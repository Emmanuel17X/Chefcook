<x-app-layout>
    <x-slot:header>
        @include('layouts.header')
    </x-slot:header>


    <div class="bg-cover bg-center flex relative top-0 left-0 w-full h-150 justify-start items-end px-40 py-10"
    style="background-image: url('{{ Storage::disk('public')->url($recette->picture) }}')">
        <div class="flex flex-col gap-6 w-2/3">
            <p>Tag</p>
            <div class="text-5xl">{{ $recette->nom }}</div>
            <div class="flex justify-start gap-8">
                <p>Par {{ $recette->user->username }}</p>
                <p>Temps : {{ $recette->time }}</p>
                <p>Difficulté : {{ $recette->difficulty }}</p>
                <p>
                    @php
                        $fullstar = floor($recette->note);
                        $remains = ($recette->note - $fullstar);
                        $halfstar = 0;
                        if ($remains >= 0.5){
                            $halfstar = 1;
                        }
                        $voidstar = 5 - $fullstar - $halfstar;
                    @endphp
                    @for ($i=0; $i < $fullstar; $i++)
                        <i class="fa-solid fa-star text-yellow-400"></i>
                    @endfor
                    @for ($j=0; $j < $halfstar; $j++)
                        <i class="fa-solid fa-star-half-stroke text-yellow-400"></i>
                    @endfor
                    @for ($k=0; $k < $voidstar; $k++)
                        <i class="fa-solid fa-star"></i>
                    @endfor
                </p>
            </div>
        </div>
    </div>
    @php
        $ingredients = $recette->ingredients;
        $steps = $recette->cookingsteps;
        $i = 0;
        $comments = $recette->comments;
    @endphp
    <div class="flex flex-col gap-8 mx-40 items-center">
        <div class="text-2xl w-1/2"><!-- Deuxième Div -->
            Description
        </div>
        <div class="flex flex-col gap-5 w-1/2"><!-- Troisième Div -->
            <h1 class="text-2xl">Ingrédients</h1>
            <p class="text-xl">Pour <span id="people">1</span> personne</p>
            <div class="flex justify-evenly w-50">
                <button class="rounded-full size-8 border-2" id="more" type="button">+</button>
                <p id="quantite" class="nums">X</p>
                <button class="rounded-full size-8 border-2" id="less" type="button">-</button>
            </div>
            <hr>
            @foreach ($ingredients as $ingredient)
                <div class="flex flex-col gap-6">
                    <div class="flex justify-between">
                        <p>{{ $ingredient->nom }}</p>
                        <p class="stock" data-q="{{ $ingredient->pivot->quantity }}" data-m="{{ $ingredient->pivot->mesure }}">
                            {{ $ingredient->pivot->quantity }} &nbsp; {{ $ingredient->pivot->mesure }}
                        </p>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="flex flex-col gap-8 w-1/2 items-center"><!-- Etapes de préparation -->
            <h1>Préparation</h1>
            @foreach ($steps as $step)
                <div class="rounded-4xl w-fit min-h-25 h-fit p-7 bg-amber-50 flex flex-col items-center">
                    <div class="rounded-full size-6 bg-black text-[#EEE] text-center">{{ $i }}</div>
                    <p>{{ $step->content }}</p>
                </div>
                @php
                    $i++;
                @endphp
            @endforeach
        </div>
        <div class="bg-black p-15 rounded-3xl w-60"><!-- Note -->
            <form method="post" action="/recette/{{ $recette->id_recette }}/note">
                @csrf
                <button id="btn_1" type="submit" class="stars" value="1">
                    <i class="fa-regular fa-star text-gray-300 rating"></i>
                </button>
                <button id="btn_2" type="submit" class="stars" value="2">
                    <i class="fa-regular fa-star text-gray-300 rating"></i>
                </button>
                <button id="btn_3" type="submit" class="stars" value="3">
                    <i class="fa-regular fa-star text-gray-300 rating"></i>
                </button>
                <button id="btn_4" type="submit" class="stars" value="4">
                    <i class="fa-regular fa-star text-gray-300 rating"></i>
                </button>
                <button id="btn_5" type="submit" class="stars" value="5">
                    <i class="fa-regular fa-star text-gray-300 rating"></i>
                </button>
                <input type="hidden" name="value" id="note"
                value="{{ $recette->notes_recettes->firstWhere('id_user', auth()->id())?->value }}">
            </form>
        </div>
        <div class="bg-white w-full p-10 flex flex-col gap-8 items-center"><!-- Espace Commentaire -->
            <div class="w-1/2 flex flex-col items-center">
                <h1 class="text-2xl">
                    <i class="fa-solid fa-comments"></i>
                    Commentaires ({{ $comments->count() }})
                </h1>
                <div class="flex flex-col gap-8 p-6 w-full ">
                    @foreach ($comments as $comment)
                        <div class="max-w-100 min-w-40 min-h-25 h-fit w-auto rounded-3xl border flex flex-col gap-6 py-8 px-4">
                            <div class="flex justify-between h-fit">
                                <h1 class="text-xl">{{ $comment->user->username }}</h1>
                                @php
                                    $note_u = $comment->user->notes_recettes->firstWhere('id_recette', $comment->recette->id_recette)?->value;
                                @endphp
                                <p>
                                    @php
                                        $fullstar2 = floor($note_u);
                                        $remains2 = ($note_u - $fullstar);
                                        $halfstar2 = 0;
                                        if ($remains2 >= 0.5){
                                            $halfstar = 1;
                                        }
                                        $voidstar2 = 5 - $fullstar2 - $halfstar2;
                                    @endphp
                                    @for ($i=0; $i < $fullstar2; $i++)
                                        <i class="fa-solid fa-star text-yellow-400"></i>
                                    @endfor
                                    @for ($j=0; $j < $halfstar2; $j++)
                                        <i class="fa-solid fa-star-half-stroke text-yellow-400"></i>
                                    @endfor
                                    @for ($k=0; $k < $voidstar2; $k++)
                                        <i class="fa-solid fa-star"></i>
                                    @endfor
                                </p>
                            </div>
                            <div class="h-fit">{{ $comment->content }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
            <form class="flex flex-col gap-8 items-end w-1/2" method="POST"
            action="/recette/{{ $recette->id_recette }}/comment">
                @csrf
                <input class="rounded-3xl bg-gray-300 w-full h-25" type="text" name="content">
                <input type="hidden" value="{{ $recette->id_recette }}" name="id_recette">
                @error('content')
                    {{ $message }}
                @enderror
                <button class="w-fit rounded-3xl bg-black text-[#EEE] py-2 px-4" type="submit">Publier</button>
            </form>
        </div>
    </div>

    <script>
        more = document.getElementById('more');
        less = document.getElementById('less');
        people = document.getElementById('people');
        quantite = document.getElementById('quantite');
        stock = document.getElementsByClassName('stock');
        i = document.getElementsByClassName('rating');
        note = document.getElementById('note');
        btn_1 = document.getElementById('btn_1');
        btn_2 = document.getElementById('btn_2');
        btn_3 = document.getElementById('btn_3');
        btn_4 = document.getElementById('btn_4');
        btn_5 = document.getElementById('btn_5');
        btn_1.addEventListener('click', starsystem);
        btn_2.addEventListener('click', starsystem);
        btn_3.addEventListener('click', starsystem);
        btn_4.addEventListener('click', starsystem);
        btn_5.addEventListener('click', starsystem);
        z = 1;
        stock1 = [];
        c_stock = [];
        m = [];
        for (s of stock){
            stock1.push(parseFloat(s.dataset.q));
            c_stock.push(parseFloat(s.dataset.q));
            m.push(s.dataset.m);
        }


        quantite.innerHTML = z;
        more.addEventListener('click', moreq);
        less.addEventListener('click', lessq);
        function moreq(){
            z = z+1;
            quantite.innerHTML = z;
            people.innerHTML = z;
            for (s=0; s < stock.length; s++){
                c_stock[s] += stock1[s];
                stock[s].textContent = c_stock[s] + ' ' + m[s];
            }

        }

        function lessq(){
            if (z > 1){
                z = z-1;
                quantite.innerHTML = z;
                people.innerHTML = z;
                for (s=0; s < stock.length; s++){
                    c_stock[s] -= stock1[s];
                    stock[s].textContent = c_stock[s] + ' ' + m[s];
                }
            }
        }

        function defaultStars(x){
            for(j = 0; j < x; j++){
                    i[j].classList.add('text-yellow-400');
                    i[j].classList.remove('text-gray-300');
            }
            for(k = 4; k >= x; k--){
                    i[k].classList.add('text-gray-300');
                    i[k].classList.remove('text-yellow-400');
            }
        }

        defaultStars(note.value);

        function starsystem(event){
            event.preventDefault();
            note.value = this.value;
            x = this.value;
            for(j = 0; j < x; j++){
                    i[j].classList.add('text-yellow-400');
                    i[j].classList.remove('text-gray-300');
            }
            for(k = 4; k >= x; k--){
                    i[k].classList.add('text-gray-300');
                    i[k].classList.remove('text-yellow-400');
            }
            this.form.submit();
        }

    </script>

    <x-slot:footer>
        @include('layouts.footer')
    </x-slot:footer>
</x-app-layout>
