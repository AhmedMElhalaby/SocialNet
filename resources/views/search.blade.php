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
                        <li class="nav-item active">
                            <a class="nav-link fs-15" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item ">
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

    <div class="container mt-5">
        <div class="row">
            <div class="col-3 mobile-hidden">
                <div class="main-block">
                    <div class="coverPicture" style="background: url('{{asset('public/img/cover.jpg')}}');"></div>
                    <div class="profilePicture" style="background: url('{{asset('public/uploads/'.Auth::user()->image)}}');"></div>
                    <div class="FullName text-center  fs-18 ProjectColor ">
                        {{Auth::user()->name}}
                    </div>
                    <div class="row statistic text-center fs-16 p-3">
                        <div class="col "><p>Ferinds</p> <br> <p>{{Auth::user()->friends()->count()}}</p></div>
                        <div class="col border-left"><p>Posts</p> <br> <p>{{Auth::user()->posts()->count()}}</p></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12  mobile-shown">
                <div class="main-block">
                    <ul class="nav nav-pills nav-fill">
                        <li class="nav-item">
                            <a class="nav-link active"  id="Posts-tab" data-toggle="tab" href="#Posts" role="tab" aria-controls="Posts" aria-selected="true">Post's</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  id="People-tab" data-toggle="tab" href="#People" role="tab" aria-controls="People" aria-selected="true">People</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" >
                    <div id="Posts" class="tab-pane fade show active" role="tabpanel" aria-labelledby="Posts-tab">
                        @foreach($Posts as $item)
                            <div class="main-block post-with-photo">
                                <div class="Post-Box">
                                    <div class="header row ">
                                        <div class="col-2">
                                            <div class=" pt-2 pl-2 d-inline-block">
                                                <div class="Profile-Picture " style="background: url('public/uploads/{{$item->User()->image}}') "></div>
                                            </div>
                                        </div>
                                        <div class="col-8 p-l-0">
                                            <div class="UserName d-inline-block mt-3">
                                                <p><a href="{{asset('profile/'.$item->User()->id)}}" class="font-weight-bold">{{$item->User()->name}}</a></p>
                                                <p class="lh-1-2"><a href="" class="fs-10">{{$item->created_at}}</a> <i class="fa fa-globe fs-10" data-toggle="tooltip" data-placement="top" title="Public"></i></p>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="ActionBTN text-right pr-4 pt-4">
                                                <a href="">
                                                    <i class="fa fa-chevron-down"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="mt-0 mb-4">
                                    <div class="body row">
                                        <div class="details col ">
                                            <p class="px-3 ">{{$item->text}}</p>
                                        </div>
                                        @if($item->image != '')
                                            <div class="image col-12 " >
                                                <div class="row pr-3 pt-3 pl-3 ">
                                                    <div class="col"style=" background: url('public/uploads/{{$item->image}}'); height: 350px;background-size: cover;background-position: top center;"></div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    @if($item->image != '')

                                        <hr class="mt-0 mb-0">
                                    @else
                                        <hr class="mt-4 mb-0">
                                    @endif

                                    <div class="footer ">
                                        <div class="row action-btn ">
                                            <div class="col ">
                                                @if($item->isLike())
                                                    <form action="{{asset('postDisLike')}}" method="post">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="post_id" value="{{$item->id}}">
                                                        <p class=" py-2 footer-btn text-center"><button class="myBtn" style="color: #c850c0;"><i class="fa fa-heart" aria-hidden="true"></i> <span class="px-1"> Unlike</span></button></p>
                                                    </form>
                                                @else
                                                    <form action="{{asset('postLike')}}" method="post">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="post_id" value="{{$item->id}}">
                                                        <p class=" py-2 footer-btn text-center"><button class="myBtn"><i class="fa fa-heart-o" aria-hidden="true"></i> <span class="px-1"> Like</span></button></p>
                                                    </form>
                                                @endif
                                            </div>
                                            <div class="col border-left">
                                                <form action="{{asset('PostShare')}}" method="post">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="post_id" value="{{$item->id}}">
                                                    <p class=" py-2 footer-btn text-center"><button class="myBtn"><i class="fa fa-share-square-o" aria-hidden="true"></i> <span class="px-1"> Share</span></button></p>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div id="People" class="tab-pane fade show " role="tabpanel" aria-labelledby="People-tab">
                        <div class="main-block">
                        @foreach($Users as $item)
                            <div class="row">
                                <hr class="m-1">
                                <div class="col-2">
                                    <div class=" pt-2 pl-2 d-inline-block">
                                        <div class="Profile-Picture " style="background: url('{{asset("public/uploads/".$item->image)}}');width: 40px;height: 40px;    border: 1.5px solid #8B54C7; "></div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="UserName d-inline-block mt-3">
                                        <p><a href="{{asset('profile/'.$item->id)}}" class="font-weight-bold">{{$item->name}}</a></p>
                                        <!--<p class="lh-1-2"><a href="" class="fs-10">22:50 PM</a> <i class="fa fa-globe fs-10" data-toggle="tooltip" data-placement="top" title="" data-original-title="Public"></i></p>-->
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>

                </div>

            </div>
            <div class="col-3 mobile-hidden">
                <div class="main-block">
                    <div class="row">
                        <div class="col pl-4"><p class="fs-14 font-cairo font-weight-600">People you may know</p></div>
                    </div>
                    @foreach($PeopleYouMayKnow as $item)
                        <hr class="m-1">
                        <div class="row">
                            <div class="col-3">
                                <div class=" pt-2 pl-2 d-inline-block">
                                    <div class="Profile-Picture " style="background: url('public/uploads/{{$item->image}}');width: 40px;height: 40px;    border: 1.5px solid #8B54C7; "></div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="UserName d-inline-block mt-3">
                                    <p><a href="" class="font-weight-bold">{{$item->name}}</a></p>
                                    <!--<p class="lh-1-2"><a href="" class="fs-10">22:50 PM</a> <i class="fa fa-globe fs-10" data-toggle="tooltip" data-placement="top" title="" data-original-title="Public"></i></p>-->
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

        </div>
    </div>
@endsection
