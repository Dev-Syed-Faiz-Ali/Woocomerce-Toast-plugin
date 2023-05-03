jQuery( document ).ready(function() {
    
    
	

    	var data = {
			'action': 'my_action',
			'whatever': 1234
		};
    jQuery.ajax(
    {
        type: "post",
        dataType: "json",
        data: data,
        url: my_ajax_object.ajax_url,
        success: function(msg){
            //console.log(msg);
        }
    });


function popup() {
	jQuery("body").append('<div id="popup"></div>');
	jQuery("#popup").append('<span class="close">x</span>');
	jQuery("#popup").append('<div id="box_notification"></div>');
	var timeht='<div id="data-row-info"></div>';
	var html=timeht;
	jQuery("#box_notification").html(html);
	//console.log(0);
}
var time_delay = 10;
var time_out = 30;
var action_data = {
	'action': 'get_time',
};
// jQuery.post('', action_data , function(response) {
// 	time_delay = JSON.parse(response).dely_time;
// 	time_out = JSON.parse(response).time_out;
// 	time_out = parseInt(time_out) + parseInt(time_delay);
// });


var carName="";
function popvalues(url,time,pid,pname,p_qty,bill_name,order_date){
    console.log(url,time,pid,pname,p_qty,bill_name,order_date);
	if(carName==pid)
		{
			return;
		}
	else{
		carName=pid;
		var cust= "<div class='boxe'> <img src="+url+"> <h2> " +bill_name+ " has bought <span class='p-name'>" +pname+ "</span> <span> " +time+ " </span></div></h2>";
	jQuery("#data-row-info").html(cust);
	
	}
}
/*---- poppup ---------*/


	
	
	
	
	
	

	
function finterval() {


		var data = {
			'action': 'my_action',
			'whatever': 1234
		};
	
	
	
	 jQuery.ajax(
    {
        type: "post",
        dataType: "json",
        data: data,
        url: my_ajax_object.ajax_url,
        success: function(response){
            //var obj = JSON.parse(JSON.stringify(response));
             var obj = response;
            var res = [];
      
   for(var i in obj){
     res.push(obj[i]); 
    
   }
                
       popvalues(res[0],res[1],res[2],res[3],res[4],res[5]);
  


// var d = res[6]['date'];
// // var d = res[6];

// d = d.split(' ')[0];


   
        console.log(res[0],res[1],res[2],res[3],res[4],res[5]);
		
            

           

			 var timesRun = 0;
    var interval = setInterval(function () {
        
		if(timesRun  === 0 ){
				//console.log(time_delay);
        		jQuery("#popup").css({ display: "block" });
		}
		timesRun += 1;
 		//console.log(time_delay);
 		//console.log(time_out);
 		//console.log(timesRun);
        if (timesRun === parseInt(time_delay)) {
           //console.log(timesRun);
            jQuery("#popup").css({ display: "none" });
        } 
		
		if (timesRun === parseInt(time_out) ) {
			
          // console.log(timesRun + 'time');
            clearInterval(interval);
            timesRun = 0;
            finterval();
        } 

        //do whatever here..
    }, 1000);
        }
    });
	

		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
// 		jQuery.post(my_ajax_object.ajax_url, data, function(response) {
               
   
// 		});
	

   
}

finterval();
popup();

/*---- poppup ---------*/





var closebtns = document.getElementsByClassName("close");
var i;

for (i = 0; i < closebtns.length; i++) {
  closebtns[i].addEventListener("click", function() {
    this.parentElement.style.display = 'none';
  });
}




});










    

