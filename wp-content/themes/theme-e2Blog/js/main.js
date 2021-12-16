(function ($) {
  // open document ready

  $(document).ready(function () {
    // slider primary
    $("#slider-primary").slick({
      dots: true,
      infinite: true,
      speed: 1000,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      fade: true,
      autoplaySpeed: 3000,
    });

    // input search
    $(document).on("click", ".search-icon", function () {
      $(this).parent().find(".input-search").toggleClass("open");
    });

    // nav
    $(document).on("click", ".bar-icon", function (e) {
      e.stopPropagation();
      $(".m-navbar").removeClass("close");
      $(".m-navbar").addClass("open");
      $(this).css({
        opacity: "0",
        visibility: "hidden",
      });
    });

    $(document).on("click", ".icon-nav-close", function () {
      $(".m-navbar").removeClass("open");
      $(".m-navbar").addClass("close");
      $(".bar-icon").css({
        opacity: "1",
        visibility: "visible",
      });
    });

    $(window).on("click", function (e) {
      e.stopPropagation();
      if (
        !$(e.target).closest(".m-navbar").length &&
        !$(e.target).closest(".hd-right-group .bar-icon").length
      ) {
        $(".m-navbar").removeClass("open");
        $(".m-navbar").addClass("close");
        $(".bar-icon").css({
          opacity: "1",
          visibility: "visible",
        });
      }
    });

    // tabs single
    // var tabsListContent = document.querySelectorAll('.tabs-ct');
    // listNameTabs = document.querySelectorAll('.tabs-name');

    // listNameTabs.forEach(itemName => {
    //     itemName.addEventListener('click', function (e) {
    //         tabsListContent.forEach(itemContent => {
    //             itemContent.style.display = "none";
    //         });

    //         listNameTabs.forEach(element => {
    //             element.classList.remove('active');
    //         });

    //         this.classList.add('active');
    //         let idTabContent = this.dataset.tab;
    //         document.getElementById(idTabContent).style.display = "block";
    //     })
    // });
    $('.single-tabs .tabs-name a[href*="#"]').on("click", function (e) {
      $(".single-tabs .tabs-name").removeClass("active");
      $(this).parent().addClass("active");
      $("html,body").animate(
        {
          scrollTop: $($(this).attr("href")).offset().top - 70,
        },
        700
      );
      e.preventDefault();
    });

    // backtotop
    const backtotop = $("#backtotop-btn");

    $(window).on("scroll", function () {
      if ($(window).scrollTop() > 1000) {
        backtotop.addClass("show");
      } else {
        backtotop.removeClass("show");
      }
    });
    backtotop.on("click", function (e) {
      e.preventDefault();
      $("html, body").animate(
        {
          scrollTop: 0,
        },
        1500
      );
    });

    // sticky menu

    $(window).on("load resize", function (e) {
      // drop sub menu
      // e.stopPropagation();
      $(document).on("click", ".topMenu .menu-item-has-children", function () {
        $(this).toggleClass("menu-drop");
      });

      if ($(window).width() > 991) {
        $(window).on("scroll", function () {
          var windowTop = Math.floor($(window).scrollTop());
          var wrapheader = Math.floor($(".wrap-header").offset().top);

          if (windowTop > wrapheader) {

            $(".header .header-ctn").addClass("hidden");
            $(".ctn-topMenu").addClass("fixed");
            $(".ctn-topMenu .search .search-icon").hide();
            $(".ctn-topMenu .bar-icon").show();
            $(".navigation .search").show();
            $(".input-search").removeClass("open");
            $(".translate-language-topMenu").addClass("show");
          } else {

            setTimeout(function () {
              $(".header .header-ctn").removeClass("hidden");
              $(".ctn-topMenu").removeClass("fixed");
              $(".ctn-topMenu .search .search-icon").show();
              $(".ctn-topMenu .bar-icon").hide();
              $(".navigation .search").hide();
              $(".translate-language-topMenu").removeClass("show");
            }, 600);
          }
        });
      }
    });

    // preven copy cut in website
    $("body").bind("cut copy", function (e) {
      e.preventDefault();
    });

    // close document ready
  });
})(jQuery);

const animateFadeIn = document.querySelectorAll(".obj-animate");

observer = new IntersectionObserver(
  (entries) => {
    //IntersectionObserver quan sát đối tượng có nằm trong vùng nhìn hay ko
    entries.forEach((entry) => {
      if (entry.intersectionRatio > 0) {
        entry.target.classList.add("anm-fadeIn");
      }
    });
  },
  {
    rootMargin: "0px 0px -20% 0px",
  }
);

animateFadeIn.forEach((image) => {
  observer.observe(image);
});

//    <!-- TARGET LINK IN SINGLE  -->

var singlePageContent = document.querySelectorAll(".single .single-content a"),
  singlePageTabs = document.querySelectorAll(".single .sg-tabs-ct a");

function addTargetBlank(elementBlank) {
  elementBlank.forEach((element) => {
    element.setAttribute("target", "_blank");
  });
}

addTargetBlank(singlePageContent);
addTargetBlank(singlePageTabs);

// chuyển vietnamese thành "Tiếng việt"
var vnLanguage = document.querySelectorAll(
  ".translate-language .trp-language-switcher > div > a"
);
var menuLangue = document.querySelectorAll("li .trp-ls-language-name");

vietSub(vnLanguage);
vietSub(menuLangue);

function vietSub(languageName) {
  languageName.forEach((vietNam) => {
    var innerTextVn = vietNam.textContent.replace(/\s{2,}/g, " ").trim();
    if (innerTextVn == "Vietnamese") {
      vietNam.innerText = "Tiếng Việt";
    }
  });
}
