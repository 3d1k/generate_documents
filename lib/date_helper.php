<?php  

if( ! function_exists('unix_to_human_rus')){
    function unix_to_human_rus($date='',$type='long'){
        if(empty($date)){
           $date = date('d-m-Y'); 
        }
        $array_month = array(1=>array('long'=>'января','short'=>'янв'),
                             2=>array('long'=>'февраля','short'=>'фев'),
                             3=>array('long'=>'марта','short'=>'мар'),
                             4=>array('long'=>'апреля','short'=>'апр'),
                             5=>array('long'=>'мая','short'=>'мая'),
                             6=>array('long'=>'июня','short'=>'июн'),
                             7=>array('long'=>'июля','short'=>'июл'),
                             8=>array('long'=>'августа','short'=>'авг'),
                             9=>array('long'=>'сентября','short'=>'сен'),
                             10=>array('long'=>'октября','short'=>'окт'),
                             11=>array('long'=>'ноября','short'=>'нояб'),
                             12=>array('long'=>'декабря','short'=>'дек'),
                );
        $date_array = explode('-',$date);
        $month = $array_month[(int)$date_array[1]][($type=='long')?'long':'short'];
        return $date_array[0]." ".$month." ".$date_array[2]." г."; 
    }
    
}
if(!function_exists('reverseDate')){
    function reverseDate($date){
         return implode('-',  array_reverse(explode('-', $date)));
    }
}
if(!function_exists("mktimeFromDate"))
{
    function mktimeFromDate($date,$is_date_reverse=false,$now=true){
        $date_array = explode("-",$date);
        $month = $date_array[1];
        $day=($is_date_reverse)?$date_array[2]:$date_array[0];
        $year = ($is_date_reverse)?$date_array[0]:$date_array[2];
        
        $hours=0;
        $minutes=0;
        $sec = 0;
        if($now){
            $hours=23;
            $minutes = 59;
            $sec=59;
        }
        return mktime($hours, $minutes, $sec, $month, $day, $year);
    }
}