<?php
require('require/top.php');
?>
<div class="wrwr">
    <div class="path" id="path">
        <a href="index.html"><i class="fa fa-home" aria-hidden="true"></i> لوحة التحكم</a>
        <span>/</span>
        <a href="order.html">الطلبات</a>
    </div>
    <div class="rowbtn">
        <div class="b">
            <input type="text" placeholder="البحث بواسطة رقم الطلب" id="sfield" onkeyup="search('sfield','p_name')" />
        </div>
    </div>
    <div class="catbox-row">
        <div class="catbox">
            <div class="heading">
                <div class="slno">الرقم التسلسلي</div>
                <div class="p_namee">رقم الطلب</div>
                <div class="p_status">الحالة</div>
                <div class="date">التاريخ</div>
                <div class="p_action" style="width: 7rem">الإجراء</div>
            </div>
            <div class="bspace">
                <?php
                $query = "select * from orders where seller_id='ADMIN' order by id desc";
                $res = mysqli_query($con, $query);
                $i = 1;
                while ($row = mysqli_fetch_assoc($res)) {

                ?>
                    <div class="p_row">
                        <div class="slno"><?php echo $i;
                                            $i++; ?></div>
                        <div class="p_name"><?php echo $row['o_id']; ?></div>
                        <div class="p_status">
                            <span class="active_span"><?php echo $row['order_status']; ?></span>
                        </div>
                        <div class="date"><?php echo $row['added_on']; ?></div>
                        <div class="p_action" style="width: 7rem">
                            <button class="edit" onclick="redirect_to('showOrderDetail.php?id=<?php echo $row['o_id']; ?>')">
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
        @ 2024 famliyproducts. جميع الحقوق محفوظة.
    </div>
</div>
<?php
require('require/foot.php');
?>