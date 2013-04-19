<?php 
include(CLASS_SKILL_EFFECT);
class battle extends ClassSkillEffect{
/*
 * $battle	= new battle($MyParty,$EnemyParty);
 * $battle->SetTeamName($this->name,$party["name"]);
 * $battle->Process();//���L�_ʼ
 */
	// teams
	var $team0, $team1;
	// team name
	var $team0_name, $team1_name;
	// team ave level
	var $team0_ave_lv, $team1_ave_lv;

	// ħ���
	var $team0_mc = 0;
	var $team1_mc = 0;

	// ���L����󥿩`����(���L���������ԤΤ���)
	var $BattleMaxTurn	= BATTLE_MAX_TURNS;
	var $NoExtends	= false;

	//
	var $NoResult	= false;

	// ���L����
	var $BackGround = "grass";

	// ������`�� ( << >> �� ����Ή���)
	var $Scroll = 0;

	// �t����`��
	var $team0_dmg = 0;
	var $team1_dmg = 0;
	// �t�Єӻ���
	var $actions = 0;
	// ���L�ˤ�������ʥǥ��쥤
	var $delay;
	// �������`��
	var $result;
	// ��館�뤪��
	var $team0_money, $team1_money;
	// ���äȤ��������ƥ�
	var $team0_item=array(), $team1_item=array();
	var $team0_exp=0, $team1_exp=0;// �t�U�Y����

	// ����ʉ���
	var $ChangeDelay	= false;//������SPD���仯�����H��DELAY����Ӌ�㤹�롣

	var $BattleResultType	= 0;// 0=�Q���Ť��ʤ����Draw 1=�����ߤ����Ǆٔ���Q���
	var $UnionBattle;// �Ф�HP�tHP���L��(????/????)
//////////////////////////////////////////////////
//	���󥹥ȥ饯����

	//�����`������Ф��ܤ��Ȥ롣
	function battle($team0,$team1) {
		include(DATA_JUDGE);
		include_once(DATA_SKILL);

		//��󥹥��`���Α餷�Ƥʤ��Ƥ��ن��������Ϥ�����Τ�
		include_once(CLASS_MONSTER);

		$this->team0	= $team0;
		$this->team1	= $team1;

		// �����`��ˑ��L���äΉ������O������(class.char.php)
		// װ�������C�ܵȤ�Ӌ�㤷���O�����롣
		// ���L���äΉ����ϴ�����Ӣ�Z���ä��ꤹ�롣class.char.php����ա�
		//  $this->team["$key"] �Ƕɤ�����.(�����ϥ��`�෬��)
		foreach($this->team0 as $key => $char)
			$this->team0["$key"]->SetBattleVariable(TEAM_0);
		foreach($this->team1 as $key => $char)
			$this->team1["$key"]->SetBattleVariable(TEAM_1);
		//dump($this->team0[0]);
		// delay�v�B
		$this->SetDelay();//�ǥ��쥤Ӌ��
		$this->DelayResetAll();//���ڻ�
	}
//////////////////////////////////////////////////
//	
	function SetResultType($var) {
		$this->BattleResultType	= $var;
	}
//////////////////////////////////////////////////
//	UnionBattle�Ǥ����¤ˤ��롣
	function SetUnionBattle() {
		$this->UnionBattle	= true;
	}
//////////////////////////////////////////////////
//	��������򥻥åȤ��롣
	function SetBackGround($bg) {
		$this->BackGround	= $bg;
	}
//////////////////////////////////////////////////
//	���L�˥���饯���`��;�вμӤ����롣
	function JoinCharacter($user,$add) {
		foreach($this->team0 as $char) {
			if($user === $char) {
				//array_unshift($this->team0,$add);
				$add->SetTeam(TEAM_0);
				array_push($this->team0,$add);
				//dump($this->team0);
				$this->ChangeDelay();
				return 0;
			}
		}
		foreach($this->team1 as $char) {
			if($user === $char) {
				//array_unshift($this->team1,$add);
				$add->SetTeam(TEAM_1);
				array_push($this->team1,$add);
				$this->ChangeDelay();
				return 0;
			}
		}
	}
//////////////////////////////////////////////////
//	�޽祿�`������Q����㤦��
	function LimitTurns($no) {
		$this->BattleMaxTurn	= $no;
		$this->NoExtends		= true;//�����������L�Ϥ��ʤ���
	}
//////////////////////////////////////////////////
//	
	function NoResult() {
		$this->NoResult	= true;
	}
//////////////////////////////////////////////////
//	���L����󥿩`�����򉈤䤹��
	function ExtendTurns($no,$notice=false) {
		// ���L���ʤ��������O������Ƥ�������L���ʤ���
		if($this->NoExtends === true) return false;

		$this->BattleMaxTurn	+= $no;
		if(BATTLE_MAX_EXTENDS < $this->BattleMaxTurn)
			$this->BattleMaxTurn	= BATTLE_MAX_EXTENDS;
		if($notice) {
print <<< HTML
	<tr><td colspan="2" class="break break-top bold" style="text-align:center;padding:20px 0;">
	����ս���غ���.
	</td></tr>
HTML;
		}
		return true;
	}
//////////////////////////////////////////////////
//	���L�Ы@�ä��������ƥ�򷵤���
	function ReturnItemGet($team) {
		if($team == TEAM_0) {
			if(count($this->team0_item) != 0)
				return $this->team0_item;
			else
				return false;
		} else if($team == TEAM_1) {
			if(count($this->team1_item) != 0)
				return $this->team1_item;
			else
				return false;
		}
	}
//////////////////////////////////////////////////
//	�����߂Ȥ�������������
	function ReturnBattleResult() {
		return $this->result;
	}
//////////////////////////////////////////////////
//	���Lӛ�h�򱣴椹��
	function RecordLog($type=false) {
		if($type == "RANK") {
			$file	= LOG_BATTLE_RANK;
			$log	= @glob(LOG_BATTLE_RANK."*");
			$logAmount = MAX_BATTLE_LOG_RANK;
		} else if($type == "UNION") {
			$file	= LOG_BATTLE_UNION;
			$log	= @glob(LOG_BATTLE_UNION."*");
			$logAmount = MAX_BATTLE_LOG_UNION;
		} else {
			$file	= LOG_BATTLE_NORMAL;
			$log	= @glob(LOG_BATTLE_NORMAL."*");
			$logAmount = MAX_BATTLE_LOG;
		}

		// �Ť���������
		$i	= 0;
		while($logAmount <= count($log) ) {
			unlink($log["$i"]);
			unset($log["$i"]);
			$i++;
		}

		// �¤�����������
		$time	= time().substr(microtime(),2,6);
		$file	.= $time.".dat";

		$head	= $time."\n";//�_ʼ�r�g(1��Ŀ)
		$head	.= $this->team0_name."<>".$this->team1_name."\n";//�μӥ��`��(2��Ŀ)
		$head	.= count($this->team0)."<>".count($this->team1)."\n";//�μ�����(3��Ŀ)
		$head	.= $this->team0_ave_lv."<>".$this->team1_ave_lv."\n";//ƽ����٥�(4��Ŀ)
		$head	.= $this->result."\n";//�������`��(5��Ŀ)
		$head	.= $this->actions."\n";//�t���`����(6��Ŀ)
		$head	.= "\n";// ����(7��Ŀ)

		WriteFile($file,$head.ob_get_contents());
	}
//////////////////////////////////////////////////
//	���L�I��(�����g�Ф��Ƒ��L���I�����)
	function Process() {
		$this->BattleHeader();

		//���L���K���ޤ��R�귵��
		do {
			if($this->actions % BATTLE_STAT_TURNS == 0)//һ���g����״�r���ʾ
				$this->BattleState();//״�r�α�ʾ

			// �Єӥ����
			if(DELAY_TYPE === 0)
				$char	= &$this->NextActer();
			else if(DELAY_TYPE === 1)
				$char	= &$this->NextActerNew();

			$this->Action($char);//�Є�
			$result	= $this->BattleResult();//�����ЄӤǑ��L���K�ˤ������ɤ������ж�

			//����ʹ�õȤ�SPD���仯��������DELAY����Ӌ�㤹�롣
			if($this->ChangeDelay)
				$this->SetDelay();

		} while(!$result);

		$this->ShowResult($result);//���L�νY����ʾ
		$this->BattleFoot();

		//$this->SaveCharacters();
	}
//////////////////////////////////////////////////
//	���L��Υ���饯���`״�r�򱣴椹�롣
	function SaveCharacters() {
		//���`��0
		foreach($this->team0 as $char) {
			$char->SaveCharData();
		}
		//���`��1
		foreach($this->team1 as $char) {
			$char->SaveCharData();
		}
	}

//////////////////////////////////////////////////
//	���L�K�ˤ��ж�
//	ȫ�T����Ǥ�=draw(?)
	function BattleResult() {
		if(CountAlive($this->team0) == 0)//ȫ�T���ܩ`�ʤ�ؓ���ˤ��롣
			$team0Lose	= true;
		if(CountAlive($this->team1) == 0)//ȫ�T���ܩ`�ʤ�ؓ���ˤ��롣
			$team1Lose	= true;
		//���ߤΥ��`�෬�Ť������֤��򷵤�
		if( $team0Lose && $team1Lose ) {
			$this->result	= DRAW;
			return "draw";
		} else if($team0Lose) {//team1 won
			$this->result	= TEAM_1;
			return "team1";
		} else if($team1Lose) {// team0 won
			$this->result	= TEAM_0;
			return "team0";

		// �I���`�����椷�Ƥ�������Є������_�����r��
		} else if($this->BattleMaxTurn <= $this->actions) {
			// ���������β
			/*
				// ���������β1�����Ϥʤ����L
			$AliveNumDiff	= abs(CountAlive($this->team0) - CountAlive($this->team1));
			if(0 < $AliveNumDiff && $this->BattleMaxTurn < BATTLE_MAX_EXTENDS) {
			*/
			$AliveNumDiff	= abs(CountAlive($this->team0) - CountAlive($this->team1));
			$Not5	= (CountAlive($this->team0) != 5 && CountAlive($this->team1) != 5);
			//$lessThan4	= ( CountAlive($this->team0) < 5 || CountAlive($this->team1) < 5 );
			//if( ( $lessThan4 || 0 < $AliveNumDiff ) && $this->BattleMaxTurn < BATTLE_MAX_EXTENDS ) {
			if( ( $Not5 || 0 < $AliveNumDiff ) && $this->BattleMaxTurn < BATTLE_MAX_EXTENDS ) {
				if($this->ExtendTurns(TURN_EXTENDS,1))
					return false;
			}

			// �Q���Ť��ʤ���Ф��������֤��ˤ��롣
			if($this->BattleResultType == 0) {
				$this->result	= DRAW;//�����֤���
				return "draw";
			// �Q���Ť��ʤ���������ߤ����Ǆٔ���Ĥ��롣
			} else if($this->BattleResultType == 1) {
				// �Ȥꤢ���������֤����O��
				// (1) �����������त�ۤ����٤�
				// (2) (1) ��ͬ���ʤ�t����`�����त�ۤ����٤�
				// (3) (2) �Ǥ�ͬ���ʤ������֤���???(or���l�Ȥ΄٤�)
	
				$team0Alive	= CountAliveChars($this->team0);
				$team1Alive	= CountAliveChars($this->team1);
				if($team1��� < $team0Alive) {// team0 won
					$this->result	= TEAM_0;
					return "team0";
				} else if($team0��� < $team1Alive) {// team1 won
					$this->result	= TEAM_1;
					return "team1";
				} else {
					$this->result	= DRAW;
					return "draw";
				}
			} else {
				$this->result	= DRAW;
				print("error321708.<br />�뱨�������...��������");
				return "draw";// ����`�رܡ�
			}

			$this->result	= DRAW;
			print("error321709.<br />�뱨�������...��������");
			return "draw";// ����`�رܡ�
		}
	}
//////////////////////////////////////////////////
//	���L�νY����ʾ
	function ShowResult($result) {

		// ��ȤΥ��`��(���L���ܤ�����)
		$TotalAlive2	= 0;
		// �Ф�HP / ��ӋHP �� ��ʾ
		foreach($this->team1 as $char) {//���`��1
			if($char->STATE !== DEAD)
				$TotalAlive2++;
			$TotalHp2	+= $char->HP;//��ӋHP
			$TotalMaxHp2	+= $char->MAXHP;//��Ӌ���HP
		}

		// �҂ȤΥ��`��(���L���˒줱����)
		$TotalAlive1	= 0;
		foreach($this->team0 as $char) {//���`��0
			if($char->STATE !== DEAD)
				$TotalAlive1++;
			$TotalHp1	+= $char->HP;//��ӋHP
			$TotalMaxHp1	+= $char->MAXHP;//��Ӌ���HP
		}

		// �Y�����ʾ���ʤ���
		if($this->NoResult) {
			print('<tr><td colspan="2" style="text-align:center;padding:10px 0px" class="break break-top">');
			//print("<a name=\"s{$this->Scroll}\"></a>");// ������`�������
			print("ģ��ս����");
			print("</td></tr>\n");
			print('<tr><td class="teams break">'."\n");
			// ��ȥ��`��
			print("����HP : {$TotalHp2}/{$TotalMaxHp2}<br />\n");
			print("��� : {$TotalAlive2}/".count($this->team1)."<br />\n");
			print("���˺� : {$this->team1_dmg}<br />\n");
			// �҂ȥ��`��
			print('</td><td class="teams break">'."\n");
			print("����HP : {$TotalHp1}/{$TotalMaxHp1}<br />\n");
			print("��� : {$TotalAlive1}/".count($this->team0)."<br />\n");
			print("���˺� : {$this->team0_dmg}<br />\n");
			print("</td></tr>\n");
			return false;
		}

		//if($this->actions % BATTLE_STAT_TURNS != 0 || $result == "draw")
		//if(($this->actions + 1) % BATTLE_STAT_TURNS != 0)
		$BreakTop	= " break-top";
		print('<tr><td colspan="2" style="text-align:center;padding:10px 0px" class="break'.$BreakTop.'">'."\n");
		//print($this->actions."%".BATTLE_STAT_TURNS."<br>");
		print("<a name=\"s{$this->Scroll}\"></a>\n");// ������`�������
		if($result == "draw") {
			print("<span style=\"font-size:150%\">ƽ��</span><br />\n");
		} else {
			$Team	= &$this->{$result};
			$TeamName	= $this->{$result."_name"};
			print("<span style=\"font-size:200%\">{$TeamName} ʤ��!</span><br />\n");
		}

		print('<tr><td class="teams">'."\n");
		// Union�Ȥ����Ǥʤ��ΤǤ櫓��
		print("����HP : ");
		print($this->UnionBattle?"????/????":"{$TotalHp2}/{$TotalMaxHp2}");
		print("<br />\n");
/*
		if($this->UnionBattle) {
			print("����HP : ????/????<br />\n");
		} else {
			print("����HP : {$TotalHp2}/{$TotalMaxHp2}<br />\n");
		}
*/
		// ��ȥ��`��
		print("��� : {$TotalAlive2}/".count($this->team1)."<br />\n");
		print("���˺� : {$this->team1_dmg}<br />\n");
		if($this->team1_exp)//�ä��U�Y��
			print("�ܾ���ֵ : ".$this->team1_exp."<br />\n");
		if($this->team1_money)//�ä�����
			print("��Ǯ : ".MoneyFormat($this->team1_money)."<br />\n");
		if($this->team1_item) {//�ä������ƥ�
			print("<div class=\"bold\">����</div>\n");
			foreach($this->team0_item as $itemno => $amount) {
				$item	= LoadItemData($itemno);
				print("<img src=\"".IMG_ICON.$item["img"]."\" class=\"vcent\">");
				print("{$item[name]} x {$amount}<br />\n");
			}
		}

		// �҂ȥ��`��
		print('</td><td class="teams">');
		print("����HP : {$TotalHp1}/{$TotalMaxHp1}<br />\n");
		print("��� : {$TotalAlive1}/".count($this->team0)."<br />\n");
		print("���˺� : {$this->team0_dmg}<br />\n");
		if($this->team0_exp)//�ä��U�Y��
			print("�ܾ���ֵ : ".$this->team0_exp."<br />\n");
		if($this->team0_money)//�ä�����
			print("��Ǯ : ".MoneyFormat($this->team0_money)."<br />\n");
		if($this->team0_item) {//�ä������ƥ�
			print("<div class=\"bold\">Items</div>\n");
			foreach($this->team0_item as $itemno => $amount) {
				$item	= LoadItemData($itemno);
				print("<img src=\"".IMG_ICON.$item["img"]."\" class=\"vcent\">");
				print("{$item[name]} x {$amount}<br />\n");
			}
		}
		print("</td></tr>\n");
		//print("</td></tr>\n");//?
	}

//////////////////////////////////////////////////
//	�������Є�
	function Action(&$char) {
		// $char->judge ���O������Ƥʤ�����w�Ф�
		if($char->judge === array()) {
			$char->delay	= $char->SPD;
			return false;
		}

		// ���`��0���ˤϥ�����҂Ȥ�
		// ���`��1���ˤ���Ȥ� �Є����ݤȽY�� ���ʾ����
		print("<tr><td class=\"ttd2\">\n");
		if($char->team === TEAM_0)
			print("</td><td class=\"ttd1\">\n");
		// �Է֤Υ��`��Ϥɤ��餫?
		foreach($this->team0 as $val) {
			if($val === $char) {
				$MyTeam	= &$this->team0;
				$EnemyTeam	= &$this->team1;
				break;
			}
		}
		//���`��0�Ǥʤ��ʤ���`��1
		if(!$MyTeam) {
			$MyTeam	= &$this->team1;
			$EnemyTeam	= &$this->team0;
		}

		//�ЄӤ��ж�(ʹ�ä��뼼���ж�)
		if($char->expect) {// ԁ��,�A�� ����
			$skill	= $char->expect;
			$return	= &$char->target_expect;
		} else {//���C���ж���������
			$JudgeKey	= -1;

			// �־A�؏�ϵ
			$char->AutoRegeneration();
			// ��״�B�ʤ����`�����ܤ��롣
			$char->PoisonDamage();

			//�ж�
			do {
				$Keys	= array();//������(���ڻ�)
				do {
					$JudgeKey++;
					$Keys[]	= $JudgeKey;
				// ���}�ж��ʤ�Τ�Ӥ���
				} while($char->action["$JudgeKey"] == 9000 && $char->judge["$JudgeKey"]);

				//$return	= MultiFactJudge($Keys,$char,$MyTeam,$EnemyTeam);
				$return	= MultiFactJudge($Keys,$char,$this);

				if($return) {
					$skill	= $char->action["$JudgeKey"];
					foreach($Keys as $no)
						$char->JdgCount[$no]++;//�Q�������жϤΥ�����Ȥ���
					break;
				}
			} while($char->judge["$JudgeKey"]);

			/* // (2007/10/15)
			foreach($char->judge as $key => $judge){
				// $return �� true,false,���ФΤ��Ť줫
				// ���ФΈ��Ϥ��ж���������һ�¤�������餬����(�ϥ�)��
				$return	=& DecideJudge($judge,$char,$MyTeam,$EnemyTeam,$key);
				if($return) {
					$skill	= $char->action["$key"];
					$char->JdgCount[$key]++;//�Q�������жϤΥ�����Ȥ���
					break;
				}
			}
			*/
		}

		// ���L�ξt�Єӻ����򉈤䤹��
		$this->actions++;

		if($skill) {
			$this->UseSkill($skill,$return,$char,$MyTeam,$EnemyTeam);
		// �ЄӤǤ��ʤ��ä����Ϥ΄I��
		} else {
			print($char->Name(bold)." �����˼��������ж�.<br />(�޸����ж�ģʽ)<br />\n");
			$char->DelayReset();
		}

		//�ǥ��쥤�ꥻ�å�
		//if($ret	!== "DontResetDelay")
		//	$char->DelayReset;

		//echo $char->name." ".$skill."<br>";//�_�J��
		//����νK���
		if($char->team === TEAM_1)
			print("</td><td class=\"ttd1\"> \n");
		print("</td></tr>\n");
	}
//////////////////////////////////////////////////
//	�t����`������㤹��
	function AddTotalDamage($team,$dmg) {
		if(!is_numeric($dmg)) return false;
		if($team == $this->team0)
			$this->team0_dmg	+= $dmg;
		else if($team == $this->team1)
			$this->team1_dmg	+= $dmg;
	}

//////////////////////////////////////////////////
//
	function UseSkill($skill_no,&$JudgedTarget,&$My,&$MyTeam,&$Enemy) {
		$skill	= LoadSkillData($skill_no);//���ǩ`���i��

		// ���������ײ�һ��
		if($skill["limit"] && !$My->monster) {
			if(!$skill["limit"][$My->WEAPON]) {
				print('<span class="u">'.$My->Name(bold));
				print('<span class="dmg"> ʧ��</span> ��Ϊ ');
				print($skill["limit"][$My->WEAPON]);
				print("<img src=\"".IMG_ICON.$skill["img"]."\" class=\"vcent\"/>");
				print($skill[name]."</span><br />\n");
				//print($My->Name(bold)." Failed to use ".$skill["name"]."<br />\n");
				print("(�������Ͳ���)<br />\n");
				$My->DelayReset();// �Є�혤�ꥻ�å�
				return true;
			}
		}

		// SP����
		if($My->SP < $skill["sp"]) {
			print($My->Name(bold).$skill["name"]."ʧ��(SP����)");
			if($My->expect) {//�⤷ԁ�����A��;�Ф�SP�����㤷������
				$My->ResetExpect();
			}
			$My->DelayReset();// �Є�혤�ꥻ�å�
			return true;
		}

		// �⤷ "ԁ��" �� "�A��" ����Ҫ�ʼ��ʤ�(+ԁ���_ʼ���Ƥʤ�����)��ԁ��,�A���_ʼ
		if($skill["charge"]["0"] && $My->expect === false) {
			// ��������A���ԁ�����_ʼ������� /////////////////////
			// ����ħ���ˤ�ä��Ĥ�䤨��
			if($skill["type"] == 0) {//����
				print('<span class="charge">'.$My->Name(bold).' ��ʼ����.</span>');
				$My->expect_type	= CHARGE;
			} else {//ħ��
				print('<span class="charge">'.$My->Name(bold).' ��ʼӽ��.</span>');
				$My->expect_type	= CAST;
			}
			$My->expect	= $skill_no;//ԁ��?�A�����ˤ�ͬ�r��ʹ�ä��뼼
			// ��ʹ�äƤʤ��Τǥ����Ȥˤ�����
			//$My->target_expect	= $JudgedTarget;//һ�꥿�`���åȤⱣ��
			//ԁ��?�A��r�g���O����
			$My->DelayByRate($skill["charge"]["0"],$this->delay,1);
			print("<br />\n");

			// ���L�ξt�Єӻ�����p�餹(�A��orԁ�� ���ЄӤ����ʤ�)
			$this->actions--;

			return true;//�ǥ��쥤�����������ꥻ�åȤ��ʤ��褦�ˡ�
		} else {
			// ����g�H��ʹ�ä��� ///////////////////////////////////

			// �Єӻ�����ץ饹����
			$My->ActCount++;

			// �Є����ݤα�ʾ(�ЄӤ���)
			print('<div class="u">'.$My->Name(bold));
			print("<img src=\"".IMG_ICON.$skill["img"]."\" class=\"vcent\"/>");
			print($skill[name]."</div>\n");

			// ħ��ꇤ����M(ζ��)
			if($skill["MagicCircleDeleteTeam"])
			{
				if($this->MagicCircleDelete($My->team,$skill["MagicCircleDeleteTeam"])) {
					print($My->Name(bold).'<span class="charge"> ʹ��ħ���� x'.$skill["MagicCircleDeleteTeam"].'</span><br />'."\n");
				// ħ������Mʧ��
				} else {
					print('<span class="dmg">ʧ��!(ħ������)</span><br />'."\n");
					$My->DelayReset();// �Є�혤�ꥻ�å�
					return true;
				}
			}

			// SP�����M(����λ�ä����A��?ԁ�����ˤ�ͬ�r�����M����)
			$My->SpDamage($skill["sp"],false);

			// ����`��(ԁ��)���ˤ�ͬ�r��ʹ�ä��뼼������������
			if($My->expect)
				$My->ResetExpect();

			// HP�������Έ���(Sacrifice)
			if($skill["sacrifice"])
				$My->SacrificeHp($skill["sacrifice"]);

		}

		// ���`���åȤ��x��(���a)
		if($skill["target"]["0"] == "friend"):
			$candidate	= &$MyTeam;
		elseif($skill["target"]["0"] == "enemy"):
			$candidate	= &$Enemy;
		elseif($skill["target"]["0"] == "self"):
			$candidate[]	= &$My;
		elseif($skill["target"]["0"] == "all"):
			//$candidate	= $MyTeam + $Enemy;//???
			$candidate	= array_merge_recursive(&$MyTeam,&$Enemy);//�Y�Ϥ���,�K�Ӥ������ˤ�����������??
		endif;

		// ���a����ʹ�ä��댝����x�� �� (������ʹ��)

		// �g���ʹ��
		if($skill["target"]["1"] == "individual") {
			$target	=& $this->SelectTarget($candidate,$skill);//������x�k
			if($defender =& $this->Defending($target,$candidate,$skill) )//�ؤ����륭���
				$target	= &$defender;
			for($i=0; $i<$skill["target"]["2"]; $i++) {//�g����}���،g��
				$dmg	= $this->SkillEffect($skill,$skill_no,$My,$target);
				$this->AddTotalDamage($MyTeam,$dmg);
			}

		// �}����ʹ��
		} else if($skill["target"]["1"] == "multi") {
			for($i=0; $i<$skill["target"]["2"]; $i++) {
				$target	=& $this->SelectTarget($candidate,$skill);//������x�k
				if($defender =& $this->Defending($target,$candidate,$skill) )//�ؤ����륭���
					$target	= &$defender;
				$dmg	= $this->SkillEffect($skill,$skill_no,$My,$target);
				$this->AddTotalDamage($MyTeam,$dmg);
			}

		// ȫ���ʹ��
		} else if($skill["target"]["1"] == "all") {
			foreach($candidate as $key => $char) {
				$target	= &$candidate[$key];
				//if($char->STATE === DEAD) continue;//�����ߤϥѥ���
				if($skill["priority"] != "����") {//һ�r�Ĥˡ�
					if($char->STATE === DEAD) continue;//�����ߤϥѥ���
				}
				// ȫ�幥�Ĥ��ؤ�����ʤ�(�Ȥ���)
				for($i=0; $i<$skill["target"]["2"]; $i++) {
					$dmg	= $this->SkillEffect($skill,$skill_no,$My,$target);
					$this->AddTotalDamage($MyTeam,$dmg);
				}
			}
		}

		// ʹ����ʹ���ߤ�Ӱ푤��넿����
		if($skill["umove"])
			$My->Move($skill["umove"]);

		// ���Č���ˤʤä�������_���ɤ��ʤä����_�����(�Ȥꤢ����HP=0�ˤʤä����ɤ���)��
		if($skill["sacrifice"]) { // Sacriϵ�μ���ʹ�ä����ϡ�
			$Sacrier[]	= &$My;
			$this->JudgeTargetsDead($Sacrier);
		}
		list($exp,$money,$itemdrop)	= $this->JudgeTargetsDead($candidate);//�֡�ȡ�ä���U�Y����ä�

		$this->GetExp($exp,$MyTeam);
		$this->GetItem($itemdrop,$MyTeam);
		$this->GetMoney($money,$MyTeam);

		// ����ʹ�õȤ�SPD���仯��������DELAY����Ӌ�㤹�롣
		if($this->ChangeDelay)
			$this->SetDelay();

		// �Є����Ӳֱ(��������O������)
		if($skill["charge"]["1"]) {
			$My->DelayReset();
			print($My->Name(bold)." �ж��Ƴ���");
			$My->DelayByRate($skill["charge"]["1"],$this->delay,1);
			print("<br />\n");
			return false;
		}

		// ������Є�혤�ꥻ�åȤ��롣
		$My->DelayReset();
	}
//////////////////////////////////////////////////
//	�U�Y����ä�
function GetExp($exp,&$team) {
	if(!$exp) return false;

	$exp	= round(EXP_RATE * $exp);

	if($team === $this->team0){
		$this->team0_exp	+= $exp;
	} else {
		$this->team1_exp	+= $exp;
	}

	$Alive	= CountAliveChars($team);
	if($Alive=== 0) return false;
	$ExpGet	= ceil($exp/$Alive);//�����ߤˤ����U�Y����֤��롣
	print("����߻�� {$ExpGet} ����.<br />\n");
	foreach($team as $key => $char) {
		if($char->STATE === 1) continue;//�����ߤˤ�EXP�����ʤ�
		if($team[$key]->GetExp($ExpGet))//LvUp�����ʤ�true������
			print("<span class=\"levelup\">".$char->Name()." ����!</span><br />\n");
	}
}
//////////////////////////////////////////////////
//	�����ƥ��ȡ�ä���(���`�ब)
	function GetItem($itemdrop,$MyTeam) {
		if(!$itemdrop) return false;
		if($MyTeam === $this->team0) {
			foreach($itemdrop as $itemno => $amount) {
				$this->team0_item["$itemno"]	+= $amount;
			}
		} else {
			foreach($itemdrop as $itemno => $amount) {
				$this->team1_item["$itemno"]	+= $amount;
			}
		}
	}

//////////////////////////////////////////////////
//	���l���ؤ����륭�����x�֡�
	function &Defending(&$target,&$candidate,$skill) {
		if($target === false) return false;

		if($skill["invalid"])//�����oҕ�Ǥ��뼼��
			return false;
		if($skill["support"])//֧Ԯ�ʤΤǥ��`�ɤ��ʤ���
			return false;
		if($target->POSITION == "front")//ǰ�l�ʤ��ؤ��Ҫ�o�����K���
			return false;
		// "ǰ�l�����Ҥ�������"�����Ф�ԑ����
		// ǰ�l + ������ + HP1���� �ˉ�� ( ���ϵ���Ĥ����ˤʤ����ؤ�Τ� [2007/9/20] )
		foreach($candidate as $key => $char) {
			//print("{$char->POSTION}:{$char->STATE}<br>");
			if($char->POSITION == "front" && $char->STATE !== 1 && 1 < $char->HP )
				$fore[]	= &$candidate["$key"];
		}
		if(count($fore) == 0)//ǰ�l�����ʤ�����ؤ�ʤ����K���
			return false;
		// һ�ˤŤ��ؤ����뤫���ʤ������ж����롣
		shuffle($fore);//���Ф΁K�Ӥ�줼��
		foreach($fore as $key => $char) {
			// �ж���ʹ��������Ӌ�㤷���ꤹ�롣
			switch($char->guard) {
				case "life25":
				case "life50":
				case "life75":
					$HpRate	= ($char->HP / $char->MAXHP) * 100;
				case "prob25":
				case "prob50":
				case "prob75":
					mt_srand();
					$prob	= mt_rand(1,100);
			}
			// �g�H���ж����Ƥߤ롣
			switch($char->guard) {
				case "never":
					continue;
				case "life25":// HP(%)��25%���Ϥʤ�
					if(25 < $HpRate) $defender	= &$fore["$key"]; break;
				case "life50":// ��50%��
					if(50 < $HpRate) $defender	= &$fore["$key"]; break;
				case "life75":// ��70%��
					if(75 < $HpRate) $defender	= &$fore["$key"]; break;
				case "prob25":// 25%�δ_�ʤ�
					if($prob < 25) $defender	= &$fore["$key"]; break;
				case "prob50":// 50% ��
					if($prob < 50) $defender	= &$fore["$key"]; break;
				case "prob75":// 75% ��
					if($prob < 75) $defender	= &$fore["$key"]; break;
				default:
					$defender	= &$fore["$key"];
			}
			// �l�������l���ؤ����ä��ΤǤ�����ʾ����
			if($defender) {
				print('<span class="bold">'.$defender->name.'</span> ����<span class="bold">'.$target->name.'</span>!<br />'."\n");
				return $defender;
			}
		}
	}
//////////////////////////////////////////////////
//	������ʹ����ˌ�����(���a)�����ܩ`�������ɤ�����_�����
	function JudgeTargetsDead(&$target) {
		foreach($target as $key => $char) {
			// �뤨������`���β�֤ǽU�Y����ȡ�ä����󥹥��`�Έ��ϡ�
			if(method_exists($target[$key],'HpDifferenceEXP')) {
				$exp	+= $target[$key]->HpDifferenceEXP();
			}
			if($target[$key]->CharJudgeDead()) {//��������ɤ���
				// ������å��`��
				print("<span class=\"dmg\">".$target[$key]->Name(bold)." ����.</span><br />\n");

				//�U�Y����ȡ��
				$exp	+= $target[$key]->DropExp();

				//�����ȡ��
				$money	+= $target[$key]->DropMoney();

				// �����ƥ�ɥ�å�
				if($item = $target[$key]->DropItem()) {
					$itemdrop["$item"]++;
					$item	= LoadItemData($item);
					print($char->Name("bold")." ������");
					print("<img src=\"".IMG_ICON.$item["img"]."\" class=\"vcent\"/>\n");
					print("<span class=\"bold u\">{$item[name]}</span>.<br />\n");
				}

				//�ن������ʤ�������
				if($target[$key]->summon === true) {
					unset($target[$key]);
				}

				// ������Τǥǥ��쥤��ֱ����
				$this->ChangeDelay();
			}
		}
		return array($exp,$money,$itemdrop);//ȡ�ä���U�Y���򷵤�
	}
//////////////////////////////////////////////////
//	�����λ�ˏ��äƺ��a����һ�˷���
	function &SelectTarget(&$target_list,$skill) {

		/*
		* ���ȤϤ��뤬�����ƤϤޤ�ʤ��Ƥ���K�Ĥ˥��`���åȤ�Ҫ�롣
		* �� : ���l���Ӥʤ���ǰ�l����ˤ��롣
		*    : ȫ�T��HP100%���l�� �Ƥ��Ȥ� �ˌ���ˤ��롣
		*/

		//�Ф�HP(%)���٤ʤ��ˤ򥿩`���åȤˤ���
		if($skill["priority"] == "LowHpRate") {
			$hp = 2;//һ��1���󤭤����֤�???
			foreach($target_list as $key => $char) {
				if($char->STATE == DEAD) continue;//���ܩ`�ߤό���ˤʤ�ʤ���
				$HpRate	= $char->HP / $char->MAXHP;//HP(%)
				if($HpRate < $hp) {
					$hp	= $HpRate;//�F״�����HP(%)���ͤ���
					$target	= &$target_list[$key];
				}
			}
			return $target;//���HP���ͤ���

		//���l���Ȥ���
		} else if($skill["priority"] == "Back") {
			foreach($target_list as $key => $char) {
				if($char->STATE == DEAD) continue;//���ܩ`�ߤό���ˤʤ�ʤ���
				if($char->POSITION != FRONT)//���l�ʤ�
				$target[]	= &$target_list[$key];//���a�ˤ����
			}
			if($target)
				return $target[array_rand($target)];//�ꥹ�Ȥ��Ф���������

		/*
		* ���ȤϤ��뤬��
		* ���Ȥ��댝�󤬤��ʤ����ʹ�ä�ʧ������(�g�z��)
		*/

		//���ܩ`�ߤ��Ф��������Ƿ�����
		} else if($skill["priority"] == "Dead") {
			foreach($target_list as $key => $char) {
				if($char->STATE == DEAD)//���ܩ`�ʤ�
				$target[]	= &$target_list[$key];//���ܩ`�ߥꥹ��
			}
			if($target)
				return $target[array_rand($target)];//���ܩ`�ߥꥹ�Ȥ��Ф���������
			else
				return false;//�l�⤤�ʤ����false���������ʤ�...(��������ʹ��ʧ��)

		// �ن��������Ȥ��롣
		} else if($skill["priority"] == "Summon") {
			foreach($target_list as $key => $char) {
				if($char->summon)//�ن������ʤ�
					$target[]	= &$target_list[$key];//�ن������ꥹ��
			}
			if($target)
				return $target[array_rand($target)];//�ن��������Ф���������
			else
				return false;//�l�⤤�ʤ����false���������ʤ�...(��������ʹ��ʧ��)

		// ����`���ФΥ����
		} else if($skill["priority"] == "Charge") {
			foreach($target_list as $key => $char) {
				if($char->expect)
					$target[]	= &$target_list[$key];
			}
			if($target)
				return $target[array_rand($target)];
			else
				return false;//�l�⤤�ʤ����false���������ʤ�...(��������ʹ��ʧ��)
		//
		}

		//��������(������)
		foreach($target_list as $key => $char) {
			if($char->STATE != DEAD)//���ܩ`����ʤ�
				$target[]	= &$target_list[$key];//���ܩ`�ߥꥹ��
		}
		return $target[array_rand($target)];//��������l��һ��
	}
//////////////////////////////////////////////////
//	�Τ��ЄӤ��l��(�֡�ԁ���Ф�ħ�����k�Ӥ���Τ��l��)
//	��ե���󥹤򷵤�
	function &NextActer() {
		// ���ǥ��쥤���󤭤��ˤ�̽��
		foreach($this->team0 as $key => $char) {
			if($char->STATE === 1) continue;
			// ������l�Ǥ⤤���ΤǤȤꤢ����������ˤȤ��롣
			if(!isset($delay)) {
				$delay	= $char->delay;
				$NextChar	= &$this->team0["$key"];
				continue;
			}
			// ����餬��Υǥ��쥤���ऱ��н���
			if($delay <= $char->delay) {//�Є�
				// �⤷�����ȥǥ��쥤��ͬ���ʤ�50%�ǽ���
				if($delay == $char->delay) {
					if(mt_rand(0,1))
						continue;
				}
				$delay	= $char->delay;
				$NextChar	= &$this->team0["$key"];
			}
		}
		// ����ͬ����
		foreach($this->team1 as $key => $char) {
			if($char->STATE === 1) continue;
			if($delay <= $char->delay) {//�Є�
				if($delay == $char->delay) {
					if(mt_rand(0,1))
						continue;
				}
				$delay	= $char->delay;
				$NextChar	= &$this->team1["$key"];
			}
		}
		// ȫ�T�ǥ��쥤�p��
		$dif	= $this->delay - $NextChar->delay;//���L�����ǥ��쥤���Є��ߤΥǥ��쥤�β��
		if($dif < 0)//�⤷���֤�0���¤ˤʤä��顭
			return $NextChar;
		foreach($this->team0 as $key => $char) {
			$this->team0["$key"]->Delay($dif);
		}
		foreach($this->team1 as $key => $char) {
			$this->team1["$key"]->Delay($dif);
		}
		/*// ����`�������餳��ǡ�
		if(!is_object($NextChar)) {
			print("AAA");
			dump($NextChar);
			print("BBB");
		}
		*/

		return $NextChar;
	}
//////////////////////////////////////////////////
//	�Τ��ЄӤ��l��(�֡�ԁ���Ф�ħ�����k�Ӥ���Τ��l��)
//	��ե���󥹤򷵤�
	function &NextActerNew() {

		// �Τ��ЄӤޤ������x���̤��ˤ�̽����
		$nextDis	= 1000;
		foreach($this->team0 as $key => $char) {
			if($char->STATE === DEAD) continue;
			$charDis	= $this->team0[$key]->nextDis();
			if($charDis == $nextDis) {
				$NextChar[]	= &$this->team0["$key"];
			} else if($charDis <= $nextDis) {
				$nextDis	= $charDis;
				$NextChar	= array(&$this->team0["$key"]);
			}
		}

		// ����ͬ����
		foreach($this->team1 as $key => $char) {
			if($char->STATE === DEAD) continue;
			$charDis	= $this->team1[$key]->nextDis();
			if($charDis == $nextDis) {
				$NextChar[]	= &$this->team1["$key"];
			} else if($charDis <= $nextDis) {
				$nextDis	= $charDis;
				$NextChar	= array(&$this->team1["$key"]);
			}
		}

		// ȫ�T�ǥ��쥤�p�� //////////////////////

		//�⤷���֤�0���¤ˤʤä���
		if($nextDis < 0) {
			if(is_array($NextChar)) {
				return $NextChar[array_rand($NextChar)];
			} else
				return $NextChar;
		}

		foreach($this->team0 as $key => $char) {
			$this->team0["$key"]->Delay($nextDis);
		}
		foreach($this->team1 as $key => $char) {
			$this->team1["$key"]->Delay($nextDis);
		}
		// ����`�������餳��Ǥ��������
		/*
		if(!is_object($NextChar)) {
			print("AAA");
			dump($NextChar);
			print("BBB");
		}
		*/

		if(is_array($NextChar))
			return $NextChar[array_rand($NextChar)];
		else
			return $NextChar;
	}
//////////////////////////////////////////////////
//	�����ȫ�T���Єӥǥ��쥤����ڻ�(=SPD)
	function DelayResetAll() {
		if(DELAY_TYPE === 0 || DELAY_TYPE === 1)
		{
			foreach($this->team0 as $key => $char) {
				$this->team0["$key"]->DelayReset();
			}
			foreach($this->team1 as $key => $char) {
				$this->team1["$key"]->DelayReset();
			}
		}
	}
//////////////////////////////////////////////////
//	�ǥ��쥤��Ӌ�㤷���O������
//	�l����SPD���仯�������Ϻ���ֱ��
//	*** ����ʹ�õȤ�SPD���仯�����H�˺��ӳ��� ***
	function SetDelay() {
		if(DELAY_TYPE === 0)
		{
			//SPD����󂎤Ⱥ�Ӌ������
			foreach($this->team0 as $key => $char) {
				$TotalSPD	+= $char->SPD;
				if($MaxSPD < $char->SPD)
					$MaxSPD	= $char->SPD;
			}
			//dump($this->team0);
			foreach($this->team1 as $char) {
				$TotalSPD	+= $char->SPD;
				if($MaxSPD < $char->SPD)
					$MaxSPD	= $char->SPD;
			}
			//ƽ��SPD
			$AverageSPD	= $TotalSPD/( count($this->team0) + count($this->team1) );
			//����delay�Ȥ�
			$AveDELAY	= $AverageSPD * DELAY;
			$this->delay	= $MaxSPD + $AveDELAY;//���Α��L�λ��ʥǥ��쥤
			$this->ChangeDelay	= false;//false�ˤ��ʤ��Ț���DELAY��Ӌ�㤷ֱ���Ƥ��ޤ���
		}
			else if(DELAY_TYPE === 1)
		{
		}
	}
//////////////////////////////////////////////////
//	���L�λ��ʥǥ��쥤����Ӌ�㤵����褦�ˤ��롣
//	ʹ�������ϡ�����ʹ�äǥ�����SPD���仯�����H��ʹ����
//	class.skill_effect.php ��ʹ�á�
	function ChangeDelay(){
		if(DELAY_TYPE === 0)
		{
			$this->ChangeDelay	= true;
		}
	}
//////////////////////////////////////////////////
//	���`�����ǰ���O��
	function SetTeamName($name1,$name2) {
		$this->team0_name	= $name1;
		$this->team1_name	= $name2;
	}
//////////////////////////////////////////////////
//	���L�_ʼ�����r��ƽ����٥���ӋHP�Ȥ�Ӌ��?��ʾ
//	���L�νU����һ�Ĥα�ǘ��ɤ���뤦�ä�
	function BattleHeader() {
		foreach($this->team0 as $char) {//���`��0
			$team0_total_lv	+= $char->level;//��ӋLV
			$team0_total_hp	+= $char->HP;//��ӋHP
			$team0_total_maxhp	+= $char->MAXHP;//��Ӌ���HP
		}
		$team0_avelv	= round($team0_total_lv/count($this->team0)*10)/10;//���`��0ƽ��LV
		$this->team0_ave_lv	= $team0_avelv;
		foreach($this->team1 as $char) {//���`��1
			$team1_total_lv	+= $char->level;
			$team1_total_hp	+= $char->HP;
			$team1_total_maxhp	+= $char->MAXHP;
		}
		$team1_avelv	= round($team1_total_lv/count($this->team1)*10)/10;
		$this->team1_ave_lv	= $team1_avelv;
		if($this->UnionBattle) {
			$team1_total_hp		= '????';
			$team1_total_maxhp	= '????';
		}
		?>
<table style="width:100%;" cellspacing="0"><tbody>
<tr><td class="teams"><div class="bold"><?php print $this->team1_name?></div>
�ܼ��� : <?php print $team1_total_lv?><br>
ƽ������ : <?php print $team1_avelv?><br>
��HP : <?php print $team1_total_hp?>/<?php print $team1_total_maxhp?>
</td><td class="teams ttd1"><div class="bold"><?php print $this->team0_name?></div>
�ܼ��� : <?php print $team0_total_lv?><br>
ƽ������ : <?php print $team0_avelv?><br>
��HP : <?php print $team0_total_hp?>/<?php print $team0_total_maxhp?>
</td></tr><?php 
	}
//////////////////////////////////////////////////
//	���L�K�˕r�˱�ʾ
	function BattleFoot() {
	/*	print("<tr><td>");
		dump($this->team0);
		print("</td></tr>");*/
		?>
</tbody></table>
<?php 
	}
//////////////////////////////////////////////////
//	���L����?�������βФ�HP�Ф�SP�Ȥ��ʾ
	function BattleState() {
		static $last;
		if($last !== $this->actions)
			$last	= $this->actions;
		else
			return false;

		print("<tr><td colspan=\"2\" class=\"btl_img\">\n");
		// ���L���ƥå�혤��Ԅӥ�����`��
		print("<a name=\"s".$this->Scroll."\"></a>\n");
		print("<div style=\"width:100%;hight:100%;position:relative;\">\n");
		print('<div style="position:absolute;bottom:0px;right:0px;">'."\n");
		if($this->Scroll)
			print("<a href=\"#s".($this->Scroll - 1)."\"><<</a>\n");
		else
			print("<<" );
		print("<a href=\"#s".(++$this->Scroll)."\">>></a>\n");
		print('</div>');

		switch(BTL_IMG_TYPE) {
			case 0:
				print('<div style="text-align:center">');
				$this->ShowGdImage();//����
				print('</div>');
				break;
			case 1:
			case 2:
				$this->ShowCssImage();//����
				break;
		}
		print("</div>");
		print("</td></tr><tr><td class=\"ttd2 break\">\n");

		print("<table style=\"width:100%\"><tbody><tr><td style=\"width:50%\">\n");// team1-backs

		// 	��ȥ��`�����l
		foreach($this->team1 as $char) {
			// �ن�����餬�������Ƥ�����Ϥ��w�Ф�
			if($char->STATE === DEAD && $char->summon == true)
				continue;

			if($char->POSITION != FRONT)
				$char->ShowHpSp();
		}

		// 	��ȥ��`��ǰ�l
		print("</td><td style=\"width:50%\">\n");
		foreach($this->team1 as $char) {
			// �ن�����餬�������Ƥ�����Ϥ��w�Ф�
			if($char->STATE === DEAD && $char->summon == true)
				continue;

			if($char->POSITION == FRONT)
				$char->ShowHpSp();
		}

		print("</td></tr></tbody></table>\n");

		print("</td><td class=\"ttd1 break\">\n");

		// 	�҂ȥ��`��ǰ�l
		print("<table style=\"width:100%\"><tbody><tr><td style=\"width:50%\">\n");
		foreach($this->team0 as $char) {
			// �ن�����餬�������Ƥ�����Ϥ��w�Ф�
			if($char->STATE === DEAD && $char->summon == true)
				continue;
			if($char->POSITION == FRONT)
				$char->ShowHpSp();
		}

		// 	�҂ȥ��`�����l
		print("</td><td style=\"width:50%\">\n");
		foreach($this->team0 as $char) {
			// �ن�����餬�������Ƥ�����Ϥ��w�Ф�
			if($char->STATE === DEAD && $char->summon == true)
				continue;
			if($char->POSITION != FRONT)
				$char->ShowHpSp();
		}
		print("</td></tr></tbody></table>\n");

		print("</td></tr>\n");
	}
//////////////////////////////////////////////////
//	���L����(����Τ�)
	function ShowGdImage() {
		$url	= BTL_IMG."?";

		// HP=0 �Υ����λ���(�����Ӥ�����Ф����ȡ��)
		$DeadImg	= substr(DEAD_IMG,0,strpos(DEAD_IMG,"."));

		//���`��1
		$f	= 1;
		$b	= 1;//ǰ�l����?���l��������ڻ�
		foreach($this->team0 as $char) {
			//����ϥ������O������Ƥ��뻭��Β����ӤޤǤ���ǰ
			if($char->STATE === 1)
				$img	= $DeadImg;
			else
				$img	= substr($char->img,0,strpos($char->img,"."));
			if($char->POSITION == "front")://ǰ�l
				$url	.= "f2{$f}=$img&";
				$f++;
			else:
				$url	.= "b2{$b}=$img&";//���l
				$b++;
			endif;
		}
		//���`��0
		$f	= 1;
		$b	= 1;
		foreach($this->team1 as $char) {
			if($char->STATE === 1)
				$img	= $DeadImg;
			else
				$img	= substr($char->img,0,strpos($char->img,"."));
			if($char->POSITION == "front"):
				$url	.= "f1{$f}=$img&";
				$f++;
			else:
				$url	.= "b1{$b}=$img&";
				$b++;
			endif;
		}
		print('<img src="'.$url.'">');// �����줬��ʾ�����Τ�
	}
//////////////////////////////////////////////////
//	CSS���L����
	function ShowCssImage() {
		include_once(BTL_IMG_CSS);
		$img	= new cssimage();
		$img->SetBackGround($this->BackGround);
		$img->SetTeams($this->team1,$this->team0);
		$img->SetMagicCircle($this->team1_mc, $this->team0_mc);
		if(BTL_IMG_TYPE == 2)
			$img->NoFlip();// CSS����ܞ�o��
		$img->Show();
	}
//////////////////////////////////////////////////
//	�����ä롢һ�r�Ĥˉ����˱��椹�������
//	class�ڤ˥᥽�å�����`
	function GetMoney($money,$team) {
		if(!$money) return false;
		$money	= ceil($money * MONEY_RATE);
		if($team === $this->team0) {
			print("{$this->team0_name} ��� ".MoneyFormat($money).".<br />\n");
			$this->team0_money	+= $money;
		} else if($team === $this->team1) {
			print("{$this->team1_name} ��� ".MoneyFormat($money).".<br />\n");
			$this->team1_money	+= $money;
		}
	}
//////////////////////////////////////////////////
//	��`���`�ǩ`���˵ä��Ӌ���~��ɤ�
	function ReturnMoney() {
		return array($this->team0_money,$this->team1_money);
	}

//////////////////////////////////////////////////
//	ȫ�����������������...(�ͥ���ޥ󥵤���ʹ�äƤʤ�?)
	function CountDeadAll() {
		$dead	= 0;
		foreach($this->team0 as $char) {
			if($char->STATE === DEAD)
				$dead++;
		}
		foreach($this->team1 as $char) {
			if($char->STATE === DEAD)
				$dead++;
		}
		return $dead;
	}

//////////////////////////////////////////////////
//	ָ�������Υ��`�����������������(ָ���Υ��`��)�ͥ���ޥ󥵤���ʹ�äƤʤ�?
	function CountDead($VarChar) {
		$dead	= 0;

		if($VarChar->team == TEAM_0) {
		//	print("A".$VarChar->team."<br>");
			$Team	= $this->team0;
		} else {
			//print("B".$VarChar->team);
			$Team	= $this->team1;
		}

		foreach($Team as $char) {
			if($char->STATE === DEAD) {
				$dead++;
			} else if($char->SPECIAL["Undead"] == true) {
				//print("C".$VarChar->Name()."/".count($Team)."<br>");
				$dead++;
			}
		}
		return $dead;
	}
//////////////////////////////////////////////////
//	ħ��ꇤ�׷�Ӥ���
	function MagicCircleAdd($team,$amount) {
		if($team == TEAM_0) {
			$this->team0_mc	+= $amount;
			if(5 < $this->team0_mc)
				$this->team0_mc	= 5;
			return true;
		} else {
			$this->team1_mc	+= $amount;
			if(5 < $this->team1_mc)
				$this->team1_mc	= 5;
			return true;
		}
	}
//////////////////////////////////////////////////
//	ħ��ꇤ���������
	function MagicCircleDelete($team,$amount) {
		if($team == TEAM_0) {
			if($this->team0_mc < $amount)
				return false;
			$this->team0_mc	-= $amount;
			return true;
		} else {
			if($this->team1_mc < $amount)
				return false;
			$this->team1_mc	-= $amount;
			return true;
		}
	}
// end of class. /////////////////////////////////////////////////////
}

//////////////////////////////////////////////////
//	���������������Ʒ���
function CountAlive($team) {
	$no	= 0;//���ڻ�
	foreach($team as $char) {
		if($char->STATE !== 1)
			$no++;
	}
	return $no;
}

//////////////////////////////////////////////////
//	���ڥ�����������������Ʒ���
function CountAliveChars($team) {
	$no	= 0;//���ڻ�
	foreach($team as $char) {
		if($char->STATE === 1)
			continue;
		if($char->monster)
			continue;
		$no++;
	}
	return $no;
}
//////////////////////////////////////////////////
//	��߀ϵ������Ǻ��Ф줿��󥹥��`��
	function CreateSummon($no,$strength=false) {
		include_once(DATA_MONSTER);
		$monster	= CreateMonster($no,1);

		$monster["summon"]	= true;
		// �ن���󥹥��`�Ώ�����
		if($strength) {
			$monster["maxhp"]	= round($monster["maxhp"]*$strength);
			$monster["hp"]	= round($monster["hp"]*$strength);
			$monster["maxsp"]	= round($monster["maxsp"]*$strength);
			$monster["sp"]	= round($monster["sp"]*$strength);
			$monster["str"]	= round($monster["str"]*$strength);
			$monster["int"]	= round($monster["int"]*$strength);
			$monster["dex"]	= round($monster["dex"]*$strength);
			$monster["spd"]	= round($monster["spd"]*$strength);
			$monster["luk"]	= round($monster["luk"]*$strength);

			$monster["atk"]["0"]	= round($monster["atk"]["0"]*$strength);
			$monster["atk"]["1"]	= round($monster["atk"]["1"]*$strength);
		}

		$monster	= new monster($monster);
		$monster->SetBattleVariable();
		return $monster;
	}
//////////////////////////////////////////////////
//	�}�����ж�Ҫ�ؤǤ��ж�
//function MultiFactJudge($Keys,$char,$MyTeam,$EnemyTeam) {
function MultiFactJudge($Keys,$char,$classBattle) {
	foreach($Keys as $no) {

		//$return	= DecideJudge($no,$char,$MyTeam,$EnemyTeam);
		$return	= DecideJudge($no,$char,$classBattle);

		// �ж�����Ǥ��ä����ϽK�ˡ�
		if(!$return)
			return false;

		// ���Ф���^���ƹ�ͨ�Ŀ��Ф�(�ۤ܎�ֹ�η����)
		/*
		if(!$compare && is_array($return))
			$compare	= $return;
		else if(is_array($return))
			$compare	= array_intersect($intersect,$return);
		*/

	}

	/*
	if($compare == array())
		$compare	= true;
	return $compare;
	*/
	return true;
}
?>
