<?php
	$author_name = "Daniil Stoljar";
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
		<img src="oppepilt.jpg" alt="Tallinna Ülikooli Terra hoone" width="2000" height="380">
		<p>Lehe avamise hetk: <?php echo $weekday_name_et[$weekday_now - 1] . ", " . $full_time_now . ", " . $day_category . ", " . $time_of_day;?>.</p>
		<?php echo $file_name; ?>
	</body>
</html>
