(function($){
	$.fn.CuteFocus = function(){
		$this=$(this);
		$this.focus();		
      	$this.addClass('fondo-azul');
    	setTimeout(function(){
    		$this.removeClass('fondo-azul');
    	},200);
	}
})(jQuery);