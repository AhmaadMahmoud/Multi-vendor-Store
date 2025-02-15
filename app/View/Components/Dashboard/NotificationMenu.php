<?php

namespace App\View\Components\Dashboard;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class NotificationMenu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $notifications;
     public $newCount;
    public function __construct($count = 10)
    {
        $user = Auth::user();
    // جلب عدد معين من الإشعارات
    $this->notifications = $user->notifications()->take($count)->get();

    // جلب عدد الإشعارات غير المقروءة
    $this->newCount = $user->unreadNotifications()->count();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.notification-menu');
    }
}
