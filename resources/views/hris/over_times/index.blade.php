<div class="container bg-white padding10 no-margin">
  <div class="row">
    <div class="col-md-12">
      {{ export_btn('overtime') }}
    </div>
    <div class="col-md-12">
      <table class="table bordered border striped" id="datatable">
        <thead>
          <tr>
            <th width="10px">#</th>
            <th>Employee</th>
            <th>Department</th>
            <th>Sub Department</th>
            <th>Position</th>
            <th>Date</th>
            <th>Pay ($)</th>
            <th width="50px">Action</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
<script type="text/javascript">
  function pay(id) 
  {
    loadForFree(id, '{{ route('overtime.pay_edit') }}', 'Pay', size='very-small');
  }
</script>