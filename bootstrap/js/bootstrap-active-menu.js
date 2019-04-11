$(function() {
	
	$("#dom a:contains('Dom')").parent().addClass('active');
	$("#przesylki a:contains('Przesyłki')").parent().addClass('active');
	$("#transakcje a:contains('Transakcje')").parent().addClass('active');
	$("#poczta a:contains('Poczta')").parent().addClass('active');
	$("#osiagniecia a:contains('Osiągnięcia')").parent().addClass('active');
	$("#kontakty a:contains('Kontakty')").parent().addClass('active');
	$("#statystyki a:contains('Statystyki')").parent().addClass('active');


	if($("#lista a:contains('Lista')").parent().hasClass('active')){
		$(".dropdown a:contains('Klienci')");
	}
	
});