<?php
require APPROOT . '/views/admin/inc/header.php';
?>
<body id="page-top">
<div id="wrapper">

    <!-- Sidebar -->
    <?php require APPROOT . '/views/admin/inc/sidebar.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
            <?php require APPROOT . '/views/admin/inc/topbar.php'; ?>
            <!-- Begin Page Content -->
            <div class="container-fluid">

                <?php
                if (isset($_SESSION['success_msg'])) {
                    flash_template($_SESSION['success_msg'], 'alert alert-success', 'text-align: center');
                }
                unset($_SESSION['success_msg']);
                ?>

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Product Tag</h1>

                <!-- DataTales Example -->
                <div class="card shadow mb-4 mt-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Product Tag<h6>
                    </div>


                    <div class="card-body">
                        <form action="" class="form-horizontal" role="form" method="post">
                            <label for="">Product ID: </label>
                            <select id="tag-multiselect" multiple="multiple">
                                <option value=""></option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <?php
        require APPROOT . '/views/admin/inc/footer.php';
        ?>
