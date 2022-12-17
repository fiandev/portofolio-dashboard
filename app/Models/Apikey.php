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
    public function logs () {
      return $this->hasMany(ApikeyLog::class, "apikey_id");
    }
    public function getRouteKeyName(){
      return "key";
    }
}
