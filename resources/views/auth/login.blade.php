<!DOCTYPE html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="/admin/assets/" data-template="vertical-menu-template-no-customizer">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Connection-Register</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/img/icon1.svg" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- Icons -->
    <link rel="stylesheet" href="/admin/assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/admin/assets/vendor/css/rtl/core.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/css/rtl/theme-default.css" />
    <link rel="stylesheet" href="/admin/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/admin/assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/typeahead-js/typeahead.css" />
    <!-- Vendor -->
    <link rel="stylesheet"
        href="/admin/assets/vendor/libs/@form-validation/umd/styles/index.min.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="/admin/assets/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="/admin/assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/admin/assets/js/config.js"></script>
    <style>
         body{
  background-color: #EBEBEB;
}     
    .authentication-wrapper.authentication-basic .authentication-inner:after {
  width: 180px;
  height: 180px;
  content: " ";
  position: absolute;
  z-index: -1;
  bottom: -30px;
  right: -110px;
  background-image: url("data:image/svg+xml,%3Csvg width='181' height='181' viewBox='0 0 181 181' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Crect x='1.30469' y='1.44312' width='178' height='178' rx='19' stroke='%237367F0' stroke-opacity='0.16' stroke-width='2' stroke-dasharray='8 8'/%3E%3Crect x='22.8047' y='22.9431' width='135' height='135' rx='10' fill='%237367F0' fill-opacity='0.08'/%3E%3C/svg%3E");
}
h6 span{
  padding: 0 20px;
  font-weight: 700;
}
[class="checkbox"]:checked,
[class="checkbox"]:not(:checked){
display: none;
}
.checkbox:checked + label,
.checkbox:not(:checked) + label{
  position: relative;
  display: block;
  text-align: center;
  width: 60px;
  height: 16px;
  border-radius: 8px;
  padding: 0;
  margin: 10px auto 0px auto;
  cursor: pointer;
  background-color: #2C71DE;
}
.checkbox:checked + label:before,
.checkbox:not(:checked) + label:before{
  position: absolute;
  display: block;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  color: #2C71DE;
  background-color: #070891;
  font-family: 'unicons';
  content: '\eb4f';
  z-index: 20;
  top: -10px;
  left: -10px;
  line-height: 36px;
  text-align: center;
  font-size: 24px;
  transition: all 0.5s ease;
}
.checkbox:checked + label:before {
  transform: translateX(44px) rotate(-270deg);
}
.card-3d-wrap {
  -webkit-transform-style: preserve-3d;
  transform-style: preserve-3d;
}
.card-3d-wrapper {
  -webkit-transform-style: preserve-3d;
  transform-style: preserve-3d;
  transition: all 600ms ease-out; 
}
.card-front, .card-back {
    width: 100%;
  height: 100%;
  -webkit-transform-style: preserve-3d;
  position: relative;

}
.card-back {
  transform: rotateY(180deg);
}
.checkbox:checked ~ .card-3d-wrap .card-3d-wrapper {
  transform: rotateY(180deg);
}
.section{
  position: relative;
  width: 100%;
  display: block;
}
#particles-js{
    position: fixed;
    height: 100%;
    width: 100%;
    }


    </style>
    </head>
    <body>
        <div id="particles-js"></div>
            <div class="container">
                <div class="row full-height ">
                    <div class="col-12 py-5">
                        <h6 class="mb-0 pb-3  text-center"><span>Log In </span><span>Sign Up</span></h6>
                        <input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>
                        <label for="reg-log"></label>
                            <div class="authentication-wrapper authentication-basic container-p-y card-3d-wrap mx-auto" >
                                <div class="authentication-inner py-4 card-3d-wrapper">
                                    <div class="card" style="width: 455px;">
                                        <div class="card-front ">
                                            <div class="card-body">
                                                <div class="section ">
                                                    <div></div>
                                                    <!-- Logo -->
                                                    <div class=" text-center">
                                                        <img src="/img/logo1.png" alt="" srcset="" style="width: 50%;">
                                                    </div>
                                                    <!-- /Logo -->
                                                    <h4 class="mb-1 pt-2">Bienvenue chez DIGIMAN !  👋</h4>
                                                    <p class="mb-4">Veuillez vous connecter à votre compte et commencer l'aventure</p>
                                                    @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li> @endforeach
                                                        </ul>
                                                    </div>
                                                    @endif
                                                        <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label">Email </label>
                                                            <input type="text" class="form-control" id="email" required name="email"
                                                                placeholder="Enter your email " value="{{ old('email') }}" autofocus />
                                                        </div>
                                                        <div class="mb-3 form-password-toggle">
                                                            <div class="d-flex justify-content-between">
                                                                <label class="form-label" for="password">Password</label>
                                                                <a href="{{ route('password.request') }}">
                                                                    <small>Forgot Password?</small>
                                                                </a>
                                                            </div>
                                                            <div class="input-group input-group-merge">
                                                                <input type="password" id="password" required class="form-control" name="password"
                                                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                                    aria-describedby="password" />
                                                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input"  name="remember" type="checkbox" id="remember-me" />
                                                                <label class="form-check-label" for="remember-me"> Sesouvenir de moi </label>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <button class="btn btn-primary d-grid w-100" type="submit">Connexion</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <script type="text/javascript" src="/admin/assets/js/particles.js"></script>
        <script type="text/javascript" src="/admin/assets/js/app.js"></script>
        <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="/admin/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/admin/assets/vendor/libs/popper/popper.js"></script>
    <script src="/admin/assets/vendor/js/bootstrap.js"></script>
    <script src="/admin/assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="/admin/assets/vendor/libs/hammer/hammer.js"></script>
    <script src="/admin/assets/vendor/libs/i18n/i18n.js"></script>
    <script src="/admin/assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="/admin/assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="/admin/assets/vendor/libs/@form-validation/umd/bundle/popular.min.js"></script>
    <script src="/admin/assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js"></script>
    <script src="/admin/assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js"></script>

    <!-- Main JS -->
    <script src="/admin/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="/admin/assets/js/pages-auth.js"></script>
</body>
</html>





