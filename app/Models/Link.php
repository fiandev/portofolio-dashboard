<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    protected $hidden = [
        'id',
        'user_id',
        'uid',
    ];
    public function user() {
      return $this->belongsTo(User::class, "user_id");
    }
    public function types() {
      return $this->hasMany(LinkType::class);
    }
    public function getRouteKeyName(){
      return "uid";
    }
}
