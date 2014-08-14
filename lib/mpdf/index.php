<?php

$content=  file_get_contents('accountant.html');

  include("mpdf.php");

$mpdf=new mPDF('utf-8','A4','','',20,15,20,16); 
$mpdf->charset_in = 'utf-8';

$mpdf->SetDisplayMode('fullpage');

$mpdf->list_indent_first_level = 0; // 1 or 0 - whether to indent the first level of a list

$stylesheet = file_get_contents('table.css');
$mpdf->WriteHTML($stylesheet,1);    // The parameter 1 tells that this is css/style only and no body/html/text

$mpdf->WriteHTML($content,2);

$mpdf->Output('mpdf2.pdf','I');
exit;
    ?>