@extends('auth.main')
    @section('content')
        <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>jssDevOps</strong> usuarios</h1>
                            <div class="description">
                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                            <div class="form-top">
                                <div class="form-top-left">
                                    <h3>Iniciar Sesión</h3>
                                    <p>Ingrese sus credenciales</p>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-lock"></i>
                                </div>
                            </div>
                            <div class="form-bottom">

                                <form role="form" action="" method="post" class="login-form">
                                      {{ csrf_field() }}
                                    <div class="form-group">
                                        <label class="sr-only" for="email">Usuario</label>
                                        <input type="email" name="email" placeholder="Usuario..." class="form-username form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email">
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="password">Contraseña</label>
                                        <input type="password" name="password" placeholder="Contraseña..." class="form-password form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password">
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif

                                    </div>
                                 <button type="submit" class="btn">Entrar</button>
                                </form>
                            </div>
                            <br>
                            <a href="{{ route('auth.provider','google') }}" class="btn btn-block btn-social btn-google">
                                <i class="fa fa-google-plus"></i> Sign in with Google
                            </a>
                        </div>
                    </div>
                    
                </div>
            </div>
    @endsection