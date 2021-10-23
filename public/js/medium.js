// Set up the toggle effect:
$(".read-more-show").on("click", function(e) {
    $(this).prevAll().addClass('hide-content');
    $(this).next('.read-more-content').removeClass('hide-content');
    $(this).next('.read-more-content').next('.read-more-hide').removeClass('hide-content');
    $(this).addClass('hide-content');
    e.preventDefault();
});

// Changes contributed by @diego-rzg
$(".read-more-hide").on("click", function(e) {
    $(this).prevAll().removeClass('hide-content');
    $(this).prev('.read-more-content').addClass('hide-content');
    $(this).addClass('hide-content');
    e.preventDefault();
});

$(".back-page").on("click",function(e){
    window.history.back();
});