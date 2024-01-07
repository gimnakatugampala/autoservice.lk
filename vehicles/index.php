<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sash – Bootstrap 5  Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords" content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/brand/favicon.ico">

    <!-- TITLE -->
    <title>Sash – Bootstrap 5 Admin & Dashboard Template</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- STYLE CSS -->
     <link href="../assets/css/style.css" rel="stylesheet">

	<!-- Plugins CSS -->
    <link href="../assets/css/plugins.css" rel="stylesheet">

    <!--- FONT-ICONS CSS -->
    <link href="../assets/css/icons.css" rel="stylesheet">

    <!-- INTERNAL Switcher css -->
    <link href="../assets/switcher/css/switcher.css" rel="stylesheet">
    <link href="../assets/switcher/demo.css" rel="stylesheet">

</head>

<body class="app sidebar-mini ltr light-mode">

    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="../assets/images/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            <!-- app-Header -->
            <?php include_once '../includes/app-header.php';?>
            <!-- /app-Header -->

            <!--APP-SIDEBAR-->
            <?php include_once '../includes/sidebar.php'; ?>
            <!--/APP-SIDEBAR-->

            <!--app-content open-->
            <div class="main-content app-content mt-0">
                <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">

                        <!-- PAGE-HEADER -->
                        <div class="page-header">
                            <h1 class="page-title">Vehicles</h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Manage Vehicles</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Vehicles</li>
                                </ol>

                                <div class="mt-4">
                                    <a href="../vehicles/add-vehicle.php" class="btn btn-primary"><i class="fa fa-plus" ></i> Add Vehicle</a>
                                </div>

                            </div>

                            
                        </div>
                        <!-- PAGE-HEADER END -->
                        
                        
                        <!-- Row -->
                        <div class="row row-sm">
                          
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">All Vehicles</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom">
                                                <thead>
                                                    <tr>
                                                        <th class="border-bottom-0">ID</th>
                                                        <th class="border-bottom-0">Vehicle Number</th>
                                                        <th class="border-bottom-0">Vehicle Type</th>
                                                        <th class="border-bottom-0">Model</th>
                                                        <th class="border-bottom-0">Owner</th>
                                                        <th class="border-bottom-0">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>56</td>
                                                        <td>KY-3038</td>
                                                        <td>Sedan</td>
                                                        <td>FIT</td>
                                                        <td>Gimna Katugampala</td>
                                                        <td>
                                                            <a href="../vehicles/vehicle-details.php" class="btn btn-primary"><i class="fa fa-eye"></i></a>

                                                            <a href="../vehicles/edit-vehicle.php" class="btn btn-info"><i class="fa fa-pencil" ></i></a>
                                                        </td>
                                                    </tr>
                                                  
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Row -->


                    </div>
                    <!-- CONTAINER CLOSED -->

                </div>
            </div>
            <!--app-content closed-->
        </div>

        <!-- Sidebar-right -->
        <?php include_once '../includes/right-sidebar.php';?>
        <!--/Sidebar-right-->

        <!-- Country-selector modal-->
        <div class="modal fade" id="country-selector">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content country-select-modal">
                    <div class="modal-header">
                        <h6 class="modal-title">Choose Country</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <ul class="row p-3">
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block active">
                                    <span class="country-selector"><img alt="" src="../assets/images/flags-img/us_flag.jpg"
                                            class="me-3 language"></span>USA
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                        src="../assets/images/flags-img/italy_flag.jpg"
                                        class="me-3 language"></span>Italy
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                        src="../assets/images/flags-img/spain_flag.jpg"
                                        class="me-3 language"></span>Spain
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                        src="../assets/images/flags-img/india_flag.jpg"
                                        class="me-3 language"></span>India
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                        src="../assets/images/flags-img/french_flag.jpg"
                                        class="me-3 language"></span>French
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                        src="../assets/images/flags-img/russia_flag.jpg"
                                        class="me-3 language"></span>Russia
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                        src="../assets/images/flags-img/germany_flag.jpg"
                                        class="me-3 language"></span>Germany
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                        src="../assets/images/flags-img/argentina.jpg"
                                        class="me-3 language"></span>Argentina
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt="" src="../assets/images/flags-img/malaysia.jpg"
                                        class="me-3 language"></span>Malaysia
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt="" src="../assets/images/flags-img/turkey.jpg"
                                        class="me-3 language"></span>Turkey
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Country-selector modal-->

        <!-- FOOTER -->
        <?php include_once '../includes/footer.php';?>
        <!-- FOOTER CLOSED -->
    </div>

    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

    <!-- JQUERY JS -->
    <script src="../assets/js/jquery.min.js"></script>

    <!-- BOOTSTRAP JS -->
    <script src="../assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- INPUT MASK JS-->
    <script src="../assets/plugins/input-mask/jquery.mask.min.js"></script>

	<!-- TypeHead js -->
	<script src="../assets/plugins/bootstrap5-typehead/autocomplete.js"></script>
    <script src="../assets/js/typehead.js"></script>

    <!-- INTERNAL SELECT2 JS -->
    <script src="../assets/plugins/select2/select2.full.min.js"></script>

    <!-- DATA TABLE JS-->
    <script src="../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="../assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
    <script src="../assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
    <script src="../assets/plugins/datatable/js/buttons.bootstrap5.min.js"></script>
    <script src="../assets/plugins/datatable/js/jszip.min.js"></script>
    <script src="../assets/plugins/datatable/pdfmake/pdfmake.min.js"></script>
    <script src="../assets/plugins/datatable/pdfmake/vfs_fonts.js"></script>
    <script src="../assets/plugins/datatable/js/buttons.html5.min.js"></script>
    <script src="../assets/plugins/datatable/js/buttons.print.min.js"></script>
    <script src="../assets/plugins/datatable/js/buttons.colVis.min.js"></script>
    <script src="../assets/plugins/datatable/dataTables.responsive.min.js"></script>
    <script src="../assets/plugins/datatable/responsive.bootstrap5.min.js"></script>
    <script src="../assets/js/table-data.js"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="../assets/plugins/p-scroll/perfect-scrollbar.js"></script>
    <script src="../assets/plugins/p-scroll/pscroll.js"></script>
    <script src="../assets/plugins/p-scroll/pscroll-1.js"></script>

    <!-- SIDE-MENU JS -->
    <script src="../assets/plugins/sidemenu/sidemenu.js"></script>

    <!-- SIDEBAR JS -->
    <script src="../assets/plugins/sidebar/sidebar.js"></script>

    <!-- Color Theme js -->
    <script src="../assets/js/themeColors.js"></script>

    <!-- Sticky js -->
    <script src="../assets/js/sticky.js"></script>

    <!-- CUSTOM JS -->
    <script src="../assets/js/custom.js"></script>

    <!-- Custom-switcher -->
    <script src="../assets/js/custom-swicher.js"></script>

    <!-- Switcher js -->
    <script src="../assets/switcher/js/switcher.js"></script>

</body>

</html>