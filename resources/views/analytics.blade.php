@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="btn-group d-md-none d-flex btn-group-sm float-right" role="group" aria-label="Basic example">
                            <button type="button" class="btn today btn-secondary btn-dark changeDate" data-from="{{ \Carbon\Carbon::today()->toDateString() }}" data-to="{{ \Carbon\Carbon::today()->toDateString() }}">Today</button>
                            <button type="button" class="btn yesterday btn-secondary changeDate" data-from="{{ \Carbon\Carbon::yesterday()->toDateString() }}" data-to="{{ \Carbon\Carbon::yesterday()->toDateString() }}">Yesterday</button>
                            <button type="button" class="btn last_7_days btn-secondary changeDate" data-from="{{  \Carbon\Carbon::today()->subDays(7)->toDateString() }}" data-to="{{ \Carbon\Carbon::yesterday()->toDateString() }}">Last 7 days</button>
                            <button type="button" class="btn last_30_days btn-secondary changeDate" data-from="{{  \Carbon\Carbon::today()->subDays(30)->toDateString() }}" data-to="{{ \Carbon\Carbon::yesterday()->toDateString() }}">Last 30 days</button>
                        </div>

                        <div class="btn-group d-none d-md-flex float-right" role="group" aria-label="Basic example">
                            <button type="button" class="btn today btn-secondary btn-dark changeDate" data-from="{{ \Carbon\Carbon::today()->toDateString() }}" data-to="{{ \Carbon\Carbon::today()->toDateString() }}">Today</button>
                            <button type="button" class="btn yesterday btn-secondary changeDate" data-from="{{ \Carbon\Carbon::yesterday()->toDateString() }}" data-to="{{ \Carbon\Carbon::yesterday()->toDateString() }}">Yesterday</button>
                            <button type="button" class="btn last_7_days btn-secondary changeDate" data-from="{{  \Carbon\Carbon::today()->subDays(7)->toDateString() }}" data-to="{{ \Carbon\Carbon::yesterday()->toDateString() }}">Last 7 days</button>
                            <button type="button" class="btn last_30_days btn-secondary changeDate" data-from="{{  \Carbon\Carbon::today()->subDays(30)->toDateString() }}" data-to="{{ \Carbon\Carbon::yesterday()->toDateString() }}">Last 30 days</button>
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                   <div class="col-md-3">
                       <div class="legend">
                           <div class="legend-label">
                               <i class="fas fa-users"></i> CUSTOMERS
                           </div>
                           <div class="legend-value">
                               <span id="customers">
                                   <i class="fas fa-spinner"></i>
                               </span>
                           </div>
                       </div>
                   </div>
                   <div class="col-md-3">
                       <div class="legend">
                           <div class="legend-label">
                               <i class="fas fa-shopping-cart"></i> ORDERS
                           </div>
                           <div class="legend-value">
                               <span id="orders">
                                   <i class="fas fa-spinner"></i>
                               </span>
                           </div>
                       </div>
                   </div>
                   <div class="col-md-3">
                       <div class="legend">
                           <div class="legend-label">
                               <i class="fas fa-industry"></i> ON PROGRESS
                           </div>
                           <div class="legend-value">
                               <span id="on_progress">
                                   <i class="fas fa-spinner"></i>
                               </span>
                           </div>
                       </div>
                   </div>
                    <div class="col-md-3">
                        <div class="legend">
                            <div class="legend-label">
                                <i class="fas fa-check-circle"></i> DELIVERIES
                            </div>
                            <div class="legend-value">
                                <span id="deliveries">
                                    <i class="fas fa-spinner"></i>
                                </span>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <script>
        let today = $(".today");
        let fromDate = today.data('from');
        let toDate = today.data('to');

        getDateRange(fromDate, toDate)


        $(".changeDate").on("click", function (e) {
            fromDate = $(this).data('from');
            toDate = $(this).data('to');


            $('.today').removeClass("btn-dark");
            $('.yesterday').removeClass("btn-dark");
            $('.last_7_days').removeClass("btn-dark");
            $('.last_30_days').removeClass("btn-dark");

            $(this).addClass("btn-dark");

            getDateRange(fromDate, toDate)

            console.log(fromDate)
            console.log(toDate);
        })

        function getDateRange(fromDate, toDate) {

            //$('#today').addClass("btn-dark");

            const url = "/analytics-date-range?from_date=" +fromDate +"&to_date=" + toDate;
            console.log(url)
            $.getJSON(url, function (data) {
                console.log(data)
                $("#customers").html('<i class="fas fa-spinner"></i>')
                $("#orders").html('<i class="fas fa-spinner"></i>')
                $("#on_progress").html('<i class="fas fa-spinner"></i>')
                $("#deliveries").html('<i class="fas fa-spinner"></i>')

                setTimeout (function(){
                    $("#customers").html(data.customers.count)
                    $("#orders").html(data.orders.count)
                    $("#on_progress").html(data.on_progress.count)
                    $("#deliveries").html(data.deliveries.count)
                },200);


            })
        }

    </script>
@endpush
