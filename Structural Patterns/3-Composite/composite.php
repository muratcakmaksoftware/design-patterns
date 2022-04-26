<?php

enum Position {
    case MANAGER;
    case TEAM_LEADER;
    case BACKEND_TEAM_LEADER;
    case FRONTEND_TEAM_LEADER;
    case DEVELOPER;
    case TESTER;
    case DESIGNER;
    case ANALYST;
}

//Component(Bileşen) // Özelliğe ait gerekli olan fonksiyonlar ve bilgiler tutulur.
abstract class Employee
{
    protected Position $position;
    protected string $name;
    protected int $salary;

    public abstract function getSalary();
}

//Composite //Ağacın dalı(branch) olarak temsil etmekdir. Ağacın yapraklarıyla alakalı toplu işler burada yapılır.
class EmployeeComposite extends Employee
{
    private $children = [];

    public function __construct(Position $position, $name, $salary) //Parent için özelleştirme
    {
        $this->position = $position;
        $this->name = $name;
        $this->salary = $salary;
    }

    public function addChild(Employee $employee)
    {
        $this->children[] = $employee;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function getSalary()
    {
        return $this->salary;
    }
}

//Leaf //Ağacın yapraklarını temsil etmektedir. Temel işler burada yapılır.
class EmployeeLeaf extends Employee
{
    //Eklenmesi zorunlu değildir, EmployeeComposite deki constructor görecektir.
    public function __construct(Position $position, $name, $salary) //Child için özelleştirme
    {
        $this->position = $position;
        $this->name = $name;
        $this->salary = $salary;
    }

    public function getSalary()
    {
        return $this->salary;
    }
}

//Manager - Ağaç(Tree)
$managerComposite = new EmployeeComposite(Position::MANAGER, 'Murat', 30000); //Parent

//Backend Team Leader - Dal(Branch)
$backendTeamLeaderComposite = new EmployeeComposite(Position::BACKEND_TEAM_LEADER, 'Ahmet', 15000); //Parent
$managerComposite->addChild($backendTeamLeaderComposite);

//Developer - Dal'ın yaprakları(Leaf)
$backendTeamLeaderComposite->addChild(new EmployeeLeaf(Position::DEVELOPER, 'Mehmet', 9000)); //Child
$backendTeamLeaderComposite->addChild(new EmployeeLeaf(Position::DEVELOPER, 'Kerem', 9000)); //Child

echo '<pre>';
print_r($managerComposite);
echo '</pre>';

//OUTPUT:
//EmployeeComposite Object
//(
//    [position:protected] => Position Enum
//        (
//            [name] => MANAGER
//        )
//
//    [name:protected] => Murat
//    [salary:protected] => 30000
//    [children:EmployeeComposite:private] => Array
//        (
//            [0] => EmployeeComposite Object
//                (
//                    [position:protected] => Position Enum
//                        (
//                            [name] => BACKEND_TEAM_LEADER
//                        )
//
//                    [name:protected] => Ahmet
//                    [salary:protected] => 15000
//                    [children:EmployeeComposite:private] => Array
//                        (
//                            [0] => EmployeeLeaf Object
//                                (
//                                    [position:protected] => Position Enum
//                                        (
//                                            [name] => DEVELOPER
//                                        )
//
//                                    [name:protected] => Mehmet
//                                    [salary:protected] => 9000
//                                )
//
//                            [1] => EmployeeLeaf Object
//                                (
//                                    [position:protected] => Position Enum
//                                        (
//                                            [name] => DEVELOPER
//                                        )
//
//                                    [name:protected] => Kerem
//                                    [salary:protected] => 9000
//                                )
//
//                        )
//
//                )
//
//        )
//
//)