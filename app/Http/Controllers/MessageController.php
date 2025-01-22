<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $viewData = [
            'title' => 'Messages',
            'messages' => Message::with(['recipient', 'sender'])
                ->where('recipient_id', auth()->user()->id)
                ->orderBy('created_at', 'desc')
                ->get()
                ->groupBy('sender.id'),
        ];

        // return $viewData;

        return view('client.messages.index', $viewData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $viewData = [
            'title' => 'Create Message',
        ];

        return view('admin.messages.create', $viewData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sender_id' => ['required', 'integer'],
            'recipient_id' => ['required', 'integer'],
            'message' => ['required', 'string'],
            'is_read' => ['required', 'boolean'],
        ]);

        DB::beginTransaction();

        try {
            Message::create($validatedData);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Failed to create message');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $viewData = [
            'title' => 'Message',
            'message' => Message::findOrFail($id),
        ];

        return view('admin.messages.show', $viewData);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $viewData = [
            'title' => 'Edit Message',
            'message' => Message::findOrFail($id),
        ];

        return view('admin.messages.edit', $viewData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'sender_id' => ['required', 'integer'],
            'recipient_id' => ['required', 'integer'],
            'message' => ['required', 'string'],
            'is_read' => ['required', 'boolean'],
        ]);

        DB::beginTransaction();

        try {
            Message::findOrFail($request->id)->update($validatedData);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Failed to update message');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        DB::beginTransaction();

        try {
            Message::findOrFail($request->id)->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Failed to delete message');
        }
    }
}
