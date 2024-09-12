<?php

namespace PHPMaker2024\project2;

// Page object
$BookingorderReportList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { bookingorder_report: currentTable } });
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
            "check_in": <?= $Page->check_in->toClientList($Page) ?>,
            "check_out": <?= $Page->check_out->toClientList($Page) ?>,
            "refund": <?= $Page->refund->toClientList($Page) ?>,
            "booking_status": <?= $Page->booking_status->toClientList($Page) ?>,
            "name": <?= $Page->name->toClientList($Page) ?>,
            "price": <?= $Page->price->toClientList($Page) ?>,
            "status": <?= $Page->status->toClientList($Page) ?>,
            "is_verified": <?= $Page->is_verified->toClientList($Page) ?>,
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
<form name="fbookingorder_reportsrch" id="fbookingorder_reportsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="off">
<div id="fbookingorder_reportsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { bookingorder_report: currentTable } });
var currentForm;
var fbookingorder_reportsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fbookingorder_reportsrch")
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
            "check_in": <?= $Page->check_in->toClientList($Page) ?>,
            "check_out": <?= $Page->check_out->toClientList($Page) ?>,
            "refund": <?= $Page->refund->toClientList($Page) ?>,
            "booking_status": <?= $Page->booking_status->toClientList($Page) ?>,
            "name": <?= $Page->name->toClientList($Page) ?>,
            "price": <?= $Page->price->toClientList($Page) ?>,
            "status": <?= $Page->status->toClientList($Page) ?>,
            "is_verified": <?= $Page->is_verified->toClientList($Page) ?>,
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
            data-select2-id="fbookingorder_reportsrch_x_check_in"
            data-table="bookingorder_report"
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
        loadjs.ready("fbookingorder_reportsrch", function() {
            var options = {
                name: "x_check_in",
                selectId: "fbookingorder_reportsrch_x_check_in",
                ajax: { id: "x_check_in", form: "fbookingorder_reportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.bookingorder_report.fields.check_in.filterOptions);
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
            data-select2-id="fbookingorder_reportsrch_x_check_out"
            data-table="bookingorder_report"
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
        loadjs.ready("fbookingorder_reportsrch", function() {
            var options = {
                name: "x_check_out",
                selectId: "fbookingorder_reportsrch_x_check_out",
                ajax: { id: "x_check_out", form: "fbookingorder_reportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.bookingorder_report.fields.check_out.filterOptions);
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
            data-select2-id="fbookingorder_reportsrch_x_refund"
            data-table="bookingorder_report"
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
        loadjs.ready("fbookingorder_reportsrch", function() {
            var options = {
                name: "x_refund",
                selectId: "fbookingorder_reportsrch_x_refund",
                ajax: { id: "x_refund", form: "fbookingorder_reportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.bookingorder_report.fields.refund.filterOptions);
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
            data-select2-id="fbookingorder_reportsrch_x_booking_status"
            data-table="bookingorder_report"
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
        loadjs.ready("fbookingorder_reportsrch", function() {
            var options = {
                name: "x_booking_status",
                selectId: "fbookingorder_reportsrch_x_booking_status",
                ajax: { id: "x_booking_status", form: "fbookingorder_reportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.bookingorder_report.fields.booking_status.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
<?php
if (!$Page->name->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_name" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->name->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_name"
            name="x_name[]"
            class="form-control ew-select<?= $Page->name->isInvalidClass() ?>"
            data-select2-id="fbookingorder_reportsrch_x_name"
            data-table="bookingorder_report"
            data-field="x_name"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->name->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->name->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->name->editAttributes() ?>>
            <?= $Page->name->selectOptionListHtml("x_name", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->name->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbookingorder_reportsrch", function() {
            var options = {
                name: "x_name",
                selectId: "fbookingorder_reportsrch_x_name",
                ajax: { id: "x_name", form: "fbookingorder_reportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.bookingorder_report.fields.name.filterOptions);
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
            data-select2-id="fbookingorder_reportsrch_x_price"
            data-table="bookingorder_report"
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
        loadjs.ready("fbookingorder_reportsrch", function() {
            var options = {
                name: "x_price",
                selectId: "fbookingorder_reportsrch_x_price",
                ajax: { id: "x_price", form: "fbookingorder_reportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.bookingorder_report.fields.price.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
<?php
if (!$Page->status->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_status" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->status->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_status"
            name="x_status[]"
            class="form-control ew-select<?= $Page->status->isInvalidClass() ?>"
            data-select2-id="fbookingorder_reportsrch_x_status"
            data-table="bookingorder_report"
            data-field="x_status"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->status->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->status->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->status->editAttributes() ?>>
            <?= $Page->status->selectOptionListHtml("x_status", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->status->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbookingorder_reportsrch", function() {
            var options = {
                name: "x_status",
                selectId: "fbookingorder_reportsrch_x_status",
                ajax: { id: "x_status", form: "fbookingorder_reportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.bookingorder_report.fields.status.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->is_verified->Visible) { // is_verified ?>
<?php
if (!$Page->is_verified->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_is_verified" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->is_verified->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_is_verified"
            name="x_is_verified[]"
            class="form-control ew-select<?= $Page->is_verified->isInvalidClass() ?>"
            data-select2-id="fbookingorder_reportsrch_x_is_verified"
            data-table="bookingorder_report"
            data-field="x_is_verified"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->is_verified->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->is_verified->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->is_verified->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->is_verified->editAttributes() ?>>
            <?= $Page->is_verified->selectOptionListHtml("x_is_verified", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->is_verified->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbookingorder_reportsrch", function() {
            var options = {
                name: "x_is_verified",
                selectId: "fbookingorder_reportsrch_x_is_verified",
                ajax: { id: "x_is_verified", form: "fbookingorder_reportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.bookingorder_report.fields.is_verified.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fbookingorder_reportsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fbookingorder_reportsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fbookingorder_reportsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fbookingorder_reportsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<input type="hidden" name="t" value="bookingorder_report">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div id="gmp_bookingorder_report" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_bookingorder_reportlist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
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
        <th data-name="booking_id" class="<?= $Page->booking_id->headerCellClass() ?>"><div id="elh_bookingorder_report_booking_id" class="bookingorder_report_booking_id"><?= $Page->renderFieldHeader($Page->booking_id) ?></div></th>
<?php } ?>
<?php if ($Page->check_in->Visible) { // check_in ?>
        <th data-name="check_in" class="<?= $Page->check_in->headerCellClass() ?>"><div id="elh_bookingorder_report_check_in" class="bookingorder_report_check_in"><?= $Page->renderFieldHeader($Page->check_in) ?></div></th>
<?php } ?>
<?php if ($Page->check_out->Visible) { // check_out ?>
        <th data-name="check_out" class="<?= $Page->check_out->headerCellClass() ?>"><div id="elh_bookingorder_report_check_out" class="bookingorder_report_check_out"><?= $Page->renderFieldHeader($Page->check_out) ?></div></th>
<?php } ?>
<?php if ($Page->refund->Visible) { // refund ?>
        <th data-name="refund" class="<?= $Page->refund->headerCellClass() ?>"><div id="elh_bookingorder_report_refund" class="bookingorder_report_refund"><?= $Page->renderFieldHeader($Page->refund) ?></div></th>
<?php } ?>
<?php if ($Page->booking_status->Visible) { // booking_status ?>
        <th data-name="booking_status" class="<?= $Page->booking_status->headerCellClass() ?>"><div id="elh_bookingorder_report_booking_status" class="bookingorder_report_booking_status"><?= $Page->renderFieldHeader($Page->booking_status) ?></div></th>
<?php } ?>
<?php if ($Page->trans_resp_mesg->Visible) { // trans_resp_mesg ?>
        <th data-name="trans_resp_mesg" class="<?= $Page->trans_resp_mesg->headerCellClass() ?>"><div id="elh_bookingorder_report_trans_resp_mesg" class="bookingorder_report_trans_resp_mesg"><?= $Page->renderFieldHeader($Page->trans_resp_mesg) ?></div></th>
<?php } ?>
<?php if ($Page->datentime->Visible) { // datentime ?>
        <th data-name="datentime" class="<?= $Page->datentime->headerCellClass() ?>"><div id="elh_bookingorder_report_datentime" class="bookingorder_report_datentime"><?= $Page->renderFieldHeader($Page->datentime) ?></div></th>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
        <th data-name="name" class="<?= $Page->name->headerCellClass() ?>"><div id="elh_bookingorder_report_name" class="bookingorder_report_name"><?= $Page->renderFieldHeader($Page->name) ?></div></th>
<?php } ?>
<?php if ($Page->name1->Visible) { // name1 ?>
        <th data-name="name1" class="<?= $Page->name1->headerCellClass() ?>"><div id="elh_bookingorder_report_name1" class="bookingorder_report_name1"><?= $Page->renderFieldHeader($Page->name1) ?></div></th>
<?php } ?>
<?php if ($Page->price->Visible) { // price ?>
        <th data-name="price" class="<?= $Page->price->headerCellClass() ?>"><div id="elh_bookingorder_report_price" class="bookingorder_report_price"><?= $Page->renderFieldHeader($Page->price) ?></div></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Page->status->headerCellClass() ?>"><div id="elh_bookingorder_report_status" class="bookingorder_report_status"><?= $Page->renderFieldHeader($Page->status) ?></div></th>
<?php } ?>
<?php if ($Page->is_verified->Visible) { // is_verified ?>
        <th data-name="is_verified" class="<?= $Page->is_verified->headerCellClass() ?>"><div id="elh_bookingorder_report_is_verified" class="bookingorder_report_is_verified"><?= $Page->renderFieldHeader($Page->is_verified) ?></div></th>
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
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_bookingorder_report_booking_id" class="el_bookingorder_report_booking_id">
<span<?= $Page->booking_id->viewAttributes() ?>>
<?= $Page->booking_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->check_in->Visible) { // check_in ?>
        <td data-name="check_in"<?= $Page->check_in->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_bookingorder_report_check_in" class="el_bookingorder_report_check_in">
<span<?= $Page->check_in->viewAttributes() ?>>
<?= $Page->check_in->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->check_out->Visible) { // check_out ?>
        <td data-name="check_out"<?= $Page->check_out->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_bookingorder_report_check_out" class="el_bookingorder_report_check_out">
<span<?= $Page->check_out->viewAttributes() ?>>
<?= $Page->check_out->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->refund->Visible) { // refund ?>
        <td data-name="refund"<?= $Page->refund->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_bookingorder_report_refund" class="el_bookingorder_report_refund">
<span<?= $Page->refund->viewAttributes() ?>>
<?= $Page->refund->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->booking_status->Visible) { // booking_status ?>
        <td data-name="booking_status"<?= $Page->booking_status->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_bookingorder_report_booking_status" class="el_bookingorder_report_booking_status">
<span<?= $Page->booking_status->viewAttributes() ?>>
<?= $Page->booking_status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->trans_resp_mesg->Visible) { // trans_resp_mesg ?>
        <td data-name="trans_resp_mesg"<?= $Page->trans_resp_mesg->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_bookingorder_report_trans_resp_mesg" class="el_bookingorder_report_trans_resp_mesg">
<span<?= $Page->trans_resp_mesg->viewAttributes() ?>>
<?= $Page->trans_resp_mesg->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->datentime->Visible) { // datentime ?>
        <td data-name="datentime"<?= $Page->datentime->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_bookingorder_report_datentime" class="el_bookingorder_report_datentime">
<span<?= $Page->datentime->viewAttributes() ?>>
<?= $Page->datentime->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->name->Visible) { // name ?>
        <td data-name="name"<?= $Page->name->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_bookingorder_report_name" class="el_bookingorder_report_name">
<span<?= $Page->name->viewAttributes() ?>>
<?= $Page->name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->name1->Visible) { // name1 ?>
        <td data-name="name1"<?= $Page->name1->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_bookingorder_report_name1" class="el_bookingorder_report_name1">
<span<?= $Page->name1->viewAttributes() ?>>
<?= $Page->name1->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->price->Visible) { // price ?>
        <td data-name="price"<?= $Page->price->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_bookingorder_report_price" class="el_bookingorder_report_price">
<span<?= $Page->price->viewAttributes() ?>>
<?= $Page->price->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_bookingorder_report_status" class="el_bookingorder_report_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->is_verified->Visible) { // is_verified ?>
        <td data-name="is_verified"<?= $Page->is_verified->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_bookingorder_report_is_verified" class="el_bookingorder_report_is_verified">
<span<?= $Page->is_verified->viewAttributes() ?>>
<?= $Page->is_verified->getViewValue() ?></span>
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
    ew.addEventHandlers("bookingorder_report");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
