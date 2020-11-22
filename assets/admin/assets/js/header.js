
var bu = $('#base_url').val();
setTimeout(() => {
	loadSidebar();
}, 100);

function loadSidebar() {
	$.ajax({
		url: bu + 'admin/loadSidebar',
		method: 'POST',
		data: {
			page: $('#page').val()
		}
	}).done(function (e) {
		$('#sidebarnav').html(e);
	}).fail(function (e) {
		alert('Terjadi kesalahan #AJXLSB. Silahkan reload!');
	});
}




function notifikasi(sel, msg, err) {
	var alert_type = 'alert-success ';
	if (err) alert_type = 'alert-danger ';
	var html = '<div class="alert ' + alert_type + ' alert-dismissible show p-4">' + msg + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
	$(sel).html(html);
	$('html, body').animate({
		scrollTop: $(sel).offset().top - 75
	}, 500);
}

function notifikasi2(sel, msg, err) {
	var alert_type = 'alert-success ';
	if (err) alert_type = 'alert-danger ';
	var html = '<div class="alert ' + alert_type + ' alert-dismissible show p-4">' + msg + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
	$(sel).html(html);

}

function formatHarga(str) {
	return str.toString()
		.replace(/\D/g, "")
		.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function onlyNumber(str) {
	return str.toString()
		.replace(/\D/g, "");
}
