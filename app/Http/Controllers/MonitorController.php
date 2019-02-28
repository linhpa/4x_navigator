<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Redis;
use App\User;

class MonitorController extends Controller
{
    public function __construct() {
    	$this->middleware(['auth', 'admin']);
    }

    public function index() {
    	$loggedIds = $this->loggedUsers('users:*');

		$users = User::paginate(10);

    	return view('monitor.index', compact('users', 'loggedIds'));
    }

    protected function loggedUsers($pattern, $cursor = null, $allResults=array())
	{
	    // Zero means full iteration
	    if ($cursor === "0"){
	        $users = array();

	        foreach($allResults as $result){
	            $user = User::where('id', Redis::Get($result))->first();
	            $users[] = $user->id;
	        }
	        return $users;
	    }

	    // No $cursor means init
	    if ($cursor === null){
	        $cursor = "0";
	    }

	    // The call
	    $result = Redis::scan($cursor, 'match', $pattern);

	    // Append results to array
	    $allResults = array_merge($allResults, $result[1]);

	    // Get rid of duplicated values
	    $allResults = array_unique($allResults);

	    // Recursive call until cursor is 0
	    return $this->loggedUsers($pattern, $result[0], $allResults);
	}
}
