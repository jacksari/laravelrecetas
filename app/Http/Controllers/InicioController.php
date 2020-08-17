<?php

namespace App\Http\Controllers;

use App\CategoriaReceta;
use App\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InicioController extends Controller
{
    public function index()
    {
        //Recetas por cantidad de votos
        //$votadas = Receta::has('likes', '>', 1)->get();
        $votadas = Receta::withCount('likes')->orderBy('likes_count','desc')->take(3)->get();

        // Obtener las revetas más nuevas
        //$nuevas = Receta::orderBy('created_at', 'ASC')->get();
        $nuevas = Receta::latest()->limit(6)->get();

        //Obtener las cateogrias
        $categorias = CategoriaReceta::all();

        //Agrupar recetas por categoria
        $recetas = [];

        foreach($categorias as $categoria){

            $recetas[ Str::slug($categoria->titulo) ][] = Receta::where('categoria_id', $categoria->id)->take(3)->get();

        }
        
        return view('inicio.index', compact('nuevas','recetas','votadas'));
    }
}
