<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];

    public function customer() { return $this->belongsTo(Customer::class); }
    public function pet()      { return $this->belongsTo(Pet::class); }
    public function staff()    { return $this->belongsTo(Staff::class); }
    public function details()  { return $this->hasMany(TransactionDetail::class); }
}
