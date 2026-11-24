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
  $container = 'container-lg';

@endphp

@section('layoutContent')
  @if ($isNavbar)
    @include('layouts/landing-layout/navbar')
  @endif

  <div class="layout-wrapper layout-content-navbar {{ $isMenu ? '' : 'layout-without-menu' }}">



    <div class="layout-container">

      @if ($isMenu)
        @include('layouts/sections/menu/verticalMenu')
      @endif

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

          <div class="content-backdrop fade"></div>

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
