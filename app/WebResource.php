<?php

namespace App;

use App\Enumerators\SectionsEnumerator;
use App\Enumerators\UserEnumerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WebResource extends Model
{
    protected $table = 'web_resources';
    protected $fillable = [
        'login',
        'password',
        'method',
    ];

    public function scopeSecret()
    {
        return $this->where('method', '=', UserEnumerator::METHOD_SECRET);
    }

    public function scopeKey()
    {
        return $this->where('method', '=', UserEnumerator::METHOD_KEY);
    }

    public function web()
    {
        return $this->belongsTo(Web::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
