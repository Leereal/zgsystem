@extends('layouts.dashboard')
@section('content')

<div class="right_col" role="main">
  <!-- top tiles -->
  <div class="row tile_count">
    <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-money"></i> Total Payments</span>
      <div class="count green"> @money($payments->sum('amount'))</div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>{{round((($payments->sum('amount'))-($overal_last_month_payments))/$overal_last_month_payments*100) }}%</i> From Last Month</span>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-money"></i> {{ Auth::user()->branch->branch_name }} Total Payments</span>
      <div class="count green">@money($branch_total_payments)</div>
      <span class="count_bottom"><i class="green">{{round(($branch_total_payments-$branch_total_payments_last_month )/$branch_total_payments_last_month *100) }}% </i> From Last Month</span>
    </div>    
    <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-money"></i> {{ Auth::user()->branch->branch_name }} {{ date('F', strtotime("-1 month")) }} Total Payments</span>
      <div class="count green">@money($last_month_payments->sum('amount'))</div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>{{ round($last_month_payments->sum('amount')/$overal_last_month_payments*100) }}% </i> Of All Payments Last Month</span>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-money"></i> {{ Auth::user()->branch->branch_name }} {{ date('F')}} Total Payments</span>
      <div class="count green"> @money($this_month_payments)</div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-desc"></i>
       {{ $target['amount'] > 0 ? ($this_month_payments/$target['amount']*100): 0 }}% 
      </i> Of Target  @money($target['amount'])</span>
    </div>    
  </div>
  <!-- /top tiles -->
  <!-- top tiles -->
  <div class="row tile_count">    
    <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Claims</span>
      <div class="count blue">$50,994.00</div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From Last Month</span>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> {{ Auth::user()->branch->branch_name }} Total Claims</span>
      <div class="count blue">$4,567.00</div>
      <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> This Month's Claims</span>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i>{{ Auth::user()->branch->branch_name }} {{ date('F', strtotime("-1 month")) }} Total Claims</span>
      <div class="count blue">$2,315.00</div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> This Month's Claims</span>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> {{ Auth::user()->branch->branch_name }} {{ date('F')}} Total Claims</span>
      <div class="count blue">$7,325.00</div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From This Month</span>
    </div>
  </div>
  <!-- /top tiles -->
  <div class="row top_tiles">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <a href="/requests">
        <div class="tile-stats" style="color:{{ $requestchecks->count() ? 'white' : ''}};background-color:{{ $requestchecks->count() ? 'red' : ''}}">
          <div class="icon"><i class="fa fa-bell-o"></i></div>
          <div class="count"><span class="label label-success">{{ $requestchecks->count()+0 }}</span></div>
          <h4>Service Providers Requests</h4>
          <p>Requests from service providers</p>
        </div>
      </a>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-group"></i></div>
        <div class="count">{{ $clients->count('id') }}</div>
        <h4>{{ Auth::user()->branch->branch_name }} Clients</h4>
        <p>All clients registered at this branch</p>
      </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-group"></i></div>
        <div class="count">{{ $active_clients }}</div>
        <h4>{{ Auth::user()->branch->branch_name }} Active Clients</h4>
        <p>All clients registered at this branch</p>
      </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-check-square-o"></i></div>
        <div class="count">{{ $service_providers->count('id') }}</div>
        <h4>Service Providers</h4>
        <p>All our service providers</p>
      </div>
    </div>
  </div>    
</div>
@endsection