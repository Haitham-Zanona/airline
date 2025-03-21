<?php
namespace App\Console\Commands;

use App\Http\Controllers\FlightController;
use Illuminate\Console\Command;

class ImportAirports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'airports:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import airports data from Amadeus API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $controller = new FlightController();
        $result     = $controller->importAirports();
        $this->info($result);

        return 0;

    }
}