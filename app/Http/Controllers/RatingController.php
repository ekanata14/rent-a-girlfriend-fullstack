<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Models
use App\Models\Order;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $viewData = [
            'title' => 'Ratings',
            'ratings' => Rating::all(),
        ];

        return view('admin.ratings.index', $viewData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $orderId)
    {
        $viewData = [
            'title' => 'Create Rating',
            'order' => Order::findOrFail($orderId),
        ];

        return view('client.ratings.create', $viewData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'gf_bf_id' => ['required', 'integer'],
            'user_id' => ['required', 'integer'],
            'order_id' => ['required', 'integer'],
            'rate' => ['required', 'integer'],
            'review' => ['required', 'string'],
        ]);

        DB::beginTransaction();

        try {
            Rating::create($validatedData);
            DB::commit();

            return redirect()->route('client.orders.index')->with('success', 'Rating created successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Failed to create rating');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $viewData = [
            'title' => 'Rating',
            'rating' => Rating::findOrFail($id),
        ];

        return view('admin.ratings.show', $viewData);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $viewData = [
            'title' => 'Edit Rating',
            'rating' => Rating::findOrFail($id),
        ];

        return view('admin.ratings.edit', $viewData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'gf_bf_id' => ['required', 'integer'],
            'user_id' => ['required', 'integer'],
            'order_id' => ['required', 'integer'],
            'rate' => ['required', 'integer'],
            'review' => ['required', 'string'],
        ]);

        DB::beginTransaction();

        try {
            Rating::findOrFail($request->id)->update($validatedData);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Failed to update rating');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        DB::beginTransaction();

        try {
            Rating::findOrFail($request->id)->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Failed to delete rating');
        }
    }
}
