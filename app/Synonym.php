<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Synonym extends Model
{
    protected $table = 'synonyms';

    public function slot()
    {
        return $this->belongsTo('App\Slot', 'slotID');
    }
}
