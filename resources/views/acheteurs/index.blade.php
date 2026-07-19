@extends('layouts.app')

@section('title', 'Liste des acheteurs')

@section('content')

    <div class="page-title container mt-3 mb-3">
        <h1 class="text-primary"><i class="bi bi-person me-2"></i>Acheteurs</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAcheteur">
        <i class="bi bi-plus me-2"></i> Ajouter
        </button>
    </div>
    {{-- <a href="{{ route('acheteurs.create') }}" class="btn btn-primary mb-3">Ajouter un acheteur</a> --}}

    {{-- Vérification si la collection est vide --}}
    @if($acheteurs->isEmpty())
        <p>😞 Aucun acheteur disponible.</p>
    @else
    <div class="table-responsive container">
        <table class="table table-hover table-bordered mx-auto">
            <thead class="table-light">
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($acheteurs as $acheteur)
                    <tr>
                        <td>{{ $acheteur->nom }}</td>
                        <td>{{ $acheteur->email }}</td>
                        <td>{{ $acheteur->telephone ?? 'Non renseigné' }}</td>
                        <td>
                             <div class="d-flex gap-2">
                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#detailAcheteur{{$acheteur->id}}">
                                <i class="bi bi-eye"></i>
                                </button>
                                 <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateAcheteur{{$acheteur ->id}}">
                                <i class="bi bi-pencil"></i>
                                </button>
                                {{-- formulaire de suppression --}}
                                <form action="{{ route('acheteurs.destroy',$acheteur) }}" method="POST" class="d-inline delete-form">
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
    <div class="modal fade" id="addAcheteur" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel">Ajouter un Acheteur</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('acheteurs.store') }}" method="POST">
                    <div class="modal-body">
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

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enrégistre</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    @foreach($acheteurs as $acheteur)

    {{-- modal detail product --}}
    <div class="modal fade" id="detailAcheteur{{$acheteur ->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Détails de l'acheteur : {{ $acheteur->nom }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <dl>
                    <dt>Email :</dt>
                    <dd>{{ $acheteur->email }}</dd>

                    <dt>Téléphone :</dt>
                    <dd>{{ $acheteur->telephone ?? 'Non renseigné' }}</dd>

                </dl>

                {{-- historique des achats de cet acheteur --}}
                <h2>Achats</h2>

                @if($acheteur->produits->isEmpty())
                    <p class="mb-2">
                        😞 Aucun achat <br>
                    </p>
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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAchat{{$acheteur ->id}}">
                <i class="bi bi-plus me-2"></i> Ajouter un achat
                </button>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            </div>
            </div>
        </div>
    </div>

    {{-- modal update product --}}
    <div class="modal fade" id="updateAcheteur{{$acheteur ->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel">Modifier : {{ $acheteur->nom }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('acheteurs.update', $acheteur) }}" method="POST">
            <div class="modal-body">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nom">Nom :</label>
                    <input type="text" name="nom" id="nom" value="{{ old('nom', $acheteur->nom) }}" class="form-control" required>
                    @error('nom')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $acheteur->email) }}" class="form-control" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="telephone">Téléphone :</label>
                    <input type="text" name="telephone" id="telephone" value="{{ old('telephone', $acheteur->telephone) }}" class="form-control">
                    @error('telephone')
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

    {{-- modal add Achat --}}
    <div class="modal fade" id="addAchat{{$acheteur ->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel">Ajouter un Acheteur</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('acheteurs.acheter',$acheteur) }}" method="POST">
                    <div class="modal-body">
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

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enrégistre</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    @endforeach

@endsection
