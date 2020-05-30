<?php include_once APPROOT . '/views/home/inc/header.php' ?>
<?php include_once APPROOT . '/views/home/inc/topbar.php' ?>
<?php include_once APPROOT . '/views/home/inc/navbar.php' ?>
<!-- Breadcrumbs -->
<div class="container">
    <ol class="breadcrumb">
        <li>
            <a href="<?= URLROOT ?>">Home</a>
        </li>
        <li>
            <a href="<?= URLROOT . 'home/categories' ?>">Shop</a>
        </li>
        <li class="active">
            <?= ucfirst($data['product']->product_name) ?>
        </li>
    </ol> <!-- end breadcrumbs -->
</div>

<!-- Single Product -->
<section class="section-wrap single-product">
    <div class="container relative">
        <div class="row">

            <div class="col-sm-6 col-xs-12 mb-60">

                <div class="flickity flickity-slider-wrap mfp-hover" id="gallery-main">
                    <?php
                    $img = json_decode($data['product']->img_path);
                    foreach ($img as $v):
                        ?>
                        <div class="gallery-cell">

                            <a href="<?= URLROOT ?>public/img/uploads/products/<?= $data['product']->product_id . '/' .$v ?>" class="lightbox-img">
                                <img src="<?= URLROOT ?>public/img/uploads/products/<?= $data['product']->product_id . '/' .$v ?>" alt=""/>
                                <i class="icon arrow_expand"></i>
                            </a>
                        </div>
                    <?php endforeach; ?>

                </div> <!-- end gallery main -->

                <div class="gallery-thumbs">

                    <?php
                    foreach ($img as $v):
                        ?>
                        <div class="gallery-cell">
                            <img src="<?= URLROOT ?>public/img/uploads/products/<?= $v ?>" alt=""/>
                        </div>

                    <?php endforeach; ?>

                </div> <!-- end gallery thumbs -->

            </div> <!-- end col img slider -->

            <div class="col-sm-6 col-xs-12 product-description-wrap">
                <h1 class="product-title"><?= $data['product']->product_name ?></h1>
<!--                <span class="rating">-->
<!--              <a href="#">3 Reviews</a>-->
<!--               </span>-->
                <span class="price">
                    <?php if($data['product']->promo_price != null){ ?>
                        <del>
                          <span>RM <?= $data['product']->product_price ?></span>
                        </del>
                        <ins>
                          <span class="amount">RM <?= $data['product']->promo_price ?></span>
                        </ins>
                    <?php }else{ ?>
                        <ins>
                          <span class="amount">RM <?= $data['product']->product_price ?></span>
                        </ins>
                    <?php } ?>
                </span>
                <p class="product-description"><?= $data['product']->product_description ?></p>

                <div class="select-options">
                    <div class="row row-20">
                        <?php
                        if(!empty($data['variation'])) :
                        //Turn object to array
                        foreach ($data['variation'] as $k => $v) {
                            $variation[] = get_object_vars($v);
                        }
                        $array = array();
                        //Loop variation
                        foreach ($variation as $k => $v):
                            //Initiate Keys
                            $attr_keys = array_keys($v);
                            $attr_keys = $attr_keys[0];

                            //Initiate Values
                            $attr_values = array_values($v);
                            $attr_values = explode(', ', $attr_values[0]);
                            ?>
                            <div class="col-sm-6">
                                <select class="color-select">
                                    <option value>Select <?= $attr_keys ?></option>
                                    <?php foreach ($attr_values as $key => $value) : ?>
                                        <option value="<?= strtolower($value) ?>"><?= $value ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php
                        endforeach;
                        endif;
                        ?>
                    </div>
                </div>

                <ul class="product-actions clearfix">

                    <li>
                        <a href="#" class="btn btn-color btn-lg add-to-cart left"><span>Add to Cart</span></a>
                    </li>
                    <li>
                        <div class="icon-add-to-wishlist left">
                            <a href="#"><i class="icon icon_heart_alt"></i></a>
                        </div>
                    </li>
                    <li>
                        <div class="quantity buttons_added">
                            <input type="button" value="-" class="minus"/><input type="number" step="1" min="0"
                                                                                 value="1" title="Qty"
                                                                                 class="input-text qty text"/><input
                                    type="button" value="+" class="plus"/>
                        </div>
                    </li>
                </ul>

                <div class="product_meta">
                    <span class="sku">SKU: <a href="#"><?= $data['product']->product_sku ?></a></span>
                    <span class="posted_in">Category: <?= get_category_name($data['product']->product_category) ?></span>
<!--                    <span class="tagged_as">Tags: <a href="#">Elegant</a>, <a href="#">Bag</a></span>-->
                </div>

                <div class="socials-share clearfix">
                    <div class="social-icons rounded">
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-google-plus"></i></a>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                        <a href="#"><i class="fa fa-vimeo"></i></a>
                    </div>
                </div>
            </div> <!-- end col product description -->
        </div> <!-- end row -->

        <!-- tabs -->
        <div class="row">
            <div class="col-md-12">
                <div class="tabs tabs-bb">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab-description" data-toggle="tab">Description</a>
                        </li>
                        <li>
                            <a href="#tab-info" data-toggle="tab">Information</a>
                        </li>
                        <li>
                            <a href="#tab-reviews" data-toggle="tab">Reviews</a>
                        </li>
                    </ul> <!-- end tabs -->

                    <!-- tab content -->
                    <div class="tab-content">

                        <div class="tab-pane fade in active" id="tab-description">
                            <p>
                                We possess within us two minds. So far I have written only of the conscious mind. I
                                would now like to introduce you to your second mind, the hidden and mysterious
                                subconscious. Our subconscious mind contains such power and complexity that it literally
                                staggers the imagination.And finally the subconscious is the mechanism through which
                                thought impulses which are repeated regularly with feeling and emotion are quickened,
                                charged. Our subconscious mind contains such power and complexity that it literally
                                staggers the imagination.And finally the subconscious is the mechanism through which
                                thought impulses.
                            </p>
                        </div>

                        <div class="tab-pane fade" id="tab-info">
                            <table class="table">

                                <tbody>
                                <tr>
                                    <th>CPU</th>
                                    <td>2.7GHz quad-core Intel Core i5 Turbo Boost up to 3.2GHz</td>
                                </tr>
                                <tr>
                                    <th>RAM</th>
                                    <td>8GB (two 4GB) memory</td>
                                </tr>
                                <tr>
                                    <th>Video</th>
                                    <td>Intel Iris Pro Graphics</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade" id="tab-reviews">

                            <div class="reviews">
                                <ul class="reviews-list">
                                    <li>
                                        <div class="review-body">
                                            <div class="review-content">
                                                <p class="review-author"><strong>Alexander Samokhin</strong> - May 6,
                                                    2014 at 12:48 pm</p>
                                                <div class="rating">
                                                    <a href="#"></a>
                                                </div>
                                                <p>This template is so awesome. I didn’t expect so many features inside.
                                                    E-commerce pages are very useful, you can launch your online store
                                                    in few seconds. I will rate 5 stars.</p>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="review-body">
                                            <div class="review-content">
                                                <p class="review-author"><strong>Christopher Robins</strong> - May 6,
                                                    2014 at 12:48 pm</p>
                                                <div class="rating">
                                                    <a href="#"></a>
                                                </div>
                                                <p>This template is so awesome. I didn’t expect so many features inside.
                                                    E-commerce pages are very useful, you can launch your online store
                                                    in few seconds. I will rate 5 stars.</p>
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                            </div> <!--  end reviews -->
                        </div>

                    </div> <!-- end tab content -->

                </div>
            </div> <!-- end tabs -->
        </div> <!-- end row -->


    </div> <!-- end container -->
</section>
<!-- end single product -->


<?php include_once APPROOT . '/views/home/inc/footer.php' ?>
