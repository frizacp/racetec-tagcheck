@extends('layouts.tagging')

@section('title', 'Tag Check')

@section('footer')
<script>
    function showDefault() {
        console.log("🔁 Kembali ke default view");

        $("#resultname").html('<h1 id="blinkText" style="color:#FFFFFF;">Check bib here</h1>');
        $("#contest").html("");
        $("#resultBib").html("");
        $("#resultTime").html("");
        $("#pace").html("");

        // pastikan box waktu disembunyikan
        $("#resultSection").hide();
    }

    function chipCode() {
        var code = $("#code").val();
        console.log("📥 Input BIB Code:", code);

        $("#code").attr("disabled", true);
        setTimeout(function() {
            $("#code").attr("disabled", false);
            $("#code").focus();
        }, 5000);

        $.ajax({
            url: "{{ route('tagcheck.index') }}",
            type: "GET",
            data: {
                _token: "{{ csrf_token() }}",
                code: code.substring(0, 24),
                key: "show"
            },
            success: function(data) {
                console.log("✅ Response dari server:", data);

                clearTimeout(window.defaultTimer);

                if (data.status == 200) {
                    $("#resultBib").html(data.data.bib);
                    $("#resultname").html(data.data.firstname + " " + data.data.lastname);
                    $("#resultTime").html(data.data.time);
                    $("#contest").html(data.data.contest);
                    $("#pace").html(data.data.pace);

                    console.log("🟢 Data ditemukan:", data.data);

                    // ✅ perbaikan: hide / show langsung ke #resultSection
                    if (!data.data.time || data.data.time.trim() === "" || data.data.time === "00:00:00") {
                        console.log("⚠️ Time kosong atau 00:00:00 → sembunyikan box result");
                        $("#resultSection").hide();
                    } else {
                        $("#resultSection").show();
                    }

                } else {
                    console.log("🔴 Data tidak ditemukan");
                    $("#resultBib").html("Not Found");
                    $("#resultname").html("Not Found");
                    $("#resultTime").html("Not Found");
                    $("#contest").html("Not Found");
                    $("#pace").html("Not Found");
                    $("#resultSection").show();
                }

                $("#code").val("");

                // ⏳ Setelah 7 detik, balik ke tampilan default
                window.defaultTimer = setTimeout(showDefault, 14000);
            },
            error: function(xhr, status, error) {
                console.error("❌ AJAX Error:", status, error);
            }
        });
    }

    $(document).ready(function() {
        showDefault();
    });
</script>
@endsection

@section('header')
<style>
    @font-face {
        font-family: 'Gotham Ultra';
        src: url('/fonts/Gotham_Ultra.otf') format('opentype');
        font-weight: 700;
        font-style: normal;
    }

    @font-face {
        font-family: 'Gotham Ultra';
        src: url('/fonts/Gotham_Ultra_Italic.ttf') format('opentype');
        font-weight: 700;
        font-style: italic;
    }

    body {
        font-family: 'Gotham Ultra', sans-serif;
        background-image: url('/img/votcha.jpg');
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

    @keyframes blink {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    h1 {
        font-size: 80px !important;
        animation: blink 3s infinite;
    }

    h2 {
        font-family: 'Gotham Ultra', sans-serif !important;
        font-style: italic !important;
        font-size: 80px !important;
        margin: 0 !important;
        font-weight: bold !important;
    }

    h3 {
        font-family: 'Gotham Ultra', sans-serif !important;
        font-size: 60px !important;
        margin: 0 !important;
        font-weight: bold !important;
        font-style: italic;
    }

    h4 {
        font-family: 'Gotham Ultra', sans-serif !important;
        font-style: italic !important;
        font-size: 60px !important;
        margin: 0 !important;
        font-weight: bold !important;
    }

    h5 {
        font-family: 'Gotham Ultra', sans-serif !important;
        font-size: 40px !important;
        margin: 0 !important;
        font-weight: bold !important;
        font-style: italic;
    }

    .img-logo {
        display: block;
        margin: 0 auto;
        max-width: 350px;
        height: auto;
    }

    .bibTag {
        padding-top: 20px;
    }
</style>
@endsection

@section('content')
<input type="text" class="border-0" autofocus style="width: 100%; height: 100%; position: fixed"
    autocomplete="off" id="code" onchange="chipCode()">

<div class="bibTag">
    <div class="d-flex flex-column justify-content-center align-items-center" style="min-height: 85vh;">
        <div class="text-center pt-2">
            <h2 class="text-uppercase" id="resultname" style="color: #FFFF00;">NAMA</h2>
            <div class="d-flex justify-content-center align-items-center" style="gap: 60px; margin-top: 10px;">
                <div>
                    <h5 class="text-uppercase text-center" id="contest" style="color: #FFFFFF"></h5>
                    <h3 class="text-uppercase" id="resultBib" style="color: #ffffff;"></h3>
                </div>
                <div id="resultSection" style="border: 4px solid #FFFFFF; border-radius: 15px; padding: 20px; margin-top: 10px;">
                    <h4 id="resultTime" style="color: #FFFF00">RESULT : TIME</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection