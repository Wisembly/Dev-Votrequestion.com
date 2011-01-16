$(function() {
	
	function validate(){
		var required = $('.isRequired').length;
		var isOk = $('.isOk').length;
				
		if ( isOk == required ){
			$("#alert").hide();
			$("#showSubmit").fadeIn("slow");
		}
	}
	
	// on parcours le form à la recherche de tous les .col-field
	$("#show_form").find('.col-field').each(function(){
		var field = $(this);
		
		// tous ceux qui ont .isRequired vont avoir droit à leur fonction de vérification
		if ( field.children().hasClass('isRequired')){
			
			// si on a affaire à un input text ou textarea
			field.find(':input').keyup(function(){
				var input = $(this);
				if ( input.val().length > 0 )
					input.addClass('isOk');
				else
					input.removeClass('isOk');
					
				validate();
			});
			
			// si on a affaire à des checkboxes
			field.find(':checkbox').change(function(e){
				var nbre_checked=0;
				var ul = $(this).parent().parent();
				ul.find(':checkbox').each(function(e){
					if ( $(this).is(':checked') ) nbre_checked++ ;
				});
				
				if ( nbre_checked > 0 )
					ul.parent().addClass('isOk');
				else
					ul.parent().removeClass('isOk');
					
				validate();
			});
			
			// si on a affaire à des boutons radio
			field.find(':radio').change(function(){
				// par définition un radio ne peut pas être décoché une fois coché, on est donc forcément bon
				$(this).parent().parent().parent().addClass('isOk');
				validate();
			});
		}
	});
});