@extends('layouts.dashboard')
@section('content')
<div class="right_col" role="main">         
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><strong>Profile : </strong>{{ $dependent->name }} {{ $dependent->surname }} </h3>
      </div>      
    </div>    
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Medical Aid Number : {{ $dependent->medical_aid_number }} | Plan : {{ $dependent->plan->name }}</h2>            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
              <div class="profile_img">
                <div id="crop-avatar">
                  <!-- Current avatar -->                  
                  <img class="img-responsive avatar-view" src="@if(!$dependent->image && $dependent->gender=='Male'){{asset('images/male.jpg')}} @elseif (!$dependent->image && $dependent->gender=='Female'){{asset('images/female.jpg')}} @else {{asset($dependent->image)}} @endif" alt="Avatar" width="128" height="128" title="Profile Picture">
                </div>
              </div>
              <h3>{{ $dependent->name }} {{ $dependent->surname }}</h3>
              <hr>  
              <ul class="list-unstyled user_data">
                <li>                  
                  @if(Auth::user()->hasRole(['Service Provider','System Admin']))  
                    <form method="POST" action="{{ route('requestCheckDependent',$dependent->id) }}">                      
                      @csrf
                      <button type="submit" class="btn bg-primary"><i class="fa fa-binoculars">Request Check</i></button>
                    </form> 
                  @endif 
                </li>
                <hr>  
                <li>
                  <i class="fa fa-barcode" data-toggle="tooltip" title="ID Number"></i>
                  @if(!$dependent->id_number)
                  Info not available
                  @else
                  {{$dependent->id_number}}
                  @endif 
                </li>
                <hr>         
                <li>
                  <i class="fa fa-birthday-cake" data-toggle="tooltip" title="Date Of Birth"></i>
                  @if(!$dependent->date_of_birth)
                  Info not available
                  @else
                  {{$dependent->date_of_birth}}
                  @endif 
                </li>                              
              </ul>
              @if(!Auth::user()->hasRole(['Client','Service Provider','Chairman','Principal Officer']))
              <a href="/dependents/{{$dependent->id}}/edit" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
              @endif
              <br />

              <!-- start skills -->
              <h4>Waiting Period</h4>
              <ul class="list-unstyled user_data">
                <li>
                  <p>Current : 
                    @if($dependent->period_status=='Stage 5') 
                    Complete!
                    @else
                    {{$dependent->period_status}}
                    @endif
                  </p>
                  <div class="progress progress_lg">
                    <div class="progress-bar bg-green progress-striped" role="progressbar" data-transitiongoal="
                    @if($dependent->period_status=='Stage 1')
                    20
                    @elseif($dependent->period_status=='Stage 2')
                    40
                    @elseif($dependent->period_status=='Stage 3')
                    60
                    @elseif($dependent->period_status=='Stage 4')
                    80
                    @elseif($dependent->period_status=='Stage 5')
                    100
                    @else
                    0
                    @endif

                    "></div>
                  </div>
                </li>                
              </ul>
              <!-- end of skills -->

            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
              @include('inc.messages')
              <div class="profile_title">
                <div class="col-md-6">
                  <h2>User Activity Report</h2>
                </div>
                <div class="col-md-6">
                  <div class="pull-right" style="margin-top: 7px;">
                    <p><strong>Joined : {{ $dependent->created_at }}</strong></p>
                  </div>
                </div>
              </div>
            </br>
              <div class="jumbotron" style="padding: 5px;">
                <ul class="stats-overview">
                  <li>
                    <span class="name">Membership Status</span>
                    @if($dependent->membership_status=='Active')                    
                    <span class="value text-success">{{ $dependent->membership_status }}</span>
                    @else
                    <span class="value text-danger">{{ $dependent->membership_status }}</span>
                    @endif
                  </li>
                  <li>
                    <span class="name">Premium</span>
                    <span class="value text-success">{{ $dependent->premium }}</span>
                  </li>
                  <li class="hidden-phone">
                    <span class="name">Plan</span>
                    <span class="value text-success">{{ $dependent->plan->name }}</span>
                  </li>
                </ul>
                              
              </div>
              <!-- start of gallery -->
              <hr>
              {{-- <div class="row">

                <p><strong>Media Elements</strong></p>

                @forelse($files as $file)
                <div class="col-md-55">
                  <div class="thumbnail">
                    <div class="image view view-first">
                      <img style="width: 100%; display: block;" src="@if(pathinfo(asset('storage/'.$file->name), PATHINFO_EXTENSION)=='pdf'){{asset('images/pdf.png')}} @elseif (pathinfo(asset('storage/'.$file->name), PATHINFO_EXTENSION)=='docx'){{asset('images/docx.png')}} @else {{asset('storage/'.$file->name)}} @endif" alt="image" />
                      <div class="mask">                        
                        <div class="tools tools-bottom">
                          <a href="{{asset('storage/'.$file->name)}}" download data-toggle="tooltip" title="Download"><i class="fa fa-download"></i></a>
                          <a href="/clients/{{$client->id}}/edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>
                          @if(Auth::user()->id==$file->user_id || Auth::user()->hasRole(['System Admin','Chairman','Principal Officer','Team Leader']))
                          <a onclick="deleteData({{$file->id}})" data-toggle="tooltip" title="Remove File"><i class="fa fa-times"></i></a>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="caption">
                      <p>{{$file->caption}}</p>
                    </div>
                  </div>
                </div>
                @empty
                  <p style="color:red">No files uploaded!</p>
                @endforelse

              </div> --}}
              <!-- end of gallery--->

              <div class="" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                  @if(!Auth::user()->hasRole(['Service Provider']))
                 {{--  <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Client Activities</a>
                  </li>   --}}                
                  <li role="presentation" class=""><a href="#tab_content1" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Limits</a>
                  </li>
                  @endif
                  <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Claims</a>
                  </li>                 
                </ul>
                <div id="myTabContent" class="tab-content">
                  {{-- <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                    <!-- start recent activity -->
                    <ul class="messages">
                      @foreach($activities as $activity)
                      <li>
                        <img src="@if(!$client->img && $client->gender=='Male'){{asset('images/male.jpg')}} @elseif (!$client->img && $client->gender=='Female'){{asset('images/female.jpg')}} @else {{asset('images/img.jpg')}} @endif" class="avatar" alt="Avatar">
                        <div class="message_date">
                          <h5 class="date text-info">{{ $activity->created_at->format('d') }}</h5>
                          <p class="month">{{ $activity->created_at->format('M') }}</p>
                        </div>
                        <div class="message_wrapper">
                          <h4 class="heading">{{ $client->name }}</h4>
                          <div class="message"><p>{{ $activity->description}}</p></div>
                          <br />
                          <p class="url">
                            <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                            <a href="#"><i class="fa fa-paperclip"></i> document.doc </a>
                          </p>
                        </div>
                      </li> 
                    </ul>
                    @endforeach
                    <!-- end recent activity -->

                  </div> --}}
                  <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="x_panel">                        
                        <div class="x_content">
                          
                          <div class="widget_summary">
                            <div class="w_left w_25">
                              <span>Global Limit</span>
                            </div>
                            <div class="w_center w_55">
                              <div class="progress">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ ($plan->global_limit-$limit->global_limit)/$plan->global_limit*100}}%; color: black">                                
                                <span style="">60% Complete</span>
                                </div>
                              </div>
                            </div>
                            <div class="w_right w_20">
                              <span>${{ $limit->global_limit}}</span>
                            </div>
                            <div class="clearfix"></div>
                          </div> 

                          <div class="widget_summary">
                            <div class="w_left w_25">
                              <span>Hospitalisation</span>
                            </div>
                            <div class="w_center w_55">
                              <div class="progress">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ ($plan->hospitalization-$limit->hospitalization)/$plan->hospitalization*100}}%; color: black">                                
                                <span style="">60% Complete</span>
                                </div>
                              </div>
                            </div>
                            <div class="w_right w_20">
                              <span>${{ $limit->hospitalization}}</span>
                            </div>
                            <div class="clearfix"></div>
                          </div>

                          <div class="widget_summary">
                            <div class="w_left w_25">
                              <span>Ward Admission</span>
                            </div>
                            <div class="w_center w_55">
                              <div class="progress">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ ($plan->ward_admission-$limit->ward_admission)/$plan->ward_admission*100}}%; color: black">                                
                                <span style="">60% Complete</span>
                                </div>
                              </div>
                            </div>
                            <div class="w_right w_20">
                              <span>${{ $limit->ward_admission}}</span>
                            </div>
                            <div class="clearfix"></div>
                          </div>                         
                          <div class="widget_summary">
                            <div class="w_left w_25">
                              <span>Drugs</span>
                            </div>
                            <div class="w_center w_55">
                              <div class="progress">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ ($plan->drugs-$limit->drugs)/$plan->drugs*100}}%; color: black">                                
                                <span style="">60% Complete</span>
                                </div>
                              </div>
                            </div>
                            <div class="w_right w_20">
                              <span>${{ $limit->drugs}}</span>
                            </div>
                            <div class="clearfix"></div>
                          </div>

                          <div class="widget_summary">
                            <div class="w_left w_25">
                              <span>Optical</span>
                            </div>
                            <div class="w_center w_55">
                              <div class="progress">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ ($plan->optical-$limit->optical)/$plan->optical*100}}%; color: black">                                
                                <span style="">60% Complete</span>
                                </div>
                              </div>
                            </div>
                            <div class="w_right w_20">
                              <span>${{ $limit->optical}}</span>
                            </div>
                            <div class="clearfix"></div>
                          </div>

                          <div class="widget_summary">
                            <div class="w_left w_25">
                              <span>Oncology</span>
                            </div>
                            <div class="w_center w_55">
                              <div class="progress">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ ($plan->oncology-$limit->oncology)/$plan->oncology*100}}%; color: black">                                
                                <span style="">60% Complete</span>
                                </div>
                              </div>
                            </div>
                            <div class="w_right w_20">
                              <span>${{ $limit->oncology}}</span>
                            </div>
                            <div class="clearfix"></div>
                          </div>

                          <div class="widget_summary">
                            <div class="w_left w_25">
                              <span>Dialysis</span>
                            </div>
                            <div class="w_center w_55">
                              <div class="progress">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ ($plan->dialysis-$limit->dialysis)/$plan->dialysis*100}}%; color: black">                                
                                <span style="">60% Complete</span>
                                </div>
                              </div>
                            </div>
                            <div class="w_right w_20">
                              <span>${{ $limit->dialysis}}</span>
                            </div>
                            <div class="clearfix"></div>
                          </div>

                          <div class="widget_summary">
                            <div class="w_left w_25">
                              <span>Dental</span>
                            </div>
                            <div class="w_center w_55">
                              <div class="progress">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ ($plan->dental-$limit->dental)/$plan->dental*100}}%; color: black">                                
                                <span style="">60% Complete</span>
                                </div>
                              </div>
                            </div>
                            <div class="w_right w_20">
                              <span>${{ $limit->dental}}</span>
                            </div>
                            <div class="clearfix"></div>
                          </div>

                        </div>
                      </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="x_panel">                        
                        <div class="x_content">
                          
                          
                          <div class="widget_summary">
                            <div class="w_left w_25">
                              <span>Pathology</span>
                            </div>
                            <div class="w_center w_55">
                              <div class="progress">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ ($plan->pathology-$limit->pathology)/$plan->pathology*100}}%; color: black">                                
                                <span style="">60% Complete</span>
                                </div>
                              </div>
                            </div>
                            <div class="w_right w_20">
                              <span>${{ $limit->pathology}}</span>
                            </div>
                            <div class="clearfix"></div>
                          </div>

                          <div class="widget_summary">
                            <div class="w_left w_25">
                              <span>Radiology</span>
                            </div>
                            <div class="w_center w_55">
                              <div class="progress">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ ($plan->radiology-$limit->radiology)/$plan->radiology*100}}%; color: black">                                
                                <span style="">60% Complete</span>
                                </div>
                              </div>
                            </div>
                            <div class="w_right w_20">
                              <span>${{ $limit->radiology}}</span>
                            </div>
                            <div class="clearfix"></div>
                          </div>

                          <div class="widget_summary">
                            <div class="w_left w_25">
                              <span>Maternity</span>
                            </div>
                            <div class="w_center w_55">
                              <div class="progress">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ ($plan->maternity-$limit->maternity)/$plan->maternity*100}}%; color: black">                                
                                <span style="">60% Complete</span>
                                </div>
                              </div>
                            </div>
                            <div class="w_right w_20">
                              <span>${{ $limit->maternity}}</span>
                            </div>
                            <div class="clearfix"></div>
                          </div>

                          <div class="widget_summary">
                            <div class="w_left w_25">
                              <span>Prosthesis</span>
                            </div>
                            <div class="w_center w_55">
                              <div class="progress">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ ($plan->prosthesis-$limit->prosthesis)/$plan->prosthesis*100}}%; color: black">                                
                                <span style="">60% Complete</span>
                                </div>
                              </div>
                            </div>
                            <div class="w_right w_20">
                              <span>${{ $limit->prosthesis}}</span>
                            </div>
                            <div class="clearfix"></div>
                          </div>

                          <div class="widget_summary">
                            <div class="w_left w_25">
                              <span>Family Planning</span>
                            </div>
                            <div class="w_center w_55">
                              <div class="progress">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ ($plan->family_planning-$limit->family_planning)/$plan->family_planning*100}}%; color: black">                                
                                <span style="">60% Complete</span>
                                </div>
                              </div>
                            </div>
                            <div class="w_right w_20">
                              <span>${{ $limit->family_planning}}</span>
                            </div>
                            <div class="clearfix"></div>
                          </div>

                          <div class="widget_summary">
                            <div class="w_left w_25">
                              <span>Physiotherapy</span>
                            </div>
                            <div class="w_center w_55">
                              <div class="progress">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ ($plan->physiotherapy-$limit->physiotherapy)/$plan->physiotherapy*100}}%; color: black">                                
                                <span style="">60% Complete</span>
                                </div>
                              </div>
                            </div>
                            <div class="w_right w_20">
                              <span>${{ $limit->physiotherapy}}</span>
                            </div>
                            <div class="clearfix"></div>
                          </div>

                          <div class="widget_summary">
                            <div class="w_left w_25">
                              <span>Glucometer</span>
                            </div>
                            <div class="w_center w_55">
                              <div class="progress">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ ($plan->glucometer-$limit->glucometer)/$plan->glucometer*100}}%; color: black">                                
                                <span style="">60% Complete</span>
                                </div>
                              </div>
                            </div>
                            <div class="w_right w_20">
                              <span>${{ $limit->glucometer}}</span>
                            </div>
                            <div class="clearfix"></div>
                          </div>

                          <div class="widget_summary">
                            <div class="w_left w_25">
                              <span>Funeral Grant</span>
                            </div>
                            <div class="w_center w_55">
                              <div class="progress">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ ($plan->funeral_grant-$limit->funeral_grant)/$plan->funeral_grant*100}}%; color: black">                                
                                <span style="">60% Complete</span>
                                </div>
                              </div>
                            </div>
                            <div class="w_right w_20">
                              <span>${{ $limit->funeral_grant}}</span>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                        </div>
                      </div>
                    </div>  

                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                    <!-- start claims -->
                    <table class="data table table-striped no-margin">
                      <thead>
                        <tr>                          
                          <th>Date</th>
                          <th>Description</th>
                          <th>Amount</th>
                          <th>Receipt Number</th>
                          <th>MOP</th>
                          <th>Done By</th>
                        </tr>
                      </thead>
                      <tbody>
                        {{-- @foreach($claims as $claim)
                        <tr>
                          <td>{{ $claim->created_at }}</td>
                          <td>{{ $claim->description }}</td>
                          <td>{{ $claim->amount }}</td>
                          <td>{{ $claim->receipt_number }}</td>
                          <td>{{ $claim->description}}</td>
                          <td>{{ $claim->servicerprovider['name'] }}</td>                         
                        </tr>
                        @endforeach --}}
                      </tbody>
                    </table>
                    <!-- end claims -->
                  </div>                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="">
  function deleteData(id){
   swal({
          title: "Are you sure?",
          text: "After deleting you won't be able to undo!",
          icon: "warning",          
          buttons: true,
          dangerMode: true        
        }).then((willDelete)=>{
          if(willDelete){
            $.ajax({
                url : "{{ url('files') }}" + '/' + id ,
                type: 'POST',
                data: {
                  '_method' : 'DELETE',
                  _token: '{{csrf_token()}}'           
                },
                  success : function(data) {                                        
                    swal({
                      title: "Deleted Successfully",
                      text: "Record deleted successfully",
                      icon: "success",
                      button: "Done!"                       
                    }).then(function(){window.location.reload();});
                  },
                  error : function(data){        
                    swal({
                      title: "Ooops..., failed!",
                      text: "Failed",         
                      icon: "error",          
                      timer : '6500'          
                    });        
                  }
              });      
          }
          else {
            swal("Cancelled!");
          }
        });

}
</script>
@endsection