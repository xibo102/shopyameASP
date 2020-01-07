
<html>
	<head>
	<meta charset="utf-8">
	<title>Draw Me A Kanji</title>
	<link rel="stylesheet" href="demo.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.2.8/raphael.min.js"></script>
	<script src="../src/dmak.js"></script>
	<script src="../src/dmakLoader.js"></script>
	<script src="../src/anime.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/svg.js/2.5.0/svg.js"></script>
	<script src="https://d3js.org/d3.v5.min.js"></script>
	<style>
		 #drawing{
		width:500px;
		height:500px;
		}
		#moving {
			height: 20px;
			width: 20px;
			background: red;
			position: absolute;
			top:0;
			left: 0;
		}
	</style>
	</head>
	<body>
		<input id ='text'>
		<button id = 'submit'> submit</button>
			
		<div id="konnichiha"></div>
		
		<div id="wrap-svg"></div>
		

		<script>
			var quantily_svg;
			var content;
			var svgkk;
			var svgCopy;
			var targetPath;
			var duongkinh = 5;
			$(document).ready(function(){
				
				$('#submit').click(function(){
					var text = $('#text').val();
					var dmak = new Dmak(text, {'step':0.00001,'element': "konnichiha", "uri": "http://kanjivg.tagaini.net/kanjivg/kanji/", 'stroke.animated':'false',"stroke.order.attr.font-size": '40px'});

					setTimeout(function(){
						
                        quantily_svg = $('#konnichiha').children('svg').length;
                        content = $('#wrap-svg').html();	//get html trong Wrap-svg / ban đầu là rỗng	
						for ( var a = 0; a < quantily_svg; a++ )
						{		
                            // content = $('#wrap-svg').html();	    		
							content+= '<svg id="aa'+a+'"></svg>';
                            alert(content);
							$('#wrap-svg').html(content);
							
							svgkk = $('#konnichiha').children('svg').html();
							$('#aa'+a+'').html(svgkk);
							svgCopy = $('#aa'+a+'').html();
							
							var quantity_path = $('#aa'+a+'').children('path').length;	//số nét chữ
							var countCircle = [];
							for( var k = 2 ; k < quantity_path; k++ )
							{
								targetPath = $('#aa'+a+'').children('path').eq(k); //get path
								countCircle[k] = targetPath[0].getTotalLength()/duongkinh; // số vòng tròn trong 1 path
								var distance = targetPath[0].getTotalLength()/countCircle[k];  // khoảng cách 2 vòng tròn
								var length = targetPath[0].getTotalLength();	// chiều daif
							
								for(var i = 0; i < countCircle[k]; i++){
									svgCopy+= '<circle id="move_circle'+k+i+'" cx="0" cy="0" r="2.5" fill="red"></circle>';
									
								}
								$('#aa'+a+'').html(svgCopy);

							}

							for( var k = 2 ; k < quantity_path; k++ )
							{
								var targetPathx = $('#aa'+a+'').children('path').eq(k); //get path
								for(var i = 0; i < countCircle[k]; i++){
									var temp = i * distance;
									var point = targetPathx[0].getPointAtLength(temp);
									var $moveCircle = document.getElementById('move_circle'+k+i);
									$moveCircle.setAttribute("transform","translate("+ point.x + ","+ point.y +")");
								}
								
							}
						}

					}, 1000);
				
				});
			});
			
		</script>


	</body>
</html>
