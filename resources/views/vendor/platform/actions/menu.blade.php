@isset($title)
    <li class="nav-item mt-3 mb-1">
        <div class="text-muted ms-4 w-100 user-select-none">{{ __($title) }}</div>
    </li>
@endisset

@if (!empty($name))
<li class="nav-item {{ active($active) }} @if(active($active) == 'active' and config('platform.sidebar.color') == 'white') bg-secondary {{ config('platform.sidebar.active') }} @endif">
    <a data-turbo="{{ var_export($turbo) }}"
        {{ $attributes }}
    >
        @if(active($active) == 'active' and config('platform.sidebar.color') == 'white')
            <div class="text-white">
        @endif

        @isset($icon)
            <x-orchid-icon :path="$icon" class="{{ empty($name) ?: 'me-2'}}"/>
        @endisset

        {{ $name ?? '' }}

        @isset($badge)
            <b class="badge bg-{{$badge['class']}} col-auto ms-auto">{{$badge['data']()}}</b>
        @endisset

        @if(active($active) == 'active' and config('platform.sidebar.color') == 'white')
            </div>
        @endif
    </a>
</li>
@endif

@if(!empty($list))
    <div class="nav collapse sub-menu ps-2 {{active($active, 'show')}}"
         id="menu-{{$slug}}"
         data-bs-parent="#headerMenuCollapse">
        @foreach($list as $item)
            {!!  $item->build($source) !!}
        @endforeach
    </div>
@endif

@if($divider)
    <li class="divider my-2"></li>
@endif

