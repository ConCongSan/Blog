<h6 class="mb-4">Bài đăng</h6>
<table class="table table-hover" id="post">
    <thead>
    <tr>
        <th scope="col">Tiêu đề</th>
        <th scope="col">Nội dung</th>
        <th scope="col">Ảnh</th>
        <th scope="col">Chức năng</th>
    </tr>
    </thead>
    <tbody>
    @foreach($all as $listpost)
        <tr>
            <th>{{$listpost->title}}</th>
            <th>{{$listpost->content}}</th>
            <th scope="col"><img width="50%" height="60px" src="{{ url('anh/')}}/{{$listpost->image}}"></th>
            <th>
                <button><a href="/admin/edit-post/{{ $listpost->id }}">Sửa</a></button>
                <button id="delete" value="{{ $listpost->id }}">Xoá</button>
            </th>
        </tr>
    @endforeach

    </tbody>
</table>
