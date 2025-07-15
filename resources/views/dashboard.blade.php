@extends('layouts.app')

@section('title')
    {{ auth()->user()->identifier }}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Шар предсказаний</h1>
                    <form action="{{ route('auth.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-secondary">Выйти</button>
                    </form>
                </div>
                <div class="card-body">
                    @if(session('current_answer'))
                        <div class="alert alert-success" role="alert">
                            <div class="col-md-6">
                                <h3>Ответ: {{ session('current_answer') }}</h3>
                            </div>
                            <div class="col-md-6">
                                <h4>Ваш вопрос: ""{{ session('question_stats.text') }}"
                                    задавался {{ session('question_stats.asked_count') }} раз</h4>
                            </div>
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach($errors->all() as $error)
                                {{ $error }}<br/>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{ route('ask-question') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="code"
                                   class="col-md-4 col-form-label text-md-end"><h5>{{ auth()->user()->identifier }},
                                    задайте
                                    новый вопрос</h5></label>
                            <div class="col-md-6">
                            <textarea id="question" name="question" rows="3" class="form-control"
                                      placeholder="Задайте вопрос, на который можно ответить Да или Нет"></textarea>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Получить ответ
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if($questions->isNotEmpty())
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>История ваших вопросов</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped projects">
                            <thead>
                            <tr>
                                <th>Вопрос</th>
                                <th>Ответ</th>
                                <th>Когда</th>
                                <th>Задавался, раз</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($questions as $answer)
                                <tr>
                                    <td>{{ $answer->question->text }}</td>
                                    <td>{{ $answer->response }}</td>
                                    <td>{{ $answer->created_at->format('d.m.Y H:i') }}</td>
                                    <td>{{ $answer->question->asked_count }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $questions->withQueryString()->links() }}
            </div>
        </div>
    @endif
@endsection
