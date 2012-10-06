{* $Id: tracker_validator.tpl 29348 2010-09-17 16:29:53Z jonnybradley $ *}
{jq}
$("#editItemForm{{$trackerEditFormId}}").validate({
	{{$validationjs}},
	submitHandler: function(){process_submit(this.currentForm);}
});
process_submit = function(me) {
	if (!$(me).attr("is_validating")) {
		$(me).attr("is_validating", true);
		$(me).validate();
	}
	if ($(me).validate().pendingRequest > 0) {
		setTimeout(function() {process_submit(me);}, 500);
		return false;
	}
	$(me).attr("is_validating", false);
	me.submit();
};
{/jq}