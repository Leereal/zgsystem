@extends('layouts.dashboard')
@section('content')
        <div class="right_col" role="main">         
            <div class="page-title">
              <div class="title_left">
                <h3>Mode Of Payments <small>Click Add Mode Of Payment button to Add New</small></h3>
              </div>
              <div class="title_right">

                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

                  @if(!Auth::user()->hasRole(['Client','Service Provider','Brand Ambassador']))                  
                    <a onclick="addForm()" class="btn btn-primary">
                      <span class="glyphicon glyphicon-plus"></span>Add Mode Of Payment
                    </a>                 
                  @endif  
                    
              </div>
            </div>

            <div class="clearfix"></div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View All Mode Of Payments</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    @include('inc.messages')
                    <div class="well" style="overflow: auto">
                      <div class="col-md-4">
                        <div id="reportrange_right" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                          <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                          <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <p>Date Range Picker with opening to right and left</p>
                      </div>
                      <div class="col-md-4">
                        <div class="pull-right" >
                          <span><button onclick="filterData()">Filter</button></span> 
                        </div>
                      </div>
                    </div>
                    <table id="datatable-fixed-header" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Name</th>                                                 
                          <th>Date Added</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($mops as $mop)
                          <tr>
                            <td><a onclick="viewInfo({{$mop->id}})"> {{ $mop->name}}</a></td>                                                    
                            <td>{{ $mop->created_at}}</td>
                            <td>
                              <a onclick="viewInfo({{$mop->id}})" class="btn btn-primary btn-xs view_{{$mop->id}}" 
                              data-name="{{$mop->name}}"><i class="fa fa-folder"></i> View </a>
                              <a onclick="editForm({{$mop->id}})" class="btn btn-info btn-xs edit_{{$mop->id}}" data-id="{{$mop->id}}"
                              data-name="{{$mop->name}}"><i class="fa fa-pencil"></i> Edit </a>
                              <a onclick="deleteData({{$mop->id}})" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Trash </a>
                              <form method="POST" action="">
                                @method('DELETE')
                                @csrf                                
                              </form>
                            </td>                              
                          </tr>
                        @endforeach                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
</div>
@include('mops.form')
<script type="text/javascript">

function filterData(){
    var table = $('#datatable-fixed-header').DataTable();

    ///Date picker function start here
    var startDate;
    var endDate;

    $('#reportrange_right').daterangepicker(
       {
        
          startDate: moment().subtract(29 , 'days'),
          endDate: moment(),
          minDate: '01/01/2012',
          maxDate: '12/31/2014',
          dateLimit: { days: 60 },
          showDropdowns: true,
          showWeekNumbers: true,
          timePicker: false,
          timePickerIncrement: 1,
          timePicker12Hour: true,
          ranges: {
             'Today': [moment(), moment()],
             'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
             'Last 7 Days': [moment().subtract(6, 'days'), moment()],
             'Last 30 Days': [moment().subtract(29, 'days'), moment()],
             'This Month': [moment().startOf('month'), moment().endOf('month')],
             'Last Month': [moment().subtract(1,'month').startOf('month'), moment().subtract(1,'month').endOf('month')]
          },
          opens: 'left',
          buttonClasses: ['btn btn-default'],
          applyClass: 'btn-small btn-primary',
          cancelClass: 'btn-small',
          format: 'DD/MM/YYYY',
          separator: ' to ',
          locale: {
              applyLabel: 'Submit',
              fromLabel: 'From',
              toLabel: 'To',
              customRangeLabel: 'Custom Range',
              daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
              monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
              firstDay: 1
          }
       }
       
    );
    var firstDate =  moment().subtract(29,'days').format('Y-M-D'); 
    var lastDate =  moment().format('Y-M-D');
    
    ///Date picker function ends here

    $.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = firstDate;
        var max = lastDate;
        var dat =  parseFloat( data[3] ) || 0; // use data for the age column
 
        if ( ( isNaN( min ) && isNaN( max ) ) ||
             ( isNaN( min ) && dat <= max ) ||
             ( min <= dat   && isNaN( max ) ) ||
             ( min <= dat   && dat <= max ) )
        {
            return true;
        }
        return false;
    }
  );
    table.draw();

 }
</script>  
@endsection
