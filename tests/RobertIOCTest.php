<?php 
require_once __DIR__."/../vendor/autoload.php";
require_once __DIR__."/SampleObject.php";
require_once __DIR__."/ObjectToMake.php";
require_once __DIR__."/ExpectsException.php";
require_once __DIR__."/ExpectsMongo.php";

class RobertIOCTest extends PHPUnit_Framework_TestCase
{
	protected $container = Array();
	protected $ioc;
	public function setUp()
	{
		$this->container['Sample\SampleObject'] = new \Sample\SampleObject();
		$this->container['Exception'] = new \Exception('foo');
		$this->container['MongoClient'] = new \MongoClient();
		$this->ioc = new \RobertIOC\RobertIOC($this->container);
	}
	public function testObjectToMake()
	{
		$o = new \Sample\ObjectToMake(new \Sample\SampleObject());
		$this->assertEquals(get_class($o),'Sample\ObjectToMake');
	}
	public function testInstantiateExists()
	{
		$o = $this->ioc->instantiate('Sample\ObjectToMake');
		$this->assertEquals(get_class($o),'Sample\ObjectToMake');
	}
	/**
	 * @expectedException ReflectionException
	 * @expectedExceptionMessage Class Sample\GoingToFail does not exist
	 */
	public function testInstantiateNotExists()
	{
		$o = $this->ioc->instantiate('Sample\GoingToFail');
	}
	
	public function testInstantiatePredefined()
	{
		$o = $this->ioc->instantiate('Sample\ExpectsException');
	}
	public function testInstantiateMongo()
	{
		$o = $this->ioc->instantiate('Sample\ExpectsMongo');
		$this->assertEquals(get_class($o->mongo),"MongoClient");
	}

}