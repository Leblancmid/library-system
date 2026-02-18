<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Loan;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::latest()->paginate(10);

        return view('members.index', compact('members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:members,email',
        ]);

        Member::create($validated);

        return redirect()
        ->route('members.index')
        ->with('messages', 'Member added successfully!');
    }

    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }
    public function update(Request $request, Member $member) 
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:members,email',
        ]);

        $member->update($validated);

        return redirect()
        ->route('members.index')
        ->with('messages', 'Member updated successfully!');
    }

    public function destroy(Member $member)
    {
        $member->delete();

        return response()->json([
            'message' => 'Member deleted successfully'
        ], 200);
    }
}
