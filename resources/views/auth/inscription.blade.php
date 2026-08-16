<x-app-layout>
    <div class="w-full h-screen flex justify-between items-center px-8 gap-16 m-0">
        <div class="my-0 basis-1/2 h-full p-4 bg-cover bg-center flex flex-col items-center justify-end"
        style="background-image: url('{{ Storage::disk('public')->url('gaufre.jpg') }}')">
            <div class="mb-20 ml-15 mr-30">
                <h1 class="text-3xl text-bold">Découvrez l'art culinaire du Bénin</h1>
                <h3 class="nowrap">Rejoignez notre communauté de passionnés de cuisine et accédez
                    à des milliers de recettes exclusives </h3>
            </div>
        </div>
        <div class="basis-1/2 h-full grid content-evenly items-center">
            <div>
                <h1 class="text-5xl text-bold leading-20">Créer un compte</h1>
                <h3>Rejoignez nous pour commencer votre voyage gastronomique</h3>
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="grid grid-rows content-center items-center leading-12">
                    <label for="nom">Nom d'utilisateur</label>
                    <input class="rounded-2xl hover:ring-blue-500 hover:ring-2 w-2/3" id="nom" type="text" name="nom" placeholder="👤 Benoit DUPAIN" required autofocus>
                    @error('nom')
                        {{ $message }}
                    @enderror
                </div>
                <div class="grid grid-rows content-center items-center leading-12">
                    <label for="email">Adresse email</label>
                    <input class="rounded-2xl hover:ring-blue-500 hover:ring-2 w-2/3" id="email" type="email" placeholder="✉️ benoit213@gmail.com" name="email" required>
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>
                <div class="grid grid-rows content-center items-center leading-12">
                    <label for="password">Mot de passe</label>
                    <div class="flex justify-start">
                        <input class="rounded-2xl hover:ring-blue-500 hover:ring-2 w-2/3 fa-" id="password" type="password" placeholder="🔒 *******" name="password" required>
                        <button type="button" class="-ml-15">
                            <i id="on" class="fa-solid fa-eye"></i>
                            <i id="off" class="fa-solid fa-eye-slash"></i>
                        </button>
                    </div>
                    @error('password')
                        {{ $message }}
                    @enderror
                </div>
                <div class="leading-12">
                    <input class="rounded-full" type="checkbox" id="conditions" required>
                    <label class="nowrap" for="conditions">J'accepte les <a href="#">conditions d'utilisation</a> et la <a href="#">politique de confidentialité</a></label>
                </div>
                <button type="submit" class="bg-black rounded-3xl px-8 py-4 w-2/3 text-white" type="submit">S'inscrire -></button>
            </form>
            <div class="text-xl ml-10"> Vous avez déjà un compte ? <a class="font-bold" href="{{ route('connexion') }}">Se connecter</a></div>
        </div>
    </div>
    <script>
        eye = document.getElementById('on');
        eye_slash = document.getElementById('off');
        password = document.getElementById('password');
        btn = document.getElementsByClassName('-ml-15');
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
