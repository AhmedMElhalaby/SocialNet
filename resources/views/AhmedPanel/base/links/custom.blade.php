@if($link['condition']($object))<a href="{{url($redirect.'/'.$object->id.'/'.$link['route'])}}" data-toggle="tooltip" data-placement="bottom" title="{{$link['lang']}}" class="fs-20"><i class="fa {{$link['icon']}}"></i></a>@endif