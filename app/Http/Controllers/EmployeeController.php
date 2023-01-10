<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkHours;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->privilege_level > 1)
        {
            $employees = User::where('privilege_level', 1)->get();
            return view('Employees.EmployeeList', compact('employees'));
        }
        return view('home');
    }

    public function EmployeeListUser()
    {
        if(Auth::user()->privilege_level > 1)
        {
            $employees = User::whereBetween('privilege_level', [1,3])->get();
            return view('Employees.EmployeeListUser', compact('employees'));
        }
        return view('home');
    }

    public function EditUserForm($id)
    {
        if(Auth::user()->privilege_level > 1)
        {
            $user = User::findOrFail($id);
            return view('Employees.EditUser', compact('user'));
        }
        return view('home');
    }

    public function UpdateUser(Request $request, $id)
    {        
        if(Auth::user()->privilege_level > 1)
        {
            $request->validate([
                'name' => 'required|string|min:1|max:50',
                'privilege_level' => 'required|integer|gte:1|lte:3',
                'email' => 'required|email'
            ]);

            $user = User::findOrFail($id);
            $user->name = request('name');
            $user->email = request('email');
            $user->privilege_level = request('privilege_level');
            $user->update();
            return redirect()->to('/EmployeeListUser')->with('message', "Użytkownik pomyślnie zaktualizowany!");
        }
        return view('home');
    }
}
