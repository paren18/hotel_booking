<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model {
    protected $fillable = ['client_id', 'room_id', 'start_date', 'end_date'];

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function room() {
        return $this->belongsTo(Room::class);
    }
}
