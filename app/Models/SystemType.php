<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class SystemType extends  Model
{
//    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
//    protected $hidden = [
//        'password',
//    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */

    public function type(){
        return $this->belongsTo(UserType::class , 'user_type' , 'id');
//        return $this->ha
    }
}
