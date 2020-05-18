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
                                <label for="name" class="col-sm-3 control-label">Category Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="c_name"
                                           value="<?= $data['category']->cat_name ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="about" class="col-sm-3 control-label">Category Description</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="c_description"
                                              required><?= $data['category']->cat_desc ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="about" class="col-sm-3 control-label">Priority</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="priority"
                                           value="<?= $data['category']->priority ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tech" class="col-sm-3 control-label">Category Image <sup class="img-size">* 570px * 700px</sup></label>
                                <div class="col-sm-3">
                                    <div class="custom-file">
                                        <input type="file" accept="image/*" value="hi" name="p_img" class="custom-file-input p-Img" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>

                            <div class="tmp_image">
                                <input type="hidden" id="img_delete_p_id" value="<?= $data['id'] ?>">
                                <?php
                                if (isset($data['category']->img_path)) :
                                    $img_path = $data['category']->img_path;
                                    ?>
                                    <span class="prod_img">
                                        <button class="cancelImg" type="button"
                                                onclick="deleteCatImg(this, '<?= $img_path . '\', \'' .$data['id'] ?>')">x</button>
                                        <img src="<?= URLROOT . 'public/img/uploads/category/' . $img_path ?>"
                                             style="width: 10%; margin: 10px;">
                                    </span>
                                <?php
                                endif;
                                ?>
                            </div>

                            <hr>
                            <div class="form-group">
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <a href="<?= URLROOT . 'admin/category' ?>">
                                                <button type="button" class="btn btn-secondary">Go Back</button>
                                            </a>
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
