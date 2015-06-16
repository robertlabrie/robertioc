<?php 
require_once __DIR__."/../vendor/autoload.php";
require_once __DIR__."/SampleObject.php";
require_once __DIR__."/ObjectToMake.php";
class RobertIOCTest extends PHPUnit_Framework_TestCase
{
	protected $container = Array();
	protected $ioc;
	public function setUp()
	{
		$this->container['Sample\SampleObject'] = new \Sample\SampleObject();
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
}