<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model {
  /**
   * Indicates if the IDs are auto-incrementing.
   *
   * @var bool
   */
  public $incrementing = false;
  protected $primary = 'id';
  protected $table = 'conversations';
  protected $fillable = ['title', 'description', 'status', 'type'];
  public function members() {
    return $this->hasMany('App\Models\ConversationMember', 'conversation_id');
  }
  public function messages() {
    return $this->hasMany('App\Models\Messages', 'conversation_id');
  }
  const ACTIVE = 1;
  const INACTIVE = 2;
  public function getStatusStrAttribute() {
    return __('conversations.status_str.' . $this->status);
  }

  const T_PRIVATE = 1;
  const T_GROUP = 2;
  const T_CHANNEL = 3;
  public function getTypeStrAttribute() {
    return __('conversations.type_str.' . $this->type);
  }
}
