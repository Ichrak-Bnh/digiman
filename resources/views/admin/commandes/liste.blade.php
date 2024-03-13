@extends('admin.nav')
@section('title', 'liste des commandes')
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">eCommerce /</span> commande List</h4>

            <!-- Product List Widget -->

            <div class="card mb-4">
                <div class="card-widget-separator-wrapper">
                    <div class="card-body card-widget-separator">
                        <div class="row gy-4 gy-sm-1">
                            <div class="col-sm-6 col-lg-3">
                                <div
                                    class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                                    <div>
                                        <h6 class="mb-2">Total <span class="small">(Sorties + Retourné)</span> </h6>
                                        <h4 class="mb-2">{{ $montant_total_commande + $montant_total_commande_retourner }}
                                        </h4>
                                        <p class="mb-0">
                                            <span class="text-muted me-2">{{ $commandes->count() }} Commandes</span>
                                        </p>
                                    </div>
                                    <span class="avatar me-sm-4">
                                        <span class="avatar-initial bg-label-secondary rounded"><i
                                                class="ti-md ti ti-smart-home text-body"></i></span>
                                    </span>
                                </div>
                                <hr class="d-none d-sm-block d-lg-none me-4" />
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div
                                    class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                                    <div>
                                        <h6 class="mb-2">Montant des commandes</h6>
                                        <h4 class="mb-2 text-danger">{{ $montant_total_commande_retourner }}</h4>
                                        <p class="mb-0">
                                            <span class="text-muted me-2 text-danger">Retrouné</span>
                                        </p>
                                    </div>
                                    <span class="avatar p-2 me-lg-4">
                                        <span class="avatar-initial bg-label-secondary rounded"><i
                                                class="ti-md ti ti-device-laptop text-body"></i></span>
                                    </span>
                                </div>
                                <hr class="d-none d-sm-block d-lg-none" />
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div
                                    class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
                                    <div>
                                        <h6 class="mb-2">Montant des commandes</h6>
                                        <h4 class="mb-2"> {{ $montant_total_commande }} </h4>
                                        <p class="mb-0">
                                            <span class="text-muted me-2">Non retourné</span>
                                        </p>
                                    </div>
                                    <span class="avatar p-2 me-sm-4">
                                        <span class="avatar-initial bg-label-secondary rounded"><i
                                                class="ti-md ti ti-wallet text-body"></i></span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-2">Commandes</h6>
                                        <h4 class="mb-2">{{ $commandes->count() }}</h4>
                                        <p class="mb-0">
                                            <span class="text-muted me-2">Total des commandes</span>
                                            {{-- <span class="badge bg-label-danger">-3.5%</span> --}}
                                        </p>
                                    </div>
                                    <span class="avatar p-2">
                                        <span class="avatar-initial bg-label-secondary rounded"><i
                                                class="ti-md ti ti-gift text-body"></i></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <!-- Product List Table -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Filtre</h5>
                    <form action="/client/filtre_commande" method="post">
                        @csrf
                        <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
                            <div class="col-md-4 product_status">
                                <label class="form-label">Rechercher par Nom,Id,Téléphone</label>
                                <input type="search" name="key" value="{{ old('old_key') }}" class="form-control"
                                    id="search-input" placeholder="Saisissez le nom du produit">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Filtre par statut</label>
                                <select name="etat" class="form-select">
                                    <option>{{ old('old_etat') }}</option>
                                    <x-status-select />
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Date</label>
                                <input type="date" name="date" id="date" class="form-select">
                            </div>
                            <div class="col-md-2 product_category">
                                <label class="form-label"><br> </label>
                                <button class="btn btn-success" style="width: 100%" type="submit">Filtrer</button>
                            </div>
                            <div class="col-md-2 product_stock" style="text-align: right;">
                                <a href="/client/ajout_commande">
                                    <button type="button" class="btn btn-primary">
                                        <i class="fa-solid fa-plus"></i> &nbsp; commande
                                    </button>
                                </a>
                            </div>
                        </div>
                    </form>
                    <div id="outils" class="hide">
                        <button class="btn btn-sm btn-warning " id="btn-telecharger-manifest" type="button"
                            name="manifest">
                            <i class="fa-solid fa-download"></i>&nbsp;&nbsp; Telecharger Manifest
                        </button>
                        <button class="btn btn-sm btn-info" id="btn-telecharger-borderau" type="button"
                            name="borderau">
                            <i class="fa-solid fa-download"></i>&nbsp;&nbsp; Telecharger borderau
                        </button>
                        <button class="btn btn-sm btn-success " id="btn-telecharger-excel" type="button"
                            name="borderau">
                            <i class="fa-regular fa-file-excel"></i>&nbsp;&nbsp; Telecharger fiche Excel
                        </button>
                    </div>
                </div>
                <div class="card-datatable table-responsive">
                    <table class="datatables-products table">
                        <thead class="border-top">
                            <tr>
                                <th>
                                    <input type="checkbox" id="check-all" class="form-check-input">
                                </th>
                                <th>Id commande</th>
                                <th>Date</th>
                                <th>Client</th>
                                <th>Téléphone</th>
                                <th>Montant
                                    @if (auth()->user()->taxe == 'oui')
                                        ( TTC )
                                    @else
                                        ( HT )
                                    @endif
                                </th>
                                <th>status</th>
                                <th>actions</th>
                            </tr>
                        </thead>
                        @php
                            $total = 0;
                        @endphp
                        @forelse ($commandes as $item)
                            <tr>
                                <td>
                                    <input type="checkbox" name="selected_orders[]" value="{{ $item->id }}"
                                        class="form-check-input check-box">
                                </td>
                                <td> {{ $item->id }}</td>
                                <td> {{ \Carbon\Carbon::parse($item->created_at)->format('H:i:s d-m-Y') }} </td>
                                <td> {{ $item->nom_client }}</td>
                                <td> {{ $item->telephone }} </td>
                                <td> {{ $item->total_amount }} DT</td>
                                <td>
                                    <a href=" javascript:void(0)" data-bs-toggle="modal"
                                        data-bs-target="#addNewAddress{{ $item->id }}">
                                        @include('admin.composants.badge_statut', [
                                            'statut' => $item->status,
                                        ])
                                    </a>
                                </td>
                                <td style="text-align: right;">
                                    @if ($item->status != 'Retourné' && $item->status != 'Planification retour')
                                        <a href="/client/editer_commande/{{ $item->id }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        &nbsp;&nbsp;&nbsp;
                                    @endif
                                    <a href="/client/details_commande/{{ $item->id }}">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                    &nbsp;&nbsp;&nbsp;
                                    <span onclick="delete_commande({{ $item->id }})">
                                        <i class="fa-solid fa-trash-can text-danger"></i>
                                    </span>
                                </td>
                                @php
                                    $total += $item->total_amount;
                                @endphp
                                @if ($item->status != 'Retourné')
                                    <!-- Statut de la commande Modal -->
                                    @include('admin.composants.update_statut_commande', [
                                        'id' => $item->id,
                                    ])
                                    <!--/ Statut de la commande Modal -->
                                @endif

                            @empty
                            <tr>
                                <td colspan="8">
                                    <div class="alert alert-warning">
                                        Aucune commande a cette date !
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        <tr style="background-color: #dff7e9;">
                            <td colspan="4"></td>
                            <td><b>MONTANT TOTAL : </b></td>
                            <td><b> {{ $total }} DT</b> </td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </div>
                {{ $commandes->links('pagination::bootstrap-4') }}
            </div>
        </div>
        <!-- / Content -->
    </div>

    <!-- Assurez-vous d'inclure jQuery dans votre page -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {

            //check all
            $('#check-all').change(function() {
                if ($(this).is(':checked')) {
                    $(".check-box").prop('checked', true);
                    $("#outils").show();
                } else {
                    $(".check-box").prop('checked', false);
                    $("#outils").hide();
                }
            });
            $('.check-box').change(function() {
                if ($(this).is(':checked')) {
                    $("#outils").show();
                }
            });





            $('#statut_commande').change(function() {
                var valeurSelectionnee = $(this).val();
                console.log('valeur' + valeurSelectionnee);
                if (valeurSelectionnee == "Retourné") {
                    $('#motif').show();
                    $('#motif').prop('required', true);
                } else {
                    $('#motif').hide();
                    $('#motif').prop('required', false);
                }
            });

            $(".addNewstatutForm").submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    type: "POST",
                    url: "/client/update_statut_commande",
                    data: formData,
                    success: function(response) {
                        if (response.message) {
                            $('.monBouton_close').click();
                            Swal.fire({
                                icon: "success",
                                title: "Modifier",
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1000
                            });
                            setTimeout(function() {
                                location.reload(true);
                            }, 2000);
                        }
                        if (response.erreur) {
                            Swal.fire({
                                icon: "error",
                                title: "Erreur",
                                text: data.erreur,
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }
                    },
                    error: function(error) {
                        console.error('Erreur lors de la soumission du formulaire', error);
                    }
                });
            });
        });
    </script>
    <script>
        // Fonction pour afficher SweetAlert et suprimer
        function delete_commande(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'GET',
                        url: '/client/delete_commande',
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.message) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: response.message,
                                    icon: "success"
                                });
                                setTimeout(function() {
                                    location.reload(true);
                                }, 2000);
                            }
                            if (response.erreur) {
                                Swal.fire({
                                    title: "Erreur!",
                                    text: response.erreur,
                                    icon: "error"
                                });
                            }
                        },
                        error: function(error) {
                            console.error('Erreur de recherche', error);
                        }
                    });

                }
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#btn-telecharger-manifest').on('click', function() {
                var selectedOrders = $('input.check-box:checked').map(function() {
                    return this.value;
                }).get();
                if (selectedOrders.length === 0) {
                    Swal.fire({
                        title: "Erreur!",
                        text: "Veuillez sélectionner au moins une commande.",
                        icon: "error"
                    });
                    return;
                }
                var url = '/client/generate-pdf-manifest?selectedOrders=' + selectedOrders.join(',');
                window.location.href = url;
            });
        });
    </script>



    <script>
        $(document).ready(function() {
            $('#btn-telecharger-borderau').on('click', function() {
                var selectedOrders = $('input.check-box:checked').map(function() {
                    return this.value;
                }).get();
                if (selectedOrders.length === 0) {
                    Swal.fire({
                        title: "Erreur!",
                        text: "Veuillez sélectionner au moins une commande.",
                        icon: "error"
                    });
                    return;
                }
                var url = '/client/generate-pdf-borderau?selectedOrders=' + selectedOrders.join(',');
                window.location.href = url;
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('#btn-telecharger-excel').on('click', function() {
                var selectedOrders = $('input.check-box:checked').map(function() {
                    return this.value;
                }).get();
                if (selectedOrders.length === 0) {
                    Swal.fire({
                        title: "Erreur!",
                        text: "Veuillez sélectionner au moins une commande.",
                        icon: "error"
                    });
                    return;
                }
                var url = '/client/generate-pdf-excel?selectedOrders=' + selectedOrders.join(',');
                window.location.href = url;
            });
        });
    </script>



<script>
    $(document).ready(function() {
        $('#btn-telecharger-excel').on('click', function() {
            var selectedOrders = $('input.check-box:checked').map(function() {
                return this.value;
            }).get();
            if (selectedOrders.length === 0) {
                Swal.fire({
                    title: "Erreur!",
                    text: "Veuillez sélectionner au moins une commande.",
                    icon: "error"
                });
                return;
            }
            var url = '/client/generate-pdf-excel?selectedOrders=' + selectedOrders.join(',');
            window.location.href = url;
        });
    });
</script>

@endsection
