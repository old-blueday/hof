<?php
	//include("./setting.php");
	if(!defined("ADMIN_PASSWORD"))
		exit(1);
	/*
	* ��¼
	*/
	if($_POST["pass"] == ADMIN_PASSWORD || $_COOKIE["adminPass"] == ADMIN_PASSWORD) {
		setcookie ("adminPass", $_POST["pass"]?$_POST["pass"]:$_COOKIE["adminPass"],time()+60*30);
		$login = true;
	}

	/*
	* ע��
	*/
	if($_POST["logout"]) {
		setcookie ("adminPass");
		$login = false;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=GBK">
<script type="text/javascript" src="prototype.js"></script>
<title>HoF - �����̨</title>
<style TYPE="text/css">
<!--
form{
margin: 0;
padding: 0;
}
-->
</style>
</head>
<body>
<?php
if($login) {

	/*
	* function dump
	*/
	if(!function_exists("dump")) {
		function dump($var) {
			print("<pre>".print_r($var,1)."</pre>\n");
		}
	}

	/*
	* changeData(��������)
	*/
	function changeData($file,$text) {
		$fp = @fopen($file,"w") or die("file lock error!");
		flock($fp,LOCK_EX);
		fwrite($fp,stripcslashes($text));
		flock($fp,LOCK_UN);
		fclose($fp);
		print("<span style=\"font-weight:bold\">�����޸�</span>");
	}

	/*
	* �˵�
	*/
print <<< MENU
<form action="?" method="post">
<a href="?">������ҳ</a>
<a href="?menu=user">�û�����</a>
<a href="?menu=data">���ݹ���</a>
<a href="?menu=other">����</a>
<input type="submit" value="ע��" name="logout" />
</form>
<hr>
MENU;

	/*
	* �û��б�
	*/
	if($_GET["menu"] === "user") {
		$userList = glob(USER."*");
		print("<p>ȫ���û�</p>\n");
		foreach($userList as $user) {
			print('<form action="?" method="post">');
			print('<input type="submit" name="UserData" value=" ���� ">');
			print('<input type="hidden" name="userID" value="'.basename($user).'">');
			print(basename($user)."\n");
			print("</form>\n");
		}
	}

	/*
	* �û�����
	*/
	else if($_POST["UserData"]) {
		$userFileList = glob(USER.$_POST["userID"]."/*");
		print("<p>USER :".$_POST["userID"]."</p>\n");
		foreach($userFileList as $file) {
			print('<form action="?" method="post">');
			print('<input type="submit" name="UserFileDet" value=" ���� ">');
			print('<input type="hidden" name="userFile" value="'.basename($file).'">');
			print('<input type="hidden" name="userID" value="'.$_POST["userID"].'">');
			print(basename($file)."\n");
			print("</form>\n");
		}
		print('<br><form action="?" method="post">');
		print('ɾ���û�:<input type="text" name="deletePass" size="">');
		print('<input type="submit" name="deleteUser" value="ɾ��">');
		print('<input type="hidden" name="userID" value="'.$_POST["userID"].'">');
		print("</form>\n");
	}

	/*
	* �û�����ɾ��
	*/
	else if($_POST["deleteUser"]) {
		if($_POST["deletePass"] == ADMIN_PASSWORD) {
			include(GLOBAL_PHP);
			include(CLASS_USER);
			$userD = new user($_POST["userID"]);
			$userD->DeleteUser();
			print($_POST["userID"]."��ɾ����");
		} else {
			print("û�����롣");
		}
	}

	/*
	* �û�����(��ϸ)
	*/
	else if($_POST["UserFileDet"]) {
		$file = USER.$_POST["userID"]."/".$_POST["userFile"];
		// �����޸�
		if($_POST["changeData"]) {
			$fp = @fopen($file,"w") or die("file lock error!");
			flock($fp,LOCK_EX);
			fwrite($fp,$_POST["fileData"]);
			flock($fp,LOCK_UN);
			fclose($fp);
			print("�����޸�");
		}

		print("<p>$file</p>\n");
		print('<form action="?" method="post">');
		print('<textarea name="fileData" style="width:800px;height:300px;">');
		print(file_get_contents($file));
		print("</textarea><br>\n");		print('<input type="submit" name="changeData" value="�޸�">');
		print('<input type="submit" value="����">');
		print('<input type="hidden" name="userFile" value="'.$_POST["userFile"].'">');
		print('<input type="hidden" name="userID" value="'.$_POST["userID"].'">');
		print('<input type="hidden" name="UserFileDet" value="1">');
		print("</form>\n");
		print('<form action="?" method="post">');
		print('<input type="submit" name="UserData" value="����">');
		print('<input type="hidden" name="userID" value="'.$_POST["userID"].'">');
		print("</form>\n");
	}

	/*
	* ���ݻ���
	*/
	else if($_GET["menu"] === "data") {
print <<< DATA
<br>
<form action="?" method="post">
<ul>
<li><input type="submit" name="UserDataDetail" value=" ���� ">(��1)�û����ݻ��ܱ�ʾ</li>
<li><input type="submit" name="UserCharDetail" value=" ���� ">(��1)�������ݻ��ܱ�ʾ</li>
<li><input type="submit" name="ItemDataDetail" value=" ���� ">(��1)�������ݻ��ܱ�ʾ</li>
<li><input type="submit" name="UserIpShow" value=" ���� ">(��1)�û�IP��ʾ</li>
<li><input type="submit" name="searchBroken" value=" ���� ">(��1)�п��������𻵵�����<input type="text" name="brokenSize" value="100" size=""></li>
<li><input type="submit" name="adminBattleLog" value=" ���� ">ս����¼����</li>
<li><input type="submit" name="adminAuction" value=" ���� ">��������</li>
<li><input type="submit" name="adminRanking" value=" ���� ">��������</li>
<li><input type="submit" name="adminTown" value=" ���� ">�㳡����</li>
<li><input type="submit" name="adminRegister" value=" ���� ">�û���¼���ݹ���</li>
<li><input type="submit" name="adminUserName" value=" ���� ">�û�������</li>
<li><input type="submit" name="adminUpDate" value=" ���� ">�������ݹ���</li>
<li><input type="submit" name="adminAutoControl" value=" ���� ">�Զ������¼</li>
</ul>
<p>(��1)����Ƚ��������ܡ�<br>
�����������ӵ����ݴ���
</p>
</form>
DATA;
	}

	/*
	* ���ݻ���(�û�����)
	*/
	else if($_POST["UserDataDetail"]) {
		include(GLOBAL_PHP);
		include(CLASS_USER);
		$userFileList = glob(USER."*");
		foreach($userFileList as $user) {
			$user = new user(basename($user,".dat"));
			$totalMoney += $user->money;
		}
		print("UserAmount :".count($userFileList)."<br>\n");
		print("TotalMoney :".MoneyFormat($totalMoney)."<br>\n");
		print("AveMoney :".MoneyFormat($totalMoney/count($userFileList))."<br>\n");
	}

	/*
	* ���ݻ���(��������)
	*/
	else if($_POST["UserCharDetail"]) {
		include(GLOBAL_PHP);
		$userFileList = glob(USER."*");
		foreach($userFileList as $user) {
			$userDir = glob($user."/*");
			foreach($userDir as $fileName) {
				if(!is_numeric(basename($fileName,".dat"))) continue;
				$charData = ParseFile($fileName);
				$charAmount++;
				$totalLevel += $charData["level"];
				$totalStr += $charData["str"];
				$totalInt += $charData["int"];
				$totalDex += $charData["dex"];
				$totalSpd += $charData["spd"];
				$totalLuk += $charData["luk"];
				if($charData["gender"] === "0")
					$totalMale++;
				else if($charData["gender"] === "1")
					$totalFemale++;
				$totalJob[$charData["job"]]++;
				//print($charData["name"]."<br>");
			}
		}
		print("��������:".$charAmount."<br>\n");
		print("ƽ���ȼ� :".$totalLevel/$charAmount."<br>\n");
		print("ƽ��str :".$totalStr/$charAmount."<br>\n");
		print("ƽ��int :".$totalInt/$charAmount."<br>\n");
		print("ƽ��dex :".$totalDex/$charAmount."<br>\n");
		print("ƽ��spd :".$totalSpd/$charAmount."<br>\n");
		print("ƽ��luk :".$totalLuk/$charAmount."<br>\n");
		print("�� :{$totalMale}(".($totalMale/$charAmount*100)."%)<br>\n");
		print("Ů :{$totalFemale}(".($totalFemale/$charAmount*100)."%)<br>\n");
		print("--- ְҵ<br>\n");
		arsort($totalJob);
		include(DATA_JOB);
		foreach($totalJob as $job => $amount) {
			$jobData = LoadJobData($job);
			print($job."({$jobData[name_male]},{$jobData[name_female]})"." : ".$amount."(".($amount/$charAmount*100)."%)<br>\n");
		}
	}

	/*
	* ���ݻ���(��������)
	*/
	else if($_POST["ItemDataDetail"]) {
		include(GLOBAL_PHP);
		$userFileList = glob(USER."*");
		$userAmount = count($userFileList);
		$items = array();
		foreach($userFileList as $user) {
			if(!$data = ParseFile($user."/item.dat"));
			foreach($data as $itemno => $amount)
				$items[$itemno] += $amount;
		}
		foreach($items as $itemno => $amount) {
			if(strlen($itemno) != 4) continue;
			print($itemno." : ".$amount."(ƽ��:".$amount/$userAmount.")<br>");
		}
	}

	/*
	* �û�IP
	*/
	else if($_POST["UserIpShow"]) {
		include(GLOBAL_PHP);
		$userFileList = glob(USER."*");
		$ipList = array();
		foreach($userFileList as $user) {
			$file = $user."/data.dat";
			if(!$data = ParseFile($file)) continue;
			$html .= "<tr><td>".$data["id"]."</td><td>".$data["name"]."</td><td>".$data["ip"]."</td></tr>\n";
			$ipList[$data["ip"]?$data["ip"]:"*UnKnown"]++;
		}
		// �ظ��б�
		print("<p>IP�ظ��б�</p>\n");
		foreach($ipList as $ip => $amount) {
			if(1 < $amount)
				print("$ip : $amount<br>\n");
		}
		print("<table border=\"1\">\n");
		print($tags = "<tr><td>ID</td><td>����</td><td>IP</td></tr>\n");
		print($html);
		print("</table>\n");
	}

	/*
	* �п��������𻵵�����
	*/
	else if($_POST["searchBroken"]) {
		print("<p>���ܻ����ļ�<br>\n");
		$baseSize = $_POST["brokenSize"]?(int)$_POST["brokenSize"]:100;
		print("��{$baseSize}byte ���µ��ļ�����(�������ݳ���).</p>");
		$userFileList = glob(USER."*");
		foreach($userFileList as $user) {
			$userDir = glob($user."/*");
			if(filesize($user."/data.dat") < $baseSize)
				print($user."/data.dat"."(".filesize($user."/data.dat").")"."<br>\n");
			foreach($userDir as $fileName) {
				if(!is_numeric(basename($fileName,".dat"))) continue;
				if(filesize($fileName) < $baseSize)
					print($fileName."(".filesize($fileName).")<br>\n");
			}
		}
	}

	/*
	* ս����¼����
	*/
	else if($_POST["adminBattleLog"]) {
		if($_POST["deleteLogCommon"]) {
			$dir = LOG_BATTLE_NORMAL;
			$logFile = glob($dir."*");
			foreach($logFile as $file) {
				unlink($file);
			}
			print("<p>ͨ��ս����¼ɾ����</p>\n");
		} else if($_POST["deleteLogUnion"]) {
			$dir = LOG_BATTLE_UNION;
			$logFile = glob($dir."*");
			foreach($logFile as $file) {
				unlink($file);
			}
			print("<p>BOSSս����¼ɾ����</p>\n");
		} else if($_POST["deleteLogRanking"]) {
			$dir = LOG_BATTLE_RANK;
			$logFile = glob($dir."*");
			foreach($logFile as $file) {
				unlink($file);
			}
			print("<p>����ս����¼ɾ����</p>\n");
		}
print <<< DATA
<br>
<form action="?" method="post">
<input type="hidden" name="adminBattleLog" value="1">
<ul>
<li><input type="submit" name="deleteLogCommon" value=" ���� ">ͨ��ս����¼ȫ��ɾ��</li>
<li><input type="submit" name="deleteLogUnion" value=" ���� ">BOSSս����¼ȫ��ɾ��</li>
<li><input type="submit" name="deleteLogRanking" value=" ���� ">������¼ȫ��ɾ��</li>
</ul>
</form>
DATA;
	}

	/*
	* ��������
	*/
	else if($_POST["adminAuction"]) {
		$file = AUCTION_ITEM;
		print("<p>��������</p>\n");
		// �����޸�
		if($_POST["changeData"]) {
			changeData($file,$_POST["fileData"]);
		}
		print('<form action="?" method="post">');
		print('<textarea name="fileData" style="width:800px;height:300px;">');
		print(file_get_contents($file));
		print("</textarea><br>\n");		print('<input type="submit" name="changeData" value="�޸�">');
		print('<input type="submit" value="����">');
		print('<input type="hidden" name="adminAuction" value="1">');
		print("</form>\n");
	}

	/*
	* ��������
	*/
	else if($_POST["adminRanking"]) {
		$file = RANKING;
		print("<p>��������</p>\n");
		// �����޸�
		if($_POST["changeData"]) {
			changeData($file,$_POST["fileData"]);
		}
		print('<form action="?" method="post">');
		print('<textarea name="fileData" style="width:800px;height:300px;">');
		print(file_get_contents($file));
		print("</textarea><br>\n");		print('<input type="submit" name="changeData" value="�޸�">');
		print('<input type="submit" value="����">');
		print('<input type="hidden" name="adminRanking" value="1">');
		print("</form>\n");
	}

	/*�㳡����	*/
	else if($_POST["adminTown"]) {
		$file = BBS_TOWN;
		print("<p>�㳡����</p>\n");
		// �����޸�
		if($_POST["changeData"]) {
			changeData($file,$_POST["fileData"]);
		}
		print('<form action="?" method="post">');
		print('<textarea name="fileData" style="width:800px;height:300px;">');
		print(file_get_contents($file));
		print("</textarea><br>\n");		print('<input type="submit" name="changeData" value="�޸�">');
		print('<input type="submit" value="����">');
		print('<input type="hidden" name="adminTown" value="1">');
		print("</form>\n");
	}

	/*
	* �û���¼���ݹ���
	*/
	else if($_POST["adminRegister"]) {
		$file = REGISTER;
		print("<p>�û���¼���ݹ���</p>\n");
		// ��������
		if($_POST["changeData"]) {
			changeData($file,$_POST["fileData"]);
		}
		print('<form action="?" method="post">');
		print('<textarea name="fileData" style="width:800px;height:300px;">');
		print(file_get_contents($file));
		print("</textarea><br>\n");		print('<input type="submit" name="changeData" value="�޸�">');
		print('<input type="submit" value="����">');
		print('<input type="hidden" name="adminRegister" value="1">');
		print("</form>\n");
	}

	/*	* �û�������
	*/
	else if($_POST["adminUserName"]) {
		$file = USER_NAME;
		print("<p>�û�������</p>\n");
		// �����޸�
		if($_POST["changeData"]) {
			changeData($file,$_POST["fileData"]);
		}
		print('<form action="?" method="post">');
		print('<textarea name="fileData" style="width:800px;height:300px;">');
		print(file_get_contents($file));
		print("</textarea><br>\n");		print('<input type="submit" name="changeData" value="�޸�">');
		print('<input type="submit" value="����">');
		print('<input type="hidden" name="adminUserName" value="1">');
		print("</form>\n");
	}

	/*
	* ����������
	*/
	else if($_POST["adminUpDate"]) {
		$file = UPDATE;
		print("<p>����������</p>\n");
		// �����޸�
		if($_POST["changeData"]) {
			changeData($file,$_POST["fileData"]);
		}
		print('<form action="?" method="post">');
		print('<textarea name="fileData" style="width:800px;height:300px;">');
		print(file_get_contents($file));
		print("</textarea><br>\n");		print('<input type="submit" name="changeData" value="�޸�">');
		print('<input type="submit" value="����">');
		print('<input type="hidden" name="adminUpDate" value="1">');
		print("</form>\n");
	}

	/*
	* �Զ������¼
	*/
	else if($_POST["adminAutoControl"]) {
		$file = MANAGE_LOG_FILE;
		print("<p>�Զ������¼</p>\n");
		// �����޸�
		if($_POST["changeData"]) {
			changeData($file,$_POST["fileData"]);
		}
		print('<form action="?" method="post">');
		print('<textarea name="fileData" style="width:800px;height:300px;">');
		print(file_get_contents($file));
		print("</textarea><br>\n");		print('<input type="submit" name="changeData" value="�޸�">');
		print('<input type="submit" value="����">');
		print('<input type="hidden" name="adminAutoControl" value="1">');
		print("</form>\n");
	}

	/*
	* OTHER
	*/
	else if($_GET["menu"] === "other") {
print("
<p>����</p>\n
<ul>\n
<li><a href=\"".ADMIN_DIR."list_item.php\">�����б�</a></li>\n
<li><a href=\"".ADMIN_DIR."list_enchant.php\">װ��Ч���б�</a></li>\n
<li><a href=\"".ADMIN_DIR."list_job.php\">ְҵ�б�</a></li>\n
<li><a href=\"".ADMIN_DIR."list_judge.php\">�ж��б�</a></li>\n
<li><a href=\"".ADMIN_DIR."list_monster.php\">�����б�</a></li>\n
<li><a href=\"".ADMIN_DIR."list_skill3.php\">�����б�</a></li>\n
<li><a href=\"".ADMIN_DIR."set_action2.php\">�ж�ģʽ�趨��</a></li>\n
</ul>\n
");
	}

	/*
	* ������
	*/
	else {
print("<p>�����O��</p>\n
<table border=\"1\">\n
<tr><td>����</td><td>˵��</td><td>ֵ</td></tr>
<tr><td>TITLE</td><td>����</td><td>".TITLE."</td></tr>\n
<tr><td>MAX_TIME</td><td>���Time</td><td>".MAX_TIME."Time</td></tr>\n
<tr><td>TIME_GAIN_DAY</td><td>ÿ��������Time</td><td>".TIME_GAIN_DAY."Time</td></tr>\n
<tr><td>CONTROL_PERIOD</td><td>�Զ���������</td><td>".CONTROL_PERIOD."s(".(CONTROL_PERIOD/60/60)."hour)"."</td></tr>\n
<tr><td>RECORD_IP</td><td>IP��¼(1=ON)</td><td>".RECORD_IP."</td></tr>\n
<tr><td>SELLING_PRICE</td><td>��ֵ</td><td>".SELLING_PRICE."</td></tr>\n
<tr><td>EXP_RATE</td><td>����ֵ����</td><td>x".EXP_RATE."</td></tr>\n
<tr><td>MONEY_RATE</td><td>��Ǯ����</td><td>x".MONEY_RATE."</td></tr>\n
<tr><td>AUCTION_MAX</td><td>����Ʒ��</td><td>".AUCTION_MAX."</td></tr>\n
<tr><td>JUDGE_LIST_AUTO_LOAD</td><td>�����ж��б��Զ�ȡ��(1=�Զ�)</td><td>".JUDGE_LIST_AUTO_LOAD."</td></tr>\n
<tr><td>AUCTION_TOGGLE</td><td>����ON/OFF(1=ON)</td><td>".AUCTION_TOGGLE."</td></tr>\n
<tr><td>AUCTION_EXHIBIT_TOGGLE</td><td>��ƷON/OFF(1=ON)</td><td>".AUCTION_EXHIBIT_TOGGLE."</td></tr>\n
<tr><td>RANK_TEAM_SET_TIME</td><td>���������O������</td><td>".RANK_TEAM_SET_TIME."s(".(RANK_TEAM_SET_TIME/60/60)."hour)"."</td></tr>\n
<tr><td>RANK_BATTLE_NEXT_LOSE</td><td>ʧ�ܺ�����սʱ��</td><td>".RANK_BATTLE_NEXT_LOSE."s(".(RANK_BATTLE_NEXT_LOSE/60/60)."hour)"."</td></tr>\n
<tr><td>RANK_BATTLE_NEXT_WIN</td><td>Ӯ������վ��ս��ʱ��</td><td>".RANK_BATTLE_NEXT_WIN."s</td></tr>\n
<tr><td>NORMAL_BATTLE_TIME</td><td>��ͨս������ʱ��</td><td>".NORMAL_BATTLE_TIME."Time</td></tr>\n
<tr><td>MAX_BATTLE_LOG</td><td>ս����¼������(ͨ����)</td><td>".MAX_BATTLE_LOG."</td></tr>\n
<tr><td>MAX_BATTLE_LOG_UNION</td><td>ս����¼������(BOSS)</td><td>".MAX_BATTLE_LOG_UNION."</td></tr>\n
<tr><td>MAX_BATTLE_LOG_RANK</td><td>ս����¼������(����)</td><td>".MAX_BATTLE_LOG_RANK."</td></tr>\n
<tr><td>UNION_BATTLE_TIME</td><td>BOSSս����ʱ��</td><td>".UNION_BATTLE_TIME."Time</td></tr>\n
<tr><td>UNION_BATTLE_NEXT</td><td>BOSSս����սʱ��</td><td>".UNION_BATTLE_NEXT."s</td></tr>\n
<tr><td>BBS_BOTTOM_TOGGLE</td><td>�±��Ƿ����bbs����(1=ON)</td><td>".BBS_BOTTOM_TOGGLE."</td></tr>\n
</table>\n
");
	}

print <<< ADMIN
<hr>
<p>�벻ҪƵ��ʹ�ù����ܡ�<br>
�û����������п��ܵ��´���
</p>
ADMIN;


} else {
print <<< LOGIN
<form action="?" method="post">
�п�:<input type="text" name="pass" />
<input type="submit" value="��·" />
</form>
LOGIN;
}

?>
</body>
</html>