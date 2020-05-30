<nav class="navbar navbar-static-top">
    <div class="navigation" id="sticky-nav">
        <div class="container relative">

            <div class="row">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Mobile cart -->
                    <div class="nav-cart mobile-cart hidden-lg hidden-md">
                        <div class="nav-cart-outer">
                            <div class="nav-cart-inner">
                                <a href="#" class="nav-cart-icon">2</a>
                            </div>
                        </div>
                    </div>
                </div> <!-- end navbar-header -->

                <div class="header-wrap">
                    <div class="header-wrap-holder">

                        <!-- Search -->
                        <div class="nav-search hidden-sm hidden-xs">
                            <form method="get">
                                <input type="search" class="form-control" placeholder="Search">
                                <button type="submit" class="search-button">
                                    <i class="icon icon_search"></i>
                                </button>
                            </form>
                        </div>

                        <!-- Logo -->
                        <div class="logo-container">
                            <div class="logo-wrap text-center">
                                <a href="<?= URLROOT ?>">
                                    <img class="logo" src="<?= URLROOT ?>public/img/logo_dark.png" alt="logo">
                                </a>
                            </div>
                        </div>

                        <!-- Cart -->
                        <div class="nav-cart-wrap hidden-sm hidden-xs">
                            <div class="nav-cart right">
                                <div class="nav-cart-outer">
                                    <div class="nav-cart-inner">
                                        <a href="#" class="nav-cart-icon">2</a>
                                    </div>
                                </div>
                                <div class="nav-cart-container">
                                    <div class="nav-cart-items">

                                        <div class="nav-cart-item clearfix">
                                            <div class="nav-cart-img">
                                                <a href="#">
                                                    <img src="img/shop/cart_small_1.jpg" alt="">
                                                </a>
                                            </div>
                                            <div class="nav-cart-title">
                                                <a href="#">
                                                    Ladies Bag
                                                </a>
                                                <div class="nav-cart-price">
                                                    <span>1 x</span>
                                                    <span>1250.00</span>
                                                </div>
                                            </div>
                                            <div class="nav-cart-remove">
                                                <a href="#"><i class="icon icon_close"></i></a>
                                            </div>
                                        </div>

                                        <div class="nav-cart-item clearfix">
                                            <div class="nav-cart-img">
                                                <a href="#">
                                                    <img src="img/shop/cart_small_2.jpg" alt="">
                                                </a>
                                            </div>
                                            <div class="nav-cart-title">
                                                <a href="#">
                                                    Sequin Suit longer title
                                                </a>
                                                <div class="nav-cart-price">
                                                    <span>1 x</span>
                                                    <span>1250.00</span>
                                                </div>
                                            </div>
                                            <div class="nav-cart-remove">
                                                <a href="#"><i class="icon icon_close"></i></a>
                                            </div>
                                        </div>

                                    </div> <!-- end cart items -->

                                    <div class="nav-cart-summary">
                                        <span>Cart Subtotal</span>
                                        <span class="total-price">$1799.00</span>
                                    </div>

                                    <div class="nav-cart-actions mt-20">
                                        <a href="<?= URLROOT . 'home/cart' ?>" class="btn btn-md btn-dark"><span>View Cart</span></a>
                                        <a href="<?= URLROOT . 'home/checkout' ?>" class="btn btn-md btn-color mt-10"><span>Proceed to Checkout</span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="menu-cart-amount right">
                      <span>
                        Cart /
                        <a href="#"> $1299.50</a>
                      </span>
                            </div>
                        </div> <!-- end cart -->

                    </div>
                </div> <!-- end header wrap -->

                <div class="nav-wrap">
                    <div class="collapse navbar-collapse" id="navbar-collapse">

                        <ul class="nav navbar-nav">

                            <li id="mobile-search" class="hidden-lg hidden-md">
                                <form method="get" class="mobile-search relative">
                                    <input type="search" class="form-control" placeholder="Search...">
                                    <button type="submit" class="search-button">
                                        <i class="icon icon_search"></i>
                                    </button>
                                </form>
                            </li>

                            <li class="dropdown">
                                <a href="<?= URLROOT ?>">Home</a>
                            </li>

                            <li class="dropdown">
                                <a href="#">Pages</a>
                                <i class="fa fa-angle-down dropdown-toggle" data-toggle="dropdown"></i>
                                <ul class="dropdown-menu">
                                    <li><a href="about-us.html">About Us</a></li>
                                </ul>
                            </li>

                            <?php /*
                            <li class="dropdown">
                                <a href="<?= URLROOT . 'home/categories' ?>" class="dropdown-toggle" data-toggle="dropdown">Categories</a>
                                <ul class="dropdown-menu megamenu">
                                    <li>
                                        <div class="megamenu-wrap">
                                            <div class="row">
                                                <div class="col-md-3 megamenu-item">
                                                    <ul class="menu-list">
                                                        <?php foreach (get_category() as $k => $v) : ?>
                                                            <li><a href="#"><?= $v->cat_name ?></a></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li> <!-- end categories -->
                             */?>

                            <li class="dropdown">
                                <a href="/home/collection">Categories</a>
                                <i class="fa fa-angle-down dropdown-toggle" data-toggle="dropdown"></i>
                                <ul class="dropdown-menu">
                                    <?php foreach (get_category() as $k => $v) : ?>
                                        <li><a href="/home/all_products?category_id=<?= $v->cat_id ?>"><?= $v->cat_name ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#">Shop</a>
                                <i class="fa fa-angle-down dropdown-toggle" data-toggle="dropdown"></i>
                                <ul class="dropdown-menu">
                                    <li><a href="/home/all_products">All Products</a></li>
<!--                                    <li><a href="/home/collections">Collections</a></li>-->
<!--                                    <li><a href="/home/product">Single Product</a></li>-->
                                    <li><a href="/home/cart">Cart</a></li>
                                    <li><a href="/home/checkout">Checkout</a></li>
                                </ul>
                            </li>

                            <li class="mobile-links">
                                <ul>
                                    <li>
                                        <a href="#">Login</a>
                                    </li>
                                    <li>
                                        <a href="#">My Account</a>
                                    </li>
                                    <li>
                                        <a href="#">My Wishlist</a>
                                    </li>
                                </ul>
                            </li>

                        </ul> <!-- end menu -->
                    </div> <!-- end collapse -->
                </div> <!-- end col -->

            </div> <!-- end row -->
        </div> <!-- end container -->
    </div> <!-- end navigation -->
</nav> <!-- end navbar -->