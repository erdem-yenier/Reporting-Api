<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Library\DashboardLibrary;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Http\Requests\ReportFormRequest;
use App\Http\Requests\TransactionFormRequest;

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

            $data = [
                'from_date' => $from_date,
                'to_date' => $to_date,
                'merchant' => $merchant,
                'acquirer' => $acquirer,
            ];
            $response = DashboardLibrary::httpRequest('https://sandbox-reporting.rpdpymnt.com/api/v3/transactions/report' , $token , $data);
            
            if ($response->successful()) {
                if ($response->json()['status'] == "APPROVED") {
        
                    $response_data['status'] = "info";
                    $response_data['message'] = trans('dashboard.report.success.messages');
                    $response_data['data'] = $response->json()['response'];
                    return View::make('dashboard.pages.report')->with('response_data', $response_data);

                }
    
            } else {
                $response_data['status'] = "error";
                $response_data['message'] = trans('dashboard.reoprt.error.messages');
                return View::make('dashboard.pages.report')->with('response_data', $response_data);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['reportInfo' => trans('dashboard.report.info.messages')]);
        }
        
    }

    public function query() {
        return view('dashboard.pages.query');
    }

    public function queryPost(ReportFormRequest $request) {
        
        $token = session("api_token");
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        $merchant = $request->input('merchant');
        $acquirer = $request->input('acquirer');

        try {

            $data = [
                'from_date' => $from_date,
                'to_date' => $to_date,
                'merchant' => $merchant,
                'acquirer' => $acquirer,
            ];
            $response = DashboardLibrary::httpRequest('https://sandbox-reporting.rpdpymnt.com/api/v3/transaction/list' , $token , $data);
            
            if ($response->successful()) {

                $response_data['status'] = "info";
                $response_data['message'] = trans('dashboard.report.success.messages');
                $response_data['data'] = $response->json();
                return View::make('dashboard.pages.query')->with('response_data', $response_data);
    
            } else {
                $response_data['status'] = "error";
                $response_data['message'] = trans('dashboard.query.error.messages');
                return View::make('dashboard.pages.query')->with('response_data', $response_data);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['queryInfo' => trans('dashboard.query.info.messages')]);
        }
        
    }

    public function transaction() {
        return view('dashboard.pages.transaction');
    }

    public function transactionPost(TransactionFormRequest $request) {
        
        $token = session("api_token");
        $transaction_id = $request->input('transaction_id');

        try {

            $data = [
                'transactionId' => $transaction_id
            ];
            $response = DashboardLibrary::httpRequest('https://sandbox-reporting.rpdpymnt.com/api/v3/transaction' , $token , $data);
            
            if ($response->successful()) {
                
                $response_data['status'] = "info";
                $response_data['message'] = trans('dashboard.report.success.messages');
                $response_data['data'] = $response->json();
                return View::make('dashboard.pages.transaction')->with('response_data', $response_data);
    
            } else {
                $response_data['status'] = "error";
                $response_data['message'] = trans('dashboard.report.error.messages');
                return View::make('dashboard.pages.transaction')->with('response_data', $response_data);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['reportInfo' => trans('dashboard.report.info.messages')]);
        }
        
    }

    public function client() {
        return view('dashboard.pages.client');
    }

    public function clientPost(TransactionFormRequest $request) {
        
        $token = session("api_token");
        $transaction_id = $request->input('transaction_id');

        try {

            $data = [
                'transactionId' => $transaction_id
            ];
            $response = DashboardLibrary::httpRequest('https://sandbox-reporting.rpdpymnt.com/api/v3/client' , $token , $data);
            
            if ($response->successful()) {

                $response_data['status'] = "success";
                $response_data['message'] = trans('dashboard.report.success.messages');
                $response_data['data'] = $response->json();
                return View::make('dashboard.pages.client')->with('response_data', $response_data);

    
            } else {

                $response_data['status'] = "error";
                $response_data['message'] = trans('dashboard.report.error.messages');
                return View::make('dashboard.pages.client')->with('response_data', $response_data);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['reportInfo' => trans('dashboard.report.info.messages')]);
        }
        
    }
}
