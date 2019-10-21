<?php
include_once 'DBConnect/DBConnect.php';
include_once 'CustomerManager/OrderManager.php';
include_once 'CustomerManager/Order.php';

$orderManager = new OrderManager();
$id = $_GET['id'];
$detail = $orderManager->getOrderById($id);
if (isset($_POST["status"])){
    $new_status=$_POST["status"];
    $orderManager->updateStatus($id,$new_status);
    header("Location:orderDetail.php?id=$id");
}
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
<h1>Thong tin khach hang</h1>
<table>
    <tr>
        <td>Ma khach hang:</td>
        <td><?php echo $detail[0]['customerNumber'] ?></td>
    </tr>
    <tr>
        <td>Ten khach hang:</td>
        <td><?php echo $detail[0]['customerName'] ?></td>
    </tr>
    <tr>
        <td>Dien thoai:</td>
        <td><?php echo $detail[0]['phone'] ?></td>
    </tr>
    <tr>
        <td>Dia chi:</td>
        <td><?php echo $detail[0]['address'] ?></td>
    </tr>
    <tr>
        <td>Trang thai:</td>
        <td><?php echo $detail[0]['status'] ?></td>
    </tr>
</table>

<h1>Trạng thái : </h1>
<form action="" method="post">
    <select name="status">
        <option value="Shipped>">
                Shipped
        </option>

        <option value="Cancelled">
            Cancelled
        </option>

        <option value="In Process">
            In Process
        </option>

        <option value="On Hold">
            On Hold
        </option>

        <option value="Resolved">
            Resolved
        </option>

        <option value="Disputed">
            Disputed
        </option>
    </select>
    <input type="submit" value="Update" onclick="return confirm('bạn muốn sửa không ?')">
</form>

<h1>Chi tiet hoa don </h1>
<table>
    <tr>
        <td>STT</td>
        <td>Ten san pham</td>
        <td>So luong</td>
        <td>Gia tien mot san pham</td>
        <td>Tong tien</td>
    </tr>
    <?php foreach ($detail as $key => $value): ?>
        <tr>
            <td><?php echo ++$key ?></td>
            <td><?php echo $value['productName'] ?></td>
            <td><?php echo $value['quantity'] ?></td>
            <td><?php echo $value['price'] ?></td>
            <td><?php echo $value['total'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
