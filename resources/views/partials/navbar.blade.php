<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{route('home')}}">Bincom Test</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{route('show.pollingunit')}}">Question 1</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('lga.summary')}}">Question 2</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('new-polling-unit.create')}}">Question 3</a>
            </li>
        </ul>
    </div>
</nav>
