<?php
/*
Plugin Name: Top Coin Plugin
Plugin URI: https://huykira.net/webmaster/wordpress/plugin-lay-tin-tu-dong-tu-vnexpress-net.html
Description: Top Coin Plugin by Huy Kira
Author: Huy Kira
Version: 1.0
Author URI: http://www.huykira.net
*/
if ( !function_exists( 'add_action' ) ) {
  echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
  exit;
}

define('BHK_PLUGIN_URL', plugin_dir_url(__FILE__));
define('BHK_PLUGIN_RIR', plugin_dir_path(__FILE__));

require_once(BHK_PLUGIN_RIR . 'includes/widget.php');
require_once(BHK_PLUGIN_RIR . 'includes/shortcode.php');

function bhk_styles()  { 
    wp_enqueue_style( 'bhk_style', BHK_PLUGIN_URL . 'css/bhk_style.css' );
    wp_enqueue_script( 'bhk_script', BHK_PLUGIN_URL . 'js/bhk_script.js', true, 1.1, true );
}
add_action('wp_enqueue_scripts', 'bhk_styles');

function bhk_add_menu() {
	add_submenu_page(
		'options-general.php',
		__( 'Top Coin'),
        'Top Coin',
        'manage_options',
        'top-coin',
        'bhk_create_page',
        'dashicons-index-card'
	);
}
add_action('admin_menu', 'bhk_add_menu');
function bhk_create_page(){ ?>
	<link rel="stylesheet" href="<?php echo BHK_PLUGIN_URL . 'css/bhk_style.css'; ?>">
	<div class="wrap">
		<h1 class="wp-heading-inline">Top coin</h1>
		<div id="col-container" class="wp-clearfix">
			<div id="col-left">
				<div class="info-plugin">
		    		<h2>Hướng dẫn sử dụng</h2>
		    		<p>Đây là plugin hiển thị danh sách top các đồng tiền ảo đang thịnh hành hiện nay, plugin lấy dự liệu online cập nhật nhanh nhất thông qua các API</p>
		    		<hr>
		    		<p><strong>Hiển thị là ngoài giao diện:</strong></p>
		    		<p><strong>Cách 1: Sử dụng wigdet </strong></p>
					<p>Bạn truy cập vào: <strong>admin -> giao diện -> wiget</strong>, tại khu vực này bạn sẽ thấy 1 widget tên là <strong>"+HK Top Coin"</strong>, bạn tiếng hành kéo widget qua khu vực sidebar mà bạn muốn hiển thị sau đó bạn điển tiêu đề và số lượng tiền ảo muốn hiển thị, mặc định widget là 5 đồng tiền có xếp hạng cao nhất.</p>
					<p><strong>Cách 2: Sử dụng shortcode </strong></p>
					<p>Bạn copy đoạn code dưới dán vào vị trí bạn muốn hiển thị bản xếp hạng tiền ảo.</p>
					<code>
				    	&lt;?php do_shortcode('[topcoin num="5"]'); ?&gt; 
				    </code>
					<p>Trong đó: <strong>num="5"</strong> là số lượng tiền ảo hiện thị là 5.</p> 
					<p>Ngoài việc chèn trực tiếp vào code bạn còn có thể tạo page hoặc post để sử dụng shortcode này. <strong>[topcoin num="5"]</strong></p>
		    	</div>
			</div>
			<div id="col-right" style="padding-left: 30px;box-sizing: border-box;">
				<h2>Demo</h2>
				<?php  do_shortcode('[topcoin num="10"]'); ?>
			</div>
		</div>
		
	</div>
<?php }