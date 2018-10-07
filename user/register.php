<?php
/**
 * Created by PhpStorm.
 * User: SpringRain
 * Date: 2018/10/6
 * Time: 22:09
 */
include_once "../sql/SQLHelper.php";
include_once "../Response.php";

$username = $_POST['username'] ?? 0;
$password = $_POST['password'] ?? 0;
$phone_num = $_POST['phone_num'] ?? 0;

if (!($username && $password && $phone_num)) {
    \Response\Response::send(-1, '参数错误', []);
}
$conn = (new \SQL\SQLHelper())->conn;

$query = "select * from user where username='$username' or phone_num='$phone_num';";
$result = mysqli_query($conn, $query);


if (mysqli_num_rows($result) > 0) {
    \Response\Response::send(-1, '用户名或手机号已存在', []);

} else {
    $query = "insert into user(username, password, phone_num) values('$username', '$password', '$phone_num');";
    $result = mysqli_query($conn, $query);

    \Response\Response::send(0, 'success', []);
}


