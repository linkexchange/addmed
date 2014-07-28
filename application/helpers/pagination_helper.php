<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function ajaxPagination($functionName="",$parameters=array(),$recordCount=0,$currentItem=1){
    $ci=& get_instance();
    $ci->config->load('table');
    $records_per_page=(int)$ci->config->item('record_limit');
    $pages_limit=(int)$ci->config->item('pages_limit');
    $outputPrinted=0;
    $previous=1;
    $next=1;
    $totalPages=0;
    $start=1    ;
    $end=0;
    
    if($recordCount%$records_per_page)
        $totalPages=(int)($recordCount/$records_per_page+1);
    else
        $totalPages=(int)($recordCount/$records_per_page);
    $para="";
    $arrSize=0; $ch=0;
    $arrSize=count($parameters);
    if($arrSize){
        for($i=0;$i<$arrSize;$i++){
            $ch++;
            if($ch<$arrSize)
                $para.="'".$parameters[$i]."',";
            else
                $para.="'".$parameters[$i]."'";
        }
    }
    else
    {
        $para="";
    }
    if($para!=""){
        $first='<li class="page-nav-fisrt"><a onclick="'.$functionName.'(1,'.$para.');" href="javascript:void(0);">First</a></li>';
        $last='<li class="page-nav-last"><a onclick="'.$functionName.'('.$totalPages.','.$para.');" href="javascript:void(0);">Last</a></li>';  
    }
    else {
        $first='<li class="page-nav-fisrt"><a onclick="'.$functionName.'(1);" href="javascript:void(0);">First</a></li>';
        $last='<li class="page-nav-last"><a onclick="'.$functionName.'('.$totalPages.');" href="javascript:void(0);">Last</a></li>';
    }
    if($totalPages<$pages_limit)
        $end=$totalPages;
    else
        $end=$pages_limit;
    
    $pageDifference=0;
    if($pages_limit%2)
        $pageDifference=(int)($pages_limit/2);
    else
        $pageDifference=($pages_limit/2)-1;
    
    if($currentItem>$pageDifference):
        $start=$currentItem-$pageDifference;
        $end=$currentItem+$pageDifference;
    endif;
       
    if($currentItem>=$totalPages || $end>=$totalPages){
        $end=$totalPages;
        if($pages_limit%2)
            $start=$totalPages-$pages_limit+1;
        else
            $start=$totalPages-$pages_limit;
    }
    
    if($start<1){
        $start=1;
        if($totalPages<$pages_limit)
            $end=$totalPages;
        else
            $end=$pages_limit;
    }
    
    if($currentItem<=1){
        $pre=0;
    }else{
        $pre=$currentItem-1;
        
        if($para!=""){
            $previous='<li class="page-nav-prev"><a onclick="'.$functionName.'('.$pre.','.$para.');" href="javascript:void(0);">Prevoius</a></li>';
        }
        else {
           $previous='<li class="page-nav-prev"><a onclick="'.$functionName.'('.$pre.');" href="javascript:void(0);">Prevoius</a></li>';
        }
    }
    
    if($currentItem>=$totalPages){
        $next=0;
    }else{
        $next=(int)$currentItem+1;
        
        if($para!=""){
            
            $nextItem='<li class="page-nav-next"><a onclick="'.$functionName.'('.$next.','.$para.');" href="javascript:void(0);">Next</a></li>';
        }
        else {
            $nextItem='<li class="page-nav-next"><a onclick="'.$functionName.'('.$next.');" href="javascript:void(0);">Next</a></li>';
        }
    }
    $output="";
    $output.='<ul class="pagination pagination-split m-bottom-md">';
    
    if($currentItem!=1){
         $output.=$first;
         $output.=$previous;
    }
    
    for($i=$start; $i<=$end; $i++) :
        if($i==$currentItem):
           if($para!=""){
                $output.='<li class="page-nav-'.$i.' active"><a onclick="'.$functionName.'('.$i.','.$para.');" href="javascript:void(0);">'.$i.'</a></li>';
            }
            else {
                $output.='<li class="page-nav-'.$i.' active"><a onclick="'.$functionName.'('.$i.');" href="javascript:void(0);">'.$i.'</a></li>';
            }
        else :
             if($para!=""){
                   $output.='<li class="page-nav-'.$i.'"><a onclick="'.$functionName.'('.$i.','.$para.');" href="javascript:void(0);">'.$i.'</a></li>';
                }
                else {
                    $output.='<li class="page-nav-'.$i.'"><a onclick="'.$functionName.'('.$i.');" href="javascript:void(0);">'.$i.'</a></li>';
                }
            endif;
    endfor;
    
    if($currentItem!=$totalPages):
           $output.=$nextItem;
           $output.=$last;
    endif;
    
    $output.='</ul>';
    echo $output; 
      
}   

function pagination($url="",$parameters=array(),$recordCount=0,$currentItem=1){
    $ci=& get_instance();
    $ci->config->load('table');
    $records_per_page=(int)$ci->config->item('record_limit');
    $pages_limit=(int)$ci->config->item('pages_limit');
    $outputPrinted=0;
    $previous=1;
    $next=1;
    $totalPages=0;
    $start=1    ;
    $end=0;
    
    if($recordCount%$records_per_page)
        $totalPages=(int)($recordCount/$records_per_page+1);
    else
        $totalPages=(int)($recordCount/$records_per_page);
    
    $para="";
    $arrSize=0; $ch=0;
    $arrSize=count($parameters);
    if($arrSize){
        for($i=0;$i<$arrSize;$i++){
            $ch++;
            if($ch<$arrSize)
                $para.="".$parameters[$i]."/";
            else
                $para.="".$parameters[$i]."";
        }
    }
    else
    {
        $para="";
    }
    
    if($para!=""){
        $first='<li class="page-nav-fisrt"><a href="'.$url.$para.'/1/">First</a></li>';
        $last='<li class="page-nav-last"><a href="'.$url.$para.'/'.$totalPages.'/">Last</a></li>';  
    }
    else {
        $first='<li class="page-nav-fisrt"><a href="'.$url.'1">First</a></li>';
        $last='<li class="page-nav-last"><a href="'.$url.'/'.$totalPages.'">Last</a></li>';
    }
    //echo $first;
    if($currentItem>=$totalPages){
        $next=0;
    }else{
        $next=(int)$currentItem+1;
        
        if($para!=""){
            
            $nextItem='<li class="page-nav-next"><a href="'.$url.$para.'/'.$next.'/">Next</a></li>';
        }
        else {
            $nextItem='<li class="page-nav-next"><a href="'.$url.$next.'/">Next</a></li>';
        }
    }
    $output="";
    $output.='<ul class="pagination pagination-split m-bottom-md">';
    
    if($currentItem!=1){
         $output.=$first;
         $output.=$previous;
    }
    
    for($i=$start; $i<=$end; $i++) :
        if($i==$currentItem):
           if($para!=""){
                $output.='<li class="page-nav-'.$i.' active"><a href="'.$url.$para.'/'.$i.'/">'.$i.'</a></li>';
            }
            else {
                $output.='<li class="page-nav-'.$i.' active"><a href="'.$url.$i.'/">'.$i.'</a></li>';
            }
        else :
             if($para!=""){
                   $output.='<li class="page-nav-'.$i.'"><a href="'.$url.$para.'/'.$i.'/">'.$i.'</a></li>';
                }
                else {
                    $output.='<li class="page-nav-'.$i.'"><a href="'.$url.$i.'/">'.$i.'</a></li>';
                }
            endif;
    endfor;
    
    if($currentItem!=$totalPages):
           $output.=$nextItem;
           $output.=$last;
    endif;
    
    $output.='</ul>';
    echo $output; 
}
?>
