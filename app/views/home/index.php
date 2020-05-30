<?php include_once APPROOT . '/views/home/inc/header.php'?>
<?php include_once APPROOT . '/views/home/inc/topbar.php'?>
<?php include_once APPROOT . '/views/home/inc/navbar.php'?>

    <!-- Hero Slider -->
    <section class="section-wrap nopadding">
        <div class="container">
            <div class="entry-slider">
                <div class="flexslider" id="flexslider-hero">
                    <ul class="slides clearfix">
                        <li>
                            <img src="img/slider/1.jpg" alt="">
                            <div class="img-holder img-1"></div>
                            <div class="hero-holder text-center right-align">
                                <div class="hero-lines">
                                    <h1 class="hero-heading white">Collection 2017</h1>
                                    <h4 class="hero-subheading white uppercase">HOT AND FRESH TRENDS OF THIS YEAR</h4>
                                </div>
                                <a href="#" class="btn btn-lg btn-white"><span>Shop Now</span></a>
                            </div>
                        </li>
                        <li>
                            <img src="img/slider/2.jpg" alt="">
                            <div class="img-holder img-2"></div>
                            <div class="hero-holder text-center">
                                <div class="hero-lines">
                                    <h1 class="hero-heading white large">Winter Sales</h1>
                                </div>
                                <a href="#" class="btn btn-lg btn-white"><span>Shop Now</span></a>
                            </div>
                        </li>
                        <li>
                            <img src="img/slider/3.jpg" alt="">
                            <div class="img-holder img-3"></div>
                            <div class="hero-holder left-align">
                                <div class="hero-lines">
                                    <h1 class="hero-heading white">Autumn 2017</h1>
                                    <p class="white">A-ha Theme is the Best E-Commerce solution</p>
                                    <p class="white">Packed with tons of features and unique styles</p>
                                </div>
                                <a href="#" class="btn btn-lg btn-white"><span>Shop Now</span></a>
                            </div>
                        </li>
                        <li>
                            <img src="img/slider/4.jpg" alt="">
                            <div class="img-holder img-4"></div>
                            <div class="hero-holder text-center right-align">
                                <div class="hero-lines">
                                    <h1 class="hero-heading white">Summer 2017</h1>
                                    <p class="white">A-ha Theme is the Best E-Commerce solution</p>
                                    <p class="white">Packed with tons of features and unique styles</p>
                                </div>
                                <a href="#" class="btn btn-lg btn-white"><span>Shop Now</span></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div> <!-- end slider -->
        </div>
    </section>
    <!-- end hero slider -->

<?php foreach ($data['prod_tag'] as $key => $value) :
    $p_id = json_decode($value->product_id);
?>

    <!-- New Arrivals -->
    <section class="section-wrap new-arrivals pb-40">
        <div class="container">

            <div class="row heading-row">
                <div class="col-md-12 text-center">
                    <h2 class="heading uppercase"><small><?= $value->product_tagname?></small></h2>
                </div>
            </div>

            <div class="row row-10">

                <?php for($i=0; $i<4; $i++):
                    $product = getProductById($p_id[$i]);
                    $img = json_decode($product->img_path);
                    ?>
                <div class="col-md-3 col-xs-6">
                    <div class="product-item">
                        <div class="product-img">
                            <a href="/home/product?product_id=<?= $product->product_id ?>">
                                <?php if(empty($img)):?>
                                <img src="<?= URLROOT ?>public/img/no-img.jpg" alt="">
                                <?php else: ?>
                                <img src="<?= URLROOT ?>public/img/uploads/products/<?= $product->product_id . '/' .$img[0] ?>" alt="">
                                <?php endif; ?>
                            </a>
                            <div class="product-label">
                                <span class="sale">sale</span>
                            </div>
                            <div class="product-actions">
                                <a href="#" class="product-add-to-wishlist" data-toggle="tooltip" data-placement="bottom" title="Add to wishlist">
                                    <i class="fa fa-heart"></i>
                                </a>
                            </div>
                            <a href="#" class="product-quickview">Quick View</a>
                        </div>
                        <div class="product-details">
                            <h3>
                                <a class="product-title" href="shop-single-product.html"><?= $product->product_name ?></a>
                            </h3>
                            <span class="price">
                                  <?php if($product->promo_price != null){ ?>
                                      <del>
                                          <span>RM <?= $product->product_price ?></span>
                                        </del>
                                      <ins>
                                          <span class="amount">RM <?= $product->promo_price ?></span>
                                        </ins>
                                  <?php }else{ ?>
                                      <ins>
                                          <span class="amount">RM <?= $product->product_price ?></span>
                                        </ins>
                                  <?php } ?>
                </span>
                        </div>
                    </div>
                </div>
                <?php endfor; ?>
            </div> <!-- end row -->
        </div>
    </section>
    <!-- end new arrivals -->
<?php endforeach; ?>


<?php include_once APPROOT . '/views/home/inc/footer.php'?>