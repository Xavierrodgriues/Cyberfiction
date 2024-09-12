<?php

namespace PHPMaker2024\project4;

// Page object
$AdminCredAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { admin_cred: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fadmin_credadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fadmin_credadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["sr_no", [fields.sr_no.visible && fields.sr_no.required ? ew.Validators.required(fields.sr_no.caption) : null, ew.Validators.integer], fields.sr_no.isInvalid],
            ["admin_name", [fields.admin_name.visible && fields.admin_name.required ? ew.Validators.required(fields.admin_name.caption) : null], fields.admin_name.isInvalid],
            ["admin_pass", [fields.admin_pass.visible && fields.admin_pass.required ? ew.Validators.required(fields.admin_pass.caption) : null], fields.admin_pass.isInvalid]
        ])

        // Form_CustomValidate
        .setCustomValidate(
            function (fobj) { // DO NOT CHANGE THIS LINE! (except for adding "async" keyword)!
                    // Your custom validation code here, return false if invalid.
                    return true;
                }
        )

        // Use JavaScript validation or not
        .setValidateRequired(ew.CLIENT_VALIDATE)

        // Dynamic selection lists
        .setLists({
        })
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
<form name="fadmin_credadd" id="fadmin_credadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="admin_cred">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->sr_no->Visible) { // sr_no ?>
    <div id="r_sr_no"<?= $Page->sr_no->rowAttributes() ?>>
        <label id="elh_admin_cred_sr_no" for="x_sr_no" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sr_no->caption() ?><?= $Page->sr_no->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sr_no->cellAttributes() ?>>
<span id="el_admin_cred_sr_no">
<input type="<?= $Page->sr_no->getInputTextType() ?>" name="x_sr_no" id="x_sr_no" data-table="admin_cred" data-field="x_sr_no" value="<?= $Page->sr_no->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->sr_no->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->sr_no->formatPattern()) ?>"<?= $Page->sr_no->editAttributes() ?> aria-describedby="x_sr_no_help">
<?= $Page->sr_no->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sr_no->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->admin_name->Visible) { // admin_name ?>
    <div id="r_admin_name"<?= $Page->admin_name->rowAttributes() ?>>
        <label id="elh_admin_cred_admin_name" for="x_admin_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->admin_name->caption() ?><?= $Page->admin_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->admin_name->cellAttributes() ?>>
<span id="el_admin_cred_admin_name">
<input type="<?= $Page->admin_name->getInputTextType() ?>" name="x_admin_name" id="x_admin_name" data-table="admin_cred" data-field="x_admin_name" value="<?= $Page->admin_name->EditValue ?>" size="30" maxlength="150" placeholder="<?= HtmlEncode($Page->admin_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->admin_name->formatPattern()) ?>"<?= $Page->admin_name->editAttributes() ?> aria-describedby="x_admin_name_help">
<?= $Page->admin_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->admin_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->admin_pass->Visible) { // admin_pass ?>
    <div id="r_admin_pass"<?= $Page->admin_pass->rowAttributes() ?>>
        <label id="elh_admin_cred_admin_pass" for="x_admin_pass" class="<?= $Page->LeftColumnClass ?>"><?= $Page->admin_pass->caption() ?><?= $Page->admin_pass->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->admin_pass->cellAttributes() ?>>
<span id="el_admin_cred_admin_pass">
<input type="<?= $Page->admin_pass->getInputTextType() ?>" name="x_admin_pass" id="x_admin_pass" data-table="admin_cred" data-field="x_admin_pass" value="<?= $Page->admin_pass->EditValue ?>" size="30" maxlength="150" placeholder="<?= HtmlEncode($Page->admin_pass->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->admin_pass->formatPattern()) ?>"<?= $Page->admin_pass->editAttributes() ?> aria-describedby="x_admin_pass_help">
<?= $Page->admin_pass->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->admin_pass->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fadmin_credadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fadmin_credadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
    </div><!-- /buttons offset -->
<?= $Page->IsModal ? "</template>" : "</div>" ?><!-- /buttons .row -->
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("admin_cred");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
