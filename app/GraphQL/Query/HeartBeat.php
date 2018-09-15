<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class HeartBeat extends Query{
	protected $attributes = [
		'name' => 'heartbeat',
		'description'	=> 'returns a heartbeat from server. it\'s usefull when client want\'s to checkout if server is cool and running. then requesting other apis'
	];

	public function type(){
		return GraphQL::type('HeartBeat');
	}

	public function resolve($root, $args){
		return [
			'ok'		=> true,
			'time'	=> time(),
		];
	}
}