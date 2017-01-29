    <style>
    .nopaddingandmargin {
        margin:0 !important;
        padding:0 !important;
        padding-left:20px !important;
    }
    .image_throtlling {
        max-width: 123px;
        float:left;
        margin-right:10px;
    }
    .blocks {
        border:1px solid #cccccc;
        padding:5px;
        margin-bottom:5px;
        color:#fff;
        background-color: #cccccc;
    }

    </style>
    <h2>STAFF DIRECTORY</h2>
    
    <p>
    <a href="<?php echo admin_url('admin.php?page=add_staff_directory'); ?>">Add Staff</a>
    ::
    <a href="<?php echo admin_url('admin.php?page=list_directory'); ?>">Listing ALL Directory</a>
    </p>
    <form action="<?php echo admin_url('admin.php'); ?>" method="get">
    <p>Directory 
    <input type="hidden" name="page" value="list_staff_directory"/>
    <select name="master">
    <option value="">Please choose</option>
    <?php foreach ($details as $detail) { ?>
      <option 
        value="<?php echo $detail->id; ?>" 
        <?php 
        if (isset($_GET['master'])) {
            if ($_GET['master'] == $detail->id) {
                echo 'selected="selected"';
            }
        }
      ?>
        >
      <?php echo $detail->title_default; ?></option>
    <?php } ?>
    </select> <input type="submit" class="button" value="View"/ >
    </p>
    </form>
    <table class='wp-list-table widefat plugins  striped' style="width:95%">
        <tr>
            <th style="width:5%;font-weight:bold">ID</th>
            <th style="width:25%;font-weight:bold">Name</th>
            <th style="width:35%;font-weight:bold">Profile</th>
            <th style="width:10%;font-weight:bold">Status</th>
            <th style="width:15%;font-weight:bold">Attribute</th>
        </tr>
        <?php foreach ($rows as $row) { ?>
            <tr>
                <td><?php echo $row->id; ?></td>
                <td>
                    <div>
                    <?php 
                    if (($row->picture_path == NULL) || ($row->picture_url == NULL)){
                        ?>
                        <img src="<?php echo $image_folder."default.jpg"; ?>" class="image_throtlling"/>
                    <?php
                    }
                    else { ?>
                        <img src="<?php echo site_url().$row->picture_url; ?>" class="image_throtlling"/>
                    <?php
                    } 
                    ?>
                    </div>
                    <div><b><?php echo strtoupper($row->name); ?></b></div>
                    <div>Email:<br/><small><?php echo $row->email; ?></small></div>
                    <div>Tel: <small><?php echo $row->telephone; ?></small></div>
                    <div>Fax: <small><?php echo $row->fax; ?></small></div>                   
                </td>
                <td>
                <div class="blocks">
                    <div>Default: <?php echo $row->position_default; ?></div>   
                    <div>En: <?php echo $row->position_en; ?></div>  
                </div>
                <div class="blocks">
                    <?php  
                    if (array_key_exists($row->table_master,$details)) {
                        echo "<div>Default: ".$details[$row->table_master]->title_default."</div>";
                        echo "<div>En:".$details[$row->table_master]->title_en."</div>";
                    }
                    else {
                       echo $row->table_master;  
                    }
                    ?>              
                </div>    
                </td>
                <td><?php echo eidir_StringHelper::returnTextForStatus($row->status); ?></td>
                <td> 
                   
                    <div>
                        <a href="<?php echo admin_url('admin.php?page=update_staff_directory&id=' . $row->id); ?>">Update</a> 
                        ::
                        <a href="<?php echo admin_url('admin.php?task=deleteattribute&page=list_delete_directory&noheader=true&id=' . $row->id); ?>" onclick="return confirm('Are you sure?')">Delete</a>
                        ::
                        <a href="<?php echo admin_url('admin.php?page=picture_staff_directory&id='. $row->id); ?>" >Picture</a>
                    </div>  

                </td>               
            </tr>
        <?php } ?>
    </table>
    <?php $eidir_pagination->generateLinkForAdmin(); ?> 