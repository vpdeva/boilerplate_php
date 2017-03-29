   			
   			</div>
   		  </div>
        </div> 
      </div>
    </div>
 
 <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  
    <script src="<?=SURL;?>js/bootstrap.js"></script>
    <script src="<?=SURL;?>js/jquery.dataTables.js"></script>
    <script src="<?=SURL;?>js/select2.js"></script>
    <script src="<?=SURL;?>js/jquery.gritter.js"></script>
    <script src="<?=SURL;?>js/bootstrapValidator-min.js"></script>
    <script src="<?=SURL;?>js/bootstrap-formhelpers-min.js"></script>
 <?php

	
	
	
	if(file_exists('js/pages/'.$pg_name.'.php')){
		include('js/pages/'.$pg_name.'.php');
		} 

?>
  </body>
</html>
