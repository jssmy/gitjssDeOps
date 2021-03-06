@section('title',  trans('gitscrum.welcome-to-gitScrum-step-1'))

@extends('layouts.master-fluid', ['hideNavbar' => true, 'bodyClass' => 'body-wizard-step1'])

@section('content')

<div class="authentication__left-screen white">

    <div class="aligner">
        @if($provider=='github')
            <div class="content-area">

                <div class="text-center">
                    <h4>{{trans('gitscrum.you-can-import-the-repositories-to-GitScrum')}}</h4>
                    <h5>{{trans('gitscrum.you-have')}} {{$repositories->count()}} {{trans('gitscrum.repositories')}}</h5>
                </div>

                <form action="{{route('wizard.step2','github')}}" method="post">

                    {{ csrf_field() }}

                    <div class="content-middle gs-card">

                        <div class="gs-card-content">

                            @include('partials.boxes.repositories', ['list'=>$repositories, 'columns'=>$columns])

                        </div>

                    </div>

                    <div class="text-center">
                        <button class="btn btn-lg btn-success btn-loader">{{trans('gitscrum.confirm-to-add-repositories-into-the')}} <strong>jssDevOps</strong></button>
                    </div>

                </form>

            </div>
        @endif

        @if($provider=='trello')
            <div class="content-area">

                <div class="text-center">
                    <h4>Boards found</h4>
                    <h5>as</h5>
                </div>

                <form action="{{route('wizard.step2','github')}}" method="post">

                    {{ csrf_field() }}

                    <div class="content-middle gs-card">

                        <div class="gs-card-content">

                            

                        </div>

                    </div>

                    <div class="text-center">
                        <button class="btn btn-lg btn-success btn-loader">{{trans('gitscrum.confirm-to-add-repositories-into-the')}} <strong>jssDevOps</strong></button>
                    </div>

                </form>

            </div>
        @endif
    </div>

</div>

<div style="background-image: url('/img/config/home.jpg');" class="authentication__right-screen">

    <div class="aligner">
        <div class="content">

            <h1>jssDevOps</h1>
            

        </div>
    </div>

</div>
@endsection
