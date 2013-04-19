<?php 
class Ranking {
/*
�I�����(��󥭥󥰑�)
1. �����ߤ�ID��ɤ�
2.
	1λ���ˡ�
		���L�Ǥ��ޤ��󥨥�`��
	2-����λ���ˡ�
		1���Ϥ��ˤ�̽����
	�������ˡ�
		����λ���ˤ�̽����
3. �Է֤����֤ȑ��L
4. �����ߡ����ߤ��λ���
5. ���档
----------------------------
����`�����衢������`
�𤳤ꤦ��ȫ�Ƥ�(?)����
��|1λ���Ӥʤ��r(������夬�o���Ȥ�)�����ߤ�1λ�ˤʤ롣
��|1λ������Ǥ��ʤ���
��|������2λ-����λ���ߤ��Ϥ����餷�Ƅ٤ġ�
��|������2λ-����λ���ߤ��Ϥ����餷��ؓ���롣
��|������2λ-����λ���ߤ��Ϥ����餷��1λ�ˤʤ롣
��|���`����h����Ɵo���ߤ�����Ǥ��ʤ���
��|���`����h�Ϥ������ɡ���󥭥󥰤˲μӤ��Ƥʤ��ߤ����餹�롣
��|���餷�����֤Υ��`�ब��������(����Ƿ���Ƥ���)��
��|���餷�����֤Υ��`�ब��������(ȫ�TǷ���Ƥ���)��
��|���餷�����֤�ID���夬�����Ƥ��롣
��|ID���������Ȥ���󥭥󥰤�������礹�롣
��|�r�g���ޤ�������Ϥ�����Ǥ��ʤ���
��|���֤��r�g������(�����֤�o�v�S)
*/

	var $Ranking	= array();

//////////////////////////////////////////////
// �ե����뤫���i���z��ǥ�󥭥󥰤����Фˤ���
	function Ranking() {
		$file	= RANKING;

		if(!file_exists($file)) return 0;

		// �ե����뤫���i������Фˤ����
		$fp	= fopen($file,"r");
		flock($fp,LOCK_EX);
		while($line = fgets($fp) ) {
			$line	= trim($line);
			if(trim($line) == "") continue;
				$this->Ranking[]	= $line;
		}
		//$this->Ranking	= file($file);
		// ���Ф�0�ʤ�K��
		if(!$this->Ranking) return 0;
		// ���Фä������Ф�ָ�
		foreach($this->Ranking as $rank => $val) {
			$list	= explode("<>", $val);
			$this->Ranking["$rank"]	= array();
			$this->Ranking["$rank"]["id"]	= $list["0"];
		}
		//$this->JoinRanking("yqyqqq","last");
		//dump($this->Ranking);
	}

//////////////////////////////////////////////
// ��󥭥󥰑餹�롣�餦��
	function Challenge($id) {
		// ��󥭥󥰤��o���Ȥ�(1λ�ˤʤ�)
		if(!$this->Ranking) {
			$this->JoinRanking($id);
			$this->SaveRanking();
			$message	= "������ʼ."; 
			return array($message,true);
		}

		$MyRank	= $this->SearchID($id);//�Է֤��λ
		// 1λ�Έ��ϡ�
		if($MyRank === 0) {
			$message	= "��һ����������ս.";
			return array($message,true);
		}

		// �Է֤������ʤ�
		if(!$MyRank) {
			$this->JoinRanking($id);//�Է֤�����λ�ˤ��롣
			$MyRank	= count($this->Ranking) - 1;//�Է֤Υ��(����λ)

			$MyID	= $this->Ranking["$MyRank"]["id"];
			$RivalID= $this->Ranking["$MyRank" - 1]["id"];//�Է֤��1���Ϥ��ˤ����֡�
			/*
			dump($this->Ranking);
			dump($RivalID);
			dump($MyID);
			dump($MyRank);//����`�Ǥ����B����
			return 0;*/
			list($message,$result)	= $this->RankBattle($MyID,$RivalID);
			if($message == "Battle" && $result === true)
				$this->RankUp($MyID);

			$this->SaveRanking();
			return array($message,$result);
		}

		// 2λ-����λ���ˤ΄I��
		if($MyRank) {
			$rival	= $MyRank - 1;//�Է֤���λ��1���Ϥ��ˡ�

			$MyID	= $this->Ranking["$MyRank"]["id"];
			$RivalID= $this->Ranking["$rival"]["id"];
			list($message,$result)	= $this->RankBattle($MyID,$RivalID);
			if($message != "Battle")
				return array($message,$result);

			// ���L���Фä�true�ʤ��󥯤���
			if($message == "Battle" && $result === true) {
				$this->RankUp($MyID);
				$this->SaveRanking();
			}
			return array($message,$result);
		}
	}

//////////////////////////////////////////////
// ��碌��
	function RankBattle($ChallengerID,$DefendID) {
		$challenger	= new user($ChallengerID);
		$challenger->CharDataLoadAll();
		$defender	= new user($DefendID);
		$defender->CharDataLoadAll();
		//print($ChallengerID."<br>".$DefendID."<br>");

		$Party_Challenger	= $challenger->RankParty();
		$Party_Defender		= $defender->RankParty();
		if($Party_Defender == "NOID") {//��`�����夬�Ȥ˴��ڤ��ʤ�����
			$message	= "û���û�...<br />(�Զ�ʤ��)";
			$this->DeleteRank($DefendID);
			$this->SaveRanking();
			return array($message,true);
		}

		// ����
		// array(��å��`��,���L�����ä���,�ٔ�)

		// ����åѩ`�ƥ��`������ޤ��󣡣���
		if($Party_Challenger === false) {
			$message	= "����ս������!<br />(�����������Ļ�����Ҳ��û��)";
			return array($message,true);
		}
		// ����åѩ`�ƥ��`������ޤ��󣡣���
		if($Party_Defender === false) {
			$this->DeleteRank($DefendID);
			$this->SaveRanking();
			$message	= "{$defender->name} û������ս����<br />(�Զ�ʤ��)";
			return array($message,true);
		}

		//dump($Party_Challenger);
		//dump($Party_Defender);
		include(CLASS_BATTLE);
		$battle	= new battle($Party_Challenger,$Party_Defender);
		$battle->SetBackGround("colosseum");
		$battle->SetTeamName($challenger->name,$defender->name);
		$battle->Process();//���L�_ʼ
		$battle->RecordLog("RANK");
		return array("Battle",$battle->isChallengerWin());
	}

//////////////////////////////////////////////
// ��󥭥󥰤˲μӤ����롣
	function JoinRanking($id,$place=false) {
		if(!$place)//����λ������
			$place	= count($this->Ranking);
		$data	= array(array("id"=>$id));
		array_splice($this->Ranking, $place, 0, $data);
	}

//////////////////////////////////////////////////
// �λ������椨�롣
	function ChangeRank($id,$id0) {
	
	}

//////////////////////////////////////////////////
// �λ���Ϥ��롣
	function RankUp($id) {
		$place	= $this->SearchID($id);
		//1λ�ϟo�� ���ȡ���󥭥󥰤�1�ĤΈ���(1λ�Τ�)
		$number	= count($this->Ranking);
		if($place === 0 || $number < 2)
			return false;

		$temp	= $this->Ranking["$place"];
		$this->Ranking["$place"]	= $this->Ranking["$place"-1];
		$this->Ranking["$place"-1]	= $temp;
	}

//////////////////////////////////////////////////
// �λ���¤��롣
	function RankDown($id) {
		$place	= $this->SearchID($id);
		// ����λ�ϟo�� ���ȡ���󥭥󥰤�1�ĤΈ���(1λ�Τ�)
		$number	= count($this->Ranking);
		if($place === ($number - 1) ||  $number < 2)
			return false;

		$temp	= $this->Ranking["$place"];
		$this->Ranking["$place"]	= $this->Ranking["$place"+1];
		$this->Ranking["$place"+1]	= $temp;
	}

//////////////////////////////////////////////////
// ��󥭥󥰤�������
	function DeleteRank($id) {
		$place	= $this->SearchID($id);
		if($place === false) return false;//����ʧ��
		unset($this->Ranking["$place"]);
		return true;//�����ɹ�
	}

//////////////////////////////////////////////////
// ��󥭥󥰤򱣴椹��
	function SaveRanking() {
		foreach($this->Ranking as $rank => $val) {
			$ranking	.= $val["id"]."\n";
		}

		WriteFile(RANKING,$ranking);
	}

//////////////////////////////////////////////////
// $id ��̽��
	function SearchID($id) {
		foreach($this->Ranking as $rank => $val) {
			if($val["id"] == $id)
				return (int)$rank;
		}
		return false;
	}

//////////////////////////////////////////////////
// ��󥭥󥰤α�ʾ
	function ShowRanking($from=false,$to=false,$bold=false) {
		$last	= count($this->Ranking) - 1;
		// ��󥭥󥰤����ڤ��ʤ��r
		if(count($this->Ranking) < 1) {
			print("<div class=\"bold\">û������.</div>\n");
		// ��ʾ��������ָ�����줿�r
		} else if(is_numeric($from) && is_numeric($to)) {
			for($from; $from<$to; $from++) {
				$user	= new user($this->Ranking["$from"]["id"]);
				$place	= ($from==$last?"λ(����λ)":"λ");
				if($bold === $from) {
					echo ($from+1)."{$place} : <span class=\"u\">".$user->name."</span><br />";
					continue;
				}
				if($this->Ranking["$from"])
					echo ($from+1)."{$place} : ".$user->name."<br />";
				//else break;
			}
		// ��ʾ��������ָ������ʤ��ä��r(ȫ��ʾ)
		} else if(!$no) {
			foreach($this->Ranking as $key => $val) {
				$user	= new user($val["id"]);
				echo ($key+1)."λ : ".$user->name."<br />";
			}
		}
	}

//////////////////////////////////////////////////
// $id���x�Υ�󥭥󥰤��ʾ
	function ShowNearlyRank($id,$no=5) {
		//dump($this->Ranking);
		$MyRank	= $this->SearchID($id);
		//print("aaa".$MyRank.":".$id."<br>");
		$lowest	= count($this->Ranking);
		// ����λ�˽����Τ��R���Ϥ��Ʊ�ʾ
		if( $lowest < ($MyRank+$no) ) {
			$moveup	= $no - ($lowest - $MyRank);
			$this->ShowRanking($MyRank-$moveup-5,$lowest,$MyRank);
			return 0;
		}
		// �Ϥ˽����Τ��R���¤��Ʊ�ʾ
		if( ($MyRank-$no) < 0 ) {
			$this->ShowRanking(0,$no+5,$MyRank);
			return 0;
		}
		// ���g
		$this->ShowRanking($MyRank-$no,$MyRank+$no,$MyRank);
	}

// end of class
}
?>
