<section class="photo-wrapper">
    <div class="photo-list"></div>
    <div class="controls">
        <button class="btn btn-prev">Prev</button>
        <button class="btn btn-next">Next</button>
    </div>
</section>
<script>
    jQuery(document).ready(function ($) {
        function disActivePrevButton() {
            if(sessionStorage.getItem("page") == 1) {
                $(".btn-prev").attr("disabled", "disabled")
            } else {
                $(".btn-prev").attr("disabled")
            }
        }
        function printData(data) {
            disActivePrevButton()
            $(".photo-list").html("");
            data.forEach(post => {
                $(".photo-list").append(`
                    <div class="photo-item">
                        <div class="photo-img">
                            <img src="http://gallery.loc/uploads/${post.image}" alt="${post.alt_text}">
                            <div class="favorite-btn">
                                <img src="./images/favorite2.svg" alt="">
                            </div>
                        </div>
                        <div class="photo-title">
                            <p>${post.title}</p>
                        </div>
                        <div class="photo-author">
                            <p><span class="photo-author-by">By: </span> ${post.by}</p>
                        </div>
                    </div>
                `);
            })
        }
        disActivePrevButton()
       $.ajax({
           url:"http://gallery.loc/getPhotos",
           method:"get",
           dataType:"json",
           success:function (response) {
               printData(response.images);
               sessionStorage.setItem("page", response.current_page);
           }
       });

        $(".btn-next").on("click", function() {
            let page = +sessionStorage.getItem("page");
            page += 1;
            $.ajax({
                url:"http://gallery.loc/getPhotos",
                method:"get",
                data:{page},
                dataType:"json",
                success:function (response) {
                    printData(response.images);
                    sessionStorage.setItem("page", response.current_page);
                }
            });
        });
    });
</script>