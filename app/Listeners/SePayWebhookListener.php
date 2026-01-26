<?php

namespace App\Listeners;

use SePay\SePay\Events\SePayWebhookEvent; // Phải có dòng này
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use SePay\SePay\Notifications\SePayTopUpSuccessNotification;

class SePayWebhookListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(\SePay\SePay\Events\SePayWebhookEvent $event): void
    {

        $data = $event->sePayWebhookData; // Dữ liệu giao dịch từ SePay
        $orderNumber = $event->info;    // Package đã tách được số 12345 từ "DH12345"

        // Ghi toàn bộ dữ liệu nhận được vào log để xem
        Log::info('--- SEPAY WEBHOOK DEBUG START ---');
        Log::info('Dữ liệu thô (sePayWebhookData):', (array) $event->sePayWebhookData);
        Log::info('Thông tin tách được (info): ' . $event->info);
        Log::info('--- SEPAY WEBHOOK DEBUG END ---');
        // Chỉ xử lý giao dịch tiền vào
        if ($data->transferType === 'in') {

            // 1. Tìm đơn hàng theo order_number
            $order = Order::where('order_number', $orderNumber)->first();

            if (!$order) {
                Log::warning("Đơn hàng với order_number {$orderNumber} không tồn tại.");
                return;
            }

            // 2. Kiểm tra số tiền chuyển có khớp với tổng đơn hàng không (Tùy chọn nhưng nên có)
            if ((float)$data->transferAmount >= (float)$order->total_amount) {

                // 3. Cập nhật trạng thái đơn hàng
                $order->update([
                    'status' => 'completed',
                    'updated_at' => now(),
                ]);
                // ... sau khi update order thành 'completed' để bắt sự kiện cập nhật trạng thái tự động thông qua websocket
                event(new \App\Events\OrderStatusUpdated($order));
                Log::info("Đã phát sự kiện cập nhật đơn hàng {$order->order_number} qua WebSocket.");
                // 4. (Tùy chọn) Gửi Email thông báo cho khách hàng đã nhận được tiền
                // Mail::to($order->email)->send(new OrderPaidMail($order));

                Log::info("Đơn hàng {$orderNumber} đã được cập nhật trạng thái thành 'processing' do nhận được thanh toán từ SePay.");
            } else {
                Log::warning("Số tiền nhận được từ SePay ({$data->transferAmount}) không khớp với tổng đơn hàng ({$order->total_amount}) cho đơn hàng {$orderNumber}.");
            }
        }
    }
}
