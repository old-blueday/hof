<?php 
	if(!function_exists("LoadSkillData"))
		include(DATA_SKILL);
?>
<div style="margin:15px">
<!-- ---------------------------------------------------------------- -->
<a name="content"></a>
<h4>Ŀ¼</h4>
<UL>
<LI><A href="#mj">�����ж��Ķ����ж�</A> 
<LI><A href="#twenty">Լ20%�ĸ��ʡ�</A> 
<LI><A href="#def">���ڷ���������ֵ��</A> 
<LI><A href="#res">���������Լ���״̬�쳣��ԭ��</A> </LI></UL><!-- ---------------------------------------------------------------- --><A name=mj></A>
<H4>�����ж��Ķ����ж�<A href="#content">��</A></H4>
<DIV style="MARGIN: 0px 20px">
<P>ѧϰ"* think over" ���ܵĻ�<BR>���Թ��������������ж����ж���</P>
<P><IMG class=vcent src="./image/char/mon_079.gif">�����սʿϵ�Ļ�...<IMG class=vcent src="./image/char/mon_080r.gif"></P>
<TABLE cellSpacing=5>
<TBODY>
<TR>
<TD>1</TD>
<TD><SELECT> <OPTION>����</OPTION> <OPTION selected>�Լ��� HP��50%����ʱ</OPTION> <OPTION>�Լ��� SP��20%����ʱ</OPTION> <OPTION>�Լ��� SP��30%����ʱ</OPTION> <OPTION>�����ж�ʱ</OPTION></SELECT> </TD>
<TD><SELECT> <OPTION>Attack</OPTION> <OPTION>Bash</OPTION> <OPTION>RagingBlow</OPTION> <OPTION>Reinforce</OPTION> <OPTION>SelfRecovery</OPTION> <OPTION selected>* think over</OPTION></SELECT> </TD>

<td><?php ShowSkillDetail(LoadSkillData(9000))?></td>
</tr>
<tr>
<TD>2</TD>
<TD><SELECT> <OPTION>����</OPTION> <OPTION>�Լ��� HP��50%����ʱ</OPTION> <OPTION selected>�Լ��� SPΪ20%����ʱ</OPTION> <OPTION>�Լ��� SP��30%����ʱ</OPTION> <OPTION>�����ж�ʱ</OPTION></SELECT></TD>
<TD><SELECT> <OPTION>Attack</OPTION> <OPTION>Bash</OPTION> <OPTION>RagingBlow</OPTION> <OPTION>Reinforce</OPTION> <OPTION selected>SelfRecovery</OPTION> <OPTION>* think over</OPTION></SELECT></TD>
<td><?php ShowSkillDetail(LoadSkillData(3121))?></td>
</tr>
<tr>
<TD>3</TD>
<TD><SELECT> <OPTION>����</OPTION> <OPTION>�Լ��� HPΪ50%����ʱ</OPTION> <OPTION>�Լ��� SPΪ20%����ʱ</OPTION> <OPTION>�Լ��� SPΪ30%����ʱ</OPTION> <OPTION selected>�����ж�ʱ</OPTION></SELECT></TD>
<TD><SELECT> <OPTION>Attack</OPTION> <OPTION>Bash</OPTION> <OPTION>RagingBlow</OPTION> <OPTION selected>Reinforce</OPTION> <OPTION>SelfRecovery</OPTION> <OPTION>* think over</OPTION></SELECT></TD>
<td><?php ShowSkillDetail(LoadSkillData(3110))?></td>
</tr>
<tr>
<TD>4</TD>
<TD><SELECT> <OPTION>����</OPTION> <OPTION>�Լ��� HPΪ50%����ʱ</OPTION> <OPTION>�Լ��� SPΪ20%����ʱ</OPTION> <OPTION selected>�Լ���SPΪ30%����ʱ</OPTION> <OPTION>�����ж�ʱ</OPTION></SELECT></TD>
<TD><SELECT> <OPTION>Attack</OPTION> <OPTION>Bash</OPTION> <OPTION selected>RagingBlow</OPTION> <OPTION>Reinforce</OPTION> <OPTION>SelfRecovery</OPTION> <OPTION>* think over</OPTION></SELECT></TD>

<td><?php ShowSkillDetail(LoadSkillData(1017))?></td>
</tr>
<tr>
<TD>5</TD>
<TD><SELECT> <OPTION selected>����</OPTION> <OPTION>�Լ��� HPΪ50%����ʱ</OPTION> <OPTION>�Լ��� SPΪ20%����ʱ</OPTION> <OPTION>�Լ��� SPΪ30%����ʱ</OPTION> <OPTION>�����ж�ʱ</OPTION></SELECT></TD>
<TD><SELECT> <OPTION selected>Attack</OPTION> <OPTION>Bash</OPTION> <OPTION>RagingBlow</OPTION> <OPTION>Reinforce</OPTION> <OPTION>SelfRecovery</OPTION> <OPTION>* think over</OPTION></SELECT></TD>
<td><?php ShowSkillDetail(LoadSkillData(1000))?></td>
</tr>
</tbody>
</table>��������Ļ���1 �� 2�� 
<UL>
<LI>�Լ��� HPΪ50%����ʱ 
<LI>�Լ��� SPΪ20%����ʱ </LI></UL>
<P>ֻ��˫�����ʺϵ�ʱ��ʹ�� "SelfRecovery" ��</P><!-- ----------------------------------- -->
<P>˵������...</P>
<TABLE cellSpacing=5>
<TBODY>
<TR>
<TD>1</TD>
<TD><SELECT> <OPTION selected>��ʱ��</OPTION></SELECT> </TD>
<TD><SELECT> <OPTION>Skill 1</OPTION> <OPTION>Skill 2</OPTION> <OPTION>Skill 3</OPTION> <OPTION selected>* think over</OPTION></SELECT> </TD>
<TD>�� ���ʺ��жϵ�ʱ�� ��3</TD></TR>
<TR>
<TD>2</TD>
<TD><SELECT> <OPTION selected>��ʱ��</OPTION></SELECT></TD>
<TD><SELECT> <OPTION selected>Skill 1</OPTION> <OPTION>Skill 2</OPTION> <OPTION>Skill 3</OPTION> <OPTION>* think over</OPTION></SELECT></TD>
<TD>�� ����ʺ�1+2���ж� ʹ��Skill 1 </TD></TR>
<TR>
<TD>3</TD>
<TD><SELECT> <OPTION selected>��ʱ��</OPTION></SELECT></TD>
<TD><SELECT> <OPTION>Skill 1</OPTION> <OPTION>Skill 2</OPTION> <OPTION>Skill 3</OPTION> <OPTION selected>* think over</OPTION></SELECT></TD>
<TD>�� ���ʺ��жϵ�ʱ�� ��6</TD></TR>
<TR>
<TD>4</TD>
<TD><SELECT> <OPTION selected>��ʱ��</OPTION></SELECT></TD>
<TD><SELECT> <OPTION>Skill 1</OPTION> <OPTION>Skill 2</OPTION> <OPTION>Skill 3</OPTION> <OPTION selected>* think over</OPTION></SELECT></TD>
<TD>�� ���ʺ��жϵ�ʱ�� ��6</TD></TR>
<TR>
<TD>5</TD>
<TD><SELECT> <OPTION selected>��ʱ��</OPTION></SELECT></TD>
<TD><SELECT> <OPTION>Skill 1</OPTION> <OPTION selected>Skill 2</OPTION> <OPTION>Skill 3</OPTION> <OPTION>* think over</OPTION></SELECT></TD>
<TD>�� ����ʺ�3+4+5���ж��Ļ� ʹ�� Skill 2 </TD></TR>
<TR>
<TD>6</TD>
<TD><SELECT> <OPTION selected>��ʱ��</OPTION></SELECT></TD>
<TD><SELECT> <OPTION>Skill 1</OPTION> <OPTION>Skill 2</OPTION> <OPTION selected>Skill 3</OPTION> <OPTION>* think over</OPTION></SELECT></TD>
<TD>�� �ʺ�6���ж��Ļ� ʹ�� Skill 3 </TD></TR></TBODY></TABLE>
<P>...?</P></DIV><!-- ---------------------------------------------------------------- --><A name=twenty></A>
<H4>Լ20%�ĸ��ʡ�<A href="#content">��</A></H4>
<P>ͬʱ����ж������ж���70%����,30%���ʣ�����<BR>0.7 * 0.3 = 0.21 = 21%</P><!-- ---------------------------------------------------------------- --><A name=def></A>
<H4>���ڷ���������ֵ��<A href="#content">��</A></H4>
<P>ǰ���Ǽ��˵İٷֱȺ�����ֱ�ӿ�ȥ��ֵ</P><!-- ---------------------------------------------------------------- --><A name=res></A>
<H4>���������Լ���״̬�쳣��ԭ��<A href="#content">��</A></H4>
<P>ս����û�ж�Ӧ��</P></DIV>