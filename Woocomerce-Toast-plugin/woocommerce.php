<?php
/*
Plugin Name: Woocomerce Product Toast
/*
Plugin Name: Woocomerce Product Toast
Plugin URI: 
Description: Show All Sale Product toast
Author: Syed Faiz Ali
Author URI: 
Version: 0.1


*/

//define absolute path to avoid direct access
if(!defined('ABSPATH')){
    define('ABSPATH', dirname(__FILE__));
}


// //include database
// include_once("db_created.php");

// //register hook
// register_activation_hook(__FILE__, "BDP_tb_create");



// // Create New table for db
register_activation_hook( __FILE__, 'crudOperationsTable');
function crudOperationsTable() {
  global $wpdb;
  $charset_collate = $wpdb->get_charset_collate();
  $table_name = $wpdb->prefix . 'userstable';
  $sql = "CREATE TABLE `$table_name` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(220) DEFAULT NULL,
  `clientname` varchar(220) DEFAULT NULL,
  `productname` varchar(220) DEFAULT NULL,
  `time` varchar(220) DEFAULT NULL,
  PRIMARY KEY(user_id)
  ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
  ";
  if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
  }
}


// add_action('admin_menu', 'addAdminPageContent');
// function addAdminPageContent() {
//   add_menu_page('CRUD', 'CRUD', 'manage_options', __FILE__, 'crudAdminPage', 'dashicons-wordpress');
// }
function crudAdminPage() {
  global $wpdb;
  $table_name = $wpdb->prefix . 'userstable';
}


//Adding CSS inline style to an existing CSS stylesheet
function wpb_add_inline_css() {
    
$reg = get_option('SFA_options');
$test = unserialize($reg);
//print_r($reg['color']);

// popup style
$color = $reg['color'];
$width = $reg['width'];
$border_radius = $reg['bradius'];
$border_width = $reg['bwidth'];
$border_style = $reg['bstyle'];
$border_color = $reg['bcolor'];
$border_box_positon = $reg['boxp'];
$border_box_positon_top = $reg['boxp1'];
$border_sgin = $reg['bbwidth'];
	
// User Name Style
$name_user = $reg['namecolor'];
$name_fw  = $reg['namefw'];
$name_fs = $reg['namefs'];
$name_fspx = $reg['name_fspx'];
	
// 	product name
$name_procolor = $reg['procolor'];
$name_profw  = $reg['profw'];
$name_profs = $reg['profs'];
$name_propx = $reg['pro_fspx'];




	
	wp_enqueue_style( 'slicknavcss', plugins_url() . '/Woocomerce-pupop-plugin-2/maincss.css' );
	
        //All the user input CSS settings as set in the plugin settings
        //$color = 'green';
        $slicknav_custom_css = "
        
          
	#popup {
    display: block;
    overflow: hidden;
    z-index: 19;
    position: fixed;
    $border_box_positon:0!important;
    top: auto;
    $border_box_positon_top:0px;
    background-color:{$color};
    width: {$width}{$border_sgin};
    height: auto;
    padding: 10px 10px 10px 10px;
    border-radius: {$border_radius}px;
    border-width:{$border_width}px;
   border-style:{$border_style};
   border-color:{$border_color};
    box-shadow: -1px 5px 12px 2px #0000004a;
    display: none;
    margin: 9px;
}

	#popup h2 {color:{$name_user}!important;
	           font-weight:{$name_fw }!important;
			   font-size:{$name_fs}{$name_fspx}!important;
			   }
			 
			 
    .p-name	{color:{$name_procolor}!important;
	           font-weight:{$name_profw}!important;
			   font-size:{$name_profs}{$name_propx}!important;
			   }
		

		
		
        ";

  //Add the above custom CSS via wp_add_inline_style
 wp_add_inline_style( 'slicknavcss', $slicknav_custom_css ); //Pass the variable into the main style sheet ID

}
add_action( 'wp_enqueue_scripts', 'wpb_add_inline_css' ); //Enqueue the CSS style
add_action( 'wp_enqueue_scripts', 'wpb_add_inline_css22' ); //Enqueue the CSS style




function my_enqueue() {

    wp_enqueue_script( 'ajax-script', plugin_dir_url( __FILE__ ) . '/assets/pop-ajax.js', array('jquery'),filemtime( plugin_dir_url( __FILE__ ) . '/assets/pop-ajax.js') , false);

    wp_localize_script( 'ajax-script', 'my_ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'my_enqueue' );
// wp_enqueue_script( 'real_time_script', plugin_dir_url( __FILE__ ) . '/main.js', array('jQuery'),filemtime( plugin_dir_url( __FILE__ ) . '/main.js'), true );
wp_enqueue_style( 'real_time_css', plugin_dir_url( __FILE__ ) . '/maincss.css' );


// wp_localize_script('real_time_script', 'ipAjaxVar', array(
//     'ajaxurl' => admin_url('admin-ajax.php')
// ));

//print_r(plugin_dir_url( __FILE__ ).'main.js');









add_action( 'wp_ajax_nopriv_my_action', 'my_action' );


add_action( 'wp_ajax_my_action', 'my_action' );



	
	
	
$tempoptions = get_option("SFA_options");
if (!empty($tempoptions)) {
    foreach ($tempoptions as $key => $option)
        $options[$key] = $option;
        
        $btn_checker = $options['btncheck']; 
        
        
        // echo $btn_checker;
        
        
        if($btn_checker == OFF){

 
 
  function my_action() {
	
  
   
	global $wpdb; // this is how you get access to the database

	$whatever = intval( $_POST['whatever'] );

	$whatever += 10;
	$ids = wc_get_products( array( 'return' => 'ids', 'limit' => -1 ) );
	shuffle($ids);
	$data = array();

	foreach ($ids as $id){
	    
    $count=0;
        $results=retrieve_orders_ids_from_a_product_id($id);
        
            foreach($results as $order_id){
    			$order = wc_get_order( $order_id );

    	
            $obj = array();
            $obj[$count] = new stdClass();

            $main = array();

    // The loop to get the order items which are WC_Order_Item_Product objects since WC 3+
            foreach( $order->get_items() as $item_id => $item ){

if(isset($results)){
            if(isset($id)){
                         $image = wp_get_attachment_image_src( get_post_thumbnail_id( $item['product_id'] ), 'single-post-thumbnail' );
                         
                        $data['thumb_url']=esc_url($image[0]);
                    }
        }
        
                    $product_id    = $item['product_id']; // Get the product ID
//                   $variation_id  = $item['variation_id']; // Get the variation ID
                    
                   

                    $product_name  = $item['name']; // The product name
                    $item_qty      = $item['quantity']; // The quantity

//                     // Get line item totals (non discounted)
//                     $line_total     = $item['subtotal']; // or $item['line_subtotal'] -- The line item non discounted total
//                     $line_total_tax = $item['subtotal_tax']; // or $item['line_subtotal_tax'] -- The line item non discounted tax total

//                     // Get line item totals (discounted)
//                     $line_total2     = $item['total']; // or $item['line_total'] -- The line item non discounted total
//                     $line_total_tax2 = $item['total_tax']; // The line item non discounted tax total
                	$date= date('Y-m-d', strtotime($order->get_date_created()));
                    $dateago = timeago($date);
                    $data['time'] = $dateago;
                	$obj[$count] -> time = $dateago;
    	
                    $data['id'] = $product_id;
                    $obj[$count] -> id = $product_id;

                    // $data['vid'] = $variation_id;
                    $data['product_name'] = $product_name;
                    $obj[$count] -> prod_name = $product_name;

                    $data['product_qty'] = $item_qty;

                    $billing_first_name = $order->get_formatted_billing_full_name();
                    $billing_last_name  = $order->get_formatted_shipping_full_name();
                    $order_date= $order->get_date_created();
                    $data['billing_name'] = $billing_first_name;
                    $data['order_date'] = $order_date;
                    
                    $data++;
                    $main[] = $data;
    	

                    // And so on ……
                }
    			$count++;
    			
    			
    			
    		}

    	//print_r($id);

    	
    	}
    // 	echo json_encode($data);
    	wp_send_json($data,200);

           

    	wp_die(); 
    }
 
 
 
 
 
 
 
 
  
 }

elseif ($btn_checker == ON) {
  
  
  	
	function my_action() {
	
	global $wpdb,$ip;	
	$whatever = intval( $_POST['whatever'] );
	$whatever += 10;	
		
	$table_name = $wpdb->prefix . 'userstable';
	
	$results = $wpdb->get_results( "SELECT * FROM $table_name");
	shuffle($results);//query to fetch record only from user_ip field
	if(count($results) > 0){
	   
	   		  $data = array();
          foreach ($results as $print) {
			  
$data['thumb_url'] = $print->img;
$data['time'] = $print->time;
$data['id']= $print->user_id;
// $data['time'] = $print->time;
$data['product_name'] = $print->productname;
$data['product_qty'] = "";
$data['billing_name'] = $print->clientname;
$data['order_date'] = $print->time;  

			  

			 
			    
			  

	 }
	   
	}
	
	
// 	   	  global $wpdb;
//    		  $table_name = $wpdb->prefix . 'userstable';
//           $result = $wpdb->get_results("SELECT * FROM $table_name");
		

		


	
	    wp_send_json($data,200);
    	wp_die(); 
	
	
	}



  
  
}
	
else{}
        
        
        
}

	


        



   















  

add_action("admin_menu", "addMenu");
function addMenu()
{
  add_menu_page("Woocommerce Toast", "Wo/Toast Setting", 5, "woocomerce-popup-options", "Menu" );
  add_submenu_page("woocomerce-popup-options", "Add Dummy Product", "Add Dummy Product", 4, "options", "option");
}





function option()
{
	

	  
   global $wpdb;
  $table_name = $wpdb->prefix . 'userstable';
  if (isset($_POST['newsubmit'])) {
    $img = $_POST['newimg'];
    $clientname = $_POST['newclientname'];
    $productname = $_POST['newproductname'];
    $time = $_POST['newtime'];	  
    $wpdb->query("INSERT INTO $table_name(img,clientname,productname,time) VALUES('$img','$clientname','$productname','$time')");
    echo "<script>location.replace('admin.php?page=options');</script>";
  }
  if (isset($_POST['uptsubmit'])) {
    $id = $_POST['uptid'];
    $img = $_POST['upimg'];
    $clientname = $_POST['upclientname'];
    $productname = $_POST['upproductname'];
    $time = $_POST['uptime'];	  
    $wpdb->query("UPDATE $table_name SET img='$img', clientname='$clientname', productname='$productname', time='$time' WHERE user_id='$id'");
    echo "<script>location.replace('admin.php?page=options');</script>";
  }
  if (isset($_GET['del'])) {
    $del_id = $_GET['del'];
    $wpdb->query("DELETE FROM $table_name WHERE user_id='$del_id'");
    echo "<script>location.replace('admin.php?page=options');</script>";
  }

	
  ?>
  <div class="wrap back-wr">
	  
	 
	  
    <h2>Add Dummy Products For Toast</h2>
	  
	   <div class="tbr">
    <table class="wp-list-table widefat striped tab90">
      <thead>
        <tr>
          <th width="10%">User ID</th>
          <th width="10%">Product Image URL</th>
          <th width="10%">Client Name</th>
          <th width="10%">Product Name</th>
		 <th width="10%"> Time </th>
        </tr>
      </thead>
      <tbody>
        <form action="" method="post">
          <tr class="ulpoad">
            <td><input type="text" value="AUTO_GENERATED" disabled></td>
            <td><input type="url" id="newimg" name="newimg" required  accept="image/jpg,image/png,image/jpeg,image/gif" ></td>
            <td><input type="text" id="newnewclientnameemail" name="newclientname" required></td>
			 <td><input type="text" id="newproductname" name="newproductname" required></td>
            <td><input type="text" id="newtime" name="newtime" required></td>
            <td><button id="newsubmit" name="newsubmit" type="submit">INSERT</button></td>
          </tr>
        </form>
        <?php
          $result = $wpdb->get_results("SELECT * FROM $table_name");
          foreach ($result as $print) {
            echo "
              <tr class='view''>
                <td width='10%'>$print->user_id</td>
                <td width='10%'><img src='$print->img' width='80'></td>
                <td width='10%'>$print->clientname</td>
				<td width='10%'>$print->productname</td>
				<td width='10%'>$print->time</td>
                <td width='10%'><a href='admin.php?page=options&upt=$print->user_id'><button type='button' class='upde'>UPDATE</button></a> <a href='admin.php?page=options&del=$print->user_id'><button type='button' class='del'>DELETE</button></a></td>
              </tr>
            ";
          }
	
        ?>
      </tbody>  
    </table>
	
		   
		   
	  </div>
    <br>
    <br>
    <?php
      if (isset($_GET['upt'])) {
        $upt_id = $_GET['upt'];
        $result = $wpdb->get_results("SELECT * FROM $table_name WHERE user_id='$upt_id'");
        foreach($result as $print) {
          $name = $print->name;
          $email = $print->email;
        }
        echo "
        <table class='wp-list-table widefat striped'>
          <thead>
            <tr class='update1'>
              <th width='10%'>User ID</th>
              <th width='10%'>Product Image</th>
              <th width='10%'>Client Name</th>
			  <th width='10%'>Time</th>
              <th width='10%'>Actions</th>
            </tr>
          </thead>
          <tbody>
            <form action='' method='post'>
              <tr class='update2'>
                <td width='10%'>$print->user_id <input type='hidden' id='uptid' name='uptid' value='$print->user_id'></td>
                <td width='10%'><input type='text' id='uptname' name='upimg' value='$print->img'></td>
                <td width='10%'><input type='text' id='uptemail' name='upclientname' value='$print->clientname'></td>
				<td width='10%'><input type='text' id='uptemail' name='upproductname' value='$print->productname'></td>
				<td width='10%'><input type='text' id='uptemail' name='uptime' value='$print->time'></td>
                <td width='10%'><button id='uptsubmit' name='uptsubmit' type='submit' class='upde' >UPDATE</button> <a href='admin.php?page=options' class='cen'><button type='button' class='del' >CANCEL</button></a></td>
              </tr>
            </form>
          </tbody>
        </table>";
      }
    ?>
  </div>
  <?php


}


	



function menu()
{
    
    
    
    

            // function dataget()
            // {


            //         $ids = wc_get_products( array( 'return' => 'ids', 'limit' => -1 ) );
            //         foreach ($ids as $id){

            //              $results=retrieve_orders_ids_from_a_product_id($id);
            //             foreach($results as $order_id){
            //                 $order = wc_get_order( $order_id );
            //                 $main = array();

            //                 foreach( $order->get_items() as $item_id => $item ){
            //                     $data = array();
            //                     $product_id    = $item['product_id']; // Get the product ID
            //                     $variation_id  = $item['variation_id']; // Get the variation ID
            //                     $product_name  = $item['name']; // The product name
            //                     $item_qty      = $item['quantity']; // The quantity
            //                     $line_total     = $item['subtotal']; // or $item['line_subtotal'] -- The line item non discounted total
            //                     $line_total_tax = $item['subtotal_tax']; // or $item['line_subtotal_tax'] -- The line item non discounted tax total
            //                     $line_total2     = $item['total']; // or $item['line_total'] -- The line item non discounted total
            //                     $line_total_tax2 = $item['total_tax']; // The line item non discounted tax total
            //                     $date= date('Y-m-d', strtotime($order->get_date_created()));
            //                     $dateago = timeago($date);
            //                     $data['time'] = $dateago;
            //                     $data['id'] = $product_id;
            //                     $data['product_name'] = $product_name;
            //                     $data['product_qty'] = $item_qty;
            //                     $billing_first_name = $order->get_formatted_billing_full_name();
            //                     $billing_last_name  = $order->get_formatted_shipping_full_name();
            //                     $order_date= $order->get_date_created();
            //                     $data['billing_name'] = $billing_first_name;
            //                     $data['order_date'] = $order_date;
            //                     $main[] = $data;
            //                 }
            //             }
            // 		}

            // }

     ?>
     
     <div class="wrap">
	<h1 class="main-h">Toast Setting</h1>
	<?php settings_errors(); ?>

	

	

 
		
		<ul class="nav nav-tabs nvt">
		<li class="active"><a href="#tab-1">Styling / Animation</a></li>
		<li><a href="#tab-2">Documentation</a></li>
	</ul>
		
		<div class="tab-content tc">
		<div id="tab-1" class="tab-pane active tp">
	   <form action="options.php" method="post" class="manfotm">	
		 <?php 
        settings_fields('SFA_options' );
        do_settings_sections( 'SFA' ); ?>
   
			
     <input name="submit-btn" class="button button-primary" type="submit" value="<?php esc_attr_e( 'Update All Settings' ); ?>" />
		 <h4 class="pf">
			  Powered By Syed Faiz Ali
		 </h4>
    </form>
		 
		 <div class="sfaajx-theme-name" style="background:green;color:white"><?php echo '<strong>'.__("Current Theme - ").'</strong>'. get_template(); ?></div>
		 
		</div>
			


		<div id="tab-2" class="tab-pane tp">
<div class="details">
			<p>
			    The Toast plugin is a simple yet effective way to get more exposure for your products. By toasting your products on your website, you can increase your chances of getting noticed by potential customers. The plugin is designed to work with WooCommerce, so you can easily add it to your existing website. The Toast plugin allows you to select which products you want to toast, and then displays a toast message on your website whenever someone adds one of those products to their shopping cart. The plugin is fully customizable, so you can change the toast message to anything you want. You can also choose how often the toast message is displayed, and whether or not it is displayed on the product page.
			</p>
			
			</div>
			
		</div>
			
			</div>
		
   
		


<script>
    
window.addEventListener("load", function() {

	// store tabs variables
	var tabs = document.querySelectorAll("ul.nav-tabs > li");

	for (i = 0; i < tabs.length; i++) {
		tabs[i].addEventListener("click", switchTab);
	}

	function switchTab(event) {
		event.preventDefault();

		document.querySelector("ul.nav-tabs li.active").classList.remove("active");
		document.querySelector(".tab-pane.active").classList.remove("active");

		var clickedTab = event.currentTarget;
		var anchor = event.target;
		var activePaneID = anchor.getAttribute("href");

		clickedTab.classList.add("active");
		document.querySelector(activePaneID).classList.add("active");

	}

});
</script>
     
   
    <?php


}


function dbi_register_settings() {
    
//     styling
    register_setting( 'SFA_options', 'SFA_options' );
// 	animation
	register_setting( 'SFA_options2', 'SFA_options2' );
    
    

	add_settings_section( 'api_settings2', 'ANIMATION', 'dbi_plugin_section_text', 'SFA2' );
	
	add_settings_section( 'api_settings', 'STYLING / ANIMATION ', 'dbi_plugin_section_text', 'SFA' );
	
	
    add_settings_field( 'dbi_plugin_setting_api_key', 'Delay Time Sec', 'dbi_plugin_setting_api_key', 'SFA', 'api_settings' );

    add_settings_field( 'dbi_plugin_setting_results_limit', 'Time Out Sec', 'dbi_plugin_setting_results_limit', 'SFA', 'api_settings' );
	
	add_settings_field( 'dbi_plugin_setting_btnchecks', 'Dummy content on ?', 'dbi_plugin_setting_btnchecks', 'SFA', 'api_settings' );
	
	
    
    add_settings_field( 'dbi_plugin_setting_boxp', 'Box Position', 'dbi_plugin_setting_boxp', 'SFA', 'api_settings' );

    add_settings_field( 'dbi_plugin_setting_color', 'Background Color ', 'dbi_plugin_setting_color', 'SFA', 'api_settings' );
    
    add_settings_field( 'dbi_plugin_setting_width', 'Box Width ', 'dbi_plugin_setting_width', 'SFA', 'api_settings' );
     
    add_settings_field( 'dbi_plugin_setting_bradius', 'Border Radius', 'dbi_plugin_setting_bradius', 'SFA', 'api_settings' );
     
    add_settings_field( 'dbi_plugin_setting_bwidth', 'Border Width', 'dbi_plugin_setting_bwidth', 'SFA', 'api_settings' );
     
    add_settings_field( 'dbi_plugin_setting_bcolor', 'Border Color', 'dbi_plugin_setting_bcolor', 'SFA', 'api_settings' );
     
    add_settings_field( 'dbi_plugin_setting_bstyle', 'Border Style', 'dbi_plugin_setting_bstyle', 'SFA', 'api_settings' );
	
	add_settings_field( 'dbi_plugin_setting_namecolor', 'Name Text Color', 'dbi_plugin_setting_namecolor', 'SFA', 'api_settings' );
	
	add_settings_field( 'dbi_plugin_setting_namefs', 'Font Size', 'dbi_plugin_setting_namefs', 'SFA', 'api_settings' );
	
	add_settings_field( 'dbi_plugin_setting_namefw', 'Font Weight', 'dbi_plugin_setting_namefw', 'SFA', 'api_settings' );
	
	
	
	add_settings_field( 'dbi_plugin_setting_procolor', 'Product Text Color', 'dbi_plugin_setting_procolor', 'SFA', 'api_settings' );
	
	add_settings_field( 'dbi_plugin_setting_profs', 'Font Size', 'dbi_plugin_setting_profs', 'SFA', 'api_settings' );
	
	add_settings_field( 'dbi_plugin_setting_profw', 'Font Weight', 'dbi_plugin_setting_profw', 'SFA', 'api_settings' );
	
	
	
	
	
	
	
	
	
	
     
     
     
     
     

     
    
     
     
       /*
        add_settings_field( 
        'bstyle', 
        __( 'Settings field description', 'dropdown' ), 'Dropdown_select_field_render', 
        'pluginPage', 
        'Dropdown_pluginPage_section' 
    );
      */


	
}


   
	


add_action( 'admin_init', 'dbi_register_settings' );






function dbi_plugin_setting_api_key() {
    

    $options = get_option( 'SFA_options' );
    echo "<input id='dbi_plugin_setting_api_key' name='SFA_options[dely_time]' type='number' value='" . esc_attr( $options['dely_time'] ) . "' />";
}

function dbi_plugin_setting_results_limit() {
    $options = get_option( 'SFA_options' );
    echo "<input id='dbi_plugin_setting_results_limit' name='SFA_options[time_out]' type='number' value='" . esc_attr( $options['time_out'] ) . "' />";
}




function dbi_plugin_setting_start_date() {
    $options = get_option( 'SFA_options' );
    echo "<input id='dbi_plugin_setting_start_date' name='SFA_options[start_date]' type='number' value='" . esc_attr( $options['start_date'] ) . "' />";
}


function dbi_plugin_setting_color() {
    $options = get_option( 'SFA_options' );
    echo "<input id='dbi_plugin_setting_color' name='SFA_options[color]' type='color' value='" . esc_attr( $options['color'] ) . "' />";
}


function dbi_plugin_setting_width() {
    $options = get_option( 'SFA_options' );
    echo "<input id='dbi_plugin_setting_with' name='SFA_options[width]' type='number' value='" . esc_attr( $options['width'] ) . "' />";
   
    $options = get_option( 'SFA_options' );
    echo "
        <select name='SFA_options[bbwidth]' id='dbi_plugin_setting_bbwidth'>
        <option value='px' " . selected( $options['bbwidth'], px, false ) ." >px</option>
        <option value='%' " . selected( $options['bbwidth'], '%' , false) .">%</option>
        <option value='em' " . selected( $options['bbwidth'], em, false ) .">em</option>

    </select>
    ";
}


function dbi_plugin_setting_bradius() {
    $options = get_option( 'SFA_options' );
    echo "<input id='dbi_plugin_setting_bradius' name='SFA_options[bradius]' type='number' value='" . esc_attr( $options['bradius'] ) . "' />";
}

function dbi_plugin_setting_bwidth() {
    $options = get_option( 'SFA_options' );
    echo "<input id='dbi_plugin_setting_bwidth' name='SFA_options[bwidth]' type='number' value='" . esc_attr( $options['bwidth'] ) . "' />";
}


function dbi_plugin_setting_bstyle() {
    $options = get_option( 'SFA_options' );
    echo "
        <select name='SFA_options[bstyle]' id='dbi_plugin_setting_bstyle'>
        <option value='solid' " . selected( $options['bstyle'], solid, false ) ." >Solid</option>
        <option value='dashed' " . selected( $options['bstyle'], dashed, false ) .">Dashed</option>
        <option value='dotted' " . selected( $options['bstyle'], dotted, false ) .">Dotted</option>
        <option value='double' " . selected( $options['bstyle'], double, false ) .">Double</option>
    </select>
    ";
    
}


function dbi_plugin_setting_boxp() {
    $options = get_option( 'SFA_options' );
    echo "
        <select name='SFA_options[boxp]'>
        <option value='left' " . selected( $options['boxp'], left, false ) .">Left</option>
        <option value='right' " . selected( $options['boxp'], right, false ) .">Right</option>
    </select>
    ";
    
      echo "
        <select name='SFA_options[boxp1]'>
        <option value='top' " . selected( $options['boxp1'], top, false ) .">Top</option>
        <option value='bottom' " . selected( $options['boxp1'], bottom, false ) .">Bottom</option>
    </select>
    ";
}



function dbi_plugin_setting_bcolor() {
    $options = get_option( 'SFA_options' );
    echo "<input id='dbi_plugin_setting_bcolor' name='SFA_options[bcolor]' type='color' value='" . esc_attr( $options['bcolor'] ) . "' />";
}


function dbi_plugin_setting_namecolor() {
    $options = get_option( 'SFA_options' );
    echo "<input id='dbi_plugin_setting_namecolor' name='SFA_options[namecolor]' type='color' value='" . esc_attr( $options['namecolor'] ) . "' />";
}


function dbi_plugin_setting_namefs() {
    $options = get_option( 'SFA_options' );
    echo "<input id='dbi_plugin_setting_namefs' name='SFA_options[namefs]' type='number' value='" . esc_attr( $options['namefs'] ) . "' />";
   
    $options = get_option( 'SFA_options' );
    echo "
        <select name='SFA_options[name_fspx]' id='dbi_plugin_setting_name_fspx'>
        <option value='px' " . selected( $options['name_fspx'], px, false ) ." >px</option>
        <option value='%' " . selected( $options['name_fspx'], '%' , false) .">%</option>
        <option value='em' " . selected( $options['name_fspx'], em, false ) .">em</option>

    </select>
    ";
}

function dbi_plugin_setting_namefw() {
    $options = get_option( 'SFA_options' );
    echo "<input id='dbi_plugin_setting_namefw' name='SFA_options[namefw]' type='number' value='" . esc_attr( $options['namefw'] ) . "' />";
}






function dbi_plugin_setting_procolor() {
    $options = get_option( 'SFA_options' );
    echo "<input id='dbi_plugin_setting_procolor' name='SFA_options[procolor]' type='color' value='" . esc_attr( $options['procolor'] ) . "' />";
}


function dbi_plugin_setting_profs() {
    $options = get_option( 'SFA_options' );
    echo "<input id='dbi_plugin_setting_profs' name='SFA_options[profs]' type='number' value='" . esc_attr( $options['profs'] ) . "' />";
   
    $options = get_option( 'SFA_options' );
    echo "
        <select name='SFA_options[pro_fspx]' id='dbi_plugin_setting_pro_fspx'>
        <option value='px' " . selected( $options['pro_fspx'], px, false ) ." >px</option>
        <option value='%' " . selected( $options['pro_fspx'], '%' , false) .">%</option>
        <option value='em' " . selected( $options['pro_fspx'], em, false ) .">em</option>

    </select>
    ";
}

function dbi_plugin_setting_profw() {
    $options = get_option( 'SFA_options' );
    echo "<input id='dbi_plugin_setting_namefw' name='SFA_options[profw]' type='number' value='" . esc_attr( $options['profw'] ) . "' />";
}


function dbi_plugin_setting_btnchecks() {
    $options = get_option( 'SFA_options' );
    echo "
        <select name='SFA_options[btncheck]' id='dbi_plugin_setting_name_btncheck'>
        <option value='ON' " . selected( $options['btncheck'], ON, false ) ." >ON</option>
        <option value='OFF'" . selected( $options['btncheck'],  OFF, false) .">OFF</option>

    </select>
    ";
}



function SFA_options_validate( $input ) {
//     $newinput['api_key'] = trim( $input['api_key'] );
//     if ( ! preg_match( '/^[a-z0-9]{32}$/i', $newinput['api_key'] ) ) {
//         $newinput['api_key'] = '';
//     }

    return $newinput;
}





function timeago($date) {
	   $timestamp = strtotime($date);	
	   
	   $strTime = array("second", "minute", "hour", "day", "month", "year");
	   $length = array("60","60","24","30","12","10");

	   $currentTime = time();
	   if($currentTime >= $timestamp) {
			$diff     = time()- $timestamp;
			for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
			$diff = $diff / $length[$i];
			}

			$diff = round($diff);
			return $diff . " " . $strTime[$i] . "(s) ago ";
	   }
	}



function retrieve_orders_ids_from_a_product_id( $product_id ) {
    global $wpdb;

    // Define HERE the orders status to include in  <==  <==  <==  <==  <==  <==  <==
    $orders_statuses = "'wc-completed', 'wc-processing', 'wc-on-hold'";

    # Requesting All defined statuses Orders IDs for a defined product ID
    $orders_ids = $wpdb->get_col( "
        SELECT DISTINCT woi.order_id
        FROM {$wpdb->prefix}woocommerce_order_itemmeta as woim, 
             {$wpdb->prefix}woocommerce_order_items as woi, 
             {$wpdb->prefix}posts as p
        WHERE  woi.order_item_id = woim.order_item_id
        AND woi.order_id = p.ID
        AND p.post_status IN ( $orders_statuses )
        AND woim.meta_key LIKE '_product_id'
        AND woim.meta_value LIKE '$product_id'
        ORDER BY woi.order_item_id DESC"
    );
    // Return an array of Orders IDs for the given product ID
    return $orders_ids;
}

// if($_SERVER['REQUEST_METHOD'] == 'POST'){
// 	if(isset($_POST['action'])){
// 		if($_POST['action'] == 'get_time'){
// 	    	$options = get_option( 'SFA_options' );
// 			echo json_encode($options);
// 			die(); 
// 		}
// 	}
// }
// 


