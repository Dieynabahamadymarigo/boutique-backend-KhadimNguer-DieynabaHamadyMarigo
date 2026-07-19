@extends('layouts.app')

@section('title', 'Créer un acheteur')

@section('content')
    <h1>Créer un acheteur</h1>

    <form action="{{ route('acheteurs.store') }}" method="post">
        @csrf

        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom') }}" class="form-control" required>
            @error('nom')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="telephone">Téléphone :</label>
            <input type="text" name="telephone" id="telephone" value="{{ old('telephone') }}" class="form-control">
            @error('telephone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="{{ route('acheteurs.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
@endsection