<?php
  include("Cell.php");
  include("Group.php");
  $string = file_get_contents("data.json");
  $data = json_decode($string, true);

  $cells = array();
  for($i=1;$i<=$data["elements"]["nbcells"];$i++){
  	$cells[$i] = new Cell($i);
  	
  	for($j=1;$j<=$data["elements"]["maximum"];$j++){
  		$cells[$i]->addPossibleValue($j);
  	}
  	
  }
  
  $groups = array();
  for($i=1;$i<=$data["elements"]["nbgroups"];$i++){
  	
  	$groups[$i] = new Group($i);
  	
  	foreach(explode(" ",$data["elements"]["groups"][$i-1]) as $group_element){
  		
	  	$cells[$group_element]->addGroup($i);
	  	$groups[$i]->addCell($group_element);
	  	
  	}
  	
  }
  
  
  
?>
