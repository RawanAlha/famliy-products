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
$shipping = '';
$shippingex = '';
$sd = '';
$dc = '';
$bs = '';
$filter = '';
$subfilter = '';
$tc = '';
$rday = '';
$return_p = '';
$repref = '';
$sku = get_code();
$img1 = "../assets/images/product/big-2.jpg";
$img2 = "../assets/images/product/big-2.jpg";
$img3 = "../assets/images/product/big-2.jpg";
$img4 = "../assets/images/product/big-2.jpg";
if ($h_t == '1973') {
    $heading = "إضافة منتج";
    $cb = '<a href="javascript:void(0)" class="btn d-flex-center-a-j bg-main br-15" onclick="add_product()" id="pbtn">
     <i class="uil uil-plus"></i>
     <span>إضافة</span>
   </a>';
} else if ($h_t == '2846') {
    $heading = "تعديل المنتج";
    $productid = get_safe_value($con, $_GET['idp']);
    $cq = "select * from product where id='$productid'";
    $cr = mysqli_query($con, $cq);
    $nor = mysqli_num_rows($cr);
    if ($nor > 0) {
        $r = mysqli_fetch_assoc($cr);
        $name = $r['product_name'];
        $category = $r['cat_id'];
        $subcategory = $r['scat_id'];
        $qty = $r['qty'];
        $price = $r['price'];
        $sellprice = $r['sell_price'];
        $tax = $r['tax'];
        $fa = $r['fa'];
        $sku = $r['sku'];
        $sd = $r['shrt_desc'];
        $dc = $r['description'];
        $tc = $r['disclaimer'];
        $img1 = "../media/product/" . $r['img1'];
        $img2 = "../media/product/" . $r['img2'];
        if (!empty($r['img3'])) {
            $img3 = "../media/product/" . $r['img3'];
        }
        if (!empty($r['img4'])) {
            $img4 = "../media/product/" . $r['img4'];
        }
        $cb = '<a href="javascript:void(0)" class="btn d-flex-center-a-j bg-main br-15" onclick="edit_product(' . $_GET['idp'] . ')" id="pbtn">
      <i class="uil uil-plus"></i>
      <span>تحديث</span>
    </a>';
    } else {
        redirect('product.php');
    }
} else {
    redirect('product.php');
}
?>
<div class="path">
    <div class="container">
        <a href="index.html">الرئيسية</a>
        /
        <a href="product.php">المنتجات</a>
        /
        <a href="add_product.php">إضافة منتج</a>
    </div>
</div>
<div class="cartrow" id="catrow">
    <div class="gh">
        <div class="heading">
            <h3><?php echo $heading; ?></h3>
        </div>
        <div class="maincontainer2">
            <form action="#">
                <div class="formrow">
                    <div class="heading">الفئة</div>
                    <select name="addcatname" id="addcatname" onchange="get_subcatfa()">
                        <option value="#">اختر الفئة</option>
                        <?php
                        $query = "select * from categories order by id desc";
                        $resi = mysqli_query($con, $query);
                        $i = 1;
                        while ($ropw = mysqli_fetch_assoc($resi)) {
                            $cname = $ropw['category'];
                            $cnamei = $ropw['id'];
                            if ($cnamei == $category) {
                                echo "<option value='$cnamei' selected>$cname</option> ";
                            } else {
                                echo "<option value='$cnamei'>$cname</option> ";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="formrow">
                    <div class="heading">الفئة الفرعية</div>
                    <select name="addscatname" id="addscatname" onchange="get_filterfa()">
                        <option value="#">اختر الفئة الفرعية</option>
                        <?php
                        if ($h_t == 2846) {
                            $query2 = "select * from subcategories where cat_id='$category' order by id desc";
                            $resi2 = mysqli_query($con, $query2);
                            while ($ropw2 = mysqli_fetch_assoc($resi2)) {
                                $cname2 = $ropw2['subcat'];
                                $cname2i = $ropw2['id'];
                                if ($cname2i == $subcategory) {
                                    echo "<option value='$cname2i' selected>$cname2</option>";
                                } else {
                                    echo "<option value='$cname2i'>$cname2</option> ";
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
                        $subfilterRes = mysqli_query($con, "select * from p_sfilter where pid='$productid'");
                        while ($subfilterRow = mysqli_fetch_assoc($subfilterRes)) {
                            $productSubFilters[] = $subfilterRow['sfid'];
                        }
                        $qn = "select * from filter where subcat_id='$subcategory'";
                        $resn = mysqli_query($con, $qn);
                        $template = '';
                        while ($rown = mysqli_fetch_assoc($resn)) {
                            $template = $template . '
                            <div class="formrow">
                            <div class="heading">
                                التصفية
                            </div>
                            <select class="select" name="productFiltersName" id="addfiltername">
                                <option value="' . $rown['id'] . '">' . $rown['filter'] . '</option>
                            </select>
                            </div>
                            <div class="formrow">
                                <div class="heading">
                                    التصفية الفرعية
                                </div>
                            <div id="subfilters" style="background-color: #f8f8fb;width:100%;padding: 0.8rem;
                                        border: 0.5px solid #74788d;
                                        border-radius: 5px;">';
                            $filtername = $rown['id'];
                            $q2 = "select * from sub_filter where filter_id='$filtername'";

                            $res2 = mysqli_query($con, $q2);
                            while ($row2 = mysqli_fetch_assoc($res2)) {
                                if (in_array($row2['id'], $productSubFilters)) {
                                    $template = $template . '<span style="font-size:1.2rem;float:right; margin:0 0.8rem">
                                        <input type="checkbox" name="productSubFiltersName"  style="display:block;height: 1.5rem;
                                        background-color: #f8f8fb;
                                        width: 1.5rem;
                                        padding: 0 0.8rem;
                                        border: 0.5px solid #74788d;
                                        border-radius: 5px;float:right" value="' . $row2['id'] . '" checked>
                                        &nbsp; ' . $row2['subfilter'] . '
                                     </span>';
                                } else {
                                    $template = $template . '<span style="font-size:1.2rem;float:right; margin:0 0.8rem">
                                        <input type="checkbox" name="productSubFiltersName"  style="display:block;height: 1.5rem;
                                        background-color: #f8f8fb;
                                        width: 1.5rem;
                                        padding: 0 0.8rem;
                                        border: 0.5px solid #74788d;
                                        border-radius: 5px;float:right" value="' . $row2['id'] . '">
                                        &nbsp; ' . $row2['subfilter'] . '
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
                    <div class="heading">اسم المنتج</div>
                    <input type="text" placeholder="أدخل اسم المنتج *" id="pname" value="<?php echo $name; ?>" />
                </div>

                <div class="formrow">
                    <div class="heading">السعر</div>
                    <input type="number" placeholder="أدخل سعر المنتج *" id="pprice" value="<?php echo $price; ?>" oninput="putacp()" />
                </div>
                <div class="formrow">
                    <div class="heading">سعر البيع</div>
                    <input type="number" placeholder="أدخل سعر البيع *" id="psprice" value="<?php echo $sellprice; ?>" oninput="checkprice()" valueAsNumber />
                </div>
                <div class="formrow">
                    <div class="heading">الضريبة</div>
                    <input type="number" placeholder="أدخل قيمة الضريبة *" id="tax" oninput="t_ax()" value="<?php echo $tax; ?>" />
                </div>
                <div class="formrow">
                    <div class="heading">السعر النهائي</div>
                    <input type="number" placeholder="0.00" id="fa" value="<?php echo $fa; ?>" readonly />
                </div>
                <div class="formrow">
                    <div class="heading">رمز المنتج</div>
                    <input type="text" id="sku" value="<?php echo $sku; ?>" readonly />
                </div>
                <div class="formrow">
                    <div class="heading">الكمية</div>
                    <input type="number" placeholder="أدخل كمية المنتج *" id="pqty" value="<?php echo $qty; ?>" />
                </div>
                <div class="formrow f">
                    <div class="heading">الشروط والأحكام</div>
                    <textarea name="shrtdsc" id="tc" placeholder="الشروط والأحكام *"><?php echo $tc; ?></textarea>
                </div>
                <div class="formrow f">
                    <div class="heading">وصف مختصر</div>
                    <textarea name="shrtdsc" id="shrtdsc" placeholder="وصف مختصر *"><?php echo $sd; ?></textarea>
                </div>
                <div class="formrow f">
                    <div class="heading">الوصف</div>
                    <textarea class="desc" name="dsc" id="dsc" placeholder="الوصف *"><?php echo $dc; ?></textarea>
                </div>
                <div class="formrow ig">
                    <div class="imgdiv">
                        <div class="img">
                            <img src="<?php echo $img1; ?>" alt="" id="preview1" />
                        </div>
                        <div class="file">
                            <label for="uploadimage1">
                                تصفح
                                <input type="file" name="productimage1" id="uploadimage1" onchange="show_preview('preview1','uploadimage1')" />
                            </label>
                        </div>
                    </div>
                    <div class="imgdiv">
                        <div class="img">
                            <img src="<?php echo $img2; ?>" alt="" id="preview2" />
                        </div>
                        <div class="file">
                            <label for="uploadimage2">
                                تصفح
                                <input type="file" name="productimage2" id="uploadimage2" onchange="show_preview('preview2','uploadimage2')" />
                            </label>
                        </div>
                    </div>
                    <div class="imgdiv">
                        <div class="img">
                            <img src="<?php echo $img3; ?>" alt="" id="preview3" />
                        </div>
                        <div class="file">
                            <label for="uploadimage3">
                                تصفح
                                <input type="file" name="productimage3" id="uploadimage3" onchange="show_preview('preview3','uploadimage3')" />
                            </label>
                        </div>
                    </div>
                    <div class="imgdiv">
                        <div class="img">
                            <img src="<?php echo $img4; ?>" alt="" id="preview4" />
                        </div>
                        <div class="file">
                            <label for="uploadimage4">
                                تصفح
                                <input type="file" name="productimage4" id="uploadimage4" onchange="show_preview('preview4','uploadimage4')" />
                            </label>
                        </div>
                    </div>
                </div>
                <div class="formrow">
                    <span id="pdstatus" style="color:red; font-size:1.4rem; text-transform:capitalize;">

                    </span>
                </div>
                <div class="formrow">
                    <?php echo $cb; ?>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
require("require/foot.php");
?>
