@php
  $width = $width ?? '60';
  $height = $height ?? '48';
@endphp

<span class="text-primary">
  <img src="{{ asset('assets/json/img/logo.png') }}" alt="Logo" width="{{ $width }}"
    height="{{ $height }}">
</span>
