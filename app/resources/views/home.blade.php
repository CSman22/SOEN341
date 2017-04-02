@extends('layouts.app')

@section('extra-content')
<script type="text/javascript" src="/js/dashboard.js"></script>
<div class="col-md-9">
              <div class="panel panel-default">
                  <div class="panel-heading">Dashboard</div>

                  <div class="panel-body">
                      You are logged in!
                      <a href="{{ url('/logout') }}"
                          onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                          Logout
                      </a>
                  </div>
              </div>

              <div class="panel panel-default">
                  <div class="panel-heading">Scheduled Meetings</div>
                  <div class="panel-body">
                  @if(!$meetings->isEmpty())
                    <div class="panel-group", style='margin: 15px;'>
                    @foreach ($meetings as $meeting)
                        <div class="panel panel-default">
                          @foreach ($meeting->users->except(Auth::id()) as $attendee)
                          <div class="panel-heading">meeting {{$attendee->title}}</div>
                          @endforeach
                          <div class="panel-body">    
                            <div class="row" >
                              <div class="col-sm-6">

                                    <h5>Meeting With:
                                    @foreach ($meeting->users->except(Auth::id()) as $attendee)
                                        <span class="label label-default">{{$attendee->name}}</span>
                                    @endforeach
                                    </h5>

                                    <h5>Meeting Time:
                                    <span class="label label-default">{{date("l, F j, Y g:i a", strtotime($meeting->start_time))}}</span>
                                    </h5>

                              </div>
                              <div class="col-sm-3"></div>
                              <div class="col-sm-3">
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['meetings.destroy', $meeting->id]]) }}
                                    {{ Form::submit('Leave meeting', ['class' => 'btn btn-danger', 'style'=>'margin-top: 20px;']) }}
                                    {{ Form::close() }}
                              </div> 
                            </div>
                          </div>
                        </div>
                        @endforeach
                    </div>
                  @else
                    <div class="panel-group", style='margin: 15px;'>
                      <div class="panel panel-default">
                        <div class="panel-heading">No scheduled meetings</div>
                      </div>
                    </div>
                  @endif
                  </div>
              </div>

          <!--OPEN MEETING REQUEST PANNEL-->
              <div class="panel panel-default">
              <!--open request Heading-->
                  <div class="panel-heading">Open Meeting Requests</div>
                    <!--open request Body-->
                        <div class="panel-body">
                            @if(!$requests->isEmpty())
                            <!--INNER PANNELS: INDIVIDUAL REQUESTS-->
                            <div class="panel-group", style='margin: 15px;'>
                                @foreach ($requests as $request)
                                <div class="panel panel-default">

                                <!--INNER PANNEL HEADING -->
                                    @foreach ($request->receiver()->except(Auth::id()) as $reciever)
                                      <div class="panel-heading">meeting {{$reiever->is}}</div>
                                    @endforeach

                                <!--INNER PANNEL BODY -->    
                                    <div class="panel-body">    
                                        <div class="row" >
                                            <div class="col-sm-6">
                          
                                                <h5>Meeting Time:
                                                <span class="label label-default">{{date("l, F j, Y g:i a", strtotime($meeting->start_time))}}</span>
                                                </h5>
                                            </div>
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-3">
                                                {{ Form::open(['method' => 'DELETE', 'route' => ['requests.destroy', $request->id]]) }}
                                                {{ Form::submit('Close Meeting Request', ['class' => 'btn btn-danger']) }}
                                                {{ Form::close() }}
                                                @if($request->receiver()->is(Auth::user()))
                                                    {{ Form::open(['method' => 'GET', 'route' => ['requests.accept', $request->id]]) }}
                                                    {{ Form::submit('Accept Meeting Request', ['class' => 'btn btn-default']) }}
                                                    {{ Form::close() }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                                @endforeach
                            @else
                                        <p><Label>No meeting request</Label></p>
                                    </div> 
                                </div>
                            </div>   
                            @endif
                        </div>
              </div>

              <div class="panel panel-default">
                  <div class="panel-heading">Buddy Matches</div>

                  <div class="panel-body">
                      <!-- Display matches of people with the same availablility & class-->
                      <div class="panel panel-primary">
                        <div class="panel-heading">New matches for COURSE_NAME1</div>
                        <div class="panel-body">
                          <div id="ifMatchesEmpty"></div>
                          <table id="matches" class="table">
                            <tbody>
                            <tr>
                              <td>You matched with USER_NAME1<br>for availabilities from MUTUAL_START1 to MUTUAL_END1 &nbsp;<td>
                              <td>
                                <input type="button" value="Confirm" class="btn btn-success">
                                <input type="button" value="Decline" class="btn btn-danger" onclick="deleteRow(this, 'matches')">
                              </td>
                            </tr>
                            <tr>
                              <td>You matched with USER_NAME2<br>for availabilities from MUTUAL_START2 to MUTUAL_END2 &nbsp;<td>
                              <td>
                                <input type="button" value="Confirm" class="btn btn-success">
                                <input type="button" value="Decline" class="btn btn-danger" onclick="deleteRow(this, 'matches')">
                              </td>
                            </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                  </div>
              </div>
        </div>
@endsection
@include('common')
