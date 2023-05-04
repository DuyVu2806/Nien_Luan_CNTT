<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    protected $fillable = [
        'user_id',
        'rating',
        'outstanding_feature',
        'transportation',
        'comment',
        'order_item_id'
    ];

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class, 'order_item_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function replyComment()
    {
        return $this->belongsTo(ReplyComment::class,'comment_id','id');
    }
}
