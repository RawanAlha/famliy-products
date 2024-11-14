<div class="left">
            <div class="ul-wrapper">
              <ul>
                <li <?php if($_SERVER['PHP_SELF']==D."/myac.php"){ echo "class='active'"; } ?>>
                  <i class="uil uil-box"></i>
                  <a href="myac.php">طلباتي</a>
                </li>
                <li <?php if($_SERVER['PHP_SELF']==D."/wallet.php"){ echo "class='active'"; } ?>>
                  <i class="uil uil-wallet"></i>
                  <a href="wallet.php">محفظتي</a>
                </li>
                <li <?php if($_SERVER['PHP_SELF']==D."/wishlist.php"){ echo "class='active'"; } ?>>
                  <i class="uil uil-heart"></i>
                  <a href="wishlist.php">قائمة المفظلة</a>
                </li>
                <li <?php if($_SERVER['PHP_SELF']==D."/address.php" || $_SERVER['PHP_SELF']==D."/edit_address.php" || $_SERVER['PHP_SELF']==D."/add_address.php"){ echo "class='active'"; } ?>>
                  <i class="uil uil-location-point"></i>
                  <a href="address.php">عنواني</a>
                </li>
                <li onclick="logout()">
                  <i class="uil uil-sign-out-alt"></i>
                  <a href="javascript:void(0)">تسجيل الخروج</a>
                </li>
              </ul>
            </div>
          </div>
