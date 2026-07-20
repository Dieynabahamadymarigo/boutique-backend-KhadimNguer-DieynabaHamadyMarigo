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

        <div class="d-flex justify-content-between text-primary mb-4 mt-2 p-3 titleLogin">
            <a class="text-primary text-decoration-none text-center {{ request()->routeIs('login') ? 'active' : '' }}" href="{{route('login')}}">
                <h5 class="card-title">Connexion</h5>
            </a>
            <a class="text-primary text-decoration-none text-center {{ request()->routeIs('register') ? 'active' : '' }}" href="{{route('register')}}">
                <h5 class="card-title">Inscription</h5>
            </a>
        </div>

        <form method="POST" action="{{ route('login') }}" class="login p-3">
            @csrf

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

            <!-- Password -->
            <div class="input-group loginInput">
                <span class="input-group-text">
                    <i class="bi bi-lock"></i>
                </span>
                <div class="form-floating">
                    <x-text-input id="password" class="block form-control " type="password" name="password" required autocomplete="current-password" placeholder="Password" />
                    <x-input-label for="password" :value="__('Mot de passe')" />
                </div>

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="mt-3 d-flex flex-wrap justify-content-between rememberMe">
                <div class="">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded" name="remember">
                        <small class="ms-1 fs-10 text-gray-600">{{ __('Se souvenir de moi') }}</small>
                    </label>
                </div>
                <div>
                    @if (Route::has('password.request'))
                        <a class="text-decoration-none" href="{{ route('password.request') }}">
                            {{ __('Mot de passe oublié ?') }}
                        </a>
                    @endif
                </div>
            </div>

            <div class="mt-5 d-flex justify-content-center buttonLogin">
                <button type="submit" class="ms-3">
                    {{ __('Connexion') }}
                </button>
                {{-- <x-primary-button class="ms-3">
                    {{ __('Connexion') }}
                </x-primary-button> --}}
            </div>
        </form>
        {{-- <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p> --}}
      </div>
    </div>
  </div>
</div>
{{--
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Connexion') }}
            </x-primary-button>
        </div>
    </form> --}}
{{-- </x-guest-layout> --}}
