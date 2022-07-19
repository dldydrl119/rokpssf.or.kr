var mainSlideIdx = 0;

$(document).ready(function(){
	//slide
	var mainSlideLength = $('.main_slide li').length;
	
	mainSlidePlay(mainSlideIdx);
	$('.indicator span').on('click', function(){
		mainSlideIdx = $('.indicator span').index(this);
		mainSlide(mainSlideIdx);
	});

	$('.main_slide .control').on('click', function(){
		if($(this).hasClass('pause')){
			$(this).removeClass('pause').addClass('play').attr('title','멈춤');
			mainSlide(mainSlideIdx);
		} else {
			$(this).removeClass('play').addClass('pause').attr('title','자동넘기기');
			mainSlidePause();
		}
	});

	$('.main_slide .btn.prev').on('click', function(){
		if(mainSlideIdx > 0){
			mainSlideIdx--;
		}else{
			mainSlideIdx = mainSlideLength-1;				
		}
		mainSlide(mainSlideIdx);
	});

	$('.main_slide .btn.next').on('click', function(){
		var mainSlideIdx = $('.indicator span.curr').index();
		if(mainSlideIdx < mainSlideLength-1){
			mainSlideIdx++;
		}else{
			mainSlideIdx = 0;
		}
		mainSlide(mainSlideIdx);
	});

	//공지사항, 보도자료 tab control
	$('.board_tab li a').on('click', function(){
		var idx = $('.board_tab li a').index(this);
		$('.board_tab li').removeClass('curr').eq(idx).addClass('curr');
		$('.board_box').removeClass('curr').eq(idx).addClass('curr');
	});
});

//slide
function mainSlide(mainSlideIdx){
	var mainSlideLength = $('.main_slide li').length;
	$('.main_slide li').removeClass('show').eq(mainSlideIdx).addClass('show');
	$('.main_slide .indicator span').removeClass('curr').eq(mainSlideIdx).addClass('curr');
}

function mainSlidePlay(mainSlideIdx){		
	var mainSlideLength = $('.main_slide li').length;
	timer = setInterval(function(){
		var mainSlideIdx = $('.indicator span.curr').index();
		if(mainSlideIdx < mainSlideLength-1){
			mainSlideIdx++;
		}else{				
			mainSlideIdx = 0;
		}
		mainSlide(mainSlideIdx);		
	}, 6000);
}

function mainSlidePause(){
	clearInterval(timer);
}