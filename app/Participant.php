<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participant extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    /**
     * Get the attendances for the blog post.
     */
    public function attendances()
    {
        return $this->hasMany('App\Attendance', 'participant_id');
    }

    /**
     * Get the reports for the blog post.
     */
    public function reports()
    {
        return $this->hasMany('App\Report', 'participant_id');
    }

    /**
     * Get the product for the blog post.
     */
    public function product()
    {
        return $this->hasOne('App\Product', 'participant_id');
    }


    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
