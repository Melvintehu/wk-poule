@foreach($matches as $match)

    <ul>
        <li> {{ $match->home_team->name }} </li>
        <li> {{ $match->away_team->name }} </li>
        <li> {{ $match->play_date }} </li>
        <li> {{ $match->start_time }} </li>
        <li> {{ $match->end_time }} </li>
        <li> {{ $match->statistic->present()->goalsHome }} </li>
        <li> {{ $match->statistic->present()->goalsAway }} </li>
        <li> {{ $match->statistic->present()->yellow_cards_home }} </li>
        <li> {{ $match->statistic->present()->yellow_cards_away }} </li>
        <li> {{ $match->statistic->present()->red_cards_home }} </li>
        <li> {{ $match->statistic->present()->red_cards_away }} </li>
    </ul>

@endforeach