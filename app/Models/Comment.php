<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
class Comment extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'comments';
    protected $fillable = [
        'content',
        'user_id',
        'card_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function setcard()
    {
        return $this->belongsTo(SetCard::class);
    }

}
