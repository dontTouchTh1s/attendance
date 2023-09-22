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
        if (isset($request->manager_id)) {
            Employee::findOr($request->manager_id, function () {
                return response('Manager not found', 404);
            });
        }
        $user = new User();

        if (isset($request->roll)) {
            // User trying to store employee with specific roll
            if (\Auth::user()->cannot('create', Employee::class))
                response('You should have super admin roll to create employee with specific roll', 403);
            $user->roll = $request->roll;
        }
        // Create user
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

    public function show(Employee $employee)
    {
        return response($employee);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
