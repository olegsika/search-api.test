<?php

namespace App\Http\Controllers;


use App\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    protected $fields = ['bedrooms', 'bathrooms', 'storeys', 'garages'];

    public function getData()
    {
        $hotels = Hotel::all();

        return response()->json($hotels, 200);
    }

    public function search(Request $request)
    {
        $hotels = Hotel::where(function ($query) use ($request) {
            if($request->name !== null){
                $query->where('name', 'LIKE', "%$request->name%");
            }
            foreach ($this->fields as $field){
                if($request->$field !== null){
                    $query->where($field, $request->$field);
                }
            }
            if($request->minPrice !== null || $request->maxPrice != null){
                $query->whereBetween('price', [$request->minPrice ?? '0', $request->maxPrice ?? Hotel::max('price')]);
            }
        })->get();


        /*
         * If big data better use Facade DB
        */

        /*
        $hotels = DB::table('hotels');

        if($request->name !== null){
            $hotels = $hotels->where('name', 'LIKE', "%$request->name%");
        }
        foreach ($this->fields as $field){
            if($request->$field !== null){
                $hotels = $hotels->where($field, $request->$field);
            }
        }
        if($request->minPrice !== null || $request->maxPrice != null){
            $hotels = $hotels->whereBetween('price', [$request->minPrice ?? '0', $request->maxPrice ?? DB::table('hotels')->max('price')]);
        }*/

        return response()->json($hotels, 200);
    }
}
