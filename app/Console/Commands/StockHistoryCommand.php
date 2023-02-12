<?php

namespace App\Console\Commands;

use App\Models\Stock;
use App\Models\StockHistory;
use Carbon\Carbon;
use Illuminate\Console\Command;

class StockHistoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:daily_stock_history_snap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'takes a snap of the stock table every day';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $current_time = Carbon::now();
        $stock_history = array();
        $stock = Stock::all();

        foreach ($stock as $item) {
            $item_data['stock_id'] = $item['id'];
            $item_data['quantity'] = $item['quantity'];
            $item_data['unit_price'] = $item['unit_price'];
            $item_data['created_at'] = $current_time;
            $item_data['updated_at'] = $current_time;
            $stock_history[] = $item_data;
        }
        StockHistory::insert($stock_history);
    }
}
