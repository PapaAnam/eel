<form action="{{ $action }}" id="form-id" method="post">
  {{ csrf_field() }}
  <div class="row">
    <div class="col-md-2">
      <div class="form-group @if ($errors->has('date')) has-error @endif">
        <label for="date">Date</label>
        <input placeholder="Insert Date" type="number" min="1" max="31" required class="form-control month-day" id="date" name="date" required @if(count($errors)) value="{{ old('date') }}" @endif>
        @if ($errors->has('date'))
        <span class="help-block">
          <strong>{{ $errors->first('date') }}</strong>
        </span>
        @endif
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group @if ($errors->has('month')) has-error @endif">
        <label for="month">Month</label>
        <select name="month" class="select2 form-control" style="width: 100%;">
          @for($i=1;$i<=12;$i++)
          <option value="{{ $i }}">{{ english_month_name($i) }}</option>
          @endfor
        </select>
      </div>
    </div>
    <div class="col-md-7">
      <div class="form-group @if ($errors->has('event')) has-error @endif">
        <label for="event">Event</label>
        <input placeholder="Insert Event" type="text"  required class="form-control" id="event" name="event" required @if(count($errors)) value="{{ old('event') }}" @endif>
        @if ($errors->has('event'))
        <span class="help-block">
          <strong>{{ $errors->first('event') }}</strong>
        </span>
        @endif
      </div>
    </div>
    <div class="col-md-12">
      {{ save_btn() }}
    </div>
  </div>
</form>