{{-- le navbar --}}
<nav class="navbar navbar-expand-lg ">
  <div class="container">

    <a class="navbar-brand" href="{{ route('home') }}">
        <img src="{{ asset('images/logo1.png') }}" alt="Logo" class="logo">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse " id="navbarTogglerDemo02">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}" aria-current="page" href="{{ route('categories.index') }}">Catégories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('produits.*') ? 'active' : '' }}" aria-current="page" href="{{ route('produits.index') }}">Produits</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('acheteurs.*') ? 'active' : '' }}" aria-current="page" href="{{ route('acheteurs.index') }}">Acheteurs</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        @auth
        <li class="nav-item dropdown userConnected">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{Auth::user()->name}}
          </a>
          <ul class="dropdown-menu">
            <li>
                <form action="{{ route('logout') }}" method="post" style="display:inline">
                @csrf
                <button class="dropdown-item" type="submit" >
                <i class="bi bi-box-arrow-left me-2"></i> Déconnexion
                </button>
                </form>
            </li>
            <li>
                <button onclick="{{route('profile.edit')}}" class="dropdown-item" type="button">
                    {{-- <a href="{{route('profile.edit')}}" class=" text-decoration-none text-dark"> --}}
                        <i class="bi bi-person me-2"></i>Profil
                    {{-- </a> --}}
                </button>
            </li>
          </ul>
        </li>
        {{-- <span>{{Auth::user()->name}} </span>
        <form action="{{ route('logout') }}" method="post" style="display:inline">
            @csrf
            <button type="submit">Déconnexion</button>
        </form> --}}
        @else
        <li class="nav-item userNotConnected">
          <a class="nav-link text-white text-center" href="{{route('login')}}">Connexion</a>
        </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
