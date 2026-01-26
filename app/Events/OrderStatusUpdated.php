<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderStatusUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    // Tên kênh (Channel) mà trình duyệt sẽ lắng nghe
    public function broadcastOn()
    {
        return new Channel('order.' . $this->order->order_number);
    }

    // Dữ liệu gửi về cho JavaScript
    public function broadcastWith()
    {
        return [
            'status' => $this->order->status,
            'message' => 'Đơn hàng đã được thanh toán thành công!'
        ];
    }
}
