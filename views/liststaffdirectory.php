    <style>
    .nopaddingandmargin {
        margin:0 !important;
        padding:0 !important;
        padding-left:20px !important;
    }
    .image_throtlling {
        max-width: 200px;
        float:left;
        margin-right:10px;
    }

    </style>
    <h2>STAFF DIRECTORY</h2>
    
    <form action="<?php echo site_url(); ?>" method="get">
    <p><?php ei_localization::_output('select_text'); ?> 
    <select name="filter">
    <option value=""><?php ei_localization::_output('select_pleaseChoose'); ?></option>
    <?php foreach ($details as $detail) { ?>
      <option 
        value="<?php echo $detail->id; ?>" 
        <?php 
        if (isset($_GET['filter'])) {
            if ($_GET['filter'] == $detail->id) {
                echo 'selected="selected"';
            }
        }
      ?>
        >
    <?php 
    if ($this->lang=="default") {
        echo $detail->title_default; 
    }
    else {
        echo $detail->title_en;  
    }
    ?> 
    </option>
    <?php } ?>
    </select> <input type="submit" value="<?php ei_localization::_output('select_button'); ?>"/ >
    </p>
    </form>
    <table class='wp-list-table widefat plugins  striped' style="width:95%">
       
        <?php foreach ($rows as $row) { ?>
            <tr>
                
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
                    <div><?php ei_localization::_output('name'); ?> <?php echo ($row->name); ?></div>
                    <div><?php ei_localization::_output('email'); ?> <?php echo $row->email; ?></div>
                    <div>
                        <?php ei_localization::_output('position'); ?> 
                        <?php ei_localization::_dynamicOutput($row,$this->lang,'position'); ?> 
                    </div>
                    <div>
                    <?php ei_localization::_output('department'); ?>  
                    <?php  
                    if (array_key_exists($row->table_master,$details)) {
                        if ($this->lang=="defaut") {
                            echo $details[$row->table_master]->title_default;
                        }
                        else {
                            $x="title_".$this->lang;
                            echo $details[$row->table_master]->$x;
                        }
                        
                    }
                    ?>
                    </div>       
                </td>      
            </tr>
        <?php } ?>
    </table>
    <?php $pagination->generateLink(); ?> 