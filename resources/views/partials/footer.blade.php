<footer class="footer bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-4 text-left">
                <span class="text-muted">jensbnt © Copyright 2018</span>
            </div>
            <div class="col-md-4 text-center">
                <span class="text-muted">Version 2.3</span>
            </div>
            <div class="col-md-4 text-right">
                <form method="POST" action="{{ route('nightmode') }}">
                    {{ csrf_field() }}
                    <div class="btn-group">
                        <button type="submit" name="nightmode" value="false"
                                class="btn {{ Cookie::has('nightmode') && Cookie::get('nightmode') ? "btn-outline-secondary" : "btn-secondary" }}">
                            Day
                        </button>
                        <button type="submit" name="nightmode" value="true"
                                class="btn {{ Cookie::has('nightmode') && Cookie::get('nightmode') ? "btn-secondary" : "btn-outline-secondary" }}">
                            Night
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</footer>