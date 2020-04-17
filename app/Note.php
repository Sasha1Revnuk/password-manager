<?php

namespace App;

use App\Enumerators\SectionsEnumerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    protected $table = 'notes';
    protected $fillable = [
        'name',
        'user_id',
        'text'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
