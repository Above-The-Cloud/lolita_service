<?php
/**
 * Created by PhpStorm.
 * User: SpringRain
 * Date: 2018/10/7
 * Time: 23:00
 */

include_once "../sql/SQLHelper.php";
include_once "../Response.php";

$conn = (new \SQL\SQLHelper())->conn;

$query = "select * from user;";
$result = mysqli_query($conn, $query);
$return = [];
if (mysqli_num_rows($result) > 0) {
    while($row = $result->fetch_assoc()){
        $return[] = $row;
    }
}
\Response\Response::send(0, 'success', $return);