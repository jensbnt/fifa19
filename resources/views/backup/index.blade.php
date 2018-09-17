@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md">
                @include('partials.message')
            </div>
        </div>
        <div class="row">

            <!-- ALL -->

            <div class="col-md">
                <div class="card mb-3">
                    <div class="card-header"></div>
                    <div class="text-center mt-3">
                        <img style="width: 20%;"
                             src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b4/Hdd_font_awesome.svg/2000px-Hdd_font_awesome.svg.png">
                    </div>
                    <div class="card-body text-center">
                        <h1 class="display-4">Backup Everything</h1>
                        <p>This is the most convenient way to make a backup. With these options you can backup and
                            restore your entire database of players, teams, teamplayers and trades. Seperate options for
                            each of these categories can be found below. <b>Attention!</b> Backups can take some time,
                            don't refresh the page untill the pages has stopped loading.</p>
                        <div class="row">
                            <div class="col-md-6">
                                <form method="POST" action="{{ route('backup.index') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="backup-all">
                                    <button type="submit" class="btn btn-success btn-block">Backup</button>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <form method="POST" action="{{ route('backup.index') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="restore-all">
                                    <button type="submit" class="btn btn-primary btn-block">Restore</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- PLAYERS -->

            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-header"></div>
                    <div class="text-center mt-3">
                        <img style="width: 20%;"
                             src="https://futhead.cursecdn.com/static/img/18/players_alt/p50514925.png">
                    </div>
                    <div class="card-body text-center">
                        <h4>Players</h4>
                        <p>Backup and restore players seperately.</p>
                        <div class="form-row">
                            <div class="col-md-6">
                                <form method="POST" action="{{ route('backup.index') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="backup-players">
                                    <button type="submit" class="btn btn-success btn-block">Backup</button>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <form method="POST" action="{{ route('backup.index') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="restore-players">
                                    <button type="submit" class="btn btn-primary btn-block">Restore</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TEAMS -->

            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-header"></div>
                    <div class="text-center mt-3">
                        <img style="width: 20%;"
                             src="https://cdn.bleacherreport.net/images/team_logos/328x328/belgium_national_football.png">
                    </div>
                    <div class="card-body text-center">
                        <h4>Teams</h4>
                        <p>Backup and restore teams seperately.</p>
                        <div class="form-row">
                            <div class="col-md-6">
                                <form method="POST" action="{{ route('backup.index') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="backup-teams">
                                    <button type="submit" class="btn btn-success btn-block">Backup</button>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <form method="POST" action="{{ route('backup.index') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="restore-teams">
                                    <button type="submit" class="btn btn-primary btn-block">Restore</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TEAMPLAYERS -->

            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-header"></div>
                    <div class="text-center mt-3">
                        <img style="width: 20%;"
                             src="https://futhead.cursecdn.com/static/img/18/players_alt/p151170887.png">
                    </div>
                    <div class="card-body text-center">
                        <h4>Teamplayers</h4>
                        <p>Backup and restore teamplayers seperately.</p>
                        <div class="form-row">
                            <div class="col-md-6">
                                <form method="POST" action="{{ route('backup.index') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="backup-teamplayers">
                                    <button type="submit" class="btn btn-success btn-block">Backup</button>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <form method="POST" action="{{ route('backup.index') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="restore-teamplayers">
                                    <button type="submit" class="btn btn-primary btn-block">Restore</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TRADES -->

            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-header"></div>
                    <div class="text-center mt-3">
                        <img style="width: 20%;"
                             src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSwhmLEZJda6rH-bQSl1FnE_6yTtlZIcydu04SURP2WCMpF6f6">
                    </div>
                    <div class="card-body text-center">
                        <h4>Trades</h4>
                        <p>Backup and restore trades seperately.</p>
                        <div class="form-row">
                            <div class="col-md-6">
                                <form method="POST" action="{{ route('backup.index') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="backup-trades">
                                    <button type="submit" class="btn btn-success btn-block">Backup</button>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <form method="POST" action="{{ route('backup.index') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="restore-trades">
                                    <button type="submit" class="btn btn-primary btn-block">Restore</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

