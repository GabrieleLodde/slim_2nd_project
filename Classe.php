<?php
require_once ("Alunno.php");
class Classe{
    protected $arrayAlunni = [];

    public function __construct(){
        $A1 = new Alunno("Pippo", "Rossi", 17);
        $A2 = new Alunno("Giulio", "Verdi", 18);
        $A3 = new Alunno("Mario", "Gialli", 19);
        $A4 = new Alunno("Sergio", "Blu", 20);
        $A5 = new Alunno("Carlo", "Arancioni", 21);
        $A6 = new Alunno("Cristiano", "Viola", 22);
        $A7 = new Alunno("Matteo", "Marroni", 23);
        $A8 = new Alunno("Pietro", "Neri", 24);
        array_push($this->arrayAlunni, $A1);
        array_push($this->arrayAlunni, $A2);
        array_push($this->arrayAlunni, $A3);
        array_push($this->arrayAlunni, $A4);
        array_push($this->arrayAlunni, $A5);
        array_push($this->arrayAlunni, $A6);
        array_push($this->arrayAlunni, $A7);
        array_push($this->arrayAlunni, $A8);
    }
    
    public function getArray(){
        return $this->arrayAlunni;
    }

}

?>