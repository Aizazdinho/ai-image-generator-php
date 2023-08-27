<?php
    include 'backend/config.php';
    $image = "";
	if($_SERVER['REQUEST_METHOD'] === "POST"){
		if(isset($_POST['generate'])){
			$prompt    = $_POST['prompt'];

			if(!empty($prompt)){
				$prompt = trim($prompt);
		
                $genObj->prompt = $prompt;

                $image =  $genObj->generate();

			}else{
				$error = "Field are requried!.";
			}
		}
	} 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>MyAI</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="frontend/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet"> 
    <script src="https://code.jquery.com/jquery-3.7.0.slim.min.js" integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>

	<link rel="apple-touch-icon" sizes="180x180" href="frontend/images/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="frontend/images/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="frontend/images/favicon/favicon-16x16.png">
	<link rel="manifest" href="frontend/images/favicon/site.webmanifest">
	<link rel="mask-icon" href="frontend/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">


</head>
<body>
<form id="form" method="POST">
<div class="wrapper flex flex-1">
<div class="inner-wrapper flex flex-1 w-full h-screen">
	
	<!--CONTENT_WRAPPER-->
	<div class="flex flex-1 h-full items-start justify-center">
		<!--INNER_CONTENT_WRAPPER-->
		<div class="flex flex-1 w-full flex-col items-center justify-center">
			
			<!--LOGO_SECTION-->
			<div class="w-full flex flex-1 items-center justify-center flex-col">

				<!--LOGO_IMAGE_DIV-->
				<div class="w-96 overflow-hidden items-center sm:mt-0 md:mt-20 sm:mt-20 mb-6 flex justify-center flex-col text-center">
					<div id="loader" class="hidden w-40 h-40 overflow-hidden">
						<img src="frontend/images/loding.gif">
					</div>
					<!-- Check if Image is generated -->
                    <?php if(!empty($image)):?>
                        <img src="<?php echo $image;?>"/>
                        <span class="text-gray-800 text-sm">Image successfuly generated</span>
                    <?php else:?>
                    	<!-- else display the logo image -->
                        <img id="logo" src="frontend/images/mygpt.png"/>
						<span class="text-red-800 text-sm font-bold">
							<?php 
                                if(isset($error)){
                                    echo $error;
                                }
                            ?>
						</span>
					<?php endif;?>
				</div>
				<!--LOGO_IMAGE_DIV_ENDS-->

				<!--INPUT_SECTION-->
				<div class="2xl:w-1/3 md:w-2/3 sm:w-3/4 w-10/12">
					<label class="relative">
						<span class="absolute flex left-4 text-gray-300" style="top:3px;"><i class="fas fa-search"></i></span>
						<input class="pl-9 py-3 pr-3 border w-full text-gray-800" type="text" name="prompt" placeholder="Generate images by AI" />
					</label>
				</div>
				<!--INPUT_SECTION_ENDS-->

			</div><!--LOGO_SECTION_END-->

			<!--BOTTOM_SECTION-->
			<div>

				<!--BOTTON_WRAPPER-->
				<div class="pt-5 flex items-center justify-center flex-col">
					<div>
						<button class="bg-green-500 px-3 py-1 rounded text-white hover:shadow-md" name="generate">Generate Image</button>
					</div>
					
				</div>
				<!--BOTTON_WRAPPER_ENDS-->

			</div>
			<!--BOTTOM_SECTION_ENDS-->

		</div>
		<!--INNER_CONTENT_WRAPPER_ENDS-->
	</div>
	<!--CONTENT_WRAPPER_ENDS-->
</div>	
</div>
</form>
<script>
    $("#form").submit(function() { 
        $("#logo").hide();
        $("#loader").removeClass('hidden');
    });
</script>
</body>
</html>