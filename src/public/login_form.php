<div class="wrapper">
    <form class="form-signin" action="/login" method="POST">
        <h2 class="form-signin-heading">Введите логин и пароль</h2>
        <?php if (isset($errors['username'])): ?>
            <label style="color: red"> <?php echo $errors['username'];?> </label>
        <?php endif; ?>
        <input type="text" class="form-control" name="username" placeholder="Email Address" required="" autofocus="" />
        <?php if (isset($errors['password'])): ?>
            <label style="color: red"> <?php echo $errors['password'];?> </label>
        <?php endif; ?>
        <input type="password" class="form-control" name="password" placeholder="Password" required=""/>
        <label class="checkbox">
            <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
    </form>
</div>


<style>
@import "bourbon";

body {
background: #eee !important;
}

.wrapper {
margin-top: 80px;
margin-bottom: 80px;
}

.form-signin {
max-width: 380px;
padding: 15px 35px 45px;
margin: 0 auto;
background-color: #fff;
border: 1px solid rgba(0,0,0,0.1);

.form-signin-heading,
.checkbox {
margin-bottom: 30px;
}

.checkbox {
font-weight: normal;
}

.form-control {
position: relative;
font-size: 16px;
height: auto;
padding: 10px;
@include box-sizing(border-box);

&:focus {
z-index: 2;
}
}

input[type="text"] {
margin-bottom: -1px;
border-bottom-left-radius: 0;
border-bottom-right-radius: 0;
}

input[type="password"] {
margin-bottom: 20px;
border-top-left-radius: 0;
border-top-right-radius: 0;
}
}
</style>
