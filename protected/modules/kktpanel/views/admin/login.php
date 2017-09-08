<div class="admin">
    <div class="title-admin">
        <b>Login Administrator</b>
    </div>
    <div class="admin-cont clearfix">
    <?php echo CHtml::beginForm()?>
        <label style="color: red; text-align: center;"><?php echo CHtml::errorSummary($model,"&nbsp;")?></label>
        <ul class="form">
            <li class="clearfix"><label><strong>Tên đăng nhập:</strong></label>
                <div class="filltext clearfix">
                    <p><?php echo CHtml::activeTextField($model,"username",array("class"=>"input1"));?>

                    </p>
                </div>
            </li>
            <li class="clearfix"><label><strong>Mật khẩu</strong></label>
                <div class="filltext clearfix">
                    <p>
                    <?php echo CHtml::activePasswordField($model,"password",array("class"=>"input1"));?>
                    </p>
                    <p><?php echo CHtml::activeHiddenField($model,"remember")?></p>
                    <p><input type="submit" value="Đăng nhập"/></p>
                </div>
            </li>
        </ul>
    <?php echo CHtml::endForm();?>
    </div>
</div>