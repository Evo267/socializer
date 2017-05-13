$(document).ready(function(){
	
	hashtag_regexp = /#(([a-zA-Z0-9]+)|([\u0600-\u06FF]+))/g;

	function linkHashtags(text) {
	    return text.replace(
	        hashtag_regexp,
	        '<a class="hashtag" href="/tag/$1">#$1</a>'
	    );
	} 

    $('.post_content').each(function() {
        $(this).html(linkHashtags($(this).html()));
    });

});