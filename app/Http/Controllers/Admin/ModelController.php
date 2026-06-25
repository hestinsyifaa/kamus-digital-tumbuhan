<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ModelAI;

class ModelController extends Controller
{
    public function index()
    {
        $models = ModelAI::all();
        $activeModel = ModelAI::where('status', 'active')->first();

        return view('admin.models.index', compact('models', 'activeModel'));
    }
}