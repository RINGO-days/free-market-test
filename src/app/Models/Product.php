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
    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
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

    public function likeBy($user):bool
    {
        return $this->likes()->where('user_id',$user->id)->exists();
    }


}
