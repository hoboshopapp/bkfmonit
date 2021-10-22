<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserType extends Model
{
//    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'user_type';
    protected $primaryKey = 'id';
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

    public function users(){
       return $this->hasMany(User::class , 'user_type' );
    }
}
