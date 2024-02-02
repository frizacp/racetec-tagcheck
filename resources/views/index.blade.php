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
    }, 5000);

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
                $("#resultName").html(data.data.name);
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
    background-image: url('/img/tag-check.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: top;
    color: #000!important
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
    font-size: 60px!important;
    margin: 0!important;
    font-weight: bold!important;
}

h1 {
    font-size: 200px!important
}

.bibTag {
    margin-top: 320px
}
</style>
@endsection

@section('content')
<input type="text" class="border-0" autofocus autocomplete="off" id="code" onchange="chipCode()">
<div class="bibTag">
    <div class="mb-3 text-center">
        <h2 id="resultBib">####</h2>
        <h2 id="resultName">####</h2>
    </div>

    <h1 class="text-center" id="resultTime">##:##:##</h1>

    <div class="text-center">
        <h2 id="pace">####</h2>
        <h2 id="contest">########</h2>
    </div>
</div>
@endsection
