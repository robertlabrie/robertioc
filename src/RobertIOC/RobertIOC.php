<?php 
namespace RobertIOC;
class RobertIOC
{
	private $container;
	
	public function __construct($container)
	{
		$this->container = $container;
	}
	public function instantiate($class)
	{
		$rc = new \ReflectionClass($class);
		$arguments = Array();
		$parameters = $rc->getConstructor()->getParameters();
		foreach ($parameters as $p)
		{
			array_push($arguments,$this->container[$p->getClass()->name]);
		}
		return $rc->newInstanceArgs($arguments);
	}
}



	/*
foreach ($classes as $class)
{
	//...all the classes in the monitors namespace
	$class = str_replace(".php","",$class);
	$rc = new ReflectionClass("Monitor\\$class");
	if ($rc->isInterface()) { continue; }
	if ($rc->implementsInterface('Monitor\IMonitorSomething')) {
		//that implement IMonitorSomething
		$arguments = Array();
		$parameters = $rc->getConstructor()->getParameters();
		foreach ($parameters as $p)
		{
			//for all the parameters of the class constructor pack an array
			//with an instance of that type from the app service locator
			array_push($arguments,$app[$p->getClass()->name]);
		}
		
		//attach an instance of the object to the service locator with the
		//arguments from above
		$app[$class] = function ($app) use ($arguments, $rc) {
			return $rc->newInstanceArgs($arguments);
		};
		
		//this gets used later when scannning and invoking the monitors
		array_push($monitors,$class);
	}
}	
*/