//$Id: captchalib.js 27791 2010-06-28 23:53:53Z sampaioprimo $

jQuery(document).ready(function() {
	jQuery('#captchaRegenerate').click(function() {
		generateCaptcha();
	});
});

function generateCaptcha() {
	jQuery('#captchaImg').attr('src', 'img/spinner.gif').show();
	jQuery('body').css('cursor', 'progress');
	jQuery.ajax({
		url: 'antibot.php',
		dataType: 'json',
		success: function(data) {
			jQuery('#captchaImg').attr('src', data.captchaImgPath);
			jQuery('#captchaId').attr('value', data.captchaId);
			jQuery('body').css('cursor', 'auto');
		}
	});
}
