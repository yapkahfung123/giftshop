<!-- Navigation -->
<header class="nav-type-1">

    <div class="top-bar hidden-sm hidden-xs">
        <div class="container">
            <div class="top-bar-line">
                <div class="row">
                    <div class="top-bar-links">
                        <ul class="col-sm-6 top-bar-acc">
                            <?= isset($_SESSION['user_id'])? '<li class="top-bar-link"><a href="'. URLROOT .'home/account">My Account</a></li>' : '' ?>
<!--                            <li class="top-bar-link"><a href="#">My Wishlist</a></li>-->
                            <?= !isset($_SESSION['user_id'])? '<li class="top-bar-link"><a href="'. URLROOT . 'home/login">Login</a></li>' : "" ?>
                        </ul>

                        <ul class="col-sm-6 text-right top-bar-currency-language">
                            <?php /*
                            <li>
                                Currency: <a href="#">USD<i class="fa fa-angle-down"></i></a>
                                <div class="currency-dropdown">
                                    <ul>
                                        <li><a href="#">USD</a></li>
                                        <li><a href="#">EUR</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="language">
                                Language: <a href="#">ENG<i class="fa fa-angle-down"></i></a>
                                <div class="language-dropdown">
                                    <ul>
                                        <li><a href="#">English</a></li>
                                        <li><a href="#">Spanish</a></li>
                                        <li><a href="#">German</a></li>
                                        <li><a href="#">Chinese</a></li>
                                    </ul>
                                </div>
                            </li>
                            */?>
                            <li>
                                <div class="social-icons">
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                    <a href="#"><i class="fa fa-vimeo"></i></a>
                                </div>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>

        </div>
    </div> <!-- end top bar -->