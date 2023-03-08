<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Title</title>
</head>
<style>
    textarea.form-control {
        width: 30%
    }
</style>
<label>{{ Auth::user()->username }}</label><br>
<a href="{{ route('mail') }}"> Gửi Email</a><br>
<a href="{{ route('edit.password') }}"> Đổi mật khẩu</a><br>
<a href="{{ route('logout') }}">Đăng xuất</a>
<body>

{{--Tag--}}
<form action="{{ route("create_tag") }}" method="post">
    Thẻ : <input name="name">
    <button type="submit"> Tạo</button>
</form>
<table class="table table-hover" id="tag">
    <thead>
    <tr>
        <th scope="col">Thẻ</th>
    </tr>
    </thead>

    <tbody id="list-tag">
    @foreach($tag as $listtag)
        <tr>
            <th>{{$listtag->name}}</th>
            <th>
                <button><a href="{{ route('delete.tag',['id' => $listtag->id]) }}">Xoá</a></button>
            </th>
        </tr>
    @endforeach
    </tbody>
</table>

{{--Upload File --}}
<form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" id="">
    <button type="submit">Lưu</button>
</form>

{{--Bai dang--}}
<form action="{{ route('create_store') }}" method="post" enctype="multipart/form-data" id="Form-Create-Post"
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
                <button><a href="{{ route('delete.post',['id' =>$listpost->id ]) }}">Xoá</a></button>
            </th>
        </tr>
    @endforeach

    </tbody>
</table>
{{--Mail--}}
<h6 class="mb-4">Danh sách mail</h6>
<table class="table table-hover" id="post">
    <thead>
    <tr>
        <th scope="col">Người gửi</th>
        <th scope="col">Nội dung</th>
        <th scope="col">Mail</th>
        <th scope="col">Chức năng</th>
    </tr>
    </thead>
    <tbody>
    @foreach($mail as $listmail)
        <tr>
{{--            @dd($listmail->getMailNameAttribute());--}}
            <th>{{$listmail->getMailNameAttribute()}}</th>
            <th>{{$listmail->content}}</th>
            <th>{{$listmail->mail}}</th>
            <th>
                <button><a href="/admin/edit-post/{{ $listmail->id }}">Sửa</a></button>
                <button><a href="{{ route('delete.post',['id' =>$listmail->id ]) }}">Xoá</a></button>
            </th>
        </tr>
    @endforeach

    </tbody>
</table>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>
<script>
    $(document).ready(() => {
        // var $tableTag = $("#tag");
        var $tablePost = $("#post")
        // $('#delete').click(()=>{
        //    console.log('hello');
        // });
        //
        $tablePost.on('click', '#delete', () => {
            let $id = $("#delete").val();
            console.log('hello')
            console.log($id)
            // var obj = $(this);
            $.ajax({
                url: "https://blog/api/admin/delete-post/" + $id,
                type: "POST",
                data: $id,
                success: function (res) {
                    console.log('hi')
                    $("#delete").closest("tr").remove();
                }
            })
        })

        // $('#delete').on('click',() => {
        //     var $id = $("#delete").val();
        //     console.log('hello')
        //     // var obj = $(this);
        //     $.ajax({
        //         url: "https://blog/api/admin/delete-post/" + $id,
        //         type: "POST",
        //         data: $id,
        //         success: function (res) {
        //             $("#delete").closest("tr").remove();
        //         }
        //     })
        // })

        // $table.on('click', '#delete', () => {
        //     var $id = $(this).data("id");
        //     var obj = $(this);
        //     $.ajax({
        //         url: "https://blog/api/admin/delete-post/" + $id,
        //         type: "POST",
        //         data: $id,
        //         success: function (res) {
        //             obj.parents("tr").remove();
        //         }
        //     })
        // })
        // load_data();


        // $('#Form-Create-Post').submit((e) => {
        //     e.preventDefault();
        //     let formData = $("#Form-Create-Post").serialize()
        //     $.post('https://blog/api/admin/create-post', formData, function (res) {
        //         console.log(formData)
        //         load_data();
        //     })
        // })


        {{--function load_data() {--}}
        {{--    --}}{{--$.get('https://blog/api/admin/get-post', (res) => {--}}
        {{--    --}}{{--    if (res.data != '') {--}}
        {{--    --}}{{--        let category = res.data;--}}
        {{--    --}}{{--        let _li = '';--}}
        {{--    --}}{{--        category.forEach(function (item) {--}}
        {{--    --}}{{--            _li += '<tr>';--}}
        {{--    --}}{{--            _li += '<th scope="row" >' + item.title + '</th>';--}}
        {{--    --}}{{--            _li += '<th scope="row">' + item.content + '</th>';--}}
        {{--    --}}{{--            _li +=--}}
        {{--    --}}{{--                '<th scope="col"> <img width="50%" height="60px" src = "{{ url('anh/')}}/' + item.image + '"> </th>';--}}
        {{--    --}}{{--            _li += '<th> <button id="edit" data-id=" ' + item.id + ' "> Sửa </button>';--}}
        {{--    --}}{{--            _li += '<button id="delete" data-id=" ' + item.id + ' " > Xoá </button> </th>';--}}
        {{--    --}}{{--            _li += '</tr>';--}}
        {{--    --}}{{--        });--}}
        {{--    --}}{{--        $('#list-post').html(_li);--}}
        {{--    --}}{{--    }--}}
        {{--    --}}{{--});--}}
        {{--}--}}

        // $table.on('click', '#edit', () => {
        //     var $id = $(this).data("id");
        //     $.ajax({
        //         url: "https://blog/api/admin/edit-post/" + $id,
        //         type: "POST",
        //         data: $id,
        //         success: function (res) {
        //
        //         }
        //     })
        // })
    });
</script>
