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
                <h1 class="h3 mb-2 text-gray-800">Product Management</h1>

                <!-- DataTales Example -->
                <div class="card shadow mb-4 mt-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Product<h6>
                    </div>


                    <div class="card-body">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                data-target="#productVariation" style="margin-bottom: 10px">
                            Add Variation
                        </button>
                        <form action="" class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">Product Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="p_name"
                                           value="<?= $data['product']->product_name ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">Product Price</label>
                                <div class="col-sm-9">
                                    <input type="number" min="0" class="form-control" name="p_price"
                                           value="<?= $data['product']->product_price ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">Discount Price<sup class="img-size">*
                                        Leave Blank if no discount</sup></label>
                                <div class="col-sm-9">
                                    <input type="number" min="0" class="form-control" name="p_discount"
                                            value="<?= $data['product']->promo_price ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">SKU</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="p_sku">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="about" class="col-sm-3 control-label">Product Description</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="p_description"
                                              required><?= $data['product']->product_description ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="about" class="col-sm-3 control-label">Priority</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="priority"
                                           value="<?= $data['product']->priority ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="qty" class="col-sm-3 control-label">Product Stock</label>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control" name="p_stock"
                                           value="<?= $data['product']->product_stock ?>" required>
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
                                            <option value="<?= $v->cat_id ?>" <?= ($v->cat_id == $data['product']->product_category) ? 'selected' : '' ?>><?= $v->cat_name ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tech" class="col-sm-3 control-label">Product Image <sup class="img-size">*
                                        300px * 400px</sup></label>
                                <div class="col-sm-3">
                                    <div class="custom-file">
                                        <input type="file" accept="image/*" name="p_img[]" multiple
                                               class="custom-file-input p-Img" id="inputGroupFile01"
                                               aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>

                            <div class="tmp_image">
                                <input type="hidden" id="img_delete_p_id" value="<?= $data['id'] ?>">
                                <?php
                                if (isset($data['product']->img_path)) :
                                    $img_decode = json_decode($data['product']->img_path);
                                    foreach ($img_decode as $k => $v) :
                                        ?>
                                        <span class="prod_img">
                                                <button class="cancelImg" type="button"
                                                        onclick="deleteImg(this, '<?= $v ?>')">x</button>
                                                <img src="<?= URLROOT . 'public/img/uploads/products/' . $v ?>"
                                                     style="width: 10%; margin: 10px;">
                                            </span>
                                    <?php
                                    endforeach;
                                endif;
                                ?>
                            </div>

                            <hr>
                            <div class="form-group">
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <a href="<?= URLROOT . 'admin/product' ?>">
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
        <div class="modal fade" id="productVariation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Product Variation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="../../app/add_variation" method="post">
                        <div class="modal-body" id="modal-variation">
                            <button type="button" class="btn btn-primary btn-sm addVariation">Add Attributes</button>
                            <input type="hidden" name="product_id" value="<?= $data['id'] ?>">

                            <?php
                            if (is_array($data['variation'])) :
                                foreach ($data['variation'] as $key => $value) :
                                    ?>
                                    <div class="row">
                                        <div class="col-md-6 col-5">
                                            <input type="text" class="form-control variation" name="variation[]"
                                                   placeholder="Color, Size etc..." value="<?= $key ?>" required>
                                        </div>

                                        <div class="col-md-4 col-5">
                                            <input type="text" class="form-control variation_attr"
                                                   name="variation_attr[]"
                                                   placeholder="Red, Blue..." value="<?= $value ?>" required>
                                        </div>

                                        <div class="col-md-2 col-2">
                                            <button type="button" class="btn btn-danger btn_remove_dom">x</button>
                                        </div>
                                    </div>
                                <?php
                                endforeach;
                            endif;
                            ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button id="save_variation" type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php
        require APPROOT . '/views/admin/inc/footer.php';
        ?>
