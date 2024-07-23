@if ($errors->any())
    <div class="alert alert-danger" role="alert" id="myAlert">
        @foreach ($errors->all() as $error)
            {{ $error }} <br>
        @endforeach
    </div>
@else
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert" id="myAlert">
            {{ session('success') }}
        </div>
    @elseif (session()->has('error'))
        <div class="alert alert-danger" role="alert" id="myAlert">
            {{ session('error') }}
        </div>
    @elseif (session()->has('error_message'))
        <div class="alert alert-danger" role="alert" id="myAlert">
            {{ session('error_message') }}
        </div>
    @endif
@endif

@php
    $success = session('success');
    $error_message = session('error_message');
    $error = session('error');
    $errors = $errors->getBag('default')->getMessages();

    if ($success) {
        DB::table('g59_logs')->insert([
            'user_id' => auth()->user() ? auth()->user()->username : 'auth',
            'status' => 'success',
            'message' => $success,
            'url' => url()->previous(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    if ($error_message) {
        DB::table('g59_logs')->insert([
            'user_id' => auth()->user() ? auth()->user()->username : 'auth',
            'status' => 'error',
            'message' => $error_message,
            'url' => url()->previous(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
    if ($error) {
        DB::table('g59_logs')->insert([
            'user_id' => auth()->user() ? auth()->user()->username : 'auth',
            'status' => 'error',
            'message' => $error,
            'url' => url()->previous(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    if ($errors) {
        DB::table('g59_logs')->insert([
            'user_id' => auth()->user() ? auth()->user()->username : 'auth',
            'status' => 'multi-error',
            'message' => json_encode($errors),
            'url' => url()->previous(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
@endphp

<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

<script>
    setTimeout(function() {
        var alert = document.getElementById('myAlert');
        alert.style.display = 'none';
    }, 2000);

    const success = "{{ $success }}";
    const error_message = "{{ $error_message }}";
    const errors = {!! json_encode($errors) !!};


    if (success) {
        Toastify({
            text: success,
            duration: 3000,
            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)"
        }).showToast();
    }
    if (error_message) {
        Toastify({
            text: error_message,
            duration: 3000,
            backgroundColor: "linear-gradient(to right, #ff512f, #f09819)"
        }).showToast();
    }

    Object.keys(errors).forEach(function(key) {
        errors[key].forEach(function(error) {
            Toastify({
                text: error,
                duration: 3000,
                backgroundColor: key === 'success' ?
                    "linear-gradient(to right, #00b09b, #96c93d)" :
                    "linear-gradient(to right, #ff512f, #f09819)"
            }).showToast();
        });
    });
</script>
