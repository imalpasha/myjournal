<table cellpadding="0"  width="100%">
	<tr><td>
		<table cellpadding="0" cellspacing="0" border="0">
<?php

$query = mysql_query("select id,name,link from quicklinks where user_id = '$user_id';") or die ("could not select quicklinks");
$numrows = mysql_num_rows($query);
if ( $numrows > 0 ) {
	while($result=mysql_fetch_array($query))	{
		$name=$result["name"];	
		$link=$result["link"];
	
?>
	<tr>
		<td align="left" width="100%">- <a class="sidemenu" href="http://<?php echo $link; ?>"><?php echo $name; ?></a></td>
	</tr>
	<?php 
	}
}

?>		
		</table>
	</td></tr>
</table>

