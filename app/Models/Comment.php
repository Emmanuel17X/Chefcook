<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Recette;
use App\Models\User;

class Comment extends Model
{


    protected $fillable = [
        'content',
        'etat',
        'id_user',
        'id_post',
        'id_recette',
    ];

    public function recette(){
        return $this->belongsTo(Recette::class, 'id_recette', 'id_recette');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
