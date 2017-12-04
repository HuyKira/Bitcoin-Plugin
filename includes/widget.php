<?php 
class BHK_plugin_widget extends WP_Widget {
  	function BHK_plugin_widget() {
	    $widget_ops = array( 'classname' => 'bhk_plugin_widget', 'description' => 'Hiển thị list danh sách xếp hạng các đồng tiển ảo đang thịnh hành hiện nay và tỉ giá của chúng' );
	    $control_ops = array( 'id_base' => 'bhk_plugin_widget' ); 
	    $this->WP_Widget( 'BHK_plugin_widget', '+HK - Top Coin', $widget_ops, $control_ops );
  	}
    function widget($args, $instance) {
      	extract( $args );
      	$title      = $instance['title'];
      	$num        = $instance['num'];
		if ( !defined('ABSPATH') )
  		die('-1'); 
  		echo $before_widget; 
  		echo $before_title.$title.$after_title;
  		$urlapi = 'https://api.coinmarketcap.com/v1/ticker/?limit='.$num;
  		$data = json_decode(file_get_contents($urlapi, true)); ?>
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
							<p><?php echo $value->percent_change_24h; ?></p>
							<?php if($value->percent_change_24h > 0){ echo '<span>&uarr;</span>'; } else {echo '<span style="color: Red">&darr;</span>';} ?>
							<div class="clear"></div>	
						</td>
					</tr>	
					<?php } ?>
				</tbody>
			</table>
		</div>
		<?php echo $after_widget;
  	} 
    function update($new_instance, $old_instance) {
      	$instance['title'] 	= strip_tags($new_instance['title']);
      	$instance['num']   	= $new_instance['num'];
      	return $instance;
    }
  	function form($instance) {
  		$defaults = array(
		    'title' => 'Tiêu đề',
		    'num' => 5,
		);
  		$instance = wp_parse_args((array) $instance, $defaults ); ?>
	    <p>
	      	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Nhập tiêu đề: '); ?></label>
	      	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>"  />
	    </p>
	    <p>
	      	<label for="<?php echo $this->get_field_id('num'); ?>"><?php _e('Nhập số lượng bài viết : '); ?></label>
	      	<input class="widefat" id="<?php echo $this->get_field_id('num'); ?>" name="<?php echo $this->get_field_name('num'); ?>" type="number" value="<?php echo $instance['num']; ?>" />
	    </p>
    <?php }
}
add_action('widgets_init', create_function('', 'return register_widget("BHK_plugin_widget");'));