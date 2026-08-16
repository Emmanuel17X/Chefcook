<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Recette;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Observers\Notes_recetteObserver;

#[ObservedBy([Notes_recetteObserver::class])]

class Notes_recette extends Model
{


    protected $primaryKey = 'id_note1';

    protected $fillable = [
        'value',
        'id_user',
        'id_recette'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function recette(){
        return $this->belongsTo(Recette::class, 'id_recette', 'id_recette');
    }
}
