<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use App\User;
use App\createEvent;

class Category extends Model
{
    // use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        "id",
        "name",
        "created_at",
        "updated_at",
    ];

    public function event() {
        return $this->hasMany(createEvent::class);
    }
}
