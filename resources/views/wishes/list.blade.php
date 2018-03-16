@extends('layouts.app')

@section('content')
    <div class="row-fluid">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                        {{trans('appliances.wishlist.mywishlist') }}
                </div>
                {!! $appliances->render() !!}
                <div class="panel-body">
                    <div class="row-fluid">
                        <div class="col-xs-12">
                            @if(count($appliances) > 0)
                                @foreach($appliances as $appliance)
                                    @include('wishes.list-item')
                                @endforeach
                            @else
                                {{ trans('wishlist.empty') }}
                            @endif
                        </div><!--col-md-6-->
                    </div><!--row-->
                </div><!--panel body-->
            </div><!-- panel -->
        </div><!-- col-xs-12 -->
    </div><!-- row -->
@endsection