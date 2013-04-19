<?php 
include_once("class.char.php");
class monster extends char{

	// ��󥹥��`���äΉ���
	var $monster = true;
	var $exphold;//�U�Y��
	var $moneyhold;//����
	var $itemdrop;//��Ȥ������ƥ�
	var $summon;
//////////////////////////////////////////////////
//	
	function monster($data) {
		$this->SetCharData($data);

	}
//////////////////////////////////////////////////
//	�����ǩ`���α���
	function SaveCharData() {
		// ��󥹥��`�ϱ��椷�ʤ���
		return false;
	}

//////////////////////////////////////////////////
//	����״�B�ˤ��롣
	function GetNormal($mes=false) {
		if($this->STATE === ALIVE)
			return true;
		if($this->STATE === DEAD) {//����״�B
			if($this->summon) return true;
			if($mes)
				print($this->Name(bold).' <span class="recover">revived</span>!<br />'."\n");
			$this->STATE = 0;
			return true;
		}
		if($this->STATE === POISON) {//��״�B
			if($mes)
				print($this->Name(bold)."'s <span class=\"spdmg\">poison</span> has cured.<br />\n");
			$this->STATE = 0;
			return true;
		}
	}
//////////////////////////////////////////////////
//	���ܩ`���Ƥ뤫�ɤ����_�J���롣
	function CharJudgeDead() {
		if($this->HP < 1 && $this->STATE !== DEAD) {//���ܩ`
			$this->STATE	= DEAD;
			$this->HP	= 0;
			$this->ResetExpect();
			//$this->delay	= 0;

			return true;
		}
	}
//////////////////////////////////////////////////
//	�����Ή����򥻥åȤ��롣
	function SetCharData($monster) {

		$this->name		= $monster["name"];
		$this->level	= $monster["level"];

		if ($monster["img"])
			$this->img		= $monster["img"];

		$this->str		= $monster["str"];
		$this->int		= $monster["int"];
		$this->dex		= $monster["dex"];
		$this->spd		= $monster["spd"];
		$this->luk		= $monster["luk"];

		$this->maxhp	= $monster["maxhp"];
		$this->hp		= $monster["hp"];
		$this->maxsp	= $monster["maxsp"];
		$this->sp		= $monster["sp"];

		$this->position	= $monster["position"];
		$this->guard	= $monster["guard"];

		if(is_array($monster["judge"]))
			$this->judge	= $monster["judge"];
		if(is_array($monster["quantity"]))
			$this->quantity	= $monster["quantity"];
		if(is_array($monster["action"]))
			$this->action	= $monster["action"];

		//��󥹥��`����
		//$this->monster		= $monster["monster"];
		$this->monster		= true;
		$this->summon		= $monster["summon"];
		$this->exphold		= $monster["exphold"];
		$this->moneyhold	= $monster["moneyhold"];
		$this->itemdrop		= $monster["itemdrop"];
		$this->atk	= $monster["atk"];
		$this->def	= $monster["def"];
		$this->SPECIAL	= $monster["SPECIAL"];
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
}
?>
