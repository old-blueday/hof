<?php

class Ranking {

	var $fp;

	var $Ranking	= array();
	var $UserName;
	var $UserRecord;

//////////////////////////////////////////////
// �ե����뤫���i���z��ǥ�󥭥󥰤����Фˤ���
/*

	$this->Ranking[0][0]= *********;// ��λ

	$this->Ranking[1][0]= *********;// ͬһ 2λ
	$this->Ranking[1][1]= *********;

	$this->Ranking[2][0]= *********;// ͬһ 3λ
	$this->Ranking[2][1]= *********;
	$this->Ranking[2][2]= *********;

	$this->Ranking[3][0]= *********;// ͬһ 4λ
	$this->Ranking[3][1]= *********;
	$this->Ranking[3][2]= *********;
	$this->Ranking[3][3]= *********;

	...........

*/
	function Ranking() {
		$file	= RANKING;
		if(!file_exists($file)) return 0;
		$this->fp=FileLock($file);
		$Place	= 0;
		while($line = fgets($this->fp) ) {
			$line	= trim($line);
			if($line == "") continue;
			if(count($this->Ranking[$Place]) === $this->SamePlaceAmount($Place))
				$Place++;
			$this->Ranking[$Place][]	= $line;
		}
		if(!$this->Ranking) return 0;
		foreach($this->Ranking as $Rank => $SamePlaces) {
			if(!is_array($SamePlaces))
				continue;
			foreach($SamePlaces as $key => $val) {
				$list	= explode("<>", $val);
				$this->Ranking["$Rank"]["$key"]	= array();
				$this->Ranking["$Rank"]["$key"]["id"]	= $list["0"];
			}
		}
	}
//////////////////////////////////////////////
// ��󥭥󥰑餹�롣�餦��
	function Challenge(&$user) {
		// ��󥭥󥰤��o���Ȥ�(1λ�ˤʤ�)
		if(!$this->Ranking) {
			$this->JoinRanking($user->id);
			$this->SaveRanking();
			print("Rank starts.");
			//return array($message,true);
			return false;
		}
		//�Է֤��λ
		$MyRank	= $this->SearchID($user->id);

		// 1λ�Έ��ϡ�
		if($MyRank["0"] === 0) {
			SHowError("��һ����������ս.");
			//return array($message,true);
			return false;
		}

		// �Է֤������ʤ� ////////////////////////////////////
		if(!$MyRank)
		{
			$this->JoinRanking($user->id);//�Է֤�����λ�ˤ��롣
			$MyPlace	= count($this->Ranking) - 1;//�Է֤Υ��(����λ)
			$RivalPlace	= (int)($MyPlace - 1);

			// ���֤���λ�ʤΤ��ɤ���
			if($RivalPlace === 0)
				$DefendMatch	= true;
			else
				$DefendMatch	= false;

			//$MyID	= $id;

			//�Է֤��1���Ϥ��ˤ����֡�
			$RivalRankKey	= array_rand($this->Ranking[$RivalPlace]);
			$RivalID	= $this->Ranking[$RivalPlace][$RivalRankKey]["id"];//���餹�����֤�ID
			$Rival	= new user($RivalID);

			/*
			dump($this->Ranking);
			dump($RivalID);
			dump($MyID);
			dump($MyRank);//����`�Ǥ����B����
			return 0;
			*/

			$Result	= $this->RankBattle($user,$Rival,$MyPlace,$RivalPlace);
			$Return	= $this->ProcessByResult($Result,&$user,&$Rival,$DefendMatch);
			
			return $Return;
			// �����ʤ��λ����
			//if($message == "Battle" && $result === 0) {
			//	$this->ChangePlace($user,$Rival);
			//}

			//$this->SaveRanking();
			//return array($message,$result);
		}

		// 2λ-����λ���ˤ΄I��////////////////////////////////
		if($MyRank) {
			$RivalPlace	= (int)($MyRank["0"] - 1);//�Է֤���λ��1���Ϥ��ˡ�

			// ���֤���λ�ʤΤ��ɤ���
			if($RivalPlace === 0)
				$DefendMatch	= true;
			else
				$DefendMatch	= false;

			//�Է֤��1���Ϥ��ˤ�����
			$RivalRankKey	= array_rand($this->Ranking[$RivalPlace]);
			$RivalID	= $this->Ranking[$RivalPlace][$RivalRankKey]["id"];
			$Rival	= new user($RivalID);
			//$MyID		= $this->Ranking[$MyRank["0"]][$MyRank["1"]]["id"];
			//$MyID		= $id;
			//list($message,$result)	= $this->RankBattle($MyID,$RivalID);
			$Result	= $this->RankBattle($user,$Rival,$MyRank["0"],$RivalPlace);
			$Return	= $this->ProcessByResult($Result,&$user,&$Rival,$DefendMatch);
			
			return $Return;
			//if($message != "Battle")
			//	return array($message,$result);

			// ���L���ФäƄ����ʤ��λ����
			/*
			if($message == "Battle" && $result === 0) {
				$this->ChangePlace($MyID,$RivalID);
				//dump($this->Ranking);
				$this->SaveRanking();
			}
			return array($message,$result);
			*/
		}
	}

//////////////////////////////////////////////
// ��碌��
	function RankBattle(&$user,&$Rival,$UserPlace,$RivalPlace) {

		$UserPlace	= "[".($UserPlace+1)."λ]";
		$RivalPlace	= "[".($RivalPlace+1)."λ]";

		/*
			�� ���֤Υ�`�����夬�Ȥ˴��ڤ��ʤ����Ϥ΄I��
			��������Ȥ������I���줿�r�˥�󥭥󥰤����������褦�ˤ�������
			�������ʤ�����`���⤷��ʤ���
		*/
		if($Rival->is_exist() == false) {
			ShowError("���ֲ�����(��ս��ʤ)");
			$this->DeleteRank($DefendID);
			$this->SaveRanking();
			//return array(true);
			return "DEFENDER_NO_ID";
		}

		// �������Υ�󥭥��äΥѩ`�ƥ��`���i���z��
		$Party_Challenger	= $user->RankParty();
		$Party_Defender		= $Rival->RankParty();


		// ����åѩ`�ƥ��`������ޤ��󣡣���
		if($Party_Challenger === false) {
			ShowError("�餦���Щ`�����ޤ��󣨣�����");
			return "CHALLENGER_NO_PARTY";
		}

		// ����åѩ`�ƥ��`������ޤ��󣡣���
		if($Party_Defender === false) {
			//$defender->RankRecord(0,"DEFEND",$DefendMatch);
			//$defender->SaveData();
			ShowError($Rival->name." ��ս�����ﻹδ����<br />(��ս��ʤ)");
			return "DEFENDER_NO_PARTY";//��ս��ʤ�Ȥ���
		}

		//dump($Party_Challenger);
		//dump($Party_Defender);
		include(CLASS_BATTLE);
		$battle	= new battle($Party_Challenger,$Party_Defender);
		$battle->SetBackGround("colosseum");
		$battle->SetResultType(1);// �Q�ŤĤ��ʤ����Ϥ������ߤ����ǛQ���褦�ˤ���
		$battle->SetTeamName($user->name.$UserPlace,$Rival->name.$RivalPlace);
		$battle->Process();//���L�_ʼ
		$battle->RecordLog("RANK");
		$Result	= $battle->ReturnBattleResult();// ���L�Y��

		// ���L���ܤ������ä��Ȥγɿ��Ϥ����ǉ䤨�롣
		//$defender->RankRecord($Result,"DEFEND",$DefendMatch);
		//$defender->SaveData();

		//return array("Battle",$Result);
		if($Result === TEAM_0) {
			return "CHALLENGER_WIN";
		} else if ($Result === TEAM_1) {
			return "DEFENDER_WIN";
		} else if ($Result === DRAW) {
			return "DRAW_GAME";
		} else {
			return "DRAW_GAME";//(����`)�趨�Ǥϳ��ʤ�����`(�ر���)
		}
	}
//////////////////////////////////////////////////
//	�Y���ˤ�äƄI���䤨��
	function ProcessByResult($Result,&$user,&$Rival,$DefendMatch) {
		switch($Result) {

			// �ܤ����Ȥ�ID�����ڤ��ʤ�
			case "DEFENDER_NO_ID":
				$this->ChangePlace($user->id,$Rival->id);
				$this->DeleteRank($Rival->id);
				$this->SaveRanking();
				return false;
				break;

			// �����PT�o��
			case "CHALLENGER_NO_PARTY":
				return false;
				break;

			// �ܤ�����PT�o��
			case "DEFENDER_NO_PARTY":
				$this->ChangePlace($user->id,$Rival->id);
				$this->SaveRanking();
				//$user->RankRecord(0,"CHALLENGER",$DefendMatch);
				$user->SetRankBattleTime(time() + RANK_BATTLE_NEXT_WIN);
				$Rival->RankRecord(0,"DEFEND",$DefendMatch);
				$Rival->SaveData();
				return true;
				break;

			// �����߄٤�
			case "CHALLENGER_WIN":
				$this->ChangePlace($user->id,$Rival->id);
				$this->SaveRanking();
				$user->RankRecord(0,"CHALLENGER",$DefendMatch);
				$user->SetRankBattleTime(time() + RANK_BATTLE_NEXT_WIN);
				$Rival->RankRecord(0,"DEFEND",$DefendMatch);
				$Rival->SaveData();
				return "BATTLE";
				break;

			// �ܤ����Ȅ٤�
			case "DEFENDER_WIN":
				//$this->SaveRanking();
				$user->RankRecord(1,"CHALLENGER",$DefendMatch);
				$user->SetRankBattleTime(time() + RANK_BATTLE_NEXT_LOSE);
				$Rival->RankRecord(1,"DEFEND",$DefendMatch);
				$Rival->SaveData();
				return "BATTLE";
				break;

			// ���֤�
			case "DRAW_GAME":
				//$this->SaveRanking();
				$user->RankRecord("d","CHALLENGER",$DefendMatch);
				$user->SetRankBattleTime(time() + RANK_BATTLE_NEXT_LOSE);
				$Rival->RankRecord("d","DEFEND",$DefendMatch);
				$Rival->SaveData();
				return "BATTLE";
				break;
			default:
				return true;
				break;
		}
	}
//////////////////////////////////////////////////
//	�������λ �� ͬ���λ������
	function SamePlaceAmount($Place) {
		switch(true) {
			case ($Place == 0): return 1;//1λ
			case ($Place == 1): return 2;//2λ
			case ($Place == 2): return 3;//3λ
			case (2 < $Place):
				return 3;
		}
	}
//////////////////////////////////////////////
// ��󥭥󥰤�����λ�˲μӤ�����
	function JoinRanking($id) {
		$last	= count($this->Ranking) - 1;
		// ��󥭥󥰤����ڤ��ʤ�����
		if(!$this->Ranking) {
			$this->Ranking["0"]["0"]["id"]	= $id;
		// ����λ���λ�����T���`�Щ`�ˤʤ����
		} else if(count($this->Ranking[$last]) == $this->SamePlaceAmount($last)) {
			$this->Ranking[$last+1]["0"]["id"]	= $id;
		// �ʤ�ʤ�����
		} else {
			$this->Ranking[$last][]["id"]	= $id;
		}
	}
//////////////////////////////////////////////////
// ��󥭥󥰤�������
	function DeleteRank($id) {
		$place	= $this->SearchID($id);
		if($place === false) return false;//����ʧ��
		unset($this->Ranking[$place[0]][$place[1]]);
		return true;//�����ɹ�
	}
//////////////////////////////////////////////////
// ��󥭥󥰤򱣴椹��
	function SaveRanking() {
		foreach($this->Ranking as $rank => $val) {
			foreach($val as $key => $val2) {
				$ranking	.= $val2["id"]."\n";
			}
		}

		WriteFileFP($this->fp,$ranking);
		$this->fpclose();
	}
//////////////////////////////////////////////////
//	
	function fpclose() {
		if($this->fp) {
			fclose($this->fp);
			unset($this->fp);
		}
	}
//////////////////////////////////////////////////
//	�λ������椨��
	function ChangePlace($id_0,$id_1) {
		$Place_0	= $this->SearchID($id_0);
		$Place_1	= $this->SearchID($id_1);
		$temp	= $this->Ranking[$Place_0["0"]][$Place_0["1"]];
		$this->Ranking[$Place_0["0"]][$Place_0["1"]]	= $this->Ranking[$Place_1["0"]][$Place_1["1"]];
		$this->Ranking[$Place_1["0"]][$Place_1["1"]]	= $temp;
	}
//////////////////////////////////////////////////
// $id �Υ��λ�ä�̽��
	function SearchID($id) {
		foreach($this->Ranking as $rank => $val) {
			foreach($val as $key => $val2) {
				if($val2["id"] == $id)
					return array((int)$rank,(int)$key);// �λ�o���κη�Ŀ����
			}
		}
		return false;
	}
//////////////////////////////////////////////////
// ��󥭥󥰤α�ʾ
	function ShowRanking($from=false,$to=false,$bold_id=false) {
		// ���줬�o�����Ϥ�ȫ��󥭥󥰤��ʾ
		if($from === false or $to === false) {
			$from	= 0;//��λ
			$to		= count($this->Ranking);//����λ
		}

		// ̫�֤ˤ�����
		if($bold_id)
			$BoldRank	= $this->SearchID($bold_id);

		$LastPlace	= count($this->Ranking) - 1;// ����λ

		print("<table cellspacing=\"0\">\n");
		print("<tr><td class=\"td6\" style=\"text-align:center\">��λ</td><td  class=\"td6\" style=\"text-align:center\">����</td></tr>\n");
		for($Place=$from; $Place<$to + 1; $Place++) {
			if(!$this->Ranking["$Place"])
				break;
			print("<tr><td class=\"td7\" valign=\"middle\" style=\"text-align:center\">\n");
			// �λ��������
			switch($Place) {
				case 0:
					print('<img src="'.IMG_ICON.'crown01.png" class="vcent" />'); break;
				case 1:
					print('<img src="'.IMG_ICON.'crown02.png" class="vcent" />'); break;
				case 2:
					print('<img src="'.IMG_ICON.'crown03.png" class="vcent" />'); break;
				default:
					if($Place == $LastPlace)
						print("��");
					else
						print(($Place+1)."λ");
			}
			print("</td><td class=\"td8\">\n");
			foreach($this->Ranking["$Place"] as $SubRank => $data) {
				list($Name,$R)	= $this->LoadUserName($data["id"],true);//�ɿ����i���z��
				$WinProb	= $R[all]?sprintf("%0.0f",($R[win]/$R[all])*100):"--";
				$Record	= "(".($R[all]?$R[all]:"0")."ս ".
						($R[win]?$R[win]:"0")."ʤ".
						($R[lose]?$R[lose]:"0")."�� ".
						($R[all]-$R[win]-$R[lose])."�� ".
						($R[defend]?$R[defend]:"0")."�� ".
						"ʤ��".$WinProb.'%'.
						")";
				if(isset($BoldRank) && $BoldRank["0"] == $Place && $BoldRank["1"] == $SubRank) {
					print('<span class="bold u">'.$Name."</span> {$Record}");
				} else {
					print($Name." ".$Record);
				}
				print("<br />\n");
			}
			print("</td></tr>\n");
		}
		print("</table>\n");
	}
//////////////////////////////////////////////
//	����� ����ID
	function ShowRankingRange($id,$Amount) {
		$RankAmount	= count($this->Ranking);
		$Last	= $RankAmount - 1;
		do {
			// ��󥭥󥰤�Amount���Ϥʤ��Ȥ�
			if($RankAmount <= $Amount) {
				$start	= 0;
				$end	= $Last;
				break;
			}

			$Rank	= $this->SearchID($id);
			if($Rank === false) {
				print("����δ֪");
				return 0;
			}
			$Range	= floor($Amount/2);
			// ��λ�˽�������λ
			if( ($Rank[0] - $Range) <= 0 ) {
				$start	= 0;
				$end	= $Amount - 1;
			// ����λ�ˤ�����������λ
			} else if( $Last < ($Rank[0] + $Range) ) {
				$start	= $RankAmount - $Amount;
				$end	= $RankAmount;
			// �����ڤˤ����ޤ�
			} else {
				$start	= $Rank[0]-$Range;
				$end	= $Rank[0]+$Range;
			}
		} while(0);

		$this->ShowRanking($start,$end,$id);
	}
//////////////////////////////////////////////
//	��`������ǰ����ӳ���
	function LoadUserName($id,$rank=false) {

		if(!$this->UserName["$id"]) {
			$User	= new user($id);
			$Name	= $User->Name();
			$Record	= $User->RankRecordLoad();
			if($Name !== false) {
				$this->UserName["$id"]	= $Name;
				$this->UserRecord["$id"]	= $Record;
			} else {
				$this->UserName["$id"]	= "-";

				$this->DeleteRank($id);

				foreach($this->Ranking as $rank => $val) {
					foreach($val as $key => $val2) {
						$ranking	.= $val2["id"]."\n";
					}
				}
		
				WriteFileFP($this->fp,$ranking);
			}
		}

		if($rank)
			return array($this->UserName["$id"],$this->UserRecord["$id"]);
		else
			return $this->UserName["$id"];
	}
//////////////////////////////////////////////////
//	
	function dump() {
		print("<pre>".print_r($this,1)."</pre>\n");
	}
// end of class
}
?>
