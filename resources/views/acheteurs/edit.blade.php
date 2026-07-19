@extends('layouts.app')

@section('title', 'Modifier un acheteur')

@section('content')
    <h1>Modifier : {{ $acheteur->nom }}</h1>

    <form action="{{ route('acheteurs.update', $acheteur) }}" method="post">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom', $acheteur->nom) }}" class="form-control" required>
            @error('nom')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" value="{{ old('email', $acheteur->email) }}" class="form-control" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="telephone">Téléphone :</label>
            <input type="text" name="telephone" id="telephone" value="{{ old('telephone', $acheteur->telephone) }}" class="form-control">
            @error('telephone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('acheteurs.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
@endsection