<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UnlockAchievement
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\AchievementUnlocked  $event
     * @return void
     */
    public function handle(AchievementUnlocked $event)
    {   $userinfo = $event->user;
        $UserID = DB::table('users')->where('email', $userinfo->email)->value('email');
        $achievement_name=$event->achievement_name;
        $achievementID = DB::table('achievements')->where('Name', $achievement_name)->value('id');

        $storeachievement=DB::insert('insert into user_achievement (user_id, achievement_id) values (?, ?)', [$UserID,$achievementID]);
        return $storeachievement;
        //
    }
}
