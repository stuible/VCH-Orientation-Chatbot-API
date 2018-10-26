<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    protected $table = "slots";

    public function intent()
    {
    return $this->belongsTo('App\Intent', 'intentID');
    }

    public function synonyms()
    {
        return $this->hasMany('App\Synonym', 'slotID');
    }
}
