<?php

namespace App\Http\Controllers;

use App\Events\ChartData;
use App\Events\ReturnTicker;
use App\Events\TradeHistory;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ExchangeController extends Controller
{

    public function index(){
        return view("exchanges.index");
    }

    public function chartData()
    {
        return view("exchanges.chart-data");
    }
    public function tradeHistory()
    {
        return view("exchanges.trade-history");
    }

    public function getNewTicker(){
        $response = Http::withHeaders([
            'accept' => 'application/json'
        ])
            ->get(config('crypto.ticker_url'))
            ->json();

       event(new ReturnTicker());
       return response()->json($response);
    }
    public function getNewTradeHistory(){
        $response = Http::withHeaders([
            'accept' => 'application/json'
        ])
            ->get(config('crypto.trade_history_url'))
            ->json();

       event(new TradeHistory());
       return response()->json($response);
    }

    public function getNewChartData(){
        $response = Http::withHeaders([
            'accept' => 'application/json'
        ])
            ->get(config('crypto.chart_data_url'))
            ->json();

       event(new ChartData());
       return response()->json($response);
    }
}
