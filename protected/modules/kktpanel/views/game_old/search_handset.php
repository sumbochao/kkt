<?php $url = new Url();?>
<script type="text/javascript">
    $(document).ready(function(){     
        $("#check_all_hs").click(function(){
            $("input[name=check_id_hs]").each(function(){this.checked = true;});
        });
        $("#uncheck_all_hs").click(function(){
            $("input[name=check_id_hs]").each(function(){this.checked = false;});
        });
    });
    var arr_hs = <?php echo json_encode($arr_hs)?>;
    function ajaxSearchHandset(){
        var keyword = $("#keyword").val();
        var manufacturer = $("#manufacturer").val();
        if(manufacturer ==""){alert('Chưa chọn thiết bị');return false;};
        var strUrl = "<?=$url->createUrl("game/ajaxSearchHandset") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                keyword:keyword,
                manufacturer:manufacturer,
            },
            success: function(msg){
                $("#list_search_handset").html(msg);
            }          
        });
    }
    function removeDevice(id){
        $("#area_device_"+$("#type_game").val()+id).remove();
    }
    function removeAllDevice(){
        if(confirm('Bạn có muốn xóa toàn bộ thiết bị không ?')){
            $("input[name=device_"+$("#type_game").val()+"]").each(function(){
                removeDevice(this.value);
            });
        }
    }
    function setOneHandset(id){

        if(typeof($("#device_"+$("#type_game").val()+id).val()) =="undefined"){ 
            var msg = '<div class="fl area_device" style="margin-right:20px" id="area_device_'+$("#type_game").val()+id+'">';
            msg += '<input type="hidden" name="device_'+$("#type_game").val()+'" id="device_'+$("#type_game").val()+id+'" value="'+id+'"/>';
            msg += '<a href="javascript:void(0)" onclick="removeDevice('+id+')" class="icon-delete"></a><span>'+arr_hs[id]+'</span></div>';
            $("#list_devices_"+$("#type_game").val()).append(msg);
            $("#m_handset_"+id).remove();
        }else{
            alert('Bạn đã thêm thiết bị này rồi!');
        }
    }
    function setManyHandset(){

        var item = $("input[name=check_id_hs]:checked");
        if(item.length==0){
            alert('Phải chọn ít nhất 1 thiết bị! ');
            return false;
        }        
        item.each(function(){ 
            if(typeof($("#device_"+$("#type_game").val()+this.value).val()) =="undefined"){
                var msg = "";
                msg += '<div class="fl area_device" style="margin-right:20px" id="area_device_'+$("#type_game").val()+this.value+'">';
                msg += '<input type="hidden" name="device_'+$("#type_game").val()+'" id="device_'+$("#type_game").val()+this.value+'" value="'+this.value+'"/>';
                msg += '<a href="javascript:void(0)" onclick="removeDevice('+this.value+')" class="icon-delete"></a><span>'+arr_hs[this.value]+'</span></div>';  
                $("#list_devices_"+$("#type_game").val()).append(msg);
                $("#m_handset_"+this.value).remove();
            }
        });
        //$.fn.colorbox.close();
    }
</script>
<h3><span><strong class="s18">Tìm kiếm </strong></span></h3>
<div class="popup-cont clearfix">
    <div class="box clearfix">
        <p>
            <select style="width:190px" id="manufacturer">
                <?php foreach($data_handset as $key=>$value){?>
                    <option value="<?php echo $value["manufacturer"]?>"> <?php echo $value["manufacturer"]?> </option>
                    <?php }?>
            </select>
            <input type="button" class="btn-bigblue" value=" Tìm kiếm " onclick="ajaxSearchHandset();">
        </p>
        <p><textarea cols="5" rows="5" style="width:98%; height:55px" id="keyword"></textarea></p>
        <p>
            <a id="check_all_hs" href="javascript:void(0)"><strong> [Check All] </strong></a> &nbsp; 
            <a id="uncheck_all_hs" href="javascript:void(0)"> <strong>[UnCheck All]</strong> </a> &nbsp; 
            <a href="javascript:void(0)" onclick="setManyHandset();" class="save"> <strong>[Lưu]</strong> </a></p>
        <div style="height:400px; overflow-y:auto" class="box_cont table">
            <ul class="list-col3" id="list_search_handset">
            </ul>                         
        </div>

    </div>
    </div>
