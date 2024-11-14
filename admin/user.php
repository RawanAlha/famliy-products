<?php
require('require/top.php');
?>
<div class="wrwr">
    <div class="path" id="path">
        <a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> لوحة التحكم</a>
        <span>/</span>
        <a href="user.php">المستخدمون</a>
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
                <div class="p_image">البريد الإلكتروني</div>
                <div class="p_image">الجوال</div>
                <div class="p_status">المحفظة</div>
                <div class="p_action">الإجراء</div>
            </div>
            <div class="bspace" id="sellersecroww">
                <?php
                $query = "select * from users order by id desc";
                $res = mysqli_query($con, $query);
                $i = 1;
                while ($row = mysqli_fetch_assoc($res)) {
                    $idd = $row['id'];
                    if ($row['status'] == 1) {
                        $st = "نشط";
                        $cb = "<button class='deactive' onclick='user_acdc($idd, 0)'>
                  <i class='fa fa-eye-slash' aria-hidden='true'></i>تعطيل
                </button>";
                    } else {
                        $st = "معطل";
                        $cb = "
                <button class='active' onclick='user_acdc($idd, 1)'>
                <i class='fa fa-eye' aria-hidden='true'></i>تنشيط
              </button>
                ";
                    }
                ?>
                    <div class="p_row">
                        <div class="slno"><?php echo $i; ?></div>
                        <div class="p_image">
                            <?php

                            echo $row['email'];
                            echo "&nbsp;";
                            if ($row['e_vfd'] == 1) {
                            ?>
                                <i class="fa fa-check-circle" aria-hidden="true" style="color:orange;"></i>
                            <?php
                            } else {
                            ?>
                                <i class="fa fa-times-circle" aria-hidden="true" style="color:orange;"></i>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="p_image">
                            <?php

                            echo $row['mobile'];
                            echo "&nbsp;";
                            if ($row['m_vfd'] == 1) {
                            ?>
                                <i class="fa fa-check-circle" aria-hidden="true" style="color:orange;"></i>
                            <?php
                            } else {
                            ?>
                                <i class="fa fa-times-circle" aria-hidden="true" style="color:orange;"></i>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="p_status">
                            <span>
                                $
                                <?php
                                $u_id = $row['id'];
                                $ro = mysqli_fetch_assoc(mysqli_query($con, "select * from user_wallet where user_id='$u_id'"));
                                echo $ro['ballance'];
                                ?>
                            </span>
                        </div>
                        <div class="p_action">
                            <?php echo $cb; ?>
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