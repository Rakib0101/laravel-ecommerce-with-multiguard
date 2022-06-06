@extends('layouts.backend-master')
@section('content')

@foreach ($products as $product)
    {{$product->product_name_en}}
@endforeach
    
@endsection