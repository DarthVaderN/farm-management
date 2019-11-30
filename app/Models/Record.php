<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    public static function write($operation)
    {
        Record::insert([
            'operation' => $operation,
            'add_at' => Carbon::now()->format('h:i:s')
        ]);
    }
}
