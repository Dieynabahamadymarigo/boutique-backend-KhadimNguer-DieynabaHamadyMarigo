@extends('layouts.app')

@section('title', $acheteur->nom)

@section('content')
    <h1>Détails de l'acheteur : {{ $acheteur->nom }}</h1>

    <dl>
        <dt>Email :</dt>
        <dd>{{ $acheteur->email }}</dd>

        <dt>Téléphone :</dt>
        <dd>{{ $acheteur->telephone ?? 'Non renseigné' }}</dd>

    </dl>

    {{-- historique des achats de cet acheteur --}}
    <h2>Achats</h2>

    @if($acheteur->produits->isEmpty())
        Aucun achat.
    @else
        <ul>
        @foreach($acheteur->produits as $produit)
            <li>
                <a href="{{route('produits.show',$produit)}}">{{ $produit->nom }}</a> 
                - {{ $produit->pivot->quantite }} unité(s) 
                - {{ $produit->pivot->date_achat }}
            </li>
        @endforeach
        </ul>
    @endif

    {{-- Formulaire pour ajouter un nouvel achat --}}
    <h3>Ajouter un achat</h3>
    <form action="{{route('acheteurs.acheter',$acheteur)}}" method="post">
        @csrf
        <div class="form-group">
            <label for="produit_id">Produit :</label>
            <select name="produit_id" id="produit_id" class="form-control" required>
                <option value="">Sélectionnez un produit</option>
                @foreach($produits as $produit)
                    <option value="{{ $produit->id }}" @selected(old('produit_id') == $produit->id)>
                        {{ $produit->nom }} ({{ number_format($produit->prix, 2, ',', ' ') }} Frc)
                    </option>
                @endforeach
            </select>
            @error('produit_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="quantite">Quantité :</label>
            <input type="number" name="quantite" id="quantite" class="form-control" min="1" value="{{old('quantite',1)}}" required>
            @error('quantite')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="date_achat">Date de l'achat :</label>
            <input type="date" name="date_achat" id="date_achat" class="form-control" value="{{ old('date_achat', now()->toDateString()) }}" required>
            @error('date_achat')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Ajouter l'achat</button>
    </form>

    <a href="{{route('acheteurs.edit',$acheteur)}}">Modifier</a>
    <a href="{{ route('acheteurs.index') }}" class="btn btn-secondary">Retour à la liste</a>

    <form action="{{route('acheteurs.destroy',$acheteur)}}" method="post" onsubmit="return confirm('Supprimer cet acheteur ?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>

@endsection