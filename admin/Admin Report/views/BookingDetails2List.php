<?php

namespace PHPMaker2024\project6;

// Page object
$BookingDetails2List = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { booking_details2: currentTable } });
var currentPageID = ew.PAGE_ID = "list";
var currentForm;
var <?= $Page->FormName ?>;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("<?= $Page->FormName ?>")
        .setPageId("list")
        .setSubmitWithFetch(<?= $Page->UseAjaxActions ? "true" : "false" ?>)
        .setFormKeyCountName("<?= $Page->FormKeyCountName ?>")

        // Dynamic selection lists
        .setLists({
            "room_name": <?= $Page->room_name->toClientList($Page) ?>,
            "price": <?= $Page->price->toClientList($Page) ?>,
            "total_pay": <?= $Page->total_pay->toClientList($Page) ?>,
            "user_name": <?= $Page->user_name->toClientList($Page) ?>,
            "check_in": <?= $Page->check_in->toClientList($Page) ?>,
            "check_out": <?= $Page->check_out->toClientList($Page) ?>,
            "refund": <?= $Page->refund->toClientList($Page) ?>,
            "booking_status": <?= $Page->booking_status->toClientList($Page) ?>,
            "trans_amt": <?= $Page->trans_amt->toClientList($Page) ?>,
            "trans_status": <?= $Page->trans_status->toClientList($Page) ?>,
            "datentime": <?= $Page->datentime->toClientList($Page) ?>,
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
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
</div>
<?php } ?>
<?php if ($Page->ShowCurrentFilter) { ?>
<?php $Page->showFilterList() ?>
<?php } ?>
<?php if (!$Page->IsModal) { ?>
<form name="fbooking_details2srch" id="fbooking_details2srch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="off">
<div id="fbooking_details2srch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { booking_details2: currentTable } });
var currentForm;
var fbooking_details2srch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fbooking_details2srch")
        .setPageId("list")
<?php if ($Page->UseAjaxActions) { ?>
        .setSubmitWithFetch(true)
<?php } ?>

        // Add fields
        .addFields([
        ])
        // Validate form
        .setValidate(
            async function () {
                if (!this.validateRequired)
                    return true; // Ignore validation
                let fobj = this.getForm();

                // Validate fields
                if (!this.validateFields())
                    return false;

                // Call Form_CustomValidate event
                if (!(await this.customValidate?.(fobj) ?? true)) {
                    this.focus();
                    return false;
                }
                return true;
            }
        )

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
            "room_name": <?= $Page->room_name->toClientList($Page) ?>,
            "price": <?= $Page->price->toClientList($Page) ?>,
            "total_pay": <?= $Page->total_pay->toClientList($Page) ?>,
            "user_name": <?= $Page->user_name->toClientList($Page) ?>,
            "check_in": <?= $Page->check_in->toClientList($Page) ?>,
            "check_out": <?= $Page->check_out->toClientList($Page) ?>,
            "refund": <?= $Page->refund->toClientList($Page) ?>,
            "booking_status": <?= $Page->booking_status->toClientList($Page) ?>,
            "trans_amt": <?= $Page->trans_amt->toClientList($Page) ?>,
            "trans_status": <?= $Page->trans_status->toClientList($Page) ?>,
            "datentime": <?= $Page->datentime->toClientList($Page) ?>,
        })

        // Filters
        .setFilterList(<?= $Page->getFilterList() ?>)
        .build();
    window[form.id] = form;
    currentSearchForm = form;
    loadjs.done(form.id);
});
</script>
<input type="hidden" name="cmd" value="search">
<?php if (!$Page->isExport() && !($Page->CurrentAction && $Page->CurrentAction != "search") && $Page->hasSearchFields()) { ?>
<div class="ew-extended-search container-fluid ps-2">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = RowType::SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->room_name->Visible) { // room_name ?>
<?php
if (!$Page->room_name->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_room_name" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->room_name->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_room_name"
            name="x_room_name[]"
            class="form-control ew-select<?= $Page->room_name->isInvalidClass() ?>"
            data-select2-id="fbooking_details2srch_x_room_name"
            data-table="booking_details2"
            data-field="x_room_name"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->room_name->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->room_name->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->room_name->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->room_name->editAttributes() ?>>
            <?= $Page->room_name->selectOptionListHtml("x_room_name", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->room_name->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbooking_details2srch", function() {
            var options = {
                name: "x_room_name",
                selectId: "fbooking_details2srch_x_room_name",
                ajax: { id: "x_room_name", form: "fbooking_details2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.booking_details2.fields.room_name.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->price->Visible) { // price ?>
<?php
if (!$Page->price->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_price" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->price->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_price"
            name="x_price[]"
            class="form-control ew-select<?= $Page->price->isInvalidClass() ?>"
            data-select2-id="fbooking_details2srch_x_price"
            data-table="booking_details2"
            data-field="x_price"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->price->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->price->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->price->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->price->editAttributes() ?>>
            <?= $Page->price->selectOptionListHtml("x_price", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->price->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbooking_details2srch", function() {
            var options = {
                name: "x_price",
                selectId: "fbooking_details2srch_x_price",
                ajax: { id: "x_price", form: "fbooking_details2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.booking_details2.fields.price.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->total_pay->Visible) { // total_pay ?>
<?php
if (!$Page->total_pay->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_total_pay" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->total_pay->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_total_pay"
            name="x_total_pay[]"
            class="form-control ew-select<?= $Page->total_pay->isInvalidClass() ?>"
            data-select2-id="fbooking_details2srch_x_total_pay"
            data-table="booking_details2"
            data-field="x_total_pay"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->total_pay->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->total_pay->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->total_pay->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->total_pay->editAttributes() ?>>
            <?= $Page->total_pay->selectOptionListHtml("x_total_pay", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->total_pay->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbooking_details2srch", function() {
            var options = {
                name: "x_total_pay",
                selectId: "fbooking_details2srch_x_total_pay",
                ajax: { id: "x_total_pay", form: "fbooking_details2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.booking_details2.fields.total_pay.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->user_name->Visible) { // user_name ?>
<?php
if (!$Page->user_name->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_user_name" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->user_name->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_user_name"
            name="x_user_name[]"
            class="form-control ew-select<?= $Page->user_name->isInvalidClass() ?>"
            data-select2-id="fbooking_details2srch_x_user_name"
            data-table="booking_details2"
            data-field="x_user_name"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->user_name->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->user_name->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->user_name->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->user_name->editAttributes() ?>>
            <?= $Page->user_name->selectOptionListHtml("x_user_name", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->user_name->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbooking_details2srch", function() {
            var options = {
                name: "x_user_name",
                selectId: "fbooking_details2srch_x_user_name",
                ajax: { id: "x_user_name", form: "fbooking_details2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.booking_details2.fields.user_name.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->check_in->Visible) { // check_in ?>
<?php
if (!$Page->check_in->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_check_in" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->check_in->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_check_in"
            name="x_check_in[]"
            class="form-control ew-select<?= $Page->check_in->isInvalidClass() ?>"
            data-select2-id="fbooking_details2srch_x_check_in"
            data-table="booking_details2"
            data-field="x_check_in"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->check_in->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->check_in->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->check_in->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->check_in->editAttributes() ?>>
            <?= $Page->check_in->selectOptionListHtml("x_check_in", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->check_in->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbooking_details2srch", function() {
            var options = {
                name: "x_check_in",
                selectId: "fbooking_details2srch_x_check_in",
                ajax: { id: "x_check_in", form: "fbooking_details2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.booking_details2.fields.check_in.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->check_out->Visible) { // check_out ?>
<?php
if (!$Page->check_out->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_check_out" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->check_out->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_check_out"
            name="x_check_out[]"
            class="form-control ew-select<?= $Page->check_out->isInvalidClass() ?>"
            data-select2-id="fbooking_details2srch_x_check_out"
            data-table="booking_details2"
            data-field="x_check_out"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->check_out->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->check_out->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->check_out->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->check_out->editAttributes() ?>>
            <?= $Page->check_out->selectOptionListHtml("x_check_out", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->check_out->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbooking_details2srch", function() {
            var options = {
                name: "x_check_out",
                selectId: "fbooking_details2srch_x_check_out",
                ajax: { id: "x_check_out", form: "fbooking_details2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.booking_details2.fields.check_out.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->refund->Visible) { // refund ?>
<?php
if (!$Page->refund->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_refund" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->refund->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_refund"
            name="x_refund[]"
            class="form-control ew-select<?= $Page->refund->isInvalidClass() ?>"
            data-select2-id="fbooking_details2srch_x_refund"
            data-table="booking_details2"
            data-field="x_refund"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->refund->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->refund->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->refund->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->refund->editAttributes() ?>>
            <?= $Page->refund->selectOptionListHtml("x_refund", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->refund->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbooking_details2srch", function() {
            var options = {
                name: "x_refund",
                selectId: "fbooking_details2srch_x_refund",
                ajax: { id: "x_refund", form: "fbooking_details2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.booking_details2.fields.refund.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->booking_status->Visible) { // booking_status ?>
<?php
if (!$Page->booking_status->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_booking_status" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->booking_status->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_booking_status"
            name="x_booking_status[]"
            class="form-control ew-select<?= $Page->booking_status->isInvalidClass() ?>"
            data-select2-id="fbooking_details2srch_x_booking_status"
            data-table="booking_details2"
            data-field="x_booking_status"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->booking_status->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->booking_status->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->booking_status->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->booking_status->editAttributes() ?>>
            <?= $Page->booking_status->selectOptionListHtml("x_booking_status", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->booking_status->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbooking_details2srch", function() {
            var options = {
                name: "x_booking_status",
                selectId: "fbooking_details2srch_x_booking_status",
                ajax: { id: "x_booking_status", form: "fbooking_details2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.booking_details2.fields.booking_status.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->trans_amt->Visible) { // trans_amt ?>
<?php
if (!$Page->trans_amt->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_trans_amt" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->trans_amt->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_trans_amt"
            name="x_trans_amt[]"
            class="form-control ew-select<?= $Page->trans_amt->isInvalidClass() ?>"
            data-select2-id="fbooking_details2srch_x_trans_amt"
            data-table="booking_details2"
            data-field="x_trans_amt"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->trans_amt->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->trans_amt->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->trans_amt->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->trans_amt->editAttributes() ?>>
            <?= $Page->trans_amt->selectOptionListHtml("x_trans_amt", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->trans_amt->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbooking_details2srch", function() {
            var options = {
                name: "x_trans_amt",
                selectId: "fbooking_details2srch_x_trans_amt",
                ajax: { id: "x_trans_amt", form: "fbooking_details2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.booking_details2.fields.trans_amt.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->trans_status->Visible) { // trans_status ?>
<?php
if (!$Page->trans_status->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_trans_status" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->trans_status->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_trans_status"
            name="x_trans_status[]"
            class="form-control ew-select<?= $Page->trans_status->isInvalidClass() ?>"
            data-select2-id="fbooking_details2srch_x_trans_status"
            data-table="booking_details2"
            data-field="x_trans_status"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->trans_status->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->trans_status->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->trans_status->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->trans_status->editAttributes() ?>>
            <?= $Page->trans_status->selectOptionListHtml("x_trans_status", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->trans_status->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbooking_details2srch", function() {
            var options = {
                name: "x_trans_status",
                selectId: "fbooking_details2srch_x_trans_status",
                ajax: { id: "x_trans_status", form: "fbooking_details2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.booking_details2.fields.trans_status.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->datentime->Visible) { // datentime ?>
<?php
if (!$Page->datentime->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_datentime" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->datentime->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_datentime"
            name="x_datentime[]"
            class="form-control ew-select<?= $Page->datentime->isInvalidClass() ?>"
            data-select2-id="fbooking_details2srch_x_datentime"
            data-table="booking_details2"
            data-field="x_datentime"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->datentime->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->datentime->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->datentime->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->datentime->editAttributes() ?>>
            <?= $Page->datentime->selectOptionListHtml("x_datentime", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->datentime->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbooking_details2srch", function() {
            var options = {
                name: "x_datentime",
                selectId: "fbooking_details2srch_x_datentime",
                ajax: { id: "x_datentime", form: "fbooking_details2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.booking_details2.fields.datentime.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
</div><!-- /.row -->
<div class="row mb-0">
    <div class="col-sm-auto px-0 pe-sm-2">
        <div class="ew-basic-search input-group">
            <input type="search" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control ew-basic-search-keyword" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>" aria-label="<?= HtmlEncode($Language->phrase("Search")) ?>">
            <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" class="ew-basic-search-type" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
            <button type="button" data-bs-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false">
                <span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fbooking_details2srch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fbooking_details2srch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fbooking_details2srch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fbooking_details2srch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
            </div>
        </div>
    </div>
    <div class="col-sm-auto mb-3">
        <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
    </div>
</div>
</div><!-- /.ew-extended-search -->
<?php } ?>
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="list<?= ($Page->TotalRecords == 0 && !$Page->isAdd()) ? " ew-no-record" : "" ?>">
<div id="ew-header-options">
<?php $Page->HeaderOptions?->render("body") ?>
</div>
<div id="ew-list">
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?= $Page->isAddOrEdit() ? " ew-grid-add-edit" : "" ?> <?= $Page->TableGridClass ?>">
<form name="<?= $Page->FormName ?>" id="<?= $Page->FormName ?>" class="ew-form ew-list-form" action="<?= $Page->PageAction ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="booking_details2">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div id="gmp_booking_details2" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_booking_details2list" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = RowType::HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->booking_id->Visible) { // booking_id ?>
        <th data-name="booking_id" class="<?= $Page->booking_id->headerCellClass() ?>"><div id="elh_booking_details2_booking_id" class="booking_details2_booking_id"><?= $Page->renderFieldHeader($Page->booking_id) ?></div></th>
<?php } ?>
<?php if ($Page->room_name->Visible) { // room_name ?>
        <th data-name="room_name" class="<?= $Page->room_name->headerCellClass() ?>"><div id="elh_booking_details2_room_name" class="booking_details2_room_name"><?= $Page->renderFieldHeader($Page->room_name) ?></div></th>
<?php } ?>
<?php if ($Page->price->Visible) { // price ?>
        <th data-name="price" class="<?= $Page->price->headerCellClass() ?>"><div id="elh_booking_details2_price" class="booking_details2_price"><?= $Page->renderFieldHeader($Page->price) ?></div></th>
<?php } ?>
<?php if ($Page->total_pay->Visible) { // total_pay ?>
        <th data-name="total_pay" class="<?= $Page->total_pay->headerCellClass() ?>"><div id="elh_booking_details2_total_pay" class="booking_details2_total_pay"><?= $Page->renderFieldHeader($Page->total_pay) ?></div></th>
<?php } ?>
<?php if ($Page->user_name->Visible) { // user_name ?>
        <th data-name="user_name" class="<?= $Page->user_name->headerCellClass() ?>"><div id="elh_booking_details2_user_name" class="booking_details2_user_name"><?= $Page->renderFieldHeader($Page->user_name) ?></div></th>
<?php } ?>
<?php if ($Page->phonenum->Visible) { // phonenum ?>
        <th data-name="phonenum" class="<?= $Page->phonenum->headerCellClass() ?>"><div id="elh_booking_details2_phonenum" class="booking_details2_phonenum"><?= $Page->renderFieldHeader($Page->phonenum) ?></div></th>
<?php } ?>
<?php if ($Page->check_in->Visible) { // check_in ?>
        <th data-name="check_in" class="<?= $Page->check_in->headerCellClass() ?>"><div id="elh_booking_details2_check_in" class="booking_details2_check_in"><?= $Page->renderFieldHeader($Page->check_in) ?></div></th>
<?php } ?>
<?php if ($Page->check_out->Visible) { // check_out ?>
        <th data-name="check_out" class="<?= $Page->check_out->headerCellClass() ?>"><div id="elh_booking_details2_check_out" class="booking_details2_check_out"><?= $Page->renderFieldHeader($Page->check_out) ?></div></th>
<?php } ?>
<?php if ($Page->refund->Visible) { // refund ?>
        <th data-name="refund" class="<?= $Page->refund->headerCellClass() ?>"><div id="elh_booking_details2_refund" class="booking_details2_refund"><?= $Page->renderFieldHeader($Page->refund) ?></div></th>
<?php } ?>
<?php if ($Page->booking_status->Visible) { // booking_status ?>
        <th data-name="booking_status" class="<?= $Page->booking_status->headerCellClass() ?>"><div id="elh_booking_details2_booking_status" class="booking_details2_booking_status"><?= $Page->renderFieldHeader($Page->booking_status) ?></div></th>
<?php } ?>
<?php if ($Page->starter_name->Visible) { // starter_name ?>
        <th data-name="starter_name" class="<?= $Page->starter_name->headerCellClass() ?>"><div id="elh_booking_details2_starter_name" class="booking_details2_starter_name"><?= $Page->renderFieldHeader($Page->starter_name) ?></div></th>
<?php } ?>
<?php if ($Page->main_course_name->Visible) { // main_course_name ?>
        <th data-name="main_course_name" class="<?= $Page->main_course_name->headerCellClass() ?>"><div id="elh_booking_details2_main_course_name" class="booking_details2_main_course_name"><?= $Page->renderFieldHeader($Page->main_course_name) ?></div></th>
<?php } ?>
<?php if ($Page->sweet_dish_name->Visible) { // sweet_dish_name ?>
        <th data-name="sweet_dish_name" class="<?= $Page->sweet_dish_name->headerCellClass() ?>"><div id="elh_booking_details2_sweet_dish_name" class="booking_details2_sweet_dish_name"><?= $Page->renderFieldHeader($Page->sweet_dish_name) ?></div></th>
<?php } ?>
<?php if ($Page->trans_amt->Visible) { // trans_amt ?>
        <th data-name="trans_amt" class="<?= $Page->trans_amt->headerCellClass() ?>"><div id="elh_booking_details2_trans_amt" class="booking_details2_trans_amt"><?= $Page->renderFieldHeader($Page->trans_amt) ?></div></th>
<?php } ?>
<?php if ($Page->trans_status->Visible) { // trans_status ?>
        <th data-name="trans_status" class="<?= $Page->trans_status->headerCellClass() ?>"><div id="elh_booking_details2_trans_status" class="booking_details2_trans_status"><?= $Page->renderFieldHeader($Page->trans_status) ?></div></th>
<?php } ?>
<?php if ($Page->datentime->Visible) { // datentime ?>
        <th data-name="datentime" class="<?= $Page->datentime->headerCellClass() ?>"><div id="elh_booking_details2_datentime" class="booking_details2_datentime"><?= $Page->renderFieldHeader($Page->datentime) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody data-page="<?= $Page->getPageNumber() ?>">
<?php
$Page->setupGrid();
while ($Page->RecordCount < $Page->StopRecord || $Page->RowIndex === '$rowindex$') {
    if (
        $Page->CurrentRow !== false &&
        $Page->RowIndex !== '$rowindex$' &&
        (!$Page->isGridAdd() || $Page->CurrentMode == "copy") &&
        (!(($Page->isCopy() || $Page->isAdd()) && $Page->RowIndex == 0))
    ) {
        $Page->fetch();
    }
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->setupRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->booking_id->Visible) { // booking_id ?>
        <td data-name="booking_id"<?= $Page->booking_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_details2_booking_id" class="el_booking_details2_booking_id">
<span<?= $Page->booking_id->viewAttributes() ?>>
<?= $Page->booking_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->room_name->Visible) { // room_name ?>
        <td data-name="room_name"<?= $Page->room_name->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_details2_room_name" class="el_booking_details2_room_name">
<span<?= $Page->room_name->viewAttributes() ?>>
<?= $Page->room_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->price->Visible) { // price ?>
        <td data-name="price"<?= $Page->price->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_details2_price" class="el_booking_details2_price">
<span<?= $Page->price->viewAttributes() ?>>
<?= $Page->price->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->total_pay->Visible) { // total_pay ?>
        <td data-name="total_pay"<?= $Page->total_pay->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_details2_total_pay" class="el_booking_details2_total_pay">
<span<?= $Page->total_pay->viewAttributes() ?>>
<?= $Page->total_pay->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->user_name->Visible) { // user_name ?>
        <td data-name="user_name"<?= $Page->user_name->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_details2_user_name" class="el_booking_details2_user_name">
<span<?= $Page->user_name->viewAttributes() ?>>
<?= $Page->user_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->phonenum->Visible) { // phonenum ?>
        <td data-name="phonenum"<?= $Page->phonenum->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_details2_phonenum" class="el_booking_details2_phonenum">
<span<?= $Page->phonenum->viewAttributes() ?>>
<?= $Page->phonenum->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->check_in->Visible) { // check_in ?>
        <td data-name="check_in"<?= $Page->check_in->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_details2_check_in" class="el_booking_details2_check_in">
<span<?= $Page->check_in->viewAttributes() ?>>
<?= $Page->check_in->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->check_out->Visible) { // check_out ?>
        <td data-name="check_out"<?= $Page->check_out->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_details2_check_out" class="el_booking_details2_check_out">
<span<?= $Page->check_out->viewAttributes() ?>>
<?= $Page->check_out->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->refund->Visible) { // refund ?>
        <td data-name="refund"<?= $Page->refund->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_details2_refund" class="el_booking_details2_refund">
<span<?= $Page->refund->viewAttributes() ?>>
<?= $Page->refund->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->booking_status->Visible) { // booking_status ?>
        <td data-name="booking_status"<?= $Page->booking_status->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_details2_booking_status" class="el_booking_details2_booking_status">
<span<?= $Page->booking_status->viewAttributes() ?>>
<?= $Page->booking_status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->starter_name->Visible) { // starter_name ?>
        <td data-name="starter_name"<?= $Page->starter_name->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_details2_starter_name" class="el_booking_details2_starter_name">
<span<?= $Page->starter_name->viewAttributes() ?>>
<?= $Page->starter_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->main_course_name->Visible) { // main_course_name ?>
        <td data-name="main_course_name"<?= $Page->main_course_name->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_details2_main_course_name" class="el_booking_details2_main_course_name">
<span<?= $Page->main_course_name->viewAttributes() ?>>
<?= $Page->main_course_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sweet_dish_name->Visible) { // sweet_dish_name ?>
        <td data-name="sweet_dish_name"<?= $Page->sweet_dish_name->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_details2_sweet_dish_name" class="el_booking_details2_sweet_dish_name">
<span<?= $Page->sweet_dish_name->viewAttributes() ?>>
<?= $Page->sweet_dish_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->trans_amt->Visible) { // trans_amt ?>
        <td data-name="trans_amt"<?= $Page->trans_amt->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_details2_trans_amt" class="el_booking_details2_trans_amt">
<span<?= $Page->trans_amt->viewAttributes() ?>>
<?= $Page->trans_amt->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->trans_status->Visible) { // trans_status ?>
        <td data-name="trans_status"<?= $Page->trans_status->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_details2_trans_status" class="el_booking_details2_trans_status">
<span<?= $Page->trans_status->viewAttributes() ?>>
<?= $Page->trans_status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->datentime->Visible) { // datentime ?>
        <td data-name="datentime"<?= $Page->datentime->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_details2_datentime" class="el_booking_details2_datentime">
<span<?= $Page->datentime->viewAttributes() ?>>
<?= $Page->datentime->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }

    // Reset for template row
    if ($Page->RowIndex === '$rowindex$') {
        $Page->RowIndex = 0;
    }
    // Reset inline add/copy row
    if (($Page->isCopy() || $Page->isAdd()) && $Page->RowIndex == 0) {
        $Page->RowIndex = 1;
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction && !$Page->UseAjaxActions) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close result set
$Page->Recordset?->free();
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd() && !($Page->isGridEdit() && $Page->ModalGridEdit) && !$Page->isMultiEdit()) { ?>
<?= $Page->Pager->render() ?>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
</div>
<div id="ew-footer-options">
<?php $Page->FooterOptions?->render("body") ?>
</div>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("booking_details2");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
