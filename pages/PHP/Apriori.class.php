<?php
	ini_set('memory_limit', '1024M');
	require_once("Element.class.php");
	require_once("Rule.class.php");
	class Matrice{
		
		private $matrice;
		private $nbLingne;
		private $nbColone;
		private $support;
		public $confiance;		
		
        
		public function __construct($nc,$nl,$s,$c){
			
			$this->nbLigne=$nl;
			$this->nbColone=$nc;
			$this->support=round($s/100*$nc);
			if($this->support==0)$this->support=1;
			$this->confiance=round($c/100,2);
			
			for ($l = 0; $l<$nl; $l++) {
				for ($c = 0; $c<$nc; $c++) {
					$this->matrice[$l][$c]=rand(0,1);
				}
			}												
		}//end constructor
		
		public function getNbligne(){
			if ($this->nbLigne>0) return true;
			else return false;
		}
		
		function Multiply($a, $b){
			$r = array();
			$result=array();
			$som=0;
			for($i = 0; $i <count($a); $i ++){
				$m=$a[$i]*$b[$i];
				$som+=$m;
				array_push($r,$m);
			}
			array_push($result,$r);
			array_push($result,$som);
			return $result;
		}//end multi
		
		private function multiplyArray($array){			
			$result=$this->Multiply($this->matrice[$array[0]],$this->matrice[$array[1]]);
			for($i=2;$i<sizeof($array);$i++){
				$result=$this->Multiply($result[0],$this->matrice[$array[$i]]);
			}
			return $result;
		}
		
		public function getL1(){
			$minsup=0;
			$cpt=0;
		   $LI=[];
		   for ($l = 0; $l<$this->nbLigne; $l++){
				   $element=new Element([],$l);
				   $element->setOccurence(array_sum($this->matrice[$l]));					
				   if($element->getOccurence() >= $this->support) {
					array_push($LI,$element);
					$minsup+=$element->getOccurence();
					$cpt++;
					}
				   
		   }
		   if($cpt>0) $minsup=intval($minsup/$cpt); //echo "<script type='text/javascript'> console.log('minsup 1 ".$minsup."'); </script>";
		   $this->showItemset($LI,1);
		   return array($LI,$minsup);
		}//end LI1
		
		public function getL2($LI){
			$minsup=0;
			$cpt=0;
			$LI2=array();
			//$CI2=array();
			$Repeate=array();
			$result=array();
		   for ($i = 0; $i<count($LI)-1; $i++){
				$Repeate[$i]=0;
				$items=$LI[$i]->getItems();
				for ($j = $i+1; $j<count($LI); $j++){
					$element=new Element($items,$LI[$j]->getItems()[0]);
					$occurence=$this->Multiply($this->matrice[$i],$this->matrice[$j]);					
					$element->setMulItems($occurence[0]);
					$element->setOccurence($occurence[1]);
					
					//array_push($CI2,$element);
					if($element->getOccurence() >= $this->support) {
						$Repeate[$i]+=1;
						array_push($LI2,$element);
						$minsup+=$element->getOccurence();
						$cpt++;
					}
				}				
			}
		   //$this->showItemset($CI2,2);
		   $this->showItemset($LI2,2);
		   if($cpt>0) $minsup=intval($minsup/$cpt);
		   //echo "<script type='text/javascript'> console.log('minsup 2 ".$minsup."'); </script>";
		   array_push($result,$LI2);
		   array_push($result,$Repeate);
		   array_push($result,$minsup);
		   return $result;
		}//end LI2
		
		public function apriori(){
			
			echo '<div class="col-lg-12 ">
					<div class="panel panel-success">
						<div class="panel-heading">
								Frequent Itemsets 
							<label style="position: relative; left: 700px; color=white; ">Min support = '.$this->support.' </label>
						</div>
						<div class="panel-body MatrixJob">';
			
					
			$Rules=array();
			$AllRules=array();
			$LI=$this->getL1();			
			$LI2=$this->getL2($LI[0]);			
			$repeat1=$LI2[1];
			$repeat2;
			$LIi=array($LI,$LI2[0]);			
			$num=2;
			
			$autoMinSup=$LI[1]+$LI2[2];
			
				
			while(count($repeat1)>0){
				
				$h=0; 	$s=-1;	$repeat2=array(); array_push($LIi,array());		$minsup=0;	$cpt=0;	
				for($i=0;$i<count($repeat1);$i++){
					
					if($repeat1[$i]>1){
						
						for($j=0;$j<$repeat1[$i]-1;$j++){
							
							$items=$LIi[$num-1][$j+$h]->getItems();						
							$size=count($items)-1;
							$multiOnce=$LIi[$num-1][$j+$h]->getMulItems();							
							$new=true;
							
							for($k=$j+1;$k<$repeat1[$i];$k++){
								
								$items2=$LIi[$num-1][$k+$h]->getItems()[$size];
								$element=new Element($items,$items2);							
								$occurence=$this->Multiply($multiOnce,$this->matrice[$items2]);
								$element->setMulItems($occurence[0]);
								$element->setOccurence($occurence[1]);
								
								if($element->getOccurence() >= $this->support){
									if($new==true){										
										array_push($repeat2,1);									
										$s++;									
										$new=false;
									}else{
										$repeat2[$s]+=1;										
									}
									array_push($LIi[$num],$element);
									$minsup+=$element->getOccurence();
									$cpt++;
								}//end if $element->getOccurence() >= $this->support
								
							}//end third for
							
							$LIi[$num-1][$j+$h]->setMulItems(array());						
						}//end second for
						
					}//end if $repeat1[$i]>1
					
					$h+=$repeat1[$i];
					
				}//end first for
				
				//echo "####itemset ".($num+1)." "; print_r($repeat2);
				if(count($LIi[$num])>0) {
					$this->showItemset($LIi[$num],$num+1);
					$num++;
				}								
				$repeat1=$repeat2;			
				if($cpt>0) {
					$minsup=intval($minsup/$cpt);
					//echo "<script type='text/javascript'> console.log('minsup  ".$minsup."'); </script>";
				}
				
				$autoMinSup+=$minsup;
			}//end while
			
			echo '</div></div></div>';
			if($num-1>0) $autoMinSup=intval($autoMinSup/($num-1));
			echo "<script type='text/javascript'> console.log('auto minsup ".$autoMinSup."'); </script>";
				
			return array($LIi,$num,$autoMinSup);
			
		}//end apriori
		
		public function showRules($LIi,$num){			
			echo '<div class="panel-body ShowLIs">';
			for($i=1;$i<$num;$i++){
				echo'<div class="col-lg-6">
						<div class="panel panel-green">
							<div class="panel-heading">
								Rules of '.($i+1).'-frequent itemset ('.count($LIi[$i]).') 
							</div>';
				
				echo		'<div class="panel-body">';
				echo 			'<div class="table-responsive" style="height: 370px; width: 410px;">
									<table class="table table-striped table-bordered table-hover">
										<thead>';
				echo 						'<th>Rule</th>';
				echo 						'<th>Trust </th>';
				echo 					'</thead>
										<tbody>';
										
									for($j=0;$j<count($LIi[$i]);$j++){
										$items=$LIi[$i][$j];
										
										$this->getRules($items,$i+1);
									}
				
				echo '					</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>';
			}
			echo '</div>';
			if($this->nbLigne!=0) echo "<script type='text/javascript'> slided=true; SlideLIs=true; $(\".MatrixJob\").slideDown(); $(\".ShowLIs\").slideDown(); </script>";
			else echo "<script type='text/javascript'>slided=false; SlideLIs=false; $(\".MatrixJob\").slideUp(); $(\".ShowLIs\").slideUp(); </script>";
		}
		
		public function getRules($Element,$num){
			
			$items=$Element->getItems();
			$Rules1=array();
			
			//---------------------------- first itemset
			
			for($i=0;$i<count($items);$i++){
				$itm=$items[$i];
				$itms=$items;
				unset($itms[$i]);
				$itms = array_values($itms);
				$Rule=new SymmetricalRule(array(),$itms);
				$Rule->pushA($itm);
				//TRUST a
				
				$T_ab=round($Element->getOccurence()/array_sum($this->matrice[$itm]),2);
				if($this->confiance<=$T_ab){
					$Rule->setTrust_AB($T_ab);
				}
								
				//trust b
				if($num==2) {
					$T_ba=array_sum($this->matrice[$Rule->getB()[0]]);
					$T_ba=round($Element->getOccurence()/$T_ba,2);
				}else {
					$T_ba=$this->multiplyArray($Rule->getB());
					$T_ba=round($Element->getOccurence()/$T_ba[1],2);
				}
				
				if($this->confiance<=$T_ba){
					$Rule->setTrust_BA($T_ba);
				}
				
				$Rule->tostringTab($this->confiance);
							
				array_push($Rules1,$Rule);
			}
			
			$Rules2=array();
			$stop=false;
			
			//---------------------------- next itemset
			
			while(!$stop && $num>3){
					$deb=-1;$cptdeb=0;
					
				for($i=0;$i<count($Rules1)-1;$i++){
					$R=$Rules1[$i];									
					$cptStop=0;
					$deb++;
					
					for($j=$deb;$j<count($R->getB());$j++){
						$Rule=new SymmetricalRule($R->getA(),array());
						$itms=$R->getB();
						$itm=$itms[$j];
						unset($itms[$j]);
						$itms = array_values($itms);
						$Rule->pushA($itm);
						$Rule->setB($itms);
						
						if(count($Rule->getA())==count($Rule->getB()) && count($Rules2)>1){
							
							for($k=0;$k<count($Rule->getA());$k++){
								if($Rule->getA()[$k]!=$Rules2[count($Rules2)-1]->getB()[$k]) break;
							}
							if($k==count($Rule->getA())){								
								$stop=true;
								break;
							}
						}
						//trust a
						$T_ab=$this->multiplyArray($Rule->getA());
						$T_ab=round($Element->getOccurence()/$T_ab[1],2);
						if($this->confiance<=$T_ab){
							$Rule->setTrust_AB($T_ab);
						}
						
						//trust b
						$T_ba=$this->multiplyArray($Rule->getB());
						$T_ba=round($Element->getOccurence()/$T_ba[1],2);
						if($this->confiance<=$T_ba){
							$Rule->setTrust_BA($T_ba);
						}						
						
						$Rule->tostringTab($this->confiance);
												
						array_push($Rules2,$Rule);
						$cptStop++;
					}
					//echo "<script type='text/javascript'> console.log('$num/2 = ".round($num/2)." $cptStop'); </script>";
					if($deb==count($R->getB())){
						$cptdeb++;
						if($cptdeb==count($R->getB())) $cptdeb=0;												
						$deb=$cptdeb-1;
					}
					if( ($num==4) || ($stop==true)) {
						//echo " </br> break2 </br>";
						break;
					}
																				
				}
				
				$Rules1=$Rules2;
				$Rules2=array();
				
				if(count($Rule->getA())==intval($num/2) ) {					
					$stop=true;
					$Rules1=array();
					$Rules2=array();					
				}
								
			}
						
		}//end getRules()
		
		public function showItemset($ci,$num){
			
			echo'<div class="col-lg-4">
					<div class="panel panel-green">
						<div class="panel-heading">
							'.$num.'-Frequent Itemset ('.count($ci).')
						</div>
						<div class="panel-body">';
			echo 			'<div class="table-responsive ScrollPanels">
								<table class="table table-striped table-bordered table-hover">
									<thead>';
			echo 						'<th>ItemSet</th>';
			echo 						'<th>Suport</th>';
			echo 					'</thead>
									<tbody>';
									
			for($i=0;$i<count($ci);$i++){
				echo '<tr>';
				$ci[$i]->tostring();
				echo '</tr>';
			}
			echo '					</tbody>
								</table>
							</div>';
			echo		'</div>						
					</div>
				</div>';		
		}//END SHOW ITEMS
		
		public function ShowMatrice(){
			echo '<div class="panel-body">';
			echo'<div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Data Matrix						
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body ">
							<div class="table-responsive Scroll">
								<table class="table table-striped table-bordered table-hover">
									<thead>
										<tr>';
			for ($l = 0; $l<$this->nbLigne; $l++) {
				echo 						'<th><i class="fa">I'.$l.'</i></th>';
			}
				echo					'</tr>
									</thead>
									<tbody>';										
			
			for ($c = 0; $c<$this->nbColone; $c++) {
				echo 					'<tr>';
				for ($l = 0; $l<$this->nbLigne; $l++) {
					echo 					'<td>'.$this->matrice[$l][$c].'</td>';
				}
				echo 					'</tr>';
			}
			echo 					'</tbody>
								</table>
							</div>
						</div>                        
					</div>                    
                </div>';
			echo '</div>';
						

		}//end show matrix

		
    }//END CLASS
        
?>