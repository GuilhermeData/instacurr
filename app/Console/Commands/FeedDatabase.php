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
        echo "\n\nA partir de agora a cada 5 min a base de dados será alimentada com a última cotação em reais para as seguintes moedas estrangeiras (Dólar, Euro, Libra, Peso)"
        . "\n\nPara parar o processo pressione Ctrl + C ou feche essa janela";
        
        $this->loop();
    }
    
    private function haveToInsertNewQuotation($last, $new) 
    {
        if($last->usd === $new->USD->buy && 
                $last->eur === $new->EUR->buy && 
                $last->gbp === $new->GBP->buy && 
                $last->ars === $new->ARS->buy) {
            
            return false;
            
        } else {
            
            // if something changes, we hate to insert a new row
            return true;
        }
    }
    
    private function refreshUpdatedAt($last)
    {
        $last->update(array('updated_at' => date('Y-m-d H:i:s')));
        
        echo "\n\nDados atualizados em: ".date('d/m/Y H:i:s');
    }
    
    private function insertQuotation($curr)
    {
        $quotation = new Quotations;
        $quotation->curr_source = $curr->source;
        $quotation->usd =         $curr->USD->buy;
        $quotation->eur =         $curr->EUR->buy;
        $quotation->gbp =         $curr->GBP->buy;
        $quotation->ars =         $curr->ARS->buy;
        $quotation->created_at =  date('Y-m-d H:i:s');
        $quotation->updated_at =  date('Y-m-d H:i:s');
        $quotation->save();
        
        echo "\n\nDados atualizados em: ".date('d/m/Y H:i:s');
    }
    
    private function loop()
    {
        $api_url = "https://api.hgbrasil.com/finance/quotations?format=json&key=ef044b18";
        $noDataMsg = "\n\nNenhuma informação encontrada para a iteração em ".date('d/m/Y H:i:s');
        $minutes = 5;
        
        $json_data = file_get_contents($api_url);
        
        if($json_data) {
        
            $data = json_decode($json_data);
            $curr = $data->results->currencies;
            
            if($curr) {

                $lastQuots = Quotations::where('id', '>', 0)->orderBy('updated_at', 'desc')->first();

                if(!$lastQuots) {

                    $this->insertQuotation($curr);

                } else if($this->haveToInsertNewQuotation($lastQuots, $curr)) {

                    $this->insertQuotation($curr);

                } else {

                    // Nothing changes, just refresh the updated_at column 
                    $this->refreshUpdatedAt($lastQuots);
                }
                
            } else {
                echo $noDataMsg;
            }
        } else {
            echo $noDataMsg;
        }
        
        sleep($minutes * 60);
        $this->loop();
    }
}