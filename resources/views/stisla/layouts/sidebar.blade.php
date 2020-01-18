@php
  $_nama_aplikasi = config('stisla.nama_aplikasi');
  $_nama_aplikasi_mobile = config('stisla.nama_aplikasi_mobile');
@endphp
<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{ url('') }}">{{ $_nama_aplikasi }}</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ url('') }}">{{ $_nama_aplikasi_mobile }}</a>
    </div>
    <ul class="sidebar-menu">
      @foreach (\App\Models\Menu::with('sub')->whereNull('parent_id')->get() as $menu)
      @if($menu->sub->count() <= 0)
      <li @if($active == $menu->route) class="active" @endif>
        <a @if($menu->is_blank) target="_blank" @endif class="nav-link" href="{{ route($menu->route) }}"><i class="{{$menu->ikon}}"></i> <span>{{$menu->nama}}</span></a>
      </li>
      @else
      <li class="nav-item dropdown @if(in_array($active, $menu->sub->pluck('route')->toArray())) active @endif">
        <a href="#" class="nav-link has-dropdown"><i class="{{$menu->ikon}}"></i> <span>{{$menu->nama}}</span></a>
        <ul class="dropdown-menu">
          @foreach ($menu->sub as $sub)
          <li @if($active == $sub->route) class="active" @endif><a class="nav-link" href="{{route($sub->route)}}">{{$sub->nama}}</a></li>
          @endforeach
        </ul>
      </li>
      @endif
      @endforeach
    </ul>
  </aside>
</div>