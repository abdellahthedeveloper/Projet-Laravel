<div class="page-content">
    <div class="page-header">
        <div class="container-fluid">
            @if (session()->has('message')) <!-- Vérifie si une session contient un message -->
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session()->get('message') }} <!-- Affiche le message de la session -->
                </div>
            @endif

            <div class="container">
                <!-- Table des livres -->
                <h2 class="mb-4">Liste des Livres</h2> <!-- Titre de la section -->

                <!-- Tableau des livres -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Titre</th> <!-- En-tête de la colonne Titre -->
                            <th>Auteur</th> <!-- En-tête de la colonne Auteur -->
                            <th>Description</th> <!-- En-tête de la colonne Description -->
                            <th>Prix</th> <!-- En-tête de la colonne Prix -->
                            <th>Quantité</th> <!-- En-tête de la colonne Quantité -->
                            <th>Catégorie</th> <!-- En-tête de la colonne Catégorie -->
                            <th>Image Author</th> <!-- En-tête de la colonne Image de l'auteur -->
                            <th>Image Book</th> <!-- En-tête de la colonne Image du livre -->
                            <th>Delete</th> <!-- En-tête de la colonne Supprimer -->
                            <th>Update</th> <!-- En-tête de la colonne Mettre à jour -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($book as $book) <!-- Boucle pour parcourir les livres -->
                        <tr>
                            <td>{{ $book->title }}</td> <!-- Affiche le titre du livre -->
                            <td>{{ $book->auther_name }}</td> <!-- Affiche le nom de l'auteur -->
                            <td>{{ Str::limit($book->description, 50) }}</td> <!-- Affiche une partie de la description du livre -->
                            <td>{{ $book->price }} €</td> <!-- Affiche le prix du livre -->
                            <td>{{ $book->quantity }}</td> <!-- Affiche la quantité de livres disponibles -->
                            <td>{{ $book->category->cat_title }}</td> <!-- Affiche le titre de la catégorie -->
                            <td><img src="{{ asset($book->auther_img) }}" alt="{{ $book->auther_name }}" style="width: 100px; height: auto;"></td> <!-- Affiche l'image de l'auteur -->
                            <td><img src="{{ asset($book->book_img) }}" alt="{{ $book->title }}" style="width: 100px; height: auto;"></td> <!-- Affiche l'image du livre -->
                            <td><a onclick="confirmation(event)" href="{{ url('book_delete', $book->id) }}" class="btn btn-danger">Delete</a></td> <!-- Lien pour supprimer le livre avec confirmation -->
                            <td><a href="{{ url('edit_book', $book->id) }}" class="btn btn-info">Update</a></td> <!-- Lien pour mettre à jour le livre -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
