<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AttendanceSheet;
use Carbon\Carbon;

class UserAttendanceController extends Controller
{
    public function index()
    {
        $users = User::paginate(5);

        return view('users-index', compact('users'));
    }

    //検索機能
    public function find()
    {
        return view('find', ['input' => '']);
    }

    public function search(Request $request)
    {
        $input = $request->input;
        $users = User::where(function ($query) use ($input) {
            $query // 部分一致
                ->where('id', 'LIKE', "%{$input}%")
                ->orWhere('name', 'LIKE', "%{$input}%");
        })
            ->orWhere(function ($query) use ($input) {
                $query // 完全一致
                    ->where('id', $input)
                    ->orWhere('name', $input);
            })
            ->paginate(5);

        $param = [
            'input' => $input,
            'users' => $users
        ];

        return view('users-index', $param);
    }

    public function show($user_id)
    {
        $users = User::paginate(5);
        $user = User::with('attendanceSheets.breakTimes')->findOrFail($user_id);
        return view('users-attendance', compact('users', 'user'));
    }
}
