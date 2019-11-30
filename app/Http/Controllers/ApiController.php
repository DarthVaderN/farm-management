<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\Sheep;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function index()
    {
        $yard = [1, 1, 1, 1];
        $count = count($yard);
        $total = 10 - $count;
        if ( Sheep::isYardEmpty() ) {
            DB::beginTransaction();
            while ( $total > 0 ) {
                $number = mt_rand(0, 3);
                $yard[$number] += 1;
                $total -= 1;
            }
            foreach ( $yard as $key => $value ) {
                for ( $i = 1; $i <= $value; $i++ ) {
                    Sheep::add($key + 1);
                }
            }
            DB::commit();
        }
        $all = Sheep::where('active', 1)->orderBy('yard')->get();
        $yard = [];
        foreach ( $all as $sheep ) {
            $yard[$sheep->yard][] = $sheep->id;
        }
//      return response()->json(['yard' => $yard, 'all' => $all],200);  response JSON for api
        return view('home',compact('yard','all'));

    }

    public function clone()
    {
        $yardList    = [1, 2, 3, 4];
        $randomList = [];
        foreach ( $yardList as $yard ) {

            $total = Sheep::where([['yard', '=', $yard], ['active', '=', '1']])->count();
            if ( $total >= Sheep::NumberToReproduce ) {
                $randomList[] = $yard;
            }
        }

        $count = count($randomList);
        $msg   = 0;

        if ( $count > 0 ) {
            $index = (mt_rand(Sheep::MinYard, count($randomList)) - 1);
            $id  = Sheep::add($randomList[$index]);
            $msg =['yard' => $randomList[$index],'sheep_id' => $id];
        }

        return response()->json($msg);
    }

    public function kill()
    {
        $id    = Sheep::killOneSheep();
        $moved = Sheep::checkYard();
        $msg = ['kill' => ['id' => $id], 'moved' => $moved];
        return response()->json($msg);
    }
    public static function delete()
    {
        $sheepDelete = Sheep::truncate();
        $recordDelete = Record::truncate();
        return response()->json([$sheepDelete,$recordDelete],204);
    }

    public function status()
    {
        $all   = Sheep::all()->count();
        $live  = Sheep::where('active', 1)->latest()->count();
        $kill = Sheep::where('active', 0)->latest()->count();
        $min = Sheep::select('yard', DB::raw('COUNT(id) as total'))->groupBy('yard')->orderBy('total')->first();
        $max = Sheep::select('yard', DB::raw('COUNT(id) as total'))->groupBy('yard')->orderBy('total', 'desc')->first();
            // response JSON for api
//      return response()->json([$all,$live,$kill,$max,$min]); response JSON for api
        return view('status',compact('all','live','kill','min','max'));
    }

}
