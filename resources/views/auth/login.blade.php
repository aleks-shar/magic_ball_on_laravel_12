@extends('layouts.app')

@section('title')
    Войти
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Шар предсказаний</h1>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach($errors->all() as $error)
                                {{ $error }}<br/>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{ route('auth.login') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="code"
                                   class="col-md-4 col-form-label text-md-end"><h5>Введите ваш идентификатор</h5></label>
                            <div class="col-md-6">
                                <input id="identifier" name="identifier" type="text" class="form-control"
                                       placeholder="Любые символы">
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Войти
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
