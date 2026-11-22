
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
    $container = $container ?? 'container-fluid';

@endphp

@section('layoutContent')

    <div class="layout-wrapper layout-content-navbar {{ $isMenu ? '' : 'layout-without-menu' }}">

        <div class="layout-container">

            @if ($isMenu)
                @include('layouts/sections/menu/verticalMenu')
            @endif

            <!-- Layout page -->
            <div class="layout-page">

                <!-- Navbar -->
                @if ($isNavbar)
                    @include('layouts/pelanggan-layout/navbar')
                @endif

                <!-- Content wrapper -->
                <div class="content-wrapper">

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

@endsection
