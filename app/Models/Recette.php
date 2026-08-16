<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cookingstep;
use App\Models\User;
use App\Models\Comment;
use App\Models\Ingredient;
use App\Models\Notes_recette;

class Recette extends Model
{
    //
    protected $primaryKey = 'id_recette';

    protected $fillable = [
        'nom',
        'picture',
        'video',
        'time',
        'difficulty',
        'user_id',
        'note'
    ];

    public function ingredients(){
        return $this->belongsToMany(Ingredient::class,'recette_ingredient','id_recette','id_ingredient')->withPivot('mesure', 'quantity');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function cookingsteps(){
        return $this->hasMany(Cookingstep::class, 'recette_id', 'id_recette');
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'id_recette', 'id_recette');
    }

    public function notes_recettes(){
        return $this->hasMany(Notes_recette::class, 'id_recette', 'id_recette');
    }
}
