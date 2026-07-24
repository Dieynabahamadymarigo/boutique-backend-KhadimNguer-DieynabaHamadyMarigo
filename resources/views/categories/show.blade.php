@extends('layouts.app')

@section('title', 'Détails de la catégorie')

@section('content')
<div class="card-detail container p-3 mt-5">
  <div class="card-body">
    <div class="row ">
        <h4 class="card-title col-md-12 text-center text-secondary">
            {{$categorie->nom}}
        </h4>
    </div>
    <div class="card-text row mt-3">
        <h6 class="col-md-6">Description : <br> {{ $categorie->description ?: '😞 Aucune description disponible' }} </h6>
        <h6 class="col-md-6">Produits associés : <br>
            @if($categorie->produits->isEmpty())
            <p>😞 Aucun produit associé à cette catégorie.</p>
            @else
                <ul>
                    @foreach($categorie->produits as $produit)
                        <li class="text-primary " style="list-style: none">
                            <a class="icon-link icon-link-hover text-decoration-none text-primary" style="--bs-icon-link-transform: translate3d(0, -.125rem, 0);" href="{{ route('produits.show', $produit) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5"/>
                            </svg>
                                {{ $produit->nom }}
                            </a>
                            — {{number_format($produit->prix, 2,',','')}} Frc
                        </li>
                    @endforeach
                </ul>
            @endif
        </h6>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Retour à la liste</a>
    </div>
  </div>
</div>
@endsection
