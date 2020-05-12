<?php include_once APPROOT . '/views/home/inc/header.php' ?>
<?php include_once APPROOT . '/views/home/inc/topbar.php' ?>
<?php include_once APPROOT . '/views/home/inc/navbar.php' ?>

<!-- Page Title -->
<section class="page-title text-center">
    <div class="container relative clearfix">
        <div class="title-holder">
            <div class="title-text">
                <h1 class="uppercase">My Account</h1>
            </div>
        </div>
    </div>
</section> <!-- end page title -->

<!-- My Account -->
<section class="section-wrap woocommerce-account pt-0 pb-60">
    <div class="container">
        <div class="woocommerce">
            <?php include_once APPROOT . '/views/home/account/inc/nav.php' ?>

            <div class="woocommerce-MyAccount-content">
                <?php
                if (isset($data['success'])){
                    echo '<div class="alert alert-success fade in alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                          <strong>'. $data['success'] .'</strong>
                          </div>';
                }unset($data['success']);
                ?>

                <form class="woocommerce-EditAccountForm edit-account" action="" method="post">

                    <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
                        <label for="account_first_name">First name&nbsp;<span class="required">*</span></label>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name" autocomplete="off" value="<?= $data['data']->firstname ?>">
                    </p>
                    <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
                        <label for="account_last_name">Last name&nbsp;<span class="required">*</span></label>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" autocomplete="family-name" value="<?= $data['data']->lastname ?>">
                    </p>
                    <div class="clear"></div>

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="account_email">Email address&nbsp;<span class="required" style="color: red">*Unable To Change This</span></label>
                        <input type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" autocomplete="email" value="<?= $data['data']->email ?>" readonly>
                    </p>
                    <div class="clear"></div>

                    <p>
                        <button type="submit" class="btn btn-lg woocommerce-Button button" name="submit" value="Save changes">Save changes</button>
                    </p>

                    <div class="clear"></div>

                </form>
            </div>

        </div>
    </div>
</section> <!-- end my account -->


<?php include_once APPROOT . '/views/home/inc/footer.php' ?>
