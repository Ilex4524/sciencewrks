 <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">ONAT</a>
    </div>
    @if(Auth::guard('admin-web')->check())
    
      <ul class="nav navbar-nav">
        <li class={{ Request::is('departments') ? "active" : "" }}><a href="{{route('departments.index')}}">Departments</a></li>
        <li class={{ Request::is('staff-types') ? "active" : "" }}><a href="{{route('staff-types.index')}}">Staff Types</a></li>
        <li class={{ Request::is('employees') ? "active" : "" }}><a href="{{route('employees.index')}}">Staff</a></li>
      </ul>
    @elseif(Auth::guard('web')->check())
      <ul class="nav navbar-nav">
        <li class={{ Request::is('employees') ? "active" : "" }}><a href="{{route('employees.index')}}">Staff</a></li>
        <li class={{ Request::is('references') ? "active" : "" }}><a href="#">References</a></li>
        <li class={{ Request::is('users') ? "active" : "" }}><a href="#">Users</a></li>
        <li class={{ Request::is('researches') ? "active" : "" }}><a href="#">Researches</a></li>
      </ul>
    @endif
    
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav> 