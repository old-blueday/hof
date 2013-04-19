<?php
function LoadSkillTree($char) {
/*
	���ÿ��ܤʼ��򷵤���
*/
	// ���Üg�ߥ����롣
	// array_search() �Ǥʤ� �ϥå����ʹ�äƚ����ж����롣
	// �ɤä��΄I���٤����ϡ�֪���
	$lnd	= array_flip($char->skill);
	$lnd[key($lnd)]++;//���Ф����^�΂���"0"�ʤΤ�1�ˤ���(issetʹ�鷺��true�ˤ��뤿��)
	$list	= array();//������
	//////////////////////////////////// ����
	if(	$char->job == 100
	 ||	$char->job == 101
	 ||	$char->job == 102
	 ||	$char->job == 103
	 ||	$char->job == 111
	 ||	$char->job == 112
	 ||	$char->job == 121
	 ||	$char->job == 122
	 ||	$char->job == 131
	 ||	$char->job == 132) {
		if($lnd["1001"])//Bash
			$list[]	= "1003";//DowbleAttack
		if($lnd["1001"])
			$list[]	= "1013";//Stab
		if($lnd["1001"])
			$list[]	= "3110";//Reinforce
		if($lnd["1001"])
			$list[]	= "3120";//FirstAid
		if($lnd["1003"])//DowbleAttack
			$list[]	= "1017";//RagingBlow
		if($lnd["1003"])
			$list[]	= "1011";//WeaponBreak
		if($lnd["1013"])//Stab
			$list[]	= "1014";//FatalStab
		if($lnd["1013"])
			$list[]	= "1016";//ArmorPierce
		if($lnd["3120"])//FirstAid
			$list[]	= "3121";//SelfRecovery
	}
	// RoyalGuard
	if($char->job == 101
	 ||	$char->job == 111
	 ||	$char->job == 112) {
		if($lnd["1003"])//DowbleAttack
			$list[]	= "1012";//ArmorBreak
		if($lnd["1017"]) {//RagingBlow
			$list[]	= "1018";//Indiscriminate
			$list[]	= "1022";//ChargeAttack
		}
		if($lnd["1013"]) {//Stab
			$list[]	= "1015";//KnockBack
			$list[]	= "1023";//Hit&Away
		}
		if($lnd["1016"])//ArmorPierce
			$list[]	= "1019";//PierceRush
		if($lnd["3110"]){ // Reinforce
			$list[]	= "3111";//OverLimit
			$list[]	= "3112";//Deffensive
		}
		if($lnd["3121"]){ // SelfRecovery
			$list[]	= "3122";//HyperRecovery
			$list[]	= "3123";//SelfRegeneration
		}
	}
	// Sacrier
	if($char->job == 102
	 ||	$char->job == 121
	 ||	$char->job == 122) {
		$list[]	= "1100";// ObtainPower
		if($lnd["1100"])// ObtainPower
			$list[]	= "1101";// ObtainSpeed
		if($lnd["1101"])// ObtainSpeed
			$list[]	= "1102";// ObtainMind
		$list[]	= "1113";// Pain
		if($lnd["1113"]) {// Pain
			$list[]	= "1114";// Rush
			$list[]	= "1117";// illness
		}
		if($lnd["1114"]) {// Rush
			$list[]	= "1115";// Ruin
			$list[]	= "1118";// Pressure
		}
		if($lnd["1115"])// Ruin
			$list[]	= "1116";// Punish
		// Rush + illness + ObtainMaind
		if($lnd["1114"] && $lnd["1117"] && $lnd["1102"])
			$list[]	= "1119";// Possession
	}
	// WitchHunt
	if($char->job == 103
	 ||	$char->job == 131
	 ||	$char->job == 132) {
		if($lnd["1003"])//DowbleAttack
			$list[]	= "1020";//ManaBreak
		if($lnd["1020"]) {//ManaBreak
			$list[]	= "1021";//SoulBreak
			$list[]	= "1025";//ManaDivision
		}
		if($lnd["1021"])//SoulBreak
			$list[]	= "1024";//LifeDivision
		// ������
		$list[]	= "2090";//EnergyRob
		$list[]	= "3231";//ForceShield(self)
		if($lnd["2090"]) {//EnergyRob
			$list[]	= "2091";//EnergyCollect
			$list[]	= "2110";//ChargeDisturb
			$list[]	= "2111";//ChargeDisturb(all)
		}
		if($lnd["2091"])//EnergyCollect
			$list[]	= "3421";//CircleErase
		if($lnd["3231"]) {//ForceShield(self)
			$list[]	= "3215";//MindBreak
			$list[]	= "3230";//ForceShield
			$list[]	= "3235";//MindBreak
		}
	}
	// �ʼ�ʮ�־�
	if($char->job == 111) {
		if($lnd["3122"]) //���ظ�
			$list[]	= "3124";//��������
		$list[]	= "3201";//��ս��Ԯ
		$list[]	= "3114";//ӭ��׼��
	}
	// �ʼ���ʿ
	if($char->job == 112) {
		if($lnd["1011"])//�ƻ�����
			$list[]	= "1033";//�廵����
		if($lnd["1012"])//�ƻ�װ��
			$list[]	= "1034";//����װ��
		if($lnd["1022"])//���
			$list[]	= "1026";//���³��
		if($lnd["1023"])//һ������
			$list[]	= "1027";//�෵
		if($lnd["1017"])//��ŭһ��
			$list[]	= "1031";//��ɨǧ��
	}
	// ��Ѫ��ħ
	if($char->job == 121) {
		if($lnd["1100"] && $lnd["1101"] && $lnd["1102"]) //
			$list[]	= "1120";//����
		if($lnd["1113"]) //ʹ��
			$list[]	= "1121";//Űɱ
		if($lnd["1115"]) //����
			$list[]	= "1122";//Ѫ����ɱ
		if($lnd["1122"]) //Ѫ����ɱ
			$list[]	= "1123";//�����¾
		$list[]	= "2058";//Ѫ������
		$list[]	= "3206";//��ŭ
	}
	// ��Ѫ��ʿ
	if($char->job == 122) {
		if($lnd["2033"]) //��ʳ
			$list[]	= "2034";//Ѫ���ռ�
		$list[]	= "2033";//��ʳ
	}
	// ħ��ʿ
	if($char->job == 131) {
		if($lnd["1021"]) //�ƻ����
			$list[]	= "1029";//���������
		$list[]	= "1030";//�Ӻ�ն
		$list[]	= "1038";//ħ�⽣
		if($lnd["1038"]) //ħ�⽣
			$list[]	= "1039";//�ɻ꽣
		if($lnd["1039"]) //�ɻ꽣
			$list[]	= "1040";//������
		if($lnd["3421"]) //ħ��������
			$list[]	= "3422";//ħ�������
	}
	// ��������
	if($char->job == 132) {
		if($lnd["1016"]) //�̴�װ��
			$list[]	= "1028";//����
		if($lnd["1013"]) //ͻ��
			$list[]	= "1124";//����ն
		if($lnd["3110"]) //ǿ��
			$list[]	= "3115";//����֮��
		if($lnd["1028"]) //����
			$list[]	= "1035";//�Ʒ�ն
		if($lnd["1035"]) //�Ʒ�ն
			$list[]	= "1036";//���п���
		if($lnd["1036"]) //���п���
			$list[]	= "1037";//���з籩
		$list[]	= "3216";//����ս
		if($lnd["3216"]) //����ս
			$list[]	= "3217";//����ǿ��
	}
	//////////////////////////////////// ħ��ϵ
	if(	$char->job == 200
	||	$char->job == 201
	||	$char->job == 202
	||	$char->job == 203
	||	$char->job == 211
	||	$char->job == 212
	||	$char->job == 221
	||	$char->job == 222
	||	$char->job == 231
	||	$char->job == 232) {
		$list[]	= "3011";//HiManaRecharge
		if($lnd["1002"])//FireBall
			$list[]	= "2000";//FireStorm
		if($lnd["2000"])//FireStorm
			$list[]	= "2002";//FirePillar
		if($lnd["1002"])//FireBall
			$list[]	= "2010";//IceSpear
		if($lnd["2010"])//IceSpear
			$list[]	= "2011";//IceJavelin
		if($lnd["2011"])//IceSpear
			$list[]	= "2014";//IcePrison
		if($lnd["1002"])//FireBall
			$list[]	= "2020";//ThunderBolt
		if($lnd["2020"])//ThunderBolt
			$list[]	= "2021";//LightningBall
		if($lnd["2021"])//LightningBall
			$list[]	= "2022";//Flash
		if($lnd["2021"])
			$list[]	= "2023";//Paralysis
	}
	// Warlock
	if($char->job == 201
	||	$char->job == 211
	||	$char->job == 212) {
		if($lnd["2000"])//FireStorm
			$list[]	= "2001";//HellFire
		if($lnd["2001"])//HellFire
			$list[]	= "2004";//MeteoStorm
		if($lnd["2002"])
			$list[]	= "2003";//Explosion
		if($lnd["2011"])//IceSpear
			$list[]	= "2012";//Blizzard
		if($lnd["2011"] && $lnd["2014"])//IceSpear + IcePrison
			$list[]	= "2015";//TidalWave
		if($lnd["2021"])//LightningBall
			$list[]	= "2024";//ThunderStorm
		if($lnd["3011"])//HiManaRecharge
			$list[]	= "3012";//LifeConvert
		if($lnd["3012"])//LifeConvert
			$list[]	= "3013";//EnergyExchange
		if($lnd["2000"] && $lnd["2021"])//FireStorm + LightningBall
			$list[]	= "2041";//EarthQuake
		if($lnd["2041"])//EarthQuake
			$list[]	= "2042";//Subsidence
		if($lnd["2011"] && $lnd["2021"])//IceSpear + LightningBall
			$list[]	= "2040";//SandStorm
	}
	// Summoner
	if($char->job == 202
	||	$char->job == 221
	||	$char->job == 222) {
		$list[]	= "3020";//ManaExtend
		$list[]	= "2500";//SummonIfrit
		$list[]	= "2501";//SummonLeviathan
		$list[]	= "2502";//SummonArchAngel
		$list[]	= "2503";//SummonFallenAngel
		$list[]	= "2504";//SummonThor
		if($lnd["3011"])//HiManaRecharge
			$list[]	= "3012";//LifeConvert
		$list[]	= "3410";//MagicCircle
		if($lnd["3410"]) {
			$list[]	= "3411";//DoubleMagicCircle
			$list[]	= "3420";//CircleErace
		}
	}
	// Necromancer
	if($char->job == 203
	||	$char->job == 231
	||	$char->job == 232) {
		$list[]	= "2030";//LifeDrain
		if($lnd["2030"]) {//LifeDrain
			$list[]	= "2031";//LifeSqueeze
			$list[]	= "2050";//VenomBlast
			$list[]	= "3205";//Fear
			$list[]	= "3215";//MindBreak
		}
		if($lnd["2050"])//VenomBlast
			$list[]	= "2051";//PoisonSmog
		/* // �O�������g������
		if($lnd["2031"])//LifeSqueeze
			$list[]	= "2032";//DeathKnell
		*/
		$list[]	= "2460";//RaiseDead(Zombie)
		if($lnd["2460"]) {//RaiseDead(Zombie)
			$list[]	= "2461";// Ghoul
			$list[]	= "2462";// RaiseMummy
		}
		if($lnd["2461"] && $lnd["2462"])// Ghoul + RaiseMummy
			$list[]	= "2055";// SoulRevenge
		if($lnd["2461"])// Ghoul
			$list[]	= "2463";// ZombieControl
		if($lnd["2463"])
			$list[]	= "2057";// SelfMetamorphose
		if($lnd["2462"])// RaiseMummy
			$list[]	= "2464";// GraveYard
		if($lnd["2464"])
			$list[]	= "2056";// ZombieRevival
		// ZombieControl + GraveYard
		if($lnd["2463"] && $lnd["2464"])
			$list[]	= "2465";// Biohazard
	}
	// ��ħ��ʦ
	if($char->job == 211) {
		$list[]	= "3116";//ħ����Լ
		if($lnd["2024"]) //�ױ�
			$list[]	= "2046";//��������
		if($lnd["2004"]) //��ʯ�籩
			$list[]	= "2047";//��������
		if($lnd["2011"]) //����ǹ
			$list[]	= "2048";//��������
		if($lnd["2014"]) //
			$list[]	= "2049";//�����
	}
	// ����
	if($char->job == 212) {
		$list[]	= "2069";//Ѹ��ֱ��
		if($lnd["2069"]) //Ѹ��ֱ��
			$list[]	= "2070";//Ѹ��׷��
		if($lnd["2070"]) //Ѹ��׷��
			$list[]	= "2071";//������
		if($lnd["2040"]) //ɳĮ�籩
			$list[]	= "2044";//��ɳ�籩
		if($lnd["2042"]) //����
			$list[]	= "2045";//��ʯ��
		if($lnd["2023"]) //���
			$list[]	= "2061";//�׵�����
	}
	// ħ���ٻ�ʦ
	if($char->job == 221) {
		if($lnd["3411"]) //˫��ħ����
			$list[]	= "3412";//����ħ����
		$list[]	= "2505";//�����
		$list[]	= "2506";//�����
		$list[]	= "2507";//������
	}
	// ħ��
	if($char->job == 222) {
		$list[]	= "3275";//������ǿ��
		$list[]	= "3313";//ħ��ǿ��
		if($lnd["3313"]) //ħ��ǿ��
			$list[]	= "3314";//ħ�ޱ���
		if($lnd["3314"]) //ħ�ޱ���
			$list[]	= "3315";//ȫħ��ǿ��
		if($lnd["3315"]) //ȫħ��ǿ��
			$list[]	= "3316";//ȫħ�ޱ���
		if($lnd["3316"]) //ȫħ�ޱ���
			$list[]	= "3317";//ħ�޸���
		if($lnd["3420"]) //ħ��������
			$list[]	= "3423";//ħ����Ĩ��
	}
	// ����ʦ
	if($char->job == 231) {
		$list[]	= "3202";//��ħ���
		$list[]	= "2064";//˥��
		if($lnd["2064"]) //˥��
			$list[]	= "2065";//��������
		if($lnd["2064"]) //˥��
			$list[]	= "2072";//�޴�
	}
	// а��
	if($char->job == 232) {
		$list[]	= "2066";//��Ԫ��
		if($lnd["2066"]) //��Ԫ��
			$list[]	= "2067";//ħ�д���
		if($lnd["2067"]) //ħ�д���
			$list[]	= "2068";//�ռ�ը��
		if($lnd["2003"]) //��ը
			$list[]	= "2062";//�Ա�
		if($lnd["2465"]) //����Σ��
			$list[]	= "2467";//ľ������ʿ
		if($lnd["2467"]) //ľ������ʿ
			$list[]	= "2468";//ľ����С��
		if($lnd["2468"]) //ľ����С��
			$list[]	= "2469";//ľ�������
		$list[]	= "2035";//����ո�
	}
	//////////////////////////////////// ֧Ԯϵ
	if(	$char->job == 300
	 ||	$char->job == 301
	 ||	$char->job == 302
	 ||	$char->job == 311
	 ||	$char->job == 312
	 ||	$char->job == 321
	 ||	$char->job == 322) {
		if($lnd["3000"]) {//Healing
			$list[]	= "2100";//Holy
			$list[]	= "3001";//PowerHeal
			$list[]	= "3003";//QuickHeal
		}
		if($lnd["3001"] || $lnd["3003"]) {// Power || QuickHeal
			$list[]	= "3002";//PartyHeal
			$list[]	= "3004";//SmartHeal
			$list[]	= "3030";//Reflesh
		}
		if($lnd["2100"])//Holy
			$list[]	= "2480";//HealRabbit

		if($lnd["3101"])//Blessing
			$list[]	= "3102";//Benediction
	}
	// Bishop
	if($char->job == 301
	 ||	$char->job == 311
	 ||	$char->job == 312) {
		if($lnd["2100"]) {//Holy
			$list[]	= "2101";//HolyBurst
			$list[]	= "3200";//Encourage
			$list[]	= "3210";//Charm
			$list[]	= "3220";//ProtectionField
			$list[]	= "3230";//ForceShield
		}
		if($lnd["2101"])//HolyBurst
			$list[]	= "2102";//GrandCross
		if($lnd["3220"])//ProtectionField
			$list[]	= "3400";//Regeneration
		if($lnd["3230"])//ForceShield
			$list[]	= "3401";//ManaRegen
		if($lnd["2480"])//HealRabbit
			$list[]	= "2481";//AdventAngel

		if($lnd["3102"] && $lnd["3220"] && $lnd["3230"])
			$list[]	= "3103";//Sanctuary
		$list[]	= "3415";//MagicCircle
	}
	// Druid
	if($char->job == 302
	 ||	$char->job == 321
	 ||	$char->job == 322) {
		if($lnd["3004"]) {//SmartHeal
			$list[]	= "3005";//ProgressiveHeal
			$list[]	= "3060";//HolyShield
		}
		if($lnd["3060"]) {
			$list[]	= "3050";//Quick
			$list[]	= "3055";//CastAsist
		}
		$list[]	= "3250";//PowerAsist
		$list[]	= "3255";//MagicAsist
		if($lnd["3250"] or $lnd["3255"])
			$list[]	= "3265";//SpeedAsist
		$list[]	= "3415";//MagicCircle
	}
	// �̻�
	if($char->job == 311) {
		if($lnd["3400"]) //�����ظ�
			$list[]	= "3402";//��������
		if($lnd["3401"]) //ħ�������ظ�
			$list[]	= "3403";//ħ����������
		if($lnd["3402"] && $lnd["3403"])
			$list[]	= "3404";//˫�س�������
		if($lnd["3102"]) //��ף��
			$list[]	= "3105";//��ף��
		if($lnd["3001"]) //�߼�����
			$list[]	= "3007";//��������
		if($lnd["3003"]) //���ٻظ�
			$list[]	= "3008";//��������
		if($lnd["3002"]) //Ⱥ��ظ�
			$list[]	= "3006";//Ⱥ������
		$list[]	= "3042";//����ת��
		if($lnd["3042"]) //����ת��
			$list[]	= "3041";//��������
	}
	// ��ʹ
	if($char->job == 312) {
		if($lnd["3415"]) //ħ����
			$list[]	= "3416";//˫��ħ����
		if($lnd["3103"]) //ʥ��
			$list[]	= "3104";//��罵��
		if($lnd["2481"]) //��ʹ����
			$list[]	= "2482";//��ʹ����
		if($lnd["2482"]) //��ʹ����
			$list[]	= "2483";//�񽫽���
	}
	// ��Ȼ�ػ���
	if($char->job == 321) {
		if($lnd["3060"]) {//ʥ�����
			$list[]	= "3136";//��������
			$list[]	= "3137";//��������
		}
		$list[]	= "2059";//����仯
		if($lnd["3005"]) //�����ظ�
			$list[]	= "3009";//��������
		if($lnd["3055"]) //�ӿ�ӽ��
			$list[]	= "3056";//����ӽ��
		if($lnd["3265"]) //�ٶȸ���
			$list[]	= "3270";//��������
	}
	// ���������
	if($char->job == 322) {
		$list[]	= "2063";//Ұ�Ա仯
		if($lnd["2063"]) //Ұ�Ա仯
			$list[]	= "3311";//Ұ�޻���
		if($lnd["3311"]) //Ұ�޻���
			$list[]	= "3312";//Ұ����ɱ
		if($lnd["2100"]) //ʥ��
			$list[]	= "2103";//������
		if($lnd["2103"]) //������
			$list[]	= "2104";//������
	}
	//////////////////////////////////// ��ϵ
	if( $char->job == 400
	||	$char->job == 401
	||	$char->job == 402
	||	$char->job == 403
	||	$char->job == 411
	||	$char->job == 412
	||	$char->job == 421
	||	$char->job == 422
	||	$char->job == 431
	||	$char->job == 432) {
		$list[]	= "2310";//DoubleShot
		if(!$lnd["2300"])
			$list[]	= "2300";//Shoot
		if($lnd["2300"]) {//Shoot
			$list[]	= "2301";//PowerShoot
			$list[]	= "2302";//ArrowShower
			$list[]	= "2303";//PalsyShot
		}
	}
	// Sniper
	if($char->job == 401
	||	$char->job == 411
	||	$char->job == 412) {
		if($lnd["2303"])//PalsyShot
			$list[]	= "2304";//PoisonShot
		if($lnd["2301"]){ //PowerShoot
			$list[]	= "2305";//ChargeShot
			$list[]	= "2306";//PierceShot
		}
		if($lnd["2306"]) {//PierceShot
			$list[]	= "2308";//Aiming
			$list[]	= "2309";//Disarm
		}
		// ArrowShower + ChargeShot + PierceShot
		if($lnd["2302"] && $lnd["2305"] && $lnd["2306"])
			$list[]	= "2307";//HurricaneShot
	}
	// BeastTamer
	if($char->job == 402
	||	$char->job == 421
	||	$char->job == 422) {

		$list[]	= "1240";//Whip
		if($lnd["1240"]) {
			$list[]	= "1241";//Lashing
			$list[]	= "1243";//WhipBite
		}
		if($lnd["1241"]) {
			$list[]	= "1242";//WhipStorm
			$list[]	= "1244";//BodyBind
		}
		$list[]	= "2401";//CallPookie
		$list[]	= "2404";//CallTrainedLion
		$list[]	= "2408";//CallSprite
		if($lnd["2401"])//CallPookie
			$list[]	= "2402";//CallWildBoar
		if($lnd["2402"])//Call
			$list[]	= "2403";//CallGrandDino
		if($lnd["2404"])//CallTrainedLion
			$list[]	= "2405";//CallBear
		if($lnd["2405"])//CallBear
			$list[]	= "2406";//CallChimera
		if($lnd["2408"])//CallSprite
			$list[]	= "2409";//CallFlyHippo
		if($lnd["2409"])//Call
			$list[]	= "2410";//CallDragon
		if($lnd["2408"] && $lnd["2405"])//CallSprite+Bear
			$list[]	= "2407";//CallSnowMan
		$list[]	= "3300";//PowerTrain
		$list[]	= "3301";//MindTrain
		$list[]	= "3302";//SpeedTrain
		$list[]	= "3303";//DefenceTrain
		if($lnd["3300"])//
			$list[]	= "3304";//BuildUp
		if($lnd["3301"])//
			$list[]	= "3305";//Intention
		if($lnd["3302"])//
			$list[]	= "3306";//Nimble
		if($lnd["3303"])//
			$list[]	= "3307";//Fortify
		// �`Train 4���
		if($lnd["3300"] && $lnd["3301"] && $lnd["3302"] && $lnd["3303"]) {
			$list[]	= "3308";//FullSupport
			$list[]	= "3310";//SuppressBeast
		}
	}
	// Murderer
	if($char->job == 403
	||	$char->job == 431
	||	$char->job == 432) {
		$list[]	= "1200";//PoisonBlow
		if($lnd["1200"]) {
			$list[]	= "1207";//PoisonBreath
			$list[]	= "1208";//PoisonInvasion
			$list[]	= "1220";//AntiPoisoning
		}
		if($lnd["1208"])
			$list[]	= "1209";//TransPoison
		$list[]	= "1203";//KnifeThrow
		if($lnd["1203"])
			$list[]	= "1204";//ScatterKnife
		$list[]	= "1205";//SulfaricAcid
		if($lnd["1205"])
			$list[]	= "1206";//AcidMist
	}
	// �ѻ���
	if($char->job == 411) {
		if($lnd["2309"]) //�����װ
			$list[]	= "2313";//���װ��
		if($lnd["2306"]) //��͸���
			$list[]	= "2314";//�������
		if($lnd["2307"]) //쫷����
			$list[]	= "2315";//��ɢ���
		if($lnd["2314"]) //��͸���
			$list[]	= "2316";//����ɢ��
		if($lnd["2305"]) //��λ���
			$list[]	= "2318";//ǿ������
	}
	// ��ɱ��
	if($char->job == 412) {
		if($lnd["2304"]) //�ж�����
			$list[]	= "2311";//���Ƽ�
		if($lnd["2303"]) //������
			$list[]	= "2312";//���ɢ��
		if($lnd["2301"]) //ǿ�����
			$list[]	= "2317";//��ͷһ��
		if($lnd["2317"]) //��ͷһ��
			$list[]	= "2319";//���ƴ���
	}
	// ����
	if($char->job == 421) {
		if($lnd["3308"]) //ȫ��֧��
			$list[]	= "3309";//ȫ��֧��
		if($lnd["2403"]) //������ٻ�
			$list[]	= "2411";//�ٻ�������
		if($lnd["2406"]) //�ٻ��ϳ���
			$list[]	= "2412";//�ٻ�����Ȯ
		if($lnd["2410"]) //�ٻ���
			$list[]	= "2413";//�ٻ���ʯ��
	}
	// ����
	if($char->job == 422) {
		if($lnd["1242"]) //��ҧ
			$list[]	= "1245";//�����߸�
		if($lnd["1245"]) //�����߸�
			$list[]	= "1246";//�����籩
	}
	// ��ɱ��
	if($char->job == 431) {
		$list[]	= "1221";//��ɱ
		if($lnd["1221"]) //��ɱ
			$list[]	= "1222";//��ذ�Ҵ�
		if($lnd["1200"]) //��֮һ��
			$list[]	= "1223";//��֮���
	}
	// ������
	if($char->job == 432) {
		$list[]	= "3138";//������
		if($lnd["3138"]) //������
			$list[]	= "3139";//��֮�ӻ�
		if($lnd["1206"]) //����
			$list[]	= "1224";//��ɳ��
		if($lnd["1204"]) //ذ���Ҵ�
			$list[]	= "1225";//����Ҵ�
	}
	//////////////////////////////////// ������
	if(!$lnd["3010"] && $char->job == "200")//ManaRecharge
		$list[]	= "3010";
	//////////////////////////////////// ��ͨϵ
	if(19 < $char->level)
		$list[]	= "4000";//�R��B��
	if(4 < $char->level)
		$list[]	= "9000";//�}���ж�(* think over)
	asort($list);
	return $list;
}
?>