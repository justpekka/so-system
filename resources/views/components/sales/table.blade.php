@if(gettype($data) == "object" || gettype($data) == "array")
<div class="w-100 overflow-auto">
  <table {{ $attributes }} class="table table-hover">
    @foreach($data as $key => $value)
      @if ($loop->first)
      <thead>
        <tr>
          @if(gettype($value) == "object" || gettype($data) == "array")
            <th scope="col"><b> # </b></td>
            @foreach($value as $index => $child_value)
              <th scope="col"><b> {{ $index }} </b></td>
            @endforeach
          @endif
        </tr>
      </thead>
      @endif
      
      <tbody>
          <tr>
            @if(gettype($value) == "object" || gettype($data) == "array")
              <th scope="row"><b> {{ $key }} </b></td>
              @foreach($value as $child_value)
              <td> {{ $child_value }} </td>
              @endforeach
            @else
              <th scope="row"><b> {{ $key }} </b></td>
              <td> {{ $value }} </td>
            @endif
        </tr>
      </tbody>
    @endforeach
  </table>
</div>

@endif

{{ $slot }}