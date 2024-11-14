<?php
require('require/top.php');
$id = $_GET['sid'];
$o = mysqli_fetch_assoc(mysqli_query($con, "select * from seller_wallet where seller_id='$id'"));
?>
<div class="wrwr">
    <div class="path" id="path">
        <a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> لوحة التحكم</a>
        <span>/</span>
        <a href="manual_update.php">التحديث اليدوي</a>
    </div>
    <div class="catbox-row">
        <div class="catboxp">
            <h1><?php echo "التحديث اليدوي"; ?> </h1>
            <div class="formrow">
                <div class="heading">
                    مبلغ المحفظة
                </div>
                <div class="catselect">
                    <input type="number" placeholder="أدخل البريد الإلكتروني" id="bal" value="<?php echo $o['ballance']; ?>" readonly>
                </div>
            </div>
            <div class="formrow">
                <div class="heading">
                    اختر الطريقة
                </div>
                <div class="catselect">
                    <select name="" id="mtd" class="select">
                        <option value="#">-- اختر الوضع --</option>
                        <option value="1">ائتمان</option>
                        <option value="0">خصم</option>
                    </select>
                </div>
            </div>
            <div class="formrow">
                <div class="heading">
                    المبلغ
                </div>
                <div class="catselect">
                    <input type="number" placeholder="أدخل المبلغ" id="abal">
                </div>
            </div>
            <div class="formrow">
                <div class="heading">
                    رسالة
                </div>
                <div class="catselect">
                    <textarea name="" id="txn" placeholder="أدخل تفاصيل المعاملة"></textarea>
                </div>
            </div>
            <div class="formrow">
                <span id='pdstatus' style='font-size:1.3rem; color:#556ee6;'></span>
                <button class='add' onclick="manual_add(<?php echo $id; ?>)">
                    تحديث</button>
            </div>
        </div>
    </div>
</div>
<?php
require('require/foot.php');
?>