<?php

namespace App\Exports;

class ExportBooks
{
    const COLUMN = [
        'book_id','book_title','book_edition','book_category'
    ];
    public static function getMappingData():array
    {
        return [
            'book_id'=>function($book){  return $book->id;},
            'book_title'=>function($book){ return $book->title;},
            'book_edition'=>function($book){ return $book->edition;},
            'book_category'=>function($book){ $category = $book->category; return $category?$category->name:'unknown';},
        ];
    }
}
