
(function($) {
	
	"use strict"

	// Mobile Nav toggle
	$('.menu-toggle > a').on('click', function (e) {
		e.preventDefault();
		$('#responsive-nav').toggleClass('active');
	})

	// Fix cart dropdown from closing
	$('.cart-dropdown').on('click', function (e) {
		e.stopPropagation();
	});

	/////////////////////////////////////////

	// Products Slick
	$('.products-slick').each(function() {
		var $this = $(this),
				$nav = $this.attr('data-nav');

		$this.slick({
			slidesToShow: 4,
			slidesToScroll: 1,
			autoplay: true,
			infinite: true,
			speed: 300,
			dots: false,
			arrows: true,
			appendArrows: $nav ? $nav : false,
			responsive: [{
	        breakpoint: 991,
	        settings: {
	          slidesToShow: 2,
	          slidesToScroll: 1,
	        }
	      },
	      {
	        breakpoint: 480,
	        settings: {
	          slidesToShow: 1,
	          slidesToScroll: 1,
	        }
	      },
	    ]
		});
	});

	// Products Widget Slick
	$('.products-widget-slick').each(function() {
		var $this = $(this),
				$nav = $this.attr('data-nav');

		$this.slick({
			infinite: true,
			autoplay: true,
			speed: 300,
			dots: false,
			arrows: true,
			appendArrows: $nav ? $nav : false,
		});
	});

	/////////////////////////////////////////

	// Product Main img Slick
	$('#product-main-img').slick({
    infinite: true,
    speed: 300,
    dots: false,
    arrows: true,
    fade: true,
    asNavFor: '#product-imgs',
  });

	// Product imgs Slick
  $('#product-imgs').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    centerMode: true,
    focusOnSelect: true,
		centerPadding: 0,
		vertical: true,
    asNavFor: '#product-main-img',
		responsive: [{
        breakpoint: 991,
        settings: {
					vertical: false,
					arrows: false,
					dots: true,
        }
      },
    ]
  });

	// Product img zoom
	var zoomMainProduct = document.getElementById('product-main-img');
	if (zoomMainProduct) {
		$('#product-main-img .product-preview').zoom();
	}

	/////////////////////////////////////////

	// Input number
	$('.price').each(function() {
		var $this = $(this),
		$input = $this.find('input[type="number"]'),
		up = $this.find('.qty-up'),
		down = $this.find('.qty-down');

		down.on('click', function () {
			var value = parseInt($input.val()) - 10;
			value = value < 0 ? 0 : value;
			
			$input.val(value);
			$input.change();
			updatePriceSlider($this , value)
		})

		up.on('click', function () {
			var value = parseInt($input.val()) + 10;
			$input.val(value);
			$input.change();
			updatePriceSlider($this , value)
		})
	});

	$('.produit').each(function() {
		var $this = $(this),
		$input = $this.find('input[type="number"]'),
		up = $this.find('.qty-up'),
		down = $this.find('.qty-down');

		down.on('click', function () {
			var value = parseInt($input.val()) - 1;
			value = value < 0 ? 0 : value;
			
			$input.val(value);
			$input.change();
			updatePriceSlider($this , value)
		})

		up.on('click', function () {
			var value = parseInt($input.val()) + 1;
			$input.val(value);
			$input.change();
			updatePriceSlider($this , value)
		})
	});

	var priceInputMax = document.getElementById('price-max'),
			priceInputMin = document.getElementById('price-min');
	
	priceInputMax.addEventListener('change', function(){
		updatePriceSlider($(this).parent() , this.value)
		
		
	});

	priceInputMin.addEventListener('change', function(){
		updatePriceSlider($(this).parent() , this.value)
		
		
	});

	function updatePriceSlider(elem , value) {
		if ( elem.hasClass('price-min') ) {
			
			priceSlider.noUiSlider.set([value, null]);
		} else if ( elem.hasClass('price-max')) {
			
			priceSlider.noUiSlider.set([null, value]);
		}
		
	}

	// Price Slider
	var priceSlider = document.getElementById('price-slider');
	if (priceSlider) {
		noUiSlider.create(priceSlider, {
			start: [0, 10000],
			connect: true,
			step: 10,
			range: {
				'min': 0,
				'max': 10000
			}
			
		});

		priceSlider.noUiSlider.on('update', function( values, handle ) {
			var value = values[handle];
			
			handle ? priceInputMax.value = value : priceInputMin.value = value
		
			filter_data();
			
		});
	}
	

	
	

function filter_data()
{ 	
    
   
    
    var priceInputMax = document.getElementById('price-max'),
			priceInputMin = document.getElementById('price-min');
    var page=1;
    var x = priceInputMax.value;
    var y = priceInputMin.value;
    var sort=document.getElementById("input-select-sort").value;
    var show=document.getElementById("input-select-show").value;
    var test= document.getElementById("test").value;
    var id = document.getElementById("id").value;
    console.log(test,id,y,x,sort,show,page);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    var f=this.responseText;
    
    document.getElementById("row").innerHTML =f;
}
};
if(test=="all"){
    xmlhttp.open("GET", "index.php?action=produitList&filtre=price&min="+y+"&max="+x+"&sort="+sort+"&show="+show+"&page="+page, true);
    xmlhttp.send();
}else if(test=="surcategorie"){
	xmlhttp.open("GET", "index.php?action=productCategorie&surcategorie="+id+"&filtre=price&min="+y+"&max="+x+"&sort="+sort+"&show="+show+"&page="+page, true);
	xmlhttp.send();
}else if(test=="categorie"){
	xmlhttp.open("GET", "index.php?action=productCategorie&categorie="+id+"&filtre=price&min="+y+"&max="+x+"&sort="+sort+"&show="+show+"&page="+page, true);
	xmlhttp.send();
}else if(test=="souscategorie"){
	xmlhttp.open("GET", "index.php?action=productCategorie&souscategorie="+id+"&filtre=price&min="+y+"&max="+x+"&sort="+sort+"&show="+show+"&page="+page, true);
	xmlhttp.send();}
}

 
 
	
	document.getElementById("input-select-sort").onchange = function (){filter_data()};
	document.getElementById("input-select-show").onchange = function (){filter_data()};
	
})(jQuery);
