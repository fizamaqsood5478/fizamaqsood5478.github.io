<?php
// Define the Student class
class Student {
    public $RollNo;
    public $Name;
    public $Branch;
    public $Year;

    // Constructor to initialize attributes
    public function __construct($rollNo, $name, $branch, $year) {
        $this->RollNo = $rollNo;
        $this->Name = $name;
        $this->Branch = $branch;
        $this->Year = $year;
    }
}
?>
