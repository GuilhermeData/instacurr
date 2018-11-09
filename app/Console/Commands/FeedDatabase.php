<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Quotations;

class FeedDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start-feed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Feed database each 5 minutes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->loop();
    }
    
    private function loop()
    {
        $api_url = "https://api.hgbrasil.com/finance/quotations?format=json&key=ef044b18";
        $minutes = 5;
        
        $json_data = file_get_contents($api_url);
        $data = json_decode($json_data);
        $curr = $data->results->currencies;
        
        $quotation = new Quotations;
        $quotation->curr_source = $curr->source;
        $quotation->usd =         $curr->USD->buy;
        $quotation->eur =         $curr->EUR->buy;
        $quotation->gbp =         $curr->GBP->buy;
        $quotation->ars =         $curr->ARS->buy;
        $quotation->save();
        
        sleep($minutes * 60);
        $this->loop();
    }
}