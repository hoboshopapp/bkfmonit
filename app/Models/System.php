<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class System extends Model
{
//    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'systems';
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

    public function records(){
       return $this->hasMany(SystemRecord::class  , 'system_id')->limit(10);
    }
        public function temp_records(){
        return $this->hasMany(SystemTempRecord::class  , 'system_id')->limit(10)->orderBy('id' , 'desc');
    }
}
