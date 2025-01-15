<body>

    @include('home.header') <!-- Inclusion de l'en-tête -->
   
    <div class="currently-market">
      <div class="container">
        <div class="row">
          @if (session()->has('message')) <!-- Vérifie si une session contient un message -->
            <div class="alert alert-succes" style="background-color: rgb(159, 220, 228)">
              <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true"><strong>X </strong></button>
              {{ session()->get('message') }} <!-- Affiche le message de la session -->
            </div>
          @endif   
          
          <div class="col-md-6" style="margin-top: 100px">
            <div class="filters">
              <ul>
                <li data-filter="*" class="active"><a style="color: white" href="{{ url('explorer') }}">All Books</a></li> <!-- Filtre pour tous les livres -->
                @foreach ($category as $category)
                <li>
                  <a style="color: white" href="{{ url('cat_rechercher', $category->id) }}">{{ $category->cat_title }}</a> <!-- Filtre pour chaque catégorie -->
                </li>
                @endforeach
              </ul>
            </div>
          </div>
  
          <form action="{{ url('rechercher') }}" method="get">
              @csrf <!-- Protection CSRF -->
              <div class="row" style="margin: 30px">
                  <div class="col-md-6"> 
                      <input class="form-control" type="search" name="rechercher" placeholder="Rechercher Votre Book, Author préféré"> <!-- Champ de recherche -->
                  </div>
                  <div class="col-md-2"> 
                      <input class="btn btn-primary" type="submit" value="Recherche"> <!-- Bouton de soumission de la recherche -->
                  </div>
              </div>
          </form>
  
          <div class="col-lg-12">
            <div class="row grid">
              @foreach ($data as $book) <!-- Boucle pour parcourir les livres -->
              <div class="col-lg-6 currently-market-item all msc">
                <div class="item">
                  <div class="left-image">
                    <img src="{{ asset($book->book_img) }}" alt="" style="border-radius: 20px; min-width: 195px;"> <!-- Affiche l'image du livre -->
                    <span>
                      <h4 style="margin-top: 30px">Description</h4> <!-- Titre de la description -->
                      <p>{{ $book->description }}</p> <!-- Affiche la description du livre -->
                    </span>
                  </div>
                  <div class="right-content">
                    <h4>{{ $book->title }}</h4> <!-- Affiche le titre du livre -->
                    <span class="author">
                      <img src="{{ asset($book->auther_img) }}" alt="" style="max-width: 50px; border-radius: 50%;"> <!-- Affiche l'image de l'auteur -->
                      <h6>{{ $book->auther_name }}</h6> <!-- Affiche le nom de l'auteur -->
                    </span>
                    <div class="line-dec"></div>
                    <span class="bid">
                      Current Available<br><strong>{{ $book->quantity }}</strong><br> <!-- Affiche la quantité de livres disponibles -->
                    </span>
                    <div class="text-button">
                      <!-- Espace pour ajouter un bouton si nécessaire -->
                    </div>
                    </br>
                    <div class="">
                      <a class="btn btn-primary" href="{{ url('borrow_books', $book->id) }}">Borrow</a> <!-- Lien pour emprunter le livre -->
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  
    @include('home.footer') <!-- Inclusion du pied de page -->
  
  </body>
  