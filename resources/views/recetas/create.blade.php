@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.css" integrity="sha512-qjOt5KmyILqcOoRJXb9TguLjMgTLZEgROMxPlf1KuScz0ZMovl0Vp8dnn9bD5dy3CcHW5im+z5gZCKgYek9MPA==" crossorigin="anonymous" />
@endsection

@section('botones')
    <a href="{{ route('recetas.index') }}" class="btn btn-primary mr-2 text-white">Volver</a>
@endsection

@section('content')
    
    <h2 class="text-center mb-5">Crear nueva receta</h2>

    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <form method="POST" action="{{ route('recetas.store') }}" novalidate>
                @csrf
                <div class="form-group">
                    <label for="titulo">Título de receta</label>
                    <input 
                        type="text"
                        name="titulo"
                        class="form-control @error('titulo') is-invalid @enderror"
                        id="titulo"
                        placeholder="Título de receta"
                        value="{{old('titulo')}}"/>
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
                        @foreach ($categorias as $id => $categoria)
                            <option 
                                value="{{$id}}"  
                                {{old('categoria') == $id ? 'selected' : ''}}>{{$categoria}}</option>
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
                    <input id="preparacion" type="hidden" name="preparacion" value="{{old('preparacion')}}">
                    <trix-editor></trix-editor>
                </div>

                <div class="form-group">
                    <label for="ingredientes">Ingredientes</label>
                    <input id="ingredientes" type="hidden" name="ingredientes" value="{{old('ingredientes')}}">
                    <trix-editor input="ingredientes"></trix-editor>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Agregar receta</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.js" integrity="sha512-zEL66hBfEMpJUz7lHU3mGoOg12801oJbAfye4mqHxAbI0TTyTePOOb2GFBCsyrKI05UftK2yR5qqfSh+tDRr4Q==" crossorigin="anonymous"></script>
@endsection