{{-- Page d'accueil --}}
@extends('layouts.app')
@section('title', 'Accueil -- Boutique')

{{-- le body --}}
@section('content')

    <div>
        <img src="{{asset('images/banner.png')}}" alt="banner" class="banner pt-4">
    </div>

    {{-- <div class="cards">
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
    </div> --}}

    <div class="row row-cols-2 row-cols-md-3 mt-4 mb-5 mx-auto justify-content-evenly group-cards">
        <div class="card">
        <a href="{{route('categories.index')}}" >
            <div class="card-body text-center">
                <h3 class="card-title text-primary"><i class="bi bi-columns-gap me-2"></i>Catégories</h3>
                <p class="card-text">
                    Découvrez nos différentes catégories de produits
                </p>
            </div>
            </a>
        </div>
        <div class="card">
            <a href="{{route('produits.index')}}">
                <div class="card-body text-center">
                    <h3 class="card-title text-primary"><i class="bi bi-file-text me-2"></i> Produits</h3>
                    <p class="card-text">
                        Découvrez nos produits disponibles à la vente
                    </p>
                </div>
            </a>
        </div>
        <div class="card">
            <a href="{{route('acheteurs.index')}}">
                <div class="card-body text-center">
                    <h3 class="card-title text-primary"><i class="bi bi-person me-2"></i> Acheteurs</h3>
                    <p class="card-text">
                        Découvrez nos différents acheteurs.
                    </p>
                </div>
            </a>
    </div>
    </div>

    {{-- contact us --}}
    <div class="container contactUs mb-5">
        <div>
            <h4>
                <i class="bi bi-geo-alt"></i>
                Pikine, Dakar
            </h4>
        </div>
        <div>
            <h4>
                <i class="bi bi-telephone"></i>
                +221 77 676 76 77
            </h4>
        </div>
        <div>
            <h4>
                <i class="bi bi-envelope-at"></i>
                    hamadymarigo09@kitchen.sn
            </h4>
        </div>
        <div>
            <h4>
                <i class="bi bi-facebook"></i>
                <i class="bi bi-instagram"></i>
                <i class="bi bi-tiktok"></i>
                <i class="bi bi-whatsapp"></i>
            </h4>
        </div>
    </div>
@endsection
