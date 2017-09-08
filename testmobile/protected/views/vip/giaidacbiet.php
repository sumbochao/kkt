


            <?php if(isset($data)){?>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr class="bg_cam">
                        <td class="SM_1"><p style="color: #000;">Giải đặc biệt</p></td>
                        <td class="SM_1"><p style="color: #000;">Ngày về</p></td>
                        <td class="SM_1"><p style="color: #000;">Năm</p></td>
                    </tr>
                </table>
                <table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#e6e6e6">

                    <?php for($i=0;$i<count($data);$i++){?>
                        <tr class="bg_white">
                            <td class="SM_1">
                                <?php echo $data[$i]['giai_dacbiet'];?>
                            </td>
                            <td class="SM_1">
                                <?php echo $data[$i]['ngay'];?>
                            </td>
                            <td class="SM_1">
                                <?php echo $data[$i]['nam'];?>
                            </td>
                        </tr>
                        <?php }?>
                </table>
                <?php }?>
