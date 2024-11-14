<?php
require('require/top.php');
?>
<div class="wrwr">
    <div class="path" id="path">
        <a href="index.html"><i class="fa fa-home" aria-hidden="true"></i> لوحة التحكم</a>
        <span>/</span>
        <a href="product.html">المنتج</a>
    </div>
    <div class="rowbtn">
        <div class="b">
            <input type="text" placeholder="البحث بالاسم" id="sfield" onkeyup="search('sfield','p_name')" />
        </div>
    </div>
    <div class="catbox-row">
        <div class="catbox">
            <div class="heading">
                <div class="slno">الرقم التسلسلي</div>
                <div class="p_image">الصورة</div>
                <div class="p_namee">الاسم</div>
                <div class="p_status">الحالة</div>
                <div class="p_action">الإجراء</div>
            </div>
            <div class="bspace" id="productsecrow">
                <?php
                $query = "select * from product where isappp='1' order by id desc";
                $res = mysqli_query($con, $query);
                $i = 1;
                while ($row = mysqli_fetch_assoc($res)) {
                    $st = '';
                    $cb = '';
                    $idd = $row['id'];
                    if ($row['status'] == 1) {
                        $st = "نشط";
                        $cb = "<button class='deactive' onclick='product_acdc($idd, 0)'>
              <i class='fa fa-eye-slash' aria-hidden='true'></i>غير نشط
            </button>";
                    } else {
                        $st = "غير نشط";
                        $cb = "
            <button class='active' onclick='product_acdc($idd, 1)'>
            <i class='fa fa-eye' aria-hidden='true'></i>نشط
          </button>
            ";
                    }
                ?>
                    <div class="p_row">
                        <div class="slno"><?php echo $i; ?></div>
                        <div class="p_image">
                            <img src="../media/product/<?php echo $row['img1']; ?>" alt="product" />
                        </div>
                        <div class="p_name"><?php echo $row['product_name']; ?> </div>
                        <div class="p_status">
                            <?php echo $st; ?>
                        </div>
                        <div class="p_action">
                            <button class="edit" onclick="showdetailproduct(<?php echo $row['id']; ?>)">
                                <i class="fa fa-wifi" aria-hidden="true"></i>عرض
                            </button>
                            <?php echo $cb; ?>
                            <button class="delete" onclick="delete_product(<?php echo $row['id']; ?>)">
                                <i class="fa fa-trash" aria-hidden="true"></i>حذف
                            </button>
                        </div>
                    </div>
                <?php
                    $i++;
                }
                ?>
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