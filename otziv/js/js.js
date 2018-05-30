$(document).ready(function() {

   var current_performer_id = meme;
   var selected_performers_counter = meme.length;
   var upload_chunk_size = 120000;

   if(selected_performers_counter>0){
    $('#counter').text(selected_performers_counter);
    $('#counter').css("visibility", "visible");
   }

   $('.show_client_ready_orders').magnificPopup();
   $('.menu__link_m_f').magnificPopup();
   $('.service__btn').magnificPopup();
   $('.order__btn').magnificPopup();
   $('.select__but_tarif').magnificPopup();
   $('.become__btn').magnificPopup();
   $('.directory__exepted_btn').magnificPopup();
   $('.footer__link').magnificPopup();
   $('.show_orders_for_me').magnificPopup();
   $('.show_mesages').magnificPopup();
    
   $('.accept_order_btn').on('click', function(){
    var pressed_accept_btn_index = $('.accept_order_btn').index(this);
    var order_id_to_accept = client_ready_orders[pressed_accept_btn_index];
    $.ajax({
        type: 'get',
        url: '../engine/order_confirm.php',
        data: {
          'order_id_to_accept':order_id_to_accept,
        },
        contentType: false,
        cache: false,
      });
    $('#orders_to_accept_counter').text($('#orders_to_accept_counter').text()-1);
    var text = $('#orders_to_accept_counter').text();
    if(text = 0){
      $('#orders_to_accept_counter').attr('visibility', 'hidden');
    }
    alert("Вы подтвердили заказ. Теперь его можно скачать в личном кабинете.");
   })

   $('.reject_order_btn').on('click', function(){
    var pressed_reject_btn_index = $('.reject_order_btn').index(this);
    var order_id_to_reject = client_ready_orders[pressed_reject_btn_index];
    $.ajax({
        type: 'get',
        url: '../engine/order_confirm.php',
        data: {
          'order_id_to_reject':order_id_to_reject,
        },
        contentType: false,
        cache: false,
      });
    $('#orders_to_accept_counter').text($('#orders_to_accept_counter').text()-1);
    var text = $('#orders_to_accept_counter').text();
    if(text = 0){
      $('#orders_to_accept_counter').attr('visibility', 'hidden');
    }
    alert("Вы отправилю заказ на доработку!");
   })

   $('.send_answer_btn').on('click', function(){
    event.preventDefault();
    var pressed_send_answer_btn = $('.send_answer_btn').index(this);
    var message_from_array = $('.message_from_id');
    var message_from_id = message_from_array.eq(pressed_send_answer_btn).attr('value');
    var message_body_to_send_array = $('.message_body_to_send');
    var message_body_to_send = message_body_to_send_array.eq(pressed_send_answer_btn).attr('value');
    $.ajax({
        type: 'get',
        url: '../engine/send_message.php',
        data: {
          'to_id':message_from_id,
          'message_body':message_body_to_send
        },
        contentType: false,
        cache: false,
      });
   })

   $('#tarif_select').change(function(){
    var my_int = $('#tarif_select').attr('value');
    if(my_int==0){
    $('#set_orders_quantity_input').attr('value', '1');
    }else{
      $('#set_orders_quantity_input').attr('value', tarif_quantities[my_int-1]);
    }
   })

   $('#set_orders_quantity_input').on('input keyup', function(){
    if($('#set_orders_quantity_input').attr('value')==""||$('#set_orders_quantity_input').attr('value')=="0"){
      $('#set_orders_quantity_input').attr('value', '1');
    }
    var my_int = parseInt(($('#set_orders_quantity_input').attr('value')), 10);
    $('#set_orders_quantity_input').attr('value', my_int);
    $('#tarif_select').attr('value', '0');
   })

   $('#logged_user_avatar').mouseenter(function(){
    $('#renew_avatar_div').css('visibility', 'visible');
   })

   $('#renew_avatar_div').mouseenter(function(){
    $(this).css('visibility', 'visible');
   })

   $('#logged_user_avatar').mouseleave(function(){
    $('#renew_avatar_div').css('visibility', 'hidden');
   })

   $('#renew_avatar_div').mouseleave(function(){
    $(this).css('visibility', 'hidden');
   })

   $('#avatar_input').change(function(){
      $('#renew_avatar_btn').click();
   })

   $('#to_cabinet').on('click', function(){
    event.preventDefault();
    window.location.href = "cabinet.php";
   })

  $('.performer_block_id_setter').on('click', function(){
    var getter_index = $('.performer_block_id_setter').index(this);
    var block_list = $('.performer_block_id_getter');
          
    event.preventDefault();

    var checker = false;
    for (var i = 0; i < current_performer_id.length; i++) {
      if(current_performer_id[i]==Number(block_list.eq(getter_index).text())){
        checker = true;
      }
    }

    if(!checker){
      current_performer_id.push(Number(block_list.eq(getter_index).text()));
      selected_performers_counter ++;
      $(this).text('отменить');
      $(this).css('background', 'red');
      $(this).css('color', 'white');
      $('#counter').text(selected_performers_counter);
      $('#counter').css("visibility", "visible");

      $.ajax({
        type: 'get',
        url: '../engine/add_contact.php',
        data: {
          'perf':current_performer_id,
        },
        contentType: false,
        cache: false,
      });
    }else{
      var to_remove_iteration = current_performer_id.indexOf(block_list.eq(getter_index).text());
      current_performer_id.splice(to_remove_iteration, 1);
      selected_performers_counter --;
      $(this).text('заказать');
      $(this).css('background', '#42e0ed');
      $(this).css('color', 'black');
      if(selected_performers_counter==0){
        $('#counter').css("visibility", "hidden");
      }else{
        $('#counter').text(selected_performers_counter);
        $('#counter').css("visibility", "visible");
      }

      $.ajax({
        type: 'get',
        url: '../engine/add_contact.php',
        data: {
          'perf':current_performer_id,
        },
        contentType: false,
        cache: false,
      });
    }

    
  })

  setInterval(function() {
    if (!($('#performers_adder').is(':hover'))&&!($('#performers_adder_desc').is(':hover'))){
      $('#performers_adder_desc').hide("fast");
    }
   },500);

   $('#performers_adder').mouseenter(function(){
    var show_desc = true;
    if(logged_in){
      if(!(selected_performers_counter>0)){
        $('#performers_adder').attr('href', '../ispolniteli.php');
        show_desc = false;
      }else{
        $('#performers_adder').attr('href', '../order_confirm.php');
        $('#performers_adder_desc').text('');
        show_desc = false;
      }
    }
    if(show_desc){
      $('#performers_adder_desc').show("fast");
    }
   })

   setInterval(function() {
    if (!($('#show_notifications').is(':hover'))&&!($('#notifications_button').is(':hover'))){
      $('#show_notifications').hide("fast");
    }
   },500);

   $('#notifications_button').mouseenter(function(){
    $('#show_notifications').show("fast");
   })
    
    $('.notification_block').on('click', function(){
        var notification_index = $('.notification_block').index(this);
        var notification_id = $('.notification_id').eq(notification_index).text();
        $.ajax({
            type: 'get',
            url: '../engine/read_notification_and_message.php',
            data: {
              'notification_id':notification_id,
            },
            contentType: false,
            cache: false,
          });
        window.location.href='../cabinet.php';
    })

   setInterval(function() {
    if (!($('#exit_button').is(':hover'))&&!($('#exit_div').is(':hover'))){
      $('#exit_div').hide("fast");
    }
   },500);

   $('#exit_button').mouseenter(function(){
    $('#exit_div').show("fast");
   })

 /* $('.menu__link_m2').magnificPopup();*/

  $('.slickp-slider').slick({
  arrows: true,
  dots: false,
  infinite: false,
  speed: 300,

  prevArrow: '<button type="button" class="slider__btn_left"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
  nextArrow: '<button type="button" class="slider__btn_right"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
  slidesToShow: 4,
  slidesToScroll: 4,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
  })

  $('.slickp-slider1').slick({
  arrows: false,
  dots: true,
  })

  $('.contractor__exit').on('click', function(){
    $('.order__video').hide();
  })


	$('.menu__link_active').on('click', function(e){
    e.preventDefault();
  	$('.menu__mobile').slideToggle();
  })

  $('.view__more_btn').on('click', function(e){
    e.preventDefault();
    $('.tarif__plan_hide').slideToggle();
  })

  $('.img__cancel').on('click', function(e){
    e.preventDefault();
  	$('.menu__mobile').slideToggle();
  })

	$('.menu__link_m').on('click', function(e){
    e.preventDefault();
  	$('.menu__mobile').slideUp();
  })  

  $('.implementers___link1').on('click', function(e){
  	e.preventDefault();
  	$('.implementers__block1').show();
  	$('.implementers__block2').hide();
  	$('.implementers__block3').hide();
  	$('.implementers__block4').hide();
  	$('.implementers__block5').hide();
  	$('.implementers__block6').hide();
  })

    $('.implementers___link2').on('click', function(e){
  	e.preventDefault();
  	$('.implementers__block2').show();
  	$('.implementers__block1').hide();
  	$('.implementers__block3').hide();
  	$('.implementers__block4').hide();
  	$('.implementers__block5').hide();
  	$('.implementers__block6').hide();
  })

    $('.implementers___link3').on('click', function(e){
  	e.preventDefault();
  	$('.implementers__block3').show();
  	$('.implementers__block1').hide();
  	$('.implementers__block2').hide();
  	$('.implementers__block4').hide();
  	$('.implementers__block5').hide();
  	$('.implementers__block6').hide();
  })

  $('.implementers___link4').on('click', function(e){
  	e.preventDefault();
  	$('.implementers__block4').show();
  	$('.implementers__block1').hide();
  	$('.implementers__block2').hide();
  	$('.implementers__block3').hide();
  	$('.implementers__block5').hide();
  	$('.implementers__block6').hide();
  })

  $('.implementers___link5').on('click', function(e){
  	e.preventDefault();
  	$('.implementers__block5').show();
  	$('.implementers__block1').hide();
  	$('.implementers__block2').hide();
  	$('.implementers__block4').hide();
  	$('.implementers__block3').hide();
  	$('.implementers__block6').hide();
  })

  $('.implementers___link6').on('click', function(e){
  	e.preventDefault();
  	$('.implementers__block6').show();
  	$('.implementers__block1').hide();
  	$('.implementers__block2').hide();
  	$('.implementers__block4').hide();
  	$('.implementers__block5').hide();
  	$('.implementers__block3').hide();
  })

   /*--------animate------*/
   
   $(window).scroll(function() {
    $('.footer_c').each(function(){
      var imagePos = $(this).offset().top;
      var topOfWindow = $(window).scrollTop();
      if (imagePos < topOfWindow+900) {
        $(this).addClass('rubberBand');
      }
    });
  }); 

   $(window).scroll(function() {
    $('.footer_b').each(function(){
      var imagePos = $(this).offset().top;
      var topOfWindow = $(window).scrollTop();
      if (imagePos < topOfWindow+900) {
        $(this).addClass('rubberBand');
      }
    });
  }); 

   $(window).scroll(function() {
    $('.footer_a').each(function(){
      var imagePos = $(this).offset().top;
      var topOfWindow = $(window).scrollTop();
      if (imagePos < topOfWindow+900) {
        $(this).addClass('rubberBand');
      }
    });
  }); 

   $(window).scroll(function() {
    $('.plan_a').each(function(){
      var imagePos = $(this).offset().top;
      var topOfWindow = $(window).scrollTop();
      if (imagePos < topOfWindow+900) {
        $(this).addClass('rubberBand');
      }
    });
  }); 

  $(window).scroll(function() {
    $('.plan__title').each(function(){
      var imagePos = $(this).offset().top;
      var topOfWindow = $(window).scrollTop();
      if (imagePos < topOfWindow+900) {
        $(this).addClass('fadeInUp');
      }
    });
  }); 

  $(window).scroll(function() {
    $('.service_a').each(function(){
      var imagePos = $(this).offset().top;
      var topOfWindow = $(window).scrollTop();
      if (imagePos < topOfWindow+900) {
        $(this).addClass('rubberBand');
      }
    });
  });

  $(window).scroll(function() {
    $('.service__title').each(function(){
      var imagePos = $(this).offset().top;
      var topOfWindow = $(window).scrollTop();
      if (imagePos < topOfWindow+900) {
        $(this).addClass('fadeInUp');
      }
    });
  });

   $(window).scroll(function() {
    $('.advantage__2_a').each(function(){
      var imagePos = $(this).offset().top;
      var topOfWindow = $(window).scrollTop();
      if (imagePos < topOfWindow+900) {
        $(this).addClass('bounceInDown');
      }
    });
  });


   $(window).scroll(function() {
    $('.advantage__2__title').each(function(){
      var imagePos = $(this).offset().top;
      var topOfWindow = $(window).scrollTop();
      if (imagePos < topOfWindow+900) {
        $(this).addClass('fadeInUp');
      }
    });
  });

  $(window).scroll(function() {
    $('.advantage_1__img3').each(function(){
      var imagePos = $(this).offset().top;
      var topOfWindow = $(window).scrollTop();
      if (imagePos < topOfWindow+900) {
        $(this).addClass('zoomInLeft');
      }
    });
  });

   $(window).scroll(function() {
    $('.advantage_1__img2').each(function(){
      var imagePos = $(this).offset().top;
      var topOfWindow = $(window).scrollTop();
      if (imagePos < topOfWindow+900) {
        $(this).addClass('zoomInRight');
      }
    });
  });

   $(window).scroll(function() {
    $('.advantage_1__title').each(function(){
      var imagePos = $(this).offset().top;
      var topOfWindow = $(window).scrollTop();
      if (imagePos < topOfWindow+900) {
        $(this).addClass('fadeInUp');
      }
    });
  });

   $(window).scroll(function() {
    $('.implementers___link').each(function(){
      var imagePos = $(this).offset().top;
      var topOfWindow = $(window).scrollTop();
      if (imagePos < topOfWindow+900) {
        $(this).addClass('zoomIn');
      }
    });
  });

   $(window).scroll(function() {
    $('.implementers_1').each(function(){
      var imagePos = $(this).offset().top;
      var topOfWindow = $(window).scrollTop();
      if (imagePos < topOfWindow+900) {
        $(this).addClass('fadeInLeft');
      }
    });
  });




 

});


$(document).ready(function() {
    $('.plus').click(function () {
        $('#tarif_select').attr('value', '0');
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
    });
    $('.minus').click(function () {
        $('#tarif_select').attr('value', '0');
        var $input = $(this).parent().find('input');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        return false;
    });
});


var inputs = document.querySelectorAll( '.inputfile' );
Array.prototype.forEach.call( inputs, function( input )
{
  var label  = input.nextElementSibling,
    labelVal = label.innerHTML;

  input.addEventListener( 'change', function( e )
  {
    var fileName = '';
    if( this.files && this.files.length > 1 )
      fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
    else
      fileName = e.target.value.split( '\\' ).pop();

    if( fileName )
      label.querySelector( 'span' ).innerHTML = fileName;
    else
      label.innerHTML = labelVal;
  });
});


/*--------Плавный скролл--------*/

$(document).ready(function(){
      $("#menu").on("click","a", function (event) {
          //отменяем стандартную обработку нажатия по ссылке
          event.preventDefault();
   
          //забираем идентификатор бока с атрибута href
          var id  = $(this).attr('href'),
   
          //узнаем высоту от начала страницы до блока на который ссылается якорь
              top = $(id).offset().top;
           
          //анимируем переход на расстояние - top за 1500 мс
          $('body,html').animate({scrollTop: top-69}, 1500);
      });
  });