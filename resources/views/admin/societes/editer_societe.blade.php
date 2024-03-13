@extends('admin.nav')
@section('title', 'Editer une societe '.$societe->nom)
@section('content')


    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <form action="/admin/update_societe" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{$societe->id}}">
            {{ csrf_field() }}
            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="py-3 mb-0">
                    <span class="text-muted fw-light">Société /</span><span class="fw-medium"> Editer une société</span>
                </h4>

                <div class="app-ecommerce">
                    <!-- Add Product -->
                    <div
                        class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                        <div class="d-flex flex-column justify-content-center">
                            <h4 class="mb-1 mt-3">Editer une société <b>" {{ $societe->nom }} "</b></h4>
                            <p class="text-muted">Veuillez renseigner tous les détails</p>
                        </div>
                        <div class="d-flex align-content-center flex-wrap gap-3">
                            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                        </div>
                    </div>

                    <div class="row">
                        <!-- First column-->
                        <div class="col-12 col-lg-8">
                            <!-- Product Information -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-tile mb-0">Details de la société</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Nom de la société</label>
                                        <input type="text" class="form-control" required placeholder="E-build"
                                            name="name" value="{{ old('name', $societe->name ) }}" />
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" required
                                                placeholder="E-build@contact.com" name="email"
                                                value="{{ old('email', $societe->email) }}" />
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Nom du Responsable</label>
                                            <input type="text" class="form-control" required placeholder="thomas"
                                                name="nom_responsable" value="{{ old('nom_responsable', $societe->nom_responsable) }} "/>
                                            @error('nom_responsable')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label class="form-label">Numero de telephone</label>
                                            <input type="number" class="form-control" required placeholder="54 235 489"
                                                name="telephone" value="{{ old('telephone',$societe->telephone) }}" />
                                            @error('telephone')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Product Information -->

                        </div>
                        <!-- /Second column -->

                        <!-- Second column -->
                        <div class="col-12 col-lg-4">
                            <!-- Media -->
                            <div class="card mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 card-title">Logo</h5>
                                </div>
                                <div class="card-body">
                                    <div class="dz-message needsclick">
                                       <img src="/uploads/{{$societe->avatar}}" alt="" style="width: 50%" srcset="">
                                    </div>
                                    <hr>
                                    <div class="fallback">
                                        <input name="avatar" accept="images/*" type="file"/>
                                    </div>
                                    @error('avatar')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- /Media -->

                        </div>
                        <!-- /Second column -->
                    </div>
                </div>
            </div>
        </form>
        <!-- / Content -->

        <div class="content-backdrop fade"></div>
    </div>
@endsection
