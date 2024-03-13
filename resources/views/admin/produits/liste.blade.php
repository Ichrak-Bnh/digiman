@extends('admin.nav')
@section('title', 'liste des produits')
@section('content')
@php
    use Milon\Barcode\Facades\DNS1DFacade as DNS1D;
@endphp
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Produits /</span> Liste</h4>

            <!-- Product List Widget -->

            <div class="card mb-4">
                <div class="card-widget-separator-wrapper">
                    <div class="card-body card-widget-separator">
                        <div class="row gy-4 gy-sm-1">
                            <div class="col-sm-6 col-lg-3">
                                <div
                                    class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                                    <div>
                                        <h6 class="mb-2">Porduits disponibles</h6>
                                        <h4 class="mb-2">{{ $produits->count() }}</h4>
                                        <p class="mb-0">
                                            <span class="me-2 text-success">Disponible</span>
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
                                        <h6 class="mb-2">Produits Indisponibles</h6>
                                        <h4 class="mb-2 text-danger">{{ $produits->where("statut",'indisponible')->count() }}</h4>
                                        <p class="mb-0">
                                            <span class=" me-2 text-danger">Disponible</span>
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
                                        <h6 class="mb-2">Moyenne des ventes</h6>
                                        <h4 class="mb-2"> {{ $moyenne_ventes }} </h4>
                                        <p class="mb-0 text-muted"></p>
                                    </div>
                                    <span class="avatar p-2 me-sm-4">
                                        <span class="avatar-initial bg-label-secondary rounded"><i
                                                class="ti-md ti ti-gift text-body"></i></span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-2">Produits</h6>
                                        <h4 class="mb-2">{{ $produits->count() }}</h4>
                                        <p class="mb-0">
                                            <span class="text-muted me-2">Total des produits</span>
                                            {{-- <span class="badge bg-label-danger">-3.5%</span> --}}
                                        </p>
                                    </div>
                                    <span class="avatar p-2">
                                        <span class="avatar-initial bg-label-secondary rounded"><i
                                                class="ti-md ti ti-wallet text-body"></i></span>
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
                    <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
                        <div class="col-md-3 product_status">
                            <label for="search-input" class="form-label">Rechercher un produit :</label>
                            <input type="search" class="form-control" id="search-input"
                                placeholder="Saisissez le nom/code barre du produit">
                        </div>
                        <div class="col-md-2">
                            <label for="search-input" class="form-label">Prix minimum de vente</label>
                            <input type="number" name="prix_minimum" class="form-control" id="prix_minimum"
                                placeholder="10000">
                        </div>
                        <div class="col-md-2">
                            <label for="search-input" class="form-label">Prix maximun de vente</label>
                            <input type="number" name="prix_maximun" class="form-control" id="prix_maximun"
                                placeholder="9000000">
                        </div>
                        <div class="col-md-2">
                            <label for="search-input" class="form-label">Stock</label>
                            <select name="statut" class="form-control" id="statut">
                                <option></option>
                                <option value="disponible">Disponible</option>
                                <option value="indisponible">Indisposible</option>
                            </select>
                        </div>
                        <div class="col-md-3 product_stock" style="text-align: right;">
                            <a href="/client/ajouter_produit">
                                <button type="button" class="btn btn-primary">
                                    <i class="fa-solid fa-plus"></i> &nbsp; Ajouter un produit
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-datatable table-responsive">
                    <table class="datatables-products table">
                        <thead class="table-dark">
                            <tr>
                                <th></th>
                                <th>product</th>
                                <th>Catégorie</th>
                                <th>stock</th>
                                <th>Prix achat</th>
                                <th>prix vente <br>
                                    @if (auth()->user()->taxe == 'oui')
                                        ( TTC )
                                    @else
                                        ( HT )
                                    @endif
                                </th>
                                <th>Code</th>
                                <th>status</th>
                                <th>actions</th>
                            </tr>
                        </thead>
                        @forelse ($produits as $item)
                            <tr>
                                <td>
                                    <div class="avatar avatar me-2 rounded-2 bg-label-secondary" data-bs-toggle="modal" data-bs-target="#modal_prodit{{ $item->id}}">
                                        <img src="/uploads/{{ $item->photo }}" class="rounded-2">
                                    </div>
                                    @include('admin.composants.produit_details_modal', ["item"=>$item])
                                </td>
                                <td data-bs-toggle="modal" data-bs-target="#modal_prodit{{ $item->id}}">
                                    <div class="d-flex flex-column">
                                        <h6 class="text-body text-nowrap mb-0" title="{{ $item->nom }}">
                                            {{ substr($item->nom, 0, 35) }}{{ strlen($item->nom) > 35 ? '...' : '' }}
                                        </h6>
                                        <small class="text-muted text-truncate d-none d-sm-block">
                                            {{ substr($item->description, 0, 30) }}{{ strlen($item->description) > 30 ? '...' : '' }}
                                            </small>
                                    </div>
                                </td>
                                <td>
                                    {{ $item->categorie_info->titre }}
                                </td>
                                <td>
                                    <span>{{ $item->quantite }}</span>
                                </td>
                                <td>
                                    <span>{{ $item->prix_achat }}</span> DT
                                </td>
                                <td>
                                    <span>
                                        @if (auth()->user()->taxe == 'oui')
                                            {{ (auth()->user()->valeur_taxe / 100) * $item->prix_vente + $item->prix_vente }}
                                        @else
                                            {{ $item->prix_vente }}
                                        @endif
                                    </span> DT
                                </td>
                                <td>
                                    <span>{{ $item->code_bar }}</span>
                                </td>
                                <td>
                                    @if ($item->statut == 'disponible')
                                        <span class="badge bg-label-success" text-capitalized="">Disponible</span>
                                    @else
                                        <span class="badge bg-label-danger" text-capitalized="">Indisponible</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="/client/editer/produit/{{ $item->id }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    &nbsp;&nbsp;&nbsp;
                                    <span onclick="delete_produit({{ $item->id }})">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </span>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="/client/suivie_produit/{{ $item->id }}">
                                        <i class="fa-solid fa-bars"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <div class="alert alert-warning">
                                        Aucun produit !
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </table>
                </div>
                {{ $produits->links('pagination::bootstrap-4') }}
            </div>
            <div>
                <br><br>

            </div>
        </div>

        <!-- / Content -->
    </div>






    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search-input').on('input', function() {
                var searchTerm = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: '/client/rechercher-produit',
                    data: {
                        term: searchTerm
                    },
                    dataType: 'json',
                    success: function(response) {
                        var produits = response.produits;
                        updateTable(produits);
                    },
                    error: function(error) {
                        console.error('Erreur de recherche', error);
                    }
                });
            });
            $('#prix_maximun').on('input', function() {
                var searchTerm = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: '/client/rechercher-produit',
                    data: {
                        max_prix: searchTerm
                    },
                    dataType: 'json',
                    success: function(response) {
                        var produits = response.produits;
                        updateTable(produits);
                    },
                    error: function(error) {
                        console.error('Erreur de recherche', error);
                    }
                });
            });
            $('#prix_minimum').on('input', function() {
                var searchTerm = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: '/client/rechercher-produit',
                    data: {
                        min_prix: searchTerm
                    },
                    dataType: 'json',
                    success: function(response) {
                        var produits = response.produits;
                        updateTable(produits);
                    },
                    error: function(error) {
                        console.error('Erreur de recherche', error);
                    }
                });
            });
            $('#statut').on('input', function() {
                var searchTerm = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: '/client/rechercher-produit',
                    data: {
                        statut: searchTerm
                    },
                    dataType: 'json',
                    success: function(response) {
                        var produits = response.produits;
                        updateTable(produits);
                    },
                    error: function(error) {
                        console.error('Erreur de recherche', error);
                    }
                });
            });

            function updateTable(produits) {
                var tableBody = $('.datatables-products tbody');
                tableBody.empty(); // Vider le contenu actuel de la table

                // Parcourir les produits et créer les lignes de la table
                $.each(produits, function(index, item) {
                    var row = '<tr>' +
                        '<td><div class="avatar avatar me-2 rounded-2 bg-label-secondary"><img src="/uploads/' +
                        item.photo + '" class="rounded-2"></div></td>' +
                        '<td><div class="d-flex flex-column"><h6 class="text-body text-nowrap mb-0">' + item
                        .nom + '</h6><small class="text-muted text-truncate d-none d-sm-block">' + item
                        .description + '</small></div></td>' +
                        '<td><span>' + item.quantite + '</span></td>' +
                        '<td><span>' + item.prix_achat + '</span> DT</td>' +
                        '<td><span>' + item.prix_vente + '</span> DT</td>' +
                        '<td><span>' + item.code_bar + '</span></td>' +
                        '<td>' + getStatusBadge(item.statut) + '</td>' +
                        '<td>' +
                        '<a href="/client/editer/produit/' + item.id +
                        '"><i class="fa-solid fa-pen-to-square"></i></a>' +
                        '&nbsp;&nbsp;&nbsp;' +
                        '<a href="/client/delete/produit/' + item.id +
                        '"><i class="fa-solid fa-trash"></i></a>' +
                        '</td>' +
                        '</tr>';

                    tableBody.append(row);
                });
            }

            // Fonction pour obtenir le badge de statut en fonction de la valeur du statut
            function getStatusBadge(statut) {
                if (statut == 'disponible') {
                    return '<span class="badge bg-label-success" text-capitalized="">Disponible</span>';
                } else {
                    return '<span class="badge bg-label-danger" text-capitalized="">Indisponible</span>';
                }
            }

        });
    </script>


    <script>
        // Fonction pour afficher SweetAlert et suprimer
        function delete_produit(id) {
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
                        url: '/client/delete-produit',
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.message == "supprimer") {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your file has been deleted.",
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


@endsection
