<?php include_once APPROOT . '/views/home/inc/header.php'?>
<?php include_once APPROOT . '/views/home/inc/topbar.php'?>
<?php include_once APPROOT . '/views/home/inc/navbar.php'?>

<!-- login -->
<section class="section-wrap login-register pt-1 pb-40">
    <div class="container">
        <div class="row">
            <div class="col-sm-5 col-sm-offset-1 mb-40">
                <form action="" method="post">
                    <div class="register">
                        <?php
                        if(!empty($data['error_msg'])){
                            echo '<div class="alert alert-danger fade in alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                              <strong>'. $data['error_msg'] .'</strong>
                              </div>';
                        }
                        ?>
                        <h4 class="uppercase">Register</h4>
                        <p class="form-row form-row-wide">
                            <label>first name
                                <abbr class="required" title="required">*</abbr>
                            </label>
                            <input type="text" class="input-text" name="firstname" value="<?= isset($data['firstname'])? $data['firstname'] : '' ?>" required>
                        </p>
                        <p class="form-row form-row-wide">
                            <label>last name
                                <abbr class="required" title="required">*</abbr>
                            </label>
                            <input type="text" class="input-text" name="lastname" value="<?= isset($data['lastname'])? $data['lastname'] : '' ?>" required>
                        </p>
                        <p class="form-row form-row-wide">
                            <label>email
                                <abbr class="required" title="required">*</abbr>
                            </label>
                            <input type="email" class="input-text" name="email" value="<?= isset($data['email'])? $data['email'] : '' ?>" required>
                        </p>
                        <p class="form-row form-row-wide">
                            <label>password
                                <abbr class="required" title="required">*</abbr>
                            </label>
                            <input type="password" class="input-text" name="password" required>
                        </p><p class="form-row form-row-wide">
                            <label>confirm password
                                <abbr class="required" title="required">*</abbr>
                            </label>
                            <input type="password" class="input-text" name="confirm_password" required>
                        </p>
                        <input type="submit" value="Register" class="btn">
                        <a href="<?= URLROOT . 'home/login' ?>">Have Account? Login instead</a
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- end login -->


<?php include_once APPROOT . '/views/home/inc/footer.php'?>
