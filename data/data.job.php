<?php 
/*
	ְҵ�Ա���
	ְҵ��ͼ��
	����װ����
	"coe"	=> array(HPϵ�� ,SPϵ��),
	"change"	=> array(����ת��ְ),
*/
function LoadJobData($no) {
	switch($no) {
		case "100":
$job	= array(
"name_male"		=> "սʿ",
"name_female"	=> "սʿ",
"img_male"		=> "mon_079.gif",
"img_female"	=> "mon_080r.gif",
"equip"			=> array("��","˫�ֽ�","��","��","�·�","����","����"),
"coe"			=> array(3, 0.5),
"change"		=> array(101,102,103),
); break;
		case "101":
$job	= array(
"name_male"		=> "�ʼ���ʿ",
"name_female"	=> "�ʼ���ʿ",
"img_male"		=> "mon_199r.gif",
"img_female"	=> "mon_234r.gif",
"equip"			=> array("��","˫�ֽ�","��","��","�·�","����","����"),
"coe"			=> array(4, 0.7),
"change"		=> array(111,112,113),
); break;
		case "111":
$job	= array(
"name_male"		=> "�ʼ�ʮ�־�",
"name_female"	=> "�ʼ�ʮ�־�",
"img_male"		=> "mon_111ma.gif",
"img_female"	=> "mon_111fe.gif",
"equip"			=> array("��","��","��","�·�","����","����"),
"coe"			=> array(6, 1),
); break;
		case "112":
$job	= array(
"name_male"		=> "�ʼ���ʿ",
"name_female"	=> "�ʼ���ʿ",
"img_male"		=> "mon_112ma.gif",
"img_female"	=> "mon_112fe.gif",
"equip"			=> array("��","˫�ֽ�","��","��","�·�","����","����"),
"coe"			=> array(5, 1.5),
); break;
		case "102":
$job	= array(
"name_male"		=> "��սʿ",
"name_female"	=> "��սʿ",
"img_male"		=> "mon_100r.gif",
"img_female"	=> "mon_012.gif",
"equip"			=> array("��","˫�ֽ�","��","�·�","����","����"),
"coe"			=> array(5.0, 0.2),
"change"		=> array(121,122,123),
); break;
		case "121":
$job	= array(
"name_male"		=> "��Ѫ��ħ",
"name_female"	=> "��Ѫ��ħ",
"img_male"		=> "mon_121ma.gif",
"img_female"	=> "mon_121fe.gif",
"equip"			=> array("��","˫�ֽ�","��","�·�","����","����"),
"coe"			=> array(7, 0.5),
); break;
		case "122":
$job	= array(
"name_male"		=> "��Ѫ��ʿ",
"name_female"	=> "��Ѫ��ʿ",
"img_male"		=> "mon_122ma.gif",
"img_female"	=> "mon_122fe.gif",
"equip"			=> array("��","˫�ֽ�","��","��","�·�","����","����"),
"coe"			=> array(6.5, 0.5),
); break;
		case "103":
$job	= array(
"name_male"		=> "ħŮ��",
"name_female"	=> "ħŮ��",
"img_male"		=> "mon_150.gif",
"img_female"	=> "mon_234.gif",
"equip"			=> array("��","ذ��","��","��","�·�","����","����"),
"coe"			=> array(3.7, 1),
"change"		=> array(131,132,133),
); break;
		case "131":
$job	= array(
"name_male"		=> "ħ��ʿ",
"name_female"	=> "ħ��ʿ",
"img_male"		=> "mon_131ma.gif",
"img_female"	=> "mon_131fe.gif",
"equip"			=> array("��","��","ذ��","��","�·�","����","����"),
"coe"			=> array(4, 2),
); break;
		case "132":
$job	= array(
"name_male"		=> "��������",
"name_female"	=> "��������",
"img_male"		=> "mon_132ma.gif",
"img_female"	=> "mon_132fe.gif",
"equip"			=> array("��","˫�ֽ�","ذ��","��","��","�·�","����","����"),
"coe"			=> array(4.5, 1.5),
); break;
		case "200":
$job	= array(
"name_male"		=> "��ʦ",
"name_female"	=> "��ʦ",
"img_male"		=> "mon_106.gif",
"img_female"	=> "mon_018.gif",
"equip"			=> array("ħ��","��","��","�·�","����","����"),
"coe"			=> array(1.5, 1),
"change"		=> array(201,202,203),
); break;
		case "201":
$job	= array(
"name_male"		=> "��ʿ",
"name_female"	=> "��ʿ",
"img_male"		=> "mon_196z.gif",
"img_female"	=> "mon_246r.gif",
"equip"			=> array("ħ��","��","��","�·�","����","����"),
"coe"			=> array(2.1, 2),
"change"		=> array(211,212,213),
); break;
		case "211":
$job	= array(
"name_male"		=> "��ħ��ʦ",
"name_female"	=> "��ħ��ʦ",
"img_male"		=> "mon_211ma.gif",
"img_female"	=> "mon_211fe.gif",
"equip"			=> array("ħ��","��","��","�·�","����","����"),
"coe"			=> array(2.5, 4),
); break;
		case "212":
$job	= array(
"name_male"		=> "����",
"name_female"	=> "����",
"img_male"		=> "mon_212ma.gif",
"img_female"	=> "mon_212fe.gif",
"equip"			=> array("ħ��","��","��","�·�","����","����"),
"coe"			=> array(3, 3),
); break;
		case "202":
$job	= array(
"name_male"		=> "�ٻ�ʦ",
"name_female"	=> "�ٻ�ʦ",
"img_male"		=> "mon_196y.gif",
"img_female"	=> "mon_246z.gif",
"equip"			=> array("ħ��","��","��","����","����"),
"coe"			=> array(1.5, 2.5),
"change"		=> array(221,222,223),
); break;
		case "221":
$job	= array(
"name_male"		=> "ħ���ٻ�ʦ",
"name_female"	=> "ħ���ٻ�ʦ",
"img_male"		=> "mon_221ma.gif",
"img_female"	=> "mon_221fe.gif",
"equip"			=> array("ħ��","��","��","�·�","����","����"),
"coe"			=> array(2, 4),
); break;
		case "222":
$job	= array(
"name_male"		=> "ħ��",
"name_female"	=> "ħ��",
"img_male"		=> "mon_222ma.gif",
"img_female"	=> "mon_222fe.gif",
"equip"			=> array("ħ��","��","�·�","����","����"),
"coe"			=> array(3, 3),
); break;
		case "203":
$job	= array(
"name_male"		=> "���鷨ʦ",
"name_female"	=> "���鷨ʦ",
"img_male"		=> "mon_196x.gif",
"img_female"	=> "mon_246y.gif",
"equip"			=> array("ħ��","��","��","�·�","����","����"),
"coe"			=> array(2.1, 1.5),
"change"		=> array(231,232,233),
); break;
		case "231":
$job	= array(
"name_male"		=> "����ʦ",
"name_female"	=> "����ʦ",
"img_male"		=> "mon_231ma.gif",
"img_female"	=> "mon_231fe.gif",
"equip"			=> array("ħ��","��","��","�·�","����","����"),
"coe"			=> array(3, 2.5),
); break;
		case "232":
$job	= array(
"name_male"		=> "а��",
"name_female"	=> "а��",
"img_male"		=> "mon_232ma.gif",
"img_female"	=> "mon_232fe.gif",
"equip"			=> array("ħ��","��","��","�·�","����","����"),
"coe"			=> array(3.5, 2),
); break;
		case "300":
$job	= array(
"name_male"		=> "��ʦ",
"name_female"	=> "Ů��˾",
"img_male"		=> "mon_213.gif",
"img_female"	=> "mon_214.gif",
"equip"			=> array("ħ��","��","�·�","����","����"),
"coe"			=> array(2, 0.8),
"change"		=> array(301,302),
); break;
		case "301":
$job	= array(
"name_male"		=> "����",
"name_female"	=> "����",
"img_male"		=> "mon_213r.gif",
"img_female"	=> "mon_214r.gif",
"equip"			=> array("ħ��","��","�·�","����","����"),
"coe"			=> array(2.7, 1.4),
"change"		=> array(311,312,313),
); break;
		case "311":
$job	= array(
"name_male"		=> "�̻�",
"name_female"	=> "�̻�",
"img_male"		=> "mon_311ma.gif",
"img_female"	=> "mon_311fe.gif",
"equip"			=> array("ħ��","��","�·�","����","����"),
"coe"			=> array(3.5, 2.5),
); break;
		case "312":
$job	= array(
"name_male"		=> "��ʹ",
"name_female"	=> "��ʹ",
"img_male"		=> "mon_312ma.gif",
"img_female"	=> "mon_312fe.gif",
"equip"			=> array("ħ��","��","�·�","����","����"),
"coe"			=> array(3, 3),
); break;
		case "302":
$job	= array(
"name_male"		=> " ��³��",
"name_female"	=> " ��³��",
"img_male"		=> "mon_213rz.gif",
"img_female"	=> "mon_214rz.gif",
"equip"			=> array("ħ��","��","�·�","����","����"),
"coe"			=> array(2.5, 1.2),
"change"		=> array(321,322,323),
); break;
		case "321":
$job	= array(
"name_male"		=> "��Ȼ�ػ���",
"name_female"	=> "��Ȼ�ػ���",
"img_male"		=> "mon_321ma.gif",
"img_female"	=> "mon_321fe.gif",
"equip"			=> array("ħ��","��","�·�","����","����"),
"coe"			=> array(4, 1.5),
); break;
		case "322":
$job	= array(
"name_male"		=> "���������",
"name_female"	=> "���������",
"img_male"		=> "mon_322ma.gif",
"img_female"	=> "mon_322fe.gif",
"equip"			=> array("ħ��","ذ��","��","�·�","����","����"),
"coe"			=> array(3, 2.5),
); break;
		case "400":
$job	= array(
"name_male"		=> " ����",
"name_female"	=> " ����",
"img_male"		=> "mon_219rr.gif",
"img_female"	=> "mon_219r.gif",
"equip"			=> array("��","�·�","����","����"),
"coe"			=> array(2.2, 0.7),
"change"		=> array(401,402,403),
); break;
		case "401":
$job	= array(
"name_male"		=> "������",
"name_female"	=> "������",
"img_male"		=> "mon_076z.gif",
"img_female"	=> "mon_042z.gif",
"equip"			=> array("��","�·�","����","����"),
"coe"			=> array(3.0, 0.8),
"change"		=> array(411,412),
); break;
		case "411":
$job	= array(
"name_male"		=> "�ѻ���",
"name_female"	=> "�ѻ���",
"img_male"		=> "mon_411ma.gif",
"img_female"	=> "mon_411fe.gif",
"equip"			=> array("��","�·�","����","����"),
"coe"			=> array(4.5, 1),
); break;
		case "412":
$job	= array(
"name_male"		=> "��ɱ��",
"name_female"	=> "��ɱ��",
"img_male"		=> "mon_412ma.gif",
"img_female"	=> "mon_412fe.gif",
"equip"			=> array("��","�·�","����","����"),
"coe"			=> array(4, 1.5),
); break;
		case "402":
$job	= array(
"name_male"		=> "ѱ��ʦ",
"name_female"	=> "ѱ��ʦ",
"img_male"		=> "mon_216z.gif",
"img_female"	=> "mon_217z.gif",
"equip"			=> array("��","��","�·�","����","����"),
"coe"			=> array(3.2, 1.0),
"change"		=> array(421,422),
); break;
		case "421":
$job	= array(
"name_male"		=> "����",
"name_female"	=> "����",
"img_male"		=> "mon_421ma.gif",
"img_female"	=> "mon_421fe.gif",
"equip"			=> array("��","�·�","����","����"),
"coe"			=> array(4, 2),
); break;
		case "422":
$job	= array(
"name_male"		=> "����",
"name_female"	=> "����",
"img_male"		=> "mon_422ma.gif",
"img_female"	=> "mon_422fe.gif",
"equip"			=> array("ذ��","��","�·�","����","����"),
"coe"			=> array(3.5, 1.5),
); break;
		case "403":
$job	= array(
"name_male"		=> "�̿�",
"name_female"	=> "�̿�",
"img_male"		=> "mon_216y.gif",
"img_female"	=> "mon_217rz.gif",
"equip"			=> array("ذ��","��","��","�·�","����"),
"coe"			=> array(3.6, 0.7),
"change"		=> array(431,432),
); break;
		case "431":
$job	= array(
"name_male"		=> "��ɱ��",
"name_female"	=> "��ɱ��",
"img_male"		=> "mon_431ma.gif",
"img_female"	=> "mon_431fe.gif",
"equip"			=> array("ذ��","��","�·�","����"),
"coe"			=> array(4, 1.5),
); break;
		case "432":
$job	= array(
"name_male"		=> "������",
"name_female"	=> "������",
"img_male"		=> "mon_432ma.gif",
"img_female"	=> "mon_432fe.gif",
"equip"			=> array("ذ��","��","�·�","����","����"),
"coe"			=> array(4.5, 1),
); break;
	}
	return $job;
}
?>