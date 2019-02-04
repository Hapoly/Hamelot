<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConversationMember extends Model {
  /**
   * Indicates if the IDs are auto-incrementing.
   *
   * @var bool
   */
  public $incrementing = false;
  protected $primary = 'id';
  protected $table = 'conversation_members';
  protected $fillable = ['user_id', 'conversation_id', 'status', 'last_online', 'status'];

  public function user() {
    return $this->belongsTo('App\Models\User', 'user_id');
  }
  public function conversation() {
    return $this->belongsTo('App\Models\User', 'conversation_id');
  }
  public function getStatusStrAttribute() {
    return __('conversation_members.status_str' . $this->status);
  }
}
