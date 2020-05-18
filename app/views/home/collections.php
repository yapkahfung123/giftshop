<?php include_once APPROOT . '/views/home/inc/header.php'?>
<?php include_once APPROOT . '/views/home/inc/topbar.php'?>
<?php include_once APPROOT . '/views/home/inc/navbar.php'?>

<!-- Collections -->
<section class="section-wrap">
    <div class="container">
        <div class="row row-10">
            <?php foreach ($data['categories'] as $k => $v) : ?>
            <div class="col-sm-6">
                <a href="<?= URLROOT ?>home/all_products?category_id=<?= $v->cat_id ?>" class="collection-item">
                    <?php if (empty($v->img_path)){ ?>
                        <img src="<?= URLROOT ?>public/img/no-img.jpg" alt="">
                    <?php }else{?>
                        <img src="<?= URLROOT ?>public/img/uploads/category/<?= $v->img_path ?>" alt="">
                    <?php } ?>
                    <div class="overlay">
                        <h2 class="uppercase"><?= $v->cat_name ?></h2>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section
    <!-- end collections -->

<?php include_once APPROOT . '/views/home/inc/footer.php'?>
