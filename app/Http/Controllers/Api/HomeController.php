<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Home\AdvertisementRequest;
use App\Http\Requests\Api\Home\CategoryRequest;
use App\Http\Requests\Api\Home\FaqRequest;
use App\Http\Requests\Api\Home\TechnicalCategoryRequest;
use App\Http\Requests\Api\Home\CategoryIssueRequest;
use App\Http\Requests\Api\Home\IssueIssueTypeRequest;
use App\Http\Requests\Api\Home\InstallRequest;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    use ResponseTrait;
    public function install(InstallRequest $request): JsonResponse
    {
        return $request->run();
    }
    public function faqs(FaqRequest $request): JsonResponse
    {
        return $request->run();
    }
    public function advertisements(AdvertisementRequest $request): JsonResponse
    {
        return $request->run();
    }
    public function categories(CategoryRequest $request): JsonResponse
    {
        return $request->run();
    }
    public function technical_categories(TechnicalCategoryRequest $request): JsonResponse
    {
        return $request->run();
    }
    public function category_issues(CategoryIssueRequest $request): JsonResponse
    {
        return $request->run();
    }
    public function issue_issue_types(IssueIssueTypeRequest $request): JsonResponse
    {
        return $request->run();
    }
}
