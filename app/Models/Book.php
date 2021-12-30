<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * status  book not in lib
     */
    public const STATUS_NOT_IN_LIB = 0;
    /**
     * status book in lib
     */
    public const STATUS_IN_LIB = 1;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * get the category name for book.
     * @return string
     */
    public function getCategoryName()
    {
        if ($this->category) {
            return $this->category->name;
        } else {
            return 'uncategorized';
        }
    }
}
