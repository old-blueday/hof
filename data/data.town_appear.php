<?php
// Ǥ������Ȥ��γ��F�����Ȥ�...
// �ո��e�Ǥ����������䤨���Ȥ���
// ���륢���ƥब�ʤ����Ф��ʤ��Ȥ��Ǥ���
// �e�ե�����ˤ����Ҫ�����ä��Τ��ɤ���΢��
function TownAppear($user) {
	$place	= array();

	// �o�������Ф���
	$place["Shop"]	= true;
	$place["Recruit"]	= true;
	$place["Smithy"]	= true;
	$place["Auction"]	= true;
	$place["Colosseum"]	= true;

	// �ض��Υ����ƥब�ʤ����Ф��ʤ�ʩ�O
	//if($user->item[****])
	//	$place["****"]	= true;

	return $place;
}
?>