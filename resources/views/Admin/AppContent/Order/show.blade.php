@extends('AhmedPanel.crud.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header " data-background-color="{{ config('app.color') }}">
                    <h4 class="title">{{__('admin.show')}} {{__(('crud.'.$lang.'.crud_the_name'))}}</h4>
                </div>
                <div class="card-content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-content table-responsive">
                                    <table class="table table-hover">
                                        <tr>
                                            <th style="border-top: none !important;">{{__('crud.'.$lang.'.user_id')}}</th>
                                            <td style="border-top: none !important;">{{$Object->user->getName()}}</td>
                                        </tr>
                                        <tr>
                                            <th style="border-top: none !important;">{{__('crud.'.$lang.'.freelancer_id')}}</th>
                                            <td style="border-top: none !important;">{{($Object->technical)?$Object->technical->getName():'-'}}</td>
                                        </tr>
                                        <tr>
                                            <th style="border-top: none !important;">{{__('crud.'.$lang.'.category_id')}}</th>
                                            <td style="border-top: none !important;">{{($Object->category)?(app()->getLocale()=='ar')?$Object->category->getNameAr():$Object->category->getName():'-'}}</td>
                                        </tr>
                                        <tr>
                                            <th style="border-top: none !important;">{{__('crud.'.$lang.'.issue_id')}}</th>
                                            <td style="border-top: none !important;">{{($Object->issue)?(app()->getLocale()=='ar')?$Object->issue->getNameAr():$Object->issue->getName():'-'}}</td>
                                        </tr>
                                        <tr>
                                            <th style="border-top: none !important;">{{__('crud.'.$lang.'.issue_type_id')}}</th>
                                            <td style="border-top: none !important;">{{($Object->issue_type)?(app()->getLocale()=='ar')?$Object->issue_type->getNameAr():$Object->issue_type->getName():'-'}}</td>
                                        </tr>
                                        <tr>
                                            <th style="border-top: none !important;">{{__('crud.'.$lang.'.status')}}</th>
                                            <td style="border-top: none !important;">{{\App\Helpers\Constant::ORDER_STATUSES_STR[$Object->getStatus()]}}</td>
                                        </tr>
                                      </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-content table-responsive">
                                    <table class="table table-hover">
                                        <tr>
                                            <th style="border-top: none !important;">{{__('crud.'.$lang.'.order_date')}}</th>
                                            <td style="border-top: none !important;">{{$Object->getOrderDate()}}</td>
                                        </tr>
                                        <tr>
                                            <th style="border-top: none !important;">{{__('crud.'.$lang.'.order_time')}}</th>
                                            <td style="border-top: none !important;">{{$Object->getOrderTime()}}</td>
                                        </tr>
                                        <tr>
                                            <th style="border-top: none !important;">{{__('crud.'.$lang.'.note')}}</th>
                                            <td style="border-top: none !important;">{{$Object->getNote()}}</td>
                                        </tr>
                                        @if($Object->getStatus() == \App\Helpers\Constant::ORDER_STATUSES['Rejected'])
                                        <tr>
                                            <th style="border-top: none !important;">{{__('crud.'.$lang.'.reject_reason')}}</th>
                                            <td style="border-top: none !important;">{{$Object->getRejectReason()}}</td>
                                        </tr>
                                        @endif
                                        @if($Object->getStatus() == \App\Helpers\Constant::ORDER_STATUSES['Canceled'])
                                        <tr>
                                            <th style="border-top: none !important;">{{__('crud.'.$lang.'.cancel_reason')}}</th>
                                            <td style="border-top: none !important;">{{$Object->getCancelReason()}}</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <th style="border-top: none !important;">{{__('crud.'.$lang.'.amount')}}</th>
                                            <td style="border-top: none !important;">{{$Object->getAmount()}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header text-center" style="padding: 5px" data-background-color="{{ config('app.color') }}">
                                    <h4 class="title"> {{__('crud.Order.statuses_history')}}</h4>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th style="border-top: none !important;">{{__('crud.Order.status')}}</th>
                                            <th style="border-top: none !important;">{{__('crud.Order.created_at')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($Object->order_statuses as $order_status)
                                            <tr>
                                                <td>{{__('crud.Order.Statuses.'.$order_status->getStatus())}}</td>
                                                <td>{{\Carbon\Carbon::parse($order_status->created_at)->format('Y-m-d h:i A')}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
