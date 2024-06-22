<?php  require "./../views/layouts/_head.php"; ?>

<h2>
    <?php
        if(isset($data['msg'])) {
            echo $data['msg'];
        }
        ?>
</h2>
<div class="login-wrapper">
    <div class="login-form">
        <h1 class="form-header">Sign In Form</h1>
        <form action="http://gallery.loc/login/post" method="post">

            <div class="form-group">
                <input class="form-input" type="email" name="email" placeholder="example@mail.ru">
            </div>
            <div class="form-group">
                <input class="form-input" type="password" name="password" placeholder="****">
            </div>
            <button class="btn login-btn">Sign In</button>
        </form>
        <p class="form-footer"><a href="http://gallery.loc/register">Create Account</a></p>
    </div>
</div>
<?php  require  "./../views/layouts/_footer.php"; ?>

