<?php

namespace App;

use App\Enumerators\SectionsEnumerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WebGroup extends Model
{
    protected $table = 'web_groups';
    protected $fillable = [
        'name',
        'user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function webs()
    {
        return $this->hasMany(Web::class);
    }


}
