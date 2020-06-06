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
                <h1 class="h3 mb-2 text-gray-800">Shipping Management</h1>

                <!-- DataTales Example -->
                <div class="card shadow mb-4 mt-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Shipping<h6>
                    </div>


                    <div class="card-body">
                        <form action="" class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">Shipping Group Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="shipping_name" value="<?= $data['shipping_data']->shipping_group_name ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">Shipping Price</label>
                                <div class="col-sm-9">
                                    <input type="number" min="0" class="form-control" name="shipping_price" value="<?= $data['shipping_data']->shipping_price ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">Is Active</label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" name="is_active" value="1" <?= ($data['shipping_data']->is_active == 1)? 'checked' : '' ?>>
                                </div>
                            </div>

                            <hr>
                            <div class="form-group">
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <a href="<?= URLROOT . 'admin/shipping' ?>">
                                                <button type="button" class="btn btn-secondary">Go Back</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
