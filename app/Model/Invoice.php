<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function payment(){
    	return $this->belongsTo(Payment::class,'id','invoice_id'); // first id invoice model and 2nd invoice_id payment model 
    }
    public function invoice_detial(){
    	return $this->hasMany(InvoiceDetail::class,'invoice_id','id');
    }
}
