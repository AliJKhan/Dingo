
<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))

            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
    @endforeach
</div>
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-default" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="http://www.jquery2dotnet.com">Brand</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                    <ul class="nav navbar-nav">

                        <li><a href="http://www.jquery2dotnet.com">About Us</a></li>
                        @if (Sentinel::check())
                            <li class="active"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="dropdown">
                            <a href="http://www.jquery2dotnet.com" class="dropdown-toggle" data-toggle="dropdown">Pages <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('services')}}">Services</a></li>
                                <li><a href="{{route('addModelnyear')}}">Model and Years</a></li>
                                <li><a href="{{route('airFilters')}}">Air Filters</a></li>
                                <li><a href="{{route('oilFilters')}}">Oil Filters</a></li>
                                <li><a href="{{route('batteries')}}">Batteries</a></li>
                                <li><a href="{{route('breakPads')}}">Brake Pad</a></li>
                                <li><a href="{{route('orders')}}">Orders</a></li>
                                <li><a href="{{route('mechanics')}}">Mechanics</a></li>
                                <li class="divider"></li>
                                <li><a href="http://www.jquery2dotnet.com">Separated link</a></li>
                                <li class="divider"></li>
                                <li><a href="http://www.jquery2dotnet.com">One more separated link</a></li>
                            </ul>
                        </li>
                        @endif
                    </ul>

                    <form class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                    @if (!Sentinel::check())
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{route('signup')}}">Sign Up</a></li>
                        <li class="dropdown">
                            <a href="http://www.jquery2dotnet.com" class="dropdown-toggle" data-toggle="dropdown">Sign in <b class="caret"></b></a>
                            <ul class="dropdown-menu" style="padding: 15px;min-width: 250px;">
                                <li>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form class="form" role="form" method="post" action="{{route('signin')}}" accept-charset="UTF-8" id="login-nav">
                                                <div class="form-group">
                                                    <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                                    <input name="email" type="email" class="form-control" id="exampleInputEmail2" placeholder="Email address" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="exampleInputPassword2">Password</label>
                                                    <input name="password" type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" required>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input name="remember" type="checkbox"> Remember me
                                                    </label>
                                                </div>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success btn-block">Sign in</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <input class="btn btn-primary btn-block" type="button" id="sign-in-google" value="Sign In with Google">
                                    <input class="btn btn-primary btn-block" type="button" id="sign-in-twitter" value="Sign In with Twitter">
                                </li>
                            </ul>
                        </li>
                    </ul>
                    @else
                        <ul class="nav navbar-nav navbar-right">

                            <form class="form" role="form" method="post" action="{{route('signout')}}" accept-charset="UTF-8" id="login-nav">

                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-block">Sign Out</button>
                                </div>
                            </form>
                        </ul>
                    @endif
                </div>
                <!-- /.navbar-collapse -->
            </nav>
        </div>
    </div>

