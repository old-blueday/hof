<?php 
class user {

	// �ե�����ݥ���
	var $fp;
	var $file;

	var $id, $pass;
	var $name, $last, $login ,$start;
	var $money;
	var $char;
	var $time;
	var $wtime;//�t���M�r�g
	var $ip;//IP���ɥ쥹

	var $party_memo;
	var $party_rank;//��󥭥��äΥѩ`�ƥ�
	var $rank_set_time;//��󥭥�PT�O�������r�g
	var $rank_btl_time;//�ΤΥ�󥯑������Ǥ���r�g
	// ��󥭥󥰤γɿ�
	// = "�t���L����<>������<>������<>�����֤�<>��λ���l";
	var $rank_record;
	var $union_btl_time;//�Τ�Union�������Ǥ���r�g

	// OPTION
	var $record_btl_log;
	var $no_JS_itemlist;
	var $UserColor;

	// ��`���`�����ƥ��äΉ���
	var $fp_item;
	var $item;

//////////////////////////////////////////////////
//	�����ID�Υ�`���`���饹������
	function user($id,$noExit=false) {
		if($id)
		{
			$this->id	= $id;
			if($data = $this->LoadData($noExit)) {
				$this->DataUpDate($data);//time�Ȥ����䤹
				$this->SetData($data);
			}
		}
	}
//////////////////////////////////////////////////
//	IP����
	function SetIp($ip) {
		$this->ip = $ip;
	}
//////////////////////////////////////////////////
//	��`���ǩ`�����i��
	function LoadData($noExit=false) {
		$file	= USER.$this->id."/".DATA;
		if(file_exists($file))
		{
			$this->file	= $file;
			$this->fp	= FileLock($file,$noExit);
			if(!$this->fp)
				return false;
			$data	= ParseFileFP($this->fp);
			//$data	= ParseFile($file);// (2007/7/30 ׷��)
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
//	ID���Y�֤ΤȤ�����ڤ��Ƥ��뤫���������
	function is_exist() {
		if($this->name)
			return true;
		else
			return false;
	}
//////////////////////////////////////////////////
//	��ǰ�򷵤�
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
//	��ǰ��䤨��
	function ChangeName($name) {

		if($this->name == $name)
			return false;

		$this->name	= $name;
		return true;
	}
//////////////////////////////////////////////////
//	Union���L�����r�g�򥻥å�
	function UnionSetTime() {
		$this->union_btl_time	= time();
	}
//////////////////////////////////////////////////
//	UnionBattle���Ǥ��뤫�ɤ����_�J���롣
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
//	��󥭥󥰑��äΥѩ`�ƥ����ɤ򷵤�
	function RankParty() {
		if(!$this->name)
			return "NOID";//������`�����⤽���`���`�����ڤ��ʤ����ϡ�
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
//	��󥭥󥰤γɿ�
// side = ("CHALLENGE","DEFEND")
	function RankRecord($result,$side,$DefendMatch) {
		$record	= $this->RankRecordLoad();

		$record["all"]++;
		switch(true) {
			// �����֤�
			/*
			case ($result === "d"):
				if($side != "CHALLENGE" && $DefendMatch)
					$record["defend"]++;
				break;
			*/
			// ���L�Y���������ߤ΄٤�
			case ($result === 0):
				if($side == "CHALLENGER") {
					$record["win"]++;
				} else {
					$record["lose"]++;
				}
				break;
			// ���L�Y���������ߤ�ؓ��
			case ($result === 1):
				if($side == "CHALLENGER") {
					$record["lose"]++;
				} else {
					$record["win"]++;
					if($DefendMatch)
						$record["defend"]++;
				}
				break;
			default:// �����֤�
				if($side != "CHALLENGER" && $DefendMatch)
					$record["defend"]++;
				break;
		}

		$this->rank_record	= $record["all"]."|".$record["win"]."|".$record["lose"]."|".$record["defend"];
	}
//////////////////////////////////////////////////
//	��󥭥󥰑�γɿ�����ӳ���
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
//	�ΤΥ�󥯑������Ǥ���r�g��ӛ�h���롣
	function SetRankBattleTime($time) {
		$this->rank_btl_time	= $time;
	}

//////////////////////////////////////////////////
//	��󥭥�����Ǥ��뤫��(�o��ʤ�Ф�r�g�򷵤�)
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
//	����򉈤䤹
	function GetMoney($no) {
		$this->money	+= $no;
	}

//////////////////////////////////////////////////
//	�����p�餹
	function TakeMoney($no) {
		if($this->money < $no) {
			return false;
		} else {
			$this->money	-= $no;
			return true;
		}
	}

//////////////////////////////////////////////////
//	�r�g�����M����(�t���M�r�g�μ���)
	function WasteTime($time) {
		if($this->time < $time)
			return false;
		$this->time		-= $time;
		$this->wtime 	+= $time;
		return true;
	}
//////////////////////////////////////////////////
//	����饯���`�����֤��Ƥ����򤫤����롣
	function CharCount() {
		$dir	= USER.$this->id;
		$no		= 0;
		foreach(glob("$dir/*") as $adr) {
			$number	= basename($adr,".dat");
			if(is_numeric($number)) {//�����ǩ`���ե�����
				$no++;
			}
		}
		return $no;
	}
//////////////////////////////////////////////////
//	ȫ���֥���饯���`��ե����뤫���i��� $this->char �˸�{
	function CharDataLoadAll() {
		$dir	= USER.$this->id;
		$this->char	= array();//���Фγ��ڻ��������Ƥ���
		foreach(glob("$dir/*") as $adr) {
			//print("substr:".substr($adr,-20,16)."<br>");//�_�J��
			//$number	= substr($adr,-20,16);//��1�Ф�ͬ���Y��
			$number	= basename($adr,".dat");
			if(is_numeric($number)) {//�����ǩ`���ե�����
				//$chardata	= ParseFile($adr);// (2007/7/30 $adr -> $fp)
				//$this->char[$number]	= new char($chardata);
				$this->char[$number]	= new char($adr);
				$this->char[$number]->SetUser($this->id);//����餬�l�Τ��O������
			}
		}
	}
//////////////////////////////////////////////////
//	ָ�������֥���饯���`��ե����뤫���i��� $this->char �˸�{�� "����"��
	function CharDataLoad($CharNo) {
		// �Ȥ��i��Ǥ���ϡ�
		if($this->char[$CharNo])
			return $this->char[$CharNo];
		// �i��ǟo�����ϡ�
		$file	= USER.$this->id."/".$CharNo.".dat";
		// ����ʥ���餤�ʤ����ϡ�
		if(!file_exists($file))
			return false;

		// �Ӥ���ϡ�
		//$chardata	= ParseFile($file);
		//$this->char[$CharNo]	= new char($chardata);
		$this->char[$CharNo]	= new char($file);
		$this->char[$CharNo]->SetUser($this->id);//����餬�l�Τ��O������
		return $this->char[$CharNo];
	}
//////////////////////////////////////////////////
//	�����ƥ��׷��
	function AddItem($no,$amount=false) {
		if(!isset($this->item))//�ɤ�������󤫡�
			$this->LoadUserItem();
		if($amount)
			$this->item[$no]	+= $amount;
		else
			$this->item[$no]++;
	}

//////////////////////////////////////////////////
//	�����ƥ������
	function DeleteItem($no,$amount=false) {
		if(!isset($this->item))//�ɤ�������󤫡�
			$this->LoadUserItem();

		// �p�餹����
		if($this->item[$no] < $amount) {
			$amount	= $this->item[$no];
			if(!$amount)
				$amount = 0;
		}
		if(!is_numeric($amount))
			$amount	= 1;

		// �p�餹��
		$this->item[$no]	-= $amount;
		if($this->item[$no] < 1)
			unset($this->item[$no]);

		return $amount;
	}

//////////////////////////////////////////////////
//	�����ƥ�ǩ`�����i��
	function LoadUserItem() {

		// 2�ؤ��i��Τ��ֹ��
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
//	�����ƥ�ǩ`���򱣴椹��
	function SaveUserItem() {
		$dir	= USER.$this->id;
		if(!file_exists($dir))
			return false;

		$file	= USER.$this->id."/".ITEM;

		if(!is_array($this->item))
			return false;

		// �����ƥ�Υ��`��
		ksort($this->item,SORT_STRING);

		foreach($this->item as $key => $val) {
			$text	.= "$key=$val\n";
		}

		if(file_exists($file) && $this->fp_item) {
			WriteFileFP($this->fp_item,$text,1);//$text���դǤⱣ�椹��
			fclose($this->fp_item);
			unset($this->fp_item);
		} else {
			// $text���դǤⱣ�椹��
			WriteFile($file,$text,1);
		}
	}

//////////////////////////////////////////////////
//	�r�g��U�^�����롣(Time�Ή���)
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
//	�ǩ`���򥻥åȤ��롣
//	��?
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
//	�ѥ���`�ɤ򰵺Ż�����
	function CryptPassword($pass) {
		return substr(crypt($pass,CRYPT_KEY),strlen(CRYPT_KEY));
	}

//////////////////////////////////////////////////
//	��ǰ������
	function DeleteName() {
		$this->name	= NULL;
	}

//////////////////////////////////////////////////
//	�ǩ`���򱣴椹����ʽ�ˉ�Q���롣(�ƥ�����)
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
//	�ǩ`���򱣴椹��
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
//	�ǩ`���ե�����業���ե�����Υե�����ݥ��󥿤�ȫ���]����
	function fpCloseAll() {
		// �����ǩ`��
		if(is_resource($this->fp))
		{
			fclose($this->fp);
			unset($this->fp);
		}

		// �����ƥ�ǩ`��
		if(is_resource($this->fp_item))
		{
			fclose($this->fp_item);
			unset($this->fp_item);
		}

		// �����ǩ`��
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
//	��`���`������(ȫ�ե�����)
	function DeleteUser($DeleteFromRank=true) {
		//��󥭥󥰤���ޤ�������
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
//	�ŗ�����Ƥ��뤫�ɤ����_�����
	function IsAbandoned() {
		$now	= time();
		// $this->login ������������нK�ˤ��롣
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
//	�����ǩ`��������
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
