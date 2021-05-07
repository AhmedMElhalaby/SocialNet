<?php

namespace App\Http\Requests\Api\Order;

use App\Helpers\Constant;
use App\Helpers\Functions;
use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Order\OrderResource;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\JsonResponse;

/**
 * @property mixed product_id
 * @property mixed quantity
 * @property mixed note
 * @property mixed delivered_date
 * @property mixed delivered_time
 */
class StoreRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'order_date'=>'required|date',
            'order_time'=>'required',
            'category_id'=>'required|exists:categories,id',
            'issue_id'=>'required|exists:issues,id',
            'issue_type_id'=>'required|exists:issues_types,id',
            'note'=>'sometimes|string'
        ];
    }

    public function run(): JsonResponse
    {
        $Object = new Order();
        $Object->setUserId(auth()->user()->getId());
        $Object->setCategoryId($this->category_id);
        $Object->setIssueId($this->issue_id);
        $Object->setIssueTypeId($this->issue_type_id);
        $Object->setOrderDate($this->order_date);
        $Object->setOrderTime($this->order_time);
        $Object->setStatus(Constant::ORDER_STATUSES['New']);
        $Object->setNote(@$this->note);
        $Object->save();
        $Object->refresh();
        Functions::ChangeOrderStatus($Object->getId(),Constant::ORDER_STATUSES['New']);
        Functions::SendNotification($Object->technical,'New Order','You have new order !','طلب جديد','لديك طلب جديد !',$Object->getId(),Constant::NOTIFICATION_TYPE['Order'],true);
        return $this->successJsonResponse([__('messages.created_successful')],new OrderResource($Object),'Order');

    }
}
