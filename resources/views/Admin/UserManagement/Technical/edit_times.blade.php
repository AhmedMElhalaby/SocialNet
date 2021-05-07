@extends('AhmedPanel.crud.main')
@section('title') | {{__('crud.TechnicalTime.crud_the_name')}} @endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="{{ config('app.color') }}">
                    <h4 class="title">{{__(('crud.TechnicalTime.crud_the_name'))}}</h4>
                </div>
                <div class="card-content">
                    <form action="{{url($redirect.'/'.$Object->id.'/edit_times')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label for="saturday" class="control-label">{{__('crud.TechnicalTime.saturday')}} *</label>
                                    <select name="saturday" style="margin: 0;padding: 0" id="saturday" class="form-control" onchange="ChangeValue(this,'saturday')">
                                        <option value="1" @if($UserTime->getSaturday() == true) selected @endif>{{__('admin.true')}}</option>
                                        <option value="0" @if($UserTime->getSaturday() == false) selected @endif>{{__('admin.false')}}</option>
                                    </select>
                                </div>
                                @if ($errors->has('saturday'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('saturday') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12 @if(!$UserTime->getSaturday()) hidden @endif" id="saturday_div">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label for="saturday_start" class="control-label">{{__('crud.TechnicalTime.saturday_start')}} *</label>
                                            <input type="time" id="saturday_start" name="saturday_start" required class="form-control {{ $errors->has('saturday_start') ? ' is-invalid' : '' }}" value="{{\Carbon\Carbon::parse($UserTime->getSaturdayStart())->format('H:i')}}">
                                        </div>
                                        @if ($errors->has('saturday_start'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('saturday_start') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label for="saturday_end" class="control-label">{{__('crud.TechnicalTime.saturday_end')}} *</label>
                                            <input type="time" id="saturday_end" name="saturday_end" required class="form-control {{ $errors->has('saturday_end') ? ' is-invalid' : '' }}" value="{{\Carbon\Carbon::parse($UserTime->getSaturdayEnd())->format('H:i')}}">
                                        </div>
                                        @if ($errors->has('saturday_end'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('saturday_end') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label for="sunday" class="control-label">{{__('crud.TechnicalTime.sunday')}} *</label>
                                    <select name="sunday" style="margin: 0;padding: 0" id="sunday" class="form-control" onchange="ChangeValue(this,'sunday')">
                                        <option value="1" @if($UserTime->getSunday() == true) selected @endif>{{__('admin.true')}}</option>
                                        <option value="0" @if($UserTime->getSunday() == false) selected @endif>{{__('admin.false')}}</option>
                                    </select>
                                </div>
                                @if ($errors->has('sunday'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('sunday') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12 @if(!$UserTime->getSunday()) hidden @endif" id="sunday_div">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label for="sunday_start" class="control-label">{{__('crud.TechnicalTime.sunday_start')}} *</label>
                                            <input type="time" id="sunday_start" name="sunday_start" required class="form-control {{ $errors->has('sunday_start') ? ' is-invalid' : '' }}" value="{{\Carbon\Carbon::parse($UserTime->getSundayStart())->format('H:i')}}">
                                        </div>
                                        @if ($errors->has('sunday_start'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('sunday_start') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label for="sunday_end" class="control-label">{{__('crud.TechnicalTime.sunday_end')}} *</label>
                                            <input type="time" id="sunday_end" name="sunday_end" required class="form-control {{ $errors->has('sunday_end') ? ' is-invalid' : '' }}" value="{{\Carbon\Carbon::parse($UserTime->getSundayEnd())->format('H:i')}}">
                                        </div>
                                        @if ($errors->has('sunday_end'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('sunday_end') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label for="monday" class="control-label">{{__('crud.TechnicalTime.monday')}} *</label>
                                    <select name="monday" style="margin: 0;padding: 0" id="monday" class="form-control" onchange="ChangeValue(this,'monday')">
                                        <option value="1" @if($UserTime->getMonday() == true) selected @endif>{{__('admin.true')}}</option>
                                        <option value="0" @if($UserTime->getMonday() == false) selected @endif>{{__('admin.false')}}</option>
                                    </select>
                                </div>
                                @if ($errors->has('monday'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('monday') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12 @if(!$UserTime->getMonday()) hidden @endif" id="monday_div">
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label for="monday_start" class="control-label">{{__('crud.TechnicalTime.monday_start')}} *</label>
                                        <input type="time" id="monday_start" name="monday_start" required class="form-control {{ $errors->has('monday_start') ? ' is-invalid' : '' }}" value="{{\Carbon\Carbon::parse($UserTime->getMondayStart())->format('H:i')}}">
                                    </div>
                                    @if ($errors->has('monday_start'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('monday_start') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label for="monday_end" class="control-label">{{__('crud.TechnicalTime.monday_end')}} *</label>
                                            <input type="time" id="monday_end" name="monday_end" required class="form-control {{ $errors->has('monday_end') ? ' is-invalid' : '' }}" value="{{\Carbon\Carbon::parse($UserTime->getMondayEnd())->format('H:i')}}">
                                        </div>
                                        @if ($errors->has('monday_end'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('monday_end') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label for="tuesday" class="control-label">{{__('crud.TechnicalTime.tuesday')}} *</label>
                                    <select name="tuesday" style="margin: 0;padding: 0" id="tuesday" class="form-control" onchange="ChangeValue(this,'tuesday')">
                                        <option value="1" @if($UserTime->getTuesday() == true) selected @endif>{{__('admin.true')}}</option>
                                        <option value="0" @if($UserTime->getTuesday() == false) selected @endif>{{__('admin.false')}}</option>
                                    </select>
                                </div>
                                @if ($errors->has('tuesday'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tuesday') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12 @if(!$UserTime->getTuesday()) hidden @endif" id="tuesday_div">
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label for="tuesday_start" class="control-label">{{__('crud.TechnicalTime.tuesday_start')}} *</label>
                                        <input type="time" id="tuesday_start" name="tuesday_start" required class="form-control {{ $errors->has('tuesday_start') ? ' is-invalid' : '' }}" value="{{\Carbon\Carbon::parse($UserTime->getTuesdayStart())->format('H:i')}}">
                                    </div>
                                    @if ($errors->has('tuesday_start'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('tuesday_start') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label for="tuesday_end" class="control-label">{{__('crud.TechnicalTime.tuesday_end')}} *</label>
                                            <input type="time" id="tuesday_end" name="tuesday_end" required class="form-control {{ $errors->has('tuesday_end') ? ' is-invalid' : '' }}" value="{{\Carbon\Carbon::parse($UserTime->getTuesdayEnd())->format('H:i')}}">
                                        </div>
                                        @if ($errors->has('tuesday_end'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('tuesday_end') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label for="wednesday" class="control-label">{{__('crud.TechnicalTime.wednesday')}} *</label>
                                    <select name="wednesday" style="margin: 0;padding: 0" id="wednesday" class="form-control" onchange="ChangeValue(this,'wednesday')">
                                        <option value="1" @if($UserTime->getWednesday() == true) selected @endif>{{__('admin.true')}}</option>
                                        <option value="0" @if($UserTime->getWednesday() == false) selected @endif>{{__('admin.false')}}</option>
                                    </select>
                                </div>
                                @if ($errors->has('wednesday'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('wednesday') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12 @if(!$UserTime->getWednesday()) hidden @endif" id="wednesday_div">
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label for="wednesday_start" class="control-label">{{__('crud.TechnicalTime.wednesday_start')}} *</label>
                                        <input type="time" id="wednesday_start" name="wednesday_start" required class="form-control {{ $errors->has('wednesday_start') ? ' is-invalid' : '' }}" value="{{\Carbon\Carbon::parse($UserTime->getWednesdayStart())->format('H:i')}}">
                                    </div>
                                    @if ($errors->has('wednesday_start'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('wednesday_start') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label for="wednesday_end" class="control-label">{{__('crud.TechnicalTime.wednesday_end')}} *</label>
                                            <input type="time" id="wednesday_end" name="wednesday_end" required class="form-control {{ $errors->has('wednesday_end') ? ' is-invalid' : '' }}" value="{{\Carbon\Carbon::parse($UserTime->getWednesdayEnd())->format('H:i')}}">
                                        </div>
                                        @if ($errors->has('wednesday_end'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('wednesday_end') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label for="thursday" class="control-label">{{__('crud.TechnicalTime.thursday')}} *</label>
                                    <select name="thursday" style="margin: 0;padding: 0" id="thursday" class="form-control" onchange="ChangeValue(this,'thursday')">
                                        <option value="1" @if($UserTime->getThursday() == true) selected @endif>{{__('admin.true')}}</option>
                                        <option value="0" @if($UserTime->getThursday() == false) selected @endif>{{__('admin.false')}}</option>
                                    </select>
                                </div>
                                @if ($errors->has('thursday'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('thursday') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12 @if(!$UserTime->getThursday()) hidden @endif" id="thursday_div">
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label for="thursday_start" class="control-label">{{__('crud.TechnicalTime.thursday_start')}} *</label>
                                        <input type="time" id="thursday_start" name="thursday_start" required class="form-control {{ $errors->has('thursday_start') ? ' is-invalid' : '' }}" value="{{\Carbon\Carbon::parse($UserTime->getThursdayStart())->format('H:i')}}">
                                    </div>
                                    @if ($errors->has('thursday_start'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('thursday_start') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label for="thursday_end" class="control-label">{{__('crud.TechnicalTime.thursday_end')}} *</label>
                                            <input type="time" id="thursday_end" name="thursday_end" required class="form-control {{ $errors->has('thursday_end') ? ' is-invalid' : '' }}" value="{{\Carbon\Carbon::parse($UserTime->getThursdayEnd())->format('H:i')}}">
                                        </div>
                                        @if ($errors->has('thursday_end'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('thursday_end') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label for="friday" class="control-label">{{__('crud.TechnicalTime.friday')}} *</label>
                                    <select name="friday" style="margin: 0;padding: 0" id="friday" class="form-control" onchange="ChangeValue(this,'friday')">
                                        <option value="1" @if($UserTime->getFriday() == true) selected @endif>{{__('admin.true')}}</option>
                                        <option value="0" @if($UserTime->getFriday() == false) selected @endif>{{__('admin.false')}}</option>
                                    </select>
                                </div>
                                @if ($errors->has('friday'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('friday') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12 @if(!$UserTime->getFriday()) hidden @endif" id="friday_div">
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label for="friday_start" class="control-label">{{__('crud.TechnicalTime.friday_start')}} *</label>
                                        <input type="time" id="friday_start" name="friday_start" required class="form-control {{ $errors->has('friday_start') ? ' is-invalid' : '' }}" value="{{\Carbon\Carbon::parse($UserTime->getFridayStart())->format('H:i')}}">
                                    </div>
                                    @if ($errors->has('friday_start'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('friday_start') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label for="friday_end" class="control-label">{{__('crud.TechnicalTime.friday_end')}} *</label>
                                            <input type="time" id="friday_end" name="friday_end" required class="form-control {{ $errors->has('friday_end') ? ' is-invalid' : '' }}" value="{{\Carbon\Carbon::parse($UserTime->getFridayEnd())->format('H:i')}}">
                                        </div>
                                        @if ($errors->has('friday_end'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('friday_end') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row submit-btn">
                            <button type="submit" class="btn btn-primary" style="margin-left:15px;margin-right:15px;">{{__('admin.save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        function ChangeValue(select,id){
            if ($(select).val() === '1'){
                $('#'+id+'_div').removeClass('hidden');
            }else{
                $('#'+id+'_div').addClass('hidden');
            }
        }
    </script>
@endsection
