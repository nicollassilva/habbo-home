@extends('layouts.app')

@section('title', isset($user) ? "Home de {$user->username}" : "Minha home")

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
            @if ($homeEditable)
                <button class="btn btn-sm btn-dark" onclick="Modal.Target('#MyItems')" dataInventory>
                    <i class="fas fa-boxes mr-1"></i>Meu inventário
                </button>
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#shopModal">
                    <i class="fas fa-store mr-1"></i>Loja de Widgets
                </button>
                <button class="btn btn-sm btn-success" dataSave>
                    <i class="fas fa-save mr-1"></i>Salvar home
                </button>
            @endif
        </div>
        <div class="playground" {!! $playgroundBackground !!}>  
            @foreach ($items as $userItem)
                @if (!$userItem->widget)
                    <div class="sticker @if ($homeEditable) in-draggable itemid{{ $userItem->product->id }} widget-{{ $userItem->widget_id }} @endif"
                        reverse="{{ $userItem->reverse }}"
                        style="left: {{ $userItem->x }}px;top: {{ $userItem->y }}px;z-index: {{ $userItem->z }};">
                        <img src="/storage/homepage/{{ $userItem->product->category->name }}/{{ $userItem->product->image }}" alt="{{ $userItem->product->title }}" width="{{ $userItem->product->width }}" height="{{ $userItem->product->height }}">
                        @if ($homeEditable)
                            <div class="btns-actions">
                                <button><i class="rotate"></i></button>
                                <button><i class="delete"></i></button>
                            </div>
                        @endif
                    </div>
                @else
                    {!! widget($userItem, $homeEditable) !!}
                @endif
            @endforeach
        </div>
    </div>
</div>
@if ($homeEditable)
    @include('home._partials.shop')
@endif

@endsection