<?php 
namespace Sample;
class ExpectsMongo
{
	public $mongo;
	public function __construct(\MongoClient $mongo)
	{
		$this->mongo = $mongo;
	}
}