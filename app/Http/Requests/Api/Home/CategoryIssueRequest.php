<?php

namespace App\Http\Requests\Api\Home;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Home\CategoryResource;
use App\Http\Resources\Api\Home\IssueResource;
use App\Http\Resources\Api\Home\TechnicalResource;
use App\Models\Category;
use App\Models\Issue;
use App\Models\User;
use App\Models\UserCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

class CategoryIssueRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'category_id'=>'required|exists:categories,id'
        ];
    }

    public function run(): JsonResponse
    {
        return $this->successJsonResponse([],IssueResource::collection(Issue::where('category_id',$this->category_id)->get()),'Issues');
    }
}
