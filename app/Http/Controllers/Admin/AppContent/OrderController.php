<?php

namespace App\Http\Controllers\Admin\AppContent;

use App\Helpers\Constant;
use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\AppContent\Order\StoreRequest;
use App\Models\Category;
use App\Models\Issue;
use App\Models\IssueType;
use App\Models\Order;
use App\Models\User;
use App\Traits\AhmedPanelTrait;

class OrderController extends Controller
{
    use AhmedPanelTrait;

    public function setup()
    {
        $this->setRedirect('app_content/orders');
        $this->setEntity(new Order());
        $this->setTable('orders');
        $this->setLang('Order');
        $this->setViewShow('Admin.AppContent.Order.show');
        $this->setViewCreate('Admin.AppContent.Order.create');
        $this->setColumns([
            'user_id'=> [
                'name'=>'user_id',
                'type'=>'custom_relation',
                'relation'=>[
                    'data'=> User::where('type',Constant::USER_TYPE['Customer'])->get(),
                    'custom'=>function($Object){
                        return ($Object)?$Object->getName():'-';
                    },
                    'entity'=>'user'
                ],
                'is_searchable'=>true,
                'order'=>true
            ],
            'technical_id'=> [
                'name'=>'technical_id',
                'type'=>'custom_relation',
                'relation'=>[
                    'data'=> User::where('type',Constant::USER_TYPE['Technical'])->get(),
                    'custom'=>function($Object){
                        return ($Object)?$Object->getName():'-';
                    },
                    'entity'=>'technical'
                ],
                'is_searchable'=>true,
                'order'=>true
            ],
            'category_id'=> [
                'name'=>'category_id',
                'type'=>'custom_relation',
                'relation'=>[
                    'data'=> Category::all(),
                    'custom'=>function($Object){
                        return ($Object)?$Object->getName():'-';
                    },
                    'entity'=>'category'
                ],
                'is_searchable'=>true,
                'order'=>true
            ],
            'status'=> [
                'name'=>'status',
                'type'=>'select',
                'data'=>[
                    Constant::ORDER_STATUSES['New'] =>__('crud.Order.Statuses.'.Constant::ORDER_STATUSES['New'],[],session('my_locale')),
                    Constant::ORDER_STATUSES['Accept'] =>__('crud.Order.Statuses.'.Constant::ORDER_STATUSES['Accept'],[],session('my_locale')),
                    Constant::ORDER_STATUSES['Rejected'] =>__('crud.Order.Statuses.'.Constant::ORDER_STATUSES['Rejected'],[],session('my_locale')),
                    Constant::ORDER_STATUSES['Canceled'] =>__('crud.Order.Statuses.'.Constant::ORDER_STATUSES['Canceled'],[],session('my_locale')),
                    Constant::ORDER_STATUSES['InProgress'] =>__('crud.Order.Statuses.'.Constant::ORDER_STATUSES['InProgress'],[],session('my_locale')),
                    Constant::ORDER_STATUSES['Finished'] =>__('crud.Order.Statuses.'.Constant::ORDER_STATUSES['Finished'],[],session('my_locale')),
                ],
                'is_searchable'=>true,
                'order'=>true
            ],
            'amount'=> [
                'name'=>'amount',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>true
            ]
        ]);
        $this->setFields([
            'user_id'=> [
                'name'=>'user_id',
                'type'=>'custom_relation',
                'relation'=>[
                    'data'=> User::where('type',Constant::USER_TYPE['Customer'])->get(),
                    'custom'=>function($Object){
                        return ($Object)?$Object->getName():'-';
                    },
                    'entity'=>'user'
                ],
                'is_required'=>true,
            ],
            'technical_id'=> [
                'name'=>'technical_id',
                'type'=>'custom_relation',
                'relation'=>[
                    'data'=> User::where('type',Constant::USER_TYPE['Technical'])->get(),
                    'custom'=>function($Object){
                        return ($Object)?$Object->getName():'-';
                    },
                    'entity'=>'technical'
                ],
                'is_required'=>true,
            ],
            'category_id'=> [
                'name'=>'category_id',
                'type'=>'custom_relation',
                'relation'=>[
                    'data'=> [],
                    'custom'=>function($Object){
                        return ($Object)?session('my_locale') =='ar'?$Object->getNameAr():$Object->getName():'-';
                    },
                    'entity'=>'category'
                ],
                'is_required'=>true,
            ],
            'issue_id'=> [
                'name'=>'issue_id',
                'type'=>'custom_relation',
                'relation'=>[
                    'data'=> [],
                    'custom'=>function($Object){
                        return ($Object)?session('my_locale') =='ar'?$Object->getNameAr():$Object->getName():'-';
                    },
                    'entity'=>'issue'
                ],
                'is_required'=>true,
            ],
            'issue_type_id'=> [
                'name'=>'issue_type_id',
                'type'=>'custom_relation',
                'relation'=>[
                    'data'=> [],
                    'custom'=>function($Object){
                        return ($Object)?session('my_locale') =='ar'?$Object->getNameAr():$Object->getName():'-';
                    },
                    'entity'=>'issue_type'
                ],
                'is_required'=>true,
            ],
            'amount'=>[
                'name'=>'amount',
                'type'=>'number',
                'is_required'=>true,
            ],
            'order_date'=>[
                'name'=>'order_date',
                'type'=>'date',
                'is_required'=>true,
            ],
            'order_time'=>[
                'name'=>'order_time',
                'type'=>'time',
                'is_required'=>true,
            ],
            'address'=>[
                'name'=>'address',
                'type'=>'text',
                'is_required'=>true,
            ],
            'note'=>[
                'name'=>'note',
                'type'=>'textarea',
                'is_required'=>false,
            ],
            'images'=>[
                'name'=>'images',
                'type'=>'images',
                'is_required'=>false,
            ],
        ]);
        $this->SetLinks([
            'show',
        ]);
    }
    public function store(StoreRequest $request)
    {
        return $request->preset($this);
    }

}
