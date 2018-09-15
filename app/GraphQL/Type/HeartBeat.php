<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class HeartBeat extends GraphQLType{
	protected $attributes = [
		'name' => 'HearBeat',
		'description' => 'heart beat result'
	];

	public function fields(){
		return [
			'ok' => [
				'type' => Type::nonNull(Type::boolean()),
				'description' => "if result was true, then server is ok"
			],
			'time' => [
				'type' => Type::nonNull(Type::int()),
				'description' => 'timestamp of server'
			],
		];
	}
}