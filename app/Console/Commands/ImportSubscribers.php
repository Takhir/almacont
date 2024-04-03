<?php

namespace App\Console\Commands;

use App\Imports\SubscribersImportAll;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportSubscribers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-subscribers';

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
        $file = storage_path('app/public/import/API_FW_ETL_RU_SERVICE_COUNT.xlsx');
        //$file = storage_path('app/public/import/SearchIDСhannel.xlsx');

        if (!file_exists($file)) {
            $this->error('File does not exist');
            return;
        }

        Excel::import(new SubscribersImportAll, $file);

        $this->info('Data imported successfully.');
    }
}
