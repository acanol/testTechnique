<?php

namespace App\Console\Commands;

use App\Appliance;
use App\Services\ImportCrawler;
use Illuminate\Console\Command;

class ImportAppliances extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:appliances {--category=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import appliances from www.appliancesdelivered.ie';

   /**
     * @var ImportCrawler
     */
    private $importCrawler;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ImportCrawler $importCrawler)
    {
        parent::__construct();
        $this->importCrawler = $importCrawler;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $category = $this->option('category');
        if(!$category) {
            $this->info('Need the category');
        } else {
            $this->importCrawler->importData(
                function ($loadedPageUrl) {
                    $this->info(sprintf('Page loaded: %s', $loadedPageUrl));
                },
                function (Appliance $appliance) {
                    $this->info(sprintf('Imported: %s', $appliance->title));
                }
            , $category);

            $this->info('Done!');
        }
    }
}
