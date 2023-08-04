<?php

namespace App\Http\Controllers;

use App\Enums\UserRoles;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return EmployeeResource::collection(Employee::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        // Create user
        $user = new User();
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->save();

        // Create Employee
        $employee = new Employee();
        $employee->fill($request->validated());
        $employee->user_id = $user->id;
        $employee->save();

        // If request contain a manager id, change roll of given employee->user to manager
        if (isset($request->manager_id)) {
            $manager = Employee::find($request->manager_id)->user;
            $manager->roll = UserRoles::Manager->value;
            $manager->save();
        }

        return response('created', 201);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
