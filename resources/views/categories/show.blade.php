@extends('layouts.app')

@section('title', 'Détails de la catégorie')

@section('content')
    <h1>{{$categorie->nom}}</h1>
    <p>{{$categorie->description ?: 'Aucune description disponible' }}</p>

    <h2>Produits associés</h2>
    @if($categorie->produits->isEmpty())
        <p>Aucun produit associé à cette catégorie.</p>
    @else
        <ul>
            @foreach($categorie->produits as $produit)
                <li>
                    <a href="{{ route('produits.show', $produit) }}">{{ $produit->nom }}</a>
                    {{number_format($produit->prix, 2,',','')}} €
                </li>
            @endforeach
        </ul>
    @endif
    
    <a href="{{route('categories.edit', $categorie)}}" class="btn btn-warning">Modifier</a>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Retour à la liste</a>

    {{-- formulaire de suppression --}}
    <form action="{{ route('categories.destroy', $categorie) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')">Supprimer</button>
    </form>
@endsection