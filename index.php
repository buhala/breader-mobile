    <!DOCTYPE html>
    <html>
    <head>
       <title>bReader</title>
       <meta name="viewport" content="width=device-width; height=decide-height;initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
       <link rel="stylesheet" href="iui/iui.css" type="text/css" />
       <link rel="stylesheet" href="iui/t/default/default-theme.css" type="text/css"/>
	   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
       <script type="application/x-javascript" src="iui/iui.js"></script>

	   <script>
	   $(function(){
	   function strip_tags (input, allowed) {
  allowed = (((allowed || "") + "").toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join(''); // making sure the allowed arg is a string containing only tags in lowercase (<a><b><c>)
  var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi,
    commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
  return input.replace(commentsAndPhpTags, '').replace(tags, function ($0, $1) {
    return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : '';
  });
}

	   $('#login_button').click(function(){
			$.getJSON('http://local.breader.eu/api/getUserFeed/'+$('#email_input').val()+'?callback=?','',function(res){
			console.log(res);
			if(res.success==false){
				alert('Your username is wrong!');
			}
			else{
				iui.showPageById('stories_div');
				i=0;
				while(i<res.length){
					$("#fieldset_div").append('<div class="row" id="story'+i+'" ><a href="'+res[i]['link']+'"><b>'+res[i]['title']+'</b><br></a>'+strip_tags(String(res[i]['description']),'')+'</div>');
					i++;

				}
			}
				});
	   });
	   });
	   </script>
	   
    </head>
	<body>
   <div class="toolbar">
      <h1 id="pageTitle"></h1>
      <a id="backButton" class="button" href="#"></a>
   </div>
    <form id="login" title="Login" class="panel"  action="" method="get" selected="true" style="width:100%;">
       <fieldset>
          <div class="row">
             <label>Email</label>
             <input type="text" name="email"  id="email_input" placeholder="Email..." >
          </div>
       </fieldset>
       <a class="whiteButton" id="login_button">Show stories</a>	   <fieldset>
	   <div class="row"><p><center>Don't have an account? Create one at <a href="http://breader.eu">http://breader.eu</a></center></p></div>
	   </fieldset>
    </form>
	
   <div id="stories_div" title="Stories" class="panel">
			<fieldset id="fieldset_div">
			
			</fieldset>
   </div>
</body>
</html>