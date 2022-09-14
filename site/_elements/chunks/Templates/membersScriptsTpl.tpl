
    $('#membersSlider[[+idx]]').on('init reInit afterChange', function(event, slick, currentSlide, nextSlide){
        var i = (currentSlide ? currentSlide : 0) + 1;
        $('#membersPopup[[+idx]] .counter').text(i + '/' + slick.slideCount);
        if ($('#membersPopup[[+idx]] .slick-current .image').length > 0) {
	        $('#membersPopup[[+idx]] .offset').removeClass('remove');
	    }
	    else {
	        $('#membersPopup[[+idx]] .offset').addClass('remove');
	    }
    });
	
    $("#membersSlider[[+idx]]").slick({
	    autoplay: false,
		arrows: true,
		speed: 800,
		draggable: false,
		dots: false,
		fade: true,
		infinite: false,
		variableWidth: false,
		adaptiveHeight: true,
		appendArrows: "#membersPopup[[+idx]] .controls",
		prevArrow: '<span class="prev"><i class="fas fa-angle-left mr"></i> [[!%asi.pg_previous? &topic=`default` &namespace=`asi`]]</span>',
		nextArrow: '<span class="next">[[!%asi.pg_next? &topic=`default` &namespace=`asi`]] <i class="fas fa-angle-right ml"></i></span>'
	});
	
	$('#membersPopup[[+idx]]').on('shown.bs.modal', function () {
        $('#membersSlider[[+idx]]').slick('refresh');
		$('#membersSlider[[+idx]]').slick('slickGoTo', memberID - 1);
		$('#membersPopup[[+idx]] .modal-content').addClass('open');
    });
    
    if ($(window).width() < 768) {	
       
        $('#membersMobileSlider[[+idx]]').on('init reInit afterChange', function(event, slick, currentSlide, nextSlide){
            var i = (currentSlide ? currentSlide : 0) + 1;
            $('#tab[[+idx]] .counter').text(i + '/' + slick.slideCount);
        });        
        
        $("#membersMobileSlider[[+idx]]").slick({
	        autoplay: false,
		    arrows: true,
		    speed: 400,
		    draggable: false,
		    dots: false,
		    fade: false,
            slidesToShow: 1,
            slidesToScroll: 1,
		    infinite: false,
		    variableWidth: false,
		    adaptiveHeight: true,
		    prevArrow: '<span class="prev"><i class="far fa-angle-left"></i></span>',
		    nextArrow: '<span class="next"><i class="far fa-angle-right"></i></span>'
	    });
	    
        $('a[href="#tab[[+idx]]"]').on('shown.bs.tab', function () {
            $('#membersMobileSlider[[+idx]]').slick('refresh');
        });	    
	    
	}    
