<tr>
<td height="60" colspan="2" align="center"> 
<p align="center"><b><font size="5"><?php
	if(strtolower($_SESSION['myusername'])=='admin')
		echo strtoupper("admin");
	else
		echo strtoupper("faculty");
?> PANEL</font></b></p>
</td>
</tr>