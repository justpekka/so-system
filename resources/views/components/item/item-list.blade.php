<div>
    <table>
        <thead>
            @foreach($titles as $key => $name)
                <th> {{$name}} </th>
            @endforeach
        </thead>
        <tbody>
            @foreach($items as $key => $child)
                <tr>
                    <td>{{$key}}</td>

                    @foreach($child as $names)
                        <td>{{$names}}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- No surplus words or unnecessary actions. - Marcus Aurelius -->