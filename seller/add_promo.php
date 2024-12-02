<?php
require("require/top.php");
authorise($con);
$sid = $_SESSION['SELLER_ID'];
?>
<div class="path">
    <div class="container">
        <a href="index.php">الرئيسية</a>
        /
        <a href="promo.php">العروض الترويجية</a>
        /
        <a href="add_promo.php">إضافة عرض ترويجي</a>
    </div>
</div>
<div class="cartrow" id="catrow">
    <div class="gh">
        <div class="heading">
            <h3>إضافة عرض ترويجي</h3>
        </div>
        <div class="maincontainer2">
            <form action="#">
                <div class="formrow">
                    <div class="heading">الفئة الفرعية</div>
                    <select name="addscatname" id="addscatname">
                        <option value="#">اختر الفئة الفرعية</option>
                        <?php
                        $query2 = "select * from subcategories order by id desc";
                        $resi2 = mysqli_query($con, $query2);
                        while ($ropw2 = mysqli_fetch_assoc($resi2)) {
                            $cname2 = $ropw2['subcat'];
                            $cname2i = $ropw2['id'];
                            echo "<option value='$cname2i'>$cname2</option> ";
                        }
                        ?>
                    </select>
                </div>
                <div class="formrow">
                    <div class="heading">رمز العرض</div>
                    <input type="text" placeholder="أدخل رمز العرض الترويجي" id="promocode">
                </div>
                <div class="formrow">
                    <div class="heading">الخصم</div>
                    <input type="number" placeholder="أدخل قيمة الخصم" id="disc">
                </div>
                <div class="formrow">
                    <div class="heading">الحد الأدنى للرصيد</div>
                    <input type="number" placeholder="أدخل الحد الأدنى للرصيد" id="minbal">
                </div>
                <div class="formrow">
                    <a href="javascript:void(0)" class="btn d-flex-center-a-j bg-main br-15" onclick="addpromo()">
                        <span>إضافة</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
require("require/foot.php");
?>
