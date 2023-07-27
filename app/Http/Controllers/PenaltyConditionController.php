<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePenaltyConditionRequest;
use App\Models\PenaltyConditions;

class PenaltyConditionController extends Controller
{
    public function store(StorePenaltyConditionRequest $request)
    {
        $pc = new PenaltyConditions();
        $pc->fill($request->validated())->save();
        return response('', 201);
    }
}
