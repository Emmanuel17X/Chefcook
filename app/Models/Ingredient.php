<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Recette;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'picture',
    ];

    protected $primaryKey = 'id_ingredient';

    public function recettes(){
        return $this->belongsToMany(Recette::class,'recette_ingredient','id_ingredient','id_recette')->withPivot('mesure', 'quantity');
    }
}
