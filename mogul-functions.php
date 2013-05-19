<?php
/*
Plugin Name: Mogul Custom Functions
Plugin URI: http://www.mogul.co.nz
Description: A set of Custom Functions for Mogul sites
Version: 1.1.5
Author: Bren Murrell @ Mogul
Author URI: http://www.mogul.co.nz
License: GPLv3
*/


/* 
* Function to output <a href="permalink">Title</a> for a given post ID
*/


function mog_quik_title($mog_quik_title_id = NULL, $noecho_quik_title = NULL) {
	//untested : if no id specified, find current page ID
	if (!$mog_quik_title_id) {
		$mog_quik_title_id = mog_get_outside_id();
	}
	$quik_title_output = "<a href=\"".get_permalink($mog_quik_title_id)."\">".get_the_title($mog_quik_title_id)."</a>";
	//if noecho_quik_title is TRUE, then RETURN the value for handling
	if ($noecho_quik_title) {
		return $quik_title_output;
	//else echo teh output (standard)
	} else {
		echo $quik_title_output;
	}
}


/*
* This function detects whether a given page is an ancestor of the current page (by ID)
* Use in conjunction with get_id_outside() (below) as:
* is_in_hierarchy(mog_get_outside_id(),2)

[ This could easily be replaced by the array function used in sidebar-children (by Mogul) - this would loop til complete ]
*/

function mog_in_hierarchy($current_page,$comparison) {
	$currentID = $current_page;
	//set initial $currentParent variable (else while loop won't work)
	$currentPost = get_post($currentID);
	$currentParent = $currentPost->post_parent;
	
	if($currentID == $comparison) {
		//current page is the comparison so return true
		return true;
	} else {
		//otherwise, traverse up to top level page to find if any ancestor pages match $comparison
		while ($currentParent != 0) {
			//get post data using $currentPostID
			$currentPost = get_post($currentID);
			
			//store parent of current post
			$currentParent = $currentPost->post_parent;
			if ($currentParent == $comparison) {
				return true;
			}
			$currentID = $currentParent;
		}
	}
}

/* this function is for backwards compatability - spelling error in function name, Use mog_in_hierarchy instead */
function mog_in_heirarchy($current_page,$comparison) {
	$currentID = $current_page;
	//set initial $currentParent variable (else while loop won't work)
	$currentPost = get_post($currentID);
	$currentParent = $currentPost->post_parent;
	
	if($currentID == $comparison) {
		//current page is the comparison so return true
		return true;
	} else {
		//otherwise, traverse up to top level page to find if any ancestor pages match $comparison
		while ($currentParent != 0) {
			//get post data using $currentPostID
			$currentPost = get_post($currentID);
			
			//store parent of current post
			$currentParent = $currentPost->post_parent;
			if ($currentParent == $comparison) {
				return true;
			}
			$currentID = $currentParent;
		}
	}
}



/*
* Retrieves ID of current page - used in sidebars or outside of loop
*/

function mog_get_outside_id() {
	global $wp_query;
	$thePostID = $wp_query->post->ID;
	return $thePostID;
}

/*
* Existing long excerpt function used to retrieve a short snippet of a page or post
*/

function mog_long_excerpt($le_len = 276, $strip_html = true) {
    ob_start();
    the_content();
    $content = ob_get_clean();
    $longexcerpt = $content ;
    $longexcerpt = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $longexcerpt);
    $longexcerpt = preg_replace('%<p\s+class="wp-caption-text">.*?</p>%s', '', $longexcerpt);
    if ($strip_html) {
        // remove <p></p> tags
        $longexcerpt = str_replace('<p>','',$longexcerpt);
        $longexcerpt = str_replace('</p>',' ',$longexcerpt);
        // remove all other html tags (eg <img>)
        $longexcerpt = strip_tags($longexcerpt);  
    }
    // take first n characters
    $longexcerpt = substr($longexcerpt,0,$le_len);
// remove SHARETHIS
    $sharethis_pos = strpos($longexcerpt, "SHARETHIS");
    if ($sharethis_pos) {
 $longexcerpt = substr($longexcerpt,0,$sharethis_pos);
}
    // remove part words
    $pos = strrpos($longexcerpt, " ");
    $longexcerpt = substr($longexcerpt,0,$pos);
    // check for inappropraite chars ending the string
    $rem_char = array(',','.',':',';','"','-');
    foreach ($rem_char as $rc) {
        $lc_len = strlen($longexcerpt);
        $lc = substr($longexcerpt,$lc_len-1,1);
        if ($lc == $rc) {
            $longexcerpt = substr($longexcerpt,0,$lc_len-1);
        }
    }
    // write the result to the screen
    echo($longexcerpt);
   
}
/*
* Displays a sidebar showing the top most parent page as the nav title *
* */

function mog_simple_sidebar($postID = NULL){
    // eg 1413
    if(!$postID) {
	$postID = mog_get_outside_id();
    }
    $currentPostID = $postID;
    
    while (!$ultimateParent) {
        //get post using $currentPostID
        $currentPost = get_post($currentPostID);
        //store parent of current post
        $currentParent = $currentPost->post_parent;
        
        if ($currentParent == 0) {
            //if this post has no parent, set the top level parent
            $ultimateParent = $currentPostID;
        } else {
            //otherwise set currentpostid to current parent (move up a level) and try again
            $currentPostID = $currentParent;
        }
    }
    $simpleTitle = get_the_title($ultimateParent);
    $simpleSidebar = wp_list_pages('child_of='.$ultimateParent.'&title_li=&echo=0'); 
    echo "<h3 class='widgettitle'>".$simpleTitle."</h3><ul class='simpleSidebar'>".$simpleSidebar."</ul>";
    
}
add_action( 'widgets_init', 'mog_ss_widget' );function mog_ss_widget() {
	register_widget( 'Mogul_SimpleSidebar_Widget' );
}
class Mogul_SimpleSidebar_Widget extends WP_Widget {
	function Mogul_SimpleSidebar_Widget() {
		// widget actual processes
		$widget_ops = array( 'classname' => 'simple-sidebar', 'description' => __('A simple widget that displays a list of descendent pages for the current pages\' ultimate parent.', 'simple-sidebar') );

		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'simple-sidebar-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'simple-sidebar-widget', __('Simple Sidebar Widget', 'simple-sidebar'), $widget_ops, $control_ops );
	}

	function form($instance) {
		// outputs the options form on admin ?>
		<p>This widget has no settings... yet</p>	
		<?php
		
		
	}

	function update($new_instance, $old_instance) {
		// processes widget options to be saved
	}

	function widget($args, $instance) {
		// outputs the content of the widget
		extract( $args );
		//find ultimate parent page (top level)
		$postID = mog_get_outside_id();
		$currentPostID = $postID;
		$currentPost = get_post($currentPostID);
		$currentPostType = $currentPost->post_type;
		if($currentPostType == 'page') {
		//do until the currentPage has no parent
		    while (!$ultimateParent) {
			//get post using $currentPostID
			$currentPost = get_post($currentPostID);
			//store parent of current post
			$currentParent = $currentPost->post_parent;
			if ($currentParent == 0) {
			    //if this post has no parent, set the top level parent
			    $ultimateParent = $currentPostID;
			} else {
			    //otherwise set currentpostid to current parent (move up a level) and try again
			    $currentPostID = $currentParent;
			}
		    }
		}
		////only show this if the current post is a page
		if($ultimateParent) {
		    $simpleTitle = get_the_title($ultimateParent);
		    $simpleSidebar = wp_list_pages('child_of='.$ultimateParent.'&title_li=&echo=0');
		    echo $before_widget;
		    echo $before_title . $simpleTitle . $after_title;
		    echo "<ul>".$simpleSidebar."</ul>";
		    echo $after_widget;
		}
	}

}
?>
