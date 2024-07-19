@extends('layouts.app')

@section('content')
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                @include('layouts.navbars.guest.navbar')
            </div>
        </div>
    </div>
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100" style="background-image:url('/images/pupil 10.jpeg')">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Sign In</h4>
                                    <p class="mb-0">Enter your email and password to sign in</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST" action="{{ route('login.perform') }}">
                                        @csrf
                                        @method('post')
                                        <div class="flex flex-col mb-3">
                                            <input type="email" name="Email" class="form-control form-control-lg" value="{{ old('Email') ?? 'group4@gmail.com' }}" aria-label="Email">
                                            @error('Email') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                        <div class="flex flex-col mb-3">
                                            <input type="password" name="Password" class="form-control form-control-lg" aria-label="Password" value="secret" >
                                            @error('Password') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="remember" type="checkbox" id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
                                        </div>
                                        
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-1 text-sm mx-auto"style="font-size: 30px; font-weight: bold; font-family: Arial, sans-serif;color:white;">
    Forgot your password? 
</p>

                                   <p style="font-size: 30px; font-weight: bold; font-family: Arial, sans-serif;color:white;">    Welcome to the Mathematics Challenge web application </p>
                                    <p> <a href="{{ route('reset-password') }}" class="text-primary text-gradient font-weight-bold"style="color:white">Reset password here</a>
                                    </p>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto"><b>
                                        Don't have an account?</b>
                                        <a href="{{ route('register') }}" class="text-primary text-gradient font-weight-bold"><b>Reset password here<b></a>
                                    </p>
                                </div>
                                 <p class="mb-4 text-sm mx-auto"><b>
                                        Here as a Guest</b>
                                        <a href="{{ route('register') }}" class="text-primary text-gradient font-weight-bold"><b>Guest View<b></a>
                                    </p>
                            </div>
                        </div>
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column"style="color:blue;">
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                                style="color:blue; background-image: url('/images/img 1.jpg');
              background-size:cover;">
                                <span class="mask bg-gradient-primary opacity-6"></span>
                                <h4 class="mt-5 text-white font-weight-bolder position-relative"></h4>
                                <p class="text-white position-relative"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
