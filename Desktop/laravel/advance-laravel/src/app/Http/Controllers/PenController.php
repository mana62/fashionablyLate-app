<?php


namespace App\Http\Controllers;

use App\Models\Pen;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PenController extends Controller
{
    public function fillPen()
    {
        $pen = new Pen();
        $uuid = (string) Str::uuid();
        $pen->fill([
            'uuid' => $uuid,
            'name' => 'FillPen',
            'price' => 1500,
        ]);
        $pen->save();
    }
    public function createPen()
    {
        $uuid = (string) Str::uuid();
        Pen::create([
            'uuid' => $uuid,
            'name' => 'CreatePen',
            'price' => 1200,
        ]);
    }
    public function insertPen()
    {
        $uuid = (string) Str::uuid();
        pen::insert([
            'uuid' => $uuid,
            'name' => 'InsertPen',
            'price' => 1800,
        ]);
    }
}
