@extends('layouts.tagging')

@section('title', 'Tag Check')

@section('footer')
<script>
function chipCode() {
    var code    =   $("#code").val()

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
            _token  :   "{{ csrf_token() }}",
            code    :   code.substring(0, 24) ,
            key     :   "show"
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
    background-image: url('/img/bg_tins.webp');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: top;
    color: #131416!important;
}

input {
    background-color: transparent!important;
    color: transparent!important;
}

input:focus {
    outline: none !important;
    border:0;
}

h2 {
    font-size: 55px!important;
    margin: 0!important;
    font-weight: bold!important;
}

h3 {
    font-size: 40px!important;
    margin: 0!important;
    font-weight: bold!important;
}

h4 {
    font-size: 75px!important;
    margin: 0!important;
    font-weight: bold!important;
}
h5 {
    font-size: 40px!important;
    margin: 0!important;
    font-weight: bold!important;
}

h1 {
    font-size: 100px!important;
    font-weight: bold!important;
}

.bibTag {
    padding-top: 20px
}
</style>
@endsection

@section('content')
<input type="text" class="border-0" autofocus style="width: 100%; height: 100%; position: fixed" autocomplete="off" id="code" onchange="chipCode()">
<div class="bibTag">
    <div class="text-center">
        <div class="d-flex flex-column justify-content-center align-items-center" style="min-height: 90vh;">
            <h2 class="text-uppercase mt-3 mb-3" id="resultname" style="color: #FFFFFF">Name</h2>

            <div class="d-flex justify-content-center align-items-center" style="gap: 60px; margin-top: 5px;">
                <div>
                    <h5 class="text-uppercase" id="contest" style="color: #FFFFFF">contest</h5>
                    <h2 class="text-uppercase" id="resultBib" style="color: #FFFFFF">bib</h2>
                </div>
            </div>
        </div>
{{--
    </div>
        <div class="text-center mt-4">
        <img src="/img/logo_str25.png" alt="Logo" style="max-width: 130px; margin-bottom: 10px;" class='mt-5'>
        <h4 class="text-uppercase mt-3 mb-3" style="background-color: #990000; color: #FFFFFF ; padding-top: 10px; padding-bottom: 10px;">CONGRATULATION</h4>
        <h2 class="text-uppercase mt-3 mb-3" id="resultname" style="color: #FFFFFF">resultname</h2>
        <div class="d-flex justify-content-center align-items-center" style="gap: 60px; margin-top: 50px;">
            <div>
            <h5 class="text-uppercase" id="contest" style="color: #FFFFFF">contest</h5>
            <h2 class="text-uppercase" id="resultBib" style="color: #FFFFFF">bib</h2>
            </div>
            <div style="border: 4px solid #FFFFFF; border-radius: 15px; padding: 20px;">
                <h2 id="resultTime" style="color: #FFFFFF">resultTime</h2>
            </div>
        </div>
    </div>--}}
    

    <div class="text-center">
    </div>
</div>
@endsection
