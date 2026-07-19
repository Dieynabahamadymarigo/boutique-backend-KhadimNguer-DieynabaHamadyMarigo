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
        <li class="nav-item">
          <a class="nav-link text-white text-center" href="   ">Connexion</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
