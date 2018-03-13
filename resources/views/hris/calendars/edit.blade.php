<div class="row">
  <form action="{{ route('special_day.update') }}" onsubmit="save(this, event)">
    {{ method_field('PUT') }}
    {{ id_field($d->id) }}
    {{ csrf_field() }}
    <div class="col-md-12">
      {{ input_text('date', '', $d->date) }}
    </div>
    <div class="col-md-12">
      {{ input_text('month', '', $d->month) }}
    </div>
    <div class="col-md-12">
      {{ input_text('event', '', $d->event) }}
    </div>
    <div class="col-md-12">
    {{ save_button('update').' '.save_close_button('update') }}
    </div>
  </form>
</div>