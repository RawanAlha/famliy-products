<?php
require('require/top.php');
authorise($con);
if (!isset($_GET['d'])) {
    redirect('index.php');
    die();
}
$id = $_GET['d'];
$product_id = $_GET['d'];
$product = product_detail($con, $product_id);
?>
<div class="path">
    <div class="container">
        <a href="index.php">الرئيسية</a>
        /
        <a href="product.php">المنتجات</a>
        /
        <a href="product-detail.php">تفاصيل المنتج</a>
    </div>
</div>
<div class="cartrow" id="catrow">
    <div class="gh">
        <section class="single-product">
            <div class="row">
                <div class="container" style="width:100%">
                    <div class="innerrow">
                        <div class="left">
                            <div class="mainImage">
                                <img src="../media/product/<?php echo $product['img1']; ?>" alt="الصورة الرئيسية" id="mi" />
                            </div>
                            <div class="subimages flex">
                                <div class="sub">
                                    <img src="../media/product/<?php echo $product['img1']; ?>" alt="الصور الفرعية" onclick="view(this)" />
                                </div>
                                <div class="sub">
                                    <img src="../media/product/<?php echo $product['img2']; ?>" alt="الصور الفرعية" onclick="view(this)" />
                                </div>
                                <div class="sub">
                                    <img src="../media/product/<?php echo $product['img3']; ?>" alt="الصور الفرعية" onclick="view(this)" />
                                </div>
                                <div class="sub">
                                    <img src="../media/product/<?php echo $product['img4']; ?>" alt="الصور الفرعية" onclick="view(this)" />
                                </div>
                            </div>
                        </div>
                        <div class="right">
                            <h2 class="mt2"><?php echo $product['product_name']; ?></h2>
                            <div class="no-stock">
                                <p class="pd-no">رقم المنتج<span><?php echo $product['sku']; ?></span></p>
                                <p class="stock-qty">الكمية<span><?php echo $product['qty']; ?></span></p>
                            </div>
                            <p class="pp-descp">
                                <?php echo $product['shrt_desc']; ?>
                            </p>
                            <div class="product-group-dt">
                                <ul>
                                    <li>
                                        <div class="main-price color-discount">
                                             السعر بعد الخصم<span> ريال <?php echo $product['fa']; ?></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="main-price mrp-price">
                                            سعر <span>ريال<?php echo $product['price']; ?></span>
                                        </div>
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <div class="main-price mt-2">
                                            الضريبة<span><?php echo $product['tax']; ?>%</span>
                                        </div>
                                    </li>
                                </ul>
                                <ul class="ordr-crt-share">
                                    <li>
                                        <a href="add_product.php?b=2846&idp=<?php echo $_GET['d'];  ?>"><button class="order-btn hover-btn">
                                                <i class="uil uil-pen"></i> تعديل</button></a>
                                    </li>
                                </ul>
                            </div>
                            <?php
                            if ($product['isappp'] == 2) {
                                $query = "select * from p_reject where product_id='$id'";
                                $res = mysqli_query($con, $query);
                                $row = mysqli_fetch_assoc($res);
                            ?>
                                <div class="product-group-dt mt3" style="background:none">
                                    <div class="reject-badge-red">
                                        تم رفض هذا المنتج. <br>التعليقات: <?php echo $row['cause']; ?>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="secondrow">
                        <div class="innerrow">
                            <div class="alldesc">
                                <div class="container">
                                    <div class="heading">
                                        <h4>تفاصيل المنتج</h4>
                                    </div>
                                    <div class="desc-body">
                                        <div class="pdct-dts-1">
                                            <div class="pdct-dt-step">
                                                <h4>الوصف</h4>
                                                <p>
                                                    <?php echo $product['description']; ?>
                                                </p>
                                            </div>
                                            <div class="pdct-dt-step">
                                                <h4>الشروط والأحكام</h4>
                                                <div class="product_attr">
                                                    <?php echo $product['disclaimer']; ?>
                                                </div>
                                            </div>
                                            <div class="pdct-dt-step">
                                                <h4>البائع</h4>
                                                <div class="product_attr">
                                                    <?php
                                                    $t = $product['added_by'];
                                                    $ti = $product['id'];
                                                    $h = mysqli_fetch_assoc(mysqli_query($con, "select b_name from sellers where id='$t'"));
                                                    $hi = mysqli_fetch_assoc(mysqli_query($con, "select added_on from product_ad_on where pid='$ti'"));
                                                    echo $h['b_name']; ?>
                                                </div>
                                            </div>
                                            <div class="pdct-dt-step">
                                                <h4>تمت الإضافة في</h4>
                                                <div class="product_attr">
                                                    <?php
                                                    $ti = $product['id'];
                                                    $hi = mysqli_fetch_assoc(mysqli_query($con, "select added_on from product_ad_on where pid='$ti'"));
                                                    echo $hi['added_on']; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php
require("require/foot.php");
?>
