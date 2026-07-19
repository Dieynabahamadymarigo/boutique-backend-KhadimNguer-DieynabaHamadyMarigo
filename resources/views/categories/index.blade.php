@extends('layouts.app')

@section('title','Categories')

@section('content')

    <div class="page-title container mt-3 mb-3">
        <h1 class="text-primary"> <i class="bi bi-columns-gap me-2"></i> Catégories</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategory">
        <i class="bi bi-plus me-2"></i> Ajouter
        </button>
    </div>

    {{-- Vérification si la collection est vide --}}
    @if($categories->isEmpty())
        <p>😞 Aucune catégorie disponible.</p>
    @else
    <div class="table-responsive container">

        <table class="table table-hover table-bordered mx-auto">
            <thead class="table-light">
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $categorie)
                    <tr>
                        <td>{{ $categorie->nom }}</td>
                        <td>{{ $categorie->description?:'😞 Aucune description disponible' }}</td>
                        <td class="">
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#detailCategory{{$categorie->id}}">
                                <i class="bi bi-eye"></i>
                                </button>
                                 <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateCategory{{$categorie ->id}}">
                                <i class="bi bi-pencil"></i>
                                </button>
                                {{-- formulaire de suppression --}}
                                <form action="{{ route('categories.destroy', $categorie) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-primary btn-delete" ><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    @endif

    {{-- modal add product --}}
    <div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel">Ajouter une Catégorie</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('categories.store') }}" method="POST">
                <div class="modal-body">
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

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enrégistre</button>
                </div>
            </form>

        </div>
    </div>
    </div>

    @foreach($categories as $categorie)

    {{-- modal detail product --}}
    <div class="modal fade" id="detailCategory{{$categorie ->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Détails de la catégorie</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                    <h1>{{$categorie->nom}}</h1>
                    <p>{{$categorie->description ?: 'Aucune description disponible' }}</p>

                    <h2>Produits associés</h2>
                    @if($categorie->produits->isEmpty())
                        <p>😞 Aucun produit associé à cette catégorie.</p>
                    @else
                        <ul>
                            @foreach($categorie->produits as $produit)
                                <li class="text-primary " style="list-style: none">
                                    {{-- <a class="icon-link icon-link-hover" style="--bs-icon-link-transform: translate3d(0, -.125rem, 0);" href="#">
                                    </a>
                                    <i class="bi bi-arrow-up me-2"></i> --}}
                                    <a class="icon-link icon-link-hover text-decoration-none text-primary" style="--bs-icon-link-transform: translate3d(0, -.125rem, 0);" href="{{ route('produits.show', $produit) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5"/>
                                    </svg>
                                    {{ $produit->nom }}</a>
                                    - {{number_format($produit->prix, 2,',','')}} Frc
                                </li>
                            @endforeach
                        </ul>
                    @endif

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
            </div>
        </div>
    </div>

    {{-- modal update product --}}
    <div class="modal fade" id="updateCategory{{$categorie ->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel">Modifier : {{ $categorie->nom }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('categories.update', $categorie) }}" method="POST">
            <div class="modal-body">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control"
                    id="nom" name="nom" value="{{old('nom', $categorie->nom)}}" required>
                    @error('nom')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $categorie->description) }}</textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </div>
            </form>

            </div>
        </div>
    </div>

    @endforeach

@endsection
