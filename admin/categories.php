<?php
require('require/top.php');
?>

<div class="wrwr">
    <div class="path">
        <a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> لوحة التحكم</a>
        <span>/</span>
        <a href="categories.php">التصنيفات</a>
    </div>
    <div class="rowbtn">
        <div class="b">
            <button class="add" onclick="showadctfa()">
                <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;إضافة
            </button>
            <input type="text" placeholder="البحث حسب التصنيف" id="sfield" onkeyup="search('sfield','catname')" />
        </div>
    </div>
    <div class="catbox-row">
        <div class="catbox">
            <div class="heading">
                <div class="sl">الرقم التسلسلي</div>
                <div class="catnameh">التصنيف</div>
                <div class="nos">التصنيف الفرعي</div>
                <div class="status">
                    <span class="active_span">نشط</span>
                </div>
                <div class="action">الإجراء</div>
            </div>
            <div class="bspace" id='catrows'>
                <?php
                $query = "select * from categories order by id desc";
                $res = mysqli_query($con, $query);
                $i = 1;
                while ($row = mysqli_fetch_assoc($res)) {
                    $st = '';
                    $cb = '';
                    $idd = $row['id'];
                    if ($row['status'] == 1) {
                        $st = "نشط";
                        $cb = "<button class='deactive' onclick='cat_acdc($idd, 0)'>
              <i class='fa fa-eye-slash' aria-hidden='true'></i>إلغاء التنشيط
            </button>";
                    } else {
                        $st = "غير نشط";
                        $cb = "
            <button class='active' onclick='cat_acdc($idd, 1)'>
            <i class='fa fa-eye' aria-hidden='true'></i>تنشيط
          </button>
            ";
                    }
                ?>
                    <div class="detailrow">
                        <div class="sl"><?php echo $i; ?></div>
                        <div class="catname"><?php echo $row['category']; ?></div>
                        <?php
                        $nm = $row['id'];
                        $q = "select * from subcategories where cat_id='$nm'";
                        $r = mysqli_query($con, $q);
                        $nor = mysqli_num_rows($r);
                        ?>
                        <div class="nos"><?php echo $nor; ?></div>
                        <div class="status">
                            <span class="active_span">
                                <?php echo $st; ?>
                            </span>
                        </div>
                        <div class="action">
                            <button class="edit" onclick="editcat(<?php echo $row['id']; ?>)">
                                <i class="fa fa-pen" aria-hidden="true"></i>تعديل
                            </button>
                            <?php echo $cb; ?>
                            <button class="delete" onclick="catdelete(<?php echo $row['id']; ?>)">
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