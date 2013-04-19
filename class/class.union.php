<?php
include_once("class.char.php");
class union extends char{

	var $file;
	var $fp;

	var $UnionName;
	var $MonsterNumber;
	var $LastDefeated;

	var $Slave;
	var $Union = true;
	var $UnionNo;
	var $UnionLand;
	var $LevelLimit;
/*
	Union��󥹥��`�ϥ���`�����ܤ���ȽU�Y����ɤ���
	�ʤΤǡ�ȫ�_��HP�Ȳ�֤�ȡ�ä������ж��r�˽U�Y����ɤ����Ȥˤ��롣
*/
	var $LastHP;

	// ��󥹥��`���äΉ���
	var $monster = true;
	var $exphold;//�U�Y��
	var $moneyhold;//����
	var $itemdrop;//��Ȥ������ƥ�

//////////////////////////////////////////////////
//	���󥹥ȥ饯��
	function union($file=false) {
		$this->LoadData($file);
	}
//////////////////////////////////////////////////
//	������`��
	function PoisonDamage($multiply=1) {
		if($this->STATE !== 2) return false;

		$poison	= $this->PoisonDamageFormula($multiply);
		print("<span class=\"spdmg\">".$this->Name(bold)." �����ж��ܵ� ");
		print("<span class=\"bold\">$poison</span> �˺�.\n");
		$this->HpDamage2($poison);
		print("</span><br />\n");
	}
//////////////////////////////////////////////////
//	������`���ι�ʽ
	function PoisonDamageFormula($multiply=1) {
		$damage	= round($this->HP * 0.01);
		$damage	*= mt_rand(50,150)/100;
		if(200 < $damage)
			$damage	= 200;
		$damage	*= $multiply;
		return round($damage);
	}

//////////////////////////////////////////////////
//	����״�B�ˤ��롣
	function GetNormal($mes=false) {
		if($this->STATE === ALIVE)
			return true;
		if($this->STATE === DEAD) {//����״�B
			// ��˥���Ϗͻ�ʤ��¤Ȥ��롣
			return true;
			/*
			if($mes)
				print($this->Name(bold).' <span class="recover">revived</span>!<br />'."\n");
			$this->STATE = 0;
			return true;
			*/
		}
		if($this->STATE === POISON) {//��״�B
			if($mes)
				print($this->Name(bold)." ��<span class=\"spdmg\">��</span> ������.<br />\n");
			$this->STATE = 0;
			return true;
		}
	}
//////////////////////////////////////////////////
//	�ЄӤ��W�餻��(Rate)
	function DelayByRate($No,$BaseDelay,$Show=false) {
		if(DELAY_TYPE === 0) {
			if($Show) {
				print("(".sprintf("%0.1f",$this->delay));
				print('<span style="font-size:80%"> >>> </span>');
			}
			$Delay	= ($BaseDelay - $this->SPD) * ($No/100);//�W�餻���g��
			$this->delay	-= $Delay;
			if($Show) {
				print(sprintf("%0.1f",$this->delay)."/".sprintf("%0.1f",$BaseDelay).")");
			}
		} else if(DELAY_TYPE === 1) {
			if($Show) {
				print("(".sprintf("%0.0f",$this->delay));
				print('<span style="font-size:80%"> >>> </span>');
			}
			$Delay	= round($No/5);//�W�餻���g��
			$this->delay	-= $Delay;
			if($Show) {
				print(sprintf("%0.0f",$this->delay)."/".sprintf("%d",100).")");
			}
		}
	}
//////////////////////////////////////////////////
//	���L�ФΥ������,HP,SP ��ɫ��֤��Ʊ�ʾ����
//	��������ˤ��Ҫ���郎����б�ʾ����褦�ˤ�����
	function ShowHpSp() {
		if($this->STATE === 1)
			$sub	= " dmg";
		else if($this->STATE === 2)
			$sub	= " spdmg";
		//��ǰ
		print("<span class=\"bold{$sub}\">{$this->name}</span>\n");
		// ����`��orԁ��
		if($this->expect_type === 0)
			print('<span class="charge">(charging)</span>'."\n");
		else if($this->expect_type === 1)
			print('<span class="charge">(casting)</span>'."\n");
		// HP,SP
		print("<div class=\"hpsp\">\n");
		$sub	= $this->STATE === 1 ? "dmg":"recover";
		//print("<span class=\"{$sub}\">HP : ????/{$this->MAXHP}</span><br />\n");//HP
		print("<span class=\"{$sub}\">HP : ????/????</span><br />\n");//HP
		$sub	= $this->STATE === 1 ? "dmg":"support";
		print("<span class=\"{$sub}\">SP : ????/????</span>\n");
		print("</div>\n");//SP
	}
//////////////////////////////////////////////////
//	���Ή仯���ʾ����(����`���ܤ����r�Ȥ�)
	function ShowValueChange() {
		print("(??? > ???)");
	}
//////////////////////////////////////////////////
//	���ŤǺ��ӳ���
	function UnionNumber($no) {
		$file	= UNION.$no."_Union.dat";
		if($this->LoadData($file))
			return true;
		else
			return false;
	}
//////////////////////////////////////////////////
//	��˥������夬�����Ƥ뤫�ɤ����_�J����(���L���)
	function is_Alive() {
		if(0 < $this->hp)
			return true;
		else
			return false;
	}
//////////////////////////////////////////////////
//	
	function LoadData($file) {
		if(!file_exists($file))
			return false;

		$this->file	= $file;
		$this->fp	= FileLock($this->file);

		$this->UnionNo	= substr(basename($file),0,4);
		$data	= ParseFileFP($this->fp);
		$this->SetCharData($data);
		return true;
	}
//////////////////////////////////////////////////
	function ShowCharLink() {
	// <div class="land_<*=$this->UnionLand*>">
		?>
	<div class="carpet_frame">
	<div class="land" style="background-image : url(<?php print IMG_OTHER."land_".$this->UnionLand.".gif"?>);">
	<a href="?union=<?php print $this->UnionNo?>"><?php $this->ShowImage();?></a></div>
	<div class="bold dmg"><?php print $this->UnionName?></div>���Ƽ���:<?php print $this->LevelLimit?>��
	</div><?php 
	}
//////////////////////////////////////////////////
	function UpMAXHP($no) {
		print($this->Name(bold)." MAXHP(????) extended to ");
		$this->MAXHP	= round($this->MAXHP * (1 + $no/100));
		print("????<br />\n");
	}
	function UpMAXSP($no) {
		print($this->Name(bold)." MAXSP(????) extended to ");
		$this->MAXSP	= round($this->MAXSP * (1 + $no/100));
		print("????<br />\n");
	}
	function DownMAXHP($no) {
		$no	/= 2;
		print($this->Name(bold)." MAXHP(????) down to ");
		$this->MAXHP	= round($this->MAXHP * (1 - $no/100));
		if($this->MAXHP < $this->HP)
			$this->HP	= $this->MAXHP;
		print("????<br />\n");
	}
	function DownMAXSP($no) {
		$no	/= 2;
		print($this->Name(bold)." MAXSP(????) down to ");
		$this->MAXSP	= round($this->MAXSP * (1 - $no/100));
		if($this->MAXSP < $this->SP)
			$this->SP	= $this->MAXSP;
		print("????<br />\n");
	}
	function DownATK($no) {
		$no	= round($no/2);
		$this->atk["0"]	= round($this->atk["0"] * (1 - $no/100));
		print($this->Name(bold)." ATK down {$no}%<br />\n");
	}
	function DownMATK($no) {
		$no	= round($no/2);
		$this->atk["1"]	= round($this->atk["1"] * (1 - $no/100));
		print($this->Name(bold)." MATK down {$no}%<br />\n");
	}
	function DownDEF($no) {
		$no	= round($no/2);
		$this->def["0"]	= round($this->def["0"] * (1 - $no/100));
		print($this->Name(bold)." DEF down {$no}%<br />\n");
	}
	function DownMDEF($no) {
		$no	= round($no/2);
		$this->def["2"]	= round($this->def["2"] * (1 - $no/100));
		print($this->Name(bold)." MDEF down {$no}%<br />\n");
	}
	function DownSPD($no) {
		$no	= round($no/2);
		$this->SPD	= round($this->SPD * (1 - $no/100));
		print($this->Name(bold)." SPD down {$no}%<br />\n");
	}
//////////////////////////////////////////////////
//	��ֽU�Y��
	function HpDifferenceEXP() {
		$dif	= $this->LastHP - $this->HP;
		$this->LastHP	= $this->HP;
		if($dif < 0) return 0;
		$exp	= ceil( $this->exphold * ($dif/$this->maxhp) );
		return $exp;
	}
//////////////////////////////////////////////////
//	�����Ή����򥻥åȤ��롣
	function SetCharData(&$data) {
		$this->MonsterNumber	= $data["MonsterNumber"];
		$this->LastDefeated		= $data["LastDefeated"];

		$monster	= CreateMonster($this->MonsterNumber);

		$this->UnionName	= $monster["UnionName"];

		$this->name	= $monster["name"];
		$this->level	= $monster["level"];

		if ($monster["img"])
			$this->img		= $monster["img"];

		$this->str		= $monster["str"];
		$this->int		= $monster["int"];
		$this->dex		= $monster["dex"];
		$this->spd		= $monster["spd"];
		$this->luk		= $monster["luk"];

		$this->maxhp	= $monster["maxhp"];
		$this->hp		= $data["HP"];
		$this->maxsp	= $monster["maxsp"];
		$this->sp		= $data["SP"];

		$this->position	= $monster["position"];
		$this->guard	= $monster["guard"];

		if(is_array($monster["judge"]))
			$this->judge	= $monster["judge"];
		//else
		//	$this->judge	= explode("<>",$monster["judge"]);
		if(is_array($monster["quantity"]))
			$this->quantity	= $monster["quantity"];
		if(is_array($monster["action"]))
			$this->action	= $monster["action"];

		//��󥹥��`����
		$this->monster		= true;
		$this->exphold		= $monster["exphold"];
		$this->moneyhold	= $monster["moneyhold"];
		$this->itemdrop		= $monster["itemdrop"];
		$this->atk	= $monster["atk"];
		$this->def	= $monster["def"];
		$this->SPECIAL	= $monster["SPECIAL"];

		$this->Slave	= $monster["Slave"];
		$this->UnionLand	= $monster["land"];
		$this->LevelLimit	= $monster["LevelLimit"];

		// �r�g���U�^���Əͻ��I����
		$Now	= time();
		$Passed	= $this->LastDefeated + $monster["cycle"];
		if($Passed < $Now && !$this->hp) {
			$this->hp	= $this->maxhp;
			$this->sp	= $this->maxsp;
		}
		$this->LastHP	= $data["HP"];//��֤�ȡ�뤿���HP��
	}

//////////////////////////////////////////////////
//	���L�äΉ���
	function SetBattleVariable($team=false) {
		// ���i���z�ߤ��ֹ�Ǥ��� ��?
		if(isset($this->IMG))
			return false;

		$this->team		= $team;//�����Ҫ��?
		$this->IMG		= $this->img;
		$this->MAXHP	= $this->maxhp;
		$this->HP		= $this->hp;
		$this->MAXSP	= $this->maxsp;
		$this->SP		= $this->sp;
		$this->STR		= $this->str + $this->P_STR;
		$this->INT		= $this->int + $this->P_INT;
		$this->DEX		= $this->dex + $this->P_DEX;
		$this->SPD		= $this->spd + $this->P_SPD;
		$this->LUK		= $this->luk + $this->P_LUK;
		$this->POSITION	= $this->position;
		$this->STATE	= ALIVE;//����״�B�ˤ���

		$this->expect	= false;//(����=ԁ���� false=���C��)
		$this->ActCount	= 0;//�Єӻ���
		$this->JdgCount	= array();//�Q�������жϤλ���
	}
//////////////////////////////////////////////////
//	���ܩ`���Ƥ뤫�ɤ����_�J���롣
	function CharJudgeDead() {
		if($this->HP < 1 && $this->STATE !== 1) {//���ܩ`
			$this->STATE	= 1;
			$this->HP	= 0;
			$this->ResetExpect();

			$this->LastDefeated	= time();
			return true;
		}
	}
//////////////////////////////////////////////////
//	�����ǩ`���α���
	function SaveCharData() {
		if(!file_exists($this->file))
			return false;
		$string	 = "MonsterNumber=".$this->MonsterNumber."\n";
		$string	.= "LastDefeated=".$this->LastDefeated."\n";
		$string	.= "HP=".$this->HP."\n";
		$string	.= "SP=".$this->SP."\n";

		WriteFileFP($this->fp,$string);
		fclose($this->fp);
		unset($this->fp);
	}

}
?>