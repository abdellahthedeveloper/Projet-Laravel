<div class="page-content">
    <div class="page-header">
        <div class="container-fluid">
            <!-- Contenu supplémentaire ou vide -->
        </div>

        <div class="div_deg">
            <h1 class="title_deg">Update Category </h1> <!-- Titre de la section de mise à jour de catégorie -->

            <form action="{{ url('update_category', $data->id) }}" method="POST"> <!-- Formulaire pour mettre à jour une catégorie -->
                @csrf <!-- Protection CSRF -->
                <span style="padding-right: 15px;">
                    <label>Category Name :</label> <!-- Étiquette du champ de saisie -->
                    <input type="text" name="cat_name" value="{{ $data->cat_title }}" required> <!-- Champ de saisie pour le nom de la catégorie -->
                </span>
                <input class="btn btn-info" type="submit" value="Update"> <!-- Bouton de soumission du formulaire -->
            </form>
        </div>
    </div>
</div>
