<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'first_name','last_name','gender','birthday','state','country','postal_code','local','street_address','city'
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
