<?php
require('require/top.php');
$order = getMyOrders($con, 5, 1);
?>
<div class="path" dir="rtl">
  <div class="container">
    <a href="index.php">الرئيسية</a>
    /
    <a href="delivered.php">تم التوصيل</a>
  </div>
</div>
<div class="cartrow" id="catrow">
  <div class="gh">
    <div class="heading">
      <h3>الطلبات المُسلّمة</h3>
    </div>
    <div class="maincontainer">
      <table class="wishlist">
        <thead>
          <th>#</th>
          <th>رقم الطلب</th>
          <th>تاريخ الإضافة</th>
          <th>الحالة</th>
          <th>تم التأكيد</th>
          <th>الإجراء</th>
        </thead>
        <tbody>
          <?php
          if (count($order) > 0) {
            $i = 1;
            foreach ($order as $o) {
              $idd = $o['id'];
              $sellerId = $_SESSION['SELLER_ID'];

              $rd = mysqli_query($con, "select * from order_stlmnt where oid='$idd' and sid='$sellerId'");
              if (mysqli_num_rows($rd) == 0) {
          ?>
                <tr>
                  <td><?php echo $i;
                      $i++; ?></td>
                  <td>
                    <a href="javascript:void(0)">
                      <?php echo $o['o_id']; ?>
                    </a>
                  </td>
                  <td><?php echo $o['added_on']; ?></td>
                  <td>
                    <span class="badge green">تم التوصيل</span>
                  </td>
                  <td>
                    <span class="badge green">نعم</span>
                  </td>
                  <td>
                    <div class="acn">
                      <a href="order-detail.php?id=<?php echo $o['id']; ?>" class="view">
                        <i class="uil uil-eye"></i>
                      </a>
                    </div>
                  </td>
                </tr>
          <?php
              }
            }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php
require("require/foot.php");
?>