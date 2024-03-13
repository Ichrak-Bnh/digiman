@extends('admin.nav')
@section('title', 'Details de la commande')
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-2"><span class="text-muted fw-light">eCommerce /</span> Order Details</h4>

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
                        <div class="card-datatable table-responsive">
                            <table class="datatables-order-details table border-top">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th class="w-50">products</th>
                                        <th class="w-25">price</th>
                                        <th class="w-25">qty</th>
                                        <th>total</th>
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
                                        <td>
                                            @if (empty($commande->motif))
                                                {{ $item->nom }}
                                            @else
                                                <span class="text-danger"> {{ $item->nom }}</span>
                                            @endif

                                        </td>
                                        <td>{{ $item->prix_unitaire }} DT</td>
                                        <td>{{ $item->quantite }}</td>
                                        <td>{{ $item->quantite * $item->prix_unitaire }} DT</td>
                                        <td></td>
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
                                        <h6 class="mb-0">{{ $total }} DT</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (!empty($commande->motif))
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between">
                                <h6 class="card-title m-0 text-danger">Motif du retour</h6>
                            </div>
                            <div class="card-body">
                                <p class="mb-0">{{ $commande->motif }}</p>
                            </div>
                        </div>
                    @endif
                </div>
                @isset($commande)
                <div class="col-12 col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="card-title m-0">Customer details</h6>
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
                            <div class="d-flex justify-content-start align-items-center mb-4">
                                <span
                                    class="avatar rounded-circle bg-label-success me-2 d-flex align-items-center justify-content-center"><i
                                        class="ti ti-shopping-cart ti-sm"></i></span>
                                <h6 class="text-body text-nowrap mb-0">{{$total_commande_client}} commandes</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6>Contact info</h6>
                            </div>
                            <p class="mb-1">Email: {{ $commande->email }}</p>
                            <p class="mb-0">Mobile: {{ $commande->telephone }}</p>
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





@endsection
