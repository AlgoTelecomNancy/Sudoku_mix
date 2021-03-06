<?php

class Cell {
  private $possibleValues;
  private $groups;
  private $indice;

  public function __construct($indice) {
    $this->indice = $indice;
  }

  public function addGroup($value) {
    $this->groups[] = $value;
  }

  public function getGroups() {
    return $this->groups;
  }

  public function removePossibleValue($value) {
    foreach($this->possibleValues as $id=>$val) {
      if($val == $value)
        unset($this->possibleValues[$id]);
    }
  }
  public function getPossibleValues() {
    return $this->possibleValues;
  }
  public function addPossibleValue($value) {
    $this->possibleValues[] = $value;
  }

  public function newValue($value) {

    $this->possibleValues = Array($value);
  }

  public function getIndice() {
    return $this->indice;
  }

}

 ?>
