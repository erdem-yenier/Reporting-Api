@section('css')
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
@extends('dashboard.layouts.main')
@section('content')

    <div>
        <form method="POST" action="{{ route('dashboard.transaction.post') }}">
          @csrf
            <input type="hidden" id="from_date" name="from_date" value="2015-07-01">
            <input type="hidden" id="to_date" name="to_date" value="2015-10-01">
            <div class="row mt-3 mb-4">
              <div class="col-md-6">
                <input type="text" id="transaction_id" name="transaction_id" class="form-control" placeholder="Transaction ID" required>
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
    
    @if (isset($reportSuccess))
      {{ $reportSuccess }}
    @endif
@endsection

@section('scripts')
    @if (isset($response_data))
        <script>
            Toast.fire({
                icon: "{{ $response_data['status'] }}",
                title: "{{ $response_data['message'] }}"
            }); 
        </script>
    @endif
@endsection