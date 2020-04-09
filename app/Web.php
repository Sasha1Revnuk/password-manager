<?php

namespace App;

use App\Enumerators\SectionsEnumerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Web extends Model
{
    protected $table = 'webs';
    protected $fillable = [
        'name',
        'user_id',
        'url'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function webGroup()
    {
        return $this->belongsTo(WebGroup::class);
    }

    public function resources()
    {
        return $this->hasMany(WebResource::class);
    }

}
