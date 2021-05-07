<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Helpers\Constant;
use App\Http\Controllers\Admin\Controller;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserSubscription;
use App\Traits\AhmedPanelTrait;

class UserSubscriptionController extends Controller
{
    use AhmedPanelTrait;

    public function setup()
    {
        $this->setRedirect('user_managements/users_subscriptions');
        $this->setEntity(new UserSubscription());
        $this->setCreate(false);
        $this->setTable('users_subscriptions');
        $this->setLang('UserSubscription');
        $this->setColumns([
            'user_id'=> [
                'name'=>'user_id',
                'type'=>'custom_relation',
                'relation'=>[
                    'data'=> User::all(),
                    'custom'=>function($Object){
                        return $Object->getName();
                    },
                    'entity'=>'user'
                ],
                'is_searchable'=>true,
                'order'=>true
            ],
            'subscription_id'=> [
                'name'=>'subscription_id',
                'type'=>'custom_relation',
                'relation'=>[
                    'data'=> Subscription::all(),
                    'custom'=>function($Object){
                        return app()->getLocale() == 'ar'?$Object->getNameAr():$Object->getName();
                    },
                    'entity'=>'subscription'
                ],
                'is_searchable'=>true,
                'order'=>true
            ],
            'expire_date'=> [
                'name'=>'expire_date',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>true
            ],
            'status'=> [
                'name'=>'status',
                'type'=>'select',
                'data'=>[
                    Constant::USER_SUBSCRIPTION['Pending'] =>__('crud.UserSubscription.Statuses.'.Constant::USER_SUBSCRIPTION['Pending'],[],session('my_locale')),
                    Constant::USER_SUBSCRIPTION['Approved'] =>__('crud.UserSubscription.Statuses.'.Constant::USER_SUBSCRIPTION['Approved'],[],session('my_locale')),
                    Constant::USER_SUBSCRIPTION['Rejected'] =>__('crud.UserSubscription.Statuses.'.Constant::USER_SUBSCRIPTION['Rejected'],[],session('my_locale')),
                ],
                'is_searchable'=>true,
                'order'=>true
            ],
        ]);
        $this->SetLinks([
        ]);
    }
}
