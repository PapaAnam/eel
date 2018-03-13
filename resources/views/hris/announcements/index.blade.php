<div class="container bg-white padding10 no-margin">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#data" data-toggle="tab">Data</a></li>
    <li><a href="#new" data-toggle="tab">New</a></li>
  </ul>
  <div class="tab-content" style="padding-top: 10px;">
    <div class="tab-pane active" id="data">
      <div class="row">
        <div class="col-md-12">
          {!! reload_btn() !!}
        </div>
        <div class="col-md-12">
          <table class="table bordered border striped" id="datatable">
            <thead>
              <tr>
                <th width="10px">#</th>
                <th>Title</th>
                <th>Content</th>
                <th>Created At</th>
                <th>Show At</th>
                <th>Until At</th>
                <th width="100px">Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
    <div class="tab-pane" id="new">
    @include('announcements.add')
    </div>
  </div>
</div>
@include('layouts.form.remove', ['modul'=>'announcement'])
<script type="text/javascript">
  var myModal = $('#myModal');
  function detail(id) 
  {
    myModal.find('.modal-title').html('Mutation Detail');
    myModal.find('.modal-dialog').css('width', '60%');
    loadForm(id, '{{ route('mutation.detail') }}');
  }
  function edit(id) {
    myModal.find('.modal-title').html('Mutation Edit');
    loadForm(id, '{{ route('mutation.edit') }}');
  }
</script>