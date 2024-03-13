@extends('layouts.guest')
@section('title','DIGIMAN - auth')
@section('content')
<div class="card-back">
        <div class="card-body ">
            <div class="section">
                <!-- Logo -->
                <div class=" text-center">
                    <img src="/img/logo1.png" alt="" srcset="" style="width: 50%;">
                </div>
                <!-- /Logo -->
                <h4 class="mb-1 pt-2">Bienvenue chez DIGIMAN !  👋</h4>
                <p class="mb-3" style="width: 300px;">Veuillez vous connecter à votre compte et commencer l'aventure</p>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li> @endforeach
                    </ul>
                </div>
                @endif
                <form method="POST" action="{{ route('register') }}" id="formAuthentication"class=" mb-3" >
                    @csrf
                    <div class="input-group">
                        <!-- Name -->
                        <div class="mb-2">
                            <label for="name" class="form-label">Name </label>
                            <input type="text" class="form-control" style="width: 180px;" id="name" required name="name"
                                placeholder="Enter your Name " value="{{ old('name') }}" autofocus />
                            </div>
                        <!-- tel -->
                        <div class="mb-2">
                            <div class="col">
                                <label class="form-label">Numero de telephone</label>
                                <input type="number" class="form-control" style="width: 180px;" required placeholder="num_tel" name="telephone" value="{{ old('telephone') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="input-group">
                        <!-- Password -->
                        <div class="mb-2 ">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" required class="form-control" style="width: 180px;" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                        </div>
                        <!-- Confirm Password -->
                        <div class="mb-2">
                            <div class="col">
                                <label class="form-label" for="password_confirmation">Confirm Password</label>
                                <input type="password" id="password" style="width: 180px;" required class="form-control"  name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" autocomplete="new-password" />
                            </div> 
                        </div>
                    </div>
                    <!-- Email Address -->
                    <div class="mb-2">
                        <label for="email" class="form-label">Email </label>
                        <input type="text" class="form-control" id="email" required name="email" placeholder="Enter your email " value="{{ old('email') }}" autofocus />
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary d-grid w-100" type="submit">Register</button>
                    </div>
                </form>
            </div>
        </div>
</div>
@endsection