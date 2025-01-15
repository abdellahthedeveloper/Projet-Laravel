<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Cette méthode affiche la page d'accueil avec tous les livres
    public function index(){
        $data=Book::all(); // Récupère tous les livres
        return view('home.index',compact('data')); // Retourne la vue de la page d'accueil avec les données des livres
    }  

    // Méthode commentée : affichage des détails d'un livre
    // public function book_details($id){
    //     $book=Book::find($id); // Trouve le livre par son id
    //     return view('home.book_details',compact('book')); // Retourne la vue des détails du livre avec les données du livre
    // }

    // Cette méthode gère l'emprunt de livres
    public function borrow_books($id){
        $data=Book::find($id); // Trouve le livre par son id
        $book_id=$id; // Stocke l'id du livre
        $quantity=$data->quantity; // Récupère la quantité disponible du livre

        if($quantity >= '1'){ // Vérifie si la quantité du livre est suffisante
            if(Auth::id()){ // Vérifie si l'utilisateur est authentifié
                $user_id=Auth::user()->id; // Récupère l'id de l'utilisateur
                $borrow=new Borrow; // Crée une nouvelle instance de Borrow
                $borrow->book_id=$book_id; // Associe le livre à l'emprunt
                $borrow->user_id=$user_id; // Associe l'utilisateur à l'emprunt
                $borrow->status='Applied'; // Définit le statut de l'emprunt à 'Applied'

                $borrow->save(); // Sauvegarde l'emprunt dans la base de données
                return redirect()->back()->with('message','Request sent to the Admin to Check, Thank you !'); // Redirige avec un message de succès
            }
            else{
                return redirect('/login'); // Redirige vers la page de login si l'utilisateur n'est pas authentifié
            }
        }else{
            return redirect()->back()->with('message','Not enough book Available'); // Redirige avec un message d'erreur si la quantité de livres est insuffisante
        }
    }

    // Cette méthode affiche l'historique des emprunts de l'utilisateur
    public function book_history(){
        if (Auth::id()) { // Vérifie si l'utilisateur est authentifié
            $userid=Auth::user()->id; // Récupère l'id de l'utilisateur
            $data=Borrow::where('user_id','=',$userid)->get(); // Récupère les emprunts de l'utilisateur
            return view('home.book_history',compact('data')); // Retourne la vue de l'historique des emprunts avec les données
        }
    }

    // Cette méthode annule une demande d'emprunt
    public function cancel($id){
        $data=Borrow::find($id); // Trouve l'emprunt par son id
        $data->delete(); // Supprime l'emprunt
        return redirect()->back()->with('message','Book request Canceled with success!! '); // Redirige avec un message de succès
    }

    // Cette méthode affiche la page d'exploration avec toutes les catégories et livres
    public function explorer(){
        $category=Category::all(); // Récupère toutes les catégories
        $data=Book::all(); // Récupère tous les livres
        return view('home.explorer',compact('data','category')); // Retourne la vue d'exploration avec les données des livres et catégories
    }

    // Cette méthode recherche des livres par titre ou nom de l'auteur
    public function rechercher(Request $request){
        $category=Category::all(); // Récupère toutes les catégories
        $rechercher=$request->rechercher; // Récupère le terme de recherche de la requête
        $data=Book::where('title','LIKE','%'.$rechercher.'%')->orWhere('auther_name','LIKE','%'.$rechercher.'%')->get(); // Recherche des livres par titre ou nom de l'auteur
        return view('home.explorer',compact('data','category')); // Retourne la vue d'exploration avec les résultats de la recherche et les catégories
    }

    // Cette méthode recherche des livres par catégorie
    public function cat_rechercher($id){
        $category=Category::all(); // Récupère toutes les catégories
        $data=Book::where('category_id',$id)->get(); // Récupère les livres de la catégorie sélectionnée
        return view('home.explorer',compact('data','category')); // Retourne la vue d'exploration avec les résultats de la recherche par catégorie et les catégories
    }
}
