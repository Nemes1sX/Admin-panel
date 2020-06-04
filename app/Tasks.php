<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $fillable = ['name', 'description', 'status', 'user_id', 'taskdate'];//

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
