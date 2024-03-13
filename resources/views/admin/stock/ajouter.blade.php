@extends('admin.nav')
@section('title', 'Ajouter rapide du stock')
@section('content')


    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        {{ csrf_field() }}
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-0">
                <span class="text-muted fw-light">Stock /</span><span class="fw-medium"> Ajout rapide</span>
            </h4>

            <div class="app-ecommerce">
                <!-- Add Product -->
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1 mt-3">Ajout rapide</h4>
                        <p class="text-muted">Veuillez renseigner tous les détails</p>
                    </div>

                </div>
                <div class="row">
                    <!-- First column-->
                    <div class="col-12 col-lg-8 mx-auto">
                        <!-- Product Information -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-tile mb-0">Details de la société</h5>
                            </div>
                            <div class="card-body">
                                <form id="form_add_stock">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label class="form-label">Code bare du produit</label>
                                            @isset($code_bar)
                                                <input type="number" class="form-control" required placeholder="xxxxxxxxx"
                                                    name="code_bar" value="{{ $code_bar }}" id="id_produit" />
                                            @else
                                                <input type="number" class="form-control" required placeholder="xxxxxxxxx"
                                                    name="code_bar" value="{{ old('code_bar') }}" id="id_produit" />
                                            @endisset
                                            @error('code_bar')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Quantité</label>
                                            <input type="number" class="form-control" required placeholder="XX"
                                                name="quantite" value="{{ old('quantite') }}" min="1" />
                                            @error('quantite')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="d-flex align-content-center flex-wrap gap-3">
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                    </div>
                                </form>
                            </div>
                            <hr>
                            <div class="card-header">
                                <h5 class="card-tile mb-0">Recherche Rapide</h5>
                            </div>
                            <div class="card-body">
                                <form id="searchForm">
                                    <label class="form-label">Nom du produit</label>
                                    <input type="text" class="form-control" id="searchInput" required
                                        placeholder="xxxxxxxxx" name="code_bar" />
                                </form>
                                <div class="card-datatable table-responsive">
                                    <table class="datatables-products table">
                                        <tbody>
                                    </table>
                                    <div id="searchResults"></div>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            //recherche des produits
            $('#searchInput').keyup(function() {
                var searchTerm = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: '/client/recherche_produit_code_bar',
                    data: {
                        key: searchTerm
                    },
                    success: function(data) {
                        var resultsContainer = $('#searchResults');
                        resultsContainer.empty();
                        var tableBody = $('.datatables-products tbody');
                        tableBody.empty(); // Vider le contenu actuel de la table
                        if (data.length > 0) {
                            $.each(data, function(index, result) {
                                var row =
                                    '<tr><td><div class="avatar avatar me-2 rounded-2 bg-label-secondary"><img src="/uploads/' +
                                    result.photo +
                                    '" class="rounded-2"></div></td><td>' + result.nom +
                                    '</td><td><span class="copy_code" data-valeur="' +
                                    result.code_bar +
                                    '"><i class="fa-solid fa-copy"></i> Copier le code </span></td></tr>';
                                tableBody.append(row);
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

            //copie du code dans la zone de recharge
            $(document).on("click", ".copy_code", function() {
                var id = $(this).data("valeur");
                $("#id_produit").val(id);

            });

            //ajout du produit
            $("#form_add_stock").submit(function(e) {
                e.preventDefault();
                var formData = $("#form_add_stock").serialize();
                var form = $(this);
                $.ajax({
                    type: "POST",
                    url: "/client/ajout_rapide_add",
                    data: formData,
                    success: function(response) {
                        if (response.message) {
                            Swal.fire({
                                title: "Ajouter !",
                                text: response.message,
                                icon: "success",
                                timer: 4000
                            });
                            form.trigger("reset");
                        } else {
                            Swal.fire({
                                title: "Erreur !",
                                text: response.erreur,
                                icon: "error",
                                timer: 4000
                            });
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });






        });
    </script>
    <style>
        .ok {
            cursor: pointer;
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
