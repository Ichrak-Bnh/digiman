@extends('admin.nav')
@section('title', 'Liste des societes')
@section('content')

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row g-4 mb-4">
                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="content-left">
                                    <span>Sociétés</span>
                                    <div class="d-flex align-items-center my-2">
                                        <h3 class="mb-0 me-2">{{ $societes->count() }}</h3>
                                    </div>
                                    <p class="mb-0">Total Sociétés</p>
                                </div>
                                <div class="avatar">
                                    <span class="avatar-initial rounded bg-label-primary">
                                        <i class="ti ti-user ti-sm"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Users List Table -->
            <div class="card">
                <div class="card-header border-bottom">
                    <h5 class="card-title mb-3">Search Filter</h5>
                    <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
                        <div class="col-md-4 user_role"></div>
                        <div class="col-md-4 user_plan"></div>
                        <div class="col-md-4 user_status">
                            <a href="/admin/ajouter_societe">
                                <button type="button" class="btn btn-primary">
                                    <i class="fa-solid fa-plus"></i> &nbsp; Ajouter une société
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-datatable table-responsive">
                    <table class="datatables-users table">
                        <thead class="border-top">
                            <tr>
                                <th>avatar</th>
                                <th>Nom</th>
                                <th>email</th>
                                <th>Téléphone</th>
                                <th>Responsable</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        @forelse ($societes as $item)
                            <tr>
                                <td><img src="/uploads/{{ $item->avatar }}" alt="avatar" style="width: 100px" ></td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->telephone }}</td>
                                <td>{{ $item->nom_responsable }}</td>
                                <td>
                                    <a href="/admin/editer/{{ $item->id }}" title="Midifer la société {{ $item->nom }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="/admin/delete/{{ $item->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </table>
                </div>

            </div>
        </div>
        <!-- / Content -->


        <div class="content-backdrop fade"></div>
    </div>

@endsection
