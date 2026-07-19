@extends('layouts.app')

@section('name','Modifier une catégorie')
    
@section('content')
    <h1>Modifier : {{ $categorie->nom }}</h1>

    <form action="{{ route('categories.update', $categorie) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" 
            id="nom" name="nom" value="{{ old('nom', $categorie->nom) }}" required>
            @error('nom')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $categorie->description) }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{route('categories.index', $categorie)}}" class="btn btn-secondary">Annuler</a>
    </form>
@endsection