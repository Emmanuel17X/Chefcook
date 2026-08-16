<x-app-layout>
    <x-slot:header>
        @include('layouts.header')
    </x-slot:header>

    <div class="bg-[crimson] relative flex justify-center top-0 left-0 w-full h-125">
        <div class="flex justify-between w-1/2 h-fit absolute -bottom-12 bg-[#EEE] shadow-gray-700
         shadow-lg rounded-3xl px-10 py-8">
            <div class="size-32 rounded-full bg-linear-to-tl from-sky-300 to-fuchsia-300 border-4
             border-white shadow-3xl"></div>
            <div class="flex flex-col gap-3">
                <h1 class="text-4xl font-bold">{{ Auth::user()->username }}</h1>
                <h3 class="text-wrap">Bio utilisateur</h3>
                <div class="flex">
                    @for ($i=0; $i<5; $i++)
                        <i class="fa-solid fa-star"></i>
                    @endfor
                    <p>X(Y avis)</p>
                </div>
            </div>
            <div>
                <button class="w-30 bg-black text-[#EEE] p-4 rounded-4xl">Modifier le profil</button>
            </div>
        </div>
    </div>

    <div class="flex flex-col gap-5 mt-25 w-auto mx-35">
        <div class="flex justify-between">
            <h1 class="text-4xl font-bold">Recettes publiées</h1>
            <p class="bg-[#BBB] text-gray-700 p-2 rounded-2xl">{{ $recettes->count() }} recettes</p>
        </div>
        <div class="flex justify-start gap-8 flex-wrap"> <!-- Contenant des div -->
            @foreach($recettes as $recette)
                <div class="flex w-96 h-115 border flex-col rounded-3xl"> <!-- Recette -->
                    <div class=" h-9/20 w-full p-5 border rounded-t-2xl bg-cover bg-center"
                    style="background-image: url('{{ Storage::disk('public')->url($recette->picture) }}')"> <!-- Image Recette -->
                        <p class="p-2 rounded-2xl bg-lime-100 w-fit">Tag</p>
                    </div>
                    <div class="h-11/20 w-full px-5 py-2 flex flex-col gap-3 justify-evenly"> <!-- Infos Recette -->
                        <h1 class="text-3xl font-bold">{{ $recette->nom }}</h1>
                        <h3>
                            Description
                        </h3>
                        <div class="flex justify-start gap-2 w-full test-sm">
                            <div class="flex text-sm">
                                <i class="fa-regular fa-clock"></i>
                                <p>{{ $recette->time }}</p>
                            </div>
                            <div class="flex text-sm">
                                <i class="fa-solid fa-utensils"></i>
                                <p>{{ $recette->difficulty }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="flex justify-evenly items-center mt-20">
        <button class="border rounded-2xl px-4 py-2">Voir toutes les recettes</button>
        <a class="border rounded-2xl px-4 py-2" href="{{ route('recipe') }}">Créer une recette</a>
    </div>

    <x-slot:footer>
        @include('layouts.footer')
    </x-slot:footer>
</x-app-layout>
