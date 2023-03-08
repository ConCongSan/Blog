<form action="{{ route('update.post',['id' => $tag->id]) }}" method="post" enctype="multipart/form-data" id="Form-Create-Post"
      name="Form-Create-Post">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label>Tiêu đề </label>
            <input type="text" class="form-control" name="title" id="title">
        </div>
        <div class="form-group">
            <label for="my-textarea">Nội dung</label>
            <textarea class="form-control test" name="content" id="content" rows="4"></textarea>
        </div>
        <select class="form-control form-control-sm" name="tag_id">
            @foreach($tag as $listtag2)
                <option value="{{ $listtag2->id }}">{{ $listtag2->name }}</option>
            @endforeach
        </select>

        <p></p>
        <input type="hidden" name="username" value="{{Auth::user()->username}}">
        <div class="form-group">
            <label>Ảnh</label>
            <input type="file" class="form-control" name="image" id="image">
        </div>
    </div>
    <div class="modal-footer border-top-0 d-flex justify-content-center">
        <button type="submit" class="btn btn-success">Thêm bài viết</button>
    </div>
</form>