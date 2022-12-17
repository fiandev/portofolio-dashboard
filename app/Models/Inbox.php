<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    protected $with = [];
    protected $hidden = [
      "id",
      "user_id",
    ];
      
    public function author () {
      return $this->belongsTo(User::class, "user_id");
    }
    public function getRouteKeyName(){
      return "uid";
    }
}
