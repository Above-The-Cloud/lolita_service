<?php
/**
 * Created by PhpStorm.
 * User: SpringRain
 * Date: 2018/10/6
 * Time: 22:45
 */

include_once "../sql/SQLHelper.php";
include_once "../Response.php";

$phone_num = $_POST['phone_num'] ?? 0;



if (!($password && $phone_num)) {
    \Response\Response::send(-1, '参数错误', []);
}
$conn = (new \SQL\SQLHelper())->conn;

$query = "select * from user where phone_num='$phone_num' and password='$password';";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    \Response\Response::send(0, 'successs', []);

} else {

    \Response\Response::send(-1, '用户名或密码不正确', []);
}

