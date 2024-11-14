<?php
require('require/top.php');
$h_t = get_safe_value($con, $_GET['b']);
if (isset($_GET['idp'])) {
    $productid = get_safe_value($con, $_GET['idp']);
}
$name = '';
$category = '';
$subcategory = '';
$qty = '';
$price = '';
$sellprice = '';
$tax = '';
$fa = '0.00';
$sku = '';
$sd = '';
$dc = '';
$bs = '';
$filter = '';
$subfilter = '';
$tc = '';
$rday = '';
$return_p = '';
$repref = '';
$shipping = '';
$shippingex = '';
$sku = get_code();
$img1 = "assets/images/2.jpg";
$img2 = "assets/images/2.jpg";
$img3 = "assets/images/2.jpg";
$img4 = "assets/images/2.jpg";
if ($h_t == '1973') {
    $heading = "إضافة منتج";
    $cb = "<button class='add' onclick='add_product()' id='pbtn'>
     <i class='fa fa-plus' aria-hidden='true'></i>
     إضافة</button>";
} else if ($h_t == '2846') {
    $heading = "تعديل المنتج";
    $productid = get_safe_value($con, $_GET['idp']);
    $cq = "select * from product where id='$productid'";
    $cr = mysqli_query($con, $cq);
    $nor = mysqli_num_rows($cr);
    if ($nor > 0) {
        $r = mysqli_fetch_assoc($cr);
        $name = $r['name'];
        $category = $r['category'];
        $subcategory = $r['subcat'];
        $qty = $r['qty'];
        $price = $r['price'];
        $sellprice = $r['sellprice'];
        $tax = $r['tax'];
        $fa = $r['fa'];
        $sku = $r['sku'];
        $sd = $r['sd'];
        $dc = $r['dc'];
        $bs = $r['bs'];
        $return_p = $r['return_p'];
        $tc = $r['tc'];
        $rday = $r['rday'];
        $repref = $r['repref'];
        $shipping = $r['shippingcharge'];
        $shippingex = $r['scpe'];
        $img1 = "../media/product/" . $r['img1'];
        $img2 = "../media/product/" . $r['img2'];
        if (!empty($r['img3'])) {
            $img3 = "../media/product/" . $r['img3'];
        }
        if (!empty($r['img4'])) {
            $img4 = "../media/product/" . $r['img4'];
        }
        $cb = "<button class='add' onclick='edit_product($productid)' id='pbtn'>
      <i class='fa fa-pen' aria-hidden='true'></i>
      تعديل</button>";
    } else {
        redirect('product.php');
    }
} else {
    redirect('product.php');
}
?>
<div class="wrwr">
    <div class="path" id="path">
        <a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> لوحة التحكم</a>
        <span>/</span>
        <a href="product.php">المنتج</a><span>/</span>
        <a href="product_management.php">إدارة المنتج</a>
    </div>
    <div class="catbox-row">
        <div class="catboxp">
            <h1><?php echo $heading; ?></h1>
            <div class="formrow">
                <div class="heading">
                    الفئة
                </div>
                <div class="catselect">
                    <select class="select" name="addcatname" id="addcatname" onchange="get_subcatfa()">
                        <option value="#">اختر الفئة</option>
                        <?php
                        $query = "select * from categories order by id desc";
                        $resi = mysqli_query($con, $query);
                        $i = 1;
                        while ($ropw = mysqli_fetch_assoc($resi)) {
                            $cname = $ropw['name'];
                            if ($cname == $category) {
                                echo "<option value='$cname' selected>$cname</option> ";
                            } else {
                                echo "<option value='$cname'>$cname</option> ";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="formrow">
                <div class="heading">
                    الفئة الفرعية
                </div>
                <select class="select" name="addscatname" id="addscatname" onchange="get_filterfa()">
                    <option value="#">اختر الفئة الفرعية</option>
                    <?php
                    if ($h_t == 2846) {
                        $query2 = "select * from sub_cat where p_cat='$category' order by id desc";
                        $resi2 = mysqli_query($con, $query2);
                        while ($ropw2 = mysqli_fetch_assoc($resi2)) {
                            $cname2 = $ropw2['name'];
                            if ($cname2 == $subcategory) {
                                echo "<option value='$cname2' selected>$cname2</option>";
                            } else {
                                echo "<option value='$cname2'>$cname2</option> ";
                            }
                        }
                    }
                    ?>
                </select>
            </div>
            <div id="filters">
                <?php
                if ($h_t == 2846) {
                    $productSubFilters = array();
                    $subfilterRes = mysqli_query($con, "select * from product_subfilters where pid='$productid'");
                    while ($subfilterRow = mysqli_fetch_assoc($subfilterRes)) {
                        $productSubFilters[] = $subfilterRow['subfilter'];
                    }
                    $qn = "select * from filters where subcat='$subcategory'";
                    $resn = mysqli_query($con, $qn);
                    $template = '';
                    while ($rown = mysqli_fetch_assoc($resn)) {
                        $template = $template . '
                            <div class="formrow">
                            <div class="heading">
                                فلتر
                            </div>
                            <select class="select" name="productFiltersName" id="addfiltername">
                                <option value="' . $rown['name'] . '">' . $rown['name'] . '</option>
                            </select>
                            </div>
                            <div class="formrow">
                                <div class="heading">
                                    فلتر فرعي
                                </div>
                            <div id="subfilters" style="background-color: #f8f8fb;width:100%;padding: 0.8rem;
                                        border: 0.5px solid #74788d;
                                        border-radius: 5px;">';
                        $filtername = $rown['name'];
                        $q2 = "select * from subfilter where p_filter='$filtername'";
                        $res2 = mysqli_query($con, $q2);
                        while ($row2 = mysqli_fetch_assoc($res2)) {
                            if (in_array($row2['name'], $productSubFilters)) {
                                $template = $template . '<span style="font-size:1.2rem;float:right; margin:0 0.8rem">
                                        <input type="checkbox" name="productSubFiltersName"  style="display:block;height: 1.5rem;
                                        background-color: #f8f8fb;
                                        width: 1.5rem;
                                        padding: 0 0.8rem;
                                        border: 0.5px solid #74788d;
                                        border-radius: 5px;float:right" value="' . $row2['name'] . '" checked>
                                        &nbsp; ' . $row2['name'] . '
                                     </span>';
                            } else {
                                $template = $template . '<span style="font-size:1.2rem;float:right; margin:0 0.8rem">
                                        <input type="checkbox" name="productSubFiltersName"  style="display:block;height: 1.5rem;
                                        background-color: #f8f8fb;
                                        width: 1.5rem;
                                        padding: 0 0.8rem;
                                        border: 0.5px solid #74788d;
                                        border-radius: 5px;float:right" value="' . $row2['name'] . '">
                                        &nbsp; ' . $row2['name'] . '
                                    </span>';
                            }
                        }
                        $template = $template . '</div> </div>';
                    }
                    echo $template;
                    unset($productSubFilters);
                }
                ?>
            </div>
            <div class="formrow">
                <div class="heading">
                    أفضل مبيعات
                </div>
                <select class="select" name="addscatname" id="addbs">
                    <option value="0">أفضل مبيعات</option>
                    <?php
                    if ($h_t == 2846) {
                        if ($bs == 1) {
                            $t = "
                        <option value='1' selected>نعم</option>
                         <option value='0'>لا</option>
                        ";
                            echo $t;
                        } else {
                            $t = "
                        <option value='1'>نعم</option>
                         <option value='0' selected>لا</option>
                        ";
                            echo $t;
                        }
                    } else {
                    ?>
                        <option value="1">نعم</option>
                        <option value="0">لا</option>
                    <?php } ?>
                </select>
            </div>
            <?php if ($return_p == 'Custom') { ?>
                <div class="formrow">
                    <div class="heading">
                        إرجاع
                    </div>
                    <select class="select" name="addscatname" id="return_selector" onchange="checkpolicy()">
                        <option value="7 days return">إرجاع خلال 7 أيام</option>
                        <option value="No Return">لا يوجد إرجاع</option>
                    </select>
                </div>
            <?php } else if ($return_p == 'No Return') { ?>
                <div class="formrow">
                    <div class="heading">
                        إرجاع
                    </div>
                    <select class="select" name="addscatname" id="return_selector" onchange="checkpolicy()">
                        <option value="7 days return">إرجاع خلال 7 أيام</option>
                        <option value="No Return" selected>لا يوجد إرجاع</option>
                    </select>
                </div>
            <?php } else { ?>
                <div class="formrow">
                    <div class="heading">
                        إرجاع
                    </div>
                    <select class="select" name="addscatname" id="return_selector" onchange="checkpolicy()">
                        <option value="7 days return" selected>إرجاع خلال 7 أيام</option>
                        <option value="No Return">لا يوجد إرجاع</option>
                    </select>
                </div>
            <?php } ?>
            <div class="formrow" id="custom_return">
                <div class="heading">
                    استرداد أو استبدال
                </div>
                <?php if ($repref == 'Refund') { ?>
                    <select class="select" name="addscatname" id="return_refund">
                        <option value="0">اختر استرداد أو استبدال</option>
                        <option value="Refund" selected>استرداد</option>
                        <option value="Replace">استبدال</option>
                    </select>
                <?php } else if ($repref == 'Replace') { ?>
                    <select class="select" name="addscatname" id="return_refund">
                        <option value="0">اختر استرداد أو استبدال</option>
                        <option value="Refund">استرداد</option>
                        <option value="Replace" selected>استبدال</option>
                    </select>
                <?php } else { ?>
                    <select class="select" name="addscatname" id="return_refund">
                        <option value="0">اختر استرداد أو استبدال</option>
                        <option value="Refund">استرداد</option>
                        <option value="Replace">استبدال</option>
                    </select>
                <?php } ?>
            </div>
            <div class="formrow">
                <div class="heading">
                    الشروط والأحكام
                </div>
                <textarea name="shrtdsc" id="tc" placeholder="الشروط والأحكام *" style="height:10rem"><?php echo $tc; ?></textarea>
            </div>
            <div class="formrow">
                <div class="heading">
                    الاسم
                </div>
                <input type="text" placeholder="أدخل اسم المنتج *" id="pname" value="<?php echo $name; ?>" />
            </div>
            <div class="formrow">
                <div class="heading">
                    السعر الفعلي
                </div>
                <input type="number" placeholder="أدخل سعر المنتج *" id="pprice" value="<?php echo $price; ?>" onkeyup="putacp()" />
            </div>
            <div class="formrow">
                <div class="heading">
                    سعر البيع
                </div>
                <input type="number" placeholder="أدخل سعر بيع المنتج *" id="psprice" value="<?php echo $sellprice; ?>" onkeyup="checkprice()" />
            </div>
            <div style="display:flex;justify-content: flex-end; min-height:0;">
                <span style="color:red;font-size:1.2rem;" id="ermsg"></span>
            </div>
            <div class="formrow">
                <div class="heading">
                    الضريبة
                </div>
                <input type="number" placeholder="أدخل ضريبة المنتج *" id="tax" onkeyup="tax()" value="<?php echo $tax; ?>" />
            </div>
            <div class="formrow">
                <div class="heading">
                    المبلغ النهائي
                </div>
                <input type="number" placeholder="أدخل سعر المنتج *" id="fa" value="<?php echo $fa; ?>" readonly />
            </div>
            <div class="formrow">
                <div class="heading">
                    رسوم الشحن
                </div>
                <input type="number" placeholder="أدخل رسوم شحن المنتج *" id="shippimg" value="<?php echo $shipping; ?>" />
            </div>
            <div class="formrow">
                <div class="heading">
                    الرسوم لكل كمية إضافية
                </div>
                <input type="number" placeholder="أدخل رسوم شحن المنتج لكل كمية إضافية *" id="shippingex" value="<?php echo $shippingex; ?>" />
            </div>
            <div class="formrow">
                <div class="heading">
                    رمز المنتج
                </div>
                <input type="text" id="sku" value="<?php echo $sku; ?>" readonly />
            </div>
            <div class="formrow">
                <div class="heading">
                    الكمية
                </div>
                <input type="number" placeholder="أدخل كمية المنتج *" id="pqty" value="<?php echo $qty; ?>" />
            </div>
            <div class="formrow">
                <span style="font-size: 14px; font-weight: 600">
                    اختر الصور
                </span>
            </div>
            <div class="formrow">
                <div class="imgdiv">
                    <div class="img">
                        <img src="<?php echo $img1; ?>" alt="" id="preview1" />
                    </div>
                    <div class="file">
                        <span class="colors">*</span>
                        <input type="file" name="productimage1" id="uploadimage1" onchange="show_preview('preview1')" />
                    </div>
                </div>
                <div class="imgdiv">
                    <div class="img">
                        <img src="<?php echo $img2; ?>" alt="" id="preview2" />
                    </div>
                    <div class="file">
                        <span class="colors">*</span>
                        <input type="file" name="productimage2" id="uploadimage2" onchange="show_preview('preview2')" />
                    </div>
                </div>
                <div class="imgdiv">
                    <div class="img">
                        <img src="<?php echo $img3; ?>" alt="" id="preview3" />
                    </div>
                    <div class="file">
                        <input type="file" name="productimage3" id="uploadimage3" onchange="show_preview('preview3')" />
                    </div>
                </div>
                <div class="imgdiv">
                    <div class="img">
                        <img src="<?php echo $img4; ?>" alt="" id="preview4" />
                    </div>
                    <div class="file">
                        <input type="file" name="productimage4" id="uploadimage4" onchange="show_preview('preview4')" />
                    </div>
                </div>
            </div>
            <div class="formrow">
                <div class="heading">
                    وصف مختصر
                </div>
                <textarea name="shrtdsc" id="shrtdsc" placeholder="وصف مختصر *"><?php echo $sd; ?></textarea>
            </div>
            <div class="formrow">
                <div class="heading">
                    الوصف
                </div>
                <textarea class="desc" name="dsc" id="dsc" placeholder="الوصف *"><?php echo $dc; ?></textarea>
            </div>
            <div class="formrow">
                <span id='pdstatus' style='font-size:1.3rem; color:#556ee6;'></span>
                <?php echo $cb; ?>
            </div>
        </div>
    </div>
    <div class="row" style="
              display: block;
              margin-bottom: 2rem;
              font-size: 1.2rem;
              color: #6a7187;
            ">
        @ 2024 منتجات العائلة. جميع الحقوق محفوظة.
    </div>
</div>
<?php
require('require/foot.php');
?>