<?php 
if($replies)
{
	for($k=0;$k<count($replies);$k++)
	{
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>".$replies[$k]['name']."</b>&nbsp;&nbsp;".$replies[$k]['created_date']."<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$replies[$k]['description']."<br/>";
	}
}
?>
