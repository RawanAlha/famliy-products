<?php
require('require/top.php');
?>
<div class="wrwr">
    <div class="path" id="path">
        <a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> لوحة التحكم</a>
        <span>/</span>
        <a href="adduser.php">إضافة مستخدم</a>
    </div>
    <div class="catbox-row">
        <div class="catboxp">
            <h1><?php echo "إضافة مستخدم"; ?></h1>
            <div class="formrow">
                <div class="heading">
                    الاسم
                </div>
                <div class="catselect">
                    <input type="text" placeholder="أدخل الاسم" id="u-name">
                </div>
            </div>
            <div class="formrow">
                <div class="heading">
                    البريد الإلكتروني
                </div>
                <div class="catselect">
                    <input type="email" placeholder="أدخل البريد الإلكتروني" id="umail">
                </div>
            </div>
            <div class="formrow">
                <div class="heading">
                    رقم الجوال
                </div>
                <div class="catselect">
                    <input type="number" placeholder="أدخل رقم الجوال" id="umobile">
                </div>
            </div>
            <div class="formrow">
                <div class="heading">
                    كلمة المرور
                </div>
                <div class="catselect">
                    <input type="password" placeholder="أدخل كلمة المرور" id="upass">
                </div>
            </div>
            <div class="formrow">
                <span id='pdstatus' style='font-size:1.3rem; color:#556ee6;'></span>
                <button class='add' onclick='add_neew_user()'>
                    <i class='fa fa-plus' aria-hidden='true'></i>
                    تعديل</button>
            </div>
        </div>
    </div>
</div>
<?php
require('require/foot.php');
?>