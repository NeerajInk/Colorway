<?php

add_action('init', 'of_options');
if (!function_exists('of_options')) {

    function of_options() {
        // VARIABLES
        $themename = get_theme_data(TEMPLATEPATH . '/style.css');
        $themename = $themename['Name'];
        $shortname = "of";
        // Populate OptionsFramework option in array for use in theme
        global $of_options;
        $of_options = get_option('of_options');
        $file_rename = array("on" => "On", "off" => "Off");
        //Stylesheet Reader
        $alt_stylesheets = array("black" =>
            "black", "brown" => "brown", "blue" => "blue", "green" => "green", "pink" => "pink", "purple" => "purple", "red" => "red", "yellow" => "yellow");
        // Test data
        $test_array = array("one" => "One", "two" => "Two", "three" => "Three", "four" => "Four", "five" => "Five");
        // Multicheck Array
        $multicheck_array = array("one" => "French Toast", "two" => "Pancake", "three" => "Omelette", "four" => "Crepe", "five" => "Waffle");
        // Multicheck Defaults
        $multicheck_defaults = array("one" => "1", "five" => "1");
        // Background Defaults
        $background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat', 'position' => 'top center', 'attachment' => 'scroll');
        // Pull all the categories into an array
        $options_categories = array();
        $options_categories_obj = get_categories();
        foreach ($options_categories_obj as $category) {
            $options_categories[$category->cat_ID] = $category->cat_name;
        }
        // Pull all the pages into an array
        $options_pages = array();
        $options_pages_obj = get_pages('sort_column=post_parent,menu_order');
        $options_pages[''] = 'Select a page:';
        foreach ($options_pages_obj as $page) {
            $options_pages[$page->ID] = $page->post_title;
        }
        // If using image radio buttons, define a directory path
        $imagepath = get_bloginfo('stylesheet_directory') . '/images/';
        $options = array();
        $options[] = array("name" => "General Settings",
            "type" => "heading");
        $options[] = array("name" => "Custom Logo",
            "desc" => "Choose your own logo. Optimal Size: 215px Wide by 55px Height",
            "id" => "colorway_logo",
            "type" => "upload");
        $options[] = array("name" => "Custom Favicon",
            "desc" => "Specify a 16px x 16px image that will represent your website's favicon.",
            "id" => "colorway_favicon",
            "type" => "upload");
        $options[] = array("name" => "Tracking Code",
            "desc" => "Paste your Google Analytics (or other) tracking code here.",
            "id" => "colorway_analytics",
            "std" => "",
            "type" => "textarea");
        $options[] = array("name" => "Body Background Image",
            "desc" => "Select image to change your website background",
            "id" => "inkthemes_bodybg",
            "std" => "",
            "type" => "upload");
        $options[] = array("name" => "Front Page On/Off",
            "desc" => "Check on for enabling front page or check off for enabling blog page in front page",
            "id" => "re_nm",
            "std" => "on",
            "type" => "radio",
            "options" => $file_rename);

//****=============================================================================****//
//****-----------This code is used for creating slider settings--------------------****//							
//****=============================================================================****//						
        $options[] = array("name" => "Slider Settings",
            "type" => "heading");
        $options[] = array("name" => "Slide1 Image",
            "desc" => "Choose Image for your Slider. Optimal Size: 896px x 350px",
            "id" => "colorway_slideimage1",
            "std" => "",
            "type" => "upload");
        $options[] = array("name" => "Slide1 Heading",
            "desc" => "Enter the Heading for Slide1",
            "id" => "colorway_slideheading1",
            "std" => "",
            "type" => "textarea");
        $options[] = array("name" => "Slide1 Heading Link",
            "desc" => "Enter the Link URL in Heading for Slide1",
            "id" => "colorway_slidelink1",
            "std" => "",
            "type" => "text");
        $options[] = array("name" => "Slide1 Description",
            "desc" => "Description for Slide1",
            "id" => "colorway_slidedescription1",
            "std" => "",
            "type" => "textarea");
        $options[] = array("name" => "Slide2 Image",
            "desc" => "Choose Image for your Slider. Optimal Size: 896px x 350px",
            "id" => "colorway_slideimage2",
            "std" => "",
            "type" => "upload");
        $options[] = array("name" => "Slide2 Heading",
            "desc" => "Enter the Heading for Slide2",
            "id" => "colorway_slideheading2",
            "std" => "",
            "type" => "textarea");
        $options[] = array("name" => "Slide2 Heading Link",
            "desc" => "Enter the Link URL in Heading for Slide2",
            "id" => "colorway_slidelink2",
            "std" => "",
            "type" => "text");
        $options[] = array("name" => "Slide2 Description",
            "desc" => "Description for Slide2",
            "id" => "colorway_slidedescription2",
            "std" => "",
            "type" => "textarea");
        $options[] = array("name" => "Slide3 Image",
            "desc" => "Choose Image for your Slider. Optimal Size: 896px x 350px",
            "id" => "colorway_slideimage3",
            "std" => "",
            "type" => "upload");
        $options[] = array("name" => "Slide3 Heading",
            "desc" => "Enter the Heading for Slide3",
            "id" => "colorway_slideheading3",
            "std" => "",
            "type" => "textarea");
        $options[] = array("name" => "Slide3 Heading Link",
            "desc" => "Enter the Link URL in Heading for Slide3",
            "id" => "colorway_slidelink3",
            "std" => "",
            "type" => "text");
        $options[] = array("name" => "Slide3 Description",
            "desc" => "Description for Slide3",
            "id" => "colorway_slidedescription3",
            "std" => "",
            "type" => "textarea");
        $options[] = array("name" => "Slide4 Image",
            "desc" => "Choose Image for your Slider. Optimal Size: 896px x 350px",
            "id" => "colorway_slideimage4",
            "std" => "",
            "type" => "upload");
        $options[] = array("name" => "Slide4 Heading",
            "desc" => "Enter the Heading for Slide4",
            "id" => "colorway_slideheading4",
            "std" => "",
            "type" => "textarea");
        $options[] = array("name" => "Slide4 Heading Link",
            "desc" => "Enter the Link URL in Heading for Slide4",
            "id" => "colorway_slidelink4",
            "std" => "",
            "type" => "text");
        $options[] = array("name" => "Slide4 Description",
            "desc" => "Description for Slide4",
            "id" => "colorway_slidedescription4",
            "std" => "",
            "type" => "textarea");
//****=============================================================================****//
//****-----------This code is used for creating home page feature content----------****//							
//****=============================================================================****//	
        $options[] = array("name" => "Home Page Settings",
            "type" => "heading");
        $options[] = array("name" => "Home Page Intro",
            "desc" => "Enter your heading text for home page",
            "id" => "inkthemes_mainheading",
            "std" => "",
            "type" => "textarea");
        //***Code for first column***//
        $options[] = array("name" => "First Feature Image",
            "desc" => "Choose image for your feature column first. Optimal size 198px x 115px",
            "id" => "inkthemes_fimg1",
            "std" => "",
            "type" => "upload");
        $options[] = array("name" => "First Feature Heading",
            "desc" => "Enter your heading line for first column",
            "id" => "inkthemes_headline1",
            "std" => "",
            "type" => "textarea");
        $options[] = array("name" => "First Feature Link",
            "desc" => "Enter your link for feature column first",
            "id" => "inkthemes_link1",
            "std" => "",
            "type" => "text");
        $options[] = array("name" => "First Feature Content",
            "desc" => "Enter your feature content for column first",
            "id" => "inkthemes_feature1",
            "std" => "",
            "type" => "textarea");
        //***Code for second column***//	
        $options[] = array("name" => "Second Feature Image",
            "desc" => "Choose image for your feature column second. Optimal size 198px x 115px",
            "id" => "inkthemes_fimg2",
            "std" => "",
            "type" => "upload");
        $options[] = array("name" => "Second Feature Heading",
            "desc" => "Enter your heading line for second column",
            "id" => "inkthemes_headline2",
            "std" => "",
            "type" => "textarea");
        $options[] = array("name" => "Second Feature Link",
            "desc" => "Enter your link for feature column second",
            "id" => "inkthemes_link2",
            "std" => "",
            "type" => "text");
        $options[] = array("name" => "Second Feature Content",
            "desc" => "Enter your feature content for column second",
            "id" => "inkthemes_feature2",
            "std" => "",
            "type" => "textarea");
        //***Code for third column***//	
        $options[] = array("name" => "Third Feature Image",
            "desc" => "Choose image for your feature column thrid. Optimal size 198px x 115px",
            "id" => "inkthemes_fimg3",
            "std" => "",
            "type" => "upload");
        $options[] = array("name" => "Third Feature Heading",
            "desc" => "Enter your heading line for third column",
            "id" => "inkthemes_headline3",
            "std" => "",
            "type" => "textarea");
        $options[] = array("name" => "Third Feature Link",
            "desc" => "Enter your link for feature column third",
            "id" => "inkthemes_link3",
            "std" => "",
            "type" => "text");
        $options[] = array("name" => "Third Feature Content",
            "desc" => "Enter your feature content for third column",
            "id" => "inkthemes_feature3",
            "std" => "",
            "type" => "textarea");
        //***Code for fourth column***//	
        $options[] = array("name" => "Fourth Feature Image",
            "desc" => "Choose image for your feature column fourth. Optimal size 198px x 115px",
            "id" => "inkthemes_fimg4",
            "std" => "",
            "type" => "upload");
        $options[] = array("name" => "Fourth Feature Heading",
            "desc" => "Enter your heading line for fourth column",
            "id" => "inkthemes_headline4",
            "std" => "",
            "type" => "textarea");
        $options[] = array("name" => "Fourth Feature link",
            "desc" => "Enter your link for feature column fourth",
            "id" => "inkthemes_link4",
            "std" => "",
            "type" => "text");
        $options[] = array("name" => "Fourth Feature Content",
            "desc" => "Enter your feature content for fourth column",
            "id" => "inkthemes_feature4",
            "std" => "",
            "type" => "textarea");
        $options[] = array("name" => "Home Page Testimonial",
            "desc" => "Enter your text for homepage testimonial in short paragraph.",
            "id" => "inkthemes_testimonial",
            "std" => "",
            "type" => "textarea");
//****=============================================================================****//
//****-----------This code is used for creating color styleshteet options----------****//							
//****=============================================================================****//				
        $options[] = array("name" => "Styling Options",
            "type" => "heading");
        $options[] = array("name" => "Theme Stylesheet",
            "desc" => "Select your themes alternative color scheme.",
            "id" => "colorway_altstylesheet",
            "std" => "green",
            "type" => "select",
            "options" => $alt_stylesheets);
        $options[] = array("name" => "Custom CSS",
            "desc" => "Quickly add some CSS to your theme by adding it to this block.",
            "id" => "colorway_customcss",
            "std" => "",
            "type" => "textarea");
        $options[] = array("name" => "Footer Settings",
            "type" => "heading");
        $options[] = array("name" => "Facebook URL",
            "desc" => "Enter your Facebook URL if you have one",
            "id" => "colorway_facebook",
            "std" => "",
            "type" => "text");
        $options[] = array("name" => "Twitter URL",
            "desc" => "Enter your Twitter URL if you have one",
            "id" => "colorway_twitter",
            "std" => "",
            "type" => "text");
        $options[] = array("name" => "RSS Feed URL",
            "desc" => "Enter your RSS Feed URL if you have one",
            "id" => "colorway_rss",
            "std" => "",
            "type" => "text");
        $options[] = array("name" => "Linked In URL",
            "desc" => "Enter your Linkedin URL if you have one",
            "id" => "colorway_linkedin",
            "std" => "",
            "type" => "text");
        $options[] = array("name" => "Stumble Upon URL",
            "desc" => "Enter your Stumble Upon URL if you have one",
            "id" => "colorway_stumble",
            "std" => "",
            "type" => "text");
        $options[] = array("name" => "Digg URL",
            "desc" => "Enter your Stumble Upon URL if you have one",
            "id" => "colorway_digg",
            "std" => "",
            "type" => "text");
        $options[] = array("name" => "Footer Text",
            "desc" => "Enter the Footer Text",
            "id" => "footer_text",
            "std" => "",
            "type" => "textarea");
//****=============================================================================****//
//****-----------This code is used for creating color SEO description--------------****//							
//****=============================================================================****//						
        $options[] = array("name" => "SEO Options",
            "type" => "heading");
        $options[] = array("name" => "Meta Keywords (comma separated)",
            "desc" => "Meta keywords provide search engines with additional information about topics that appear on your site. This only applies to your home page. Keyword Limit Maximum 8",
            "id" => "colorway_keyword",
            "std" => "",
            "type" => "textarea");
        $options[] = array("name" => "Meta Description",
            "desc" => "You should use meta descriptions to provide search engines with additional information about topics that appear on your site. This only applies to your home page.Optimal Length for Search Engines, Roughly 155 Characters",
            "id" => "colorway_description",
            "std" => "",
            "type" => "textarea");
        $options[] = array("name" => "Meta Author Name",
            "desc" => "You should write the full name of the author here. This only applies to your home page.",
            "id" => "colorway_author",
            "std" => "",
            "type" => "text");
        update_option('of_template', $options);
        update_option('of_themename', $themename);
        update_option('of_shortname', $shortname);
    }

}
?>