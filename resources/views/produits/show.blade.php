@extends('layouts.app')

@section('title', $produit->nom)

@section('content')
    <h1>{{ $produit->nom }}</h1>

    <dl>
        <dt>Prix :</dt>
        <dd>{{ number_format($produit->prix, 2, ',', '') }} €</dd>

        <dt>Stock :</dt>
        <dd>{{ $produit->stock }}</dd>

        <dt>Catégorie :</dt>
        <dd>
            <a href="{{ route('categories.show', $produit->categorie) }}">{{ $produit->categorie->nom ?? 'Aucune catégorie' }}</a>
        </dd>

        <dt>Description :</dt>
        <dd>{{ $produit->description ?: 'Aucune description disponible' }}</dd> 
    </dl>

    {{-- Acheteurs ayant acheté ce produit --}}
    <h2>Acheteurs</h2>
    @if($produit->acheteurs->isEmpty())
        <p>Aucun acheteur pour ce produit.</p>
    @else
        <ul>
            @foreach($produit->acheteurs as $acheteur)
                <li>
                    <a href="{{route('acheteurs.show',$acheteur->id)}}">{{ $acheteur->nom }}</a>
                    {{-- données de la table acheteur_produit --}}
                    — {{ $acheteur->pivot->quantite }} unité(s)
                    - {{ $acheteur->pivot->date_achat}}
                </li>
            @endforeach
        </ul>
    @endif
    
    <a href="{{route('produits.edit',$produit->id)}}">Modifier</a>
    <a href="{{ route('produits.index') }}" class="btn btn-secondary">Retour à la liste</a>

    <form action="{{route('produits.destroy',$produit)}}" method="post" onsubmit="return confirm('Supprimer ce produit ?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>
@endsection