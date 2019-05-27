<?php
	
	$dirname=('bilder/');
	$handle=opendir ($dirname);
	$dateien=scandir($dirname);
	$count=count($dateien)-2;
	
	 echo "Count: ".$count."<br/>";
	
	//$i=0;
	
	while ( $file = readdir ( $handle ) ) {
		$i++;
		if( $file == "." or $file == "..") {
			}else{
			
			$titel[]=$file;
			
			for($i=0;$i<count($file);$i++){
				$image=$dirname.$file;
				
				$size = getimagesize( $image);
				
				// $image        = $rest;
				// $target      = $rest;
				$max_width   = "600";
				$max_hoehe   = "600";
				$quality     = "100";
				$src_img     = imagecreatefromjpeg($image);
				$picsize     = getimagesize($image);
				
				$src_width   = $picsize[0];
				$src_height  = $picsize[1];
				if($picsize[0]>$picsize[1]){
					//Breitenberechnung
					if($src_width > $max_width)
					{
						$convert = $max_width/$src_width;
						$dest_width = $max_width;
						$dest_height = ceil($src_height*$convert);
					}
					else
					{
						$dest_width = $src_width;
						$dest_height = $src_height;
					}
				}
				elseif($picsize[1]>$picsize[0]){
					
					//Höhenberechnung
					if($src_height > $max_hoehe)
					{
						$convert = $max_hoehe/$src_height;
						$dest_height = $max_hoehe;
						$dest_width = ceil($src_width*$convert);
					}
					else
					{
						$dest_width = $src_width;
						$dest_height = $src_height;
					}
				}
				
				$dst_img = imagecreatetruecolor($dest_width,$dest_height);
				imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $dest_width, $dest_height, $src_width, $src_height);
				imagejpeg($dst_img, $image, $quality);
				
				echo $i.": " .$image." wurde verkleinert.<br/>";
				
			}
			
			
		}
		
	}
	
	
	
	
	
	
	
	
?>
