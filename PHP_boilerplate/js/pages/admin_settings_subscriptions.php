<script type="text/javascript">
	
	    			
  		
  			 function deletePlan(id){
	  		 //console.log("x:"+id);

	  		 $.ajax( {
		      type: "POST",
		      url: '<?=SURL;?>methods.php?action=deletePlan&token=<?=$_SESSION['token'];?>&plan_id='+id,
		      data: "",
		      success: function( response ) {
		        window.location='/admin_settings_subscriptions';
					}
		    	} );
  		}
  			
$( document ).ready(function() {


        
        var subscriptionstring='';
	      	subscriptionstring+="<?=SURL;?>methods.php?action=listPlans&token=<?=$_SESSION['token'];?>";
        var grid = $("#subscriptions_table").dataTable( {
                                    
                    "aLengthMenu": [
                        [20, 50, 100, 150, -1],
                        [20, 50, 100, 150, "All"] // change per page values here
                    ],
                    "scrollY":        "400px",
                    "iDisplayLength": 50, // default record count per page
                    "sAjaxSource": subscriptionstring,
					"type": "GET",
					"sAjaxDataProp": "data",                   
                     "scrollX": false,
                     "scrollCollapse": true,
                   "dom": '<"top"i>rt<"bottom"flp><"clear">',
                    "bPaginate": true,
                    
                     
					"aoColumns": [
					   {"mData": "id",
						   
					       "mRender": function ( data, type, full ) {
						  		return '<span class="sub_status">'+data+'</span>';}},	
					 
					   {"mData": "name",
						   "mRender": function ( data, type, full ) {
						  		return '<span class="sub_status">'+data+'</span>';}
					   },
					   
					   {"mData": "interval", 
						"mRender": function ( data, type, full ) {
						  		return '<span class="sub_status">'+data+'</span>';}
						},
						{"mData": "amount", 
						"mRender": function ( data, type, full ) {
						  		return '<span class="sub_status">'+data*.1+'</span>';}
						},
						{"mData": "trial_period_days", 
						"mRender": function ( data, type, full ) {
						  		return '<span class="sub_status">'+data+'</span>';}
						},
					 
					   {"mData": null, 
						   "bSortable": false ,
						"mRender": function ( data, type, full ) {
						  		return '<a href="<?=SURL?>admin_settings_subscription/'+full.id+'" class="btn btn-xs red"><i class="fa fa-edit"></i> Edit  </a> <a href="#" onClick="deletePlan(\''+full.id+'\')" data-id="'+ full.id +'" class="btn btn-xs purple" id="delete_plan"> <i class="fa fa-times"></i> Delete </a>';}
						}]
						});
        
    });
    
    </script>
    

