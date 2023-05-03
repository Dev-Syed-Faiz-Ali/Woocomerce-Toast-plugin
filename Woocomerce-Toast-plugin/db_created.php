<?php




function BDP_tb_create(){
    
    
    global $wpdb;
    
    
    //step1
    $DBP_tb_name=$wpdb->prefix ."Dummy_products";
    
    
    //step2
    
    $DPB_query="CREATE TABLE $DBP_tb_name(
    
        id int(10) NOT NULL AUTO_INCREAMENT,
        image_link varchar (100) DEFUALT '',
        client_name (100) DEFUALT '',
        title (100) DEFUALT '',
        decription varchar (100) DEFUALT '',
        PRIMARY KEY (id)
     )";
     
     
     //step3
     
     require_once(ABSPATH ."wp-admin/includes/upgrade.php");
     dbDelta($DPB_query);    
}
















?>