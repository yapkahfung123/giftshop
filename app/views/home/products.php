<?php include_once APPROOT . '/views/home/inc/header.php' ?>
<?php include_once APPROOT . '/views/home/inc/topbar.php' ?>
<?php include_once APPROOT . '/views/home/inc/navbar.php' ?>
<!-- Breadcrumbs -->
<div class="container">
    <ol class="breadcrumb">
        <li>
            <a href="<?= URLROOT ?>">Home</a>
        </li>
        <li class="active">
            Categories
        </li>
    </ol> <!-- end breadcrumbs -->
</div>

<!-- Catalogue -->
<section class="section-wrap pt-70 pb-40 catalogue">
    <div class="container relative">
        <div class="row">

            <div class="col-md-9 catalogue-col right mb-50">

                <?php if (isset($_GET['page']) && $_GET['page'] <= 1): ?>
                    <!-- Banner -->
                    <div class="banner-wrap relative">
                        <img src="<?= URLROOT ?>public/img/banner.jpg" alt="">
                        <div class="hero-holder text-center right-align">
                            <div class="hero-lines mb-0">
                                <h1 class="hero-heading white">Women Collection</h1>
                                <h4 class="hero-subheading white uppercase">HOT AND FRESH TRENDS OF THIS YEAR</h4>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!--                <div class="shop-filter">-->
                <!--                    <p class="result-count">Showing: 1-12 of 80 results</p>-->
                <!---->
                <!--                    <form class="ecommerce-ordering">-->
                <!--                        <select>-->
                <!--                            <option value="default-sorting">Default Sorting</option>-->
                <!--                            <option value="price-low-to-high">Price: high to low</option>-->
                <!--                            <option value="price-high-to-low">Price: low to high</option>-->
                <!--                            <option value="by-popularity">By Popularity</option>-->
                <!--                            <option value="date">By Newness</option>-->
                <!--                            <option value="rating">By Rating</option>-->
                <!--                        </select>-->
                <!--                    </form>-->
                <!--                </div>-->

                <div class="shop-catalogue grid-view left">

                    <div class="row row-10 items-grid">
                        <?php foreach ($data['products'] as $k => $v):
                            $img = json_decode($v->img_path);
                            ?>

                            <div class="col-md-4 col-xs-6">
                                <div class="product-item">
                                    <div class="product-img">
                                        <?php if (empty($img)) { ?>
                                            <a href="#">
                                                <img src="<?= URLROOT ?>public/img/no-img.jpg" alt="">
                                            </a>
                                            <?php
                                        } else {
                                            ?>
                                            <a href="#">
                                                <img src="<?= URLROOT ?>public/img/uploads/products/<?= $img[0] ?>"
                                                     alt="">
                                            </a>
                                        <?php } ?>

                                        <div class="product-label">
                                            <span class="sale">sale</span>
                                        </div>
                                        <div class="product-actions">
                                            <a href="#" class="product-add-to-wishlist" data-toggle="tooltip"
                                               data-placement="bottom" title="Add to wishlist" style="padding-top: 2px">
                                                <i class="fa fa-heart"></i>
                                            </a>
                                        </div>
                                        <a href="#" class="product-quickview">Quick View</a>
                                    </div>
                                    <div class="product-details">
                                        <h3>
                                            <a class="product-title"
                                               href="shop-single-product.html"><?= $v->product_name ?></a>
                                        </h3>
                                        <span class="price">
                                            <?php if($v->promo_price != null){ ?>
                                                <del>
                                                  <span>RM <?= $v->product_price ?></span>
                                                </del>
                                                <ins>
                                                  <span class="amount">RM <?= $v->promo_price ?></span>
                                                </ins>
                                            <?php }else{ ?>
                                                <ins>
                                                  <span class="amount">RM <?= $v->product_price ?></span>
                                                </ins>
                                            <?php } ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>

                    </div> <!-- end row -->
                </div> <!-- end grid mode -->

                <div class="clear"></div>

                <!--                 Pagination-->
                <!--                <div class="pagination-wrap">-->
                <!--                    <p class="result-count">Showing: 1-12 of 80 results</p>-->
                <!--                    <nav class="pagination right clear">-->
                <!--                        <a href="#"><i class="fa fa-angle-left"></i></a><span class="page-numbers current">-->
                <!--                1</span><a href="#">-->
                <!--                            2</a><a href="#">-->
                <!--                            3</a><a href="#">-->
                <!--                            4</a><a href="#">-->
                <!--                            <i class="fa fa-angle-right"></i></a>-->
                <!--                    </nav>-->
                <!--                </div>-->

                <div class="pagination-wrap">
                    <p class="result-count">
                        Showing: <?php echo $data['pagination']['page'] . ' / ' . $data['pagination']['totalPages'] . ' of ' . $data['pagination']['totalProducts'] . ' results' ?></p>
                    <nav class="pagination right clear">
                        <?php
                        $url = paginationProductUrl($data['category_id'], $data['pagination']['page'], 'prev')
                        ?>
                        <a href="<?= ($data['pagination']['page'] == 1) ? 'javascript:void(0)' : $url ?>">
                            <i class="fa fa-angle-left"></i>
                        </a>

                        <?php

                        for ($p = 1; $p <= $data['pagination']['totalPages']; $p++) :
                            $url = paginationProductUrl($data['category_id'], $p)
                            ?>

                            <a href="<?= $url ?>"><span style="display: contents"
                                                        class="<?= ($data['pagination']['page'] == $p) ? 'page-numbers current' : '' ?>"><?= $p; ?></span></a>

                        <?php endfor; ?>

                        <?php
                        $url = paginationProductUrl($data['category_id'], $data['pagination']['page'], 'next');
                        ?>

                        <a href="<?= ($data['pagination']['page'] == $data['pagination']['totalPages']) ? 'javascript:void(0)' : $url ?>">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </nav>
                </div>

            </div> <!-- end col -->

            <!-- Sidebar -->
            <aside class="col-md-3 sidebar left-sidebar">

                <!-- Categories -->
                <div class="widget categories">
                    <h3 class="widget-title uppercase">Categories</h3>
                    <ul class="list-no-dividers">
                        <?php foreach (get_category() as $k => $v): ?>
                            <li>
                                <a href="?category_id=<?= $v->cat_id ?>"><?= $v->cat_name ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <?php /*
                <!-- Select size -->
                <div class="widget categories">
                    <h3 class="widget-title uppercase">Select size</h3>
                    <ul class="list-no-dividers">
                        <li>
                            <a href="#">Large</a>
                        </li>
                        <li>
                            <a href="#">Medium</a>
                        </li>
                        <li>
                            <a href="#">Small</a>
                        </li>
                        <li>
                            <a href="#">X-Large</a>
                        </li>
                        <li>
                            <a href="#">X-Small</a>
                        </li>
                    </ul>
                </div>

                <!-- Select color -->
                <div class="widget categories">
                    <h3 class="widget-title uppercase">Select color</h3>
                    <ul class="list-no-dividers">
                        <li>
                            <a href="#">White</a>
                        </li>
                        <li>
                            <a href="#">Grey</a>
                        </li>
                        <li>
                            <a href="#">Black</a>
                        </li>
                        <li>
                            <a href="#">Pink</a>
                        </li>
                        <li>
                            <a href="#">Green</a>
                        </li>
                    </ul>
                </div>

                <!-- Filter by Price -->
                <div class="widget filter-by-price clearfix">
                    <h3 class="widget-title uppercase">Filter by Price</h3>

                    <div id="slider-range"></div>
                    <p>
                        <label for="amount">Price:</label>
                        <input type="text" id="amount" readonly style="border:0;">
                        <a href="#" class="btn btn-sm btn-dark">Filter</a>
                    </p>
                </div>

                <!-- Bestsellers -->
                <div class="widget bestsellers">
                    <div class="products-widget">
                        <h3 class="widget-title uppercase">Bestsellers</h3>
                        <ul class="product-list-widget">
                            <li class="clearfix">
                                <a href="shop-single-product.html">
                                    <img src="<?= URLROOT ?>public/img/shop/shop_item_9.jpg" alt="">
                                    <span class="product-title">Sleeveless dress</span>
                                </a>
                                <span class="price">
                      <ins>
                        <span class="ammount">$120.00</span>
                      </ins>
                    </span>
                            </li>
                            <li class="clearfix">
                                <a href="shop-single-product.html">
                                    <img src="<?= URLROOT ?>public/img/shop/shop_item_10.jpg" alt="">
                                    <span class="product-title">Violet Party Dress</span>
                                </a>
                                <span class="price">
                      <ins>
                        <span class="ammount">$179.00</span>
                      </ins>
                    </span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Tags -->
                <div class="widget tags clearfix">
                    <h3 class="widget-title uppercase">Tags</h3>
                    <a href="#">Multi-purpose</a>
                    <a href="#">Creative</a>
                    <a href="#">Elegant</a>
                    <a href="#">Clean</a>
                    <a href="#">Modern</a>
                    <a href="#">Responsive</a>
                    <a href="#">E-commerce</a>
                    <a href="#">WordPress</a>
                    <a href="#">Woocommerce</a>
                    <a href="#">Store</a>
                    <a href="#">Business</a>
                </div>

            </aside> <!-- end sidebar -->
            */ ?>

        </div> <!-- end row -->
    </div> <!-- end container -->
</section>
<!-- end catalogue -->

<?php include_once APPROOT . '/views/home/inc/footer.php' ?>
