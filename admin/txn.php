<?php
require('require/top.php');
$id = $_GET['sid'];
$o = mysqli_fetch_assoc(mysqli_query($con, "select * from witdraw_req where s_id='$id'"));
?>
<div class="wrwr">
    <div class="path" id="path">
        <a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> لوحة التحكم</a>
        <span>/</span>
        <a href="txn.php">تفاصيل العملية</a>
    </div>
    <div class="catbox-row">
        <div class="catboxp">
            <h1><?php echo "تفاصيل العملية"; ?></h1>
            <div class="formrow">
                <div class="heading">
                    المبلغ
                </div>
                <div class="catselect">
                    <input type="number" placeholder="أدخل البريد الإلكتروني" id="bal" value="<?php echo $o['amount_r']; ?>">
                </div>
            </div>
            <div class="formrow">
                <div class="heading">
                    تفاصيل العملية
                </div>
                <div class="catselect">
                    <textarea name="" id="txn" placeholder="أدخل تفاصيل العملية"></textarea>
                </div>
            </div>
            <div class="formrow">
                <span id='pdstatus' style='font-size:1.3rem; color:#556ee6;'></span>
                <button class='add' onclick="approve_req(<?php echo $id; ?>)">
                    قبول</button>
            </div>
        </div>
    </div>
</div>
<?php
require('require/foot.php');
?>