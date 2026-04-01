<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\Member;
use App\Models\MemberClass;
use App\Models\PointHistory;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MemberController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('search')->toString();

        $members = Member::query()
            ->with(['user', 'memberClass', 'team'])
            ->when($search !== '', function ($query) use ($search) {
                $query->whereHas('user', fn ($userQuery) => $userQuery->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('memberClass', fn ($classQuery) => $classQuery->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('team', fn ($teamQuery) => $teamQuery->where('name', 'like', "%{$search}%"));
            })
            ->orderByDesc('total_points')
            ->paginate(10)
            ->withQueryString();

        return view('members.index', [
            'members' => $members,
            'search' => $search,
        ]);
    }

    public function create(): View
    {
        return view('members.create', [
            'classes' => MemberClass::orderBy('sort_order')->get(),
            'teams' => Team::orderBy('sort_order')->get(),
        ]);
    }

    public function store(StoreMemberRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request): void {
            $initialPoints = $request->integer('total_points', 0);

            $user = User::create([
                'name' => $request->string('name')->toString(),
                'password' => $request->string('password')->toString(),
                'role' => User::ROLE_USER,
            ]);

            $member = Member::create([
                'user_id' => $user->id,
                'class_id' => $request->integer('class_id'),
                'team_id' => $request->integer('team_id'),
                'total_points' => $initialPoints,
            ]);

            if ($initialPoints !== 0) {
                PointHistory::create([
                    'member_id' => $member->id,
                    'points' => $initialPoints,
                    'description' => 'Poin awal member',
                    'created_by' => auth()->id(),
                    'created_at' => now(),
                ]);
            }
        });

        return redirect()->route('members.index')->with('status', 'Member berhasil ditambahkan.');
    }

    public function show(Member $member): View
    {
        $member->load(['user', 'memberClass', 'team']);

        return view('members.show', [
            'member' => $member,
            'histories' => $member->pointHistories()->with('creator')->latest('created_at')->paginate(10),
        ]);
    }

    public function edit(Member $member): View
    {
        $member->load(['user', 'memberClass', 'team']);

        return view('members.edit', [
            'member' => $member,
            'classes' => MemberClass::orderBy('sort_order')->get(),
            'teams' => Team::orderBy('sort_order')->get(),
        ]);
    }

    public function update(UpdateMemberRequest $request, Member $member): RedirectResponse
    {
        DB::transaction(function () use ($request, $member): void {
            $member->user->update([
                'name' => $request->string('name')->toString(),
                'password' => $request->filled('password')
                    ? $request->string('password')->toString()
                    : $member->user->password,
            ]);

            $member->update([
                'class_id' => $request->integer('class_id'),
                'team_id' => $request->integer('team_id'),
            ]);
        });

        return redirect()->route('members.show', $member)->with('status', 'Data member berhasil diperbarui.');
    }

    public function destroy(Member $member): RedirectResponse
    {
        $member->user->delete();

        return redirect()->route('members.index')->with('status', 'Member berhasil dihapus.');
    }

    public function profile(): View
    {
        $member = auth()->user()->member()
            ->with(['user', 'memberClass', 'team'])
            ->firstOrFail();

        return view('members.profile', [
            'member' => $member,
        ]);
    }
}
