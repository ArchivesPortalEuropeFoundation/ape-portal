<script>
$(document).ready(function(){    
  $("#homeBlogSlider").slick({
	  autoplay: false,
	  arrows: true,
	  speed: 400,
	  draggable: false,
	  dots: true,
	  fade: false,
      slidesToShow: [[+blogTotal:lt=`5`:then=`[[+blogTotal]]`:else=`4`]],
      slidesToScroll: 2,
	  infinite: false,
	  variableWidth: false,
	  prevArrow: '<span class="prev"><i class="fas fa-angle-left"></i></span>',
	  nextArrow: '<span class="next"><i class="fas fa-angle-right"></i></span>',
	  responsive: [
	  {
        breakpoint: 992,
        settings: {
          slidesToShow: [[+blogTotal:lt=`3`:then=`[[+blogTotal]]`:else=`2`]],
          slidesToScroll: 2
        }
      },
	  {
        breakpoint: 768,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }]
	});    
});        
</script>