<?php 
/**
"name"	=> "��ǰ",
	"img"	=> "skill_042.png",//����
	"exp"	=> "�����h��",
	"sp"	=> "���Msp",
	"type"	=> "0",//0=���� 1=ħ��
	"target"=> array(friend/enemy/all/self,individual/multi/all,���Ļ���),
		----(��)----------------------------------------
			frien/enemy	= ζ��/��
			all			= ζ��+�� ȫ��
			self		= �����
		enemy individual 1	= ��һ�ˤ�1��
		enemy individual 3	= ��һ�ˤ�3��
		enemy multi 3		= ��(�l��3��)��1�ؤŤ�(���}�ο������Ф�)
		enemy all 1			= ��ȫ�T��1�ع���
		all individual 5	= ζ����ȫ����l��һ�ˤ�5��
		all multi 5			= ζ����ȫ����l��5�ˤ�1�ؤŤ�(���}�ο������Ф�)
		all all 3			= ζ����ȫ�T��3�ؤŤ�
		------------------------------------------------
	"pow"	=> "100",// 100�Ǹ�ä��郎���ʤˤʤ�... 130=1.3�� 100 ��������
	// "hit"	=> "100",// (���������...���γɹ���...?)
	"invalid"	=> "1",//���l�򤫤Ф�������o����
	"support"	=> "1",//ζ����֧Ԯħ��(�������e����Ҫ)
	"priority"	=> "LowHpRate",//���`���åȤ΃���(LowHpRate,Dead,Summon,Charge)
	//"charge"	=> "",//������ԁ�����ˤޤǤΕr�g��顢�����A��r�g��(0=ԁ���o��)
	//"stiff"	=> "",//�Є����Ӳֱ�r�g(0=Ӳֱ�o�� 100=���C�r�g2��(���C�r�g=Ӳֱ�r�g) )
	"charge" => array(charge,stiff),//���Фˉ����
	"learn"	=> "���ä˱�Ҫ�ʥݥ������",
	"Up**"
	"Down**"
	"pierce"
	"delay"
	"knockback"
	"poison"
	"summon"
	"move"
	"strict" => array("Bow"=>true),//��������
	"umove" // ʹ���ߤ��Ƅӡ�
	"DownSTR"	=> "40",// IND DEX SPD LUK ATK MATK DEF MDEF HP SP
	"UpSTR"
	"PlusSTR"	=> 50,

*/
function LoadSkillData($no) {
	switch($no) {
		case "1000":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_042.png",
"exp"	=> "ͨ������",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "0",
"target"=> array("enemy","individual",1),
"pow"	=> "100",
); break;
		case "1001":
$skill	= array(
"name"	=> "ʹ��",
"img"	=> "skill_032.png",
"exp"	=> "",
"sp"	=> "8",
"type"	=> "0",
"learn"	=> "0",
"target"=> array("enemy","individual",1),
"pow"	=> "160",
"charge"=> array(20,20),
); break;
		case "1002":
$skill	= array(
"name"	=> "������",
"img"	=> "skill_018.png",
"exp"	=> "",
"sp"	=> "20",
"type"	=> "1",
"learn"	=> "0",
"target"=> array("enemy","multi",4),
"pow"	=> "100",
"invalid"	=> "1",
"charge"=> array(60,0),
); break;
		case "1003":
$skill	= array(
"name"	=> "˫�ش��",
"img"	=> "skill_073.png",
"exp"	=> "",
"sp"	=> "15",
"type"	=> "0",
"learn"	=> "4",
"target"=> array("enemy","individual",2),
"pow"	=> "90",
); break;
//---------------------------------------------------//
//  1010 �ޤǤϾ��������ä�����                   //
//---------------------------------------------------//
		case "1011":
$skill	= array(
"name"	=> "�ƻ�����",
"img"	=> "skill_072.png",
"exp"	=> "����������",
"sp"	=> "30",
"type"	=> "0",
"learn"	=> "6",
"target"=> array("enemy","individual",1),
"pow"	=> "100",
"charge"=> array(0,0),
"DownATK" => "50",
"DownMATK" => "50",
); break;
		case "1012":
$skill	= array(
"name"	=> "�ƻ�װ��",
"img"	=> "skill_072.png",
"exp"	=> "����������",
"sp"	=> "30",
"type"	=> "0",
"learn"	=> "6",
"target"=> array("enemy","individual",1),
"pow"	=> "100",
"charge"=> array(0,0),
"DownDEF" => "30",
"DownMDEF" => "30",
); break;
		case "1013":
$skill	= array(
"name"	=> "ͻ��",
"img"	=> "skill_074.png",
"exp"	=> "",
"sp"	=> "15",
"type"	=> "0",
"learn"	=> "4",
"target"=> array("enemy","individual",1),
"pow"	=> "190",
"charge"=> array(0,40),
); break;
		case "1014":
$skill	= array(
"name"	=> "����ͻ��",
"img"	=> "skill_074z.png",
"exp"	=> "",
"sp"	=> "50",
"type"	=> "0",
"learn"	=> "8",
"target"=> array("enemy","individual",1),
"pow"	=> "360",
"charge"=> array(0,50),
); break;
		case "1015":
$skill	= array(
"name"	=> "�ƺ�",
"img"	=> "skill_075.png",
"exp"	=> "������",
"sp"	=> "60",
"type"	=> "0",
"learn"	=> "10",
"target"=> array("enemy","individual",1),
"pow"	=> "150",
"charge"=> array(40,20),
"knockback"	=> "100",
); break;
		case "1016":
$skill	= array(
"name"	=> "�̴�װ��",
"img"	=> "skill_077.png",
"exp"	=> "���ӷ�����",
"sp"	=> "30",
"type"	=> "0",
"learn"	=> "6",
"target"=> array("enemy","individual",1),
"pow"	=> "170",
"charge"=> array(40,40),
"pierce"=> true,
); break;
		case "1017":
$skill	= array(
"name"	=> "��ŭһ��",
"img"	=> "skill_031.png",
"exp"	=> "",
"sp"	=> "40",
"type"	=> "0",
"learn"	=> "6",
"target"=> array("enemy","multi",5),
"pow"	=> "100",
"charge"=> array(40,60),
); break;
		case "1018":
$skill	= array(
"name"	=> "�����Ҵ�",
"img"	=> "skill_031z.png",
"exp"	=> "���ֵ��ҵ�ȫԱ����",
"sp"	=> "65",
"type"	=> "0",
"learn"	=> "10",
"target"=> array("all","multi",8),
"pow"	=> "100",
"invalid"	=> true,
"charge"=> array(50,100),
); break;
		case "1019":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_077z.png",
"exp"	=> "���ӷ�����",
"sp"	=> "80",
"type"	=> "0",
"learn"	=> "10",
"target"=> array("enemy","multi",6),
"pow"	=> "60",
"charge"=> array(60,60),
"pierce"=> true,
); break;
		case "1020":
$skill	= array(
"name"	=> "�ƻ�����",
"img"	=> "skill_073z.png",
"exp"	=> "SP�½�",
"sp"	=> "20",
"type"	=> "0",
"learn"	=> "2",
"target"=> array("enemy","individual",1),
"pow"	=> "120",
); break;
		case "1021":
$skill	= array(
"name"	=> "�ƻ����",
"img"	=> "skill_072z.png",
"exp"	=> "SP+HP�½�",
"sp"	=> "50",
"type"	=> "0",
"learn"	=> "6",
"target"=> array("enemy","individual",1),
"pow"	=> "160",
); break;
		case "1022":
$skill	= array(
"name"	=> "���",
"img"	=> "skill_033.png",
"exp"	=> "����ʱ�����ı�+ǰ��",
"sp"	=> "10",
"type"	=> "0",
"learn"	=> "4",
"target"=> array("enemy","individual",1),
"pow"	=> "100",
"charge"=> array(0,30),
); break;
		case "1023":
$skill	= array(
"name"	=> "һ������",
"img"	=> "skill_033z.png",
"exp"	=> "ǰ��ʱ��������+����",
"sp"	=> "10",
"type"	=> "0",
"learn"	=> "4",
"target"=> array("enemy","individual",1),
"pow"	=> "100",
"charge"=> array(0,10),
); break;
		case "1024":
$skill	= array(
"name"	=> "��������",
"img"	=> "skill_073y.png",
"exp"	=> "�����HP����",
"sp"	=> "100",
"type"	=> "0",
"learn"	=> "10",
"target"=> array("enemy","individual",1),
"charge"=> array(0,50),
); break;
		case "1025":
$skill	= array(
"name"	=> "���Ѿ���",
"img"	=> "skill_073x.png",
"exp"	=> "�����SP����",
"sp"	=> "10",
"type"	=> "0",
"learn"	=> "3",
"target"=> array("enemy","individual",1),
); break;
		case "1026":
$skill	= array(
"name"	=> "���³��",
"img"	=> "skill_033.png",
"exp"	=> "����ʱ��������+ǰ��",
"sp"	=> "30",
"type"	=> "0",
"learn"	=> "6",
"target"=> array("enemy","multi",5),
"pow"	=> "150",
"charge"=> array(0,30),
); break;
		case "1027":
$skill	= array(
"name"	=> "�෵",
"img"	=> "skill_033z.png",
"exp"	=> "ǰ��ʱ��������+����",
"sp"	=> "100",
"type"	=> "0",
"learn"	=> "6",
"target"=> array("enemy","individual",1),
"pow"	=> "150",
"charge"=> array(0,50),
); break;
		case "1028":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_077z.png",
"exp"	=> "���ӷ�����",
"sp"	=> "150",
"type"	=> "0",
"learn"	=> "12",
"target"=> array("enemy","all",1),
"pow"	=> "100",
"charge"=> array(10,50),
"pierce"=> true,
); break;
		case "1029":
$skill	= array(
"name"	=> "���������",
"img"	=> "skill_072z.png",
"exp"	=> "SP+HP�½�",
"sp"	=> "100",
"type"	=> "1",
"learn"	=> "10",
"target"=> array("enemy","all",1),
"pow"	=> "120",
); break;
		case "1030":
$skill	= array(
"name"	=> "�Ӻ�ն",
"img"	=> "skill_074z.png",
"exp"	=> "",
"sp"	=> "200",
"type"	=> "0",
"learn"	=> "10",
"target"=> array("enemy","individual",1),
"pow"	=> "600",
"charge"=> array(100,100),
"invalid"	=> "1",
); break;
		case "1031":
$skill	= array(
"name"	=> "��ɨǧ��",
"img"	=> "skill_031.png",
"exp"	=> "",
"sp"	=> "110",
"type"	=> "0",
"learn"	=> "11",
"target"=> array("enemy","multi",11),
"pow"	=> "110",
"charge"=> array(10,100),
); break;
		case "1032":
$skill	= array(
"name"	=> "�˵�",
"img"	=> "skill_077.png",
"exp"	=> "",
"sp"	=> "100",
"type"	=> "0",
"learn"	=> "10",
"target"=> array("enemy","individual",1),
"pow"	=> "1000",
"charge"=> array(100,100),
"pierce"=> true,
); break;
		case "1033":
$skill	= array(
"name"	=> "�廵����",
"img"	=> "skill_072.png",
"exp"	=> "����������",
"sp"	=> "60",
"type"	=> "0",
"learn"	=> "10",
"target"=> array("enemy","individual",1),
"pow"	=> "160",
"charge"=> array(10,30),
"DownATK" => "75",
"DownMATK" => "75",
); break;
		case "1034":
$skill	= array(
"name"	=> "����װ��",
"img"	=> "skill_072.png",
"exp"	=> "����������",
"sp"	=> "60",
"type"	=> "0",
"learn"	=> "10",
"target"=> array("enemy","individual",1),
"pow"	=> "160",
"charge"=> array(10,30),
"DownDEF" => "45",
"DownMDEF" => "45",
); break;
		case "1035":
$skill	= array(
"name"	=> "�Ʒ�ն",
"img"	=> "skill_077.png",
"exp"	=> "���ӷ�����",
"sp"	=> "100",
"type"	=> "0",
"learn"	=> "12",
"target"=> array("enemy","individual",1),
"pow"	=> "250",
"charge"=> array(20,50),
"pierce"=> true,
); break;
		case "1036":
$skill	= array(
"name"	=> "���п���",
"img"	=> "skill_077z.png",
"exp"	=> "���ӷ�����",
"sp"	=> "350",
"type"	=> "0",
"learn"	=> "20",
"target"=> array("enemy","multi",5),
"pow"	=> "150",
"charge"=> array(50,50),
"pierce"=> true,
); break;
		case "1037":
$skill	= array(
"name"	=> "���з籩",
"img"	=> "skill_077z.png",
"exp"	=> "���ӷ�����",
"sp"	=> "400",
"type"	=> "0",
"learn"	=> "24",
"target"=> array("all","all",1),
"pow"	=> "400",
"charge"=> array(40,60),
"pierce"=> true,
); break;
		case "1038":
$skill	= array(
"name"	=> "ħ�⽣",
"img"	=> "skill_077.png",
"exp"	=> "",
"sp"	=> "100",
"type"	=> "1",
"learn"	=> "6",
"target"=> array("enemy","individual",1),
"pow"	=> "450",
"charge"=> array(40,50),
"DownMATK" => "50",
); break;
		case "1039":
$skill	= array(
"name"	=> "�ɻ꽣",
"img"	=> "skill_077z.png",
"exp"	=> "",
"sp"	=> "250",
"type"	=> "1",
"learn"	=> "12",
"target"=> array("enemy","multi",3),
"pow"	=> "350",
"charge"=> array(30,50),
"DownMDEF" => "30",
); break;
		case "1040":
$skill	= array(
"name"	=> "������",
"img"	=> "skill_077z.png",
"exp"	=> "",
"sp"	=> "300",
"type"	=> "1",
"learn"	=> "20",
"target"=> array("enemy","all",1),
"pow"	=> "200",
"charge"=> array(60,0),
"DownSPD" => "25",
); break;
									// 1100 - ��սʿ����
		case "1100":
$skill	= array(
"name"	=> "��������",
"img"	=> "skill_057.png",
"exp"	=> "��������",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "2",
"target"=> array("self","individual",1),
"support"=> true,
"sacrifice"	=> "10",
"UpSTR"	=> "100",
); break;
		case "1101":
$skill	= array(
"name"	=> "�ٶ�����",
"img"	=> "skill_057.png",
"exp"	=> "�ٶ�����",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "2",
"target"=> array("self","individual",1),
"support"=> true,
"sacrifice"	=> "25",
"PlusSPD"	=> "100",
); break;
		case "1102":
$skill	= array(
"name"	=> "��������",
"img"	=> "skill_057.png",
"exp"	=> "��������",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "2",
"target"=> array("self","individual",1),
"support"=> true,
"sacrifice"	=> "10",
"UpINT"	=> "100",
); break;
		case "1113":
$skill	= array(
"name"	=> "ʹ��",
"img"	=> "skill_057.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "2",
"target"=> array("enemy","individual",1),
"pow"	=> "200",
"sacrifice"	=> "5",
); break;
		case "1114":
$skill	= array(
"name"	=> "�ٹ�",
"img"	=> "skill_057.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "4",
"target"=> array("enemy","multi",4),
"pow"	=> "100",
"sacrifice"	=> "15",
); break;
		case "1115":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_057.png",
"exp"	=> "",
"sp"	=> "1",
"type"	=> "0",
"learn"	=> "8",
"target"=> array("enemy","multi",4),
"pow"	=> "200",
"sacrifice"	=> "30",
); break;
		case "1116":
$skill	= array(
"name"	=> "�ͷ�",
"img"	=> "skill_057.png",
"exp"	=> "�����Լ����ٵ�HP������Ե��˵��˺�",
"sp"	=> "100",
"type"	=> "0",
"learn"	=> "12",
"target"=> array("enemy","individual",1),
"charge"=> array(100,100),
); break;
		case "1117":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_057.png",
"exp"	=> "����",
"sp"	=> "32",
"type"	=> "0",
"learn"	=> "8",
"target"=> array("enemy","all",1),
"sacrifice"	=> "20",
"charge"=> array(0,50),
"poison"=> "100",
); break;
		case "1118":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_057.png",
"exp"	=> "�к���",
"sp"	=> "50",
"type"	=> "0",
"learn"	=> "8",
"target"=> array("enemy","all",1),
"sacrifice"	=> "50",
"charge"=> array(100,100),
"knockback"=> "100",
); break;
		case "1119":
$skill	= array(
"name"	=> "�ѷ�ǿ��",
"img"	=> "skill_057.png",
"exp"	=> "?",
"sp"	=> "100",
"type"	=> "0",
"learn"	=> "16",
"target"=> array("friend","all",1),
"sacrifice"	=> "200",
"charge"=> array(100,0),
"UpSTR"	=> "60",
"UpINT"	=> "60",
"UpSPD"	=> "60",
"UpATK"	=> "60",
"UpMATK"=> "60",
); break;
		case "1120":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_057.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "6",
"target"=> array("self","individual",1),
"support"=> true,
"sacrifice"	=> "60",
"UpSTR"	=> "60",
"UpINT"	=> "60",
"UpSPD"	=> "60",
"UpATK"	=> "60",
"DownDEF"=> "60",
"DownMDEF"=> "60",
); break;
		case "1121":
$skill	= array(
"name"	=> "Űɱ",
"img"	=> "skill_057.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "6",
"target"=> array("enemy","individual",1),
"pow"	=> "500",
"sacrifice"	=> "20",
); break;
		case "1122":
$skill	= array(
"name"	=> "Ѫ����ɱ",
"img"	=> "skill_057.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "20",
"target"=> array("enemy","multi",5),
"pow"	=> "250",
"sacrifice"	=> "30",
); break;
		case "1123":
$skill	= array(
"name"	=> "�����¾",
"img"	=> "skill_057.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "16",
"target"=> array("all","all",1),
"pow"	=> "600",
"sacrifice"	=> "60",
); break;
		case "1124":
$skill	= array(
"name"	=> "����ն",
"img"	=> "skill_057.png",
"exp"	=> "",
"sp"	=> "150",
"type"	=> "0",
"learn"	=> "15",
"target"=> array("enemy","multi",15),
"pow"	=> "150",
"charge"=> array(150,150),
); break;
		case "1125":
$skill	= array(
"name"	=> "ͬ·��",
"img"	=> "skill_057.png",
"exp"	=> "�����Լ����ٵ�HP������Ե��˵��˺�",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "24",
"target"=> array("enemy","individual",1),
"charge"=> array(0,240),
"sacrifice"	=> "24",
); break;
//------------------------------------------------ 1200 ��ɱ��
		case "1200":
$skill	= array(
"name"	=> "��֮һ��",
"img"	=> "skill_074y.png",
"exp"	=> "�Է���״̬�Ļ�����6��",
"sp"	=> "10",
"type"	=> "0",
"learn"	=> "4",
"target"=> array("enemy","individual",1),
"pow"	=> "100",
"limit"=> array("ذ��"=>true,),
); break;
		case "1203":
$skill	= array(
"name"	=> "��ذ��",
"img"	=> "we_sword001.png",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "1",
"target"=> array("enemy","individual",1),
"pow"	=> "140",
"invalid"	=> "1",
"limit"=> array("ذ��"=>true,),
); break;
		case "1204":
$skill	= array(
"name"	=> "ذ���Ҵ�",
"img"	=> "we_sword001z.png",
"sp"	=> "30",
"type"	=> "0",
"learn"	=> "4",
"target"=> array("enemy","multi",4),
"pow"	=> "130",
"invalid"	=> "1",
"limit"=> array("ذ��"=>true,),
); break;
		case "1205":
$skill	= array(
"name"	=> "�ữ����",
"img"	=> "item_027.png",
"exp"	=> "��������",
"sp"	=> "30",
"type"	=> "0",
"learn"	=> "4",
"target"=> array("enemy","individual",1),
"DownDEF"	=> "30",
"DownMDEF"	=> "30",
); break;
		case "1206":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_079z.png",
"exp"	=> "��������",
"sp"	=> "60",
"type"	=> "0",
"learn"	=> "4",
"target"=> array("enemy","all",1),
"DownDEF"	=> "15",
); break;
		case "1207":
$skill	= array(
"name"	=> "��֮��Ϣ",
"img"	=> "skill_005cz.png",
"exp"	=> "ǰ����",
"sp"	=> "30",
"type"	=> "0",
"learn"	=> "4",
"target"=> array("enemy","all",1),
"umove"	=> "front",
"charge"=> array(30,30),
"poison"=> "80",
); break;
		case "1208":
$skill	= array(
"name"	=> "ʹ��",
"img"	=> "skill_024z.png",
"exp"	=> "��״̬�ĶԷ�ʧѪ(int��أ���)",
"sp"	=> "60",
"type"	=> "0",
"learn"	=> "6",
"target"=> array("enemy","all",1),
); break;
		case "1209":
$skill	= array(
"name"	=> "����",
"img"	=> "item_031.png",
"exp"	=> "��״̬��������+�ⶾ",
"sp"	=> "80",
"type"	=> "0",
"learn"	=> "8",
"target"=> array("friend","all",1),
"PlusSTR"	=> 50,
"PlusSPD"	=> 50,
"charge"=> array(0,100),
"CurePoison"	=> true,
); break;
		case "1210":
$skill	= array(
"name"	=> "ǰ����ä",
"img"	=> "skill_073x.png",
"exp"	=> "�ж��ӳ�",
"sp"	=> "100",
"type"	=> "0",
"learn"	=> "2",
"target"=> array("enemy","all",1),
); break;
		case "1211":
$skill	= array(
"name"	=> "������ä",
"img"	=> "skill_073x.png",
"exp"	=> "�ж��ӳ�",
"sp"	=> "100",
"type"	=> "0",
"learn"	=> "2",
"target"=> array("enemy","all",1),
); break;
		case "1220":
$skill	= array(
"name"	=> "����",
"img"	=> "item_026b.png",
"exp"	=> "������+50%",
"sp"	=> "80",
"type"	=> "0",
"learn"	=> "5",
"target"=> array("friend","all",1),
); break;
		case "1221":
$skill	= array(
"name"	=> "��ɱ",
"img"	=> "we_sword001.png",
"sp"	=> "200",
"type"	=> "0",
"learn"	=> "8",
"target"=> array("enemy","individual",1),
"pow"	=> "800",
"charge"=> array(40,0),
"invalid"	=> "1",
"limit"=> array("ذ��"=>true,),
); break;
		case "1222":
$skill	= array(
"name"	=> "��ذ�Ҵ�",
"img"	=> "we_sword001z.png",
"sp"	=> "200",
"type"	=> "0",
"learn"	=> "12",
"target"=> array("enemy","multi",10),
"pow"	=> "100",
"invalid"	=> "1",
"poison"=> "100",
"limit"=> array("ذ��"=>true,),
); break;
		case "1223":
$skill	= array(
"name"	=> "��֮���",
"img"	=> "skill_074y.png",
"exp"	=> "�Է���״̬�Ļ�����6��",
"sp"	=> "240",
"type"	=> "0",
"learn"	=> "16",
"target"=> array("enemy","all",1),
"pow"	=> "80",
"limit"=> array("ذ��"=>true,),
); break;
		case "1224":
$skill	= array(
"name"	=> "��ɳ��",
"img"	=> "we_other007y.png",
"exp"	=> "",
"sp"	=> "360",
"type"	=> "0",
"learn"	=> "12",
"target"=> array("enemy","all",1),
"charge"=> array(0,200),
"pow"	=> "30",
"delay"	=> 60,
"limit"=> array("ذ��"=>true,),
); break;
		case "1225":
$skill	= array(
"name"	=> "����Ҵ�",
"img"	=> "we_sword001z.png",
"sp"	=> "210",
"type"	=> "0",
"learn"	=> "18",
"target"=> array("enemy","all",1),
"pow"	=> "240",
"invalid"	=> "1",
"limit"=> array("ذ��"=>true,),
); break;
		case "1226":
$skill	= array(
"name"	=> "��֮��",
"img"	=> "we_sword001.png",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "5",
"target"=> array("enemy","multi",2),
"pow"	=> "150",
"invalid"	=> "1",
"limit"=> array("ذ��"=>true,),
); break;
//---------------------------------------------- 1240 ѱ��ʦ
		case "1240":
$skill	= array(
"name"	=> "���",
"img"	=> "we_other007y.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "0",
"target"=> array("enemy","multi",2),
"pow"	=> "90",
"limit"=> array("��"=>true,),
); break;
		case "1241":
$skill	= array(
"name"	=> "�޴�",
"img"	=> "we_other007y.png",
"exp"	=> "",
"sp"	=> "30",
"type"	=> "0",
"learn"	=> "2",
"target"=> array("enemy","multi",4),
"pow"	=> "90",
"limit"=> array("��"=>true,),
); break;
		case "1242":
$skill	= array(
"name"	=> "���ӷ籩",
"img"	=> "we_other007y.png",
"exp"	=> "",
"sp"	=> "40",
"type"	=> "0",
"learn"	=> "4",
"target"=> array("enemy","multi",6),
"pow"	=> "90",
"limit"=> array("��"=>true,),
); break;
		case "1243":
$skill	= array(
"name"	=> "��ҧ",
"img"	=> "we_other007y.png",
"exp"	=> "",
"sp"	=> "30",
"type"	=> "0",
"learn"	=> "4",
"target"=> array("enemy","multi",2),
"pow"	=> "80",
"delay"	=> 50,
"limit"=> array("��"=>true,),
); break;
		case "1244":
$skill	= array(
"name"	=> "����̶�",
"img"	=> "we_other007y.png",
"exp"	=> "",
"sp"	=> "40",
"type"	=> "0",
"learn"	=> "4",
"target"=> array("enemy","multi",2),
"pow"	=> "60",
"delay"	=> 30,
"DownSPD"	=> 30,
"limit"=> array("��"=>true,),
); break;
		case "1245":
$skill	= array(
"name"	=> "�����߸�",
"img"	=> "we_other007y.png",
"exp"	=> "",
"sp"	=> "100",
"type"	=> "0",
"learn"	=> "10",
"target"=> array("enemy","multi",4),
"pow"	=> "100",
"charge"=> array(10,40),
"delay"	=> 40,
"limit"=> array("��"=>true,),
); break;
		case "1246":
$skill	= array(
"name"	=> "�����籩",
"img"	=> "we_other007y.png",
"exp"	=> "",
"sp"	=> "300",
"type"	=> "0",
"learn"	=> "16",
"target"=> array("enemy","all",1),
"pow"	=> "200",
"charge"=> array(30,0),
"delay"	=> 30,
"limit"=> array("��"=>true,),
); break;
//------------------------------------------------ 
									// 2000 - ħ��ϵ�餷��
		case "2000":
$skill	= array(
"name"	=> "����籩",
"img"	=> "skill_004a.png",
"exp"	=> "",
"sp"	=> "70",
"type"	=> "1",
"learn"	=> "4",
"target"=> array("enemy","multi",6),
"pow"	=> "100",
"invalid"	=> "1",
"charge"=> array(70,0),
); break;
		case "2001":
$skill	= array(
"name"	=> "������",
"img"	=> "skill_006a.png",
"exp"	=> "",
"sp"	=> "320",
"type"	=> "1",
"learn"	=> "12",
"target"=> array("enemy","multi",12),
"pow"	=> "100",
"invalid"	=> "1",
"charge"=> array(120,0),
); break;
		case "2002":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_007a.png",
"exp"	=> "��Down",
"sp"	=> "40",
"type"	=> "1",
"learn"	=> "4",
"target"=> array("enemy","multi",2),
"pow"	=> "140",
"invalid"	=> "1",
"charge"=> array(10,40),
"DownSTR"	=> "40",
); break;
		case "2003":
$skill	= array(
"name"	=> "��ը",
"img"	=> "skill_005a.png",
"exp"	=> "��Down",
"sp"	=> "140",
"type"	=> "1",
"learn"	=> "14",
"target"=> array("all","all",1),
"pow"	=> "140",
"charge"=> array(100,40),
"DownSTR"	=> "40",
); break;
		case "2004":
$skill	= array(
"name"	=> "��ʯ�籩",
"img"	=> "skill_021z.png",
"exp"	=> "",
"sp"	=> "800",
"type"	=> "1",
"learn"	=> "12",
"target"=> array("enemy","multi",16),
"pow"	=> "160",
"charge"=> array(160,0),
); break;
		case "2010":
$skill	= array(
"name"	=> "��֮ǹ",
"img"	=> "skill_001b.png",
"exp"	=> "",
"sp"	=> "20",
"type"	=> "1",
"learn"	=> "1",
"target"=> array("enemy","individual",3),
"pow"	=> "100",
"charge"=> array(30,0),
); break;
		case "2011":
$skill	= array(
"name"	=> "����ǹ",
"img"	=> "skill_002b.png",
"exp"	=> "",
"sp"	=> "60",
"type"	=> "1",
"learn"	=> "4",
"target"=> array("enemy","individual",3),
"pow"	=> "150",
"charge"=> array(40,0),
); break;
		case "2012":
$skill	= array(
"name"	=> "����ѩ",
"img"	=> "skill_006b.png",
"exp"	=> "",
"sp"	=> "240",
"type"	=> "1",
"learn"	=> "12",
"target"=> array("enemy","multi",10),
"pow"	=> "90",
"charge"=> array(90,0),
); break;
		case "2013":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_034.png",
"exp"	=> "",
"sp"	=> "20",
"type"	=> "1",
"learn"	=> "0",
"target"=> array("enemy","individual",1),
"pow"	=> "100",
"charge"=> array(30,0),
); break;
		case "2014":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_055.png",
"exp"	=> "����Down",
"sp"	=> "40",
"type"	=> "1",
"learn"	=> "4",
"target"=> array("enemy","individual",1),
"pow"	=> "180",
"invalid"	=> "1",
"charge"=> array(40,0),
"DownDEF"	=> "30",
"DownMDEF"	=> "30",
); break;
		case "2015":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_056z.png",
"exp"	=> "������",
"sp"	=> "520",
"type"	=> "1",
"learn"	=> "12",
"target"=> array("enemy","multi",24),
"pow"	=> "80",
"charge"=> array(170,100),
"knockback"	=> "100",
); break;
		case "2020":
$skill	= array(
"name"	=> "�׻�",
"img"	=> "skill_030z.png",
"exp"	=> "",
"sp"	=> "30",
"type"	=> "1",
"learn"	=> "1",
"target"=> array("enemy","individual",1),
"pow"	=> "400",
"invalid"	=> "1",
"charge"=> array(50,0),
); break;
		case "2021":
$skill	= array(
"name"	=> "������",
"img"	=> "skill_054z.png",
"exp"	=> "",
"sp"	=> "80",
"type"	=> "1",
"learn"	=> "6",
"target"=> array("enemy","multi",3),
"pow"	=> "220",
"invalid"	=> "1",
"charge"=> array(70,0),
); break;
		case "2022":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_022z.png",
"exp"	=> "�ж��ӳ�",
"sp"	=> "30",
"type"	=> "1",
"learn"	=> "4",
"target"=> array("enemy","all",1),
"charge"=> array(30,0),
"delay"	=> "25",
); break;
		case "2023":
$skill	= array(
"name"	=> "���",
"img"	=> "skill_025.png",
"exp"	=> "�ж��ӳ�",
"sp"	=> "15",
"type"	=> "1",
"learn"	=> "4",
"target"=> array("enemy","individual",1),
"pow"	=> "50",
"charge"=> array(30,0),
"delay"	=> "120",
); break;
		case "2024":
$skill	= array(
"name"	=> "�ױ�",
"img"	=> "skill_006cz.png",
"exp"	=> "",
"sp"	=> "400",
"type"	=> "1",
"learn"	=> "12",
"target"=> array("enemy","multi",5),
"pow"	=> "300",
"charge"=> array(150,0),
"invalid"	=> "1",
); break;
		case "2025":
$skill	= array(
"name"	=> "�׹�",
"img"	=> "skill_025.png",
"exp"	=> "�ж��ӳ�",
"sp"	=> "150",
"type"	=> "1",
"learn"	=> "15",
"target"=> array("enemy","individual",5),
"pow"	=> "150",
"charge"=> array(0,150),
"delay"	=> "150",
); break;
		case "2030":
$skill	= array(
"name"	=> "��������",
"img"	=> "skill_062z.png",
"exp"	=> "HP����",
"sp"	=> "50",
"type"	=> "1",
"learn"	=> "4",
"target"=> array("enemy","individual",1),
"pow"	=> "230",
"invalid"	=> "1",
"charge"=> array(10,40),
); break;
		case "2031":
$skill	= array(
"name"	=> "������ѹ",
"img"	=> "skill_078.png",
"exp"	=> "HP����",
"sp"	=> "70",
"type"	=> "1",
"learn"	=> "8",
"target"=> array("enemy","all",1),
"pow"	=> "120",
"charge"=> array(30,80),
); break;
		case "2032":
$skill	= array(
"name"	=> "����֮��",
"img"	=> "skill_041z.png",
"exp"	=> "����",
"sp"	=> "50",
"type"	=> "1",
"learn"	=> "8",
"target"=> array("enemy","individual",1),
"invalid"	=> "1",
"charge"=> array(100,0),
); break;
		case "2033":
$skill	= array(
"name"	=> "��ʳ",
"img"	=> "skill_062z.png",
"exp"	=> "",
"sp"	=> "10",
"type"	=> "0",
"learn"	=> "5",
"target"=> array("enemy","individual",1),
"pow"	=> "150",
"invalid"	=> "1",
"charge"=> array(10,50),
); break;
		case "2034":
$skill	= array(
"name"	=> "Ѫ���ռ�",
"img"	=> "skill_078.png",
"exp"	=> "",
"sp"	=> "80",
"type"	=> "0",
"learn"	=> "8",
"target"=> array("all","all",1),
"pow"	=> "80",
"charge"=> array(80,80),
); break;
		case "2035":
$skill	= array(
"name"	=> "����ո�",
"img"	=> "skill_041z.png",
"exp"	=> "10%����",
"sp"	=> "200",
"type"	=> "0",
"learn"	=> "13",
"target"=> array("enemy","individual",1),
"invalid"	=> "1",
"charge"=> array(100,100),
); break;
		case "2036":
$skill	= array(
"name"	=> "ŭ������",
"img"	=> "skill_062z.png",
"exp"	=> "",
"sp"	=> "100",
"type"	=> "0",
"learn"	=> "12",
"target"=> array("enemy","all",1),
"pow"	=> "200",
"invalid"	=> "1",
"charge"=> array(10,20),
); break;
		case "2040":
$skill	= array(
"name"	=> "ɳĮ�籩",
"img"	=> "skill_006d.png",
"exp"	=> "�ж��ӳ�",
"sp"	=> "200",
"type"	=> "1",
"learn"	=> "12",
"target"=> array("enemy","all",1),
"pow"	=> "80",
"charge"=> array(200,0),
"delay"	=> "80",
); break;
		case "2041":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_056y.png",
"exp"	=> "",
"sp"	=> "80",
"type"	=> "1",
"learn"	=> "6",
"target"=> array("all","all",1),
"pow"	=> "200",
"charge"=> array(100,30),
); break;
		case "2042":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_056.png",
"exp"	=> "",
"sp"	=> "150",
"type"	=> "1",
"learn"	=> "8",
"target"=> array("all","all",1),
"pow"	=> "350",
"charge"=> array(130,50),
); break;
		case "2043":
$skill	= array(
"name"	=> "ɳ�籩",
"img"	=> "skill_006d.png",
"exp"	=> "�ж��ӳ�",
"sp"	=> "200",
"type"	=> "1",
"learn"	=> "10",
"target"=> array("enemy","all",1),
"pow"	=> "180",
"charge"=> array(80,20),
"delay"	=> "180",
); break;
		case "2044":
$skill	= array(
"name"	=> "��ɳ�籩",
"img"	=> "skill_006d.png",
"exp"	=> "�ж��ӳ�",
"sp"	=> "600",
"type"	=> "1",
"learn"	=> "20",
"target"=> array("enemy","all",1),
"pow"	=> "150",
"charge"=> array(200,50),
"delay"	=> "100",
); break;
		case "2045":
$skill	= array(
"name"	=> "��ʯ��",
"img"	=> "skill_056.png",
"exp"	=> "",
"sp"	=> "500",
"type"	=> "1",
"learn"	=> "12",
"target"=> array("all","all",1),
"pow"	=> "500",
"charge"=> array(150,50),
); break;
		case "2046":
$skill	= array(
"name"	=> "��������",
"img"	=> "skill_006cz.png",
"exp"	=> "",
"sp"	=> "600",
"type"	=> "1",
"learn"	=> "18",
"target"=> array("enemy","all",1),
"pow"	=> "320",
"charge"=> array(160,0),
"invalid"	=> "1",
); break;
		case "2047":
$skill	= array(
"name"	=> "��������",
"img"	=> "skill_021z.png",
"exp"	=> "",
"sp"	=> "1200",
"type"	=> "1",
"learn"	=> "18",
"target"=> array("enemy","multi",24),
"pow"	=> "200",
"charge"=> array(220,0),
); break;
		case "2048":
$skill	= array(
"name"	=> "��������",
"img"	=> "skill_002b.png",
"exp"	=> "",
"sp"	=> "360",
"type"	=> "1",
"learn"	=> "8",
"target"=> array("enemy","individual",9),
"pow"	=> "180",
"charge"=> array(90,0),
); break;
		case "2049":
$skill	= array(
"name"	=> "�����",
"img"	=> "skill_055.png",
"exp"	=> "����Down",
"sp"	=> "60",
"type"	=> "1",
"learn"	=> "6",
"target"=> array("enemy","individual",1),
"pow"	=> "180",
"invalid"	=> "1",
"charge"=> array(60,0),
"DownATK"	=> "30",
"DownMATK"	=> "30",
); break;

//-------------------------------- 2050
		case "2050":
$skill	= array(
"name"	=> "�Ͷ����",
"img"	=> "skill_024.png",
"exp"	=> "����",
"sp"	=> "30",
"type"	=> "1",
"learn"	=> "4",
"target"=> array("enemy","multi",2),
"pow"	=> "200",
"charge"=> array(40,0),
"poison"=> "100",
); break;
		case "2051":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_079.png",
"exp"	=> "����",
"sp"	=> "80",
"type"	=> "1",
"learn"	=> "8",
"target"=> array("enemy","all",1),
"pow"	=> "150",
"charge"=> array(70,0),
"poison"=> "100",
); break;
		case "2055":
$skill	= array(
"name"	=> "��긴��",
"img"	=> "skill_065.png",
"exp"	=> "�����������˺�����",
"sp"	=> "340",
"type"	=> "1",
"learn"	=> "8",
"target"=> array("enemy","all",1),
"pow"	=> "50",
"charge"=> array(0,60),
); break;
		case "2056":
$skill	= array(
"name"	=> "��ʬ����",
"img"	=> "skill_061.png",
"exp"	=> "�ҷ�����",
"sp"	=> "300",
"type"	=> "1",
"learn"	=> "8",
"target"=> array("friend","all",1),
"charge"	=> array(50,100),
"DownMAXHP"=>"30",
"DownDEF"=>"100",
"DownMDEF"=>"100",
"DownSPD"=>"50",
"priority"	=> "Dead",
); break;
		case "2057":
$skill	= array(
"name"	=> "�����ɱ�",
"img"	=> "skill_066.png",
"exp"	=> "HP60%���¿�ʹ��(1������)",
"sp"	=> "250",
"type"	=> "1",
"learn"	=> "8",
"target"=> array("self","individual",1),
"charge"=> array(0,50),
"UpMAXHP"=> 200,
"UpMATK"=> 100,
"UpINT"=> 100,
"UpSPD"=> 50,
); break;
		case "2058":
$skill	= array(
"name"	=> "Ѫ������",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "200",
"type"	=> "1",
"learn"	=> "20",
"target"=> array("self","individual",1),
"charge"=> array(20,10),
"UpMAXHP"=> 200,
"DownMAXSP"=> 100,
); break;
		case "2059":
$skill	= array(
"name"	=> "����仯",
"img"	=> "skill_066.png",
"exp"	=> "(1������)",
"sp"	=> "300",
"type"	=> "1",
"learn"	=> "20",
"target"=> array("self","individual",1),
"charge"=> array(0,100),
"UpMAXHP"=> 200,
"UpINT"=> 60,
"UpDEF"=> 35,
"UpMDEF"=> 35,
); break;
//-------------------------------- 2060
		case "2060":
$skill	= array(
"name"	=> "ħ����ը",
"img"	=> "skill_020.png",
"exp"	=> "",
"sp"	=> "140",
"type"	=> "1",
"learn"	=> "6",
"target"=> array("enemy","individual",1),
"pow"	=> "500",
"charge"=> array(0,0),
); break;
		case "2061":
$skill	= array(
"name"	=> "�׵�����",
"img"	=> "skill_025.png",
"exp"	=> "�ж��ӳ�",
"sp"	=> "60",
"type"	=> "1",
"learn"	=> "8",
"target"=> array("enemy","multi",2),
"pow"	=> "40",
"charge"=> array(60,0),
"delay"	=> "80",
); break;
		case "2062":
$skill	= array(
"name"	=> "�Ա�",
"img"	=> "skill_005a.png",
"exp"	=> "",
"sp"	=> "1000",
"type"	=> "1",
"learn"	=> "20",
"target"=> array("all","all",1),
"pow"	=> "1000",
"charge"=> array(200,1000),
); break;
		case "2063":
$skill	= array(
"name"	=> "Ұ�Ա仯",
"img"	=> "skill_066.png",
"exp"	=> "(1������)",
"sp"	=> "300",
"type"	=> "1",
"learn"	=> "20",
"target"=> array("self","individual",1),
"charge"=> array(0,100),
"UpMAXHP"=> 200,
"UpSTR"=> 100,
"UpATK"=> 100,
"UpDEF"=> 100,
"DownINT"=> 100,
"DownMATK"=> 100,
"DownMDEF"=> 100,
); break;
		case "2064":
$skill	= array(
"name"	=> "˥��",
"img"	=> "skill_066.png",
"sp"	=> "240",
"type"	=> "0",
"learn"	=> "12",
"target"=> array("enemy","individual",1),
"DownMAXHP"	=> "20",
"charge"=> array(80,0),
"invalid"	=> true,
); break;
		case "2065":
$skill	= array(
"name"	=> "��������",
"img"	=> "skill_066.png",
"sp"	=> "600",
"type"	=> "0",
"learn"	=> "20",
"target"=> array("enemy","all",1),
"DownMAXHP"	=> "10",
"charge"=> array(150,0),
"invalid"	=> true,
); break;
		case "2066":
$skill	= array(
"name"	=> "��Ԫ��",
"img"	=> "skill_077.png",
"exp"	=> "���ӷ�����",
"sp"	=> "160",
"type"	=> "1",
"learn"	=> "8",
"target"=> array("enemy","individual",1),
"pow"	=> "240",
"charge"=> array(40,20),
"pierce"=> true,
); break;
		case "2067":
$skill	= array(
"name"	=> "ħ�д���",
"img"	=> "skill_077z.png",
"exp"	=> "���ӷ�����",
"sp"	=> "320",
"type"	=> "1",
"learn"	=> "16",
"target"=> array("enemy","multi",4),
"pow"	=> "200",
"charge"=> array(80,20),
"pierce"=> true,
); break;
		case "2068":
$skill	= array(
"name"	=> "�ռ�ը��",
"img"	=> "skill_077z.png",
"exp"	=> "���ӷ�����",
"sp"	=> "600",
"type"	=> "1",
"learn"	=> "24",
"target"=> array("all","all",1),
"pow"	=> "160",
"charge"=> array(120,20),
"pierce"=> true,
); break;
		case "2069":
$skill	= array(
"name"	=> "Ѹ��ֱ��",
"img"	=> "skill_030z.png",
"exp"	=> "",
"sp"	=> "60",
"type"	=> "1",
"learn"	=> "2",
"target"=> array("enemy","individual",1),
"pow"	=> "300",
"invalid"	=> "1",
"charge"=> array(20,0),
); break;
		case "2070":
$skill	= array(
"name"	=> "Ѹ��׷��",
"img"	=> "skill_054z.png",
"exp"	=> "",
"sp"	=> "180",
"type"	=> "1",
"learn"	=> "6",
"target"=> array("enemy","multi",3),
"pow"	=> "240",
"invalid"	=> "1",
"charge"=> array(30,0),
); break;
		case "2071":
$skill	= array(
"name"	=> "������",
"img"	=> "skill_030z.png",
"exp"	=> "",
"sp"	=> "400",
"type"	=> "1",
"learn"	=> "12",
"target"=> array("enemy","all",1),
"pow"	=> "200",
"invalid"	=> "1",
"charge"=> array(60,0),
); break;
		case "2072":
$skill	= array(
"name"	=> "�޴�",
"img"	=> "skill_066.png",
"sp"	=> "400",
"type"	=> "0",
"learn"	=> "20",
"target"=> array("friend","individual",1),
"UpMAXHP"	=> "100",
"charge"=> array(100,0),
"invalid"	=> true,
); break;
//---------------------------------- 2090
		case "2090":
$skill	= array(
"name"	=> "��������",
"img"	=> "skill_037.png",
"exp"	=> "SP����",
"sp"	=> "10",
"type"	=> "1",
"learn"	=> "3",
"target"=> array("enemy","individual",1),
"pow"	=> "150",
"invalid"	=> "1",
"charge"=> array(30,0),
); break;
		case "2091":
$skill	= array(
"name"	=> "�����ռ�",
"img"	=> "skill_037.png",
"exp"	=> "SP����",
"sp"	=> "30",
"type"	=> "1",
"learn"	=> "6",
"target"=> array("enemy","all",1),
"pow"	=> "70",
"invalid"	=> "1",
"charge"=> array(100,0),
); break;
							// 2100
		case "2100":
$skill	= array(
"name"	=> "ʥ��",
"img"	=> "skill_022.png",
"exp"	=> "",
"sp"	=> "10",
"type"	=> "1",
"learn"	=> "1",
"target"=> array("enemy","individual",1),
"pow"	=> "100",
"invalid"	=> "1",
"charge"=> array(10,0),
); break;
		case "2101":
$skill	= array(
"name"	=> "ʥ�ⱬ��",
"img"	=> "skill_010z.png",
"exp"	=> "",
"sp"	=> "40",
"type"	=> "1",
"learn"	=> "6",
"target"=> array("enemy","multi",3),
"pow"	=> "100",
"invalid"	=> "1",
"charge"=> array(40,0),
); break;
		case "2102":
$skill	= array(
"name"	=> "��ʮ��",
"img"	=> "item_036b.png",
"exp"	=> "",
"sp"	=> "200",
"type"	=> "1",
"learn"	=> "8",
"target"=> array("enemy","all",1),
"pow"	=> "200",
"charge"=> array(70,30),
"MagicCircleDeleteTeam"	=> 1,
); break;
		case "2103":
$skill	= array(
"name"	=> "������",
"img"	=> "skill_010z.png",
"exp"	=> "",
"sp"	=> "120",
"type"	=> "1",
"learn"	=> "8",
"target"=> array("enemy","individual",1),
"pow"	=> "400",
"invalid"	=> "1",
"charge"=> array(20,60),
); break;
		case "2104":
$skill	= array(
"name"	=> "������",
"img"	=> "skill_010z.png",
"exp"	=> "",
"sp"	=> "300",
"type"	=> "1",
"learn"	=> "12",
"target"=> array("enemy","all",1),
"pow"	=> "300",
"invalid"	=> "1",
"charge"=> array(30,90),
); break;
							// 2110
							// ԁ���ФΥ����Τߤ��m�ꤹ�롣
		case "2110":
$skill	= array(
"name"	=> "����ӽ��",
"img"	=> "skill_016.png",
"exp"	=> "Charge��ӽ��������",
"sp"	=> "60",
"type"	=> "1",
"learn"	=> "6",
"target"=> array("enemy","individual",1),
"invalid"	=> "1",
"priority"	=> "Charge",
"delay"	=> "200",
"charge"	=> array(0,60),
); break;
		case "2111":
$skill	= array(
"name"	=> "����ӽ��(ȫԱ)",
"img"	=> "skill_016.png",
"exp"	=> "Charge��ӽ��������(ȫ)",
"sp"	=> "100",
"type"	=> "1",
"learn"	=> "6",
"target"=> array("enemy","all",1),
"invalid"	=> "1",
"priority"	=> "Charge",
"delay"	=> "100",
"charge"	=> array(0,60),
); break;
		case "2112":
$skill	= array(
"name"	=> "����",
"img"	=> "we_other007y.png",
"exp"	=> "",
"sp"	=> "300",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"delay"	=> 100,
"invalid"	=> "1",
"charge"=> array(0,100),
); break;
/////////////////////// 2300-��ϵ�� "inf"	=> "dex",// ������dex����ˤ���
		case "2300":
$skill	= array(
"name"	=> "���",
"img"	=> "item_042.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "0",
"target"=> array("enemy","individual",1),
"inf"	=> "dex",
"pow"	=> "100",
"invalid"	=> "1",
"priority"	=> "Back",
"charge"=> array(0,0),
"limit"=> array("��"=>true,),
); break;
		case "2301":
$skill	= array(
"name"	=> "ǿ�����",
"img"	=> "item_042.png",
"exp"	=> "",
"sp"	=> "10",
"type"	=> "0",
"learn"	=> "6",
"target"=> array("enemy","individual",1),
"inf"	=> "dex",
"pow"	=> "200",
"invalid"	=> "1",
"charge"=> array(0,30),
"limit"=> array("��"=>true),
); break;
		case "2302":
$skill	= array(
"name"	=> "����",
"img"	=> "item_042.png",
"exp"	=> "",
"sp"	=> "20",
"type"	=> "0",
"learn"	=> "4",
"target"=> array("enemy","multi",6),
"inf"	=> "dex",
"pow"	=> "60",
"invalid"	=> "1",
"charge"=> array(0,0),
"limit"=> array("��"=>true),
); break;
		case "2303":
$skill	= array(
"name"	=> "������",
"img"	=> "item_042.png",
"exp"	=> "",
"sp"	=> "10",
"type"	=> "0",
"learn"	=> "4",
"target"=> array("enemy","individual",1),
"inf"	=> "dex",
"pow"	=> "80",
"invalid"	=> "1",
"priority"	=> "Back",
"charge"=> array(0,0),
"delay"	=> "80",
"limit"=> array("��"=>true),
); break;
		case "2304":
$skill	= array(
"name"	=> "�ж�����",
"img"	=> "item_042.png",
"exp"	=> "��",
"sp"	=> "15",
"type"	=> "0",
"learn"	=> "2",
"target"=> array("enemy","multi",2),
"inf"	=> "dex",
"pow"	=> "50",
"invalid"	=> "1",
"charge"=> array(0,0),
"poison"=> "100",
"limit"=> array("��"=>true),
); break;
		case "2305":
$skill	= array(
"name"	=> "��λ���",
"img"	=> "item_042.png",
"exp"	=> "������",
"sp"	=> "30",
"type"	=> "0",
"learn"	=> "6",
"target"=> array("enemy","individual",1),
"inf"	=> "dex",
"pow"	=> "100",
"charge"=> array(30,0),
"knockback"	=> "100",
"limit"=> array("��"=>true),
); break;
		case "2306":
$skill	= array(
"name"	=> "��͸���",
"img"	=> "item_042.png",
"exp"	=> "���ӷ���",
"sp"	=> "90",
"type"	=> "0",
"learn"	=> "8",
"target"=> array("enemy","individual",1),
"inf"	=> "dex",
"pow"	=> "180",
"invalid"	=> "1",
"charge"=> array(60,0),
"pierce"=> true,
"limit"=> array("��"=>true),
); break;
		case "2307":
$skill	= array(
"name"	=> "쫷����",
"img"	=> "item_042.png",
"exp"	=> "",
"sp"	=> "180",
"type"	=> "0",
"learn"	=> "16",
"target"=> array("enemy","multi",16),
"inf"	=> "dex",
"pow"	=> "70",
"invalid"	=> "1",
"charge"=> array(50,80),
"limit"=> array("��"=>true),
); break;
		case "2308":
$skill	= array(
"name"	=> "��׼",
"img"	=> "item_042.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "4",
"target"=> array("enemy","individual",1),
"inf"	=> "dex",
"pow"	=> "130",
"invalid"	=> "1",
"priority"	=> "Back",
"charge"=> array(0,0),
"limit"=> array("��"=>true),
); break;
		case "2309":
$skill	= array(
"name"	=> "�����װ",
"img"	=> "item_042.png",
"exp"	=> "",
"sp"	=> "20",
"type"	=> "0",
"learn"	=> "2",
"target"=> array("enemy","individual",1),
"inf"	=> "dex",
"pow"	=> "70",
"invalid"	=> "1",
"priority"	=> "Back",
"DownATK" => "70",
"DownMATK" => "70",
"limit"=> array("��"=>true),
); break;
		case "2310":
$skill	= array(
"name"	=> "˫�����",
"img"	=> "item_042.png",
"exp"	=> "",
"sp"	=> "28",
"type"	=> "0",
"learn"	=> "0",
"target"=> array("enemy","multi",2),
"inf"	=> "dex",
"pow"	=> "80",
"invalid"	=> "1",
"priority"	=> "Back",
"limit"=> array("��"=>true),
); break;
		case "2311":
$skill	= array(
"name"	=> "���Ƽ�",
"img"	=> "item_042.png",
"exp"	=> "��",
"sp"	=> "60",
"type"	=> "0",
"learn"	=> "6",
"target"=> array("enemy","all",1),
"inf"	=> "dex",
"pow"	=> "60",
"invalid"	=> "1",
"charge"=> array(0,0),
"poison"=> "100",
"limit"=> array("��"=>true),
); break;
		case "2312":
$skill	= array(
"name"	=> "���ɢ��",
"img"	=> "item_042.png",
"exp"	=> "",
"sp"	=> "240",
"type"	=> "0",
"learn"	=> "12",
"target"=> array("enemy","all",1),
"inf"	=> "dex",
"pow"	=> "150",
"invalid"	=> "1",
"charge"=> array(120,90),
"delay"	=> "60",
"limit"=> array("��"=>true),
); break;
		case "2313":
$skill	= array(
"name"	=> "���װ��",
"img"	=> "item_042.png",
"exp"	=> "",
"sp"	=> "50",
"type"	=> "0",
"learn"	=> "5",
"target"=> array("enemy","individual",1),
"inf"	=> "dex",
"pow"	=> "50",
"invalid"	=> "1",
"priority"	=> "Back",
"DownDEF" => "50",
"DownMDEF" => "50",
"limit"=> array("��"=>true),
); break;
		case "2314":
$skill	= array(
"name"	=> "�������",
"img"	=> "item_042.png",
"exp"	=> "���ӷ���",
"sp"	=> "180",
"type"	=> "0",
"learn"	=> "16",
"target"=> array("enemy","multi",3),
"inf"	=> "dex",
"pow"	=> "160",
"invalid"	=> "1",
"charge"=> array(80,0),
"pierce"=> true,
"limit"=> array("��"=>true),
); break;
		case "2315":
$skill	= array(
"name"	=> "��ɢ���",
"img"	=> "item_042.png",
"exp"	=> "",
"sp"	=> "160",
"type"	=> "0",
"learn"	=> "12",
"target"=> array("enemy","all",1),
"inf"	=> "dex",
"pow"	=> "200",
"invalid"	=> "1",
"charge"=> array(40,80),
"limit"=> array("��"=>true),
); break;
		case "2316":
$skill	= array(
"name"	=> "����ɢ��",
"img"	=> "item_042.png",
"exp"	=> "���ӷ���",
"sp"	=> "300",
"type"	=> "0",
"learn"	=> "20",
"target"=> array("enemy","all",1),
"inf"	=> "dex",
"pow"	=> "150",
"invalid"	=> "1",
"charge"=> array(100,0),
"pierce"=> true,
"limit"=> array("��"=>true),
); break;
		case "2317":
$skill	= array(
"name"	=> "��ͷһ��",
"img"	=> "item_042.png",
"exp"	=> "",
"sp"	=> "150",
"type"	=> "0",
"learn"	=> "10",
"target"=> array("enemy","individual",1),
"inf"	=> "dex",
"pow"	=> "450",
"invalid"	=> "1",
"priority"	=> "Back",
"charge"=> array(30,50),
"limit"=> array("��"=>true),
); break;
		case "2318":
$skill	= array(
"name"	=> "ǿ������",
"img"	=> "item_042.png",
"exp"	=> "������",
"sp"	=> "60",
"type"	=> "0",
"learn"	=> "12",
"target"=> array("enemy","all",1),
"inf"	=> "dex",
"pow"	=> "80",
"charge"=> array(50,0),
"knockback"	=> "100",
"limit"=> array("��"=>true),
); break;
		case "2319":
$skill	= array(
"name"	=> "���ƴ���",
"img"	=> "item_042.png",
"exp"	=> "���ӷ���",
"sp"	=> "240",
"type"	=> "0",
"learn"	=> "12",
"target"=> array("all","all",1),
"inf"	=> "dex",
"pow"	=> "360",
"invalid"	=> "1",
"charge"=> array(120,0),
"pierce"=> true,
"limit"=> array("��"=>true),
); break;
								// 2400-�ن�ϵ
		case "2400":
$skill	= array(
"name"	=> "�粼���ٻ�",
"img"	=> "skill_066.png",
"exp"	=> "�粼���ٻ�",
"sp"	=> "100",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("self","individual",1),
"charge"=> array(30,0),
"summon"	=> "1000",
); break;
		case "2401":
$skill	= array(
"name"	=> "�ٻ�С��",
"img"	=> "skill_028.png",
"exp"	=> "�ٻ�С��",
"sp"	=> "150",
"type"	=> "0",
"learn"	=> "4",
"target"=> array("self","individual",1),
"charge"=> array(0,100),
"summon"	=> "5008",
); break;
		case "2402":
$skill	= array(
"name"	=> "�ٻ�����",
"img"	=> "skill_028.png",
"exp"	=> "�ٻ�����",
"sp"	=> "250",
"type"	=> "0",
"learn"	=> "10",
"target"=> array("self","individual",1),
"charge"=> array(0,300),
"summon"	=> "5009",
); break;
		case "2403":
$skill	= array(
"name"	=> "������ٻ�",
"img"	=> "skill_029.png",
"exp"	=> "������ٻ�",
"sp"	=> "350",
"type"	=> "0",
"learn"	=> "20",
"target"=> array("self","individual",1),
"charge"=> array(0,500),
"summon"	=> "5010",
); break;
		case "2404":
$skill	= array(
"name"	=> "�ٻ�ʨ��",
"img"	=> "skill_028.png",
"exp"	=> "�ٻ�ʨ��",
"sp"	=> "150",
"type"	=> "0",
"learn"	=> "4",
"target"=> array("self","individual",1),
"charge"=> array(0,100),
"summon"	=> "5011",
"quick"	=> true,
); break;
		case "2405":
$skill	= array(
"name"	=> "�ٻ���",
"img"	=> "skill_028.png",
"exp"	=> "�ٻ���",
"sp"	=> "250",
"type"	=> "0",
"learn"	=> "10",
"target"=> array("self","individual",1),
"charge"=> array(0,300),
"summon"	=> "5012",
"quick"	=> true,
); break;
		case "2406":
$skill	= array(
"name"	=> "�ٻ��ϳ���",
"img"	=> "skill_029.png",
"exp"	=> "�ٻ��ϳ���",
"sp"	=> "350",
"type"	=> "0",
"learn"	=> "20",
"target"=> array("self","individual",1),
"charge"=> array(0,500),
"summon"	=> "5013",
"quick"	=> true,
); break;
		case "2407":
$skill	= array(
"name"	=> "�ٻ�ѩ��",
"img"	=> "skill_028.png",
"exp"	=> "�ٻ�ѩ��",
"sp"	=> "250",
"type"	=> "0",
"learn"	=> "10",
"target"=> array("self","individual",1),
"charge"=> array(0,300),
"summon"	=> "5014",
"quick"	=> true,
); break;
		case "2408":
$skill	= array(
"name"	=> "�ٻ�С����",
"img"	=> "skill_028.png",
"exp"	=> "�ٻ�С����",
"sp"	=> "150",
"type"	=> "0",
"learn"	=> "4",
"target"=> array("self","individual",1),
"charge"=> array(0,100),
"summon"	=> "5015",
"quick"	=> true,
); break;
		case "2409":
$skill	= array(
"name"	=> "�ٻ��ɺ���",
"img"	=> "skill_028.png",
"exp"	=> "�ٻ��ɺ���",
"sp"	=> "250",
"type"	=> "0",
"learn"	=> "10",
"target"=> array("self","individual",1),
"charge"=> array(0,300),
"summon"	=> "5016",
"quick"	=> true,
); break;
		case "2410":
$skill	= array(
"name"	=> "�ٻ���",
"img"	=> "skill_029.png",
"exp"	=> "�ٻ���",
"sp"	=> "350",
"type"	=> "0",
"learn"	=> "20",
"target"=> array("self","individual",1),
"charge"=> array(0,500),
"summon"	=> "5017",
"quick"	=> true,
); break;
		case "2411":
$skill	= array(
"name"	=> "�ٻ�������",
"img"	=> "skill_029.png",
"exp"	=> "�ٻ�������",
"sp"	=> "550",
"type"	=> "0",
"learn"	=> "30",
"target"=> array("self","individual",1),
"charge"=> array(0,800),
"summon"	=> "5018",
"quick"	=> true,
); break;
		case "2412":
$skill	= array(
"name"	=> "�ٻ�����Ȯ",
"img"	=> "skill_029.png",
"exp"	=> "�ٻ�����Ȯ",
"sp"	=> "550",
"type"	=> "0",
"learn"	=> "30",
"target"=> array("self","individual",1),
"charge"=> array(0,800),
"summon"	=> "5019",
"quick"	=> true,
); break;
		case "2413":
$skill	= array(
"name"	=> "�ٻ���ʯ��",
"img"	=> "skill_029.png",
"exp"	=> "�ٻ���ʯ��",
"sp"	=> "550",
"type"	=> "0",
"learn"	=> "30",
"target"=> array("self","individual",1),
"charge"=> array(0,800),
"summon"	=> "5020",
"quick"	=> true,
); break;
				// 2460 - ��ʬ?
		case "2460":
$skill	= array(
"name"	=> "��ʬ",
"img"	=> "skill_028.png",
"exp"	=> "��ʬ",
"sp"	=> "60",
"type"	=> "1",
"learn"	=> "2",
"target"=> array("self","individual",1),
"charge"=> array(30,0),
"summon"	=> "5004",
); break;
		case "2461":
$skill	= array(
"name"	=> "ʳʬ��",
"img"	=> "skill_028.png",
"exp"	=> "ʳʬ��",
"sp"	=> "100",
"type"	=> "1",
"learn"	=> "4",
"target"=> array("self","individual",1),
"charge"=> array(40,0),
"summon"	=> "5005",
); break;
		case "2462":
$skill	= array(
"name"	=> "ľ����",
"img"	=> "skill_028.png",
"exp"	=> "ľ����",
"sp"	=> "120",
"type"	=> "1",
"learn"	=> "6",
"target"=> array("self","individual",1),
"charge"=> array(60,0),
"summon"	=> "5006",
); break;
		case "2463":
$skill	= array(
"name"	=> "��ʬ����",
"img"	=> "skill_028.png",
"exp"	=> "3���ٻ�",
"sp"	=> "200",
"type"	=> "1",
"learn"	=> "8",
"target"=> array("self","individual",1),
"charge"=> array(50,50),
"summon"	=> array(5004,5005,5004),
); break;
		case "2464":
$skill	= array(
"name"	=> "Ĺ��",
"img"	=> "skill_028.png",
"exp"	=> "3���ٻ�",
"sp"	=> "360",
"type"	=> "1",
"learn"	=> "12",
"target"=> array("self","individual",1),
"charge"=> array(100,0),
"summon"	=> array(5006,5007,5006),
); break;
		case "2465":
$skill	= array(
"name"	=> "����Σ��",
"img"	=> "skill_028.png",
"exp"	=> "5���ٻ�",
"sp"	=> "560",
"type"	=> "1",
"learn"	=> "16",
"target"=> array("self","individual",1),
"charge"=> array(160,0),
"summon"	=> array(5004,5006,5007,5006,5004),
); break;
		case "2466":
$skill	= array(
"name"	=> "��ħ���ٻ�",
"img"	=> "skill_028.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("self","individual",1),
"charge"=> array(0,1000),
"summon"	=> "5203",
); break;
		case "2467":
$skill	= array(
"name"	=> "ľ������ʿ",
"img"	=> "skill_028.png",
"exp"	=> "ľ����",
"sp"	=> "240",
"type"	=> "1",
"learn"	=> "8",
"target"=> array("self","individual",1),
"charge"=> array(80,0),
"summon"	=> "5023",
); break;
		case "2468":
$skill	= array(
"name"	=> "ľ����С��",
"img"	=> "skill_028.png",
"exp"	=> "3���ٻ�",
"sp"	=> "480",
"type"	=> "1",
"learn"	=> "16",
"target"=> array("self","individual",1),
"charge"=> array(120,0),
"summon"	=> array(5023,5023,5023),
); break;
		case "2469":
$skill	= array(
"name"	=> "ľ�������",
"img"	=> "skill_028.png",
"exp"	=> "5���ٻ�",
"sp"	=> "960",
"type"	=> "1",
"learn"	=> "24",
"target"=> array("self","individual",1),
"charge"=> array(180,0),
"summon"	=> array(5007,5023,5024,5023,5007),
); break;
								// 2480
		case "2480":
$skill	= array(
"name"	=> "������",
"img"	=> "skill_038.png",
"exp"	=> "�ٻ���������",
"sp"	=> "60",
"type"	=> "1",
"learn"	=> "4",
"target"=> array("self","individual",1),
"charge"=> array(0,0),
"summon"	=> "5000",
"quick"	=> true,
); break;
		case "2481":
$skill	= array(
"name"	=> "��ʹ����",
"img"	=> "skill_038.png",
"exp"	=> "��ʹ����",
"sp"	=> "160",
"type"	=> "1",
"learn"	=> "10",
"target"=> array("self","individual",1),
"charge"=> array(60,0),
"summon"	=> "5001",
"quick"	=> true,
); break;
		case "2482":
$skill	= array(
"name"	=> "��ʹ����",
"img"	=> "skill_038.png",
"exp"	=> "",
"sp"	=> "360",
"type"	=> "1",
"learn"	=> "16",
"target"=> array("self","individual",1),
"charge"=> array(60,60),
"summon"	=> "5021",
"quick"	=> true,
); break;
		case "2483":
$skill	= array(
"name"	=> "�񽫽���",
"img"	=> "skill_038.png",
"exp"	=> "",
"sp"	=> "600",
"type"	=> "1",
"learn"	=> "24",
"target"=> array("self","individual",1),
"charge"=> array(60,120),
"summon"	=> "5022",
"quick"	=> true,
); break;
//-----------------------------------------	2500 �ޤ��ن�ϵ
		case "2500":
$skill	= array(
"name"	=> "��������",
"img"	=> "skill_029.png",
"exp"	=> "",
"sp"	=> "700",
"type"	=> "1",
"learn"	=> "20",
"target"=> array("self","individual",1),
"charge"=> array(100,300),
"summon"	=> "5103",
"quick"	=> true,
"MagicCircleDeleteTeam"	=> 4,
); break;
		case "2501":
$skill	= array(
"name"	=> "��ά̹",
"img"	=> "skill_029.png",
"exp"	=> "",
"sp"	=> "700",
"type"	=> "1",
"learn"	=> "20",
"target"=> array("self","individual",1),
"charge"=> array(100,300),
"summon"	=> "5104",
"quick"	=> true,
"MagicCircleDeleteTeam"	=> 4,
); break;
		case "2502":
$skill	= array(
"name"	=> "��ʹ��",
"img"	=> "skill_029.png",
"exp"	=> "",
"sp"	=> "900",
"type"	=> "1",
"learn"	=> "30",
"target"=> array("self","individual",1),
"charge"=> array(100,300),
"summon"	=> "5100",
"quick"	=> true,
"MagicCircleDeleteTeam"	=> 5,
); break;
		case "2503":
$skill	= array(
"name"	=> "������ʹ",
"img"	=> "skill_029.png",
"exp"	=> "",
"sp"	=> "900",
"type"	=> "1",
"learn"	=> "30",
"target"=> array("self","individual",1),
"charge"=> array(100,300),
"summon"	=> "5101",
"quick"	=> true,
"MagicCircleDeleteTeam"	=> 5,
); break;
		case "2504":
$skill	= array(
"name"	=> "�ж�",
"img"	=> "skill_029.png",
"exp"	=> "",
"sp"	=> "1200",
"type"	=> "1",
"learn"	=> "35",
"target"=> array("self","individual",1),
"charge"=> array(100,500),
"summon"	=> "5102",
"quick"	=> true,
"MagicCircleDeleteTeam"	=> 5,
); break;
		case "2505":
$skill	= array(
"name"	=> "�����",
"img"	=> "skill_029.png",
"exp"	=> "",
"sp"	=> "1800",
"type"	=> "1",
"learn"	=> "50",
"target"=> array("self","individual",1),
"charge"=> array(100,1000),
"summon"	=> "5107",
"quick"	=> true,
"MagicCircleDeleteTeam"	=> 5,
); break;
		case "2506":
$skill	= array(
"name"	=> "�����",
"img"	=> "skill_029.png",
"exp"	=> "",
"sp"	=> "1800",
"type"	=> "1",
"learn"	=> "50",
"target"=> array("self","individual",1),
"charge"=> array(100,1000),
"summon"	=> "5108",
"quick"	=> true,
"MagicCircleDeleteTeam"	=> 5,
); break;
		case "2507":
$skill	= array(
"name"	=> "������",
"img"	=> "skill_029.png",
"exp"	=> "",
"sp"	=> "1800",
"type"	=> "1",
"learn"	=> "50",
"target"=> array("self","individual",1),
"charge"=> array(100,1000),
"summon"	=> "5109",
"quick"	=> true,
"MagicCircleDeleteTeam"	=> 5,
); break;
////////////////////////////////////////
		case "3000"://	3000 - ����
$skill	= array(
"name"	=> "����",
"img"	=> "skill_013a.png",
"exp"	=> "HP�ظ�",
"sp"	=> "5",
"type"	=> "1",
"learn"	=> "0",
"target"=> array("friend","individual",1),
"pow"	=> "200",
"support"	=> "1",
"priority"	=> "LowHpRate",
"exp"	=> "",
"charge"=> array(30,0),
); break;
		case "3001":
$skill	= array(
"name"	=> "�߼�����",
"img"	=> "skill_013b.png",
"exp"	=> "HP�ظ�",
"sp"	=> "20",
"type"	=> "1",
"learn"	=> "4",
"target"=> array("friend","multi",2),
"pow"	=> "300",
"support"	=> "1",
"priority"	=> "LowHpRate",
"charge"=> array(50,0),
); break;
		case "3002":
$skill	= array(
"name"	=> "Ⱥ��ظ�",
"img"	=> "skill_013c.png",
"exp"	=> "HP�ظ�",
"sp"	=> "30",
"type"	=> "1",
"learn"	=> "12",
"target"=> array("friend","all",1),
"pow"	=> "150",
"support"	=> "1",
"priority"	=> "LowHpRate",
"charge"=> array(50,0),
); break;
		case "3003":
$skill	= array(
"name"	=> "���ٻظ�",
"img"	=> "skill_013b.png",
"exp"	=> "HP�ظ�",
"sp"	=> "20",
"type"	=> "1",
"learn"	=> "4",
"target"=> array("friend","multi",2),
"pow"	=> "180",
"support"	=> "1",
"priority"	=> "LowHpRate",
); break;
		case "3004":
$skill	= array(
"name"	=> "����ظ�",
"img"	=> "skill_013b.png",
"exp"	=> "HP�ظ�",
"sp"	=> "30",
"type"	=> "1",
"learn"	=> "10",
"target"=> array("friend","multi",3),
"pow"	=> "200",
"support"	=> "1",
"priority"	=> "LowHpRate",
"charge"=> array(40,0),
); break;
		case "3005":
$skill	= array(
"name"	=> "�����ظ�",
"img"	=> "skill_013b.png",
"exp"	=> "����HP30%����ʱ�ظ���2��",
"sp"	=> "30",
"type"	=> "1",
"learn"	=> "4",
"target"=> array("friend","multi",3),
"pow"	=> "125",
"support"	=> "1",
"priority"	=> "LowHpRate",
"charge"=> array(20,0),
); break;
		case "3006":
$skill	= array(
"name"	=> "Ⱥ������",
"img"	=> "skill_013c.png",
"exp"	=> "HP�ظ�",
"sp"	=> "60",
"type"	=> "1",
"learn"	=> "16",
"target"=> array("friend","all",1),
"pow"	=> "360",
"support"	=> "1",
"priority"	=> "LowHpRate",
"charge"=> array(60,30),
); break;
		case "3007":
$skill	= array(
"name"	=> "��������",
"img"	=> "skill_013b.png",
"exp"	=> "HP�ظ�",
"sp"	=> "60",
"type"	=> "1",
"learn"	=> "6",
"target"=> array("friend","multi",3),
"pow"	=> "360",
"support"	=> "1",
"priority"	=> "LowHpRate",
"charge"=> array(60,30),
); break;
		case "3008":
$skill	= array(
"name"	=> "��������",
"img"	=> "skill_013a.png",
"exp"	=> "HP�ظ�",
"sp"	=> "40",
"type"	=> "1",
"learn"	=> "8",
"target"=> array("friend","multi",2),
"pow"	=> "240",
"support"	=> "1",
"priority"	=> "LowHpRate",
); break;
		case "3009":
$skill	= array(
"name"	=> "��������",
"img"	=> "skill_013b.png",
"exp"	=> "����HP30%����ʱ�ظ���2��",
"sp"	=> "60",
"type"	=> "1",
"learn"	=> "6",
"target"=> array("friend","multi",3),
"pow"	=> "160",
"support"	=> "1",
"priority"	=> "LowHpRate",
"charge"=> array(10,60),
); break;
		case "3010"://	3010
$skill	= array(
"name"	=> "�ָ�����",
"img"	=> "skill_019.png",
"exp"	=> "SP�ظ�",
"sp"	=> "0",
"type"	=> "1",
"learn"	=> "0",
"target"=> array("self","individual",1),
"support"	=> "1",
); break;
		case "3011":
$skill	= array(
"name"	=> "���о���",
"img"	=> "skill_019z.png",
"exp"	=> "SP�ظ�",
"sp"	=> "0",
"type"	=> "1",
"learn"	=> "2",
"target"=> array("self","individual",1),
"support"	=> "1",
"charge"	=> array(30,0),
); break;
		case "3012":
$skill	= array(
"name"	=> "Ѫתħ",
"img"	=> "skill_019y.png",
"exp"	=> "SP�ظ�",
"sp"	=> "0",
"type"	=> "1",
"learn"	=> "6",
"target"=> array("self","individual",1),
"pow"	=> "100",
"support"	=> "1",
"charge"	=> array(20,0),
); break;
		case "3013":
$skill	= array(
"name"	=> "ħתѪ",
"img"	=> "exchange.png",
"exp"	=> "HP,SP����(%)",
"sp"	=> "10",
"type"	=> "1",
"learn"	=> "10",
"target"=> array("self","individual",1),
"support"	=> "1",
); break;
		case "3020":
$skill	= array(
"name"	=> "ħ������",
"img"	=> "skill_019.png",
"exp"	=> "���SP����",
"sp"	=> "100",
"type"	=> "1",
"learn"	=> "2",
"target"=> array("self","individual",1),
"support"	=> "1",
); break;
		case "3021":
$skill	= array(
"name"	=> "������",
"img"	=> "skill_019z.png",
"exp"	=> "SP�ظ�",
"sp"	=> "0",
"type"	=> "1",
"learn"	=> "8",
"target"=> array("self","individual",1),
"support"	=> "1",
"charge"	=> array(30,0),
"UpSPD"	=> "50",
"UpMATK"	=> "25",
"UpATK"	=> "25",
); break;
					// 3030
		case "3030":
$skill	= array(
"name"	=> "�쳣�ָ�",
"img"	=> "skill_008.png",
"exp"	=> "״̬�쳣�ָ�",
"sp"	=> "30",
"type"	=> "1",
"learn"	=> "2",
"target"=> array("friend","all",1),
"support"	=> "1",
"pow"	=> "70",
"charge"	=> array(50,0),
"CurePoison"	=> true,
); break;
					// 3040
		case "3040":
$skill	= array(
"name"	=> "����",
"img"	=> "mat_026.png",
"exp"	=> "����",
"sp"	=> "120",
"type"	=> "1",
"learn"	=> "10",
"target"=> array("friend","individual",1),
"support"	=> "1",
"charge"	=> array(40,30),
"pow"		=> "600",
"priority"	=> "Dead",
); break;
		case "3041":
$skill	= array(
"name"	=> "��������",
"img"	=> "skill_008.png",
"exp"	=> "����",
"sp"	=> "500",
"type"	=> "1",
"learn"	=> "25",
"target"=> array("friend","multi",2),
"support"	=> "1",
"charge"	=> array(0,250),
"pow"		=> "250",
"priority"	=> "Dead",
); break;
		case "3042":
$skill	= array(
"name"	=> "����ת��",
"img"	=> "mat_026.png",
"exp"	=> "����",
"sp"	=> "350",
"type"	=> "1",
"learn"	=> "15",
"target"=> array("friend","individual",1),
"support"	=> "1",
"charge"	=> array(0,150),
"pow"		=> "150",
"priority"	=> "Dead",
); break;
//---------------------------------- 3050
		case "3050":
$skill	= array(
"name"	=> "�����ж�",
"img"	=> "skill_015.png",
"exp"	=> "�����ж�",
"sp"	=> "150",
"type"	=> "1",
"learn"	=> "10",
"target"=> array("friend","all",1),
"support"	=> "1",
"charge"	=> array(200,100),
); break;
		case "3051":
$skill	= array(
"name"	=> "ʱ����Ծ",
"img"	=> "skill_015.png",
"exp"	=> "�����ж�",
"sp"	=> "600",
"type"	=> "1",
"learn"	=> "30",
"target"=> array("friend","all",1),
"support"	=> "1",
"charge"	=> array(30,600),
); break;
		case "3052":
$skill	= array(
"name"	=> "��֪��������ʲô",
"img"	=> "skill_015.png",
"exp"	=> "�����ж�",
"sp"	=> "90",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("friend","all",1),
"support"	=> "1",
"charge"	=> array(0,90),
); break;
//---------------------------------- 3055
		case "3055":
$skill	= array(
"name"	=> "�ӿ�ӽ��",
"img"	=> "skill_016z.png",
"exp"	=> "�ӿ�ӽ��",
"sp"	=> "150",
"type"	=> "1",
"learn"	=> "10",
"target"=> array("friend","all",1),
"support"	=> "1",
"charge"	=> array(0,100),
); break;
		case "3056":
$skill	= array(
"name"	=> "����ӽ��",
"img"	=> "skill_016z.png",
"exp"	=> "�ӿ�ӽ��",
"sp"	=> "400",
"type"	=> "1",
"learn"	=> "20",
"target"=> array("friend","all",1),
"support"	=> "1",
"charge"	=> array(0,200),
); break;
//---------------------------------- 3060
		case "3060":
$skill	= array(
"name"	=> "ʥ�����",
"img"	=> "skill_045z.png",
"exp"	=> "һ�غ�������Ч��",
"sp"	=> "100",
"type"	=> "1",
"learn"	=> "10",
"target"=> array("friend","all",1),
"support"	=> "1",
"charge"	=> array(0,100),
); break;
//-------------------------- 3101
		case "3101"://	3101
$skill	= array(
"name"	=> "ף��",
"img"	=> "skill_008.png",
"exp"	=> "SP�ظ�",
"sp"	=> "0",
"type"	=> "1",
"learn"	=> "0",
"target"=> array("friend","all",1),
"SpRecoveryRate"	=> 3,
"support"	=> "1",
); break;
		case "3102":
$skill	= array(
"name"	=> "��ף��",
"img"	=> "skill_009.png",
"exp"	=> "SP�ظ�",
"sp"	=> "20",
"type"	=> "1",
"learn"	=> "4",
"target"=> array("friend","all",1),
"SpRecoveryRate"	=> 5,
"support"	=> "1",
"charge"	=> array(40,0),
); break;
		case "3103":
$skill	= array(
"name"	=> "ʥ��",
"img"	=> "skill_010.png",
"exp"	=> "HP,SP�ظ�",
"sp"	=> "150",
"type"	=> "1",
"learn"	=> "8",
"target"=> array("friend","all",1),
"pow"	=> "500",
"SpRecoveryRate"	=> 7,
"support"	=> "1",
"charge"	=> array(50,0),
"MagicCircleDeleteTeam"	=> 2,
"CurePoison"	=> true,
); break;
		case "3104":
$skill	= array(
"name"	=> "��罵��",
"img"	=> "skill_010.png",
"exp"	=> "HP,SP�ظ�",
"sp"	=> "400",
"type"	=> "1",
"learn"	=> "14",
"target"=> array("friend","all",1),
"pow"	=> "1000",
"SpRecoveryRate"	=> 10,
"support"	=> "1",
"charge"	=> array(100,40),
"MagicCircleDeleteTeam"	=> 4,
"CurePoison"	=> true,
); break;
		case "3105":
$skill	= array(
"name"	=> "��ף��",
"img"	=> "skill_009.png",
"exp"	=> "SP�ظ�",
"sp"	=> "80",
"type"	=> "1",
"learn"	=> "8",
"target"=> array("friend","all",1),
"SpRecoveryRate"	=> 8,
"support"	=> "1",
"charge"	=> array(80,0),
); break;
//----------------------------- 3110
		case "3110":
$skill	= array(
"name"	=> "ǿ��",
"img"	=> "skill_059.png",
"exp"	=> "�Լ�ǿ��",
"sp"	=> "10",
"type"	=> "0",
"learn"	=> "2",
"target"=> array("self","individual",1),
"support"	=> "1",
"UpSTR"	=> "30",
); break;
		case "3111":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_059z.png",
"exp"	=> "�Լ�ǿ������",
"sp"	=> "10",
"type"	=> "0",
"learn"	=> "8",
"target"=> array("self","individual",1),
"support"	=> "1",
"UpSTR"	=> "80",
"DownMAXHP"	=> "20",
); break;
		case "3112":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_059y.png",
"exp"	=> "�Լ�ǿ��������ǰ����",
"sp"	=> "10",
"type"	=> "0",
"learn"	=> "6",
"target"=> array("self","individual",1),
"support"	=> "1",
"UpDEF"=> "20",
"DownSTR"=> "20",
"move"	=> "front",
); break;
		case "3113":
$skill	= array(
"name"	=> "�񱩻�",
"img"	=> "skill_058z.png",
"exp"	=> "�񱩻�",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "12",
"target"=> array("self","individual",1),
"support"	=> "1",
); break;
		case "3114":
$skill	= array(
"name"	=> "ӭ��׼��",
"img"	=> "skill_059y.png",
"exp"	=> "�Լ�ǿ��",
"sp"	=> "20",
"type"	=> "0",
"learn"	=> "8",
"target"=> array("self","individual",1),
"support"	=> "1",
"UpDEF"=> "80",
"UpMDEF"=> "80",
"DownSPD"=> "80",
"move"	=> "front",
); break;
		case "3115":
$skill	= array(
"name"	=> "����֮��",
"img"	=> "skill_059.png",
"exp"	=> "�Լ�ǿ��",
"sp"	=> "150",
"type"	=> "0",
"learn"	=> "5",
"target"=> array("self","individual",1),
"charge"	=> array(50,0),
"support"	=> "1",
"UpSTR"	=> "50",
"UpATK"	=> "50",
); break;
		case "3116":
$skill	= array(
"name"	=> "ħ����Լ",
"img"	=> "skill_059.png",
"exp"	=> "�Լ�ǿ��",
"sp"	=> "180",
"type"	=> "1",
"learn"	=> "6",
"target"=> array("self","individual",1),
"charge"	=> array(60,0),
"support"	=> "1",
"UpINT"	=> "50",
"UpMATK"	=> "50",
); break;
		case "3120":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_014.png",
"exp"	=> "�Լ�HP�ظ�",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "1",
"target"=> array("self","individual",1),
"support"	=> "1",
); break;
		case "3121":
$skill	= array(
"name"	=> "���һظ�",
"img"	=> "skill_062.png",
"exp"	=> "",
"sp"	=> "15",
"type"	=> "0",
"learn"	=> "4",
"target"=> array("self","individual",1),
"support"	=> "1",
); break;
		case "3122":
$skill	= array(
"name"	=> "���ظ�",
"img"	=> "skill_062y.png",
"exp"	=> "�ָ��Լ���ʧ����HP�е�60%",
"sp"	=> "20",
"type"	=> "0",
"learn"	=> "4",
"target"=> array("self","individual",1),
"support"	=> "1",
"charge"=> array(0,30),
); break;
		case "3123":
$skill	= array(
"name"	=> "���ҳ����ظ�",
"img"	=> "skill_062x.png",
"exp"	=> "HP�����ظ���+10%",
"sp"	=> "10",
"type"	=> "0",
"learn"	=> "5",
"target"=> array("self","individual",1),
"support"	=> "1",
"charge"=> array(10,10),
"HpRegen"	=> 10,
); break;
		case "3124":
$skill	= array(
"name"	=> "��������",
"img"	=> "skill_062y.png",
"exp"	=> "Ѫ��20%����ʹ�ã��ָ��Լ���ʧ����HP�е�80%",
"sp"	=> "80",
"type"	=> "0",
"learn"	=> "8",
"target"=> array("self","individual",1),
"support"	=> "1",
"charge"=> array(0,80),
); break;
		case "3130":
$skill	= array(
"name"	=> "ӽ������",
"img"	=> "skill_062x.png",
"exp"	=> "ӽ������",
"sp"	=> "10",
"type"	=> "0",
"learn"	=> "3",
"target"=> array("self","individual",1),
"support"	=> "1",
"charge"=> array(0,30),
"HpRegen"	=> 10,
); break;
		case "3135":
$skill	= array(
"name"	=> "ʥ���",
"img"	=> "skill_062x.png",
"exp"	=> "һ�غ��˺���Ч��",
"sp"	=> "10",
"type"	=> "0",
"learn"	=> "3",
"target"=> array("self","individual",1),
"support"	=> "1",
"charge"=> array(0,30),
); break;
		case "3136":
$skill	= array(
"name"	=> "��������",
"img"	=> "skill_057.png",
"exp"	=> "",
"sp"	=> "240",
"type"	=> "1",
"learn"	=> "12",
"target"=> array("friend","all",1),
"support"	=> "1",
"pow"	=> "120",
"charge"	=> array(40,20),
); break;
		case "3137":
$skill	= array(
"name"	=> "��������",
"img"	=> "skill_009.png",
"exp"	=> "",
"sp"	=> "240",
"type"	=> "1",
"learn"	=> "12",
"target"=> array("friend","all",1),
"SpRecoveryRate"	=> 4,
"support"	=> "1",
"charge"	=> array(40,20),
); break;
		case "3138":
$skill	= array(
"name"	=> "������",
"img"	=> "skill_059.png",
"exp"	=> "�ٶ�ǿ��",
"sp"	=> "100",
"type"	=> "1",
"learn"	=> "10",
"target"=> array("self","individual",1),
"support"	=> "1",
"UpSPD"	=> "100",
); break;
		case "3139":
$skill	= array(
"name"	=> "��֮�ӻ�",
"img"	=> "skill_044.png",
"sp"	=> "300",
"type"	=> "1",
"learn"	=> "20",
"target"=> array("friend","all",1),
"support"	=> "1",
"UpSPD"	=> "30",
); break;
//-----------------------------------------------// 3200
		case "3200":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_044.png",
"sp"	=> "60",
"type"	=> "1",
"learn"	=> "6",
"target"=> array("friend","all",1),
"support"	=> "1",
"charge"	=> array(30,0),
"UpSTR"	=> "30",
); break;
		case "3201":
$skill	= array(
"name"	=> "��ս��Ԯ",
"img"	=> "skill_044.png",
"sp"	=> "150",
"type"	=> "0",
"learn"	=> "6",
"target"=> array("friend","all",1),
"support"	=> "1",
"charge"	=> array(30,60),
"UpDEF"	=> "50",
); break;
		case "3202":
$skill	= array(
"name"	=> "��ħ���",
"img"	=> "skill_044.png",
"sp"	=> "300",
"type"	=> "1",
"learn"	=> "6",
"target"=> array("friend","all",1),
"support"	=> "1",
"charge"	=> array(30,60),
"UpMDEF"	=> "50",
); break;
						// 3205
		case "3205":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_048.png",
"sp"	=> "60",
"type"	=> "1",
"learn"	=> "6",
"target"=> array("enemy","all",1),
"support"	=> "1",
"charge"	=> array(30,0),
"DownSTR"	=> "40",
); break;
		case "3206":
$skill	= array(
"name"	=> "��ŭ",
"img"	=> "skill_048.png",
"sp"	=> "80",
"type"	=> "1",
"learn"	=> "4",
"target"=> array("enemy","all",1),
"support"	=> "1",
"charge"	=> array(80,80),
"DownSTR"	=> "40",
"DownINT"	=> "40",
"DownSPD"	=> "40",
); break;
						// 3210
		case "3210":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_046.png",
"sp"	=> "60",
"type"	=> "1",
"learn"	=> "6",
"target"=> array("friend","all",1),
"support"	=> "1",
"charge"	=> array(30,0),
"UpINT"	=> "30",
); break;
						// 3215
		case "3215":
$skill	= array(
"name"	=> "�ƻ�����",
"img"	=> "skill_050.png",
"sp"	=> "60",
"type"	=> "1",
"learn"	=> "6",
"target"=> array("enemy","all",1),
"support"	=> "1",
"charge"	=> array(30,0),
"DownINT"	=> "40",
); break;
		case "3216":
$skill	= array(
"name"	=> "����ս",
"img"	=> "skill_050.png",
"sp"	=> "100",
"type"	=> "1",
"learn"	=> "10",
"target"=> array("all","all",1),
"support"	=> "1",
"charge"	=> array(100,100),
"DownINT"	=> "100",
"DowMATK"	=> "100",
); break;
		case "3217":
$skill	= array(
"name"	=> "����ǿ��",
"img"	=> "skill_050.png",
"sp"	=> "200",
"type"	=> "1",
"learn"	=> "12",
"target"=> array("all","all",1),
"support"	=> "1",
"charge"	=> array(100,100),
"UpSTR"	=> "100",
); break;
						// 3220
		case "3220":
$skill	= array(
"name"	=> "�����ش�",
"img"	=> "skill_045.png",
"sp"	=> "60",
"type"	=> "1",
"learn"	=> "6",
"target"=> array("friend","all",1),
"support"	=> "1",
"charge"	=> array(30,0),
"UpDEF"	=> "10",
); break;
		case "3221":
$skill	= array(
"name"	=> "����+",
"img"	=> "skill_045.png",
"sp"	=> "90",
"type"	=> "1",
"learn"	=> "6",
"target"=> array("friend","all",1),
"support"	=> "1",
"charge"	=> array(90,0),
"UpDEF"	=> "15",
); break;
		case "3222":
$skill	= array(
"name"	=> "����Q",
"img"	=> "skill_045.png",
"sp"	=> "70",
"type"	=> "1",
"learn"	=> "6",
"target"=> array("friend","all",1),
"support"	=> "1",
"charge"	=> array(0,0),
"UpDEF"	=> "5",
); break;
						// 3230
		case "3230":
$skill	= array(
"name"	=> "�����ش�",
"img"	=> "skill_070.png",
"sp"	=> "60",
"type"	=> "1",
"learn"	=> "6",
"target"=> array("friend","all",1),
"support"	=> "1",
"charge"	=> array(30,0),
"UpMDEF"	=> "10",
); break;
		case "3231":
$skill	= array(
"name"	=> "�����ش�[����]",
"img"	=> "skill_070.png",
"sp"	=> "30",
"type"	=> "1",
"learn"	=> "6",
"target"=> array("self","individual",1),
"support"	=> "1",
"charge"	=> array(30,0),
"UpMDEF"	=> "30",
); break;
						// 3235
		case "3235":
$skill	= array(
"name"	=> "���Խ���",
"img"	=> "skill_071.png",
"sp"	=> "60",
"type"	=> "1",
"learn"	=> "6",
"target"=> array("enemy","all",1),
"support"	=> "1",
"charge"	=> array(30,10),
"DownMDEF"	=> "10",
); break;
//---------------------------- 3250
		case "3250":
$skill	= array(
"name"	=> "��������",
"img"	=> "skill_044.png",
"sp"	=> "60",
"type"	=> "1",
"learn"	=> "6",
"target"=> array("friend","all",1),
"support"	=> "1",
"charge"	=> array(30,0),
"PlusSTR"	=> 30,
); break;
		case "3255":
$skill	= array(
"name"	=> "ħ������",
"img"	=> "skill_046.png",
"sp"	=> "60",
"type"	=> "1",
"learn"	=> "6",
"target"=> array("friend","all",1),
"support"	=> "1",
"charge"	=> array(30,0),
"PlusINT"	=> 30,
); break;
		case "3265":
$skill	= array(
"name"	=> "�ٶȸ���",
"img"	=> "skill_015.png",
"sp"	=> "60",
"type"	=> "1",
"learn"	=> "6",
"target"=> array("friend","all",1),
"support"	=> "1",
"charge"	=> array(30,0),
"PlusSPD"	=> 20,
); break;
		case "3270":
$skill	= array(
"name"	=> "��������",
"img"	=> "skill_015.png",
"sp"	=> "300",
"type"	=> "1",
"learn"	=> "12",
"target"=> array("friend","all",1),
"support"	=> "1",
"charge"	=> array(60,0),
"UpATK"	=> "15",
"UpMATK"	=> "15",
); break;
		case "3275":
$skill	= array(
"name"	=> "������ǿ��",
"img"	=> "skill_015.png",
"sp"	=> "200",
"type"	=> "1",
"learn"	=> "8",
"target"=> array("friend","all",1),
"support"	=> "1",
"charge"	=> array(60,40),
"UpLUK"	=> "100",
); break;
//------------------------------------------------// 3300 - �ٻ���ǿ��ϵ
		case "3300":
$skill	= array(
"name"	=> "�ٻ���ǿ��",
"img"	=> "we_other007.png",
"exp"	=> "�ٻ���ǿ��",
"sp"	=> "60",
"type"	=> "0",
"learn"	=> "4",
"target"=> array("friend","all",1),
"support"	=> "1",
"charge"	=> array(0,50),
"UpSTR"	=> "80",
"limit"=> array("��"=>true,),
); break;
		case "3301":
$skill	= array(
"name"	=> "�ٻ�������ǿ��",
"img"	=> "we_other007.png",
"exp"	=> "�ٻ���ǿ��",
"sp"	=> "60",
"type"	=> "0",
"learn"	=> "4",
"target"=> array("friend","all",1),
"support"	=> "1",
"charge"	=> array(0,50),
"UpINT"	=> "80",
"limit"=> array("��"=>true,),
); break;
		case "3302":
$skill	= array(
"name"	=> "�ٻ����ٶ�ǿ��",
"img"	=> "we_other007.png",
"exp"	=> "�ٻ���ǿ��",
"sp"	=> "60",
"type"	=> "0",
"learn"	=> "4",
"target"=> array("friend","all",1),
"support"	=> "1",
"charge"	=> array(0,50),
"UpSPD"	=> "50",
"limit"=> array("��"=>true,),
); break;
		case "3303":
$skill	= array(
"name"	=> "�ٻ������ǿ��",
"img"	=> "we_other007.png",
"exp"	=> "�ٻ���ǿ��",
"sp"	=> "60",
"type"	=> "0",
"learn"	=> "4",
"target"=> array("friend","all",1),
"support"	=> "1",
"charge"	=> array(0,50),
"UpDEF"	=> "20",
"UpMDEF"	=> "20",
"limit"=> array("��"=>true,),
); break;
		case "3304":
$skill	= array(
"name"	=> "�ٻ�������ǿ��",
"img"	=> "we_other007z.png",
"exp"	=> "�ٻ���ǿ��",
"sp"	=> "100",
"type"	=> "0",
"learn"	=> "6",
"target"=> array("friend","individual",1),
"support"	=> "1",
"charge"	=> array(0,50),
"UpSTR"	=> "150",
"priority"	=> "Summon",
"limit"=> array("��"=>true,),
); break;
		case "3305":
$skill	= array(
"name"	=> "����",
"img"	=> "we_other007z.png",
"exp"	=> "�ٻ���ǿ��",
"sp"	=> "100",
"type"	=> "0",
"learn"	=> "6",
"target"=> array("friend","individual",1),
"support"	=> "1",
"charge"	=> array(0,50),
"UpINT"	=> "150",
"priority"	=> "Summon",
"limit"=> array("��"=>true,),
); break;
		case "3306":
$skill	= array(
"name"	=> "����",
"img"	=> "we_other007z.png",
"exp"	=> "�ٻ���ǿ��",
"sp"	=> "100",
"type"	=> "0",
"learn"	=> "6",
"target"=> array("friend","individual",1),
"support"	=> "1",
"charge"	=> array(0,100),
"UpSPD"	=> "100",
"priority"	=> "Summon",
"limit"=> array("��"=>true,),
); break;
		case "3307":
$skill	= array(
"name"	=> "��ǿ",
"img"	=> "we_other007z.png",
"exp"	=> "�ٻ���ǿ��",
"sp"	=> "100",
"type"	=> "0",
"learn"	=> "6",
"target"=> array("friend","individual",1),
"support"	=> "1",
"charge"	=> array(0,50),
"UpDEF"	=> "50",
"UpMDEF"	=> "50",
"priority"	=> "Summon",
"limit"=> array("��"=>true,),
); break;
		case "3308":
$skill	= array(
"name"	=> "ȫ��֧��",
"img"	=> "we_other007z.png",
"exp"	=> "�ٻ���ǿ��",
"sp"	=> "200",
"type"	=> "0",
"learn"	=> "8",
"target"=> array("friend","individual",1),
"support"	=> "1",
"charge"	=> array(0,150),
"UpSTR"	=> "100",
"UpINT"	=> "100",
"UpSPD"	=> "100",
"priority"	=> "Summon",
"limit"=> array("��"=>true,),
); break;
		case "3309":
$skill	= array(
"name"	=> "ȫ��֧��",
"img"	=> "we_other007z.png",
"exp"	=> "�ٻ���ǿ��",
"sp"	=> "400",
"type"	=> "0",
"learn"	=> "14",
"target"=> array("friend","all",1),
"support"	=> "1",
"charge"	=> array(0,400),
"UpSTR"	=> "100",
"UpINT"	=> "100",
"UpSPD"	=> "100",
"limit"=> array("��"=>true,),
); break;
		case "3310":
$skill	= array(
"name"	=> "Ұ�޽�ֹ",
"img"	=> "we_other007x.png",
"exp"	=> "�ٻ�������",
"sp"	=> "100",
"type"	=> "0",
"learn"	=> "6",
"target"=> array("enemy","individual",1),
"support"	=> "1",
"charge"	=> array(0,50),
"DownSTR"	=> "50",
"DownINT"	=> "50",
"DownSPD"	=> "50",
"DownDEF"	=> "20",
"DownMDEF"	=> "20",
"priority"	=> "Summon",
"limit"=> array("��"=>true,),
); break;
		case "3311":
$skill	= array(
"name"	=> "Ұ�޻���",
"img"	=> "we_other007x.png",
"exp"	=> "�����ٻ���",
"sp"	=> "100",
"type"	=> "0",
"learn"	=> "6",
"target"=> array("enemy","individual",1),
"pow"	=> "1500",
"charge"	=> array(0,30),
"priority"	=> "Summon",
); break;
		case "3312":
$skill	= array(
"name"	=> "Ұ����ɱ",
"img"	=> "we_other007x.png",
"exp"	=> "�����ٻ���",
"sp"	=> "300",
"type"	=> "0",
"learn"	=> "12",
"target"=> array("enemy","all",1),
"pow"	=> "1000",
"charge"	=> array(0,60),
); break;
		case "3313":
$skill	= array(
"name"	=> "ħ��ǿ��",
"img"	=> "we_other007z.png",
"exp"	=> "�ٻ���ǿ��",
"sp"	=> "200",
"type"	=> "0",
"learn"	=> "10",
"target"=> array("friend","individual",1),
"support"	=> "1",
"charge"	=> array(0,100),
"UpMAXHP"	=> "100",
"UpDEF"	=> "20",
"UpMDEF"	=> "20",
"priority"	=> "Summon",
"MagicCircleDeleteTeam"	=> 1,
); break;
		case "3314":
$skill	= array(
"name"	=> "ħ�ޱ���",
"img"	=> "we_other007z.png",
"exp"	=> "�ٻ���ǿ��",
"sp"	=> "300",
"type"	=> "0",
"learn"	=> "15",
"target"=> array("friend","individual",1),
"support"	=> "1",
"charge"	=> array(0,100),
"UpATK"	=> "50",
"UpMATK"	=> "50",
"priority"	=> "Summon",
"MagicCircleDeleteTeam"	=> 2,
); break;
		case "3315":
$skill	= array(
"name"	=> "ȫħ��ǿ��",
"img"	=> "we_other007z.png",
"exp"	=> "�ٻ���ǿ��",
"sp"	=> "400",
"type"	=> "0",
"learn"	=> "20",
"target"=> array("friend","all",1),
"support"	=> "1",
"charge"	=> array(0,200),
"UpMAXHP"	=> "100",
"UpDEF"		=> "20",
"UpMDEF"	=> "20",
"MagicCircleDeleteTeam"	=> 3,
); break;
		case "3316":
$skill	= array(
"name"	=> "ȫħ�ޱ���",
"img"	=> "we_other007z.png",
"exp"	=> "�ٻ���ǿ��",
"sp"	=> "500",
"type"	=> "0",
"learn"	=> "25",
"target"=> array("friend","all",1),
"support"	=> "1",
"charge"	=> array(0,200),
"UpATK"	=> "50",
"UpMATK"	=> "50",
"MagicCircleDeleteTeam"	=> 4,
); break;
		case "3317":
$skill	= array(
"name"	=> "ħ�޸���",
"img"	=> "skill_066.png",
"exp"	=> "����ǿ��",
"sp"	=> "600",
"type"	=> "1",
"learn"	=> "30",
"target"=> array("self","individual",1),
"charge"=> array(0,150),
"UpMAXHP"=> 200,
"UpMATK"=> 100,
"UpINT"=> 100,
"UpDEF"	=> "25",
"UpMDEF"	=> "25",
"UpSPD"=> 50,
"MagicCircleDeleteTeam"	=> 5,
); break;
//----------------------------------------- 3400 �����ظ�ϵ
		case "3400":
$skill	= array(
"name"	=> "�����ظ�",
"img"	=> "skill_062x.png",
"exp"	=> "HP�����ظ�+5%",
"sp"	=> "150",
"type"	=> "1",
"learn"	=> "8",
"target"=> array("friend","all",1),
"support"	=> "1",
"charge"	=> array(10,50),
"HpRegen"	=> 5,
); break;
		case "3401":
$skill	= array(
"name"	=> "ħ�������ظ�",
"img"	=> "skill_062x.png",
"exp"	=> "SP�����ظ�+5%",
"sp"	=> "150",
"type"	=> "1",
"learn"	=> "8",
"target"=> array("friend","all",1),
"support"	=> "1",
"charge"	=> array(10,50),
"SpRegen"	=> 5,
); break;
		case "3402":
$skill	= array(
"name"	=> "��������",
"img"	=> "skill_062x.png",
"exp"	=> "HP�����ظ�+10%",
"sp"	=> "300",
"type"	=> "1",
"learn"	=> "12",
"target"=> array("friend","all",1),
"support"	=> "1",
"charge"	=> array(20,100),
"HpRegen"	=> 10,
); break;
		case "3403":
$skill	= array(
"name"	=> "ħ����������",
"img"	=> "skill_062x.png",
"exp"	=> "SP�����ظ�+10%",
"sp"	=> "300",
"type"	=> "1",
"learn"	=> "12",
"target"=> array("friend","all",1),
"support"	=> "1",
"charge"	=> array(20,100),
"SpRegen"	=> 10,
); break;
		case "3404":
$skill	= array(
"name"	=> "˫�س�������",
"img"	=> "skill_062x.png",
"exp"	=> "HP,SP�����ظ�+10%",
"sp"	=> "450",
"type"	=> "1",
"learn"	=> "18",
"target"=> array("friend","all",1),
"support"	=> "1",
"charge"	=> array(30,150),
"HpRegen"	=> 10,
"SpRegen"	=> 10,
); break;
//----------------------------------------- 3410 ħ������褯ϵ
		case "3410":
$skill	= array(
"name"	=> "ħ����",
"img"	=> "ms_01.png",
"exp"	=> "ħ����+1",
"sp"	=> "100",
"type"	=> "1",
"learn"	=> "4",
"target"=> array("self","individual",1),
"charge"	=> array(0,0),
"MagicCircleAdd"	=> 1,
); break;
		case "3411":
$skill	= array(
"name"	=> "˫��ħ����",
"img"	=> "ms_01.png",
"exp"	=> "ħ����+2",
"sp"	=> "300",
"type"	=> "1",
"learn"	=> "6",
"target"=> array("self","individual",1),
"charge"	=> array(60,0),
"MagicCircleAdd"	=> 2,
); break;
		case "3412":
$skill	= array(
"name"	=> "����ħ����",
"img"	=> "ms_01.png",
"exp"	=> "ħ����+3",
"sp"	=> "500",
"type"	=> "1",
"learn"	=> "8",
"target"=> array("self","individual",1),
"charge"	=> array(80,0),
"MagicCircleAdd"	=> 3,
); break;
		case "3415":
$skill	= array(
"name"	=> "ħ����",
"img"	=> "ms_01.png",
"exp"	=> "ħ����+1",
"sp"	=> "200",
"type"	=> "1",
"learn"	=> "4",
"target"=> array("self","individual",1),
"charge"	=> array(30,0),
"MagicCircleAdd"	=> 1,
); break;
		case "3416":
$skill	= array(
"name"	=> "˫��ħ����",
"img"	=> "ms_01.png",
"exp"	=> "ħ����+2",
"sp"	=> "500",
"type"	=> "1",
"learn"	=> "8",
"target"=> array("self","individual",1),
"charge"	=> array(80,50),
"MagicCircleAdd"	=> 2,
); break;
//----------------------------------------- 3420 ħ���������ϵ
		case "3420":
$skill	= array(
"name"	=> "ħ��������",
"img"	=> "ms_02.png",
"exp"	=> "����ħ����-1",
"sp"	=> "150",
"type"	=> "1",
"learn"	=> "4",
"target"=> array("self","individual",1),
"charge"	=> array(30,0),
"MagicCircleDeleteEnemy"	=> 1,
); break;
		case "3421"://���M��
$skill	= array(
"name"	=> "ħ��������",
"img"	=> "ms_02.png",
"exp"	=> "����ħ����-1",
"sp"	=> "240",
"type"	=> "1",
"learn"	=> "4",
"target"=> array("self","individual",1),
"charge"	=> array(40,0),
"MagicCircleDeleteEnemy"	=> 1,
); break;
		case "3422"://���M��
$skill	= array(
"name"	=> "ħ�������",
"img"	=> "ms_02.png",
"exp"	=> "����ħ����-5",
"sp"	=> "400",
"type"	=> "1",
"learn"	=> "12",
"target"=> array("self","individual",1),
"charge"	=> array(40,0),
"MagicCircleDeleteEnemy"	=> 5,
); break;
		case "3423":
$skill	= array(
"name"	=> "ħ����Ĩ��",
"img"	=> "ms_02.png",
"exp"	=> "����ħ����-2",
"sp"	=> "200",
"type"	=> "1",
"learn"	=> "8",
"target"=> array("self","individual",1),
"charge"	=> array(40,0),
"MagicCircleDeleteEnemy"	=> 2,
); break;
//----------------------------------------- 3900 �ƥ��Ȥ˱����ʼ�
		case "3900":
$skill	= array(
"name"	=> "�ж�",
"img"	=> "acce_003c.png",
"exp"	=> "�Լ�����",
"sp"	=> "20",
"type"	=> "0",
"learn"	=> "0",
"target"=> array("self","individual",1),
); break;
		case "3901":
$skill	= array(
"name"	=> "����",
"img"	=> "acce_003c.png",
"exp"	=> "����",
"sp"	=> "20",
"type"	=> "0",
"learn"	=> "0",
"target"=> array("self","individual",1),
); break;
//////////////////////////////////////////////////
		case "4000":
$skill	= array(
"name"	=> "��ԭ",
"img"	=> "inst_002.png",
"exp"	=> "��������",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "5",
"target"=> array("friend","all",1),
"support"	=> "1",
); break;
/*----------------------------------------------*
*   5000 - 5999 EnemySkills                     *
*-----------------------------------------------*/
		case "4999":
$skill	= array(
"name"	=> "---- 5000 ----------",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "20",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","all",1),
); break;
		case "5000":
$skill	= array(
"name"	=> "�ز�",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "20",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"pow"	=> "70",
"charge"=> array(0,20),
); break;
		case "5001":
$skill	= array(
"name"	=> "������",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","individual",1),
"invalid"	=> "1",
"pow"	=> "50",
"charge"=> array(0,0),
"delay"	=> "20",
); break;
		case "5002":
$skill	= array(
"name"	=> "��Ѫ",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","individual",1),
"pow"	=> "100",
"invalid"	=> "1",
"charge"=> array(0,0),
); break;
		case "5003":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","individual",1),
"pow"	=> "200",
"charge"=> array(0,0),
"poison"=> "100",
); break;
		case "5004":
$skill	= array(
"name"	=> "�Ͷ�",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","individual",1),
"pow"	=> "200",
"invalid"	=> "1",
"charge"=> array(0,0),
"poison"=> "100",
); break;
		case "5005":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "10",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("self","individual",1),
"support"	=> "1",
"charge"=> array(0,0),
"UpDEF"	=> "10",
"UpMDEF"=> "10",
); break;
		case "5006":
$skill	= array(
"name"	=> "ͻ��!!!",
"img"	=> "skill_066.png",
"exp"	=> "ͻ������",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("friend","all",1),
"support"	=> "1",
"charge"=> array(0,50),
"UpSTR"	=> "50",
); break;
		case "5007":
$skill	= array(
"name"	=> "����",// ������ �� ����
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "5",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("friend","individual",1),
"pow"	=> "200",
"support"	=> "1",
"priority"	=> "LowHpRate",
"charge"=> array(0,0),
); break;
		case "5008":
$skill	= array(
"name"	=> "��ҧ",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","individual",1),
"pow"	=> "130",
); break;
		case "5009":
$skill	= array(
"name"	=> "צ��",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","individual",1),
"pow"	=> "200",
); break;
		case "5010":
$skill	= array(
"name"	=> "ҧ",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","individual",1),
"pow"	=> "90",
"pierce"=> true,
); break;
		case "5011":
$skill	= array(
"name"	=> "��ˤ",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","individual",1),
"pow"	=> "200",
"knockback"	=> "100",
); break;
		case "5012":
$skill	= array(
"name"	=> "��ʯ",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","individual",1),
"pow"	=> "120",
"invalid"	=> "1",
); break;
		case "5013":
$skill	= array(
"name"	=> "��Ϯ",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "50",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"pow"	=> "180",
"invalid"	=> "1",
); break;
		case "5014":
$skill	= array(
"name"	=> "����צ��",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","multi",3),
"pow"	=> "70",
"pierce"=> true,
); break;
		case "5015":
$skill	= array(
"name"	=> "ѩ��",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "50",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"pow"	=> "100",
"invalid"	=> "1",
"DownSPD"	=> "10",
); break;
		case "5016":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "20",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("friend","all",1),
"charge"	=> array(20,0),
"support"	=> "1",
"UpSPD"	=> "20",
); break;
		case "5017":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("friend","all",1),
"charge"	=> array(0,30),
"support"	=> "1",
"UpSTR"	=> "30",
"UpINT"	=> "30",
"UpDEX"	=> "30",
"UpSPD"	=> "30",
); break;
		case "5018":
$skill	= array(
"name"	=> "��֮��Ϣ",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"pow"	=> "120",
"invalid"	=> "1",
); break;
		case "5019":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","individual",1),
"pow"	=> "300",
); break;
		case "5020":
$skill	= array(
"name"	=> "��ŭ����",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "300",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"pow"	=> "300",
); break;
		case "5021":
$skill	= array(
"name"	=> "ˮ��",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "300",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"pow"	=> "200",
"knockback"	=> "100",
); break;
		case "5022":
$skill	= array(
"name"	=> "����Ů��",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "200",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("friend","all",1),
"support"	=> "1",
"pow"	=> "200",
"UpSTR"	=> "20",
"UpINT"	=> "20",
"UpDEX"	=> "20",
"UpSPD"	=> "20",
"UpDEF"	=> "20",
"UpMDEF"	=> "20",
); break;
		case "5023":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "500",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"DownMAXHP"	=> "70",
"invalid"	=> "1",
); break;
		case "5024":
$skill	= array(
"name"	=> "�ͷ���",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "500",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"pow"	=> "500",
); break;
		case "5025":
$skill	= array(
"name"	=> "ʥ��籩",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "100",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"pow"	=> "150",
"invalid"	=> "1",
); break;
		case "5026":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "50",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","individual",1),
"pow"	=> "250",
); break;
		case "5027":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "50",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"pow"	=> "150",
"DownSPD"	=> "10",
); break;
		case "5028":
$skill	= array(
"name"	=> "��֮��",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "50",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","multi",3),
"pow"	=> "150",
"invalid"	=> "1",
); break;
		case "5029":
$skill	= array(
"name"	=> "����֮��",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "50",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","individual",1),
"pow"	=> "600",
"invalid"	=> "1",
); break;
		case "5030":
$skill	= array(
"name"	=> "��긴��",
"img"	=> "skill_008.png",
"exp"	=> "����",
"sp"	=> "400",
"type"	=> "1",
"learn"	=> "10",
"target"=> array("friend","multi",2),
"support"	=> "1",
"charge"	=> array(0,0),
"pow"		=> "400",
"priority"	=> "Dead",
); break;
		case "5031":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_066.png",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","individual",1),
"charge"	=> array(0,30),
"pow"		=> "220",
); break;
		case "5032":
$skill	= array(
"name"	=> "���湥��",
"img"	=> "skill_066.png",
"sp"	=> "50",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"invalid"	=> true,
"charge"	=> array(0,50),
"pow"	=> "80",
"delay"	=> "50",
); break;
		case "5033":
$skill	= array(
"name"	=> "��������",
"img"	=> "skill_066.png",
"sp"	=> "50",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("friend","all",1),
"support"=> true,
"charge"	=> array(50,50),
"UpATK"	=> "50",
); break;
		case "5034":
$skill	= array(
"name"	=> "ʯ����ٻ�",
"img"	=> "skill_066.png",
"sp"	=> "50",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("self","individual",1),
"charge"	=> array(0,100),
"summon"	=> array(1026),
); break;
		case "5035":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_066.png",
"sp"	=> "0",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"invalid"	=> true,
"charge"	=> array(50,0),
"pow"	=> "80",
); break;
		case "5036":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_066.png",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"invalid"	=> true,
"delay"	=> "30",
); break;
		case "5037":
$skill	= array(
"name"	=> "������",
"img"	=> "skill_066.png",
"sp"	=> "0",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","individual",1),
"invalid"	=> true,
"pow"	=> "200",
"DownSTR"	=> "20",
"DownDEF"	=> "20",
); break;
		case "5038":
$skill	= array(
"name"	=> "��֮��Ϣ",
"img"	=> "skill_066.png",
"sp"	=> "200",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"invalid"	=> true,
"pow"	=> "150",
"DownINT"	=> "20",
"charge"	=> array(0,50),
); break;
		case "5039":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_066.png",
"sp"	=> "100",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"invalid"	=> true,
"poison"	=> "100",
); break;
		case "5040":
$skill	= array(
"name"	=> "�ڰ�ʥ��",
"img"	=> "skill_066.png",
"sp"	=> "300",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","multi",6),
"invalid"	=> true,
"pow"	=> "150",
"charge"	=> array(70,0),
); break;
		case "5041":
$skill	= array(
"name"	=> "�ڰ�����",
"img"	=> "skill_066.png",
"sp"	=> "300",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"invalid"	=> true,
"charge"	=> array(60,30),
"DownMDEF"	=> "60",
); break;
		case "5042":
$skill	= array(
"name"	=> "ѩ��",
"img"	=> "skill_066.png",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","multi",2),
"invalid"	=> true,
"pow"	=> "70",
); break;
		case "5043":
$skill	= array(
"name"	=> "��ѩ��",
"img"	=> "skill_066.png",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","multi",4),
"invalid"	=> true,
"pow"	=> "50",
); break;
		case "5044":
$skill	= array(
"name"	=> "��ѩ",
"img"	=> "skill_066.png",
"sp"	=> "150",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"pow"	=> "150",
"DownSPD"=> "15",
); break;
		case "5045":
$skill	= array(
"name"	=> "��֮��Ϣ",
"img"	=> "skill_066.png",
"sp"	=> "40",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"pow"	=> "140",
"DownDEF"=> "10",
); break;
		case "5046":
$skill	= array(
"name"	=> "��װ��",
"img"	=> "skill_066.png",
"sp"	=> "100",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("friend","all",1),
"support"	=> true,
"UpDEF"	=> "10",
"UpMDEF"=> "10",
"charge"=> array(10,10),
); break;
		case "5047":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_066.png",
"sp"	=> "30",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","multi",3),
"pow"	=> "100",
"DownDEF"	=> "10",
"charge"=> array(30,0),
); break;
		case "5048":
$skill	= array(
"name"	=> "��������",
"img"	=> "skill_066.png",
"sp"	=> "120",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"DownSTR"	=> "20",
"charge"=> array(10,20),
); break;
		case "5049":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_066.png",
"sp"	=> "40",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("friend","all",1),
"UpSTR"	=> "40",
"UpINT"	=> "40",
"charge"=> array(40,40),
); break;
		case "5050":
$skill	= array(
"name"	=> "���ػ�",
"img"	=> "skill_066.png",
"sp"	=> "100",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","multi",2),
"pow"	=> "200",
"DownDEF"	=> "20",
"charge"	=> array(20,20),
); break;
		case "5051":
$skill	= array(
"name"	=> "ѩ��",
"img"	=> "skill_066.png",
"sp"	=> "50",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"charge"	=> array(50,0),
"delay"	=> "50",
); break;
		case "5052":
$skill	= array(
"name"	=> "����ը��",
"img"	=> "skill_066.png",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","individual",1),
"DownMAXHP"	=> "50",
"invalid"	=> true,
); break;
		case "5053":
$skill	= array(
"name"	=> "��ǽ",
"img"	=> "skill_066.png",
"sp"	=> "300",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("friend","all",1),
"charge"	=> array(20,60),
"UpDEF"	=> "20",
"UpMDEF"	=> "60",
); break;
		case "5054":
$skill	= array(
"name"	=> "�������",
"img"	=> "skill_066.png",
"sp"	=> "200",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("all","all",1),
"charge"=> array(30,0),
"pow"	=> "250",
); break;
		case "5055":
$skill	= array(
"name"	=> "�������",
"img"	=> "skill_066.png",
"sp"	=> "0",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("self","individual",1),
"charge"=> array(40,10),
"pow"	=> "400",
"DownDEF"	=> "10",
); break;
		case "5056":
$skill	= array(
"name"	=> "ҧ",
"img"	=> "skill_066.png",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","individual",1),
"charge"=> array(0,0),
"pow"	=> "340",
); break;
		case "5057":
$skill	= array(
"name"	=> "צ��",
"img"	=> "skill_066.png",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","individual",2),
"charge"=> array(0,0),
"pow"	=> "100",
"pierce"	=> true,
"charge"	=> array(0,70),
); break;
		case "5058":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_066.png",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"charge"=> array(0,30),
"DownSTR"	=> "30",
); break;
		case "5059":
$skill	= array(
"name"	=> "�Ӷ�",
"img"	=> "skill_066.png",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","individual",1),
"charge"=> array(40,40),
"DownDEF"=> 40,
"DownATK"=> 40,
); break;
		case "5060":
$skill	= array(
"name"	=> "��ȡװ��",
"img"	=> "skill_066.png",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","individual",1),
"charge"=> array(0,30),
"DownDEF"=> 30,
//"DownATK"=> 40,
); break;
		case "5061":
$skill	= array(
"name"	=> "ǿ���Ӷ�",
"img"	=> "skill_066.png",
"sp"	=> "150",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"charge"=> array(10,50),
"DownATK"=> 50,
"DownMATK"=> 50,
); break;
		case "5062":
$skill	= array(
"name"	=> "ذ�ױ�ͽ",
"img"	=> "we_sword001z.png",
"sp"	=> "130",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","multi",8),
"pow"	=> "100",
"charge"=> array(0,70),
"invalid"	=> "1",
); break;
		case "5063":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_008.png",
"exp"	=> "����",
"sp"	=> "50",
"type"	=> "1",
"learn"	=> "10",
"target"=> array("friend","individual",1),
"support"	=> "1",
"charge"	=> array(0,0),
"pow"		=> "10",
"priority"	=> "Dead",
); break;
		case "5064":
$skill	= array(
"name"	=> "�㽶���",
"img"	=> "banana.png",
"exp"	=> "",
"sp"	=> "50",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","individual",1),
"charge"	=> array(0,30),
"pow"		=> "300",
); break;
		case "5065":
$skill	= array(
"name"	=> "�㽶���",
"img"	=> "banana.png",
"exp"	=> "",
"sp"	=> "50",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","multi",3),
"invalid"	=> true,
"charge"	=> array(0,0),
"pow"		=> "70",
); break;
		case "5066":
$skill	= array(
"name"	=> "�㽶�ظ�",
"img"	=> "banana.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "1",
"learn"	=> "10",
"target"=> array("self","individual",1),
"support"	=> "1",
"charge"	=> array(0,0),
"pow"		=> "250",
"CurePoison"	=> true,
"SpRecoveryRate"	=> 4,
"support"	=> "1",
); break;
		case "5067":
$skill	= array(
"name"	=> "�㽶����",
"img"	=> "banana.png",
"exp"	=> "",
"sp"	=> "50",
"type"	=> "1",
"learn"	=> "10",
"target"=> array("friend","all",1),
"charge"	=> array(0,0),
"support"	=> "1",
); break;
		case "5068":
$skill	= array(
"name"	=> "�ٻ�ū��",
"img"	=> "banana.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("self","individual",1),
"charge"=> array(0,50),
"summon"	=> array(1100),
); break;
		case "5069":
$skill	= array(
"name"	=> "�ٻ�ū��",
"img"	=> "banana.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("self","individual",1),
"charge"=> array(0,50),
"summon"	=> array(1101),
); break;
		case "5070":
$skill	= array(
"name"	=> "�ٻ�������",
"img"	=> "skill_029.png",
"exp"	=> "�ϳ����ٻ�",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "20",
"target"=> array("self","individual",1),
"charge"=> array(0,0),
"summon"	=> "5013",
); break;
		case "5071":
$skill	= array(
"name"	=> "�ٻ�ѩ��",
"img"	=> "skill_029.png",
"exp"	=> "�ϳ����ٻ�",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "20",
"target"=> array("self","individual",1),
"charge"=> array(0,0),
"summon"	=> "5014",
); break;
		case "5072":
$skill	= array(
"name"	=> "�ٻ�Ұ��",
"img"	=> "skill_029.png",
"exp"	=> "�ϳ����ٻ�",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "20",
"target"=> array("self","individual",1),
"charge"=> array(0,0),
"summon"	=> "5014",
); break;
		case "5073":
$skill	= array(
"name"	=> "�ٻ�ʨ��",
"img"	=> "skill_029.png",
"exp"	=> "�ϳ����ٻ�",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "20",
"target"=> array("self","individual",1),
"charge"=> array(0,0),
"summon"	=> "5011",
); break;
		case "5080":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_057.png",
"exp"	=> "",
"sp"	=> "50",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","individual",1),
"delay"	=> 50,
"charge"=> array(50,50),
"pow"	=> "500",
"pierce"=> true,
); break;
		case "5081":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_057.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("self","individual",1),
"support"	=> "1",
"charge"	=> array(0,0),
"pow"		=> "300",
"CurePoison"	=> true,
"SpRecoveryRate"	=> 9,
"UpATK"	=> "30",
"UpSTR"	=> "30",
"UpDEF"	=> "30",
"UpMDEF"=> "30",
"UpSPD"	=> "30",
); break;
		case "5082":
$skill	= array(
"name"	=> "�ʹ�����",
"img"	=> "skill_057.png",
"exp"	=> "",
"sp"	=> "250",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"charge"=> array(10,50),
"pow"	=> "350",
); break;
		case "5083":
$skill	= array(
"name"	=> "��ɽ�ʼ���",
"img"	=> "skill_057.png",
"exp"	=> "",
"sp"	=> "80",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","multi",16),
"charge"=> array(20,40),
"pow"	=> "320",
"invalid"	=> "1",
); break;
		case "5084":
$skill	= array(
"name"	=> "��������",
"img"	=> "skill_057.png",
"exp"	=> "",
"sp"	=> "60",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","multi",6),
"charge"=> array(30,60),
"pow"	=> "360",
"invalid"	=> "1",
); break;
		case "5085":
$skill	= array(
"name"	=> "ˮ������",
"img"	=> "skill_057.png",
"exp"	=> "",
"sp"	=> "180",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("friend","all",1),
"support"	=> "1",
"pow"	=> "180",
"charge"	=> array(10,80),
); break;
		case "5086":
$skill	= array(
"name"	=> "�羫�Ľǵ�",
"img"	=> "skill_016z.png",
"exp"	=> "",
"sp"	=> "100",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("friend","all",1),
"charge"	=> array(100,100),
"UpSPD"	=> "100",
); break;
		case "5087":
$skill	= array(
"name"	=> "�����ʯ��",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "30",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","multi",3),
"delay"	=> 30,
"charge"=> array(30,0),
"pow"	=> "300",
"invalid"	=> "1",
"DownSPD"	=> "30",
"pierce"=> true,
); break;
		case "5088":
$skill	= array(
"name"	=> "����ƣ��",
"img"	=> "skill_057.png",
"exp"	=> "",
"sp"	=> "60",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","individual",1),
"delay"	=> 60,
"charge"=> array(60,0),
"pow"	=> "600",
"DownDEF"	=> "60",
"DownMDEF"	=> "60",
); break;
		case "5089":
$skill	= array(
"name"	=> "�ʼ�ʥ��",
"img"	=> "skill_057.png",
"exp"	=> "",
"sp"	=> "600",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"charge"=> array(50,0),
"pow"	=> "500",
); break;
		case "5090":
$skill	= array(
"name"	=> "���ŵ�Сҹ��",
"img"	=> "skill_037.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"pow"	=> "100",
"invalid"	=> "1",
"charge"=> array(0,100),
); break;
		case "5091":
$skill	= array(
"name"	=> "The World!",
"img"	=> "we_other007y.png",
"exp"	=> "",
"sp"	=> "320",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("all","all",1),
"delay"	=> 320,
"invalid"	=> "1",
"charge"=> array(160,160),
); break;
		case "5092":
$skill	= array(
"name"	=> "ɱ��ľż",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "60",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"charge"=> array(10,60),
"pow"	=> "160",
"pierce"=> true,
); break;
		case "5093":
$skill	= array(
"name"	=> "��д���",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "60",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","multi",6),
"charge"=> array(10,60),
"pow"	=> "160",
"pierce"=> true,
); break;
		case "5094":
$skill	= array(
"name"	=> "ҹ���еĻ�Ӱɱ�˹�",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "160",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","multi",16),
"charge"=> array(0,160),
"pow"	=> "160",
"invalid"	=> "1",
); break;
		case "5095":
$skill	= array(
"name"	=> "����Ů��",
"img"	=> "banana.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("self","individual",1),
"support"	=> "1",
"charge"	=> array(0,0),
"pow"		=> "160",
"CurePoison"	=> true,
"SpRecoveryRate"	=> 8,
"UpATK"	=> "16",
"UpMATK"=> "16",
"UpSTR"	=> "16",
"UpDEF"	=> "16",
"UpMDEF"=> "16",
"UpSPD"	=> "16",
"UpINT"	=> "16",
); break;
		case "5096":
$skill	= array(
"name"	=> "�Ը����֮ǹ",
"img"	=> "skill_057.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","individual",1),
"charge"=> array(0,80),
"pow"	=> "800",
"invalid"	=> "1",
); break;
		case "5097":
$skill	= array(
"name"	=> "糺�ɫ�Ķ�ħ",
"img"	=> "skill_078.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","multi",14),
"delay"	=> 40,
"pow"	=> "400",
"charge"=> array(10,40),
"invalid"	=> "1",
"pierce"=> true,
); break;
		case "5098":
$skill	= array(
"name"	=> "��ɫ��ҹ��",
"img"	=> "skill_057.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"charge"=> array(0,30),
"pow"	=> "300",
"invalid"	=> "1",
); break;
		case "5099":
$skill	= array(
"name"	=> "��ҹ֮Ů��",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("self","individual",1),
"charge"=> array(0,0),
"UpMAXHP"=> 200,
"UpATK"=> 100,
"UpMATK"=> 100,
"UpSTR"=> 100,
"UpINT"=> 100,
"UpSPD"=> 100,
"UpDEF"=> 100,
"UpMDEF"=> 100,
); break;
		case "5100":
$skill	= array(
"name"	=> "����֮ʯ",
"img"	=> "skill_057.png",
"exp"	=> "",
"sp"	=> "100",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("self","individual",1),
"charge"	=> array(10,0),
"UpMATK"=> "100",
"UpDEF"	=> "100",
"UpMDEF"=> "100",
"UpSPD"	=> "100",
"UpINT"	=> "100",
); break;
		case "5101":
$skill	= array(
"name"	=> "���ؽ��",
"img"	=> "skill_057.png",
"exp"	=> "",
"sp"	=> "40",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"charge"=> array(40,0),
"pow"	=> "400",
"invalid"	=> "1",
); break;
		case "5102":
$skill	= array(
"name"	=> "�͹۽��",
"img"	=> "item_027.png",
"exp"	=> "",
"sp"	=> "180",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"invalid"	=> "1",
"DownDEF"	=> "18",
"DownMDEF"	=> "18",
"DownATK"	=> "18",
"DownMATK"	=> "18",
"DownSTR"	=> "18",
"DownINT"	=> "18",
"DownSPD"	=> "18",
"DownLUK"	=> "18",
); break;
		case "5103":
$skill	= array(
"name"	=> "������վ�³�֮��",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "200",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","multi",20),
"delay"	=> 20,
"charge"=> array(200,200),
"pow"	=> "200",
"invalid"	=> "1",
"pierce"=> true,
); break;
		case "5104":
$skill	= array(
"name"	=> "�������",
"img"	=> "skill_037.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"pow"	=> "180",
"invalid"	=> "1",
"charge"=> array(0,180),
); break;
		case "5105":
$skill	= array(
"name"	=> "ʬ����Զ",
"img"	=> "item_027.png",
"exp"	=> "",
"sp"	=> "20",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","individual",1),
"delay"	=> 20,
"pow"	=> "200",
"charge"=> array(20,0),
"pierce"=> true,
"UpATK"	=> "20",
"UpSTR"	=> "20",
); break;
		case "5106":
$skill	= array(
"name"	=> "���Ŷݼ�",
"img"	=> "item_027.png",
"exp"	=> "",
"sp"	=> "40",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("self","individual",1),
"charge"=> array(40,40),
"UpDEF"	=> "40",
"UpMDEF"=> "40",
); break;
		case "5107":
$skill	= array(
"name"	=> "��������",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "200",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"charge"=> array(20,0),
"pow"	=> "200",
"DownSPD"	=> "20",
); break;
		case "5108":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "20",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","multi",4),
"charge"=> array(20,40),
"pow"	=> "240",
"umove"	=> "front",
"invalid"	=> "1",
"pierce"=> true,
); break;
		case "5109":
$skill	= array(
"name"	=> "������������",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "100",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","multi",8),
"charge"=> array(10,80),
"pow"	=> "180",
"invalid"	=> "1",
); break;
		case "5110":
$skill	= array(
"name"	=> "ǰ������ػ�",
"img"	=> "skill_062x.png",
"exp"	=> "",
"sp"	=> "80",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("friend","all",1),
"support"	=> "1",
"charge"	=> array(0,80),
"HpRegen"	=> 8,
); break;
		case "5111":
$skill	= array(
"name"	=> "ƾ��ݱ������",
"img"	=> "skill_013c.png",
"exp"	=> "",
"sp"	=> "80",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("friend","all",1),
"pow"	=> "800",
"support"	=> "1",
"priority"	=> "LowHpRate",
"charge"=> array(80,0),
); break;
		case "5112":
$skill	= array(
"name"	=> "�ұڷ���",
"img"	=> "skill_066.png",
"sp"	=> "100",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("friend","all",1),
"charge"	=> array(10,10),
"UpDEF"	=> "100",
"UpMDEF"	=> "100",
); break;
		case "5113":
$skill	= array(
"name"	=> "��ʯ���",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "300",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","multi",12),
"charge"=> array(30,30),
"pow"	=> "300",
"invalid"	=> "1",
); break;
		case "5114":
$skill	= array(
"name"	=> "������װ",
"img"	=> "skill_066.png",
"sp"	=> "100",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("friend","all",1),
"charge"	=> array(10,10),
"UpATK"	=> "100",
"UpMATK"	=> "100",
); break;
		case "5115":
$skill	= array(
"name"	=> "�����",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "350",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"charge"=> array(30,50),
"pow"	=> "350",
"delay"	=> 30,
"invalid"	=> "1",
"DownDEF"	=> "30",
"DownMDEF"=> "30",
"pierce"=> true,
); break;
		case "5116":
$skill	= array(
"name"	=> "���ᾧ",
"img"	=> "skill_057.png",
"exp"	=> "",
"sp"	=> "100",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("self","individual",1),
"charge"	=> array(0,0),
"UpATK"	=> "100",
"UpMATK"	=> "100",
"UpSPD"	=> "100",
); break;
		case "5117":
$skill	= array(
"name"	=> "�췣",
"img"	=> "skill_057.png",
"exp"	=> "",
"sp"	=> "600",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","individual",1),
"delay"	=> 60,
"charge"=> array(60,60),
"pow"	=> "600",
"pierce"=> true,
); break;
		case "5118":
$skill	= array(
"name"	=> "��Ǵ쫷�",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "500",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","multi",10),
"charge"=> array(50,100),
"pow"	=> "500",
"invalid"	=> "1",
); break;
		case "5119":
$skill	= array(
"name"	=> "Master spark",
"img"	=> "skill_057.png",
"exp"	=> "",
"sp"	=> "300",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","individual",1),
"charge"=> array(0,120),
"pow"	=> "900",
"invalid"	=> "1",
); break;
		case "5120":
$skill	= array(
"name"	=> "Final spark",
"img"	=> "skill_057.png",
"exp"	=> "",
"sp"	=> "400",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"charge"=> array(20,120),
"pow"	=> "800",
"invalid"	=> "1",
); break;
		case "5121":
$skill	= array(
"name"	=> "��ɱ",
"img"	=> "skill_041z.png",
"exp"	=> "����",
"sp"	=> "100",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"invalid"	=> "1",
"charge"=> array(100,0),
); break;
		case "5122":
$skill	= array(
"name"	=> "����֮��",
"img"	=> "skill_041z.png",
"exp"	=> "����",
"sp"	=> "100",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","individual",1),
"invalid"	=> "1",
"charge"=> array(10,0),
); break;
		case "5123":
$skill	= array(
"name"	=> "������Ļ�Ȫ��",
"img"	=> "skill_008.png",
"exp"	=> "����",
"sp"	=> "400",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("friend","multi",2),
"support"	=> "1",
"charge"	=> array(0,0),
"pow"		=> "1000",
"priority"	=> "Dead",
); break;
		case "5124":
$skill	= array(
"name"	=> "������֮��",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "400",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","multi",40),
"charge"=> array(40,0),
"pow"	=> "400",
"invalid"	=> "1",
); break;
		case "5125":
$skill	= array(
"name"	=> "δ������ն",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "330",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","multi",11),
"charge"=> array(20,20),
"pow"	=> "440",
"invalid"	=> "1",
); break;
		case "5126":
$skill	= array(
"name"	=> "����ն",
"img"	=> "skill_057.png",
"exp"	=> "",
"sp"	=> "140",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","individual",1),
"charge"=> array(10,40),
"pow"	=> "1400",
"invalid"	=> "1",
); break;
		case "5127":
$skill	= array(
"name"	=> "�����徻ն",
"img"	=> "skill_057.png",
"exp"	=> "",
"sp"	=> "150",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"charge"=> array(50,0),
"pow"	=> "250",
"pierce"=> true,
); break;
		case "5128":
$skill	= array(
"name"	=> "����ҫ��",
"img"	=> "skill_057.png",
"exp"	=> "",
"sp"	=> "200",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","individual",1),
"charge"=> array(10,0),
"pow"	=> "400",
"pierce"=> true,
); break;
		case "5129":
$skill	= array(
"name"	=> "����������̫��",
"img"	=> "skill_057.png",
"exp"	=> "",
"sp"	=> "500",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"charge"=> array(50,0),
"pow"	=> "500",
"invalid"	=> "1",
); break;
		case "5130":
$skill	= array(
"name"	=> "�Զ��п����װ��",
"img"	=> "skill_062x.png",
"exp"	=> "HP,SP�����ظ�+10%",
"sp"	=> "100",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("self","individual",1),
"support"	=> "1",
"charge"	=> array(10,0),
"HpRegen"	=> 10,
"SpRegen"	=> 10,
"UpATK"	=> "100",
"UpMATK"	=> "100",
"UpSPD"	=> "100",
); break;
		case "5131":
$skill	= array(
"name"	=> "�����ӡ",
"img"	=> "skill_066.png",
"sp"	=> "500",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"DownMAXHP"	=> "50",
"DownMAXSP"	=> "50",
"invalid"	=> true,
); break;
		case "5132":
$skill	= array(
"name"	=> "��������",
"img"	=> "skill_057.png",
"exp"	=> "",
"sp"	=> "200",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("enemy","multi",2),
"charge"=> array(40,0),
"pow"	=> "400",
"pierce"=> true,
); break;
		case "5133":
$skill	= array(
"name"	=> "��ħ��",
"img"	=> "skill_037.png",
"exp"	=> "SP����",
"sp"	=> "0",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"pow"	=> "300",
"invalid"	=> "1",
"charge"=> array(0,0),
); break;
		case "5134":
$skill	= array(
"name"	=> "��������",
"img"	=> "skill_057.png",
"exp"	=> "",
"sp"	=> "100",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"charge"=> array(10,0),
"pow"	=> "1000",
"invalid"	=> "1",
); break;
		case "5135":
$skill	= array(
"name"	=> "��Ѫ����",
"img"	=> "skill_008.png",
"exp"	=> "����",
"sp"	=> "0",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("friend","multi",4),
"support"	=> "1",
"charge"	=> array(0,0),
"pow"		=> "800",
"priority"	=> "Dead",
); break;
		case "5136":
$skill	= array(
"name"	=> "��϶",
"img"	=> "skill_041z.png",
"exp"	=> "����",
"sp"	=> "0",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"invalid"	=> "1",
"charge"=> array(0,0),
); break;
		case "5799":
$skill	= array(
"name"	=> "----5799--------",
"img"	=> "skill_066.png",
"sp"	=> "0",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("enemy","all",1),
"pow"	=> "0",
); break;

						// ��������߀�Ǽ�
		case "5800":
$skill	= array(
"name"	=> "Ⱥ�ٻ�",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("self","individual",1),
"charge"=> array(0,0),
"summon"=> "1012",
); break;
		case "5801":
$skill	= array(
"name"	=> "�ٻ�ū��",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("self","individual",1),
"charge"=> array(0,0),
"summon"	=> array(1012,1012,1012,1012,1012),
); break;
		case "5802":
$skill	= array(
"name"	=> "���߸���",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "80",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("self","individual",1),
"charge"=> array(30,0),
"summon"	=> array(5003),
); break;
		case "5803":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("self","individual",1),
"charge"=> array(0,150),
); break;
		case "5804":
$skill	= array(
"name"	=> "�ٻ�ū��",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "200",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("self","individual",1),
"summon"	=> array(1034,1034),
); break;
		case "5805":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "40",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("self","individual",1),
"summon"	=> array(1038),
"charge"	=> array(0,30),
); break;
		case "5806":
$skill	= array(
"name"	=> "ѩ��¹",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("self","individual",1),
"summon"	=> array(1047),
); break;
		case "5807":
$skill	= array(
"name"	=> "�ٻ�����֮��",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("self","individual",1),
"summon"	=> array(1091),
); break;
		case "5808":
$skill	= array(
"name"	=> "�ȿ�",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("self","individual",1),
"summon"	=> array(5102),
); break;
		case "5809":
$skill	= array(
"name"	=> "�ٻ�",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("self","individual",1),
"summon"	=> array(1086),
); break;
		case "5810":
$skill	= array(
"name"	=> "�ȿ�",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("self","individual",1),
"summon"	=> array(5103),
); break;
		case "5811":
$skill	= array(
"name"	=> "�������",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("self","individual",1),
"summon"	=> array(1076),
); break;
		case "5812":
$skill	= array(
"name"	=> "�������",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("self","individual",1),
"summon"	=> array(5101),
); break;
		case "5813":
$skill	= array(
"name"	=> "��ʹ��",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("self","individual",1),
"summon"	=> array(5100),
); break;
		case "5814":
$skill	= array(
"name"	=> "�ٻ�ˮԪ��",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "200",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("self","individual",1),
"summon"	=> array(1060),
); break;
		case "5815":
$skill	= array(
"name"	=> "����",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("self","individual",1),
"summon"	=> array(1082),
); break;
		case "5816":
$skill	= array(
"name"	=> "��ǽ",
"img"	=> "skill_066.png",
"sp"	=> "300",
"type"	=> "1",
"learn"	=> "99",
"target"=> array("friend","all",1),
"charge"	=> array(60,30),
"UpDEF"	=> "60",
"UpMDEF"	=> "30",
); break;
		case "5817":
$skill	= array(
"name"	=> "������",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("self","individual",1),
"summon"	=> array(5105),
); break;
		case "5818":
$skill	= array(
"name"	=> "��",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("self","individual",1),
"summon"	=> array(5106),
); break;
		case "5819":
$skill	= array(
"name"	=> "Ѫ����",
"img"	=> "skill_066.png",
"exp"	=> "",
"sp"	=> "0",
"type"	=> "0",
"learn"	=> "99",
"target"=> array("self","individual",1),
"summon"	=> array(5110,5110,5110,5110,5110),
); break;

/*----------------------------------------------*
*   7000 - 7999 PassiveSkills                   *
*-----------------------------------------------*
	Passive �O���Ŀ
"passive"	=> 1,//�ѥå��֥�����Ǥ���Ȥ�������
"p_maxhp"	=> "30",//���HP+30
"p_maxsp"	=> "10",//���SP+10
"p_str"	=> "1",//���str+
"p_int"	=> "2",//���int+
"p_dex"	=> "3",//���dex+
"p_spd"	=> "4",//���spd+
"p_luk"	=> "5",//���luk+
*-----------------------------------------------*/
		case "7000":
$skill	= array(
"name"	=> "��������",
"img"	=> "acce_003c.png",
"exp"	=> "HP+30",
"learn"	=> "2",
"passive"	=> 1,
"p_maxhp"	=> "30",
); break;
		case "7001":
$skill	= array(
"name"	=> "��������",
"img"	=> "acce_003c.png",
"exp"	=> "HP+80",
"learn"	=> "9",
"passive"	=> 1,
"p_maxhp"	=> "80",
); break;
		case "7002":
$skill	= array(
"name"	=> "������Խ",
"img"	=> "acce_003c.png",
"exp"	=> "HP+200",
"learn"	=> "21",
"passive"	=> 1,
"P_MAXHP"	=> "200",
); break;
		case "7003":
$skill	= array(
"name"	=> "��������1",
"img"	=> "acce_003c.png",
"exp"	=> "HP+30",
"learn"	=> "4",
"passive"	=> 1,
"P_MAXHP"	=> "30",
); break;
		case "7004":
$skill	= array(
"name"	=> "��������2",
"img"	=> "acce_003c.png",
"exp"	=> "HP+70",
"learn"	=> "9",
"passive"	=> 1,
"P_MAXHP"	=> "70",
); break;
		case "7005":
$skill	= array(
"name"	=> "��������3",
"img"	=> "acce_003c.png",
"exp"	=> "HP+150",
"learn"	=> "21",
"passive"	=> 1,
"P_MAXHP"	=> "150",
); break;
							// HealBonus
		case "7005":
$skill	= array(
"name"	=> "��������3",
"img"	=> "acce_003c.png",
"exp"	=> "HP+150",
"learn"	=> "21",
"passive"	=> 1,
"P_MAXHP"	=> "150",
); break;
//----------------------------------------------//
// 9999                                         //
//----------------------------------------------//
		case "9000":
$skill	= array(
"name"	=> "* ����˼��",
"name2"	=> "* ����һ�£�����",
"exp"	=> "�����ж������� swto �Ļ�����and",
"img"	=> "skill_040.png",
"learn"	=> "4",
"type"	=> false,
"pow"	=> false,
); break;
//----------------------------------------------//
	}
	if(!$skill)
		return false;
	$skill	+= array("no"=>"$no");
	return $skill;
}
?>