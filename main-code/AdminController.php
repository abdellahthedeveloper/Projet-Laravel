<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Cette méthode gère l'affichage de la page d'accueil en fonction du type d'utilisateur
    public function index(){
        if(Auth::id()){ // Vérifie si l'utilisateur est authentifié
            $user_type=Auth()->user()->usertype; // Obtient le type d'utilisateur (admin ou user)
            if($user_type== 'admin'){ // Si l'utilisateur est admin
                $user=User::all()->count(); // Compte le nombre total d'utilisateurs
                $book=Book::all()->count(); // Compte le nombre total de livres
                $accepted=Borrow::where('status','Accepted')->count(); // Compte les emprunts acceptés
                $rejected=Borrow::where('status','Rejected')->count(); // Compte les emprunts rejetés
                return view('admin.index',compact('user','book','accepted','rejected')); // Retourne la vue admin avec les données compactées
            }else if($user_type== 'user'){ // Si l'utilisateur est un user
                $data=Book::all(); // Obtient tous les livres
                return view('home.index',compact('data')); // Retourne la vue utilisateur avec les livres
            }
        }
        else{
            return redirect()->back(); // Redirige l'utilisateur non authentifié vers la page précédente
        }
    }

    // Cette méthode gère l'affichage de la page des catégories
    public function category_page(){
        $data=Category::all(); // Obtient toutes les catégories
        return view('admin.category',compact('data')); // Retourne la vue des catégories avec les données
    }

    // Cette méthode ajoute une nouvelle catégorie
    public function add_category(Request $request){
        $data= new Category; // Crée une nouvelle instance de Category
        $data->cat_title=$request->category; // Définit le titre de la catégorie avec la valeur de la requête
        $data->save(); // Sauvegarde la nouvelle catégorie dans la base de données
        return redirect()->back()->with('message','Category Added Successfully !!'); // Redirige avec un message de succès
    }

    // Cette méthode supprime une catégorie
    public function cat_delete($id){
        $data=Category::find($id); // Trouve la catégorie par son id
        $data->delete(); // Supprime la catégorie
        return redirect()->back()->with('message','Category Deleted Successfully'); // Redirige avec un message de succès
    }

    // Cette méthode affiche la page d'édition d'une catégorie
    public function edit_category($id){
        $data=Category::find($id); // Trouve la catégorie par son id
        return view('admin.edit_category',compact('data')); // Retourne la vue d'édition avec les données de la catégorie
    }

    // Cette méthode met à jour une catégorie
    public function update_category(Request $request, $id){
        $data=Category::find($id); // Trouve la catégorie par son id
        $data->cat_title=$request->cat_name; // Met à jour le titre de la catégorie
        $data->save(); // Sauvegarde les modifications dans la base de données
        return redirect('/category_page')->with('message','Category Updated Successfully'); // Redirige avec un message de succès
    }

    // Cette méthode affiche la page d'ajout d'un livre
    public function add_book(){
        $category=Category::all(); // Obtient toutes les catégories
        return view('admin.add_book',compact('category')); // Retourne la vue d'ajout de livre avec les catégories
    }

    // Cette méthode stocke un nouveau livre dans la base de données
    public function store_book(Request $request)
    {
        $data= new Book; // Crée une nouvelle instance de Book

        // Récupérer l'image du livre et de l'auteur depuis la requête
        $book_image = $request->file('book_img');
        $auther_image = $request->file('auther_img');

        // Traitement de l'image du livre
        if ($book_image) {
            // Générer un nom unique pour l'image du livre
            $book_image_name = time() . '.' . $book_image->getClientOriginalExtension();
            // Déplacer l'image dans le dossier 'books'
            $book_image->move(public_path('books'), $book_image_name);
            // Enregistrer le chemin de l'image dans la base de données
            $data->book_img = 'books/' . $book_image_name;
        }

        // Traitement de l'image de l'auteur
        if ($auther_image) {
            // Générer un nom unique pour l'image de l'auteur
            $auther_image_name = time() . '.' . $auther_image->getClientOriginalExtension();
            // Déplacer l'image dans le dossier 'authors'
            $auther_image->move(public_path('authors'), $auther_image_name);
            // Enregistrer le chemin de l'image dans la base de données
            $data->auther_img = 'authors/' . $auther_image_name;
        }

        // Enregistrer les autres informations du livre dans la base de données (comme 'title', 'auther_name', etc.)
        $data->title = $request->title;
        $data->auther_name = $request->auther_name;
        $data->price = $request->price;
        $data->description = $request->description;
        $data->quantity = $request->quantity;
        $data->category_id = $request->category_id;

        // Sauvegarder les données du livre
        $data->save();
        return redirect()->back(); // Redirige avec un message de succès
    }

    // Cette méthode affiche la liste des livres
    public function show_book(){
        $book=Book::all(); // Obtient tous les livres
        return view('admin.show_book',compact('book')); // Retourne la vue avec la liste des livres
    }

    // Cette méthode supprime un livre
    public function book_delete($id){
        $data=Book::find($id)->delete(); // Trouve le livre par son id et le supprime
        return redirect()->back()->with('message','Book deleted successfully !!'); // Redirige avec un message de succès
    }

    // Cette méthode affiche la page d'édition d'un livre
    public function edit_book($id){
        $book=Book::find($id); // Trouve le livre par son id
        $category=Category::all(); // Obtient toutes les catégories
        return view('admin.edit_book',compact('book','category')); // Retourne la vue d'édition du livre avec les données nécessaires
    }

    // Cette méthode met à jour un livre
    public function update_book(Request $request, $id){
        $data=Book::find($id); // Trouve le livre par son id

        // Met à jour les informations du livre avec les nouvelles données de la requête
        $data->title = $request->title;
        $data->auther_name = $request->auther_name;
        $data->price = $request->price;
        $data->description = $request->description;
        $data->quantity = $request->quantity;
        $data->category_id = $request->category_id;

        // Récupérer l'image du livre et de l'auteur depuis la requête
        $book_image = $request->file('book_img');
        $auther_image = $request->file('auther_img');

        // Traitement de l'image du livre
        if ($book_image) {
            // Générer un nom unique pour l'image du livre
            $book_image_name = time() . '.' . $book_image->getClientOriginalExtension();
            // Déplacer l'image dans le dossier 'books'
            $book_image->move(public_path('books'), $book_image_name);
            // Enregistrer le chemin de l'image dans la base de données
            $data->book_img = 'books/' . $book_image_name;
        }

        // Traitement de l'image de l'auteur
        if ($auther_image) {
            // Générer un nom unique pour l'image de l'auteur
            $auther_image_name = time() . '.' . $auther_image->getClientOriginalExtension();
            // Déplacer l'image dans le dossier 'authors'
            $auther_image->move(public_path('authors'), $auther_image_name);
            // Enregistrer le chemin de l'image dans la base de données
            $data->auther_img = 'authors/' . $auther_image_name;
        }

        $data->save(); // Sauvegarde les modifications du livre dans la base de données
        return redirect('/show_book')->with('message','Book Updated Successfully'); // Redirige avec un message de succès
    }

    // Cette méthode gère les demandes d'emprunt de livres
    public function borrow_request(){
        $data=Borrow::all(); // Obtient toutes les demandes d'emprunt
        $data = Borrow::with(['book.category', 'user'])->get(); // Charge les relations avec les livres et les utilisateurs
        return view('admin.borrow_request',compact('data')); // Retourne la vue avec les demandes d'emprunt
    }
    // Cette méthode accepte une demande d'emprunt et met à jour l'état du livre
public function accepter($id){
    $data=Borrow::find($id); // Trouve la demande d'emprunt par son id
    $status=$data->status; // Obtient le statut actuel de la demande d'emprunt

    if($status=='Accepted'){
        return redirect()->back(); // Si la demande est déjà acceptée, redirige vers la page précédente
    }else{
        $data->status='Accepted'; // Met à jour le statut de la demande à 'Accepted'
        $data->save(); // Sauvegarde les modifications dans la base de données

        $bookid=$data->book_id; // Obtient l'id du livre emprunté
        $book=Book::find($bookid); // Trouve le livre par son id
        $qty=$book->quantity - '1'; // Décrémente la quantité du livre de 1
        $book->quantity=$qty; // Met à jour la quantité du livre
        $book->save(); // Sauvegarde les modifications dans la base de données
        return redirect()->back(); // Redirige vers la page précédente
    }
}

// Cette méthode marque une demande d'emprunt comme retournée et met à jour l'état du livre
public function retourner($id){
    $data=Borrow::find($id); // Trouve la demande d'emprunt par son id
    $status=$data->status; // Obtient le statut actuel de la demande d'emprunt

    if($status=='Returned'){
        return redirect()->back(); // Si le livre est déjà retourné, redirige vers la page précédente
    }else{
        $data->status='Returned'; // Met à jour le statut de la demande à 'Returned'
        $data->save(); // Sauvegarde les modifications dans la base de données

        $bookid=$data->book_id; // Obtient l'id du livre emprunté
        $book=Book::find($bookid); // Trouve le livre par son id
        $qty=$book->quantity + '1'; // Incrémente la quantité du livre de 1
        $book->quantity=$qty; // Met à jour la quantité du livre
        $book->save(); // Sauvegarde les modifications dans la base de données
        return redirect()->back(); // Redirige vers la page précédente
    }
}

// Cette méthode rejette une demande d'emprunt
public function rejeter($id){
    $data=Borrow::find($id); // Trouve la demande d'emprunt par son id
    $data->status='Rejected'; // Met à jour le statut de la demande à 'Rejected'
    $data->save(); // Sauvegarde les modifications dans la base de données
    return redirect()->back(); // Redirige vers la page précédente
}

}
