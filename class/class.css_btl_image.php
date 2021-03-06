<?php
/*
	スタイルシ�`トで鮫��?�I囃?郡��辛嬬だったのを房い竃したので
	それを喘いて�蜉L鮫中を恬る。
	ただしブラウザによっては貧返く燕幣されないと房う。

	GDと�`って郡���gみの鮫�颪鰉智發垢覬慴��oし。
	IEは燕幣できる。
*/
class cssimage {

	var $background;
	var $team1_front	= array();
	var $team1_back		= array();
	var $team2_front	= array();
	var $team2_back		= array();

	var $team1_mc;
	var $team2_mc;

	var $img_x, $img_y;//イメ�`ジ嫌
	var $size;

	var $div; //</div>の��方

	var $NoFlip	= false;

//////////////////////////////////////////////////
//	CSSで image.flip() を聞うか聞わないか。
	function NoFlip() {
		$this->NoFlip	= true;
	}
//////////////////////////////////////////////////
//	嘘尚鮫�颪鬟札奪函�
//	ついでに寄きさも函誼する。
	function SetBackGround($bg) {
		$this->background	= IMG_OTHER."bg_".$bg.".gif";

		list($this->img_x, $this->img_y)	= getimagesize($this->background);
		$this->size	= "width:{$this->img_x};height:{$this->img_y};";
	}
//////////////////////////////////////////////////
//	チ�`ムの秤�鵑鬟札奪�
//	念�l瘁�lに蛍ける
	function SetTeams($team1,$team2) {
		foreach($team1 as $char) {
			// 孰�哨�ャラが棒蘭している��栽は�wばす
			if($char->STATE === DEAD && $char->summon == true)
				continue;
			if($char->POSITION == "front")
				$this->team1_front[]	= $char;
			else
				$this->team1_back[]	= $char;
		}
		foreach($team2 as $char) {
			// 孰�哨�ャラが棒蘭している��栽は�wばす
			if($char->STATE === DEAD && $char->summon == true)
				continue;
			if($char->POSITION == "front")
				$this->team2_front[]	= $char;
			else
				$this->team2_back[]	= $char;
		}
	}
//////////////////////////////////////////////////
//	徴圭��の方
	function SetMagicCircle($team1_mc, $team2_mc) {
		$this->team1_mc	= $team2_mc;
		$this->team2_mc	= $team1_mc;
	}
//////////////////////////////////////////////////
//	CSS( キャラ鮫�� ,x恙�� ,y恙�� )
	function det($url,$x,$y) {
		return "height:200px;background-image:url({$url});background-repeat:no-repeat;background-position:{$x}px {$y}px;";
	}

//////////////////////////////////////////////////
//	�蜉L鮫中を燕幣
	function Show() {

		//print("<div style=\"postion:relative;height:{$this->img_x}px;\">\n");
		//$this->div++;
		// 嘘尚を燕幣 ( 嶄刹燕幣の�蕕没鵑砲困蕕� )
		$margin	= (-1) * round($this->img_x / 2);
		print("<div style=\"position:relative;left:50%;margin-left:{$margin}px;{$this->size}".$this->det($this->background,0,0)."\">\n");
		$this->div++;

		// 徴圭��を燕幣する
		if(0 < $this->team1_mc) {
			print("<div style=\"{$this->size}".$this->det(IMG_OTHER."mc0_".$this->team1_mc.".gif",280,0)."\">\n");
			$this->div++;
		}
		if(0 < $this->team2_mc) {
			print("<div style=\"{$this->size}".$this->det(IMG_OTHER."mc1_".$this->team2_mc.".gif",0,0)."\">\n");
			$this->div++;
		}

		$cell_width		= ($this->img_x)/6;//罪嫌を6蛍護した�Lさ
		$y	= $this->img_y/2;//互さの嶄伉

		// team1 を燕幣(瘁双★念双)
		$this->CopyRow($this->team1_back, 0, $cell_width*1, $cell_width, $y, $this->img_y);
		$this->CopyRow($this->team1_front, 0, $cell_width*2, $cell_width, $y, $this->img_y);

		if(!$this->NoFlip) {
			// 郡��喘のCSS
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
//	双のキャラを宙き竃す
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
