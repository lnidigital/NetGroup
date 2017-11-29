<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
