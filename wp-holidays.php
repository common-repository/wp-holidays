<?php 
/*
Plugin Name: WordPress Holidays
Plugin URI: http://wordpress.org/extend/plugins/wp-holidays/
Description:  Display candy holiday images on your blog
Version: 0.5.4
Author:	<a href="http://www.juliusdesign.net">Julius</a>, <a href="http://gioxx.org">Gioxx</a>, and <a href="http://maurizio.mavida.com">miziomon</a>

*/

$wp_holiday_localversion = "0.5.4";
$wp_holiday_uri = "http://wordpress.org/extend/plugins/wp-holidays/";

/*

Installation:
Place the wp-holiday dir in your /wp-content/plugins/ directory
and activate through the administration panel.
*/

/*  
License: GPL

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/




function wp_holiday_activation() {
	/* 
	06.08.2008 | maurizio
	this function print one random image from summer dir
	*/
	add_option("wp_holiday_position", 'after-post');
	add_option("wp_holiday_display", 'nohome');
	add_option("wp_holiday_language", 'en');
	add_option("wp_holiday_theme", 'winter');

}

function wp_holiday_deactivation() {
	/* 
	06.08.2008 | maurizio
	this function print one random image from summer dir
	*/
	
	delete_option("wp_holiday_position");
	delete_option("wp_holiday_css");
	delete_option("wp_holiday_url");
	delete_option("wp_holiday_display");
	delete_option("wp_holiday_language");
	delete_option("wp_holiday_theme");
	delete_option("wp_holiday_wish");
	delete_option("wp_holiday_slogan");
	delete_option("wp_holiday_advice");				
	
}

// action function for above hook
function wp_holiday_menu() {

    // Add a new submenu under Options:
    add_options_page(	
					'WordPress Holidays', 
					'WordPress Holidays', 
					'manage_options', 
					__FILE__, 
					'wp_holiday_options_page');

}


function wp_holiday_options_page() {
	/* 
	06.08.2008 | maurizio
	this function display the admin form ed update the options on sumbit action
	*/
	$updated = false;
	$updated_text = "";
	
	if ( isset($_POST['submit']) )	{
		update_option('wp_holiday_position', $_POST['wp_holiday_position']);
		update_option('wp_holiday_display', $_POST['wp_holiday_display']);
		update_option('wp_holiday_css', $_POST['wp_holiday_css']);
		update_option('wp_holiday_url', $_POST['wp_holiday_url']);
		update_option('wp_holiday_language', $_POST['wp_holiday_language']);
		update_option('wp_holiday_theme', $_POST['wp_holiday_theme']);
		update_option('wp_holiday_wish', $_POST['wp_holiday_wish']);
		update_option('wp_holiday_slogan', $_POST['wp_holiday_slogan']);
		update_option('wp_holiday_advice', $_POST['wp_holiday_advice']);		
		
	
		
		$updated = true;
	}
	
	$wp_holiday_url = get_option('wp_holiday_url');
	$wp_holiday_css = get_option('wp_holiday_css');
	
	$wp_holiday_wish = get_option('wp_holiday_wish');
	$wp_holiday_slogan = get_option('wp_holiday_slogan');
	$wp_holiday_advice = get_option('wp_holiday_advice');
	
	$wp_holiday_display = get_option('wp_holiday_display');
	
	switch ($wp_holiday_display) {
    case "allpage":
		$option_allpage		= "selected";
		$option_nohome 		= "";
	    break;
    case "nohome":
		$option_allpage		= "";
		$option_nohome		= "selected";
        break;
	}	
	
	
	$wp_holiday_position = get_option('wp_holiday_position');
    
	switch ($wp_holiday_position) {
    case "after-post":
		$option_after_post	= "selected";
		$option_code 		= "";
		$option_hide 		= "";
	    break;
    case "shortcode":
		$option_after_post	= "";
		$option_code 		= "selected";
		$option_hide 		= "";        
        break;
    case "hide":
		$option_after_post	= "";
		$option_code 		= "";
		$option_hide 		= "selected";
		break;
	}
	
		
	$wp_holiday_language = get_option('wp_holiday_language');
    
	switch ($wp_holiday_language) {
    case "en":
		$option_en	= "selected";
		$option_it	= "";
		$option_es	= "";
	    break;
		
    case "it":
		$option_en	= "";
		$option_it	= "selected";
		$option_es	= "";
	    break;

    case "es":
		$option_en	= "";
		$option_it	= "";
		$option_es	= "selected";
	    break;
	}
	
	$wp_holiday_theme = get_option('wp_holiday_theme');
	switch ($wp_holiday_theme) {
    case "automatic":
		$option_automatic	= "selected";
		$option_summer	= "";
		$option_winter	= "";
		$option_custom	= "";		
	    break;
    case "summer":
		$option_automatic	= "";
		$option_summer	= "selected";
		$option_winter	= "";
		$option_custom	= "";		
	    break;
    case "winter":
		$option_automatic	= "";
		$option_summer	= "";
		$option_winter	= "selected";
		$option_custom	= "";		
	    break;
    case "custom":
		$option_automatic	= "";
		$option_summer	= "";
		$option_winter	= "selected";
		$option_custom	= "";		
	    break;				
	}
	
	
if ( $updated == true ) {
	$updated_text = '
		<br/>
		<div class="updated fade" id="message" >
			<p><strong>Options saved.</strong></p>
		</div>
		';
	}
	
echo '
    <div class="wrap">
      <h2>WordPress Holidays</h2>
	  
	  '.$updated_text.'
	  
      <p>This page contain some little options to configure <b>WordPress Holidays</b>.</p>
	  
	  <p>The default options is After post. In this way the holiday image is displayed after the post.<br/>
	  If you want to customize the position you have to set "shortcode" in the select box and use this snip while you are writing a post
	  
	  <div style="margin: 5px 0;border: dotted 1px #ccc">
	  <code >[wp_holiday]</code>
	  </div>
	  
	 <p>If you like you can also use that code inside you pages:</p>
	  
	  <div style="margin: 5px 0;border: dotted 1px #ccc">
	  <code >&lt;?php if (function_exists(\'wp_holiday\')) {  wp_holiday(); } ?&gt;</code>
	  </div>
	  
	  <p>For who need check the html code before display can use this function that return html whitout diplay</p>
	  
	  <div style="margin: 5px 0;border: dotted 1px #ccc">
	  <code>&lt;?php get_wp_holiday() ?&gt;</code>
	  </div>

	  <p>Here one little example:</p>
		<div style="margin: 5px 0;border: dotted 1px #ccc">
	  <code > es.
			<br/>&lt;?php
			<br/>$holidays = get_wp_holiday();
			<br/>echo $holidays;
			<br/>?&gt;
			</code>  
		</div>
      
	  
	<form style="margin-top: 20px;" name="form1" method="post" action="">
		
		<h3>Configure your Wordpress Holidays options</h3>
		<fieldset class="options">
	
		
		<table class="form-table" cellspacing="2" cellpadding="5" border="0">
		
		<tr valign="top">
			<th >Language:</th>
			<td>	
				<select name="wp_holiday_language" id="wp_holiday_language">
				<option value="en" '.$option_en.' >English</option>
				<option value="it" '.$option_it.' >Italiano</option>
				<option value="es" '.$option_es.' >Español</option>
				</select>
			</td>
		</tr>		

		<tr valign="top">
			<th >Theme selection:</th>
			<td>	
				<select name="wp_holiday_theme" id="wp_holiday_theme">
				<option value="automatic" '.$option_automatic.' >automatic</option>
				<option value="summer" '.$option_summer.' >summer</option>
				<option value="winter" '.$option_winter.' >winter</option>
				<option value="custom" '.$option_custom.' >custom</option>
				</select><br/>
				Theme directory. If you select custum remember tu upload an image under custom dir.
			
			</td>
		</tr>	
		
		<tr valign="top">
			<th >Position:</th>
			<td>	
				<select name="wp_holiday_position" id="wp_holiday_position">
				<option value="after-post" '.$option_after_post.' >After post</option>
				<option value="shortcode" '.$option_code.' >Shortcode</option>
				<option value="hide" '.$option_hide.' >Hide</option>
				</select>
		
			</td>
		</tr>
		
		<tr valign="top">
			<th >Display:</th>
			<td>	
				<select name="wp_holiday_display" id="wp_holiday_display">
				<option value="allpage" '.$option_allpage.' >all page</option>
				<option value="nohome" '.$option_nohome.' >no home</option>
				
				</select>
		
			</td>
		</tr>


		<tr valign="top">
			<th >Wish message: </th>
			<td>	
				<input style="width: 95%;" value="'.$wp_holiday_wish.'" name="wp_holiday_wish" id="wp_holiday_wish" type="text"><br/>
				Default value is blank <br/>
				es. Mery Christmas
			</td>
		</tr>				

		<tr valign="top">
			<th >Slogan message: </th>
			<td>	
				<input style="width: 95%;" value="'.$wp_holiday_slogan.'" name="wp_holiday_slogan" id="wp_holiday_slogan" type="text"><br/>
				Default value is blank<br/>
				es. Don\'t miss any one new post
			</td>
		</tr>	
		
		<tr valign="top">
			<th >Advice message: </th>
			<td>	
				<input style="width: 95%;" value="'.$wp_holiday_advice.'" name="wp_holiday_advice" id="wp_holiday_advice" type="text"><br/>
				Default value is blank<br/>
				es. Subscribe my feed
			</td>
		</tr>			
		
		<tr valign="top">
			<th >Url: </th>
			<td>	
				<input style="width: 95%;" value="'.$wp_holiday_url.'" name="wp_holiday_url" id="wp_holiday_url" type="text"><br/>
				if is void the default value is: bloginfo("rss_url") 	
				<br/>es. http://www.sitename.com
			</td>
		</tr>		
		
		<tr valign="top">
			<th >CSS: </th>
			<td>	
				<input style="width: 95%;" value="'.$wp_holiday_css.'" name="wp_holiday_css" id="wp_holiday_css" type="text"><br/>
				if is void the default value is: "text-align: center; margin: 2px auto;"
				<br/>es. border: dotted 1px #ccc;
		
			</td>
		</tr>	
		
		<tr valign="top">
			<th >Date range: <br/>(Coming Soon)</th>
			<td>	
				<input disabled value="'.$wp_holiday_date_start.'" name="wp_holiday_date_end" id="wp_holiday_date_start" type="text"> (Date from)<br/>
				<input disabled value="'.$wp_holiday_date_end.'" name="wp_holiday_date_end" id="wp_holiday_date_end" type="text"> (Date to)<br/>
				Set date range to show the image. If void no date limit.
		
			</td>
		</tr>	

		
		
		</table>
		
		</fieldset>
		<p class="submit" ><input type="submit" name="submit" value="update" /></p>
	</form>	  
	  
	<p >Developed by <a href="http://www.juliusdesign.net">Julius</a>, <a href="http://gioxx.org">Gioxx</a>, and <a href="http://maurizio.mavida.com">miziomon</a></p>
    </div>	
	
	';
}




function wp_holiday( ) {
	/* 
	06.08.2008 | maurizio
	this function print one random image from summer dir
	*/
	
	$wp_holiday_position = get_option('wp_holiday_position');
	if ( $wp_holiday_position != "hide" ) {	
		echo wp_holiday_filter();
		}
}

function get_wp_holiday( ) {
	/* 
	06.08.2008 | maurizio
	this function return the code of one random image from summer dir
	*/
	return wp_holiday_filter();
}

function wp_holiday_filter( $any='' ) {
	/* 06.08.2008 | maurizio
	*/

    global $wpdb, $tableposts;
	
	$wp_holiday_position = get_option('wp_holiday_position');	
	
	$wp_holiday_url = get_option('wp_holiday_url');
	$wp_holiday_css = get_option('wp_holiday_css');
	$wp_holiday_display = get_option('wp_holiday_display');
	$wp_holiday_theme = get_option('wp_holiday_theme');
	$wp_holiday_wish = get_option('wp_holiday_wish');
	$wp_holiday_slogan = get_option('wp_holiday_slogan');
	$wp_holiday_advice = get_option('wp_holiday_advice');


	$lang = get_option('wp_holiday_language');
	if ( $lang == "" ) {
		// default languange is en
		$lang = 'en';
	}

	switch ($lang) {
    case "en":
		
		if ($wp_holiday_wish == "") {
			$wp_holiday_wish = "Merry christmas and happy new year";
		}
		
		if ($wp_holiday_slogan == "") {
			$wp_holiday_slogan = "Don't lose even an article while you're on vacation!";
		}

		if ($wp_holiday_advice == "") {
			$wp_holiday_advice = "Subscribe to the free Feed RSS";
		}				
		
		
	    break;
		
    case "it":
		
		if ($wp_holiday_wish == "") {
			$wp_holiday_wish = "Buone Natale e Felice Anno Nuovo";
		}
		
		if ($wp_holiday_slogan == "") {
			$wp_holiday_slogan = "Non perdere neanche un articolo mentre sei in vacanza!";
		}

		if ($wp_holiday_advice == "") {
			$wp_holiday_advice = "Abbonati gratuitamente ai Feed RSS";
		}		

		
	    break;
    case "es":
		
		if ($wp_holiday_wish == "") {
			$wp_holiday_wish = "Feliz Navidad Y felices año Nuevo";
		}
		
		if ($wp_holiday_slogan == "") {
			$wp_holiday_slogan = "No perder artículos mientras usted está de vacaciones!";
		}

		if ($wp_holiday_advice == "") {
			$wp_holiday_advice = "Suscríbete al Feed RSS gratuitos";
		}	
		
	    break;
	}
	
		
	if ( $wp_holiday_display == "nohome" && is_front_page() ) {
		// check if we can diplay the image
		
	} else {
	
		$rss 	= get_bloginfo('rss_url');
		if ( $wp_holiday_url != "" ) {
			// custom url
			$rss = $wp_holiday_url;
		}
		
		$css = "height: 84px; clear:both; text-align: left; margin: 2px auto;";
		if ( $wp_holiday_css != "" ) {
			// custom url
			$css = $wp_holiday_css;
		}


		
		
		$path 	= get_bloginfo('url');
		//."/".$lang
		$plugin_dir	.= "/wp-content/plugins/wp-holidays/".$wp_holiday_theme;
		$this_dir = getcwd(); 
		$this_dir .= $plugin_dir;
		
		// move random selection to random-image.php ( wp-cache workaround )
		//$random_image = wp_holiday_getRandomFile($this_dir);

		//$random_image = "/random-image.php?token=" . time();
		$random_image = "/random-image.php";
		

		$image	 = "<img align='left' style='margin: 0 10px; border: 0px' src='$path$plugin_dir$random_image' >";

		/* modificato puntamento feed rss - gioxx 06.08.08 */
		$wp_holiday_box = "<div class='wp_holiday' style='$css' >
							<a href='$rss' >$image</a>
							<a href='$rss' style='font-family: Arial '>
								<br/>
								<div style='font-size: 22px; color: #E52027; font-weight: bold;' id='wp_holiday_wish'>$wp_holiday_wish</div>
								<div style='font-size: 14px; color: #2382FA;' id='wp_holiday_slogan'>$wp_holiday_slogan</div>
								<div style='font-size: 16px; color: #E52027;' id='wp_holiday_advice'>$wp_holiday_advice</div>
							</a>
							</div>";		
		
		
		
		if ( $wp_holiday_position == "after-post" ) {
			$any .= $wp_holiday_box;
		} else {
			$any = preg_replace("/\[wp_holiday\]/", $wp_holiday_box, $any);
		}
		
		
	
	}
	
	$any .= "<!-- wpholiday -->";
	return $any;
}



function wp_holiday_check_plugin_version($plugin) {

      global $plugindir, $wp_holiday_localversion, $wp_holiday_uri;
      
      if (strpos($plugin, 'wp-holidays.php') !== false) {
          
		  //$status = themedrive_getinfo();
          //$theVersion = $status[1];
          //$theMessage = $status[3];
		  
		  $theVersion = wp_holiday_getinfo();
          
          if ((version_compare(strval($theVersion), strval($wp_holiday_localversion), '>') == 1)) {
              $msg = "Latest version available <strong>" . $theVersion . "</strong> |
							<a href='" . $wp_holiday_uri . "'>download now</a>
							<br /> ";

              echo '<td colspan="5" class="plugin-update">' . $msg . '</td>';
          } else {
              return;
          }
      }
  }
	

function wp_holiday_getinfo() {
	
      $checkfile = "http://svn.wp-plugins.org/wp-holidays/trunk/version.txt";
	  $vcheck = wp_remote_fopen($checkfile);
      return $vcheck;
  }



/* plugin registration */
register_activation_hook(__FILE__, wp_holiday_activation);
register_deactivation_hook(__FILE__, wp_holiday_deactivation); 

add_action('admin_menu', 'wp_holiday_menu');
add_action('after_plugin_row', 'wp_holiday_check_plugin_version');


/* check the hook */
$wp_holiday_position = get_option('wp_holiday_position');
if ( $wp_holiday_position == "after-post" or $wp_holiday_position == "shortcode" ) {
	add_filter('the_content', 'wp_holiday_filter');	
}
	
	
?>