<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return view('dashboard.admin', [
                'memberCount' => Member::count(),
                'adminCount' => User::where('role', User::ROLE_ADMIN)->count(),
                'members' => Member::with(['user', 'memberClass', 'team'])
                    ->orderByDesc('total_points')
                    ->get(),
            ]);
        }

        $member = $user->member()
            ->with(['memberClass', 'team'])
            ->firstOrFail();

        return view('dashboard.member', [
            'member' => $member,
            'recentHistories' => $member->pointHistories()
                ->with('creator')
                ->latest('created_at')
                ->take(10)
                ->get(),
        ]);
    }
}
