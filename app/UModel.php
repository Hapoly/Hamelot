<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;


class UModel extends Model{
    public function save(array $options = []){
        if(!$this->id)
            $this->id = Uuid::generate()->string;
        parent::save($options);
    }
}
