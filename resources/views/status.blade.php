
@extends('layouts.app')
@section('content')
<table class="table">
    <thead>
    <tr>
        <th scope="col">Всего овечек</th>
        <th scope="col">Забаниных овечек</th>
        <th scope="col">Живых овечек </th>
        <th scope="col">Самый населеный загон № {{ $max->paddock }}</th>
        <th scope="col">Самый маленький загон № {{ $min->paddock }}</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="row">{{ $all }}</th>
        <td>{{ $kill }}</td>
        <td> {{ $live  }}</td>
        <td> Количество овец в загоне: {{ $max->total }} </td>
        <td> Количество овец в загоне: {{ $min->total }} </td>
    </tr>

    </tbody>
</table>
@endsection
