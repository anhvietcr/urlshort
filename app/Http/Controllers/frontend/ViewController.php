<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function getDocName(Request $request)
    {
    	$docName = $request['doc-name'];
    	return view('index', ['result'=> $docName]);
    }
}
