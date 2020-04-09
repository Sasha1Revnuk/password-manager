<?php

namespace App;

use App\Enumerators\SectionsEnumerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WebResource extends Model
{
    protected $table = 'web_resources';
    protected $fillable = [
        'login',
        'password',
    ];


    public function web()
    {
        return $this->belongsTo(Web::class);
    }




}
