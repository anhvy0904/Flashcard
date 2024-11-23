<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Card extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'cards';
    protected $fillable = [
        'question',
        'answer',
        'image',
        'set_card_id',
    ];
    public function setCard()
    {
        return $this->belongsTo(SetCard::class);
    }
}
