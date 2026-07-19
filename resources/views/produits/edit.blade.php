@extends('layouts.app')

@section('title', 'Modifier un produit')

@section('content')
    <h1>Modifier : {{ $produit->nom }}</h1>

    <form action="{{ route('produits.update', $produit) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $produit->nom) }}" required>
            @error('nom')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="prix" class="form-label">Prix</label>
            <input type="number" class="form-control" id="prix" name="prix" step="0.01" min="0" value="{{ old('prix', $produit->prix) }}" required>
            @error('prix')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" min="0" value="{{ old('stock', $produit->stock) }}" required>
            @error('stock')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="categories_id" class="form-label">Catégorie</label>
            <select class="form-control" id="categories_id" name="categories_id" required>
                @foreach($categories as $categorie)
                    <option value="{{ $categorie->id }}" @selected(old('categories_id', $produit->categories_id) == $categorie->id)>{{ $categorie->nom }}</option>
                @endforeach
            </select>
            @error('categories_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $produit->description) }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('produits.index', $produit) }}" class="btn btn-secondary">Annuler</a>
    </form>
@endsection