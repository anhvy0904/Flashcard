<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class TestDetail extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'test_details';
    protected $fillable = [
        'test_id',
        'card_id',
        'user_answer',
    ];
    public function test()
    {
        return $this->belongsTo(Test::class);
    }
    public function card()
    {
        return $this->belongsTo(Card::class);
    }
}
