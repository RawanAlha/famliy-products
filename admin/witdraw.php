<?php
require('require/top.php');
$query = "select witdraw_req.*,sellers.f_name from witdraw_req,sellers where sellers.id=witdraw_req.s_id";
$res = mysqli_query($con, $query);
$h = mysqli_query($con, "select * from witdraw_req where isnew='1'");
while ($w = mysqli_fetch_assoc($h)) {
    $jid = $w['id'];
    mysqli_query($con, "update witdraw_req set isnew='0' where id='$jid'");
}
?>
<div class="wrwr">
    <div class="path" id="path">
        <a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> لوحة التحكم</a>
        <span>/</span>
        <a href="witdraw.php">سحب</a>
    </div>
    <div class="rowbtn">
        <div class="b">
            <input type="text" placeholder="البحث بالاسم" id="sfield" onkeyup="search('sfield','p_name')" />
        </div>
    </div>
    <div class="catbox-row">
        <div class="catbox">
            <div class="heading">
                <div class="slno">رقم التسلسل</div>
                <div class="p_namee">الاسم</div>
                <div class="p_status">المحفظة</div>
                <div class="date">المطلوب</div>
                <div class="p_action" style="width: 7rem">الإجراء</div>
            </div>
            <div class="bspace">
                <?php
                $i = 1;
                while ($row = mysqli_fetch_assoc($res)) {
                ?>
                    <div class="p_row" style="height: 3rem;">
                        <div class="slno"><?php echo $i; ?></div>
                        <div class="p_name"><?php echo $row['f_name']; ?></div>
                        <div class="p_status">
                            $ <?php echo $row['amount_w']; ?>
                        </div>
                        <div class="date">$ <?php echo $row['amount_r']; ?></div>
                        <div class="p_action" style="width: 7rem">
                            <button class="edit" onclick="redirect_to('seller_detail.php?sid=<?php echo $row['s_id']; ?>&req=1')">
                                <i class="fa fa-wifi" aria-hidden="true"></i>عرض
                            </button>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="row" style="
              display: block;
              margin-bottom: 2rem;
              font-size: 1.2rem;
              color: #6a7187;
            ">
        @ 2024 famliyproducts. كل الحقوق محفوظة.
    </div>
</div>
<?php
require('require/foot.php');
?>