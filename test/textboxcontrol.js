// Text Box Control by Jamie Goodwin
// Give a Text Box a class of "tb" then...
// the plugin will store its original content...
// clear it onfocus, and if it's onblur'red while empty...
// then original content will be restored
		$(document).ready(function(){
			$(".tb").each(function(){
				var val = $(this).attr('value');
				$(this).attr('rel', val);
			});
			$(".tb").focus(function(){
				if(this.value==$(this).attr('rel')){this.value=''};
			})
			.blur(function(){
				if(this.value==''){this.value=$(this).attr('rel')};
			});
		});