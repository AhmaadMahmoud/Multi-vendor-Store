<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\User;
use App\Notifications\OrderCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendOrderCreatedNotification
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
     * @param  object  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        set_time_limit(120);
        $order = $event->order;
        $user = User::where('store_id',$order->store_id)->first(); // Notification to Onwer of the Store Only
        $user->notifyNow(new OrderCreatedNotification($order)); // Notify For One User

        // $users = User::where('store_id',$order->store_id)->get(); // Notification to All Manager In The Store [Owner - Super Admin - Admin]
        // Notification::send($users,new OrderCreatedNotification($order)); //Notification Send To All Users

    }
}
