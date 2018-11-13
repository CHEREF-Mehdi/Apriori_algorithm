<?php
    
    if(isset($_POST['menu'])){
        
        if($_POST['menu']==0){
            
            echo '  <div class="col-lg-8 btn-accueil">
                        <div class="panel">                                            
                            <div class="panel-body">
                                <p>            
                                    <button type="button" onclick="resetForm();" class="btn btn-success btn-lg btn-block"  data-toggle="modal" data-target="#NewDataModal">Introduire les données</button>
                                </p>
                            </div><!-- /.panel-body -->                        
                        </div>
                    </div>';
            
        }
        
    }        
    
?>