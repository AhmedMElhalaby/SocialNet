<?php

namespace App\Http\Requests\Admin\AppContent\Order;

use App\Helpers\Functions;
use App\Models\Media;
use App\Models\ModelPermission;
use App\Models\ModelRole;
use App\Models\RolePermission;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Mpdf\Tag\P;

class StoreRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    public function preset($crud)
    {
        if (!Functions::CheckEmployeeDateTime($this->technical_id,$this->order_date,$this->order_time)){
            return redirect()->back()
                ->withErrors([__('messages.order_time_not_in_employee_time')]);
        }
        $Object = $crud->getEntity();
        foreach ($crud->getFilters() as $filter){
            if ($filter['type'] == 'where'){
                $Object->{$filter['name']} = $filter['value'];
            }
            elseif ($filter['type'] == 'whereNull'){
                $Object->{$filter['name']} = null;
            }
            elseif ($filter['type'] == 'whereNotNull'){
                $Object->{$filter['name']} = null;
            }
        }
        foreach ($crud->getFields() as $field) {
            if ($field['type'] == 'image'){
                if($this->hasFile($field['name'])){
                    $attribute_name = $field['name'];
                    $destination_path = "storage/media/";
                    $attribute_value = $field['name'];
                    // if a new file is uploaded, store it on disk and its filename in the database
                    if ($this->hasFile($attribute_name)) {
                        $file = $this->file($attribute_name);
                        if ($file->isValid()) {
                            $file_name = md5($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();
                            $file->move($destination_path, $file_name);
                            $attribute_value =  $destination_path.$file_name;
                        }
                    }
                    $Object->{$field['name']} = $attribute_value;
                }
            }
            elseif ($field['type'] == 'multi_checkbox'){
                $MultiCheckboxField[] = $field;
            }
            elseif ($field['type'] == 'images'){
                $ImagesField[] = $field;
            }else {
                if ($this->filled($field['name'])) {
                    $Object->{$field['name']} = $this->{$field['name']};
                }
            }
        }
        $Object->save();
        $Object->refresh();
        if(isset($MultiCheckboxField)){
            foreach ($MultiCheckboxField as $MField){
                if ($this->filled($MField['name'])){
                    foreach ($this->{$MField['name']} as $MValue){
                        $Model = $MField['custom']['RelationModel']['Model'];
                        $Model->{$MField['custom']['RelationModel']['ref_id']} = $MValue;
                        $Model->{$MField['custom']['RelationModel']['id']} = $Object->getId();
                        $Model->save();
                    }
                }
            }
        }
        if(isset($ImagesField)){
            foreach ($ImagesField as $IField){
                foreach ($this->file($IField['name']) as $IValue){
                    $Model = new Media();
                    $Model->setFile($IValue);
                    $Model->setMediaType($IField['media_type']);
                    $Model->setRefId($Object->id);
                    $Model->save();
                }
            }
        }
        if($crud->getLang() == 'Admin'){
            if($this->filled('roles')) {
                foreach ($this->roles as $role_id) {
                    $RolePermission = new ModelRole();
                    $RolePermission->setModelId($Object->getId());
                    $RolePermission->setRoleId($role_id);
                    $RolePermission->save();
                    foreach (RolePermission::where('role_id', $role_id)->get() as $Permission) {
                        $RolePermission = new ModelPermission();
                        $RolePermission->setModelId($Object->getId());
                        $RolePermission->setPermissionId($Permission->getPermissionId());
                        $RolePermission->save();
                    }
                }
            }
        }
        if($crud->getLang() == 'Admin'){
            if($this->filled('permissions'))
            {
                if ($crud->getLang() == 'Admin'){
                    foreach ($this->permissions as $permission_id){
                        $RolePermission = new ModelPermission();
                        $RolePermission->setModelId($Object->getId());
                        $RolePermission->setPermissionId($permission_id);
                        $RolePermission->save();
                    }
                }
                if ($crud->getLang() == 'Role'){
                    foreach ($this->permissions as $permission_id){
                        $RolePermission = new RolePermission();
                        $RolePermission->setRoleId($Object->getId());
                        $RolePermission->setPermissionId($permission_id);
                        $RolePermission->save();
                    }
                }
            }
        }
        return redirect($crud->getRedirect())->with('status', __('admin.messages.saved_successfully'));
    }
}
