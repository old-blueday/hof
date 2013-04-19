<?php
/*
	�������륷�`�Ȥǻ���?�I��?��ܞ���ܤ��ä��Τ�˼���������Τ�
	������ä��Ƒ��L��������롣
	�������֥饦���ˤ�äƤ����֤���ʾ����ʤ���˼����

	GD���`�äƷ�ܞ�g�ߤλ�������⤹���Ҫ�o����
	IE�ϱ�ʾ�Ǥ��롣
*/
class cssimage {

	var $background;
	var $team1_front	= array();
	var $team1_back		= array();
	var $team2_front	= array();
	var $team2_back		= array();

	var $team1_mc;
	var $team2_mc;

	var $img_x, $img_y;//����`����
	var $size;

	var $div; //</div>�΂���

	var $NoFlip	= false;

//////////////////////////////////////////////////
//	CSS�� image.flip() ��ʹ����ʹ��ʤ�����
	function NoFlip() {
		$this->NoFlip	= true;
	}
//////////////////////////////////////////////////
//	��������򥻥åȡ�
//	�Ĥ��Ǥ˴󤭤���ȡ�ä��롣
	function SetBackGround($bg) {
		$this->background	= IMG_OTHER."bg_".$bg.".gif";

		list($this->img_x, $this->img_y)	= getimagesize($this->background);
		$this->size	= "width:{$this->img_x};height:{$this->img_y};";
	}
//////////////////////////////////////////////////
//	���`������򥻥å�
//	ǰ�l���l�˷֤���
	function SetTeams($team1,$team2) {
		foreach($team1 as $char) {
			// �ن�����餬�������Ƥ�����Ϥ��w�Ф�
			if($char->STATE === DEAD && $char->summon == true)
				continue;
			if($char->POSITION == "front")
				$this->team1_front[]	= $char;
			else
				$this->team1_back[]	= $char;
		}
		foreach($team2 as $char) {
			// �ن�����餬�������Ƥ�����Ϥ��w�Ф�
			if($char->STATE === DEAD && $char->summon == true)
				continue;
			if($char->POSITION == "front")
				$this->team2_front[]	= $char;
			else
				$this->team2_back[]	= $char;
		}
	}
//////////////////////////////////////////////////
//	ħ��ꇤ���
	function SetMagicCircle($team1_mc, $team2_mc) {
		$this->team1_mc	= $team2_mc;
		$this->team2_mc	= $team1_mc;
	}
//////////////////////////////////////////////////
//	CSS( ����黭�� ,x���� ,y���� )
	function det($url,$x,$y) {
		return "height:200px;background-image:url({$url});background-repeat:no-repeat;background-position:{$x}px {$y}px;";
	}

//////////////////////////////////////////////////
//	���L������ʾ
	function Show() {

		//print("<div style=\"postion:relative;height:{$this->img_x}px;\">\n");
		//$this->div++;
		// �������ʾ ( �����ʾ�Ξ����ˤ��餹 )
		$margin	= (-1) * round($this->img_x / 2);
		print("<div style=\"position:relative;left:50%;margin-left:{$margin}px;{$this->size}".$this->det($this->background,0,0)."\">\n");
		$this->div++;

		// ħ��ꇤ��ʾ����
		if(0 < $this->team1_mc) {
			print("<div style=\"{$this->size}".$this->det(IMG_OTHER."mc0_".$this->team1_mc.".gif",280,0)."\">\n");
			$this->div++;
		}
		if(0 < $this->team2_mc) {
			print("<div style=\"{$this->size}".$this->det(IMG_OTHER."mc1_".$this->team2_mc.".gif",0,0)."\">\n");
			$this->div++;
		}

		$cell_width		= ($this->img_x)/6;//�����6�ָ���L��
		$y	= $this->img_y/2;//�ߤ�������

		// team1 ���ʾ(���С�ǰ��)
		$this->CopyRow($this->team1_back, 0, $cell_width*1, $cell_width, $y, $this->img_y);
		$this->CopyRow($this->team1_front, 0, $cell_width*2, $cell_width, $y, $this->img_y);

		if(!$this->NoFlip) {
			// ��ܞ�ä�CSS
			print("<div style=\"{$this->size}filter:FlipH();\">\n");
			$this->div++;
			$dir	= 0;
			$backs	= 1;
			$fore	= 2;
		} else {
			$dir	= 1;
			$backs	= 5;
			$fore	= 4;
		}

		$this->CopyRow($this->team2_back, $dir, $cell_width*$backs, $cell_width, $y, $this->img_y);
		$this->CopyRow($this->team2_front, $dir, $cell_width*$fore, $cell_width, $y, $this->img_y);


		for($i=0; $i<$this->div; $i++)
			print("</div>");
	}

//////////////////////////////////////////////////
//	�ФΥ������褭����
	function CopyRow($teams,$direction,$axis_x,$cell_width,$axis_y,$cell_height) {
		$number	= count($teams);
		if($number == 0) return false;

		$axis_x	+= ( $direction ? -$cell_width/2 : +$cell_width/2 );
		$axis_y	+= ( $direction ? -$cell_height/2 : -$cell_height/2 );

		$gap_x	= $cell_width/($number+1) * ($direction? 1 : -1 );
		$gap_y	= $cell_height/($number+1) * ($direction? 1 : 1 );

		$f	= $direction ? IMG_CHAR_REV : IMG_CHAR;

		foreach($teams as $char) {
			$this->div++;
			$gap++;
			$x	= $axis_x + ( $gap_x * $gap );
			$y	= $axis_y + ( $gap_y * $gap );

			$x	= floor($x);
			$y	= floor($y);
			if($char->STATE === DEAD)
				$img	= $f.DEAD_IMG;
			else
				$img	= $char->GetImageUrl($f);
			list($img_x,$img_y)	= getimagesize($img);
			$x	-= round($img_x/2);
			$y	-= round($img_y/2);
			print("<div style=\"{$this->size}".$this->det($img,$x,$y)."\">\n");
		}
	}
}
?>
