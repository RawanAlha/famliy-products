<?php
require('require/top.php');
authorise_user2();
$userid = $_SESSION['USER_ID'];
$userData = mysqli_fetch_assoc(mysqli_query($con, "select users.*,user_wallet.ballance from users,user_wallet where users.id='$userid' and user_wallet.user_id=users.id"));
?>
<div class="path">
    <div class="container">
        <a href="index.php">الرئيسية</a>
        /
        <a href="address.php">عنواني</a>
        /
        <a href="add_address.php">إضافة عنوان</a>
    </div>
</div>
<section class="newaddress">
    <?php require('require/headbanner.php'); ?>
    <section class="myac-body">
        <div class="flex row">
            <?php require('require/ac-left.php'); ?>
            <div class="right">
                <h4><i class="uil uil-location-point"></i>إضافة عنوان جديد</h4>
                <div class="col-lg-12 col-md-12">
                    <div class="pdpt-bg">
                        <div class="pdpt-title">
                            <h4>إضافة عنوان</h4>
                        </div>

                        <div class="formbody">
                            <form action="javascript:void(0)">
                                <div class="form-group">
                                    <div class="product-radio">
                                        <ul class="product-now">
                                            <li>
                                                <input type="radio" id="ad1" name="address1" checked="" />
                                                <label for="ad1">المنزل</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="ad2" name="address1" />
                                                <label for="ad2">المكتب</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="ad3" name="address1" />
                                                <label for="ad3">آخر</label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="address-fieldset">
                                    <div class="row">
                                        <div class="row2">
                                            <div class="lt">
                                                <label for="ft">الاسم*</label>
                                                <input type="text" placeholder="الاسم" id="dv-name" />
                                            </div>
                                            <div class="ft">
                                                <label for="ft">الجوال*</label>
                                                <input type="number" placeholder="الرقم" id="dv-number" oninput="validate_number()" />
                                            </div>
                                        </div>
                                        <label for="ft">المدينة*</label>
                                        <select name="" id="dv-city">
                                            <option value="#">اختر المدينة</option>
                                            <?php
                                            $querys = "select * from city order by id desc";
                                            $ress = mysqli_query($con, $querys);
                                            while ($rows = mysqli_fetch_assoc($ress)) {
                                            ?>
                                                <option value="<?php echo $rows['id'] ?>">
                                                    <?php echo $rows['city_name'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <label for="ft">الشقة / البيت / المكتب *</label>
                                        <input type="text" placeholder="العنوان" id="dv-address" />
                                        <div class="row2">
                                            <div class="lt">
                                                <label for="ft">الرمز البريدي*</label>
                                                <input type="text" placeholder="الرمز البريدي" id="dv-pin" />
                                            </div>
                                            <div class="ft">
                                                <label for="ft">الشارع*</label>
                                                <input type="text" placeholder="االشارع" id="dv-land" />
                                            </div>
                                        </div>
                                        <div class="row2">
                                            <button class="save-address" onclick="add_new_address()">
                                                حفظ
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
<?php require('require/foot.php'); ?>
<?php require('require/last.php'); ?>
