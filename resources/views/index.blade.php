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
<body>

<form enctype="multipart/form-data" id="Form-Create-Post" name="Form-Create-Post">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label>Tiêu đề</label>
            <input type="text" class="form-control" name="title" id="title">
        </div>
        <div class="form-group">
            <label>Nội dung</label>
            <input type="text" class="form-control" name="content" id="content">
        </div>
        <select class="form-control form-control-sm">
            <option>Thẻ</option>
        </select>
        <p></p>
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
<table class="table table-hover" id="tbl-services">
    <thead>
    <tr>
        <th scope="col">Tiêu đề</th>
        <th scope="col">Nội dung</th>
        <th scope="col">Ảnh</th>
        <th scope="col">Chức năng</th>
    </tr>
    </thead>
    <tbody id="list-post">
    </tbody>
</table>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
        type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>
<script>
    $(document).ready(function () {

        var $table = $("#tbl-services");
        load_data();

        // $formAdd.validate({
        //     rules: {
        //         title: {
        //             required: true
        //         }
        //     },
        //     messages: {
        //         title: "Nhập tiêu đề"
        //     },
        //     errorElement: "p",
        //     errorPlacement: function (error, element) {
        //         var placement = $(element).data("error");
        //         if (placement) {
        //             $(placement).append(error);
        //         } else {
        //             error.insertAfter(element);
        //         }
        //     },
        // });


        $('#Form-Create-Post').on('submit', function (e) {
            e.preventDefault();
            let formData = $("#Form-Create-Post").serialize()
            $.post('https://blog/api/admin/create-post', formData, function (res) {
                console.log(formData)
                load_data();
            })
        })


        function load_data() {
            $.get('https://blog/api/admin/get-post', function (res) {
                if (res.data != '') {
                    let category = res.data;
                    let _li = '';
                    category.forEach(function (item) {
                        _li += '<tr>';
                        _li += '<th scope="row" >' + item.title + '</th>';
                        _li += '<th scope="row">' + item.content + '</th>';
                        _li +=
                            '<th scope="col"> <img width="50%" height="60px" src = "{{ url('anh/')}}/' + item.image + '"> </th>';
                        _li += '<th> <button id="edit" data-id=" ' + item.id + ' "> Sửa </button>';
                        _li += '<button id="delete" data-id=" ' + item.id + ' " > Xoá </button> </th>';
                        _li += '</tr>';
                    });
                    $('#list-post').html(_li);
                }
            });
        }


        $table.on('click', '#delete', function () {
            var $id = $(this).data("id");
            var obj = $(this);
            $.ajax({
                url: "https://blog/api/admin/delete-post/" + $id,
                type: "POST",
                data: $id,
                success: function (res) {
                    obj.parents("tr").remove();
                }
            })
        })

        $table.on('click', '#edit', function () {
            var $id = $(this).data("id");
            $.ajax({
                url: "https://blog/api/admin/edit-post/" + $id,
                type: "POST",
                data: $id,
                success: function (res) {

                }
            })
        })
    });
</script>
