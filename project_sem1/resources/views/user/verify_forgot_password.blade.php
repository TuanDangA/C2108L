<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Verify Account To Reset Password</h2>

        <div>
            Please follow the link below to reset your password
            <br/>
            <a href="{{ URL::to('forgot-password/verify/' . $confirmation_code) }}"><button>Click here to reset your password</button></a>.
        </div>

    </body>
</html>