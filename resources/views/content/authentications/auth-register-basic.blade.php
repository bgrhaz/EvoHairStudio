@extends('layouts/blankLayout')

@section('title', 'Register Basic - Pages')

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
@endsection

@section('content')
  <div class="position-relative">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-6 mx-4">
        <!-- Register Card -->
        <div class="card p-sm-7 p-2">
          <!-- Logo -->
          <div class="app-brand justify-content-center mt-5">
            <a href="{{ url('/') }}" class="app-brand-link gap-3">
              <span class="app-brand-logo demo">@include('_partials.macros')</span>
              <span class="app-brand-text demo text-heading fw-semibold">{{ config('variables.templateName') }}</span>
            </a>
          </div>
          <!-- /Logo -->
          <div class="card-body mt-1">
            <h4 class="mb-1">Adventure starts here 🚀</h4>
            <p class="mb-5">Make your app management easy and fun!</p>

            <form id="formAuthentication" class="mb-5" action="{{ route('auth-register-user') }}" method="POST">
              @csrf
              <div class="form-floating form-floating-outline mb-5 form-control-validation">
                <input type="text" class="form-control" id="namaLengkap" name="namaLengkap" placeholder=" " autofocus
                  required />
                <label for="namaLengkap">Nama Lengkap</label>
              </div>
              <div class="form-floating form-floating-outline mb-5 form-control-validation">
                <input type="text" class="form-control" id="username" name="username" placeholder=" " autofocus
                  required />
                <label for="username">Username</label>
              </div>
              <div class="form-floating form-floating-outline mb-5 form-control-validation">
                <input type="text" class="form-control" id="email" name="email" placeholder=" " required />
                <label for="email">Email</label>
              </div>
              <div class="form-floating form-floating-outline mb-5 form-control-validation">
                <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" placeholder=" " required />
                <label for="nomor_hp">Nomor HP</label>
              </div>
              <div class="mb-5 form-password-toggle form-control-validation">
                <div class="input-group input-group-merge">
                  <div class="form-floating form-floating-outline">
                    <input type="password" id="password" class="form-control" name="password" placeholder=" "
                      aria-describedby="password" required />
                    <label for="password">Password</label>
                  </div>
                  <span class="input-group-text cursor-pointer"><i
                      class="icon-base ri ri-eye-off-line icon-20px"></i></span>
                </div>
              </div>

              <div class="mb-5 py-2 form-control-validation">
                <div class="form-check mb-0">
                  <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" required />
                  <label class="form-check-label" for="terms-conditions">
                    I agree to
                    <a href="javascript:void(0);">privacy policy & terms</a>
                  </label>
                </div>
              </div>
              <input type="hidden" name="role" value="user">
              <button class="btn btn-primary d-grid w-100 mb-5">Sign up</button>
            </form>

            <p class="text-center mb-5">
              <span>Already have an account?</span>
              <a href="{{ url('auth/login-basic') }}">
                <span>Sign in instead</span>
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
