@if ($errors->has('status'))
    <div class="alert-container show">
        <div class="alert alert-danger auto-hide">
            <h5 class="text-danger">{{ session('status') }}</h5>
        </div>
    </div>
@endif

@error('error')
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror

@if ($errors->has('email'))
    <div class="alert-container show">
        <div class="alert alert-danger auto-hide">
            <h5 class="text-danger">{{ $errors->first('email') }}</h5>
        </div>
    </div>
@endif

@if ($errors->has('password'))
    <div class="alert-container show">
        <div class="alert alert-danger auto-hide">
            <h5 class="text-danger">{{ $errors->first('password') }}</h5>
        </div>
    </div>
@endif

@if (session('delete_account_status'))
    <div class="alert-container show">
        <div class="alert alert-success auto-hide">
            <h5 class="text-success">
                {{ session('delete_account_status') }}
            </h5>
        </div>
    </div>
@elseif (session('delete_account_error'))
    <div class="alert-container show">
        <div class="alert alert-danger auto-hide">
            <h5 class="text-success">
                {{ session('delete_account_error') }}
            </h5>
        </div>
    </div>
@endif
