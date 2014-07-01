<?php 
if(isset($amount)) {
	foreach($amount as $item) {
		if($item['advertiserPaynment'])
			echo $item['advertiserPaynment'];
		else
			echo "0";
		break;
	}
}
else
{
	echo "0";
}
?>