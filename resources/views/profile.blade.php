@extends('app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-light  bgwhite">
                <a class="navbar-brand ProjectColor" href="{{ url('/') }}">SocialNet</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item ">
                            <a class="nav-link fs-15" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link fs-15" href="{{url('profile/'.Auth::user()->id)}}">Profile</a>
                        </li>
                        <li class="nav-item pt-2 pl-3">
                            <form action="{{url('search')}}" method="get" >
                                <input type="search" name="search" class="p-1 fs-14 pl-3 input-border"  placeholder="Search .. !">
                            </form>
                        </li>
                    </ul>
                    <div class="form-inline my-2 my-lg-0">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                <a class="nav-link fs-18" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" data-toggle="tooltip" data-placement="top" title="Log out !"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title float-l" id="myModalLabel">Confirmation !!</h4>
                </div>
                <div class="modal-body">
                    Are you sure that you want to delete account ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-pal4x" data-dismiss="modal">Close</button>
                    <a href="{{asset('Delete-Account/'.$User->id)}}" class="btn btn-pal4x-danger">Yes Delete It </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col ">
                <div class="main-block">
                    <div class="coverPicture" style="background: url({{asset('public/img/cover.jpg')}});"></div>
                    <div class=" PictureProfile" style="background: url('{{asset("public/uploads/".$User->image)}}');"></div>
                    <div class="NameFull   fs-18 ProjectColor " >
                        {{$User->name}}
                    </div>
                    @if(Auth::user()->id !=$User->id)

                        @if($User->isFriend())
                            <form action="{{asset('DeleteFriend')}}" class="Follow pull-right" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="friend_id" value="{{ $User->id}}">
                                <div class=""><button class="btn btn-pal4x-danger">Delete Friend</button></div>
                            </form>
                        @else
                            <form action="{{asset('AddFriend')}}" class="Follow pull-right" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="friend_id" value="{{ $User->id}}">
                                <div class=""><button class="btn btn-pal4x">Add Friend</button></div>
                            </form>
                        @endif
                    @else
                        <div class="Follow pull-right"><a href="{{asset('Edit-Profile/'.$User->id)}}" class="btn btn-pal4x">Edit Profile</a></div>
                        <div class="Follow pull-right">
                            <a href="" class=" btn btn-pal4x-danger" data-toggle="modal" data-target="#myModal">Delete Account</a>
                        </div>
                    @endif
                    <!--<div class="row statistic text-center fs-16 p-3">-->
                    <!--<div class="col "><p>Ferinds</p> <br> <p>10</p></div>-->
                    <!--<div class="col border-left"><p>Posts</p> <br> <p>5</p></div>-->
                    <!--</div>-->
                </div>
            </div>

        </div>
    </div>
    <div class="container mt-5">
        <div class="main-block">
            <div class="row">
                <div class="mb-3 mt-3">
                    <a href="#" class="pl-5 font-weight-700 fs-18"><i class="fa fa-info-circle fa-fw"></i> &shy; Information </a>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 mt-3">
                    <p href="#" class="pl-5 pr-5 font-weight-700 fs-18"> &shy; {{$User->information}} </p>
                </div>
            </div>
            <hr class="ml-4 mr-4">
            <div class="row pl-5 pr-5">
                <div class="col-12 col-md-6">
                    <p class="font-size-14 font-weight-700 pt-4 pb-4"> <i class="fa fa-user fa-fw"></i>  &shy; Name &shy;  : &shy; <span>{{$User->name}}</span> </p>
                    <p class="font-size-14 font-weight-700 pt-4 pb-4"> <i class="fa fa-envelope fa-fw"></i> &shy;  Email  &shy; : &shy;  <span>{{$User->email}}</span> </p>
                </div>
                <div class="col-12 col-md-6">
                    <p class="font-size-14 font-weight-700 pt-4 pb-4"> <i class="fa fa-fw fa-globe"></i> &shy; Nationality &shy; : &shy;   <span>{{$User->nationality}}</span>  </p>
                    <p class="font-size-14 font-weight-700 pt-4 pb-4"> <i class="fa fa-birthday-cake fa-fw"></i>  &shy; Birthday &shy;  : &shy;    <span>{{$User->date_of_birth}}</span> </p>
                </div>
            </div>
        </div>
    </div>

@endsection
