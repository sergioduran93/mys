/* No ATRAS */
window.location.hash="-";
window.location.hash="-";//again because google chrome don't insert first hash into history
window.onhashchange=function(){window.location.hash="-";}

function preventBack(){window.history.forward();}
setTimeout("preventBack()", 0);
window.onunload=function(){null};

/* Formato numeros */
Number.prototype.formatMoney = function(decPlaces, thouSeparator, decSeparator) {
	var n = this,
	decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
	decSeparator = decSeparator == undefined ? "." : decSeparator,
	thouSeparator = thouSeparator == undefined ? "," : thouSeparator,
	sign = n < 0 ? "-" : "",
	i = parseFloat(n = Math.abs(+n || 0).toFixed(decPlaces)) + "",
	j = (j = i.length) > 3 ? j % 3 : 0;
	return sign + (j ? i.substr(0, j) + thouSeparator : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thouSeparator) + (decPlaces ? decSeparator + Math.abs(n - i).toFixed(decPlaces).slice(2) : "");
};

function round100(n){
	var num = parseFloat(n)/500;
	num     = Math.ceil(num);
	return parseInt(500*num)
}

function alertM(mensaje){
	$('#alertP').text(mensaje);
	$(function() {
		$('#alertM').modal('show');
	});
}

/*
function get_filtered_datatable() {
	var filteredrows = oTable._('tr', {"filter": "applied"});
	for ( var i = 0; i < filteredrows.length; i++ ) {
		console.log(filteredrows[i]);
	};
}
*/



















