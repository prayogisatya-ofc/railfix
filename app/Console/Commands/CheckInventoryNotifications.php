<?php

namespace App\Console\Commands;

use App\Models\Inventory;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckInventoryNotifications extends Command
{
    protected $signature = 'notif:check-inventory';
    protected $description = 'Cek inventory yang belum diproses lebih dari 2 hari dan buat notifikasi';

    public function handle()
    {
        $twoDaysAgo = Carbon::now()->subDays(2);

        $inventories = Inventory::where('status', 'received')
            ->where('date_in', '<=', $twoDaysAgo)
            ->doesntHave('notifications')
            ->get();

        foreach ($inventories as $item) {
            $item->notifications()->create([
                'is_read' => false
            ]);
        }

        $this->info("Notifikasi berhasil diperbarui.");
    }
}
