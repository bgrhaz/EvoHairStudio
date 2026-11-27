@php
  use Illuminate\Support\Facades\Auth;
@endphp

<div class="navbar-container">

  <div class="hero-title brand-dimensi d-none d-md-block">
    <h4>DIMENSI EVO </h4>
  </div>

  <nav class="navbar-button">

    <a href="{{ route('login') }}" class="btn-pelanggan">
      <span>Masuk</span>
    </a>

    <a href="{{ route('auth-register-basic') }}" class="btn-pelanggan">
      <span>Daftar</span>
    </a>

</div>
</nav>

</div>

</div>
