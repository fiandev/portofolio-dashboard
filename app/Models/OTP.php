<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{
    use HasFactory;
    
    protected $table = "otp_codes";
    protected $guarded = ["id"];
    protected $with = ["user"];
    
    public function user() {
      return $this->belongsTo(User::class, "user_id");
    }
    
    
    public function getRouteKeyName(){
      return "uid";
    }
}
