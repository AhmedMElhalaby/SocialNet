<?php

namespace App\Http\Requests\Api\Home;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Home\CategoryResource;
use App\Http\Resources\Api\Home\IssueResource;
use App\Http\Resources\Api\Home\IssueTypeResource;
use App\Http\Resources\Api\Home\TechnicalResource;
use App\Models\Category;
use App\Models\Issue;
use App\Models\IssueType;
use App\Models\User;
use App\Models\UserCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

class IssueIssueTypeRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'issue_id'=>'required|exists:issues,id'
        ];
    }

    public function run(): JsonResponse
    {
        return $this->successJsonResponse([],IssueTypeResource::collection(IssueType::where('issue_id',$this->issue_id)->get()),'IssueTypes');
    }
}
