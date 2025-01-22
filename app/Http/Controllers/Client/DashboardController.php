<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->gender == 0) {
            $users = User::where('role', 1)
                ->where('gender', 1)
                ->leftJoin('ratings', 'users.id', '=', 'ratings.gf_bf_id')
                ->selectRaw('users.*, COALESCE(AVG(ratings.rate), 0) as average_rating, COUNT(ratings.id) as total_ratings, COALESCE(SUM(ratings.rate), 0) as sum_ratings')
                ->groupBy('users.id')
                ->orderBy('average_rating', 'desc')
                ->get();
        } else if (auth()->user()->gender == 1) {
            $users = User::where('role', 1)
                ->where('gender', 0)
                ->leftJoin('ratings', 'users.id', '=', 'ratings.gf_bf_id')
                ->selectRaw('users.*, COALESCE(AVG(ratings.rate), 0) as average_rating, COUNT(ratings.id) as total_ratings, COALESCE(SUM(ratings.rate), 0) as sum_ratings')
                ->groupBy('users.id')
                ->orderBy('average_rating', 'desc')
                ->get();
        }
        $viewData = [
            'title' => 'Dashboard',
            'search' => null,
            'users' => $users,
        ];

        return view('client.dashboard', $viewData);
    }
    public function search(Request $request)
    {
        $validatedData = $request->validate([
            'search' => ['required', 'string'],
        ]);

        if (auth()->user()->gender == 0) {
            $users = User::where('role', 1)->where('gender', 1)
                ->where(function ($query) use ($validatedData) {
                    $query->where('username', 'like', '%' . $validatedData['search'] . '%')
                        ->orWhere('email', 'like', '%' . $validatedData['search'] . '%')
                        ->orWhere('age', 'like', '%' . $validatedData['search'] . '%')
                        ->orWhere('height', 'like', '%' . $validatedData['search'] . '%');
                })
                ->leftJoin('ratings', 'users.id', '=', 'ratings.gf_bf_id')
                ->selectRaw('users.*, COALESCE(AVG(ratings.rate), 0) as average_rating, COUNT(ratings.id) as total_ratings, COALESCE(SUM(ratings.rate), 0) as sum_ratings')
                ->groupBy('users.id')
                ->orderBy('average_rating', 'desc')
                ->get();
        } else if (auth()->user()->gender == 1) {
            $users = User::where('role', 1)->where('gender', 0)
                ->where(function ($query) use ($validatedData) {
                    $query->where('username', 'like', '%' . $validatedData['search'] . '%')
                        ->orWhere('email', 'like', '%' . $validatedData['search'] . '%')
                        ->orWhere('age', 'like', '%' . $validatedData['search'] . '%')
                        ->orWhere('height', 'like', '%' . $validatedData['search'] . '%');
                })
                ->leftJoin('ratings', 'users.id', '=', 'ratings.gf_bf_id')
                ->selectRaw('users.*, COALESCE(AVG(ratings.rate), 0) as average_rating, COUNT(ratings.id) as total_ratings, COALESCE(SUM(ratings.rate), 0) as sum_ratings')
                ->groupBy('users.id')
                ->orderBy('average_rating', 'desc')
                ->get();
        }

        $viewData = [
            'title' => 'Search Results',
            'search' => $validatedData['search'],
            'users' => $users,
        ];

        return view('client.dashboard', $viewData);
    }
}
