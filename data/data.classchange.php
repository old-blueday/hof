<?php 
function CanClassChange($char,$class) {
	switch($class) {
		case "101":// �ʼ���ʿ
			if(19 < $char->level && $char->job == 100)
				return true;
			return false;
		case "102":// ��սʿ
			if(24 < $char->level && $char->job == 100)
				return true;
			return false;
		case "103":// ħŮ��
			if(22 < $char->level && $char->job == 100)
				return true;
			return false;
		case "201":// ��ʿ
			if(19 < $char->level && $char->job == 200)
				return true;
			return false;
		case "202":// �ٻ�ʦ
			if(24 < $char->level && $char->job == 200)
				return true;
			return false;
		case "203":// ���鷨ʦ
			if(21 < $char->level && $char->job == 200)
				return true;
			return false;
		case "301":// ����
			if(24 < $char->level && $char->job == 300)
				return true;
			return false;
		case "302":// ��³��
			if(19 < $char->level && $char->job == 300)
				return true;
			return false;
		case "401":// �ѻ���
			if(19 < $char->level && $char->job == 400)
				return true;
			return false;
		case "402":// ѱ��ʦ
			if(24 < $char->level && $char->job == 400)
				return true;
			return false;
		case "403":// �̿�
			if(21 < $char->level && $char->job == 400)
				return true;
			return false;
		case "111":// �ʼ�ʮ�־�
			if(54 < $char->level && $char->job == 101)
				return true;
			return false;
		case "112":// �ʼ���ʿ
			if(59 < $char->level && $char->job == 101)
				return true;
			return false;
		case "121":// ��Ѫ��ħ
			if(54 < $char->level && $char->job == 102)
				return true;
			return false;
		case "122":// ��Ѫ��ʿ
			if(59 < $char->level && $char->job == 102)
				return true;
			return false;
		case "131":// ħ��ʿ
			if(54 < $char->level && $char->job == 103)
				return true;
			return false;
		case "132":// ��������
			if(59 < $char->level && $char->job == 103)
				return true;
			return false;
		case "211":// ��ħ��ʦ
			if(54 < $char->level && $char->job == 201)
				return true;
			return false;
		case "212":// ����
			if(59 < $char->level && $char->job == 201)
				return true;
			return false;
		case "221":// ħ���ٻ�ʦ
			if(54 < $char->level && $char->job == 202)
				return true;
			return false;
		case "222":// ħ��
			if(59 < $char->level && $char->job == 202)
				return true;
			return false;
		case "231":// ����ʦ
			if(54 < $char->level && $char->job == 203)
				return true;
			return false;
		case "232":// а��
			if(59 < $char->level && $char->job == 203)
				return true;
			return false;
		case "311":// �̻�
			if(54 < $char->level && $char->job == 301)
				return true;
			return false;
		case "312":// ��ʹ
			if(59 < $char->level && $char->job == 301)
				return true;
			return false;
		case "321":// ��Ȼ�ػ���
			if(54 < $char->level && $char->job == 302)
				return true;
			return false;
		case "322":// ���������
			if(59 < $char->level && $char->job == 302)
				return true;
			return false;
		case "411":// �ѻ���
			if(54 < $char->level && $char->job == 401)
				return true;
			return false;
		case "412":// ��ɱ��
			if(59 < $char->level && $char->job == 401)
				return true;
			return false;
		case "421":// ����
			if(54 < $char->level && $char->job == 402)
				return true;
			return false;
		case "422":// ����
			if(59 < $char->level && $char->job == 402)
				return true;
			return false;
		case "431":// ��ɱ��
			if(54 < $char->level && $char->job == 403)
				return true;
			return false;
		case "432":// ������
			if(59 < $char->level && $char->job == 403)
				return true;
			return false;
		default:
			return false;
	}
}
?>