<h2>STAFF DIRECTORY &gt; <small>UPDATE STAFF</small></h2>
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
<form action="<?php echo admin_url('admin.php?page=update_staff_directory&noheader=true'); ?>" method="post">
<input type="hidden" name="pluginname" value="<?php echo EIDIR_PLUGIN_NAME; ?>"/>
<input type="hidden" name="id" value="<?php echo $idfromUrl ?>"/>
<?php foreach ($rows as $row) { ?>
<p>
Name (required) <br/>
<input type="text" name="name" 
    value="<?php echo ( isset( $_POST["name"] ) ?  ( $_POST["name"] ) : $row->name ); ?>" 
    size="100" />
</p>
<p>
Email (required) <br/>
<input type="text" name="email" 
    
    value="<?php echo ( isset( $_POST["email"] ) ?  ( $_POST["email"] ) : $row->email ); ?>" 
    size="100" />
</p>
<p>
Title Default (required) <br/>
<input type="text" name="position-default" 
    value="<?php echo ( isset( $_POST["title-default"] ) ?  ( $_POST["position-default"] ) : $row->position_default ); ?>" 
    size="100" />
</p>
<p>
Title En (required) <br/>
<input type="text" name="position-en" 
    value="<?php echo ( isset( $_POST["title-en"] ) ? ( $_POST["position-en"] ) : $row->position_en ) ?>" 
    size="100" />
</p>
<p>
Phone (required) <br/>
<input type="text" name="telephone" 
    
    value="<?php echo ( isset( $_POST["telephone"] ) ?  ( $_POST["telephone"] ) : $row->telephone ) ?>" 
    size="100" />
</p>
<p>
Fax (required) <br/>
<input type="text" name="fax" 
    
    value="<?php echo ( isset( $_POST["fax"] ) ?  ( $_POST["fax"] ) : $row->fax ) ?>" 
    size="100" />
</p>
<p>Directory  <br/>
<select name="directory">
<option value="">Please choose</option>
<?php foreach ($details as $detail) { ?>
  <option 
    value="<?php echo $detail->id; ?>" 
    <?php 
    if (isset($_POST['directory'])) {
        if ($_POST['directory'] == $detail->id) {
            echo 'selected="selected"';
        }
    }
    else {
        if ($detail->id == $row->table_master) {
            echo 'selected="selected"';
        }
    }
  ?>
    >
  <?php echo $detail->title_default; ?> / <?php echo $detail->title_en; ?></option>
<?php } ?>
</select>
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
    <a href="<?php echo admin_url('admin.php?page=list_staff_directory'); ?>">Back</a> </p>
</form>
