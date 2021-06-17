@extends('layouts.app')

@section('title', 'Minha Habbo Home')

@php
    $playgroundBackground = '';

    if($background) {
        $playgroundBackground = "style=\"background-image: url('/homepage/backgrounds/{$background->image}');\"";
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

        </div>
    </div>
</div>
@endsection