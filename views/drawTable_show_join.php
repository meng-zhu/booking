<table  style="border:3px #FFAC55 dashed;padding:5px;" rules="all" cellpadding='5' width="1000" align="center";>
    <tr>
        <td COLSPAN=3><CENTER><h2>出席名單</h2></CENTER></td>
    </tr>
    <tr>
        <td><CENTER><strong>員工編號</strong></CENTER></td>
        <td><CENTER><strong>員工名稱</strong></CENTER></td>
        <td><CENTER><strong>攜伴人數</strong></CENTER></td>
    </tr>
    <?php foreach($data as $key2){ ?>
    <tr>
        <td><CENTER><?php echo $key2['eId']; ?></CENTER></td>
        <td><CENTER><?php echo $key2['name']; ?></CENTER></td>
        <td><CENTER><?php echo $key2['partner']; ?></CENTER></td>
    </tr>
    <?php } ?>
</table>