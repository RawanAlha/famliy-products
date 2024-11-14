<?php
require('require/top.php');
$z = 0;
$o = 0;
$q = "select * from sellers where isapp='$z' and is_cp='$o'";
$r = mysqli_query($con, $q);
while ($g = mysqli_fetch_assoc($r)) {
    $ids = $g['id'];
    mysqli_query($con, "update sellers set is_new='0' where id='$ids'");
}
?>

<div class="wrwr">
    <div class="path" id="path">
        <a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> لوحة التحكم</a>
        <span>/</span>
        <a href="nonsellerapprove.php">البائعون غير المعتمدين</a>
    </div>
    <div class="rowbtn">
        <div class="b">
            <input type="text" placeholder="البحث بواسطة الاسم" id="sfield" onkeyup="search('sfield','p_name')" />
        </div>
    </div>
    <div class="catbox-row">
        <div class="catbox">
            <div class="heading">
                <div class="slno">الرقم التسلسلي</div>
                <div class="p_image">البريد الإلكتروني</div>
                <div class="p_status">الحالة</div>
                <div class="p_action">الإجراء</div>
            </div>
            <div class="bspace">
                <?php
                $i = 1;
                $q = "select * from sellers where isapp='$z' and is_cp='$o'";
                $r = mysqli_query($con, $q);
                while ($row = mysqli_fetch_assoc($r)) { ?>

                    <div class="p_row">
                        <div class="slno"><?php echo $i; ?></div>
                        <div class="p_image"><?php echo $row['email']; ?></div>
                        <div class="p_status">
                            <span class="active_span" style="color: red">انتظار إكمال الملف الشخصي</span>
                        </div>
                        <div class="p_action">
                            <button class="edit" onclick="delete_seller(<?php echo $row['id']; ?>)">
                                <i class="fa fa-trash" aria-hidden="true"></i>حذف
                            </button>
                        </div>
                    </div>
                <?php $i++;
                } ?>
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