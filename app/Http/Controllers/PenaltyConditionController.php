<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePenaltyConditionRequest;
use App\Models\PenaltyCondition;

class PenaltyConditionController extends Controller
{
    public function store(StorePenaltyConditionRequest $request)
    {
        $pc = new PenaltyCondition();
        $pc->fill($request->validated())->save();
        return response('', 201);
    }
}
