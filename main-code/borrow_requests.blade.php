<div class="page-content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="container">
                <!-- Table des livres -->
                <h2 class="mb-4">Liste des Livres</h2> <!-- Titre de la section -->

                <!-- Tableau des livres -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>User Name</th> <!-- En-tête de la colonne Nom de l'utilisateur -->
                            <th>Email</th> <!-- En-tête de la colonne Email -->
                            <th>Phone</th> <!-- En-tête de la colonne Téléphone -->
                            <th>Book Title</th> <!-- En-tête de la colonne Titre du livre -->
                            <th>Catégorie</th> <!-- En-tête de la colonne Catégorie -->
                            <th>Quantité</th> <!-- En-tête de la colonne Quantité -->
                            <th>Status de Book</th> <!-- En-tête de la colonne Statut du livre -->
                            <th>Image Book</th> <!-- En-tête de la colonne Image du livre -->
                            <th>Changer Status</th> <!-- En-tête de la colonne Changer le statut -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $data) <!-- Boucle pour parcourir les demandes d'emprunt -->
                        <tr>
                            <td>{{ $data->user->name }}</td> <!-- Affiche le nom de l'utilisateur -->
                            <td>{{ $data->user->email }}</td> <!-- Affiche l'email de l'utilisateur -->
                            <td>{{ $data->user->phone }}</td> <!-- Affiche le téléphone de l'utilisateur -->
                            <td>{{ $data->book->title }}</td> <!-- Affiche le titre du livre -->
                            <td>{{ $data->book->category->cat_title }}</td> <!-- Affiche le titre de la catégorie -->
                            <td>{{ $data->book->quantity }}</td> <!-- Affiche la quantité de livres disponibles -->
                            <td>{{ $data->status }}</td> <!-- Affiche le statut du livre -->
                            <td><img src="{{ asset($data->book->book_img) }}" alt="{{ $data->book->title }}" style="width: 100px; height: auto;"></td> <!-- Affiche l'image du livre -->
                            <td>
                                <a class="btn btn-warning" href="{{ url('accepter', $data->id) }}">Accepter</a> <!-- Lien pour accepter la demande d'emprunt -->
                                <a class="btn btn-danger" href="{{ url('rejeter', $data->id) }}">Rejeter</a> <!-- Lien pour rejeter la demande d'emprunt -->
                                <a class="btn btn-info" href="{{ url('retourner', $data->id) }}">Retourner</a> <!-- Lien pour retourner le livre -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
