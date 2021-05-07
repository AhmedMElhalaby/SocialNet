<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Helpers\Constant;
use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\UserManagement\User\ActiveEmailMobileRequest;
use App\Http\Requests\Admin\UserManagement\User\EditTimePostRequest;
use App\Http\Requests\Admin\UserManagement\User\EditTimeRequest;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\User;
use App\Models\UserCategory;
use App\Traits\AhmedPanelTrait;

class TechnicalController extends Controller
{
    use AhmedPanelTrait;

    public function setup()
    {
        $this->setRedirect('user_managements/technicals');
        $this->setEntity(new User());
        $this->setViewShow('Admin.UserManagement.Technical.show');
        $this->setTable('users');
        $this->setLang('Technical');
        $this->setFilters([
            'type'=>[
                'name'=>'type',
                'type'=>'where',
                'value'=>Constant::USER_TYPE['Technical']
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
                    'entity'=>'country'
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
            'address'=> [
                'name'=>'address',
                'type'=>'text',
                'is_required'=>true,
            ],
            'nationality'=> [
                'name'=>'nationality',
                'type'=>'text',
                'is_required'=>true,
            ],
            'religion'=> [
                'name'=>'religion',
                'type'=>'select',
                'data'=>[
                    Constant::TechnicalReligion['Muslim'] =>__('crud.Technical.Religious.'.Constant::TechnicalReligion['Muslim'],[],session('my_locale')),
                    Constant::TechnicalReligion['Non-Muslim'] =>__('crud.Technical.Religious.'.Constant::TechnicalReligion['Non-Muslim'],[],session('my_locale')),
                ],
                'is_required'=>true,
            ],
            'password'=> [
                'name'=>'password',
                'type'=>'password',
                'is_required'=>true,
                'editable'=>false,
                'confirmation'=>true
            ],
            'avatar'=> [
                'name'=>'avatar',
                'type'=>'image',
                'is_required'=>true,
                'is_required_update'=>false
            ],
            'user_categories'=> [
                'name'=>'user_categories',
                'type'=>'multi_checkbox',
                'custom'=>[
                    'ListModel'=>[
                        'Model'=>(new Category())->all(),
                        'name'=>(session('my_locale') =='ar')?'name_ar':'name',
                        'id'=>'id',
                    ],
                    'RelationModel'=>[
                        'Model'=>(new UserCategory()),
                        'ref_id'=>'category_id',
                        'id'=>'user_id',
                    ],
                    'CheckFunc'=>function ($Object ,$id){
                        if($Object){
                            return $Object->hasCategory($id);
                        }
                        return false;
                    }
                ],
                'is_required'=>false,
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
                'lang'=>__('crud.Technical.Links.active_mobile_email',[],session('my_locale')),
                'condition'=>function ($Object){
                    return (is_null($Object->getEmailVerifiedAt())|| is_null($Object->getMobileVerifiedAt()));
                }
            ],
            'edit_times'=>[
                'route'=>'edit_times',
                'icon'=>'fa-calendar',
                'lang'=>__('crud.Technical.Links.edit_times',[],session('my_locale')),
                'condition'=>function ($Object){
                    return true;
                }
            ],
            'active',
            'edit',
            'show',
            'change_password',
        ]);
    }
    public function active_mobile_email($id,ActiveEmailMobileRequest $request){
        return $request->preset($this,$id);
    }
    public function edit_times($id,EditTimeRequest $request){
        return $request->preset($this,$id);
    }
    public function post_edit_times($id,EditTimePostRequest $request){
        return $request->preset($this,$id);
    }
}
