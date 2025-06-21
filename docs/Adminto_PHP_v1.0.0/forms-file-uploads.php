<?php // include 'services/session.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>

   

    <!-- Plugins css -->
    <link href="assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/dropify/css/dropify.min.css" rel="stylesheet" type="text/css" />

    <?php include 'partials/head-css.php'; ?>

</head>



<!-- Begin page -->
<div id="wrapper">



    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Dropzone File Upload</h4>
                                <p class="sub-header">
                                    DropzoneJS is an open source library that provides drag’n’drop file uploads with
                                    image previews.
                                </p>

                                <form action="/" method="post" class="dropzone" id="myAwesomeDropzone"
                                    data-plugin="dropzone" data-previews-container="#file-previews"
                                    data-upload-preview-template="#uploadPreviewTemplate">
                                    <div class="fallback">
                                        <input name="file" type="file" multiple />
                                    </div>

                                    <div class="dz-message needsclick">
                                        <i class="h1 text-muted dripicons-cloud-upload"></i>
                                        <h3>Drop files here or click to upload.</h3>
                                        <span class="text-muted font-13">(This is just a demo dropzone. Selected files
                                            are
                                            <strong>not</strong> actually uploaded.)</span>
                                    </div>
                                </form>

                                <!-- Preview -->
                                <div class="dropzone-previews mt-3" id="file-previews"></div>

                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div><!-- end col -->
                </div>
                <!-- end row -->

                <!-- file preview template -->
                <div class="d-none" id="uploadPreviewTemplate">
                    <div class="card mt-1 mb-0 shadow-none border">
                        <div class="p-2">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <img data-dz-thumbnail src="#" class="avatar-sm rounded bg-light" alt="">
                                </div>
                                <div class="col ps-0">
                                    <a href="javascript:void(0);" class="text-muted fw-bold" data-dz-name></a>
                                    <p class="mb-0" data-dz-size></p>
                                </div>
                                <div class="col-auto">
                                    <!-- Button -->
                                    <a href="" class="btn btn-link btn-lg text-muted" data-dz-remove>
                                        <i class="dripicons-cross"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- container -->

        </div> <!-- content -->  

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->

    <!-- Vendor -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>

<!-- Plugins js -->
<script src="assets/libs/dropzone/min/dropzone.min.js"></script>

<!-- Init js-->
<script src="assets/js/pages/form-fileuploads.init.js"></script>

<!-- App js -->
<script src="assets/js/app.min.js"></script>

</body>

</html>