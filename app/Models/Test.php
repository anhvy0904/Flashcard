<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Test extends Model
{
    use HasFactory,Notifiable;
    protected $table = 'tests';
    protected $fillable = [
        'set_card_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function cards()
    {
        return $this->hasMany(Card::class);
    }
}
