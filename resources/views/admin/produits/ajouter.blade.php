@extends('admin.nav')
@section('title', 'Ajouter un produit')
@section('content')

    <form action="/client/ajouter_produit" method="post" enctype="multipart/form-data">
        @csrf
        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="py-3 mb-0">
                    <span class="text-muted fw-light">Produits /</span><span class="fw-medium"> Nouveau</span>
                </h4>

                <div class="app-ecommerce">
                    <!-- Add Product -->
                    <div
                        class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                        <div class="d-flex flex-column justify-content-center">
                            <h4 class="mb-1 mt-3">Ajouter un nouveau produit</h4>
                            <p class="text-muted">Orders placed across your store</p>
                        </div>
                        <div class="d-flex align-content-center flex-wrap gap-3">
                            <div class="d-flex gap-3">
                                <button class="btn btn-label-secondary">Discard</button>
                            </div>
                            <button type="submit" class="btn btn-primary">Publish product</button>
                        </div>
                    </div>

                    <div class="row">
                        <!-- First column-->
                        <div class="col-12 col-lg-8">
                            <!-- Product Information -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-tile mb-0">Informations du produit</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Nom du produit</label>
                                        <input type="text" class="form-control" required name="nom"
                                            value="{{ old('nom') }}" />
                                        @error('nom')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label class="form-label">Quantité de sécurité</label>
                                            <input type="number" class="form-control" required name="stock_securite"
                                                value="{{ old('stock_securite') }}" />
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
                                                value="{{ old('code_bar') }}" />
                                            @error('code_bar')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Description -->

                                    <div>
                                        <label class="form-label">Description (Optional)</label>
                                        <!-- Full Editor -->
                                        <textarea name="description" required id="editor" style="width: 100%;" rows="3"> </textarea>
                                        <!-- /Full Editor -->
                                        @error('description')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Pricing Card -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Prix</h5>
                                </div>
                                <div class="card-body">
                                    <!-- Base Price -->
                                    <div class="mb-3">
                                        <label class="form-label">Prix d'achat (HT) </label>
                                        <input type="number" class="form-control" id="prix_achat" required
                                            value="{{ old('prix_achat') }}" name="prix_achat" />
                                        @error('prix_achat')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Discounted Price -->
                                    <div class="mb-3">
                                        <label class="form-label">Prix de vente (HT) </label>
                                        <input type="number" class="form-control" id="prix_vente" required
                                            name="prix_vente" value="{{ old('prix_vente') }}" />
                                        @error('prix_vente')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="alert alert-danger hide" id="notfi_prix"></div>
                                </div>
                            </div>
                            <!-- /Pricing Card -->



                        </div>
                        <!-- /Second column -->

                        <!-- Second column -->
                        <div class="col-12 col-lg-4">
                            <!-- Media -->

                            <div class="card mb-4">
                                <h5 class="card-header">Images</h5>
                                <div class="card-body">
                                    <label for="form-label">Image de garde </label>
                                    <input name="file" type="file" class="form-control" required />
                                    @error('file')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <br>
                                    <label for="form-label">Autres images </label> <br>
                                    <span class="small text-warning"> 4 images Max / jpg,png,jpeg / Max 2 Mo</span>
                                    <input type="file" class="form-control" name="gallerie[]" multiple  />
                                    @error('gallerie')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- /Media -->


                        </div>


                    </div>
                    <!-- /Second column -->
                </div>
            </div>
        </div>
        <!-- / Content -->

        <div class="content-backdrop fade"></div>
        </div>
    </form>

    </body>
@section('css')
    <style>
        .file-upload {
            position: relative;
            overflow: hidden;
            margin: 10px;
        }

        .file-input {
            position: absolute;
            font-size: 100px;
            right: 0;
            top: 0;
            opacity: 0;
        }

        .file-label {
            display: block;
            padding: 20px;
            background-color: #3498db;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }

        .file-label span {
            display: block;
        }

        .file-label:hover {
            background-color: #2980b9;
        }

        .preview-image {
            max-width: 100%;
            margin-top: 10px;
        }
    </style>
    <!-- Core CSS -->
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
@endsection



<!-- Inclure Quill -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
@endsection



<script>
    $(document).ready(function() {
        $("#notfi_prix").hide();
        $("#prix_vente").on("input", function() {
            $("#notfi_prix").empty();
            var prix_vente = $(this).val();
            var prix_achat = $("#prix_achat").val();
            if (prix_achat > prix_vente) {
                $("#notfi_prix").show();
                $("#notfi_prix").append("Le prix de vente doit etre superieur au prix d'achat");
            } else {
                $("#notfi_prix").hide();
            }
        });
    });
</script>
<!-- Script d'initialisation textarea   -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var initialContent = {!! json_encode(old('description')) !!};

        var quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Enter your description here...',
        });

        if (initialContent) {
            quill.clipboard.dangerouslyPasteHTML(initialContent);
        }
    });
</script>
@endsection
