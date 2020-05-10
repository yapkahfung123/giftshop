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
                <h1 class="h3 mb-2 text-gray-800">Product Management</h1>

                <!-- DataTales Example -->
                <div class="card shadow mb-4 mt-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Add Product<h6>
                    </div>


                    <div class="card-body">
                        <form action="" class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">Product Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="p_name" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">Product Price</label>
                                <div class="col-sm-9">
                                    <input type="number" min="0" class="form-control" name="p_price" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="about" class="col-sm-3 control-label">Product Description</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="p_description" required></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="about" class="col-sm-3 control-label">Priority</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="priority" value="99" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="qty" class="col-sm-3 control-label">Product Stock</label>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control" name="p_stock" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tech" class="col-sm-3 control-label">Product Category</label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="category" required>
                                        <option value="" disabled></option>
                                        <?php
                                        foreach ($data['category'] as $k => $v) :
                                        ?>
                                            <option value="<?= $v->cat_id ?>"><?= $v->cat_name ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tech" class="col-sm-3 control-label">Product Image <sup class="img-size">* 300px * 400px</sup></label>
                                <div class="col-sm-3">
                                    <div class="custom-file">
                                        <input type="file" accept="image/*" name="p_img[]" multiple class="custom-file-input p-Img" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>

                            <div class="tmp_image"></div>

                            <hr>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="<?= URLROOT . 'admin/product' ?>"><button type="button" class="btn btn-secondary ml-4">Go Back</button></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
<?php
require APPROOT .'/views/admin/inc/footer.php';
?>
