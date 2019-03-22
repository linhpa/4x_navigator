<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CaseField;

class CaseFieldController extends Controller
{
    public function __construct() { 
        $this->middleware('auth');
    }

    public function index(Request $request) {
        if (Auth::user()->role != 'admin') {
            return redirect('/home')->with('error', 'Unauthorized');
        }

    	$caseFields = CaseField::paginate(10);
    	return view('casefield.index', compact('caseFields'));
    }

    public function store() {

    }

    public function update() {

    }

    public function destroy() {

    }
}
