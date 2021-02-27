<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item_pajak extends Model
{
    use HasFactory;
    protected $table = "item_pajak";
    protected $primaryKey = 'id';
    protected $fillable = ['item_id', 'pajak_id'];
}
