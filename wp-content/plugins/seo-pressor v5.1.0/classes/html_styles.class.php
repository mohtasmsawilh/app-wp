<?php
if (!class_exists('WPPostsRateKeys_HtmlStyles')) {
	class WPPostsRateKeys_HtmlStyles
	{
	    /**
         * Return the number of keywords as Bold
         * 
         * @param	array	$keyword_arr
         * @param	string	$content
         * @return 	int
         * @static 
         */
        static function how_many_keyword_bold($keyword_arr,$content) {
        	$pieces = WPPostsRateKeys_Keywords::get_pieces_by_keyword($keyword_arr,$content);
        	
        	// Checks for each piece of code, is needed the total
        	$to_return = 0;
        	
        	for ($i=0;$i<(count($pieces)-1);$i++) {
        		 
        		$result = WPPostsRateKeys_HtmlStyles::if_some_style_in_pieces($pieces, $i
        				, WPPostsRateKeys_HtmlStyles::get_bold_styles(), $keyword_arr);
        		if ($result) {
        			$to_return++;
        		}
        	}
        	
        	return $to_return;
        }
        
	    /**
         * Return the number of keywords as italic
         * 
         * @param	array	$keyword_arr
         * @param	string	$content
         * @return 	bool
         * @static 
         */
        static function how_many_keyword_italic($keyword_arr,$content) {
        	$pieces = WPPostsRateKeys_Keywords::get_pieces_by_keyword($keyword_arr,$content);
        	 
        	// Checks for each piece of code, is needed the total
        	$to_return = 0;
        	 
        	for ($i=0;$i<(count($pieces)-1);$i++) {
        	
        		$result = WPPostsRateKeys_HtmlStyles::if_some_style_in_pieces($pieces, $i
        						, WPPostsRateKeys_HtmlStyles::get_italic_styles(), $keyword_arr);
        		if ($result) {
        			$to_return++;
        		}
        	}
        	 
        	return $to_return;
        }
        
	    /**
         * Return the number of keywords as underline
         * 
         * //No used DOMDocument and XPath loadHTML due to http://stackoverflow.com/questions/13464392/using-domdocument-and-domxpath-how-can-i-ignore-some-characters-for-the-match
         * 
         * @param	array	$keyword_arr
         * @param	string	$content
         * @return 	bool
         * @static 
         */
        static function how_many_keyword_underline($keyword_arr,$content) {
        	
        	
        	$pieces = WPPostsRateKeys_Keywords::get_pieces_by_keyword($keyword_arr,$content);
        	 
        	// Checks for each piece of code, is needed the total
        	$to_return = 0;
        	 
        	for ($i=0;$i<(count($pieces)-1);$i++) {
        	
        		$result = WPPostsRateKeys_HtmlStyles::if_some_style_in_pieces($pieces, $i
        						, WPPostsRateKeys_HtmlStyles::get_underline_styles(), $keyword_arr);
        		if ($result) {
        			$to_return++;
        		}
        	}
        	 
        	return $to_return;
        }
        
	    /**
         * Return all the tags allowed in the Image Decoration structure
         * 
         * To be used as Titles and Alts attributes
         * 
         * @return 	array
         * @static 
         */
        static function get_tags_for_images_decoration() {
        	return array(
        			'keyword' => array('%keyword%','SEOPressor Keyword')
        			,'post_title' => array('%post_title%','Post Title')
        			,'random_post_tag' => array('%random_post_tag%','A random Tag from Post')
        			,'random_post_category' => array('%random_post_category%','A random Category from Post')
        			);
        }
        
	    /**
         * Return all the styles for bold, underline or italic
         * 
         * @return 	array
         * @static 
         */
        static function get_styles() {
        	
        	return array(
        			array('<b>','</b>','bold')
        			, array('<strong>','</strong>','bold')
        			, array('style','font-weight: bold','bold')
        			, array('<i>','</i>','italic')
        			, array('<em>','</em>','italic')
        			, array('style','font-style: italic','italic')
        			, array('<u>','</u>','underline')
        			, array('style','text-decoration: underline','underline')
        			, array('<h1','</h1>','H1') // without > to allow define attributes
        			, array('<h2','</h2>','H2') // without > to allow define attributes
        			, array('<h3','</h3>','H3') // without > to allow define attributes
        		);
        }
        
	    /**
         * Return all the styles to be check before apply an internal link
         * 
         * @return 	array
         * @static 
         */
        static function get_styles_not_allowed_in_links() {
        	// without > to allow define attributes
        	return array(
        			array('<h1','</h1>','H1') 
        			, array('<h2','</h2>','H2')
        			, array('<h3','</h3>','H3')
        			, array('<a','</a>','a')
        			, array('<img','>','img')
        			, array('<title','</title>','title')
        		);
        }
        
	    /**
         * Return all the h_styles
         * 
         * @param 	string	$h			can be H1, H2 or H3
         * @return 	array
         * @static 
         */
        static function get_h_styles($h) {
        	$all_styles = self::get_styles();
        	$return = array();
        	
        	foreach ($all_styles as $style) {
        		if ($style[2]==$h)
        			$return[] = $style;
        	}
        	
        	return $return;
        }
        
	    /**
         * Return all the italic_styles
         * 
         * @return 	array
         * @static 
         */
        static function get_italic_styles() {
        	$all_styles = self::get_styles();
        	$return = array();
        	
        	foreach ($all_styles as $style) {
        		if ($style[2]=='italic')
        			$return[] = $style;
        	}
        	
        	return $return;
        }
        
	    /**
         * Return all the bold_styles
         * 
         * @return 	array
         * @static 
         */
        static function get_bold_styles() {
        	$all_styles = self::get_styles();
        	$return = array();
        	
        	foreach ($all_styles as $style) {
        		if ($style[2]=='bold')
        			$return[] = $style;
        	}
        	
        	return $return;
        }
        
	    /**
         * Return all the underline_styles
         * 
         * @return 	array
         * @static 
         */
        static function get_underline_styles() {
        	$all_styles = self::get_styles();
        	$return = array();
        	
        	foreach ($all_styles as $style) {
        		if ($style[2]=='underline')
        			$return[] = $style;
        	}
        	
        	return $return;
        }
        
	    /**
         * Apply the bold HTML style
         * 
         * @param 	string	$keyword
         * @return 	string
         * @static 
         */
        static function apply_bold_styles($keyword) {
        	$settings = WPPostsRateKeys_Central::get_md5_settings(TRUE);
        	
        	$design_arr = self::get_bold_styles();
        	$selected_design_id = $settings['bold_style_to_apply'];
        	$selected_design = $design_arr[$selected_design_id];
        	
        	if ($selected_design[0]=='style') {
        		$html_before = '<span style="' . $selected_design[1] . '">'; 
        		$html_after = '</span>';
        	}
        	else {
        		$html_before = $selected_design[0]; 
        		$html_after = $selected_design[1];
        	}
        	
        	return $html_before . $keyword . $html_after;
        }
        
	    /**
         * Apply the italic HTML style
         * 
         * @param 	string	$keyword
         * @return 	string
         * @static 
         */
        static function apply_italic_styles($keyword) {
        	$settings = WPPostsRateKeys_Central::get_md5_settings(TRUE);
        	$design_arr = self::get_italic_styles();
        	$selected_design_id = $settings['italic_style_to_apply'];
        	$selected_design = $design_arr[$selected_design_id];
        	
        	if ($selected_design[0]=='style') {
        		$html_before = '<span style="' . $selected_design[1] . '">'; 
        		$html_after = '</span>';
        	}
        	else {
        		$html_before = $selected_design[0]; 
        		$html_after = $selected_design[1];
        	}
        	
        	return $html_before . $keyword . $html_after;
        }
        
	    /**
         * Apply the underline HTML style
         * 
         * @param 	string	$keyword
         * @return 	string
         * @static 
         */
        static function apply_underline_styles($keyword) {
        	$settings = WPPostsRateKeys_Central::get_md5_settings(TRUE);
        	$design_arr = self::get_underline_styles();
        	$selected_design_id = $settings['underline_style_to_apply'];
        	$selected_design = $design_arr[$selected_design_id];
        	
        	if ($selected_design[0]=='style') {
        		$html_before = '<span style="' . $selected_design[1] . '">'; 
        		$html_after = '</span>';
        	}
        	else {
        		$html_before = $selected_design[0]; 
        		$html_after = $selected_design[1];
        	}
        	
        	return $html_before . $keyword . $html_after;
        }
        
	    /**
         * Check if the Internal Link can be applied
         * 
         * Checks too:
         * - if the keyword is inside a tag
         * - if the keyword is inside a shortcode
         * - if inside of some of the follow tags: <a>,<img>,<title>,<h1>,<h2>,<h3>
         * 
         * @param	string	$content
         * @param	string	$keyword
         * @param	array	$keyword_arr
         * @return 	bool
         * @static 
         */
        static function if_ready_to_apply_internal_link($content,$keyword_arr,$key_pos=1) {
			$pieces = WPPostsRateKeys_Keywords::get_pieces_by_keyword($keyword_arr,$content);
			
			$before_key_pos = $key_pos - 1;
			
			if (count($pieces)>$key_pos) {
				$array_to_check = self::get_styles_not_allowed_in_links();
				$some_style = self::if_some_style_in_pieces($pieces,$before_key_pos,$array_to_check,$keyword_arr);
				
				if ($some_style) { // If true, is inside a not allowed tag
					return false;
				}
				else {
					$in_tag_attr = self::keyword_in_tag_attribute($pieces,$before_key_pos);
					if ($in_tag_attr) {
						return false;
					}
					else {
						$in_shortcode = self::keyword_in_shortcode($pieces,$before_key_pos);
						
						if ($in_shortcode)
							return false;
					}
				}
			}
			
        	return true;
        }
        
	    /**
         * Check if has some of the three styles applied
         * 
         * Checks too:
         * - if the keyword is inside a tag
         * - if the keyword is inside a shortcode
         * 
         * @param	string	$content
         * @param	string	$keyword
         * @param	array	$keyword_arr
         * @return 	bool
         * @static 
         */
        static function if_some_style_or_in_tag_attribute($content,$keyword_arr,$key_pos=1) {
			$pieces = WPPostsRateKeys_Keywords::get_pieces_by_keyword($keyword_arr,$content);
			
			$before_key_pos = $key_pos - 1;
			
			if (count($pieces)>$key_pos) {
				$some_style = self::if_some_style_in_pieces($pieces,$before_key_pos,array(),$keyword_arr);
				if ($some_style) { // If true, so some style is applied
					return $some_style;
				}
				else {
					$in_tag = self::keyword_in_tag_attribute($pieces,$before_key_pos);
					if ($in_tag) {
						return array(TRUE,'in_tag');
					}
					else {
						$in_shortcode = self::keyword_in_shortcode($pieces,$before_key_pos);
						
						if ($in_shortcode)
							return array(TRUE,'in_shortcode');
					}
				}
			}
			
        	return FALSE;
        }
        
        /**
         * Check if has the keyword is in a shortcode
         * 
         * @param	array	$pieces
         * @param	int		$before_key_pos
         * @return 	bool
         * @static 
         */
        static function keyword_in_shortcode($pieces,$before_key_pos) {
        	
        	// Make piece 1 as the join of all pieces before the current keyword to check
        	$piece1 = '';
        	for ($i=0;$i<=$before_key_pos;$i++) {
        		$piece1 .= $pieces[$i];
        	}
        	
        	if (WPPostsRateKeys_Settings::support_multibyte()) {
        		// Check for keyword inside shortcode
        		$last_less_than = mb_strrpos($piece1,'[',null,'UTF-8');
        		if ($last_less_than!==FALSE) {
        			$last_bigger_than = mb_strrpos($piece1,']',null,'UTF-8');
        			if ($last_bigger_than===FALSE || $last_bigger_than<$last_less_than)
        				return TRUE;
        		}
        	}
        	else {
        		// Check for keyword inside shortcode
        		$last_less_than = strrpos($piece1,'[');
        		if ($last_less_than!==FALSE) {
        			$last_bigger_than = strrpos($piece1,']');
        			if ($last_bigger_than===FALSE || $last_bigger_than<$last_less_than)
        				return TRUE;
        		}
        	}
        	
        	return FALSE;
        }
        
        /**
         * Check if has the keyword is in a tag
         * 
         * @param	array	$pieces
         * @param	int		$before_key_pos
         * @return 	bool
         * @static 
         */
        static function keyword_in_tag_attribute($pieces,$before_key_pos) {
        	
        	// Make piece 1 as the join of all pieces before the current keyword to check
        	$piece1 = '';
        	for ($i=0;$i<=$before_key_pos;$i++) {
        		$piece1 .= $pieces[$i];
        	}
        	
        	// Check for keyword in alt or href attribute
        	$last_less_than = strrpos($piece1,'<');
        	if ($last_less_than!==FALSE) {
        		$last_bigger_than = strrpos($piece1,'>');
        		if ($last_bigger_than===FALSE || $last_bigger_than<$last_less_than)
        			return TRUE;
        	}
        	
        	return FALSE;
        }
        
        
	    /**
         * Get the content of Alt or Title attribute
         * 
         * 
         * @param	html	$sub_piece
         * @return 	string	this include the delimiter
         * @static 
         */
        static function get_content_in_alt_or_title($sub_piece,$alt_or_title_att='alt') {
        	
        	$sub_piece = '<img' . $sub_piece . '>';
        	
        	@$doc=new DOMDocument();
        	
        	if (WPPostsRateKeys_Settings::support_multibyte()) {
        		$sub_piece = mb_convert_encoding($sub_piece, 'HTML-ENTITIES', 'UTF-8');
        	}
        	
			@$doc->loadHTML($sub_piece);
			@$xpath = new DOMXPath(@$doc);
			@$images=$xpath->query('//img');
			
			/*@var $images DOMNodeList */
			if ($images->length>0) {
				
				/*@var $current_img DOMElement */
				$current_img = $images->item(0);
				if ($alt_or_title_att=='alt') {
					return (string) $current_img->getAttribute('alt');
				}
				else {
					return (string) $current_img->getAttribute('title');
				}
			}
			else {
				return '';
			}			
        }
        
	    /**
         * If user select this settings: automatic add_rel_nofollow_image_links
         * 
         * An image link is a link with an image as content
         * 
         * @param	html	$content
         * @param	array	$settings
         * 
         * @return 	html
         * @static 
         */
        static function add_rel_nofollow_image_links($content,$settings) {
        	
        	if ($settings['auto_add_rel_nofollow_img_links']==='1') {
        		
        		// Go through all links tags and check if is external with do follow, then add the nofollow
        		$matches = array();
        	
        		preg_match_all('/<a\s[^>]*href=\"([^\"]*)\"[^>]*>(.*)<\/a>/siU',$content,$matches);
        	
        		// In $matches[0] stores the whole tag a, in $matches[1] stores the href URLs
        		$index = 0;
        		foreach ($matches[0] as $tags) {
        			$a_content = $matches[2][$index]; // To check if is a img
        			
        			if (strpos($a_content, '<img')!==FALSE) {
        				
        				if (WPPostsRateKeys_Settings::support_multibyte()) {
        					if (mb_substr_count($tags,'rel="nofollow"','UTF-8')==0
        							&& mb_substr_count($tags,'rel=nofollow','UTF-8')==0
        							&& mb_substr_count($tags,'rel="no follow"','UTF-8')==0
        					) {
        						$is_dofollow = TRUE;
        					}
        				}
        				else {
        					if (substr_count($tags,'rel="nofollow"')==0
        							&& substr_count($tags,'rel=nofollow')==0
        							&& substr_count($tags,'rel="no follow"')==0
        					) {
        						$is_dofollow = TRUE;
        					}
        				}
        				
        				if ($is_dofollow) {
        					// Add rel="nofollow" attribute
        					 
        					$old_a_tag = $tags;
        					$new_tag = str_replace('<a ','<a rel="nofollow" ',$old_a_tag);
        					 
        					// Replace in content Old tag with New tag
        					$content = str_replace($old_a_tag,$new_tag,$content);
        				}
	        		}
	        		$index++;
	        	}
        	}
        	 
        	return $content;
        }
        
	    /**
         * If user select to force it: automatic add_rel_nofollow_external_links
         * 
         * @param	html	$content
         * @param	array	$settings
         * 
         * @return 	html
         * @static 
         */
        static function add_rel_nofollow_external_links($content,$settings) {
        	
        	if ($settings['allow_automatic_adding_rel_nofollow']) {
        		$wp_url = get_bloginfo('wpurl');
        	
	        	$wp_url_clean = str_replace('http://www.','',$wp_url);
	        	$wp_url_clean = str_replace('https://www.','',$wp_url_clean);
	        	$wp_url_clean = str_replace('https://','',$wp_url_clean);
	        	$wp_url_clean = str_replace('http://','',$wp_url_clean);
        		
	        	// Go through all links tags and check if is external with do follow, then add the nofollow 
	        	$matches = array();
	        	
	        	preg_match_all('/<a\s[^>]*href=\"([^\"]*)\"[^>]*>(.*)<\/a>/siU',$content,$matches);
	        	
	        	// In $matches[0] stores the whole tag a, in $matches[1] stores the href URLs
	        	$index = 0;
	        	foreach ($matches[0] as $tags) {
	        		$url = $matches[1][$index];
	        		
	        		// Check if is external
	        		$is_external = FALSE;
	        		
	        		// Clean from http://www. and http://
	        		$url_clean = str_replace('http://www.','',$url);
	        		$url_clean = str_replace('https://www.','',$url_clean);
	        		$url_clean = str_replace('https://','',$url_clean);
	        		$url_clean = str_replace('http://','',$url_clean);
	        		
	        		if ((strpos($url,'http://')===0 || strpos($url,'https://')===0) && strpos($url_clean,$wp_url_clean)!==0) // Url of code begins with https:// or http://
        				$is_external = TRUE;
	        		
	        		// Check if is do follow
	        		$is_dofollow = FALSE;
	        		if (WPPostsRateKeys_Settings::support_multibyte()) {
	        			if (mb_substr_count($tags,'rel="nofollow"','UTF-8')==0
	        					&& mb_substr_count($tags,'rel=nofollow','UTF-8')==0
	        					&& mb_substr_count($tags,'rel="no follow"','UTF-8')==0
	        			) {
	        				$is_dofollow = TRUE;
	        			}
	        		}
	        		else {
		        		if (substr_count($tags,'rel="nofollow"')==0
		        			&& substr_count($tags,'rel=nofollow')==0
		        			&& substr_count($tags,'rel="no follow"')==0
		        			) {
		        			$is_dofollow = TRUE;
		        		}
	        		}
	        		
	        		if ($is_external && $is_dofollow) {
	        			// Add rel="nofollow" attribute
	        			
	        			$old_a_tag = $tags;
	        			$new_tag = str_replace('<a ','<a rel="nofollow" ',$old_a_tag);
	        			
	        			// Replace in content Old tag with New tag
	        			$content = str_replace($old_a_tag,$new_tag,$content);
	        		}
	        			
	        		$index++;
	        	} 
        	}
        	
        	return $content;
        }
        
	    /**
         * Decorates Images in the Post Content
         * 
         * Used to change the Alt and Title tags accoding to settings selected by user
         * 
         * @param	html	$new_content
         * @param	array	$keyword_arr
         * @param	int		$post_id
         * @param	array	$settings
         * @return 	html
         * @static 
         */
        static function decorates_images($new_content, $keyword_arr,$post_id,$settings) {
        	
        	// Use the First Keyword to decorate
        	$post_keyword = $keyword_arr[0];
        	
        	// Get settings and initialize data
        	$image_alt_tag_decoration = $settings['image_alt_tag_decoration'];
        	$image_title_tag_decoration = $settings['image_title_tag_decoration'];
        	$alt_value = '';
        	$title_value = '';
        	$tags_for_images_decoration_arr = self::get_tags_for_images_decoration();
        	
        	/*
        	 * Get possible common data
        	 */
        	// Check Alt
        	$alt_attribute_structure = $settings['alt_attribute_structure'];
        	
        	if (WPPostsRateKeys_Settings::support_multibyte()) {        		
        		$post_title_in_alt = FALSE;
        		if (mb_substr_count($alt_attribute_structure, $tags_for_images_decoration_arr['post_title'][0],'UTF-8')) {
        			$post_title_in_alt = TRUE;
        		}
        		$random_post_tag_in_alt = FALSE;
        		if (mb_substr_count($alt_attribute_structure, $tags_for_images_decoration_arr['random_post_tag'][0],'UTF-8')) {
        			$random_post_tag_in_alt = TRUE;
        		}
        		$random_post_category_in_alt = FALSE;
        		if (mb_substr_count($alt_attribute_structure, $tags_for_images_decoration_arr['random_post_category'][0],'UTF-8')) {
        			$random_post_category_in_alt = TRUE;
        		}
        		// Check Title
        		$title_attribute_structure = $settings['title_attribute_structure'];
        		$post_title_in_title = FALSE;
        		if (mb_substr_count($title_attribute_structure, $tags_for_images_decoration_arr['post_title'][0],'UTF-8')) {
        			$post_title_in_title = TRUE;
        		}
        		$random_post_tag_in_title = FALSE;
        		if (mb_substr_count($title_attribute_structure, $tags_for_images_decoration_arr['random_post_tag'][0],'UTF-8')) {
        			$random_post_tag_in_title = TRUE;
        		}
        		$random_post_category_in_title = FALSE;
        		if (mb_substr_count($title_attribute_structure, $tags_for_images_decoration_arr['random_post_category'][0],'UTF-8')) {
        			$random_post_category_in_title = TRUE;
        		}
        	}
        	else {
	        	$post_title_in_alt = FALSE;
	        	if (substr_count($alt_attribute_structure, $tags_for_images_decoration_arr['post_title'][0])) {
	        		$post_title_in_alt = TRUE;
	        	}
	        	$random_post_tag_in_alt = FALSE;
	        	if (substr_count($alt_attribute_structure, $tags_for_images_decoration_arr['random_post_tag'][0])) {
	        		$random_post_tag_in_alt = TRUE;
	        	}
	        	$random_post_category_in_alt = FALSE;
	        	if (substr_count($alt_attribute_structure, $tags_for_images_decoration_arr['random_post_category'][0])) {
	        		$random_post_category_in_alt = TRUE;
	        	}
	        	// Check Title
	        	$title_attribute_structure = $settings['title_attribute_structure'];
	        	$post_title_in_title = FALSE;
	        	if (substr_count($title_attribute_structure, $tags_for_images_decoration_arr['post_title'][0])) {
	        		$post_title_in_title = TRUE;
	        	}
	        	$random_post_tag_in_title = FALSE;
	        	if (substr_count($title_attribute_structure, $tags_for_images_decoration_arr['random_post_tag'][0])) {
	        		$random_post_tag_in_title = TRUE;
	        	}
	        	$random_post_category_in_title = FALSE;
	        	if (substr_count($title_attribute_structure, $tags_for_images_decoration_arr['random_post_category'][0])) {
	        		$random_post_category_in_title = TRUE;
	        	}
        	}
        	
        	// Get Post data
        	if ($post_title_in_alt || $post_title_in_title) {
        		$post_title = WPPostsRateKeys_Central::get_filtered_title($post_id);
        	}
        	if ($random_post_tag_in_alt || $random_post_tag_in_title) {
        		$post_tags = wp_get_post_tags($post_id,array('fields'=>'names'));
        	}
        	if ($random_post_category_in_alt || $random_post_category_in_title) {
        		$post_categories = wp_get_post_categories($post_id,array('fields'=>'names'));
        	}
        	
        	// Get the value in depends on the structure
        	if ($image_alt_tag_decoration!='none') {
        		$alt_value = $alt_attribute_structure;
        		
        		// Replace tags
        		$alt_value = str_replace($tags_for_images_decoration_arr['keyword'][0], $post_keyword, $alt_value);
        		if ($post_title_in_alt) {
        			$alt_value = str_replace($tags_for_images_decoration_arr['post_title'][0], $post_title, $alt_value);
        		}
        		if ($random_post_tag_in_alt) {
        			$random_tag = array_rand(array_flip($post_tags));
        			
        			$alt_value = str_replace($tags_for_images_decoration_arr['random_post_tag'][0], $random_tag, $alt_value);
        		}
        		if ($random_post_category_in_alt) {
        			$random_cat = array_rand(array_flip($post_categories));
        			
        			$alt_value = str_replace($tags_for_images_decoration_arr['random_post_category'][0], $random_cat, $alt_value);
        		}
        	}
        	
        	if ($image_title_tag_decoration!='none') {
        		$title_value = $title_attribute_structure;
        		
        		// Replace tags
        		$title_value = str_replace($tags_for_images_decoration_arr['keyword'][0], $post_keyword, $title_value);
        		if ($post_title_in_title) {
        			$title_value = str_replace($tags_for_images_decoration_arr['post_title'][0], $post_title, $title_value);
        		}
        		if ($random_post_tag_in_title) {
        			$random_tag = array_rand(array_flip($post_tags));
        			
        			$title_value = str_replace($tags_for_images_decoration_arr['random_post_tag'][0], $random_tag, $title_value);
        		}
        		if ($random_post_category_in_title) {
        			$random_cat = array_rand(array_flip($post_categories));// No need to access name property because the function already return the name 
        			
        			$title_value = str_replace($tags_for_images_decoration_arr['random_post_category'][0], $random_cat, $title_value);
        		}
        	}
        	
        	if ($image_alt_tag_decoration!='none' || $image_title_tag_decoration!='none') {
        		$new_content = self::decorate_image_tag_atts($new_content,$alt_value, $title_value, $image_alt_tag_decoration, $image_title_tag_decoration);
        	}
        	
        	return $new_content;
        }
        
	    /**
         * If user select to force it: automatic adding of alt=keyword
         * 
         * to all images in the content that do not have alt tags 
         * 
         * @param	html	$content				the content to search in
         * @param	string	$alt_value				the value to be set in the Alt attribute
         * @param	string	$title_value			the value to be set in the Title attribute
         * @param	string	$alt_decoration_type	can be "none", "empty" or "all"
         * @param	string	$title_decoration_type	can be "none", "empty" or "all"
         * 
         * @return 	html
         * @static 
         */
        static private function decorate_image_tag_atts($content, $alt_value, $title_value, $alt_decoration_type, $title_decoration_type) {

        	// explode the string by <img begginin tag
        	$str_arr = explode('<img',$content);
        	$new_str_arr = array();
        		
        	for ($i=0;$i<count($str_arr);$i++) { 
        		if ($i==0) // Ignore the first piece of html because there isn't no <img tag
        			$new_str_arr[] = $str_arr[$i];
        		else {
        			$piece = $str_arr[$i];
        			
        			if (WPPostsRateKeys_Settings::support_multibyte()) {
        				$pos_bigger_than = mb_strpos($piece,'>',null,'UTF-8');
        			}
        			else {
        				$pos_bigger_than = strpos($piece,'>'); // Finding the next >, is the one that close the <img tag
        			}
        			if ($pos_bigger_than) {
        				// Check if between the beginning of the $piece up to the next > possition is an alt tag
        				
        				if (WPPostsRateKeys_Settings::support_multibyte()) {
        					$sub_piece = mb_substr($piece,0,$pos_bigger_than,'UTF-8');
        				}
        				else {
        					$sub_piece = substr($piece,0,$pos_bigger_than);
        				}
	        				
        				/*
        				 * Image Alt
        				 */
        				if ($alt_decoration_type!='none') {
	        				
        					if (WPPostsRateKeys_Settings::support_multibyte()) {
        						if (mb_substr_count($sub_piece,' alt=','UTF-8')==0
        								&& mb_substr_count($sub_piece,' alt =','UTF-8')==0
        						) { // Haven't alt tag, so ADD it
        						
        							$piece = ' alt="' . $alt_value . '"' . $piece;
        							// Now the sub piece is the piece
        							$sub_piece = $piece;
        						}
        						else {
        							// Check if has alt tag but is empty, or if the option of "all" is selected
        							$inside_alt_tag = trim(self::get_content_in_alt_or_title($sub_piece),"'\" \\");
        							if ($inside_alt_tag=='' || $alt_decoration_type=='all'){
        								// replace old tag value with new one
        								// Take in care the case in this the "alt" is separated to the "="
        								$piece = str_ireplace('alt =', 'alt=', $piece);
        									
        								$piece = str_ireplace(' alt="' . $inside_alt_tag . '"', ' alt="' . $alt_value . '"', $piece);
        								$piece = str_ireplace(" alt='" . $inside_alt_tag . "'", ' alt="' . $alt_value . '"', $piece);
        								// Now the sub piece is the piece
        								$sub_piece = $piece;
        							}
        						}
        					}
        					else {
        						if (substr_count($sub_piece,' alt=')==0
        								&& substr_count($sub_piece,' alt =')==0
        						) { // Haven't alt tag, so ADD it
        						
        							$piece = ' alt="' . $alt_value . '"' . $piece;
        							// Now the sub piece is the piece
        							$sub_piece = $piece;
        						}
        						else {
        							// Check if has alt tag but is empty, or if the option of "all" is selected
        							$inside_alt_tag = trim(self::get_content_in_alt_or_title($sub_piece),"'\" \\");
        							if ($inside_alt_tag=='' || $alt_decoration_type=='all'){
        								// replace old tag value with new one
        								// Take in care the case in this the "alt" is separated to the "="
        								$piece = str_ireplace('alt =', 'alt=', $piece);
        								 
        								$piece = str_ireplace(' alt="' . $inside_alt_tag . '"', ' alt="' . $alt_value . '"', $piece);
        								$piece = str_ireplace(" alt='" . $inside_alt_tag . "'", ' alt="' . $alt_value . '"', $piece);
        								// Now the sub piece is the piece
        								$sub_piece = $piece;
        							}
        						}
        					}
        				}
        				
	        			/*
	        			 * Image Title
	        			 */
        				if ($title_decoration_type!='none') {
	        				
        					if (WPPostsRateKeys_Settings::support_multibyte()) {
        						if (mb_substr_count($sub_piece,' title=','UTF-8')==0
        								&& mb_substr_count($sub_piece,' title =','UTF-8')==0
        						) { // Haven't alt tag, so ADD it
        							 
        							$piece = ' title="' . $title_value . '"' . $piece;
        						}
        						else {
        							// Check if has title tag but is empty, or if the option of "all" is selected
        							$inside_title_attr = trim(self::get_content_in_alt_or_title($sub_piece,'title'),"'\" \\");
        							if ($inside_title_attr=='' || $title_decoration_type=='all'){
        								// replace old tag value with new one
        								// Take in care the case in this the "title" is separated to the "="
        								$piece = str_ireplace('title =', 'title=', $piece);
        						
        								$piece = str_ireplace(' title="' . $inside_title_attr . '"',' title="' . $title_value . '"',$piece);
        								$piece = str_ireplace(" title='" . $inside_title_attr . "'",' title="' . $title_value . '"',$piece);
        							}
        						}
        					}
        					else {
		        				if (substr_count($sub_piece,' title=')==0 
		        				&& substr_count($sub_piece,' title =')==0
		        					) { // Haven't alt tag, so ADD it
		        					
		        					$piece = ' title="' . $title_value . '"' . $piece;
		        				}
		        				else {
		        					// Check if has title tag but is empty, or if the option of "all" is selected
			        				$inside_title_attr = trim(self::get_content_in_alt_or_title($sub_piece,'title'),"'\" \\");
			        				if ($inside_title_attr=='' || $title_decoration_type=='all'){
			        					// replace old tag value with new one
			        					// Take in care the case in this the "title" is separated to the "="
			        					$piece = str_ireplace('title =', 'title=', $piece);
			        					
			        					$piece = str_ireplace(' title="' . $inside_title_attr . '"',' title="' . $title_value . '"',$piece);
			        					$piece = str_ireplace(" title='" . $inside_title_attr . "'",' title="' . $title_value . '"',$piece);
		        					}
		        				}
        					}
        				}
        			}
        				
        			$new_str_arr[] = $piece;
        		}
        	}
        		
        	return implode('<img', $new_str_arr);
        }
        
	    /**
         * Check if has some of the three styles applied to the pieces of code
         * 
         * @param	array	$pieces
         * @param	int		$index				keyword possition
         * @param	array	$arrays_to_check
         * @param	array	$keyword_arr
         * @return 	bool|array
         * @static 
         */
        static function if_some_style_in_pieces($pieces, $index, $arrays_to_check=array(), $keyword_arr) {
        	
        	foreach ($keyword_arr as $keyword) {

        		// determine both parts of texts
	        	$ini_piece1 = '';
		        $ini_piece2 = '';
	        	for ($i=0;$i<count($pieces);$i++) {
	        		if ($i<=$index) {
	        			if ($ini_piece1=='')
	        				$ini_piece1 .= $pieces[$i];
						else
	        				$ini_piece1 .= $keyword . $pieces[$i];
	        		}
	        		else {
	        			if ($ini_piece2=='')
	        				$ini_piece2 .= $pieces[$i];
						else
	        				$ini_piece2 .= $keyword . $pieces[$i];
	        		}
	        	}
	        	
	        	// Check in the already defined style arrays
	        	if (count($arrays_to_check)==0)
	        		$arrays_to_check = self::get_styles();
                        
                        foreach ($arrays_to_check as $to_check) {
                            $piece1 = $ini_piece1;
                            $piece2 = $ini_piece2;
	        		if ($to_check[0]!='style') {
	        			$begin_with = FALSE;
	        			$end_with = FALSE;
	        			
	        			if (WPPostsRateKeys_Settings::support_multibyte()) {
	        				$pos_h_tmp = mb_strpos($to_check[2],'H',null,'UTF-8');
	        			}
	        			else {
	        				$pos_h_tmp = strpos($to_check[2],'H');
	        			}
	        			
	        			if ($pos_h_tmp===0) {
	        				// The Checks for H1, H2 and H3 are different, this tags can have other tags inside
	        				// But is a keyword is part of an attribute will not be considered, so
	        				// i clean the content of other tags
	        				$piece1 = strip_tags($piece1,'<h1><h2><h3>');
	        				$piece2 = strip_tags($piece2,'<h1><h2><h3>');
	        				
	        				// Check if begin with
	        				if (WPPostsRateKeys_Settings::support_multibyte()) {
		        				$first_open_tag_left = mb_strripos($piece1,$to_check[0],null,'UTF-8');
		        				$first_close_tag_left = mb_strripos($piece1,$to_check[1],null,'UTF-8');
		        			}
		        			else {
		        				$first_open_tag_left = strripos($piece1,$to_check[0]);
		        				$first_close_tag_left = strripos($piece1,$to_check[1]);
		        			}
		        			
		        			/*
	        				 * check in the left
	        				 * If: has at least one <h1
	        				 * and: 
	        				 * 		haven't </h1>
	        				 * 		or
	        				 * 		have </h1> before <h1>
	        				 */
	        				if ($first_open_tag_left!==FALSE) {
		        				if (
		        				$first_close_tag_left===FALSE
		        				|| ($first_close_tag_left!==FALSE && $first_close_tag_left < $first_open_tag_left)
		        				)
		        					$begin_with = TRUE;
		        				
		        			}
	        				// Check if end with
	        				if (WPPostsRateKeys_Settings::support_multibyte()) {
		        				$first_open_tag_right = mb_stripos($piece2,$to_check[0],null,'UTF-8');
		        				$first_close_tag_right = mb_stripos($piece2,$to_check[1],null,'UTF-8');
		        			}
		        			else {
		        				$first_open_tag_right = stripos($piece2,$to_check[0]);
	        					$first_close_tag_right = stripos($piece2,$to_check[1]);
		        			}
	        				/*
	        				 * check in the right
	        				 * If: has at least one </h1
	        				 * and: 
	        				 * 		haven't <h1>
	        				 * 		or
	        				 * 		have </h1> before <h1>
	        				 */
	        				if ($first_close_tag_right!==FALSE) {
		        				if (
		        				$first_open_tag_right===FALSE
		        				|| ($first_open_tag_right!==FALSE && $first_close_tag_right < $first_open_tag_right)
		        				)
		        					$end_with = TRUE;
		        			}
		        			
		        			if ($begin_with && $end_with) {
			        			// If has another H1, H2 or H3 inside, doesn't count
		        				if (WPPostsRateKeys_Settings::support_multibyte()) {
		        					$piece_to_check = mb_substr($piece1, $first_open_tag_left + 4,mb_strlen($piece1),'UTF-8'); // +4 for the <hx>
		        					
		        					if (mb_substr_count($piece_to_check, '<h1>','UTF-8')>0
		        							|| mb_substr_count($piece_to_check, '<h2>','UTF-8')>0
		        							|| mb_substr_count($piece_to_check, '<h3>','UTF-8')>0
		        					) {
		        						// Set to False so this match isn't counted
		        						$begin_with = FALSE;
		        						$end_with = FALSE;
		        					}
		        				}
		        				else {
		        					$piece_to_check = substr($piece1, $first_open_tag_left + 4); // +4 for the <hx>
		        					
		        					if (substr_count($piece_to_check, '<h1>')>0
		        							|| substr_count($piece_to_check, '<h2>')>0
		        							|| substr_count($piece_to_check, '<h3>')>0
		        					) {
		        						// Set to False so this match isn't counted
		        						$begin_with = FALSE;
		        						$end_with = FALSE;
		        					}
		        				}
		        			}		        			
	        			}
	        			else {
		        			// Check if begins with
		        			
	        				if (WPPostsRateKeys_Settings::support_multibyte()) {
	        					// Determine the position (from rigth to left) of the "<"
			        			$first_back_less = mb_strripos($piece1,'<',null,'UTF-8'); 
			        			// Determine the position (from rigth to left) of the current tag to check
			        			$first_back_tag = mb_strripos($piece1,$to_check[0],null,'UTF-8');
	        				}
	        				else {
			        			// Determine the position (from rigth to left) of the "<"
			        			$first_back_less = strripos($piece1,'<'); 
			        			// Determine the position (from rigth to left) of the current tag to check
			        			$first_back_tag = strripos($piece1,$to_check[0]);
	        				}
                                                
		        			if ($first_back_less!==FALSE && $first_back_tag!==FALSE) {
		        				if ($first_back_less == $first_back_tag)
		        					$begin_with = TRUE;
		        			}
		
		        			// Check if ends with
		        			
		        			if (WPPostsRateKeys_Settings::support_multibyte()) {
		        				// Determine the position (from left to rigth) of the "<"
		        				$first_less = mb_stripos($piece2,'<',null,'UTF-8');
		        				// Determine the position (from left to rigth) of the current tag to check
		        				$first_tag = mb_stripos($piece2,$to_check[1],null,'UTF-8');
		        			}
		        			else {
		        				// Determine the position (from left to rigth) of the "<"
			        			$first_less = stripos($piece2,'<'); 
			        			// Determine the position (from left to rigth) of the current tag to check
			        			$first_tag = stripos($piece2,$to_check[1]);
		        			}
		
		        			if ($first_less!==FALSE && $first_tag!==FALSE) {
		        				if ($first_less == $first_tag)
		        					$end_with = TRUE;
		        			}
	        			}
	        				
	        			if ($begin_with && $end_with) {	        					
	        				return array(TRUE,$to_check[2]);
	        			}
	        		}
	        		else {
	        			// 
	        			/*
	        			 * Some tag with style="$to_check[1]"
	        			 * example:
	        			 * <span style="font-weight: bold;">keyword</span>
	        			 * <p style="some: some; font-style: italic" id="some">keyword</span>
	        			 * <span style="text-decoration: underline;">keyword</span>
	        			 */
	        			
	        			if (WPPostsRateKeys_Settings::support_multibyte()) {
	        				$strpos_1 = mb_strrpos($piece1,'<',null,'UTF-8');
	        				$strpos_2 = mb_strrpos($piece1,'>',null,'UTF-8');
	        				
	        				$sub_str = mb_substr($piece1,$strpos_1,$strpos_2-$strpos_1,'UTF-8');
	        				
	        				if (mb_substr_count($sub_str,$to_check[1],'UTF-8')>0)
	        					return array(TRUE,$to_check[2]);
	        			}
	        			else {
		        			$strpos_1 = strrpos($piece1,'<');
			        		$strpos_2 = strrpos($piece1,'>');
			        		
			        		$sub_str = substr($piece1,$strpos_1,$strpos_2-$strpos_1);
			        		
			        		if (substr_count($sub_str,$to_check[1])>0)
			        			return array(TRUE,$to_check[2]);
	        			}
	        		}
	        	}
        	}
        	
        	return FALSE;        	
        }
	}
}

