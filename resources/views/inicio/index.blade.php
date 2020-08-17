@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
@endsection


@section('content')

    @section('hero')
        <div class="hero-categorias">
            <form class="container h-100" action="{{route('buscar.show')}}">
                <div class="row h-100 align-content-center">
                    <div class="col-md-4 texto-buscar">
                        <p class="display-4">Encuentra una receta para tu próxima comida</p>
                        <input type="search" name="buscar" class="form-control" placeholder="Buscar receta">
                    </div>
                </div>
            </form>
        </div>
    @endsection
    

    <div class="container nuevas-recetas">
        <h2 class="titulo-categoria text-uppercase mb-4">Últimas recetas</h2>

        <div class="owl-carousel owl-theme">
            @foreach ($nuevas as $nueva)
                
                    <div class="card item">
                        <img src="/storage/{{$nueva->imagen}}" class="card-img-top" alt="imagen-receta">
                        <div class="card-body">
                            <h3>{{Str::title($nueva->titulo)}}</h3>
                            <p>{{ Str::words(strip_tags( $nueva->preparacion ), 15) }}</p>
                            <a class="btn btn-primary d-block font-weight-bold text-uppercase" href="{{route('recetas.show', ['receta' => $nueva->id])}}">Ver receta</a>
                        </div>
                    </div>
                
            @endforeach
        </div>

    </div>
    

    <div class="container">
        <h2 class="titulo-categoria text-uppercase my-5 mb-4">Recetas más votadas</h2>

        <div class="row">
                
                @foreach ($votadas as $receta)
                    
                    @include('ui.receta')

                @endforeach

      
        </div>

    </div>

     {{-- <div class="d-flex justify-content-center">
        <h2 class="titulo-categoria text-uppercase mb-4 my-4">Recetas por Categoría</h2>
    </div>--}}

    @foreach ($recetas as $key => $grupo)
            
            <div class="container">
                <h2 class="titulo-categoria text-uppercase my-5 mb-4">{{ str_replace('-',' ', $key) }}</h2>

                <div class="row">
                    @foreach ($grupo as $recetas)
                        
                       
                        @if (count($recetas) !== 0)
                            @foreach ($recetas as $receta)
                                    
                                @include('ui.receta')
                
                            @endforeach
                        @else
                            <div class="card">
                                <div class="card-body h2">
                                    Sin recetas de {{ str_replace('-',' ', $key) }}
                                </div>
                            </div>
                            
                        @endif
                        

                    @endforeach
                </div>

            </div>


    @endforeach

@endsection