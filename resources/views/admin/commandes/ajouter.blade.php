@extends('admin.nav')
@section('title', 'Nouvelle commande')
@section('content')


    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        {{ csrf_field() }}
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-0">
                <span class="text-muted fw-light">Commende /</span><span class="fw-medium">Nouvelle commande</span>
            </h4>

            <div class="app-ecommerce">
                <!-- Add Product -->
                <div class="row">
                    <!-- First column-->
                    <div class="col-12 col-lg-12 mx-auto">
                        <div class="bs-stepper wizard-numbered mt-2">
                            <div class="bs-stepper-header">
                                <div class="step" data-target="#account-details-validation">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle" style="background-color: #312585;color: white;">1</span>
                                        <span class="bs-stepper-label mt-1">
                                            <span class="bs-stepper-title">Informations du client</span>
                                            <span class="bs-stepper-subtitle">veuillez remplire les champs</span>
                                        </span>
                                    </button>
                                </div>
                                <div class="line">
                                    <i class="ti ti-chevron-right"></i>
                                </div>
                                <div class="step" data-target="#personal-info-validation">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">2</span>
                                        <span class="bs-stepper-label">
                                            <span class="bs-stepper-title">Panier</span>
                                            <span class="bs-stepper-subtitle">Ajout des produits</span>
                                        </span>
                                    </button>
                                </div>
                                <div class="line">
                                    <i class="ti ti-chevron-right"></i>
                                </div>
                                <div class="step" data-target="#social-links-validation">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">3</span>
                                        <span class="bs-stepper-label">
                                            <span class="bs-stepper-title">Finalisation</span>
                                            <span class="bs-stepper-subtitle">Terminer la commande</span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Product Information -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-tile mb-0">Informations du client.</h5>
                            </div>
                            <div class="card-body">
                                <form action="/client/ajout_commande_etape_1" method="post">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <b>Type de commande</b>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="switch switch-primary">
                                                <span class="switch-label">En Ligne </span>
                                                <input type="checkbox" class="switch-input" name="type" id="type"
                                                    value="online" />
                                                <span class="switch-toggle-slider">
                                                    <span class="switch-on">
                                                        <i class="ti ti-check"></i>
                                                    </span>
                                                    <span class="switch-off">
                                                        <i class="ti ti-x"></i>
                                                    </span>
                                                </span>
                                                <span class="switch-label">En boutique </span>
                                            </label>
                                        </div>
                                        @error('type')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <hr>

                                    @csrf

                                    <div class="col-12">
                                        <label class="form-label">Nom du client</label>
                                        <input type="text" class="form-control" required placeholder="xxxxxxxxx"
                                            name="nom_client" value="{{ old('nom_client') }}" />
                                        @error('nom_client')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="info-onligne p-2" id="info-onligne">
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <label class="form-label">Adresse</label>
                                                <input type="text" class="form-control" placeholder="XX" name="adresse"
                                                    value="{{ old('adresse') }}" />
                                                @error('adresse')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control" placeholder="xxxxxxx@gmail.com"
                                                    name="email" value="{{ old('email') }}" />
                                                @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <label class="form-label">Gouvernorat</label>
                                                <select id="select2Basic" class="select2 form-select form-select-lg"
                                                    name="gouvernorat" data-allow-clear="true">
                                                    <option value="ariana">Ariana</option>
                                                    <option value="beja">Béja</option>
                                                    <option value="ben-arous">Ben Arous</option>
                                                    <option value="bizerte">Bizerte</option>
                                                    <option value="gabes">Gabès</option>
                                                    <option value="gafsa">Gafsa</option>
                                                    <option value="jendouba">Jendouba</option>
                                                    <option value="kairouan">Kairouan</option>
                                                    <option value="kasserine">Kasserine</option>
                                                    <option value="kebili">Kébili</option>
                                                    <option value="kef">Le Kef</option>
                                                    <option value="mahdia">Mahdia</option>
                                                    <option value="manouba">La Manouba</option>
                                                    <option value="medenine">Médenine</option>
                                                    <option value="monastir">Monastir</option>
                                                    <option value="nabeul">Nabeul</option>
                                                    <option value="sfax">Sfax</option>
                                                    <option value="sidi-bouzid">Sidi Bouzid</option>
                                                    <option value="siliana">Siliana</option>
                                                    <option value="sousse">Sousse</option>
                                                    <option value="tataouine">Tataouine</option>
                                                    <option value="tozeur">Tozeur</option>
                                                    <option value="tunis">Tunis</option>
                                                    <option value="zaghouan">Zaghouan</option>
                                                    <!-- Ajoutez d'autres gouvernorats selon vos besoins -->
                                                </select>

                                                @error('gouvernorat')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Numéro de téléphone</label>
                                                <input type="number" class="form-control" placeholder="xx xxx xxx"
                                                    name="telephone" value="{{ old('telephone') }}" />
                                                @error('telephone')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="d-flex align-content-center flex-wrap gap-3">
                                        <button type="submit" class="btn btn-primary">Etape suivante >>></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /Product Information -->

                    </div>
                    <!-- /Second column -->
                </div>
            </div>
        </div>
        <!-- / Content -->
    </div>

    <!-- Inclure le fichier CSS de Select2 -->
@section('css')
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
    <link rel="stylesheet" href="/admin/assets/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/tagify/tagify.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/bootstrap-select/bootstrap-select.css" />

    <link rel="stylesheet" href="/admin/assets/vendor/libs/bs-stepper/bs-stepper.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/@form-validation/umd/styles/index.min.css" />
@endsection

@section('js')



    <!-- Vendors JS -->
    <script src="/admin/assets/vendor/libs/select2/select2.js"></script>
    <script src="/admin/assets/vendor/libs/tagify/tagify.js"></script>
    <script src="/admin/assets/vendor/libs/bootstrap-select/bootstrap-select.js"></script>
    <script src="/admin/assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="/admin/assets/vendor/libs/bloodhound/bloodhound.js"></script>

    <!-- Main JS -->
    <script src="/admin/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="/admin/assets/js/forms-selects.js"></script>
    <script src="/admin/assets/js/forms-tagify.js"></script>
    <script src="/admin/assets/js/forms-typeahead.js"></script>


@endsection

<script>
    $(document).ready(function() {
        $('#gouvernoratSelect').select2({
            placeholder: 'Sélectionnez un gouvernorat',
            tags: true,
        });
    });

    $('#type').change(function() {
        if ($(this).is(':checked')) {
            $("#info-onligne").hide();
        } else {
            $("#info-onligne").show();

        }
    });
</script>
@endsection
