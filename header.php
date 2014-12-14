<?php
include 'config.php';
?>


<?
/*if (substr_count($_SERVER["SERVER_NAME"], "www.")) {
	if ($_SERVER["HTTPS"] == "on") {
		$protocol = "https://";
	}
	else {
		$protocol = "http://";
	}
	
	header("Location: ".$protocol.str_replace("www.", "", $_SERVER["SERVER_NAME"]).$_SERVER["REQUEST_URI"]);
	
	exit();
}*/

?>

<!DOCTYPE html>
<html>
<head>
	<title>CampusOwl</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=.8">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src='ratings/jquery.js' type="text/javascript"></script>
	<script src='ratings/jquery.MetaData.js' type="text/javascript" language="javascript"></script>
	<script src='ratings/jquery.rating.js' type="text/javascript" language="javascript"></script>
	<script src='ratings/jquery.rating.js' type="text/javascript" language="javascript"></script>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href='http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css' rel='stylesheet'>
    <script src='js/vote.js'></script>
    <script src='js/tooltip.js' type="text/javascript"></script>
	<script src='js/popover.js' type="text/javascript"></script>

    <link href='ratings/jquery.rating.css' type="text/css" rel="stylesheet"/>
    <link href="css/bs.min.css" type="text/css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
    	
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <script>
function divClicked() {
    var divHtml = $(this).html();
    var id = $(this).attr('name');
    var editableText = $("<textarea name='"+id+"'/>");
    editableText.val(divHtml);
    $(this).replaceWith(editableText);
    editableText.focus();
    // setup the blur event for this new textarea
    editableText.blur(editableTextBlurred);
}
//GOOGLE ANALYTICS
 (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){

  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),

  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)

  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-54889022-1', 'auto');

  ga('send', 'pageview');

//END GOOGLE ANALYTICS
function editableTextBlurred() {
    var html = $(this).val();
    var id = $(this).attr('name');
    var viewableText = $("<div class='editT' style='margin-left:10px; max-width:70%; float:left;' name='"+id+"'>");
    viewableText.html(html);
    $(this).replaceWith(viewableText);
    // setup the click event for this new div
    viewableText.click(divClicked);
    $.post("editReview.php",{'reviewID': id, 'text': html}, function(response) {
				if (response == 1) {
					

				} else {
					alert("Something went wrong!");
				}
			})
    
}

$(document).ready(function(){

	$(document).on('click', function(e) {
		$('.userInfo').popover('hide');
	});
	
	$(".userInfo").popover({trigger: 'manual', placement: "bottom", html: true}).click(function(e){
		var a = $(this).attr("name");
		var b = $(this);
		$.post("get_user_rating.php",{'userID': a}, function(response) {
				$(b).attr('data-content',response).popover('show');
		});
		 e.preventDefault();
	})
	
	
	 $('#topPage').keydown(function (event) { 

        if (event.keyCode == 13) {
            var page = $('#topPage').val(); 
            var max = $('#topPage').attr('name'); 
            if(page > max){
	            $('#topPage').css("border", "2px solid red");
            }
            else{
            	location.href = "ownPage.php?id=<?php echo urlencode($_GET["id"])?>&p="+(page)+"&sort=<?php echo $_GET["sort"]?>";
            }
        }
    });
    
    
     $('.editT').click(divClicked);
    
	$("#review").click(function(){
		 	$("#reviewBox").toggle();
		 	$("#upPic").toggle();
		 	$("#reqSpec").toggle();
	 	});
	 	$("#upPic").click(function(){
		 	$("#fileBox").toggle();
		 	$("#review").toggle();
		 	$("#reqSpec").toggle();
	 	});
	 	$("#reqSpec").click(function(){
		 	$("#specialBox").toggle();
		 	$("#review").toggle();
		 	$("#upPic").toggle();
	 	});
    $(".delete").one('click', function() {
		 	var a = $(this).val();
		 	$.get("delete_posts.php",{reviewID: a}, function(response) {
				if (response == 1) {
					alert("This post has been successfully deleted!");
					window.location.reload(true);

				} else {
					alert("Something went wrong!");
				}
			})
	 	});
	  $(".deleteToday").one('click', function() {
		 	var a = $(this).val();
		 	var userID = $(this).attr('name');
		 	
		 	$.get("delete_today.php",{'userID': userID, 'postID': a}, function(response) {
				if (response == 1) {
					alert("This post has been successfully deleted!");
					location.reload();

				} else {
					alert("Something went wrong!");
				}
			})
	 	});
	 $(".deleteImage").one('click', function() {
		 	var a = $(this).val();
		 	$.get("delete_image.php",{imageID: a}, function(response) {
				if (response == 1) {
					alert("This photo has been successfully deleted!");
					window.location.reload(true);

				} else {
					alert("Something went wrong!");
				}
			})
	 	});
	 $(".report").one('click', function() {
		 	var a = $(this).val();
		 	var username = $(this).attr('name');
		 	$.get("report_post.php",{'reviewID': a, 'username': username}, function(response) {
				if (response == 1) {
					alert("This post has been successfully reported");
					window.location.reload(true);
				}
				else if (response == 3){
					alert("You must be logged in to report");
				}
				else {
					
					alert("Something went wrong!");
				}
			})
	 	});

	 	$("#addFav").click(function(){
		 	var userID = $("#addFav").attr('name');
		 	var barID = $("#addFav").val();
		 	$.post("addFavorite.php",{'barID': barID, 'userID': userID, 'type': 'bar'}, function(response) {
				if (response == 1) {
					alert("Added to favorites");
					window.location.reload(true);

				} else {
					alert("Something went wrong!");
				}
			})
	 	});
	 	$(".specials").click(function(){
		 	var day = $(this).attr('name');
		 	var barID = $(this).attr('id');
		 	$.post("getSpecials.php",{'barID': barID, 'day': day}, function(response) {
				alert(response);
			})
	 	});

	 	$("#remFav").click(function(){
		 	var userID = $("#remFav").attr('name');
		 	var barID = $("#remFav").val();
		 	$.post("removeFavorite.php",{'barID': barID, 'userID': userID, 'type': 'bar'}, function(response) {
				if (response == 1) {
					window.location.reload(true);

				} else {
					alert("Something went wrong!");
				}
			})
	 	});
	 	
		 	

 	});
 	</script>
</head>

<body>



<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">CampusOwl</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div style='margin-left:5px;' class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Colleges <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <?php
				$query = mysql_query("SELECT * FROM colleges");
				while ($row = mysql_fetch_assoc($query)){
					$id = $row['collegeID'];
					$name = $row['name'];
					echo "<li><a href='results.php?collegeID=$id'>$name</a></li>";
				}
			?>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Bars <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li role="presentation" class="dropdown-header">University of Missouri Columbia</li>

             <?php
				$query = mysql_query("SELECT * FROM bars ORDER BY name ASC");
				while ($row = mysql_fetch_assoc($query)){
					$id = $row['barID'];
					$name = $row['name'];
					echo "<li><a href='ownPage.php?id=$id'>$name</a></li>";
				}
			?>
          </ul>
        </li>
        
        <?php if ($_SESSION['username'] || $_SESSION['admin']){ ?>
        <li><a href='request_bar.php'>Request A Bar</a></li>
        <?php } ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      
        	<?php if (!$_SESSION['username'] && !$_SESSION['admin']){ ?>
			<li><a href='login.php'>Login</a></li>
			<li><a href='register.php'>Register</a></li>
		<?php }else if ($_SESSION['username']){ ?>
				
			<li><a href='profile.php?id=<?php echo $_SESSION['userID'] ?>'><?php echo $_SESSION['username'] ?></a></li>
			<li><a href='logout.php'>Logout</a></li>
			<?php }else if ($_SESSION['admin']){ ?>
				<li><a href='a_index.php'>Admin</a></li>
				<li><a href='logout.php'>Logout</a></li>
			<?php } ?>
        
      </ul>
      <form class="navbar-form navbar-right" action='results.php' method='GET' role="search">
        <div class="form-group">
          <input type="text" class="form-control" name='q' placeholder="Search Bars">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
