@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4>Send Bulk Message</h4>

                            @if($message = session('success'))
                            <div class="alert alert-success">
                                {{ $message }}
                            </div>
                            @endif

                            <form action="{{ route('bulk-sms.send') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="user_type">User Type</label>
                                    <select name="user_type" required class="form-control" id="user_type">
                                        <option value="0">Select Type</option>
                                        <option value="1">Test User</option>
                                        <option value="2">Customer</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="message">Message (<input style="border: 0;background: transparent;width: 34px" disabled maxlength="3" size="3" value="160" id="counter">/160)</label>
                                    <textarea name="message" required onkeyup="textCounter(this,'counter',160);" class="form-control" maxlength="160" id="message" cols="30" rows="3" placeholder="Aa"></textarea>
                                </div>
                                <button class="btn btn-primary float-right">Send <i class="fas fa-rocket"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4>SMS Service</h4>
                        <button class="btn check-balance btn-outline-success btn-sm">Check Balance</button>
                        <p class="pt-3" id="balance"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <script>
        $("#message").focusin(function () {
            if(!$(this).val()) {
                $(this).attr("placeholder", "Type your message...");
            }
        }).focusout(function () {
            if(!$(this).val()) {
                $(this).attr("placeholder", "Aa");
            }
        })

        function textCounter(field,field2, maxLimit)
        {
            var countField = document.getElementById(field2);
            if ( field.value.length > maxLimit ) {
                field.value = field.value.substring( 0, maxLimit );
                return false;
            } else {
                countField.value = maxLimit - field.value.length;
            }
        }

        $(".check-balance").on('click', function () {
            $.getJSON("/bulk-sms/balance", function (data) {

                console.log(data.balance);

                $("#balance").html("Your current balance is: "+ data.balance +"TK");
            })
        })
    </script>
@endpush
