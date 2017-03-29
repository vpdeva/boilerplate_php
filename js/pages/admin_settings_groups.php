<script type="text/javascript">
	
	
  			 function deleteGroup(id){
	  		 console.log("x:"+id);

	  		 $.ajax( {
		      type: "POST",
		      url: '<?=SURL;?>methods.php?action=deleteGroup&token=<?=$_SESSION['token'];?>&group_id='+id,
		      data: "",
		      success: function( response ) {
		        window.location='/admin_settings_groups';
					}
		    	} );
  		}



$( document ).ready(function() {

        
        
        
        var groupsstring='';
	      	groupsstring+="<?=SURL;?>methods.php?action=getGroups&token=<?=$_SESSION['token'];?>";
        var grid = $("#groups_table").dataTable( {
                                    
                    "aLengthMenu": [
                        [20, 50, 100, 150, -1],
                        [20, 50, 100, 150, "All"] // change per page values here
                    ],
                    "scrollY":        "400px",
                    "iDisplayLength": 50, // default record count per page
                    "sAjaxSource": groupsstring,
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
					 
					   {"mData": "title",
						   "mRender": function ( data, type, full ) {
						  		return '<span class="sub_status">'+data+'</span>';}
					   },
					   
					  
				
					 
					   {"mData": null, 
						   "bSortable": false ,
						"mRender": function ( data, type, full ) {
						  		return '<a href="<?=SURL?>admin_settings_group/'+full.id+'" class="btn btn-xs red"><i class="fa fa-edit"></i> Edit  </a> <a href="#" onClick="deleteGroup(\''+full.id+'\')" class="btn btn-xs purple" > <i class="fa fa-times"></i> Delete </a>';}
						}]
						});
        
    });
    
    </script>
    

