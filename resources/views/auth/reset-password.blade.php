<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="/admin/assets/"
  data-template="vertical-menu-template-no-customizer">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>DIGIMAN - Reset Password </title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/img/icon1.svg" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
      rel="stylesheet" />

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
    <link rel="stylesheet" href="/admin/assets/vendor/libs/@form-validation/umd/styles/index.min.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="/admin/assets/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="/admin/assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/admin/assets/js/config.js"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
          <!-- Reset Password -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center mb-4 mt-2">
                <img src="/img/logo1.png" alt="" srcset="" style="width: 50%;">
              </div>
              <!-- /Logo -->
              <h4 class="mb-1 pt-2">Reset Password 🔒</h4>
              <p class="mb-4">for <span class="fw-medium">{{$request->email}}</span></p>
              <form id="formAuthentication" action="{{ route('password.store') }}" method="POST">
              @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div class="mb-3 form-password-toggle">
                    <label class="form-label" for="password">Email</label>
                    <div class="input-group input-group-merge">
                      <input
                        type="email"
                        value="{{old('email', $request->email)}}"
                        class="form-control"
                        name="email"
                        aria-describedby="password" />
                      <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                    </div>
                  </div>
                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">Nouveau mot de passe</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password" />
                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                  </div>
                </div>
                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="confirm-password">Confirmation du mot de passe</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="confirm-password"
                      class="form-control"
                      name="password_confirmation"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password" />
                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                  </div>
                </div>
                <button class="btn btn-primary d-grid w-100 mb-3">Valider</button>
                <div class="text-center">
                  <a href="a/login">
                    <i class="ti ti-chevron-left scaleX-n1-rtl"></i>
                    Retour
                  </a>
                </div>
              </form>
            </div>
          </div>
          <!-- /Reset Password -->
        </div>
      </div>
    </div>

    <!-- / Content -->

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



















