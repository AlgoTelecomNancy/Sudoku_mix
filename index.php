<?php

include("readFile.php");

function searchSolution($groups,$cells,$cell_mofified_id,$cell_newvalue){
	
	//Si a bien modifié quelque chose
	if($cell_mofified_id!=-1){
		//Definir la valeur de la case choisie précédemment
		$cells[$cell_mofified_id]->newValue($cell_newvalue);
		//Pour tout les groupes liés, supprimer la valeur possible
		foreach($cells[$cell_mofified_id]->getGroups() as $cell_group_id){
			foreach($groups[$cell_group_id]->getCells() as $cell_to_modify_id){
				$cells[$cell_to_modify_id]->removePossibleValue($cell_newvalue);
			}
		}
	}
	
	
	//Lancer les prochains chemins
	foreach($cells as $cell){
		
		//Si on a plus d'une possibilité
		if(count($cell->getPossibleValue())>1){
			
			//On relance le prog
			foreach($cell->getPossibleValue() as $cell_newValue){
				searchSolution($groups,$cells,$cell->getIndice(),$cell_newValue);
			}
			
		}
		
	}
	
	foreach($cells as $cell){
		echo $cell->getIndice()." => ".$cell->getPossibleValue()[0]." <br>";
	}
	
}

searchSolution($groups,$cells,-1,0);

?>