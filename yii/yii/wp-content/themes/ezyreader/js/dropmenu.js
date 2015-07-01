jQuery(function($){
	$(document).ready(function(){
$("#menu li ").hover(function(){
		$('ul:first',this).css('display', 'block');} ,
	function(){
        $('ul:first',this).css('display', 'none');
});

/// Control menu in mobile screens
	$("#menu-icon").click(function(){
		$("#nav-responsive").slideToggle();}
		)
});
})


