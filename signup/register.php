<?php

include_once("../sql/SQLHelper.php");//连接数据库
include_once("smtp.class.php");//邮件发送类

$username = stripslashes(trim($_POST['username']));
$password = md5(trim($_POST['password'])); //加密密码
$email = trim($_POST['email']); //邮箱
$mysql = new \SQL\SQLHelper();


$sql = "select id from t_user where email='$email'";
$res = mysqli_query($mysql->conn, $sql);
$num = mysqli_num_rows($res);
if ($num > 0) {
    \Response\Response::send(-1, '用户已存在，请换个其他的用户名', []);
}

$regtime = time();
$token = md5($username . $password . $regtime); //创建用于激活识别码
$token_exptime = time() + 60 * 60 * 24;//过期时间为24小时后
$sql = "insert into `user` (`username`,`password`,`email`,`token`,`token_exptime`,`regtime`) values ('$username','$password','$email','$token','$token_exptime',current_time());";

$res = mysqli_query($mysql->conn, $sql);

if ($id = mysqli_insert_id($mysql->conn)) {//写入成功，发邮件
    //echo "写入成功，发邮件";
    $smtpserver = "smtpdm.aliyun.com"; //SMTP服务器
    $smtpserverport = 25; //SMTP服务器端口
    $smtpusermail = "yiwangchunyu@aliyun.com"; //SMTP服务器的用户邮箱
    $smtpuser = "yiwangchunyu@aliyun.com"; //SMTP服务器的用户帐号
    $smtppass = "wangchunyu131"; //SMTP服务器的用户密码
    $smtp = new smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass); //这里面的一个true是表示使用身份验证,否则不使用身份验证.
    $smtp->debug = true;//是否显示发送的调试信息
    $emailtype = "HTML"; //信件类型，文本:text；网页：HTML
    $smtpemailto = $email;
    $smtpemailfrom = $smtpusermail;
    $emailsubject = "用户帐号激活";
    $emailbody = "亲爱的" . $username . "：<br/>感谢您在我站注册了新帐号。<br/>请点击链接激活您的帐号。<br/>
  <a href='http://bbs.yiwangchunyu.wang/signup/active.php?verify=" . $token . "' target='_blank'>http://lolita.yiwangchunyu.wang:8081/signup/active.php?verify=" . $token . "</a>
  <br/>如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。<br/>如果此次激活请求非你本人所发，请忽略本邮件。<br/>
  ";
    $rs = $smtp->sendmail($smtpemailto, $smtpemailfrom, $emailsubject, $emailbody, $emailtype);

    if ($rs == 1) {
        $code = 0;
        $msg = '恭喜您，注册成功！<br/>请登录到您的邮箱及时激活您的帐号！';
    } else {
        $sql = "delete from user where id = '$id';";
        mysqli_query($mysql->conn, $sql);
        $code = -1;
        $msg = $rs . "   : 对不起，邮件发送失败！请检查邮箱填写是否有误。" . "\n" .
            "$smtpemailto";
    }
    \Response\Response::send($code, $msg, []);
}
mysqli_close($mysql->conn);
?>
