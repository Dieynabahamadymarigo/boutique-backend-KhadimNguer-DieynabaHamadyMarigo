@extends('layouts.app')

@section('title', 'Utilisateurs')

@section('content')

<div class="page-title container mt-3 mb-3">
        <h1 class="text-primary"><i class="bi bi-person-circle me-2"></i>Utilisateurs</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPerson">
        <i class="bi bi-person-add me-2"></i> Ajouter
        </button>
</div>

<div class=" table-responsive container mt-4">
    <table class="table table-hover table-bordered mx-auto">
        <thead class="table-light">
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateUser{{$user ->id}}">
                    <i class="bi bi-pencil"></i>
                    </button>
                    {{-- <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm">Modifier</a> --}}
                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline delete-form">
                        @csrf @method('DELETE')
                        <button type="button" class="btn btn-danger btn-delete"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


   {{-- modal add person --}}
<div class="modal fade" id="addPerson" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel">Ajouter une personne</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('users.store') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="employe">Employé</option>
                                <option value="gestionnaire">Gestionnaire</option>
                                <option value="admin">Admin</option>
                            </select>
                            @error('role')
                            <div class="text-danger">{{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3 ">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" required>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
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

{{-- modal update person --}}
@foreach($users as $user)

<div class="modal fade" id="updateUser{{$user ->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel">Modifier : {{ $user->name }}</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('users.update', $user) }}" method="POST">
            <div class="modal-body">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{old('name', $user->name)}}" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="employe" @selected($user->role=='employe')>Employé</option>
                        <option value="gestionnaire" @selected($user->role=='gestionnaire')>Gestionnaire</option>
                        <option value="admin" @selected($user->role=="admin")>Admin</option>
                    </select>
                    @error('role')
                    <div class="text-danger">{{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3 ">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- <div class="col-md-6 mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" required>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div> --}}
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
