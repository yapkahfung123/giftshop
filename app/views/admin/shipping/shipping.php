<?php
require APPROOT . '/views/admin/inc/header.php';
?>

<body id="page-top">
<style>
    .hide {
        display: none;
    }
</style>
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
                if (isset($data['success_msg']) && $data['success_msg'] != null) {
                    flash_template($data['success_msg'], 'alert alert-success', 'text-align: center');
                }
                ?>


                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Shipping Management</h1>

                <!-- DataTales Example -->
                <div class="card shadow mb-4 mt-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Shipping Management</h6>
                    </div>


                    <div class="card-body">

                        <button type="button" id="add_shipping" class="btn btn-primary" style="margin-bottom: 20px">Add Shipping Method</button>

                        <div class="table-responsive">
                            <form action="" class="form-horizontal hide" role="form" method="post">
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Shipping Group Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="shipping_name" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Shipping Price</label>
                                    <div class="col-sm-9">
                                        <input type="number" min="0" class="form-control" name="shipping_price" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Is Active</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" name="is_active" value="0">
                                        <input type="checkbox" name="is_active" value="1" checked>
                                    </div>
                                </div>

                                <hr>
                                <div class="form-group">
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <a href="<?= URLROOT . 'admin/shipping' ?>">
                                                    <button type="button" class="btn btn-secondary">Go Back</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <table class="table table-striped table-bordered table-hover dataTable" id="dataTable1"
                                   width="100%" cellspacing="0" style="background-color: #d5dad9; color: black">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Shipping Group Name</th>
                                    <th>Shipping Price</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Shipping Group Name</th>
                                    <th>Shipping Price</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($data['shipping_data'] as $k => $v): ?>
                                        <tr>
                                            <td><?= $v->id ?></td>
                                            <td><?= $v->shipping_group_name ?></td>
                                            <td><?= $v->shipping_price ?></td>
                                            <td>
                                                <a href="/admin/edit_shipping/<?= $v->id ?>"><i class="fas fa-pen"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

<script>
    $('#add_shipping').click(function () {
        $(this).addClass('hide');
        $(this).next().children().eq(0).toggleClass('hide');
        $(this).next().children().eq(1).toggleClass('hide');
    })
</script>

<?php
require APPROOT . '/views/admin/inc/footer.php';
?>
