                @if(!Auth::user()->slack)
                    <a href="{{route('auth.provider', ['provider' => 'slack'])}}" class="btn btn-lg btn-default btn-loader">
                    <i class="fa fa-slack" aria-hidden="true"></i>&nbsp;&nbsp;<strong>Slack</strong>
                    </a>    
                @else
                    <a  disabled="true" class="btn btn-lg btn-danger">
                        <i class="fa fa-slack" aria-hidden="true"></i>&nbsp;&nbsp;<strong>Slack
                            <i class="fa fa-check" aria-hidden="true"></i>

                        </strong>
                    </a>
                @endif