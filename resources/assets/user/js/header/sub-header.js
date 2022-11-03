var scriptFooterArr = [
    "/js/header/home.defer.js",
  ];
  var scriptFooterIS = function (scripts, itv) {
    if (window.lazyReady === true) {
      if (typeof itv !== "undefined") {
        clearInterval(itv);
      }
      for (var f = 0; f < scripts.length; f++) {
        addScripts(scripts[f], false);
      }
      return true;
    } else {
      return false;
    }
  };

$("ul.cat-menu").each(function () {
  var $ul = $(this),
    $lis = $ul.find("li:gt(2)"),
    isExpanded = $ul.hasClass("expanded");
  $lis[isExpanded ? "show" : "hide"]();

  if ($lis.length > 0) {
    $ul.append(
      $(
        '<li class="view-more"><a href="javascript:;">' +
          (isExpanded ? "Thu gọn" : "Xem thêm") +
          '</a></li>'
      ).click(function (event) {
        var isExpanded = $ul.hasClass("expanded");
        event.preventDefault();
        $(this).html(isExpanded ? '<a href="javascript:;">Xem thêm</a>' : '<a href="javascript:;">Thu gọn</a>');
        $ul.toggleClass("expanded");
        $lis.toggle();
      })
    );
  }
});

$(document).on('click', '.all-menu', function(e) {
    e.preventDefault();
    document.querySelector('.wrap-all-menu').style.visibility = 'visible';
    document.querySelector('.wrap-all-menu').style.opacity = 1;
});

$(document).on('click', '.close-menu', function(e) {
    e.preventDefault();
    document.querySelector('.wrap-all-menu').style.visibility = 'hidden';
    document.querySelector('.wrap-all-menu').style.opacity = 0;
});

$(document).on('click', '.search-icon-mobile', function(e) {
    e.preventDefault();
    document.querySelector('.search-mobile').style.display = 'block';
});

var media = window.matchMedia('(min-width: 576px)');

media.addEventListener('change', function () {
    if (media.matches) {
        document.querySelector('.search-mobile').style.display = 'none';
    } 
});

$(window).scroll(function () {
    var header = document.getElementById('wrap-main-nav');
    var sticky = header.offsetTop;

    if (window.pageYOffset > sticky) {
        header.classList.add('sticky');
    } else {
        header.classList.remove('sticky');
    }
});
