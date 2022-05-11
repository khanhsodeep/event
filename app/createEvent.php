<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use App\User;
use App\Category;

class createEvent extends Model
{
    // use HasFactory;
    protected $table = 'event';
    protected $fillable = [
        "id",
        "name_event",
        "content",
        "status",
        "user_id",
        "amount",
        "member",
        "category_id",
        "time",
        "address",
        "created_at",
        "updated_at",
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
