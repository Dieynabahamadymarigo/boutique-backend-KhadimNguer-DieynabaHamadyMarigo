{{-- <x-guest-layout> --}}
@extends('layouts.app')

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="cards mb-3 mx-auto mt-5">
    <div class="row g-0">
        <div class="col-md-6">
        <img src="{{ asset('images/login.jpg') }}" class="img-fluid imgLogin" alt="...">
        <img src="{{ asset('images/loginResponsive.png') }}" class="img-fluid imgLoginResponsive" alt="...">
        </div>
        {{-- <div class="col-md-6">
        </div> --}}
        <div class="col-md-6">
        <div class="card-body">

            <div class="logoLogin mb-3 d-flex justify-content-center">
                <img src="{{ asset('images/logo1.png') }}" alt="Logo">
            </div>

            <div class="d-flex justify-content-center text-primary mt-2 p-3 titleLogin">
                <a class="text-primary text-decoration-none text-center {{ request()->routeIs('login') ? 'active' : '' }}" href="{{route('login')}}">
                    <h5 class="card-title"><i class="bi bi-arrow-left me-2"></i>Connexion</h5>
                </a>
            </div>

            <form method="POST" action="{{ route('password.email') }}" class="login p-3">
                @csrf
            <div class="mb-4 text-sm text-gray-600">
                {{ __("Vous avez oublié votre mot de passe ? Indiquez-nous simplement votre adresse e-mail et nous vous enverrons un lien de réinitialisation vous permettant d'en choisir un nouveau.") }}
            </div>

                <!-- Email Address -->
                <div class="input-group loginInput mb-3">
                    <span class="input-group-text">
                        <i class="bi bi-envelope"></i>
                    </span>
                    <div class="form-floating">
                        <x-text-input id="email" class="block form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email" />
                        <x-input-label for="email" :value="__('Email')" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-5 d-flex justify-content-center buttonLogin">
                    <button type="submit" class="ms-3">
                        {{ __('Réinitialisation') }}
                    </button>
                </div>
            </form>
            {{-- <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p> --}}
        </div>
        </div>
    </div>
    </div>

    {{-- <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form> --}}

{{-- </x-guest-layout> --}}
