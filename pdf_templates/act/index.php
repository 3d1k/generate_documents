<html>
	<head>
		<link rel="stylesheet" href="/include/pdf-templates-style/act/style.css" type="text/css" media="screen">
	</head>
	<body>
		<h3>Акт №<?=$number_order?> от <?=$date_invoice?> г</h3>
		<div id="big_fat_line"></div>
		<table id="info">
			<tr>
				<td class='company'> Исполнитель</td>
				<td class='company_description'> <?=$supplier_full_name?></td>
			</tr>
			<tr>
				<td class='company'> Заказчик</td>
				<td class='company_description'> <?=$payer_company?> </td>
			</tr>
		</table>

		<table id="products_table">
			<tr class="table_head">
				<td>№</td>
				<td>Наименование</td>
				<td>Количество</td>
				<td>Ед.</td>
				<td>Цена</td>
				<td>Сумма</td>
			</tr>
                        <?php foreach ($products as $value) {?>
			<tr>
				<td><?=$value['number']?></td>
				<td><?=$value['product']?></td>
				<td><?=$value['quantity']?></td>
				<td><?=$value['um']?></td>
				<td><?=$value['cost']?></td>
				<td><?=$value['total_sum']?></td>
			</tr>
                        <?php }
                        ?>
			<!-- <tr>
				<td colspan=4></td>
				<td>Итого</td>
				<td>3333</td>
			</tr>
			<tr>
				<td colspan=4></td>
				<td>Итого</td>
				<td>3333</td>
			</tr> -->
		</table>
		<div id="total">
			<table id="total_table">
				<tr>
					<td>Итого:</td>
					<td><?=$total_sum?></td>
				</tr>
				<tr>
					<td>Сумма НДС:</td>
					<td><?=$summ_nds?></td>
				</tr>
				<tr>
					<td>Всего:</td>
					<td><?=$total_sum_nds?></td>
				</tr>
			</table>
			 
		</div>
		<div id="in_words">Всего оказано услуг на сумму: <?=$money_stringify?></div>
		<div id="text">
			Вышеперечисленные услуги выполнены полностью и в срок. Заказчик претензий по объему, качеству и
			срокам оказания услуг не имеет
		</div>
		<table id="sign_table">
			<tr class="table_head">
				<td colspan=2>Исполнитель</td>
                                    
				<td>&nbsp; </td>
				<td colspan=2>Заказчик</td>
			</tr>
			<tr>
				<td colspan=2 class='place_for_text'><?=$supplier_head_position?></td>
				<td>&nbsp; </td>
				<td colspan=2 class='place_for_text'><?=$payer_head_position?></td>
			</tr>
			<tr>
				<td colspan=2 class='inscription'>должность</td>	
				<td>&nbsp; </td>
				<td colspan=2 class='inscription'>должность</td>	
			</tr>
			<tr>
				<td class='place_for_sign'><?php echo !empty($head_sign)?"<img  width='100px' src='$head_sign'/>":""?></td>
				<td class='place_for_text'><?=$supplier_head?></td>
				<td> &nbsp;</td>
				<td class='place_for_sign'></td>
				<td class='place_for_text'><?=$payer_head?></td>
			</tr>
			<tr>
				<td class='inscription'>подпись</td>
				<td class='inscription'>расшифровка подписи </td>
				<td>&nbsp; </td>
				<td class='inscription'>подпись</td>
				<td class='inscription'>расшифровка подписи</td>
			</tr>
		</table>
	</body>
</html>