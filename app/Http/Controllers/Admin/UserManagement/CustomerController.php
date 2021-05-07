<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Helpers\Constant;
use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\UserManagement\User\ActiveEmailMobileRequest;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\User;
use App\Traits\AhmedPanelTrait;

class CustomerController extends Controller
{
    use AhmedPanelTrait;

    public function setup()
    {
        $this->setRedirect('user_managements/customers');
        $this->setEntity(new User());
        $this->setViewShow('Admin.UserManagement.Customer.show');
        $this->setTable('users');
        $this->setLang('Customer');
        $this->setFilters([
            'type'=>[
                'name'=>'type',
                'type'=>'where',
                'value'=>Constant::USER_TYPE['Customer']
            ]
        ]);
        $this->setColumns([
            'name'=> [
                'name'=>'name',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>true
            ],
            'mobile'=> [
                'name'=>'mobile',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>true
            ],
            'email'=> [
                'name'=>'email',
                'type'=>'email',
                'is_searchable'=>true,
                'order'=>true
            ],
            'is_active'=> [
                'name'=>'is_active',
                'type'=>'active',
                'is_searchable'=>true,
                'order'=>true
            ],
            'created_at'=> [
                'name'=>'created_at',
                'type'=>'datetime',
                'is_searchable'=>true,
                'order'=>true
            ],
        ]);
        $this->setFields([
            'name'=> [
                'name'=>'name',
                'type'=>'text',
                'is_required'=>true,
            ],
            'mobile'=> [
                'name'=>'mobile',
                'type'=>'text',
                'is_required'=>true,
            ],
            'email'=> [
                'name'=>'email',
                'type'=>'email',
                'is_required'=>true,
            ],
            'country_id'=> [
                'name'=>'country_id',
                'type'=>'custom_relation',
                'relation'=>[
                    'data'=> Country::all(),
                    'custom'=>function($Object){
                        return ($Object)?$Object->getName():'-';
                    },
                    'entity'=>'countries'
                ],
                'is_required'=>true,
            ],
            'city_id'=> [
                'name'=>'city_id',
                'type'=>'custom_relation',
                'relation'=>[
                    'data'=> City::all(),
                    'custom'=>function($Object){
                        return ($Object)?$Object->getName():'-';
                    },
                    'entity'=>'city'
                ],
                'is_required'=>true,
            ],
            'avatar'=> [
                'name'=>'avatar',
                'type'=>'image',
                'is_required'=>false,
                'is_required_update'=>false
            ],
            'address'=> [
                'name'=>'address',
                'type'=>'text',
                'is_required'=>true,
            ],
            'is_active'=> [
                'name'=>'is_active',
                'type'=>'active',
                'is_required'=>true,
            ],
        ]);
        $this->SetLinks([
            'active_mobile_email'=>[
                'route'=>'active_mobile_email',
                'icon'=>'fa-check-square',
                'lang'=>__('crud.Customer.Links.active_mobile_email',[],session('my_locale')),
                'condition'=>function ($Object){
                    return (is_null($Object->getEmailVerifiedAt())|| is_null($Object->getMobileVerifiedAt()));
                }
            ],
            'active',
            'show',
            'change_password',
        ]);
    }
    public function active_mobile_email($id,ActiveEmailMobileRequest $request){
        return $request->preset($this,$id);
    }
}
