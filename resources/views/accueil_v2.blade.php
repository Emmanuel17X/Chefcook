<x-app-layout>
    <x-slot:header>
        @include('layouts.header')
    </x-slot:header>

    <div class="flex mt-60 w-full gap-1">
        <div class="w-50 basis-1/2 h-150 ml-32 flex flex-col gap-4">
            <div class="bg-[#CCC] px-4 py-2 w-fit rounded-2xl">*️⃣ COUP DE CŒUR DE LA COMMUNAUTÉ</div>
            <h1 class="text-7xl font-bold">Découvrez les meilleures recettes du Sud-Bénin</h1>
            <div class="text-wrap">L'art culinaire revisité pour les ourmets modernes.
                Apprenez à maîtriser les saveurs authentiques de Cotonou, Porto-Novo et
                autres villes du Sud-Bénin, ainsi que celles de d'autres régions.</div>
            <div class="flex justify-start gap-16">
                <div class="bg-[#CCC] rounded-3xl p-2">🕔 45-60 min</div>
                <div class="bg-[#CCC] rounded-3xl p-2">📊 Intermédiaire</div>
                <div class="bg-[#CCC] rounded-3xl p-2">🍴 12 inrédients</div>
            </div>
            <div class="flex justify-start items-end gap-16">
                <button class="bg-black text-white rounded-3xl px-4 py-3 hover:bg-blue-500 ">Explorer les recettes -></button>
                <div class="flex">
                    @for($i = 0;$i < 5; $i++)
                        <span class="size-10 rounded-full bg-[#37b012] -mx-2"></span>
                    @endfor
                </div>
            </div>
        </div>
        <div class="h-150 basis-1/2 bg-gradient-to-b from-[#FF3] to-[#F3F] mr-32">
        </div>
    </div>

    <div class="flex flex-col gap-4 p-10 bg-white w-full my-20">
        <div class="flex justify-between items-center">
            <h1 class="text-5xl text-black my-8">Catégories Populaires</h1>
            <a href="#" class="text-sm block leading-7">Voir tout ></a>
        </div>
        <div class="flex justify-between items-center gap-4">
            @for ($i=0;$i<6;$i++)
                <div>
                    <div class="bg-[#291ab0] rounded-full size-52"></div>
                    <p class="text-center my-8">Catégorie recette</p>
                </div>
            @endfor
        </div>
    </div>

    <x-slot:footer>
        @include('layouts.footer')
    </x-slot:footer>
</x-app-layout>
