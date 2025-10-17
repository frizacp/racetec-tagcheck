@extends('layouts.tagging')

@section('title', 'Tag Check')

@section('footer')
<script>
    function chipCode() {
        var code = $("#code").val()

        // setInterval #code disable for 5 second after scan tag to prevent duplicate
        $("#code").attr("disabled", true);
        setTimeout(function() {
            $("#code").attr("disabled", false);
            $("#code").focus();
        }, 10000);

        $.ajax({
            url: "{{ route('tagcheck.index') }}",
            type: "GET",
            data: {
                _token: "{{ csrf_token() }}",
                code: code.substring(0, 24),
                key: "show"
            },
            success: function(data) {
                if (data.status == 200) {
                    $("#resultBib").html(data.data.bib);
                    $("#resultname").html(data.data.firstname + " " + data.data.lastname);
                    $("#resultTime").html(data.data.time);
                    $("#contest").html(data.data.contest);
                    $("#pace").html(data.data.pace);
                } else {
                    $("#resultBib").html("Not Found");
                    $("#resultName").html("Not Found");
                    $("#resultTime").html("Not Found");
                    $("#contest").html("Not Found");
                    $("#pace").html("Not Found");
                }

                $("#code").val("")
            }
        });
    };
</script>
@endsection

@section('header')
<style>
    body {
        background-image: url('/img/bg_white.png');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: top;
        color: #131416 !important;
    }

    input {
        background-color: transparent !important;
        color: transparent !important;
    }

    input:focus {
        outline: none !important;
        border: 0;
    }

    h2 {
        font-size: 50px !important;
        margin: 0 !important;
        font-weight: bold !important;
    }

    h3 {
        font-size: 35px !important;
        margin: 0 !important;
        font-weight: bold !important;
    }

    h4 {
        font-size: 60px !important;
        margin: 0 !important;
        font-weight: bold !important;
    }

    h5 {
        font-size: 40px !important;
        margin: 0 !important;
        font-weight: bold !important;
    }

    h1 {
        font-size: 100px !important;
        font-weight: bold !important;
    }

    .bibTag {
        padding-top: 20px
    }
</style>
@endsection

@section('content')
<input type="text" class="border-0" autofocus style="width: 100%; height: 100%; position: fixed" autocomplete="off" id="code" onchange="chipCode()">
<div class="bibTag">


    <div class="d-flex flex-column justify-content-center align-items-center" style="min-height: 85vh;">
        <div class="text-center pt-3">
            <div class="d-flex flex-column justify-content-center align-items-center" style="min-height: 85vh;">

                <h5 class="text-uppercase" id="resultname" style="color: #181818; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);">NAME</h5>
                <h2 class="text-uppercase" id="resultBib" style="color: #181818; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);">BIB</h2>
                <h5 class="text-uppercase" id="contest" style="color: #181818; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);">CONTEST</h5>
            </div>
        </div>
    </div>

</div>



{{--

 <img src="/img/logo_broder.png" class="w-auto mb-3" style="height: 40px;" alt="Logo">
    <h4 class="text-uppercase py-2 px-md-5 mt-lg-5 mb-2" style="background-color: #BF0001; color: #FFFFFF;">CONGRATULATION</h4>
        <h2 class="text-uppercase" id="resultname" style="color: #FFFFFF">NAME</h2>
        <div class="flex justify-content-center align-items-center" style="gap: 60px; margin-top: 10px;">
            <div>
                <h5 class="text-uppercase text-center" id="contest" style="color: #FFFFFF">CONTEST</h5>
                <h2 class="text-uppercase text-center" id="resultBib" style="color: #FFFFFF">BIB</h2>
            </div>
            <div style="border: 4px solid #FFFFFF; border-radius: 15px; padding: 20px; margin-top: 10px;">
                <h2 id="resultTime" style="color: #FFFFFF">RESULT : TIME</h2>
            </div>
        </div>


    --}}


<div class="text-center">
</div>
</div>
@endsection