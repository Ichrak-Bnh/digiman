@extends('admin.nav')
@section('title', 'Suivie de produit produits')
@section('content')

    <!-- Content wrapper -->
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Suivie /</span>{{ $produit->nom }}</h4>

            <div class="row">
                <!-- Timeline Basic-->
                <div class="col-xl-6 mb-4 mb-xl-0">
                    <div class="card">
                        <h5 class="card-header">Recharge du stock <span class="small">( {{$recharges->count()}} )</span>  </h5>
                        <div class="card-body pb-0">
                            <ul class="timeline mb-0">
                                @forelse ($recharges as $item)
                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point timeline-point-success"></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header border-bottom mb-3">
                                                <h6 class="mb-0">{{ $produit->nom }}</h6>
                                                <span class="text-muted">{{ $item->created_at }}</span>
                                            </div>
                                            <div class="d-flex justify-content-between flex-wrap mb-2">
                                                <div class="d-flex align-items-center">
                                                    <span>Recharge en stock</span>
                                                    <i class="ti ti-arrow-right scaleX-n1-rtl mx-3"></i>
                                                </div>
                                                <div>
                                                    <span class="text-success">{{ $item->quantite }} Unité</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Timeline Basic -->

                <!-- Timeline Advanced-->
                <div class="col-xl-6">
                    <div class="card">
                        <h5 class="card-header">Vente du produit <span class="small">( {{$ventes->count()}} )</span> </h5>
                        <div class="card-body pb-0">
                            <ul class="timeline pt-3">
                                @forelse ($ventes as $item)
                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point timeline-point-danger"></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header border-bottom mb-3">
                                                <h6 class="mb-0">{{ $produit->nom }}</h6>
                                                <span class="text-muted">{{ $item->created_at }}</span>
                                            </div>
                                            <div class="d-flex justify-content-between flex-wrap mb-2">
                                                <div class="d-flex align-items-center">
                                                    <span>Vente du produit</span>
                                                    <i class="ti ti-arrow-right scaleX-n1-rtl mx-3"></i>
                                                </div>
                                                <div>
                                                    <span class="text-danger"> -{{ $item->quantite }} Unité</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Timeline Advanced-->
        </div>
    </div>
    <!-- / Content -->


    <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
@endsection
