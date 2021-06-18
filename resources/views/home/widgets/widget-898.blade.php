<div class="widget in-draggable itemid{{ $item->product->id }} widget-{{ $item->widget_id }} widget_{{ $item->theme }}"
    data-theme="{{ $item->theme }}" style="left:{{ $item->x }}px; top:{{ $item->y }}px; z-index:{{ $item->z }}px;">
    <div class="heading">
        <span>Perfil de {{ $user->username }}</span>
    </div>
    <div class="body">
        <div class="userfirst">
            <div class="usernamebox">
                <div class="username">{{ $user->username }}</div>
            </div>
            <div class="usermottobox">
                <span>
                    Cadastrou em <b>{!! Carbon::parse($user->created_at)->format("d-m-Y H:i") !!}</b>
                </span>
                <span>
                    Último login em <b>{!! Carbon::parse($user->updated_at)->format("d-m-Y H:i") !!}</b>
                </span>
                <div class="details-container last_login">
                    Ultima visita: {!! string_time(strtotime($user->updated_at)) !!}
                </div>
            </div>
        </div>
        <div class="userplate">
            <div class="avatar-medio" style="margin-top: -15px;">
                <img src="{{ imager($user->username, "headonly=0&direction=4&head_direction=3&action=&gesture=sit&size=m") }}">
            </div>
        </div>
    </div>
</div>