 <?php if (count($suggests)>0) {?>
<div align="left" style="padding: 0px; width: 200px; z-index: 500; display: block;">
        <table width="100%" cellspacing="0" cellpadding="2" style="background-color: rgb(255, 255, 255);">
            <tbody>
               <?php foreach ($suggests as $suggest) { ?>
                <tr id="<?php echo $suggest["id"]?>" onclick="setName(<?php echo $suggest["id"]?>,'<?php echo $suggest["name"]?>')">
                    <td width="100%" >
                        <span><?php echo $suggest["name"]?></span>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
</div>
<?php } ?>