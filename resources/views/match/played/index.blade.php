@foreach($matches as $match)

    <ul>
        <li> {{ $match->home_team->name }} </li>
        <li> {{ $match->away_team->name }} </li>
        <li> {{ $match->play_date }} </li>
        <li> {{ $match->start_time }} </li>
        <li> {{ $match->end_time }} </li>
    </ul>

@endforeach