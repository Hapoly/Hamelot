<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {
  /**
   * Indicates if the IDs are auto-incrementing.
   *
   * @var bool
   */
  public $incrementing = false;
  protected $primary = 'id';
  protected $table = 'messages';
  protected $fillable = ['type', 'body', 'status', 'member_id', 'conversation_id'];

  public function getTypeStrAttribute() {
    return __('messages.type_str.' . $this->type);
  }
  public function getStatusStrAttribute() {
    return __('messages.status_str.' . $this->status);
  }

  public function member() {
    return $this->belongsTo('App\Models\ConversationMember');
  }
  public function conversation() {
    return $this->belongsTo('App\Models\Conversation');
  }
}
