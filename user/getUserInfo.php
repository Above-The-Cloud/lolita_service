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
$username = $_POST['username'] ?? 0;
$id = $_POST['id'] ?? 0;


if ($phone_num||$username||$id) {
    \Response\Response::send(-1, '参数错误', []);
}
$conn = (new \SQL\SQLHelper())->conn;

$query = "select * from user where phone_num='$phone_num' or username='$username' or id=$id;";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while($row = $result->fetch_assoc()){
        \Response\Response::send(0, 'success', []);
        break;
    }

} else {

    \Response\Response::send(-1, '用户不存在', []);
}

\Response\Response::send(-1, '', []);