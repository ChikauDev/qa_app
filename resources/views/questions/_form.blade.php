@csrf
<div class="form-group">
    <label for="question-title">Question Title</label>
    <input type="text" name="title" value="{{ old('title', $question->title) }}" id="question-title" class="form-control {{ $errors->has('title') ? 'is-invalid' : ''}}">

    @if($errors->has('title'))
        <div class="invalid-feedback">
            <div>{{ $errors->first('title') }}</div>
        </div>
    @endif
</div>
<div class="form-group">
    <label for="question-body">Explain your question</label>
    <textarea type="text" name="body" id="question-body" class="form-control {{ $errors->has('body') ? 'is-invalid' : ''}}" rows="10">{{ old('body', $question->body) }}</textarea>
    @if($errors->has('body'))
    <div class="invalid-feedback">
        <div>{{ $errors->first('body') }}</div>
    </div>
@endif
</div>
<div class="form-group">
    <button type="submit" class="btn btn-outline-primary btn-lg">{{ $buttonText }}</button>
</div>