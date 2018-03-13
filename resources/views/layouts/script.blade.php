{{-- <script src="{{ asset(mix('js/app.js')) }}"></script> --}}
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/extensions/Responsive/js/dataTables.responsive.js') }}"></script>
<script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
@include('script.mask')
@include('script.random')
@include('script.tile_background')
@include('script.set_bg')
<script type="text/javascript">
  var mv                 = $('.mac-view');
  var mac_loader_mv      = mv.find('.mac-loader');
  var mac_mv             = mv.find('.mac');
  var mac_preloader_mv   = mv.find('.mac-preloader');
  var mac_module_icon_mv = mv.find('.mac-module-icon');
  var mac_icon_mv        = mv.find('.mac-icon');
  var mac_title_mv       = mv.find('.mac-title');
  var mac_content_mv     = mv.find('.mac-content');
  var mac_close_mv       = mv.find('.mac-close');
  var me                 = $('.mac-edit');
  var mac_loader_me      = me.find('.mac-loader');
  var mac_me             = me.find('.mac');
  var mac_preloader_me   = me.find('.mac-preloader');
  var mac_module_icon_me = me.find('.mac-module-icon');
  var mac_icon_me        = me.find('.mac-icon');
  var mac_title_me       = me.find('.mac-title');
  var mac_content_me     = me.find('.mac-content');
  var mac_close_me       = me.find('.mac-close');
  var md                 = $('.mac-detail');
  var mac_loader_md      = md.find('.mac-loader');
  var mac_md             = md.find('.mac');
  var mac_preloader_md   = md.find('.mac-preloader');
  var mac_module_icon_md = md.find('.mac-module-icon');
  var mac_icon_md        = md.find('.mac-icon');
  var mac_title_md       = md.find('.mac-title');
  var mac_content_md     = md.find('.mac-content');
  var mac_close_md       = md.find('.mac-close');
  var mf                 = $('.mac-free');
  var mac_loader_mf      = mf.find('.mac-loader');
  var mac_mf             = mf.find('.mac');
  var mac_preloader_mf   = mf.find('.mac-preloader');
  var mac_module_icon_mf = mf.find('.mac-module-icon');
  var mac_icon_mf        = mf.find('.mac-icon');
  var mac_title_mf       = mf.find('.mac-title');
  var mac_content_mf     = mf.find('.mac-content');
  var mac_close_mf       = mf.find('.mac-close');
  var please_wait = $('.please-wait');
  var table;
  var table1;
  var table2;
  var table3;
  var bg;
  var url;
  var icon;
  var title;
  var datatable_url;
  var csrf_token = $('#csrf_token').attr('content');
  var window_active = []
  var statusCode = {
    403 : function(xhr){
      errorMsg('Not Authority');
      mac_close_mv.trigger('click');
      mac_preloader_mv.fadeOut('slow');
      mac_loader_mv.fadeOut('slow');
    },
    401 : function(xhr){
      errorMsg('You are not login. Page will be redirect in 3s');
      setTimeout(function(){
        window.location = '{{ route('login') }}'
      }, 3000)
      mac_close_mv.trigger('click');
      mac_preloader_mv.fadeOut('slow');
      mac_loader_mv.fadeOut('slow');
    },
    500 : function(xhr){
      errorMsg('There is error in server');
      mac_close_mv.trigger('click');
      mac_preloader_mv.fadeOut('slow');
      mac_loader_mv.fadeOut('slow');
    }
  }

  $(document).on('keyup', function(e){
    if(e.keyCode == 27){
      let win = window_active.pop()
      if(win == 'mv'){
        mac_close_mv.trigger('click')
      }
      else if(win == 'me'){
        mac_close_me.trigger('click')
      }
      else if(win == 'mf'){
        mac_close_mf.trigger('click')
      }
      else if(win == 'md'){
        mac_close_md.trigger('click')
      }
    }

  })

  // $("[data-role='tile']").each(function(){
  //   var tile = $(this);
  //   tile.click(function(){
  //     datatable_url = tile.data('datatable');
  //     bg            = tile.css('backgroundColor');
  //     icon          = tile.find('.icon').data('icon');
  //     title         = tile.data('title');
  //     url           = tile.data('url');
  //     mac_preloader_mv.css('backgroundColor', bg).fadeIn('slow');
  //     setTimeout(function(){
  //       mac_module_icon_mv.find('i').addClass(icon);
  //       mac_mv.css('backgroundColor', bg).fadeIn('slow');
  //       mac_icon_mv.find('i').addClass(icon);
  //       mac_title_mv.text(title);
  //       loadContent(url);
  //     }, 1000);
  //   });
  // });
  function getContent(tile){
    datatable_url = tile.data('datatable');
    bg            = tile.css('backgroundColor');
    icon          = tile.find('.icon').data('icon');
    title         = tile.data('title');
    url           = tile.data('url');
    mac_preloader_mv.css('backgroundColor', bg).fadeIn('slow');
    setTimeout(function(){
      mac_module_icon_mv.find('i').addClass(icon);
      mac_mv.css('backgroundColor', bg).fadeIn('slow');
      mac_icon_mv.find('i').addClass(icon);
      mac_title_mv.text(title);
      loadContent(url);
    }, 1000);
  }

  mac_close_mv.click(function(){
    mac_mv.fadeOut('slow');
    mac_title_mv.text('');
    mac_module_icon_mv.find('i').attr('class', '');
    mac_icon_mv.find('i').attr('class', '');
    mac_content_mv.empty();
  });

  function loadContent(url){
    $.ajax({
      cache : false,
      url : url,
      beforeSend : function(xhr)
      {
        mac_loader_mv.fadeIn('slow');
      },
      success : function(reponse){
        mac_preloader_mv.fadeOut('slow');
        mac_loader_mv.fadeOut('slow');
        setContent(reponse);
        window_active.push('mv')
      },
      error : function(xhr){
        // $.Notify({keepOpen: true, type: 'alert', caption: 'Failed', content: xhr.responseText});
      },
      statusCode : statusCode
    });
  }

  {{--function setContent(data){
    mac_content_mv.html(data);
    table = mac_mv.find('#datatable').DataTable({
      ajax : {
        url : datatable_url,
        type : 'POST',
        data : {
          _token : csrf_token
        }
      },
      responsive : true
    });
    if(title=='Departments'){
      table1 = mac_mv.find('.sub_departments').DataTable({
        ajax : {
          url : '{{ route('sd.dt') }}',
          type : 'POST',
          data : {
            _token : csrf_token
          }
        },
        responsive : true
      });
      table2 = mac_mv.find('#department-recycle').DataTable({
        ajax : {
          url : '{{ route('department.recycle') }}',
          type : 'POST',
          data : {
            _token : csrf_token
          }
        },
        responsive : true
      });
      table3 = mac_mv.find('#sub-department-recycle').DataTable({
        ajax : {
          url : '{{ route('sd.recycle') }}',
          type : 'POST',
          data : {
            _token : csrf_token
          }
        },
        responsive : true
      });
    }
    if(title=='Employees'){
      table1 = mac_mv.find('.non_active_employees').DataTable({
        ajax : {
          url : '{{ route('employee.non_active_dt') }}',
          type : 'POST',
          data : {
            _token : csrf_token
          }
        },
        responsive : true
      });
      table2 = mac_mv.find('#salary-rules').DataTable({
        ajax : {
          url : '{{ route('employee.salary_rules.dt') }}',
          type : 'POST',
          data : {
            _token : csrf_token
          }
        },
        responsive : true
      });
    }
  }--}}
  function restore(id, url){
    var conf = confirm('Are you sure?');
    if(conf){
      $.ajax({
        url : url,
        type : 'POST',
        data : {
          _token : csrf_token,
          id : id
        },
        success : function(response){
          refreshTable();
          successMsg(response);
        }
      });
    }
  }
  function permanentDelete(id, url){
    var conf = confirm('Are you sure?');
    if(conf){
      $.ajax({
        url : url,
        type : 'POST',
        data : {
          _token : csrf_token,
          id : id,
          _method : 'DELETE'
        },
        beforeSend : function(){
          please_wait.show();
        },
        success : function(response){
          please_wait.hide();
          refreshTable();
          successMsg(response);
        }
      });
    }
  }

  function save(el, e, action='insert', close=false, callback = null){
    e.preventDefault();
    // if(!callback)
    //   callback()
    $('.form-group').removeClass('has-error');
    $('span.help-block>strong').empty();
    var form = $(el);
    var button = $(el).attr('id')=='save' || $(el).attr('id')=='save-close';
    if(button){
      form = $(el).parents('form');
    }
    var data = form.serialize();
    var url = form.attr('action');
    if(button){
      button = $(el);
    }else{
      button = form.find('#save');
    }
    button.html('Saving <span class="mif-spinner3 mif-ani-pulse"></span>');
    $.ajax({
      url : url,
      type : 'POST',
      data : data,
      success : function(response, s, x){
        successMsg(response);
        if(action=='insert'){
          form.find('[type="text"], [type="password"], textarea').val('');
          $('#img-photo').attr('src', '{{ asset('images/employee/default.jpg') }}');
          resetSelect(form);
          if(form.find('#created_at').length!=0)
            form.find('#created_at').val('{{ date('Y-m-d') }}');
          if(form.find('#time_oclock').length!=0)
            form.find('#time_oclock').val('08:30:00');
          form.find('[type="file"]').val('');
          if(document.getElementById('check-all')!=null){
            console.log('uncheck all');
            $('#add-form').find('[type="checkbox"], [type="radio"]').iCheck('uncheck');
          }
          if(document.getElementsByClassName('multiple')!=null){
            $('.multiple').select2().val('').trigger('change');
          }  
          if(callback == 'refresh-calendar')
            console.log('')
        }
        refreshTable();
        if(close)
          form.parents('.mac').find('.mac-close').trigger('click');
        if($('.tbody-leave-period').length>0)
          refresh_leave_periods();
        button.html('Save');
      },
      error : function(a){
        if(a.status==409){
          $.Notify({keepOpen: true, type: 'alert', caption: 'Failed', content: a.responseText});
        }else if(a.status==422){
          $.Notify({keepOpen: true, type: 'alert', caption: 'Failed', content: 'Error occured!!!<br>Please check again form'});
          var errors = JSON.parse(a.responseText);
          var input;
          for(var key in errors){
            input = form.find('#'+key).next().find('strong');
            input.html(errors[key][0]);
            input.parents('.form-group').addClass('has-error');
          }
        }else{
          $.Notify({keepOpen: true, type: 'alert', caption: 'Failed', content: 'Error occured!!!<br>Please check again form'});
        }
        button.html('Save');
      }
    });
  }

  function edit(id, url, size='default'){
    mac_preloader_me.css('backgroundColor', bg).fadeIn('slow');
    setTimeout(function(){
      mac_module_icon_me.find('i').addClass(icon);
      mac_me.css('backgroundColor', bg).fadeIn('slow');
      mac_icon_me.find('i').addClass(icon);
      mac_title_me.text("Edit "+title);
      loadForm(id, url, size);
    }, 1000);
  }
  function loadForm(id, url, size='default')
  {
    $.ajax({
      url : url,
      type : 'POST',
      data : {
        id : id,
        _token : csrf_token
      },
      beforeSend : function(xhr){
        mac_loader_me.fadeIn('slow');
      },
      success : function(r){
        if(size=='small'){
          mac_me.addClass('mac-small box-shadow');
        }
        mac_content_me.html(r);
        mac_preloader_me.fadeOut('slow');
        var height = me.find('.mac-small').height();
        if(size=='small'){
          mac_me.css({'top' : '50%', 'marginTop' : '-'+height/2+'px'});
        }
        window_active.push('me')
        mac_loader_me.fadeOut('slow');
      },
      statusCode : {
        403 : function(xhr){
          errorMsg('Not Authority');
          mac_close_me.trigger('click');
          mac_preloader_me.fadeOut('slow');
          mac_loader_me.fadeOut('slow');
        },
        500 : function(xhr){
          errorMsg('There is error in server');
          mac_close_me.trigger('click');
          mac_preloader_me.fadeOut('slow');
          mac_loader_me.fadeOut('slow');
        }
      }
    });
  }
  mac_close_me.click(function(){
    mac_me.fadeOut('slow');
    mac_title_me.text('');
    mac_module_icon_me.find('i').attr('class', '');
    mac_icon_me.find('i').attr('class', '');
    mac_content_me.empty();
    mac_me.removeClass('mac-small box-shadow');
    mac_me.css({'top':'5%', 'marginTop':'0px'});
  });
</script>
@include('script.mac_detail')
<script>
  function nonActivate(id, url, prefix='', size='default'){
    mac_preloader_mf.css('backgroundColor', bg).fadeIn('slow');
    setTimeout(function(){
      mac_module_icon_mf.find('i').addClass(icon);
      mac_mf.css('backgroundColor', bg).fadeIn('slow');
      mac_icon_mf.find('i').addClass(icon);
      mac_title_mf.text(prefix+" "+title);
      loadFree(id, url, size);
    }, 1000);
  }

  function loadForFree(id, url, prefix='', size='default'){
    mac_preloader_mf.css('backgroundColor', bg).fadeIn('slow');
    setTimeout(function(){
      mac_module_icon_mf.find('i').addClass(icon);
      mac_mf.css('backgroundColor', bg).fadeIn('slow');
      mac_icon_mf.find('i').addClass(icon);
      mac_title_mf.text(prefix+" "+title);
      loadFree(id, url, size);
    }, 1000);
  }

  function loadFree(id, url, size='default')
  {
    $.ajax({
      url : url,
      type : 'POST',
      data : {
        id : id,
        _token : csrf_token
      },
      beforeSend : function(xhr){
        mac_loader_mf.fadeIn('slow');
      },
      success : function(r){
        if(size!='default'){
          mac_mf.addClass('mac-'+size+' box-shadow');
        }
        mac_content_mf.html(r);
        mac_preloader_mf.fadeOut('slow');
        if(size!='default'){
          var height = mf.find('.mac-'+size).height();
          mac_mf.css({'top' : '50%', 'marginTop' : '-'+height/2+'px'});
        }
        mac_loader_mf.fadeOut('slow');
        window_active.push('mf')
      },
      statusCode : {
        403 : function(xhr){
          errorMsg('Not Authority');
          mac_close_mf.trigger('click');
          mac_preloader_mf.fadeOut('slow');
          mac_loader_mf.fadeOut('slow');
        },
        500 : function(xhr){
          errorMsg('There is error in server');
          mac_close_mf.trigger('click');
          mac_preloader_mf.fadeOut('slow');
          mac_loader_mf.fadeOut('slow');
        }
      }
    });
  }
  function activate(id, url){
    var confir = confirm('Are you sure to activate again?')
    if(confir)
      $.ajax({
        url : url,
        type : 'POST',
        data:{
          id : id,
          _token : csrf_token,
          _method : 'PUT'
        },
        success : function(r)
        {
          successMsg(r);
          refreshTable();
        }
      })
  }
  mac_close_mf.click(function(){
    mac_mf.fadeOut('slow');
    mac_title_mf.text('');
    mac_module_icon_mf.find('i').attr('class', '');
    mac_icon_mf.find('i').attr('class', '');
    mac_content_mf.empty();
    mac_mf.removeClass('mac-small box-shadow');
    mac_mf.css({'top':'5%', 'marginTop':'0px'});
  });
  function resetError(el)
  {
    el = $(el).next().find('strong');
    el.empty();
    $(el).parents().removeClass('has-error');
  }

  function logout(e){
    e.preventDefault();
    document.title = 'Logout HRIS';
    window.history.pushState('', '', '{{ route('logout') }}');
    $('.menu').fadeOut('slow');
    $('.logout-loader').fadeIn();
    var login;
    setInterval(function(){
      login = $('.logout-loader').find('h3');
      login.append('.');
      if(login.text()=='Loging out......')
        login.text('Loging out');
    }, 200);
    setTimeout(function(){
      $('#logout').unbind('submit').submit();
    }, 5000);
  }
  function refreshTable()
  {
    table.ajax.reload();
    if(table1!=undefined)
      table1.ajax.reload();
    if(table2!=undefined)
      table2.ajax.reload();
    if(table3!=undefined)
      table3.ajax.reload();
  }

  $(window).on('resize', function(){
    if($(this).height()>640)
    {
      $('body').removeClass('nothing').addClass('ovr');
    }
  });

  function successMsg(msg){
    $.Notify({type: 'success', caption: 'Success', content: msg});
  }

  function errorMsg(msg){
    $.Notify({keepOpen: true, type: 'alert', caption: 'Failed', content: msg});
  }

  function remove(id, url=null){
    var confir = confirm('Are you sure?');
    if(confir){
      $.ajax({
        url : url,
        data : {
          id : id,
          _token : csrf_token,
          _method : 'DELETE'
        },
        type : 'POST',
        beforeSend : function(){
          please_wait.show();
        },
        success : function(r)
        {
          please_wait.hide();
          successMsg(r);
          refreshTable();
        }
      })
    }
  }

  function resetSelect(form){
    var sel = form.find('select');
    var opt;
    sel.each(function(){
      optArr = [];
      $(this).find('option').each(function(){
        optArr.push($(this).attr('value'));
      });
      $(this).val(random(0, optArr.length)).trigger('change').val(optArr[0]).trigger('change');
    });
  }

  $('body').addClass('bg-'+current_bg);
</script>