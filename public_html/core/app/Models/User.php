<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\LockableTrait;

class User extends Authenticatable
{
    use HasFactory, Notifiable, LockableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile', 'provider', 'provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The courses that belong to the user.
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'user_courses')->withTimestamps();
    }
    
    /**
     * The batches that belong to the user.
     */
    public function batches()
    {
        return $this->belongsToMany(Batch::class, 'user_batches')->withTimestamps();
    }

    /**
     * The assignment that belong to the user.
     */
    public function assignments()
    {
        return $this->belongsToMany(Assignment::class, 'user_assignments')->withTimestamps();
    }

    /**
     * The attendances that belong to the user.
     */
    public function attendances()
    {
        return $this->belongsToMany(Attendance::class, 'user_attendances')->withTimestamps();
    }

    /**
     * The jobs that belong to the user.
     */
    public function jobs()
    {
        return $this->belongsToMany(Batch::class, 'user_jobs')->withTimestamps();
    }

}
