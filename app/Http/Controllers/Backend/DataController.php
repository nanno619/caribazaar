<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CentrePoint;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function centrePoint()
    {
        $centrePoint = CentrePoint::latest()->get();

        return datatables()->of($centrePoint)
        ->addColumn('action', 'backend.CentrePoint.action')
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->toJson();
    }
}
