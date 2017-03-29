<?php
	
if (isset($_GET['pram1']) && $userClass->confirmUser($_GET['pram1'])==true){


?>


<div class="row">
				<div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Confirmation Complete
                        </header>
                        <div class="panel-body">

				           <a href="<?=SURL?>">Come on in!</a>
		            
					</div>
                	</section>
    	</div>  
				<div class="col-lg-3"></div>	
   	
</div>

<?php } ?>