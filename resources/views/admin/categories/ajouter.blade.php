@extends('admin.nav')
@section('title', 'Gestion des Catégories')
@section('content')


    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        {{ csrf_field() }}
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-0">
                <span class="text-muted fw-light">Catégories /</span><span class="fw-medium"> Gestion des categories</span>
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
                    <div class="col-sm-8 col-lg-8">
                        <!-- Product Information -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-tile mb-0">Details des Catégories</h5>
                            </div>
                            <div class="p-2">
                                <b>Total : </b> {{ $categories->count() }}
                            </div>
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead class="table-dark">
                                        <tr>
                                            <td>#</td>
                                            <td>Icône</td>
                                            <td>produits</td>
                                            <td>Titre</td>
                                            <td>Description</td>
                                            <td>Création</td>
                                            <td>Options</td>
                                        </tr>
                                    </thead>
                                    @forelse ($categories as $item)
                                        <tr id="tr-{{$item->id}}">
                                            <td></td>
                                            <td>
                                                <div class="avatar avatar me-2 rounded-2 bg-label-secondary" data-bs-toggle="modal" data-bs-target="#modal_prodit{{ $item->id}}">
                                                    <img src="/uploads/{{ $item->icone }}" class="rounded-2">
                                                </div>
                                            </td>
                                            <td> {{ $item->produits->count() }} </td>
                                            <td> {{ $item->titre }} </td>
                                            <td> {{ $item->description }} </td>
                                            <td> {{ $item->created_at }} </td>
                                            <td>
                                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#Edition{{ $item->id }}">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button class="btn btn-danger" onclick="delete_categorie({{$item->id}})">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                                @include('admin.composants.modal-edition-categorie', ["item"=>$item])
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">
                                                <div class="text-center alert alert-warning">
                                                    Aucune catégorie a afficher !
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </table>
                            </div>
                            <br><br>
                        </div>
                        <!-- /Product Information -->

                    </div>
                    <!-- /Second column -->
                    <div class="col-sm-4 col-lg-4">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-tile mb-0">Nouvelle catégorie</h5>
                            </div>
                            <div class="card-body">
                                <form id="form-ajout" action="/client/ajouter-categorie" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <label for="form-label">Titre</label>
                                <input type="text" name="titre" required value="{{ old("titre")}}" class="form-control" placeholder="titre de la catégorie">
                                @error('titre')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <br>
                                <label for="form-label">Icône <span class="text-warning">(png, svg, jpeg, jpg)</span> </label>
                                <input type="file" name="icone" required class="form-control" accept="image/png, image/jpeg, image/svg" >
                                @error('icone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                                <br>
                                <label for="form-label">Description</label>
                                <textarea name="description" required class="form-control" rows="3">{{ old("description") }}</textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <br>
                                <button type="submit" class="btn btn-primary"> Enregistrer </button>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    
            function delete_categorie(id){
                swal.fire({
                title: "Attention?",
                text: "La suppression de cette catégorie entrainera la suppression de ses produits !",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Oui, supprimer"
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'GET',
                        url: '/client/delete_categorie',
                        data: {
                            id: id
                        },
                        success: function(data) {
                            if(data.message){
                                Swal.fire({
                                title: "Félicitation !",
                                text: data.message ,
                                icon: "success"
                                });
                                $("#tr-"+id).hide("slow");
                            }else{
                                Swal.fire({
                                title: "Echec !",
                                text: data.erreur ,
                                icon: "error"
                                });
                            }
                        },
                        error: function(error) {
                            console.log('Erreur de requête AJAX : ', error);
                        }
                    });
                }
                });
            }

    </script>
@endsection
