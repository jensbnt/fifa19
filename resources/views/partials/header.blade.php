<nav class="navbar sticky-top navbar-expand-md navbar-dark bg-dark" role="navigation">
    <a class="navbar-brand" href="{{ route('home.index') }}">FIFA 19</a>
    <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            <li class="nav-item"><a class="nav-link" href="{{ route('players.index') }}">Players</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('teams.index') }}">Teams</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('trades.index') }}">Trades</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('create.index') }}">Create</a></li>
        </ul>
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="{{ route('stats.index') }}">Stats</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('backup.index') }}">Backup</a></li>
        </ul>
    </div>
</nav>