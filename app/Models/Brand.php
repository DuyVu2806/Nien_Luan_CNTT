<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';

    protected $fillable = [
        'name',
        'slug',
        'category_id',        
        'status',

    ];

    public function category()
    {
        return $this->BelongsTo(Category::class,'category_id','id')->where('status','0');
    }
}
