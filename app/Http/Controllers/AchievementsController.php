<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AchievementsController extends Controller
{
    public function index(User $user)
    {  //Get the Unlocked Achievements
        $UnlockedAchievements = DB::table('achievements')
        ->join('user_achievement', 'user_achievement.achievement_id', '=', 'achievements.id')
        ->select('achievements.Name')
        ->where('user_achievement.user_id', '=', $user->id)
        ->get();

        // Get the Next available Achievements
        $NextAvailableAchievements = DB::table('achievements')
        ->leftJoin('user_achievement', 'user_achievement.achievement_id', '=', 'achievements.id')
        ->select('achievements.Name')
        ->where('user_achievement.user_id', '=', $user->id)
        ->get();

        // Get the current Badge
        $currnetBadge = DB::table('badges')
        ->join('user_badge', 'badges.id', '=', 'user_badge.badge_id')
        ->select('badges.Name')
        ->orderBy('badges.updated_at', 'desc')
        ->where('user_badge.user_id', '=', $user->id)
        ->get();


        //Get the Next Badge
        $NextBadge = DB::table('badges')
        ->leftjoin('user_badge', 'badges.id', '=', 'user_badge.badge_id')
        ->select('badges.Name')
        ->orderBy('badges.updated_at', 'asc')
        ->get();

        //Get the Number of Badges
        $NumberOfBadges = DB::table('user_achievement')
        ->where('user_id', '=', $user->id)
        ->count('user_id');

        if(($NumberOfBadges>=0) &&($NumberOfBadges<4)){
            $Remaining=4-$NumberOfBadges;
        }

        else if(($NumberOfBadges>=4) &&($NumberOfBadges<8)){
            $Remaining=8-$NumberOfBadges;
        }

        else if(($NumberOfBadges>=8) &&($NumberOfBadges<10)){
            $Remaining=10-$NumberOfBadges;
        }

        else if($NumberOfBadges>=10) {
            $Remaining=0;
        }


        return response()->json([
            'unlocked_achievements' => $UnlockedAchievements,
            'next_available_achievements' => $NextAvailableAchievements,
            'current_badge' => $currnetBadge[0],
            'next_badge' => $NextBadge[0],
            'remaing_to_unlock_next_badge' => $Remaining
        ]);
    }
}
