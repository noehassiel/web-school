/*----------------------------

    # M E S T (JS)

----------------------------*/


//SCROLL HEADER
$(function () {
    $(document).scroll(function () {
        var $nav = $("header");
        $nav.toggleClass('scroll', $(this).scrollTop() > $nav.height());

        console.log('scroll');
    });
});


//HEADER
(function () {
    if ($(window).scrollTop() > $("#nav-no").offset().top - 50) {
        $("header").addClass("alternative");
    } else {
        $("header").removeClass("alternative");
    }
});


//Sidebar
$("#menu-mobile").on("click", function () {
    toggleMenu();
});
  
$(".sidebar-overlay").on("click", function () {
    $("body").removeClass("toggled");
    $(".clonado").remove();
});

$(".sidebar-nav li").on("click", function () {
    $("body").removeClass("toggled");
    $(".clonado").remove();
});
  
$(".close-btn").on("click", function () {
    $("body").removeClass("toggled");
    $(".clonado").remove();
});
  
$(".close-sidebar").on("click", function () {
    $("body").removeClass("toggled");
    $(".clonado").remove();
});
  
function toggleMenu() {
    $("body").addClass("toggled");
}