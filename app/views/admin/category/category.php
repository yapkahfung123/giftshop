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
                if(isset($_SESSION['success_msg'])){
                    flash_template($_SESSION['success_msg'], 'alert alert-success', 'text-align: center');
                }unset($_SESSION['success_msg']);
                ?>


                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Product Management</h1>

                <!-- DataTales Example -->
                <div class="card shadow mb-4 mt-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
                    </div>


                    <div class="card-body">
                        <a href="<?= URLROOT . 'admin/add_category' ?>">
                            <button type="button" class="btn btn-primary" style="margin-bottom: 20px">Add Category</button>
                        </a>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTableCate" id="dataTable1" width="100%" cellspacing="0" style="background-color: #d5dad9; color: black">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Name</th>
                                    <th>Category Description</th>
                                    <th>Priority</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Name</th>
                                    <th>Category Description</th>
                                    <th>Priority</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php
                                foreach ($data['category'] as $k => $v):
                                    ?>
                                    <tr class="icon-margin">
                                        <td><?= $v->cat_id ?></td>
                                        <td><?= $v->cat_name ?></td>
                                        <td><?= $v->cat_desc ?></td>
                                        <td><?= $v->priority ?></td>
                                        <td><?= $v->created_at ?></td>
                                        <td>
                                            <a href="<?= URLROOT . 'admin/edit_category/' . $v->cat_id?>"><i class="fas fa-pen"></i></a>
                                            <button class="deleteCategory" style="border: none; background: none;"><i class="fas fa-trash"></i></button>
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
require APPROOT . '/views/admin/inc/footer.php';
?>
