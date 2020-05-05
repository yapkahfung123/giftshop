<?php include_once APPROOT . '/views/home/inc/header.php'?>
<?php include_once APPROOT . '/views/home/inc/topbar.php'?>
<?php include_once APPROOT . '/views/home/inc/navbar.php'?>

<!-- Breadcrumbs -->
<div class="container">
    <ol class="breadcrumb">
        <li>
            <a href="<?= URLROOT ?>">Home</a>
        </li>
        <li class="active">
            404
        </li>
    </ol> <!-- end breadcrumbs -->
</div>

<!-- 404 -->
<section class="section-wrap page-404">
    <div class="container">

        <div class="row text-center">
            <div class="col-md-6 col-md-offset-3">
                <h1>404</h1>
                <h2 class="mb-50">Page Not Found</h2>
                <p class="mb-20">You can go back to <a href="index.html">Homepage</a> or use search</p>
                <form class="relative">
                    <input type="search" placeholder="Search" class="mb-0">
                    <button type="submit" class="search-button"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>

    </div>
</section>
<!-- end 404 -->

<?php include_once APPROOT . '/views/home/inc/footer.php'?>
