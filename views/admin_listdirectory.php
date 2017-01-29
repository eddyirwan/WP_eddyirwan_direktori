    <style>
    .nopaddingandmargin {
        margin:0 !important;
        padding:0 !important;
        padding-left:20px !important;
    }
    </style>
    <h2>JPN POLL</h2>
    
    <p>
    <a href="<?php echo admin_url('admin.php?page=list_add_directory'); ?>">Add Directory</a>
    ::
    <a href="<?php echo admin_url('admin.php?page=list_staff_directory'); ?>">Listing ALL Staff Directory</a>
    </p>
    <table class='wp-list-table widefat plugins  striped' style="width:95%">
        <tr>
            <th style="width:5%;font-weight:bold">ID</th>
            <th style="width:30%;font-weight:bold">Title Default</th>
            <th style="width:30%;font-weight:bold">Title En</th>
            <th style="width:10%;font-weight:bold">Status</th>
            <th style="width:15%;font-weight:bold">Attribute</th>
        </tr>
        <?php foreach ($rows as $row) { ?>
            <tr>
                <td><?php echo $row->id; ?></td>
                <td>
                    <p><?php echo $row->title_default; ?></p>                   
                </td>
                <td>
                    <p><?php echo $row->title_en; ?></p>                   
                </td>
                <td><?php echo eidir_StringHelper::returnTextForStatus($row->status); ?></td>
                <td> 
                   
                    <div>
                        <a href="<?php echo admin_url('admin.php?page=list_update_directory&id=' . $row->id); ?>">Update</a> 
                        ::
                        <a href="<?php echo admin_url('admin.php?task=deleteall&page=list_delete_directory&noheader=true&id=' . $row->id); ?>" onclick="return confirm('Are you sure?')">Delete</a>
                        ::
                        <a href="<?php echo admin_url('admin.php?page=list_staff_directory&master=' . $row->id); ?>" >List Staff</a>
                    </div>  
                </td>               
            </tr>
        <?php } ?>
    </table>