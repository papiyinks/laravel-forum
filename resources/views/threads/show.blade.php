@extends('layouts.app')

@section('header')
    <link href="{{ asset('css/vendor/tribute.css') }}" rel="stylesheet">
@endsection

@section('content')
<thread-view inline-template :initial-replies-count="{{ $thread->replies_count }}">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="level">
                            <img src="{{ $thread->creator->avatar_path }}" alt="{{ $thread->creator->name }}" width="25" height="25" class="mr-3">

                            <span class="flex">
                                <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name}}</a> posted:
                                {{ $thread->title }}
                            </span>

                            @can('update', $thread)
                                <form action="{{ $thread->path() }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" class="btn btn-link">Delete Thread</button>
                                </form>
                            @endcan
                        </div>
                    </div>

                    <div class="card-body">
                        {{ $thread->body }}
                    </div>
                </div>

                <replies @removed="repliesCount--" @added="repliesCount++"></replies>

            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <p>
                            This thread was published {{ $thread->created_at->diffForHumans() }} by
                            <a href="#">{{ $thread->creator->name }}</a>, and currently
                            has <span v-text="repliesCount"></span> {{ Str::plural('comment', $thread->replies_count) }}.
                        </p>

                        <p>
                            <subscribe-button :active="{{ json_encode($thread->isSubscribedTo) }}"></subscribe-button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</thread-view>
@endsection
