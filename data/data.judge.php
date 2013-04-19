<?php 
//function DecideJudge($number,$My,$MyTeam,$EnemyTeam,$classBattle) {
function DecideJudge($number,$My,$classBattle) {
	if($My->team == TEAM_0) {
		$MyTeam	= $classBattle->team0;
		$EnemyTeam	= $classBattle->team1;
		$MyTeamMC	= $classBattle->team0_mc;
		$EnemyTeamMC	= $classBattle->team1_mc;
	} else {
		$MyTeam	= $classBattle->team1;
		$EnemyTeam	= $classBattle->team0;
		$MyTeamMC	= $classBattle->team1_mc;
		$EnemyTeamMC	= $classBattle->team0_mc;
	}
	$Judge		= $My->judge["$number"];
	$Quantity	= $My->quantity["$number"];
	switch($Judge) {
		case 1000:// �ض�
			return true;
		case 1001:// pass
			return false;
//------------------------ HP���
		case 1100:// �Լ���HP ����(%)����
			$hpp	= $My->HpPercent();
			if($Quantity <= $hpp) return true;
			break;
		case 1101:// �Լ���HP ����(%)����
			$hpp	= $My->HpPercent();
			if($hpp <= $Quantity) return true;
			break;
		case 1105:// �Լ���HP ��������
			$hp		= $My->HP;
			if($Quantity <= $hp) return true;
			break;
		case 1106:// �Լ���HP ��������
			$hp		= $My->HP;
			if($hp <= $Quantity) return true;
			break;
		case 1110:// ���HP ��������
			$mhp		= $My->MAXHP;
			if($Quantity <= $mhp) return true;
			break;
		case 1111:// ���HP ��������
			$mhp		= $My->MAXHP;
			if($mhp <= $Quantity) return true;
			break;
		case 1121:// �ҷ� HP����(%)����
			foreach($MyTeam as $char) {
				if($char->STATE === DEAD) continue;
				if($char->HpPercent() <= $Quantity)
					return true;
			}
			break;
		case 1125:// �ҷ�ƽ��HP ����(%)����
			foreach($MyTeam as $char) {
				if($char->STATE === DEAD) continue;
					$sum	+= $char->HpPercent();
					$cnt++;// ��������
			}
			$ave	= $sum/$cnt;
			if($Quantity <= $ave) return true;
			break;
		case 1126:// �ҷ�ƽ��HP ����(%)����
			foreach($MyTeam as $char) {
				if($char->STATE === DEAD) continue;
					$sum	+= $char->HpPercent();
					$cnt++;// ��������
			}
			$ave	= $sum/$cnt;
			if($ave <= $Quantity) return true;
			break;
//------------------------ SP
		case 1200:// �Լ���SP����(%)����
			$spp	= $My->SpPercent();
			if($Quantity <= $spp) return true;
			break;
		case 1201:// �Լ���SP����(%)����
			$spp	= $My->SpPercent();
			if($spp <= $Quantity) return true;
			break;
		case 1205:// �Լ���SP��������
			$sp		= $My->SP;
			if($Quantity <= $sp) return true;
			break;
		case 1206:// �Լ���SP����(%)����
			$sp		= $My->SP;
			if($sp <= $Quantity) return true;
			break;
		case 1210:// �Լ���SP��������
			$msp		= $My->MAXSP;
			if($Quantity <= $msp) return true;
			break;
		case 1211:// ���SP��������
			$msp		= $My->MAXSP;
			if($msp <= $Quantity) return true;
			break;
		case 1221:// �ҷ� SP����(%)����
			foreach($MyTeam as $char) {
				if($char->STATE === DEAD) continue;
				if($char->MAXSP === 0) continue;
				if($char->SpPercent() <= $Quantity)
					return true;
			}
			break;
		case 1225:// �ҷ�ƽ��SP ����(%)����
			foreach($MyTeam as $char) {
				if($char->STATE === DEAD) continue;
				if($char->MAXSP === 0) continue;					
					$sum	+= $char->SpPercent();
					$cnt++;// ��������
			}
			// ������Ļ�
			if(!$cnt)
				break;
			$ave	= $sum/$cnt;
			if($Quantity <= $ave) return true;
			break;
		case 1226:// �ҷ�ƽ��SP ����(%)����
			foreach($MyTeam as $char) {
				if($char->STATE === DEAD) continue;
				if($char->MAXSP === 0) continue;
					$sum	+= $char->SpPercent();
					$cnt++;// ��������
			}
			// ������Ļ�
			if(!$cnt)
				break;
			$ave	= $sum/$cnt;
			if($ave <= $Quantity) return true;
			break;
//------------------------ STR
		case 1300:// �Լ���STR ** ����
			break;
		case 1301:// �Լ���STR ** ����
			break;
//------------------------ INT
		case 1310:// �Լ���INT ** ����
			break;
		case 1311:// �Լ���INT ** ����
			break;
//------------------------ DEX
		case 1320:// �Լ���DEX ** ����
			break;
		case 1321:// �Լ���DEX ** ����
			break;
//------------------------ SPD
		case 1330:// �Լ���SPD ** ����
			break;
		case 1331:// �Լ���SPD ** ����
			break;
//------------------------ LUK
		case 1340:// �Լ���LUK ** ����
			break;
		case 1341:// �Լ���LUK ** ����
			break;
//------------------------ ATK
		case 1350:// �Լ���ATK ** ����
			break;
		case 1351:// �Լ���ATK ** ����
			break;
//------------------------ MATK
		case 1360:// �Լ���MATK ** ����
			break;
		case 1361:// �Լ���MATK ** ����
			break;
//------------------------ DEF
		case 1370:// �Լ���DEF ** ����
			break;
		case 1371:// �Լ���DEF ** ����
			break;
//------------------------ MDEF
		case 1380:// �Լ���MDEF ** ����
			break;
		case 1381:// �Լ���MDEF ** ����
			break;
//------------------------ ����(����)
		case 1400:// �������������� *������
			foreach($MyTeam as $char) {
				if($char->STATE !== DEAD)
					$alive++;
			}
			if($Quantity <= $alive) return true;
			break;
		case 1401:// �������������� *������
			foreach($MyTeam as $char) {
				if($char->STATE !== DEAD)
					$alive++;
			}
			if($alive <= $Quantity) return true;
			break;
		case 1405:// ���������� *������
			foreach($MyTeam as $char) {
				if($char->STATE === DEAD)
					$dead++;
			}
			if($Quantity <= $dead) return true;
			break;
		case 1406:// ���������� *������
			foreach($MyTeam as $char) {
				if($char->STATE === DEAD)
					$dead++;
			}
			if($dead <= $Quantity) return true;
			break;
		case 1410:// �ҷ�ǰ�ŵ��������� *������
			$front_alive	= 0;
			foreach($MyTeam as $char) {
				if($char->STATE !== DEAD && $char->position == FRONT)
					$front_alive++;
			}
			if($Quantity <= $front_alive) return true;
			break;
//------------------------ ����(��)
		case 1450:// �з����������� *������
			foreach($EnemyTeam as $char) {
				if($char->STATE !== DEAD)
					$alive++;
			}
			if($Quantity <= $alive) return true;
			break;
		case 1451:// �з����������� *������
			foreach($EnemyTeam as $char) {
				if($char->STATE !== DEAD)
					$alive++;
			}
			if($alive <= $Quantity) return true;
			break;
		case 1455:// �з������� *������
			foreach($EnemyTeam as $char) {
				if($char->STATE === DEAD)
					$dead++;
			}
			if($Quantity <= $dead) return true;
			break;
		case 1456:// �з������� *������
			foreach($EnemyTeam as $char) {
				if($char->STATE === DEAD)
					$dead++;
			}
			if($dead <= $Quantity) return true;
			break;
//------------------------ ����+ӽ��
		case 1500:// ����״̬�� *������
			foreach($MyTeam as $char) {
				if($char->STATE === DEAD) continue;
				if($char->expect_type === CHARGE)
					$charge++;
			}
			if($Quantity <= $charge) return true;
			break;
		case 1501:// ����״̬�� *������
			foreach($MyTeam as $char) {
				if($char->STATE === DEAD) continue;
				if($char->expect_type === CHARGE)
					$charge++;
			}
			if($charge <= $Quantity) return true;
			break;
		case 1505:// ӽ��״̬�� *������
			foreach($MyTeam as $char) {
				if($char->STATE === DEAD) continue;
				if($char->expect_type === CAST)
					$cast++;
			}
			if($Quantity <= $cast) return true;
			break;
		case 1506:// ӽ��״̬�� *������
			foreach($MyTeam as $char) {
				if($char->STATE === DEAD) continue;
				if($char->expect_type === CHARGE)
					$cast++;
			}
			if($cast <= $Quantity) return true;
			break;
		case 1510:// ����ӽ��״̬�� *������
			foreach($MyTeam as $char) {
				if($char->STATE === DEAD) continue;
				if($char->expect_type === CAST || $char->expect_type === CHARGE)
					$expect++;
			}
			if($Quantity <= $expect) return true;
			break;
		case 1511:// ����ӽ��״̬�� *������
			foreach($MyTeam as $char) {
				if($char->STATE === DEAD) continue;
				if($char->expect_type === CAST || $char->expect_type === CHARGE)
					$expect++;
			}
			if($expect <= $Quantity) return true;
			break;
//------------------------ ����+ӽ��(��)
		case 1550:// ����״̬���з���*������
			foreach($EnemyTeam as $char) {
				if($char->STATE === DEAD) continue;
				if($char->expect_type === CHARGE)
					$charge++;
			}
			if($Quantity <= $charge) return true;
			break;
		case 1551:// ����״̬���з���*������
			foreach($EnemyTeam as $char) {
				if($char->STATE === DEAD) continue;
				if($char->expect_type === CHARGE)
					$charge++;
			}
			if($charge <= $Quantity) return true;
			break;
		case 1555:// ӽ��״̬���з���*������
			foreach($EnemyTeam as $char) {
				if($char->STATE === DEAD) continue;
				if($char->expect_type === CAST)
					$cast++;
			}
			if($Quantity <= $cast) return true;
			break;
		case 1556:// ӽ��״̬���з���*������
			foreach($EnemyTeam as $char) {
				if($char->STATE === DEAD) continue;
				if($char->expect_type === CAST)
					$cast++;
			}
			if($cast <= $Quantity) return true;
			break;
		case 1560:// ����ӽ��״̬���з���*������
			foreach($EnemyTeam as $char) {
				if($char->STATE === DEAD) continue;
				if($char->expect_type === CAST || $char->expect_type === CHARGE)
					$expect++;
			}
			if($Quantity <= $expect) return true;
			break;
		case 1561:// ����ӽ��״̬���з���*������
			foreach($EnemyTeam as $char) {
				if($char->STATE === DEAD) continue;
				if($char->expect_type === CAST || $char->expect_type === CHARGE)
					$expect++;
			}
			if($expect <= $Quantity) return true;
			break;
//------------------------ ��
		case 1600:// �Լ����ڶ�״̬
			if($My->STATE === POISON) return true;
			break;
		case 1610:// �ҷ���״̬ **������
			foreach($MyTeam as $char) {
				if($char->STATE === DEAD) continue;
				if($char->STATE === POISON)
					$poison++;
			}
			if($Quantity <= $poison) return true;
			break;
		case 1611:// �ҷ���״̬ **������
			foreach($MyTeam as $char) {
				if($char->STATE === DEAD) continue;
				if($char->STATE === POISON)
					$poison++;
			}
			if($poison <= $Quantity) return true;
			break;
		case 1612:// �ҷ���״̬ **% ����
			foreach($MyTeam as $char) {
				if($char->STATE === DEAD) continue;
				$alive++;
				if($char->STATE === POISON)
					$poison++;
			}
			if(!$alive) return false;
			$Rate	= ($poison/$alive) * 100;
			if($Quantity <= $Rate) return true;
			break;
		case 1613:// �ҷ���״̬ **% ����
			foreach($MyTeam as $char) {
				if($char->STATE === DEAD) continue;
				$alive++;
				if($char->STATE === POISON)
					$poison++;
			}
			if(!$alive) return false;
			$Rate	= ($poison/$alive) * 100;
			if($Rate <= $Quantity) return true;
			break;
//------------------------ ��(��)
		case 1615:// �з���״̬ **������
			foreach($EnemyTeam as $char) {
				if($char->STATE === DEAD) continue;
				if($char->STATE === POISON)
					$poison++;
			}
			if($Quantity <= $poison) return true;
			break;
		case 1616:// �з���״̬ **������
			foreach($EnemyTeam as $char) {
				if($char->STATE === DEAD) continue;
				if($char->STATE === POISON)
					$poison++;
			}
			if($poison <= $Quantity) return true;
			break;
		case 1612:// �з���״̬ **% ����
			foreach($EnemyTeam as $char) {
				if($char->STATE === DEAD) continue;
				$alive++;
				if($char->STATE === POISON)
					$poison++;
			}
			if(!$alive) return false;
			$Rate	= ($poison/$alive) * 100;
			if($Quantity <= $Rate) return true;
			break;
		case 1613:// �з���״̬ **% ����
			foreach($EnemyTeam as $char) {
				if($char->STATE === DEAD) continue;
				$alive++;
				if($char->STATE === POISON)
					$poison++;
			}
			if(!$alive) return false;
			$Rate	= ($poison/$alive) * 100;
			if($Rate <= $Quantity) return true;
			break;
//------------------------ ����
		case 1700:// �Լ���ǰ��
			if($My->POSITION == FRONT) return true;
			break;
		case 1701:// �Լ��ں���
			if($My->POSITION == BACK) return true;
			break;
		case 1710:// ����ǰ�� **������
			$front	= 0;
			foreach($MyTeam as $char) {
				if($char->STATE === DEAD) continue;
				if($char->POSITION == FRONT)
					$front++;
			}
			if($Quantity <= $front) return true;
			break;
		case 1711:// ����ǰ�� **������
			$front	= 0;
			foreach($MyTeam as $char) {
				if($char->STATE === DEAD) continue;
				if($char->POSITION == FRONT)
					$front++;
			}
			if($front <= $Quantity) return true;
			break;
		case 1712:// ����ǰ�� **��
			$front	= 0;
			foreach($MyTeam as $char) {
				if($char->STATE === DEAD) continue;
				if($char->POSITION == FRONT)
					$front++;
			}
			if($front == $Quantity) return true;
			break;
		case 1715:// �������� **������
			$back	= 0;
			foreach($MyTeam as $char) {
				if($char->STATE === DEAD) continue;
				if($char->POSITION == BACK)
					$back++;
			}
			if($Quantity <= $back) return true;
			break;
		case 1716:// �������� **������
			$back	= 0;
			foreach($MyTeam as $char) {
				if($char->STATE === DEAD) continue;
				if($char->POSITION == BACK)
					$back++;
			}
			if($back <= $Quantity) return true;
			break;
		case 1717:// �������� **��
			$back	= 0;
			foreach($MyTeam as $char) {
				if($char->STATE === DEAD) continue;
				if($char->POSITION == BACK)
					$back++;
			}
			if($back == $Quantity) return true;
			break;
//------------------------ ����(��)
		case 1750:// �з�ǰ�� **������
			$front	= 0;
			foreach($EnemyTeam as $char) {
				if($char->STATE === DEAD) continue;
				if($char->POSITION == FRONT)
					$front++;
			}
			if($Quantity <= $front) return true;
			break;
		case 1751:// �з�ǰ�� **������
			$front	= 0;
			foreach($EnemyTeam as $char) {
				if($char->STATE === DEAD) continue;
				if($char->POSITION == FRONT)
					$front++;
			}
			if($front <= $Quantity) return true;
			break;
		case 1752:// �з�ǰ�� **��
			$front	= 0;
			foreach($EnemyTeam as $char) {
				if($char->STATE === DEAD) continue;
				if($char->POSITION == FRONT)
					$front++;
			}
			if($Quantity == $front) return true;
			break;
		case 1755:// �з����� **������
			$back	= 0;
			foreach($EnemyTeam as $char) {
				if($char->STATE === DEAD) continue;
				if($char->POSITION == BACK)
					$back++;
			}
			if($Quantity <= $back) return true;
			break;
		case 1756:// �з����� **������
			$back	= 0;
			foreach($EnemyTeam as $char) {
				if($char->STATE === DEAD) continue;
				if($char->POSITION == BACK)
					$back++;
			}
			if($back <= $Quantity) return true;
			break;
		case 1757:// �з����� **��
			$back	= 0;
			foreach($EnemyTeam as $char) {
				if($char->STATE === DEAD) continue;
				if($char->POSITION == BACK)
					$back++;
			}
			if($Quantity == $back) return true;
			break;
//------------------------ �ٻ�
		case 1800:// �������ٻ���**ƥ����
			$summon	= 0;
			foreach($MyTeam as $char) {
				//if($char->STATE === DEAD) continue;
				if($char->summon)
					$summon++;
			}
			if($Quantity <= $summon) return true;
			break;
		case 1801:// �������ٻ���**ƥ����
			$summon	= 0;
			foreach($MyTeam as $char) {
				//if($char->STATE === DEAD) continue;
				if($char->summon)
					$summon++;
			}
			if($summon <= $Quantity) return true;
			break;

		case 1805:// �������ٻ���**ƥ
			$summon	= 0;
			foreach($MyTeam as $char) {
				//if($char->STATE === DEAD) continue;
				if($char->summon)
					$summon++;
			}
			if($summon == $Quantity) return true;
			break;
//------------------------ �ٻ�(��)
		case 1820:// �з����ٻ���**ƥ����
			$summon	= 0;
			foreach($EnemyTeam as $char) {
				//if($char->STATE === DEAD) continue;
				if($char->summon)
					$summon++;
			}
			if($Quantity <= $summon) return true;
			break;
		case 1821:// �з����ٻ���**ƥ����
			$summon	= 0;
			foreach($EnemyTeam as $char) {
				//if($char->STATE === DEAD) continue;
				if($char->summon)
					$summon++;
			}
			if($summon <= $Quantity) return true;
			break;
		case 1825:// �з����ٻ���**ƥ
			$summon	= 0;
			foreach($EnemyTeam as $char) {
				//if($char->STATE === DEAD) continue;
				if($char->summon)
					$summon++;
			}
			if($summon == $Quantity) return true;
			break;
//------------------------ ħ����
		case 1840:// ������ħ������**������
			if($Quantity <= $MyTeamMC)
				return true;
			break;
		case 1841:// ������ħ������**������
			if($MyTeamMC <= $Quantity)
				return true;
			break;
		case 1845:// ������ħ������**��
			if($Quantity == $MyTeamMC)
				return true;
			break;
//------------------------ ħ����(��)
		case 1850:// �з���ħ������**������
			if($Quantity <= $EnemyTeamMC)
				return true;
			break;
		case 1851:// �з���ħ������**������
			if($EnemyTeamMC <= $Quantity)
				return true;
			break;
		case 1855:// �з���ħ������**��
			if($Quantity == $EnemyTeamMC)
				return true;
			break;
//------------------------ ָ���ж�����
		case 1900:// �Լ����ж�����**������
			if(($Quantity-1) <= $My->ActCount) return true;
			break;
		case 1901:// �Լ����ж�����**������
			if($My->ActCount <= ($Quantity-1)) return true;
			break;
		case 1902:// �Լ����ж�����**�غ�
			if($My->ActCount == ($Quantity-1)) return true;
			break;
//------------------------ �غ�����
		case 1920:// �ڡ����� �ض�
			if($My->JdgCount[$number] < $Quantity) return true;
			break;
//------------------------ ����
		case 1940:// **%�ĸ���
			$prob	= mt_rand(1,100);
			if($prob <= $Quantity) return true;
			break;
//------------------------ �����ж�
		case 9000:// �з�Lv������������
			foreach($EnemyTeam as $char) {
				if($Quantity <= $char->level)
					return true;
			}
			break;
	}
}
//////////////////////////////////////////////////
//	SP�����ã�����
function &FuncTeamHpSpRate(&$TeamHpRate,$NO) {
	foreach($TeamHpRate as $key => $Rate) {
		if($Rate <= $NO)
			$target[]	= &$MyTeam[$key];
	}
	return $target ? $target : false;
}
?>