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
                <h1 class="h3 mb-2 text-gray-800">Product Tag</h1>

                <!-- DataTales Example -->
                <div class="card shadow mb-4 mt-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Product Tag</h6>
                    </div>


                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTable" id="dataTable1" width="100%" cellspacing="0" style="background-color: #d5dad9; color: black">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tag Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Tag Name</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                        <?php foreach ($data['tag'] as $key => $value) :
                                            $decode_tag = json_decode($value->product_id);
                                            ?>
                                        <tr>
                                            <td><?= $value->id ?></td>
                                            <td><?= $value->product_tagname ?></td>
                                            <td style="width: 40%">
                                                <form action="/admin/update_tag" class="form-horizontal" method="post">
                                                    <label for="">Product ID: </label>
                                                    <select class="tag-multiselect" name="tag[]" multiple="multiple">
                                                        <?php foreach ($data['product'] as $k => $v): ?>
                                                        <option value="<?= $v->product_id ?>" <?= (is_array($decode_tag) && in_array($v->product_id, $decode_tag) )? 'selected' : '' ?>><?= $v->product_name ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <input type="text" value="<?= $value->id ?>" name="tag_id" hidden>
                                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                                </form>
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
