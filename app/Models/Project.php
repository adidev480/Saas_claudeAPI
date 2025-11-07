<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
     protected $guarded = []; 

     public function user(): BelongsTo
     {
        return $this->belongsTo(User::class);
     }

     protected $casts = [
         'chat_history' => 'array',
     ];

     public function addChatMessage($role, $content){
      $chatHistory = $this->chat_history ?? [];
      $chatHistory[] = [
         'role' => $role,
         'content' => $content,
         'timestamp' => now()->toIso8601String(),
      ];
      $this->update(['chat_history' => $chatHistory]);
     }



}