<?php
// ������
function CanCreate2($user) {

/*	// ����ʾ�˕r�g������ 
	// �����ƥ�ǩ`����need���O������Ƥ��Τ�ȫ���Ԅ�ȡ�ä���
	for($i=1000; $i<10000; $i++) {
		$item	= LoadItemData($i);
		if(!$item) continue;
		if($item["need"])
			$create[]	= $i;
	}
	return $create;
*/
	// ��
	$create2	= array(1030,1127,1231,1232,1233,1234,1235,1306,1405,1506,1605,1724,1725,1726,1759,1760,1819,2027,2054,2112,2113,2114,2218,3016,3111,3415,3416,3417,5020,5114,5214,);

	//  ��������Ʒ
	$create2	= array_merge($create2,
	array(9021,9022,9023,9024,)
	);
	
	
	return $create2;
	
	
}
// �жϵ�������
function HaveNeeds($item,$UserItem) {
	// û�е��ߵ����
	if(!$UserItem) return false;
	// ���󵽲��������������
	if(!$item["need"]) return false;
	foreach($item["need"] as $NeedNo => $Amount) {
		if($UserItem[$NeedNo] < $Amount)
			return false;
	}
	return true;
}

// ���������ص�����
function ItemAbilityPossibility($type) {
	switch($type) {
		case "��":
		case "˫�ֽ�":
		case "̫��":
		case "ذ��":
		case "ħ��":
		case "��":
		case "��":
		case "��":
		case "�л��":
		case "��ǹ":
		case "��ǹ":
		case "����ǹ":
		case "Ȩ��":
		case "��":
		case "ǹ":
		case "ì":
		case "��Լʯ":
		case "а��":
		case "���｣":
		case "����":
		case "ս��":
		case "ʥʮ��":
		case "˫��(��)":
		case "˫��(��)":
		case "צ":
		case "ħ��ɨ��":
		case "�ɽ�":
		case "����":
		case "����":
		
			$low	= array(
			// Atk+
			100,101,102,103,104,
			105,106,107,108,109,
			// Matk+
			150,151,152,153,154,
			155,156,157,158,159,
			// Atk*
			204,200,205,201,
			// Matk*
			254,250,255,251,
			// HP+
			H00,H01,H02,
			// HP*
			HM0,HM1,HM2,
			// SP+
			S00,S01,
			// SP*
			SM0,SM1,SM2,
			// SPD+
			A00,A01,A02,A03,A04,
			);
			$high	= array(
			// Atk+
			110,111,112,113,114,
			115,116,117,118,119,
			// Matk+
			160,161,162,163,164,
			165,166,167,168,169,
			// Atk*
			202,206,203,
			// Matk*
			252,256,253,
			// HP+
			H03,H04,H05,
			// HP*
			HM3,HM4,HM5,
			// SP+
			S02,S03,
			// SP*
			SM3,SM4,SM5,
			// SPD+
			A05,A06,A07,A08,A09,
			);
			break;
		case "��":
		case "ˮ����":
		case "��":
		case "��":
		case "�·�":
		case "����":
		case "����":
		case "ͷ��":
			$low	= array(
			// Def +
			300,301,
			// Mdef +
			350,351,
			// HP+
			H00,H01,H02,
			// HP*
			HM0,HM1,HM2,
			// SP+
			S00,S01,
			// SP*
			SM0,SM1,SM2,
			// SPD+
			A00,A01,A02,A03,A04,
			);
			$high	= array(
			// Def +
			302,303,304,
			// Mdef +
			352,353,354,
			// HP+
			H03,H04,H05,
			// HP*
			HM3,HM4,HM5,
			// SP+
			S02,S03,
			// SP*
			SM3,SM4,SM5,
			// All+
			A05,A06,A07,A08,A09,
			);
			break;
		//////////////
		
		case "ѫ��":
			$low	= array(
			// Atk*
			202,206,203,
			// Matk*
			252,256,253,
			);
			$high	= array(
			// HP*
			HM5,
			// SP*
			SM5,
			// All+
			A05,A09,
			304,354,
			);
			break;
	}
	return array($low,$high);
}
?>