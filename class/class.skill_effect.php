<?php
//////////////////////////////////////////////////
//	extended class.battle.php
class ClassSkillEffect{
//////////////////////////////////////////////////
//	����������ʹ�ä���
/*

������ʹ�Ì�����(����)�ϻ����Ĥ�
��ȫ�T
��������(���}����)
��(ζ����)HP���ͤ�혤������=������
�����ܩ`��(�ǥ�����)
��4�N�?
������HP���ͤ�혤���Ѥ������פ��ʤ�����

�ޤ����Ȥ˥��`���åȤ�Q��롣
���a(ζ��,��,�Է�,ζ��+��)
���a��� �g��,�}��,ȫ�� �� �����λ�ˏ��ä�(�g��,�}���Τ�)�Q���

���Ĥʤ顢���`�ɤ���뤫�ɤ����ж���
���ġ�

֧Ԯ�����Τޤ�֧Ԯ

*/
//////////////////////////////////////////////////
//	ʹ���ߤ������ߤ˥������ʹ��
	function SkillEffect($skill,$skill_no,&$user,&$target) {
		if($target === false) {
			print("û��Ŀ��.ʧ��!<br />\n");
			return false;
		}

		//�������g�H��ʹ�ä���
		switch($skill_no):

			case 1020:// ManaBreak
				$dmg	= CalcBasicDamage($skill,$user,$target);
				DamageSP($target,$dmg);
				break;

			case 1021:// SoulBreak
			case 1029://
				$dmg	= CalcBasicDamage($skill,$user,$target);
				DamageHP($target,$dmg);
				DamageSP($target,$dmg);
				break;

			case 1022://ChargeAttack
			case 5108://
				if($user->POSITION != "front")
					$option["multiply"]	= 4;
				$dmg	= CalcBasicDamage($skill,$user,$target,$option);
				DamageHP($target,$dmg);
				$user->Move("front");
				break;

			case 1026://
				if($user->POSITION != "front")
					$option["multiply"]	= 3;
				$dmg	= CalcBasicDamage($skill,$user,$target,$option);
				DamageHP($target,$dmg);
				$user->Move("front");
				break;

			case 1023://Hit&Away
				if($user->POSITION == "front")
					$option["multiply"]	= 3;
				$dmg	= CalcBasicDamage($skill,$user,$target,$option);
				DamageHP($target,$dmg);
				$user->Move("back");
				break;

			case 1027://
				if($user->POSITION == "front")
					$option["multiply"]	= 6;
				$dmg	= CalcBasicDamage($skill,$user,$target,$option);
				DamageHP($target,$dmg);
				$user->Move("back");
				break;

			case 1024://LifeDivision
				$value	= round(abs($target->HP - $user->HP)*0.5);// ���
				if($user->HP <= $target->HP) {
					if(1000 <= $value) {
						print("����ֵ̫�󱻲�����<br />\n");
						$value	= 500;
					}
					DamageHP($target,$value);
					RecoverHP($user,$value);
				} else {
					DamageHP($user,$value);
					RecoverHP($target,$value);
				}
				break;

			case 1025://ManaDivision
				$value	= round(abs($target->SP - $user->SP)*0.5);// ���
				if($user->SP <= $target->SP) {
					if(1000 <= $value) {
						print("����ֵ̫�󱻲�����<br />\n");
						$value	= 500;
					}
					DamageSP($target,$value);
					RecoverSP($user,$value);
				} else {
					DamageSP($user,$value);
					RecoverSP($target,$value);
				}
				break;

			case 1116://Punish
			case 1125://Punish
				$dmg	= $user->MAXHP - $user->HP;
				DamageHP($target,$dmg);
				break;

			case 1119://Possession
				if($user === $target) break;
				$this->StatusChanges($skill,$target);
				break;

			case 1200://PoisonBlow
			case 1223://PoisonBlow
				if($target->STATE === 2) {
					$option["multiply"]	= 6;
					print("�˺� x6!<br />\n");
				}
				$dmg	= CalcBasicDamage($skill,$user,$target,$option);
				DamageHP($target,$dmg);
				break;

			case 1208://PoisonInvasion
				$Rate	= (log(($user->INT+22)/10) - 0.8)/0.85;
				//$Rate	= 0.81 + (pow(pow($user->INT*0.1,2.05),21/40))/10;
				$target->PoisonDamage($Rate);
				break;

			case 1209://TransPoison
				if($target->STATE !== POISON) return false;
				$this->StatusChanges($skill,$target);
				$target->GetNormal(true);
				break;

			case 1220://AntiPoisoning
				$target->GetPoisonResist(50);
				break;

			case 2030: // LifeDrain
			case 2031: // LifeSqueeze
			case 2033: //
			case 2034: //
			case 2036: //
			case 5097: //
			case 5098: //
				if($user == $target) return false;//�Է֤����Է֤��������ʤ���
				$dmg	= CalcBasicDamage($skill,$user,$target);
				AbsorbHP($target,$dmg,$user,$dmg);
				break;

			case 2032: // DeathKnell
				$p	= mt_rand(1,100);
				if(50<$p) $target->HP	= 0;
				else print("ʧ��!<br />");
				return true;

			case 5121: //
				$p	= mt_rand(1,100);
				if(70<$p) $target->HP	= 0;
				else print("ʧ��!<br />");
				return true;

			case 5122: //
				$p	= mt_rand(1,100);
				if(10<$p) $target->HP	= 0;
				else print("ʧ��!<br />");
				return true;

			case 5136: //
				$p	= mt_rand(1,100);
				if(8<$p) $target->HP	= 0;
				else print("ʧ��!<br />");
				return true;

			case 2035: //
				$p	= mt_rand(1,100);
				if(90<$p) $target->HP	= 0;
				else print("ʧ��!<br />");
				return true;

			case 2055:// SoulRevenge
				$option["multiply"]	= $this->CountDead($user) + 1;
				print("�˺� x".$option["multiply"]."!<br />\n");
				$dmg	= CalcBasicDamage($skill,$user,$target,$option);
				DamageHP($target,$dmg);
				break;


			case 2056:// ZombieRevival
				//print("who? : ".$target->Name().":".$target->STATE."<br />\n");
				if($target->STATE !== 1) break;
				$target->GetNormal(true);
				$this->StatusChanges($skill,$target);
				RecoverHP($target,$target->MAXHP);
				break;

			case 2057:// SelfMetamorphorse
				if(60 < $target->HpPercent() || $target->SPECIAL["Metamo"]) {
					print("ʧ��!<br />\n");
					break;
				}
				print($target->GetSpecial("Metamo",true));
				if($target->gender == 0)
					$target->img	= "mon_110r.gif";//��
				else
					$target->img	= "mon_149r.gif";//��
				$this->StatusChanges($skill,$target);
				RecoverHP($target,round($target->MAXHP/2));
				break;

			case 2058://
			case 3317://
				$this->StatusChanges($skill,$target);
				RecoverHP($target,round($target->MAXHP/2));
				break;

			case 2059:// ����仯
				if($target->SPECIAL["Metamo"]) {
					print("ʧ��!<br />\n");
					break;
				}
				print($target->GetSpecial("Metamo",true));
				if($target->gender == 0)
					$target->img	= "mon_shujing_man.gif";//��
				else
					$target->img	= "mon_shujing_lady.gif";//��
				$this->StatusChanges($skill,$target);
				RecoverHP($target,round($target->MAXHP/2));
				break;

			case 2063:// Ұ�Ա仯
				if($target->SPECIAL["Metamo"]) {
					print("ʧ��!<br />\n");
					break;
				}
				print($target->GetSpecial("Metamo",true));
				if($target->gender == 0)
					$target->img	= "mon_085r.gif";//��
				else
					$target->img	= "mon_085r.gif";//��
				$this->StatusChanges($skill,$target);
				RecoverHP($target,round($target->MAXHP/2));
				break;

			case 5099://
				if(50 < $target->HpPercent() || $target->SPECIAL["Metamo"]) {
					print("ʧ��!<br />\n");
					break;
				}
				print($target->GetSpecial("Metamo",true));
				$this->StatusChanges($skill,$target);
				RecoverHP($target,round($target->MAXHP/2));
				break;

			// SP����ϵ
			case 2090://EneryRob
			case 5090://EneryRob
			case 2091://EneryCollect
			case 5133://EneryCollect
				if($user == $target) return false;//�Է֤����Է֤��������ʤ���
				$dmg	= CalcBasicDamage($skill,$user,$target,array("pierce"=>1));
				AbsorbSP($target,$dmg,$user,$dmg);
				break;

			case 5104://
				if($user == $target) return false;//�Է֤����Է֤��������ʤ���
				$dmg	= CalcBasicDamage($skill,$user,$target,array("pierce"=>1));
				AbsorbSP($target,$dmg,$user,$dmg);
				AbsorbHP($target,$dmg,$user,$dmg);
				break;

			// ����`��(ԁ��)�ФΥ����Τߤ���ˤ���
			case 2110:
			case 2111:
				if($target->expect === false) break;
				$this->DelayChar($target,$skill);
				break;

/*
			// HP�؏�ϵ
			case 3000:// Healing
			case 3001:// PowerHeal
			case 3002:// PartyHeal
			case 3003:// QuickHeal
			case 3004:// SmartHeal
			case 3006://
			case 3007://
			case 3103://
			case 5007:// Heal(Mons)
			case 5055:// RadiateHeating
			case 5111://
				$heal	= CalcRecoveryValue($skill,$user,$target);
				RecoverHP($target,$heal);
				$this->StatusChanges($skill,$target);
				break;
*/

			case 3005: // ProgressiveHeal
			case 3009: //
				$heal	= CalcRecoveryValue($skill,$user,$target);
				$Rate	= ($target->HP / $target->MAXHP) * 100;
				if($Rate <= 30) {
					$heal	*= 2;
					print("����x2!<br />");
				}
				RecoverHP($target,$heal);
				break;

			case 3010: // ManaRecharge(�Լ�SP�؏�)
				$SpRec	= ceil($target->MAXSP * 3/10);
				RecoverSP($target,$SpRec);
				break;

			case 3011: // HiManaRecharge
				$SpRec	= ceil($target->MAXSP * 5/10);
				RecoverSP($target,$SpRec);
				break;

			case 3021: // HiManaRecharge
				$SpRec	= ceil($target->MAXSP * 8/10);
				RecoverSP($target,$SpRec);
				break;

			case 3012: // LifeConvert
				$HpDmg	= ceil($target->MAXHP * 3/10);
				DamageHP2($target,$HpDmg);
				$SpRec	= ceil($target->MAXSP * 7/10);
				RecoverSP($target,$SpRec);
				break;

			case 3013: // EnergyExchange
				$HpRate	= floor($target->HP/$target->MAXHP*100);
				$SpRate	= floor($target->SP/$target->MAXSP*100);
				print("{$target->name} �Ի���HP��SP.<br />");
				print("HP: {$target->HP}(".$HpRate."%) �� ");
				$target->HP	= round($SpRate/100*$target->MAXHP);
				print("{$target->HP}(".$SpRate."%)<br />");
				print("SP: {$target->SP}(".$SpRate."%) �� ");
				$target->SP	= round($HpRate/100*$target->MAXSP);
				print("{$target->SP}(".$HpRate."%)<br />");
				break;

			case 3020: // ManaExtend
				$target->MAXSP	= round($target->MAXSP * 1.2);
				print($target->Name(bold)."'s MAXSP ������ {$target->MAXSP}.<br />\n");
				break;
/*
			case 3030: // Reflesh
				if($target->STATE == DEAD) break;
				if($target->STATE == POISON)
					$target->GetNormal(true);
				$heal	= CalcRecoveryValue($skill,$user,$target);
				RecoverHP($target,$heal);
				break;
*/
			//	�K��ϵ�μ���
			case 3040:// Resurrection
			case 3041://
			case 3042://
			case 5030:// SoulRestor
			case 5063:// WakeUp
			case 5135://
			case 5123://
				if($target->STATE !== 1) break;
				$heal	= CalcRecoveryValue($skill,$user,$target);
				$target->GetNormal(true);
				RecoverHP($target,$heal);
				break;

			case 3050://Quick
			case 3051://Quick
			case 3052://Quick
				if($target == $user) return false;
				if($target->expect) return false;
				//$target->Quick($this->delay + 1);
				print("<span class=\"support\">".$target->Name("bold")." ��������!</span>");
				$target->DelayCut(101,$this->delay,1);
				print("<br />\n");
				break;

			case 3055://CastAsist
				if($target->expect && $target->expect_type === 1) {
					print("<span class=\"support\">".$target->Name(bold)." casting shorted!</span>");
					$target->DelayCut(60,$this->delay,1);
					print("<br />\n");
				}
				break;

			case 3056://CastAsist
				if($target->expect && $target->expect_type === 1) {
					print("<span class=\"support\">".$target->Name(bold)." casting shorted!</span>");
					$target->DelayCut(80,$this->delay,1);
					print("<br />\n");
				}
				break;

			case 3060://HolyShield
			case 5067://BananaProtection
				if(!$target->SPECIAL["Barrier"]) {
					$target->GetSpecial("Barrier",true);
					print("<span class=\"support\">".$target->Name(bold)." got barriered!</span><br />\n");
				}
				break;

			case 3136://
			case 5085://
				$heal	= CalcRecoveryValue($skill,$user,$target);
				RecoverHP($target,$heal);
				$this->StatusChanges($skill,$target);
				if(!$target->SPECIAL["Barrier"]) {
					$target->GetSpecial("Barrier",true);
					print("<span class=\"support\">".$target->Name(bold)." got barriered!</span><br />\n");
				}
				break;

			case 3137://
				$RATE	= 4;
				$SpRec	= ceil(sqrt($target->MAXSP) * $RATE);
				RecoverSP($target,$SpRec);
				if(!$target->SPECIAL["Barrier"]) {
					$target->GetSpecial("Barrier",true);
					print("<span class=\"support\">".$target->Name(bold)." got barriered!</span><br />\n");
				}
				break;
/*
			case 3101: // Blessing(ζ��SP�؏�)
				$RATE	= 3;
				$SpRec	= ceil(sqrt($target->MAXSP) * $RATE);
				RecoverSP($target,$SpRec);
				break;

			case 3102: // Benediction
				$RATE	= 5;
				$SpRec	= ceil(sqrt($target->MAXSP) * $RATE);
				RecoverSP($target,$SpRec);
				break;

			case 3103: // Sanctuary
				$RATE	= 7;
				$SpRec	= ceil(sqrt($target->MAXSP) * $RATE);
				RecoverSP($target,$SpRec);
				break;
			case 3104: //
				$RATE	= 10;
				$SpRec	= ceil(sqrt($target->MAXSP) * $RATE);
				RecoverSP($target,$SpRec);
				break;

			case 3105: // ��ף��
				$RATE	= 8;
				$SpRec	= ceil(sqrt($target->MAXSP) * $RATE);
				RecoverSP($target,$SpRec);
				break;

*/
case 3113: // Berserk
break;
			case 3120: // FirstAid
				$heal	= 50 + $target->MAXHP * 1/10;
				$heal	= ceil($heal);
				RecoverHP($target,$heal);
				break;

			case 3121: // SelfRecovery
				$heal	= 50 + $target->MAXHP * 2/10;
				$heal	= ceil($heal);
				RecoverHP($target,$heal);
				break;

			case 3122:// HyperRecovery
				$dif	= $user->MAXHP - $user->HP;
				$heal	= ceil($dif*0.6);
				RecoverHP($target,$heal);
				break;

			case 3124://
				if(20 < $target->HpPercent()) {
					print("ʧ��!<br />\n");
					break;
				}
				$dif	= $user->MAXHP - $user->HP;
				$heal	= ceil($dif*0.8);
				RecoverHP($target,$heal);
				break;

			// �ن������Τߤ��m�ꤹ�뼼
			case 3300:// PowerTrain
			case 3301:// MindTrain
			case 3302:// SpeedTrain
			case 3303:// DefenceTrain
			case 3304:
			case 3305:
			case 3306:
			case 3307:
			case 3308:
			case 3309:
			case 3310://SuppressBeast
			case 3311:
			case 3312:
			case 3313:
			case 3314:
			case 3315:
			case 3316://ȫħ�ޱ���
				if(!$target->summon) break;
				$this->StatusChanges($skill,$target);
				break;

			case 3900:// GetPoison
				print("�ж�<br />\n");
				$user->GetPoison(100);
				break;
			case 3901:// GetDead
				DamageHP($user,9999);
				break;

			case 4000: // StanceRestore(�R��B��)
				if($target->position != $target->POSITION) {
					$target->Move($target->position);
				}
				break;

			// ��������
			case 5002: // BloodSuck
				$dmg	= CalcBasicDamage($skill,$user,$target,array("pierce"=>1));
				AbsorbHP($target,$dmg,$user,$dmg);
				return $dmg;

			case 5006: // Charge!!!
				if($user == $target) {
					$user->POSITION = "back";
					return false;//�Է֤ό�����
				}
				if($target->POSITION == "back") {
					$target->POSITION = "front";
					print($target->Name(bold)." վ��ǰ��.<br />");
				}
				$this->StatusChanges($skill,$target);
				break;

			case 5060://ArmorSnatch
				$target->DownDEF(30);
				$target->DownMDEF(30);
				$user->UpDEF(30);
				$user->UpMDEF(30);
				break;

			// ���Ʃ`�����仯�Τμ�
			case 5022://Fortune
				if($user == $target) break;//�Է֤ˤ�ʹ��ʤ���
				$heal	= CalcRecoveryValue($skill,$user,$target);
				RecoverHP($target,$heal);
				$this->StatusChanges($skill,$target);
				break;

			case 5803: // Spawn
				$spawn	= array(1018,1019,1020,1021,5002);
				$mob	= $spawn[array_rand($spawn)];
				$add	= CreateSummon($mob);
				$this->JoinCharacter($user,$add);
				$add->ShowImage(vcent);
				print($add->Name(bold)." �����˶���.<br />\n");
				break;

			//---------------------------------------------//
			// ��������μ�(���������य������)
			// ���ɤ������ΤǄI��������
			//---------------------------------------------//
			default:
				// ħ����褯
				if($skill["MagicCircleAdd"]) {
					$this->MagicCircleAdd($user->team,$skill["MagicCircleAdd"]);
					print($user->Name(bold).'<span class="support"> ��ħ���� x'.$skill["MagicCircleAdd"].'</span><br />'."\n");
				}
				// ħ�������(��)
				if($skill["MagicCircleDeleteEnemy"]) {
					$EnemyTeam	= ($user->team == TEAM_0)?TEAM_1:TEAM_0;//���֥��`���ָ��
					$this->MagicCircleDelete($EnemyTeam,$skill["MagicCircleDeleteEnemy"]);
					print($user->Name(bold).'<span class="dmg"> �����˵���ħ���� x'.$skill["MagicCircleDeleteEnemy"].'</span><br />'."\n");
				}
				// HP�־A�؏�
				if($skill["HpRegen"]) {
					$target->GetSpecial("HpRegen",$skill["HpRegen"]);
					print($target->Name(bold).'<span class="recover"> HP �ظ���+'.$skill["HpRegen"]."%</span><br />\n");
				}
				// SP�־A�؏�
				if($skill["SpRegen"]) {
					$target->GetSpecial("SpRegen",$skill["SpRegen"]);
					print($target->Name(bold).'<span class="support"> SP �ظ���+'.$skill["SpRegen"]."%</span><br />\n");
				}
				// ����`��(ԁ��)�ФΥ����Τߤ��m�ꤹ�뼼��
				if($skill["priority"] == "Charge" && !$target->expect)
					break;
				// �ن�ϵ�΄I��
				if($skill["summon"]) {
					// ���Ф���ʤ��ä���Ҫ��1�������Фˤ����㤦��
					if(!is_array($skill["summon"]))
						$skill["summon"]	= array($skill["summon"]);
					foreach($skill["summon"] as $SummonNo) {
						$Strength	= $user->SUmmonPower();//�ن���?
						$add	= CreateSummon($SummonNo,$Strength);
						if($skill["quick"])// �ٹ�
							$add->Quick($this->delay * 2);
						//break;//����ȡ��ȥ���`�o���ʤ�(?)��
						$this->JoinCharacter($user,$add);
						$add->ShowImage(vcent);
						print($add->Name(bold)." �����˶���.<br />\n");
					}
					return true;
				}

				// �����ί�
				if($skill["CurePoison"]) {
					if($target->STATE == POISON)
						$target->GetNormal(true);
				}
				// �����Ĥʥ���`����Ӌ��
				if($skill["pow"]) {
					if($skill["support"]) {
						$heal	= CalcRecoveryValue($skill,$user,$target);
						RecoverHP($target,$heal);
						$this->StatusChanges($skill,$target);
					} else {
						if($skill["pierce"])//?? �������O�������Ҫ���룿
							$option["pierce"] = true;
						$dmg	= CalcBasicDamage($skill,$user,$target,$option);
						DamageHP($target,$dmg);
					}
				}
				// SP�؏�(��`��)
				if($skill["SpRecoveryRate"]) {
					$SpRec	= ceil(sqrt($target->MAXSP) * $skill["SpRecoveryRate"]);
					RecoverSP($target,$SpRec);
				}
				// ����
				if($skill["poison"]) {
					$result	= $target->GetPoison($skill["poison"]);
					if($result === true)
						print($target->Name(bold)."<span class=\"spdmg\">�ж���</span> !<br />\n");
					else if($result === "BLOCK")
						print($target->Name(bold)." û���ж�.<br />\n");
				}
				// �Υå��Хå�(���l��)
				if($skill["knockback"])
					$target->KnockBack($skill["knockback"]);
				// ���Ʃ`�����仯
				$this->StatusChanges($skill,$target);
				// ��Ф��Ƅ�
				if($skill["move"])
					$target->Move($skill["move"]);
				// �ЄӤ��W�餻��(DELAY)
				$this->DelayChar($target,$skill);
				return $dmg;
		endswitch;
	}
//////////////////////////////////////////////////
//	�ЄӤ��W�餻��
	function DelayChar(&$target,$skill) {
		if(!$skill["delay"])
			return false;

		print($target->Name(bold)." delayed ");
		$target->DelayByRate($skill["delay"],$this->delay,1);
		print(".<br />\n");
	}
//////////////////////////////////////////////////
//	���Ʃ`������仯������
//	Class�ڤˤʤ����jĿ��
	function StatusChanges($skill,&$target) {
		if($skill["PlusSTR"])
			$target->PlusSTR($skill["PlusSTR"]);
		if($skill["PlusINT"])
			$target->PlusINT($skill["PlusINT"]);
		if($skill["PlusDEX"])
			$target->PlusDEX($skill["PlusDEX"]);
		if($skill["PlusSPD"]) {
			$target->PlusSPD($skill["PlusSPD"]);
			$this->ChangeDelay();
		}
		if($skill["PlusLUK"])
			$target->PlusLUK($skill["PlusLUK"]);

		if($skill["UpMAXHP"])
			$target->UpMAXHP($skill["UpMAXHP"]);
		if($skill["UpMAXSP"])
			$target->UpMAXSP($skill["UpMAXSP"]);
		if($skill["UpSTR"])
			$target->UpSTR($skill["UpSTR"]);
		if($skill["UpINT"])
			$target->UpINT($skill["UpINT"]);
		if($skill["UpDEX"])
			$target->UpDEX($skill["UpDEX"]);
		if($skill["UpSPD"]) {
			$target->UpSPD($skill["UpSPD"]);
			$this->ChangeDelay();
		}
		if($skill["UpATK"])
			$target->UpATK($skill["UpATK"]);
		if($skill["UpMATK"])
			$target->UpMATK($skill["UpMATK"]);
		if($skill["UpDEF"])
			$target->UpDEF($skill["UpDEF"]);
		if($skill["UpMDEF"])
			$target->UpMDEF($skill["UpMDEF"]);

		if($skill["DownMAXHP"])
			$target->DownMAXHP($skill["DownMAXHP"]);
		if($skill["DownMAXSP"])
			$target->DownMAXSP($skill["DownMAXSP"]);
		if($skill["DownSTR"])
			$target->DownSTR($skill["DownSTR"]);
		if($skill["DownINT"])
			$target->DownINT($skill["DownINT"]);
		if($skill["DownDEX"])
			$target->DownDEX($skill["DownDEX"]);
		if($skill["DownSPD"]) {
			$target->DownSPD($skill["DownSPD"]);
			$this->ChangeDelay();
		}
		if($skill["DownATK"])
			$target->DownATK($skill["DownATK"]);
		if($skill["DownMATK"])
			$target->DownMATK($skill["DownMATK"]);
		if($skill["DownDEF"])
			$target->DownDEF($skill["DownDEF"]);
		if($skill["DownMDEF"])
			$target->DownMDEF($skill["DownMDEF"]);
	}

}
//////////////////////////////////////////////////
//	HP�إ���`��
function DamageHP(&$target,$value) {
	print('<span class="dmg" style="font-color:#f53;">'.$target->Name("bold")."</span> �ܵ�");
	print("<span class='dmg bold'>  ".$value."</span> �˺� ");
	$target->HpDamage($value);
	print("<br />\n");
}
//////////////////////////////////////////////////
//	HP�إ���`��(1���¤ˤʤ�ʤ�)
function DamageHP2(&$target,$value) {
	print('<span class="dmg" style="font-color:#f53;">'.$target->Name("bold")."</span> �ܵ�");
	print("<span class='dmg bold'>  ".$value."</span> �˺� ");
	$target->HpDamage2($value);
	print("<br />\n");
}
//////////////////////////////////////////////////
//	SP�إ���`��
function DamageSP(&$target,$value) {
	print('<span class="spdmg" style="font-color:#f53;">'.$target->Name("bold")."</span> �ܵ�");
	print("<span class='spdmg bold'>  ".$value."</span> �˺� ");
	$target->SpDamage($value);
	print("<br />\n");
}
//////////////////////////////////////////////////
//	HP�λ؏�
function RecoverHP(&$target,$value) {
	print($target->Name("bold").' <span class="recover">�ظ��� <span class="bold">'.$value.' HP</span></span>');
	$target->HpRecover($value);
	print("<br />\n");
}
//////////////////////////////////////////////////
//	SP�λ؏�
function RecoverSP(&$target,$value) {
	print($target->Name("bold").' <span class="support">�ظ��� <span class="bold">'.$value.' SP</span></span>');
	$target->SpRecover($value);
	print("<br />\n");
}
//////////////////////////////////////////////////
//	HP������
function AbsorbHP(&$target,$value,&$user,$value2) {
	print(' �� '.$target->Name(bold));
	$target->HpDamage($value);
	print('��ȡ <span class="recover"><span class="bold">'.$value.'</span> HP</span>');
	$user->HpRecover($value);
	print("<br />\n");
}
//////////////////////////////////////////////////
//	SP�λ؏�
function AbsorbSP(&$target,$value,&$user,$value2) {
	print(' �� '.$target->Name(bold));
	$target->SpDamage($value);
	print('��ȡ <span class="support"><span class="bold">'.$value.'</span> SP</span>');
	$user->SpRecover($value);
	print("<br />\n");
}
//////////////////////////////////////////////////
//	�����Ĥʥ���`��Ӌ��ʽ�ǥ���`������������
function CalcBasicDamage($skill,$user,&$target,$option=null) {
	//�����Ĥʥ���`��Ӌ��(����orħ��)
	if($skill["type"] == 0) {//����
		if($skill["inf"] == "dex")//������DEX����ˤ���
			$str	= $user->DEX;
		else
			$str	= $user->STR;
		$dmg	= sqrt($str)*10;
		$dmg	+= $user->atk[0];//װ����﹥
		$dmg	*= $skill["pow"]/100;
		// ׷�ӷ����oҕ����`��
		if($user->SPECIAL["Pierce"]["0"]) {
			$Pierce	= $user->SPECIAL["Pierce"]["0"] * $skill["pow"]/100;
		}
	} else {//ħ��
		$int	= $user->INT;
		$dmg	= sqrt($int)*10;
		$dmg	+= $user->atk[1];//װ���ħ��
		$dmg	*= $skill["pow"]/100;
		// ׷�ӷ����oҕ����`��
		if($user->SPECIAL["Pierce"]["1"]) {
			$Pierce	= $user->SPECIAL["Pierce"]["1"] * $skill["pow"]/100;
		}
	}

	if($option["multiply"])
		$dmg	*= $option["multiply"];

	// 1�ع��Ĥ������0�ˤ��롣
	if($target->SPECIAL["Barrier"]) {
		$target->GetSpecial("Barrier",false);
		print("������Ч.<br />\n");
		$dmg	= 0;
	}

	$min	= $dmg*(1/10);//��ͱ��^���᥸

	//���֤η������ˤ���X�p
	if(!$option["pierce"]) {
		if($skill["type"] == 0) {//����
			$dmg	*= 1 - $target->def["0"]/100;
			$dmg	-= $target->def["1"];
		} else {//ħ��
			$dmg	*= 1 - $target->def["2"]/100;
			$dmg	-= $target->def["3"];
		}
	}
	//����`���ΤФ�Ĥ�
	//$dmg	*= mt_rand(90,110)/100;
	//$dmg	*= mt_rand(90,110)/100;
	//��ͥ���`�����ɤ���
	if($dmg < $min)
		$dmg	= $min;
	$dmg	+=	$Pierce;
	return ceil($dmg);//��K����`��
}
//////////////////////////////////////////////////
//	�؏�����Ӌ��
	function CalcRecoveryValue($skill,$user,$target) {
		$int	= $user->INT;
		$heal	= sqrt($int)*10;
		$heal	+= $user->atk["1"];//װ���ħ��
		$heal	*= $skill["pow"]/100;
		$heal	= ceil($heal);

		// �؏�������ϵ�ѥå���

		// �ܤ���Ȥ��؏�������ϵ�Υѥå��֥������֤äƤ����鉈��
		//if($user->special["?"])
		//	

		return $heal;
	}
?>
