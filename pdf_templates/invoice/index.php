<html>
<head>
    <link rel="stylesheet" href="/include/pdf-templates-style/invoice_2/style.css" type="text/css" media="screen">
</head>
	<body>
			<?php if(isset($supplier_logo) and !empty($supplier_logo)){?>
			<div id="company_logo"><img style="max-height: 200px" src="<?=$supplier_logo?>"><div>
			<?php } ?>
			<p><b><u><?=$supplier_full_name?></u></b></p>
			<p><b>Адрес</b>: <?=$supplier_legal_address?></p>
			<p><b>Телефон</b>: <?=$supplier_phone?> </p>

<!--			<p id='center_text' align="center"><b>Образец заполнения платежного поручения</b><p>-->
			<table >
				<tr>
                                    <td colspan="2"><?=$supplier_kpp_inn?></td>		
				</tr>
				<tr>
					<td>Получатель:<br> <?=$supplier_full_name?></td><td>Сч. No <?=$supplier_bill?></td>		
				</tr>
				<tr>
					<td>Банк получателя<br> <?=$supplier_bank_and_address?></td><td>БИК <?=$supplier_bik?><br>Корр.Сч. No <?=$supplier_korr_bill?></td>		
				</tr>
				<tr>
                                    <td colspan="2"> &nbsp;Назначение платежа:<?=$description?></td>		
				</tr>
				
			</table >
			<h2>СЧЕТ № <?=$number_order?> от <?=$date?></h2>
			<br>
			<table id="infoTable" >
                            <tr> <td>Поставщик:</td><td> <?=$supplier_full_name.", ".$supplier_kpp_inn?>, <?=$supplier_legal_address?> </td><tr> 
                            <tr> <td>Покупатель:</td><td> <?=$fio?></td></tr>
                        </table>
                        <br>
			<table id="accountant">
				<tr id='header'>
					<td id='number'>№</td>
					<td >Наименование услуги</td>
					<td >Единица измерения</td>
					<td >Цена </td>
					<td>Количество</td>
					<td id='ammount'>Сумма </td>
				</tr>
                                <?php foreach ($products['product'] as $product){ 
                                   // $total_sum = 0.00;
                                    ?>
                                    
                            
				<tr>
					<td><?=$product['number']?></td>
					<td><?=$product['product']?></td>
					<td><?=$product['um']?></td>
                                        <td><?=number_format($product['cost'], 2, '.',' ')?></td>
					<td><?=$product['quantity']?></td>
                                        <?php $summ = $product['total_sum']; //$total_sum+=$summ;
					print('<td>'.number_format($summ, 2, '.',' ').'</td>')?>
				</tr>
				   <?php }?>	
				<tr>
					<td colspan="5"></td>
					<td><?=number_format($total_sum, 2, '.',' ')?></td>
				</tr>

				<tr>
					<td colspan="5">Без налога (НДС) </td>
					<td>---</td>
				</tr>
				<tr>
					<td colspan="5">Итого к оплате </td>
					<td><?=number_format($total_sum, 2, '.',' ')?></td>
				</tr>
			</table>
			
			<span>Всего наименований <?=$product['quantity']?>, на сумму <?=number_format($total_sum, 2, '.',' ')?> руб.   </span> 
			<!-- <div id="sign_layout">
				<div class='bottom_sign' >
					<div class='head_project'>Руководитель</div>
					<!-- <div class='img_sign' style = "background: url('/include/pdf-templates-style/invoice/test_sign.png') no-repeat;"></div> -->
					
				<!-- 	<div class="bottom_line"><img width="200px" src="/include/pdf-templates-style/invoice_2/test_sign.png" /></div>
					<div class='fio'>(<?=$company_head?>)</div>
				</div>
				<div class='bottom_sign'>
					<div class='head_project'>Бухгалтер</div>
					<div class="bottom_line"><img width="200px" src="/include/pdf-templates-style/invoice_2/test_sign.png" /></div>
					<div class='fio'>(<?=$company_head?>)</div>
				</div>
			</div> --> 
			<table id = "sign">
				<tr class="bottom_sign">
					<td class='head_project'  width="100px">Генеральный директор</td>
					<!-- <div class='img_sign' style = "background: url('/include/pdf-templates-style/invoice/test_sign.png') no-repeat;"></div> -->
					
                                        <td class="bottom_line" ><?php if((isset($supplier_head_sign) and !empty($supplier_head_sign))){ ?><img width="150px" src="<?=$supplier_head_sign;?>"/><?php } ?> </td>
					<td class='fio'>(<?=$supplier_head?>)</td>
				</tr>
				<tr class='bottom_sign'>
					<td class='head_project' width="100px">Главный бухгалтер</td>
					<td class="bottom_line" > <?php if((isset($accountant_sign) and !empty($accountant_sign))){ ?><img width="150px" src="<?=$accountant_sign;?>"/><?php } ?></td>
					<td class='fio'>(<?=$supplier_accountant?>)</td>
				</tr>
			</table>
			
			<div id='company_print'>
			<img src="<?php  echo (isset($company_seal) and !empty($company_seal))?$company_seal:'/include/pdf-templates-style/invoice/sign.png';?>" width="150px">
			</div>
			
			
	</body>
</html>