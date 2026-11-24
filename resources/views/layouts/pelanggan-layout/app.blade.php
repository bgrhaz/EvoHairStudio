@isset($pageConfigs)
  {!! Helper::updatePageConfig($pageConfigs) !!}
@endisset

@extends('layouts/commonMaster')

@php
  /* Display elements */
  $contentNavbar = $contentNavbar ?? true;
  $containerNav = $containerNav ?? 'container-fluid';
  $isNavbar = $isNavbar ?? true;
  $isMenu = $isMenu ?? false;
  $isFlex = $isFlex ?? false;
  $isFooter = $isFooter ?? true;
  $customizerHidden = $customizerHidden ?? '';

  /* HTML Classes */
  $navbarDetached = 'navbar-detached';
  $menuFixed = isset($configData['menuFixed']) ? $configData['menuFixed'] : '';

  if (isset($navbarType)) {
      $configData['navbarType'] = $navbarType;
  }

  $navbarType = isset($configData['navbarType']) ? $configData['navbarType'] : '';
  $footerFixed = isset($configData['footerFixed']) ? $configData['footerFixed'] : '';
  $menuCollapsed = isset($configData['menuCollapsed']) ? $configData['menuCollapsed'] : '';

  /* Content classes */
  $container = 'container-lg';

@endphp

@section('layoutContent')
  @if ($isNavbar)
    @include('layouts/pelanggan-layout/navbar')
  @endif
  <div class="layout-wrapper layout-content-navbar {{ $isMenu ? '' : 'layout-without-menu' }}">


    <div class="layout-container">


      <!-- Layout page -->
      <div class="layout-page">


        <!-- Content wrapper -->
        <div class="content-wrapper">

          @if ($isFlex)
            <div class="{{ $container }} d-flex align-items-stretch flex-grow-1 p-0">
            @else
              <div class="{{ $container }} flex-grow-1 container-p-y">
          @endif
          <!-- Content -->
          <div class="customer-fullpage">

            @yield('content')

          </div>
          <!-- / Content -->

          <!-- Footer -->
          @if ($isFooter)
            @include('layouts/sections/footer/footer')
          @endif
          <!-- / Footer -->

          {{-- FOOTER --}}
          <footer class="landing-footer" id="kontak">
            <div>
              <strong>DIMENSI EVO HAIR STUDIO</strong>
              <p>Look good. Feel confident.</p>
            </div>

            <p>© 2026 DIMENSI EVO HAIR STUDIO</p>
          </footer>

        </div>
        <!-- / Content wrapper -->

      </div>
      <!-- / Layout page -->

    </div>

    @if ($isMenu)
      <div class="layout-overlay layout-menu-toggle"></div>
    @endif

    <div class="drag-target"></div>

  </div>


  <script src="{{ asset('js/navbar.js') }}" defer></script>
@endsection
