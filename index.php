<?php
include_once 'DBConnect/DBConnect.php';
include_once 'CustomerManager/OrderManager.php';
include_once 'CustomerManager/Order.php';

$orderManager = new OrderManager();
$list = $orderManager->getAll();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Danh sách đơn hàng</h1>
<table border="1">
    <tr>
        <td>STT</td>
        <td>Mã đơn hàng</td>
        <td>Ngày mua</td>
        <td>Trạng thái</td>
        <td>Tổng tiền</td>
    </tr>
    <tr>
        <?php foreach ($list as $key => $value): ?>
    <tr>
        <td><?php echo ++$key ?></td>
        <td><a href="orderDetail.php?id=<?php echo $value->orderNumber ?>"><?php echo "DH".$value->orderNumber ?></a></td>
        <td><?php echo $value->orderDate ?></td>
        <td><?php echo $value->status ?></td>
        <td><?php echo $value->totalPrice ?></td>
    </tr>
    <?php endforeach; ?>
    </tr>
</table>
</body>
</html>