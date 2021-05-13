
<header>
<nav>
<div class="col-md-6 col-md-offset-3">
<h2>Welcome {{ Auth::user()->first_name }}!</h2>
</div>
<div class='collapse navbar-collapse' id="bs-example-navbar-collapse-1">
<ul class="nav navbar-nav navbar-right">
    <li><a href='{{route('logout')}}'>Logout</a></li>
</ul>
</div>
</nav>
</header>