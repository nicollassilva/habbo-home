@extends('layouts.app')

@section('title', 'Minha Habbo Home')

@php
    $playgroundBackground = '';

    if($background) {
        $playgroundBackground = "style=\"background-image: url('/storage/homepage/backgrounds/{$background->product->image}');\"";
    }
@endphp

@section('content')
<div class="container d-flex justify-content-center flex-column align-items-center">
    @include('home._partials.page-title')
    <div class="box-home mb-5">
        <div class="header">
            <button class="btn btn-sm btn-dark" onclick="Modal.Target('#MyItems')" dataInventory><i
                    class="fas fa-boxes mr-1"></i>Meu inventário</button>
            <button class="btn btn-sm btn-primary" onclick="Modal.Target('#ShopItems')"><i
                    class="fas fa-store mr-1"></i>Loja de Widgets</button>
            <button class="btn btn-sm btn-success" dataSave><i class="fas fa-save mr-1"></i>Salvar home</button>
        </div>
        <div class="playground" {!! $playgroundBackground !!}>
            @foreach ($items as $userItem)
                @if (!$userItem->widget)
                    <div class="sticker in-draggable itemid{{ $userItem->product->id }} widget-{{ $userItem->widget_id }}"
                        reverse="{{ $userItem->reverse }}"
                        style="
                            width: {{ $userItem->product->width }}px;
                            height: {{ $userItem->product->height }}px;
                            left: {{ $userItem->x }}px;
                            top: {{ $userItem->y }}px;
                            z-index: {{ $userItem->z }}px;
                            background-image: url('/storage/homepage/{{ $userItem->product->category->name }}/{{ $userItem->product->image }}')
                            ">
                        <div class="btns-actions">
                            <button><i class="stickers"></i></button>
                            <button><i class="delete"></i></button>
                        </div>
                    </div>
                @else
                    {!! widget($userItem) !!}
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection