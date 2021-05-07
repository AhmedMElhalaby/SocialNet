<?php

namespace App\Http\Requests\Api\Home;

use App\Helpers\Constant;
use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Home\AdvertisementResource;
use App\Http\Resources\Api\Home\CategoryResource;
use App\Http\Resources\Api\Home\CountryResource;
use App\Http\Resources\Api\Home\IssueResource;
use App\Models\Advertisement;
use App\Models\Category;
use App\Models\Country;
use App\Models\Issue;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;

class InstallRequest extends ApiRequest
{
    public function run(): JsonResponse
    {
        $data = [];
        $data['Settings'] = Setting::pluck((app()->getLocale() =='en')?'value':'value_ar','key')->toArray();
        $data['Categories'] = CategoryResource::collection(Category::where('is_active',true)->get());
        $data['Countries'] = CountryResource::collection(Country::where('is_active',true)->get());
        $data['Issues'] = IssueResource::collection(Issue::where('is_active',true)->get());
        $data['Advertisements'] = AdvertisementResource::collection(Advertisement::where('is_active',true)->get());
        $data['Essentials'] = [
            'TicketsStatus'=>Constant::TICKETS_STATUS,
            'NotificationType'=>Constant::NOTIFICATION_TYPE,
            'VerificationType'=>Constant::VERIFICATION_TYPE,
            'PaymentMethod'=>Constant::PAYMENT_METHOD,
            'TransactionStatus'=>Constant::TRANSACTION_STATUS,
            'TransactionTypes'=>Constant::TRANSACTION_TYPES,
            'UserTypes'=>Constant::USER_TYPE,
            'OrderStatuses'=>Constant::ORDER_STATUSES,
        ];
        return $this->successJsonResponse([],$data);
    }
}
