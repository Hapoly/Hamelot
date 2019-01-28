<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model {
  protected $primary = 'id';
  protected $table = 'conversations';
  protected $fillable = ['title', 'description', 'status'];
  public function members() {
    return $this->hasMany('App\Models\ConversationMember', 'conversation_id');
  }
  public function messages() {
    return $this->hasMany('App\Models\Messages', 'conversation_id');
  }
  const ACTIVE = 1;
  const INACTIVE = 2;
  public function getStatusStrAttribute(){
    return __('conversations.status_str.' . $this->status); 
  }
}
