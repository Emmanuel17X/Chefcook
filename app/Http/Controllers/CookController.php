<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserFilterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RecetteRequest;
use App\Models\Recette;
use App\Http\Requests\CookingstepRequest;
use App\Models\Ingredient;
use App\Models\Cookingstep;
use App\Http\Requests\Notes_recetteRequest;
use App\Models\Notes_recette;

class CookController extends Controller
{
    public function profile(){
        $recettes = Recette::where('user_id', Auth::user()->id)->get();
        return view('profile.profile',[
            'recettes' => $recettes
        ]);
    }

    public function admin(){
        return view('administration');
    }

    public function recipe(){
        $ingredients = Ingredient::all();
        return view('profile.more_recipe',[
            'ingredients' => $ingredients
        ]);
    }

    public function recette($id){
        $recette = Recette::find($id);
        return view('recipe',[
            'recette' => $recette
        ]);
    }


    public function store(RecetteRequest $request, CookingstepRequest $request2){
        $recette = Recette::create($this->extractData(new Recette, $request));
        $ingredients = $request->validated('ingredients');
        $steps = [];
        foreach($ingredients as $ingredient){
            $x[$ingredient['id_ingredient']] = [
                'quantity' => $ingredient['quantity'],
                'mesure' => $ingredient['mesure']
            ];
        }
        $recette->ingredients()->sync($x);
        $data2 = $request2->validated();
        foreach($request2->validated('content') as $content){
            $recette->cookingsteps()->create(['content' => $content]);
        }


        return redirect('/')->with('success', 'Recette créée');
    }

    private function extractData(Recette $recette, RecetteRequest $request){
        $data = $request->validated();
        /** @var UploadedFile|null $image */
        $image = $data['picture'];
        if ($image === null || $image->getError()){
            return $data;
        }
        $data['picture'] = $image->store('recettes', 'public');
        return $data;
    }

    public function note($id, Notes_recetteRequest $request){
        $recette = Recette::find($id);
        $note1 = Notes_recette::where('id_user', Auth::id())->where('id_recette', $id)->first();
        if ($note1 !== null){
            $note1->update([
                'value' => $request->validated('value')
            ]);
            return redirect()->back();
        }
        $recette->notes_recettes()->create([
            'value' => $request->validated('value'),
            'id_user' => Auth::user()->id
        ]);

        return redirect()->back();
    }

    public function logout(){
        Auth::logout();
        return redirect('/')->with('success', 'Déconnexion');
    }
}
