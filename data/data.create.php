<?php
// ������
function CanCreate($user) {

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
	$create	= array(1000,1001,1002,1003,1004,1005,1006,1007,1008,1009,1010,1011,1012,1013,1020,1021,1022,1023,1024,1025);
	// ˫�ֽ�
	$create	= array_merge($create,
	array(1100,1101,1102,1103,1104,1105,1106,1107,1108,1109,1120,1121)
	);
	// �̽�
	$create	= array_merge($create,
	array(1201,1202,1203,1204,1205,1206,1207,1208,1209,1220,1221)
	);
	// ��
	$create	= array_merge($create,
	array(1700,1701,1702,1703,1704,1705,1706,1707,1708,1709,1710,)
	);
	// ˫����
	$create	= array_merge($create,
	array(1800,1801,1802,1803,1804,1805,1806,1807,1808,1810,1811,1812,1813,1814,)
	);
	// ��
	$create	= array_merge($create,
	array(2000,2001,2002,2003,2004,2005,2006,2007,2008,2009,2010,2011,2020,2021,)
	);
	// ��
	$create	= array_merge($create,
	array(2200,2201,2202,2203,2204,2205,2206,2210,2211,2212,2213,)
	);
	// ��
	$create	= array_merge($create,
	array(3000,3001,3002,3003,3004,3005,3006,3007,3008,3009,3010,3011,3012,)
	);
	// ��
	$create	= array_merge($create,
	array(3101,3102,3103,3104,3105,3106,)
	);
	// ��
	$create	= array_merge($create,
	array(5000,5001,5002,5003,5004,5005,5006,5007,5008,5009,5010,5011,5012,5013,5014,5015,5016,5017,5018,)
	);
	// ��
	$create	= array_merge($create,
	array(5100,5101,5102,5103,5104,5105,5106,5107,5108,5109,)
	);
	// ��
	$create	= array_merge($create,
	array(5200,5201,5202,5203,5204,5205,5206,5207,5208,)
	);
	return $create;
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
		case "ذ��":
		case "ħ��":
		case "��":
		case "��":
		case "��":
			$low	= array(
			// Atk+
			100,101,102,103,104,
			105,106,107,108,109,
			// Matk+
			150,151,152,153,154,
			155,156,157,158,159,
			// Atk*
			200,201,
			// Matk*
			250,251,
			// HP+
			H00,H01,H02,
			// HP*
			HM0,HM1,HM2,
			// SP+
			S00,S01,
			// SP*
			SM0,SM1,SM2,
			// STR+
			P00,P01,P02,P03,P04,
			// INT+
			I00,I01,I02,I03,I04,
			// DEX+
			D00,D01,D02,D03,D04,
			// SPD+
			A00,A01,A02,A03,A04,
			// LUK+
			L00,L01,L02,L03,L04,
			);
			$high	= array(
			// Atk+
			110,111,112,113,114,
			115,116,117,118,119,
			// Matk+
			160,161,162,163,164,
			165,166,167,168,169,
			// Atk*
			202,203,
			// Matk*
			252,253,
			// HP+
			H03,H04,H05,
			// HP*
			HM3,HM4,HM5,
			// SP+
			S02,S03,
			// SP*
			SM3,SM4,SM5,
			// STR+
			P05,P06,P07,P08,P09,
			// INT+
			I05,I06,I07,I08,I09,
			// DEX+
			D05,D06,D07,D08,D09,
			// SPD+
			A05,A06,A07,A08,A09,
			// LUK+
			L05,L06,L07,L08,L09,
			);
			break;
		case "��":
		case "��":
		case "��":
		case "�·�":
		case "����":
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
			// STR+
			P00,P01,P02,P03,P04,
			// INT+
			I00,I01,I02,I03,I04,
			// DEX+
			D00,D01,D02,D03,D04,
			// SPD+
			A00,A01,A02,A03,A04,
			// LUK+
			L00,L01,L02,L03,L04,
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
			// STR+
			P05,P06,P07,P08,P09,
			// INT+
			I05,I06,I07,I08,I09,
			// DEX+
			D05,D06,D07,D08,D09,
			// SPD+
			A05,A06,A07,A08,A09,
			// LUK+
			L05,L06,L07,L08,L09,
			);
			break;
	}
	return array($low,$high);
}
?>