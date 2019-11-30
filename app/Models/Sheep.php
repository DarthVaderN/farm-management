<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sheep extends Model
{
    const NumberToReproduce = 2;
    const MinYard = 1;
    const MaxYard = 4;
    const ActionAdd = 'addSheep';
    const ActionKill = 'killSheep';

    public static function add($yard)
    {
        $id = false;
        if ( abs($yard) > 0 ) {
            $id = Sheep::insertGetId(['yard' => $yard]);
            Record::write(Sheep::ActionAdd);
        }
        return $id;
    }

    public static function isYardEmpty()
    {
        $sheep = Sheep::latest()->first();

        return empty($sheep->id);
    }

    public static function killOneSheep($yard = false)
    {
        if ( abs($yard) > 0 ) {
            $sheep = Sheep::where([['yard', '=', $yard], ['active', '=', '1']])->first();
        } else {
            $sheep = Sheep::select('id', DB::raw('COUNT(id) as my'))->where('active', '1')->groupBy('yard')->havingRaw('COUNT(id) > 1')->inRandomOrder()->first();
        }

        if ( !empty($sheep->id) ) {
            Sheep::where('id', $sheep->id)->update(['active' => 0]);
            Record::write(Sheep::ActionKill);
        }

        return empty($sheep->id) ? 0 : $sheep->id;

    }

    public static function checkYard()
    {
        $yardList = [];
        for ( $i = Sheep::MinYard; $i <= Sheep::MaxYard; $i++ ) {
            $yardList[$i] = Sheep::where([['yard', '=', $i], ['active', '=', '1']])->count();
        }
        $max = array_search(max($yardList), $yardList);
        $min = array_search(min($yardList), $yardList);
        $total = min($yardList);
        if ( $min != $max && $total === 1 ) {
            $id  = Sheep::move($max, $min);
            $msg = ['id' => $id, 'from' => $max, 'to' => $min];
        } else {
            $msg = ['none'];
        }

        return $msg;
    }

    public static function move($from, $to)
    {
        $sheep = Sheep::where([['yard', '=', $from], ['active', '=', '1']])->latest()->first();
        Sheep::where('id', $sheep->id)->update(['yard' => $to]);
        return $sheep->id;
    }
}
