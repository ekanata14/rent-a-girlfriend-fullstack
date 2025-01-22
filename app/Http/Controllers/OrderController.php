<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\UserPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $viewData = [
            'title' => 'Orders',
            'orders' => Order::orderBy('created_at', 'desc')->where('user_id', auth()->user()->id)->get(),
        ];

        return view('admin.orders.index', $viewData);
    }

    public function incoming()
    {
        $viewData = [
            'title' => 'Orders',
            'orders' => Order::orderBy('created_at', 'desc')->where('user_id', '!=', auth()->user()->id)->get(),
        ];

        return view('admin.orders.index', $viewData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $packageId)
    {
        $viewData = [
            'title' => 'Create Order',
            'package' => UserPackage::findOrFail($packageId),
        ];

        return view('client.orders.create', $viewData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'package_id' => ['required', 'integer'],
            'user_id' => ['required', 'integer'],
            'date' => ['required', 'date'],
            'payment_receipt' => ['required'],
            'total_price' => ['required', 'numeric'],
        ]);

        DB::beginTransaction();

        $user = User::where('id', $validatedData['user_id'])->first();

        try {
            if ($request->hasFile('payment_receipt')) {
                $originalName = pathinfo($request->file('payment_receipt')->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $request->file('payment_receipt')->getClientOriginalExtension();
                $username = $user->username;
                $date = now()->format('Ymd_His');
                $filename = "{$username}_{$date}.{$extension}";
                $path = $request->file('payment_receipt')->storeAs('payment_receipt', $filename, 'public');
                $validatedData['payment_receipt'] = $path;
            }
            $validatedData['status'] = 'pending';
            Order::create($validatedData);

            DB::commit();
            return redirect()->route('client.orders.index')->with('success', 'Order created successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Failed to create order, ' . $e->getMessage());
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
            'payment_receipt' => ['required'],
            'total_price' => ['required', 'numeric'],
            'status' => ['required', 'string'],
        ]);

        DB::beginTransaction();

        $user = User::where('id', $validatedData['user_id'])->first();

        try {
            if ($request->hasFile('payment_receipt')) {
                $originalName = pathinfo($request->file('payment_receipt')->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $request->file('payment_receipt')->getClientOriginalExtension();
                $username = $user->username;
                $date = now()->format('Ymd_His');
                $filename = "{$username}_{$date}.{$extension}";
                $path = $request->file('payment_receipt')->storeAs('payment_receipt', $filename, 'public');
                $validatedData['payment_receipt'] = $path;
            }
            $order = Order::findOrFail($request->id);
            $order->update($validatedData);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Failed to update order, ' . $e->getMessage());
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

    public function acceptOrder(Request $request)
    {
        DB::beginTransaction();

        try {
            $order = Order::findOrFail($request->id);
            $order->update(['status' => 'accepted']);

            DB::commit();
            return back()->with('success', 'Order accepted successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Failed to accept order');
        }
    }

    public function rejectOrder(Request $request)
    {
        DB::beginTransaction();

        try {
            $order = Order::findOrFail($request->id);
            $order->update(['status' => 'rejected']);

            DB::commit();
            return back()->with('success', 'Order rejected successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Failed to accept order');
        }
    }

    public function finishOrder(Request $request)
    {
        DB::beginTransaction();

        try {
            $order = Order::findOrFail($request->id);
            $order->update(['status' => 'finished']);

            DB::commit();
            return back()->with('success', 'Order rejected successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Failed to accept order');
        }
    }
}
