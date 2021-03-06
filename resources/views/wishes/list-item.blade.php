<div class="panel panel-default">
    <div class="panel-heading">
        <h4>{{ $appliance->title }}</h4>
    </div><!--panel-heading-->

    <div class="panel-body">
        <div class="search-results-product row">
            <div class="col-xs-4 col-sm-4">
                <img class="img-responsive"
                     src="{{ asset('storage/appliances/' . $appliance->image) }}"
                     alt="{{ $appliance->title }}">
            </div>
            <div class="product-description col-xs-8 col-sm-8">
                <h3>{{ $appliance->price }}&nbsp;&euro;</h3>
                {!! $appliance->description !!}<br/>
                <div class="btn-group" role="group" aria-label="...">
                  @if(Auth::check()) 
                  <form method="post"
                              action="{{ route('wisheslist.remove.appliance', [ 'userId' => Auth::user()->id ]) }}">
                      {{ csrf_field() }}
                      <input type="hidden" name="applianceId" value="{{ $appliance->id }}">
                      <button type="submit" class="btn btn-primary" name='submitButton' value="remove">Remove</button>
                  </form>
                  @endif
                </div>
            </div>
        </div>
    </div><!--panel-body-->
</div><!--panel-->