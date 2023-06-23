$(document).ready(function(){
	ww = $(window).width();
	$('.drop__phone').click(function(){
		if($(this).siblings('.phone__list').is(':hidden')){
			$(this).siblings('.phone__list').fadeIn(300);
		}else{
			$(this).siblings('.phone__list').fadeOut(300);
		}
	});	
  $('.phone__list__close').click(function(){
    $(this).parent().css('display', 'none');
  });	
  $('.header__bottom__link-drop').click(function(){
    if($(this).siblings('.header__bottom__drop__menu').is(':hidden')){
      $(this).siblings('.header__bottom__drop__menu').fadeIn(300);
      $(this).addClass('drop');
    }else{
      $(this).siblings('.header__bottom__drop__menu').fadeOut(300);
      $(this).removeClass('drop');
    }
  });
   $('.header__phone__work-mobile').click(function(){
    if($(this).siblings('.header__address__work').is(':hidden')){
      $(this).siblings('.header__address__work').fadeIn(300);
    }else{
      $(this).siblings('.header__address__work').fadeOut(300);
    }
  });
    $('.main__cruise__drop').click(function(e){
      var div = $(".main__cruise__drop__wrap");
    if($(this).children('.main__cruise__drop__wrap').is(':hidden')){
      $(this).children('.main__cruise__drop__wrap').fadeIn(300);
      $(this).addClass('select');
    }else if((!div.is(e.target)&& div.has(e.target).length === 0)){
      $(this).children('.main__cruise__drop__wrap').fadeOut(300);
      $(this).removeClass('select');
    }
  });
    $(document).click(function(e){
       var div = $(".main__cruise__drop");
       if (!div.is(e.target) && div.has(e.target).length === 0) { 
            $('.main__cruise__drop__wrap').fadeOut(300);
        }
    });
     //Выбор чекбосов в выпадающем списке
    $('.main__cruise__drop__title__close').click(function(){
      $(this).parent().fadeOut(300);
      $(this).parent().parent().removeClass('select');
    });

    $('.main__cruise__drop__title__change').click(function(){
      $(this).parent().fadeOut(300);
      $(this).parent().parent().removeClass('select');
    });

     var call = function(){
       var count = 0;
       $('.main__cruise__drop').each(function(){
      $(this).find('.checkbox').click(function(){
        if($(this).prop('checked')){
          count++;
        }else{
          count--;
        }
        if(count == 0){
           $(this).closest('.main__cruise__drop').children('.main__cruise__drop__title').children('.main__cruise__drop__title__main').show();
            $(this).closest('.main__cruise__drop').children('.main__cruise__drop__title').children('.main__cruise__drop__title__1').css('opacity','0');
            $(this).closest('.main__cruise__drop').children('.main__cruise__drop__title').children('.main__cruise__drop__title__2').css('opacity','0')
          }else{
           $(this).closest('.main__cruise__drop').children('.main__cruise__drop__title').children('.main__cruise__drop__title__main').hide();
            $(this).closest('.main__cruise__drop').children('.main__cruise__drop__title').children('.main__cruise__drop__title__1').text('Выбрано').css('opacity','1');
            /*$(this).closest('.main__cruise__drop').children('.main__cruise__drop__title').children('.main__cruise__drop__title__2').text().css('opacity','1'); */ 
        }
      });
    });
    }
    call();

        //конец

      $('.footer__drop').click(function(){
    if($(this).parent().siblings('.footer__address__work').is(':hidden')){
      $(this).parent().siblings('.footer__address__work').fadeIn(300);
    }else{
      $(this).parent().siblings('.footer__address__work').fadeOut(300);
    }
  });   

    $('.company__slide--port__right__more').click(function(){
    if($(this).siblings('.company__slide--port__right__wrap').is(':hidden')){
      $(this).siblings('.company__slide--port__right__wrap').fadeIn(300);
      $(this).addClass('active');
    }else{
      $(this).siblings('.company__slide--port__right__wrap').fadeOut(300);
      $(this).removeClass('active')
    }
  }); 

$('a.card__right__tur__item').click(function(e) {
  event.preventDefault();
  $('.tabs__item').removeClass('first');
  $('#tab6').addClass('first');
  $('.tabs__content__item').removeClass('first');
  $('#tabtext6').addClass('first');
});


  //всплывашки поиск

    $('.form__result__item__bottom__list').hover(function() 
     {
        $(this).children(".form__result__item__bottom__popup").finish().fadeIn(400);
      },
        function (){
        $(this).children(".form__result__item__bottom__popup").fadeOut(400);
      }
      );


	$('.banner__wrap').slick({
  	infinite: true,
  	speed: 350,
  	slidesToShow: 1,
  	slidesToScroll: 1,
    arrows:false,
    autoplay:true,
    autoplaySpeed:5000,
    dots:true,
      responsive: [
    {
      breakpoint: 991,
      settings: {
      dots:false
      }
    },
    ]
  });

if(ww > 767){
	$('.otziv__main__slide').slick({
  	infinite: false,
  	speed: 350,
  	slidesToShow: 1,
  	slidesToScroll: 1,
  	arrows:true,
  	responsive: [
    {
      breakpoint: 991,
//сообщает, при какой ширине экрана нужно включать настройки
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        autoplay:true
      }
    },
     {
      breakpoint: 767,
//сообщает, при какой ширине экрана нужно включать настройки
      settings: {
      	arrows:false,
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        autoplay:true,
      }
    }
    ]
    
  });
}

$('.kruiz__news__list').slick({
    infinite: false,
    speed: 350,
    slidesToShow: 2,
    slidesToScroll: 1,
    responsive: [
    {
      breakpoint: 992,
//сообщает, при какой ширине экрана нужно включать настройки
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
      }
    },
     {
      breakpoint: 768,
//сообщает, при какой ширине экрана нужно включать настройки
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: false,
        autoplay:false,
        arrows:false
      }
    },
    ]
    
  });


  //слайдер на страницах

 
    $('.page__slider__for').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  fade: true,
  asNavFor: '.page__slider__nav',
  arrows:false
});
$('.page__slider__nav').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  arrows:true,
  asNavFor: '.page__slider__for',
  focusOnSelect: true,
    responsive: [
    {
      breakpoint: 767,
//сообщает, при какой ширине экрана нужно включать настройки
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        arrows:false
      }
    },
    {
      breakpoint: 580,
//сообщает, при какой ширине экрана нужно включать настройки
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,
        arrows:false
      }
    },
      {
      breakpoint: 420,
//сообщает, при какой ширине экрана нужно включать настройки
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,
        arrows:false
      }
    },
    ]
});



function Slider($item, $slide){
   $($item).slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  fade: true,
  asNavFor: $slide,
  arrows:false,
  autoplay:true,
});
$($slide).slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  arrows:true,
  asNavFor: $item,
  focusOnSelect: true,
    responsive: [
    {
      breakpoint: 767,
//сообщает, при какой ширине экрана нужно включать настройки
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        arrows:false
      }
    },
    {
      breakpoint: 580,
//сообщает, при какой ширине экрана нужно включать настройки
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        arrows:false
      }
    },
      {
      breakpoint: 420,
//сообщает, при какой ширине экрана нужно включать настройки
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,
        arrows:false
      }
    },
    ]
});
}
$('.cart__slider__top').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  fade: true,
  asNavFor: '.cart__slider__bottom',
  arrows:false,
  autoplay:true
});
      $('.cart__slider__bottom').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  arrows:true,
  asNavFor: '.cart__slider__top',
  focusOnSelect: true,
    responsive: [
    {
      breakpoint: 767,
//сообщает, при какой ширине экрана нужно включать настройки
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        arrows:false
      }
    },
    {
      breakpoint: 580,
//сообщает, при какой ширине экрана нужно включать настройки
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        arrows:false
      }
    },
    ]
});


Slider('.cart__slider__top--ship', '.cart__slider__bottom--ship');
Slider('.port__slider__top', '.port__slider__bottom');

 $('.tabs__item:nth-child(8)').on('click', function(){
    $('.port__slider__top').slick("setPosition");
     $('.port__slider__bottom').slick("setPosition");
 });


     $('.header__top__burger').click(function(){
      $('.mobile__menu').animate({'left':'0'},800);
      $('.overlay').css('display','block');
    });
    $('.mobile__menu__close').click(function(){
      $('.mobile__menu').animate({'left':'-350px'},800);
        $('.overlay').css('display','none');
    });
     $('.overlay').click(function(){
      $('.mobile__menu').animate({'left':'-350px'},800);
      $(this).css('display','none');
     });

    $('.form__result__button--mobile').click(function(){
      $('.sidebar').fadeIn(100).animate({'right':'0'},800);
      $('.overlay').css('display','block');
    });
    $('.sidebar__close').click(function(){
      $('.sidebar').animate({'right':'-450px'},800).fadeOut(100);;
        $('.overlay').css('display','none');
    });
     $('.overlay').click(function(){
      $('.mobile__menu').animate({'left':'-350px'},800);
      $(this).css('display','none');
     });

    $(function() {
  	$('.tabs__wrap').find('.tabs__item:first-child').addClass('first');
	$('.tabs__content__item:first-child').addClass('first');	 		
  	$('.tabs__wrap').on('click', '.tabs__item:not(.first)', function() {
    $(this).addClass('first').siblings().removeClass('first').closest('.tabs').find('.tabs__content__item').removeClass('first').eq($(this).index()).addClass('first');
    $('.otziv__main__slide').slick('setPosition');
       /*$('.cabina__wrap__right__slider').slick('setPosition');*/
  });
});

       $(function() {
    $('.tabs__wrap__form').find('.tabs__item__form:first-child').addClass('first');
  $('.tabs__content__item__form:first-child').addClass('first');      
    $('.tabs__wrap__form').on('click', '.tabs__item__form:not(.first)', function() {
    $(this).addClass('first').siblings().removeClass('first').closest('.tabs__form').find('.tabs__content__item__form').removeClass('first').eq($(this).index()).addClass('first');
  });
  });
 $( ".datepicker" ).datepicker();
 $('.datepicker').click(function() {
  if($('#ui-datepicker-div').is(':hidden')){
  $(this).siblings('svg').removeClass('active');
}else{
  $(this).siblings('svg').addClass('active');
}
 });
  $(document).click(function(e) {
    var div = $('.book__input__date');
    if ( !div.is(e.target) // если клик был не по нашему блоку
            && div.has(e.target).length === 0){
      $(this).find('.datepicker').siblings('svg').removeClass('active');
    }
  });



//селект в ссылках

$(function() {
  $('.form__result__sort').click(function() {
     if($(this).children().children('.sorter').is(':hidden')){
      $(this).children().children('.sorter').slideDown(200);
     }else{
      $(this).children().children('.sorter').slideUp(200);
     }
  });
});


//начало фильтр ползунки
$("#slider").slider({
    range: true,
    min: 40000,
    max: 10000000,
    step: 1,
    values: [40000, 10000000],
    slide: function(event, ui) {
        for (var i = 0; i < ui.values.length; ++i) {
            $("input.sliderValue[data-index=" + i + "]").val(ui.values[i]);
        }
    }
});

$("input.sliderValue").change(function() {
    var $this = $(this);
    $("#slider").slider("values", $this.data("index"), $this.val());
});
$("#slider_1").slider({
    range: true,
    min: 10,
    max: 70,
    step: 1,
    values: [10, 70],
    slide: function(event, ui) {
        for (var i = 0; i < ui.values.length; ++i) {
            $("input.sliderValue_1[data-index=" + i + "]").val(ui.values[i]);
        }
    }
});

$("input.sliderValue_1").change(function() {
    var $this = $(this);
    $("#slider_1").slider("values", $this.data("index"), $this.val());
});
$("#slider_2").slider({
    range: true,
    min: -25,
    max: 25,
    step: 1,
    values: [-25, 25],
    slide: function(event, ui) {
        for (var i = 0; i < ui.values.length; ++i) {
            $("input.sliderValue_2[data-index=" + i + "]").val(ui.values[i]);
        }
    }
});

$("input.sliderValue_2").change(function() {
    var $this = $(this);
    $("#slider_2").slider("values", $this.data("index"), $this.val());
});
$("#slider_3").slider({
    range: true,
    min: 25000,
    max: 200000,
    step: 1,
    values: [25000, 200000],
    slide: function(event, ui) {
        for (var i = 0; i < ui.values.length; ++i) {
            $("input.sliderValue_3[data-index=" + i + "]").val(ui.values[i]);
        }
    }
});

$("input.sliderValue_3").change(function() {
    var $this = $(this);
    $("#slider_3").slider("values", $this.data("index"), $this.val());
});
$("#slider_4").slider({
    range: true,
    min: 100,
    max: 2000,
    step: 1,
    values: [100, 2000],
    slide: function(event, ui) {
        for (var i = 0; i < ui.values.length; ++i) {
            $("input.sliderValue_4[data-index=" + i + "]").val(ui.values[i]);
        }
    }
});

$("input.sliderValue_4").change(function() {
    var $this = $(this);
    $("#slider_4").slider("values", $this.data("index"), $this.val());
});

$("#slider_5").slider({
    range: true,
    min: 3,
    max: 20,
    step: 1,
    values: [3, 20],
    slide: function(event, ui) {
        for (var i = 0; i < ui.values.length; ++i) {
            $("input.sliderValue_5[data-index=" + i + "]").val(ui.values[i]);
        }
    }
});

$("input.sliderValue_5").change(function() {
    var $this = $(this);
    $("#slider_5").slider("values", $this.data("index"), $this.val());
});
$("#slider_6").slider({
    range: true,
    min: 0,
    max: 40,
    step: 1,
    values: [0, 40],
    slide: function(event, ui) {
        for (var i = 0; i < ui.values.length; ++i) {
            $("input.sliderValue_6[data-index=" + i + "]").val(ui.values[i]);
        }
    }
});

$("input.sliderValue_6").change(function() {
    var $this = $(this);
    $("#slider_6").slider("values", $this.data("index"), $this.val());
});

$("#slider_7").slider({
    range: true,
    min: 7,
    max: 30,
    step: 1,
    values: [7, 30],
    slide: function(event, ui) {
        for (var i = 0; i < ui.values.length; ++i) {
            $("input.sliderValue_7[data-index=" + i + "]").val(ui.values[i]);
        }
    }
});

$("input.sliderValue_7").change(function() {
    var $this = $(this);
    $("#slider_7").slider("values", $this.data("index"), $this.val());
});
//Конец фильтр
//Кол-во
function countPlus(plus){
  var value = parseInt($(plus).val()) + 1;
    if(value > 10000)
      value = 10000;
    $(plus).val(value);
}
function countMinus(munus){
  var value = parseInt($(munus).val()) - 1;
    if(value < 1){
      value = 1;
    }
    $(munus).val(value);
}
function countSum(sum){
  $(sum).change(function(){
    var value = parseInt($(this).val());
    if(value > 10000)
      $(this).val(10000);
  });
}
  $('.form__result-amount-container .plus span').click(function(event){
    event.preventDefault();
    countPlus($('.form__result-amount'));
  });
  $('.form__result-amount-container .minus span').click(function(event){
    event.preventDefault();
    countMinus($('.form__result-amount'));
  });

   countSum($('.form__result-amount'));

    $('.form__result-amount-container_1 .plus span').click(function(event){
    event.preventDefault();
    countPlus($('.form__result-amount_1'));
  });
  $('.form__result-amount-container_1 .minus span').click(function(event){
    event.preventDefault();
    countMinus($('.form__result-amount_1'));
  });

   countSum($('.form__result-amount_1'));

   $('.scrollbar-inner').scrollbar();
   $('.scrollbar-vertical').scrollbar();
   $('.scrollbar-inner__holiday').scrollbar();
   $('.book__left__item__scroll').scrollbar();

   $("input[type='tel']").mask("999-999-99-99");


   $('.article').readmore({
  speed: 75,
  collapsedHeight: 140,
  moreLink: '<a href="#" class="read__more">Подробное описание</a>',
  lessLink: '<a href="#" class="read__close">Закрыть</a>'
});

    $('.holiday__date__left__wrap').readmore({
  speed: 75,
  collapsedHeight: 428,
  moreLink: '<a href5"#" class="read__more">Показать еще</a>',
  lessLink: '<a href="#" class="read__close">Закрыть</a>'
});

   $('.liner__tech').readmore({
  speed: 75,
  collapsedHeight: 249,
  moreLink: '<a href="#" class="read__more__line">Показать еще</a>',
  lessLink: '<a href="#" class="read__close">Закрыть</a>'
});
    /*$('.ship__block__tech__wrap').readmore({
  speed: 75,
  collapsedHeight: 330,
  moreLink: '<a href="#" class="read__more__line">Показать еще</a>',
  lessLink: '<a href="#" class="read__close">Закрыть</a>'
});*/

    hBlock = $('.region__radio__item__title').innerHeight();
    $('.region__radio__item__arrow').height(hBlock);

   //Блок Квизы

    $('.kviz-amount .plus').click(function(event){
    event.preventDefault();
    countPlus($('.kviz-rezult'));
  });
  $('.kviz-amount .minus').click(function(event){
    event.preventDefault();
    countMinus($('.kviz-rezult'));
  });

   countSum($('.kviz-rezult'));

    $('.kviz-amount_1 .plus').click(function(event){
    event.preventDefault();
    countPlus($('.kviz-rezult_1'));
  });
  $('.kviz-amount_1 .minus').click(function(event){
    event.preventDefault();
    countMinus($('.kviz-rezult_1'));
  });

   countSum($('.kviz-rezult_1'));

    $('.kviz-amount_2 .plus').click(function(event){
    event.preventDefault();
    countPlus($('.kviz-rezult_2'));
  });
  $('.kviz-amount .minus').click(function(event){
    event.preventDefault();
    countMinus($('.kviz-rezult_2'));
  });

   countSum($('.kviz-rezult_2'));

   $("#kviz-slider").slider({
    range: true,
    min: 1,
    max: 100,
    step: 1,
    values: [1, 100],
    slide: function(event, ui) {
        for (var i = 0; i < ui.values.length; ++i) {
            $("input.kviz-sliderValue[data-index=" + i + "]").val(ui.values[i]);
        }
    }
});

$("input.kviz-sliderValue").change(function() {
    var $this = $(this);
    $("#kviz-slider").slider("values", $this.data("index"), $this.val());
});
   $(".kviz-start").click(function() { 
    $('.kviz').addClass('active');
    $('.kviz-form__wrap').addClass('active');
    $('.kviz-item[data-page="0"]').addClass('active');
    $('.val-pages__item[data-list="0"]').addClass('active');
   });

   $('.kviz-button__next').click(function() { 
      var current = $('.kviz-item.active');
      current.removeClass('active');
      current.next('.kviz-item').addClass('active');
      var val = $('.val-pages__item.active');
      val.removeClass('active').addClass('disabled');
      val.next('.val-pages__item').addClass('active');
      if($('.val-pages__item.active').hasClass('val-last')){
        $('.val-pages').css('display', 'none')
      }else{
        $('.val-pages').css('display', 'block')
      }
   });
    $('.kviz-button__prev').click(function() { 
      var current = $('.kviz-item.active');
      current.removeClass('active');
      current.prev('.kviz-item').addClass('active');
      var val = $('.val-pages__item.active');
      val.removeClass('active');
      val.prev('.val-pages__item').removeClass('disabled').addClass('active');
   });
    $('.kviz-button__last').click(function() {
      $('.kviz').removeClass('active');
      $('.kviz-item.kviz-last').removeClass('active');
    });

    $('#widget').draggable();

    //бронирование

      $('.book__left__item__table__tr').click(function() {
        if($(this).children('.book__left__item__table__tr__open').is(':hidden')){
          $('.book__left__item__table__tr__open').css('display','none');
          $(this).children('.book__left__item__table__tr__open').css('display','flex');
          if(ww < 992){
            $(this).parent().parent().parent().siblings('.book__left__item__table__tr__open').appendTo($('.book__left__item__scroll').find('.book__left__item__table__tr.active')).fadeOut(200).css('display','none');
            $('.book__left__item__scroll').find('.book__left__item__table__tr.active').removeClass('active');
            $(this).children('.book__left__item__table__tr__open').insertAfter('.book__left__bottom__right__wrap');
            $(this).addClass('active');
          }
        }else{
          $(this).children('.book__left__item__table__tr__open').css('display','none');
          $(this).removeClass('open');
        }
      });

       $('.book__left__item__button__next').click(function() {
        $('.book__left__item').removeClass('active');
        $('.book__left__item__next').addClass('active');
        $('.val-pages__item').next().addClass('active');
        $('.val-pages__item').prev().removeClass('active');
         $('html, body').animate({scrollTop: 0},500);
              return false;
       });

        $('.book__item__order__prev').click(function() {
          $('.book__left__item').addClass('active');
          $('.book__left__item__next').removeClass('active');
          $('.val-pages__item').next().removeClass('active');
        $('.val-pages__item').prev().addClass('active');
         $('html, body').animate({scrollTop: 0},500);
              return false;
        });
        
        $('.book__right__mobile').click(function() {
          if($('.book__right').is(':hidden')){
            $('.book__right').fadeIn(200);
            $(this).addClass('active');
              $('html, body').animate({scrollTop: 0},500);
              return false;
          }else{
            $('.book__right').fadeOut(200);
            $(this).removeClass('active');
          }
        });

  $(function() {
    $('.book__left__bottom__select').find('.book__left__bottom__item:first-child').addClass('first');
      $('.book__left__bottom__right__wrap .book__left__bottom__right:first-child').addClass('first');      
    $('.book__left__bottom__select').on('click', '.book__left__bottom__item:not(.first)', function() {
    $(this).addClass('first').siblings().removeClass('first').closest('.book__left__bottom').find('.book__left__bottom__right').removeClass('first').eq($(this).index()).addClass('first');
  });
  });
  $('.book__left__top__label.ur').click(function() {
    if($('.book__left__item__wrap__top__bottom.ur').is(':hidden')){
       $('.book__left__item__wrap__top__bottom.ur').css('display','flex');
        $('.book__left__item__wrap__top__bottom.fiz').css('display','none');
  }
});
  $('.book__left__top__label.fiz').click(function() {
  if($('.book__left__top__label__input.fiz').attr("checked") == 'checked'){
    $('.book__left__item__wrap__top__bottom.ur').css('display','none');
    $('.book__left__item__wrap__top__bottom.fiz').css('display','flex');
  }
});

  $('.book__left__item__wrap__top__next').click(function() {
    $('.book__left__item__wrap__top__none').css('display','none');
    $('.book__left__item__wrap__top__block').css('display','block');
    $(this).css('display','none');
    $('.book__left__item__wrap__top__prev').css('display','block');
  });

 $('.book__left__item__wrap__top__prev').click(function() {
    $('.book__left__item__wrap__top__none').css('display','block');
    $('.book__left__item__wrap__top__block').css('display','none');
    $(this).css('display','none');
    $('.book__left__item__wrap__top__next').css('display','block');
  });

    //аккордион

    $('.accordion__title').click(function() {
      if($(this).siblings('.accordion__content').is(':hidden')){
         $('.accordion__content').fadeOut(200);
        $(this).siblings('.accordion__content').fadeIn(200);
        $(this).addClass('active');
      }else{
        $(this).siblings('.accordion__content').fadeOut(200);
        $(this).removeClass('active');
      }
    });

    function listAccordion(list){
         $(list).on("click", function() {
             $(this).toggleClass('open-active');
    if ($(this).hasClass('open-active')) {
      $(this).siblings('.accordion__content').slideUp(200);
    } else { 
      $(this).removeClass('open-active');
      $(this).siblings('.accordion__content').slideDown(200);
    }
  });
       }

       listAccordion($('.include__accordion__item .accordion__tittle'));
       listAccordion($('.viza__accordion__item .accordion__tittle'));
       listAccordion($('.cart__accordion .accordion__tittle'));
     
   

     $('.include__list__accordion__tittle').on("click", function() {
    if ($(this).hasClass('open-active')) {
      $(this).removeClass('open-active');
      $(this).siblings('.include__list__accordion__content').slideUp(200);
    } else { 
      $('.include__list__accordion__tittle').removeClass('open-active');
      $(this).addClass("open-active");
      $('.include__list__accordion__content').slideUp(200);
      $(this).siblings('.include__list__accordion__content').slideDown(200);
    }
  });
  

 $('.kruiz__company__title').on("click", function() {
    if ($(this).hasClass('open-active')) {
      $(this).removeClass('open-active');
      $(this).siblings('.kruiz__company__block').slideUp(200);
    } else { 
      $('.kruiz__company__title').removeClass('open-active');
      $(this).addClass("open-active");
      $('.kruiz__company__block').slideUp(200);
      $(this).siblings('.kruiz__company__block').slideDown(200);
    }
  });

    //Формы

    $('.footer__button').click(function(){
      $('.contact-form').fadeIn(200);
      $('.overlay').fadeIn(200);
    });
    $('.overlay').click(function(){
      $('.contact-form').fadeOut(200);
      $('.login-form').fadeOut(200);
      $('.otziv-form').fadeOut(200);
      $('.otziv__fade').fadeOut(200);
      $(this).fadeOut(200);
    });
    $('.form__close').click(function(){
      $(this).parent().fadeOut(200);
      $('.overlay').fadeOut(200);
    });
    

    $(".form__file__wrap input[type=file]").change(function(){
         var filename = $(this).val().replace(/.*\\/, "");
         $("#filename").val(filename);
  });

    $('.header__bottom__right__log').click(function(e){
      event.preventDefault();
      $('.login-form').fadeIn(200);
      $('.overlay').fadeIn(200);

    });

    $('.otziv__popup').click(function(){
      $('.otziv-form').fadeIn(200);
      $('.overlay').fadeIn(200);
    });

    $('.otziv__main__item').click(function(){
      $('.otziv__fade').fadeIn(200);
      $('.overlay').fadeIn(200);
    });
    $('.otziv__fade__close').click(function(){
      $('.otziv__fade').fadeOut(200);
      $('.overlay').fadeOut(200);
    });

      $('.login-form__bottom__mes').click(function(){
        var newBlock = $('.login-form__wrap').clone();
        $(this).parent().parent().html(newBlock);
        $('.login-form__wrap').addClass('active');
      });

        hh = $('.kruiz__action__predl .sale__list').innerHeight();
        $('.kruiz__action__otziv .otziv__main__list').css('height',hh);
   

        $(window).on('resize', function(){
           hh = $('.kruiz__action__predl .sale__list').innerHeight();
        $('.kruiz__action__otziv .otziv__main__list').css('height',hh);
        });

    //Палубы
       /*$('.cabina__wrap__right__slider').slick({
    infinite: false,
    speed: 350,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows:true
  });*/
    var galleryThumbs = new Swiper('.gallery-thumbs', {
      spaceBetween: 10,
      slidesPerView: 4,
      freeMode: true,
      watchSlidesVisibility: true,
      watchSlidesProgress: true,
    });
    var galleryTop = new Swiper('.gallery-top', {
      spaceBetween: 10,
      slidesPerView: 1,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      thumbs: {
        swiper: galleryThumbs
      }
    });



    cabinaNum = $('.cabina__input__select').children().length;
      for (var i = 0; i < cabinaNum; i++) {
        cabinaHeight = 108/cabinaNum;
        $('.cabina__wrap__left__table').append('<div class="cabina__wrap__left__table__item" style="height:'+ cabinaHeight +'px"></div>');
        $('.cabina__wrap__left__table__item:first-child').addClass('active')
      }


      function tabsCabina(){
       $(function() {
        $('.cabina__tabs__wrap').find('.cabina__tabs__item:first-child').addClass('first');
        $('.cabina__tabs__content__item:first-child').addClass('first');
        $('.tabs__content__right__item:first-child').addClass('first');        
        $('.cabina__tabs__wrap').on('click', '.cabina__tabs__item:not(.first)', function() {
          $(this).addClass('first').siblings().removeClass('first').closest('.cabina__tabs').find('.cabina__tabs__content__item').removeClass('first').eq($(this).index()).addClass('first');
          $('.tabs__content__right').find('.tabs__content__right__item').removeClass('first').eq($(this).index()).addClass('first');
          /*$('.cabina__wrap__right__slider').slick('setPosition');*/
        });
      });

      
          $('.cabina__tabs__title').click(function(){
           if($(this).siblings('.cabina__tabs__wrap').is(':hidden')){
            $(this).siblings('.cabina__tabs__wrap').fadeIn(300);
            $(this).addClass('drop');

          }else{
            $(this).siblings('.cabina__tabs__wrap').fadeOut(300);
            $(this).removeClass('drop')
          }
          });

          $('.cabina__tabs__item').click(function(){
            text = $(this).text();
            item = $(this).data('item');
            $('.cabina__wrap__left__table__item').each(function(){
              cabinaNum = $('.cabina__input__select').children().length;
              for (var i = 0; i < cabinaNum; i++) {
                $('.cabina__wrap__left__table').children().removeClass('active');
                $('.cabina__wrap__left__table').children().eq(item).addClass('active');
                $('.tabs__content__right').find('.cabina__wrap__right__slider').children().removeClass('active');
                $('.tabs__content__right').find('.cabina__wrap__right__slider').children().eq(item).addClass('active');
              }
            });
            $('.cabina__tabs__title').text(text);
            $(this).parent().fadeOut(200);
          });

          $('.cabina__wrap__right__slider__next').click(function(){
             next= $(this).parent('.cabina__wrap__right__slider__item').data('select');

            if ($(this).parent('.cabina__wrap__right__slider__item').index() == $(this).parent('.cabina__wrap__right__slider__item').siblings().length){
               $('.cabina__tabs__item:first-child').addClass('first');
              $('.cabina__tabs__item:last-child').removeClass('first');
              $('.cabina__wrap__right__slider__item:first-child').addClass('active');
               $('.cabina__wrap__right__slider__item:last-child').removeClass('active');
               $('.cabina__wrap__left__table__item:first-child').addClass('active');
                $('.cabina__wrap__left__table__item:last-child').removeClass('active');
                $('.cabina__tabs__content__item:first-child').addClass('first');
                $('.cabina__tabs__content__item:last-child').removeClass('first');
            }else{
              $(this).parent('.cabina__wrap__right__slider__item').removeClass('active');
              $(this).parent('.cabina__wrap__right__slider__item').next().addClass('active');
               $('.cabina__input__select').find('.cabina__tabs__item[data-item = '+next+']').removeClass('first');
             $('.cabina__input__select').find('.cabina__tabs__item[data-item = '+next+']').next().addClass('first');
                $('.cabina__wrap__left__table__item').each(function(){
              cabinaNum = $('.cabina__input__select').children().length;
              for (var i = 0; i < cabinaNum; i++) {
                $('.cabina__wrap__left__table').children().eq(next).next().addClass('active');
                $('.cabina__wrap__left__table').children().eq(next).removeClass('active');
              }
            });
                $('.cabina__wrap').find('.cabina__tabs__content__item').removeClass('first').eq(next).next().addClass('first');
            }
             text = $('.cabina__tabs__item.first').text();
             $('.cabina__tabs__title').text(text);

       
          });
           $('.cabina__wrap__right__slider__prev').click(function(){
            next= $(this).parent('.cabina__wrap__right__slider__item').data('select');
            if($(this).parent('.cabina__wrap__right__slider__item').index() == 0){
               $('.cabina__tabs__item:first-child').removeClass('first');
              $('.cabina__tabs__item:last-child').addClass('first');
                $('.cabina__wrap__right__slider__item:first-child').removeClass('active');
               $('.cabina__wrap__right__slider__item:last-child').addClass('active');
               $('.cabina__wrap__left__table__item:first-child').removeClass('active');
                $('.cabina__wrap__left__table__item:last-child').addClass('active');
                 $('.cabina__tabs__content__item:first-child').removeClass('first');
                $('.cabina__tabs__content__item:last-child').addClass('first');
            }else{
            $(this).parent('.cabina__wrap__right__slider__item').removeClass('active');
              $(this).parent('.cabina__wrap__right__slider__item').prev().addClass('active');
                 $('.cabina__input__select').find('.cabina__tabs__item[data-item = '+next+']').removeClass('first');
             $('.cabina__input__select').find('.cabina__tabs__item[data-item = '+next+']').prev().addClass('first');
               $('.cabina__wrap__left__table__item').each(function(){
              cabinaNum = $('.cabina__input__select').children().length;
              for (var i = 0; i < cabinaNum; i++) {
                $('.cabina__wrap__left__table').children().eq(next).prev().addClass('active');
                $('.cabina__wrap__left__table').children().eq(next).removeClass('active');
              }
            });
                $('.cabina__wrap').find('.cabina__tabs__content__item').removeClass('first').eq(next).prev().addClass('first');
            }
             text = $('.cabina__tabs__item.first').text();
             $('.cabina__tabs__title').text(text);
           });

      }
      tabsCabina();
 

 //Кнопка вверх


       $('body').append('<span class="scrolltop"/>');

    $(".scrolltop").click(function() {
        $("html, body").animate({ scrollTop: 0 }, 400);
        return false;
    });

   
    $(window).on('scroll', function() {
        fromTop = $(window).scrollTop();
        if (fromTop > 600) {
            $('.scrolltop').addClass('active');
        }
        if (fromTop < 200) {
            $('.scrolltop').removeClass('active');
        }
    });
      // Для мобильного

      function blockMargin(){
        if(ww > 991){
          parseInt(mLeft = $('.wrap').offset().left + 30);
        }else{
          parseInt(mLeft = $('.wrap').offset().left);
        }
        $('.banner__right__form').css('margin-left', mLeft);
      }
      blockMargin();


      function tabsMobile(){
         if(ww < 768){
         text = $('.tabs--sale .tabs__item:first-child').text();
          $('.tabs__mobile').text(text);
          $('.tabs__mobile').click(function(){
           if($(this).siblings('.tabs__wrap').is(':hidden')){
            $(this).siblings('.tabs__wrap').fadeIn(300);
            $(this).addClass('drop');

          }else{
            $(this).siblings('.tabs__wrap').fadeOut(300);
            $(this).removeClass('drop')
          }
          });

          $('.tabs--sale .tabs__item').click(function(){
            text = $(this).text();
            $('.tabs__mobile').text(text);
            $(this).parent().fadeOut(200);
          });
         }
      }
      tabsMobile();
   

    if(window.innerWidth < 768){
        $('.kruiz__action__list').slick({
          settings: "unslick",
          responsive: [
          {
            breakpoint: 767,
          //сообщает, при какой ширине экрана нужно включать настройки
          settings: {
          infinite: true,
          speed: 350,
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows:false,
          autoplay:true,
          autoplaySpeed:3000,
          }
        }
        ]
      });
      }
   

           $('.tabs__order__button').click(function(){
              if($(this).siblings('.tabs__order').is(':hidden')){
                $(this).siblings('.tabs__order').fadeIn(300);
              }else{
                $(this).siblings('.tabs__order').fadeOut (300);
              }
             });
           $('.cabina__detail').click(function(){
            if($('.cabina__tabs__title').hasClass('drop')){
              $('.cabina__wrap__right').fadeIn(300);
              $('.cabina__wrap__right__slider').slick('setPosition');
            }
          });
            $('.cabina__wrap__right__close').click(function(){
            $('.cabina__wrap__right').fadeOut(300);
           });

           $('.port__content__right__more').click(function(){
              if($(this).siblings('.port__content__right').is(':hidden')){
                $(this).siblings('.port__content__right').fadeIn(300);
              }else{
                $(this).siblings('.port__content__right').fadeOut (300);
              }
             });
        if(ww < 992){
          $('.card__left__botttom').insertAfter('.card__right__grafic');
          
          $('.cart-5__right').each(function(){
            $(this).insertAfter($(this).parent().children().children('.cart-5__left__text'));
          });

          $('.cart__button__mobile').click(function(){
            $(this).parent().parent().parent().siblings('.cart__form__right').addClass('first');
            if($('.tabs__item__form').hasClass('first')){
                $('.tabs__item__form').removeClass('first').next().addClass('first');
                $('.tabs__content__item__form').removeClass('first').next().addClass('first');
            }else{
              $('.tabs__item__form').addClass('first');
              $('.tabs__content__item__form').addClass('first')
            }

          });
            $('.cart__tabs .swiper-infra').addClass('swiper-container-1 swiper-container-horizontal');
            

             $('.contact__form').insertBefore('.contact__bottom');

              $('.otziv-form__top__star').insertAfter('.otziv-form__top__liner');

              //бронирование

              $('.book__left__bottom__item--mobile__sel').click(function(){
                if($(this).siblings('.book__left__bottom__select').children('.book__left__bottom__item').is(':hidden')){
                  $(this).siblings('.book__left__bottom__select').children('.book__left__bottom__item').css('display','block');
                  $(this).addClass('active');
                }else{
                  $(this).siblings('.book__left__bottom__select').children('.book__left__bottom__item').css('display','none');
                   $(this).removeClass('active');
                }
              });

              $('.book__left__bottom__item').each(function(){
                $(this).on('click', function(){
                $('.book__left__bottom__item').hide();  
                $(this).show();
              });
              });

        }
       if(ww < 768){
        $('.main__sale').insertBefore('.main__news');
        $('.sale__title__wrap').each(function(){
          $(this).insertAfter($(this).parent().parent().parent().siblings('.sale__title'));
        });
        $('.sale__bottom__result').each(function(){
          $(this).insertAfter($(this).parent().siblings().find('.form__result__item__text__list__wrap'));
        });
        $('.form__result__item__img').each(function(){
          $(this).insertAfter($(this).siblings().children('.form__result__item__text__list__wrap'));
        });
        $('.form__result__item__bottom__wrap__list').each(function(){
          $(this).insertAfter($(this).parent().parent().siblings().children().children('.form__result__item__text__list__wrap'));
        });
        $('.news__main__title__link--otziv').text('Оставить отзыв');
         $('.otziv__page__list__item__left__top').each(function(){
          $(this).insertBefore($(this).parent().siblings().children('.otziv__page__list__item__right__top'));
        });

         $('.card__right__grafic').insertAfter('.card__left__botttom');

           $('.otziv-form__top__star').insertBefore('.otziv-form__top__liner');
          $('.otziv__fade__right').insertBefore('.otziv-fade__top__star');
       }
       if(ww < 1201){
       
        $('.cartblock').slick({
    infinite: true,
    speed: 350,
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows:true,
    autoplay:false,
    autoplaySpeed:3000,
     responsive: [
          {
            breakpoint: 992,
          //сообщает, при какой ширине экрана нужно включать настройки
          settings: {
          slidesToShow: 3,
          }
        },
        ]
  });
    
    $('.cart__tabs .swiper').addClass('swiper-container swiper-container-horizontal');
      }

       if(ww < 1401){
        $('.form__result__item__right__social').each(function(){
          $(this).appendTo($(this).parent().siblings('.form__result__item__left'));
        });
      }
      $(window).on('resize', function(){
        if(window.innerWidth < "767"){
        blockMargin();
         tabsMobile();
       }
      });

      
$("[data-fancybox]").fancybox();

var swiper = new Swiper('.swiper-container', {
      slidesPerView: 11,
      spaceBetween: 15,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
        breakpoints: {
    // when window width is <= 320px
    480: {
      slidesPerView: 2,
      spaceBetween: 10
    },
     767: {
      slidesPerView: 3,
      spaceBetween: 10
    },
    // when window width is <= 480px
    991: {
      slidesPerView: 5,
      spaceBetween: 20
    },
    // when window width is <= 640px
    1200: {
      slidesPerView: 7,
      spaceBetween: 30
    }
  }
    });
     
     var swiper = new Swiper('.swiper-container-1', {
      slidesPerView: 4,
      spaceBetween: 10,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
        breakpoints: {
    // when window width is <= 320px
    480: {
      slidesPerView: 2,
      spaceBetween: 10
    },
      767: {
      slidesPerView: 3,
      spaceBetween: 10
    },
  }
    });
});