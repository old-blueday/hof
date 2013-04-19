<?php
include(CLASS_USER);
include(GLOBAL_PHP);
class main extends user {

	var $islogin	= false;

//////////////////////////////////////////////////
//	
	function main() {
		$this->SessionSwitch();
		$this->Set_ID_PASS();
		ob_start();
		$this->Order();
		$content	= ob_get_contents();
		ob_end_clean();

		$this->Head();
		print($content);
		$this->Debug();
		//$this->ShowSession();
		$this->Foot();
	}

//////////////////////////////////////////////////
//	
	function Order() {
		// ������I����ǰ�˄I������
		// �ޤ���`���ǩ`���i��Ǥޤ���
		switch(true) {
			case($_GET["menu"] === "auction"):
				include(CLASS_AUCTION);
				$ItemAuction	= new Auction(item);
				$ItemAuction->AuctionHttpQuery("auction");
				$ItemAuction->ItemCheckSuccess();// ���Ӥ��K�ˤ���Ʒ����{�٤�
				$ItemAuction->UserSaveData();// ����Ʒ�Ƚ��~���ID����äƱ��椹��
				break;

			case($_GET["menu"] === "rank"):
				include(CLASS_RANKING);
				$Ranking	= new Ranking();
				break;
		}
		if( true === $message = $this->CheckLogin() ):
		//if( false ):
		// ������
			include_once(DATA_ITEM);
			include(CLASS_CHAR);
			if($this->FirstLogin())
				return 0;

			switch(true) {

				case($this->OptionOrder()):	return false;

				case($_POST["delete"]):
					if($this->DeleteMyData())
						return 0;

				// �O��
				case($_SERVER["QUERY_STRING"] === "setting"):
					if($this->SettingProcess())
						$this->SaveData();

					$this->fpCloseAll();
					$this->SettingShow();
					return 0;

				// ���`�������
				case($_GET["menu"] === "auction"):
					$this->LoadUserItem();//���ߥǩ`���i��
					$this->AuctionHeader();

					/*
					* ��Ʒ�äΥե��`��
					* ��ʾ��Ҫ�󤷤����Ϥ���
					* ��Ʒ��ʧ���������ϱ�ʾ���롣
					*/
					$ResultExhibit	= $this->AuctionItemExhibitProcess($ItemAuction);
					$ResultBidding	= $this->AuctionItemBiddingProcess($ItemAuction);
					$ItemAuction->ItemSaveData();// ��������ä����Ϥ������椹�롣
    
					// ��Ʒ�ꥹ�Ȥ��ʾ����
					if($_POST["ExhibitItemForm"]) {
						$this->fpCloseAll();
						$this->AuctionItemExhibitForm($ItemAuction);

					// ��Ʒ������˳ɹ��������Ϥϥǩ`���򱣴椹��
					} else if($ResultExhibit !== false) {

						if($ResultExhibit === true || $ResultBidding === true)
							$this->SaveData();

						$this->fpCloseAll();
						$this->AuctionItemBiddingForm($ItemAuction);

					// ��������
					} else {
						$this->fpCloseAll();
						$this->AuctionItemExhibitForm($ItemAuction);
					}

					$this->AuctionFoot($ItemAuction);
					return 0;

				// ����
				case($_SERVER["QUERY_STRING"] === "hunt"):
					$this->LoadUserItem();//���ߥǩ`���i��
					$this->fpCloseAll();
					$this->HuntShow();
					return 0;

				// ��
				case($_SERVER["QUERY_STRING"] === "town"):
					$this->LoadUserItem();//���ߥǩ`���i��
					$this->fpCloseAll();
					$this->TownShow();
					return 0;

				// ���ߥ��
				case($_SERVER["QUERY_STRING"] === "simulate"):
					$this->CharDataLoadAll();//�����ǩ`���i��
					if($this->SimuBattleProcess())
						$this->SaveData();

					$this->fpCloseAll();
					$this->SimuBattleShow($result);
					return 0;

				// ��˥���
				case($_GET["union"]):
					$this->CharDataLoadAll();//�����ǩ`���i��
					include(CLASS_UNION);
					include(DATA_MONSTER);
					if($this->UnionProcess()) {
						// ���L����
						$this->SaveData();
						$this->fpCloseAll();
					} else {
						// ��ʾ
						$this->fpCloseAll();
						$this->UnionShow();
					}
					return 0;

				// һ���󥹥��`
				case($_GET["common"]):
					$this->CharDataLoadAll();//�����ǩ`���i��
					$this->LoadUserItem();//���ߥǩ`���i��
					if($this->MonsterBattle()) {
						$this->SaveData();
						$this->fpCloseAll();
					} else {
						$this->fpCloseAll();
						$this->MonsterShow();
					}
					return 0;

				// ����饹��
				case($_GET["char"]):
					$this->CharDataLoadAll();//�����ǩ`���i��
					include(DATA_SKILL);
					include(DATA_JUDGE_SETUP);
					$this->LoadUserItem();//���ߥǩ`���i��
					$this->CharStatProcess();
					$this->fpCloseAll();
					$this->CharStatShow();
					return 0;

				// ����һ�E
				case($_SERVER["QUERY_STRING"] === "item"):
					$this->LoadUserItem();//���ߥǩ`���i��
					//$this->ItemProcess();
					$this->fpCloseAll();
					$this->ItemShow();
					return 0;

				// ���b
				case($_GET["menu"] === "refine"):
					$this->LoadUserItem();
					$this->SmithyRefineHeader();
					if($this->SmithyRefineProcess())
						$this->SaveData();

					$this->fpCloseAll();
					$result	= $this->SmithyRefineShow();
					return 0;

				// �u��
				case($_GET["menu"] === "create"):
					$this->LoadUserItem();
					$this->SmithyCreateHeader();
					include(DATA_CREATE);//�u���Ǥ����Υǩ`����
					if($this->SmithyCreateProcess())
						$this->SaveData();

					$this->fpCloseAll();
					$this->SmithyCreateShow();
					return 0;
				// ����å�(��ʽ:�I��,�Ӥ�,��)
				case($_SERVER["QUERY_STRING"] === "shop"):
					$this->LoadUserItem();//���ߥǩ`���i��
					if($this->ShopProcess())
						$this->SaveData();
					$this->fpCloseAll();
					$this->ShopShow();
					return 0;
				// ����å�(�I��)
				case($_GET["menu"] === "buy"):
					$this->LoadUserItem();//���ߥǩ`���i��
					$this->ShopHeader();
					if($this->ShopBuyProcess())
						$this->SaveData();
					$this->fpCloseAll();
					$this->ShopBuyShow();
					return 0;

				// ����å�(�Ӥ�)
				case($_GET["menu"] === "sell"):
					$this->LoadUserItem();//���ߥǩ`���i��
					$this->ShopHeader();
					if($this->ShopSellProcess())
						$this->SaveData();
					$this->fpCloseAll();
					$this->ShopSellShow();
					return 0;

				// ����å�(�P��)
				case($_GET["menu"] === "work"):
					$this->ShopHeader();
					if($this->WorkProcess())
						$this->SaveData();
					$this->fpCloseAll();
					$this->WorkShow();
					return 0;

				// ��󥭥�
				case($_GET["menu"] === "rank"):
					$this->CharDataLoadAll();//�����ǩ`���i��
					$RankProcess	= $this->RankProcess($Ranking);

					if ($RankProcess === "BATTLE") {
						$this->SaveData();
						$this->fpCloseAll();
					} else if ($RankProcess === true) {
						$this->SaveData();
						$this->fpCloseAll();
						$this->RankShow($Ranking);
					} else {
						$this->fpCloseAll();
						$this->RankShow($Ranking);
					}
					return 0;

				// ����
				case($_SERVER["QUERY_STRING"] === "recruit"):
					if($this->RecruitProcess())
						$this->SaveData();

					$this->fpCloseAll();
					$this->RecruitShow($result);
					return 0;

				// ��������(�ȥå�)
				default:
					$this->CharDataLoadAll();//�����ǩ`���i��
					$this->fpCloseAll();
					$this->LoginMain();
					return 0;
			}
		else:
		// ��������
			$this->fpCloseAll();
			switch(true) {
				case($this->OptionOrder()):	return false;
				case($_POST["Make"]):
					list($bool,$message) = $this->MakeNewData();
					if( true === $bool ) {
						$this->LoginForm($message);
						return false;
					}
				case($_SERVER["QUERY_STRING"] === "newgame"):
					$this->NewForm($message);	return false;
				default:	$this->LoginForm($message);
			}
		endif;
	}

//////////////////////////////////////////////////
//	UpDate,BBS,Manual��
	function OptionOrder() {
		$this->fpCloseAll();
		switch(true) {
			case($_SERVER["QUERY_STRING"] === "rank"):	RankAllShow();	return true;
			case($_SERVER["QUERY_STRING"] === "update"):	ShowUpDate();	return true;
			case($_SERVER["QUERY_STRING"] === "bbs"):	$this->bbs01();	return true;
			case($_SERVER["QUERY_STRING"] === "manual"):	ShowManual();	return true;
			case($_SERVER["QUERY_STRING"] === "manual2"):	ShowManual2();	return true;
			case($_SERVER["QUERY_STRING"] === "tutorial"):	ShowTutorial();	return true;
			case($_SERVER["QUERY_STRING"] === "log"):
				ShowLogList();
				return true;
			case($_SERVER["QUERY_STRING"] === "clog"): LogShowCommon(); return true;
			case($_SERVER["QUERY_STRING"] === "ulog"): LogShowUnion(); return true;
			case($_SERVER["QUERY_STRING"] === "rlog"): LogShowRanking(); return true;
			case($_GET["gamedata"]):
				ShowGameData();
				return true;
			case($_GET["log"]):
				ShowBattleLog($_GET["log"]);
				return true;
			case($_GET["ulog"]):
				ShowBattleLog($_GET["ulog"],"UNION");
				return true;
			case($_GET["rlog"]):
				ShowBattleLog($_GET["rlog"],"RANK");
				return true;
		}
	}

//////////////////////////////////////////////////
//	�������򷵤�	������+2(max:5)
	function EnemyNumber($party) {
		$min	= count($party);//�ץ쥤��`��PT��
		if($min == 5)//5�ˤʤ�5ƥ
			return 5;
		$max	= $min + ENEMY_INCREASE;// �Ĥޤꡢ+2�ʤ�[1��:1��3ƥ] [2��:2��4ƥ] [3:3-5] [4:4-5] [5:5]
		if($max>5)
			$max	= 5;
		mt_srand();
		return mt_rand($min,$max);
	}
//////////////////////////////////////////////////
//	���F����_�ʤ��锳���x��Ƿ���
	function SelectMonster($monster) {
		foreach($monster as $val)
			$max	+= $val[0];//�_�ʤκ�Ӌ
		$pos	= mt_rand(0,$max);//0����Ӌ ���Ф�������ȡ��
		foreach($monster as $monster_no => $val) {
			$upp	+= $val[0];//���Εr��Ǥδ_�ʤκ�Ӌ
			if($pos <= $upp)//��Ӌ���ͤ���С������Q�������
				return $monster_no;
		}
	}
//////////////////////////////////////////////////
//	����PT�����ɡ�����
//	Specify=��ָ��(����)
	function EnemyParty($Amount,$MonsterList,$Specify=false) {

		// ָ����󥹥��`
		if($Specify) {
			$MonsterNumbers	= $Specify;
		}

		// ��󥹥��`��Ȥꤢ�������Ф�ȫ������
		$enemy	= array();
		if(!$Amount)
			return $enemy;
		mt_srand();
		for($i=0; $i<$Amount; $i++)
			$MonsterNumbers[]	= $this->SelectMonster($MonsterList);

		// ���}���Ƥ����󥹥��`���{�٤�
		$overlap	= array_count_values($MonsterNumbers);

		// �������i������Ф����롣
		include(CLASS_MONSTER);
		foreach($MonsterNumbers as $Number) {
			if(1 < $overlap[$Number])//1ƥ���ϳ��F����ʤ���ǰ��ӛ�Ť�Ĥ��롣
				$enemy[]	= new monster(CreateMonster($Number,true));
			else
				$enemy[]	= new monster(CreateMonster($Number));
		}
		return $enemy;
	}
//////////////////////////////////////////////////
//	�����Ԕ����ʾ�����ͤ�줿�ꥯ�����Ȥ�I����
//	�L��...(100�Х��`�Щ`)
	function CharStatProcess() {
		$char	= &$this->char[$_GET["char"]];
		if(!$char) return false;
		switch(true):
			// ���Ʃ`�����ϕN
			case($_POST["stup"]):
				//���Ʃ`�����ݥ���ȳ��^(�ͤ�Τ���ν~����)
				$Sum	= abs($_POST["upStr"]) + abs($_POST["upInt"]) + abs($_POST["upDex"]) + abs($_POST["upSpd"]) + abs($_POST["upLuk"]);
				if($char->statuspoint < $Sum) {
					ShowError("״̬��������","margin15");
					return false;
				}

				if($Sum == 0)
					return false;

				$Stat	= array("Str","Int","Dex","Spd","Luk");
				foreach($Stat as $val) {//��󂎤򳬤��ʤ��������å�
					if(MAX_STATUS < ($char->{strtolower($val)} + $_POST["up".$val])) {
						ShowError("�������״̬(".MAX_STATUS.")","margin15");
						return false;
					}
				}
				$char->str	+= $_POST["upStr"];//���Ʃ`�����򉈤䤹
				$char->int	+= $_POST["upInt"];
				$char->dex	+= $_POST["upDex"];
				$char->spd	+= $_POST["upSpd"];
				$char->luk	+= $_POST["upLuk"];
				$char->SetHpSp();

				$char->statuspoint	-= $Sum;//�ݥ���Ȥ�p�餹��
				print("<div class=\"margin15\">\n");
				if($_POST["upStr"])
					ShowResult("STR <span class=\"bold\">".$_POST[upStr]."</span> ������".($char->str - $_POST["upStr"])." -> ".$char->str."<br />\n");
				if($_POST["upInt"])
					ShowResult("INT <span class=\"bold\">".$_POST[upInt]."</span> ������".($char->int - $_POST["upInt"])." -> ".$char->int."<br />\n");
				if($_POST["upDex"])
					ShowResult("DEX <span class=\"bold\">".$_POST[upDex]."</span> ������".($char->dex - $_POST["upDex"])." -> ".$char->dex."<br />\n");
				if($_POST["upSpd"])
					ShowResult("SPD <span class=\"bold\">".$_POST[upSpd]."</span> ������".($char->spd - $_POST["upSpd"])." -> ".$char->spd."<br />\n");
				if($_POST["upLuk"])
					ShowResult("LUK <span class=\"bold\">".$_POST[upLuk]."</span> ������".($char->luk - $_POST["upLuk"])." -> ".$char->luk."<br />\n");
				print("</div>\n");
				$char->SaveCharData($this->id);
				return true;
			// ����?���O��(����)
			case($_POST["position"]):
				if($_POST["position"] == "front") {
					$char->position	= FRONT;
					$pos	= "ǰ��(Front)";
				} else {
					$char->position	= BACK;
					$pos	= "����(Back)";
				}

				$char->guard	= $_POST["guard"];
				switch($_POST["guard"]) {
					case "never":	$guard	= "��������"; break;
					case "life25":	$guard	= "����25%����ʱ��������"; break;
					case "life50":	$guard	= "����50%����ʱ��������"; break;
					case "life75":	$guard	= "����75%����ʱ��������"; break;
					case "prob25":	$guard	= "25%�ĸ��ʱ�������"; break;
					case "prob50":	$guard	= "50%�ĸ��ʱ�������"; break;
					case "prob75":	$guard	= "75%�ĸ��ʱ�������"; break;
					default:	$guard	= "�ض���������"; break;
				}
				$char->SaveCharData($this->id);
				ShowResult($char->Name()." ������ {$pos} ��<br />��Ϊǰ��ʱ ����Ϊ{$guard} ��\n","margin15");
				return true;
			//�Є��O��
			case($_POST["ChangePattern"]):
				$max	= $char->MaxPatterns();
				//ӛ������ģʽ�ȼ������С�
				for($i=0; $i<$max; $i++) {
					$judge[]	= $_POST["judge".$i];
					$quantity_post	= (int)$_POST["quantity".$i];
					if(4 < strlen($quantity_post)) {
						$quantity_post	= substr($quantity_post,0,4);
					}
					$quantity[]	= $quantity_post;
					$action[]	= $_POST["skill".$i];
				}
				//if($char->ChangePattern($judge,$action)) {
				if($char->PatternSave($judge,$quantity,$action)) {
					$char->SaveCharData($this->id);
					ShowResult("ս�����ñ������","margin15");
					return true;
				}
				ShowError("����ʧ�ܣ��볢�Ա���03050242","margin15");
				return false;
				break;
			//	�Є��O�� �� ģ�M��
			case($_POST["TestBattle"]):
					$max	= $char->MaxPatterns();
					//ӛ������ģʽ�ȼ������С�
					for($i=0; $i<$max; $i++) {
						$judge[]	= $_POST["judge".$i];
						$quantity_post	= (int)$_POST["quantity".$i];
						if(4 < strlen($quantity_post)) {
							$quantity_post	= substr($quantity_post,0,4);
						}
						$quantity[]	= $quantity_post;
						$action[]	= $_POST["skill".$i];
					}
					//if($char->ChangePattern($judge,$action)) {
					if($char->PatternSave($judge,$quantity,$action)) {
						$char->SaveCharData($this->id);
						$this->CharTestDoppel();
					}
				break;
			//	�Є�ģʽ���(���Q)
			case($_POST["PatternMemo"]):
				if($char->ChangePatternMemo()) {
					$char->SaveCharData($this->id);
					ShowResult("ģʽ�������","margin15");
					return true;
				}
				break;
			//	ָ���Ф�׷��
			case($_POST["AddNewPattern"]):
				if(!isset($_POST["PatternNumber"]))
					return false;
				if($char->AddPattern($_POST["PatternNumber"])) {
					$char->SaveCharData($this->id);
					ShowResult("ģʽ׷�����","margin15");
					return true;
				}
				break;
			//	ָ���Ф�����
			case($_POST["DeletePattern"]):
				if(!isset($_POST["PatternNumber"]))
					return false;
				if($char->DeletePattern($_POST["PatternNumber"])) {
					$char->SaveCharData($this->id);
					ShowResult("ģʽ�������","margin15");
					return true;
				}
				break;
			//	ָ���w������װ���Ϥ���
			case($_POST["remove"]):
				if(!$_POST["spot"]) {
					ShowError("û��ѡ����Ҫȥ����װ��","margin15");
					return false;
				}
				if(!$char->{$_POST["spot"]}) {// $this �� $char �����eע�⣡
					ShowError("ָ��λ��û��װ��","margin15");
					return false;
				}
				$item	= LoadItemData($char->{$_POST["spot"]});
				if(!$item) return false;
				$this->AddItem($char->{$_POST["spot"]});
				$this->SaveUserItem();
				$char->{$_POST["spot"]}	= NULL;
				$char->SaveCharData($this->id);
				SHowResult($char->Name()." �� {$item[name]} �����","margin15");
				return true;
				break;
			//	װ��ȫ���Ϥ���
			case($_POST["remove_all"]):
				if($char->weapon || $char->shield || $char->armor || $char->item ) {
					if($char->weapon)	{ $this->AddItem($char->weapon);	$char->weapon	=NULL; }
					if($char->shield)	{ $this->AddItem($char->shield);	$char->shield	=NULL; }
					if($char->armor)	{ $this->AddItem($char->armor);		$char->armor	=NULL; }
					if($char->item)		{ $this->AddItem($char->item);		$char->item		=NULL; }
					$this->SaveUserItem();
					$char->SaveCharData($this->id);
					ShowResult($char->Name()." ��װ��ȫ�����","margin15");
					return true;
				}	break;
			//	ָ�����װ�䤹��
			case($_POST["equip_item"]):
				$item_no	= $_POST["item_no"];
				if(!$this->item["$item_no"]) {//���ε��ߤ����֤��Ƥ��뤫
					ShowError("Item not exists.","margin15");
					return false;
				}

				$JobData	= LoadJobData($char->job);
				$item	= LoadItemData($item_no);//װ�䤷�褦�Ȥ��Ƥ���
				if( !in_array( $item["type"], $JobData["equip"]) ) {//���줬װ�䲻���ܤʤ�?
					ShowError("{$char->job_name} can't equip {$item[name]}.","margin15");
					return false;
				}

				if(false === $return = $char->Equip($item)) {
					ShowError("װ�����أ�handle���㣩.","margin15");
					return false;
				} else {
					$this->DeleteItem($item_no);
					foreach($return as $no) {
						$this->AddItem($no);
					}
				}

				$this->SaveUserItem();
				$char->SaveCharData($this->id);
				ShowResult("{$char->name} �� {$item[name]} װ��.","margin15");
				return true;
				break;
			// ����������
			case($_POST["learnskill"]):
				if(!$_POST["newskill"]) {
					ShowError("ûѡ������","margin15");
					return false;
				}

				$char->SetUser($this->id);
				list($result,$message)	= $char->LearnNewSkill($_POST["newskill"]);
				if($result) {
					$char->SaveCharData();
					ShowResult($message,"margin15");
				} else {
					ShowError($message,"margin15");
				}
				return true;
			// ���饹������(ܞ)
			case($_POST["classchange"]):
				if(!$_POST["job"]) {
					ShowError("ûѡ��ְҵ","margin15");
					return false;
				}
				if($char->ClassChange($_POST["job"])) {
					// װ���ȫ�����
					if($char->weapon || $char->shield || $char->armor || $char->item ) {
						if($char->weapon)	{ $this->AddItem($char->weapon);	$char->weapon	=NULL; }
						if($char->shield)	{ $this->AddItem($char->shield);	$char->shield	=NULL; }
						if($char->armor)	{ $this->AddItem($char->armor);		$char->armor	=NULL; }
						if($char->item)		{ $this->AddItem($char->item);		$char->item		=NULL; }
						$this->SaveUserItem();
					}
					// ����
					$char->SaveCharData($this->id);
					ShowResult("תְ���","margin15");
					return true;
				}
				ShowError("failed.","margin15");
				return false;
			//	����(��ʾ)
			case($_POST["rename"]):
				$Name	= $char->Name();
				$message = <<< EOD
<form action="?char={$_GET[char]}" method="post" class="margin15">
���Ӣ��16���� (ȫ��1����=���2����)<br />
<input type="text" name="NewName" style="width:160px" class="text" />
<input type="submit" class="btn" name="NameChange" value="Change" />
<input type="submit" class="btn" value="Cancel" />
</form>
EOD;
				print($message);
				return false;
			// ����(�I��)
			case($_POST["NewName"]):
				list($result,$return)	= CheckString($_POST["NewName"],16);
				if($result === false) {
					ShowError($return,"margin15");
					return false;
				} else if($result === true) {
					if($this->DeleteItem("7500",1) == 1) {
						ShowResult($char->Name()."   ".$return." ������ɡ�","margin15");
						$char->ChangeName($return);
						$char->SaveCharData($this->id);
						$this->SaveUserItem();
						return true;
					} else {
						ShowError("û�е��ߡ�","margin15");
						return false;
					}
					return true;
				}
			// ���N�ꥻ�åȤα�ʾ
			case($_POST["showreset"]):
				$Name	= $char->Name();
				print('<div class="margin15">'."\n");
				print("ʹ�õ���<br />\n");
				print('<form action="?char='.$_GET[char].'" method="post">'."\n");
				print('<select name="itemUse">'."\n");
				$resetItem	= array(7510,7511,7512,7513,7520);
				foreach($resetItem as $itemNo) {
					if($this->item[$itemNo]) {
						$item	= LoadItemData($itemNo);
						print('<option value="'.$itemNo.'">'.$item[name]." x".$this->item[$itemNo].'</option>'."\n");
					}
				}
				print("</select>\n");
				print('<input type="submit" class="btn" name="resetVarious" value="����">'."\n");
				print('<input type="submit" class="btn" value="ȡ��">'."\n");
				print('</form>'."\n");
				print('</div>'."\n");
				break;

			// ���N�ꥻ�åȤ΄I��
			case($_POST["resetVarious"]):
				switch($_POST["itemUse"]) {
					case 7510:
						$lowLimit	= 1;
						break;
					case 7511:
						$lowLimit	= 30;
						break;
					case 7512:
						$lowLimit	= 50;
						break;
					case 7513:
						$lowLimit	= 100;
						break;
					// skill
					case 7520:
						$skillReset	= true;
						break;
				}
				// ʯ�����SPD1�ˑ������ߤˤ���
				if($_POST["itemUse"] == 6000) {
					if($this->DeleteItem(6000) == 0) {
						ShowError("û�е��ߡ�","margin15");
						return false;
					}
					if(1 < $char->spd) {
						$dif	= $char->spd - 1;
						$char->spd	-= $dif;
						$char->statuspoint	+= $dif;
						$char->SaveCharData($this->id);
						$this->SaveUserItem();
						ShowResult("�����黹","margin15");
						return true;
					}
				}
				if($lowLimit) {
					if(!$this->item[$_POST["itemUse"]]) {
						ShowError("û�е��ߡ�","margin15");
						return false;
					}
					if($lowLimit < $char->str) {$dif = $char->str - $lowLimit; $char->str -= $dif; $pointBack += $dif;}
					if($lowLimit < $char->int) {$dif = $char->int - $lowLimit; $char->int -= $dif; $pointBack += $dif;}
					if($lowLimit < $char->dex) {$dif = $char->dex - $lowLimit; $char->dex -= $dif; $pointBack += $dif;}
					if($lowLimit < $char->spd) {$dif = $char->spd - $lowLimit; $char->spd -= $dif; $pointBack += $dif;}
					if($lowLimit < $char->luk) {$dif = $char->luk - $lowLimit; $char->luk -= $dif; $pointBack += $dif;}
					if($pointBack) {
						if($this->DeleteItem($_POST["itemUse"]) == 0) {
							ShowError("û�е��ߡ�","margin15");
							return false;
						}
						$char->statuspoint	+= $pointBack;
						// װ���ȫ�����
						if($char->weapon || $char->shield || $char->armor || $char->item ) {
							if($char->weapon)	{ $this->AddItem($char->weapon);	$char->weapon	=NULL; }
							if($char->shield)	{ $this->AddItem($char->shield);	$char->shield	=NULL; }
							if($char->armor)	{ $this->AddItem($char->armor);		$char->armor	=NULL; }
							if($char->item)		{ $this->AddItem($char->item);		$char->item		=NULL; }
							ShowResult($char->Name()." ������װ�����","margin15");
						}
						$char->SaveCharData($this->id);
						$this->SaveUserItem();
						ShowResult("�����黹�ɹ�","margin15");
						return true;
					} else {
						ShowError("�����黹ʧ��","margin15");
						return false;
					}
				}
				if($skillReset) {
					if(!$this->item[$_POST["itemUse"]]) {
						ShowError("û�е��ߡ�","margin15");
						return false;
					}
					if($skillReset = true)
				if($char->job < 199) {$dif = ($char->level - 1) * 2 - $char->skillpoint; $char->skill ="1000<>1001"; $pointBack += $dif;}
				else if($char->job < 299) {$dif = ($char->level - 1) * 2 - $char->skillpoint; $char->skill ="1000<>1002<>3010"; $pointBack += $dif;}
				else if($char->job < 399) {$dif = ($char->level - 1) * 2 - $char->skillpoint; $char->skill ="1000<>3000<>3101"; $pointBack += $dif;}
				else {$dif = ($char->level - 1) * 2 - $char->skillpoint; $char->skill ="2300<>2310"; $pointBack += $dif;}
					if($pointBack) {
						if($this->DeleteItem($_POST["itemUse"]) == 0) {
							ShowError("û�е��ߡ�","margin15");
							return false;
						}
						$char->skillpoint	+= $pointBack;
						$char->SaveCharData($this->id);
						$this->SaveUserItem();
						ShowResult("�������óɹ�","margin15");
						return true;
					} else {
						ShowError("��������ʧ��","margin15");
						return false;
					}
				}
				break;

			// ����ʥ�(��ʾ)
			case($_POST["byebye"]):
				$Name	= $char->Name();
				$message = <<< HTML_BYEBYE
<div class="margin15">
{$Name} ���?<br>
<form action="?char={$_GET[char]}" method="post">
<input type="submit" class="btn" name="kick" value="Yes">
<input type="submit" class="btn" value="No">
</form>
</div>
HTML_BYEBYE;
				print($message);
				return false;
			// ����ʥ�(�I��)
			case($_POST["kick"]):
				//$this->DeleteChar($char->birth);
				$char->DeleteChar();
				$host  = $_SERVER['HTTP_HOST'];
				$uri   = rtrim(dirname($_SERVER['PHP_SELF']));
				//$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				$extra = INDEX;
				header("Location: http://$host$uri/$extra");
				exit;
				break;
		endswitch;
	}
//////////////////////////////////////////////////////////////////////////////////////
//	����饯���`Ԕ����ʾ?װ�����ʤɤʤ�
//	�L������...(200������)
	function CharStatShow() {
		$char	= &$this->char[$_GET["char"]];
		if(!$char) {
			print("Not exists");
			return false;
		}
		// ���L�É������O����
		$char->SetBattleVariable();

		// �ǩ`��
		$JobData	= LoadJobData($char->job);

		// ܞ���ܤ�
		if($JobData["change"]) {
			include_once(DATA_CLASSCHANGE);
			foreach($JobData["change"] as $job) {
				if(CanClassChange($char,$job))
					$CanChange[]	= $job;//ܞ�Ǥ�����a��
			}
		}

		////// ���Ʃ`������ʾ //////////////////////////////
			?>
<form action="?char=<?php print $_GET["char"]?>" method="post" style="padding:5px 0 0 15px">
<?php 
		// �����������
		print('<div style="padding-top:5px">');
		foreach($this->char as $key => $val) {
			//if($key == $_GET["char"]) continue;//��ʾ�Х���饹���å�
			echo "<a href=\"?char={$key}\">{$val->name}</a>  ";
		}
		print("</div>");
	?>
<h4>����״̬ <a href="?manual#charstat" target="_blank" class="a0">?</a></h4>
<?php 
		$char->ShowCharDetail();
		// ����
		if($this->item["7500"])
			print('<input type="submit" class="btn" name="rename" value="ChangeName">'."\n");
		// ���Ʃ`�����ꥻ�å�ϵ
		if($this->item["7510"] ||
			$this->item["7511"] ||
			$this->item["7512"] ||
			$this->item["7513"] ||
			$this->item["7520"]) {
			print('<input type="submit" class="btn" name="showreset" value="����">'."\n");
		}
?>
<input type="submit" class="btn" name="byebye" value="�޳�">
</form>
<?php 
	// ���Ʃ`�����ϕN ////////////////////////////
	if(0 < $char->statuspoint) {
print <<< HTML
	<form action="?char=$_GET[char]" method="post" style="padding:0 15px">
	<h4>Status <a href="?manual#statup" target="_blank" class="a0">?</a></h4>
HTML;

		$Stat	= array("Str","Int","Dex","Spd","Luk");
		print("Point : {$char->statuspoint}<br />\n");
		foreach($Stat as $val) {
			print("{$val}:\n");
			print("<select name=\"up{$val}\" class=\"vcent\">\n");
			for($i=0; $i < $char->statuspoint + 1; $i++)
				print("<option value=\"{$i}\">+{$i}</option>\n");
			print("</select>");
		}
		print("<br />");
		print('<input type="submit" class="btn" name="stup" value="��ֵ">');
		print("\n");

	print("</form>\n");
	}
	?>
	<form action="?char=<?php print $_GET["char"]?>" method="post" style="padding:0 15px">
	<h4>�ж�ģʽ <a href="?manual#jdg" target="_blank" class="a0">?</a></h4>
<?php 

		// Action Pattern �Є��ж� /////////////////////////
		$list	= JudgeList();// �Є��ж�����һ�E
		print("<table cellspacing=\"5\"><tbody>\n");
		for($i=0; $i<$char->MaxPatterns(); $i++) {
			print("<tr><td>");
			//----- No
			print( ($i+1)."</td><td>");
			//----- JudgeSelect(�ж��ηN�)
			print("<select name=\"judge".$i."\">\n");
			foreach($list as $val) {//�жϤ�option
				$exp	= LoadJudgeData($val);
				print("<option value=\"{$val}\"".($char->judge[$i] == $val ? " selected" : NULL).($exp["css"]?' class="select0"':NULL).">".($exp["css"]?' ':'   ')."{$exp[exp]}</option>\n");
			}
			print("</select>\n");
			print("</td><td>\n");
			//----- ����(��)
			print("<input type=\"text\" name=\"quantity".$i."\" maxlength=\"4\" value=\"".$char->quantity[$i]."\" style=\"width:56px\" class=\"text\">");
			print("</td><td>\n");
			//----- //SkillSelect(���ηN�)
			print("<select name=\"skill".$i."\">\n");
			foreach($char->skill as $val) {//����option
				$skill	= LoadSkillData($val);
				print("<option value=\"{$val}\"".($char->action[$i] == $val ? " selected" : NULL).">");
				print($skill["name"].(isset($skill["sp"])?" - (SP:{$skill[sp]})":NULL));
				print("</option>\n");
			}
			print("</select>\n");
			print("</td><td>\n");
			print('<input type="radio" name="PatternNumber" value="'.$i.'">');
			print("</td></tr>\n");
		}
		print("</tbody></table>\n");
	?>
<input type="submit" class="btn" value="ȷ��ģʽ" name="ChangePattern">
<input type="submit" class="btn" value="���� & ����" name="TestBattle">
 <a href="?simulate">Simulate</a><br />
<input type="submit" class="btn" value="�л�ģʽ" name="PatternMemo">
<input type="submit" class="btn" value="���" name="AddNewPattern">
<input type="submit" class="btn" value="ɾ��" name="DeletePattern">
</form>
<form action="?char=<?php print $_GET["char"]?>" method="post" style="padding:0 15px">
<h4>λ�� & ����<a href="?manual#posi" target="_blank" class="a0">?</a></h4>
<table><tbody>
<tr><td>λ��(Position) :</td><td><input type="radio" class="vcent" name="position" value="front"
<?php  ($char->position=="front"?print(" checked"):NULL) ?>>ǰ��(Front)</td></tr>
<tr><td></td><td><input type="radio" class="vcent" name="position" value="back"
<?php  ($char->position=="back"?print(" checked"):NULL) ?>>����(Backs)</td></tr>
<tr><td>����(Guarding) :</td><td>
<select name="guard">
<?php 

		// ǰ�l�Εr�����l�ؤ� //////////////////////////////
		$option	= array(/*
		"always"=> "Always",
		"never"	=> "Never",
		"life25"	=> "If life more than 25%",
		"life50"	=> "If life more than 50%",
		"life75"	=> "If life more than 75%",
		"prob25"	=> "Probability of 25%",
		"prpb50"	=> "Probability of 50%",
		"prob75"	=> "Probability of 75%",
		*/
		"always"=> "�ض�����",
		"never"	=> "������",
		"life25"	=> "����25%����ʱ����",
		"life50"	=> "����50%����ʱ����",
		"life75"	=> "����75%����ʱ����",
		"prob25"	=> "25%�ĸ��ʱ���",
		"prpb50"	=> "50%�ĸ��ʱ���",
		"prob75"	=> "75%�ĸ��ʱ���",
		);
		foreach($option as $key => $val)
			print("<option value=\"{$key}\"".($char->guard==$key ? " selected" : NULL ).">{$val}</option>");
	?>
	</select>
	</td></tr>
	</tbody></table>
	<input type="submit" class="btn" value="����">
	</form>
<?php 
		// װ���Ф����ʾ ////////////////////////////////
		$weapon	= LoadItemData($char->weapon);
		$shield	= LoadItemData($char->shield);
		$armor	= LoadItemData($char->armor);
		$item	= LoadItemData($char->item);

		$handle	= 0;
		$handle	= $weapon["handle"] + $shield["handle"] + $armor["handle"] + $item["handle"];
	?>
	<div style="margin:0 15px">
	<h4>װ��<a href="?manual#equip" target="_blank" class="a0">?</a></h4>
	<div class="bold u">Current Equip's</div>
	<table>
	<tr><td class="dmg" style="text-align:right">Atk :</td><td class="dmg"><?php print $char->atk[0]?></td></tr>
	<tr><td class="spdmg" style="text-align:right">Matk :</td><td class="spdmg"><?php print $char->atk[1]?></td></tr>
	<tr><td class="recover" style="text-align:right">Def :</td><td class="recover"><?php print $char->def[0]." + ".$char->def[1]?></td></tr>
	<tr><td class="support" style="text-align:right">Mdef :</td><td class="support"><?php print $char->def[2]." + ".$char->def[3]?></td></tr>
	<tr><td class="charge" style="text-align:right">handle :</td><td class="charge"><?php print $handle?> / <?php print $char->GetHandle()?></td></tr>
	</table>
	<form action="?char=<?php print $_GET["char"]?>" method="post">
	<table>
	<tr><td class="align-right">
	����:</td><td><input type="radio" class="vcent" name="spot" value="weapon">
<?php ShowItemDetail(LoadItemData($char->weapon));?>
	</td></tr><tr><td class="align-right">
	��:</td><td><input type="radio" class="vcent" name="spot" value="shield">
<?php ShowItemDetail(LoadItemData($char->shield));?>
	</td></tr><tr><td class="align-right">
	��:</td><td><input type="radio" class="vcent" name="spot" value="armor">
<?php ShowItemDetail(LoadItemData($char->armor));?>
	</td></tr><tr><td class="align-right">
	����:</td><td><input type="radio" class="vcent" name="spot" value="item">
<?php ShowItemDetail(LoadItemData($char->item));?>
	</td></tr></tbody>
	</table>
	<input type="submit" class="btn" name="remove" value="ж��">
	<input type="submit" class="btn" name="remove_all" value="ȫж">
	</form>
	</div>
<?php 

		// װ����ܤ����ʾ ////////////////////////////////
		if($JobData["equip"])
			$EquipAllow	= array_flip($JobData["equip"]);//װ����ܤ���ꥹ��(��ܞ)
		else
			$EquipAllow	= array();//װ����ܤ���ꥹ��(��ܞ)
		$Equips		= array("Weapon"=>"2999","Shield"=>"4999","Armor"=>"5999","Item"=>"9999");

		print("<div style=\"padding:15px 15px 0 15px\">\n");
		print("\t<div class=\"bold u\">ӵ�е� & ����װ����</div>\n");
		if($this->item) {
			include(CLASS_JS_ITEMLIST);
			$EquipList	= new JS_ItemList();
			$EquipList->SetID("equip");
			$EquipList->SetName("type_equip");
			// JS��ʹ�ä��ʤ���
			if($this->no_JS_itemlist)
				$EquipList->NoJS();
			reset($this->item);//���줬�o����װ�����r�˱�ʾ����ʤ�
			foreach($this->item as $key => $val) {
				$item	= LoadItemData($key);
				// װ��Ǥ��ʤ��ΤǴ�
				if(!isset( $EquipAllow[ $item["type"] ] ))
					continue;
				$head	= '<input type="radio" name="item_no" value="'.$key.'" class="vcent">';
				$head	.= ShowItemDetail($item,$val,true)."<br />";
				$EquipList->AddItem($item,$head);
			}
			print($EquipList->GetJavaScript("list0"));
			print($EquipList->ShowSelect());
			print('<form action="?char='.$_GET["char"].'" method="post">'."\n");
			print('<div id="list0">'.$EquipList->ShowDefault().'</div>'."\n");
			print('<input type="submit" class="btn" name="equip_item" value="װ��">'."\n");
			print("</form>\n");
		} else {
			print("���޵���.<br />\n");
		}
		print("</div>\n");

		
		/*
		print("\t<table><tbody><tr><td colspan=\"2\">\n");
		print("\t<span class=\"bold u\">Stock & Allowed to Equip</span></td></tr>\n");
		if($this->item):
			reset($this->item);//���줬�o����װ�����r�˱�ʾ����ʤ�
			foreach($Equips as $key => $val) {
				print("\t<tr><td class=\"align-right\" valign=\"top\">\n");
				print("\t{$key} :</td><td>\n");
				while( substr(key($this->item),0,4) <= $val && substr(current($this->item),0,4) !== false ) {
					$item	= LoadItemData(key($this->item));
					if(!isset( $EquipAllow[ $item["type"] ] )) {
						next($this->item);
						continue;
					}
					print("\t");
					print('<input type="radio" class="vcent" name="item_no" value="'.key($this->item).'">');
					print("\n\t");
					print(current($this->item)."x");
					ShowItemDetail($item);
					print("<br>\n");
					next($this->item);
				}
				print("\t</td></tr>\n");
			}
		else:
			print("<tr><td>No items.</td></tr>");
		endif;
		print("\t</tbody></table>\n");
		*/
	?>
	<form action="?char=<?php print $_GET["char"]?>" method="post" style="padding:0 15px">
	<h4>����<a href="?manual#skill" target="_blank" class="a0">?</a></h4>
<?php 

		// �������ʾ //////////////////////////////////////
		//include(DATA_SKILL);//ActionPattern���Ƅ�
		include_once(DATA_SKILL_TREE);
		if($char->skill) {
			print('<div class="u bold">�����յ�</div>');
			print("<table><tbody>");
			foreach($char->skill as $val) {
				print("<tr><td>");
				$skill	= LoadSkillData($val);
				ShowSkillDetail($skill);
				print("</td></tr>");
			}
			print("</tbody></table>");
			print('<div class="u bold">�¼���</div>');
			print("���ܵ� : {$char->skillpoint}");
			print("<table><tbody>");
			$tree	= LoadSkillTree($char);
			foreach(array_diff($tree,$char->skill) as $val) {
				print("<tr><td>");
				$skill	= LoadSkillData($val);
				ShowSkillDetail($skill,1);
				print("</td></tr>");
			}
			print("</tbody></table>");
			//dump($char->skill);
			//dump($tree);
			print('<input type="submit" class="btn" name="learnskill" value="ϰ��">'."\n");
			print('<input type="hidden" name="learnskill" value="1">'."\n");
		}
		// ܞ ////////////////////////////////////////////
		if($CanChange) {
			?>

	</form>
	<form action="?char=<?php print $_GET["char"]?>" method="post" style="padding:0 15px">
	<h4>תְ</h4>
	<table><tbody><tr>
<?php 
			foreach($CanChange as $job) {
				print("<td valign=\"bottom\" style=\"padding:5px 30px;text-align:center\">");
				$JOB	= LoadJobData($job);
				print('<img src="'.IMG_CHAR.$JOB["img_".($char->gender?"female":"male")].'">'."<br />\n");//����
				print('<input type="radio" value="'.$job.'" name="job">'."<br />\n");
				print($JOB["name_".($char->gender?"female":"male")]);
				print("</td>");
			}
			?>

	</tr></tbody></table>
	<input type="submit" class="btn" name="classchange" value="תְ">
	<input type="hidden" name="classchange" value="1">
<?php 
		}
	?>

	</form>
<?php //�����������
		print('<div  style="padding:15px">');
		foreach($this->char as $key => $val) {
			//if($key == $_GET["char"]) continue;//��ʾ�Х���饹���å�
			echo "<a href=\"?char={$key}\">{$val->name}</a>  ";
		}
		print('</div>');
	}
//////////////////////////////////////////////////
//	('A`)...
	function CharTestDoppel() {
		if(!$_POST["TestBattle"]) return 0;

		$char	= $this->char[$_GET["char"]];
		$this->DoppelBattle(array($char));
	}
//////////////////////////////////////////////////
//	�ɥåڥ륲�󥬩`�ȑ餦��
	function DoppelBattle($party,$turns=10) {
		//$enemy	= $party;
		//���줬�o����PHP4or5 ���`���Y���ˤʤ��Ǥ�
		//$enemy	= unserialize(serialize($enemy));
		// ��
		foreach($party as $key => $char) {
			$enemy[$key]	= new char();
			$enemy[$key]->SetCharData(get_object_vars($char));
			
		}
		foreach($enemy as $key => $doppel) {
			//$doppel->judge	= array();//�����Ȥ�ȡ��ȥɥåڥ뤬�ЄӤ��ʤ���
			$enemy[$key]->ChangeName("�˥�".$doppel->name);
		}
		//dump($enemy[0]->judge);
		//dump($party[0]->judge);

		include(CLASS_BATTLE);
		$battle	= new battle($party,$enemy);
		$battle->SetTeamName($this->name,"�ɥåڥ�");
		$battle->LimitTurns($turns);//��󥿩`������10
		$battle->NoResult();
		$battle->Process();//���L�_ʼ
		return true;
	}
//////////////////////////////////////////////////
//
	function SimuBattleProcess() {
		if($_POST["simu_battle"]) {
			$this->MemorizeParty();//�ѩ`�ƥ��`ӛ��
			// �Է֥ѩ`�ƥ��`
			foreach($this->char as $key => $val) {//�����å����줿��ĥꥹ��
				if($_POST["char_".$key])
					$MyParty[]	= $this->char[$key];
			}
			if( count($MyParty) === 0) {
				ShowError('ս������Ҫһ���˲μ�',"margin15");
				return false;
			} else if(5 < count($MyParty)) {
				ShowError('ս�����ֻ���������',"margin15");
				return false;
			}
			$this->DoppelBattle($MyParty,50);
			return true;
		}
	}
//////////////////////////////////////////////////
//	
	function SimuBattleShow($message=false) {
		print('<div style="margin:15px">');
		ShowError($message);
		print('<span class="bold">ģ��ս</span>');
		print('<h4>Teams</h4></div>');
		print('<form action="'.INDEX.'?simulate" method="post">');
		$this->ShowCharacters($this->char,CHECKBOX,explode("<>",$this->party_memo));
			?>
	<div style="margin:15px;text-align:center">
	<input type="submit" class="btn" name="simu_battle" value="ս��!">
	<input type="reset" class="btn" value="����"><br>
	����˶���:<input type="checkbox" name="memory_party" value="1">
	</div></form>
<?php 
	}
//////////////////////////////////////////////////
//	
	function HuntShow() {
		include(DATA_LAND);
		include(DATA_LAND_APPEAR);
		print('<div style="margin:15px">');
		print('<h4>��ͨ����</h4>');
		print('<div style="margin:0 20px">');

		$mapList	= LoadMapAppear($this);
		foreach($mapList as $map) {
			list($land)	= LandInformation($map);
			print("<p style='display:inline;margin-right:32px;'><a href=\"?common={$map}\">{$land[name]}</a>");
			//print(" ({$land[proper]})");
			print("</p>");
		}

		// Union
		print("</div>\n");
		$files	= glob(UNION."*");
		if($files) {
			include(CLASS_UNION);
			include(DATA_MONSTER);
			foreach($files as $file) {
				$UnionMons	= new union($file);
				if($UnionMons->is_Alive())
					$Union[]	= $UnionMons;
			}
		}
		if($Union) {
			print('<h4>BOSS</h4>');
			$result = $this->CanUnionBattle();
			if($result !== true) {
				$left_minute	= floor($result/60);
				$left_second	= $result%60;
				print('<div style="margin:0 20px">');
				print('���´�ս������Ҫ : <span class="bold">'.$left_minute. ":".sprintf("%02d",$left_second)."</span>");
				print("</div>");
			}
			print("</div>");
			$this->ShowCharacters($Union);
		} else {
			print("</div>");
		}

		// union
		print("<div style=\"margin:0 15px\">\n");
		print("<h4>BOSSս��¼ <a href=\"?ulog\">ȫ��ʾ</a></h4>\n");
		print("<div style=\"margin:0 20px\">\n");
		$log	= @glob(LOG_BATTLE_UNION."*");
		foreach(array_reverse($log) as $file) {
			$limit++;
			BattleLogDetail($file,"UNION");
			if(15 <= $limit)
				break;
		}
		print("</div></div>\n");
	}
//////////////////////////////////////////////////
//	��󥹥��`�α�ʾ
	function MonsterShow() {
		$land_id	= $_GET["common"];
		include(DATA_LAND);
		include_once(DATA_LAND_APPEAR);
		// �ޤ��Ф��ʤ��ޥåפʤΤ��Ф����Ȥ�����
		if(!in_array($_GET["common"],LoadMapAppear($this))) {
			print('<div style="margin:15px">not appeared or not exist</div>');
			return false;
		}
		list($land,$monster_list)	= LandInformation($land_id);
		if(!$land || !$monster_list) {
			print('<div style="margin:15px">fail to load</div>');
			return false;
		}

		print('<div style="margin:15px">');
		ShowError($message);
		print('<span class="bold">'.$land["name"].'</span>');
		print('<h4>����</h4></div>');
		print('<form action="'.INDEX.'?common='.$_GET["common"].'" method="post">');
		$this->ShowCharacters($this->char,"CHECKBOX",explode("<>",$this->party_memo));
			?>
	<div style="margin:15px;text-align:center">
	<input type="submit" class="btn" name="monster_battle_multiply" value="ս��!(������)(ʧ�������)">
	<input type="submit" class="btn" name="monster_battle" value="ս��!">
	<input type="reset" class="btn" value="����"><br>
	����˶���:<input type="checkbox" name="memory_party" value="1">
	</div></form>
<?php 
		include(DATA_MONSTER);
		include(CLASS_MONSTER);
		foreach($monster_list as $id =>$val) {
			if($val[1])
				$monster[]	= new monster(CreateMonster($id));
		}
		print('<div style="margin:15px"><h4>MonsterAppearance</h4></div>');
		$this->ShowCharacters($monster,"MONSTER",$land["land"]);
	}
//////////////////////////////////////////////////

	function TimeCostCalc() {
		return NORMAL_BATTLE_TIME;
	}

//////////////////////////////////////////////////
//	��󥹥��`�ȤΑ��L
	function MonsterBattle() {
		if($_POST["monster_battle"] || $_POST["monster_battle_multiply"]) {
			$this->MemorizeParty();//�ѩ`�ƥ��`ӛ��
			// ���ΥޥåפǑ館�뤫�ɤ����_�J���롣
			include_once(DATA_LAND_APPEAR);
			$land	= LoadMapAppear($this);
			if(!in_array($_GET["common"],$land)) {
				ShowError("û�г��ֵ�ͼ","margin15");
				return false;
			}

			// Time�����Ƥ뤫�ɤ����_�J����
			if($this->time < NORMAL_BATTLE_TIME) {
				ShowError("Time ���� (��Ҫ Time:".NORMAL_BATTLE_TIME.")","margin15");
				return false;
			}
			// �Է֥ѩ`�ƥ��`
			foreach($this->char as $key => $val) {//�����å����줿��ĥꥹ��
				if($_POST["char_".$key])
					$MyParty[]	= $this->char[$key];
			}
			if( count($MyParty) === 0) {
				ShowError('ս������Ҫһ���˲μ�',"margin15");
				return false;
			} else if(5 < count($MyParty)) {
				ShowError('ս�����ֻ���������',"margin15");
				return false;
			}
			// ���ѩ`�ƥ��`(�ޤ���һƥ)
			include(DATA_LAND);
			include(DATA_MONSTER);
			list($Land,$MonsterList)	= LandInformation($_GET["common"]);
			$EneNum	= $this->EnemyNumber($MyParty);
			$EnemyParty	= $this->EnemyParty($EneNum,$MonsterList);

			$this->WasteTime(NORMAL_BATTLE_TIME);//�r�g�����M
			include(CLASS_BATTLE);
			$battle	= new battle($MyParty,$EnemyParty);
			$battle->SetBackGround($Land["land"]);//����
			$battle->SetTeamName($this->name,$Land["name"]);
			$battle->Process();//���L�_ʼ
			$battle->SaveCharacters();//�����ǩ`������
			list($UserMoney)	= $battle->ReturnMoney();//���L�ǵä���Ӌ���~
			//����򉈤䤹
			$this->GetMoney($UserMoney);
			//���L���α���
			if($this->record_btl_log)
				$battle->RecordLog();

			// ���ߤ��ܤ�ȡ��
			if($itemdrop	= $battle->ReturnItemGet(0)) {
				$this->LoadUserItem();
				foreach($itemdrop as $itemno => $amount)
					$this->AddItem($itemno,$amount);
				$this->SaveUserItem();
			}
			//dump($itemdrop);
			//dump($this->item);
			return true;
		}
	}

//////////////////////////////////////////////////
	function ItemProcess() {
	}

//////////////////////////////////////////////////
//	
	function ItemShow() {
		?>
		<div style="margin:15px">
		<h4>����</h4>
		<div style="margin:0 20px">
<?php 
		if($this->item) {
			include(CLASS_JS_ITEMLIST);
			$goods	= new JS_ItemList();
			$goods->SetID("my");
			$goods->SetName("type");
			// JS��ʹ�ä��ʤ���
			if($this->no_JS_itemlist)
				$goods->NoJS();
			//$goods->ListTable("<table>");
			//$goods->ListTableInsert("<tr><td>No</td><td>Item</td></tr>");
			foreach($this->item as $no => $val) {
				$item	= LoadItemData($no);
				$string	= ShowItemDetail($item,$val,1)."<br />";
				//$string	= "<tr><td>".$no."</td><td>".ShowItemDetail($item,$val,1)."</td></tr>";
				$goods->AddItem($item,$string);
			}
			print($goods->GetJavaScript("list"));
			print($goods->ShowSelect());
			print('<div id="list">'.$goods->ShowDefault().'</div>');
		} else {
			print("No items.");
		}
		print("</div></div>");
	}
//////////////////////////////////////////////////
//	��إå�
	function ShopHeader() {
		?>
<div style="margin:15px">
<h4>��</h4>

<div style="width:600px">
<div style="float:left;width:50px;">
<img src="<?php print IMG_CHAR?>ori_002.gif" />
</div>
<div style="float:right;width:550px;">
��ӭ���٩`<br />
<a href="?menu=buy">��</a> / <a href="?menu=sell">��</a><br />
<a href="?menu=work">��</a>
</div>
<div style="clear:both"></div>
</div>

</div>
<?php 
	}
//////////////////////////////////////////////////
//
	function ShopProcess() {
		switch(true) {
			case($_POST["partjob"]):
				if($this->WasteTime(100)) {
					$this->GetMoney(500);
					ShowResult("����".MoneyFormat(500)." ���äȤ���!(?)","margin15");
					return true;
				} else {
					ShowError("�r�g���o�����P���ʤ�Ƥ�ä����ʤ���(?)","margin15");
					return false;
				}
			case($_POST["shop_buy"]):
				$ShopList	= ShopList();//�ӤäƤ��Υǩ`��
				if($_POST["item_no"] && in_array($_POST["item_no"],$ShopList)) {
					if(ereg("^[0-9]",$_POST["amount"])) {
						$amount	= (int)$_POST["amount"];
						if($amount == 0)
							$amount	= 1;
					} else {
						$amount	= 1;
					}
					$item	= LoadItemData($_POST["item_no"]);
					$need	= $amount * $item["buy"];//ُ��˱�Ҫ�ʤ���
					if($this->TakeMoney($need)) {// ����������뤫���ж���
						$this->AddItem($_POST["item_no"],$amount);
						$this->SaveUserItem();
						if(1 < $amount) {
							$img	= "<img src=\"".IMG_ICON.$item[img]."\" class=\"vcent\" />";
							ShowResult("{$img}{$item[name]}  {$amount}�� ���� (".MoneyFormat($item["buy"])." x{$amount} = ".MoneyFormat($need).")","margin15");
							return true;
						} else {
							$img	= "<img src=\"".IMG_ICON.$item[img]."\" class=\"vcent\" />";
							ShowResult("{$img}{$item[name]}�� ���� (".MoneyFormat($need).")","margin15");
							return true;
						}
					} else {//�Y����
						ShowError("�ʽ���(��Ҫ".MoneyFormat($need).")","margin15");
						return false;
					}
				}
				break;
			case($_POST["shop_sell"]):
				if($_POST["item_no"] && $this->item[$_POST["item_no"]]) {
					if(ereg("^[0-9]",$_POST["amount"])) {
						$amount	= (int)$_POST["amount"];
						if($amount == 0)
							$amount	= 1;
					} else {
						$amount	= 1;
					}
					// ����������(���^���ƉӤ���Τ����)
					$DeletedAmount	= $this->DeleteItem($_POST["item_no"],$amount);
					$item	= LoadItemData($_POST["item_no"]);
					$price	= (isset($item["sell"]) ? $item["sell"] : round($item["buy"]*SELLING_PRICE));
					$this->GetMoney($price*$DeletedAmount);
					$this->SaveUserItem();
					if($DeletedAmount != 1)
						$add	= " x{$DeletedAmount}";
					$img	= "<img src=\"".IMG_ICON.$item[img]."\" class=\"vcent\" />";
					ShowResult("{$img}{$item[name]}{$add}".MoneyFormat($price*$DeletedAmount)." ����","margin15");
					return true;
				}
				break;
		}
	}
//////////////////////////////////////////////////
//	
	function ShopShow($message=NULL) {
		?>
	<div style="margin:15px">
	<?php print ShowError($message)?>
	<h4>Goods List</h4>
	<div style="margin:0 20px">
<?php 
		include(CLASS_JS_ITEMLIST);
		$ShopList	= ShopList();//�ӤäƤ��Υǩ`��

		$goods	= new JS_ItemList();
		$goods->SetID("JS_buy");
		$goods->SetName("type_buy");
		// JS��ʹ�ä��ʤ���
		if($this->no_JS_itemlist)
			$goods->NoJS();
		foreach($ShopList as $no) {
			$item	= LoadItemData($no);
			$string	= '<input type="radio" name="item_no" value="'.$no.'" class="vcent">';
			$string	.= "<span style=\"padding-right:10px;width:10ex\">".MoneyFormat($item["buy"])."</span>".ShowItemDetail($item,false,1)."<br />";
			$goods->AddItem($item,$string);
		}
		print($goods->GetJavaScript("list_buy"));
		print($goods->ShowSelect());

		print('<form action="?shop" method="post">'."\n");
		print('<div id="list_buy">'.$goods->ShowDefault().'</div>'."\n");
		print('<input type="submit" class="btn" name="shop_buy" value="��">'."\n");
		print('Amount <input type="text" name="amount" style="width:60px" class="text vcent">(input if 2 or more)<br />'."\n");
		print('<input type="hidden" name="shop_buy" value="1">');
		print('</form></div>'."\n");

		print("<h4>My Items<a name=\"sell\"></a></h4>\n");//������Ӥ�
		print('<div style="margin:0 20px">'."\n");
		if($this->item) {
			$goods	= new JS_ItemList();
			$goods->SetID("JS_sell");
			$goods->SetName("type_sell");
			// JS��ʹ�ä��ʤ���
			if($this->no_JS_itemlist)
				$goods->NoJS();
			foreach($this->item as $no => $val) {
				$item	= LoadItemData($no);
				$price	= (isset($item["sell"]) ? $item["sell"] : round($item["buy"]*SELLING_PRICE));
				$string	= '<input type="radio" class="vcent" name="item_no" value="'.$no.'">';
				$string	.= "<span style=\"padding-right:10px;width:10ex\">".MoneyFormat($price)."</span>".ShowItemDetail($item,$val,1)."<br />";
				$head	= '<input type="radio" name="item_no" value="'.$no.'" class="vcent">'.MoneyFormat($item["buy"]);
				$goods->AddItem($item,$string);
			}
			print($goods->GetJavaScript("list_sell"));
			print($goods->ShowSelect());
	
			print('<form action="?shop" method="post">'."\n");
			print('<div id="list_sell">'.$goods->ShowDefault().'</div>'."\n");
			print('<input type="submit" class="btn" name="shop_sell" value="Sell">');
			print('Amount <input type="text" name="amount" style="width:60px" class="text vcent">(input if 2 or more)'."\n");
			print('<input type="hidden" name="shop_sell" value="1">');
			print('</form>'."\n");
		} else {
			print("No items");
		}
		print("</div>\n");
/*
		if($this->item) {
			foreach($this->item as $no => $val) {
				$item	= LoadItemData($no);
				$price	= (isset($item["sell"]) ? $item["sell"] : round($item["buy"]*SELLING_PRICE));
				print('<input type="radio" class="vcent" name="item_no" value="'.$no.'">');
				print(MoneyFormat($price));
				print("   {$val}x");
				ShowItemDetail($item);
				print("<br>");
			}
		} else
			print("No items.<br>");
		print('Amount <input type="text" name="amount" style="width:50px" class="text vcent">(input if 2 or more)<br />'."\n");
		print('<input type="submit" class="btn vcent" name="shop_sell" value="Sell">');
		print('<input type="hidden" name="shop_sell" value="1">');
		print('</form>');*/
		?>
<form action="?shop" method="post">
<h4>��</h4>
<div style="margin:0 20px">
��Ǵ򹤤��Ƥ����äޤ�...<br />
<input type="submit" class="btn" name="partjob" value="��">
Get <?php print MoneyFormat("500")?> for 100Time.
</form></div></div>
<?php 
	}

//////////////////////////////////////////////////
	function ShopBuyProcess() {
		//dump($_POST);
		if(!$_POST["ItemBuy"])
			return false;

		print("<div style=\"margin:15px\">");
		print("<table cellspacing=\"0\">\n");
		print('<tr><td class="td6" style="text-align:center">�۸�</td>'.
		'<td class="td6" style="text-align:center">��</td>'.
		'<td class="td6" style="text-align:center">����</td>'.
		'<td class="td6" style="text-align:center">����</td></tr>'."\n");
		$moneyNeed	= 0;
		$ShopList	= ShopList();
		foreach($ShopList as $itemNo) {
			if(!$_POST["check_".$itemNo])
				continue;
			$item	= LoadItemData($itemNo);
			if(!$item) continue;
			$amount	= (int)$_POST["amount_".$itemNo];
			if($amount < 0)
				$amount	= 0;
			
			//print("$itemNo x $Deleted<br>");
			$buyPrice	= $item["buy"];
			$Total	= $amount * $buyPrice;
			$moneyNeed	+= $Total;
			print("<tr><td class=\"td7\">");
			print(MoneyFormat($buyPrice)."\n");
			print("</td><td class=\"td7\">");
			print("x {$amount}\n");
			print("</td><td class=\"td7\">");
			print("= ".MoneyFormat($Total)."\n");
			print("</td><td class=\"td8\">");
			print(ShowItemDetail($item)."\n");
			print("</td></tr>\n");
			$this->AddItem($itemNo,$amount);
		}
		print("<tr><td colspan=\"4\" class=\"td8\">���� : ".MoneyFormat($moneyNeed)."</td></tr>");
		print("</table>\n");
		print("</div>");
		if($this->TakeMoney($moneyNeed)) {
			$this->SaveUserItem();
			return true;
		} else {
			ShowError("��û���㹻��Ǯ","margin15");
			return false;
		}
	}
//////////////////////////////////////////////////
	function ShopBuyShow() {
		print('<div style="margin:15px">'."\n");
		print("<h4>����</h4>\n");

print <<< JS_HTML
<script type="text/javascript">
<!--
function toggleCSS(id) {
Element.toggleClassName('i'+id+'a', 'tdToggleBg');
Element.toggleClassName('i'+id+'b', 'tdToggleBg');
Element.toggleClassName('i'+id+'c', 'tdToggleBg');
Element.toggleClassName('i'+id+'d', 'tdToggleBg');
Field.focus('text_'+id);
}
function toggleCheckBox(id) {
if($('check_'+id).checked) {
  $('check_'+id).checked = false;
} else {
  $('check_'+id).checked = true;
  Field.focus('text_'+id);
}
toggleCSS(id);
}
// -->
</script>
JS_HTML;

		print('<form action="?menu=buy" method="post">'."\n");
		print("<table cellspacing=\"0\">\n");
		print('<tr><td class="td6"></td>'.
		'<td style="text-align:center" class="td6">�۸�</td>'.
		'<td style="text-align:center" class="td6">��</td>'.
		'<td style="text-align:center" class="td6">����</td></tr>'."\n");
		$ShopList	= ShopList();
		foreach($ShopList as $itemNo) {
			$item	= LoadItemData($itemNo);
			if(!$item) continue;
			print("<tr><td class=\"td7\" id=\"i{$itemNo}a\">\n");
			print('<input type="checkbox" name="check_'.$itemNo.'" value="1" onclick="toggleCSS(\''.$itemNo.'\')">'."\n");
			print("</td><td class=\"td7\" id=\"i{$itemNo}b\" onclick=\"toggleCheckBox('{$itemNo}')\">\n");
			// �I��
			$price	= $item["buy"];
			print(MoneyFormat($price));
			print("</td><td class=\"td7\" id=\"i{$itemNo}c\">\n");
			print('<input type="text" id="text_'.$itemNo.'" name="amount_'.$itemNo.'" value="1" style="width:60px" class="text">'."\n");
			print("</td><td class=\"td8\" id=\"i{$itemNo}d\" onclick=\"toggleCheckBox('{$itemNo}')\">\n");
			print(ShowItemDetail($item));
			print("</td></tr>\n");
		}
		print("</table>\n");
		print('<input type="submit" name="ItemBuy" value="��" class="btn">'."\n");
		print("</form>\n");

		print("</div>\n");
	}
//////////////////////////////////////////////////
	function ShopSellProcess() {
		//dump($_POST);
		if(!$_POST["ItemSell"])
			return false;

		$GetMoney	= 0;
		print("<div style=\"margin:15px\">");
		print("<table cellspacing=\"0\">\n");
		print('<tr><td class="td6" style="text-align:center">�۸�</td>'.
		'<td class="td6" style="text-align:center">��</td>'.
		'<td class="td6" style="text-align:center">����</td>'.
		'<td class="td6" style="text-align:center">����</td></tr>'."\n");
		foreach($this->item as $itemNo => $amountHave) {
			if(!$_POST["check_".$itemNo])
				continue;
			$item	= LoadItemData($itemNo);
			if(!$item) continue;
			$amount	= (int)$_POST["amount_".$itemNo];
			if($amount < 0)
				$amount	= 0;
			$Deleted	= $this->DeleteItem($itemNo,$amount);
			//print("$itemNo x $Deleted<br>");
			$sellPrice	= ItemSellPrice($item);
			$Total	= $Deleted * $sellPrice;
			$getMoney	+= $Total;
			print("<tr><td class=\"td7\">");
			print(MoneyFormat($sellPrice)."\n");
			print("</td><td class=\"td7\">");
			print("x {$Deleted}\n");
			print("</td><td class=\"td7\">");
			print("= ".MoneyFormat($Total)."\n");
			print("</td><td class=\"td8\">");
			print(ShowItemDetail($item)."\n");
			print("</td></tr>\n");
		}
		print("<tr><td colspan=\"4\" class=\"td8\">���� : ".MoneyFormat($getMoney)."</td></tr>");
		print("</table>\n");
		print("</div>");
		$this->SaveUserItem();
		$this->GetMoney($getMoney);
		return true;
	}
//////////////////////////////////////////////////
	function ShopSellShow() {
		print('<div style="margin:15px">'."\n");
		print("<h4>����</h4>\n");

print <<< JS_HTML
<script type="text/javascript">
<!--
function toggleCSS(id) {
Element.toggleClassName('i'+id+'a', 'tdToggleBg');
Element.toggleClassName('i'+id+'b', 'tdToggleBg');
Element.toggleClassName('i'+id+'c', 'tdToggleBg');
Element.toggleClassName('i'+id+'d', 'tdToggleBg');
Field.focus('text_'+id);
}
function toggleCheckBox(id) {
if($('check_'+id).checked) {
  $('check_'+id).checked = false;
} else {
  $('check_'+id).checked = true;
  Field.focus('text_'+id);
}
toggleCSS(id);
}
// -->
</script>
JS_HTML;

		print('<form action="?menu=sell" method="post">'."\n");
		print("<table cellspacing=\"0\">\n");
		print('<tr><td class="td6"></td>'.
		'<td style="text-align:center" class="td6">�۸�</td>'.
		'<td style="text-align:center" class="td6">��</td>'.
		'<td style="text-align:center" class="td6">����</td></tr>'."\n");
		foreach($this->item as $itemNo => $amount) {
			$item	= LoadItemData($itemNo);
			if(!$item) continue;
			print("<tr><td class=\"td7\" id=\"i{$itemNo}a\">\n");
			print('<input type="checkbox" name="check_'.$itemNo.'" value="1" onclick="toggleCSS(\''.$itemNo.'\')">'."\n");
			print("</td><td class=\"td7\" id=\"i{$itemNo}b\" onclick=\"toggleCheckBox('{$itemNo}')\">\n");
			// �۸�
			$price	= ItemSellPrice($item);
			print(MoneyFormat($price));
			print("</td><td class=\"td7\" id=\"i{$itemNo}c\">\n");
			print('<input type="text" id="text_'.$itemNo.'" name="amount_'.$itemNo.'" value="'.$amount.'" style="width:60px" class="text">'."\n");
			print("</td><td class=\"td8\" id=\"i{$itemNo}d\" onclick=\"toggleCheckBox('{$itemNo}')\">\n");
			print(ShowItemDetail($item,$amount));
			print("</td></tr>\n");
		}
		print("</table>\n");
		print('<input type="submit" name="ItemSell" value="Sell" class="btn" />'."\n");
		print('<input type="hidden" name="ItemSell" value="1" />'."\n");
		print("</form>\n");

		print("</div>\n");
	}
//////////////////////////////////////////////////
//	�򹤄I��
	function WorkProcess() {
		/*if($_POST["amount"]) {
			$amount	= (int)$_POST["amount"];
			// 1����10����
			if(0 < $amount && $amount < 11) {
				$time	= $amount * 100;
				$money	= $amount * 500;
				if($this->WasteTime($time)) {
					ShowResult(MoneyFormat($money)." ���äȤ�����","margin15");
					$this->GetMoney($money);
					return true;
				} else {
					ShowError("��û���㹻��ʱ�䡣","margin15");
					return false;
				}
			}
		}*/
	}
//////////////////////////////////////////////////
//	�򹤱�ʾ
	function WorkShow() {
		?>
<div style="margin:15px">
<h4>һ�ݼ�ְ������</h4>
<form method="post" action="?menu=work">
<p>1�� 100Time<br />
�o�� : <?php print MoneyFormat(500)?>/��</p>
<select name="amount">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
</select><br />
<input type="submit" value="��" class="btn"/>
</form>
</div>
<?php 
	}
//////////////////////////////////////////////////
	function RankProcess(&$Ranking) {

		// RankBattle
		if($_POST["ChallengeRank"]) {
			if(!$this->party_rank) {
				ShowError("С����δ�趨","margin15");
				return false;
			}
			$result	= $this->CanRankBattle();
			if(is_array($result)) {
				ShowError("����ȴ�ʱ�䣨����","margin15");
				return false;
			}

			/*
				$BattleResult = 0;//����
				$BattleResult = 1;//����
				$BattleResult = "d";//����
			*/
			//list($message,$BattleResult)	= $Rank->Challenge(&$this);
			$Result	= $Ranking->Challenge(&$this);

			//if($Result === "Battle")
			//	$this->RankRecord($BattleResult,"CHALLENGE",false);

			/*
			// �ٔ��ˤ�äƴΤޤǤΑ��L�Εr�g���O������
			//����
			if($BattleResult === 0) {
				$this->SetRankBattleTime(time() + RANK_BATTLE_NEXT_WIN);

			//����
			} else if($BattleResult === 1) {
				$this->SetRankBattleTime(time() + RANK_BATTLE_NEXT_LOSE);

			//���֤�
			} else if($BattleResult === "d") {
				$this->SetRankBattleTime(time() + RANK_BATTLE_NEXT_LOSE);

			}
			*/

			return $Result;// ���L���Ƥ���� $Result = "Battle";
		}

		// ��󥭥��äΥ��`����h
		if($_POST["SetRankTeam"]) {
			$now	= time();
			// �ޤ��O���r�g���ФäƤ��롣
			if(($now - $this->rank_set_time) < RANK_TEAM_SET_TIME) {
				$left	= RANK_TEAM_SET_TIME - ($now - $this->rank_set_time);
				$day	= floor($left / 3600 / 24);
				$hour	= floor($left / 3600)%24;
				$min	= floor(($left % 3600)/60);
				$sec	= floor(($left % 3600)%60);
				ShowError("�����趨���黹�� {$day}�� �� {$hour}Сʱ {$min}�� {$sec}��","margin15");
				return false;
			}
			foreach($this->char as $key => $val) {//�����å����줿��ĥꥹ��
				if($_POST["char_".$key])
					$checked[]	= $key;
			}
			// �O������������त���٤ʤ�����
			if(count($checked) == 0 || 5 < count($checked)) {
				ShowError("��������Ӧ����1��С��5��","margin15");
				return false;
			}

			$this->party_rank	= implode("<>",$checked);
			$this->rank_set_time	= $now;
			ShowResult("�����趨���","margin15");
			return true;
		}
	}
//////////////////////////////////////////////////
//	
	function RankShow(&$Ranking) {

		//$ProcessResult	= $this->RankProcess($Ranking);// array();

		//���L���Ф�줿�ΤǱ�ʾ���ʤ���
		//if($ProcessResult === "BATTLE")
		//	return true;

		// ���`�����O���βФ�r�gӋ��
		$now	= time();
		if( ($now - $this->rank_set_time) < RANK_TEAM_SET_TIME) {
			$left	= RANK_TEAM_SET_TIME - ($now - $this->rank_set_time);
			$hour	= floor($left / 3600);
			$min	= floor(($left % 3600)/60);
			$left_mes	= "<div class=\"bold\">{$hour}Hour {$min}minutes left to set again.</div>\n";
			$disable	= " disabled";
		}
			?>

	<div style="margin:15px">
	<?php print ShowError($message)?>
	<form action="?menu=rank" method="post">
	<h4>���а�(Ranking) - <a href="?rank">�鿴����</a> <a href="?manual#ranking" target="_blank" class="a0">?</a></h4>
	<?php
		// ����Ǥ��뤫�ɤ���(�r�g�νU�^��)
		$CanRankBattle	= $this->CanRankBattle();
		if($CanRankBattle !== true) {
			print('<p>Time left to Next : <span class="bold">');
			print($CanRankBattle[0].":".sprintf("%02d",$CanRankBattle[1]).":".sprintf("%02d",$CanRankBattle[2]));
			print("</span></p>\n");
			$disableRB	= " disabled";
		}

		print("<div style=\"width:100%;padding-left:30px\">\n");
		print("<div style=\"float:left;width:50%\">\n");
		print("<div class=\"u\">TOP 5</div>\n");
		$Ranking->ShowRanking(0,4);
		print("</div>\n");
		print("<div style=\"float:right;width:50%\">\n");
		print("<div class=\"u\">NEAR 5</div>\n");
		$Ranking->ShowRankingRange($this->id,5);
		print("</div>\n");
		print("<div style=\"clear:both\"></div>\n");
		print("</div>\n");

		// �ɥ����
		//$Rank->dump();
		/*
		print("<table><tbody><tr><td style=\"padding:0 50px 0 0\">\n");
		print("<div class=\"bold u\">RANKING</div>");
		$Rank->ShowRanking(0,10);
		print("</td><td>");
		print("<div class=\"bold u\">Nearly</div>");
		$Rank->ShowNearlyRank($this->id);
		print("</td></tr></tbody></table>\n");
		*/
	?>
	<input type="submit" class="btn" value="��ս��" name="ChallengeRank" style="width:160px"<?php print $disableRB?> />
	</form>
	<form action="?menu=rank" method="post">
	<h4>��������(Team Setting)</h4>
	<p>����ս�����趨��<br />
	������������ս���顣</p>
	</div>
<?php $this->ShowCharacters($this->char,CHECKBOX,explode("<>",$this->party_rank));?>

	<div style="margin:15px">
	<?php print $left_mes?>
	<input type="submit" class="btn" style="width:160px" value="�趨����"<?php print $disable?> />
	<input type="hidden" name="SetRankTeam" value="1" />
	<p>�趨��<?php print $reset=floor(RANK_TEAM_SET_TIME/(60*60))?>Сʱ����������á�<br />Team setting disabled after <?php print $reset?>hours once set.</p>
	</form>
	</div>
<?php 
	}
//////////////////////////////////////////////////
	function RecruitProcess() {

		// �������޽�
		if( MAX_CHAR <= count($this->char) )
			return false;

		include(DATA_BASE_CHAR);
		if($_POST["recruit"]) {
			// �����Υ�����
			switch($_POST["recruit_no"]) {
				case "1": $hire = 2000; $charNo	= 1; break;
				case "2": $hire = 2000; $charNo	= 2; break;
				case "3": $hire = 2500; $charNo	= 3; break;
				case "4": $hire = 4000; $charNo	= 4; break;
				default:
					ShowError("δѡ������","margin15");
					return false;
			}
			// ��ǰ�I��
			if($_POST["recruit_name"]) {
				if(is_numeric(strpos($_POST["recruit_name"],"\t")))
					return "error.";
				$name	= trim($_POST["recruit_name"]);
				$name	= stripslashes($name);
				$len	= strlen($name);
				if ( 0 == $len || 16 < $len ) {
					ShowError("����̫�̻�̫��","margin15");
					return false;
				}
				$name	= htmlspecialchars($name,ENT_QUOTES);
			} else {
				ShowError("���Ʋ����ǿ�","margin15");
				return false;
			}
			//�Ԅe
			if( !isset($_POST["recruit_gend"]) ) {
				ShowError("δѡ���Ԅe","margin15");
				return false;
			} else {
				$Gender	= $_POST["recruit_gend"]?"��":"��";
			}
			// �����ǩ`���򥯥饹������
			
			$plus	= array("name"=>"$name","gender"=>$_POST["recruit_gend"]);
			$char	= new char();
			$char->SetCharData(array_merge(BaseCharStatus($charNo),$plus));
			//���ý�
			if($hire <= $this->money) {
				$this->TakeMoney($hire);
			} else {
				ShowError("��û���㹻��Ǯ","margin15");
				return false;
			}
			// �����򱣴椹��
			$char->SaveCharData($this->id);
			ShowResult($char->Name()."($char->job_name:{$Gender}) ��Ϊͬ�飡","margin15");
			return true;
		}
	}

//////////////////////////////////////////////////
//	
	function RecruitShow() {
		if( MAX_CHAR <= $this->CharCount() ) {
			?>

	<div style="margin:15px">
	<p>Maximum characters.<br>
	Need to make a space to recruit new character.</p>
	<p>�����������ﵽ��<br>
	Ҫ����µĿռ����������ˣ�������</p>
	</div>
<?php 
			return false;
		}
		include_once(CLASS_MONSTER);
		$char[0]	= new char();
		$char[0]->SetCharData(array_merge(BaseCharStatus("1"),array("gender"=>"0")));
		$char[1]	= new char();
		$char[1]->SetCharData(array_merge(BaseCharStatus("1"),array("gender"=>"1")));
		$char[2]	= new char();
		$char[2]->SetCharData(array_merge(BaseCharStatus("2"),array("gender"=>"0")));
		$char[3]	= new char();
		$char[3]->SetCharData(array_merge(BaseCharStatus("2"),array("gender"=>"1")));
		$char[4]	= new char();
		$char[4]->SetCharData(array_merge(BaseCharStatus("3"),array("gender"=>"0")));
		$char[5]	= new char();
		$char[5]->SetCharData(array_merge(BaseCharStatus("3"),array("gender"=>"1")));
		$char[6]	= new char();
		$char[6]->SetCharData(array_merge(BaseCharStatus("4"),array("gender"=>"0")));
		$char[7]	= new char();
		$char[7]->SetCharData(array_merge(BaseCharStatus("4"),array("gender"=>"1")));
		?>

	<form action="?recruit" method="post" style="margin:15px">
	<h4>�������ְҵ</h4>
	<table cellspacing="0"><tbody><tr>
	<td class="td1" style="text-align:center">
<?php $char[0]->ShowImage()?>
<?php $char[1]->ShowImage()?><br>
	<input type="radio" name="recruit_no" value="1" style="margin:3px"><br>
	<?php print MoneyFormat(2000)?></td>
	<td class="td1" style="text-align:center">
<?php $char[2]->ShowImage()?>
<?php $char[3]->ShowImage()?><br>
	<input type="radio" name="recruit_no" value="2" style="margin:3px"><br>
	<?php print MoneyFormat(2000)?></td>
	<td class="td1" style="text-align:center">
<?php $char[4]->ShowImage()?>
<?php $char[5]->ShowImage()?><br>
	<input type="radio" name="recruit_no" value="3" style="margin:3px"><br>
	<?php print MoneyFormat(2500)?></td>
	<td class="td1" style="text-align:center">
<?php $char[6]->ShowImage()?>
<?php $char[7]->ShowImage()?><br>
	<input type="radio" name="recruit_no" value="4" style="margin:3px"><br>
	<?php print MoneyFormat(4000)?></td>
	</tr><tr>
	<td class="td4" style="text-align:center">
	սʿ</td>
	<td class="td5" style="text-align:center">
	��ʦ</td>
	<td class="td4" style="text-align:center">
	��ʦ</td>
	<td class="td5" style="text-align:center">
	����</td>
	</tr>
	</tbody></table>

	<h4>��������Ա�</h4>
	<table><tbody><tr><td valign="top">
	<input type="text" class="text" name="recruit_name" style="width:160px" maxlength="16"><br>
	<div style="margin:5px 0px">
	<input type="radio" class="vcent" name="recruit_gend" value="0">��
	<input type="radio" class="vcent" name="recruit_gend" value="1" style="margin-left:15px;">Ů</div>
	<input type="submit" class="btn" name="recruit" value="��Ӷ">
	<input type="hidden" class="btn" name="recruit" value="Recruit">
	</td><td valign="top">
	<p>1 to 16 letters.<br>
	Chinese characters count as 2.<br>
	1������ = 2 letter.
	</p>
	</td></tr></tbody></table>
	</form>
<?php 
	}
//////////////////////////////////////////////////
//	�ұ�ݾ��b�إå�
	function SmithyRefineHeader() {
	?>
<div style="margin:15px">
<h4>��������(Refine)</h4>

<div style="width:600px">
<div style="float:left;width:80px;">
<img src="<?php print IMG_CHAR?>mon_053r.gif" />
</div>
<div style="float:right;width:520px;">
������ ���Խ�����Ʒ�ľ�����<br />
ѡ����Ҫ��������Ʒ�Լ������Ĵ�����<br />
�����ӹ��������ǲ�����<br />
�ܵ��ڹ���� <span class="bold">��������</span> ��<a href="?menu=create">���</a>��
</div>
<div style="clear:both"></div>
</div>
<h4>��������<a name="refine"></a></h4>
<div style="margin:0 20px">
<?php 
	}
//////////////////////////////////////////////////
//	�ұ�݄I��(���b)
	function SmithyRefineProcess() {
		if(!$_POST["refine"])
			return false;
		if(!$_POST["item_no"]) {
			ShowError("Select Item.");
			return false;
		}
		// ���ߤ��i���z��ʤ�����
		if(!$item	= LoadItemData($_POST["item_no"])) {
			ShowError("Failed to load item data.");
			return false;
		}
		// ���ߤ����֤��Ƥ��ʤ�����
		if(!$this->item[$_POST["item_no"]]) {
			ShowError("Item \"{$item[name]}\" doesn't exists.");
			return false;
		}
		// ������ָ������Ƥ��ʤ�����
		if($_POST["timesA"] < $_POST["timesB"])
			$times	= $_POST["timesB"];
		else
			$times	= $_POST["timesA"];
		if(!$times || $times < 1 || (REFINE_LIMIT) < $times ) {
			ShowError("times?");
			return false;
		}
		include(CLASS_SMITHY);
		$obj_item	= new Item($_POST["item_no"]);
		// ���ε��ߤ����b�Ǥ��ʤ�����
		if(!$obj_item->CanRefine()) {
			ShowError("Cant refine \"{$item[name]}\"");
			return false;
		}
		// �������龫�b��ʼ���I��
		$this->DeleteItem($_POST["item_no"]);// ���ߤ������뤫�仯����Τ�����
		$Price	= round($item["buy"]/2);
		// ����b�����{����
		if( REFINE_LIMIT < ($item["refine"] + $times) ) {
			$times	= REFINE_LIMIT - $item["refine"];
		}
		$Trys	= 0;
		for($i=0; $i<$times; $i++) {
			// ���������
			if($this->TakeMoney($Price)) {
				$MoneySum	+= $Price;
				$Trys++;
				if(!$obj_item->ItemRefine()) {//���b����(false=ʧ���ʤΤǽK�ˤ���)
					break;
				}
			// ����;�ФǤʤ��ʤä����ϡ�
			} else {
				ShowError("Not enough money.<br />\n");
				$this->AddItem($obj_item->ReturnItem());
				break;
			}
			// ָ���������b��ɹ������ä����ϡ�
			if($i == ($times - 1)) {
				$this->AddItem($obj_item->ReturnItem());
			}
		}
		print("Money Used : ".MoneyFormat($Price)." x ".$Trys." = ".MoneyFormat($MoneySum)."<br />\n");
		$this->SaveUserItem();
		return true;
		/*// �������Ƥ뤫Ӌ��
		$Price	= round($item["buy"]/2);
		$MoneyNeed	= $times * $Price;
		if($this->money < $MoneyNeed) {
			ShowError("Your request needs ".MoneyFormat($MoneyNeed));
			return false;
		}*/
		
	}
//////////////////////////////////////////////////
//	�ұ�ݱ�ʾ
	function SmithyRefineShow() {
		// �����b�I��
		//$Result	= $this->SmithyRefineProcess();

		// ���b���ܤ���α�ʾ
		if($this->item) {
			include(CLASS_JS_ITEMLIST);
			$possible	= CanRefineType();
			$possible	= array_flip($possible);
			//���Ф����^�΂���"0"�ʤΤ�1�ˤ���(issetʹ�鷺��true�ˤ��뤿��)
			$possible[key($possible)]++;

			$goods	= new JS_ItemList();
			$goods->SetID("my");
			$goods->SetName("type");

			$goods->ListTable("<table cellspacing=\"0\">");// �Ʃ`�֥륿���ΤϤ��ޤ�
			$goods->ListTableInsert("<tr><td class=\"td9\"></td><td class=\"align-center td9\">������</td><td class=\"align-center td9\">Item</td></tr>"); // �Ʃ`�֥�������������Ф˱�ʾ�������ġ�

			// JS��ʹ�ä��ʤ���
			if($this->no_JS_itemlist)
				$goods->NoJS();
			foreach($this->item as $no => $val) {
				$item	= LoadItemData($no);
				// ���b���ܤ��������ʾ�����롣
				if(!$possible[$item["type"]])
					continue;
				$price	= $item["buy"]/2;
				// NoTable
	//			$string	= '<input type="radio" class="vcent" name="item_no" value="'.$no.'">';
	//			$string	.= "<span style=\"padding-right:10px;width:10ex\">".MoneyFormat($price)."</span>".ShowItemDetail($item,$val,1)."<br />";

				$string	= '<tr>';
				$string	.= '<td class="td7"><input type="radio" class="vcent" name="item_no" value="'.$no.'">';
				$string	.= '</td><td class="td7">'.MoneyFormat($price).'</td><td class="td8">'.ShowItemDetail($item,$val,1)."<td>";
				$string	.= "</tr>";

				$goods->AddItem($item,$string);
			}
			// JavaScript���֤Ε�������
			print($goods->GetJavaScript("list"));
			print('���Ծ���������');
			// �NΥ��쥯�ȥܥå���
			print($goods->ShowSelect());
			print('<form action="?menu=refine" method="post">'."\n");
			// [Refine]button
			print('<input type="submit" value="Refine" name="refine" class="btn">'."\n");
			// ���b������ָ��
			print('���� : <select name="timesA">'."\n");
			for($i=1; $i<11; $i++) {
				print('<option value="'.$i.'">'.$i.'</option>');
			}
			print('</select>'."\n");
			// �ꥹ�Ȥα�ʾ
			print('<div id="list">'.$goods->ShowDefault().'</div>'."\n");
			// [Refine]button
			print('<input type="submit" value="Refine" name="refine" class="btn">'."\n");
			print('<input type="hidden" value="1" name="refine">'."\n");
			// ���b������ָ��
			print('���� : <select name="timesB">'."\n");
			for($i=1; $i<(REFINE_LIMIT+1); $i++) {
				print('<option value="'.$i.'">'.$i.'</option>');
			}
			print('</select>'."\n");
			print('</form>'."\n");
		} else {
			print("No items<br />\n");
		}
		print("</div>\n");
	?>
	</div>
<?php 
	}
//////////////////////////////////////////////////
//	�ұ�� �u�� �إå�
	function SmithyCreateHeader() {
		?>
<div style="margin:15px">
<h4>��������(Create)<a name="sm"></a></h4>
<div style="width:600px">
<div style="float:left;width:80px;">
<img src="<?php print IMG_CHAR?>mon_053rz.gif" />
</div>
<div style="float:right;width:520px;">
������ ���Խ�����Ʒ��������<br />
ֻҪ�����زľͿ�������װ����<br />
���������زĵĻ��������������������<br />
����ڹ���� <span class="bold">��������</span> ��<a href="?menu=refine">���</a>��<br />
<a href="#mat">�����ز�һ��</a>
</div>
<div style="clear:both"></div>
</div>
<h4>��������<a name="refine"></a></h4>
<div style="margin:0 15px">
<?php 
	}
//////////////////////////////////////////////////
//	�u���I��
	function SmithyCreateProcess() {
		if(!$_POST["Create"]) return false;

		// ���ߤ��x�k����Ƥ��ʤ�
		if(!$_POST["ItemNo"]) {
			ShowError("��ѡ��һ����������");
			return false;
		}

		// ���ߤ��i��
		if(!$item	= LoadItemData($_POST["ItemNo"])) {
			ShowError("error12291703");
			return false;
		}

		// �������ߤ��ɤ������������
		if(!HaveNeeds($item,$this->item)) {
			ShowError($item["name"]." ��û���㹻��ԭ��������");
			return false;
		}

		// ׷���ز�
		if($_POST["AddMaterial"]) {
			// ���֤��Ƥ��ʤ�����
			if(!$this->item[$_POST["AddMaterial"]]) {
				ShowError("���زĲ���׷�ӡ�");
				return false;
			}
			// ׷���زĤε��ߥǩ`��
			$ADD	= LoadItemData($_POST["AddMaterial"]);
			$this->DeleteItem($_POST["AddMaterial"]);
		}

		// ���ߤ��u��
		// �����p�餹
		//$Price	= $item["buy"];
		$Price	= 0;
		if(!$this->TakeMoney($Price)) {
			ShowError("��û���㹻��Ǯ����Ҫ".MoneyFormat($Price)."��");
			return false;
		}
		// �زĤ�p�餹
		foreach($item["need"] as $M_item => $M_amount) {
			$this->DeleteItem($M_item,$M_amount);
		}
		include(CLASS_SMITHY);
		$item	= new item($_POST["ItemNo"]);
		$item->CreateItem();
		// ���ӄ���
		if($ADD["Add"])
			$item->AddSpecial($ADD["Add"]);
		// �Ǥ������ߤ򱣴椹��
		$done	= $item->ReturnItem();
		$this->AddItem($done);
		$this->SaveUserItem();

		print("<p>");
		print(ShowItemDetail(LoadItemData($done)));
		
		print("\n<br />���ˣ�</p>\n");
		return true;
	}
//////////////////////////////////////////////////
//	�u����ʾ
	function SmithyCreateShow() {
		//$result	= $this->SmithyCreateProcess();

		$CanCreate	= CanCreate($this);
		include(CLASS_JS_ITEMLIST);
		$CreateList	= new JS_ItemList();
		$CreateList->SetID("create");
		$CreateList->SetName("type_create");

		$CreateList->ListTable("<table cellspacing=\"0\">");// �Ʃ`�֥륿���ΤϤ��ޤ�
		$CreateList->ListTableInsert("<tr><td class=\"td9\"></td><td class=\"align-center td9\">��������</td><td class=\"align-center td9\">Item</td></tr>"); // �Ʃ`�֥�������������Ф˱�ʾ�������ġ�

		// JS��ʹ�ä��ʤ���
		if($this->no_JS_itemlist)
			$CreateList->NoJS();
		foreach($CanCreate as $item_no) {
			$item	= LoadItemData($item_no);
			if(!HaveNeeds($item,$this->item))// �زĲ���ʤ��
				continue;
			// NoTable
			//$head	= '<input type="radio" name="ItemNo" value="'.$item_no.'">'.ShowItemDetail($item,false,1,$this->item)."<br />";
			//$CreatePrice	= $item["buy"];
			$CreatePrice	= 0;//
			$head	= '<tr><td class="td7"><input type="radio" name="ItemNo" value="'.$item_no.'"></td>';
			$head	.= '<td class="td7">'.MoneyFormat($CreatePrice).'</td><td class="td8">'.ShowItemDetail($item,false,1,$this->item)."</td>";
			$CreateList->AddItem($item,$head);
		}
		if($head) {
			print($CreateList->GetJavaScript("list"));
			print($CreateList->ShowSelect());
		?>
<form action="?menu=create" method="post">
<div id="list"><?php print $CreateList->ShowDefault()?></div>
<input type="submit" class="btn" name="Create" value="����">
<input type="reset" class="btn" value="����">
<input type="hidden" name="Create" value="1"><br />
<?php 
		// ׷���زĤα�ʾ
		print('<div class="bold u" style="margin-top:15px">׷���ز�</div>'."\n");
		for($item_no=7000; $item_no<7200; $item_no++) {
			if(!$this->item["$item_no"])
				continue;
			if($item	= LoadItemData($item_no)) {
				print('<input type="radio" name="AddMaterial" value="'.$item_no.'" class="vcent">');
				print(ShowItemDetail($item,$this->item["$item_no"],1)."<br />\n");
			}
		}
		?>
<input type="submit" class="btn" name="Create" value="����">
<input type="reset" class="btn" value="����">
</form>
<?php 
		} else {
			print("��Ŀǰ���������е��زĵĻ�ʲôҲ����������");
		}


		// �����ز�һ�E
		print("</div>\n");
		print("<h4>�����ز�һ��<a name=\"mat\"></a> <a href=\"#sm\">��</a></h4>");
		print("<div style=\"margin:0 15px\">");
		for($i=6000; $i<7000; $i++) {
			if(!$this->item["$i"])
				continue;
			$item	= LoadItemData($i);
			ShowItemDetail($item,$this->item["$i"]);
			print("<br />\n");
		}
		?>
</div>
</div>
<?php 
		return $result;
	}
//////////////////////////////////////////////////
//	���Щ`�ˤʤ�I��
	function AuctionJoinMember() {
		if(!$_POST["JoinMember"])
			return false;
		if($this->item["9000"]) {//�Ȥ˻�T
			//ShowError("You are already a member.\n");
			return false;
		}
		// �������ʤ�
		if(!$this->TakeMoney(round(START_MONEY * 1.10))) {
			ShowError("��û���㹻��Ǯ<br />\n");
			return false;
		}
		// ���ߤ��㤹
		$this->AddItem(9000);
		$this->SaveUserItem();
		$this->SaveData();
		ShowResult("������ĳ�Ա��<br />\n");
		return true;
	}
//////////////////////////////////////////////////
//	
	function AuctionEnter() {
		if($this->item["9000"])//���`���������Щ`���`��
			return true;
		else
			return false;
	}
//////////////////////////////////////////////////
//	���`�������α�ʾ(header)
	function AuctionHeader() {
		?>
<div style="margin:15px 0 0 15px">
<h4>����(Auction)</h4>
<div style="margin-left:20px">

<div style="width:500px">
<div style="float:left;width:50px;">
<img src="<?php print IMG_CHAR?>ori_003.gif" />
</div>
<div style="float:right;width:450px;">
<?php 

		$this->AuctionJoinMember();
		if($this->AuctionEnter()) {
			print("���л�Ա��ô��<br />\n");
			print("��ӭ������������<br />\n");
			print("<a href=\"#log\">�ع˼�¼</a>\n");
		} else {
			print("������������������Ҫ�����Ա����<br />\n");
			print("�����ÿ�Ҫ ".MoneyFormat(round(START_MONEY * 1.10))." �ء�<br />\n");
			print("���ô?<br />\n");
			print('<form action="" method="post">'."\n");
			print('<input type="submit" value="���" name="JoinMember" class="btn"/>'."\n");
			print("</form>\n");
		}
		if(!AUCTION_TOGGLE)
			ShowError("������ͣ");
		if(!AUCTION_EXHIBIT_TOGGLE)
			ShowError("��ͣ����");
		?>
</div>
<div style="clear:both"></div>
</div>
</div>
<h4>��������(Item Auction)</h4>
<div style="margin-left:20px">
<?php 
	}
//////////////////////////////////////////////////
//	���`�������α�ʾ
	function AuctionFoot(&$ItemAuction) {
		?>
</div>
<a name="log"></a>
<h4>������¼(AuctionLog)</h4>
<div style="margin-left:20px">
<?php $ItemAuction->ShowLog();?>
</div>
<?php 
	}
//////////////////////////////////////////////////
//	����I��
	function AuctionItemBiddingProcess(&$ItemAuction) {
		if(!$this->AuctionEnter())
			return false;
		if(!isset($_POST["ArticleNo"]))
			return false;

		$ArticleNo	= $_POST["ArticleNo"];
		$BidPrice	= (int)$_POST["BidPrice"];
		if($BidPrice < 1) {
			ShowError("������Ǹ�����ļ۸�");
			return false;
		}
		// �ޤ���Ʒ�Ф��ɤ����_�J���롣
		if(!$ItemAuction->ItemArticleExists($ArticleNo)) {
			ShowError("�������Ʒ�������޷�ȷ�ϡ�");
			return false;
		}
		// �Է֤�����Ǥ����ˤ��ɤ����δ_�J
		if(!$ItemAuction->ItemBidRight($ArticleNo,$this->id)) {
			ShowError("No.".$ArticleNo." �����Ƿ��Ѿ��б�");
			return false;
		}
		// ��;��������äƤ��ʤ����_�J���롣
		$Bottom	= $ItemAuction->ItemBottomPrice($ArticleNo);
		if($BidPrice < $Bottom) {
			ShowError("�������Ͷ���");
			ShowError("Ŀǰ����:".MoneyFormat($BidPrice)." ��ͳ���:".MoneyFormat($Bottom));
			return false;
		}
		// ��֤äƤ뤫�_�J����
		if(!$this->TakeMoney($BidPrice)) {
			ShowError("�����ʽ��㡣");
			return false;
		}

		// �g�H�˾��ꤹ�롣
		if($ItemAuction->ItemBid($ArticleNo,$BidPrice,$this->id,$this->name)) {
			ShowResult("No:{$ArticleNo}  ".MoneyFormat($BidPrice)." ���չ���<br />\n");
			return true;
		}
	}
//////////////////////////////////////////////////
//	���ߥ��`��������äΥ��֥������Ȥ��i��Ƿ���
/*
	function AuctionItemLoadData() {
		include(CLASS_AUCTION);
		$ItemAuction	= new Auction(item);
		$ItemAuction->ItemCheckSuccess();// ���Ӥ��K�ˤ���Ʒ����{�٤�
		$ItemAuction->UserSaveData();// ����Ʒ�Ƚ��~���ID����äƱ��椹��

		return $ItemAuction;
	}
*/
//////////////////////////////////////////////////
//	�����åե��`��(����)
	function AuctionItemBiddingForm(&$ItemAuction) {

		if(!AUCTION_TOGGLE)
			return false;

		// ��Ʒ�åե��`��ˤ����ܥ���
		if($this->AuctionEnter()) {
		if(AUCTION_EXHIBIT_TOGGLE) {
				print("<form action=\"?menu=auction\" method=\"post\">\n");
				print('<input type="submit" value="������Ʒ" name="ExhibitItemForm" class="btn" style="width:160px">'."\n");
				print("</form>\n");
			}
			// ��ᤷ�Ƥ����ϡ�����Ǥ���褦��
			$ItemAuction->ItemSortBy($_GET["sort"]);
			$ItemAuction->ItemShowArticle2(true);

			if(AUCTION_EXHIBIT_TOGGLE) {
				print("<form action=\"?menu=auction\" method=\"post\">\n");
				print('<input type="submit" value="������Ʒ" name="ExhibitItemForm" class="btn" style="width:160px">'."\n");
				print("</form>\n");
			}

		} else {
			// ����Ǥ��ʤ�
			$ItemAuction->ItemShowArticle2(false);
		}
	}
//////////////////////////////////////////////////
//	���߳�Ʒ�I��
	function AuctionItemExhibitProcess(&$ItemAuction) {

		if(!AUCTION_EXHIBIT_TOGGLE)
			return "BIDFORM";// ��Ʒ���Y

		// ���椷�ʤ��ǳ�Ʒ�ꥹ�Ȥ��ʾ����
		if(!$this->AuctionEnter())
			return "BIDFORM";
		if(!$_POST["PutAuction"])
			return "BIDFORM";

		if(!$_POST["item_no"]) {
			ShowError("Select Item.");
			return false;
		}
		// ���å����ˤ��30���g�γ�Ʒ�ܷ�
		$SessionLeft	= 30 - (time() - $_SESSION["AuctionExhibit"]);
		if($_SESSION["AuctionExhibit"] && 0 < $SessionLeft) {
			ShowError("Wait {$SessionLeft}seconds to ReExhibit.");
			return false;
		}
		// ͬ�r��Ʒ��������
		if(AUCTION_MAX <= $ItemAuction->ItemAmount()) {
			ShowError("���������Ѵﵽ���ޡ�(".$ItemAuction->ItemAmount()."/".AUCTION_MAX.")");
			return false;
		}
		// ��Ʒ�M��
		if(!$this->TakeMoney(500)) {
			ShowError("Need ".MoneyFormat(500)." to exhibit auction.");
			return false;
		}
		// ���ߤ��i���z��ʤ�����
		if(!$item	= LoadItemData($_POST["item_no"])) {
			ShowError("Failed to load item data.");
			return false;
		}
		// ���ߤ����֤��Ƥ��ʤ�����
		if(!$this->item[$_POST["item_no"]]) {
			ShowError("Item \"{$item[name]}\" doesn't exists.");
			return false;
		}
		// ���ε��ߤ���Ʒ�Ǥ��ʤ�����
		$possible	= CanExhibitType();
		if(!$possible[$item["type"]]) {
			ShowError("Cant put \"{$item[name]}\" to the Auction");
			return false;
		}
		// ��Ʒ�r�g�δ_�J
		if(	!(	$_POST["ExhibitTime"] === '1' ||
				$_POST["ExhibitTime"] === '3' ||
				$_POST["ExhibitTime"] === '6' ||
				$_POST["ExhibitTime"] === '12' ||
				$_POST["ExhibitTime"] === '18' ||
				$_POST["ExhibitTime"] === '24') ) {
			var_dump($_POST);
			ShowError("time?");
			return false;
		}
		// �����δ_�J
		if(ereg("^[0-9]",$_POST["Amount"])) {
			$amount	= (int)$_POST["Amount"];
			if($amount == 0)
				$amount	= 1;
		} else {
			$amount	= 1;
		}
		// �p�餹(���������यָ�����줿���Ϥ��������{������)
		$_SESSION["AuctionExhibit"]	= time();//���å�����2�س�Ʒ�����
		$amount	= $this->DeleteItem($_POST["item_no"],$amount);
		$this->SaveUserItem();

		// ��Ʒ����
		// $ItemAuction	= new Auction(item);// (2008/2/28:�����Ȼ�)
		$ItemAuction->ItemAddArticle($_POST["item_no"],$amount,$this->id,$_POST["ExhibitTime"],$_POST["StartPrice"],$_POST["Comment"]);
		print($item["name"]."{$amount}�� չ��Ʒ��");
		return true;
	}
//////////////////////////////////////////////////
//	��Ʒ�åե��`��
	function AuctionItemExhibitForm() {

		if(!AUCTION_EXHIBIT_TOGGLE)
			return false;

		include(CLASS_JS_ITEMLIST);
		$possible	= CanExhibitType();
		?>
<div class="u bold">��β�չ</div>
<ol>
<li>ѡ��һ�ֵ��ߣ�������</li>
<li>���Ҫ������������������Ҫ����������</li>
<li>ָ��������ʱ�䡣</li>
<li>ָ�����ļ�(������Ļ�Ϊ0)</li>
<li>��������������</li>
<li>���͡�</li>
</ol>
<div class="u bold">ע������</div>
<ul>
<li>����Ҫ��$500�������ѡ�</li>
<li>�����������������ƺ��������������µ�����</li>
</ul>
<a href="?menu=auction">�鿴����������</a>
</div>
<h4>����</h4>
<div style="margin-left:20px">
<div class="u bold">���������ĵ���</div>
<?php 
		if(!$this->item) {
			print("No items<br />\n");
			return false;
		}
		$ExhibitList	= new JS_ItemList();
		$ExhibitList->SetID("auc");
		$ExhibitList->SetName("type_auc");
		// JS��ʹ�ä��ʤ���
		if($this->no_JS_itemlist)
			$ExhibitList->NoJS();
		foreach($this->item as $no => $amount) {
			$item	= LoadItemData($no);
			if(!$possible[$item["type"]])
				continue;
			$head	= '<input type="radio" name="item_no" value="'.$no.'" class="vcent">';
			$head	.= ShowItemDetail($item,$amount,1)."<br />";
			$ExhibitList->AddItem($item,$head);
		}
		print($ExhibitList->GetJavaScript("list"));
		print($ExhibitList->ShowSelect());
		?>
<form action="?menu=auction" method="post">
<div id="list"><?php print $ExhibitList->ShowDefault()?></div>
<table><tr><td style="text-align:right">
����(Amount) :</td><td><input type="text" name="Amount" class="text" style="width:60px" value="1" /><br />
</td></tr><tr><td style="text-align:right">
ʱ��(Time) :</td><td>
<select name="ExhibitTime">
<option value="24" selected>24 hour</option>
<option value="18">18 hour</option>
<option value="12">12 hour</option>
<option value="6">6 hour</option>
<option value="3">3 hour</option>
<option value="1">1 hour</option>
</select>
</td></tr><tr><td>
���ļ�(Start Price) :</td><td><input type="text" name="StartPrice" class="text" style="width:240px" maxlength="10"><br />
</td></tr><tr><td style="text-align:right">
����(Comment) :</td><td>
<input type="text" name="Comment" class="text" style="width:240px" maxlength="40">
</td></tr><tr><td></td><td>
<input type="submit" class="btn" value="Put Auction" name="PutAuction" style="width:240px"/>
<input type="hidden" name="PutAuction" value="1">
</td></tr></table>
</form>

<?php 
		
	}
//////////////////////////////////////////////////
//	Union��󥹥��`�΄I��
	function UnionProcess() {

		if($this->CanUnionBattle() !== true) {
			$host  = $_SERVER['HTTP_HOST'];
			$uri   = rtrim(dirname($_SERVER['PHP_SELF']));
			$extra = INDEX;
			header("Location: http://$host$uri/$extra?hunt");
			exit;
		}

		if(!$_POST["union_battle"])
			return false;
		$Union	= new union();
		// ������Ƥ��뤫�����ڤ��ʤ����ϡ�
		if(!$Union->UnionNumber($_GET["union"]) || !$Union->is_Alive()) {
			return false;
		}
		// ��˥����󥹥��`�Υǩ`��
		$UnionMob	= CreateMonster($Union->MonsterNumber);
		$this->MemorizeParty();//�ѩ`�ƥ��`ӛ��
		// �Է֥ѩ`�ƥ��`
		foreach($this->char as $key => $val) {//�����å����줿��ĥꥹ��
			if($_POST["char_".$key]) {
				$MyParty[]	= $this->char[$key];
				$TotalLevel	+= $this->char[$key]->level;//�Է�PT�κ�Ӌ��٥�
			}
		}
		// ��Ӌ��٥�����
		if($UnionMob["LevelLimit"] < $TotalLevel) {
			ShowError('�ϼƼ���ˮƽ('.$TotalLevel.'/'.$UnionMob["LevelLimit"].')',"margin15");
			return false;
		}
		if( count($MyParty) === 0) {
			ShowError('ս������Ҫһ���˲μ�',"margin15");
			return false;
		} else if(5 < count($MyParty)) {
			ShowError('ս�����ֻ���������',"margin15");
			return false;
		}
		if(!$this->WasteTime(UNION_BATTLE_TIME)) {
			ShowError('Time Shortage.',"margin15");
			return false;
		}

		// ��PT��

		// ���������ѩ`�ƥ��`
		if($UnionMob["SlaveAmount"])
			$EneNum	= $UnionMob["SlaveAmount"] + 1;//PT���Ф�ͬ����������
		else
			$EneNum	= 5;// Union�����5�˹̶����롣

		if($UnionMob["SlaveSpecify"])
			$EnemyParty	= $this->EnemyParty($EneNum-1, $Union->Slave, $UnionMob["SlaveSpecify"]);
		else
			$EnemyParty	= $this->EnemyParty($EneNum-1, $Union->Slave, $UnionMob["SlaveSpecify"]);

		// unionMob�����ФΤ��褽���������
		array_splice($EnemyParty,floor(count($EnemyParty)/2),0,array($Union));

		$this->UnionSetTime();

		include(CLASS_BATTLE);
		$battle	= new battle($MyParty,$EnemyParty);
		$battle->SetUnionBattle();
		$battle->SetBackGround($Union->UnionLand);//����
		//$battle->SetTeamName($this->name,"Union:".$Union->Name());
		$battle->SetTeamName($this->name,$UnionMob["UnionName"]);
		$battle->Process();//���L�_ʼ

		$battle->SaveCharacters();//�����ǩ`������
			list($UserMoney)	= $battle->ReturnMoney();//���L�ǵä���Ӌ���~
			$this->GetMoney($UserMoney);//����򉈤䤹
			$battle->RecordLog("UNION");
			// ���ߤ��ܤ�ȡ��
			if($itemdrop	= $battle->ReturnItemGet(0)) {
				$this->LoadUserItem();
				foreach($itemdrop as $itemno => $amount)
					$this->AddItem($itemno,$amount);
				$this->SaveUserItem();
			}

		return true;
	}
//////////////////////////////////////////////////
//	Union��󥹥��`�α�ʾ
	function UnionShow() {
		if($this->CanUnionBattle() !== true) {
			$host  = $_SERVER['HTTP_HOST'];
			$uri   = rtrim(dirname($_SERVER['PHP_SELF']));
			$extra = INDEX;
			header("Location: http://$host$uri/$extra?hunt");
			exit;
		}
		//if($Result	= $this->UnionProcess())
		//	return true;
		print('<div style="margin:15px">'."\n");
		print("<h4>Union Monster</h4>\n");
		$Union	= new union();
		// ������Ƥ��뤫�����ڤ��ʤ����ϡ�
		if(!$Union->UnionNumber($_GET["union"]) || !$Union->is_Alive()) {
			ShowError("Defeated or not Exists.");
			return false;
		}
		print('</div>');
		$this->ShowCharacters(array($Union),false,"sea");
		print('<div style="margin:15px">'."\n");
		print("<h4>Teams</h4>\n");
		print("</div>");
		print('<form action="'.INDEX.'?union='.$_GET["union"].'" method="post">');
		$this->ShowCharacters($this->char,CHECKBOX,explode("<>",$this->party_memo));
			?>
	<div style="margin:15px;text-align:center">
	<input type="submit" class="btn" value="ս��!">
	<input type="hidden" name="union_battle" value="1">
	<input type="reset" class="btn" value="����"><br>
	����˶���:<input type="checkbox" name="memory_party" value="1">
	</div></form>
<?php 
	}
//////////////////////////////////////////////////
//	α�ʾ
	function TownShow() {
		include(DATA_TOWN);
		print('<div style="margin:15px">'."\n");
		print("<h4>��</h4>");
		print('<div class="town">'."\n");
		print("<ul>\n");
		$PlaceList	= TownAppear($this);
		// ��
		if($PlaceList["Shop"]) {
			?>
<li>��(Shop)
<ul>
<li><a href="?menu=buy">��(Buy)</a></li>
<li><a href="?menu=sell">��(Sell)</a></li>
<li><a href="?menu=work">��</a></li>
</ul>
</li>
<?php 
		}
		// ������
		if($PlaceList["Recruit"])
			print("<li><p><a href=\"?recruit\">�˲�������(Recruit)</a></p></li>");
		// �ұ��
		if($PlaceList["Smithy"]) {
			?>
<li>��ұ��(Smithy)
<ul>
<li><a href="?menu=refine">��������(Refine)</a></li>
<li><a href="?menu=create">��������(Create)</a></li>
</ul>
</li>
<?php 
		}
		// ���`���������
		if($PlaceList["Auction"] && AUCTION_TOGGLE)
			print("<li><a href=\"?menu=auction\">�������(Auction)</li>");
		// ��������
		if($PlaceList["Colosseum"])
			print("<li><a href=\"?menu=rank\">������(Colosseum)</a></li>");
		print("</ul>\n");
		print("</div>\n");
		print("<h4>�㳡</h4>");
		$this->TownBBS();
		print("</div>\n");
	}

//////////////////////////////////////////////////
//	��ͨ��1�В�ʾ��
	function TownBBS() {
		$file	= BBS_TOWN;
	?>
<form action="?town" method="post">
<input type="text" maxlength="60" name="message" class="text" style="width:300px"/>
<input type="submit" value="post" class="btn" style="width:100px" />
</form>
<?php 
		if(!file_exists($file))
			return false;
		$log	= file($file);
		if($_POST["message"] && strlen($_POST["message"]) < 121) {
			$_POST["message"]	= htmlspecialchars($_POST["message"],ENT_QUOTES);
			$_POST["message"]	= stripslashes($_POST["message"]);

			$name	= "<span class=\"bold\">{$this->name}</span>";
			$message	= $name." > ".$_POST["message"];
			if($this->UserColor)
				$message	= "<span style=\"color:{$this->UserColor}\">".$message."</span>";
			$message	.= " <span class=\"light\">(".date("Mj G:i").")</span>\n";
			array_unshift($log,$message);
			while(50 < count($log))
				array_pop($log);
			WriteFile($file,implode(null,$log));
		}
		foreach($log as $mes)
			print(nl2br($mes));
	}
//////////////////////////////////////////////////
	function SettingProcess() {
		if($_POST["NewName"]) {
			$NewName	= $_POST["NewName"];
			if(is_numeric(strpos($NewName,"\t"))) {
				ShowError('error1');
				return false;
			}
			$NewName	= trim($NewName);
			$NewName	= stripslashes($NewName);
			if (!$NewName) {
				ShowError('Name is blank.');
				return false;
			}
			$length	= strlen($NewName);
			if ( 0 == $length || 16 < $length) {
				ShowError('1 to 16 letters?');
				return false;
			}
			$userName	= userNameLoad();
			if(in_array($NewName,$userName)) {
				ShowError("�������ѱ�ʹ�á�","margin15");
				return false;
			}
			if(!$this->TakeMoney(NEW_NAME_COST)) {
				ShowError('money not enough');
				return false;
			}
			$OldName	= $this->name;
			$NewName	= htmlspecialchars($NewName,ENT_QUOTES);
			if($this->ChangeName($NewName)) {
				ShowResult("Name Changed ({$OldName} -> {$NewName})","margin15");
				//return false;
				userNameAdd($NewName);
				return true;
			} else {
				ShowError("?");//��ǰ��ͬ����
				return false;
			}
		}

		if($_POST["setting01"]) {
			if($_POST["record_battle_log"])
				$this->record_btl_log	= 1;
			else
				$this->record_btl_log	= false;

			if($_POST["no_JS_itemlist"])
				$this->no_JS_itemlist	= 1;
			else
				$this->no_JS_itemlist	= false;
		}
		if($_POST["color"]) {
			if(	strlen($_POST["color"]) != 6 &&
				!ereg("^[0369cf]{6}",$_POST["color"]))
				return "error 12072349";
			$this->UserColor	= $_POST["color"];
			ShowResult("Setting changed.","margin15");
			return true;
		}
	}
//////////////////////////////////////////////////
//	�O����ʾ����
	function SettingShow() {
		print('<div style="margin:15px">'."\n");
		if($this->record_btl_log) $record_btl_log	= " checked";
		if($this->no_JS_itemlist) $no_JS_itemlist	= " checked";
		?>
<h4>����</h4>
<form action="?setting" method="post">
<table><tbody>
<tr><td><input type="checkbox" name="record_battle_log" value="1" <?php print $record_btl_log?>></td><td>ս����¼</td></tr>
<tr><td><input type="checkbox" name="no_JS_itemlist" value="1" <?php print $no_JS_itemlist?>></td><td>�����б�ʹ��javascript</td></tr>
</tbody></table>
<!--<tr><td>None</td><td><input type="checkbox" name="none" value="1"></td></tr>-->
��ɫ: 
<SELECT class=bgcolor name=color> <OPTION style="COLOR: #ffffff" value=ffffff selected>SampleColor</OPTION> <OPTION style="COLOR: #ffffcc" value=ffffcc>SampleColor</OPTION> <OPTION style="COLOR: #ffff99" value=ffff99>SampleColor</OPTION> <OPTION style="COLOR: #ffff66" value=ffff66>SampleColor</OPTION> <OPTION style="COLOR: #ffff33" value=ffff33>SampleColor</OPTION> <OPTION style="COLOR: #ffff00" value=ffff00>SampleColor</OPTION> <OPTION style="COLOR: #ffccff" value=ffccff>SampleColor</OPTION> <OPTION style="COLOR: #ffcccc" value=ffcccc>SampleColor</OPTION> <OPTION style="COLOR: #ffcc99" value=ffcc99>SampleColor</OPTION> <OPTION style="COLOR: #ffcc66" value=ffcc66>SampleColor</OPTION> <OPTION style="COLOR: #ffcc33" value=ffcc33>SampleColor</OPTION> <OPTION style="COLOR: #ffcc00" value=ffcc00>SampleColor</OPTION> <OPTION style="COLOR: #ff99ff" value=ff99ff>SampleColor</OPTION> <OPTION style="COLOR: #ff99cc" value=ff99cc>SampleColor</OPTION> <OPTION style="COLOR: #ff9999" value=ff9999>SampleColor</OPTION> <OPTION style="COLOR: #ff9966" value=ff9966>SampleColor</OPTION> <OPTION style="COLOR: #ff9933" value=ff9933>SampleColor</OPTION> <OPTION style="COLOR: #ff9900" value=ff9900>SampleColor</OPTION> <OPTION style="COLOR: #ff66ff" value=ff66ff>SampleColor</OPTION> <OPTION style="COLOR: #ff66cc" value=ff66cc>SampleColor</OPTION> <OPTION style="COLOR: #ff6699" value=ff6699>SampleColor</OPTION> <OPTION style="COLOR: #ff6666" value=ff6666>SampleColor</OPTION> <OPTION style="COLOR: #ff6633" value=ff6633>SampleColor</OPTION> <OPTION style="COLOR: #ff6600" value=ff6600>SampleColor</OPTION> <OPTION style="COLOR: #ff33ff" value=ff33ff>SampleColor</OPTION> <OPTION style="COLOR: #ff33cc" value=ff33cc>SampleColor</OPTION> <OPTION style="COLOR: #ff3399" value=ff3399>SampleColor</OPTION> <OPTION style="COLOR: #ff3366" value=ff3366>SampleColor</OPTION> <OPTION style="COLOR: #ff3333" value=ff3333>SampleColor</OPTION> <OPTION style="COLOR: #ff3300" value=ff3300>SampleColor</OPTION> <OPTION style="COLOR: #ff00ff" value=ff00ff>SampleColor</OPTION> <OPTION style="COLOR: #ff00cc" value=ff00cc>SampleColor</OPTION> <OPTION style="COLOR: #ff0099" value=ff0099>SampleColor</OPTION> <OPTION style="COLOR: #ff0066" value=ff0066>SampleColor</OPTION> <OPTION style="COLOR: #ff0033" value=ff0033>SampleColor</OPTION> <OPTION style="COLOR: #ff0000" value=ff0000>SampleColor</OPTION> <OPTION style="COLOR: #ccffff" value=ccffff>SampleColor</OPTION> <OPTION style="COLOR: #ccffcc" value=ccffcc>SampleColor</OPTION> <OPTION style="COLOR: #ccff99" value=ccff99>SampleColor</OPTION> <OPTION style="COLOR: #ccff66" value=ccff66>SampleColor</OPTION> <OPTION style="COLOR: #ccff33" value=ccff33>SampleColor</OPTION> <OPTION style="COLOR: #ccff00" value=ccff00>SampleColor</OPTION> <OPTION style="COLOR: #ccccff" value=ccccff>SampleColor</OPTION> <OPTION style="COLOR: #cccccc" value=cccccc>SampleColor</OPTION> <OPTION style="COLOR: #cccc99" value=cccc99>SampleColor</OPTION> <OPTION style="COLOR: #cccc66" value=cccc66>SampleColor</OPTION> <OPTION style="COLOR: #cccc33" value=cccc33>SampleColor</OPTION> <OPTION style="COLOR: #cccc00" value=cccc00>SampleColor</OPTION> <OPTION style="COLOR: #cc99ff" value=cc99ff>SampleColor</OPTION> <OPTION style="COLOR: #cc99cc" value=cc99cc>SampleColor</OPTION> <OPTION style="COLOR: #cc9999" value=cc9999>SampleColor</OPTION> <OPTION style="COLOR: #cc9966" value=cc9966>SampleColor</OPTION> <OPTION style="COLOR: #cc9933" value=cc9933>SampleColor</OPTION> <OPTION style="COLOR: #cc9900" value=cc9900>SampleColor</OPTION> <OPTION style="COLOR: #cc66ff" value=cc66ff>SampleColor</OPTION> <OPTION style="COLOR: #cc66cc" value=cc66cc>SampleColor</OPTION> <OPTION style="COLOR: #cc6699" value=cc6699>SampleColor</OPTION> <OPTION style="COLOR: #cc6666" value=cc6666>SampleColor</OPTION> <OPTION style="COLOR: #cc6633" value=cc6633>SampleColor</OPTION> <OPTION style="COLOR: #cc6600" value=cc6600>SampleColor</OPTION> <OPTION style="COLOR: #cc33ff" value=cc33ff>SampleColor</OPTION> <OPTION style="COLOR: #cc33cc" value=cc33cc>SampleColor</OPTION> <OPTION style="COLOR: #cc3399" value=cc3399>SampleColor</OPTION> <OPTION style="COLOR: #cc3366" value=cc3366>SampleColor</OPTION> <OPTION style="COLOR: #cc3333" value=cc3333>SampleColor</OPTION> <OPTION style="COLOR: #cc3300" value=cc3300>SampleColor</OPTION> <OPTION style="COLOR: #cc00ff" value=cc00ff>SampleColor</OPTION> <OPTION style="COLOR: #cc00cc" value=cc00cc>SampleColor</OPTION> <OPTION style="COLOR: #cc0099" value=cc0099>SampleColor</OPTION> <OPTION style="COLOR: #cc0066" value=cc0066>SampleColor</OPTION> <OPTION style="COLOR: #cc0033" value=cc0033>SampleColor</OPTION> <OPTION style="COLOR: #cc0000" value=cc0000>SampleColor</OPTION> <OPTION style="COLOR: #99ffff" value=99ffff>SampleColor</OPTION> <OPTION style="COLOR: #99ffcc" value=99ffcc>SampleColor</OPTION> <OPTION style="COLOR: #99ff99" value=99ff99>SampleColor</OPTION> <OPTION style="COLOR: #99ff66" value=99ff66>SampleColor</OPTION> <OPTION style="COLOR: #99ff33" value=99ff33>SampleColor</OPTION> <OPTION style="COLOR: #99ff00" value=99ff00>SampleColor</OPTION> <OPTION style="COLOR: #99ccff" value=99ccff>SampleColor</OPTION> <OPTION style="COLOR: #99cccc" value=99cccc>SampleColor</OPTION> <OPTION style="COLOR: #99cc99" value=99cc99>SampleColor</OPTION> <OPTION style="COLOR: #99cc66" value=99cc66>SampleColor</OPTION> <OPTION style="COLOR: #99cc33" value=99cc33>SampleColor</OPTION> <OPTION style="COLOR: #99cc00" value=99cc00>SampleColor</OPTION> <OPTION style="COLOR: #9999ff" value=9999ff>SampleColor</OPTION> <OPTION style="COLOR: #9999cc" value=9999cc>SampleColor</OPTION> <OPTION style="COLOR: #999999" value=999999>SampleColor</OPTION> <OPTION style="COLOR: #999966" value=999966>SampleColor</OPTION> <OPTION style="COLOR: #999933" value=999933>SampleColor</OPTION> <OPTION style="COLOR: #999900" value=999900>SampleColor</OPTION> <OPTION style="COLOR: #9966ff" value=9966ff>SampleColor</OPTION> <OPTION style="COLOR: #9966cc" value=9966cc>SampleColor</OPTION> <OPTION style="COLOR: #996699" value=996699>SampleColor</OPTION> <OPTION style="COLOR: #996666" value=996666>SampleColor</OPTION> <OPTION style="COLOR: #996633" value=996633>SampleColor</OPTION> <OPTION style="COLOR: #996600" value=996600>SampleColor</OPTION> <OPTION style="COLOR: #9933ff" value=9933ff>SampleColor</OPTION> <OPTION style="COLOR: #9933cc" value=9933cc>SampleColor</OPTION> <OPTION style="COLOR: #993399" value=993399>SampleColor</OPTION> <OPTION style="COLOR: #993366" value=993366>SampleColor</OPTION> <OPTION style="COLOR: #993333" value=993333>SampleColor</OPTION> <OPTION style="COLOR: #993300" value=993300>SampleColor</OPTION> <OPTION style="COLOR: #9900ff" value=9900ff>SampleColor</OPTION> <OPTION style="COLOR: #9900cc" value=9900cc>SampleColor</OPTION> <OPTION style="COLOR: #990099" value=990099>SampleColor</OPTION> <OPTION style="COLOR: #990066" value=990066>SampleColor</OPTION> <OPTION style="COLOR: #990033" value=990033>SampleColor</OPTION> <OPTION style="COLOR: #990000" value=990000>SampleColor</OPTION> <OPTION style="COLOR: #66ffff" value=66ffff>SampleColor</OPTION> <OPTION style="COLOR: #66ffcc" value=66ffcc>SampleColor</OPTION> <OPTION style="COLOR: #66ff99" value=66ff99>SampleColor</OPTION> <OPTION style="COLOR: #66ff66" value=66ff66>SampleColor</OPTION> <OPTION style="COLOR: #66ff33" value=66ff33>SampleColor</OPTION> <OPTION style="COLOR: #66ff00" value=66ff00>SampleColor</OPTION> <OPTION style="COLOR: #66ccff" value=66ccff>SampleColor</OPTION> <OPTION style="COLOR: #66cccc" value=66cccc>SampleColor</OPTION> <OPTION style="COLOR: #66cc99" value=66cc99>SampleColor</OPTION> <OPTION style="COLOR: #66cc66" value=66cc66>SampleColor</OPTION> <OPTION style="COLOR: #66cc33" value=66cc33>SampleColor</OPTION> <OPTION style="COLOR: #66cc00" value=66cc00>SampleColor</OPTION> <OPTION style="COLOR: #6699ff" value=6699ff>SampleColor</OPTION> <OPTION style="COLOR: #6699cc" value=6699cc>SampleColor</OPTION> <OPTION style="COLOR: #669999" value=669999>SampleColor</OPTION> <OPTION style="COLOR: #669966" value=669966>SampleColor</OPTION> <OPTION style="COLOR: #669933" value=669933>SampleColor</OPTION> <OPTION style="COLOR: #669900" value=669900>SampleColor</OPTION> <OPTION style="COLOR: #6666ff" value=6666ff>SampleColor</OPTION> <OPTION style="COLOR: #6666cc" value=6666cc>SampleColor</OPTION> <OPTION style="COLOR: #666699" value=666699>SampleColor</OPTION> <OPTION style="COLOR: #666666" value=666666>SampleColor</OPTION> <OPTION style="COLOR: #666633" value=666633>SampleColor</OPTION> <OPTION style="COLOR: #666600" value=666600>SampleColor</OPTION> <OPTION style="COLOR: #6633ff" value=6633ff>SampleColor</OPTION> <OPTION style="COLOR: #6633cc" value=6633cc>SampleColor</OPTION> <OPTION style="COLOR: #663399" value=663399>SampleColor</OPTION> <OPTION style="COLOR: #663366" value=663366>SampleColor</OPTION> <OPTION style="COLOR: #663333" value=663333>SampleColor</OPTION> <OPTION style="COLOR: #663300" value=663300>SampleColor</OPTION> <OPTION style="COLOR: #6600ff" value=6600ff>SampleColor</OPTION> <OPTION style="COLOR: #6600cc" value=6600cc>SampleColor</OPTION> <OPTION style="COLOR: #660099" value=660099>SampleColor</OPTION> <OPTION style="COLOR: #660066" value=660066>SampleColor</OPTION> <OPTION style="COLOR: #660033" value=660033>SampleColor</OPTION> <OPTION style="COLOR: #660000" value=660000>SampleColor</OPTION> <OPTION style="COLOR: #33ffff" value=33ffff>SampleColor</OPTION> <OPTION style="COLOR: #33ffcc" value=33ffcc>SampleColor</OPTION> <OPTION style="COLOR: #33ff99" value=33ff99>SampleColor</OPTION> <OPTION style="COLOR: #33ff66" value=33ff66>SampleColor</OPTION> <OPTION style="COLOR: #33ff33" value=33ff33>SampleColor</OPTION> <OPTION style="COLOR: #33ff00" value=33ff00>SampleColor</OPTION> <OPTION style="COLOR: #33ccff" value=33ccff>SampleColor</OPTION> <OPTION style="COLOR: #33cccc" value=33cccc>SampleColor</OPTION> <OPTION style="COLOR: #33cc99" value=33cc99>SampleColor</OPTION> <OPTION style="COLOR: #33cc66" value=33cc66>SampleColor</OPTION> <OPTION style="COLOR: #33cc33" value=33cc33>SampleColor</OPTION> <OPTION style="COLOR: #33cc00" value=33cc00>SampleColor</OPTION> <OPTION style="COLOR: #3399ff" value=3399ff>SampleColor</OPTION> <OPTION style="COLOR: #3399cc" value=3399cc>SampleColor</OPTION> <OPTION style="COLOR: #339999" value=339999>SampleColor</OPTION> <OPTION style="COLOR: #339966" value=339966>SampleColor</OPTION> <OPTION style="COLOR: #339933" value=339933>SampleColor</OPTION> <OPTION style="COLOR: #339900" value=339900>SampleColor</OPTION> <OPTION style="COLOR: #3366ff" value=3366ff>SampleColor</OPTION> <OPTION style="COLOR: #3366cc" value=3366cc>SampleColor</OPTION> <OPTION style="COLOR: #336699" value=336699>SampleColor</OPTION> <OPTION style="COLOR: #336666" value=336666>SampleColor</OPTION> <OPTION style="COLOR: #336633" value=336633>SampleColor</OPTION> <OPTION style="COLOR: #336600" value=336600>SampleColor</OPTION> <OPTION style="COLOR: #3333ff" value=3333ff>SampleColor</OPTION> <OPTION style="COLOR: #3333cc" value=3333cc>SampleColor</OPTION> <OPTION style="COLOR: #333399" value=333399>SampleColor</OPTION> <OPTION style="COLOR: #333366" value=333366>SampleColor</OPTION> <OPTION style="COLOR: #333333" value=333333>SampleColor</OPTION> <OPTION style="COLOR: #333300" value=333300>SampleColor</OPTION> <OPTION style="COLOR: #3300ff" value=3300ff>SampleColor</OPTION> <OPTION style="COLOR: #3300cc" value=3300cc>SampleColor</OPTION> <OPTION style="COLOR: #330099" value=330099>SampleColor</OPTION> <OPTION style="COLOR: #330066" value=330066>SampleColor</OPTION> <OPTION style="COLOR: #330033" value=330033>SampleColor</OPTION> <OPTION style="COLOR: #330000" value=330000>SampleColor</OPTION> <OPTION style="COLOR: #00ffff" value=00ffff>SampleColor</OPTION> <OPTION style="COLOR: #00ffcc" value=00ffcc>SampleColor</OPTION> <OPTION style="COLOR: #00ff99" value=00ff99>SampleColor</OPTION> <OPTION style="COLOR: #00ff66" value=00ff66>SampleColor</OPTION> <OPTION style="COLOR: #00ff33" value=00ff33>SampleColor</OPTION> <OPTION style="COLOR: #00ff00" value=00ff00>SampleColor</OPTION> <OPTION style="COLOR: #00ccff" value=00ccff>SampleColor</OPTION> <OPTION style="COLOR: #00cccc" value=00cccc>SampleColor</OPTION> <OPTION style="COLOR: #00cc99" value=00cc99>SampleColor</OPTION> <OPTION style="COLOR: #00cc66" value=00cc66>SampleColor</OPTION> <OPTION style="COLOR: #00cc33" value=00cc33>SampleColor</OPTION> <OPTION style="COLOR: #00cc00" value=00cc00>SampleColor</OPTION> <OPTION style="COLOR: #0099ff" value=0099ff>SampleColor</OPTION> <OPTION style="COLOR: #0099cc" value=0099cc>SampleColor</OPTION> <OPTION style="COLOR: #009999" value=009999>SampleColor</OPTION> <OPTION style="COLOR: #009966" value=009966>SampleColor</OPTION> <OPTION style="COLOR: #009933" value=009933>SampleColor</OPTION> <OPTION style="COLOR: #009900" value=009900>SampleColor</OPTION> <OPTION style="COLOR: #0066ff" value=0066ff>SampleColor</OPTION> <OPTION style="COLOR: #0066cc" value=0066cc>SampleColor</OPTION> <OPTION style="COLOR: #006699" value=006699>SampleColor</OPTION> <OPTION style="COLOR: #006666" value=006666>SampleColor</OPTION> <OPTION style="COLOR: #006633" value=006633>SampleColor</OPTION> <OPTION style="COLOR: #006600" value=006600>SampleColor</OPTION> <OPTION style="COLOR: #0033ff" value=0033ff>SampleColor</OPTION> <OPTION style="COLOR: #0033cc" value=0033cc>SampleColor</OPTION> <OPTION style="COLOR: #003399" value=003399>SampleColor</OPTION> <OPTION style="COLOR: #003366" value=003366>SampleColor</OPTION> <OPTION style="COLOR: #003333" value=003333>SampleColor</OPTION> <OPTION style="COLOR: #003300" value=003300>SampleColor</OPTION> <OPTION style="COLOR: #0000ff" value=0000ff>SampleColor</OPTION> <OPTION style="COLOR: #0000cc" value=0000cc>SampleColor</OPTION> <OPTION style="COLOR: #000099" value=000099>SampleColor</OPTION> <OPTION style="COLOR: #000066" value=000066>SampleColor</OPTION> <OPTION style="COLOR: #000033" value=000033>SampleColor</OPTION> <OPTION style="COLOR: #000000" value=000000>SampleColor</OPTION></SELECT><br />
<input type="submit" class="btn" name="setting01" value="�޸�" style="width:100px">
<input type="hidden" name="setting01" value="1">
</form>
<h4>ע��</h4>
<form action="<?php print INDEX?>" method="post">
<input type="submit" class="btn" name="logout" value="ע��" style="width:100px">
</form>
<h4>���������</h4>
<form action="?setting" method="post">
�M�� : <?php print MoneyFormat(NEW_NAME_COST)?><br />
16���ַ�(ȫ��=2�ַ�)<br />
�µ����� : <input type="text" class="text" name="NewName" size="20">
<input type="submit" class="btn" value="���" style="width:100px">
</form>
<h4>���羡ͷ</h4>
<div class="u">����ɱ��</div>
<form action="?setting" method="post">
PassWord : <input type="text" class="text" name="deletepass" size="20">
<input type="submit" class="btn" name="delete" value="��Ҫ��ɱ��..." style="width:100px">
</form>
</div>
<?php 
		return $Result;
	}
////////// Show //////////////////////////////////////////////////////
/*
 * ShowCharStat
 * ShowHunt
 * ShowItem
 * ShowShop
 * ShowRank
 * ShowRecruit
 * ShowSetting
 */

//////////////////////////////////////////////////
//	���L�r���x�k�������Щ`��ӛ������
	function MemorizeParty() {
		if($_POST["memory_party"]) {
			//$temp	= $this->party_memo;//һ�r�Ĥ�ӛ��
			//$this->party_memo	= array();
			foreach($this->char as $key => $val) {//�����å����줿��ĥꥹ��
				if($_POST["char_".$key])
					//$this->party_memo[]	 = $key;
					$PartyMemo[]	= $key;
			}
			//if(5 < count($this->party_memo) )//5�����Ϥ��jĿ
			//	$this->party_memo	= $temp;
			if(0 < count($PartyMemo) && count($PartyMemo) < 6)
				$this->party_memo	= implode("<>",$PartyMemo);
		}
	}

//////////////////////////////////////////////////////////////////////


//////////////////////////////////////////////////
//	�����󤷤�����
	function LoginMain() {
		$this->ShowTutorial();
		$this->ShowMyCharacters();
		RegularControl($this->id);
	}
//////////////////////////////////////////////////
//	���奦�ȥꥢ��
	function ShowTutorial() {
		$last	= $this->last;
		$start	= substr($this->start,0,10);
		$term	= 60*60*1;
		if( ($last - $start) < $term) {
			?>
	<div style="margin:5px 15px">
	<a href="?tutorial">�̳�</a> - ս���Ļ���(��¼��һ��Сʱ����ʾ)
	</div>

<?php 
		}
	}

//////////////////////////////////////////////////
//	�Է֤Υ������ʾ����
	function ShowMyCharacters($array=NULL) {// $array �� ɫ���ܤ�ȡ��
		if(!$this->char) return false;
		$divide	= (count($this->char)<CHAR_ROW ? count($this->char) : CHAR_ROW);
		$width	= floor(100/$divide);//��������

		print('<table cellspacing="0" style="width:100%"><tbody><tr>');//���100%
		foreach($this->char as $val) {
			if( $i%CHAR_ROW==0 && $i != 0 )
				print("\t</tr><tr>\n");
			print("\t<td valign=\"bottom\" style=\"width:{$width}%\">");//��������ˏꤸ��%�Ǹ�����ָ�
			$val->ShowCharLink($array);
			print("</td>\n");
			$i++;
		}
		print("</tr></tbody></table>");
	}
//////////////////////////////////////////////////
//	�������M�ߤǱ�ʾ����
	function ShowCharacters($characters,$type=null,$checked=null) {
		if(!$characters) return false;
		$divide	= (count($characters)<CHAR_ROW ? count($characters) : CHAR_ROW);
		$width	= floor(100/$divide);//��������

		if($type == "CHECKBOX") {
print <<< HTML
<script type="text/javascript">
<!--
function toggleCheckBox(id) {
id0 = "box" + id;
\$("box" + id).checked = \$("box" + id).checked?false:true;
Element.toggleClassName("text"+id,'unselect');
}
// -->
</script>
HTML;
		}

		print('<table cellspacing="0" style="width:100%"><tbody><tr>');//���100%
		foreach($characters as $char) {
			if( $i%CHAR_ROW==0 && $i != 0 )
				print("\t</tr><tr>\n");
			print("\t<td valign=\"bottom\" style=\"width:{$width}%\">");//��������ˏꤸ��%�Ǹ�����ָ�

			/*-------------------*/
			switch(1) {
				case ($type === MONSTER):
					$char->ShowCharWithLand($checked); break;
				case ($type === CHECKBOX):
					if(!is_array($checked)) $checked = array();
					if(in_array($char->birth,$checked))
						$char->ShowCharRadio($char->birth," checked");
					else
						$char->ShowCharRadio($char->birth);
					break;
				default:
					$char->ShowCharLink();
			}

			print("</td>\n");
			$i++;
		}
		print("</tr></tbody></table>");
	}

//////////////////////////////////////////////////
//	�Է֤Υǩ`���ȥ��å��`������
	function DeleteMyData() {
		if($this->pass == $this->CryptPassword($_POST["deletepass"]) ) {
			$this->DeleteUser();
			$this->name	= NULL;
			$this->pass	= NULL;
			$this->id	= NULL;
			$this->islogin= false;
			unset($_SESSION["id"]);
			unset($_SESSION["pass"]);
			setcookie("NO","");
			$this->LoginForm();
			return true;
		}
	}

//////////////////////////////////////////////////
//	�����α�ʾ
	function Debug() {
		if(DEBUG)
			print("<pre>".print_r(get_object_vars($this),1)."</pre>");
	}

//////////////////////////////////////////////////
//	���å���������ʾ���롣
	function ShowSession() {
		echo "this->id:$this->id<br>";
		echo "this->pass:$this->pass<br>";
		echo "SES[id]:$_SESSION[id]<br>";
		echo "SES[pass]:$_SESSION[pass]<br>";
		echo "SES[pass]:".$this->CryptPassword($_SESSION[pass])."(crypted)<br>";
		echo "CK[NO]:$_COOKIE[NO]<br>";
		echo "SES[NO]:".session_id();
		dump($_COOKIE);
		dump($_SESSION);
	}

//////////////////////////////////////////////////
//	�����󤷤��r�g���O������
	function RenewLoginTime() {
		$this->login	= time();
	}

//////////////////////////////////////////////////
//	�����󤷤��Τ������Ƥ���Τ����������Ȥ����Τ���
	function CheckLogin() {
		//logout
		if(isset($_POST["logout"])) {
		//	$_SESSION["pass"]	= NULL;
		//	echo $_SESSION["pass"];
			unset($_SESSION["pass"]);
		//	session_destroy();
			return false;
		}

		//session
		$file=USER.$this->id."/".DATA;//data.dat
		if ($data = $this->LoadData()) {
			//echo "<div>$data[pass] == $this->pass</div>";
			if($this->pass == NULL)
				return false;
			if ($data["pass"] === $this->pass) {
				//������״�B
				$this->DataUpDate($data);
				$this->SetData($data);
				if(RECORD_IP)
					$this->SetIp($_SERVER['REMOTE_ADDR']);
				$this->RenewLoginTime();

				$pass	= ($_POST["pass"])?$_POST["pass"]:$_GET["pass"];
				if ($pass) {//���礦�ɽ�����󤹤�ʤ�
					$_SESSION["id"]	= $this->id;
					$_SESSION["pass"]	= $pass;
					setcookie("NO",session_id(),time()+COOKIE_EXPIRE);
				}

				$this->islogin	= true;//������״�B
				return true;
			} else
				return "Wrong password!";
		} else {
			if($_POST["id"])
				return "ID \"{$this->id}\" doesnt exists.";
		}
	}

//////////////////////////////////////////////////
//	$id ����h�g��id�Ȥ���ӛ�h����
	function RecordRegister($id) {
		$fp=fopen(REGISTER,"a");
		flock($fp,2);
		fputs($fp,"$id\n");
		fclose($fp);
	}

//////////////////////////////////////////////////
//	pass �� id ���O������
	function Set_ID_PASS() {
		$id	= ($_POST["id"])?$_POST["id"]:$_GET["id"];
		//if($_POST["id"]) {
		if($id) {
				$this->id	= $id;//$_POST["id"];
			// ��������I�����r����
			if (is_registered($_POST["id"])) {
				$_SESSION["id"]	= $this->id;
			}
		} else if($_SESSION["id"])
			$this->id	= $_SESSION["id"];

		$pass	= ($_POST["pass"])?$_POST["pass"]:$_GET["pass"];
		//if($_POST["pass"])
		if($pass)
			$this->pass	= $pass;//$_POST["pass"];
		else if($_SESSION["pass"])
			$this->pass	= $_SESSION["pass"];

		if($this->pass)
			$this->pass	= $this->CryptPassword($this->pass);
	}

//////////////////////////////////////////////////
//	���椵��Ƥ��륻�å���󷬺Ť������롣
	function SessionSwitch() {
		// session����Εr�g(?)
		// how about "session_set_cookie_params()"?
		session_cache_expire(COOKIE_EXPIRE/60);
		if($_COOKIE["NO"])//���å��`�˱��椷�Ƥ��륻�å����ID�Υ��å�������ӳ���
			session_id($_COOKIE["NO"]);

		session_start();
		if(!SESSION_SWITCH)//switch���ʤ��ʤ餳���ǽK��
			return false;
		//print_r($_SESSION);
		//dump($_SESSION);
		$OldID	= session_id();
		$temp	= serialize($_SESSION);

		session_regenerate_id();
		$NewID	= session_id();
		setcookie("NO",$NewID,time()+COOKIE_EXPIRE);
		$_COOKIE["NO"]=$NewID;

		session_id($OldID);
		session_start();

		if($_SESSION):
		//	session_destroy();//Sleipnir���Ȥ�������...?(�����)
		//	unset($_SESSION);//���ä��ϴ��ɷ�(��äѤꤳ����jĿ����)(������)
			//�Y��,���å�����foreach�ǥ�`�פ���1���Ť�unset(2007/9/14 ������)
			foreach($_SESSION as $key => $val)
				unset($_SESSION["$key"]);
		endif;

		session_id($NewID);
		session_start();
		$_SESSION	= unserialize($temp);
	}

//////////////////////////////////////////////////
//	�������줿����ͤˤϤޤ뤫�ж�
//	�� ��Ҏ�ǩ`�������ɡ�

	function MakeNewData() {
		// ���h�������޽�Έ���
		if(MAX_USERS <= count(glob(USER."*")))
			return array(false,"Maximum users.<br />�Ѵﵽ����û�������");
		if(isset($_POST["Newid"]))
			trim($_POST["Newid"]);
		if(empty($_POST["Newid"]))
			return array(false,"Enter ID.");

		if(!ereg("[0-9a-zA-Z]{4,16}",$_POST["Newid"])||
			ereg("[^0-9a-zA-Z]+",$_POST["Newid"]))//��Ҏ��F
			return array(false,"Bad ID");

		if(strlen($_POST["Newid"]) < 4 || 16 < strlen($_POST["Newid"]))//��������
			return array(false,"Bad ID");

		if(is_registered($_POST["Newid"]))
			return array(false,"This ID has been already used.");

		$file = USER.$_POST["Newid"]."/".DATA;
		// PASS
		//if(isset($_POST["pass1"]))
		//	trim($_POST["pass1"]);
		if(empty($_POST["pass1"]) || empty($_POST["pass2"]))
			return array(false,"Enter both Password.");

		if(!ereg("[0-9a-zA-Z]{4,16}",$_POST["pass1"]) || ereg("[^0-9a-zA-Z]+",$_POST["pass1"]))
			return array(false,"Bad Password 1");
		if(strlen($_POST["pass1"]) < 4 || 16 < strlen($_POST["pass1"]))//��������
			return array(false,"Bad Password 1");
		if(!ereg("[0-9a-zA-Z]{4,16}",$_POST["pass2"]) || ereg("[^0-9a-zA-Z]+",$_POST["pass2"]))
			return array(false,"Bad Password 2");
		if(strlen($_POST["pass2"]) < 4 || 16 < strlen($_POST["pass2"]))//��������
			return array(false,"Bad Password 2");

		if($_POST["pass1"] !== $_POST["pass2"])
			return array(false,"Password dismatch.");

		$pass = $this->CryptPassword($_POST["pass1"]);
		// MAKE
		if(!file_exists($file)){
			mkdir(USER.$_POST["Newid"], 0705);
			$this->RecordRegister($_POST["Newid"]);//IDӛ�h
			$fp=fopen("$file","w");
			flock($fp,LOCK_EX);
				$now	= time();
				fputs($fp,"id=$_POST[Newid]\n");
				fputs($fp,"pass=$pass\n");
				fputs($fp,"last=".$now."\n");
				fputs($fp,"login=".$now."\n");
				fputs($fp,"start=".$now.substr(microtime(),2,6)."\n");
				fputs($fp,"money=".START_MONEY."\n");
				fputs($fp,"time=".START_TIME."\n");
				fputs($fp,"record_btl_log=1\n");
			fclose($fp);
			//print("ID:$_POST[Newid] success.<BR>");
			$_SESSION["id"]=$_POST["Newid"];
			setcookie("NO",session_id(),time()+COOKIE_EXPIRE);
			$success	= "<div class=\"recover\">ID : $_POST[Newid] ע��ɹ�. ���¼��</div>";
			return array(true,$success);//����...
		}
	}

//////////////////////////////////////////////////
//	��ҎID�����äΥե��`��
	function NewForm($error=NULL) {
		if(MAX_USERS <= count(glob(USER."*"))) {
			?>

	<div style="margin:15px">
	Maximum users.<br />
	�û����Ѵﵽ���
	</div>
<?php 
			return false;
		}
		$idset=($_POST["Newid"]?" value=$_POST[Newid]":NULL);
		?>
	<div style="margin:15px">
	<?php print ShowError($error);?>
	<h4>ע��!</h4>
	<form action="<?php print INDEX?>" method="post">

	<table><tbody>
	<tr><td colspan="2">ID & PASS must be 4 to 16 letters.<br />letters allowed a-z,A-Z,0-9<br />
	ID �� PASS�� 4-16 �������ڡ����Ӣ���֡�</td></tr>
	<tr><td><div style="text-align:right">ID:</div></td>
	<td><input type="text" maxlength="16" class="text" name="Newid" style="width:240px"<?php print $idset?>></td></tr>
	<tr><td colspan="2"><br />Password,Re-enter.<br />PASS �Լ������� ȷ���á�</td></tr>
	<tr><td><div style="text-align:right">PASS:</div></td>
	<td><input type="password" maxlength="16" class="text" name="pass1" style="width:240px"></td></tr>

	<tr><td></td>
	<td><input type="password" maxlength="16" class="text" name="pass2" style="width:240px">(verify)</td></tr>

	<tr><td></td><td><input type="submit" class="btn" name="Make" value="ȷ��" style="width:160px"></td></tr>

	</tbody></table>
	</form>
	</div>
<?php 
	}
	function LoginForm($message = NULL) {
		?>
<div style="width:730px;">
<!-- ������ -->
<div style="width:350px;float:right">
<h4 style="width:350px">��¼</h4>
<?php print $message?>
<form action="<?php print INDEX?>" method="post" style="padding-left:20px">
<table><tbody>
<tr>
<td><div style="text-align:right">ID:</div></td>
<td><input type="text" maxlength="16" class="text" name="id" style="width:160px"<?php print $_SESSION["id"]?" value=\"$_SESSION[id]\"":NULL?>></td>
</tr>
<tr>
<td><div style="text-align:right">PASS:</div></td>
<td><input type="password" maxlength="16" class="text" name="pass" style="width:160px"></td>
</tr>
<tr><td></td><td>
<input type="submit" class="btn" name="Login" value="��¼" style="width:80px"> 
<a href="?newgame">�����?</a>
</td></tr>
</tbody></table>
</form>

<h4 style="width:350px">���а�</h4>
<?php 
	include_once(CLASS_RANKING);
	$Rank	= new Ranking();
	$Rank->ShowRanking(0,4);
	?>
</div>
<!-- � -->
<div style="width:350px;padding:5px;float:left;">
<div style="width:350px;text-align:center">
<img src="./image/top01.gif" style="margin-bottom:20px" />
</div>
<div style="margin-left:20px">
<DIV class=u>�⵽����ʲô��Ϸ?</DIV>
<UL>
<LI>��Ϸ��Ŀ���ǵõ���һ��<BR>���ұ���ס��һ��λ�á� 
<LI>��Ȼû��ð�յ�Ҫ�ء�<BR>���е���µ�ս��ϵͳ�� </LI></UL>
<DIV class=u>ս���ĸо���ʲô?</DIV>
<UL>
<LI>5�˵����ﹹ�ɶ��� �� 
<LI>��������ֲ�ͬģʽ��<BR>����ս����״����ʹ�ü��ܡ� 
<LI><A class=a0 href="?log">���</A>���Ի���ս����¼�� </LI></UL></DIV></DIV>

<div class="c-both"></div>
</div>

<!-- -------------------------------------------------------- -->

<div style="margin:15px">
<h4>��ʾ</h4>
�û���: <?php print UserAmount()?> / <?php print MAX_USERS?><br />
<?php 
	$Abandon	= ABANDONED;
	print(floor($Abandon/(60*60*24))."��������û�仯�Ļ����ݽ���ʧ��");
print("</div>\n");
	}

//////////////////////////////////////////////////
//	�ϲ��˱�ʾ������˥�`��
//	�����󤷤Ƥ����äȤ����Ǥʤ��ˡ�
	function MyMenu() {
		if($this->name && $this->islogin) { // �����󤷤Ƥ�����
			print('<div id="menu">'."\n");
			//print('<span class="divide"></span>');//���Ф�
			print('<a href="'.INDEX.'">��ҳ</a><span class="divide"></span>');
			print('<a href="?hunt">����</a><span class="divide"></span>');
			print('<a href="?item">����</a><span class="divide"></span>');
			print('<a href="?town">����</a><span class="divide"></span>');
			print('<a href="?setting">����</a><span class="divide"></span>');
			print('<a href="?log">��¼</a><span class="divide"></span>');
			if(BBS_OUT)
				print('<a href="'.BBS_OUT.'" target="_balnk">BBS</a><span class="divide"></span>'."\n");
			print('</div><div id="menu2">'."\n");
				?>
	<div style="width:100%">
	<div style="width:30%;float:left"><?php print $this->name?></div>
	<div style="width:60%;float:right">
	<div style="width:40%;float:left"><span class="bold">�ʽ�</span> : <?php print MoneyFormat($this->money)?></div>
	<div style="width:40%;float:right"><span class="bold">ʱ��</span> : <?php print floor($this->time)?>/<?php print MAX_TIME?></div>
	</div>
	<div class="c-both"></div>
	</div>
<?php 
			print('</div>');
		} else if(!$this->name && $this->islogin) {// ���إ��������
			print('<div id="menu">');
			print("First login. Thankyou for the entry.");
			print('</div><div id="menu2">');
			print("fill the blanks. ���ɣ�����д��");
			print('</div>');
		} else { //// ��������״�B���ˡ������äα�ʾ
			print('<div id="menu">');
			print('<a href="'.INDEX.'">��ҳ</a><span class="divide"></span>'."\n");
			print('<a href="?newgame">��ע��</a><span class="divide"></span>'."\n");
			print('<a href="?manual">������ֲ�</a><span class="divide"></span>'."\n");
			print('<a href="?gamedata=job">��Ϸ����</a><span class="divide"></span>'."\n");
			print('<a href="?log">ս����¼</a><span class="divide"></span>'."\n");
			if(BBS_OUT)
			print('<a href="'.BBS_OUT.'" target="_balnk">BBS</a><span class="divide"></span>'."\n");			
			print('</div><div id="menu2">');
			print("��ӭ���� [ ".TITLE." ]");
			print('</div>');
		}
	}

//////////////////////////////////////////////////
//	HTML�_ʼ����
	function Head() {
		?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<?php $this->HtmlScript();?>
<title><?php print TITLE?></title>
</head>
<body><a name="top"></a>
<div id="main_frame">
<div id="title"><img src="./image/title03.gif"></div>
<?php $this->MyMenu();?><div id="contents">
<?php 
	}

//////////////////////////////////////////////////
//	�������륷�`�ȤȤ���
	function HtmlScript() {
		?>
<meta http-equiv="Content-Type" content="text/html; charset=GBK">
<link rel="stylesheet" href="./basis.css" type="text/css">
<link rel="stylesheet" href="./style.css" type="text/css">
<script type="text/javascript" src="prototype.js"></script>
<?php 
	}

//////////////////////////////////////////////////
//	HTML�K�˲���
	function Foot() {
		?>
</div>
<div style="clear: both;"></div>
<div id="foot">
<a href="?update">UpDate</a> - 
<?php 
	if(BBS_BOTTOM_TOGGLE)
		print('<a href="'.BBS_OUT.'" target="_blank">BBS</a> - '."\n");
		?>
<a href="?manual">�ֲ�</a> - 
<a href="?tutorial">��ѧ</a> - 
<a href="?gamedata=job">��Ϸ����</a> - 
<a href="#top">Top</a><br>
Copy Right <a href="http://tekito.kanichat.com/">Tekito</a> 2007-2008.<br>
���� By <a href="http://www.firingsquad.com.cn/">FiringSquad������</a> 2006-2008.<br>
</div>
</div>
</body>
</html>
<?php 
	}

//////////////////////////////////////////////////
//	���إ������äΥե��`��
	function FirstLogin() {
		// ����:�O���g��=false / ���O��=true
		if ($this->name)
			return false;

		do {
			if (!$_POST["Done"])
				break;
			if(is_numeric(strpos($_POST["name"],"\t"))) {
				$error	= 'error1';
				break;
			}
			if(is_numeric(strpos($_POST["name"],"\n"))) {
				$error	= 'error';
				break;
			}
			$_POST["name"]	= trim($_POST["name"]);
			$_POST["name"]	= stripslashes($_POST["name"]);
			if (!$_POST["name"]) {
				$error	= 'Name is blank.';
				break;
			}
			$length	= strlen($_POST["name"]);
			if ( 0 == $length || 16 < $length) {
				$error	= '1 to 16 letters?';
				break;
			}
			$userName	= userNameLoad();
			if(in_array($_POST["name"],$userName)) {
				$error	= '�������ѱ�ʹ�á�';
				break;
			}
			// ����Υ�������ǰ
			$_POST["first_name"]	= trim($_POST["first_name"]);
			$_POST["first_name"]	= stripslashes($_POST["first_name"]);
			if(is_numeric(strpos($_POST["first_name"],"\t"))) {
				$error	= 'error';
				break;
			}
			if(is_numeric(strpos($_POST["first_name"],"\n"))) {
				$error	= 'error';
				break;
			}
			if (!$_POST["first_name"]) {
				$error	= 'Character name is blank.';
				break;
			}
			$length	= strlen($_POST["first_name"]);
			if ( 0 == $length || 16 < $length) {
				$error	= '1 to 16 letters?';
				break;
			}
			if(!$_POST["fjob"]) {
				$error	= 'Select characters job.';
				break;
			}
			$_POST["name"]	= htmlspecialchars($_POST["name"],ENT_QUOTES);
			$_POST["first_name"]	= htmlspecialchars($_POST["first_name"],ENT_QUOTES);

			$this->name	= $_POST["name"];
			userNameAdd($this->name);
			$this->SaveData();
			switch($_POST["fjob"]){
				case "1":
					$job = 1; $gend = 0; break;
				case "2":
					$job = 1; $gend = 1; break;
				case "3":
					$job = 2; $gend = 0; break;
				default:
					$job = 2; $gend = 1;
			}
			include(DATA_BASE_CHAR);
			$char	= new char();
			$char->SetCharData(array_merge(BaseCharStatus($job),array("name"=>$_POST[first_name],"gender"=>"$gend")));
			$char->SaveCharData($this->id);
			return false;
		}while(0);

		include(DATA_BASE_CHAR);
		$war_male	= new char();
		$war_male->SetCharData(array_merge(BaseCharStatus("1"),array("gender"=>"0")));
		$war_female	= new char();
		$war_female->SetCharData(array_merge(BaseCharStatus("1"),array("gender"=>"1")));
		$sor_male	= new char();
		$sor_male->SetCharData(array_merge(BaseCharStatus("2"),array("gender"=>"0")));
		$sor_female	= new char();
		$sor_female->SetCharData(array_merge(BaseCharStatus("2"),array("gender"=>"1")));

		?>
	<form action="<?php print INDEX?>" method="post" style="margin:15px">
<?php ShowError($error);?>
	<h4>Name of Team</h4>
	<p>Decide the Name of the team.<br />
	It should be more than 1 and less than 16 letters.<br />
	Japanese characters count as 2 letters.</p>
	<p>1-16�ַ��Ķ�������<br /></p>
	<div class="bold u">TeamName</div>
	<input class="text" style="width:160px" maxlength="16" name="name"
<?php print($_POST["name"]?"value=\"$_POST[name]\"":"")?>>
	<h4>First Character</h4>
	<p>Decide the name of Your First Charactor.<br>
	more than 1 and less than 16 letters.</p>
	<p>��һ����������ơ�</p>
	<div class="bold u">CharacterName</div>
	<input class="text" type="text" name="first_name" maxlength="16" style="width:160px;margin-bottom:10px">
	<table cellspacing="0" style="width:400px"><tbody>
	<tr><td class="td1" valign="bottom"><div style="text-align:center"><?php print $war_male->ShowImage()?><br><input type="radio" name="fjob" value="1" style="margin:3px"></div></td>
	<td class="td1" valign="bottom"><div style="text-align:center"><?php print $war_female->ShowImage()?><br><input type="radio" name="fjob" value="2" style="margin:3px"></div></td>
	<td class="td1" valign="bottom"><div style="text-align:center"><?php print $sor_male->ShowImage()?><br><input type="radio" name="fjob" value="3" style="margin:3px"></div></td>
	<td class="td1" valign="bottom"><div style="text-align:center"><?php print $sor_female->ShowImage()?><br><input type="radio" name="fjob" value="4" style="margin:3px"></div></td></tr>
	<tr><td class="td2"><div style="text-align:center">male</div></td><td class="td3"><div style="text-align:center">female</div></td>
	<td class="td2"><div style="text-align:center">male</div></td><td class="td3"><div style="text-align:center">female</div></td></tr>
	<tr><td colspan="2" class="td4"><div style="text-align:center">Warrior</div></td><td colspan="2" class="td4"><div style="text-align:center">Socerer</div></td></tr>
	</tbody></table>
	<p>Choose your first character's job & Gender.</p>
	<p>����������Ա���ְҵ</p>
	<input class="btn" style="width:160px" type="submit" value="Done" name="Done">
	<input type="hidden" value="1" name="Done">
	<input class="btn" style="width:160px" type="submit" value="logout" name="logout"></form>
<?php 
			return true;
	}
//////////////////////////////////////////////////
//	��ͨ��1�В�ʾ��
	function bbs01() {
		if(!BBS_BOTTOM_TOGGLE)
			return false;
		$file	= BBS_BOTTOM;
	?>
<div style="margin:15px">
<h4>one line bbs</h4>
���󱨸�������������Ŀ�������
<form action="?bbs" method="post">
<input type="text" maxlength="60" name="message" class="text" style="width:300px"/>
<input type="submit" value="post" class="btn" style="width:100px" />
</form>
<?php 
		if(!file_exists($file))
			return false;
		$log	= file($file);
		if($_POST["message"] && strlen($_POST["message"]) < 121) {
			$_POST["message"]	= htmlspecialchars($_POST["message"],ENT_QUOTES);
			$_POST["message"]	= stripslashes($_POST["message"]);

			$name	= ($this->name ? "<span class=\"bold\">{$this->name}</span>":"����");
			$message	= $name." > ".$_POST["message"];
			if($this->UserColor)
				$message	= "<span style=\"color:{$this->UserColor}\">".$message."</span>";
			$message	.= " <span class=\"light\">(".date("Mj G:i").")</span>\n";
			array_unshift($log,$message);
			while(150 < count($log))// ������������
				array_pop($log);
			WriteFile($file,implode(null,$log));
		}
		foreach($log as $mes)
			print(nl2br($mes));
		print('</div>');
	}
//end of class
//////////////////////////////////////////////////////////////////////
}
?>
