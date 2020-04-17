<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'email', 'password', 'last_name', 'secret_password','confirm_code', 'email_id','api_token',
    ];

    protected $appends = [
        'full_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullNameAttribute() : string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function webGroups()
    {
        return $this->hasMany(WebGroup::class);
    }

    public function webs()
    {
        return $this->hasMany(Web::class);
    }

    public function webResources()
    {
        return $this->hasMany(WebResource::class);
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
