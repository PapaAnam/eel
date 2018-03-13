@extends('layouts.view')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>Special Day</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="{{ $back }}">Calendar</a></li>
      <li class="active">Special Day</li>
    </ol>
  </section>
  <section class="content">
    {!! scs() !!}
    <div class="row">
      <div class="col-xs-12">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">Data</a></li>
            <li><a href="#tab_2" data-toggle="tab">New</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
              <div class="row">
                <div class="col-md-12">
                  <table class="datatable table table-striped table-bordered">
                    <thead>
                      <th width="10px">#</th>
                      <th>Date</th>
                      <th>Month</th>
                      <th>Event</th>
                      <th width="100px">Action</th>
                    </thead>
                    <tbody>
                      <?php $no = 1; ?>
                      @foreach($data as $d)
                      <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $d->date }}</td>
                        <td>{{ english_month_name($d->month) }}</td>
                        <td>{{ $d->event }}</td>
                        <td>
                          {!! ed_btn(route('calendar.edit', $d->id)) !!}
                          {!! del_btn($d->id) !!}
                        </td>
                      </tr>
                      <?php $no++; ?>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab_2">
              @include('calendars.add')
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@include('layouts.form.remove')
@endsection