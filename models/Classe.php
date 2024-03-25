<?php

class Classe implements JsonSerializable{
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

        $this->addAlunno($A1);
        $this->addAlunno($A2);
        $this->addAlunno($A3);
        $this->addAlunno($A4);
        $this->addAlunno($A5);
        $this->addAlunno($A6);
        $this->addAlunno($A7);
        $this->addAlunno($A8);
    }
    
    public function getArray(){
        return $this->arrayAlunni;
    }

    public function findByName($name){
        $alunno = null;
        foreach($this->arrayAlunni as $alunno_array){
            if(strtolower($alunno_array->getNome()) == strtolower($name)){
                $alunno = $alunno_array;
            }

        }
        return $alunno;
    }

    public function jsonSerialize() {
        $attrs = [];
        $class_vars = get_class_vars(get_class($this));
        foreach ($class_vars as $name => $value) {
            $attrs[$name]=$this->{$name};
        }
        return $attrs;
    }

    public function addAlunno($alunno){
        array_push($this->arrayAlunni, $alunno);
    }

    public function modifyAlunno($alunno_passed, $id){
        if(!isset($this->arrayAlunni[$id])){
            return null;
        }
        $this->arrayAlunni[$id]->setNome($alunno_passed->getNome());
        $this->arrayAlunni[$id]->setCognome($alunno_passed->getCognome());
        $this->arrayAlunni[$id]->setEta($alunno_passed->getEta());
        return $this->arrayAlunni[$id];
    }

    public function deleteAlunno($id){
        if(isset($this->arrayAlunni[$id])){
            unset($this->$arrayAlunni[$id]);
            return $this->arrayAlunni;
        }
        return false;
    }
}

?>