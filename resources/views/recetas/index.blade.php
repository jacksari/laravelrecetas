@extends('layouts.app')

@section('botones')
    <a href="{{ route('recetas.create') }}" class="btn btn-primary mr-2 text-white">Crear receta</a>

@endsection

@section('content')
    
    <h2 class="text-center mb-5">Administra tus recetas</h2>
    <div class="col-md-10 mx-auto bg-white p-3">
        <table class="table">
            <thead class="bg-primary text-light">
                <tr>
                    <th scole="col">Título</th>
                    <th scole="col">Categoría</th>
                    <th scole="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Pizza</td>
                    <td>Pizza</td>
                    <td>
                        <button class="btn btn-primary btn-sm">Editar</button>
                    </td>
                </tr>
                <tr>
                    <td>Pizza 2</td>
                    <td>Pizza 2</td>
                    <td>
                        <button class="btn btn-primary btn-sm">Editar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    

@endsection