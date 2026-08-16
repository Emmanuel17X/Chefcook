<x-app-layout>
    <div class="flex rounded-3xl my-5 mx-18 justify-start items-center w-auto h-182 border shadow-3xl">
        <div class="my-0 w-1/2 h-full pb-24 pl-19 pr-34 bg-cover bg-center flex flex-col items-center justify-end rounded-l-3xl border-none"
        style="background-image: url('{{ Storage::disk('public')->url('quiche.jpg') }}')"> <!-- Image d'illustration du formulaire -->
            <div>
                <h1 class="text-3xl text-bold">Découvrez l'art culinaire du Bénin</h1>
                <h3 class="nowrap">Rejoignez notre communauté de passionnés de cuisine et accédez
                    à des milliers de recettes exclusives </h3>
            </div>
        </div>
        <div class="flex flex-col items-start justify-center w-1/2 h-full px-19 py-8 rounded-r-3xl border-none my-0 mx-0"> <!-- Propos et formulaire -->
            <div class="p-10">
                <h1 class="text-5xl text-bold leading-20">Ravis de vous revoir</h1>
                <h3>Veuillez entrer vos identfiants pour vous connecter</h3>
            </div>
            <form class="flex flex-col items-start justify-center gap-5 w-full h-full p-10" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="flex flex-col gap-4 w-full">
                    <label for="email">Adresse email</label>
                    <input class="w-full hover:ring-blue-500 hover:ring-2 rounded-2xl" type="email" name="email" placeholder="✉️ chef@cook.com">
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>
                <div class="w-full flex flex-col gap-10 items-start justify-center leading-12">
                    <label class="relative w-full block" for="password">
                        <p class="absolute left-1">Mot de passe</p>
                        <a class="block absolute right-5" href="#">Mot de passe oublié ?</a>
                    </label>
                    <div class="relative w-full">
                        <input class="rounded-2xl w-full hover:ring-blue-500 hover:ring-2" id="password" type="password" placeholder="🔒 *******" name="password" required>
                        <button type="button" class="absolute right-4 top-4">
                            <i id="on" class="fa-solid fa-eye"></i>
                            <i id="off" class="fa-solid fa-eye-slash"></i>
                        </button>
                    </div>
                    @error('password')
                        {{ $message }}
                    @enderror
                </div>
                <input class="w-full px-8 rounded-3xl text-[#EEE] py-4 bg-black " type="submit" value="Se connecter">
            </form>
            <div class="text-xl ml-10"> Vous n'avez pas de compte ? <a class="font-bold" href="{{ route('inscription') }}">Inscrivez vous gratuitement</a></div>
        </div>
    </div>
    <script>
        eye = document.getElementById('on');
        eye_slash = document.getElementById('off');
        password = document.getElementById('password');
        btn = document.getElementsByClassName('top-4');
        btn[0].addEventListener('click', visibility);
        function visibility(){
            if (password.type === "password"){
                password.type = 'text';
                eye_slash.style.display = 'block';
                eye.style.display = 'none';
            }
            else{
                password.type = 'password';
                eye_slash.style.display = 'none';
                eye.style.display = 'block';
            }
        }
    </script>
</x-app-layout>
