<?php

namespace App\Http\Controllers;

use App\CategoriaReceta;
use App\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show','search']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Auth::user()->recetas->dd();
        // $recetas = Auth::user()->recetas;

        $usuario = auth()->user();


        $recetas = Receta::where('user_id', $usuario->id)->paginate(5);

        return view('recetas.index')->with('recetas',$recetas)->with('usuario', $usuario);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //DB::table('categoria_receta')->get()->pluck('titulo', 'id');
        //$categorias = DB::table('categoria_recetas')->get()->pluck('titulo', 'id');

        $categorias = CategoriaReceta::all(['id','titulo']);

        return view('recetas.create')->with('categorias', $categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
       
        //dd($request->all());

        $data = $request->validate([
            'titulo' => 'required|min:6',
            'categoria' => 'required',
            'preparacion' => 'required',
            'ingredientes' => 'required',
            'imagen' => 'required|image'
        ]);
        //dd($data);
        $ruta_imagen = $request['imagen']->store('upload-recetas','public');

        $img = Image::make( public_path("storage/{$ruta_imagen}") )->fit(1200,550);

        $img->save();

            // DB::table('recetas')->insert([
            //     'titulo' => $data['titulo'],
            //     'ingredientes' => $ingredientes2,
            //     'preparacion' => $preparacion2,
            //     'user_id' => Auth::user()->id,
            //     'categoria_id' => $data['categoria'],
            //     'imagen' => $ruta_imagen
            // ]);
        auth()->user()->recetas()->create([
            'titulo' => $data['titulo'],
            'ingredientes' => $data['ingredientes'],
            'preparacion' => $data['preparacion'],
            'categoria_id' => $data['categoria'],
            'imagen' => $ruta_imagen
        ]);
    
        return redirect()->action('RecetaController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        //Obtener si el usuario le gusta la receta y esta autenteicado
        $like = ( auth()->user() ) ? auth()->user()->meGusta->contains($receta->id) : false;
        //Pasa la cantidad de likes de una receta
        $likes = $receta->likes->count();

        return view('recetas.show',compact('receta','like','likes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        $this->authorize('view', $receta);
        $categorias = CategoriaReceta::all(['id','titulo']);
        return view('recetas.edit',compact('categorias','receta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        // Revisar el policy
        $this->authorize('update', $receta);

        $data = $request->validate([
            'titulo' => 'required|min:6',
            'categoria' => 'required',
            'preparacion' => 'required',
            'ingredientes' => 'required'
        ]);

        $receta->titulo = $data['titulo'];
        $receta->categoria_id = $data['categoria'];
        $receta->preparacion = $data['preparacion'];
        $receta->ingredientes = $data['ingredientes'];

        if(request('imagen')){
            $ruta_imagen = $request['imagen']->store('upload-recetas','public');

            $img = Image::make( public_path("storage/{$ruta_imagen}") )->fit(1200,550);
            $img->save();

            $receta->imagen = $ruta_imagen;
        }

        $receta->save();

        return redirect()->action('RecetaController@index');
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        $this->authorize('delete', $receta);

        $receta->delete();
        
        return redirect()->action('RecetaController@index');
    }

    public function search(Request $request)
    {
         $busqueda = $request['buscar'];
        $recetas = Receta::where('titulo', 'like', '%'. $busqueda . '%')->paginate(3);
        $recetas->appends(['buscar' => $busqueda]);

        return view('busquedas.show', compact('recetas','busqueda'));
    }
}
