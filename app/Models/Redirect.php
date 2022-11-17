<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Redirect extends Model
{
    use HasFactory;

    public function ticket() : Relation
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user() : Relation
    {
        return $this->belongsTo(User::class);
    }
}
