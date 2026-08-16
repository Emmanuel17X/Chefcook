<div class="flex items-center justify-between gap-10">
    <img src="{{ Storage::disk('public')->url('logo_chefcook.png') }}" class="ml-16 size-16 rounded-full">
    <h1 class="text-bold text-3xl">ChefCook</h1>
    @auth
        <a class="text-xl hover:underline block" href="{{ route('accueil') }}">Accueil</a>
        <a class="text-xl hover:underline block" href="#">Administration</a>
        <a class="text-xl hover:underline block" href="#">Recettes</a>
        <a class="text-xl hover:underline block" href="{{ route('profil') }}">Profil</a>
        <form method="post" action="{{ route('logout') }}">
            @csrf
            <button class="rounded-3xl bg-red-600 p-3" type="submit">Se déconnecter</button>
        </form>
    @endauth
</div>
@guest
    <div class="flex items-center justify-between gap-10 mx-20">
        <a href="{{ route('connexion') }}">Se connecter</a>
        <a href="{{ route('inscription') }}">S'inscrire</a>
    </div>
@endguest
@auth
<div class="flex items-center justify-between gap-10 mx-20">
    <div class="h-8 w-60 rounded-2xl bg-slate-400">🔍 Rechercher une recette...</div>
    <a href="#" class="">🔔</a>
    <span class="size-14 rounded-full bg-[crimson]"></span>
</div>
@endauth

