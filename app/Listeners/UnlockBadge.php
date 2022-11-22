<?php

namespace App\Listeners;

use App\Events\BadgeUnlocked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UnlockBadge
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
     * @param  \App\Events\BadgeUnlocked  $event
     * @return void
     */
    public function handle(BadgeUnlocked $event)
    {   $userinfo = $event->user;
        $UserID = DB::table('users')->where('email', $userinfo->email)->value('id');
        $badge_name=$event->badge_name;
        $badgeID = DB::table('badges')->where('Name', $badge_name)->value('id');

        $storebadges=DB::insert('insert into user_badge (user_id, badge_id) values (?, ?)', [$UserID,$badgeID]);
        return $storebadges;
        //
    }
}
