<nav class="navbar sticky-top navbar-expand-md navbar-dark bg-dark" role="navigation">
    <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            <li class="nav-item"><a class="nav-link" href="{{ route('players.index') }}">Players</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('teams.index') }}">Teams</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('create.index') }}">Create</a></li>
        </ul>
        <ul class="nav navbar-nav abs-center-x">
            <a class="navbar-brand" href="{{ route('home.index') }}">
                <img src="https://lh3.googleusercontent.com/0OkazSaeKunzFw09BhD2zdEdOeavQcT9ejfkq1jl9fgTeuIjL6OMGnQvq-rrhxtpsCM=s180-rw" width="30" height="30">
            </a>
        </ul>
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="{{ route('home.about') }}">About</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('backup.index') }}">Backup</a></li>
        </ul>
    </div>
</nav>