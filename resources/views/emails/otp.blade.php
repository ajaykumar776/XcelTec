@extends('layouts.main')

@section('content')

<div class="row" style="margin-top: 100px;">
    <div class="col-4"></div>
    <div class="col-4">
        <h1>One-Time Password (OTP) Verification</h1>
        @if(!$errors->has('verified'))
        <p>Your OTP for email verification is: {{ $otp ?? '' }}</p>
        @endif
        <form action="{{route('otpverification')}}" method="post">
            @if(!$errors->has('verified'))
            @csrf
            <input required class="form-control" type="text" name="otp" placeholder="enter otp">
            @if ($errors->has('otp'))
            <div class="alert alert-danger mt-1">
                {{ $errors->first('otp') }}
            </div>
            @endif
            <input class="form-control btn btn-primary mt-2" style="width: 30%; float:right" type="submit" value="Verify">
            @endif
            @if ($errors->has('verified'))
            <div class="alert alert-success mt-1">
                {{ $errors->first('verified') }} <span><a href="{{route('dashboard')}}"> Redirecting in <span id="countdown">15</span> seconds...</a></span>
            </div>
            @endif
        </form>
    </div>
    <div>

    </div>
    <div class="col-4"></div>
</div>
<script>
    function redirectAfter30Seconds() {
        window.location.href = "{{ route('dashboard') }}";
    }
    let countdownTime = 15;

    function updateTimer() {
        const countdownElement = document.getElementById('countdown');
        countdownElement.textContent = countdownTime;
        countdownTime--;
        if (countdownTime < 0) {
            redirectAfter30Seconds();
        }
    }
    const timerInterval = setInterval(updateTimer, 1000);
</script>


@endsection