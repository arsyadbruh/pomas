<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}
</head>

<body class="bg-light">

    <div class="w-100 d-flex justify-content-center align-items-center flex-column" style="height: 100vh">
        <h1>Testing Area</h1>

        @foreach ($testdata as $data)
            <div class="form-check d-flex align-items-center justify-content-between">
                <input class="form-check-input m-0 cekbox" type="checkbox" name="cekbok"
                    style="width: 28px; height: 28px" {{ $data->status_test == true ? 'checked' : null }}
                    value="{{ $data->id }}">
                <label class="form-check-label fs-4 ms-3">{{ $data->name }}</label>
            </div>
        @endforeach

        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="" class="rounded me-2" alt="...">
                    <strong class="me-auto">Bootstrap</strong>
                    <small>3 second</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Input Checked
                </div>
            </div>
        </div>
    </div>



    <script>


        $(function() {
            $('.cekbox').change(function() {
                let toastLiveExample = document.getElementById('liveToast');
                let statusChecked = $(this).is(':checked');
                let isCheck =  statusChecked ? 1 : 0;
                let data_id = $(this).val();
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/onStatus',
                    data: {
                        'status': isCheck,
                        'data_id': data_id
                    },
                    success: function(data) {
                        console.log('success change status');
                    }
                })

                let toast = new bootstrap.Toast(toastLiveExample);
                toast.show();

            });
        });
    </script>
</body>

</html>
