@if(isset($lvl[$index]))
@foreach ($lvl[$index] as $val)
    <li class="lvl-{{$index}} @if ($val->is_active ) active @endif">
        <label class="tree-toggle nav-header">
            <a href="{{$val->url}}">{{$val->lable}}</a>
        </label>

        @if ($val->is_active and isset($lvl[$index+1]))
        <ul class="nav nav-list tree">
            @include('jetcms.core::helpers.li_lvl',[
                'index' => $index+1,
                'lvl' => $lvl,
                'hr' => false
            ])
        </ul>
        @endif
    </li>

    @if (isset($hr) and $hr == true)
    <li>
        <hr class="h6"/>
    </li>

    @endif
@endforeach
@endif