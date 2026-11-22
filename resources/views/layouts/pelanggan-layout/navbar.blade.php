<!-- Navbar -->
@if (isset($navbarDetached) && $navbarDetached == 'navbar-detached')
  <nav
    class="layout-navbar-pelanggan {{ $containerNav }} {{ $navbarDetached }} navbar navbar-expand-xl align-items-center bg-navbar-theme-pelanggan"
    id="layout-navbar-pelanggan">
    @include('layouts/pelanggan-layout/navbar-partial')
  </nav>
@else
  <nav class="layout-navbar-pelanggan navbar navbar-expand-xl align-items-center" id="layout-navbar-pelanggan">
    <div class="{{ $containerNav }}">
      @include('layouts/pelanggan-layout/navbar-partial')
    </div>
  </nav>
@endif
<!-- / Navbar -->
