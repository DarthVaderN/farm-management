<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">

        </div>
        <ul class="nav navbar-nav">
            <li class="{{ setActive('/') }}"><a href="{{ url('/') }}">Главная</a></li>
            <li class="{{ setActive('status') }}"><a href="{{ url('/status') }}">Статистика Овечек</a></li>
        </ul>
    </div>
</nav>

