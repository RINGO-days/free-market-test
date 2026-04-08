<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'image',
        'brand',
        'price',
        'number_of_like',
        'number_of_comment',
        'category_id',
        'description',
        'condition_id'
];
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function conditions()
    {
        return $this->belongsTo(Condition::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormatPriceAttribute()
    {
        return '￥' . number_format($this->price) . '(税込)';
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if(!empty($keyword)){
            $query->where('name' , 'like' , '%' . $keyword . '%');
        }
        return $query;
    }


}
