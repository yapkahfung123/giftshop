<?php include_once APPROOT . '/views/home/inc/header.php'?>
<?php include_once APPROOT . '/views/home/inc/topbar.php'?>
<?php include_once APPROOT . '/views/home/inc/navbar.php'?>

<div class="container">
    <h1 class="text-center">
        <?php
        if (isset($_SESSION['login_successfully'])){
            echo '<div class="alert alert-success fade in alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                              <strong>'. $_SESSION['login_successfully'] .'</strong>
                              </div>';
        }unset($_SESSION['login_successfully']);
        ?>
    </h1>

    <a href="<?= URLROOT ?>home/logout"><button>LogOut</button></a>
</div>


<?php include_once APPROOT . '/views/home/inc/footer.php'?>
