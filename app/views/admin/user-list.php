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
                <h1 class="h3 mb-2 text-gray-800">User Listing</h1>

                <!-- DataTales Example -->
                <div class="card shadow mb-4 mt-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">User Listing</h6>
                    </div>


                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTable" id="dataTable1" width="100%" cellspacing="0" style="background-color: #d5dad9; color: black">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($data['user_list'] as $k => $v) :?>
                                        <tr>
                                            <td><?= $v->user_id ?></td>
                                            <td><?= $v->email ?></td>
                                            <td><?= $v->firstname ?></td>
                                            <td><?= $v->lastname ?></td>
                                            <td><?= $v->status ?></td>
                                            <td><?= $v->created_at ?></td>
                                            <td></td>
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

<?php
require APPROOT .'/views/admin/inc/footer.php';
?>
