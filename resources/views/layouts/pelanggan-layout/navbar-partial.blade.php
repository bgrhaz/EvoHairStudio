@php
  use Illuminate\Support\Facades\Auth;
  use Illuminate\Support\Facades\Route;
@endphp

<!--  Brand demo (display only for navbar-full and hide on below xl) -->
@if (isset($navbarFull))
  <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-6">
    <a href="{{ url('/') }}" class="app-brand-link gap-2">
      <span class="app-brand-text demo menu-text fw-bold"></span>
    </a>
  </div>
@endif

<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

  <!-- Navigasi Halaman -->
  <ul class="navbar-nav flex-row align-items-center gap-2">
    <li class="nav-item">
      <a class="nav-link" href="{{ url('/') }}">
        <i class="ri ri-home-4-line me-1"></i>
        Halaman Utama
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ url('/kontak') }}">
        <i class="ri ri-contacts-line me-1"></i>
        Kontak
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ url('/tentang') }}">
        <i class="ri ri-information-line me-1"></i>
        Tentang
      </a>
    </li>
  </ul>

  <!-- Dropdown Profil -->
  <ul class="navbar-nav flex-row align-items-center ms-auto">
    <li class="nav-item navbar-dropdown dropdown-user dropdown">
      <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">

        <div class="avatar avatar-gold">
          <i class="ri ri-user-3-fill"></i>
        </div>
      </a>

      <ul class="dropdown-menu dropdown-menu-end">

        <!-- User Information -->
        <li>
          <div class="dropdown-item">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0 me-3">
                <div class="avatar avatar-gold avatar-lg">
                  <i class="ri ri-user-3-fill"></i>
                </div>
              </div>

              <div class="flex-grow-1">
                <h6 class="mb-0">
                  {{ Auth::user()->username }}
                </h6>
                <small class="text-body-secondary">
                  {{ Auth::user()->role }}
                </small>
              </div>
            </div>
          </div>
        </li>

        <li>
          <div class="dropdown-divider my-1"></div>
        </li>

        <!-- Profile -->
        <li>
          <a class="dropdown-item" href="javascript:void(0);">
            <i class="ri ri-user-3-line icon-md me-3"></i>
            <span>My Profile</span>
          </a>
        </li>

        <!-- Settings -->
        <li>
          <a class="dropdown-item" href="javascript:void(0);">
            <i class="ri ri-settings-3-line icon-md me-3"></i>
            <span>Settings</span>
          </a>
        </li>

        <!-- Logout -->
        <li>
          <div class="dropdown-divider my-1"></div>
        </li>

        <li>
          <div class="d-grid px-4 pt-2 pb-1">
            <a class="btn btn-danger d-flex justify-content-center align-items-center"
              href="{{ route('auth-logout-basic') }}">
              <span>Logout</span>
              <i class="ri ri-logout-box-r-line ms-2"></i>
            </a>
          </div>
        </li>

      </ul>
    </li>
  </ul>
</div>
