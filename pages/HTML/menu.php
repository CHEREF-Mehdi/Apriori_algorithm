<?php
error_reporting(0);
require_once("../PHP/Element.class.php");
require_once("../PHP/Apriori.class.php");
require_once("../PHP/Rule.class.php");
set_time_limit(0);
$nbrL= $_POST['nbrLigne'];
$nbrC=$_POST['nbrColone'];
$Sup= $_POST['Support'];
$Conf=$_POST['confiance'];

    //$str=$nbrL."--".$nbrC."--".$Sup."--".$Conf;
                            
    $Matrice=new Matrice($nbrL,$nbrC,$Sup,$Conf);
    
    
?>

<!DOCTYPE html>
<html lang="fr">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Data-Mining</title>

        <!-- Bootstrap Core CSS -->
        <link href="../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="../../dist/css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="../../bower_components/morrisjs/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        
        <!-- My Style -->
        <link href="../CSS/style.css" rel="stylesheet" type="text/css">
        
         <!-- jQuery -->
    <script src="../../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>
    
    <!-- achat JavaScript -->
    <script src="../JS/menu.js"></script>
    
    <!-- js confirm -->
    <script src="../JS/dialog.js"></script>

    </head>
    <body>
        <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Data-Mining : "APRIORI" Algorithm.</a>
            </div>
            <!-- /.navbar-header -->
            
            
            <div class="navbar-default sidebar" role="navigation" style="position: fixed!important;">
                <div class="sidebar-nav navbar-collapse">
                    
                    <ul class="nav" id="side-menu">
                            <li class="sidebar-search">
                                 <div class="row">
                                        <div class="row">
                                        <div class="col-lg-12">
                                            <div class="panel-body">
                                                <a class="navbar-brand" href="#"> <p id="title_alias"></p></a><hr/>
                                            </div>
                                        </div>
                                        </div>
                                    </div>                           
                            </li>
                                 
                            <li>
                                    <a href="#" id="menu_stat" onclick="resetForm();" data-toggle="modal" data-target="#NewDataModal"> <i class="fa fa-bar-chart-o"> </i> New Data<span class="fa arrow"></span></a>
                                   
                            </li>
                            
                            <li>
                                    <a id="MatrixJShow"> <i class="fa fa-bar-chart-o"> </i> Frequent Itemsets<span class="fa arrow"></span></a>
                                   
                            </li>
                            
                            <li>
                                    <a  id="ShowLIS"> <i class="fa fa-bar-chart-o"> </i> Rules<span class="fa arrow"></span></a>
                                   
                            </li>
                                                                            
                            
                    </ul>
                    
                </div>
                
            </div>
            
        </nav>       
        <div id="excute_script"></div>
		
		<script type='text/javascript'>
                function resetForm(){
                        $("#Submit-Data").attr("data-dismiss","");
                        document.getElementById("nbrLigne").value="";
                        document.getElementById("nbrColone").value="";
                        document.getElementById("Support").value="";
                        document.getElementById("confiance").value="";                       
                    }
        </script>
        
        <div id="page-wrapper">
            <div class="panel-body">
                <div id="IntroDonnees">                        
                    <?php
                                
                            $Matrice->ShowMatrice();  							
        
                    ?>
                    <div class="col-lg-12" >
                        <div class="alert alert-danger hidden" id="Autominsup">
                            <label style="position: relative; left: 350px; color=white;" id="LabelAutominsup"> </label>
                        </div>
                    </div>
                    <?php
                    
                            $old=time();
                            $LI=$Matrice->apriori();
                            $new=time()-$old;
                            
                            echo "<script type='text/javascript'> console.log('time generating frequent itemset =".$new."'); </script>";
                            echo "<script type='text/javascript'> autoMin=",$LI[2],"; ShowAUtoMinsup(autoMin); </script>";
							
                    ?>
                </div>
                
                <div id="rules">
                    
                    <div class="col-lg-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Rules <?php echo'<label style="position: relative; left: 765px; color=white; ">Min Confiance = '.($Matrice->confiance*100).' </label>'; ?>
                            </div>
                            
                                <?php
                                    $old=time();
                                        $Matrice->showRules($LI[0],$LI[1]); 
                                    $new=time()-$old;
			
                                    echo "<script type='text/javascript'> console.log('time generating rules =".$new."'); </script>";
                                                                                                              
                                ?>
                            
                        </div>
                    </div>
                    
                </div> 
            
			
			<!-- Modal -->
        <div class="modal fade" id="NewDataModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header header-mystyle">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">New Data</h4>
                    </div>
                    <form  name="New_data_form" method="POST" action="menu.php" >
                        <div class="modal-body">                                                        
                                <div class="form-group">
                                    
                                    <div class="form-group" id="div_nbrLigne">
                                        <label class="control-label" for="nbrLigne">Instance/Trasaction/Rows</label>
                                        <input type="number" step="any" min="1"  class="form-control" id="nbrLigne" name="nbrLigne" placeholder="0,00" required="true"/>
                                    </div>
                                    
                                    <div class="form-group" id="div_nbrcolone">
                                        <label class="control-label" for="nbrColone">Items/Columns</label>
                                        <input type="number" step="any" min="1"  class="form-control" id="nbrColone" name="nbrColone" placeholder="0,00" required="true"/>
                                    </div>
                                    
                                    <div class="form-group" id="div_support">
                                        <label class="control-label" for="Support">Min support %</label>
                                        <input type="number" step="any" min="0" max="100" class="form-control" name="Support" id="Support" placeholder="0,00 %" required="true"/>
                                    </div>
                                    
                                    <div class="form-group" id="div_confiance">
                                        <label class="control-label" for="confiance">Min trust %</label>
                                        <input type="number" step="any" min="0" max="100" class="form-control" name="confiance" id="confiance" placeholder="0,00 %" required="true"/>
                                    </div>
                                    
                                </div>                                                                                                                                                                            
                        </div>
                        <div class="modal-footer footer-mystyle">                        
                            <button type="submit"  id="Submit-Data" class="btn btn-success">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">cancel</button>
                        </div>
                     </form>
                </div><!-- /.modal-content -->                
            </div><!-- /.modal-dialog -->            
        </div> <!-- /.Modal -->
        
    </div>
			
            </div>
        </div> <!-- /.page-wrapper -->                     
    
    </body>
</html>