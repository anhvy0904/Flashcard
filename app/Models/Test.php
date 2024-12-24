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
        'setcard_id',
        

    ];
    public function testdetails()
    {
        return $this->hasMany(TestDetail::class);
    }
    public function testResults()
    {
        return $this->hasOne(TestResult::class);
    }
    public function setcard()
    {
        return $this->belongsTo(SetCard::class);
    }
}
