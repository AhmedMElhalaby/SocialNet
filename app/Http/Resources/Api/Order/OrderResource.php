<?php

namespace App\Http\Resources\Api\Order;

use App\Helpers\Functions;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Home\TechnicalResource;
use App\Http\Resources\Api\Home\UserResource;
use App\Http\Resources\Api\Home\CategoryResource;

class OrderResource extends JsonResource
{
    public function toArray($request): array
    {
        $Objects = array();
        $Objects['id'] = $this->getId();
        $Objects['user_id'] = $this->getUserId();
        $Objects['User'] = new UserResource($this->user);
        $Objects['category_id'] = $this->getCategoryId();
        $Objects['Category'] = new CategoryResource($this->category);
        $Objects['technical_id'] = $this->getTechnicalId();
        $Objects['Technical'] = new TechnicalResource($this->technical);
        $Objects['amount'] = $this->getAmount();
        $UserBalance = Functions::UserBalance($this->getUserId());
        if ($UserBalance >= $this->getAmount()) {
            $balance = 0;
        }else{
            $balance = $this->getAmount() - $UserBalance;
        }
        $Objects['balance'] = $balance;
        $Objects['order_date'] = Carbon::parse($this->created_at);
        $Objects['order_date'] = $this->getOrderDate();
        $Objects['order_time'] = $this->getOrderTime();
        $Objects['reject_reason'] = $this->getRejectReason();
        $Objects['cancel_reason'] = $this->getCancelReason();
        $Objects['rate'] = $this->reviews()->avg('rate')??'0';
        $Objects['address'] = $this->getAddress();
        $Objects['status'] = $this->getStatus();
        $Objects['note'] = $this->getNote();
        $Objects['status_str'] = __('crud.Order.Statuses.'.$this->getStatus());
        $Objects['OrderStatuses'] = OrderStatusResource::collection($this->order_statuses);
        return $Objects;
    }
}
