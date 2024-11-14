<?php
require('require/top.php');
$oid = $_GET['id'];
$rw = mysqli_fetch_assoc(mysqli_query($con, "select * from orders where o_id='$oid'"));
$qu = "select order_detail.*,product.img1,product.fa,product.name,commition.commission from order_detail,product,commition where order_detail.order_id='$oid' and product.id=order_detail.product_id and commition.subcat=product.subcat";
$rs = mysqli_query($con, $qu);
$t = array();
while ($rt = mysqli_fetch_assoc($rs)) {
    $t[] = $rt;
}
// prx($t);
?>
<div class="wrwr">
    <div class="path" id="path">
        <a href="index.html"><i class="fa fa-home" aria-hidden="true"></i> لوحة التحكم</a>
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
                        <th style="font-size:1.4rem;font-weight:400;padding:0.2rem;border-bottom:1px solid #e2e2e2;">
                            معرف الشحن</th>
                        <th style="font-size:1.4rem;font-weight:400;padding:0.2rem;border-bottom:1px solid #e2e2e2;">
                            الشركة</th>
                        <th style="font-size:1.4rem;font-weight:400;padding:0.2rem;border-bottom:1px solid #e2e2e2;">
                            العمولة</th>
                    </thead>
                    <tbody>
                        <?php
                        $tp = 0;
                        $i = 0;
                        $j = 0;
                        $total_com = 0;
                        foreach ($t as $p) {
                            //prx($p);
                            $shipid = get_id();
                            $shipnameid = get_id();
                            $oidd = $p['id'];
                            $pid = $p['product_id'];
                            $mm = mysqli_num_rows(mysqli_query($con, "select * from reforrep where oid='$oidd' and isappr='1' or isappr='0'"));
                            if ($mm != 1) {
                                $rq = mysqli_fetch_assoc(mysqli_query($con, "select * from product where id='$pid'"));
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
                                                    <?php echo $r['repref']; ?> تم
                                                </span>
                                        <?php
                                            }
                                        } ?>
                                    </td>
                                    <td style="padding: 1rem 0.8rem;border-bottom:1px solid  #e2e2e2;text-align:center;font-size:1.4rem;">
                                        <?php echo $p['qty']; ?>
                                    </td>
                                    <td style="padding: 1rem 0.8rem;border-bottom:1px solid  #e2e2e2;text-align:center;font-size:1.4rem;">
                                        $ <?php $o = $p['qty'] * $p['fa'];
                                                echo $o; ?>
                                    </td>
                                    <td style="padding: 1rem 0.8rem;border-bottom:1px solid  #e2e2e2;text-align:center;font-size:1.4rem;">
                                        <?php echo $p['status']; ?>
                                    </td>
                                    <td style="padding: 1rem 0.8rem;border-bottom:1px solid  #e2e2e2;text-align:center;font-size:1.4rem;">
                                        <?php echo $p['shipping_id']; ?>
                                    </td>
                                    <td style="padding: 1rem 0.8rem;border-bottom:1px solid  #e2e2e2;text-align:center;font-size:1.4rem;">
                                        <?php echo $p['ship_name']; ?>
                                    </td>
                                    <td style="padding: 1rem 0.8rem;border-bottom:1px solid  #e2e2e2;text-align:center;font-size:1.4rem;">
                                        $ <?php
                                                echo ($p['commission'] * $o) / 100;
                                                $total_com += ($p['commission'] * $o) / 100;
                                                ?>
                                    </td>
                                </tr>
                                <?php
                                if ($rq['added_by'] == "ADMIN") {
                                    if ($p['status'] == "Placed") {
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
                                    } else {
                                    ?>
                                        <tr>

                                           <td style="border-bottom:1px solid #e2e2e2;">
    <button style="height: 3.2rem;
                    width: 8rem;
                    border-radius: 5px; 
                    background-color: #556ee6;
                    color: #fff;" onclick="
                        ship_product('<?php echo $p['id']; ?>','<?php echo $shipid ?>','<?php echo $shipnameid ?>')">تم التسليم</button>
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
}
$tp += $o;
if ($p['status'] == "Delivered") {
    if ($p['stlment'] == 0) {
        $slinfo[$i] = "معلق";
    } else {
        $slinfo[$i] = "تم";
    }
    $i++;
}
if ($p['clearence'] == 1) {
    $payable[$i] = $o - ($p['commission'] * $o) / 100;
    $order_detail_id[$i] = $p['id'];
    $payable2[$i] = $p['cdeduct'];
}
}
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
    <td style="padding: 1rem 0.8rem;font-size:1.5rem;">الإجمالي الكلي: </td>
    <td style="padding: 1rem 0.8rem;font-size:1.5rem;"> $ <?php echo $rw['total_price']; ?>
    </td>
</tr>
<tr>
    <td style="padding: 1rem 0.8rem;font-size:1.5rem;">طريقة الدفع: </td>
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
<tr>
    <td style="padding: 1rem 0.8rem;font-size:1.5rem;">العمولة الإجمالية: </td>
    <td style="padding: 1rem 0.8rem;font-size:1.5rem;"> $<?php echo $total_com; ?></td>
</tr>
<?php
$h = 1;
foreach ($slinfo as $stlinfo) {
    $cd = get_id();
?>
    <tr>
        <td style="padding: 1rem 0.8rem;font-size:1.5rem;">المنتج <?php echo $h; ?>: </td>
        <td style="padding: 1rem 0.8rem;font-size:1.5rem;">تسوية <?php echo $stlinfo; ?></td>
        <td style="padding: 1rem 0.8rem;font-size:1.5rem;"><?php
                                                            if (isset($payable[$h]) && $stlinfo != "تم") {
                                                            ?>
            دفع للبائع:
            <input type="text" value="<?php echo $payable[$h]; ?>" id="<?php echo $cd; ?>" style="border:1px solid #e2e2e2;padding:0.5rem;width:10rem;margin-left:auto">
            <button style="height: 3.2rem;
                    width: 8rem;
                    border-radius: 5px;
                    background-color: #556ee6;
                    color: #fff;" onclick="pay('<?php echo $order_detail_id[$h]; ?>','<?php echo $cd; ?>')">دفع</button>
            <?php
                                                            }
            ?>
        </td>
    </tr>
    <?php if ($stlinfo == "تم") { ?>
        <tr>
            <td style="padding: 1rem 0.8rem;font-size:1.5rem;">المنتج <?php echo $h; ?>: </td>
            <td style="padding: 1rem 0.8rem;font-size:1.5rem;"><?php
                                                                echo "الدفع المتوقع: $;" . $payable[$h];
                                                                ?></td>
            <td style="padding: 1rem 0.8rem;font-size:1.5rem;"><?php
                                                                echo "تم الدفع: $;" . $payable2[$h];
                                                                ?></td>
        </tr>
<?php }
    $h++;
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