<div class="currently-market">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="section-heading">
            <div class="line-dec"></div>
            <h2><em>Book</em> Currently In The Market.</h2> <!-- Titre de la section -->
          </div>
        </div>
        
        @if (session()->has('message')) <!-- Vérifie si une session contient un message -->
        <div class="alert alert-succes" style="background-color: rgb(159, 220, 228)">
          <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true"><strong>X </strong></button>
          {{ session()->get('message') }} <!-- Affiche le message de la session -->
        </div>
        @endif
        
        <div class="col-lg-6">
          <!-- Espace pour ajouter du contenu si nécessaire -->
        </div>

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
                    {{-- <a href="{{url('book_details',$book->id)}}">View Book Details</a> --}} <!-- Lien pour voir les détails du livre (commenté) -->
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
