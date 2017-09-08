<?php
    $url = new Url(); 
?>

<script type="text/javascript">

</script>
<div class="main clearfix">
    <center>
        <h1>Không thể lấy được email</h1>
        <br>
        <form action="/kktpanel/fbaccount/index" method="GET">
            <label>Nhập email của bạn:</label>
            &nbsp;
            <input type="email" id="email" name="email" >
            <br>
            <input type="submit" class="btn-bigblue" value=" Nhập email ">
            <a onclick="window.location = '<?php echo $url->createUrl("fbaccount/logout")?>';" href="javascript:void(0)">
                <input type="button" class="btn-bigblue" value=" Thoát ">
            </a>
        </form>
    </center>
</div>
