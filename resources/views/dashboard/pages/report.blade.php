@section('css')
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
@extends('dashboard.layouts.main')
@section('content')

    <div>
        <form method="POST" action="{{ route('dashboard.report.post') }}">
          @csrf
            <input type="hidden" id="from_date" name="from_date" value="2015-07-01">
            <input type="hidden" id="to_date" name="to_date" value="2015-10-01">
            <div class="row mt-3 mb-4">
              <div class="col-md-6">
                <input type="text" id="daterange" class="form-control" value="07/01/2015 - 10/01/2015">
              </div>
              <div class="col-md-2">
                <input type="number" id="merchant" name="merchant" class="form-control" placeholder="Merchant" min="1" required>
              </div>
              <div class="col-md-2">
                <input type="number" id="acquirer" name="acquirer" class="form-control" placeholder="Acquirer" min="1" required>
              </div>
              <div class="col-md-2">
                <button id="filter" type="submit" class="btn btn-secondary btn-block">Filter</button>
              </div>
            </div>
          </form>

          <div class="card">
            <div class="card-header">
              <h5 class="card-title">Response Data</h5>
            </div>
            <div class="card-body">
              @if (isset($response_data))
                  @foreach ($response_data['data'] as $key => $item)
                    <p class="card-text">{{ $key }} - {{ $item }}</p>
                  @endforeach
              @endif
            </div>
          </div>
    </div>
@endsection

@section('scripts')
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

  @if (isset($response_data))
    <script>
        Toast.fire({
            icon: "{{ $response_data['status'] }}",
            title: "{{ $response_data['message'] }}"
        }); 
    </script>
  @endif

  <script>

    $(function() {
      $('#daterange').daterangepicker({
        opens: 'left'
      }, function(start, end, label) {
        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));

        $('#from_date').val(start.format('YYYY-MM-DD'));
        $('#to_date').val(end.format('YYYY-MM-DD'));
        
      });
    });

    $('input[type="number"]').on('keypress', function(event) {
        if (event.key === 'e' || event.key === 'E') {
            event.preventDefault();
        }
    });

    

    /*
    $('#filter').click(function (e) { 
      
      const token = "{{ session('api_token') }}"
      const merchant = $('#merchant').val();
      const acquirer = $('#acquirer').val();

      const jsonData = {
        'fromDate' : start_date,
        'toDate' : end_date,
        'merchant' : merchant,
        'acquirer' : acquirer
      };
      
      $.ajax({
        url: 'https://sandbox-reporting.rpdpymnt.com/api/v3/transactions/report',
        method: 'POST',
        headers: {
          'Authorization': token,
          "Accept": "application/json"
        },
        type: 'json',
        data: jsonData,
        success: function(response) {
          console.log(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(errorThrown);
        }
      });
      
    });
    */

  </script>
@endsection