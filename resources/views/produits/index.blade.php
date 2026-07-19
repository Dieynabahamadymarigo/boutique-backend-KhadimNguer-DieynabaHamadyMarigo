@extends('layouts.app')

@section('title', 'Produits')

@section('content')

    <div class="page-title container mt-3 mb-3">
        <h1 class="text-primary"><i class="bi bi-file-text me-2"></i>Produits</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProduct">
        <i class="bi bi-plus me-2"></i> Ajouter
        </button>
    {{-- <a href="{{ route('produits.create') }}" class="btn btn-primary mb-3">Ajouter un produit</a> --}}
    </div>
    {{-- Vérification si la table est vide --}}
    @if($produits->isEmpty())
        <p>😞 Aucun produit disponible.</p>
    @else
    <div class="table-responsive container">
        <table class="table table-hover table-bordered mx-auto">
            <thead class="table-light">
                <tr>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Stock</th>
                    <th>Catégorie</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produits as $produit)
                    <tr>
                        <td>{{ $produit->nom }}</td>
                        <td>{{ number_format($produit->prix, 2, ',', '') }} Frc</td>
                        <td>{{ $produit->stock }}</td>
                        <td>{{ $produit->categorie->nom ?? '😞 Aucune catégorie' }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#detailProduct{{$produit->id}}">
                                <i class="bi bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateProduct{{$produit ->id}}">
                                 <i class="bi bi-pencil"></i>
                                </button>

                                {{-- formulaire de suppression --}}
                                <form action="{{ route('produits.destroy', $produit) }}" method="POST" class="d-inline delete-form">
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
    <div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel">Ajouter un Produict</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('produits.store') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{old('nom')}}" required>
                            @error('nom')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="categories_id" class="form-label">Catégorie</label>
                            <select class="form-control" id="categories_id" name="categories_id" required>
                                @foreach($categories as $categorie)
                                    <option value="{{ $categorie->id }}" @selected(old('categories_id') == $categorie->id)>{{ $categorie->nom }}</option>
                                @endforeach
                            </select>
                            @error('categories_id')
                                <div class="text-danger">{{ $message }}
                                </div>
                            @enderror
                        </div>
                        </div>

                        <div class="row">
                        <div class="col-md-6 mb-3 ">
                            <label for="prix" class="form-label">Prix</label>
                            <input type="number" class="form-control" id="prix" name="prix" step="0.01" min="0" value="{{ old('prix') }}" required>
                            @error('prix')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" min="0" value="{{ old('stock') }}" required>
                            @error('stock')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea>
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

    @foreach($produits as $produit)

    {{-- modal detail product --}}
    <div class="modal fade" id="detailProduct{{$produit ->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Détails du produit</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <h1 class="text-secondary">{{ $produit->nom }}</h1>

                <dl>
                    <dt class="text-primary">
                        Prix :
                        <span>
                            {{ number_format($produit->prix, 2, ',', '') }} Frc
                        </span>
                    </dt>


                    <dt class="text-primary">
                        Stock :
                        <span>
                            {{ $produit->stock }}
                        </span>
                    </dt>

                    <dt class="text-primary">
                        Catégorie :
                        <span>
                            <a class="icon-link icon-link-hover text-decoration-none text-primary" style="--bs-icon-link-transform: translate3d(0, -.125rem, 0);" href="{{ route('categories.show', $produit->categorie) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5"/>
                            </svg>
                            {{ $produit->categorie->nom ?? '😞 Aucune catégorie' }}
                            </a>

                        </span>
                    </dt>

                    <dt class="text-primary">
                        Description :
                        <span>
                            {{ $produit->description ?: '😞 Aucune description disponible' }}
                        </span>
                    </dt>
                </dl>

                {{-- Acheteurs ayant acheté ce produit --}}
                <h2 class="text-secondary">Acheteurs</h2>
                @if($produit->acheteurs->isEmpty())
                    <p>
                        😞 Aucun acheteur pour ce produit
                    </p>
                @else
                    <ul>
                        @foreach($produit->acheteurs as $acheteur)
                            <li class="text-primary " style="list-style: none">
                                 <a class="icon-link icon-link-hover text-decoration-none text-primary" style="--bs-icon-link-transform: translate3d(0, -.125rem, 0);" href="{{ route('acheteurs.show',$acheteur->id)}}">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-short" viewBox="0 0 16 16">
                                 <path fill-rule="evenodd" d="M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5"/>
                                </svg>
                                {{ $acheteur->nom }}</a>
                                {{-- données de la table acheteur_produit --}}
                                — {{ $acheteur->pivot->quantite }} unité(s)
                                - {{ $acheteur->pivot->date_achat}}
                            </li>
                        @endforeach
                    </ul>
                @endif

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            </div>
            </div>
        </div>
    </div>

    {{-- modal update product --}}
    <div class="modal fade" id="updateProduct{{$produit ->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel">Modifier : {{ $produit->nom }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('produits.update', $produit) }}" method="POST">
                <div class="modal-body">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $produit->nom) }}" required>
                        @error('nom')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
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
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="prix" class="form-label">Prix</label>
                        <input type="number" class="form-control" id="prix" name="prix" step="0.01" min="0" value="{{ old('prix', $produit->prix) }}" required>
                        @error('prix')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock" min="0" value="{{ old('stock', $produit->stock) }}" required>
                        @error('stock')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $produit->description) }}</textarea>
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
