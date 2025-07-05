<div class="row page-title align-items-center my-3 mx-1">
    <div class="col-sm-6 col-xl-6">
        <h4 class="mb-1 mt-0">
            @if (!empty($icono))
                {!! $icono !!}
            @endif
            {{ $title }}
        </h4>
    </div>
    <div class="col-sm-6 col-xl-6">
        <ol class="breadcrumb float-end">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Inicio</a>
            </li>
            @foreach ($segments as $segment)
                @if (!$segment['active'] && $segment['url'])
                    <li class="breadcrumb-item">
                        <a href="{{ $segment['url'] }}">{{ $segment['name'] }}</a>
                    </li>
                @elseif (!$segment['active'])
                    <li class="breadcrumb-item">{{ $segment['name'] }}</li>
                @else
                    <li class="breadcrumb-item active">{{ $segment['name'] }}</li>
                @endif
            @endforeach
        </ol>
    </div>
</div>
