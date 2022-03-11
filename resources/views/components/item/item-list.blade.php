<div>
    <table class="table">
        <thead>
            <th></th>
            @foreach($titles as $key => $name)
                <th> {{$key}} </th>
            @endforeach
        </thead>
        
        <tbody>
            @foreach($items as $key => $child)
                <tr>
                    <td>{{$key}}</td>

                    @foreach($child as $key => $names)
                        @if($key == 'item_status')
                            <?php $names = $names['inStock'] ?>
                        @endif
                        <td>{{$names}}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- No surplus words or unnecessary actions. - Marcus Aurelius -->