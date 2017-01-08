<h2>DIRECTORY &gt; <small>ADD NEW DIRECTORY</small></h2>
<style>
.attributePlaceholder {
    border:1px solid #cccccc;
    padding:15px;
}
.gapAboveTitle {
    margin-top:10px;
    font-weight: bold;
}
</style>
<?php
if ( is_wp_error( $reg_errors ) ) {
    echo '<div class="alert alert-warning"><strong>ERROR</strong>';
    foreach ( $reg_errors->get_error_messages() as $error ) {
        echo '<div>';
        echo $error;
        echo '</div>';
    }
    echo '</div>';
}
?>
<div style="height:10px"></div>
<form action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>&noheader=true" method="post">
<input type="hidden" name="pluginname" value="<?php echo EIDIR_PLUGIN_NAME; ?>"/>
<p>
Title Default (required) <br/>
<input type="text" name="title-default" 
    
    value="<?php echo ( isset( $_POST["title-default"] ) ?  esc_attr( $_POST["title-default"] ) : '' ); ?>" 
    size="100" />
</p>
<p>
Title En (required) <br/>
<input type="text" name="title-en" 
    
    value="<?php echo ( isset( $_POST["title-en"] ) ?  esc_attr( $_POST["title-en"] ) : '' ) ?>" 
    size="100" />
</p>
<p>
Status  <br/>
<select name="status">
  <option value="1" <?php ( isset( $_POST["status"] ) ?  esc_attr( $_POST["status"] ) : '' ) ?>>Enable</option>
  <option value="2" <?php ( isset( $_POST["status"] ) ?  esc_attr( $_POST["status"] ) : '' ) ?>>Disable</option>
</select>
</p>

<p><input type="submit" class="button" value="Send"></p>
</form>
