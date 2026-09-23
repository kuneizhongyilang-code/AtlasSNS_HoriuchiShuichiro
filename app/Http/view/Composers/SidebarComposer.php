<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class SidebarComposer
{
    public function compose(View $view)
    {
        $userId = auth()->id();

        $followCount = 0;
        $followerCount = 0;

        if ($userId) {

            // 自分がフォローしている人数
            $followCount = DB::table('follows')
                ->where('following_id', $userId)
                ->count();

            // 自分をフォローしている人数
            $followerCount = DB::table('follows')
                ->where('followed_id', $userId)
                ->count();
        }

        $view->with([
            'followCount' => $followCount,
            'followerCount' => $followerCount,
        ]);
    }
}
