<div class="widget @if ($isEditable) in-draggable-widget itemid{{ $item->product->id }} widget-{{ $item->widget_id }} @endif widget_{{ $item->theme }}"
    data-theme="{{ $item->theme }}" style="left:{{ $item->x }}px; top:{{ $item->y }}px; z-index:{{ $item->z }};">
    <div class="heading">
        <span>Meu livro de visitas ({{ count($messages) }})</span>
    </div>
    @if ($isEditable)
        @include('home.widgets._partials.buttons')
    @endif
    <div class="body">
        @auth
        <button onclick="Modal.Target(\'#guestbook\')" btnMessage>Escrever uma mensagem</button>
        @endauth
        <div class="mensagens">
            @foreach ($messages as $message)
            <div class="msg">
                <div class="avatar-pequeno" style="background-image: url('{{ imager($message->author->username, "direction=2&head_direction=3&gesture=sml&size=s") }}')"></div>
                <span class="user">
                    <a href="url-do-usuario">{{ $message->author->username }}</a>
                </span>
                <div class="texto">{{ $message->content }}</div>
                <div class="data">{!! string_time(strtotime($message->created_at)) !!}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>