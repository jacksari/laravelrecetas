@extends('layouts.app')

@section('botones')
    @include('ui.navegacion')
@endsection

@section('content')
    
    <h2 class="text-center mb-5">Administra tus recetas</h2>


    <div class="col-md-12 mx-auto bg-white p-3">
        <table class="table">
            <thead class="bg-primary text-light">
                <tr>
                    <th scole="col">Título</th>
                    <th scole="col">Categoría</th>
                    <th scole="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recetas as $receta)
                    <tr>
                        <td>{{$receta->titulo}}</td>
                        <td>{{$receta->categoria->titulo}}</td>
                        <td>
                            <div class="row d-flex justify-content-center">
                                <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                                    <eliminar-receta receta-id={{$receta->id}}></eliminar-receta>
                                    
                                    
                                </div>
                                <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                                    <a href="{{ route('recetas.edit', ['receta' => $receta->id])}}" class="btn btn-dark btn-sm d-block mt-1">Editar</a>
                                </div>
                                <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                                    <a href="{{ route('recetas.show', ['receta' => $receta->id])}}" class="btn btn-success btn-sm d-block mt-1">Ver</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    
                @endforeach
            </tbody>
        </table>

        <div class="col-12 mt-4 justify-content-center d-flex">
            {{ $recetas->links() }}
        </div>
    </div>

    <h2 class="text-center my-5">Recetas que te gustan</h2>
        <div class="col-md-10 mx-auto bg-white p-3">

            @if (count($usuario->meGusta) > 0)
                <ul class="list-group">
                    @foreach ($usuario->meGusta as $receta)
                        <li class="list-group-item d-flex justify-content-between align-content-center">
                            <p>{{$receta->titulo}}</p>

                            <a class="btn btn-outline-success text-uppercase" href="{{route('recetas.show', ['receta' => $receta->id])}}">Ver</a>

                        </li>
                    @endforeach
                </ul>

            @else
                <p class="text-center">Aún no tienes recetas Guardadas <small class="text-primary">Dale me gusta a las reeecetas y apareceran aquí</small></p>
            @endif

            
        </div>

        

    

@endsection