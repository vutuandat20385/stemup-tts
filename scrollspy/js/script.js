$(document).ready(function() {

	$('ul li ul li a').click(function(event) {
		// alert(1);
		event.preventDefault();

		part = $(this).attr('href'); // lấy id của thẻ h2 tương ứng
		// console.log(part);

		position = $(part).offset().top; // tìm vị trí thẻ h2

		// hiệu ứng
		$('html, body').animate({scrollTop: position},1000,'easeInOutSine');
	});
});