<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatId extends Model
{
    protected $fillable = [
        'from_id',
        'to_id',
    ];
    public function from()
    {
        return $this->belongsTo(User::class, 'from_id');
    }
    public function to()
    {
        return $this->belongsTo(User::class, 'to_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'chat_id');
    }
}
