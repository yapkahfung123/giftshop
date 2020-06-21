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

                if (isset($_SESSION['error_msg'])) {
                    flash_template($_SESSION['error_msg'], 'alert alert-danger', 'text-align: center');
                }
                unset($_SESSION['error_msg']);
                ?>

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Shipping Management</h1>

                <!-- DataTales Example -->
                <div class="card shadow mb-4 mt-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Shipping<h6>
                    </div>


                    <div class="card-body">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                data-target="#shippingState" style="margin-bottom: 10px">
                            Add Shipping State
                        </button>
                        <form action="" class="form-horizontal" role="form" method="post">
                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">Shipping Group Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="shipping_name"
                                           value="<?= $data['shipping_data']->shipping_group_name ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">Shipping Price</label>
                                <div class="col-sm-9">
                                    <input type="number" min="0" class="form-control" name="shipping_price"
                                           value="<?= $data['shipping_data']->shipping_price ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">Is Active</label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" name="is_active"
                                           value="1" <?= ($data['shipping_data']->is_active == 1) ? 'checked' : '' ?>>
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

        <!-- Modal -->
        <div class="modal fade" id="shippingState" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Shipping State</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="../../app/shipping_name" method="post">
                        <div class="modal-body" id="modal-variation">
                            <label>Select State:</label>
                            <select class="tag-multiselect" name="state[]" multiple="multiple">
                                <?php
                                foreach ($data['state'] as $k => $v):
                                    $state_decode = json_decode($data['selected_state']);
                                    ?>
                                    <option value="<?= $v ?>" <?= (!empty($state_decode) && (in_array($v, $state_decode)) ? 'selected' : '') ?>><?= $v ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="hidden" name="group_id" value="<?= $data['id'] ?>">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php
        require APPROOT . '/views/admin/inc/footer.php';
        ?>
