<form action="{{ route('sendmail') }}" method="post">
    @csrf
    Nội dung <input type="text" name="content" id=""><br>
    Email <input type="text" name="mail"><br>
    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
    <input type="submit" value="Lưu">
</form>