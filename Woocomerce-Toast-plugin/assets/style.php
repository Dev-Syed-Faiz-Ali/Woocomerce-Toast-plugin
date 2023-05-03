<?php


.model_inline {
    background-color: {$color};
}

		







//Adding CSS inline style to an existing CSS stylesheet
function wpb_add_inline_css22() {

        //All the user input CSS settings as set in the plugin settings
        $slicknav_custom_css = "
       
	   .he  {color:{$name_user}!important;
	           font-weight:{$name_fw }!important;
			   font-size:{$name_fs}{$name_fspx}!important;
			   }
	   
           ";

  //Add the above custom CSS via wp_add_inline_style
  wp_add_inline_style( 'slicknavcss', $slicknav_custom_css ); //Pass the variable into the main style sheet ID

}












?>