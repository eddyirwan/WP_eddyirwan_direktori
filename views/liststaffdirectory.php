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
    .height25 {
        height:25px;
    }
    .height10 {
        height:10px;
    }
    .table {
        margin-bottom:7px;
        border-top:1px solid #cccccc;
        padding-top:2px;
    }
    #filter {
        font-size:16px;
        vertical-align: middle;
    }
    #search option{
        font-size:14px;
        vertical-align: middle;
        border:1px solid red;
    }

    </style>

    <form action="<?php echo eidir_StringHelper::getUrlAndRemoveQueryString(); ?>" method="get">
    
    <div><?php ei_localization::_output('select_text'); ?> <br/>
    <select name="filter" id="filter">
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
    </select>
    </div>
     <div class="height10"></div>
    <div>
        <?php ei_localization::_output('input_text'); ?> <br/> <input type="text" name="search" id="search" value="" />
    </div>
    <div class="height25"></div>
    <div><input type="submit" value="<?php ei_localization::_output('select_button'); ?>"/ ></div>
    </form>
    <div class="height25"></div>
    <div>
       
        <?php foreach ($rows as $row) { ?>
        <div class="table">
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
                    <div><?php ei_localization::_output('telephone'); ?> <?php echo $row->telephone; ?></div>
                    <div><?php ei_localization::_output('fax'); ?> <?php echo $row->fax; ?></div>
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
                    <div style="clear:both"></div>       
        </div>    
        
        <?php } ?>
    </div>
    <?php $eidir_pagination->generateLink(); ?> 