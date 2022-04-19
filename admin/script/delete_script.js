$('document').ready(function() {
	// select all checkbox	
	$(document).on('click', '#select_all', function() {          	
		$(".emp_checkbox").prop("checked", this.checked);
		$("#select_count").html($("input.emp_checkbox:checked").length+" Selected");
	});	
	$(document).on('click', '.emp_checkbox', function() {		
		if ($('.emp_checkbox:checked').length == $('.emp_checkbox').length) {
			$('#select_all').prop('checked', true);
		} else {
			$('#select_all').prop('checked', false);
		}
		$("#select_count").html($("input.emp_checkbox:checked").length+" Selected");
	});  
	// delete selected records
	jQuery('#deactive_records').on('click', function(e) { 
		var employee = [];  
		$(".emp_checkbox:checked").each(function() {  
			employee.push($(this).data('emp-id'));
		});	
		if(employee.length <=0)  {  
			alert("Please select records.");  
		}  
		else { 	
			WRN_PROFILE_DELETE = "Are you sure you want to deactive "+(employee.length>1?"these":"this")+" row?";  
			var checked = confirm(WRN_PROFILE_DELETE);  
			if(checked == true) {			
				var selected_values = employee.join(","); 
				$.ajax({ 
					type: "POST",  
					url: "deactive.php",  
					cache:false,  
					data: 'emp_id='+selected_values,  
					success: function(response) {	
						// remove deleted employee rows
						/*var emp_ids = response.split(",");
						for (var i=0; i<emp_ids.length; i++ ) {						
							$("#"+emp_ids[i]).update();
						}	*/
						location.reload(true)
						

					}   
				});				
			}  
		}  
	});


	jQuery('#active_records').on('click', function(e) { 
		var employee = [];  
		$(".emp_checkbox:checked").each(function() {  
			employee.push($(this).data('emp-id'));
		});	
		if(employee.length <=0)  {  
			alert("Please select records.");  
		}  
		else { 	
			WRN_PROFILE_DELETE = "Are you sure you want to active "+(employee.length>1?"these":"this")+" row?";  
			var checked = confirm(WRN_PROFILE_DELETE);  
			if(checked == true) {			
				var selected_values = employee.join(","); 
				$.ajax({ 
					type: "POST",  
					url: "active.php",  
					cache:false,  
					data: 'emp_id='+selected_values,  
					success: function(response) {	
						// remove deleted employee rows
						/*var emp_ids = response.split(",");
						for (var i=0; i<emp_ids.length; i++ ) {						
							$("#"+emp_ids[i]).update();
						}	*/
						location.reload(true)
						

					}   
				});				
			}  
		}  
	});
	jQuery('#All_active_records').on('click', function(e) { 
		var selected_values = ""; 
		WRN_PROFILE_DELETE = "Are you sure you want All enable ?";  
		var checked = confirm(WRN_PROFILE_DELETE);  
		if(checked == true) {
				$.ajax({ 
					type: "POST",  
					url: "All_active.php",  
					cache:false,  
					data: 'emp_id='+selected_values,  
					success: function(response) {	
						// remove deleted employee rows
						/*var emp_ids = response.split(",");
						for (var i=0; i<emp_ids.length; i++ ) {						
							$("#"+emp_ids[i]).update();
						}	*/
						location.reload(true)
						

					}   
				});				
		} 
		 
	});

	jQuery('#All_deactive_records').on('click', function(e) { 
		var selected_values = ""; 
		WRN_PROFILE_DELETE = "Are you sure you want All disable ?";  
		var checked = confirm(WRN_PROFILE_DELETE);  
		if(checked == true) {
				$.ajax({ 
					type: "POST",  
					url: "All_deactive.php",  
					cache:false,  
					data: 'emp_id='+selected_values,  
					success: function(response) {	
						// remove deleted employee rows
						/*var emp_ids = response.split(",");
						for (var i=0; i<emp_ids.length; i++ ) {						
							$("#"+emp_ids[i]).update();
						}	*/
						location.reload(true)
						

					}   
				});				
		} 
		 
	});

	$(function() {
		$('#toggle-event2').change(function() {
		  $('#console-event').html('Toggle: ' + $(this).prop('checked'))
		})
	  })

	  $(function() {
		$('.emp_checkbox2').change(function() {
			console.log("toggle-event");
	       var employee2 = [];  
	   
		  employee2.push($(this).data('emp-id-slide'));
	  		  console.log(employee2);	
	  
	 	
		 			
			  var selected_values = employee2.join(","); 

             if  ($(this).prop('checked')){

			  $.ajax({ 
				  type: "POST",  
				  url: "active.php",  
				  cache:false,  
				  data: 'emp_id='+selected_values,  
				  success: function(response) {	
					  // remove deleted employee rows
					  /*var emp_ids = response.split(",");
					  for (var i=0; i<emp_ids.length; i++ ) {						
						  $("#"+emp_ids[i]).update();
					  }	*/
					  location.reload(true)
					  

				  }   
			  });
			}else	{

                $.ajax({ 
					type: "POST",  
					url: "deactive.php",  
					cache:false,  
					data: 'emp_id='+selected_values,  
					success: function(response) {	
						// remove deleted employee rows
						/*var emp_ids = response.split(",");
						for (var i=0; i<emp_ids.length; i++ ) {						
							$("#"+emp_ids[i]).update();
						}	*/
						location.reload(true)
						
  
					}   
				});



			}			
		  } ) 
	  })





});