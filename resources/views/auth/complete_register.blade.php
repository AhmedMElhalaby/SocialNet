@extends('auth.layout')
@section('style')
    <style>
        input[type=date]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            display: none;
        }
    </style>
    <script>
        document.getElementById("PicButton").addEventListener("click", function(event){
            event.preventDefault()
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#avatar')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
@section('content')
<form action="{{asset('PostCompleteRegister')}}" method="post" class="container-fluid" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="row mb-3">
        <div class="col-md-8">
            <p class="fs-18 lh-2-9 font-weight-600">Complete Registration </p>

        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-pal4x btn-sm px-3 py-2 btn-block mt-2"><i class="fa fa-bookmark"></i>  ­   ­ Save & Go Home Page </button>
        </div>
    </div>
    <hr class="mb-5">
    <div class="row">
        <div class="col-md-9">
            <div class="row mb-2">
                <div class="col-md-3">
                    <p class="fs-18 lh-2-9">Date Of Birth :</p>
                </div>
                <div class="col-md-6">
                    <div class="wrap-input100 validate-input" data-validate = "date_of_birth is required">
                        <input class="input100" type="date" name="date_of_birth" placeholder="Date Of Birth">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
			                <i class="fa fa-birthday-cake" aria-hidden="true"></i>
		                </span>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
            <div class="row mb-2">
                <div class="col-md-3">
                    <p class="fs-18 lh-2-9">Nationality :</p>
                </div>
                <div class="col-md-6">
                    <div class="wrap-input100 validate-input" data-validate = "nationality is required">
                        <input class="input100" type="text" name="nationality" placeholder="Nationality">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
			                <i class="fa fa-globe" aria-hidden="true"></i>
		                </span>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
            <div class="row mb-2">
                <div class="col-md-3">
                    <p class="fs-18 lh-2-9">About me :</p>
                </div>
                <div class="col-md-8">
                    <div class="wrap-input100 validate-input" data-validate = "information is required">
                        <textarea class="input100 pt-3  p-r-5" type="text" name="information" placeholder="Information about me .." rows="25" ></textarea>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
			                <i class="fa fa-address-card" aria-hidden="true"></i>
		                </span>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>

        </div>
        <div class="col-md-3">
            <label class="label  mb-3 pull-left" data-width="160" data-toggle="tooltip" title="" data-original-title="press here to choose picture">
                <img class="rounded" id="avatar" src="{{asset('public/img/avatar.png')}}" width="160" height="160" alt="avatar" style="height: 160px">
                <input type="file" class="sr-only" id="input" name="image" accept="image/*" onchange="readURL(this)">
                <a class="btn btn-pal4x btn-sm px-3 py-2 btn-block mt-2 " id="PicButton" onclick=""><i class="fa fa-photo"></i>  ­   ­ Upload Image </a>
            </label>
            <div class="clearfix"></div>
        </div>
    </div>
</form>
@endsection
