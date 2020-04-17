$(function () {

    $('body').height(3000);

    /*$(window).scroll(function () {
     if ($(this).scrollTop() > 200) {
     $('.navbar')
     .removeClass('bg-success')
     .addClass('bg-primary');
     } else {
     $('.navbar')
     .removeClass('bg-primary')
     .addClass('bg-success');
     }
     
     });*/


    $('.navbar a').click(function (e) {
        e.preventDefault();
        var id = $(this).attr('href'),
                targetOffset = $(id).offset().top,
                menuHeight = $('.navbar').innerHeight();
        
        $('html, body').animate({
            scrollTop: targetOffset - menuHeight}, 500);
    });
    
    debounce = function(func, wait, immediate){
        var timeout;
        return function(){
            var context = this, args = arguments;
            var later = function(){
                timeout = null;
                if(!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if(callNow)  func.apply(context, args);
        };
    };
    
    (function () {
        var $target = $('.anime'),
            animationClass = 'anime-start',
            offset = $(window).height() * 2 / 4,
            menuHeight = $('.navbar').innerHeight();

        function animeScroll() {

            var documentTop = $(window).scrollTop();

            $target.each(function () {
                var itemTop = $(this).offset().top;               
                
                if (documentTop > itemTop - offset - menuHeight) {
                    $(this).addClass(animationClass);
                } else {
                    $(this).removeClass(animationClass);
                }
            });
        }

        animeScroll();

        $(document).scroll(function(){
            animeScroll();            
        });
    }());



});

 