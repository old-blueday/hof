<?php
class Auction {
	var $fp;
	var $AuctionType;
	var $ArticleNo;
	var $Article = array();
	var $UserName;
	var $TempUser	= array();
	var $AuctionLog;
	var $DataChange	= false;
	var $QUERY;
	var $sort;
	function Auction($type) {
		if($type == "item") {
			$this->AuctionType = "item";
			$this->ItemArticleRead();
		} else if($type == "char") {
			$this->AuctionType = "char";
		}
	}
	function AuctionHttpQuery($name) {
		$this->QUERY	= $name;
	}
	function ItemCheckSuccess() {
		$Now	= time();
		foreach($this->Article as $no => $Article) {
			if(AuctionLeftTime($Now,$Article["end"]))
				continue;
			if(!function_exists("LoadItemData"))
				include(DATA_ITEM);
			$item	= LoadItemData($Article["item"]);
			if($Article["bidder"]) {
				$this->UserGetItem($Article["bidder"],$Article["item"],$Article["amount"]);
				$this->UserGetMoney($Article["exhibitor"],$Article["price"]);
				$this->AddLog("No.{$Article[No]} <img src=\"".IMG_ICON.$item["img"]."\"><span class=\"bold\">{$item[name]} x{$Article[amount]}</span>�� ".$this->UserGetNameFromTemp($Article["bidder"])."".MoneyFormat($Article["price"])." <span class=\"recover\">�бꡣ</span>");
			} else {
				$this->UserGetItem($Article["exhibitor"],$Article["item"],$Article["amount"]);
				$this->AddLog("No.{$Article[No]} <img src=\"".IMG_ICON.$item["img"]."\"><span class=\"bold\">{$item[name]} x{$Article[amount]}</span>��<span class=\"dmg\">���ꡣ</span>");
			}
			unset($this->Article["$no"]);
			$this->DataChange	= true;
		}
	}
	function UserGetNameFromTemp($UserID) {
		if($this->TempUser["$UserID"]["Name"])
			return $this->TempUser["$UserID"]["Name"];
		else
			return "-";
	}
	function UserGetMoney($UserID,$Money) {
		if(!$this->TempUser["$UserID"]["user"])
		{
			$this->TempUser["$UserID"]["user"]	= new user($UserID);
			$this->TempUser["$UserID"]["Name"]	= $this->TempUser["$UserID"]["user"]->Name();
		}

		$this->TempUser["$UserID"]["UserGetTotalMoney"]	+= $Money;
		$this->TempUser["$UserID"]["Money"]	= true;
	}
	function UserGetItem($UserID,$item,$amount) {
		if(!$this->TempUser["$UserID"]["user"])
		{
			$this->TempUser["$UserID"]["user"]	= new user($UserID);
			$this->TempUser["$UserID"]["Name"]	= $this->TempUser["$UserID"]["user"]->Name();
		}

		$this->TempUser["$UserID"]["UserGetItem"]["$item"]	+= $amount;
		$this->TempUser["$UserID"]["item"]	= true;
	}
	function UserGetChar($UserID,$char) {
		$this->TempUser["$UserID"]["char"][]	= $char;
		$this->TempUser["$UserID"]["CharAdd"]	= true;
	}
	function UserSaveData() {
		foreach($this->TempUser as $user => $Result) {
			if($this->TempUser["$user"]["Money"]) {
				$this->TempUser["$user"]["user"]->GetMoney($this->TempUser["$user"]["UserGetTotalMoney"]);
				$this->TempUser["$user"]["user"]->SaveData();
			}
			if($this->TempUser["$user"]["item"]) {
				foreach($this->TempUser["$user"]["UserGetItem"] as $itemNo => $amount) {
					$this->TempUser["$user"]["user"]->AddItem($itemNo,$amount);
				}
				$this->TempUser["$user"]["user"]->SaveUserItem();
			}
			if($this->TempUser["$user"]["CharAdd"]) {
				if($this->TempUser["$user"]["char"]) {
					foreach($this->TempUser["$user"]["char"] as $char) {
						$char->SaveCharData($user);
					}
				}
			}
			$this->TempUser["$user"]["user"]->fpCloseAll();
		}
		unset($this->TempUser);
	}
	function ItemBidRight($ArticleNo,$UserID) {
		if($this->Article["$ArticleNo"]["bidder"] == $UserID)
			return false;
		if($this->Article["$ArticleNo"]["exhibitor"] == $UserID)
			return false;
		return true;
	}
	function LoadUserName($id) {
		if($this->UserName["$id"]) {
			return $this->UserName["$id"];
		} else {
			$User	= new user($id);
			$Name	= $User->Name();
			if($Name) {
				$this->UserName["$id"]	= $Name;
			} else {
				$this->UserName["$id"]	= "-";
			}
			return $this->UserName["$id"];
		}
	}
	function ItemBottomPrice($ArticleNo) {
		if($this->Article["$ArticleNo"]) {
			return BottomPrice($this->Article["$ArticleNo"]["price"]);
		}
	}
	function ItemBid($ArticleNo,$BidPrice,$Bidder,$BidderName) {
		if(!$Article	= $this->Article["$ArticleNo"])
			return false;
		$BottomPrice	= BottomPrice($this->Article["$ArticleNo"]["price"]);
		if($Article["IP"] == $_SERVER[REMOTE_ADDR]) {
			ShowError("IP����.");
			return false;
		}
		if(isMobile == "i") {
			ShowError("mobile forbid.");
			return false;
		}
		if($BidPrice < $BottomPrice)
			return false;
		if($Article["bidder"]) {
			$this->UserGetMoney($Article["bidder"],$Article["price"]);
			$this->UserSaveData();
		}
		$Now	= time();
		$left	= AuctionLeftTime($Now,$Article["end"],true);
		if(0 < $left && $left < 901) {
			$dif	= 900 - $left;
			$this->Article["$ArticleNo"]["end"]	+= $dif;
		}
		$this->Article["$ArticleNo"]["price"]	= $BidPrice;
		$this->Article["$ArticleNo"]["TotalBid"]++;
		$this->Article["$ArticleNo"]["bidder"]	= $Bidder;
		$this->DataChange	= true;
		$item	= LoadItemData($Article["item"]);
		$this->AddLog("No.".$Article["No"]." <span class=\"bold\">{$item[name]} x{$Article[amount]}</span>�� ".MoneyFormat($BidPrice)."  ".$BidderName." <span class=\"support\">���ۡ�</span>");
		return true;
	}
	function ItemShowArticle($bidding=false) {
		if(count($this->Article) == 0) {
			print("��������(No auction)<br />\n");
			return false;
		} else {
			$Now	= time();
			$exp	= '<tr><td class="td9">���</td><td class="td9">�۸�</td><td class="td9">Ͷ����</td><td class="td9">������</td><td class="td9">����</td>'.
					'<td class="td9">��չ��</td><td class="td9"> ���� </td></tr>'."\n";
			print('<table style="width:725px;text-align:center" cellpadding="0" cellspacing="0" border="0">'."{$exp}\n");
			foreach($this->Article as $Article) {
				print("<tr><td class=\"td7\">");
				print($Article["No"]);
				print("</td><td class=\"td7\">");
				print(MoneyFormat($Article["price"]));
				print("</td><td class=\"td7\">");
				if(!$Article["bidder"])
					$bidder	= "-";
				else
					$bidder	= $this->LoadUserName($Article["bidder"]);
				print($bidder);
				print("</td><td class=\"td7\">");
				print($Article["TotalBid"]);
				print("</td><td class=\"td7\">");
				print(AuctionLeftTime($Now,$Article["end"]));
				print("</td><td class=\"td7\">");
				$exhibitor	= $this->LoadUserName($Article["exhibitor"]);
				print($exhibitor);
				print("</td><td class=\"td8\">");
				print($Article["comment"]?$Article["comment"]:" ");
				print("</td></tr>\n");
				print('<tr><td colspan="7" style="text-align:left;padding-left:15px" class="td6">');
				$item	= LoadItemData($Article["item"]);
				print('<form action="?menu=auction" method="post">');
				if($bidding) {
					print('<a href="#" onClick="Element.toggle(\'Bid'.$Article["No"].'\';return false;)">��Ͷ��</a>');
					print('<span style="display:none" id="Bid'.$Article["No"].'">');
					print(' <input type="text" name="BidPrice" style="width:80px" class="text" value="'.BottomPrice($Article["price"]).'">');
					print('<input type="submit" value="����" class="btn">');
					print('<input type="hidden" name="ArticleNo" value="'.$Article["No"].'">');
					print('</span>');
				}
				print(ShowItemDetail($item,$Article["amount"],1));
				print("</form>");
				print("</td></tr>\n");
			}
			print("{$exp}</table>\n");
			return true;
		}
	}
	function ItemShowArticle2($bidding=false) {
		if(count($this->Article) == 0) {
			print("��������(No auction)<br />\n");
			return false;
		} else {
			$Now	= time();
			if($this->sort)
				${"Style_".$this->sort}	= ' class="a0"';
			$exp	= '<tr><td class="td9"><a href="?menu='.$this->QUERY.'&sort=no"'.$Style_no.'>No</a></td>'.
					'<td class="td9"><a href="?menu='.$this->QUERY.'&sort=time"'.$Style_time.'>����</td>'.
					'<td class="td9"><a href="?menu='.$this->QUERY.'&sort=price"'.$Style_price.'>�۸�</a>'.
					'<br /><a href="?menu='.$this->QUERY.'&sort=rprice"'.$Style_rprice.'>���ǣ�</a></td>'.
					'<td class="td9">Item</td>'.
					'<td class="td9"><a href="?menu='.$this->QUERY.'&sort=bid"'.$Style_bid.'>Bids</a></td>'.
					'<td class="td9">Ͷ����</td><td class="td9">��չ��</td></tr>'."\n";
			print("������Ŀ����:".$this->ItemAmount()."\n");
			print('<table style="width:725px;text-align:center" cellpadding="0" cellspacing="0" border="0">'."\n");
			print($exp);
			foreach($this->Article as $Article) {
				// ���ӷ���
				print("<tr><td rowspan=\"2\" class=\"td7\">");
				print($Article["No"]);
				// �K�˕r��
				print("</td><td class=\"td7\">");
				print(AuctionLeftTime($Now,$Article["end"]));
				// �F�ھ���۸�
				print("</td><td class=\"td7\">");
				print(MoneyFormat($Article["price"]));
				// �����ƥ�
				print('</td><td class="td7" style="text-align:left">');
				$item	= LoadItemData($Article["item"]);
				print(ShowItemDetail($item,$Article["amount"],1));
				// ��Ӌ������
				print("</td><td class=\"td7\">");
				print($Article["TotalBid"]);
				// Ͷ����
				print("</td><td class=\"td7\">");
				if(!$Article["bidder"])
					$bidder	= "-";
				else
					$bidder	= $this->LoadUserName($Article["bidder"]);
				print($bidder);
				// ��չ��
				print("</td><td class=\"td8\">");
				$exhibitor	= $this->LoadUserName($Article["exhibitor"]);
				print($exhibitor);
				// ������
				print("</td></tr><tr>");
				print("<td colspan=\"6\" class=\"td8\" style=\"text-align:left\">");
				print('<form action="?menu=auction" method="post">');
				// ����ե��`��
				if($bidding) {
					print('<strong>��Ҫ���꣺</strong>');
					print('<span id="Bid'.$Article["No"].'">');
					print(' <input type="text" name="BidPrice" style="width:80px" class="text" value="'.BottomPrice($Article["price"]).'">');
					print('<input type="submit" value="����" class="btn">');
					print('<input type="hidden" name="ArticleNo" value="'.$Article["No"].'">');
					print('</span>');
				}
				print($Article["comment"]?$Article["comment"]:" ");
				print("</form>");
				print("</td></tr>\n");
				print("</td></tr>\n");
			}
			print($exp);
			print("</table>\n");
			return true;
		}
	}
//////////////////////////////////////////////////
//	���η��Ťθ���Ʒ����Ʒ����Ƥ��뤫��������롣
	function ItemArticleExists($no) {
		if($this->Article["$no"]) {
			return true;
		} else {
			return false;
		}
	}
//////////////////////////////////////////////
//	�����ƥ���Ʒ����
	function ItemAddArticle($item,$amount,$id,$time,$StartPrice,$comment) {
		// �K�˕r�̤�Ӌ��
		$Now	= time();
		$end	= $Now + round($now + (60 * 60 * $time));
		// �_ʼ�۸�Τ���
		if(ereg("^[0-9]",$StartPrice)) {
			$price	= (int)$StartPrice;
		} else {
			$price	= 0;
		}
		// �����ȄI��
		$comment	= str_replace("\t","",$comment);
		$comment	= htmlspecialchars(trim($comment),ENT_QUOTES);
		$comment	= stripslashes($comment);
		// ����Ʒ����
		$this->ArticleNo++;
		if(9999 < $this->ArticleNo)
			$this->ArticleNo	= 0;
		$New	= array(
			// ����Ʒ����
			"No"		=> $this->ArticleNo,
			// �K�˕r��
			"end"		=> $end,
			// ��ξ���۸�
			"price"		=> (int)$price,
			// ��չ��id
			"exhibitor"	=> $id,
			// �����ƥ�
			"item"		=> $item,
			// ����
			"amount"	=> (int)$amount,
			// ��Ӌ������
			"TotalBid"	=> 0,
			// ��KͶ����id
			"bidder"	=> NULL,
			// ��K����r�g(ʹ�äƤʤ�����ʹ���������ʹ�äƤ�������)
			"latest"	=> NULL,
			// ������
			"comment"	=> $comment,
			// IP
			"IP"	=> $_SERVER[REMOTE_ADDR],
			);
		array_unshift($this->Article,$New);
		$itemData	= LoadItemData($item);
		$this->AddLog("No.".$this->ArticleNo."  <img src=\"".IMG_ICON.$itemData["img"]."\"><span class=\"bold\">{$itemData[name]} x{$amount}</span>��<span class=\"charge\"> ����������</span>");
		$this->DataChange	= true;
	}
//////////////////////////////////////////////
//	���`�������Υǩ`���򱣴椹��
	function ItemSaveData() {
		if(!$this->DataChange)
		{
			fclose($this->fp);
			unset($this->fp);
			return false;
		}
		// �����ƥ� ���`�������򱣴椹�롣
		$string	= $this->ArticleNo."\n";
		foreach($this->Article as $val) {
			//if(strlen($val["end"]) != 10) continue;
			$string	.=	$val["No"].
				"<>".$val["end"].
				"<>".$val["price"].
				"<>".$val["exhibitor"].
				"<>".$val["item"].
				"<>".$val["amount"].
				"<>".$val["TotalBid"].
				"<>".$val["bidder"].
				"<>".$val["latest"].
				"<>".$val["comment"].
				"<>".$val["IP"]."\n";
		}
		//print($string);
		if(file_exists(AUCTION_ITEM) && $this->fp) {
			WriteFileFP($this->fp,$string,true);
			fclose($this->fp);
			unset($this->fp);
		} else {
			WriteFile(AUCTION_ITEM,$string,true);
		}
		$this->SaveLog();
	}
//////////////////////////////////////////////
	function ItemSortBy($type) {
		switch($type) {
			case "no":
				usort($this->Article,"ItemArticleSortByNo");
				$this->sort	= "no";
				break;
			case "time":
				usort($this->Article,"ItemArticleSortByTime");
				$this->sort	= "time";
				break;
			case "price":
				usort($this->Article,"ItemArticleSortByPrice");
				$this->sort	= "price";
				break;
			case "rprice":
				usort($this->Article,"ItemArticleSortByRPrice");
				$this->sort	= "rprice";
				break;
			case "bid":
				usort($this->Article,"ItemArticleSortByTotalBid");
				$this->sort	= "bid";
				break;
			default:
				usort($this->Article,"ItemArticleSortByTime");
				$this->sort	= "time";
				break;
		}
	}
//////////////////////////////////////////////
// �����ƥ४�`��������äΥե�������_����
// �ǩ`����ȡ�����,��{
	function ItemArticleRead() {
		// �ե����뤬�������
		if(file_exists(AUCTION_ITEM)) {
			//$fp	= fopen(AUCTION_ITEM,"r+");
			$this->fp	= FileLock(AUCTION_ITEM);
			//if(!$fp) return false;
			//flock($fp,LOCK_EX);
			// ���ӷ��Ť����i�ߤ���
			$this->ArticleNo	= trim(fgets($this->fp));
			while( !feof($this->fp) ) {
				$str	= fgets($this->fp);
				if(!$str) continue;
				$article = explode("<>",$str);
				if(strlen($article["1"]) != 10) continue;
				$this->Article[$article["0"]]	= array(
				"No"		=> $article["0"],// ���ӷ���
				"end"		=> $article["1"],// �K�˕r��
				"price"		=> $article["2"],// ��ξ���۸�
				"exhibitor"	=> $article["3"],// ��չ��id
				"item"		=> $article["4"],// �����ƥ�
				"amount"	=> $article["5"],// ����
				"TotalBid"	=> $article["6"],// ��Ӌ������
				"bidder"	=> $article["7"],// ��KͶ����id
				"latest"	=> $article["8"],// ��K����r�g
				"comment"	=> trim($article["9"]),// ������
				"IP"	=> trim($article["10"]),// IP
				);
			}
		// �ե����뤬�o������
		} else {
			// �Τ⤷�ʤ���
		}
	}
//////////////////////////////////////////////////
//	��Ʒ�����
	function ItemAmount() {
		return count($this->Article);
	}
//////////////////////////////////////////////////
//	���`�������U�^�����i��
	function LoadLog() {
		if($this->AuctionType == "item") {
			if(!file_exists(AUCTION_ITEM_LOG)) {
				$this->AuctionLog	= array();
				return false;
			}
			$fp	= fopen(AUCTION_ITEM_LOG,"r+");
			if(!$fp) return false;
			flock($fp,LOCK_EX);
			while( !feof($fp) ) {
				$str	= trim(fgets($fp));
				if(!$str) continue;
				$this->AuctionLog[]	= $str;
			}
		}
	}
//////////////////////////////////////////////////
//	���`�������U�^���α���
	function SaveLog() {
		if($this->AuctionType == "item") {
			if(!$this->AuctionLog)
				return false;
			// 30�����¤˅����
			while(100 < count($this->AuctionLog)) {
				array_pop($this->AuctionLog);
			}
			foreach($this->AuctionLog as $log) {
				$string	.= $log."\n";
			}
			WriteFile(AUCTION_ITEM_LOG,$string);
		}
	}
//////////////////////////////////////////////////
//	���α�ʾ
	function ShowLog() {
		if(!$this->AuctionLog)
			$this->LoadLog();
		if(!$this->AuctionLog)
			return false;
		foreach($this->AuctionLog as $log) {
			print("{$log}<br />\n");
		}
	}
//////////////////////////////////////////////////
//	����׷��
	function AddLog($string) {
		if(!$this->AuctionLog)
			$this->LoadLog();
		if(!$this->AuctionLog)
			$this->AuctionLog	= array();
		array_unshift($this->AuctionLog,$string);
	}


}
//////////////////////////////////////////////////
//	�����ƥ�򷬺�혤ˁK���椨��
	function ItemArticleSortByNo($a,$b) {
		if($a["No"] == $b["No"])
			return 0;
		return ($a["No"] > $b["No"]) ? 1:-1;
	}
//////////////////////////////////////////////////
//	�����ƥ�������r�g혤ˁK�Ӊ䤨��
	function ItemArticleSortByTime($a,$b) {
		if($a["end"] == $b["end"])
			return 0;
		return ($a["end"] > $b["end"]) ? 1:-1;
	}
//////////////////////////////////////////////////
//	�����ƥ��۸�혤ˁK���椨��
	function ItemArticleSortByPrice($a,$b) {
		if($a["price"] == $b["price"])
			return 0;
		return ($a["price"] > $b["price"]) ? -1:1;
	}
//////////////////////////////////////////////////
//	�����ƥ��۸�혤ˁK���椨��(���㤯)
	function ItemArticleSortByRPrice($a,$b) {
		if($a["price"] == $b["price"])
			return 0;
		return ($a["price"] > $b["price"]) ? 1:-1;
	}
//////////////////////////////////////////////////
//	�����ƥ�򾺱���혤ˁK���椨��
	function ItemArticleSortByTotalBid($a,$b) {
		if($a["TotalBid"] == $b["TotalBid"])
			return 0;
		return ($a["TotalBid"] > $b["TotalBid"]) ? -1:1;
	}
//////////////////////////////////////////////////
//	�����r�g�򷵤�
	function AuctionLeftTime($now,$end,$int=false) {
		$left	= $end - $now;
		// $int=true �ʤ��֤�������
		if($int)
			return $left;
		if($left < 1) {// �K�ˤ��Ƥ�����Ϥ�false
			return false;
		}
		if($left < 601) {
			return "{$left}��";
		} else if($left < 3601) {
			$minutes	= floor($left/60);
			return "{$minutes}��";
		} else {
			$hour	= floor($left/3600);
			$minutes	= floor(($left%3600)/60);
			return "{$hour}Сʱ$minutes}��";
		}
	}
//////////////////////////////////////////////////
	function BottomPrice($price) {
		$bottom	= floor($price * 0.10);
		if($bottom < 101)
			return sprintf("%0.0f",$price + 100);
		else
			return sprintf("%0.0f",$price + $bottom);
	}
?>

