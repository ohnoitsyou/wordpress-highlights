<?php
/*
 * Plugin Name: CSEE Highlight
 * Description: A front page highlight
 * Author: David Young
 * Version: 1.0
 */


class cseehighlight_widget extends WP_Widget {

  function cseehighlight_widget() {
    parent::WP_Widget(false, $name = 'Highlight widget');
  }

  function widget($args, $instance) {
    extract($args);
    
    $title = $instance['title'];
    $link_url = $instance['link_url'];
    $background_class = $instance['background'];
    $text_class = $instance['text_color'] . "_text";
    $drop_shadow = $instance['drop_shadow'] ? "drop_shadow" : "";
    $disabled = $instance['disabled'];
    $wrapper_class = "highlight ${background_class}";
    $content_class = "${text_class} ${drop_shadow}"; 
     
    $margins = "margin: ${instance['topMargin']}px ${instance['rightMargin']}px ${instance['bottomMargin']}px ${instance['leftMargin']}px;";
    $paddings = "padding: ${instance['topPadding']}px ${instance['rightPadding']}px ${instance['bottomPadding']}px ${instance['leftPadding']}px;";
    $fontsize = "font-size: ${instance['fontSize']}px;";
    $style_line = "$margins $paddings $fontsize"; 

 
    if(!$disabled) {
      echo $before_widget;
    ?>
    <div class="<?php echo $wrapper_class; ?>" style="<?php echo $style_line ?>">
      <a href="<?php echo $link_url; ?>">
        <div class="<?php echo $content_class; ?>"><?php echo $title; ?></div>
      </a>
    </div>
    <?php
 
      echo $after_widget;
    }
  }

  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title'],"<br>");
    $instance['link_url'] = $new_instance['link_url'];
    $instance['background'] = $new_instance['background'];
    $instance['text_color'] = $new_instance['text_color'];
    $instance['drop_shadow'] = $new_instance['drop_shadow'];
    $instance['topPadding'] = $new_instance['topPadding'];
    $instance['rightPadding'] = $new_instance['rightPadding'];
    $instance['bottomPadding'] = $new_instance['bottomPadding'];
    $instance['leftPadding'] = $new_instance['leftPadding'];
    $instance['topMargin'] = $new_instance['topMargin'];
    $instance['rightMargin'] = $new_instance['rightMargin'];
    $instance['bottomMargin'] = $new_instance['bottomMargin'];
    $instance['leftMargin'] = $new_instance['leftMargin'];
    $instance['fontSize'] = $new_instance['fontSize'];
    $instance['disabled'] = $new_instance['disabled'];
    return $instance;
  }

  function form($instance) {
    $title = esc_attr($instance['title']);
    $link_url = $instance['link_url'];
    $background = $instance['background'];
    $text_color = $instance['text_color'];
    $drop_shadow = $instance['drop_shadow'];
    $topPadding =  $instance['topPadding'] == 4? 4: $instance['topPadding'];
    $rightPadding = $instance['rightPadding'] == 4? 4 : $instance['rightPadding'];
    $bottomPadding = $instance['bottomPadding'] == 4 ? 4 : $instance['bottomPadding'];
    $leftPadding = $instance['leftPadding'] == 4 ? 4 : $instance['leftPadding'];
    $topMargin = $instance['topMargin'] == 0 ? 0 : $instance['topMargin'];
    $rightMargin = $instance['rightMargin'] == 0 ? 0 : $instance['rightMargin'];
    $bottomMargin = $instance['bottomMargin'] == 0 ? 0 : $instance['bottomMargin'];
    $leftMargin = $instance['leftMargin'] == 0 ? 0 : $instance['leftMargin']; 
    $fontSize = $instance['fontSize'] == 12 ? 12 : $instance['fontSize'];
    $disabled = $instance['disabled'];
    ?>
    <?php /* Highlight Text */ ?>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Highlight Text:'); ?></label> 
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    </p>
    <?php /* Link Url */ ?>
    <p>
      <label for="<?php echo $this->get_field_id('link_url'); ?>"><?php _e('Highlight link URL:');?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('link_url'); ?>" name="<?php echo $this->get_field_name('link_url'); ?>" type="text" value="<?php echo $link_url; ?>" />
    </p>
    <?php /* Background color */ ?>
    <p>
      <label for="<?php echo $this->get_field_id('background'); ?>"><?php _e('Background type:');?></label><br />
      <input id="<?php echo $this->get_field_id('background'); ?>" name="<?php echo $this->get_field_name('background'); ?>" type="radio" value="yellow_gradient" <?php echo checked($background, "yellow_gradient"); ?> /><span> Yellow Gradient</span><br />
      <input id="<?php echo $this->get_field_id('background'); ?>" name="<?php echo $this->get_field_name('background'); ?>" type="radio" value="red_gradient" <?php echo checked($background, "red_gradient"); ?> /><span> Red Gradient</span><br />
      <input id="<?php echo $this->get_field_id('background'); ?>" name="<?php echo $this->get_field_name('background'); ?>" type="radio" value="black_gradient" <?php echo checked($background, "black_gradient"); ?> /><span> Black Gradient</span><br />
      <input id="<?php echo $this->get_field_id('background'); ?>" name="<?php echo $this->get_field_name('background'); ?>" type="radio" value="white_gradient" <?php echo checked($background, "white_gradient"); ?> /><span> White Gradient</span><br />

    </p>
    <?php /* Text color */ ?>
    <p>
      <label for="<?php echo $this->get_field_id('text_color'); ?>"><?php _e('Text color:');?></label><br />
      <input id="<?php echo $this->get_field_id('text_color'); ?>" name="<?php echo $this->get_field_name('text_color'); ?>" type="radio" value="black" <?php echo checked($text_color, "black"); ?> /><span> Black</span><br />
      <input id="<?php echo $this->get_field_id('text_color'); ?>" name="<?php echo $this->get_field_name('text_color'); ?>" type="radio" value="blue" <?php echo checked($text_color, "blue"); ?> /><span> Blue</span><br />
      <input id="<?php echo $this->get_field_id('text_color'); ?>" name="<?php echo $this->get_field_name('text_color'); ?>" type="radio" value="white" <?php echo checked($text_color, "white"); ?> /><span> White</span><br />
      <input id="<?php echo $this->get_field_id('text_color'); ?>" name="<?php echo $this->get_field_name('text_color'); ?>" type="radio" value="gray" <?php echo checked($text_color, "gray"); ?> /><span> Gray</span><br />
    </p>
    <?php /* Drop Shadow */ ?>
    <p>
      <label for-"<?php echo $this->get_field_id('drop_shadow'); ?>"><?php _e('Drop Shadow:');?></label>
      <input id="<?php echo $this->get_field_id('drop_shadow'); ?>" name="<?php echo $this->get_field_name('drop_shadow'); ?>" type="checkbox" value="1" <?php echo checked('1', $drop_shadow); ?> />
    </p>

    <style>
      .table-layout p {
        display: table-row;
      }
      .table-layout label, .table-layout input {
        display: table-cell;
      }
    </style>
    <?php /* Padding */ ?>
    <div class="table-layout"> 
    <p>
      <label for="<?php echo $this->get_field_id('fontSize'); ?>"><?php _e('Font Size:');?></label>
      <input id="<?php echo $this->get_field_id('fontSize'); ?>" name="<?php echo $this->get_field_name('fontSize'); ?>" type="text" value="<?php echo $fontSize; ?>" maxlength="3" size="3" />px
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('topPadding'); ?>" ><?php _e('Top Padding:');?></label>
      <input id="<?php echo $this->get_field_id('topPadding'); ?>" name="<?php echo $this->get_field_name('topPadding'); ?>" type="text" value="<?php echo $topPadding; ?>" maxlength="3" size="3"/>px
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('rightPadding'); ?>" ><?php _e('Right Padding:');?></label>
      <input id="<?php echo $this->get_field_id('rightPadding'); ?>" name="<?php echo $this->get_field_name('rightPadding'); ?>" type="text" value="<?php echo $rightPadding; ?>" maxlength="3" size="3"/>px
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('bottomPadding'); ?>" ><?php _e('Bottom Padding:');?></label>
      <input id="<?php echo $this->get_field_id('bottomPadding'); ?>" name="<?php echo $this->get_field_name('bottomPadding'); ?>" type="text" value="<?php echo $bottomPadding; ?>" maxlength="3" size="3"/>px
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('leftPadding'); ?>" ><?php _e('Left Padding:');?></label>
      <input id="<?php echo $this->get_field_id('leftPadding'); ?>" name="<?php echo $this->get_field_name('leftPadding'); ?>" type="text" value="<?php echo $leftPadding; ?>" maxlength="3" size="3"/>px
    </p>
    <?php /* Margin */ ?>
    <p>
      <label for="<?php echo $this->get_field_id('topMargin'); ?>" ><?php _e('Top Margin:');?></label>
      <input id="<?php echo $this->get_field_id('topMargin'); ?>" name="<?php echo $this->get_field_name('topMargin'); ?>" type="text" value="<?php echo $topMargin; ?>" maxlength="3" size="3" />px
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('rightMargin'); ?>" ><?php _e('Right Margin:');?></label>
      <input id="<?php echo $this->get_field_id('rightMargin'); ?>" name="<?php echo $this->get_field_name('rightMargin'); ?>" type="text" value="<?php echo $rightMargin; ?>" maxlength="3" size="3" />px
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('bottomMargin'); ?>" ><?php _e('Bottom Margin:');?></label>
      <input id="<?php echo $this->get_field_id('bottomMargin'); ?>" name="<?php echo $this->get_field_name('bottomMargin'); ?>" type="text" value="<?php echo $bottomMargin; ?>" maxlength="3" size="3" />px
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('leftMargin'); ?>" ><?php _e('Left Margin:');?></label>
      <input id="<?php echo $this->get_field_id('leftMargin'); ?>" name="<?php echo $this->get_field_name('leftMargin'); ?>" type="text" value="<?php echo $leftMargin; ?>" maxlength="3" size="3" />px
    </p>
    </div>
    <br />
    <p>
      <label for="<?php echo $this->get_field_id('disabled'); ?>"><?php _e('Hide this widget: ') ?></label>
      <input id="<?php echo $this->get_field_id('disabled'); ?>" name="<?php echo $this->get_field_name('disabled'); ?>" type="checkbox" value="1" <?php checked($disabled,'1'); ?> />
    </p>
  <?php
  }
}

function cseehighlight_styles() {
  wp_register_style('csee-highlights-style',plugins_url('csee-highlights-style.css',__FILE__));
  wp_enqueue_style('csee-highlights-style');
}


add_action('widgets_init', create_function('', 'return register_widget("cseehighlight_widget");'));
add_action('wp_enqueue_scripts','cseehighlight_styles');
