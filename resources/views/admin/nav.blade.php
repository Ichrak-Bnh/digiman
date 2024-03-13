<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-assets-path="/admin/assets/" data-template="vertical-menu-template-no-customizer">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title')</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/img/icon1.svg" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="/admin/assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/admin/assets/vendor/css/rtl/core.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/css/rtl/theme-default.css" />
    <link rel="stylesheet" href="/admin/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/admin/assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/swiper/swiper.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="/admin/assets/vendor/css/pages/cards-advance.css" />

    <!-- Helpers -->
    <script src="/admin/assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/admin/assets/js/config.js"></script>
        <style>
            .hide{
                display: none;
            }
        </style>
    @yield('css')
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                @role('client')
                <div class="app-brand demo">
                    <a href="/index" class="app-brand-link">
                        <img src="/img/logo1.png" alt="" srcset="" style="width: 100%">
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                        <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
                        <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboards -->
                    <li class="menu-item  {{ request()->is('index') ? 'active open' : '' }}">
                        <a href="/index" class="menu-link ">
                            <i class="menu-icon tf-icons ti ti-smart-home"></i>
                            <div data-i18n="Dashboards">Dashboards</div>
                        </a>
                    </li>
                @endrole


                @role('admin')
                <div class="app-brand demo">
                    <a href="/index_admin" class="app-brand-link">
                        <img src="/img/logo1.png" alt="" srcset="" style="width: 100%">
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                        <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
                        <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>
                
                <ul class="menu-inner py-1">
                    <!-- Dashboards -->
                    <li class="menu-item  {{ request()->is('index') ? 'active open' : '' }}">
                        <a href="/index_admin" class="menu-link ">
                            <i class="menu-icon tf-icons ti ti-smart-home"></i>
                            <div data-i18n="Dashboards">Dashboards</div>
                        </a>
                    </li>
                @endrole


                    @role('admin')
                        <!-- Gestion des societes -->
                        <li class="menu-header small text-uppercase ">
                            <span class="menu-header-text">Gestion des Sociétés</span>
                        </li>
                        <!-- Layouts -->
                        <li class="menu-item ">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-layout-sidebar"></i>
                                <div data-i18n="Sociétés">Sociétés</div>
                            </a>

                            <ul class="menu-sub">
                                <li class="menu-item">
                                    <a href="/admin/ajouter_societe" class="menu-link ">
                                        <div data-i18n="Ajouter une société">Ajouter une société</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="/admin/liste_societe" class="menu-link">
                                        <div data-i18n="Liste des sociétés">Liste des sociétés</div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endrole

                    @role('client')
                        <!-- Gestion des produits -->
                        <li class="menu-header small text-uppercase ">
                            <span class="menu-header-text">Gestion des Produits</span>
                        </li>
                        <!-- Layouts -->
                        <li class="menu-item {{ request()->is('client/liste_produit','client/ajouter_produit') ? 'active open' : '' }}">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-layout-sidebar"></i>
                                <div data-i18n="Produits">Produits</div>
                            </a>

                            <ul class="menu-sub">
                                <li class="menu-item">
                                    <a href="/client/ajouter_produit" class="menu-link ">
                                        <div data-i18n="Ajouter un produit">Ajouter un produit</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="/client/liste_produit" class="menu-link">
                                        <div data-i18n="Liste des produits">Liste des produits</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="/client/gestion_categories" class="menu-link">
                                        <div data-i18n="Gestion des catégories">Gestion des catégories</div>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Gestion  du stock -->
                        <li class="menu-header small text-uppercase ">
                            <span class="menu-header-text">Gestion du stock</span>
                        </li>
                        <!-- Layouts -->
                        <li class="menu-item ">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="fa-solid fa-cubes-stacked menu-icon"></i>
                                <div data-i18n="Stock">Stock</div>
                            </a>

                            <ul class="menu-sub">
                                <li class="menu-item">
                                    <a href="/client/ajout_rapide" class="menu-link">
                                        <div data-i18n="Ajout rapide">Ajout rapide</div>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Gestion des commades-->
                        <li class="menu-header small text-uppercase ">
                            <span class="menu-header-text">Gestion des commandes</span>
                        </li>
                        <!-- Layouts -->
                        <li class="menu-item ">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="fa-solid fa-cart-shopping menu-icon"></i>
                                <div data-i18n="Commandes">Commandes</div>
                            </a>

                            <ul class="menu-sub">
                                <li class="menu-item">
                                    <a href="/client/liste_commandes" class="menu-link ">
                                        <div data-i18n="Liste des commades">Liste des commades</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="/client/ajout_commande" class="menu-link">
                                        <div data-i18n="Nouvelle commande">Nouvelle commande</div>
                                    </a>
                                </li>
                            </ul>
                        </li>


                    @endrole


                </ul>
            </aside>
            <!-- / Menu -->
            <!-- Layout container -->
            <div class="layout-page">
                @include('admin.navbar')
                @include('admin.composants.toasts')
                @yield('content')
            </div>
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->







    <script src="/admin/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/admin/assets/vendor/libs/popper/popper.js"></script>
    <script src="/admin/assets/vendor/js/bootstrap.js"></script>
    <script src="/admin/assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="/admin/assets/vendor/libs/hammer/hammer.js"></script>
    <script src="/admin/assets/vendor/libs/i18n/i18n.js"></script>
    <script src="/admin/assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="/admin/assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="/admin/assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="/admin/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>

    <!-- Main JS -->
    <script src="/admin/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="/admin/assets/js/app-ecommerce-dashboard.js"></script>

    <script src="/admin/assets/js/app-ecommerce-product-add.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('js')
</body>

</html>
