@extends('admin.nav')
@section('title', 'Parametre du profil')
@section('content')
    @php
        if (auth()->user()->avatar == '') {
            $avatar = '/img/avatar.webp';
        } else {
            $avatar = '/uploads/' . auth()->user()->avatar;
        }
    @endphp

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills flex-column flex-md-row mb-4">
                        <li class="nav-item">
                            <a class="nav-link active" href="/admin/my_profile">
                                <i class="ti-xs ti ti-users me-1"></i>
                                Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/my_profile/security"><i class="ti-xs ti ti-lock me-1"></i>
                                Securité</a>
                        </li>
                    </ul>
                    <form action="/admin/update/profile" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="card mb-4">
                            <h5 class="card-header">Profile Details</h5>
                            <!-- Account -->
                            <div class="card-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <div class="avatar avatar-xl avatar-online">
                                        <img src="{{ $avatar }}" alt="Avatar" class="rounded-circle" />
                                      </div>
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                            <i class="ti ti-upload d-block d-sm-none"></i>
                                            <input type="file" name="avatar" class="account-file-input"
                                                accept="image/png, image/jpeg" />
                                        </label>
                                        <div class="text-muted">Allowed JPG, GIF or PNG. Max size of 800K</div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-0" />
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Nom</label>
                                        <input class="form-control" type="text" name="name" required autofocus
                                            value="{{ old('name', $user->name) }}" />
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input class="form-control" type="email" name="email" required
                                            value="{{ old('email', $user->email) }}" placeholder="john.doe@example.com" />
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Nom du responsable</label>
                                        <input class="form-control" type="text" name="nom_responsable" required autofocus
                                            value="{{ old('nom_responsable', $user->nom_responsable) }}" />
                                        @error('nom_responsable')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Numéro de téléphone</label>
                                        <input class="form-control" type="text" name="telephone" required autofocus
                                            value="{{ old('telephone', $user->telephone) }}" />
                                        @error('telephone')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Mode d'affichage des chiffres .</label> <br>
                                        <label class="switch switch-square">
                                            <span class="switch-label">Hors taxes (HT)</span>
                                            <input type="checkbox" class="switch-input" name="taxe" value="oui"
                                                id="taxe" @checked($user->taxe == 'oui') />
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on"></span>
                                                <span class="switch-off"></span>
                                            </span>
                                            <span class="switch-label">Toutes taxes comprises (TTC)</span>
                                        </label>
                                        @error('taxe')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @if ($user->taxe != 'oui')
                                    <div class="mb-3 col-md-6 hide" id="div_valeur_taxe">
                                    @else
                                    <div class="mb-3 col-md-6" id="div_valeur_taxe">
                                    @endif
                                        <label class="form-label">Valeur de la taxe (%)</label>
                                        <input class="form-control" type="number" name="valeur_taxe"
                                            @disabled($user->taxe != 'oui') id="valeur_taxe" placeholder="[ 0 - 100 ]"
                                            autofocus value="{{ old('valeur_taxe', $user->valeur_taxe) }}" />
                                        @error('valeur_taxe')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br><br>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                    <button type="reset" class="btn btn-label-secondary">Cancel</button>
                                </div>
                            </div>
                            <!-- /Account -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- / Content -->

    </div>
    <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
    </div>

@section('css')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#taxe').change(function() {
                if ($(this).is(':checked')) {
                    $('#div_valeur_taxe').show();
                    $('#valeur_taxe').prop('disabled', false);
                } else {
                    $('#valeur_taxe').prop('disabled', true);
                    $('#div_valeur_taxe').hide();
                }
            });
        });
    </script>
@endsection

@endsection
