<h2>DIRECTORY &gt; <small>UPDATE DIRECTORY</small></h2>
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
<input type="hidden" name="pluginname" value="<?php echo PLUGIN_NAME; ?>"/>
<input type="hidden" name="id" value="<?php echo $idfromUrl ?>"/>
<?php foreach ($rows as $row) { ?>
<p>
Title Default (required) <br/>
<input type="text" name="title-default" 
    title="Normal character with ?@# only"
    value="<?php echo ( isset( $_POST["title-default"] ) ?  ( $_POST["title-default"] ) : $row->title_default ); ?>" 
    size="100" />
</p>
<p>
Title En (required) <br/>
<input type="text" name="title-en" 
    title="Normal character with ?@# only"
    value="<?php echo ( isset( $_POST["title-en"] ) ? ( $_POST["title-en"] ) : $row->title_en ) ?>" 
    size="100" />
</p>
<p>
Status  <br/>
<select name="status">
  <option value="1" 
  <?php 
    if (isset($_POST['status'])) {
        if ($_POST['status'] == 1) {
            echo 'selected="selected"';
        }
    }
    else if ($row->status == 1){
        echo 'selected="selected"';
    }
  ?>
  >Enable</option>
  <option value="2" 
  <?php 
    if (isset($_POST['status'])) {
        if ($_POST['status'] == 2) {
            echo 'selected="selected"';
        }
    }
    else if ($row->status == 2){
        echo 'selected="selected"';
    }
  ?>
  >Disable</option>
</select>
</p>
<?php } ?>

<p>
    <input type="submit" class="button" value="Send"> 
    <a href="<?php echo admin_url('admin.php?page=list_directory'); ?>">Back</a> </p>
</form>
