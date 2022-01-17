<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
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
                <select class="form-select" name="selecting" aria-label="Default select example">
                    <option value="none">None</option>
                    <option value="{{ $data->id }}" hidden class="idTest">yes</option>
                    @foreach ($testOptions as $option)
                        <option value="{{ $option->id }}" {{ $option->id == $data->option_id ? "selected" : '' }} >{{ $option->name }}</option>
                    @endforeach
                </select>
            </div>
        @endforeach

        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="liveToastChecked" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
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

        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="liveToastUncheck" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="" class="rounded me-2" alt="...">
                    <strong class="me-auto">Bootstrap</strong>
                    <small>3 second</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Not Check
                </div>
            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {
            $('select.form-select').change(function() {
                let data_id = $(this).find('.idTest').val();
                let selectedData = $(this).val();
                let selectedText = $(this).find('option:selected').text();
                console.log("data : ",selectedData);
                console.log("text : ",selectedText);
                console.log("id input : ",data_id);
                // $.ajax({
                //     type: "GET",
                //     dataType: "json",
                //     url: "/onSelect",
                //     data: {
                //         'data_id' : data_id,
                //         'selected' : selectedData
                //     }
                // });
            })
        });
        $(function() {
            $('.cekbox').change(function() {

                let statusChecked = $(this).is(':checked');
                let isCheck = statusChecked ? 1 : 0;
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

                let toastLiveChecked = document.getElementById('liveToastChecked');
                let toastLiveUnCheck = document.getElementById('liveToastunCheck');

                let toast = statusChecked
                    ? new bootstrap.Toast(toastLiveChecked)
                    : new bootstrap.Toast(toastLiveUnCheck)
                toast.show();
            });
        });
    </script>
</body>

</html>
