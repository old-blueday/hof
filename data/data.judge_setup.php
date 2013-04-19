<?php
function LoadJudgeData($no) {
/*
	�ж�����
	HP
	SP
	����(�Լ�����������)
	״̬������������
	�Լ����ж�����
	�غ��޶�
	���ֵ�״̬
	�����ĸ���
*/
	$Quantity	= '����';
	switch($no) {
		case 1000:// �ض�
			$judge["exp"]	= "�ض�";
			break;
		case 1001:// pass
			$judge["exp"]	= "�������ж�";
			break;
//------------------------ HP
		case 1099:
			$judge["exp"]	= "HP";
			$judge["css"]	= true;
			break;
		case 1100:// �Լ���HP {$Quantity}(%)����
			$judge["exp"]	= "�Լ���HP {$Quantity}(%)����";
			break;
		case 1101:// �Լ���HP {$Quantity}(%)����
			$judge["exp"]	= "�Լ���HP {$Quantity}(%)����";
			break;
		case 1105:// �Լ���HP {$Quantity}����
			$judge["exp"]	= "�Լ���HP {$Quantity}����";
			break;
		case 1106:// �Լ���HP {$Quantity}����
			$judge["exp"]	= "�Լ���HP {$Quantity}����";
			break;
		case 1110:// ���HP {$Quantity}����
			$judge["exp"]	= "���HP {$Quantity}����";
			break;
		case 1111:// ���HP {$Quantity}����
			$judge["exp"]	= "���HP {$Quantity}����";
			break;
		case 1121:// �ҷ� HP{$Quantity}(%)����HP
			$judge["exp"]	= "�ҷ� HP{$Quantity}(%)����";
			break;
		case 1125:// �ҷ�ƽ��HP {$Quantity}(%)���Ϥλ�
			$judge["exp"]	= "�ҷ�ƽ��HP {$Quantity}(%)����";
			break;
		case 1126:// �ҷ�ƽ��HP {$Quantity}(%)���¤λ�
			$judge["exp"]	= "�ҷ�ƽ��HP {$Quantity}(%)����";
			break;
//------------------------ SP
		case 1199:
			$judge["exp"]	= "SP";
			$judge["css"]	= true;
			break;
		case 1200:// �Լ���SP{$Quantity}(%)����
			$judge["exp"]	= "�Լ���SP{$Quantity}(%)����";
			break;
		case 1201:// �Լ���SP{$Quantity}(%)����
			$judge["exp"]	= "�Լ���SP{$Quantity}(%)����";
			break;
		case 1205:// �Լ���SP{$Quantity}����
			$judge["exp"]	= "�Լ���SP{$Quantity}����";
			break;
		case 1206:// �Լ���SP{$Quantity}����
			$judge["exp"]	= "�Լ���SP{$Quantity}����";
			break;
		case 1210:// ���SP{$Quantity}����
			$judge["exp"]	= "���SP{$Quantity}����";
			break;
		case 1211:// ���SP{$Quantity}����
			$judge["exp"]	= "���SP{$Quantity}����";
			break;
		case 1221:// �ҷ� SP{$Quantity}(%)����HP
			$judge["exp"]	= "�ҷ� SP{$Quantity}(%)����";
			break;
		case 1225:// �ҷ�ƽ��SP {$Quantity}(%)���Ϥλ�
			$judge["exp"]	= "�ҷ�ƽ��SP {$Quantity}(%)����";
			break;
		case 1226:// �ҷ�ƽ��SP {$Quantity}(%)���¤λ�
			$judge["exp"]	= "�ҷ�ƽ��SP {$Quantity}(%)����";
			break;
/*
//------------------------ STR
		case 1299:
			$judge["exp"]	= "STR";
			break;
		case 1300:// �Լ���STR{$Quantity} ����
			$judge["exp"]	= "�Լ���STR{$Quantity} ����";
			break;
		case 1301:// �Լ���STR{$Quantity} ����
			$judge["exp"]	= "�Լ���STR{$Quantity} ����";
			break;
//------------------------ INT
		case 1309:
			$judge["exp"]	= "INT";
			break;
		case 1310:// �Լ���INT{$Quantity} ����
			$judge["exp"]	= "�Լ���INT{$Quantity} ����";
			break;
		case 1311:// �Լ���INT{$Quantity} ����
			$judge["exp"]	= "�Լ���INT{$Quantity} ����";
			break;
//------------------------ DEX
		case 1319:
			$judge["exp"]	= "DEX";
			break;
		case 1320:// �Լ���DEX{$Quantity} ����
			$judge["exp"]	= "�Լ���DEX{$Quantity} ����";
			break;
		case 1321:// �Լ���DEX{$Quantity} ����
			$judge["exp"]	= "�Լ���DEX{$Quantity} ����";
			break;
//------------------------ SPD
		case 1329:
			$judge["exp"]	= "SPD";
			break;
		case 1330:// �Լ���SPD{$Quantity} ����
			$judge["exp"]	= "�Լ���SPD{$Quantity} ����";
			break;
		case 1331:// �Լ���SPD{$Quantity} ����
			$judge["exp"]	= "�Լ���SPD{$Quantity} ����";
			break;
//------------------------ LUK
		case 1339:
			$judge["exp"]	= "LUK";
			break;
		case 1340:// �Լ���LUK{$Quantity} ����
			$judge["exp"]	= "�Լ���LUK{$Quantity} ����";
			break;
		case 1341:// �Լ���LUK{$Quantity} ����
			$judge["exp"]	= "�Լ���LUK{$Quantity} ����";
			break;
//------------------------ ATK
		case 1349:
			$judge["exp"]	= "ATK";
			break;
		case 1350:// �Լ���ATK{$Quantity} ����
			$judge["exp"]	= "�Լ���ATK{$Quantity} ����";
			break;
		case 1351:// �Լ���ATK{$Quantity} ����
			$judge["exp"]	= "�Լ���ATK{$Quantity} ����";
			break;
//------------------------ MATK
		case 1359:
			$judge["exp"]	= "MATK";
			break;
		case 1360:// �Լ���MATK{$Quantity} ����
			$judge["exp"]	= "�Լ���MATK{$Quantity} ����";
			break;
		case 1361:// �Լ���MATK{$Quantity} ����
			$judge["exp"]	= "�Լ���MATK{$Quantity} ����";
			break;
//------------------------ DEF
		case 1369:
			$judge["exp"]	= "DEF";
			break;
		case 1370:// �Լ���DEF{$Quantity} ����
			$judge["exp"]	= "�Լ���DEF{$Quantity} ����";
			break;
		case 1371:// �Լ���DEF{$Quantity} ����
			$judge["exp"]	= "�Լ���DEF{$Quantity} ����";
			break;
//------------------------ MDEF
		case 1379:
			$judge["exp"]	= "MDEF";
			break;
		case 1380:// �Լ���MDEF{$Quantity} ����
			$judge["exp"]	= "�Լ���MDEF{$Quantity} ����";
			break;
		case 1381:// �Լ���MDEF{$Quantity} ����
			$judge["exp"]	= "�Լ���MDEF{$Quantity} ����";
			break;
*/
//------------------------ ����(����)
		case 1399:
			$judge["exp"]	= "����";
			$judge["css"]	= true;
			break;
		case 1400:// �ҷ��������� {$Quantity}������
			$judge["exp"]	= "�ҷ��������� {$Quantity}������";
			break;
		case 1401:// �ҷ��������� {$Quantity}������
			$judge["exp"]	= "�ҷ��������� {$Quantity}������";
			break;
		case 1405:// �ҷ������� {$Quantity}������
			$judge["exp"]	= "�ҷ������� {$Quantity}������";
			break;
		case 1406:// �ҷ������� {$Quantity}������
			$judge["exp"]	= "�ҷ������� {$Quantity}������";
			break;
		case 1410:// ����ǰ�ŵ����� {$Quantity}������
			$judge["exp"]	= "�ҷ�ǰ�ŵ������� {$Quantity}������";
			break;
//------------------------ �������У�
		case 1449:
			$judge["exp"]	= "����(��)";
			$judge["css"]	= true;
			break;
		case 1450:// �з��������� {$Quantity}������
			$judge["exp"]	= "�з��������� {$Quantity}������";
			break;
		case 1451:// �з��������� {$Quantity}������
			$judge["exp"]	= "�з��������� {$Quantity}������";
			break;
		case 1455:// �з������� {$Quantity}������
			$judge["exp"]	= "�з������� {$Quantity}������";
			break;
		case 1456:// �з������� {$Quantity}������
			$judge["exp"]	= "�з������� {$Quantity}������";
			break;
//------------------------ ӽ��
		case 1499:
			$judge["exp"]	= "����+ӽ��";
			$judge["css"]	= true;
			break;
		case 1500:// ����ӽ��״̬�� {$Quantity}������
			$judge["exp"]	= "����״̬�� {$Quantity}������";
			break;
		case 1501:// ����ӽ��״̬�� {$Quantity}������
			$judge["exp"]	= "����״̬�� {$Quantity}������";
			break;
		case 1505:// ����ӽ��״̬��{$Quantity}������
			$judge["exp"]	= "ӽ��״̬��{$Quantity}������";
			break;
		case 1506:// ����ӽ��״̬��{$Quantity}������
			$judge["exp"]	= "ӽ��״̬��{$Quantity}������";
			break;
		case 1510:// ����ӽ��״̬��{$Quantity}������
			$judge["exp"]	= "����ӽ��״̬��{$Quantity}������";
			break;
		case 1511:// ����ӽ��״̬��{$Quantity}������
			$judge["exp"]	= "����ӽ��״̬��{$Quantity}������";
			break;
//------------------------ ӽ��(��)
		case 1549:
			$judge["exp"]	= "ӽ��(��)";
			$judge["css"]	= true;
			break;
		case 1550:// �з�����״̬�� {$Quantity}������
			$judge["exp"]	= "�з�����״̬�� {$Quantity}������";
			break;
		case 1551:// �з�����״̬�� {$Quantity}������
			$judge["exp"]	= "�з�����״̬�� {$Quantity}������";
			break;
		case 1555:// �з�ӽ��״̬�� {$Quantity}������
			$judge["exp"]	= "�з�ӽ��״̬�� {$Quantity}������";
			break;
		case 1556:// �з�ӽ��״̬�� {$Quantity}������
			$judge["exp"]	= "�з�ӽ��״̬�� {$Quantity}������";
			break;
		case 1560:// �����з�ӽ��״̬�� {$Quantity}������
			$judge["exp"]	= "�з�ӽ������״̬�� {$Quantity}������";
			break;
		case 1561:// �����з�ӽ��״̬�� {$Quantity}������
			$judge["exp"]	= "�з�����ӽ��״̬�� {$Quantity}������";
			break;
//------------------------ ��
		case 1599:
			$judge["exp"]	= "��";
			$judge["css"]	= true;
			break;
		case 1600:// ��ʬ������
			$judge["exp"]	= "�Լ����ڶ�״̬";
			break;
		case 1610:// �ҷ���״̬ {$Quantity}������
			$judge["exp"]	= "�ҷ���״̬ {$Quantity}������";
			break;
		case 1611:// �ҷ���״̬ {$Quantity}������
			$judge["exp"]	= "�ҷ���״̬ {$Quantity}������";
			break;
		case 1612:// �ҷ���״̬ {$Quantity}% ����
			$judge["exp"]	= "�ҷ���״̬ {$Quantity}% ����";
			break;
		case 1613:// �ҷ���״̬ {$Quantity}% ����
			$judge["exp"]	= "�ҷ���״̬ {$Quantity}% ����";
			break;
//------------------------ ��(��)
		case 1614:
			$judge["exp"]	= "��(��)";
			$judge["css"]	= true;
			break;
		case 1615:// �з���״̬ {$Quantity}������
			$judge["exp"]	= "�з���״̬ {$Quantity}������";
			break;
		case 1616:// �з���״̬ {$Quantity}������
			$judge["exp"]	= "�з���״̬ {$Quantity}������";
			break;
		case 1617:// �з���״̬ {$Quantity}% ����
			$judge["exp"]	= "�з���״̬ {$Quantity}% ����";
			break;
		case 1618:// �з���״̬ {$Quantity}% ����
			$judge["exp"]	= "�з���״̬ {$Quantity}% ����";
			break;
//------------------------ ����
		case 1699:
			$judge["exp"]	= "����";
			$judge["css"]	= true;
			break;
		case 1700:// �Լ���ǰ��
			$judge["exp"]	= "�Լ���ǰ��";
			break;
		case 1701:// �Լ��ں���
			$judge["exp"]	= "�Լ��ں���";
			break;
		case 1710:// �ҷ�ǰ��{$Quantity}������
			$judge["exp"]	= "�ҷ�ǰ��{$Quantity}������";
			break;
		case 1711:// �ҷ�ǰ��{$Quantity}������
			$judge["exp"]	= "�ҷ�ǰ��{$Quantity}������";
			break;
		case 1712:// �ҷ�ǰ��{$Quantity}������
			$judge["exp"]	= "�ҷ�ǰ��{$Quantity}��";
			break;
		case 1715:// �ҷ�����{$Quantity}������
			$judge["exp"]	= "�ҷ�����{$Quantity}������";
			break;
		case 1716:// �ҷ�����{$Quantity}������
			$judge["exp"]	= "�ҷ�����{$Quantity}������";
			break;
		case 1717:// �ҷ�����{$Quantity}������
			$judge["exp"]	= "�ҷ�����{$Quantity}��";
			break;
//------------------------ ����(��)
		case 1749:
			$judge["exp"]	= "����(��)";
			$judge["css"]	= true;
			break;
		case 1750:// �з�ǰ��{$Quantity}������
			$judge["exp"]	= "�з�ǰ��{$Quantity}������";
			break;
		case 1751:// �з�ǰ��{$Quantity}������
			$judge["exp"]	= "�з�ǰ��{$Quantity}������";
			break;
		case 1752:// �з�ǰ��{$Quantity}��
			$judge["exp"]	= "�з�ǰ��{$Quantity}��";
			break;
		case 1755:// �з�����{$Quantity}������
			$judge["exp"]	= "�з�����{$Quantity}������";
			break;
		case 1756:// �з�����{$Quantity}������
			$judge["exp"]	= "�з�����{$Quantity}������";
			break;
		case 1757:// �з�����{$Quantity}��
			$judge["exp"]	= "�з�����{$Quantity}��";
			break;
//------------------------ �ٻ�
		case 1799:
			$judge["exp"]	= "�ٻ�";
			$judge["css"]	= true;
			break;
		case 1800:// �ҷ����ٻ��� {$Quantity}ƥ����
			$judge["exp"]	= "�ҷ����ٻ��� {$Quantity}ƥ����";
			break;
		case 1801:// �ҷ����ٻ��� {$Quantity}ƥ����
			$judge["exp"]	= "�ҷ����ٻ��� {$Quantity}ƥ����";
			break;
		case 1805:// �ҷ����ٻ��� {$Quantity}ƥ
			$judge["exp"]	= "�ҷ����ٻ��� {$Quantity}ƥ";
			break;
//------------------------ �ٻ�(��)
		case 1819:
			$judge["exp"]	= "�ٻ�(��)";
			$judge["css"]	= true;
			break;
		case 1820:// �з����ٻ��� {$Quantity}ƥ����
			$judge["exp"]	= "�з����ٻ��� {$Quantity}ƥ����";
			break;
		case 1821:// �з����ٻ��� {$Quantity}ƥ����
			$judge["exp"]	= "�з����ٻ��� {$Quantity}ƥ����";
			break;
		case 1825:// �з����ٻ��� {$Quantity}ƥ
			$judge["exp"]	= "�з����ٻ��� {$Quantity}ƥ";
			break;
//------------------------ ħ����
		case 1839:
			$judge["exp"]	= "ħ����";
			$judge["css"]	= true;
			break;
		case 1840:// �ҷ���ħ������ {$Quantity}������
			$judge["exp"]	= "�ҷ���ħ������ {$Quantity}������";
			break;
		case 1841:// �ҷ���ħ������ {$Quantity}������
			$judge["exp"]	= "�ҷ���ħ������ {$Quantity}������";
			break;
		case 1845:// �ҷ���ħ������ {$Quantity}��
			$judge["exp"]	= "�ҷ���ħ������ {$Quantity}��";
			break;
//------------------------ ħ����(��)
		case 1849:
			$judge["exp"]	= "ħ����(��)";
			$judge["css"]	= true;
			break;
		case 1850:// �з���ħ������ {$Quantity}������
			$judge["exp"]	= "�з���ħ������ {$Quantity}������";
			break;
		case 1851:// �з���ħ������ {$Quantity}������
			$judge["exp"]	= "�з���ħ������ {$Quantity}������";
			break;
		case 1855:// �з���ħ������ {$Quantity}��
			$judge["exp"]	= "�з���ħ������ {$Quantity}��";
			break;

//------------------------ ָ���ж�����
		case 1899:
			$judge["exp"]	= "ָ���ж�����";
			$judge["css"]	= true;
			break;
		case 1900:// �Լ����ж����� {$Quantity}������
			$judge["exp"]	= "�Լ����ж����� {$Quantity}������";
			break;
		case 1901:// �Լ����ж����� {$Quantity}������
			$judge["exp"]	= "�Լ����ж����� {$Quantity}������";
			break;
		case 1902:// �Լ��ĵ� {$Quantity}�غ�
			$judge["exp"]	= "�Լ��ĵ� {$Quantity}�غ�";
			break;
//------------------------ �غ�����
		case 1919:
			$judge["exp"]	= "�غ�����";
			$judge["css"]	= true;
			break;
		case 1920:// {$Quantity}�� �ض�"
			$judge["exp"]	= "��{$Quantity}�� �ض�";
			break;
//------------------------ ����
		case 1939:
			$judge["exp"]	= "����";
			$judge["css"]	= true;
			break;
		case 1940:// {$Quantity}%�ĸ���
			$judge["exp"]	= "{$Quantity}%�ĸ���";
			break;
//----------------------- ����
		case 9000:// �з�Lv�������ϡ�
			$judge["exp"]	= "�з�Lv����{$Quantity}����";
			break;
		default:
$judge	= false;
	}
	return $judge;
}
?>