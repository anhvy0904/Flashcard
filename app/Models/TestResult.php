<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'test_results';
    protected $fillable = [
        'test_id',
        'user_id',
        'score',
    ];
    public function test()
    {
        return $this->belongsTo(Test::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
