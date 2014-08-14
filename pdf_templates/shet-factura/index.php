<html>
	<head>
	 <link rel="stylesheet" href="/include/pdf-templates-style/shet-factura/style.css" type="text/css" media="screen">
	<!-- <style>
		body{
			width:80%;
		}
		#header_block{
			width: 100%;
			height: 45px;
		}
		#header_info {
			float:right;
			text-align: right;
			font-size: 8;
		}
		#info{
			font-size: 12;
		}
		#table{
			 font-size: 12;
			 border-collapse: collapse;
			 border:0px #000 solid !important;

		}
		#table td{
			border: 1px solid black;
		}
		#numbers td {
			text-align: center;
		}
		.product_name{
			text-align: left;
		}
		.products, #total{
			text-align: right;
		}
		.head_description{
			width: 150px;
			font-size: 12;
			vertical-align: top;
		}
		.blockWithLine{
			display: inline-block;
			float: right;
			width: 100%;
		}
		.formNumber .blockWithLine{
			width: 94%;
		}
		.textAtopLine{
			position: relative;
		}
		.blockWithLine .textAtopLine{
			font-size: 12px;
			width: 100%;
		}
		.blockWithLine .line{
			width: 100%;
			border-bottom: 1px solid black;
		}
		.blockWithLine .textUnderLine{
			width: 100%;
			font-size: 8px;
			text-align: center;
			vertical-align: top;
		}
		.place_sign{
			width: 100px;
		}
		.place_fio{
			
			width: 150px;
		}
		.place_fio .textAtopLine
		{
			padding-left: 5px;
		}
		.place_big_sign{
			/*margin-left: 15px;*/
			width: 300px;
		}
		img{
			position: absolute;
			top: -12px;
			left:0px;
			/*margin-bottom: -13px;*/
		}
 

	</style> -->
	</head>
	<body>
		<div id="header_block">
			<div id="header_info">
				Приложение №1</br>
				к постановлению Правительства Российской Федерации<br>
				от 26 декабря 2011 г. № 1137
			</div>
		</div>
		<div>
			<h3>СЧЕТ-ФАКТУРА № <?=$number_order?> от <?=$date_invoice?><br>
			Исправления № -- от --</h3>
			<div id="info">
				Продавец: <?=$supplier_full_name?><br>
				Адрес: <?=$supplier_legal_address?><br>
				ИНН/КПП продавца: <?=$supplier_kpp_inn?><br>
				Грузоотправитель и его адрес: он же<br>
				Грузополучатель и его адрес:<?=$payer_consignee?><br>
				К платежно-расчетному документу № от . .<br>
				Покупатель:<?=$payer_company?><br>
				Адрес: <?=$payer_legal_address?><br>
				ИНН/КПП покупателя: <?=$payer_inn_kpp?>/<br>
				Валюта: наименование, <?=$currency?> <br>
			</div>
			<div id="items">
				<table id="table" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td rowspan=2 >Наименование товара (описание выполненных работ, оказанных услуг), имущественного права</td>
						<td colspan=2 >Единица измерения</td>
						<td rowspan=2 >Количество</td>
						<td rowspan=2 >Цена (тариф) за единицу измерения</td>
						<td rowspan=2 >Стоимость товаров (работ, услуг), имущественных прав без налога - всего</td>
						<td rowspan=2 >В том числе акциз</td>
						<td rowspan=2 >Налоговая ставка</td>
						<td rowspan=2 >Сумма налога, предъявляемая покупателю</td>
						<td rowspan=2 >Стоимость товаров (работ, услуг), имущественных прав с налогом - всего</td>
						<td colspan=2>Страна происхождения товара</td>
						<td rowspan=2>Номер таможенной декларации</td>
						
					</tr>
					<tr>
						<td>код</td>
						<td>условное обозначение (национальное)</td>
						<td>цифровой код</td>
						<td>краткое наименование</td>
						<!-- <td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td> -->
					
					</tr>
					<tr id="numbers">
						<td>1</td>
						<td>2</td>
						<td>2a</td>
						<td>3</td>
						<td>4</td>
						<td>5</td>
						<td>6</td>
						<td>7</td>
						<td>8</td>
						<td>9</td>
						<td>10</td>
						<td>10a</td>
						<td>11</td>
					
					</tr>
					<?php
					foreach($products as $key=>$product){?>

						<tr class='products'>
							<td class ='product_name'><?=$product['product']?></td>
							<td><?=$product['um_code']?></td>
							<td><?=$product['um']?></td>
							<td><?=$product['quantity']?></td>
							<td><?=$product['cost']?></td>
							<td><?=$product['total_without_nds']?></td>
							<td><?=$product['excise']?></td>
							<td><?=$product['nds_str']?></td>
							<td><?=$product['total_nds']?></td>
							<td><?=$product['total_with_nds']?></td>
							<td><?=$product['country_code']?></td>
							<td><?=$product['country']?></td>
							<td><?=$product['customs']?></td>
						</tr>
					<?php }?>
					<tr id="total">
						<td  id = "all" colspan=5>Всего к оплате</td>
						<!-- <td>2</td>
						<td>2a</td>
						<td>3</td>
						<td>4</td> -->
						<td><?=$total_sum?></td>
						<td colspan=2>X</td>
						<!-- <td>7</td> -->
						<td><?=$total_nds?></td>
						<td><?=$total_sum_with_nds?></td>
						<!-- <td>10</td>
						<td>10a</td>
						<td>11</td>
					 -->
					</tr>
				</table>
			</div>
			<!-- 
						<div class="blockWithLine place_sign">
			                <div class="textAtopLine"></div>
			                <div class="line"></div>
			                <div class="textUnderLine">(подпись)</div>
		                </div> -->
			<br>
			<div id="head_sign_table">
				<table id="table_for_sign" height="200px">
				<tr>
					<td rowspan=2 class = 'head_description'>
						Руководитель организации или иное уполномечнное лицо
					</td>
					<td class='place_sign'>
						<?php echo !empty($head_sign)?"<img  width='100px' src='$head_sign'/>":""?>
					</td>
					<td class='place_fio'>
						<?=$supplier_head?>
					</td>
					<td rowspan=2 class='head_description'>
						Главный бухгалтер или иное уполномечнное лицо
					</td>
					<td class='place_sign'>
						<?php echo !empty($accountant_sign)?"<img  width='100px' src='$accountant_sign'/>":""?>
					</td>
					<td class='place_fio'>
						<?=$supplier_accountant?>
					</td >
				</tr>
				<tr>
					<td class='inscription'>(подпись)</td>	
					<td class='inscription'>(ф.и.о)</td>	
					<td class='inscription'>(подпись)</td>	
					<td class='inscription'>(ф.и.о)</td>	
				</tr>
				<tr>
					<td rowspan=2 class= 'head_description'>
						Уполномоченное лицо
					</td>
					<td class='place_sign'>
						<?php echo !empty($head_sign)?"<img  width='100px' src='$head_sign'/>":""?>
						<!-- <div class="blockWithLine place_sign">
			                <div class="textAtopLine">&nbsp;<img  width="100px" src='/include/pdf-templates-style/invoice_2/test_sign.png'/></div>
			                <div class="line"></div>
			                <div class="textUnderLine">(подпись)</div>
		                </div> -->
					</td>
					<td class='place_fio'>
						<?=$supplier_head?>
						<!-- <div class="blockWithLine place_fio">
			                <div class="textAtopLine">&nbsp;Пупкин В.В.</div>
			                <div class="line"></div>
			                <div class="textUnderLine">(ф.и.о)</div>
		                </div> -->
					</td>
					<td></td>
					<td colspan=3 class='place_big_sign'>
						<!-- <div class="blockWithLine place_big_sign">
			                <div class="textAtopLine">&nbsp;</div>
			                <div class="line"></div>
			                <div class="textUnderLine">&nbsp;</div>
		                </div> -->
					</td>
				</tr>
				<tr>
					<td class='inscription'>(подпись)</td>	
					<td class='inscription'>(ф.и.о)</td>	
					<!-- <td class='inscription'>(подпись)</td>	
					<td class='inscription'>(ф.и.о)</td>	 -->
				</tr>
				</table>
			</div>
		</div>
	</body>
</html>