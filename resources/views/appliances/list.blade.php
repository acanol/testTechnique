@extends('layouts.app')

@section('content')
    <div class="row-fluid">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{__('appliances.list.'.$category) }}
                </div>
                {!! $appliances->render() !!}
                <div class="panel-body">
                    <div class="row-fluid">
                        <div class="col-xs-12">
                            @foreach($appliances as $appliance)
                                @include('appliances.list-item')
                            @endforeach
                        </div><!--col-md-6-->
                    </div><!--row-->
                </div><!--panel body-->
            </div><!-- panel -->
        </div><!-- col-xs-12 -->
    </div><!-- row -->
@endsection