<x-app-layout>
    <x-slot:header>
        @include('layouts.header')
    </x-slot:header>

    <div class="mx-75">
        <div class="flex flex-col gap-2 items-center w-auto mt-35">
            <h1 class="text-5xl font-bold">Créer une nouvelle recette</h1>
            <h2 class="text-2xl">Partagez votre chef-d'oeuvre culinaire avec la communauté</h2>
        </div>

        <form method="post" action="{{ route('store') }}" enctype="multipart/form-data" class="mt-10 p-15 w-full flex flex-col justify-center items-start">
            @csrf
            <div class="flex h-75 w-full justify-center items-center"><!-- Deuxième div -->
                <div class="w-auto h-full flex justify-center items-center"> <!-- Côté image -->
                    <div class="flex flex-col">
                        <label class="flex flex-col" for="picture">Image de couverture</label>
                        <input class="bg-white" placeholder="Ajouter une photo" accept="image/*" type="file" name="picture">
                        <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                    </div>
                </div>
                <div class="flex flex-col gap-5 p-5 h-full"> <!-- Côté écrit -->
                    <div class="flex flex-col gap-3"> <!-- Div simple -->
                        <label for="nom">Titre de la recette</label>
                        <input placeholder="Ex: Soupe à l'oignon gratinée" name="nom">
                        @error('nom')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="flex justify-start"> <!-- Div complexe du formulaire -->
                        <div class="flex flex-col gap-2 relative">
                            <label for="time">Temps de préparation</label>
                            <input type="time" name="time">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="difficutlty">Difficulté</label>
                            <select name="difficulty">
                                <option>Facile</option>
                                <option>Moyen</option>
                                <option>Difficile</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-25 w-full h-fit bg-[#CFCFCF] rounded-3xl px-6 py-8 flex flex-col items-start gap-6" > <!-- Troisième Div -->
                <h1>Ingrédients</h1>
                <div class="w-full flex flex-col gap-6 items-start" id="ingredients">
                    @php
                        $mesures = ['mg','g','','kg','l','ml','cl','dl','tsp'];
                    @endphp

                    <div id="ingredient" class="flex justify-between w-full">
                        <div class="w-50 h-15 overflow-y-auto">
                            @foreach ($ingredients as $ingredient)
                                <img class="w-40 h-10" src="{{ Storage::disk('public')->url('ingredients/'.$ingredient->picture) }}">
                                <input type="radio" value="{{ $ingredient->id_ingredient }}" > <!-- Ingrédients -->
                                <label for="ingredients">{{ $ingredient->nom }}</label>
                            @endforeach
                        </div>
                        @error('ingredients.*.id_ingredient')
                            {{ $message }}
                        @enderror
                        <input id="quantity" type="number" placeholder="Quantité de l'ingrédient"><!-- Quantity -->
                        @error('ingredients.*.quantity')
                            {{ $message }}
                        @enderror
                        <select id="select"> <!-- Mesure -->
                            @foreach ($mesures as $mesure)
                                <option value="{{ $mesure }}">{{ $mesure }}</option>
                            @endforeach
                        </select>
                        @error('ingredients.*.mesure')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <button type="button" id="more_ingr">
                    <i class="fa-solid fa-circle-plus"></i>
                     Ajouter un ingrédient
                </button>
            </div>
            <div class="mt-25 flex flex-col gap-6 w-full h-fit"> <!-- Quatrième div -->
                <h1 class="capitalize font-bold text-4xl">étapes de préparation</h1>
                <div id="steps" class="flex flex-col gap-8" w-full>
                    <div id="step" class="flex flex-col gap-4 w-full">
                        <textarea name="content[]">Décrivez les étapes de votre recette ici</textarea>
                        @error('content')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="flex justify-evenly items-center">
                    <button type="button" id="more_step" class="capitalize bg-black w-50 p-4 rounded-3xl text-white">étape suivante</button>
                    <button type="submit" class="bg-black w-50 p-4 rounded-3xl text-white">Publier la recette</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        i = 0;
        mesure = document.getElementById('select');
        y = document.getElementsByClassName('overflow-y-auto');
        ingrs = y[0].querySelectorAll('input');
        quantity = document.getElementById('quantity');
        newIngredient = [];
        newStep = [];
        steps = document.getElementById('steps');
        step = document.getElementById('step');
        addStep = document.getElementById('more_step');
        ingredient = document.getElementById('ingredient');
        ingredients = document.getElementById('ingredients');
        addIngredient = document.getElementById('more_ingr');
        newmesure = '';
        newingrs = [];
        newquantity = '';

        for (ingr of ingrs){
            ingr.setAttribute('name',`ingredients[${i}][id_ingredient]`);
        }
        quantity.setAttribute('name',`ingredients[${i}][quantity]`);
        mesure.setAttribute('name',`ingredients[${i}][mesure]`);

        addIngredient.addEventListener('click', moreIngr);
        addStep.addEventListener('click', moreStep);
        function moreIngr(){
            i++;
            newIngredient = ingredient.cloneNode(true);
            newIngredient.querySelector('select').value = "";
            newmesure = newIngredient.querySelector('select');
            newquantity = newIngredient.querySelector('input[type="number"]');
            newingrs = newIngredient.getElementsByClassName('overflow-y-auto')[0].querySelectorAll('input');
            newquantity.setAttribute('name', `ingredients[${i}][quantity]`);
            newmesure.setAttribute('name', `ingredients[${i}][mesure]`);
            for (newingr of newingrs){
            newingr.setAttribute('name',`ingredients[${i}][id_ingredient]`);
            newingr.checked = false;
            }
            newquantity.value = "";
            ingredients.appendChild(newIngredient);
        }
        function moreStep(){
            newStep = step.cloneNode(true);
            newStep.querySelector('textarea').value = "";
            steps.appendChild(newStep);
        }
    </script>

    <x-slot:footer>
        @include('layouts.footer')
    </x-slot:footer>
</x-app-layout>
