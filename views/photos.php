<?php include "./../views/layouts/_head.php" ?>
<div class="popup" id="popup">
    <div class="overlay"></div>
    <div class="popup-content">
        <h2>Create A Post</h2>
        <form id="imageForm" enctype="multipart/form-data">
            <div class="form-group">
                <input class="form-input" type="text" name="title" placeholder="Title">
            </div>

            <div class="form-group">
                <input class="form-input" type="text" name="alt_text" placeholder="Alt Text">
            </div>

            <div class="form-group">
                <input class="form-input" type="file" name="image">
            </div>
            <div class="controls">
                <button class="btn close-btn">Close</button>
                <button class="btn submit-btn">Submit</button>
            </div>
        </form>

    </div>
</div>
<main class="photos-main">
    <section class="wrapper">
        <button class="btn open-popup" id="open-popup">Create New Post</button>
        <?php require "./../views/layouts/_photo_content.php"; ?>
    </section>
</main>
<script>
    jQuery(document).ready(function($) {
        //popup
        function makePopup(id) {
            const node = $(`#${id}`);
            const overlay = $(".overlay");
            function hidePopup() {
                $(node).removeClass('active');
            }
            $(document).on("click", ".close-btn", hidePopup);
            $(overlay).on("click", hidePopup);

            return function () {
                $(node).addClass('active');
            }
        }

        const popup = makePopup("popup");
        $("#open-popup").on("click", popup)
    });

    $("#imageForm").on("submit", function(event) {
        event.preventDefault();
        $.ajax({
            method:"post",
            url:"http://gallery.loc/photos/store",
            data: new FormData(this),
            dataType:"json",
            contentType:false,
            cache:false,
            processData: false,
            beforeSend:function () {

            },
            success: function(response) {
                $(".popup-content").prepend(`<div class='msg msg-${response.success ? 'success' : 'fail'}'><p>${response.msg}</p></div>`);
                setTimeout(function() {
                    $(".popup-content .msg").remove();
                }, 3000)
                console.log(response);
            }
        })
    })
</script>
<?php include "./../views/layouts/_footer.php" ?>
