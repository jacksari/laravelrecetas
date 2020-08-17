@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.css" integrity="sha512-qjOt5KmyILqcOoRJXb9TguLjMgTLZEgROMxPlf1KuScz0ZMovl0Vp8dnn9bD5dy3CcHW5im+z5gZCKgYek9MPA==" crossorigin="anonymous" />
@endsection

@section('botones')
<a href="{{ route('recetas.index') }}" class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold">
    <svg class="icono" fill="none" viewBox="0 0 24 24" stroke="currentColor" className="arrow-circle-left w-6 h-6"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" /></svg>
    Volver</a>
@endsection

@section('content')
    
    <h2 class="text-center mb-5">Editar receta: {{$receta->titulo}}</h2>

    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <form method="POST" action="{{ route('recetas.update', ['receta' => $receta->id]) }}" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="titulo">Título de receta</label>
                    <input 
                        type="text"
                        name="titulo"
                        class="form-control @error('titulo') is-invalid @enderror"
                        id="titulo"
                        placeholder="Título de receta"
                        value="{{$receta->titulo}}"/>
                        @error('titulo')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="categoria">Categoria</label>
                    <select name="categoria" class="form-control @error('titulo') is-invalid @enderror" id="categoria">
                        <option value="">-- Seleccione una categoria --</option>
                        @foreach ($categorias as $categoria)
                            <option 
                                value="{{$categoria->id}}"  
                                {{ $receta->categoria_id == $categoria->id ? 'selected' : ''}}>{{$categoria->titulo}}</option>
                        @endforeach

                    </select>
                    @error('categoria')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="preparacion">Preparación</label>
                    <input id="preparacion" type="hidden" name="preparacion" value="{{ $receta->preparacion }}">
                    <trix-editor
                        class="@error('titulo') is-invalid @enderror"
                        input='preparacion' 
                    ></trix-editor>

                    @error('preparacion')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="ingredientes">Ingredientes</label>
                    <input id="ingredientes" type="hidden" name="ingredientes" value="{{ $receta->ingredientes }}">
                    <trix-editor
                        class="@error('titulo') is-invalid @enderror"
                        input='ingredientes' 
                    ></trix-editor>
                    @error('ingredientes')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="imagen">Elige la imagen</label>
                    
                    <input type="file" 
                            id="imagen"
                            class="form-control @error('titulo') is-invalid @enderror"
                            name="imagen">
                    @error('imagen')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                    @enderror

                    <div class="mt-4">
                        <p class="text-primary">Imagen acutal</p>
                        <img src="/storage/{{$receta->imagen}}" style="width: 300px" alt="">
                    </div>
                </div>

                

                

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Agregar receta</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.js" integrity="sha512-zEL66hBfEMpJUz7lHU3mGoOg12801oJbAfye4mqHxAbI0TTyTePOOb2GFBCsyrKI05UftK2yR5qqfSh+tDRr4Q==" crossorigin="anonymous" defer></script>
@endsection