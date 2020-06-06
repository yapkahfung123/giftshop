<?php include_once APPROOT . '/views/home/inc/header.php' ?>
<?php include_once APPROOT . '/views/home/inc/topbar.php' ?>
<?php include_once APPROOT . '/views/home/inc/navbar.php' ?>

<!-- Cart -->
<section class="section-wrap shopping-cart pt-0">
    <div class="container relative">
        <div class="row">

            <div class="col-md-12">

                <?php
                if (isset($_SESSION['successfully'])){
                    echo '<div class="alert alert-success fade in alert-dismissible" role="alert" style="text-align: center">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                              <strong>'. $_SESSION['successfully'] .'</strong>
                              </div>';
                }unset($_SESSION['successfully']);

                if (!empty($_SESSION['error_msg'])) {
                    echo '<div class="alert alert-danger fade in alert-dismissible" role="alert" style="text-align: center">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                              <strong>' . $_SESSION['error_msg'] . '</strong>
                              </div>';
                }unset($_SESSION['error_msg'])

                ?>

                <form action="../app/update_cart" method="post">
                    <div class="table-wrap mb-30">
                        <table class="shop_table cart table">
                            <thead>
                            <tr>
                                <th class="product-name" colspan="2">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-subtotal">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if($data['login'] == 1): ?>
                                <?php foreach ($data['cart'] as $k => $v):
                                    $img = json_decode($v->img_path);
                                    ?>
                                    <tr class="cart_item">
                                        <td class="product-thumbnail">
                                            <a href="javascript::void(0)">
                                                <?php if(!empty($img)): ?>
                                                    <img src="<?= URLROOT ?>public/img/uploads/products/<?= $v->product_id . '/' . $img[0] ?>" alt=""/>
                                                <?php else: ?>
                                                    <img src="<?= URLROOT ?>public/img/no-img.jpg" alt=""/>
                                                <?php endif; ?>
                                            </a>
                                        </td>
                                        <td class="product-name">
                                            <a href="#"><?= ucfirst($v->product_name); ?></a>
                                            <ul>
                                                <?php if(!empty($v->variation)):
                                                    $var_decode = json_decode($v->variation);
                                                    foreach ($var_decode as $key => $value) :
                                                        $array = (array) $value;

                                                        ?>
                                                        <li><?= ucfirst(array_keys($array)[0]) . ' : ' . ucfirst(array_values($array)[0]);  ?></li>

                                                    <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </ul>
                                        </td>
                                        <td class="product-price">
                                            <span class="amount">RM <?= $v->price ?></span>
                                        </td>
                                        <td class="product-quantity">
                                            <div class="quantity buttons_added">
                                                <input type="hidden" name="cart_id[]" value="<?= $v->cart_id ?>">
                                                <input type="button" value="-" class="minus"/>
                                                <input type="number" name="qty[]" step="1" min="0" value="<?= $v->quantity ?>" title="Qty" class="input-text qty text"/>
                                                <input type="button" value="+" class="plus"/>
                                            </div>
                                        </td>
                                        <td class="product-subtotal">
                                            <span class="amount">Rm <?= number_format($v->price * $v->quantity, 2) ?></span>
                                        </td>
                                        <td class="product-remove">
                                            <a href="javascript:void(0)" class="remove" title="Remove this item" onclick="delete_cart(<?= $v->cart_id ?>)">
                                                <i class="icon icon_close"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            <?php else: ?>
                                <section class="section-wrap page-404">
                                    <div class="container">

                                        <div class="row text-center">
                                            <div class="col-md-6 col-md-offset-3">
                                                <h1>Login To Trace Your Cart</h1>
                                                <p class="mb-20"><a href="/home/login">Login Now!</a></p>


                                                <p class="mb-20">Dont Have An Account? <a href="/home/register">Register Now!</a></p>

                                            </div>
                                        </div>

                                    </div>
                                </section>


                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="row mb-50">
                        <div class="col-md-5 col-sm-12">
                            <div class="coupon">
                                <input type="text" name="coupon_code" id="coupon_code" class="input-text form-control" value
                                       placeholder="Coupon code">
                                <input type="submit" name="apply_coupon" class="btn btn-md btn-dark" value="Apply">
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="actions right">
                                <input type="submit" name="submit" value="Update Cart" class="btn btn-md btn-dark">
                                <div class="wc-proceed-to-checkout">
                                    <a href="checkout.html"
                                       class="btn btn-md btn-color"><span>proceed to checkout</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div> <!-- end col -->
        </div> <!-- end row -->

        <div class="row">
            <div class="col-md-6 shipping-calculator-form">
                <h2 class="heading relative heading-small uppercase mb-30">Calculate Shipping</h2>
                <p class="form-row form-row-wide">
                    <select name="calc_shipping_country" id="calc_shipping_country" class="country_to_state"
                            rel="calc_shipping_state">
                        <option>Select a country…</option>
                        <option value="my">Malaysia</option>
                    </select>
                </p>

                <div class="row row-20">
                    <div class="col-sm-6">
                        <p class="form-row form-row-wide">
                            <input type="number" min="5" max="5" class="input-text" placeholder="Postcode" name="calc_shipping_postcode" id="calc_shipping_postcode">
                        </p>
                    </div>

                    <div class="col-sm-6">
                        <p class="form-row form-row-wide">
                            <select class="input-text" name="calc_shipping_state" id="calc_shipping_state" style="cursor: no-drop;">
                                <option value="">Select State</option>
                                <?php foreach ($data['state_list'] as $k=>$v) : ?>
                                <option value="<?= str_replace(' ', '', $v) ?>"><?= $v ?></option>
                                <?php endforeach; ?>
                            </select>
                        </p>
                    </div>
                </div>

                <p>
                    <button type="submit" name="calc_shipping" value="1" class="btn btn-md btn-dark mt-20 mb-mdm-40">
                        Update Totals
                    </button>
                </p>
            </div> <!-- end col shipping calculator -->

            <div class="col-md-4 col-md-offset-2">
                <div class="cart_totals">
                    <h2 class="heading relative heading-small uppercase mb-30">Cart Totals</h2>

                    <table class="table shop_table">
                        <tbody>
                        <tr class="cart-subtotal">
                            <th>Cart Subtotal</th>
                            <td>
                                <span class="amount">RM <?= getCartTotal($_SESSION['user_id']); ?></span>
                            </td>
                        </tr>
                        <tr class="shipping">
                            <th>Shipping</th>
                            <td>
                                <span>Free Shipping</span>
                            </td>
                        </tr>
                        <tr class="order-total">
                            <th><strong>Order Total</strong></th>
                            <td>
                                <strong><span class="amount">RM <?= getCartTotal($_SESSION['user_id']); ?></span></strong>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div> <!-- end col cart totals -->

        </div> <!-- end row -->


    </div> <!-- end container -->
</section>

<script src="<?= URLROOT ?>public/js/addcart/add-to-cart.js"></script>

<script>
    $('#calc_shipping_postcode').keyup(function () {
        var postcode = $(this).val();
        if (postcode.length == 5) {
            $.ajax({
                url: '../api/get_state',
                method: 'post',
                data: {
                    'postcode': postcode
                },
                success: function (response) {
                    var data = JSON.parse(response);
                    if(data.region != null && data.state_name != null){
                        $('#calc_shipping_state option:selected').removeAttr('selected');
                        $('#calc_shipping_state option[value=' + data.state_name.replace(/\s/g, "") + ']').attr('selected', 'selected');
                    }
                }
            })
        }
    })
</script>
<!-- end cart -->


<?php include_once APPROOT . '/views/home/inc/footer.php' ?>
