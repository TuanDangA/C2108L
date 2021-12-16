function init()
        {
            account_name = document.getElementById("account");
            password = document.getElementById("pass");
        }
function validate()
{
    if(account_name.value == "admin" && password.value == "123456")
    {
        alert("Logic success.Redirecting....");
        window.location.assign("nextpage.html");
    }
    else 
    {
        alert("Tên tài khoản hoặc mật khẩu sai. Vui lòng thử lại.");
    }
}