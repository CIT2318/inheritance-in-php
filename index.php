<!DOCTYPE html>
<html>
<head>
	<title>Inheritance in OOP PHP</title>
</head>
<body>
<?php
/*
class ProjectManager{
	private $builder;
	private $joiner;
	private $electrician;
	function __construct($builder,$joiner)
	{
		$this->builder = $builder;
		$this->joiner = $joiner;
	}
	
	public function buildHouse()
	{
		echo "<p>".$this->builder->digFoundations()."</p>";
		echo "<p>".$this->builder->buildWalls()."</p>";
		echo "<p>".$this->joiner->makeStairs()."</p>";
		// $plumber->fitSink();
		// $electrician->fitLighting();
	}
	public function payContractors(){
		echo "<p>".$this->builder->pay()."</p>";
		echo "<p>".$this->joiner->pay()."</p>";
		// $plumber->pay();
		// $electrician->pay();
	}
	
	// function __construct()
	// {
	// 	$this->contractors = [];
	// }
	// public function hireContractor($contractor){
	// 	$this->contractors[]=$contractor;
	// }

}
*/


class ProjectManager{
	private $contractors;
	function __construct()
	{
		$this->contractors = [];
	}
	public function hireContractor($contractor){
		$this->contractors[]=$contractor;
	}
	
	public function buildHouse()
	{
		foreach($this->contractors as $contractor){
			echo "<p>".$contractor->work()."</p>";
		}
	}
	public function payContractors(){
		foreach($this->contractors as $contractor){
			echo "<p>".$contractor->pay()."</p>";
		}
	}
	
	

}

Abstract class Contractor{
	private $firstName;
	private $lastName;
	function __construct($firstName,$lastName)
	{
	 	$this->firstName = $firstName;
	 	$this->lastName = $lastName;
	}
	public function getFullName()
	{
		return $this->firstName." ".$this->lastName;
	}
	public function pay(){
		return $this->getFullName()." just got paid.";
	}
	abstract function work();
}

class Builder extends Contractor{
	public function digFoundations()
	{
		return $this->getFullName()." has dug some foundations.";
	}
	public function buildWalls()
	{
		return $this->getFullName()." has built the walls.";
	}
	public function work(){
		return $this->buildWalls()." ".$this->digFoundations();
	}
}

class Joiner extends Contractor{
	public function work()
	{
		return $this->getFullName()." has made some stairs.";
	}
}

class Electrician extends Contractor{
	public function work()
	{
		return $this->getFullName()." has fitted the lights.";
	}
}

class Plumber extends Contractor{
	public function work()
	{
		return $this->getFullName()." has fitted a sink.";
	}
}




// $builder = new Builder("Jane","Smith");
// echo "<p>".$builder->digFoundations()."</p>"; //Jane Smith has dug some foundations.

/*
Open this page in a browser. You should get the message 'Jane Smith has dug some foundations'
Add another method to the Builder class. Call it buildWalls(). This method should return a simple string stating the builder is building walls. Uncomment the following code to check this works
*/
//echo "<p>".$builder->buildWalls()."</p>"; //Jane Smith has built the walls.

/*
When you build a house you don't just need builder. Create a Joiner class. The Joiner class will need first name and last name properties and it will need to feature the getFullName(), and pay() methods just like in the Builder class. You will also need to add a makeStairs() method. makeStairs() should return a simple string stating the joiner has made some stairs. Uncomment the following code to check this works. 
*/

// $joiner = new Joiner("Imran","Iqbal");
// echo "<p>".$joiner->makeStairs()."</p>"; //Imran Iqbal has made some stairs.
// echo "<p>".$joiner->pay()."</p>"; //Imran Iqbal just got paid.

/*
Have a look at  the Builder and Joiner classes. Have a go at creating a parent class called Contractor and have Builder and Joiner inherit from Contractor. Make Contractor Abstract (we don't want to create any Contractor instances). Think what properties and methods Joiner and Builder have in common.  All the previous statements for creating instances should still work. 
*/

/*
Now uncomment the ProjectManager class. Create an instance of ProjectManager (specifying the builder and joiner as arguments when you call the constructor function). Test this works by calling the buildHouse and payContractors methods
*/

// $projectManager = new ProjectManager($builder, $joiner);
// $projectManager->buildHouse();
// $projectManager->payContractors();

/*
Create another class, call this class Electrician. It will need to inherit from the Contractor class. Add a fitLighting method it should return a string stating the electrician has fitted the lights
*/

// $electrician = new Electrician("Carla","Green");
// echo "<p>".$electrician->fitLighting()."</p>"; //Carla has made some stairs.
// echo "<p>".$electrician->pay()."</p>";

/*
Modify the ProjectManager class so that it also uses an Electrician object
*/

/*

Add an abstract method to Contractor, name it work(). Implement the work() method in Builder, Joiner and Electrician classes. Again here's some example code. Depending on how you have implemented this some of your previous code e.g. $electrician->fitLighting() might now give errors. if ti does comment out these lines. 


*/
// $builder = new Builder("Jane","Smith");
// $joiner = new Joiner("Imran","Iqbal");
// $electrician = new Electrician("Carla","Green");
// echo "<p>".$builder->work()."</p>"; //Jane Smith has dug some foundations. Jane Smith has built some walls. 
// echo "<p>".$joiner->work()."</p>"; //Imran Iqbal has made some stairs. 
// echo "<p>".$electrician->work()."</p>"; //Carla Green has fitted the lights. 

/*
Modify the project manager class The problem with this is that everytime we create a new kind of Contractor we have to make changes to the ProjectManager class (by adding extra properties, parameters etc.). It would be nice if we could add new types of Contractor without changing the ProjectManager class. Have a go at the following:

Remove the $builder, $joiner and $electrician properties from the ProjectManager class.
Replace them with a single $contractors property.
In the constructor function set $contractors to be an empty array i.e.
$contractors = [];

Add a hireContractor() method that will allow us to add elements (builder, joiner etc.) to the array e.g.

public function hireContractor($contractor){
	$this->contractors[]=$contractor;
 }

Modify the buildHouse and payContractors methods so that they user forEach loops call methods of Contractor objects e.g.

foreach($this->contractors as $contractor){
			echo "<p>".$contractor->work()."</p>";
		}

Test this works by uncommenting the following code


*/
// $builder = new Builder("Jane","Smith");
// $joiner = new Joiner("Imran","Iqbal");
// $electrician = new Electrician("Carla","Green");
// $projectManager = new ProjectManager();
// $projectManager->hireContractor($builder);
// $projectManager->hireContractor($joiner);
// $projectManager->hireContractor($electrician);
// $projectManager->buildHouse();
// $projectManager->payContractors();

/*
Finally add another child class of Contractor, name it Plumber. The work method should return a string such as plumber has fitted the sink. Modify the above code so that a plumber is also added to the project. 

IMPORTANT - Notice how we can now add a plumber and we don't have to make any changes to ProjectManager class. This is the advantage of polymorphism. 
*/
$builder = new Builder("Jane","Smith");
$joiner = new Joiner("Imran","Iqbal");
$electrician = new Electrician("Carla","Green");
$plumber = new Plumber("Clinton","Woods");
$projectManager = new ProjectManager();
$projectManager->hireContractor($builder);
$projectManager->hireContractor($joiner);
$projectManager->hireContractor($electrician);
$projectManager->hireContractor($plumber);
$projectManager->buildHouse();
$projectManager->payContractors();



?>
</body>
</html>