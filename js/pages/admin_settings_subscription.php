
<script type="text/javascript">
$( document ).ready(function() {
	
	  var form = $('#planForm');
	  //console.log(form.serialize());
	  
	  $('#savePlan').click(function() {
		  //console.log( form.serialize() );
		    $.ajax( {
		      type: "POST",
		      url: '<?=SURL;?>methods.php?action=savePlan&token=<?=$_SESSION['token'];?>&user_id=<?=$_SESSION['user_id'];?>&plan_id=<?=issetor($_GET['pram1']);?>',
		      data: form.serialize(),
		      success: function( response ) {
		        window.location='/admin_settings_subscriptions';
					}
		    	} );
  			}); 
  			var url='<?=SURL;?>methods.php?action=getPlan&token=<?=$_SESSION['token'];?>&user_id=<?=$_SESSION['user_id'];?>&plan_id=<?=issetor($_GET['pram1']);?>';
  			
  			
  			$.getJSON(url, 'data', process_response)
  			
function process_response(response) {
        
        var i;

            // for debug

        for (i in response.data) {
            form.find('[name="' + i + '"]').val(response.data[i]);
                   }
    }



        
        <? if (isset($_GET['pram1'])){ ?>
        
        var groupsstring='';
	      	groupsstring+="<?=SURL;?>methods.php?action=getPlanUsers&token=<?=$_SESSION['token'];?>&user_id=<?=$_SESSION['user_id'];?>&plan_id=<?=$_GET['pram1'];?>";
        var grid = $("#plan_table").dataTable( {
                                    
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
					 
					   {"mData": "username",
						   "mRender": function ( data, type, full ) {
						  		return '<span class="sub_status">'+data+'</span>';}
					   },
					   
					   {"mData": "email", 
						"mRender": function ( data, type, full ) {
						  		return '<span class="sub_status">'+data+'</span>';}
						}]
						});
        
        
        <? }?>
    });
    
    
    </script>

