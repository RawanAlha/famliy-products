<?php
require('require/top.php');
?>
<div class="wrwr">
    <div class="path">
        <a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> لوحة التحكم</a>
        <span>/</span>
        <a href="categories.php">الفئات</a><span> /</span>
        <a href="sub-cat.php">الفئات الفرعية</a>
    </div>
    <div class="rowbtn">
        <div class="b">
            <button class="add" onclick="showadsctfa()">
                <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;إضافة
            </button>
            <input type="text" placeholder="البحث حسب الفئة" id="sfield" onkeyup="search('sfield','catname')" />
        </div>
    </div>
    <div class="catbox-row">
        <div class="catbox">
            <div class="heading">
                <div class="sl">رقم التسلسل</div>
                <div class="catnameh">الفئة الفرعية</div>
                <div class="nos">الفئة الرئيسية</div>
                <div class="nos">العمولة</div>
                <div class="status">
                    <span class="active_span">الحالة</span>
                </div>
                <div class="action">الإجراء</div>
            </div>
            <div class="bspace" id="subcatrows">
                <?php
                $query = "select * from subcategories order by id desc";

                $res = mysqli_query($con, $query);
                $i = 1;
                $template = '';
                while ($row = mysqli_fetch_assoc($res)) {
                    $st = '';
                    $cb = '';
                    $idd = $row['id'];
                    $scat = $row['id'];
                    $query2 = "select * from commission where scat_id='$scat'";
                    $res2 = mysqli_query($con, $query2);
                    $rowt = mysqli_fetch_assoc($res2);
                    $cmsn = $rowt['com'];
                    if ($row['status'] == 1) {
                        $st = "نشط";
                        $cb = "<button class='deactive' onclick='subcat_acdc($idd, 0)'>
                  <i class='fa fa-eye-slash' aria-hidden='true'></i>إلغاء النشاط
                </button>";
                    } else {
                        $st = "غير نشط";
                        $cb = "
                <button class='active' onclick='subcat_acdc($idd, 1)'>
                <i class='fa fa-eye' aria-hidden='true'></i>نشط
                </button>
                ";
                    }
                    $id = $row['id'];
                    $name = $row['subcat'];
                    $pcat = $row['cat_id'];
                    $h = mysqli_fetch_assoc(mysqli_query($con, "select * from categories where id='$pcat'"));
                    $pcat = $h['category'];
                    $template = $template . "
<div class='detailrow'>
<div class='sl'>  $i </div>
<div class='catname'> $name</div>
<div class='nos'> $pcat </div>
<div class='nos'>$cmsn%</div>
<div class='status'>
  <span class='active_span'>
  $st
  </span>
</div>
<div class='action'>
  <button class='edit' onclick='editsubcat($id)'>
    <i class='fa fa-pen' aria-hidden='true'></i>تحرير
  </button>
  $cb
  <button class='delete' onclick='subcatdelete($id)'>
    <i class='fa fa-trash' aria-hidden='true'></i>حذف
  </button>
</div>
</div>
";
                    $i++;
                }
                echo $template;
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
        @ 2024 منتجات العائلة. كل الحقوق محفوظة.
    </div>
</div>
<?php
require('require/foot.php');
?>