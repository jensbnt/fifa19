@extends('layouts.master')

@section('content')
    <div class="container">
        <div id="accordion">
            <div class="row">
                <div class="col-md-4">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-secondary">Updates</li>
                        <a class="list-group-item list-group-item-action pl-5" data-toggle="collapse" href="#collapseV2"
                           role="button" aria-expanded="false" aria-controls="collapseV2">Version 2.0</a>
                        <a class="list-group-item list-group-item-action pl-5" data-toggle="collapse" href="#collapseV1"
                           role="button" aria-expanded="false" aria-controls="collapseV1">Version 1.0</a>
                        <a class="list-group-item list-group-item-action pl-5" data-toggle="collapse" href="#collapseV0"
                           role="button" aria-expanded="false" aria-controls="collapseV0">Version 0.0</a>
                        <li class="list-group-item list-group-item-secondary">FAQ</li>
                        <a class="list-group-item list-group-item-action pl-5" data-toggle="collapse"
                           href="#collapseContact" role="button" aria-expanded="false" aria-controls="collapseContact">Contact</a>
                    </ul>
                </div>
                <div class="col-md-8 mb-3">
                    <div class="collapse show" id="collapseV2" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card">
                            <div class="card-body">
                                <h1>Version 2.0</h1>
                                <br>
                                <p>Cool description.</p>
                                <span class="text-muted">Release: 17/09/2018</span>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><b>v2.2</b> - Removed trade section</li>
                                <li class="list-group-item"><b>v2.1</b> - Home page & about page update</li>
                                <li class="list-group-item"><b>v2.0</b> - Website redesign, ready for FIFA 19</li>
                            </ul>
                        </div>
                    </div>
                    <div class="collapse" id="collapseV1" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card">
                            <div class="card-body">
                                <h1>Version 1.0</h1>
                                <br>
                                <p>Cool description.</p>
                                <span class="text-muted">Release: 25/04/2018</span>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><b>v1.16</b> - Nation & Club database</li>
                                <li class="list-group-item"><b>v1.15</b> - Stats</li>
                                <li class="list-group-item"><b>v1.14</b> - Advanced sort</li>
                                <li class="list-group-item"><b>v1.13</b> - Team formations + pictures</li>
                                <li class="list-group-item"><b>v1.12</b> - Backups</li>
                                <li class="list-group-item"><b>v1.11</b> - Add players with .csv</li>
                                <li class="list-group-item"><b>v1.10</b> - Edit players</li>
                                <li class="list-group-item"><b>v1.9</b> - Add game option</li>
                                <li class="list-group-item"><b>v1.8</b> - Added top players</li>
                                <li class="list-group-item"><b>v1.7</b> - Added player sorting on team page</li>
                                <li class="list-group-item"><b>v1.6</b> - Added player graphics (picture, club and
                                    nation)
                                </li>
                                <li class="list-group-item"><b>v1.5</b> - Global player stats</li>
                                <li class="list-group-item"><b>v1.4</b> - Edit player's games, goals and assists</li>
                                <li class="list-group-item"><b>v1.3</b> - Add custom players</li>
                                <li class="list-group-item"><b>v1.2</b> - Add a team description and edit teams</li>
                                <li class="list-group-item"><b>v1.1</b> - User logins</li>
                                <li class="list-group-item"><b>v1.0</b> - Players & teams</li>
                            </ul>
                        </div>
                    </div>
                    <div class="collapse" id="collapseV0" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card">
                            <div class="card-body">
                                <h1>Version 0.0</h1>
                                <br>
                                <p>Cool description.</p>
                                <span class="text-muted">Release: 24/04/2018</span>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><b>v0.*</b> - Alpha stage</li>
                            </ul>
                        </div>
                    </div>
                    <div class="collapse" id="collapseContact" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card">
                            <div class="card-body">
                                <h1>Contact</h1>
                                <br>
                                <p>Email: <a href="mailto:jens_beernaert@hotmail.com">jens_beernaert@hotmail.com</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

