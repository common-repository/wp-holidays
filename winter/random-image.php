<?php

/*
You can use this script to pass-through an image from an external server to the player.
Just insert the url to the external image below and copy this file to your server.
You can use the flashvar 'image', 'image_redirect.php' your HTML to feed this script to the player.
*/


function getRandomFile($start_dir)      {
	/*
	returns the name of one random file from within a directory
	*/
        
		$old_dir = getcwd();
        chdir($start_dir);
		
        $dir = opendir('.');
        while (($myfile = readdir($dir)) !==false)  {
                if ($myfile != '.' && $myfile != '..' && is_file($myfile)  ) {
				
					$ext = substr($myfile, strlen($myfile)-3, 3);
					if ( $ext == 'jpg' || $ext == 'gif' || $ext == 'png' ) {
							$files[] = $myfile;
						 }
						 
                    }
                }
        closedir($dir);
        chdir('../');
        srand ((float) microtime() * 10000000);
        $file = array_rand($files);
		
		chdir($old_dir);
        return $files[$file];
        }


$randomimage = dirname(__FILE__) . "/". getRandomFile(dirname(__FILE__));

// build file headers
header("Expires: Mon, 1 Gen 1970 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

header("content-type:image/png;");
// refer to file
readfile($randomimage);
// that's all
exit();




?>
