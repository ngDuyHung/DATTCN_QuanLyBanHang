<?php

namespace App\Observers;

use App\Models\Inventory;

class InventoryObserver
{
    /**
     * Handle the Inventory "created" event.
     */
    public function created(Inventory $inventory): void
    {
        $this->syncProductStatus($inventory);
    }

    /**
     * Handle the Inventory "updated" event.
     */
    public function updated(Inventory $inventory): void
    {
        // wasChanged kiểm tra xem sau khi lưu xong thì cột đó có vừa bị thay đổi không
        if ($inventory->wasChanged('quantity_in_stock')) {
            $this->syncProductStatus($inventory);
        }
    }

    /**
     * Handle the Inventory "deleted" event.
     */
    public function deleted(Inventory $inventory): void
    {
        $inventory->product()->update(['is_active' => 0]);
    }

    /**
     * Handle the Inventory "restored" event.
     */
    public function restored(Inventory $inventory): void
    {
        $this->syncProductStatus($inventory);
    }

    /**
     * Handle the Inventory "force deleted" event.
     */
    public function forceDeleted(Inventory $inventory): void
    {
        $inventory->product()->update(['is_active' => 0]);
    }

    /**
     * Hàm dùng chung để đồng bộ trạng thái is_active của Product
     */
    private function syncProductStatus(Inventory $inventory): void
    {
        // Nếu số lượng tồn kho <= 0, đặt is_active = 0 (Off)
        // Nếu số lượng tồn kho > 0, đặt is_active = 1 (On)
        $newStatus = $inventory->quantity_in_stock <= 0 ? 0 : 1;

        // Cập nhật vào bảng products
        $inventory->product()->update(['is_active' => $newStatus]);
    }
}
