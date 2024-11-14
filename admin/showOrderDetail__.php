<?php
require('require/top.php');
$oid = $_GET['id'];
$allSeller = array();
$sellerInfo = array();
?>
<div class="wrwr">
    <div class="path" id="path">
        <a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> لوحة التحكم</a>
        <span>/</span>
        <a href="showOrderDetail.php?id=<?php echo $_GET['id']; ?>">تفاصيل الطلب</a>
    </div>
    <div class="catbox-row">
        <div class="catbox">
            <section class="myorders">
                <section class="myac-body">
                    <div class="flex row">
                        <div class="right">
                            <div class="col-lg-12 col-md-12" id="bill-sec">
                                <?php
                                $query = "select orders.payment_type,orders.dv_time,orders.order_status,orders.id,orders.o_id,orders.total_amt,orders.ship_fee_order,orders.final_val,dv_time.from,dv_time.tto,order_status.o_status from orders,dv_time,order_status where orders.id='$oid' and orders.dv_date=dv_time.id and not orders.order_status='1' and orders.order_status=order_status.id and orders.ptu='0'";
                                $res = mysqli_query($con, $query);
                                if (mysqli_num_rows($res) > 0) {
                                    while ($row = mysqli_fetch_assoc($res)) {

                                ?>
                                        <div class="call-bill">
                                            <div class="order-bill-slip">
                                                <span style="
                                        padding: 0.6rem 1rem;
                                        font-size:1.3rem;
                                        border-radius: 15px;
                                        background-color: #e6faee;
                                        color: #43dc80;
                                    "> <?php echo $row['o_status']; ?> </span>
                                            </div>
                                        </div>
                                        <div class="pdpt-bg">
                                            <div class="pdpt-title flex justify-between">
                                                <h4>رقم الطلب: <?php echo $row['o_id']; ?></h4>
                                                <h6>وقت التسليم: <?php echo $row['dv_time']; ?>, <?php echo $row['from']; ?>
                                                    -
                                                    <?php echo $row['tto']; ?></h6>
                                                <h6><?php
                                                    $fg = mysqli_query($con, "select order_time.added_on,order_status.o_status from order_time,order_status where order_time.oid='$oid' and order_time.o_status=order_status.id");
                                                    while ($rw = mysqli_fetch_assoc($fg)) {
                                                        echo $rw['o_status'] . " : " . $rw['added_on'] . "<br>";
                                                    }

                                                    ?></h6>
                                            </div>
                                            <div class="order-body10">
                                                <?php
                                                $oid = $row['id'];
                                                $rs = mysqli_query($con, "select order_detail.delivered_qty,order_detail.hover,order_detail.rcvd,order_detail.qty,product.product_name,product.img1,product.id,product.fa,product.added_by,sellers.f_name,commission.com from order_detail,product,sellers,commission where order_detail.oid='$oid' and order_detail.p_id=product.id and product.added_by=sellers.id and product.scat_id=commission.scat_id");
                                                $totalOrderedPricePerSeller = 0;
                                                $totalReceivedPricePerSeller = 0;
                                                while ($rw = mysqli_fetch_assoc($rs)) {
                                                    $totalOrderedPricePerSeller += $rw['qty'] * $rw['fa'];
                                                    $totalReceivedPricePerSeller += $rw['delivered_qty'] * $rw['fa'];
                                                    $g = $rw['added_by'];


                                                ?>
                                                    <ul class="order-dtsll">
                                                        <li>
                                                            <div class="order-dt-img">
                                                                <img src="../media/product/<?php echo $rw['img1']; ?>" alt="" />
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="order-dt47">
                                                                <h4><?php echo $rw['product_name']; ?></h4>
                                                                <div class="order-title">
                                                                    المطلوب: <?php echo $rw['qty']; ?> قطعة
                                                                </div>
                                                                <div class="order-title">
                                                                    تم التسليم: <?php echo $rw['delivered_qty']; ?> قطعة
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="order-dt47">
                                                                <h4>السعر</h4>
                                                                <div class="order-title">
                                                                    $<?php echo $rw['qty'] * $rw['fa']; ?>
                                                                </div>
                                                                <div class="order-title">
                                                                    $<?php echo $rw['delivered_qty'] * $rw['fa']; ?>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                <?php


                                                }
                                                ?>
                                                <div class="total-dt">
                                                    <div class="total-checkout-group">
                                                        <div class="cart-total-dil">
                                                            <h4>المجموع الكلي</h4>
                                                            <span>$<?php echo $row['total_amt']; ?></span>
                                                        </div>
                                                        <div class="cart-total-dil pt-3">
                                                            <h4>رسوم التوصيل</h4>
                                                            <span>$<?php echo $row['ship_fee_order']; ?></span>
                                                        </div>
                                                        <div class="cart-total-dil pt-3">
                                                            <h4>طريقة الدفع</h4>
                                                            <span><?php
                                                                    if ($row['payment_type'] == 1) {
                                                                        echo "الدفع عند الاستلام";
                                                                    } else {
                                                                        echo "عبر الإنترنت";
                                                                    }
                                                                    ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="main-total-cart">
                                                        <h2>الإجمالي</h2>
                                                        <span>$<?php echo $row['final_val']; ?></span>
                                                    </div>
                                                    <div class="main-total-cart">
                                                        <h2>المبلغ المدفوع من قبل المستخدم</h2>
                                                        <span>$<?php echo $row['final_val']; ?></span>
                                                    </div>
                                                    <?php
                                                    if ($row['payment_type'] == 2 && ($totalOrderedPricePerSeller - $totalReceivedPricePerSeller) > 0) {
                                                    ?>
                                                        <div class="main-total-cart">
                                                            <input type="text" style="border:1px solid #eaeaea;" id='dfghert' value="<?php $gg = ($totalOrderedPricePerSeller - $totalReceivedPricePerSeller) + $row['ship_fee_order'];
                                                                                                                                        echo $gg; ?>">
                                                            <button style="
                                                    border-radius: 4px;
                                                    padding: 0.8rem;
                                                    background-color: #556ee6;
                                                    color: #fff;
                                                    float: right;
                                                    " onclick="finalizewithuser(<?php echo $oid; ?>)">تنهي</button>
                                                        </div>
                                                    <?php } else {
                                                    ?>
                                                        <div class="main-total-cart">
                                                            <button style="
                                                    border-radius: 4px;
                                                    padding: 0.8rem;
                                                    background-color: #556ee6;
                                                    color: #fff;
                                                    float: right;
                                                    " onclick="finalize(<?php echo $oid; ?>)">تنهي</button>
                                                        </div>

                                                    <?php
                                                    } ?>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                                <br>
                            </div>
                        </div>
                    </div>
                </section>
            </section>
        </div>
    </div>
    <div class="row" style="
              display: block;
              margin-bottom: 2rem;
              font-size: 1.2rem;
              color: #6a7187;
            ">
        @ 2024 famliyproducts. جميع الحقوق محفوظة.
    </div>
</div>
<?php
require('require/foot.php');
?>