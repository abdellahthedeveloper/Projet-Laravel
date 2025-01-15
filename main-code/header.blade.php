<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{ url('home') }}" class="logo">
                        <img src="assets/images/logo.png" alt=""> <!-- Logo du site -->
                    </a>
                    <!-- ***** Logo End ***** -->

                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="{{ url('home') }}">Home</a></li> <!-- Lien vers la page d'accueil -->
                        <li><a href="{{ url('explorer') }}">Explore</a></li> <!-- Lien vers la page d'exploration -->

                        @if (Route::has('login')) <!-- Vérifie si les routes de login sont définies -->
                            <nav class="-mx-3 flex flex-1 justify-end">
                                @auth <!-- Vérifie si l'utilisateur est authentifié -->
                                    <li><a class="active" href="{{ url('book_history') }}">My History</a></li> <!-- Lien vers l'historique des emprunts -->

                                    <x-app-layout>
                                    </x-app-layout>
                                
                                @else
                                    <li><a href="{{ route('login') }}">Login</a></li> <!-- Lien vers la page de login -->

                                    @if (Route::has('register')) <!-- Vérifie si la route de registration est définie -->
                                        <li><a href="{{ route('register') }}">Register</a></li> <!-- Lien vers la page de registration -->
                                    @endif
                                @endauth
                            </nav>
                        @endif
                    </ul>   

                    <a class="menu-trigger">
                        <span>Menu</span> <!-- Menu déclencheur pour les appareils mobiles -->
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>
