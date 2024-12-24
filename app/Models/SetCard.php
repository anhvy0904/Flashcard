<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class SetCard extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'set_cards';
    protected $fillable = [
        'title',
        'description',
        'image',
        'user_id',
        'views',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function cards()
    {
        return $this->hasMany(Card::class, 'setcard_id');
    }
    public function tests()
    {
        return $this->hasMany(Test::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
