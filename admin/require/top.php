<?php
require('../utility/utility.php');
if (!isset($_SESSION['IS_LOGIN_ADMIN'])) {
    redirect('login.php');
} else {
?>
    <!DOCTYPE html>
    <html lang="ar">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>لوحة الإدارة | لوحة التحكم</title>
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://kit.fontawesome.com/1615ee01dc.js" crossorigin="anonymous"></script>
</head>

    <body>
        <div class="floatwrap" id="floatwrap">
            <div class="cataddbox" id="cataddbox"></div>
        </div>
        <div class="floatwrap" id="floatwrap2">
            <div class="cataddbox" id="cataddboxsub"></div>
        </div>
        <div class="floatwrap global" id="globalfloatwrap">
            <div class="updatebalance" id="updatebalance">
                <div class="row">
                    <h1>الرصيد الحالي:</h1>
                    <h3>$ 1700</h3>
                </div>
                <div class="row2">
                    <input type="number" placeholder="أدخل الرصيد المحدث" />
                    <button class="add">
                        <i class="fa fa-refresh" aria-hidden="true"></i>
                        تحديث
                    </button>
                </div>
                <div class="row2">
                    <button class="add" onclick="closebalance()">
                        <i class="fa fa-times" aria-hidden="true"></i>
                        إغلاق
                    </button>
                </div>
            </div>
            <div class="productview" id="productview"></div>
            <div class="productview" id="productviewapprove">
                <div class="row">
                    <div class="left">
                        <div class="image">
                            <img src="assets/images/2.jpg" alt="" id="mi" />
                        </div>
                        <div class="imgrow">
                            <div class="imb" onclick="changeview('assets/images/1.jpg')">
                                <img src="assets/images/1.jpg" alt="" />
                            </div>
                            <div class="imb" onclick="changeview('assets/images/2.jpg')">
                                <img src="assets/images/2.jpg" alt="" />
                            </div>
                        </div>
                        <div class="namebox">
                            <h3>المنتج 1 غلاية كهربائية</h3>
                        </div>
                        <div class="namebox">
                            كهربائي | <span>فرشاة</span>
                        </div>
                        <div class="namebox">
                            <span class="price">
                                السعر:
                                <span class="tag">
                                    $ 1700 |&nbsp;<em class="crs">$ 100</em>
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="right">
                        <h3>وصف مختصر:</h3>
                        <br />
                        <p>نص تجريبي باللغة العربية</p>
                        <br />
                        <h3>الوصف:</h3>
                        <br />
                        <p>نص تجريبي باللغة العربية للوصف الكامل</p>
                        <div class="stock">
                            <span>متوفر في المخزون</span>
                        </div>
                        <div class="stock">
                            <span class="qty">الكمية: 80 قطعة</span>
                        </div>
                        <div class="stock">
                            <span class="qty">
                                أضيف بواسطة: <span class="n">المدير</span>
                            </span>
                        </div>
                        <div class="stock">
                            <span class="qty">
                                التاريخ: <span class="n">12/12/12</span>
                            </span>
                        </div>
                        <div class="btnrow">
                            <button class="adcatbtn" onclick="closeadctp()">
                                <i class="fa fa-times" aria-hidden="true"></i>
                                إغلاق
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mainbody-wrapper">
            <div class="navigation">
                <div class="photo">
                    <img src="assets/images/2.jpg" alt="صورة المدير" />
                </div>
                <div class="top">
                    <h2>مرحباً</h2>
                    <br />
                    <h2>
                        <span>المدير</span>
                    </h2>
                </div>
                <div class="menutittle">القائمة</div>
                <ul>
                    <a href="index.php">
                        <li>
                            <i class="fa fa-home" aria-hidden="true"></i>
                            &nbsp;لوحة التحكم
                        </li>
                    </a>
                    <a href="categories.php">
                        <li>
                            <i class="fa fa-list" aria-hidden="true"></i>
                            &nbsp;الفئات
                        </li>
                    </a>
                   
                   
                   
                   
                    <a href="product.php">
                        <li>
                            <i class="fa fa-briefcase" aria-hidden="true"></i>
                            &nbsp;المنتجات
                        </li>
                    </a>
                    <a href="seller.php">
                        <li>
                            <i class="fa fa-users" aria-hidden="true"></i>
                            &nbsp;البائعون
                        </li>
                    </a>
                    <a href="user.php">
                        <li>
                            <i class="fa fa-user" aria-hidden="true"></i>
                            &nbsp;المستخدمون
                        </li>
                    </a>
                    <a href="deliveryboy.php">
                        <li>
                            <i class="fa fa-user" aria-hidden="true"></i>
                            &nbsp;مندوب التوصيل
                        </li>
                    </a>
                 
                 
                 
                  
                  
                  
                  
                   
                   
                  
                
                
                
                  
                 
                    <a href="earning.php">
                        <li>
                            <i class="fa fa-usd" aria-hidden="true"></i>
                            &nbsp;الأرباح
                        </li>
                    </a>
                    <a href="sellerapprove.php">
                        <li>
                            <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                            &nbsp;الموافقة على البائع
                            <?php
                            $count = mysqli_num_rows(mysqli_query($con, "select * from sellers where is_cp='1' and is_new='1' and isapp='0'"));
                            if ($count > 0) {
                            ?>
                                <span style="background:red; padding:0.3rem; color:white; border-radius:50%">
                                    <?php echo $count; ?>
                                </span>
                            <?php
                            }
                            ?>
                        </li>
                    </a>
                    <a href="nonsellerapprove.php">
                        <li>
                            <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                            &nbsp;البائعون غير المعتمدين
                            <?php
                            $count = mysqli_num_rows(mysqli_query($con, "select * from sellers where is_cp='0' and is_new='1'"));
                            if ($count > 0) {
                            ?>
                                <span style="background:red; padding:0.3rem; color:white; border-radius:50%">
                                    <?php echo $count; ?>
                                </span>
                            <?php
                            }
                            ?>
                        </li>
                    </a>
                    <a href="productapprove.php">
                        <li>
                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                            &nbsp;الموافقة على المنتج
                            <?php
                            $count = mysqli_num_rows(mysqli_query($con, "select * from product where isnew='1' and isappp='0'"));
                            if ($count > 0) {
                            ?>
                                <span style="background:red; padding:0.3rem; color:white; border-radius:50%">
                                    <?php echo $count; ?>
                                </span>
                            <?php
                            }
                            ?>
                        </li>
                    </a>
                    <a href="witdraw.php">
                        <li>
                            <i class="fa fa-share-square-o" aria-hidden="true"></i>
                            &nbsp;طلبات السحب
                            <?php
                            $count = mysqli_num_rows(mysqli_query($con, "select * from witdraw_req where isnew='1'"));
                            if ($count > 0) {
                            ?>
                                <span style="background:red; padding:0.3rem; color:white; border-radius:50%">
                                    <?php echo $count; ?>
                                </span>
                            <?php
                            }
                            ?>
                        </li>
                    </a>
                    <a href="adduser.php">
                        <li>
                            <i class="fa fa-hourglass-start" aria-hidden="true"></i>
                            &nbsp;إضافة مستخدم
                        </li>
                    </a>
                    <a href="addseller.php">
                        <li>
                            <i class="fa fa-hourglass-start" aria-hidden="true"></i>
                            &nbsp;إضافة بائع
                        </li>
                    </a>
                    <a href="addDeliveryBoy.php">
                        <li>
                            <i class="fa fa-hourglass-start" aria-hidden="true"></i>
                            &nbsp;إضافة مندوب توصيل
                        </li>
                    </a>
                </ul>
            </div>
            <div class="workspace">
                <header>
                    <button onclick="logout()">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="beige" width="15px" height="15px">
                            <path d="M0 0h24v24H0z" fill="none" />
                            <path d="M13 3h-2v10h2V3zm4.83 2.17l-1.42 1.42C17.99 7.86 19 9.81 19 12c0 3.87-3.13 7-7 7s-7-3.13-7-7c0-2.19 1.01-4.14 2.58-5.42L6.17 5.17C4.23 6.82 3 9.26 3 12c0 4.97 4.03 9 9 9s9-4.03 9-9c0-2.74-1.23-5.18-3.17-6.83z" />
                        </svg>
                        تسجيل الخروج
                    </button>
                </header>
            <?php
        }
            ?>