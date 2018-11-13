<?php
	class Element{
		private $occurence;
		private $MulItems=array();
		private $items;
		
		public function __construct($items,$item){
			array_push($items,$item);
			$this->items=$items;						
			$this->occurence=0;
		}	
		
		public function getItems(){
			return $this->items;
		}
		
		public function getMulItems(){
			return $this->MulItems;
		}
		
		public function getOccurence(){
			return $this->occurence;
		}
		
		public function setOccurence($sup){
			$this->occurence=$sup;
		}
		
		public function setMulItems($sup){
			$this->MulItems=$sup;			
		}
		
		public function tostring(){
			echo'<td><i class="fa"> [I';
			for($i=0;$i<count($this->items)-1;$i++){
				echo $this->items[$i],',I';
			}
			echo $this->items[$i],']</i></td>';
			echo'<td> '.$this->occurence.'</td> ';			
		}
		
    }        
    
?>