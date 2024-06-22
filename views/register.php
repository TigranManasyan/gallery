<?php  require "./../views/layouts/_head.php"; ?>

<h2>
    <?php
    if(isset($data['msg'])) {
        echo $data['msg'];
    }
    ?>
</h2>
<div class="register-wrapper">
    <div class="register-form">
        <h1 class="form-header">Sign Up Form</h1>
        <form action="http://gallery.loc/register/post" method="post">
            <div class="form-group">
                <input class="form-input" type="text" name="name" placeholder="John Smith">
            </div>
            <div class="form-group">
                <input class="form-input" type="email" name="email" placeholder="example@mail.ru">
            </div>
            <div class="form-group">
                <input class="form-input" type="password" name="password" placeholder="****">
            </div>
            <button class="btn register-btn">Sign Up</button>
        </form>
        <p class="form-footer"><a href="http://gallery.loc/">Account Exists?</a></p>
    </div>
</div>
<?php  require  "./../views/layouts/_footer.php"; ?>

