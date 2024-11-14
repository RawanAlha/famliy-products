<?php
require('require/top.php');
$cart = get_cart_products($con);
$total_subtotal = 0;
// print_r($_SESSION['USER_CART']);
?>
<div class="path">
    <div class="container">
        <a href="index.php">الرئيسية</a>
        /
        <a href="cart.php">العربة</a>
    </div>
</div>
<section class="cart">
    <section class="myac-body">
        <div class="flex row">
            <div class="right">
                <div class="col-lg-12 col-md-12">
                    <div class="pdpt-bg">
                        <div class="pdpt-title flex justify-between">
                            <h4>
                                <i class="uil uil-shopping-cart-alt"></i> &nbsp;سلتي
                            </h4>
                        </div>
                        <div class="order-body10">
                            <table>
                                <thead>
                                    <th>
                                        <h5>المنتج</h5>
                                    </th>
                                    <th>
                                        <h5>السعر</h5>
                                    </th>
                                    <th>
                                        <h5>الكمية</h5>
                                    </th>
                                    <th>
                                        <h5>المجموع الفرعي</h5>
                                    </th>
                                    <th>
                                        <h5>حذف</h5>
                                    </th>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($cart) > 0) {
                                        foreach ($cart as $product) {
                                            if (!isset($_SESSION['USER_LOGIN'])) {
                                                $p_qy = $product['product_qty'];
                                            } else {
                                                $p_qy = $product['qty'];
                                            }
                                    ?>
                                            <tr>
                                                <td>
                                                    <div class="product">
                                                        <a href="">
                                                            <img src="media/product/<?php echo $product['img1'] ?>" alt="" />
                                                        </a>
                                                        <h6><?php echo $product['product_name'] ?></h6>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="price">
                                                        <h6>ريال<?php echo $product['fa'] ?></h6>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="qty">
                                                        <div class="box">
                                                            <input type="text" value="<?php echo $p_qy; ?>" />
                                                            <div class="btnbv">
                                                                <button onclick="inc(this,<?php echo $product['id']; ?>)">+</button>
                                                                <button onclick="de_sc(this,<?php echo $product['id']; ?>)">-</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="price">
                                                        <h6>ريال<?php
                                                                    $sftp = $p_qy * $product['fa'];
                                                                    $total_subtotal += $sftp;
                                                                    echo $sftp;
                                                                    ?></h6>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="price">
                                                        <h6>
                                                            <i class="uil uil-trash-alt" onclick="del_cart(<?php echo $product['id'] ?>)"></i>
                                                        </h6>
                                                    </div>
                                                </td>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="left">
                <div class="ul-wrapper">
                    <h4>إجمالي العربة</h4>
                    <?php
                    if (!isset($_SESSION['USER_LOGIN'])) {
                        if ($total_subtotal > 0) {
                    ?>
                            <table>
                                <tr>
                                    <td>
                                        <h6>المجموع الفرعي</h6>
                                    </td>
                                    <td>
                                        <h6>ريال<?php echo $total_subtotal; ?></h6>
                                    </td>
                                </tr>
                            </table>
                            <div class="cktout">
                                <button onclick="control.redirect('checkout.php')">المتابعة إلى الدفع</button>
                            </div>
                            <?php
                        }
                    } else {
                        $utm = $_SESSION['utm_source'];
                        $uid = $_SESSION['USER_ID'];
                        $rs = mysqli_query($con, "select * from cart where u_id='$uid' and belonging_city='$utm'");
                        if (mysqli_num_rows($rs) > 0) {
                            $ct = mysqli_fetch_assoc($rs);

                            if ($ct['total'] > 0) {
                            ?>

                                <table>
                                    <tr>
                                        <td>
                                            <h6>المجموع الفرعي</h6>
                                        </td>
                                        <td>
                                            <h6>ريال<?php echo $ct['total']; ?></h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>الشحن</h6>
                                        </td>
                                        <td>
                                            <h6>ريال
                                                <?php
                                                echo $ct['ship_fee'];
                                                ?></h6>
                                        </td>
                                    </tr>
                                    <?php
                                    if ($ct['is_applied']) {
                                    ?>
                                        <tr>
                                            <td>
                                                <h6>العرض الترويجي</h6>
                                            </td>
                                            <td>
                                                <h6>-ريال
                                                    <?php
                                                    echo $ct['promo'];
                                                    ?></h6>
                                            </td>
                                        </tr>
                                    <?php }
                                    if ($ct['is_add_w']) {
                                    ?>

                                        <tr>
                                            <td>
                                                <h6>من المحفظة</h6>
                                            </td>
                                            <td>
                                                <h6>-ريال
                                                    <?php
                                                    echo $ct['wl_amt'];
                                                    ?></h6>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                        <td>
                                            <h6>المجموع الكلي</h6>
                                        </td>
                                        <td>
                                            <h6>ريال<?php echo $ct['final_amt']; ?></h6>
                                        </td>
                                    </tr>
                                </table>

                                <div class="cktout">
                                    <button onclick="control.redirect('checkout.php')">المتابعة إلى الدفع</button>
                                </div>
                            <?php
                            }
                            ?>
                    <?php }
                    }

                    ?>

                </div>
            </div>
        </div>
    </section>
</section>
<?php require('require/foot.php'); ?>
<?php require('require/last.php'); ?>
