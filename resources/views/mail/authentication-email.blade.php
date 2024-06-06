<style>
.btn{
    padding: 10px; background-color: red; color: white; text-decoration: none;
    display: block;
    border-radius: 18px;
}
</style>
<h3>Xin chào, {{$user->username}}</h3>
<br>
<p>Bạn đã gửi yêu cầu đặt lại mật khẩu, vui lòng click vào nút bên dưới để đặt lại!</p>
<br>
<a style="" href="{{route('auth.reset.index', $verify->id)}}">
Reset Password
</a>
<br>
<p>Xin cảm ơn</p>

