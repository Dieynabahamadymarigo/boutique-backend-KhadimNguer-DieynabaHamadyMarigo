@extends('layouts.app')

@section('title', 'Créer une catégorie')

@section('content')
    <h1>Créer une catégorie</h1>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nom">Nom</label>
            {{-- old() conserve la valeur saisie en cas d'erreur de validation  --}}
            <input type="text" class="form-control" 
            id="nom" name="nom" value="{{old('nom')}}" required>
            @error('nom')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4">{{ old('description') }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="{{route('categories.index')}}">Annuler</a>
    </form>
@endsection