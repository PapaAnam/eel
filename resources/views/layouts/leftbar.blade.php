<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ $profile->avatar }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ strlen($profile->name)>20?substr($profile->name, 0, 15).'...':$profile->name }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      @if(Auth::user()->level==1)
        @include('layouts.leftbar.administrator')
      @else
        @include('layouts.leftbar.user')
      @endif
    </ul>
  </section>
</aside>