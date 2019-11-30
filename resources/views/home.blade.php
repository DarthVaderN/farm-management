@extends('layouts.app')
@section('content')
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Ферма по разведению овец</h1>
                <h2>Дней</h2>
                <h3 id="day">0</h3>
                    @foreach ($yard as $key => $list)
                        <div class="col-md-6">
                            <h3>Загон №{{ $key }}</h3>
                            <div id="yard{{ $key  }}" class="yard">
                            @foreach ($list as $sheepId)
                                <div id="sheep{{ $sheepId }}" class="name">Овечка № {{ $sheepId }}</div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            <div class="col-md-6">
                <form>
                    <div class="form-group">
                        <button id="delete" class="btn">Сбросить к стандартным настройкам</button>
                    </div>
                    <div class="form-group">
                        <select name="command" id="" class="btn btn-info">
                            <option value="add" >Добавить одну</option>
                            <option value="sleep">Забанить одну</option>
                        </select>
                        <input type="submit" class="btn btn-info" name="send" value="Отправить">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
