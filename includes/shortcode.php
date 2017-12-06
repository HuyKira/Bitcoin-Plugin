<?php
function create_shortcode_bhk($args) {
   	$num = $args['num'];
   	$urlapi = 'https://api.coinmarketcap.com/v1/ticker/?limit='.$num;
	$data = json_decode(file_get_contents($urlapi, true)); 
	if($data) { ?>
	<div class="bhk-content-coin">
		<table class="bhk-table-coin">
			<thead>
				<tr>
					<th>Số TT</th>
					<th>Tên</th>
					<th>Giá (USD)</th>
					<th>Trong 24h</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($data as $key => $value) { ?>
				<tr>
					<td><?php echo $value->rank; ?></td>
					<td><img src="https://files.coinmarketcap.com/static/img/coins/16x16/<?php echo $value->id; ?>.png" alt=""><?php echo $value->name; ?></td>
					<td><?php echo $value->price_usd; ?>$ </td>
					<td>
						<p><?php echo $value->percent_change_24h; ?>%</p>
						<?php if($value->percent_change_24h > 0){ echo '<span>&uarr;</span>'; } else {echo '<span style="color: Red">&darr;</span>';} ?>
						<div class="clear"></div>	
					</td>
				</tr>	
				<?php } ?>
			</tbody>
		</table>
	</div> 
<?php } }
add_shortcode( 'topcoin', 'create_shortcode_bhk' );