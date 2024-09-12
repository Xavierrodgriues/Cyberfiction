<?php

namespace PHPMaker2024\project4;

// Page object
$AdminCredView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="view">
<form name="fadmin_credview" id="fadmin_credview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { admin_cred: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fadmin_credview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fadmin_credview")
        .setPageId("view")
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="admin_cred">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->sr_no->Visible) { // sr_no ?>
    <tr id="r_sr_no"<?= $Page->sr_no->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_admin_cred_sr_no"><?= $Page->sr_no->caption() ?></span></td>
        <td data-name="sr_no"<?= $Page->sr_no->cellAttributes() ?>>
<span id="el_admin_cred_sr_no">
<span<?= $Page->sr_no->viewAttributes() ?>>
<?= $Page->sr_no->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->admin_name->Visible) { // admin_name ?>
    <tr id="r_admin_name"<?= $Page->admin_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_admin_cred_admin_name"><?= $Page->admin_name->caption() ?></span></td>
        <td data-name="admin_name"<?= $Page->admin_name->cellAttributes() ?>>
<span id="el_admin_cred_admin_name">
<span<?= $Page->admin_name->viewAttributes() ?>>
<?= $Page->admin_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->admin_pass->Visible) { // admin_pass ?>
    <tr id="r_admin_pass"<?= $Page->admin_pass->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_admin_cred_admin_pass"><?= $Page->admin_pass->caption() ?></span></td>
        <td data-name="admin_pass"<?= $Page->admin_pass->cellAttributes() ?>>
<span id="el_admin_cred_admin_pass">
<span<?= $Page->admin_pass->viewAttributes() ?>>
<?= $Page->admin_pass->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
