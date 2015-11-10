<?php

class Group {
  private $cells;
  private $indice;

  public function __construct($indice) {
    $this->indice = $indice;
  }

  public function addCell($value) {
    $this->cells[] = $value;
  }

  public function getCells() {
    return $this->cells;
  }

  public function getIndice() {
    return $this->indice;
  }

}

 ?>
