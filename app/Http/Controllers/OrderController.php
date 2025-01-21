<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $viewData = [
            'title' => 'Orders',
            'orders' => Order::all(),
        ];

        return view('admin.orders.index', $viewData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $viewData = [
            'title' => 'Create Order',
        ];

        return view('admin.orders.create', $viewData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'package_id' => ['required', 'integer'],
            'user_id' => ['required', 'integer'],
            'total_price' => ['required', 'numeric'],
            'status' => ['required', 'string'],
        ]);

        DB::beginTransaction();

        try {
            Order::create($validatedData);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Failed to create order');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $viewData = [
            'title' => 'Order',
            'order' => Order::findOrFail($id),
        ];

        return view('admin.orders.show', $viewData);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $viewData = [
            'title' => 'Edit Order',
            'order' => Order::findOrFail($request->id),
        ];

        return view('admin.orders.edit', $viewData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'package_id' => ['required', 'integer'],
            'user_id' => ['required', 'integer'],
            'total_price' => ['required', 'numeric'],
            'status' => ['required', 'string'],
        ]);

        DB::beginTransaction();

        try {
            $order = Order::findOrFail($request->id);
            $order->update($validatedData);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Failed to update order');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        DB::beginTransaction();

        try {
            Order::findOrFail($request->id)->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Failed to delete order');
        }
    }
}
