<?php

namespace App\Http\Requests\Admin\UserManagement\User;

use App\Helpers\Constant;
use App\Models\Transaction;
use App\Models\UserTime;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class EditTimePostRequest extends FormRequest
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
        if ($this->filled('saturday') && $this->saturday){
            $UserTime->setSaturday(true);
            $UserTime->setSaturdayStart($this->saturday_start);
            $UserTime->setSaturdayEnd($this->saturday_end);
        }else{
            $UserTime->setSaturday(false);
            $UserTime->setSaturdayStart(null);
            $UserTime->setSaturdayEnd(null);
        }
        if ($this->filled('sunday') && $this->sunday){
            $UserTime->setSunday(true);
            $UserTime->setSundayStart($this->sunday_start);
            $UserTime->setSundayEnd($this->sunday_end);
        }else{
            $UserTime->setSunday(false);
            $UserTime->setSundayStart(null);
            $UserTime->setSundayEnd(null);
        }
        if ($this->filled('monday') && $this->monday){
            $UserTime->setMonday(true);
            $UserTime->setMondayStart($this->monday_start);
            $UserTime->setMondayEnd($this->monday_end);
        }else{
            $UserTime->setMonday(false);
            $UserTime->setMondayStart(null);
            $UserTime->setMondayEnd(null);
        }
        if ($this->filled('tuesday') && $this->tuesday){
            $UserTime->setTuesday(true);
            $UserTime->setTuesdayStart($this->tuesday_start);
            $UserTime->setTuesdayEnd($this->tuesday_end);
        }else{
            $UserTime->setTuesday(false);
            $UserTime->setTuesdayStart(null);
            $UserTime->setTuesdayEnd(null);
        }
        if ($this->filled('wednesday') && $this->wednesday){
            $UserTime->setWednesday(true);
            $UserTime->setWednesdayStart($this->wednesday_start);
            $UserTime->setWednesdayEnd($this->wednesday_end);
        }else{
            $UserTime->setWednesday(false);
            $UserTime->setWednesdayStart(null);
            $UserTime->setWednesdayEnd(null);
        }
        if ($this->filled('thursday') && $this->thursday){
            $UserTime->setThursday(true);
            $UserTime->setThursdayStart($this->thursday_start);
            $UserTime->setThursdayEnd($this->thursday_end);
        }else{
            $UserTime->setThursday(false);
            $UserTime->setThursdayStart(null);
            $UserTime->setThursdayEnd(null);
        }
        if ($this->filled('friday') && $this->friday){
            $UserTime->setFriday(true);
            $UserTime->setFridayStart($this->friday_start);
            $UserTime->setFridayEnd($this->friday_end);
        }else{
            $UserTime->setFriday(false);
            $UserTime->setFridayStart(null);
            $UserTime->setFridayEnd(null);
        }
        $UserTime->save();
        return redirect($crud->getRedirect())->with('status', __('admin.messages.saved_successfully'));
    }
}
