<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkHours;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class WorkHoursController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->privilege_level == 1)
        {
            $workHours = WorkHours::where('employee_id', Auth::user()->id)->orderBy('date','ASC')->get();
            return view('WorkHours.MyWorkHours', compact('workHours'));
        }
        return view('home');
    }

    public function ManageWorkHours($id)
    {
        if(Auth::user()->privilege_level > 1)
        {
            $workHours = WorkHours::where('employee_id', $id)->orderBy('date','ASC')->get();
            return view('WorkHours.MyWorkHours', compact('workHours'));
        }
        return view('home');
    }

    public function AddWorkHour($id)
    {
        if(Auth::user()->privilege_level > 1)
        {
            return view('WorkHours.AddWorkHour', compact('id'));
        }
        return view('home');
    }

    public function StoreWorkHour(Request $request)
    {
        $request->validate([
            'godziny' => 'required|integer|min:1|digits_between:1,2|gte:0|lte:12',
            'data' => 'required|date',
            'employee_id' => 'required|integer'
        ]);

        $employee = User::findOrFail(request('employee_id'));
        $workHour = new WorkHours();
        $workHour->date = request('data');
        $workHour->work_hours = request('godziny');
        $workHour->employee_id = $employee->id;
        $workHour->name = $employee->name;
        $workHour->save();

        $workHours = WorkHours::where('employee_id', request('employee_id'))->orderBy('date','ASC')->get();
        return redirect()->to('/ManageWorkHours/'.$employee->id)->with('message', "Godziny pracy zostały dodane!");
    }

    public function DeleteWorkHour($id)
    {
        $workHour = WorkHours::findOrFail($id);
        $employee_id = $workHour->employee_id;
        $workHour->delete();
        return redirect()->to('/ManageWorkHours/'.$employee_id)->with('message', "Wpis pomyślnie usunięty");
    }

    public function ChangeWorkHour($id)
    {
        if(Auth::user()->privilege_level > 1)
        {
            $workHour = WorkHours::findOrFail($id);
            return view('WorkHours.EditWorkHour', compact('workHour'));
        }
        return view('home');
    }

    public function EditWorkHour(Request $request, $id)
    {        
        if(Auth::user()->privilege_level > 1)
        {
            $request->validate([
                'godziny' => 'required|integer|min:1|digits_between:1,2|gte:0|lte:12',
                'data' => 'required|date',
            ]);

            $workHour = WorkHours::findOrFail($id);
            $workHour->date = request('data');
            $workHour->work_hours = request('godziny');
            $workHour->update();
            return redirect()->to('/ManageWorkHours/'.$workHour->employee_id)->with('message', "Godziny pracy zostały zaktualizowane!");
        }
        return view('home');
    }
}
