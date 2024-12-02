<?php
require("require/top.php");
if (!isset($_GET['hash'])) {
    redirect('index.php');
    die();
}
authorise($con);
authenticate_seller($_GET['hash']);
$rt = 0;
if (isset($_GET['rt'])) {
    $rt = $_GET['rt'];
}
$sid = $_SESSION['SELLER_ID'];
$query = "select * from sellers where id='$sid'";
$seller_res = mysqli_query($con, $query);
$seller_row = mysqli_fetch_assoc($seller_res);
$is_approve = $seller_row['isapp'];
$cp = $seller_row['is_cp'];
$fullname = $seller_row['f_name'];
$type = $seller_row['tob'];
$bname = $seller_row['b_name'];
$cntry = $seller_row['country'];
$state = $seller_row['state'];
$city = $seller_row['city'];
$pin = $seller_row['pin'];
$is_gst = $seller_row['is_gst'];
$gstnum = $seller_row['gst_id'];
$acn = $seller_row['acc_num'];
$ach = $seller_row['acc_holder'];
$bank = $seller_row['bank'];
$branch = $seller_row['branch'];
$ifsc = $seller_row['ifsc'];

?>
<div class="path">
    <div class="container">
        <a href="index.php">الرئيسية</a>
        /
        <a href="edit_profile.php?hash=<?php echo hash_code() ?>">تعديل الملف الشخصي</a>
    </div>
</div>
<div class="cartrow" id="catrow">
    <div class="gh">
        <div class="heading">
            <h3>تعديل الملف الشخصي</h3>
        </div>
        <div class="maincontainer2">
            <form action="#">
                <h1 style="color:#556ee6" class="mt3">التفاصيل الأساسية</h1>
                <div class="formrow">
                    <div class="heading">الاسم</div>
                    <input type="text" placeholder="الاسم" id="seller_full_name" value="<?php echo $fullname; ?>">
                </div>
                <div class="formrow">
                    <div class="heading">ايميل</div>
                    <input type="email" placeholder="Enter Email Id" id="ايميل" value="<?php echo $seller_row['email']; ?>">
                </div>
                <div class="formrow">
                    <div class="heading">جوال </div>
                    <input type="text" placeholder="جوال" id="mobile" value="<?php echo $seller_row['mobile']; ?>">
                </div>
                <div class="formrow">
                    <div class="heading">عنوان </div>
                    <input type="text" placeholder="عنوان" id="address" value="<?php echo $seller_row['address']; ?>">
                </div>
                <h1 style="color:#556ee6" class="mt3">تفاصيل العمل</h1>
                <div class="formrow">
                    <div class="heading">نوع العمل</div>
                    <select class="select" name="addscatname" id="seller_b_type">
                        <option value="#">نوع العمل</option>
                        <?php
                        $queryi = "select * from business_type order by id desc";
                        $resi = mysqli_query($con, $queryi);
                        while ($rowi = mysqli_fetch_assoc($resi)) {
                            if ($rowi['id'] == $type) {
                        ?>
                                <option value="<?php echo $rowi['id']; ?>" selected><?php echo $rowi['type']; ?>
                                </option>
                            <?php } else { ?>
                                <option value="<?php echo $rowi['id']; ?>"><?php echo $rowi['type']; ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
                <div class="formrow">
                    <div class="heading">اسم العمل</div>
                    <input type="text" placeholder="اسم العمل" id="seller_b_name" value="<?php echo $bname; ?>">
                </div>
                <div class="formrow">
                    <div class="heading">دولة</div>
                    <select class="select" id="fsc" onchange="getstatelist()">
                        <option value="#">دولة</option>
                        <?php
                        $query = "select * from country order by id desc";
                        $res = mysqli_query($con, $query);
                        while ($row = mysqli_fetch_assoc($res)) {
                            if ($row['id'] == $cntry) {
                        ?>
                                <option value="<?php echo $row['id']; ?>" selected><?php echo $row['cntry_name']; ?>
                                </option>
                            <?php } else { ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['cntry_name']; ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
                <div class="formrow">
                    <div class="heading">ولاية</div>
                    <?php if ($state == '') { ?>
                        <select class="select" id="fscb" style="margin:1rem 0 0 0;" onchange="getcitylist()">
                            <option value="#">ولاية</option>
                        </select>
                    <?php } else { ?>
                        <select class="select" id="fscb" style="margin:1rem 0 0 0;" onchange="getcitylist()">
                            <?php
                            $querys = "select * from state where c_id='$cntry' order by id desc";
                            $ress = mysqli_query($con, $querys);
                            while ($rows = mysqli_fetch_assoc($ress)) {
                                if ($rows['id'] == $state) {
                            ?>
                                    <option value="<?php echo $rows['id']; ?>" selected><?php echo $rows['state_name']; ?>
                                    </option>
                                <?php } else { ?>
                                    <option value="<?php echo $rows['id']; ?>"><?php echo $rows['state_name']; ?></option>
                            <?php }
                            } ?>
                        </select>
                    <?php } ?>
                </div>
                <div class="formrow">
                    <div class="heading">مدينة</div>
                    <?php if ($city == '') { ?>
                        <select class="select" id="fscb2" style="margin:1rem 0 0 0;" onchange="getpinlist()">
                            <option value="#">مدينة</option>
                        </select>
                    <?php } else { ?>
                        <select class="select" id="fscb2" style="margin:1rem 0 0 0;" onchange="getcitylist()">
                            <?php
                            $querys = "select * from city where s_id='$state' order by id desc";
                            $ress = mysqli_query($con, $querys);
                            while ($rows = mysqli_fetch_assoc($ress)) {
                                if ($rows['id'] == $state) {
                            ?>
                                    <option value="<?php echo $rows['id']; ?>" selected><?php echo $rows['city_name']; ?>
                                    </option>
                                <?php } else { ?>
                                    <option value="<?php echo $rows['id']; ?>"><?php echo $rows['city_name']; ?></option>
                            <?php }
                            } ?>
                        </select>
                    <?php } ?>
                </div>
                <div class="formrow">
                    <div class="heading">الرمز البريدي</div>
                    <?php if ($city == '') { ?>
                        <select class="select" id="fscb3" style="margin:1rem 0 0 0;">
                            <option value="#">الرمز البريدي</option>
                        </select>
                    <?php } else { ?>
                        <select class="select" id="fscb3" style="margin:1rem 0 0 0;" onchange="getcitylist()">
                            <?php
                            $querys = "select * from pin where c_id='$city' order by id desc";
                            $ress = mysqli_query($con, $querys);
                            while ($rows = mysqli_fetch_assoc($ress)) {
                                if ($rows['id'] == $pin) {
                            ?>
                                    <option value="<?php echo $rows['id']; ?>" selected><?php echo $rows['pincode']; ?>
                                    </option>
                                <?php } else { ?>
                                    <option value="<?php echo $rows['id']; ?>"><?php echo $rows['pincode']; ?></option>
                            <?php }
                            } ?>
                        </select>
                    <?php } ?>
                </div>
                <div class="formrow">
                    <div class="heading">ضريبة السلع والخدمات
</div>
                    <?php if ($is_gst == '0') { ?>
                        <select class="select" name="addscatname" id="isgst" onchange="is_gst()">
                            <option value="#">اختر ضريبة السلع والخدمات
</option>
                            <option value="1">تعم</option>
                            <option value="2">لا</option>
                        </select>
                    <?php } else { ?>

                        <?php if ($is_gst == 1) { ?>
                            <select class="select" name="addscatname" id="isgst" onchange="is_gst()">
                                <option value="1" selected>نعم</option>
                                <option value="2">لا</option>
                            </select>
                        <?php } else { ?>
                            <select class="select" name="addscatname" id="isgst" onchange="is_gst()">
                                <option value="1">نعم</option>
                                <option value="2" selected>لا</option>
                            </select>
                    <?php }
                    } ?>
                </div>
                <?php if ($is_gst == '0' || $is_gst == '2') { ?>
                    <div class="formrow" id='isgst1' style="display:none;">
                        <div class="heading">رقم ضريبة السلع والخدمات
</div>
                        <input type="text" placeholder="ادخل رقم ضريبة السلع والخدمات" id="seller_gst_num" value="<?php echo $gstnum; ?>" />
                    </div>
                <?php } else if ($is_gst == 1) { ?>
                    <div class="formrow" id='isgst1'>
                        <div class="heading">رقم ضريبة السلع والخدمات</div>
                        <input type="text" placeholder="ادخل رقم ضريبة السلع والخدمات" id="seller_gst_num" value="<?php echo $gstnum; ?>" />
                    </div>
                <?php } ?>
                <h1 style="color:#556ee6" class="mt3">التفاصيل البنكية</h1>
                <div class="formrow">
                    <div class="heading">رقم الحساب</div>
                    <input type="number" placeholder="رقم الحساب" id="seller_ac" value="<?php echo $acn; ?>" />
                </div>
                <div class="formrow">
                    <div class="heading">اسم صاحب الحساب</div>
                    <input type="text" id="seller_bank_holder" placeholder="اسم صاحب الحساب" value="<?php echo $ach; ?>" />
                </div>
                <div class="formrow">
                    <div class="heading">اسم البنك</div>
                    <input type="text" id="seller_bank_name" placeholder="اسم البنك" value="<?php echo $bank; ?>" />
                </div>
                <div class="formrow">
                    <div class="heading">اسم الفرع</div>
                    <input type="text" id="seller_branch_name" placeholder="اسم الفرع" value="<?php echo $branch; ?>" />
                </div>
                <div class="formrow">
                    <div class="heading">الرمز المكون من 3 ارقام</div>
                    <input type="text" id="seller_ifsc" placeholder="ادخل الرمز" value="<?php echo $ifsc; ?>" />
                </div>
                <div class="formrow">
                    <span id="pdstatus" style="color:red; font-size:1.4rem; text-transform:capitalize;">

                    </span>
                </div>
                <div class="formrow">
                    <a href="javascript:void(0)" class="btn d-flex-center-a-j bg-main br-15" onclick="update_profile()">
                        <i class="uil uil-plus"></i>
                        <span>تحديث</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
require("require/foot.php");
?>
