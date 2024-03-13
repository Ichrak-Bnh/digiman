@extends('admin.nav')
@section('title', 'Details de la commande')
@section('content')
<input type="hidden" name="id_commande" id="id_commande" value="{{ $commande->id}}">


    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-2"><span class="text-muted fw-light">eCommerce /</span> Editer commande</h4>

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                <div class="d-flex flex-column justify-content-center gap-2 gap-sm-0">
                    <h5 class="mb-1 mt-3 d-flex flex-wrap gap-2 align-items-end">
                        Order #{{ $commande->id }}
                        @include('admin.composants.badge_statut', ["statut"=> $commande->status])
                    </h5>
                    <p class="text-body">{{ $commande->created_at }}</p>
                </div>
            </div>

            <!-- Order Details Table -->

            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title m-0">Order details</h5>
                        </div>
                        <div class="alert alert-warning">
                            Les modifications sont enregistrées puis les répercussions sont directement affectées au stock.
                        </div>
                        <div class="card-datatable table-responsive">
                            <table class="datatables-order-details table border-top">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th class="w-50">products</th>
                                        <th class="w-25">price</th>
                                        <th class="w-25">qty</th>
                                        <th>total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                @php
                                    $total = 0;
                                @endphp
                                @forelse ($produits as $item)
                                    @php
                                        $total = $total + $item->quantite * $item->prix_unitaire;
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="avatar avatar me-2 rounded-2 bg-label-secondary">
                                                <img src="/uploads/{{ $item->photo }}" class="rounded-2">
                                            </div>
                                        </td>
                                        <td>{{ $item->nom }}</td>
                                        <td>{{ $item->prix_unitaire }}</td>
                                        <td>
                                            <input type="number" value="{{ $item->quantite }}"
                                                data-prix-vente="{{ $item->prix_vente }}" min="1"
                                                data-index="{{ $item->id }}" class="form-control quantite-input">
                                        </td>
                                        <td class="prix-total">
                                            <span id="prix-total-valeur-{{ $item->id }}" class="valeur-somme"
                                                contenteditable="true">
                                                {{ $item->quantite * $item->prix_unitaire }}
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-danger btn-delete"
                                                data-product-id="{{ $item->id }}">
                                                <i class="fa-solid fa-delete-left"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </table>
                            <div class="d-flex justify-content-end align-items-center m-3 mb-2 p-1">
                                <div class="order-calculations">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="w-px-100 text-heading">Tax:</span>
                                        <h6 class="mb-0">00</h6>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h6 class="w-px-100 mb-0">Total:</h6>
                                        <h6 class="mb-0">
                                            <span id="total_total">
                                                {{ $total }}
                                            </span>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @isset($commande)
                    <div class="col-12 col-lg-4">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between">
                                <h6 class="card-title m-0">Information du client</h6>
                                <h6 class="m-0">
                                    <a href=" javascript:void(0)" class="btn-edit-user-commande">Modifier</a>
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-start align-items-center mb-4">
                                    <div class="avatar me-2">
                                        <img src="/img/avatar.webp" alt="Avatar" class="rounded-circle" />
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a href="app-user-view-account.html" class="text-body text-nowrap">
                                            <h6 class="mb-0">{{ $commande->nom_client }}</h6>
                                        </a>
                                        <small class="text-muted">Customer ID: {{ $commande->id }}</small>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6>Contact info</h6>
                                </div>
                                <form id="form-edit-user">
                                    @csrf
                                    <input type="hidden" name="id_commande" value="{{ $commande->id }}">
                                    <p class="mb-1">Email: {{ $commande->email }}</p>
                                    <input type="email" value="{{ $commande->email }}" name="email"
                                        class="form-control edit-form hide ">
                                    <p class="mb-0">Mobile: {{ $commande->telephone }}</p>
                                    <input type="number" value="{{ $commande->telephone }}" name="telephone"
                                        class="form-control edit-form hide ">
                                    <p class="mb-0">Adresse de Livraison : {{ $commande->adresse }}</p>
                                    <textarea name="adresse" rows="2" class="form-control edit-form hide "> {{ $commande->adresse }}</textarea>
                                    <div class="text-center p-2  edit-form hide">
                                        <button type="submit" class="btn btn-sm btn-dark">
                                            Enregistrer
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between">
                                <h6 class="card-title m-0">Statut de la commande</h6>
                            </div>
                            <div class="card-body">
                                <p class="mb-0">
                                    @include('admin.composants.badge_statut', ["statut"=> $commande->status])
                                </p>
                            </div>
                        </div>



                    </div>
                @endisset
            </div>
        </div>
        <!-- / Content -->
    </div>
    <!-- Content wrapper -->


    <!-- Assurez-vous d'inclure jQuery dans votre page -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {


            //mise a jour de la quantite
            $('.quantite-input').on('input', function() {
                var index = $(this).data('index');
                var nouvelleQuantite = $(this).val();
                var prixVente = $(this).data('prix-vente');
                var nouveauPrixTotal = nouvelleQuantite * prixVente;
                var id_commande = $("#id_commande").val();
                $('#prix-total-valeur-' + index).empty();
                $('#prix-total-valeur-' + index).append(nouveauPrixTotal);
                mettreAJourSomme();
                mettreAJourSommeqte();
                //console.log(nouveauPrixTotal);
                $.ajax({
                    type: 'GET',
                    url: '/client/update_quantite_produit_to_commande',
                    data: {
                        id_commande : id_commande,
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


            //formulaire d'edition
            $('.btn-edit-user-commande').on('click', function() {
                $('.edit-form').show();
                $("#form-edit-user").submit(function(event) {
                    event.preventDefault();
                    var formData = $(this).serialize();
                    $.ajax({
                        type: "POST",
                        url: "/client/edit_commande_user",
                        data: formData,
                        success: function(response) {
                            if (response.message) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Modifier",
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 3000
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
                            console.error('Erreur lors de la soumission du formulaire',
                                error);
                        }
                    });
                });
            });



             // Écoute de l'événement clic pour les boutons de suppression
             $('.btn-delete').on('click', function() {
                var productId = $(this).data('product-id');
                var id_commande = $("#id_commande").val();
                $.ajax({
                    type: 'GET',
                    url: '/client/delete_produit_to_commande',
                    data: {
                        id: productId,
                        id_commande : id_commande,
                    },
                    success: function(data) {
                        if (data.message ) {
                            // Recharger la page
                            Swal.fire({
                                icon: "success",
                                title: "Supprimé",
                                text: data.message,
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

@endsection
