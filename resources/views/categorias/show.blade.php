@extends('layouts.app')

@section('content')

    <div class="container">
        <h2 class="titulo-categoria text-uppercase mt-5 mb-4">
            Categoría: {{$categoriaReceta->titulo}}
        </h2>

        <div class="row">
            @if (count($recetas) !== 0)
                @foreach ($recetas as $receta)
                    @include('ui.receta')
                @endforeach
            @else
                <div class="card">
                    <div class="card-body h2">
                        Sin recetas de {{ $categoriaReceta->titulo }}
                    </div>
                </div>
            @endif
        </div>
        <div class="d-flex justify-content-center mt-5">
            {{ $recetas->links() }}
        </div>

    </div>
    
@endsection