<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\ReportFormRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    ########### dashboard index
    public function index()
    {  
        return view('dashboard.dashboard');
    }

    public function report() {
        return view('dashboard.pages.report');
    }

    public function reportPost(ReportFormRequest $request) {
        
        $token = session("api_token");
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        $merchant = $request->input('merchant');
        $acquirer = $request->input('acquirer');

        try {

            $response = Http::withHeaders([
                'Authorization' => $token
            ])->post('https://sandbox-reporting.rpdpymnt.com/api/v3/transactions/report', [
                'from_date' => $from_date,
                'to_date' => $to_date,
                'merchant' => $merchant,
                'acquirer' => $acquirer,
            ]);
            
            if ($response->successful()) {
                if ($response->json()['status'] == "APPROVED") {
        
                    $response_data = ['asdad' => 'asdadsa'];

                    return view('dashboard.paages.report', ['data' => $response_data , 'reportSuccess', trans('dashboard.report.error.messages')]);

                    #return redirect()->route('dashboard.report')->with(['reportSuccess' => trans('dashboard.report.success.messages')])->compact(['data' => $response_data]);
                }
    
            } else {
                return redirect()->route('dashboard.report')->with(['reportError' => trans('dashboard.report.error.messages')]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['reportInfo' => trans('dashboard.report.info.messages')]);
        }
        
    }

    public function query() {
        return view('dashboard.pages.query');
    }

    public function transaction() {
        return view('dashboard.pages.transaction');
    }

    public function client() {
        return view('dashboard.pages.client');
    }
}
