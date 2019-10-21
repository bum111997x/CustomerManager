<?php
include_once 'DBConnect/DBConnect.php';
include_once 'Order.php';


class OrderManager
{
    protected $conn;

    public function __construct()
    {
        $db = new DBConnect('mysql:host=localhost;dbname=classicmodels', 'BUM', '1');
        $this->conn = $db->connect();
    }

    public function getAll()
    {
        $sql = 'SELECT o.orderNumber AS \'orderNumber\', o.orderDate AS \'orderDate\',
                o.status AS \'status\', SUM(od.priceEach) AS \'totalPrice\' FROM orders o
                INNER JOIN orderdetails od
                ON o.orderNumber = od.orderNumber
                GROUP BY od.orderNumber;';
        $stmt = $this->conn->query($sql);
        $result = $stmt->fetchAll();
        $orders = [];
        foreach ($result as $value) {
            $order = new Order($value['orderNumber'], $value['orderDate'], $value['status'], $value['totalPrice']);
            array_push($orders, $order);
        }
        return $orders;
    }

    public function getOrderById($id)
    {
        $sql = "SELECT c.customerNumber AS 'customerNumber', c.customerName AS 'customerName', c.phone AS 'phone', 
                c.addressLine1 AS 'address', o.status AS 'status' ,p.productName AS 'productName', 
                od.quantityOrdered AS 'quantity',od.priceEach AS 'price' ,od.quantityOrdered*od.priceEach AS 'total'
                FROM customers c
                INNER JOIN orders o
                ON c.customerNumber = o.customerNumber
                INNER JOIN orderdetails od
                ON o.orderNumber = od.orderNumber
                INNER JOIN products p
                ON od.productCode = p.productCode
                WHERE o.orderNumber = $id
                ";
        $stmt = $this->conn->query($sql);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function updateStatus($id, $status)
    {
        $sql = "UPDATE orders SET status =:status WHERE orderNumber=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }
}