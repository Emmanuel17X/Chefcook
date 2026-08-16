<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Recette;

class Cookingstep extends Model
{


    protected $fillable = [
        'recette_id',
        'content'
    ];

    public function recettes(){
        return $this->belongsTo(Recette::class);
    }
}
