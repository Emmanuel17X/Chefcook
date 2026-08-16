<x-app-layout>
    <x-slot:header>
        @include('layouts.header')
    </x-slot:header>

    @if ($recettes->count() >= 3)
        <div class="h-150 w-full flex justify-center gap-8 p-8 mt-25">
            @php
                $recipes = $recettes->sortBy('nom')->take(3)->values();
            @endphp
            <a href="/recette/{{ $recipes[0]->id_recette }}" class="h-full w-1/2 rounded-3xl bg-cover bg-center flex flex-col gap-4 justify-end align-start p-8"
            style="background-image: url('{{ Storage::disk('public')->url($recipes[0]->picture) }}')">
                <div class="flex justify-start gap-3">
                    <div class=" bg-green-200 h-fit w-fit rounded-2xl py-2 px-4">Tag</div>
                    <div class=" bg-[#EEE] h-fit w-fit rounded-2xl py-2 px-4">Tag</div>
                </div>
                <h1 class="text-5xl font-bold text-[#EEE]">{{ $recipes[0]->nom }}</h1>
                <div class="flex justify-start gap-4">
                    <p>🕔 {{ $recipes[0]->time }}</p>
                    <p>🍽️ {{ $recipes[0]->difficulty }}</p>
                    <p class="text-lg">
                        @php
                            $fullstar = floor($recipes[0]->note);
                            $remains = ($recipes[0]->note - $fullstar);
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
                        ({{ $recipes[0]->note }})
                    </p>
                </div>
            </a>
            <div class="flex flex-col h-full w-1/3 gap-8 pr-8">
                <a href="/recette/{{ $recipes[1]->id_recette }}" class="h-1/2 w-full bg-cover bg-center rounded-3xl flex flex-col gap-4 p-7.5 items-start justify-end"
                style="background-image: url('{{ Storage::disk('public')->url($recipes[1]->picture) }}')">
                    <div class=" bg-[#EEE] h-fit w-fit rounded-2xl py-2 px-4">Tag</div>
                    <div class="text-4xl text-[#EEE] font-bold">{{ $recipes[1]->nom }}</div>
                </a>
                <a href="/recette/{{ $recipes[2]->id_recette }}" class="h-1/2 w-full bg-cover bg-center rounded-3xl flex flex-col gap-4 p-7.5 items-start justify-end"
                style="background-image: url('{{ Storage::disk('public')->url($recipes[2]->picture) }}')">
                    <div class=" bg-[#EEE] h-fit rounded-2xl w-fit py-2 px-4">Tag</div>
                    <div class="text-4xl text-[#EEE] font-bold">{{ $recipes[2]->nom }}</div>
                </a>
            </div>
        </div>

        <div class="flex flex-col gap-8 px-33 mt-20 w-full h-fit">
            @php
                $rcps = $recettes->sortByDesc('created_at')->take(4);
            @endphp
            <div class="flex justify-between items-center w-full h-fit pr-10">
                <h1 class="font-bold text-5xl">Dernière Recettes</h1>
                <button class="text-lg block" id="sight">Voir tout -></button>
            </div>
            <div class="flex justify-start items-center gap-8 pt-4 w-full h-full flex-wrap"><!-- Contenant -->
                @foreach ($rcps as $rcp)
                    <div class="w-70 vitrine h-112 bg-[#BBB] flex flex-col"> <!-- Recette -->
                        <div class="flex w-full h-9/20 bg-cover p-6 justify-between"
                        style="background-image: url('{{ Storage::disk('public')->url($rcp->picture) }}')"><!-- Image Recette -->
                            <div class=" bg-green-200 h-fit rounded-2xl p-2">Tag</div>
                            <div class="bg-[#EEE] p-2 rounded-2xl h-fit" >
                                <i class="fa-regular fa-heart"></i>
                            </div>
                        </div>
                        <div class="w-full flex flex-col gap-5 bg-transparent h-11/20 p-4"><!-- Infos Recette -->
                            <h2 class="text-2xl">{{ $rcp->nom }}</h2>
                            <p>Par {{ $rcp->user->username }}</p>
                            <div class="flex justify-between items-center">
                                <div class="flex flex-col gap-1">
                                    <p>🕔 {{ $rcp->time }}</p>
                                    <p>🍽️ {{ $rcp->difficulty }}</p>
                                </div>
                                <div class="bg-yellow-200 p-2 rounded-2xl">
                                    ⭐ {{ $rcp->note }}
                                </div>
                            </div>
                            <a href="/recette/{{ $rcp->id_recette }}" class="w-full py-2 px-4 rounded-2xl bg-black text-[#EEE]">Voir la recette</a>
                        </div>
                    </div>
                @endforeach
                @foreach ($recettes as $recette)
                    <div class="w-70 h-112 total bg-[#BBB] hidden flex-col"> <!-- Recette -->
                        <div class="flex w-full h-9/20 bg-cover p-6 justify-between"
                        style="background-image: url('{{ Storage::disk('public')->url($recette->picture) }}')"><!-- Image Recette -->
                            <div class=" bg-green-200 h-fit rounded-2xl p-2">Tag</div>
                            <div class="bg-[#EEE] p-2 rounded-2xl h-fit" >
                                <i class="fa-regular fa-heart"></i>
                            </div>
                        </div>
                        <div class="w-full flex flex-col gap-5 bg-transparent h-11/20 p-4"><!-- Infos Recette -->
                            <h2 class="text-2xl">{{ $recette->nom }}</h2>
                            <p>Par {{ $recette->user->username }}</p>
                            <div class="flex justify-between items-center">
                                <div class="flex flex-col gap-1">
                                    <p>🕔 {{ $recette->time }}</p>
                                    <p>🍽️ {{ $recette->difficulty }}</p>
                                </div>
                                <div class="bg-yellow-200 p-2 rounded-2xl">
                                    ⭐ {{ $rcp->note }}
                                </div>
                            </div>
                            <a href="/recette/{{ $recette->id_recette }}" class="w-full py-2 px-4 rounded-2xl bg-black text-[#EEE]">Voir la recette</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="h-150 w-full flex justify-center gap-8 p-8 mt-25">
            <div class="h-full w-1/2 rounded-3xl bg-green-600 flex flex-col gap-4 justify-end align-start p-8">
                <div class="flex justify-start gap-3">
                    <div class=" bg-green-200 h-fit w-fit rounded-2xl py-2 px-4">Tag</div>
                    <div class=" bg-[#EEE] h-fit w-fit rounded-2xl py-2 px-4">Tag</div>
                </div>
                <h1 class="text-5xl font-bold text-[#EEE]">Nom Recette</h1>
                <div class="flex justify-start gap-4">
                    <p>🕔 Temps</p>
                    <p>🍽️ Difficulté</p>
                    <p class="text-lg">
                        @for ($i=0; $i < 5; $i++)
                            <i class="fa-solid fa-star"></i>
                        @endfor
                    </p>
                </div>
            </div>
            <div class="flex flex-col h-full w-1/3 gap-8 pr-8">
                <div class="h-1/2 w-full bg-yellow-300 rounded-3xl flex flex-col gap-4 p-7.5 items-start justify-end">
                    <div class=" bg-[#EEE] h-fit w-fit rounded-2xl py-2 px-4">Tag</div>
                    <div class="text-4xl text-[#EEE] font-bold">Nom Recette</div>
                </div>
                <div class="h-1/2 w-full bg-red-600 rounded-3xl flex flex-col gap-4 p-7.5 items-start justify-end">
                    <div class=" bg-[#EEE] h-fit rounded-2xl w-fit py-2 px-4">Tag</div>
                    <div class="text-4xl text-[#EEE] font-bold">Nom Recette</div>
                </div>
            </div>
        </div>
    @endif

    <script>
        sight = document.getElementById('sight');
        vitrines = document.getElementsByClassName('vitrine');
        totaux = document.getElementsByClassName('total');
        sight.addEventListener('click', moreSight);
        function moreSight(){
            for (vitrine of vitrines){
                vitrine.classList.toggle('hidden');
            }
            for (total of totaux){
                total.classList.toggle('hidden');
            }
        }
    </script>

    <x-slot:footer>
        @include('layouts.footer')
    </x-slot:footer>
</x-app-layout>
