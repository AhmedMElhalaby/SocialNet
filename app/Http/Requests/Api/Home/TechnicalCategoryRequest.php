<?php

namespace App\Http\Requests\Api\Home;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Home\CategoryResource;
use App\Http\Resources\Api\Home\TechnicalResource;
use App\Models\Category;
use App\Models\User;
use App\Models\UserCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

class TechnicalCategoryRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'technical_id'=>'required|exists:users,id'
        ];
    }

    public function run(): JsonResponse
    {
        $CategoriesIds = UserCategory::where('user_id',$this->technical_id)->pluck('category_id');
        return $this->successJsonResponse([],CategoryResource::collection((new Category())->whereIn('id',$CategoriesIds)->get()),'Categories');

    }
}
