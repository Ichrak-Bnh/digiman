@extends('admin.nav')
@section('title', 'Accueil')
@section('content')

    <script>
        function statistics(date) {
            alert(date);
        }
    </script>



    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <!-- View sales -->
                <div class="col-xl-4 mb-4 col-lg-5 col-12">
                    <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="col-7">
                                <div class="card-body text-nowrap">
                                    <h5 class="card-title mb-0">Congratulations <B>{{ Auth::user()->name }}</B> ! 🎉</h5>
                                    <p class="mb-2">Bienvenue sur Digiman !</p>
                                    <h4 class="text-primary mb-1">
                                        @if (auth()->user()->taxe == 'oui')
                                            {{ (auth()->user()->valeur_taxe / 100) * $montant_total_commande + $montant_total_commande }}
                                        @else
                                            {{ $montant_total_commande }}
                                        @endif
                                        DT
                                    </h4>
                                    <a href="/client/liste_commandes" class="btn btn-primary">Voir les commandes</a>
                                </div>
                            </div>
                            <div class="col-5 text-center text-sm-left">
                                <div class="card-body pb-0 px-0 px-md-4">
                                    <img src="/admin/assets/img/illustrations/card-advance-sale.png" height="140"
                                        alt="view sales" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- View sales -->


                <!-- Statistics -->
                <script>
                    $(document).on("click", "#btn-filter-statistics", function() {
                        $(this).hide("slow");
                        $("#form-statistics").show("slow");
                    });
                </script>
                <div class="col-xl-8 mb-4 col-lg-7 col-12">
                    <div class="card h-100">
                        <div class="card-header">
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="card-title mb-0">
                                    Statistiques
                                    @isset($statistics)
                                        <span class="small text-muted">( {{ $statistics['debut'] }}-{{ $statistics['fin'] }}
                                            )</span>
                                    @else
                                        <span class="small text-muted">( général )</span>
                                    @endisset
                                </h5>
                                <span id="btn-filter-statistics">
                                    <a href="#"><i class="fa-solid fa-filter"></i> filtre</a>
                                </span>
                                <form action="/client/statistics/" method="post" class="hide" id="form-statistics">
                                    @csrf
                                    <table>
                                        <tr>
                                            <td>
                                                <input type="date" name="debut" class="form-control-sm" required>
                                            </td>
                                            <td>
                                                <input type="date" name="fin" class="form-control-sm" required>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm " type="submit"
                                                    style="background-color: #1d9dd9;color:white;">
                                                    <i class="fa-solid fa-magnifying-glass"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row gy-3">
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded-pill bg-label-primary me-3 p-2">
                                            <i class="ti ti-chart-pie-2 ti-sm"></i>
                                        </div>
                                        <div class="card-info">
                                            <h5 class="mb-0">{{ $nombreProduitVendu }}</h5>
                                            <small>Produit vendus</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded-pill bg-label-info me-3 p-2">
                                            <i class="ti ti-users ti-sm"></i>
                                        </div>
                                        <div class="card-info">
                                            <h5 class="mb-0">{{ $nombreTotalClients }}</h5>
                                            <small>Clients</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded-pill bg-label-danger me-3 p-2">
                                            <i class="ti ti-shopping-cart ti-sm"></i>
                                        </div>
                                        <div class="card-info">
                                            <h5 class="mb-0">{{ $total_produits }}</h5>
                                            <small>Produits</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded-pill bg-label-success me-3 p-2">
                                            <i class="ti ti-currency-dollar ti-sm"></i>
                                        </div>
                                        <div class="card-info">
                                            <h5 class="mb-0" id="statistics_benefices">
                                                @if (auth()->user()->taxe == 'oui')
                                                    {{ (auth()->user()->valeur_taxe / 100) * $beneficeTotal[0]->benefice_total + $beneficeTotal[0]->benefice_total }}
                                                @else
                                                    {{ $beneficeTotal[0]->benefice_total }}
                                                @endif
                                                DT
                                            </h5>
                                            <small>Benefices</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Statistics -->

                <div class="col-xl-4 col-12">
                    <div class="row">
                        <!-- Expenses -->
                        <div class="col-xl-6 mb-4 col-md-3 col-6">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <h5 class="card-title mb-0">Taux de</h5>
                                    <small class="text-muted">livraison</small>
                                </div>
                                <div class="card-body">
                                    <div id="expensesChart" data-pourcent='{{ $tauxLivraison }}'></div>
                                    <div class="mt-md-2 text-center mt-lg-3 mt-3">
                                        <small class="text-muted mt-3">Taux total</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Expenses -->

                        <!-- Expenses 2-->
                        <div class="col-xl-6 mb-4 col-md-3 col-6">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <h5 class="card-title mb-0">Taux de</h5>
                                    <small class="text-muted">Retour </small>
                                </div>
                                <div class="card-body">
                                    <div id="expensesChart2" data-pourcent2='{{ $tauxRetour }}'></div>
                                    <div class="mt-md-2 text-center mt-lg-3 mt-3">
                                        <small class="text-muted mt-3">Taux total</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Expenses 2-->

                        <!-- Generated Leads -->
                        <div class="col-xl-12 mb-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex flex-column">
                                            <div class="card-title mb-auto">
                                                <h5 class="mb-1 text-nowrap">Etat général </h5>
                                                <small>des commandes</small>
                                            </div>
                                            <div class="chart-statistics">
                                                <h3 class="card-title mb-1">{{ $commandes->count() }}</h3>
                                                <small class="text-success text-nowrap fw-medium"><i
                                                        class="ti ti-chevron-up me-1"></i> :</small>
                                            </div>
                                        </div>
                                        <div id="generatedLeadsChart" data-labels='@json(array_column($statutsTotals, 'status'))'
                                            data-series='@json(array_column($statutsTotals, 'total'))'>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Generated Leads -->
                    </div>
                </div>

                <!-- Revenue Report -->
                <script>
                    $(document).ready(function() {
                        $('#dateSelect').on('change', function() {
                            $('#myFormDate').submit();
                        });
                    });
                </script>
                <div class="col-12 col-xl-8 mb-4">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="row row-bordered g-0">
                                <div class="col-md-8 position-relative p-4">
                                    <div class="card-header d-inline-block p-0 text-wrap position-absolute">
                                        <h5 class="m-0 card-title">Revenue Report</h5>
                                    </div>
                                    <div id="totalRevenueChart" data-revenus='@json($revenus)'
                                        data-revenus-max='{{ $max_revenue }}' class="mt-n1"></div>
                                </div>
                                <div class="col-md-4 p-4">
                                    <div class="text-center mt-4">
                                        <div class="dropdown">
                                            <form id="myFormDate" action="/client/Revenue" method="post">
                                                @csrf
                                                <select name="date" class="form-control-sm" id="dateSelect">
                                                    @isset($date_revenue)
                                                        <option value="{{ $date_revenue }}">{{ $date_revenue }}</option>
                                                    @endisset
                                                    <option value="{{ date('Y') }}">{{ date('Y') }}</option>
                                                    <option value="2024">2024</option>
                                                    <option value="2025">2025</option>
                                                    <option value="2026">2026</option>
                                                    <option value="2027">2027</option>
                                                    <option value="2028">2028</option>
                                                </select>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="text-center pt-4"> Total / Max </div>
                                    <h3 class="text-center pt-1 mb-0">{{ $revenusMensuelsTotal }} DT</h3>
                                    <p class="mb-4 text-center">
                                        @isset($date_revenue)
                                            <span class="fw-medium">Résutalt : {{ $date_revenue }}</span>
                                        @else
                                            <span class="fw-medium">{{ date('Y') }}</span>
                                        @endisset


                                    </p>
                                    <div class="px-3">
                                        <div id="reportBarChart2" data-revenus2='@json($revenus)'></div>
                                    </div>
                                    @isset($date_revenue)
                                        <div>

                                        </div>
                                    @endisset
                                    {{-- <div class="text-center mt-4">
                                        <button type="button" class="btn btn-primary">Increase Budget</button>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--/ Revenue Report -->

                <!-- Earning Reports -->
                <script>
                    $(document).on("click", "#btn-filter-Earning", function() {
                        $(this).hide("slow");
                        $("#form-Earning").show("slow");
                    });
                </script>
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between">
                            <div class="card-title mb-0">
                                <h5 class="m-0 me-2">Raport des gains</h5>
                                @isset($Earning)
                                    <small class="text-muted">Résultat :
                                        {{ $Earning['mois'] }}/{{ $Earning['annee'] }}</small>
                                @else
                                    <small class="text-muted">Général</small>
                                @endisset
                            </div>
                            <span id="btn-filter-Earning">
                                <a href="#"><i class="fa-solid fa-filter"></i> filtre</a>
                            </span>
                        </div>
                        <div class="card-body pb-0">
                            <form action="/client/Earning" method="post" id="form-Earning" class="hide">
                                @csrf
                                <table style="width: 100%;">
                                    <tr>
                                        <td>Mois</td>
                                        <td>Année</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select name="mois" required class="form-control">
                                                <option value="1">Janvier</option>
                                                <option value="2">Février</option>
                                                <option value="3">Mars</option>
                                                <option value="4">Avril</option>
                                                <option value="5">Mai</option>
                                                <option value="6">Juin</option>
                                                <option value="7">Juillet</option>
                                                <option value="8">Août</option>
                                                <option value="9">Septembre</option>
                                                <option value="10">Octobre</option>
                                                <option value="11">Novembre</option>
                                                <option value="12">Décembre</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="annee" id="" required class="form-control">
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                                <option value="2026">2026</option>
                                                <option value="2027">2027</option>
                                                <option value="2028">2028</option>
                                            </select>
                                        </td>
                                        <td>
                                            <button class="btn " type="submit"
                                                style="background-color: #1d9dd9;color:white;">
                                                <i class="fa-solid fa-magnifying-glass"></i> &nbsp;&nbsp;&nbsp; Filtrer
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <ul class="p-0 m-0">
                                <li class="d-flex mb-3">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-primary"><i
                                                class="ti ti-chart-pie-2 ti-sm"></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Net Profit</h6>
                                            <small class="text-muted">{{ $benefice[0]->benefice_total }} DT</small>
                                        </div>
                                        {{-- <div class="user-progress d-flex align-items-center gap-3">
                                            <small>$1,619</small>
                                            <div class="d-flex align-items-center gap-1">
                                                <i class="ti ti-chevron-up text-success"></i>
                                                <small class="text-muted">18.6%</small>
                                            </div>
                                        </div> --}}
                                    </div>
                                </li>
                                <li class="d-flex mb-3">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-success"><i
                                                class="ti ti-currency-dollar ti-sm"></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Recette</h6>
                                            <small class="text-muted">{{ $recette }} DT</small>
                                        </div>
                                        {{--  <div class="user-progress d-flex align-items-center gap-3">
                                            <small>$3,571</small>
                                            <div class="d-flex align-items-center gap-1">
                                                <i class="ti ti-chevron-up text-success"></i>
                                                <small class="text-muted">39.6%</small>
                                            </div>
                                        </div> --}}
                                    </div>
                                </li>
                            </ul>
                            <div id="reportBarChart"></div>
                        </div>
                    </div>
                </div>
                <!--/ Earning Reports -->

                <!-- Popular Product -->
                <div class="col-md-6 col-xl-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between">
                            <div class="card-title m-0 me-2">
                                <h5 class="m-0 me-2">Produits populaires</h5>
                                <small class="text-muted">classement par catégorie</small>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="nav-align-top">
                                <ul class="nav nav-tabs nav-fill" role="tablist">
                                    <li class="nav-item">
                                        <button type="button" class="nav-link active" role="tab"
                                            data-bs-toggle="tab" data-bs-target="#navs-justified-vente"
                                            aria-controls="navs-justified-vente" aria-selected="true">
                                            Par vente
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                            data-bs-target="#navs-justified-chiffre"
                                            aria-controls="navs-justified-chiffre" aria-selected="false">
                                            Chiffre d'affaire
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content pb-0">
                                    <div class="tab-pane fade show active" id="navs-justified-vente" role="tabpanel">
                                        <ul class="p-0 m-0">
                                            @forelse ($topProductsByQuantity as $item)
                                                <li class="d-flex mb-4 pb-1">
                                                    <div class="me-3">
                                                        <img src="/uploads/{{ $item->produit->photo }}" alt="User"
                                                            class="rounded" width="46" />
                                                    </div>
                                                    <div
                                                        class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                        <div class="me-2">
                                                            <h6 class="mb-0">
                                                                {{ substr($item->produit->nom, 0, 30) }}{{ strlen($item->produit->nom) > 30 ? '...' : '' }}
                                                            </h6>
                                                            <small class="text-muted d-block">Quantité : {{ $item->total_quantite }} <i>Unités</i> </small>
                                                        </div>
                                                    </div>
                                                </li>
                                            @empty
                                            @endforelse
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade show " id="navs-justified-chiffre" role="tabpanel">
                                        <ul class="p-0 m-0">
                                            @forelse ($topProductsByRevenue as $item)
                                                <li class="d-flex mb-4 pb-1">
                                                    <div class="me-3">
                                                        <img src="/uploads/{{ $item->produit->photo }}" alt="User"
                                                            class="rounded" width="46" />
                                                    </div>
                                                    <div
                                                        class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                        <div class="me-2">
                                                            <h6 class="mb-0">
                                                                {{ substr($item->produit->nom, 0, 30) }}{{ strlen($item->produit->nom) > 30 ? '...' : '' }}
                                                            </h6>
                                                            <small class="text-muted d-block">Chiffre d'affaire  : {{ $item->total_revenue }} DT</small>
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
                    </div>
                </div>
                <!--/ Popular Product -->

                <!-- Sales by Countries tabs-->
                <div class="col-md-6 col-xl-4 col-xl-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between pb-2 mb-1">
                            <div class="card-title mb-1">
                                <h5 class="m-0 me-2">Commades</h5>
                                <small class="text-muted">classement par catégorie</small>
                            </div>
                            {{--   <div class="dropdown">
                                <button class="btn p-0" type="button" id="salesByCountryTabs" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="salesByCountryTabs">
                                    <a class="dropdown-item" href="javascript:void(0);">Download</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                </div>
                            </div> --}}
                        </div>
                        <div class="card-body">
                            <div class="nav-align-top">
                                <ul class="nav nav-tabs nav-fill" role="tablist">
                                    <li class="nav-item">
                                        <button type="button" class="nav-link active" role="tab"
                                            data-bs-toggle="tab" data-bs-target="#navs-justified-new"
                                            aria-controls="navs-justified-new" aria-selected="true">
                                            Gouvernorat
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                            data-bs-target="#navs-justified-link-shipping"
                                            aria-controls="navs-justified-link-shipping" aria-selected="false">
                                            Clients
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content pb-0">
                                    <div class="tab-pane fade show active" id="navs-justified-new" role="tabpanel">
                                        <ul class="p-0 m-0">
                                            @forelse ($topGouvernorats as $item)
                                                <li class="d-flex mb-3">
                                                    <div class="avatar flex-shrink-0 me-3">
                                                        <span class="avatar-initial rounded bg-label-primary">
                                                            <i class="fa-solid fa-location-dot"></i>
                                                        </span>
                                                    </div>
                                                    <div
                                                        class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                        <div class="me-2">
                                                            <h6 class="mb-0">{{ $item->gouvernerat }}</h6>
                                                            <small class="text-muted"> Montant :
                                                                <b>{{ $item->total_achats }} </b> DT</small>
                                                        </div>
                                                        {{--  <div class="user-progress d-flex align-items-center gap-3">
                                                            <small>$1,619</small>
                                                            <div class="d-flex align-items-center gap-1">
                                                                <i class="ti ti-chevron-up text-success"></i>
                                                                <small class="text-muted">18.6%</small>
                                                            </div>
                                                        </div> --}}
                                                    </div>
                                                @empty
                                            @endforelse
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="navs-justified-link-shipping" role="tabpanel">
                                        <ul class="p-0 m-0">
                                            @forelse ($topClients as $item)
                                                <li class="d-flex mb-3">
                                                    <div class="avatar flex-shrink-0 me-3">
                                                        <span class="avatar-initial rounded bg-label-primary">
                                                            <i class="fa-solid fa-user"></i>
                                                        </span>
                                                    </div>
                                                    <div
                                                        class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                        <div class="me-2">
                                                            <h6 class="mb-0">{{ $item->nom_client }}</h6>
                                                            <small class="text-muted">Montant :
                                                                {{ $item->total_achats }} DT</small>
                                                        </div>
                                                        {{--  <div class="user-progress d-flex align-items-center gap-3">
                                                            <small>$1,619</small>
                                                            <div class="d-flex align-items-center gap-1">
                                                                <i class="ti ti-chevron-up text-success"></i>
                                                                <small class="text-muted">18.6%</small>
                                                            </div>
                                                        </div> --}}
                                                    </div>
                                                @empty
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Sales by Countries tabs -->
            </div>
        </div>
        <!-- / Content -->

    </div>
    <!-- Content wrapper -->


@endsection
