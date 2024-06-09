<style>
.btn{
    padding: 10px; background-color: red; color: white; text-decoration: none;
    display: block;
    border-radius: 18px;
    font-weight: bold;
}
</style>
<h3>Xin chào, {{$user->username}}</h3>
<br>
<p>Bạn đã gửi yêu cầu đặt lại mật khẩu, vui lòng click vào nút bên dưới để đặt lại mật khẩu</p>
<br>
<a style="padding: 10px; background-color: red; color: white; text-decoration: none;
    display: inline-block;font-size: 15px;
    border: 1px solid gray;font-weight: bold;
    border-radius: 18px;" href="{{route('auth.reset.index', $verify->id)}}">
Reset Password
</a>
<br>
<p>Đường dẫn có hiệu lực trong 5 phút.</p>

