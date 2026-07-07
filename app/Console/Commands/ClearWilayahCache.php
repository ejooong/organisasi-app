<?php

namespace App\Console\Commands;

use App\Models\WilayahCache;
use Illuminate\Console\Command;

class ClearWilayahCache extends Command
{
    protected $signature = 'wilayah:clear-cache';
    protected $description = 'Clear old wilayah cache data';

    public function handle()
    {
        $count = WilayahCache::where('cached_at', '<', now()->subDays(7))->count();
        
        if ($count > 0) {
            WilayahCache::where('cached_at', '<', now()->subDays(7))->delete();
            $this->info("Cleared {$count} old cache records.");
        } else {
            $this->info("No old cache records found.");
        }
        
        return Command::SUCCESS;
    }
}