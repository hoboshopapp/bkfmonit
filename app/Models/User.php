<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends  Model
{
    use HasFactory;
//    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'users';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     *
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'user_type',
        'api_key',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'api_key',
        'created_at',
        'updated_at'

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */

    public function type(){
        return $this->belongsTo(UserType::class , 'user_type');
//        return $this->ha
    }
    public function systems(){
        return $this->hasMany(System::class , 'user_id')->orderBy('id');
//        return $this->ha
    }
}
