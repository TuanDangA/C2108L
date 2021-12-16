function init()
{
    accountTag = document.getElementById("account_id");
    passwordTag = document.getElementById("password_id");
}
function validate()
{
    if(accountTag.value=="admin" && passwordTag.value=="123456")
    {
        alert("Login successful. Redirecting...");
        window.location.assign("nextpage2.html");
    }
    else
    {   
        alert('Tên tài khoản hoặc mật khẩu không đúng. Xin vui lòng thử lại.')
    }
}