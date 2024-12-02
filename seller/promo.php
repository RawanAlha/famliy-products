<?php
require('require/top.php');
?>
<div class="path" dir="rtl">
    <div class="container">
        <a href="index.php">الرئيسية</a>
        /
        <a href="promo.php">العروض الترويجية</a>
    </div>
</div>
<div class="cartrow" id="catrow" dir="rtl">
    <div class="gh">
        <div class="heading">
            <h3>جميع العروض الترويجية</h3>
            <a href="add_promo.php">إضافة عرض ترويجي</a>
        </div>
        <div class="maincontainer">
            <table class="wishlist">
                <thead>
                    <th>#</th>
                    <th>الرمز</th>
                    <th>الخصم</th>
                    <th>الحد الأدنى للرصيد</th>
                    <th>الإجراءات</th>
                </thead>
                <tbody>
                    <?php
                    $sellerid = $_SESSION['SELLER_ID'];
                    $query = "select * from promo where adb='$sellerid' order by id desc";
                    $res = mysqli_query($con, $query);
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        <tr>
                            <td>
                                <?php echo $i; ?>
                            </td>
                            <td>
                                <?php echo $row['code'] ?>
                            </td>
                            <td> <?php echo $row['dis']; ?></td>
                            <td>
                                <?php echo $row['minbal']; ?>
                            </td>
                            <td>
                                <div class="acn">
                                    <a href="javascript:void(0)" onclick="delpromo(<?php echo $row['id']; ?>)" class="del">
                                        <i class="uil uil-trash-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php
                        $i++;
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