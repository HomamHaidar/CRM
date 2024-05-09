@extends('layouts.master2')
@section('css')
@endsection
@section('content')

    <div class="container-fluid">
        <div class="row no-gutter">
            <!-- The image half -->
            <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
                <div class="row wd-100p mx-auto text-center">
                    <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                        <img src="{{URL::asset('assets/img/media/hero.png')}}"
                             class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
                    </div>
                </div>
            </div>
            <!-- Session Status -->

            <x-auth-session-status class="mb-4" :status="session('status')"/>
            <!-- The content half -->
            <div class="col-md-6 col-lg-6 col-xl-5 bg-white-9">
                <div class="login d-flex align-items-center py-2">
                    <!-- Demo content-->
                    <div class="container p-0 ">
                        <disv clas="row">
                            <div class="col-md-10 col-lg-12 col-xl-9">
                                <div class="card-sign text-md-center">


                                    <div class="mb-5 d-flex justify-content-center align-items-center"><img href="{{ url('/' . $page='index') }}"><img
                                                src="{{URL::asset('assets/img/brand/crmlogo.png')}}"
                                                class="sign-favicon ht-200" alt="logo"></img>

                                    </div>
                                    <div class="card-sigin">
                                        <div class="main-signup-header">
                                            <h2> مرحبا بعودتك !</h2>
                                            <h5 class="font-weight-semibold mb-4">الرجاء تسجيل لدخول للمتابعة.</h5>

                                            <form method="POST" action="{{ route('login') }}">
                                                @csrf

                                                <!-- Email Address -->
                                                <div>
                                                    <x-input-label for="email" :value="__('Email')"/>
                                                    <x-text-input id="email" class="form-control" placeholder="Enter your email"  type="email"
                                                                  name="email"  required autofocus
                                                                  autocomplete="old-email"/>

{{--                                                   // <x-input-error :messages="$errors->get('email')" class="alert alert-danger" />--}}
                                                    @if($errors->has('email'))
                                                        <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                                                    @endif
                                                </div>
                                                <br>

                                                <!-- Password -->
                                                <div class="form-group">
                                                    <x-input-label for="password" :value="__('Password')"/>

                                                    <x-text-input id="password" class="form-control"
                                                                  type="password"
                                                                  name="password"
                                                                  required autocomplete="current-password"/>
                                                    @if($errors->has('password'))
                                                        <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                                                    @endif
{{--                                                    <x-input-error :messages="$errors->get('password')" class="mt-2 danger-widget"/>--}}
                                                </div>

                                                <!-- Remember Me -->


                                                <div class="flex items-center justify-end mt-4">
                                                    <x-primary-button  class="btn btn-main-primary btn-block">
                                                        {{ __('Log in') }}
                                                    </x-primary-button>
                                                </div>
                                            </form>
                                        </div>
                                        </div>
                                        </div>
                                        </div>



@endsection
@section('js')
@endsection
