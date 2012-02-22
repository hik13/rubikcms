<?php $active_class_li="module-submenu-active"; ?>

<?php if ($punktscommand) { ?>

<ul class="module-submenu clearfix">
        <?php  foreach($punktscommand as $punkt) { ?>
    <li <?php if ($punkt["active"]) echo "class='".$active_class_li."'" ?>>
        <div class="module-submenu-center">
            <div class="module-submenu-right"></div>
            <div class="module-submenu-left"></div>
            <?php if ($punkt["active"]) { ?>
            <a href="<?php echo $punkt["action"] ?>"><?php echo $punkt["name"] ?></a>
            <?php } else  echo $punkt["name"] ;?>
        </div>
    </li>
            <?php } ?>
</ul>
<?php } ?>
