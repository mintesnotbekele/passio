<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Cornford\Googlmapper\Facades\MapperFacade as Mapper;
use Illuminate\Http\Request;

class GeofencingController extends Controller
{
    public function index()
    {
        Mapper::map(37.4419, -122.1419);

        return view('geofencing.index');
    }

    public function store(Request $request)
    {
        $lat = $request->input('lat');
        $lng = $request->input('lng');
        $radius = $request->input('radius');

        Mapper::map($lat, $lng, ['zoom' => 15, 'marker' => false, 'eventAfterLoad' => 'circleListener(maps[0].shapes[0], '.$radius.');']);
        Mapper::circle([$lat, $lng], $radius, ['strokeColor' => '#FF0000', 'strokeOpacity' => 0.8, 'strokeWeight' => 2, 'fillColor' => '#FF0000', 'fillOpacity' => 0.35]);

        return view('geofencing.index');
    }
}
