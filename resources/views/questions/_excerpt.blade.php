<div class="media post">
    <div class="d-flex flex-column counters">
        <div class="vote">
            <div>
                <span class="subtext">
                    {{ $question->votes_count }}
                </span>
                {{ Str::plural('vote', $question->votes_count) }}
            </div>
        </div>
        <div class="status {{ $question->status }}">
            <div>
                <span class="subtext">
                    {{ $question->answers_count }}
                </span>
                {{ Str::plural('answer', $question->answers_count) }}
            </div>
        </div>
        <div class="views">
            <div>
                {{ $question->views . " " .Str::plural('view',      $question->views) }}
            </div>
        </div>
    </div>
    <div class="media-body">
        <div class="d-flex align-items-center">
            <h3 class="mt-0">
                <a href="{{ $question->url }}">
                </a>
            </h3>
            <div class="ml-auto">
                @can ('update', $question)
                    <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-sm btn-outline-info">
                        Edit
                    </a>   
                @endcan
                @can ('delete', $question)
                    <form method='post' class="form-delete" action="{{ route('questions.destroy', $question->id) }}">
                        @method('DELETE')
                        @csrf                         
                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure ?')">
                            Delete
                        </button>        
                    </form>
                @endcan
            </div>
        </div>
        <h3 class="mt-0">
            <a href="{{ $question->url }}">{{ $question->title }}</a>
            <p class="lead">
                Asked by <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                <small class="text-muted">{{ $question->created_date }}</small>
            </p>
        </h3>
        <div class="excerpt">
            {{ $question->excerpt(250) }}
        </div>
    </div>
</div>