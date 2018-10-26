<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intent extends Model
{
    protected $table = "intents";

    public function slots()
    {
        return $this->hasMany('App\Slot');
    }
}
