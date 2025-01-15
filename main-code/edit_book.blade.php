<div>
    <h1 class="titre">Update Book</h1> <!-- Titre de la section de mise à jour du livre -->

    <form action="{{ url('update_book', $book->id) }}" method="POST" enctype="multipart/form-data">
        <!-- CSRF Token (sécurité) -->
        @csrf

        <div class="form-group">
            <label for="title">Titre du Livre</label> <!-- Étiquette du champ de titre du livre -->
            <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}" required> <!-- Champ de saisie pour le titre du livre -->
        </div>

        <div class="form-group">
            <label for="auther_name">Nom de l'Auteur</label> <!-- Étiquette du champ de nom de l'auteur -->
            <input type="text" class="form-control" id="auther_name" name="auther_name" value="{{ $book->auther_name }}" required> <!-- Champ de saisie pour le nom de l'auteur -->
        </div>

        <div class="form-group">
            <label for="price">Prix</label> <!-- Étiquette du champ de prix -->
            <input type="number" class="form-control" id="price" name="price" value="{{ $book->price }}" required> <!-- Champ de saisie pour le prix -->
        </div>

        <div class="form-group">
            <label for="quantity">Quantité</label> <!-- Étiquette du champ de quantité -->
            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $book->quantity }}" required> <!-- Champ de saisie pour la quantité -->
        </div>

        <div class="form-group">
            <label for="description">Description</label> <!-- Étiquette du champ de description -->
            <textarea class="form-control" id="description" name="description" rows="3">{{ $book->description }}</textarea> <!-- Champ de saisie pour la description -->
        </div>

        <div class="form-group">
            <label for="category_id">Catégorie</label> <!-- Étiquette de la liste déroulante des catégories -->
            <select class="form-control" id="category_id" name="category_id" required> <!-- Liste déroulante des catégories -->
                @foreach($category as $category) <!-- Boucle pour parcourir les catégories -->
                    <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->cat_title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="book_img">Image du Livre (optionnel)</label> <!-- Étiquette du champ de téléchargement de l'image du livre -->
            <input type="file" class="form-control-file" id="book_img" name="book_img"> <!-- Champ de téléchargement pour l'image du livre -->
            @if($book->book_img)
                <p>Image actuelle : <img src="{{ asset($book->book_img) }}" alt="{{ $book->title }}" style="width: 100px; height: auto;"></p> <!-- Affiche l'image actuelle du livre -->
            @endif
        </div>

        <div class="form-group">
            <label for="auther_img">Image de l'Auteur (optionnel)</label> <!-- Étiquette du champ de téléchargement de l'image de l'auteur -->
            <input type="file" class="form-control-file" id="auther_img" name="auther_img"> <!-- Champ de téléchargement pour l'image de l'auteur -->
            @if($book->auther_img)
                <p>Image actuelle : <img src="{{ asset($book->auther_img) }}" alt="{{ $book->auther_name }}" style="width: 100px; height: auto;"></p> <!-- Affiche l'image actuelle de l'auteur -->
            @endif
        </div>

        <div>
            <input type="submit" class="btn btn-warning" value="Update the Book"> <!-- Bouton de soumission du formulaire -->
        </div>
    </form>
</div>
