<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apikey extends Model
{
    use HasFactory;
    protected $table = "apikeys";
    protected $guarded = ["id"];
    protected $with = [];
    
    public function author () {
      return $this->belongsTo(User::class, "user_id");
    }
}
