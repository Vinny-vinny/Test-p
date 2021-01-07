<ul class="nav nav-pills">
    <li class="nav-item">
        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{route('return-ticker')}}">returnTicker</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Request::segment(1) === 'chart-data' ? 'active' : null }}" href="{{route('chart-data')}}">returnChartData</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Request::segment(1) === 'trade-history' ? 'active' : null }}" href="{{url('trade-history')}}">returnTradeHistory</a>
    </li>
</ul>


