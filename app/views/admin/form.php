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

                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">Form Tables</h1>

                        <!-- DataTales Example -->
                        <div class="card shadow mb-4 mt-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Form Data</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTable" id="dataTable" width="100%" cellspacing="0" style="background-color: #d5dad9; color: black">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Message</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Message</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php foreach ($data['form'] as $form) :?>
                                        <tr>
                                            <td><?= $form->id;?></td>
                                            <td><?= $form->name;?></td>
                                            <td><?= $form->email;?></td>
                                            <td><?= $form->phone;?></td>
                                            <td><?= $form->msg;?></td>
                                            <td><?= $form->created_at;?></td>
                                            <td style="text-align: center">
                                                <a href="https://wa.me/6<?= $form->phone;?>" target="_blank" style="color: black">
                                                    <i class="fab fa-whatsapp"></i>
                                                </a>
                                                <button class="deleteForm" style="border: none; background: none;">
                                                    <i class="fas fa-trash"></i>
                                                </button>
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

<?php
require APPROOT .'/views/admin/inc/footer.php';
?>
