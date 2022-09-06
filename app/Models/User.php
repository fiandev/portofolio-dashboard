<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory;
    protected $guarded = ["id"];
    protected $table = "users";
    
    protected $with = ["skills", "links"];
    
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    
    public function inboxes() {
      return $this->hasMany(Inbox::class);
    }
    public function skills() {
      return $this->hasMany(Skill::class);
    }
    
    public function links() {
      return $this->hasMany(Link::class);
    }
    
    public function apikeys() {
      return $this->hasMany(Apikey::class);
    }
    
    public function getRouteKeyName(){
      return "username";
    }
}
