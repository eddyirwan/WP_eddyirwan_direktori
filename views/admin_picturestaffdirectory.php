<h2>STAFF DIRECTORY &gt; <small>UPDATE STAFF PICTURE</small></h2>
<style>
.attributePlaceholder {
    border:1px solid #cccccc;
    padding:15px;
}
.gapAboveTitle {
    margin-top:10px;
    font-weight: bold;
}
.fileUpload {
    position: relative;
    overflow: hidden;
    margin: 10px;
}
.fileUpload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}
.image_throtlling {
    max-width: 200px;
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
<form action="<?php echo admin_url('admin.php?page=picture_staff_directory&noheader=true'); ?>" 
    method="post"
    enctype="multipart/form-data">
<input type="hidden" name="pluginname" value="<?php echo PLUGIN_NAME; ?>"/>
<input type="hidden" name="id" value="<?php echo $idfromUrl ?>"/>
<?php foreach ($rows as $row) { ?>
<p>
Name : <?php $row->name; ?><br/>
<?php 
if (($row->picture_path == NULL) || ($row->picture_url == NULL)){
    ?>
    <img src="<?php echo $image_folder."default.jpg"; ?>"/>
<?php
}
else { ?>
    <img src="<?php echo site_url().$row->picture_url; ?>" class="image_throtlling"/>
<?php
} 
?>
<div class="fileUpload button button-primary">
    <span>File To Upload</span>
    <input type="file" name="file" class="upload" />
</div>
    
</p>
<?php } ?>
<p>
    <input type="submit" class="button" value="Save"> 
    <a href="<?php echo admin_url('admin.php?page=list_delete_directory&task=deleteimage&id='.$idfromUrl); ?>&noheader=true" onclick="return confirm('Are you sure?')" class="button"/> Delete Image </a>
    <a href="<?php echo admin_url('admin.php?page=list_directory'); ?>">Back</a> </p>
</form>
