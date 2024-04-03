<?php

namespace App\Console\Commands;

use App\Imports\ChannelsPackageImportAll;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportChannelsPackages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-channels-packages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $file = storage_path('app/public/import/API_FW_TARIFF.xlsx');

        if (!file_exists($file)) {
            $this->error('File does not exist');
            return;
        }

        Excel::import(new ChannelsPackageImportAll, $file);

        $this->info('Data imported successfully.');
    }
}
