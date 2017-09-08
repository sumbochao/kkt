<?php
    $url = new Url();
    $arr_action = LogConfig::$action; 
    $arr_object = LogConfig::$object;
    $current_url = Common::getCurrentUrl();
    $path_paging = strpos($current_url,'?') !==false ? $current_url.'&' : $current_url.'?';
    $path_paging = str_replace("?page=".$page."&","?",$path_paging);
    $path_paging = str_replace("&page=".$page."&","&",$path_paging);
?>
<div class="main clearfix">
    <div class="box clearfix bottom30">
        <form method="GET">
            <ul class="form4">
                <li class="clearfix"><label><strong>Từ ngày </strong>:</label>
                    <div class="filltext">
                        <?php
                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'from_date',
                            'id' => 'from_date',
                            'value' => $from_date,
                            // additional javascript options for the date picker plugin
                            'options' => array(
                            'showAnim' => 'fold',
                            'dateFormat' => 'dd-mm-yy',
                            'changeYear' => 'true',
                            'changeMonth' => 'true',
                            'showOn' => 'both',
                            'buttonText' => '...'
                            ),
                            'htmlOptions' => array(
                            'style' => 'width:170px',
                            'class' => 'form',
                            ),
                            ));
                        ?> 
                        &nbsp;đến ngày &nbsp; 
                        <?php
                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'to_date',
                            'id' => 'to_date',
                            'value' => $to_date,
                            // additional javascript options for the date picker plugin
                            'options' => array(
                            'showAnim' => 'fold',
                            'dateFormat' => 'dd-mm-yy',
                            'changeYear' => 'true',
                            'changeMonth' => 'true',
                            'showOn' => 'both',
                            'buttonText' => '...'
                            ),
                            'htmlOptions' => array(
                            'style' => 'width:170px',
                            'class' => 'form',
                            ),
                            ));
                        ?> 
                    </div>
                </li>
                <li class="clearfix"><label><strong>Tài khoản </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:196px;margin-right:28px" value="<?php echo $username?>" name="username"> 
                </li>
                <li class="clearfix"><label><strong>Từ khóa </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:196px;margin-right:28px" value="<?php echo $keyword?>" name="keyword">
                    </div>
                </li>
                <li class="clearfix"><label><strong>Hành động </strong>:</label>
                    <div class="filltext">
                        <select style="width:203px;" name="action">
                            <option value="0">--Tất cả--</option>
                            <?php foreach($arr_action as $key=>$value){?>
                                <option value="<?php echo $key;?>" <?php echo ($action == $key ? 'selected="selected"':'' )?>><?php echo $value;?></option>
                                <?php }?>
                        </select>
                        &nbsp; Module:
                        <select style="width:203px;" name="object">
                            <option value="0">--Tất cả--</option>
                            <?php foreach($arr_object as $key=>$value){?>
                                <option value="<?php echo $key;?>" <?php echo ($object == $key ? 'selected="selected"':'' )?>><?php echo $value;?></option>
                                <?php }?>
                        </select>
                    </div>
                </li>
                <li class="clearfix"><label>&nbsp;</label>
                    <div class="filltext">
                        <input type="submit" value=" Tìm kiếm" class="btn-bigblue"> 
                    </div>
                </li>

            </ul>
        </form>
    </div>
    <div class="box">
        <div class="fillter clearfix">
            <div class="fl">
                Tìm thấy <strong class="clred"><?php echo $count; ?></strong> kết quả 
            </div>
            <div class="fr">
                <ul class="paging">
                    <?php
                        echo Paging::show_paging_cp($max_page,$page,$path_paging);
                    ?>
                </ul>
            </div>
        </div>
        <div class="table clearfix">
            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tbody>
                    <tr class="bg-grey">
                        <td width="3%"><strong>STT</strong></td>
                        <td width="10%"><strong>Username</strong></td>
                        <td width="13%"><strong>Hành động </strong></td>
                        <td width="13%"><strong>Module</strong></td>
                        <td width="40%"><strong>Nội dung</strong></td>
                        <td width="10%"><strong>Ngày thực hiện</strong></td>
                    </tr>
                    <?php 
                        $i=0;
                        foreach($data as $key=>$value){
                            $i++;
                        ?>
                        <tr>
                            <td><?php echo $i?></td>                           
                            <td><?php echo $value["username"]?></td>
                            <td><?php echo $arr_action[$value["action"]]?></td>
                            <td><?php echo $arr_object[$value["object"]]?></td>
                            <td style="text-align: left;"><?php echo $value["content"]?></td>
                            <td><?php echo date("d-m-Y H:i:s",$value["create_date"])?></td>
                        </tr>
                        <?php }?>
                </tbody>
            </table>
        </div> 
        <div class="fillter clearfix">
            <div class="fr">
                <ul class="paging">
                    <?php
                        echo Paging::show_paging_cp($max_page,$page,$path_paging);
                    ?>
                </ul>
            </div>
        </div>

    </div>
</div>