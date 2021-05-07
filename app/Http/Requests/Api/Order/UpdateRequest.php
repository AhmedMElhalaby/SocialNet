<?php

namespace App\Http\Requests\Api\Order;

use App\Helpers\Functions;
use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Order\OrderResource;
use App\Models\Order;
use App\Helpers\Constant;
use App\Models\Setting;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;

/**
 * @property mixed order_id
 * @property mixed status
 * @property mixed reject_reason
 * @property mixed cancel_reason
 */
class UpdateRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'order_id'=>'required|exists:orders,id',
            'status'=>'required|in:'.Constant::ORDER_STATUSES_RULES
        ];
    }

    public function run(): JsonResponse
    {
        $Object = (new Order)->find($this->order_id);
        switch ($this->status){
            case Constant::ORDER_STATUSES['Accept']:{
                if ($Object->getStatus() !=Constant::ORDER_STATUSES['New']) {
                    return $this->failJsonResponse([__('messages.wrong_sequence')]);
                }
                $Object->setStatus(Constant::ORDER_STATUSES['Accept']);
                $Object->save();
                Functions::ChangeOrderStatus($Object->getId(),Constant::ORDER_STATUSES['Accept']);
                Functions::SendNotification($Object->user,'Order Accept','Freelancer Accepted your order !','الموافقة على الطلب !','قام المزود بالموافقة على طلبك',$Object->getId(),Constant::NOTIFICATION_TYPE['Order']);
                break;
            }
            case Constant::ORDER_STATUSES['InProgress']:{
                if ($Object->getStatus() !=Constant::ORDER_STATUSES['Accept']) {
                    return $this->failJsonResponse([__('messages.wrong_sequence')]);
                }
                $Object->setStatus(Constant::ORDER_STATUSES['InProgress']);
                $Object->save();
                Functions::ChangeOrderStatus($Object->getId(),Constant::ORDER_STATUSES['InProgress']);
                Functions::SendNotification($Object->user,'Order In Progress','Provider start work your order !','الطلب قيد التنفيذ !','قام المزود ببدء العمل',$Object->getId(),Constant::NOTIFICATION_TYPE['Order']);
                break;
            }
            case Constant::ORDER_STATUSES['Rejected']:{
                if ($Object->getStatus() !=Constant::ORDER_STATUSES['New']) {
                    return $this->failJsonResponse([__('messages.wrong_sequence')]);
                }
                $Object->setStatus(Constant::ORDER_STATUSES['Rejected']);
                $Object->setRejectReason(@$this->reject_reason);
                $Object->save();
                Functions::ChangeOrderStatus($Object->getId(),Constant::ORDER_STATUSES['Rejected']);
                Functions::SendNotification($Object->user,'Order Rejected','Provider Rejected your order !','الرفض على الطلب !','قام المزود برفض طلبك',$Object->getId(),Constant::NOTIFICATION_TYPE['Order']);
                break;
            }
            case Constant::ORDER_STATUSES['Canceled']:{
                if ($Object->getStatus() !=Constant::ORDER_STATUSES['New']) {
                    return $this->failJsonResponse([__('messages.wrong_sequence')]);
                }
                $Object->setStatus(Constant::ORDER_STATUSES['Canceled']);
                $Object->setCancelReason(@$this->cancel_reason);
                $Object->save();
                Functions::ChangeOrderStatus($Object->getId(),Constant::ORDER_STATUSES['Canceled']);
                Functions::SendNotification($Object->technical,'Order Canceled','Customer Canceled the order !','إلغاء الطلب !','قام المستخدم بإلغاء الطلب',$Object->getId(),Constant::NOTIFICATION_TYPE['Order']);
                break;
            }
            case Constant::ORDER_STATUSES['Finished']:{
                if ($Object->getStatus() !=Constant::ORDER_STATUSES['InProgress']) {
                    return $this->failJsonResponse([__('messages.wrong_sequence')]);
                }
                $Object->setStatus(Constant::ORDER_STATUSES['Finished']);
                $Object->save();
                Functions::ChangeOrderStatus($Object->getId(),Constant::ORDER_STATUSES['Finished']);
                Functions::SendNotification($Object->user,'Order Finished','Provider Finished the order !','تم إنهاء الطلب','قام التقني بإنهاء الطلب',$Object->getId(),Constant::NOTIFICATION_TYPE['Order']);
                break;
            }
        }
        $Object->save();
        return $this->successJsonResponse([__('messages.updated_successful')],new OrderResource($Object),'Order');
    }
}
