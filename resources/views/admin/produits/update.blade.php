@extends('admin.nav')
@section('title', 'Modifier produit ' . $produit->nom)
@section('content')

    <form action="/client/update_produit" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="{{ $produit->id }}">
        @csrf
        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="py-3 mb-0">
                    <span class="text-muted fw-light">Produit /</span><span class="fw-medium"> Edition</span>
                </h4>

                <div class="app-ecommerce">
                    <!-- Add Product -->
                    <div
                        class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                        <div class="d-flex flex-column justify-content-center">
                            <h4 class="mb-1 mt-3">Edition du produit</h4>
                            <p class="text-muted">{{ $produit->nom }}</p>
                        </div>
                        <div class="d-flex align-content-center flex-wrap gap-3">
                            <div class="d-flex gap-3">
                                <button class="btn btn-label-secondary">Discard</button>
                            </div>
                            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                        </div>
                    </div>

                    <div class="row">
                        <!-- First column-->
                        <div class="col-12 col-lg-8">
                            <!-- Product Information -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-tile mb-0">Product information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Nom du produit</label>
                                        <input type="text" class="form-control" required name="nom"
                                            value="{{ old('nom', $produit->nom) }}" />
                                        @error('nom')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label class="form-label">Quantité de sécurité</label>
                                            <input type="number" class="form-control" required name="stock_securite"
                                                value="{{ old('stock_securite', $produit->stock_securite) }}" />
                                            @error('stock_securite')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <label for="form-label">catégorie</label>
                                            <select name="categorie" required id="select2Basic" data-allow-clear="true"
                                                class="select2 form-select ">
                                                @foreach ($categories as $item)
                                                    <option value="{{ old('categorie', $item->titre) }}">
                                                        {{ $item->titre }}</option>
                                                @endforeach
                                            </select>
                                            @error('categorie')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Barcode</label>
                                            <input type="text" class="form-control" required name="code_bar"
                                                value="{{ old('code_bar', $produit->code_bar) }}" />
                                            @error('code_bar')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Description -->
                                    <div>
                                        <label class="form-label">Description (Optional)</label>
                                        <textarea name="description" required class="form-control" rows="3">
                                            {{ old('description', $produit->description) }}
                                        </textarea>
                                        @error('description')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- Pricing Card -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Pricing</h5>
                                </div>
                                <div class="card-body">
                                    <!-- Base Price -->
                                    <div class="mb-3">
                                        <label class="form-label">Prix d'achat (HT) </label>
                                        <input type="number" class="form-control" required
                                            value="{{ old('prix_achat', $produit->prix_achat) }}" name="prix_achat" />
                                        @error('prix_achat')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Discounted Price -->
                                    <div class="mb-3">
                                        <label class="form-label">Prix de vente (HT) </label>
                                        <input type="number" class="form-control" required name="prix_vente"
                                            value="{{ old('prix_vente', $produit->prix_vente) }}" />
                                        @error('prix_vente')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- /Pricing Card -->
                        </div>
                        <!-- /Second column -->

                        <!-- Second column -->
                        <div class="col-12 col-lg-4">

                            <!-- Media -->
                            <div class="card mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 card-title">Image</h5>
                                </div>
                                <div class="card-body">
                                    <label for="form-label">Image d'illustration</label>
                                    <div class=" text-center">
                                        <img src="/uploads/{{ $produit->photo }}" style="width: 50%;" srcset="">
                                    </div>
                                    <input name="photo" type="file" class="form-control" />
                                    @error('photo')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <label for="form-label">Autres images</label>
                                    @if ($produit->gallerie_info !== null)
                                        <div class="row">
                                            @foreach ($produit->gallerie_info as $image)
                                                <div class="col" id="img-{{ $image->id }}">
                                                    <button type="button"
                                                        onclick="delete_image({{ $image->id }},{{ $produit->id }})"
                                                        class="bn btn-sm btn-danger">
                                                        x
                                                    </button>
                                                    <img src="/uploads/{{ $image->url }}" style="width: 100%;">
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    <input type="file" class="form-control" name="gallerie[]" multiple />
                                </div>
                            </div>
                            <!-- /Media -->

                        </div>
                        <!-- /Second column -->
                    </div>
                </div>
            </div>
            <!-- / Content -->

            <div class="content-backdrop fade"></div>
        </div>
    </form>
    <link rel="stylesheet" href="/admin/assets/vendor/css/rtl/core.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/css/rtl/theme-default.css" />
    <link rel="stylesheet" href="/admin/assets/css/demo.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/quill/typography.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/quill/katex.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/quill/editor.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/dropzone/dropzone.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/tagify/tagify.css" />
    <script src="/admin/assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/admin/assets/js/config.js"></script>
@section('js')
    <!-- Vendors JS -->
    <script src="/admin/assets/vendor/libs/select2/select2.js"></script>
    <script src="/admin/assets/vendor/libs/tagify/tagify.js"></script>
    <script src="/admin/assets/vendor/libs/bootstrap-select/bootstrap-select.js"></script>
    <script src="/admin/assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="/admin/assets/vendor/libs/bloodhound/bloodhound.js"></script>

    <!-- Main JS -->
    <script src="/admin/assets/js/main.js"></script>

    <script src="/admin/assets/js/forms-selects.js"></script>
    <script src="/admin/assets/js/forms-tagify.js"></script>
    <script src="/admin/assets/js/forms-typeahead.js"></script>



    <!-- Inclure Quill -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
@endsection

<script>
    function delete_image(id_image, id_produit) {
        $.ajax({
            type: 'GET',
            url: '/client/delete_produit_image',
            data: {
                id_image: id_image,
                id_produit: id_produit
            },
            success: function(data) {
                if (data.message) {
                    Swal.fire({
                        title: "Félicitation !",
                        text: data.message,
                        icon: "success",
                        timer:2000
                    });
                    $("#img-" + id_image).hide("slow");
                } else {
                    Swal.fire({
                        title: "Echec !",
                        text: data.erreur,
                        icon: "error"
                    });
                }
            },
            error: function(error) {
                console.log('Erreur de requête AJAX : ', error);
            }
        });
    }
</script>


@endsection
