<?php

namespace App\Http\Requests\Admin\UserManagement\User;

use App\Helpers\Constant;
use App\Models\Transaction;
use App\Models\UserTime;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class EditTimeRequest extends FormRequest
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
        return [
        ];
    }
    public function preset($crud,$id){
        $Object = $crud->getEntity()->find($id);
        if(!$Object)
            return $crud->wrongData();
        $UserTime = (new UserTime())->firstOrCreate(['user_id'=>$Object->getId()]);
        return view('Admin.UserManagement.Technical.edit_times',compact('Object','UserTime'))->with($crud->getParams());
    }
}
