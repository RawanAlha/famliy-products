<?php
require('require/top.php');
$oid = $_GET['id'];
$rw = mysqli_fetch_assoc(mysqli_query($con, "select * from orders where o_id='$oid'"));
$qu = "select order_detail.*,orders.payment_type,product.img1,product.fa,product.name,commition.commission from order_detail,orders,product,commition where order_detail.order_id='$oid' and product.id=order_detail.product_id and commition.subcat=product.subcat and order_detail.status='Undelivered' and orders.o_id=order_detail.order_id";
$rs = mysqli_query($con, $qu);
$t = array();
while ($rt = mysqli_fetch_assoc($rs)) {
    $t[] = $rt;
}
?>
<div class="wrwr">
    <div class="path" id="path">
        <a href="index.html"><i class="fa fa-home" aria-hidden="true"></i> الرئيسية</a>
        <span>/</span>
        <a href="showOrderDetail.html">تفاصيل الطلب</a>
    </div>
    <div class="catbox-row">
        <div class="catbox">
            <div class="bspace">
                <div class="head" style="display:block">
                    <div class="orderid"> <?php echo $oid; ?></div>
                </div>
                <table style="width:100%">
                    <thead>
                        <th style="font-size:1.4rem;font-weight:400;padding:0.2rem;border-bottom:1px solid #e2e2e2;">
                            الصورة</th>
                        <th style="font-size:1.4rem;font-weight:400;padding:0.2rem;border-bottom:1px solid #e2e2e2;">
                            الاسم</th>
                        <th style="font-size:1.4rem;font-weight:400;padding:0.2rem;border-bottom:1px solid #e2e2e2;">
                            الكمية</th>
                        <th style="font-size:1.4rem;font-weight:400;padding:0.2rem;border-bottom:1px solid #e2e2e2;">
                            السعر الإجمالي</th>
                        <th style="font-size:1.4rem;font-weight:400;padding:0.2rem;border-bottom:1px solid #e2e2e2;">
                            الحالة</th>
                    </thead>
                    <tbody>
                        <?php
                        $tp = 0;
                        $i = 0;
                        $slinfo = array();
                        foreach ($t as $p) {
                            $shipid = get_id();
                            $shipnameid = get_id();
                            $oidd = $p['order_id'];
                            $pid = $p['product_id'];
                            $mm = mysqli_num_rows(mysqli_query($con, "select * from reforrep where oid='$oidd'"));

                        ?>
                            <tr>
                                <td style="padding: 1rem 0.8rem;border-bottom:1px solid #e2e2e2;text-align:center;font-size:1.4rem;">
                                    <img src="../media/product/<?php echo $p['img1']; ?>" alt="product" style="height:8rem;width:8rem">
                                </td>
                                <td style="padding: 1rem 0.8rem;border-bottom:1px solid  #e2e2e2;text-align:center;font-size:1.4rem;">
                                    <?php echo $p['name']; ?>
                                    <br><br>
                                    <?php
                                    if ($mm > 0) {
                                        $r = mysqli_fetch_assoc(mysqli_query($con, "select * from reforrep where oid='$oidd' and pid='$pid'"));
                                        if ($r['isdone'] == 0) {
                                    ?>
                                            <span style="font-size: 1.1rem; padding:0.5rem; background:#ffa500a3;border-radius:10px">
                                                <?php echo $r['repref']; ?> مطلوب
                                            </span>
                                        <?php  } else {
                                        ?>
                                            <span style="font-size: 1.1rem; padding:0.5rem; background:#ffa500a3;border-radius:10px">
                                                <?php echo $r['repref']; ?> تم التنفيذ
                                            </span>
                                    <?php
                                        }
                                    } ?>
                                </td>
                                <td style="padding: 1rem 0.8rem;border-bottom:1px solid  #e2e2e2;text-align:center;font-size:1.4rem;">
                                    <?php echo $p['qty']; ?>
                                </td>
                                <td style="padding: 1rem 0.8rem;border-bottom:1px solid  #e2e2e2;text-align:center;font-size:1.4rem;">
                                    &#8377; <?php $o = $p['qty'] * $p['fa'];
                                            echo $o; ?>
                                </td>
                                <td style="padding: 1rem 0.8rem;border-bottom:1px solid  #e2e2e2;text-align:center;font-size:1.4rem;">
                                    <?php echo $p['status']; ?>
                                </td>
                            </tr>
                            <?php
                            if ($p['status'] == "Placed" || $p['status'] == "") {
                            ?>
                                <tr>
                                    <td style="border-bottom:1px solid #e2e2e2;">
                                        <input type="text" id="<?php echo $shipnameid ?>" placeholder="اسم الشركة الناقلة" style="border:1px solid #e2e2e2;padding:0.5rem;width:10rem;margin-left:auto">
                                    </td>
                                    <td style="border-bottom:1px solid #e2e2e2;">
                                        <input type="text" id="<?php echo $shipid ?>" placeholder="معرف الشحن" style="border:1px solid #e2e2e2;padding:0.5rem;width:10rem">
                                    </td>
                                    <td style="border-bottom:1px solid #e2e2e2;">
                                        <button style="height: 3.2rem;
                                width: 8rem;
                                border-radius: 5px;
                                background-color: #556ee6;
                                color: #fff;" onclick="
                                    ship_product('<?php echo $p['id']; ?>','<?php echo $shipid ?>','<?php echo $shipnameid ?>')">تقديم</button>
                                    </td>
                                    <td style="border-bottom:1px solid #e2e2e2;"></td>
                                    <td style="border-bottom:1px solid #e2e2e2;"></td>
                                </tr>
                            <?php
                            } else if ($p['status'] == "Placed" || $p['status'] == "Shipped") {
                            ?>
                                <tr>

                                    <td style="border-bottom:1px solid #e2e2e2;">
                                        <button style="height: 3.2rem;
                                width: 8rem;
                                border-radius: 5px;
                                background-color: #556ee6;
                                color: #fff;" onclick="deliver_product('<?php echo $p['id']; ?>')">تم التسليم</button>
                                    </td>
                                    <td style="border-bottom:1px solid #e2e2e2;">
                                        <button style="height: 3.2rem;
                                width: 8rem;
                                border-radius: 5px;
                                background-color: #556ee6;
                                color: #fff;" onclick="ship_product('<?php echo $p['id']; ?>','<?php echo $shipid ?>','<?php echo $shipnameid ?>')">لم يتم التسليم</button>
                                    </td>
                                    <td style="border-bottom:1px solid #e2e2e2;"></td>
                                    <td style="border-bottom:1px solid #e2e2e2;">
                                    </td>
                                </tr>
                        <?php
                            }
                            $tp += $o;
                            if ($p['payment_type'] != "COD") {
                                $slinfo[$i] = 1;
                                $payable[$i] = $p['qty'] * $p['fa'];
                                $order_detail_id[$i] = $p['id'];
                                $auw[$i] = $p['auw'];
                            }

                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
                <table style="margin-top:2rem;">
                    <tr>
                        <td style="padding: 1rem 0.8rem;font-size:1.5rem;">الاسم: </td>
                        <td style="padding: 1rem 0.8rem;font-size:1.5rem;"><?php echo $rw['name']; ?></td>
                    </tr>
                    <tr>
    <td style="padding: 1rem 0.8rem;font-size:1.5rem;">العنوان: </td>
    <td style="padding: 1rem 0.8rem;font-size:1.5rem;">
        <?php echo $rw['city']; ?>,
        <?php echo $rw['landmark']; ?>,
        <?php echo $rw['state']; ?>,
        <?php echo $rw['country']; ?>,<?php echo $rw['pin']; ?>.<br>
        <?php echo $rw['mobile']; ?>
    </td>
</tr>
<tr>
    <td style="padding: 1rem 0.8rem;font-size:1.5rem;">التاريخ: </td>
    <td style="padding: 1rem 0.8rem;font-size:1.5rem;"> <?php echo $rw['added_on']; ?></td>
</tr>
<tr>
    <td style="padding: 1rem 0.8rem;font-size:1.5rem;">السعر الإجمالي: </td>
    <td style="padding: 1rem 0.8rem;font-size:1.5rem;"> $ <?php echo $tp; ?></td>
</tr>
<tr>
    <td style="padding: 1rem 0.8rem;font-size:1.5rem;">الخصم: </td>
    <td style="padding: 1rem 0.8rem;font-size:1.5rem;"> <?php
        if (empty($rw['discount'])) {
            echo "0";
        } else {
            echo $rw['discount'];
        } ?>%</td>
</tr>
<tr>
    <td style="padding: 1rem 0.8rem;font-size:1.5rem;">المجموع الكلي: </td>
    <td style="padding: 1rem 0.8rem;font-size:1.5rem;"> $ <?php echo $rw['total_price']; ?>
    </td>
</tr>
<tr>
    <td style="padding: 1rem 0.8rem;font-size:1.5rem;">وضع الدفع: </td>
    <td style="padding: 1rem 0.8rem;font-size:1.5rem;"> <?php echo $rw['payment_type']; ?></td>
</tr>
<tr>
    <td style="padding: 1rem 0.8rem;font-size:1.5rem;">حالة الدفع: </td>
    <td style="padding: 1rem 0.8rem;font-size:1.5rem;"> <?php echo $rw['payment_status']; ?></td>
</tr>
<tr>
    <td style="padding: 1rem 0.8rem;font-size:1.5rem;">معرف المعاملة: </td>
    <td style="padding: 1rem 0.8rem;font-size:1.5rem;"><?php echo $rw['txnid']; ?></td>
</tr>
<?php
$h = 0;
$v = 1;
foreach ($slinfo as $stlinfo) {
    $cd = get_id();
?>
    <tr>
        <td style="padding: 1rem 0.8rem;font-size:1.5rem;">المنتج <?php echo $v; ?>: </td>
        <td style="padding: 1rem 0.8rem;font-size:1.5rem;"><?php
            echo $payable[$h];
            ?></td>
        <?php
        if ($auw[$h] == 0) {
        ?>
            <td style="padding: 1rem 0.8rem;font-size:1.5rem;">
                دفع للمستخدم:
                <input type="text" value="<?php echo $payable[$h]; ?>" id="<?php echo $cd; ?>" style="border:1px solid #e2e2e2;padding:0.5rem;width:10rem;margin-left:auto">
                <button style="height: 3.2rem;
            width: 8rem;
            border-radius: 5px;
            background-color: #556ee6;
            color: #fff;" onclick="pay_user_wallet('<?php echo $order_detail_id[$h]; ?>','<?php echo $cd; ?>')">دفع</button>
            </td>
        <?php } else if ($auw[$h] == 1) { ?>
            <td style="padding: 1rem 0.8rem;font-size:1.5rem;"><?php
                echo "تم الاعتماد";
                ?></td>
        <?php } ?>
    </tr>
<?php
    $h++;
    $v++;
}

?>
</table>
</div>
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