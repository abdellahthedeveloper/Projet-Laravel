<body>

    @include('home.header') <!-- Inclusion de l'en-tête -->
  
    <div class="currently-market">
      <div class="container">
        <div class="row">
          @if (session()->has('message')) <!-- Vérifie si une session contient un message -->
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session()->get('message') }} <!-- Affiche le message de la session -->
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
        </div>
  
        <table class="table table-bordered custom-table">
          <thead>
            <tr>
              <th>Book Title</th> <!-- En-tête de la colonne Titre du livre -->
              <th>Auteur Name</th> <!-- En-tête de la colonne Nom de l'auteur -->
              <th>Status</th> <!-- En-tête de la colonne Statut -->
              <th>Book Image</th> <!-- En-tête de la colonne Image du livre -->
              <th>Cancel</th> <!-- En-tête de la colonne Annuler -->
            </tr>
          </thead>
          <tbody>
            @foreach($data as $data) <!-- Boucle pour parcourir les emprunts -->
            <tr>
              <td>{{ $data->book->title }}</td> <!-- Affiche le titre du livre -->
              <td>{{ $data->book->auther_name }}</td> <!-- Affiche le nom de l'auteur -->
              <td>{{ $data->status }}</td> <!-- Affiche le statut de l'emprunt -->
              <td>
                <img src="{{ asset($data->book->book_img) }}" 
                     alt="{{ $data->book->title }}" 
                     style="width: 100px; height: auto;"> <!-- Affiche l'image du livre -->
              </td>
              <td>
                @if ($data->status == 'Applied') <!-- Vérifie si le statut est 'Applied' -->
                  <a class="btn btn-warning" href="{{ url('cancel', $data->id) }}">Appuier</a> <!-- Lien pour annuler l'emprunt -->
                @else
                  <p style="font-weight:bold;">Tu ne peux pas Annuler pour le Moment.</p> <!-- Message si l'annulation n'est pas possible -->
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  
    @include('home.footer') <!-- Inclusion du pied de page -->
  
  </body>
  