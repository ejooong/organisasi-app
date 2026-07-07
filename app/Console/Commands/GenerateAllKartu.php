<?php

namespace App\Console\Commands;

use App\Models\Anggota;
use App\Services\PdfKartuService;
use Illuminate\Console\Command;

class GenerateAllKartu extends Command
{
    protected $signature = 'kartu:generate-all';
    protected $description = 'Generate PDF kartu for all members';

    public function handle()
    {
        $pdfService = new PdfKartuService();
        $anggotas = Anggota::all();
        $count = 0;
        
        $this->info("Generating kartu for {$anggotas->count()} members...");
        
        $bar = $this->output->createProgressBar($anggotas->count());
        $bar->start();
        
        foreach ($anggotas as $anggota) {
            try {
                $pdfService->save($anggota);
                $count++;
            } catch (\Exception $e) {
                $this->error("Failed for {$anggota->nama_lengkap}: {$e->getMessage()}");
            }
            $bar->advance();
        }
        
        $bar->finish();
        $this->newLine();
        $this->info("Successfully generated {$count} kartu anggota.");
        
        return Command::SUCCESS;
    }
}