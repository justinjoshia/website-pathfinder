<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePointRequest;
use App\Models\Member;
use App\Models\PointHistory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PointController extends Controller
{
    public function create(Member $member): View
    {
        $member->load(['user', 'memberClass', 'team']);

        return view('points.create', [
            'member' => $member,
        ]);
    }

    public function store(StorePointRequest $request, Member $member): RedirectResponse
    {
        DB::transaction(function () use ($request, $member): void {
            PointHistory::create([
                'member_id' => $member->id,
                'points' => $request->integer('points'),
                'description' => $request->string('description')->toString(),
                'created_by' => auth()->id(),
                'created_at' => now(),
            ]);

            $member->increment('total_points', $request->integer('points'));
        });

        return redirect()->route('members.show', $member)->with('status', 'Perubahan poin berhasil disimpan.');
    }

    public function index(): View
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $histories = PointHistory::with(['member.user', 'creator'])
                ->latest('created_at')
                ->paginate(15);
        } else {
            $member = $user->member()->firstOrFail();

            $histories = $member->pointHistories()
                ->with('creator')
                ->latest('created_at')
                ->paginate(15);
        }

        return view('points.index', [
            'histories' => $histories,
            'isAdmin' => $user->isAdmin(),
        ]);
    }
}
