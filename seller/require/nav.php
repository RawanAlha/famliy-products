<div class="left-part" id="lft">
    <div class="logo">
        <a href="javascript:void(0)">
            <img src="../assets/images/logo.png" alt="logo" />
        </a>
       
        <div class="close-left-nav" onclick="close_res_nav()">
            <i class="uil uil-times"></i>
        </div>
    </div>
    <div class="list-nav">
        <ul class="nav-list">
            <?php 
                if(profile_completed($con)==1 && profle_verified($con)==1){
            ?>
            <li class="outer-list">
                <a href="index.php">
                    <i class="uil uil-estate"></i>
                    <span>لوحة التحكم</span>
                </a>
            </li>
            <li class="outer-list">
                <a href="product.php">
                    <i class="uil uil-box"></i>
                    <span>المنتج</span>
                </a>
            </li>
            
            
            
            <li class="outer-list">
                <a href="order_received.php">
                    <i class="uil uil-archive"></i>
                    <span>تم استلام الطلب &nbsp; <span style="color:red;font-size:1.2rem;font-weight:700"></span></span>
                </a>
            </li>
            <li class="outer-list">
                <a href="order_assigned.php">
                    <i class="uil uil-parcel"></i>
                    <span>تم تعيين الطلب</span>
                </a>
            </li>
            <li class="outer-list">
              <a href="outfordelivery.php">
              <i class="uil uil-car-sideview"></i>
                <span>خارج للتسليم</span>
              </a>
            </li>
            <li class="outer-list">
                <a href="delivery_c.php">
                    <i class="uil uil-voicemail-rectangle"></i>
                    <span>تأكيد التسليم</span>
                </a>
            </li>
            <li class="outer-list">
                <a href="delivered.php">
                    <i class="uil uil-gift"></i>
                    <span>تم التوصيل</span>
                </a>
            </li>
            <li class="outer-list">
                <a href="issue.php">
                    <i class="uil uil-toilet-paper"></i>
                    <span>مشكلة</span>
                </a>
            </li>
            <li class="outer-list">
                <a href="order_setteled.php">
                    <i class="uil uil-bag"></i>
                    <span>الطلبات المستقرة</span>
                </a>
            </li>
            <li class="outer-list">
                <a href="undelivered_c.php">
                    <i class="uil uil-channel"></i>
                    <span>تأكيد عدم التسليم</span>
                </a>
            </li>
            <li class="outer-list">
                <a href="undelivered.php">
                    <i class="uil uil-cube"></i>
                    <span>لم يتم التسليم</span>
                </a>
            </li>
            <li class="outer-list">
                <a href="promo.php">
                <i class="uil uil-no-entry"></i>
                    <span>كود خصم</span>
                </a>
            </li>
            <?php }else{  ?>

            <li class="outer-list">
                <a href="index.php">
                    <i class="uil uil-estate"></i>
                    <span>لوحة التحكم</span>
                </a>
            </li>

            <?php } ?>
        </ul>
    </div>
    <div class="copyright">
        <p>Developed by famliyproducts group</p>
    </div>
</div>