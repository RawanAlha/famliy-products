<?php
require('require/top.php');
$order = getMyOrders($con, 6, 0);
?>
<div class="path">
    <div class="container">
        <a href="index.php">الرئيسية</a>
        /
        <a href="order_assigned.php">الطلبات المسندة</a>
    </div>
</div>
<div class="cartrow" id="catrow">
    <div class="gh">
        <div class="heading">
            <h3>الطلبات المقدمة</h3>
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
                            $id = $o['o_id'];
                            $d = mysqli_num_rows(mysqli_query($con, "select * from cnfrm_undelivery where od_id='$id'"));
                            if ($d == 0) {
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
                                        <span class="badge green">غير مسلم</span>
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