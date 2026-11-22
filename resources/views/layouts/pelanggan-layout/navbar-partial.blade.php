@php
  use Illuminate\Support\Facades\Auth;
@endphp

<div class="navbar-nav-right d-flex align-items-center w-100" id="navbar-collapse">

  <!-- Navigasi Halaman -->
  <ul class="navbar-nav flex-row align-items-center gap-4">

    <li class="nav-item">
      <a href="#home" class="nav-link d-flex align-items-center gap-1">
        <i class="ri ri-home-4-line"></i>
        <span>Halaman Utama</span>
      </a>
    </li>

    <li class="nav-item">
      <a href="#kontak" class="nav-link d-flex align-items-center gap-1">
        <i class="ri ri-contacts-line"></i>
        <span>Kontak</span>
      </a>
    </li>

    <li class="nav-item">
      <a href="#tentang" class="nav-link d-flex align-items-center gap-1">
        <i class="ri ri-information-line"></i>
        <span>Tentang</span>
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

        <!-- Informasi Pengguna -->
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

        <li>
          <div class="dropdown-divider my-1"></div>
        </li>

        <!-- Logout -->
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
