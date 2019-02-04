<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use URL;
use App\Http\Requests\Chat\CreateConversationGroup as CreateGroupRequest;

use App\Models\Conversation;
use App\Models\ConversationMember;
use App\Models\ConversationMessage;

class Conversations extends Controller {
  public function createGroup(CreateConversationRequest $reqest){
    $conversation = Conversation::create([
      'title' => $reqest->title,
      'description' => $reqest->description,
      'type' => Conversation::T_GROUP,
    ]);
    return $conversation;
  }
}
