<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class OrderCreatedNotification extends Notification
{
    use Queueable;
    public $order;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order=$order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database','broadcast']; // channels of notifications

        // $channels = ['database'];
        // if($notifiable->notification_prefrences['order_created']['sms'] ?? false){
        //     $channels[] = 'vonage';
        // }
        // if($notifiable->notification_prefrences['order_created']['mail'] ?? false){
        //     $channels[] = 'mail';
        // }
        // if($notifiable->notification_prefrences['order_created']['broascast'] ?? false){
        //     $channels[] = 'broascast';
        // }
        // return $channels;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $addr = $this->order->billingAddress;
        return (new MailMessage)
                    ->subject('New Order #'.$this->order->number)
                    ->from('notification@ajyal-store.ps','Ajyal Store')
                    ->greeting('Hi '.$notifiable->name) // Name User in the database his onwer the store
                    ->line("A New Order {$this->order->number} Created By {$addr->name}")
                    ->action('Notification Action', url('/dashboard'))
                    ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable){
        $addr = $this->order->billingAddress;
        return [
            'body' => "A New Order {$this->order->number} Created By {$addr->name}",
            'icon' => 'fas fa-file',
            'url' => url('/dashboard'),
            'order_id' => $this->order->id
        ];
    }
    public function toBroadcast($notifiable){
        $addr = $this->order->billingAddress;
        $user = Auth::user();
        $newCount = $user->unreadNotifications()->count();
        return new BroadcastMessage([
            'body' => "A New Order {$this->order->number} Created By {$addr->name}",
            'icon' => 'fas fa-file',
            'url' => url('/dashboard'),
            'order_id' => $this->order->id,
            'newCont' => $newCount
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
