@section('title',  trans('gitscrum.title-login'))

@extends('layouts.master-fluid', ['hideNavbar' => true, 'bodyClass' => 'body-login'])

@section('content')
<script async defer src="https://buttons.github.io/buttons.js"></script>



    <div class="authentication__left-screen">

        <div class="aligner">

            <div class="text-center">

                <div class="authentication__logo">
                    <img style="width: 20%; height: 20%;" src="{{ asset('img/config/jssdevops.png') }}">
                </div>

                <h3 class="">
                    Wizard
                    <a target="_blank"><strong>Aplications</strong></a>
                </h3>
                @if(!Auth::user()->github)
                    <a href="{{route('auth.provider', ['provider' => 'github'])}}" class="btn btn-lg btn-default btn-loader">
                    <i class="fa fa-github" aria-hidden="true"></i>&nbsp;&nbsp;<strong>GitHub</strong>
                    </a>    
                @else
                    <a  disabled="true" class="btn btn-lg btn-danger">
                        <i class="fa fa-github" aria-hidden="true"></i>&nbsp;&nbsp;<strong>GitHub
                            <i class="fa fa-check" aria-hidden="true"></i>

                        </strong>
                    </a>
                @endif

                @if(!Auth::user()->trello)
                    <a href="{{route('auth.provider', ['provider' => 'trello'])}}" class="btn btn-lg btn-default btn-loader">
                    <i class="fa fa-trello" aria-hidden="true"></i>&nbsp;&nbsp;<strong>Trello</strong>
                    </a>    
                @else
                    <a  disabled="true" class="btn btn-lg btn-danger">
                        <i class="fa fa-trello" aria-hidden="true"></i>&nbsp;&nbsp;<strong>Trello
                            <i class="fa fa-check" aria-hidden="true"></i>

                        </strong>
                    </a>
                @endif

                @if( (Auth::user()->github && Auth::user()->trello ) )
                    <div class="row">
                    
                        <br>
                        <a class="btn btn-warning" href="">Cotinue</a>
                    </div>
                @endif



                
                <p class="small">The GitScrum Community is licensed under the
                    <a href="https://github.com/gitscrum-community-edition/laravel-gitscrum/blob/master/LICENSE.md" target="_blank">MIT license</a></p>

            </div>

        </div>
    </div>

    <div style="background-image: url('img/config/home.jpg');" class="authentication__right-screen">

        <div class="aligner">
            <div class="content">
                <h1>jssDevOps</h1>
                

                
            </div>
        </div>

    </div>

@endsection
