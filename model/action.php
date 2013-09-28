<?php

	require("../class/soap.class.php");
	$a = new AAA('http://aaa.nsu.edu.cn/NSUAAAWS/OpenAAA.asmx?WSDL');
	$arr = array(
		'UserID' => '',
		'UserPW' => '',
		'UserIP' => $_SERVER["REMOTE_ADDR"],
		'OpenAPIVersion' => "1.0.0.0",
		'Token' => ''
	);

	switch ($_GET['type']) {
		case 'token':
				$a->GetTokenPicture();
			exit;

		case 'keep':
			$arr['UserID']=$_POST['UserID'];
			$arr['UserPW']=$_POST['UserPW'];
			$arr['Token']=$_POST['Token'];
			$list = $a->keeplogin($arr);
			if($list->KeepSessionResult!=True){
				echo "连接超时!";
			}
			break;

		case 'show':
				echo "<p>欢迎你！".$_COOKIE['name']."</p>".
					 "<p>你的宽带为:".$_COOKIE['net']."</p>".
					 "<p>账户有效期至:".$_COOKIE['time']."</p>".
					 "<p>请不要刷新此页面! 祝你愉快! :)</p>".
					 "<p>并请在15分钟后回到本页面重新输入验证码</p>";
			break;

		default:
			$arr['UserID']=$_POST['UserID'];
			$arr['UserPW']=$_POST['UserPW'];
			$arr['Token']=$_POST['Token'];
			$list=$a->Goin($arr);
			$sta = $list->LoginResult;
			if($sta->IsLogin == 1){
				setcookie("net",$list->LoginResult->NetGroupName);
				setcookie("time",$list->LoginResult->ExpireTime);
				setcookie("name",$list->LoginResult->UserName);
			}else{
				echo $list->LoginResult->Message;
			}
		break;
	}

?>