<div class="form-group row">
    <label for="title">タイトル</label>
    <div class="col-sm-10">
        <input type="text" name="title" class="form-control" value="{{ old('title') }}">
    </div>
</div>

<div class="from-group row mt-3">
    <label for="file_name">画像ファイル</label>
    <div class="col-sm-10">
        <input type="file" name="file_name" class="form-control" accept="image/png, image/jpeg">
    </div>
</div>

@for ($i = 1; $i < 6; $i++)
<div class="form-group row mt-3">
    <label for="point{{ $i }}">ポイント{{ $i }}</label>
    <div class="col-sm-10">
        <textarea name="point{{ $i }}" class="form-control">{{ old('point$i') }}</textarea>
    </div>
</div>
@endfor

<div class="form-group row mt-3">
    <label for="thoughts">感想</label>
    <div class="col-sm-10">
        <textarea name="thoughts" class="form-control">{{ old('thoughts') }}</textarea>
    </div>
</div>

<div class="form-group row mt-3">
    <div class="col-sm-10">
        <button type="submit" class="btn btn-primary">投稿する</button>
        {{ link_to_route('posts.index', '一覧に戻る', null, ['class' => 'btn btn-secondary']) }}
    </div>
</div>
