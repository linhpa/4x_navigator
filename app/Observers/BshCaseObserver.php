<?php

namespace App\Observers;

use App\BshCase;
use App\Events\CaseModelEvent;
use Auth;

class BshCaseObserver
{
    /**
     * Listen to the BshCase created event.
     *
     * @param  BshCase  $case
     * @return void
     */
    public function created(BshCase $case)
    {
        event(new CaseModelEvent(Auth::user(), 'Case', 'Case Created. Case ID: '. $case->id));
    }

    /**
     * Listen to the BshCase updated event.
     *
     * @param  BshCase  $case
     * @return void
     */
    public function udpated(BshCase $case)
    {
        event(new CaseModelEvent(Auth::user(), 'Case', 'Case Updated. Case ID: '. $case->id));
    }

    public function deleted(BshCase $case)
    {

    }
}
