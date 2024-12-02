<?php
require('require/top.php');
$order = getMyOrders($con, 7, 0);
?>
<div class="path">
  <div class="container">
    <a href="index.php">الرئيسية</a>
    /
    <a href="order_assigned.php">ترتيب تم تعيينه</a>
  </div>
</div>
<div class="cartrow" id="catrow">
  <div class="gh">
    <div class="heading">
      <h3>طلبات المشكلات</h3>
    </div>
    <div class="maincontainer">
      <table class="wishlist">
        <thead>
          <th>#</th>
          <th>الرقم</th>
          <th>تمت الإضافة في</th>
          <th>الحالة</th>
          <th>الإجراء</th>
        </thead>
        <tbody>
          <?php
          if (count($order) > 0) {
            $i = 1;
            foreach ($order as $o) {
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
                  <span class="badge orange"> مشكلة </span>
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
          ?>

        </tbody>
      </table>
    </div>
  </div>
</div>
<?php
require("require/foot.php");
?>