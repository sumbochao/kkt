
            <?php if(isset($data)){?>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr class="bg_cam">
                        <td class="SM_1"><p style="color: #000;">Bộ Số</p></td>
                        <td class="SM_1"><p style="color: #000;">Độ dài chu kỳ </p></td>
                        <td class="SM_1"><p style="color: #000;">Ngày về</p></td>
                    </tr>
                </table>
                <table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#e6e6e6">

                    <?php for($i=0;$i<count($data);$i++){?>
                        <tr class="bg_white">
                            <td class="SM_1">
                                <?php echo $data[$i]['boso'];?>
                            </td>
                            <td class="SM_1">
                                <?php echo $data[$i]['dodai_chuky'];?>
                            </td>
                            <td class="SM_1">
                                <?php echo $data[$i]['end_date'];?>
                            </td>
                        </tr>
                        <?php }?>
                </table>
                <?php }?>