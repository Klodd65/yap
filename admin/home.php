<?php
    require_once 'nav.php';
    $status = UpgradeAdvisor::getStatus();
?>
<div class="container">
    <div class="row">
        <div class="col-md">
            <div class="jumbotron">
                <h1 class="display-5"><?php echo word('welcome')?>, <?php echo admin_GetUserName()?>...</h1>
                <p class="lead">Yap (<?php echo $GLOBALS['version']?>)</p>
                <button class="btn btn-sm btn-<?php echo $status['status'] ? "success" : "danger" ?>"
                        id="upgrade-advisor-details"
                        data-toggle="tooltip"
                        data-placement="bottom"
                        title="<?php echo $status['message']?>">
                    <?php echo "Status: " . ($status['status'] ? "Operational" : "Problem"); ?>
                </button>
                <hr class="my-4">
                <div class="btn-group-lg">
                    <a target="_blank" class="btn btn-info btn-md" href="https://yap.bmlt.app" role="button"><?php echo $GLOBALS['documentation']?></a>
                    <a target="_blank" class="btn btn-info btn-md" href="https://github.com/bmlt-enabled/yap/issues" role="button"><?php echo $GLOBALS['bugs_requests']?></a>
                    <a target="_blank" class="btn btn-info btn-md" href="https://github.com/bmlt-enabled/yap/blob/master/RELEASENOTES.md" role="button"><?php echo $GLOBALS['release_notes']?></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once 'footer.php';?>
<script type="text/javascript">
    $(function() {
        $("#upgrade-advisor-details").tooltip();
    })
</script>
