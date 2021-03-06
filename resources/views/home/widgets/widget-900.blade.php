<div class="widget @if ($isEditable) in-draggable-widget itemid{{ $item->product->id }} widget-{{ $item->widget_id }} @endif widget_{{ $item->theme }}"
    data-theme="{{ $item->theme }}" style="left:{{ $item->x }}px; top:{{ $item->y }}px; z-index:{{ $item->z }};">
    <div class="heading">
        <span>Meus emblemas ({{ count($badges) }})</span>
    </div>
    @if ($isEditable)
        @include('home.widgets._partials.buttons')
    @endif
    <div class="body">
        <div class="box-badges">
            @foreach ($badges as $badge)
            <div class="emblema" data-toggle="tooltip"
                title="<b>Código:</b> {{ $badge->getCode() }}<br><b>Nome:</b> {{ $badge->getName() }}<br><b>Descrição:</b> {{ $badge->getDescription() }}">
                <img loading="lazy" src="https://images.habbo.com/c_images/album1584/{{ $badge->getCode() }}.png" alt="{{ $badge->getCode() }}">
            </div>
            @endforeach
            @if (empty($badges))
                <span class="w-100 float-left d-flex justify-content-center align-items-center" style="height: 180px;">Nenhum emblema encontrado.</span>
            @endif
        </div>
    </div>
</div>