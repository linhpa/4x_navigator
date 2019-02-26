<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CaseField;

class CaseFieldController extends Controller
{
    public function index(Request $request) {
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
