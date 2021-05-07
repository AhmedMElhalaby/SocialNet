<?php


namespace App\Helpers;


class Constant
{
    const NOTIFICATION_TYPE = [
        'General'=>1,
        'Ticket'=>2,
        'Order'=>3,
    ];
    const VERIFICATION_TYPE = [
        'Email'=>1,
        'Mobile'=>2
    ];
    const VERIFICATION_TYPE_RULES = '1,2';
    const TICKETS_STATUS = [
        'Open'=>1,
        'Closed'=>2
    ];
    const PAYMENT_METHOD = [
        'BankTransfer'=>1,
        'Cash'=>2,
    ];
    const PAYMENT_METHOD_RULES = '1,2';
    const TRANSACTION_STATUS = [
        'Pending'=>1,
        'Paid'=>2,
    ];
    const TRANSACTION_TYPES = [
        'Deposit'=>1,
        'Withdraw'=>2,
        'Holding'=>3,
    ];
    const SETTING_TYPE = [
        'Page'=>1,
        'Notification'=>2,
        'Values'=>3,
    ];
    const USER_TYPE=[
        'Customer'=>1,
        'Technical'=>2
    ];
    const USER_TYPE_RULES = '1,2';
    const ORDER_STATUSES = [
        'New' => 1,
        'Accept' => 2,
        'Rejected' => 3,
        'Canceled' => 4,
        'InProgress' => 5,
        'Finished' => 6,
    ];
    const ORDER_STATUSES_STR = [
        1 =>'New',
        2 =>'Accept',
        3 =>'Rejected',
        4 =>'Canceled',
        5 =>'InProgress',
        6 =>'Finished',
    ];
    const COMPLETED_ORDER_STATUSES = [self::ORDER_STATUSES['Rejected'],self::ORDER_STATUSES['Canceled'],self::ORDER_STATUSES['Finished']];
    const ORDER_STATUSES_RULES = '1,2,3,4,5,6';
    const USER_SUBSCRIPTION = [
        'Pending'=>1,
        'Approved'=>2,
        'Rejected'=>3,
    ];
    const MEDIA_TYPE = [
        'OrderImages'=>1,
    ];
    const TechnicalReligion = [
        'Muslim'=>1,
        'Non-Muslim'=>2,
    ];
}
