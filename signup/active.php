<?php

$mysql = new \SQL\SQLHelper();

$verify = stripslashes(trim($_GET['verify']));
$nowtime = time();
$query = mysqli_query($mysql->conn, "select id,token_exptime from user where status='0' and
`token`='$verify'");
$row = mysqli_fetch_array($query);
if($row){
  if($nowtime>$row['token_exptime']){ //24hour
    $msg = '您的激活有效期已过，请登录您的帐号重新发送激活邮件.';
  }else{
    mysqli_query($mysql->conn, "update user set status=1 where id=".$row['id']);
    if(mysqli_affected_rows($mysql->conn)!=1) die(0);
    $msg = '激活成功！';
  }
}else{
  $msg = 'error.';
}
echo $msg;
echo "</br>";
header("refresh:3;url=../index.php");
print('正在加载，请稍等...<br>三秒后自动跳转到登录页面~~~');
?>