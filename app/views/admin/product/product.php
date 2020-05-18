<?php
require APPROOT .'/views/admin/inc/header.php';
?>

<body id="page-top">
<div id="wrapper">

    <!-- Sidebar -->
    <?php require APPROOT .'/views/admin/inc/sidebar.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
            <?php require APPROOT .'/views/admin/inc/topbar.php'; ?>
            <!-- Begin Page Content -->
            <div class="container-fluid">
                    <?php
                        if(isset($_SESSION['success_msg'])){
                            flash_template($_SESSION['success_msg'], 'alert alert-success', 'text-align: center');
                        }unset($_SESSION['success_msg']);
                    ?>


                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Product Management</h1>

                <!-- DataTales Example -->
                <div class="card shadow mb-4 mt-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Product Management</h6>
                    </div>


                    <div class="card-body">
                        <a href="<?= URLROOT . 'admin/add_product' ?>">
                            <button type="button" class="btn btn-primary" style="margin-bottom: 20px">Add Product</button>
                        </a>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTable" id="dataTable1" width="100%" cellspacing="0" style="background-color: #d5dad9; color: black">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Discount Price</th>
                                    <th>Description</th>
                                    <th>Stock</th>
                                    <th>Priority</th>
<!--                                    <th>Variation</th>-->
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Discount Price</th>
                                    <th>Description</th>
                                    <th>Stock</th>
                                    <th>Priority</th>
<!--                                    <th>Variation</th>-->
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    foreach ($data['product'] as $k => $v):
                                    ?>
                                    <tr class="icon-margin">
                                        <td><?= $v->product_id ?></td>
                                        <td><?= $v->product_name ?></td>
                                        <td>RM <?= $v->product_price ?></td>
                                        <td><?= ($v->promo_price != null)? 'RM '.$v->promo_price : 'No Discount'?></td>
                                        <td><?= $v->product_description ?></td>
                                        <td><?= $v->product_stock ?></td>
                                        <td><?= $v->priority ?></td>
                                        <td><?= $v->created_at ?></td>
                                        <td>
                                            <a href="<?= URLROOT . 'admin/edit_product/' . $v->product_id?>"><i class="fas fa-pen"></i></a>
                                            <button class="deleteProduct" style="border: none; background: none;"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

<?php
require APPROOT .'/views/admin/inc/footer.php';
?>
