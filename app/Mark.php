<?php

namespace App;

use App\Enumerators\SectionsEnumerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mark extends Model
{
    protected $table = 'marks';
    protected $fillable = [
        'name',
        'user_id',
        'url'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
