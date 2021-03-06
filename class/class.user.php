<?php 
class user {

	// ファイルポインタ
	var $fp;
	var $file;

	var $id, $pass;
	var $name, $last, $login ,$start;
	var $money;
	var $char;
	var $time;
	var $wtime;//�t���M�r�g
	var $ip;//IPアドレス

	var $party_memo;
	var $party_rank;//ランキング喘のパ�`ティ
	var $rank_set_time;//ランキングPT�O協した�r�g
	var $rank_btl_time;//肝のランク�蕕北��蕕任�る�r�g
	// ランキングの撹��
	// = "�t�蜉L指方<>�拈�方<>�￣永�<>哈き蛍け<>遍了契�l";
	var $rank_record;
	var $union_btl_time;//肝のUnion�蕕北��蕕任�る�r�g

	// OPTION
	var $record_btl_log;
	var $no_JS_itemlist;
	var $UserColor;

	// ユ�`ザ�`アイテム喘の�篳�
	var $fp_item;
	var $item;

//////////////////////////////////////////////////
//	���鵑�IDのユ�`ザ�`クラスを恬撹
	function user($id,$noExit=false) {
		if($id)
		{
			$this->id	= $id;
			if($data = $this->LoadData($noExit)) {
				$this->DataUpDate($data);//timeとか��やす
				$this->SetData($data);
			}
		}
	}
//////////////////////////////////////////////////
//	IPを�筝�
	function SetIp($ip) {
		$this->ip = $ip;
	}
//////////////////////////////////////////////////
//	ユ�`ザデ�`タを�iむ
	function LoadData($noExit=false) {
		$file	= USER.$this->id."/".DATA;
		if(file_exists($file))
		{
			$this->file	= $file;
			$this->fp	= FileLock($file,$noExit);
			if(!$this->fp)
				return false;
			$data	= ParseFileFP($this->fp);
			//$data	= ParseFile($file);// (2007/7/30 弖紗)
			/*
			$Array	= array("party_memo","party_rank");
			foreach($Array as $val)
			{
				if(!$data["$val"]) continue;
				$data["$val"]	= explode("<>",$data["$val"]);
			}
			*/
			return $data;
		}
			else
		{
			return false;
		}
	}

//////////////////////////////////////////////////
//	IDが�Y蕉のところ贋壓しているかたしかめる
	function is_exist() {
		if($this->name)
			return true;
		else
			return false;
	}
//////////////////////////////////////////////////
//	兆念を卦す
	function Name($opt=false) {
		if($this->name) {
			if($opt)
				return '<span class="'.$opt.'">'.$this->name.'</span>';
			else
				return $this->name;
		} else {
			return false;
		}
	}
//////////////////////////////////////////////////
//	兆念を�笋┐�
	function ChangeName($name) {

		if($this->name == $name)
			return false;

		$this->name	= $name;
		return true;
	}
//////////////////////////////////////////////////
//	Union�蜉Lした�r�gをセット
	function UnionSetTime() {
		$this->union_btl_time	= time();
	}
//////////////////////////////////////////////////
//	UnionBattleができるかどうか�_�Jする。
	function CanUnionBattle() {
		$Now	= time();
		$Past	= $this->union_btl_time	+ UNION_BATTLE_NEXT;
		if($Past <= $Now) {
			return true;
		} else {
			return abs($Now - $Past);
		}
	}
//////////////////////////////////////////////////
//	ランキング�蚌辰離僣`ティ�ｳ匹魴気�
	function RankParty() {
		if(!$this->name)
			return "NOID";//階エラ�`。そもそもユ�`ザ�`が贋壓しない��栽。
		if(!$this->party_rank)
			return false;

		$PartyRank	= explode("<>",$this->party_rank);
		foreach($PartyRank as $no) {
			$char	= $this->CharDataLoad($no);
			if($char)
				$party[]	= $char;
			//if($this->char[$no])
			//	$party[]	= $this->char[$no];
		}

		if($party)
			return $party;
		else
			return false;
	}
//////////////////////////////////////////////////
//	ランキングの撹��
// side = ("CHALLENGE","DEFEND")
	function RankRecord($result,$side,$DefendMatch) {
		$record	= $this->RankRecordLoad();

		$record["all"]++;
		switch(true) {
			// 哈き蛍け
			/*
			case ($result === "d"):
				if($side != "CHALLENGE" && $DefendMatch)
					$record["defend"]++;
				break;
			*/
			// �蜉L�Y惚が薬�蚯澆��戮�
			case ($result === 0):
				if($side == "CHALLENGER") {
					$record["win"]++;
				} else {
					$record["lose"]++;
				}
				break;
			// �蜉L�Y惚が薬�蚯澆輪�け
			case ($result === 1):
				if($side == "CHALLENGER") {
					$record["lose"]++;
				} else {
					$record["win"]++;
					if($DefendMatch)
						$record["defend"]++;
				}
				break;
			default:// 哈き蛍け
				if($side != "CHALLENGER" && $DefendMatch)
					$record["defend"]++;
				break;
		}

		$this->rank_record	= $record["all"]."|".$record["win"]."|".$record["lose"]."|".$record["defend"];
	}
//////////////////////////////////////////////////
//	ランキング�蕕粒豹�を柵び竃す
	function RankRecordLoad() {

		if(!$this->rank_record) {
			$record	= array(
						"all" => 0,
						"win" => 0,
						"lose" => 0,
						"defend" => 0,
						);
			return $record;
		}

		list(
			$record["all"],
			$record["win"],
			$record["lose"],
			$record["defend"],
		)	= explode("|",$this->rank_record);
		return $record;
	}
//////////////////////////////////////////////////
//	肝のランク�蕕北��蕕任�る�r�gを���hする。
	function SetRankBattleTime($time) {
		$this->rank_btl_time	= $time;
	}

//////////////////////////////////////////////////
//	ランキング薬�蕕任�るか��(�o尖なら火り�r�gを卦す)
	function CanRankBattle() {
		$now	= time();
		if($this->rank_btl_time <= $now) {
			return true;
		} else if(!$this->rank_btl_time) {
			return true;
		} else {
			$left	= $this->rank_btl_time - $now;
			$hour		= floor($left/3600);
			$minutes	= floor(($left%3600)/60);
			$seconds	= floor(($left%3600)%60);
			return array($hour,$minutes,$seconds);
		}
	}

//////////////////////////////////////////////////
//	お署を��やす
	function GetMoney($no) {
		$this->money	+= $no;
	}

//////////////////////////////////////////////////
//	お署を�pらす
	function TakeMoney($no) {
		if($this->money < $no) {
			return false;
		} else {
			$this->money	-= $no;
			return true;
		}
	}

//////////////////////////////////////////////////
//	�r�gを���Mする(�t���M�r�gの紗麻)
	function WasteTime($time) {
		if($this->time < $time)
			return false;
		$this->time		-= $time;
		$this->wtime 	+= $time;
		return true;
	}
//////////////////////////////////////////////////
//	キャラクタ�`を侭隔してる方をかぞえる。
	function CharCount() {
		$dir	= USER.$this->id;
		$no		= 0;
		foreach(glob("$dir/*") as $adr) {
			$number	= basename($adr,".dat");
			if(is_numeric($number)) {//キャラデ�`タファイル
				$no++;
			}
		}
		return $no;
	}
//////////////////////////////////////////////////
//	畠侭隔キャラクタ�`をファイルから�iんで $this->char に鯉�{
	function CharDataLoadAll() {
		$dir	= USER.$this->id;
		$this->char	= array();//塘双の兜豚晒だけしておく
		foreach(glob("$dir/*") as $adr) {
			//print("substr:".substr($adr,-20,16)."<br>");//�_�J喘
			//$number	= substr($adr,-20,16);//◎1佩と揖じ�Y惚
			$number	= basename($adr,".dat");
			if(is_numeric($number)) {//キャラデ�`タファイル
				//$chardata	= ParseFile($adr);// (2007/7/30 $adr -> $fp)
				//$this->char[$number]	= new char($chardata);
				$this->char[$number]	= new char($adr);
				$this->char[$number]->SetUser($this->id);//キャラが�lのか�O協する
			}
		}
	}
//////////////////////////////////////////////////
//	峺協の侭隔キャラクタ�`をファイルから�iんで $this->char に鯉�{瘁 "卦す"。
	function CharDataLoad($CharNo) {
		// 屡に�iんでる��栽。
		if($this->char[$CharNo])
			return $this->char[$CharNo];
		// �iんで�oい��栽。
		$file	= USER.$this->id."/".$CharNo.".dat";
		// そんなキャラいない��栽。
		if(!file_exists($file))
			return false;

		// 肖る��栽。
		//$chardata	= ParseFile($file);
		//$this->char[$CharNo]	= new char($chardata);
		$this->char[$CharNo]	= new char($file);
		$this->char[$CharNo]->SetUser($this->id);//キャラが�lのか�O協する
		return $this->char[$CharNo];
	}
//////////////////////////////////////////////////
//	アイテムを弖紗
	function AddItem($no,$amount=false) {
		if(!isset($this->item))//どうしたもんか´
			$this->LoadUserItem();
		if($amount)
			$this->item[$no]	+= $amount;
		else
			$this->item[$no]++;
	}

//////////////////////////////////////////////////
//	アイテムを��茅
	function DeleteItem($no,$amount=false) {
		if(!isset($this->item))//どうしたもんか´
			$this->LoadUserItem();

		// �pらす方。
		if($this->item[$no] < $amount) {
			$amount	= $this->item[$no];
			if(!$amount)
				$amount = 0;
		}
		if(!is_numeric($amount))
			$amount	= 1;

		// �pらす。
		$this->item[$no]	-= $amount;
		if($this->item[$no] < 1)
			unset($this->item[$no]);

		return $amount;
	}

//////////////////////////////////////////////////
//	アイテムデ�`タを�iむ
	function LoadUserItem() {

		// 2嶷に�iむのを契峭。
		if(isset($this->item))
			return false;

		$file	= USER.$this->id."/".ITEM;

		if(file_exists($file)) {
			$this->fp_item	= FileLock($file);
			$this->item	= ParseFileFP($this->fp_item);
			if($this->item === false)
				$this->item	= array();
		} else {
			$this->item	= array();
		}
	}

//////////////////////////////////////////////////
//	アイテムデ�`タを隠贋する
	function SaveUserItem() {
		$dir	= USER.$this->id;
		if(!file_exists($dir))
			return false;

		$file	= USER.$this->id."/".ITEM;

		if(!is_array($this->item))
			return false;

		// アイテムのソ�`ト
		ksort($this->item,SORT_STRING);

		foreach($this->item as $key => $val) {
			$text	.= "$key=$val\n";
		}

		if(file_exists($file) && $this->fp_item) {
			WriteFileFP($this->fp_item,$text,1);//$textが腎でも隠贋する
			fclose($this->fp_item);
			unset($this->fp_item);
		} else {
			// $textが腎でも隠贋する
			WriteFile($file,$text,1);
		}
	}

//////////////////////////////////////////////////
//	�r�gを�U�^させる。(Timeの��紗)
	function DataUpDate(&$data) {
		$now	= time();
		$diff	= $now - $data["last"];
		$data["last"]	= $now;
		$gain	= $diff / (24*60*60) * TIME_GAIN_DAY;
		$data["time"]	+= $gain;
		if(MAX_TIME < $data["time"])
			$data["time"]	= MAX_TIME;
	}

//////////////////////////////////////////////////
//	デ�`タをセットする。
//	☆?
	function SetData(&$data) {

		foreach($data as $key => $val) {
			$this->{$key}	= $val;
		}
		/*
		$this->name	= $data["name"];
		$this->login	= $data["login"];
		$this->last	= $data["last"];
		$this->start	= $data["start"];
		*/
	}

//////////////////////////////////////////////////
//	パスワ�`ドを圧催晒する
	function CryptPassword($pass) {
		return substr(crypt($pass,CRYPT_KEY),strlen(CRYPT_KEY));
	}

//////////////////////////////////////////////////
//	兆念を��す
	function DeleteName() {
		$this->name	= NULL;
	}

//////////////////////////////////////////////////
//	デ�`タを隠贋する侘塀に���Qする。(テキスト)
	function DataSavingFormat() {

		$Save	= array(
			"id",
			"pass",
			"ip",
			"name",
			"last",
			"login",
			"start",
			"money",
			"time",
			"wtime",
			"party_memo",
			"party_rank",
			"rank_set_time",
			"rank_btl_time",
			"rank_record",
			"union_btl_time",
			// opt
			"record_btl_log",
			"no_JS_itemlist",
			"UserColor",
			);
		foreach($Save as $val) {
			if($this->{$val})
				$text	.= "$val=".(is_array($this->{$val}) ? implode("<>",$this->{$val}) : $this->{$val})."\n";
		}
		

		/*
		$Save	= get_object_vars($this);
		unset($Save["char"]);
		unset($Save["item"]);
		unset($Save["islogin"]);
		foreach($Save as $key => $val) {
			$text	.= "$key=".(is_array($val) ? implode("<>",$val) : $val)."\n";
		}
		*/

		//print("<pre>".print_r($AAA,1)."</pre>");

		return $text;
	}

//////////////////////////////////////////////////
//	デ�`タを隠贋する
	function SaveData() {
		$dir	= USER.$this->id;
		$file	= USER.$this->id."/".DATA;

		if(file_exists($this->file) && $this->fp) {
			//print("BBB");
			//ftruncate($this->fp,0);
			//rewind($this->fp);
			//$fp	= fopen($file,"w+");
			//flock($fp,LOCK_EX);
			//fputs($this->fp,$this->DataSavingFormat());
			WriteFileFP($this->fp,$this->DataSavingFormat());
			fclose($this->fp);
			unset($this->fp);
			//WriteFile("./user/1234/data2.dat",$this->DataSavingFormat());
			//WriteFile($file,$this->DataSavingFormat());
			//WriteFileFP($this->fp,$this->DataSavingFormat());
			//fclose($this->fp);
		} else {
			if(file_exists($file))
				WriteFile($file,$this->DataSavingFormat());
		}
	}
/////////////////////////////////////////////////
//	デ�`タファイル惹キャラファイルのファイルポインタも畠何�]じる
	function fpCloseAll() {
		// 児云デ�`タ
		if(is_resource($this->fp))
		{
			fclose($this->fp);
			unset($this->fp);
		}

		// アイテムデ�`タ
		if(is_resource($this->fp_item))
		{
			fclose($this->fp_item);
			unset($this->fp_item);
		}

		// キャラデ�`タ
		if($this->char)
		{
			foreach($this->char as $key => $var)
			{
				if(method_exists($this->char[$key],"fpclose"))
					$this->char[$key]->fpclose();
			}
		}

	}
//////////////////////////////////////////////////
//	ユ�`ザ�`の��茅(畠ファイル)
	function DeleteUser($DeleteFromRank=true) {
		//ランキングからまず��す。
		if($DeleteFromRank) {
			include_once(CLASS_RANKING);
			$Ranking	= new Ranking();
			if( $Ranking->DeleteRank($this->id) )
				$Ranking->SaveRanking();
		}

		$dir	= USER.$this->id;
		$files	= glob("$dir/*");
		$this->fpCloseAll();
		foreach($files as $val)
			unlink($val);
		rmdir($dir);
	}
//////////////////////////////////////////////////
//	慧��されているかどうか�_かめる
	function IsAbandoned() {
		$now	= time();
		// $this->login がおかしければ�K阻する。
		if(strlen($this->login) !== 10) {
			return false;
		}
		if( ($this->login + ABANDONED) < $now) {
			return true;
		} else {
			return false;
		}
	}
//////////////////////////////////////////////////
//	キャラデ�`タを��す
	function DeleteChar($no) {
		$file	= USER.$this->id."/".$no.".dat";
		if($this->char[$no]) {
			$this->char[$no]->fpclose();
		}
		if(file_exists($file))
			unlink($file);
	}

//////////////////////////////////////////////////
//	
	//function Load

}
?>
