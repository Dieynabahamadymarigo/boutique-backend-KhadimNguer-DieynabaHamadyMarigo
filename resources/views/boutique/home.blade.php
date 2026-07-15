{{-- Page d'accueil --}}
@extends('layouts.app')
@section('title', 'Accueil -- Boutique')

{{-- le body --}}
@section('content')

    <h1>Bienvenue sur notre boutique</h1>
    <p>Découvrez nos derniers produits !</p>

    <div class="cards">
        <a href="{{route('categories.index')}}" class="card">
            <h2>Catégories</h2>
            <p>Découvrez nos différentes catégories de produits.</p>
        </a>
        <a href="{{route('produits.index')}}" class="card">
            <h2>Produits</h2>
            <p>Découvrez nos produits disponibles à la vente.</p>
        </a>
        <a href="{{route('acheteurs.index')}}" class="card">
            <h2>Acheteurs</h2>
            <p>Découvrez nos différents acheteurs.</p>
        </a>
    </div>
@endsection
