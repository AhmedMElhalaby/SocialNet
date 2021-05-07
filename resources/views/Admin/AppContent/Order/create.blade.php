@extends('AhmedPanel.crud.main')
@section('title') | {{__('admin.add')}} {{__('crud.'.$lang.'.crud_name')}} @endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="{{ config('app.color') }}">
                    <h4 class="title">{{__('admin.add')}} {{__('crud.'.$lang.'.crud_name')}}</h4>
                </div>
                <div class="card-content">
                    <form action="{{url($redirect)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            @foreach($Fields as $Field)
                                {!! \App\Traits\AhmedPanelTrait::Fields($Field,old($Field['name']),$lang) !!}
                            @endforeach
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
        $('#technical_id').on('change',function (){
            let technical_id = $(this).val();
            $.get('{{url('api/home/technical_categories')}}',{technical_id},function (response){
                if (response.status.status === 'success'){
                    $('#category_id').html('<option>-</option>');
                    $('#issue_id').html('<option>-</option>');
                    $('#issue_type_id').html('<option>-</option>');
                    response.Categories.forEach(category=>{
                        $('#category_id').append('<option value="'+category.id+'">'+category.name+'</option>');
                    });
                }else{
                    console.log(response.status.message);
                }
            });
        });
        $('#category_id').on('change',function (){
            let category_id = $(this).val();
            $.get('{{url('api/home/category_issues')}}',{category_id},function (response){
                if (response.status.status === 'success'){
                    $('#issue_id').html('<option>-</option>');
                    $('#issue_type_id').html('<option>-</option>');
                    response.Issues.forEach(issue=>{
                        $('#issue_id').append('<option value="'+issue.id+'">'+issue.name+'</option>');
                    });
                }else{
                    console.log(response.status.message);
                }
            });
        });
        $('#issue_id').on('change',function (){
            let issue_id = $(this).val();
            $.get('{{url('api/home/issue_issue_types')}}',{issue_id},function (response){
                if (response.status.status === 'success'){
                    $('#issue_type_id').html('<option>-</option>');
                    response.IssueTypes.forEach(issue_type=>{
                        $('#issue_type_id').append('<option value="'+issue_type.id+'">'+issue_type.name+'</option>');
                    });
                }else{
                    console.log(response.status.message);
                }
            });
        });
    </script>
@endsection
