<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function vote()
    {
        return $this->hasOne('App\Vote');
    }
}
