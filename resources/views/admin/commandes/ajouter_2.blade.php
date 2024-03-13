@extends('admin.nav')
@section('title', 'Nouvelle commande')
@section('content')
    @php
        $total_qte = 0;
        $total_price = 0;
        $total_total = 0;
    @endphp

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        {{ csrf_field() }}
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-0">
                <span class="text-muted fw-light">Commande /</span><span class="fw-medium">Nouvelle commande</span>
            </h4>

            <div class="app-ecommerce">
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1 mt-3">Etape 2/3</h4>
                        <p class="text-muted">Veuillez renseigner tous les détails</p>
                    </div>
                    <div class="d-flex align-content-center flex-wrap gap-3">
                        <div class="d-flex gap-3">
                            <a href="/client/annuler/commande/actuel">
                                <button class="btn btn-label-danger">
                                    <i class="fa-solid fa-xmark"></i> &nbsp;
                                    Annuler
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- First column-->
                <div class="col-12 col-lg-12 mx-auto">
                    <!-- Product Information -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-tile mb-0">Panier</h5>
                        </div>

                        <div class="card-body">
                            <div class="alert alert-secondary">
                                <div class="row mb-3">
                                    <div class="col-sm-8">
                                        <table style="width: 100%" id="searchResults" class="datatables-products table">
                                            <tbody class="border-top">
                                                <tr>
                                                    <td></td>
                                                    <td>Produit</td>
                                                    <td>Prix</td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div id="resultsContainer"></div>
                                    </div>
                                    <div class="col-sm-4">
                                        <form id="searchForm" autocomplete="off">
                                            <h6>
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                                Recherce du produit par nom
                                            </h6>
                                            <input type="text" autocomplete="off" class="form-control" id="searchInput"
                                                autocomplete="" placeholder="xxxxxxxxx" name="nom" />
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <p>Total des produits en panier : {{ $totalQuantiteEnPanier }}</p>

                            <div class="card-datatable table-responsive">
                                <table class="datatables-products table">
                                    <thead class="border-top">
                                        <tr>
                                            <th></th>
                                            <th>product</th>
                                            <th>Quantité</th>
                                            <th>Prix</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>


                                    @forelse ($productDetails as $index => $item)
                                        <tr>
                                            <td>
                                                <div class="avatar avatar me-2 rounded-2 bg-label-secondary">
                                                    <img src="/uploads/{{ $item->photo }}" class="rounded-2">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <h6 class="text-body text-nowrap mb-0">
                                                        {{ $item->nom }}
                                                    </h6>
                                                    <small class="text-muted text-truncate d-none d-sm-block">
                                                        {{ substr($item->description, 0, 60) }}{{ strlen($item->description) > 60 ? '...' : '' }}
                                                    </small>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="number" value="{{ $item->quantite }}"
                                                    data-prix-vente="{{ $item->prix_vente }}"
                                                    min="1"
                                                    data-index="{{ $item->id }}" class="form-control quantite-input"
                                                    style="width: 120px !important;">
                                            </td>
                                            <td>
                                                <span>{{ $item->prix_vente }}</span>
                                            </td>
                                            <td class="prix-total">
                                                <span id="prix-total-valeur-{{ $item->id }}" class="valeur-somme"
                                                    contenteditable="true">
                                                    {{ $item->quantite * $item->prix_vente }}
                                                </span>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-danger btn-delete"
                                                    data-product-id="{{ $item->id }}">
                                                    <i class="fa-solid fa-delete-left"></i> &nbsp; Supprimer
                                                </button>
                                            </td>
                                        </tr>
                                        @php
                                            $total_qte += $item->quantite;
                                            $total_price += $item->prix_vente * $item->quantite;
                                            $total_total += $item->quantite * $item->prix_vente;
                                        @endphp

                                    @empty
                                    @endforelse
                                    <tr style="background-color: #f1f1f2;">
                                        <td colspan="2">
                                            <b>TOTAL = </b>
                                        </td>
                                        <td>
                                            <b>
                                                <span id="total_total_qte">
                                                    {{ $total_qte }}
                                                </span>
                                            </b>
                                        </td>
                                        <td>
                                            <b>{{ $total_price }}</b>
                                        </td>
                                        <td>
                                            <b>
                                                <span id="total_total">
                                                    {{ $total_total }}
                                                </span>
                                            </b>
                                        </td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                            <hr>
                            <div class="flex text-right">
                                @if ($totalQuantiteEnPanier >= 1)
                                    <a href="/client/valdier_commande_actuelle">
                                        <button class="btn btn-primary btn-submit-order">
                                            <i class="fa-solid fa-cart-shopping"></i> &nbsp; Valider la commande
                                        </button>
                                    </a>
                                @endif
                            </div>

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

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#searchInput').keyup(function() {
                var searchTerm = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: '/client/recherche_produit_code_bar',
                    data: {
                        key: searchTerm
                    },
                    success: function(data) {
                        var tbody = $('#searchResults tbody');
                        var resultsContainer = $('#resultsContainer');
                        resultsContainer.empty();
                        var lignesASupprimer = $('#searchResults tbody tr:not(:first-child)');
                        lignesASupprimer.remove();
                        if (data.length > 0) {
                            $.each(data, function(index, result) {
                                var newRow = $(
                                    '<tr><td><div class="avatar avatar me-2 rounded-2 bg-label-secondary"><img src="/uploads/' +
                                    result.photo +
                                    '"  class="rounded-2" /></div></td><td>' +
                                    result.nom +
                                    '</td><td>' + result.prix_vente +
                                    '</td><td><button class="add_panier btn btn-info" data-valeur="' +
                                    result.id +
                                    '" ><i class="fa-solid fa-plus"></i> Ajouter</button></td></tr>'
                                );

                                tbody.append(newRow);
                            });
                        } else {
                            resultsContainer.append(
                                '<div class="text-danger">Aucun résultat trouvé</div>');
                        }
                    },
                    error: function(error) {
                        console.log('Erreur de requête AJAX : ', error);
                    }
                });
            });
            $('#searchForm').submit(function(e) {
                e.preventDefault();
            });



            //fontion d'ajout au panier
            $(document).on("click", ".add_panier", function() {
                var id = $(this).data("valeur");
                $.ajax({
                    type: 'GET',
                    url: '/client/add_produit_to_panier',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data.message) {
                            Swal.fire({
                                icon: "success",
                                title: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            // Recharger la page
                            setTimeout(function() {
                                location.reload(true);
                            }, 2000);
                        }
                    },
                    error: function(error) {
                        console.log('Erreur de requête AJAX : ', error);
                    }
                });
            });





            //mise a jour de la quantite
            $('.quantite-input').on('input', function() {
                var index = $(this).data('index');
                var nouvelleQuantite = $(this).val();
                var prixVente = $(this).data('prix-vente');
                var nouveauPrixTotal = nouvelleQuantite * prixVente;
                $('#prix-total-valeur-' + index).empty();
                $('#prix-total-valeur-' + index).append(nouveauPrixTotal);
                mettreAJourSomme();
                mettreAJourSommeqte();
                //console.log(nouveauPrixTotal);
                $.ajax({
                    type: 'GET',
                    url: '/client/update_quantite_produit_to_panier',
                    data: {
                        id: index,
                        quantite: nouvelleQuantite
                    },
                    success: function(data) {
                        if (data.erreur) {
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
                        console.log('Erreur de requête AJAX : ', error);
                    }
                });
            });





            function mettreAJourSomme() {
                var somme = 0;
                $('.valeur-somme').each(function() {
                    var valeur = parseFloat($(this).text()) || 0;
                    somme += valeur;
                });
                $('#total_total').empty();
                $('#total_total').append(somme);
            }

            function mettreAJourSommeqte() {
                var somme2 = 0;
                $('.quantite-input').each(function() {
                    var valeur2 = parseFloat($(this).val()) || 0;
                    somme2 += valeur2;
                });
                $('#total_total_qte').empty();
                $('#total_total_qte').append(somme2);
            }






            // Écoute de l'événement clic pour les boutons de suppression
            $('.btn-delete').on('click', function() {
                var productId = $(this).data('product-id');
                $.ajax({
                    type: 'GET',
                    url: '/client/delete_produit_to_panier',
                    data: {
                        id: productId,
                    },
                    success: function(data) {
                        if (data.message === 'supprimer') {
                            // Recharger la page
                            Swal.fire({
                                icon: "success",
                                title: "Supprimé",
                                text: "Le produit a été supprimé du panier",
                                showConfirmButton: false,
                                timer: 2500
                            });
                            setTimeout(function() {
                                location.reload(true);
                            }, 3000);
                        }
                        if (data.erreur) {
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
                        console.log('Erreur de requête AJAX : ', error);
                    }
                });

            });



        });
    </script>
    <style>
        .ok {
            cursor: pointer;
            color: black !important;
            padding-left: 20px;
        }

        .ok:hover {
            font-weight: bold;
            border-left: solid 5px #7367f0;
        }

        .searchResults {
            padding: 20px;
        }
    </style>
@endsection
