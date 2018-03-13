<div class="panel panel-default">
  <div class="panel-heading">
    Important File
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-sm-6">
        {!! inp_file('certidao', 'Attach Certidao Baptismo', 'onchange="uploadHistory(this, \'certidao_baptismo\')"') !!}
        <input type="hidden" name="certidao_baptismo" class="certidao_baptismo">
      </div>
      <div class="col-sm-6">
        {!! inp_file('elekt', 'Attach Elektoral', 'onchange="uploadHistory(this)"') !!}
        <input type="hidden" name="elektoral" class="elektoral">
      </div>
      <div class="col-sm-6">
        {!! inp_file('cartao_rd', 'Attach Cartao RDTL', 'onchange="uploadHistory(this, \'cartao_rdtl\')"') !!}
        <input type="hidden" name="cartao_rdtl" class="cartao_rdtl">
      </div>
    </div>
    <div class="alert alert-info">
      <h4><i class="icon fa fa-info-circle"></i> Please read!</h4>
      Download file under to check<br>
      1. Certidao Baptismo <a target="_blank" href="{{ route('employee.certidao_baptismo_download', [$data->id]) }}">download</a><br>
      2. Cartao RDTL <a target="_blank" href="{{ route('employee.cartao_rdtl_download', [$data->id]) }}">download</a><br>
      3. Elektoral <a target="_blank" href="{{ route('employee.elektoral_download', [$data->id]) }}">download</a><br>
      Keep blank if do not want to change.<br>
      Supported file types .doc, .docx, .pdf, .bmp, .jpg, .png
    </div>
  </div>
</div>