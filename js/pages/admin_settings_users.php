<script type="text/javascript">
	
	
	
  			 function deleteUser(id){
	  		 console.log("x:"+id);

	  		 $.ajax( {
		      type: "POST",
		      url: '<?=SURL;?>methods.php?action=deleteUser&token=<?=$_SESSION['token'];?>&user_id='+id,
		      data: "",
		      success: function( response ) {
		        window.location='/admin_settings_users';
					}
		    	} );
  		}



$( document ).ready(function() {



	  
	
   function gostring(){
	   					var urlstring='';
	                    urlstring+="<?=SURL;?>methods.php?action=listUsers&token=<?=$_SESSION['token'];?>&user_id=<?=$_SESSION['user_id'];?>";
	                    grid.api().ajax.url(urlstring).load();
						}
		
						var urlstring='';
	                    urlstring+="<?=SURL;?>methods.php?action=listUsers&token=<?=$_SESSION['token'];?>&user_id=<?=$_SESSION['user_id'];?>";
	                    						
						
        var grid = $("#users_table").dataTable( {
                                    
                    "aLengthMenu": [
                        [20, 50, 100, 150, -1],
                        [20, 50, 100, 150, "All"] // change per page values here
                    ],
                    "scrollY":        "400px",
                    "iDisplayLength": 50, // default record count per page
                    "sAjaxSource": urlstring,
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
					   /*{"mData": "date_added",
						  "mRender": function ( data, type, full ) {
						  		return '<span class="sub_status">'+data+'</span>';}  		 
					   },*/
					  
					   {"mData": 'email', 
						"mRender": function ( data, type, full ) {
						  		return '<span class="sub_status">'+data+'</span>';}
						},
					   {"mData": "status", 
						"mRender": function ( data, type, full ) {
							var out;
							 if (data=='1') out='Active'; else out='Inactive';
						  		return '<span class="sub_status">'+out+'</span>';}
						},
				
					 
					   {"mData": null, 
						   "bSortable": false ,
						"mRender": function ( data, type, full ) {
						  		return '<a href="<?=SURL?>edit-profile/'+full.id+'" class="btn btn-xs red"><i class="fa fa-edit"></i> Edit  </a> <a href="#" onClick="deleteUser(\''+full.id+'\')" class="btn btn-xs purple" > <i class="fa fa-times"></i> Delete </a>';}
						}],
						
						"initComplete": function(settings, json) {
						var timeoutid = 0;
						$("#users_table").mousemove(function() {
						clearTimeout(timeoutid);
						timeoutid = setTimeout(gostring, 10000);
						});
						
						}

         
	

    });
        
        
        

        
    });

</script>