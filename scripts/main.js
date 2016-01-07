$(document).ready(function(){
	// $('select option').click(function(e) {
    $('#jexam option').on('mousedown', function (e) {
    	this.selected = !this.selected;
    	e.preventDefault();
	});
});