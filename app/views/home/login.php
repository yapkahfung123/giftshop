<?php include_once APPROOT . '/views/home/inc/header.php'?>
<?php include_once APPROOT . '/views/home/inc/topbar.php'?>
<?php include_once APPROOT . '/views/home/inc/navbar.php'?>

<!-- login -->
<section class="section-wrap login-register pt-1 pb-40">
    <div class="container">
        <div class="row">
            <div class="col-sm-5 col-sm-offset-1 mb-40 vl">
                <form action="" method="post">
                    <div class="login">
                        <?php
                        if (isset($_SESSION['successfully'])){
                            echo '<div class="alert alert-success fade in alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                              <strong>'. $_SESSION['successfully'] .'</strong>
                              </div>';
                        }unset($_SESSION['successfully']);

                        if (!empty($data['error_msg'])) {
                            echo '<div class="alert alert-danger fade in alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                              <strong>' . $data['error_msg'] . '</strong>
                              </div>';
                        }

                        ?>
                        <h4 class="uppercase">login</h4>
                        <p class="form-row form-row-wide">
                            <label>email
                                <abbr class="required" title="required">*</abbr>
                            </label>
                            <input type="text" class="input-text" name="email" placeholder="" value="<?= isset($_COOKIE['user_email'])? $_COOKIE['user_email']:'';?>" required>
                        </p>
                        <p class="form-row form-row-wide">
                            <label>password
                                <abbr class="required" title="required">*</abbr>
                            </label>
                            <input type="password" class="input-text" name="password" placeholder="" value="<?= isset($_COOKIE['user_pword'])? $_COOKIE['user_pword']:'';?>" required>
                        </p>
                        <input type="submit" value="Login" class="btn">
                        <input type="hidden" value="0" name="remember">
                        <input type="checkbox" class="input-checkbox" id="remember" name="remember" <?= isset($_COOKIE['user_email']) && isset($_COOKIE['user_pword'])? 'checked':'';?>>
                        <label for="remember" class="checkbox">Remember me</label>
                        <a href="#">Lost Password?</a>
                    </div>
                </form>
            </div>
            <div class="col-sm-5">
                <div class="register">
                    <h4 class="uppercase">Register</h4>
                    <p>Registering for this site allows you to access your order status and history. Just fill in the fields below, and we’ll get a new account set up for you in no time. We will only ask you for information necessary to make the purchase process faster and easier.</p>
                    <a href="<?= URLROOT . 'home/register'?>" style="float: none"><input type="button" value="Register" class="btn"></a>
                </div>
            </div>
        </div>
    </div>
</section> <!-- end login -->


<?php include_once APPROOT . '/views/home/inc/footer.php'?>
