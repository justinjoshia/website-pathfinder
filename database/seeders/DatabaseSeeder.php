<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\MemberClass;
use App\Models\PointHistory;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::transaction(function (): void {
            $classes = collect([
                ['name' => 'Sahabat', 'sort_order' => 1],
                ['name' => 'Teman', 'sort_order' => 2],
                ['name' => 'Penyelidik', 'sort_order' => 3],
                ['name' => 'Perintis', 'sort_order' => 4],
                ['name' => 'Penjelajah', 'sort_order' => 5],
                ['name' => 'Pemimpin', 'sort_order' => 6],
                ['name' => 'Calon Master Guide (CMG)', 'sort_order' => 7],
            ])->mapWithKeys(fn (array $class) => [
                $class['name'] => MemberClass::query()->updateOrCreate(
                    ['name' => $class['name']],
                    ['sort_order' => $class['sort_order']],
                ),
            ]);

            $teams = collect([
                ['name' => 'Gliserin', 'gender' => 'female', 'sort_order' => 1],
                ['name' => 'Xenon', 'gender' => 'female', 'sort_order' => 2],
                ['name' => 'Fluorine', 'gender' => 'female', 'sort_order' => 3],
                ['name' => 'Neon', 'gender' => 'male', 'sort_order' => 4],
                ['name' => 'Uranium', 'gender' => 'male', 'sort_order' => 5],
                ['name' => 'Arsenic', 'gender' => 'male', 'sort_order' => 6],
                ['name' => 'Einsteinium', 'gender' => 'male', 'sort_order' => 7],
            ])->mapWithKeys(fn (array $team) => [
                $team['name'] => Team::query()->updateOrCreate(
                    ['name' => $team['name']],
                    ['gender' => $team['gender'], 'sort_order' => $team['sort_order']],
                ),
            ]);

            $admin = User::query()->updateOrCreate(
                ['name' => 'masterguide'],
                ['password' => '12345678', 'role' => User::ROLE_ADMIN],
            );

            $members = [
                [
                    'user' => ['name' => 'lionel', 'password' => 'password123'],
                    'class' => 'Sahabat',
                    'team' => 'Neon',
                    'points' => 120,
                ],
                [
                    'user' => ['name' => 'grace', 'password' => 'password123'],
                    'class' => 'Teman',
                    'team' => 'Gliserin',
                    'points' => 95,
                ],
                [
                    'user' => ['name' => 'caleb', 'password' => 'password123'],
                    'class' => 'Perintis',
                    'team' => 'Uranium',
                    'points' => 150,
                ],
            ];

            foreach ($members as $memberData) {
                $user = User::query()->updateOrCreate(
                    ['name' => $memberData['user']['name']],
                    ['password' => $memberData['user']['password'], 'role' => User::ROLE_USER],
                );

                $member = Member::query()->updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'class_id' => $classes[$memberData['class']]->id,
                        'team_id' => $teams[$memberData['team']]->id,
                        'total_points' => $memberData['points'],
                    ],
                );

                PointHistory::query()->updateOrCreate(
                    [
                        'member_id' => $member->id,
                        'description' => 'Poin awal seeder',
                    ],
                    [
                        'points' => $memberData['points'],
                        'created_by' => $admin->id,
                        'created_at' => now(),
                    ],
                );
            }
        });
    }
}
