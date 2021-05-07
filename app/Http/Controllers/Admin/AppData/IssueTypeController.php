<?php

namespace App\Http\Controllers\Admin\AppData;

use App\Http\Controllers\Admin\Controller;
use App\Models\Issue;
use App\Models\IssueType;
use App\Traits\AhmedPanelTrait;

class IssueTypeController extends Controller
{
    use AhmedPanelTrait;

    public function setup()
    {
        $this->setRedirect('app_data/issues_types');
        $this->setEntity(new IssueType());
        $this->setTable('issues_types');
        $this->setLang('IssueType');
        $this->setColumns([
            'issue_id'=> [
                'name'=>'issue_id',
                'type'=>'custom_relation',
                'relation'=>[
                    'data'=> Issue::all(),
                    'custom'=>function($Object){
                        return app()->getLocale() == 'ar'?$Object->getNameAr():$Object->getName();
                    },
                    'entity'=>'issue'
                ],
                'is_searchable'=>true,
                'order'=>true
            ],
            'name'=> [
                'name'=>'name',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>true
            ],
            'name_ar'=> [
                'name'=>'name_ar',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>true
            ],
            'price'=> [
                'name'=>'price',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>true
            ],
            'is_active'=> [
                'name'=>'is_active',
                'type'=>'active',
                'is_searchable'=>true,
                'order'=>true
            ],
        ]);
        $this->setFields([
            'issue_id'=> [
                'name'=>'issue_id',
                'type'=>'custom_relation',
                'relation'=>[
                    'data'=> Issue::all(),
                    'custom'=>function($Object){
                        return app()->getLocale() == 'ar'?$Object->getNameAr():$Object->getName();
                    },
                    'entity'=>'issue'
                ],
                'is_required'=>true
            ],
            'name'=> [
                'name'=>'name',
                'type'=>'text',
                'is_required'=>true
            ],
            'name_ar'=> [
                'name'=>'name_ar',
                'type'=>'text',
                'is_required'=>true
            ],
            'price'=> [
                'name'=>'price',
                'type'=>'text',
                'is_required'=>true
            ],
            'is_active'=> [
                'name'=>'is_active',
                'type'=>'active',
                'is_required'=>true
            ],
        ]);
        $this->SetLinks([
            'edit',
            'delete',
        ]);
    }

}
