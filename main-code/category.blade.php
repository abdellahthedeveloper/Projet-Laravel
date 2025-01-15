<div class="d-flex align-items-stretch">  
    <div class="page-content">
      <div class="page-header">
        <div class="container-fluid">
          <div class="div_center">
            <div>
              @if (session()->has('message')) <!-- Vérifie si une session contient un message -->
                <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                  {{ session()->get('message') }} <!-- Affiche le message de la session -->
                </div>
              @endif
            </div>
  
            <h1 class="cat_label">Add Category </h1> <!-- Titre de la section d'ajout de catégorie -->
            <form action="{{ url('add_category') }}" method="POST"> <!-- Formulaire pour ajouter une catégorie -->
              @csrf <!-- Protection CSRF -->
              <span style="padding-right: 15px;">
                <label>Category Name :</label> <!-- Étiquette du champ de saisie -->
                <input type="text" name="category" required> <!-- Champ de saisie pour le nom de la catégorie -->
              </span>
              <input class="btn btn-primary" type="submit" value="Add Category"> <!-- Bouton de soumission du formulaire -->
            </form>
  
            <div>
              <table class="center"> <!-- Tableau pour afficher les catégories -->
                <tr>
                  <th>Category Name </th>
                  <th>Action </th>
                </tr>
                @foreach ($data as $data) <!-- Boucle pour parcourir les catégories -->
                  <tr>
                    <td>{{ $data->cat_title }}</td> <!-- Affiche le titre de la catégorie -->
                    <td>
                      <a class="btn btn-info" href="{{ url('edit_category', $data->id) }}">Update</a> <!-- Lien pour mettre à jour la catégorie -->
                      <a onclick="confirmation(event)" class="btn btn-danger" href="{{ url('cat_delete', $data->id) }}">Delete</a> <!-- Lien pour supprimer la catégorie avec confirmation -->
                    </td>
                  </tr>
                @endforeach
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  