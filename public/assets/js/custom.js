
  (function ($) {

  "use strict";

    // MENU
    $('#sidebarMenu .nav-link').on('click',function(){
      $("#sidebarMenu").collapse('hide');
    });

    // CUSTOM LINK
    $('.smoothscroll').click(function(){
      var el = $(this).attr('href');
      var elWrapped = $(el);
      var header_height = $('.navbar').height();

      scrollToDiv(elWrapped,header_height);
      return false;

      function scrollToDiv(element,navheight){
        var offset = element.offset();
        var offsetTop = offset.top;
        var totalScroll = offsetTop-navheight;

        $('body,html').animate({
        scrollTop: totalScroll
        }, 300);
      }
    });

  })(window.jQuery);

  document.addEventListener('DOMContentLoaded', () => {
      const scrollElements = document.querySelectorAll('.js-scroll');

      const elementInView = (el) => {
          const rect = el.getBoundingClientRect();
          return (
              rect.top <= (window.innerHeight || document.documentElement.clientHeight) * 0.75
          );
      };

      const displayScrollElement = (element) => {
          element.classList.add('visible');
      };

      const handleScrollAnimation = () => {
          scrollElements.forEach((el) => {
              if (elementInView(el)) {
                  displayScrollElement(el);
              }
          });
      };

      window.addEventListener('scroll', () => {
          handleScrollAnimation();
      });

      // Инициализация при загрузке
      handleScrollAnimation();
  });
