<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->when($request->filled('start_date_from'), function ($query) use ($request) {
                $startDateFrom = Carbon::createFromFormat('m/d/Y', $request->start_date_from)->toDateString();
                $query->where('start_date', '>=', $startDateFrom);
            })
            ->when($request->filled('start_date_to'), function ($query) use ($request) {
                $startDateTo = Carbon::createFromFormat('m/d/Y', $request->start_date_to)->toDateString();
                $query->where('start_date', '<=', $startDateTo);
            })
            ->paginate();

        return view('users.index', compact('users'));
    }
}
