<?php
  include("Cell.php");
  include("Group.php");
  
  function ajoutervaleurfixee($cells,$groups,$cell_mofified_id,$cell_newvalue){
  	
  		//Pour tout les groupes liés, supprimer la valeur possible
		foreach($cells[$cell_mofified_id]->getGroups() as $cell_group_id){
			foreach($groups[$cell_group_id]->getCells() as $cell_to_modify_id){
				$cells[$cell_to_modify_id]->removePossibleValue($cell_newvalue);
			}
		}
		
		//Definir la valeur de la case choisie précédemment
		$cells[$cell_mofified_id]->newValue($cell_newvalue);

  }
  
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
  
  for($i=0;$i<count($data["elements"]["predefined"]);$i++){
  	
  	$predefined = explode(" ",$data["elements"]["predefined"][$i]);
  	  	
  	ajoutervaleurfixee($cells,$groups,$predefined[0],$predefined[1]);
  	
  }
  
  
  
?>
