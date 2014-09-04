<?php
/*
Plugin Name: Popular Threads Widget For Disqus
Plugin URI: http://www.trickspanda.com
Description: Add a Disqus popular threads widget to your WordPress blog's sidebar
Version: 1.2
Author: Hardeep Asrani
Author URI: http://www.hardeepasrani.com
*/

class tp_disquspopularthreads extends WP_Widget
{
    function tp_disquspopularthreads()
    {
        $widget_ops = array(
            'classname' => 'tp_disquspopularthreads',
            'description' => 'Add Disqus popular threads widget to WordPress sidebar.'
        );
        
        $this->WP_Widget('tp_disquspopularthreads', 'Disqus Popular Threads Widget', $widget_ops);
    }
    
    function form($instance)
    {
        $instance = wp_parse_args((array) $instance);
        
        if ($instance['threadnumbers'] == NULL) {
            $instance['threadnumbers'] = "5";
        }
?>

<p>
<label for="<?php
        echo $this->get_field_id('title');
?>">
Title:
<br/>
<input id="<?php
        echo $this->get_field_id('title');
?>" 
name="<?php
        echo $this->get_field_name('title');
?>" type="text" value="<?php
        if(isset($instance['title'])){ echo $instance['title']; }
?>" />
</label>
<br/>
<label for="<?php
        echo $this->get_field_id('siteid');
?>">
Disqus Site ID:
<br/>
<input id="<?php
        echo $this->get_field_id('siteid');
?>" 
name="<?php
        echo $this->get_field_name('siteid');
?>" type="text" value="<?php
        if(isset($instance['siteid'])){ echo $instance['siteid']; }
?>" />
</label>
<br/>
<label for="<?php
        echo $this->get_field_id('threadnumbers');
?>">
Number of Threads:
<br/>
<input id="<?php
        echo $this->get_field_id('threadnumbers');
?>" 
name="<?php
        echo $this->get_field_name('threadnumbers');
?>" type="number" value="<?php
        echo $instance['threadnumbers'];
?>" />
</label>
</p>

<?php
    }
    function update($new_instance, $old_instance)
    {
        $instance                     = $old_instance;
        $instance['title']           = $new_instance['title'];
        $instance['siteid']           = $new_instance['siteid'];
        $instance['threadnumbers']   = $new_instance['threadnumbers'];
        
        return $instance;
    }
    
    function widget($args, $instance) // widget sidebar output
    {
        extract($args, EXTR_SKIP);
        
        echo $before_widget;
        echo $before_title;
        echo $instance['title'];
        echo $after_title;
        
        $title           = $instance['title'];
        $siteid           = $instance['siteid'];
        $threadnumbers   = $instance['threadnumbers'];
        
        echo "<div id='popularthreads' class='dsq-widget'><script type='text/javascript' src='http://$siteid.disqus.com/popular_threads_widget.js?num_items=$threadnumbers'></script></div>";
        echo $after_widget;
    }
}

add_action('widgets_init', create_function('', 'return register_widget("tp_disquspopularthreads");'));

?>