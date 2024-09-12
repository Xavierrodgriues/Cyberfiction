<?php

namespace PHPMaker2024\project4;

// Page object
$AdminCredDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { admin_cred: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fadmin_creddelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fadmin_creddelete")
        .setPageId("delete")
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
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fadmin_creddelete" id="fadmin_creddelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="admin_cred">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid <?= $Page->TableGridClass ?>">
<div class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<table class="<?= $Page->TableClass ?>">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->sr_no->Visible) { // sr_no ?>
        <th class="<?= $Page->sr_no->headerCellClass() ?>"><span id="elh_admin_cred_sr_no" class="admin_cred_sr_no"><?= $Page->sr_no->caption() ?></span></th>
<?php } ?>
<?php if ($Page->admin_name->Visible) { // admin_name ?>
        <th class="<?= $Page->admin_name->headerCellClass() ?>"><span id="elh_admin_cred_admin_name" class="admin_cred_admin_name"><?= $Page->admin_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->admin_pass->Visible) { // admin_pass ?>
        <th class="<?= $Page->admin_pass->headerCellClass() ?>"><span id="elh_admin_cred_admin_pass" class="admin_cred_admin_pass"><?= $Page->admin_pass->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while ($Page->fetch()) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = RowType::VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->CurrentRow);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->sr_no->Visible) { // sr_no ?>
        <td<?= $Page->sr_no->cellAttributes() ?>>
<span id="">
<span<?= $Page->sr_no->viewAttributes() ?>>
<?= $Page->sr_no->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->admin_name->Visible) { // admin_name ?>
        <td<?= $Page->admin_name->cellAttributes() ?>>
<span id="">
<span<?= $Page->admin_name->viewAttributes() ?>>
<?= $Page->admin_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->admin_pass->Visible) { // admin_pass ?>
        <td<?= $Page->admin_pass->cellAttributes() ?>>
<span id="">
<span<?= $Page->admin_pass->viewAttributes() ?>>
<?= $Page->admin_pass->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
}
$Page->Recordset?->free();
?>
</tbody>
</table>
</div>
</div>
<div class="ew-buttons ew-desktop-buttons">
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
