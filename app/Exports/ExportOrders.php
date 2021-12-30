<?php

namespace App\Exports;

class ExportOrders
{
    const COLUMN = [
        'book_id','book_title','borrowed_by','borrowed_at','returned_at'
    ];
    public static function getMappingData():array
    {
        return [
            'book_id'=>function($order){ return $order->book_id;},
            'book_title'=>function($order){ return $order->book?$order->book->title:'-';},
            'borrowed_by'=>function($order){ return $order->user?$order->user->name:'-';},
            'borrowed_at'=>function($order){ return $order->borrowed_at;},
            'returned_at'=>function($order){ return $order->returned_at;},
        ];
    }
}
