<div class="widget in-draggable itemid{{ $item->product->id }} widget-{{ $item->widget_id }} widget_{{ $item->theme }}"
    data-theme="{{ $item->theme }}" style="left:{{ $item->x }}px; top:{{ $item->y }}px; z-index:{{ $item->z }};">
    <div class="heading">
        <span>Meus emblemas ({{ count($badges) }})</span>
    </div>
    @if ($isOwner)
        @include('home.widgets._partials.buttons')
    @endif
    <div class="body">
        <div class="box-badges">
            @foreach ($badges as $badge)
            <div class="emblema" data-toggle="tooltip"
                title="<b>Código:</b> {{ $badge->getCode() }}<br><b>Nome:</b> {{ $badge->getName() }}<br><b>Descrição:</b> {{ $badge->getDescription() }}"
                style="background-image: url('https://images.habbo.com/c_images/album1584/{{ $badge->getCode() }}.png')"></div>
            @endforeach
            @if (empty($badges))
                <span class="w-100 float-left d-flex justify-content-center align-items-center" style="height: 180px;">Nenhum emblema encontrado.</span>
            @endif
        </div>
    </div>
</div>