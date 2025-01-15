<div class="page-content">
    <div class="page-header">
        <div class="container-fluid">
            <div>
                <h1 class="titre">Add Book</h1> <!-- Titre de la section d'ajout de livre -->

                <!-- Formulaire de création d'un livre -->
                <form action="{{ url('store_book') }}" method="POST" enctype="multipart/form-data">
                    @csrf <!-- Protection contre les attaques CSRF -->

                    <div class="mb-3">
                        <label for="title" class="form-label">Titre</label> <!-- Étiquette du champ de titre -->
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required> <!-- Champ de saisie pour le titre du livre -->
                        @error('title')
                            <div class="text-danger">{{ $message }}</div> <!-- Affiche un message d'erreur si le titre est incorrect -->
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="auther_name" class="form-label">Nom de l'auteur</label> <!-- Étiquette du champ de nom de l'auteur -->
                        <input type="text" class="form-control" id="auther_name" name="auther_name" value="{{ old('auther_name') }}" required> <!-- Champ de saisie pour le nom de l'auteur -->
                        @error('auther_name')
                            <div class="text-danger">{{ $message }}</div> <!-- Affiche un message d'erreur si le nom de l'auteur est incorrect -->
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Prix</label> <!-- Étiquette du champ de prix -->
                        <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}" required> <!-- Champ de saisie pour le prix -->
                        @error('price')
                            <div class="text-danger">{{ $message }}</div> <!-- Affiche un message d'erreur si le prix est incorrect -->
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label> <!-- Étiquette du champ de description -->
                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea> <!-- Champ de saisie pour la description -->
                        @error('description')
                            <div class="text-danger">{{ $message }}</div> <!-- Affiche un message d'erreur si la description est incorrecte -->
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantité</label> <!-- Étiquette du champ de quantité -->
                        <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}" required> <!-- Champ de saisie pour la quantité -->
                        @error('quantity')
                            <div class="text-danger">{{ $message }}</div> <!-- Affiche un message d'erreur si la quantité est incorrecte -->
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="book_img" class="form-label">Image du livre</label> <!-- Étiquette du champ de téléchargement de l'image du livre -->
                        <input type="file" class="form-control" id="book_img" name="book_img" accept="image/*"> <!-- Champ de téléchargement pour l'image du livre -->
                        @error('book_img')
                            <div class="text-danger">{{ $message }}</div> <!-- Affiche un message d'erreur si l'image du livre est incorrecte -->
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="auther_img" class="form-label">Image de l'auteur</label> <!-- Étiquette du champ de téléchargement de l'image de l'auteur -->
                        <input type="file" class="form-control" id="auther_img" name="auther_img" accept="image/*"> <!-- Champ de téléchargement pour l'image de l'auteur -->
                        @error('auther_img')
                            <div class="text-danger">{{ $message }}</div> <!-- Affiche un message d'erreur si l'image de l'auteur est incorrecte -->
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Catégorie</label> <!-- Étiquette de la liste déroulante des catégories -->
                        <select class="form-control" id="category_id" name="category_id" required> <!-- Liste déroulante des catégories -->
                            <option value="">Sélectionnez une catégorie</option> <!-- Option par défaut -->
                            @foreach($category as $category) <!-- Boucle pour parcourir les catégories -->
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->cat_title }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="text-danger">{{ $message }}</div> <!-- Affiche un message d'erreur si la catégorie est incorrecte -->
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Ajouter le livre</button> <!-- Bouton de soumission du formulaire -->
                </form>
            </div>
        </div>
    </div>
</div>
