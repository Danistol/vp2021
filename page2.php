<?php
	$author_name = "Daniil Stoljar";
	//var_dump($_POST);
	$todays_adjective_html = null;
	$todays_adjective_error = null;
	$todays_adjective = null;
	if(isset($_POST["adjective_submit"])){
		//echo "Klikiti";
		if(!empty($_POST["todays_adjective_input"])){
			$todays_adjective_html = "<p>Tänane päev on " . $_POST["todays_adjective_input"] .". </p>";
			$todays_adjective = $_POST["todays_adjective_input"];
		} else{
			$todays_adjective_error = "Palun sisesta tänase päeva kohta omadussõna";
		}
	}
	
	
	$full_time_now = date("d.m.Y H:i:s");
	$weekday_now = date("N"); 
	$day_category = "lihtsalt päev";
	//echo $weekday_now; 
	// võrdub ==     suurem/väiksem <>  <= >=    pole võrdne !=
	if($weekday_now <= 6) {
		$day_category = "koolipäev";
	} else{
		$day_category = "puhkepäev";
	}
	$weekday_name_et = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
	$sleeptime = "uneaeg";
	$work_time = "tundide aeg ";
	$free_time = "vaba aeg"; 
	$vodka_time ="nädala vahetus, oled vaba";
	
	$time_of_day = date("H");
	if($day_category == "koolipäev"){
		if($time_of_day > 23 && $time_of_day < 8) {
			$time_of_day = $sleeptime; 
		}	 elseif(8 <= $time_of_day && $time_of_day <= 18) {
				$time_of_day = $work_time;
			} elseif(18 <= $time_of_day && $time_of_day  < 23) {
				$time_of_day = $free_time;
				}
	}else{
		$time_of_day = $vodka_time;
	}	
	echo $weekday_name_et[2];
	
	// juhusliku foto lisamine 
	$photo_dir = "photos/";
	//loen kataloogi sisu
	$all_files = scandir($photo_dir);
	$all_real_files = array_slice($all_files, 2);
	
	//sõelume välja päris pildid
	$photo_files = [];
	$allow_photo_types = ["image/jpeg", "image/png"];
	foreach($all_real_files as $file_name){
		echo
		$file_info = getimagesize($photo_dir . $file_name);
		if(isset($file_info["mime"])){
		if(in_array($file_info["mime"], $allow_photo_types)){
			array_push($photo_files, $file_name);	
			}
		}
	}
	
	//echo $all_files;
	//var_dump($all_real_files);
	//loen masiivi elemendid kokku
	$file_count = count($all_real_files);
	//loosin juhusliku arvu(min peab olema 0 ja max count - 1)
	$photo_num = mt_rand(0, $file_count - 2);
	//<img src="kataloog/fail alt="Tallinna ülikool">
	$photo_html = '<img src="' . $photo_dir . $photo_files[$photo_num] . '" alt="Tallinna Ülikool">';
	$photo_list_html = "\n <ul> \n";
	for($i = 0;$i < $file_count;$i ++){
		$photo_list_html .= "<li>" . $photo_files[$i] . "</li>";
	} 
	$photo_list_html .= "</ul> \n";
	
	$photo_select_html = "\n" . '<select name="photo_select">'. "\n";
	for($i = 0;$i < $file_count;$i ++){
		$photo_select_html .= '<option valuse = "' . $i . '">' . $photo_files[$i] . "</option> \n";
	} 
	$photo_select_html .= "</ul> \n";
	
	?>

<!DOCTYPE html>
<html lang="et">
	<head>
		<meta charset="utf-8">
		<title><?php echo $author_name; ?>, veebiprogrameerimine</title>
	</head>
	<body>
		<h1><?php echo $author_name; ?>, veebiprogrameerimine</h1>
		<p>See leht on loodud õppetöö raames ja ei sisalda tõsiseltvõetavat sisu!</p>
		<p>Õppetöö toimub <a href="https://www.tlu.ee/dt">Tallinna ülikooli Digitehnoloogiate instituudis</a>.</p>
		<hr>
		<form method="POST">
			<input type="text" placeholder="omadussõna tänase kohta" name="todays_adjective_input" value = "<?php echo $todays_adjective?>" >
			<input type="submit" name="adjective_submit" value="Saada">
			<span><?php echo $todays_adjective_error ?></span>
		</form>
		<?php echo $todays_adjective_html;?>
		<hr>
		<form method="POST">
			<?php echo $photo_select_html; ?>
		</form>
		<hr>
		<hr>
		<?php echo $photo_html;
			  echo $photo_list_html;
		?>
	</body>
</html>
