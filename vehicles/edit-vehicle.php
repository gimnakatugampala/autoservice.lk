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
                            <h1 class="page-title">Edit Vehicle</h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Manage Vehicle</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Vehicle</li>
                                </ol>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

            
                        <!--Row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Vehicle Number <span class="text-red">*</span></label>
                                                    <input type="text" class="form-control" placeholder="KY-3038">
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                            <label class="form-label">Vehicle Type <span class="text-red">*</span></label>
                                            <select class="form-control select2" data-placeholder="Choose one (with optgroup)">
                                                    <optgroup label="Mountain Time Zone">
                                                        <option value="AZ">Arizona</option>
                                                        <option value="CO">Colorado</option>
                                                        <option value="ID">Idaho</option>
                                                        <option value="MT">Montana</option><option value="NE">Nebraska</option>
                                                        <option value="NM">New Mexico</option>
                                                        <option value="ND">North Dakota</option>
                                                        <option value="UT">Utah</option>
                                                        <option value="WY">Wyoming</option>
                                                    </optgroup>
                                                    <optgroup label="Central Time Zone">
                                                        <option value="AL">Alabama</option>
                                                        <option value="AR">Arkansas</option>
                                                        <option value="IL">Illinois</option>
                                                        <option value="IA">Iowa</option>
                                                        <option value="KS">Kansas</option>
                                                        <option value="KY">Kentucky</option>
                                                        <option value="LA">Louisiana</option>
                                                        <option value="MN">Minnesota</option>
                                                        <option value="MS">Mississippi</option>
                                                        <option value="MO">Missouri</option>
                                                        <option value="OK">Oklahoma</option>
                                                        <option value="SD">South Dakota</option>
                                                        <option value="TX">Texas</option>
                                                        <option value="TN">Tennessee</option>
                                                        <option value="WI">Wisconsin</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                            <label class="form-label">Vehicle Sub Type <span class="text-red">*</span></label>
                                            <select class="form-control select2" data-placeholder="Choose one (with optgroup)">
                                                    <optgroup label="Mountain Time Zone">
                                                        <option value="AZ">Arizona</option>
                                                        <option value="CO">Colorado</option>
                                                        <option value="ID">Idaho</option>
                                                        <option value="MT">Montana</option><option value="NE">Nebraska</option>
                                                        <option value="NM">New Mexico</option>
                                                        <option value="ND">North Dakota</option>
                                                        <option value="UT">Utah</option>
                                                        <option value="WY">Wyoming</option>
                                                    </optgroup>
                                                    <optgroup label="Central Time Zone">
                                                        <option value="AL">Alabama</option>
                                                        <option value="AR">Arkansas</option>
                                                        <option value="IL">Illinois</option>
                                                        <option value="IA">Iowa</option>
                                                        <option value="KS">Kansas</option>
                                                        <option value="KY">Kentucky</option>
                                                        <option value="LA">Louisiana</option>
                                                        <option value="MN">Minnesota</option>
                                                        <option value="MS">Mississippi</option>
                                                        <option value="MO">Missouri</option>
                                                        <option value="OK">Oklahoma</option>
                                                        <option value="SD">South Dakota</option>
                                                        <option value="TX">Texas</option>
                                                        <option value="TN">Tennessee</option>
                                                        <option value="WI">Wisconsin</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                            </div>

                                            <div class="col-md-6">
                                            <div class="form-group">
                                            <label class="form-label">Manufacturer <span class="text-red">*</span></label>
                                            <select class="form-control select2" data-placeholder="Choose one (with optgroup)">
                                                    <optgroup label="Mountain Time Zone">
                                                        <option value="AZ">Arizona</option>
                                                        <option value="CO">Colorado</option>
                                                        <option value="ID">Idaho</option>
                                                        <option value="MT">Montana</option><option value="NE">Nebraska</option>
                                                        <option value="NM">New Mexico</option>
                                                        <option value="ND">North Dakota</option>
                                                        <option value="UT">Utah</option>
                                                        <option value="WY">Wyoming</option>
                                                    </optgroup>
                                                    <optgroup label="Central Time Zone">
                                                        <option value="AL">Alabama</option>
                                                        <option value="AR">Arkansas</option>
                                                        <option value="IL">Illinois</option>
                                                        <option value="IA">Iowa</option>
                                                        <option value="KS">Kansas</option>
                                                        <option value="KY">Kentucky</option>
                                                        <option value="LA">Louisiana</option>
                                                        <option value="MN">Minnesota</option>
                                                        <option value="MS">Mississippi</option>
                                                        <option value="MO">Missouri</option>
                                                        <option value="OK">Oklahoma</option>
                                                        <option value="SD">South Dakota</option>
                                                        <option value="TX">Texas</option>
                                                        <option value="TN">Tennessee</option>
                                                        <option value="WI">Wisconsin</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                            </div>

                                            <div class="col-md-6">
                                            <div class="form-group">
                                            <label class="form-label">Manufacture Country <span class="text-red">*</span></label>
                                            <select class="form-control select2" data-placeholder="Choose one (with optgroup)">
                                                    <optgroup label="Mountain Time Zone">
                                                        <option value="AZ">Arizona</option>
                                                        <option value="CO">Colorado</option>
                                                        <option value="ID">Idaho</option>
                                                        <option value="MT">Montana</option><option value="NE">Nebraska</option>
                                                        <option value="NM">New Mexico</option>
                                                        <option value="ND">North Dakota</option>
                                                        <option value="UT">Utah</option>
                                                        <option value="WY">Wyoming</option>
                                                    </optgroup>
                                                    <optgroup label="Central Time Zone">
                                                        <option value="AL">Alabama</option>
                                                        <option value="AR">Arkansas</option>
                                                        <option value="IL">Illinois</option>
                                                        <option value="IA">Iowa</option>
                                                        <option value="KS">Kansas</option>
                                                        <option value="KY">Kentucky</option>
                                                        <option value="LA">Louisiana</option>
                                                        <option value="MN">Minnesota</option>
                                                        <option value="MS">Mississippi</option>
                                                        <option value="MO">Missouri</option>
                                                        <option value="OK">Oklahoma</option>
                                                        <option value="SD">South Dakota</option>
                                                        <option value="TX">Texas</option>
                                                        <option value="TN">Tennessee</option>
                                                        <option value="WI">Wisconsin</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                            </div>

                                            <div class="col-md-6">
                                            <div class="form-group">
                                            <label class="form-label">Fuel Type <span class="text-red">*</span></label>
                                            <select class="form-control select2" data-placeholder="Choose one (with optgroup)">
                                                    <optgroup label="Mountain Time Zone">
                                                        <option value="AZ">Arizona</option>
                                                        <option value="CO">Colorado</option>
                                                        <option value="ID">Idaho</option>
                                                        <option value="MT">Montana</option><option value="NE">Nebraska</option>
                                                        <option value="NM">New Mexico</option>
                                                        <option value="ND">North Dakota</option>
                                                        <option value="UT">Utah</option>
                                                        <option value="WY">Wyoming</option>
                                                    </optgroup>
                                                    <optgroup label="Central Time Zone">
                                                        <option value="AL">Alabama</option>
                                                        <option value="AR">Arkansas</option>
                                                        <option value="IL">Illinois</option>
                                                        <option value="IA">Iowa</option>
                                                        <option value="KS">Kansas</option>
                                                        <option value="KY">Kentucky</option>
                                                        <option value="LA">Louisiana</option>
                                                        <option value="MN">Minnesota</option>
                                                        <option value="MS">Mississippi</option>
                                                        <option value="MO">Missouri</option>
                                                        <option value="OK">Oklahoma</option>
                                                        <option value="SD">South Dakota</option>
                                                        <option value="TX">Texas</option>
                                                        <option value="TN">Tennessee</option>
                                                        <option value="WI">Wisconsin</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                            </div>

                                            <div class="col-md-6">
                                            <div class="form-group">
                                            <label class="form-label">Model <span class="text-red">*</span></label>
                                            <select class="form-control select2" data-placeholder="Choose one (with optgroup)">
                                                    <optgroup label="Mountain Time Zone">
                                                        <option value="AZ">Arizona</option>
                                                        <option value="CO">Colorado</option>
                                                        <option value="ID">Idaho</option>
                                                        <option value="MT">Montana</option><option value="NE">Nebraska</option>
                                                        <option value="NM">New Mexico</option>
                                                        <option value="ND">North Dakota</option>
                                                        <option value="UT">Utah</option>
                                                        <option value="WY">Wyoming</option>
                                                    </optgroup>
                                                    <optgroup label="Central Time Zone">
                                                        <option value="AL">Alabama</option>
                                                        <option value="AR">Arkansas</option>
                                                        <option value="IL">Illinois</option>
                                                        <option value="IA">Iowa</option>
                                                        <option value="KS">Kansas</option>
                                                        <option value="KY">Kentucky</option>
                                                        <option value="LA">Louisiana</option>
                                                        <option value="MN">Minnesota</option>
                                                        <option value="MS">Mississippi</option>
                                                        <option value="MO">Missouri</option>
                                                        <option value="OK">Oklahoma</option>
                                                        <option value="SD">South Dakota</option>
                                                        <option value="TX">Texas</option>
                                                        <option value="TN">Tennessee</option>
                                                        <option value="WI">Wisconsin</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Year <span class="text-red">*</span></label>
                                                    <select name="user[year]" class="form-control form-select select2" data-bs-placeholder="Select Year">
                                                            <option label="Select Year">Year</option>
                                                            <option value="2014">2040</option>
                                                            <option value="2014">2039</option>
                                                            <option value="2014">2037</option>
                                                            <option value="2014">2036</option>
                                                            <option value="2014">2035</option>
                                                            <option value="2014">2034</option>
                                                            <option value="2014">2033</option>
                                                            <option value="2014">2032</option>
                                                            <option value="2014">2031</option>
                                                            <option value="2014">2030</option>
                                                            <option value="2014">2030</option>
                                                            <option value="2013">2029</option>
                                                            <option value="2012">2028</option>
                                                            <option value="2011">2027</option>
                                                            <option value="2010">2026</option>
                                                            <option value="2009">2025</option>
                                                            <option value="2008">2024</option>
                                                            <option value="2007">2023</option>
                                                            <option value="2006">2022</option>
                                                            <option value="2005">2021</option>
                                                            <option value="2004">2020</option>
                                                            <option value="2003">2019</option>
                                                            <option value="2002">2018</option>
                                                        </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Select Vehicle Owner <span class="text-red">*</span></label>
                                                    <select name="user[year]" class="form-control form-select select2" data-bs-placeholder="Select Year">
                                                            <option label="Select Vehicle Owner">Select Vehicle Owner</option>
                                                            <option value="2014">2040</option>
                                                            <option value="2014">2039</option>
                                                            <option value="2014">2037</option>
                                                            <option value="2014">2036</option>
                                                            <option value="2014">2035</option>
                                                            <option value="2014">2034</option>
                                                            <option value="2014">2033</option>
                                                            <option value="2014">2032</option>
                                                            <option value="2014">2031</option>
                                                            <option value="2014">2030</option>
                                                            <option value="2014">2030</option>
                                                            <option value="2013">2029</option>
                                                            <option value="2012">2028</option>
                                                            <option value="2011">2027</option>
                                                            <option value="2010">2026</option>
                                                            <option value="2009">2025</option>
                                                            <option value="2008">2024</option>
                                                            <option value="2007">2023</option>
                                                            <option value="2006">2022</option>
                                                            <option value="2005">2021</option>
                                                            <option value="2004">2020</option>
                                                            <option value="2003">2019</option>
                                                            <option value="2002">2018</option>
                                                        </select>
                                                </div>
                                            </div>

                                           

                                            <div class="col-md-6">

                                            <div class="form-group">
                                                    <label for="exampleInputEmail1" class="form-label">Engine Number</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Engine Number" autocomplete="Engine Number">
                                                </div>

                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Vehicle Color <span class="text-red">*</span></label>
                                                    <div>
                                                    <input id="colorpicker" type="text">
                                                </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 my-2">
                                            <label class="form-label">Vehicle Image</label>
                                                <input type="file" class="dropify" data-bs-height="180">
                                            </div>

                                     
                                            <div class="col-md-12">
                                                <button class="btn btn-default">Cancel</button>
                                                <button class="btn btn-primary">Update</button>
                                            </div>

                                         

                                        </div>
                                    </div>
                                </div>
                       
                            </div>
                        </div>
                        <!--End Row-->

                    
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
        <!-- FOOTER END -->

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

     <!-- FILE UPLOADES JS -->
     <script src="../assets/plugins/fileuploads/js/fileupload.js"></script>
    <script src="../assets/plugins/fileuploads/js/file-upload.js"></script>

    <!-- INTERNAL File-Uploads Js-->
    <script src="../assets/plugins/fancyuploder/jquery.ui.widget.js"></script>
    <script src="../assets/plugins/fancyuploder/jquery.fileupload.js"></script>
    <script src="../assets/plugins/fancyuploder/jquery.iframe-transport.js"></script>
    <script src="../assets/plugins/fancyuploder/jquery.fancy-fileupload.js"></script>
    <script src="../assets/plugins/fancyuploder/fancy-uploader.js"></script>

        <!-- TIMEPICKER JS -->
        <script src="../assets/plugins/time-picker/jquery.timepicker.js"></script>
    <script src="../assets/plugins/time-picker/toggles.min.js"></script>

    <!-- INTERNAL intlTelInput js-->
    <script src="../assets/plugins/intl-tel-input-master/intlTelInput.js"></script>
    <script src="../assets/plugins/intl-tel-input-master/country-select.js"></script>
    <script src="../assets/plugins/intl-tel-input-master/utils.js"></script>

    <!-- INTERNAL jquery transfer js-->
    <script src="../assets/plugins/jQuerytransfer/jquery.transfer.js"></script>


    <!-- INTERNAL SELECT2 JS -->
    <script src="../assets/plugins/select2/select2.full.min.js"></script>

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


    <!-- DATEPICKER JS -->
    <script src="../assets/plugins/date-picker/date-picker.js"></script>
    <script src="../assets/plugins/date-picker/jquery-ui.js"></script>
    <script src="../assets/plugins/input-mask/jquery.maskedinput.js"></script>

    <!-- COLOR PICKER JS -->
    <script src="../assets/plugins/pickr-master/pickr.es5.min.js"></script>
    <script src="../assets/js/picker.js"></script>


      <!-- MULTI SELECT JS-->
    <script src="../assets/plugins/multipleselect/multiple-select.js"></script>
    <script src="../assets/plugins/multipleselect/multi-select.js"></script>

    <!-- Sticky js -->
    <script src="../assets/js/sticky.js"></script>
    <script src="../assets/js/select2.js"></script>

    <!-- CUSTOM JS -->
    <script src="../assets/js/custom.js"></script>

    <!-- Custom-switcher -->
    <script src="../assets/js/custom-swicher.js"></script>

    <!-- Switcher js -->
    <script src="../assets/switcher/js/switcher.js"></script>

      <!-- FORMELEMENTS JS -->
      <script src="../assets/js/formelementadvnced.js"></script>
    <script src="../assets/js/form-elements.js"></script>


        <!-- SELECT2 JS -->
        <script src="../assets/plugins/select2/select2.full.min.js"></script>
    <script src="../assets/js/select2.js"></script>

    <!-- INTERNAL Bootstrap-Datepicker js-->
    <script src="../assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- BOOTSTRAP-DATERANGEPICKER JS -->
    <script src="../assets/plugins/bootstrap-daterangepicker/moment.min.js"></script>

    <!-- INTERNAL Bootstrap-Datepicker js-->
    <script src="../assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>

    <!-- INTERNAL Sumoselect js-->
    <script src="../assets/plugins/sumoselect/jquery.sumoselect.js"></script>



    

</body>

</html>