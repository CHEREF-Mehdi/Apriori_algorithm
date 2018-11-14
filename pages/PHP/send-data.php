<?php
    require_once('Apriori.class.php');
    
    if (isset($_POST['nbrLigne'],$_POST['nbrColone'],$_POST['support'],$_POST['confiance'])){
        $nbrL= $_POST['nbrLigne'];
        $nbrC=$_POST['nbrColone'];
        $Sup= $_POST['support'];
        $Conf=$_POST['confiance'];
        /*$str=$nbrL."--".$nbrC."--".$Sup."--".$Conf;
        echo "<script type='text/javascript'> alert('".$str."'); </script>";*/
        $Matrice=new Matrice($nbrL,$nbrC,$Sup,$Conf);
        
        $Matrice->ShowMatrice();
    }

   
?>