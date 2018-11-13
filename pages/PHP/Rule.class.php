<?php
    class SymmetricalRule{
        private $A=array();
        private $B=array();
        private $Trust_AB;
        private $Trust_BA;
        private $AB=false;
        private $BA=false;
        
        public function __construct($a,$b){			
			$this->A=$a;						
			$this->B=$b;
            $this->Trust_AB=0;
            $this->Trust_BA=0;
		}
        
        public function setTrust_AB($T_ab){
            $this->Trust_AB=$T_ab;
            $this->AB=true;
        }
        
        public function setTrust_BA($T_ba){
            $this->Trust_BA=$T_ba;
            $this->BA=true;
        }
        
        public function getA(){
            return $this->A;
        }
        
        public function getB(){
            return $this->B;
        }
        
        public function pushA($itm){
            array_push($this->A,$itm);
        }
        
        public function setA($array){
            $this->A=$array;
        }
        
        public function pushB($itm){
            array_push($this->B,$itm);
        }
        
        public function setB($array){
            $this->B=$array;
        }
        
        /*public function ToString(){
            $STRING;
            echo $this->A[0];
            for($i=1;$i<count($this->A);$i++){
                echo ','.$this->A[$i];
            }
            if($this->BA) echo ' <'; echo ' == '; if($this->AB) echo '> ';
            echo $this->B[0];
            for($i=1;$i<count($this->B);$i++){
                echo ','.$this->B[$i];
            }
            echo "\t".$this->Trust_AB." -- ".$this->Trust_BA;
        }*/
		
		public function tostringTab($minconf){
			
			if($this->Trust_AB>=$minconf){
				echo '<tr>';
				echo'<td><i class="fa">[I'.$this->A[0];
				for($i=1;$i<count($this->A);$i++){
					echo ','.$this->A[$i];
				}
				echo'] ';
				echo '<i class="fa fa-arrow-right"></i>';				
				echo ' [I'.$this->B[0];
				for($i=1;$i<count($this->B);$i++){
					echo ',I'.$this->B[$i];
				}
				echo ']</i></td>';
				echo'<td>'.($this->Trust_AB*100).'% </td>';
				echo '</tr>';
			}			
			
			if($this->Trust_BA>=$minconf){
				echo '<tr>';					
					echo '<td><i class="fa">[I'.$this->B[0];
					for($i=1;$i<count($this->B);$i++){
						echo ',I'.$this->B[$i];
					}
					echo'] ';
					echo '<i class="fa fa-arrow-right"></i>';
					echo' [I'.$this->A[0];
					for($i=1;$i<count($this->A);$i++){
						echo ',I'.$this->A[$i];
					}
					echo ']</i></td>';
					echo'<td>'.($this->Trust_BA*100).'% </td>';
				echo '</tr>';
			}
												
		}
                
        
    }
?>