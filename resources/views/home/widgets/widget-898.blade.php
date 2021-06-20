<div class="widget in-draggable-widget itemid{{ $item->product->id }} widget-{{ $item->widget_id }} widget_{{ $item->theme }}"
    data-theme="{{ $item->theme }}" style="left:{{ $item->x }}px; top:{{ $item->y }}px; z-index:{{ $item->z }};">
    <div class="heading">
        <span>Perfil de {{ $item->user->username }}</span>
    </div>
    @if ($isOwner)
        @include('home.widgets._partials.buttons')
    @endif
    <div class="body">
        <div class="userfirst">
            <div class="usernamebox">
                <div class="username">{{ $item->user->username }}</div>
            </div>
            <div class="usermottobox">
                <span>
                    Cadastrou em <b>{!! Carbon::parse($item->user->created_at)->format("d-m-Y H:i") !!}</b>
                </span>
                <span>
                    Último login em <b>{!! Carbon::parse($item->user->updated_at)->format("d-m-Y H:i") !!}</b>
                </span>
                <div class="details-container last_login">
                    Ultima visita: {!! string_time(strtotime($item->user->updated_at)) !!}
                </div>
            </div>
        </div>
        <div class="userplate">
            <div class="avatar-medio" style="margin-top: -15px;">
                <img src="{{ imager($item->user->username, "headonly=0&direction=4&head_direction=3&action=&gesture=sit&size=m") }}">
            </div>
        </div>
    </div>
</div>