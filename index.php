<?php

include("readFile.php");

function searchSolution($groups,$cells,$cell_mofified_id,$cell_newvalue){
	
	
	
	//Si a bien modifié quelque chose
	if($cell_mofified_id!=-1){
		//Pour tout les groupes liés, supprimer la valeur possible
		foreach($cells[$cell_mofified_id]->getGroups() as $cell_group_id){
			foreach($groups[$cell_group_id]->getCells() as $cell_to_modify_id){
				$cells[$cell_to_modify_id]->removePossibleValue($cell_newvalue);
			}
		}
		
		//Definir la valeur de la case choisie précédemment
		$ans_cell = $cells[$cell_mofified_id];
		$cells[$cell_mofified_id]->newValue($cell_newvalue);
		
		
		
	}
	

	$fini = 1;
	//Lancer les prochains chemins
	foreach($cells as $cell){
		
		//Si on a plus d'une possibilité
		if(count($cell->getPossibleValues())>1){
			
			$fini = 0;
			//On relance le prog
			foreach($cell->getPossibleValues() as $cell_newValue){
				
				
				searchSolution($groups,$cells,$cell->getIndice(),$cell_newValue);
			}
			
		}
		if(count($cell->getPossibleValues())==0){
			$fini = 0;
		}
		
	}
	
	
	if($fini==1){
		foreach($cells as $cell){
			echo $cell->getIndice()." => ".implode(" ",$cell->getPossibleValues())." <br>";
		}
		
	}
	
	//On remet comme c'était
	if($cell_mofified_id!=-1){
		//Pour tout les groupes liés, supprimer la valeur possible
		foreach($cells[$cell_mofified_id]->getGroups() as $cell_group_id){
			foreach($groups[$cell_group_id]->getCells() as $cell_to_modify_id){
				$cells[$cell_to_modify_id]->addPossibleValue($cell_newvalue);
			}
		}
		
		//Remetre les valeurs d'avant
		$cells[$cell_mofified_id] = $ans_cell;
		
		
		
	}
	
}

searchSolution($groups,$cells,-1,0);


?>