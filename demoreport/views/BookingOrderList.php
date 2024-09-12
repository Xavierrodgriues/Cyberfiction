<?php

namespace PHPMaker2024\project1;

// Page object
$BookingOrderList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { booking_order: currentTable } });
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
<?php if (!$Page->IsModal) { ?>
<form name="fbooking_ordersrch" id="fbooking_ordersrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="off">
<div id="fbooking_ordersrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { booking_order: currentTable } });
var currentForm;
var fbooking_ordersrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fbooking_ordersrch")
        .setPageId("list")
<?php if ($Page->UseAjaxActions) { ?>
        .setSubmitWithFetch(true)
<?php } ?>

        // Dynamic selection lists
        .setLists({
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
<div class="row mb-0">
    <div class="col-sm-auto px-0 pe-sm-2">
        <div class="ew-basic-search input-group">
            <input type="search" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control ew-basic-search-keyword" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>" aria-label="<?= HtmlEncode($Language->phrase("Search")) ?>">
            <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" class="ew-basic-search-type" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
            <button type="button" data-bs-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false">
                <span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fbooking_ordersrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fbooking_ordersrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fbooking_ordersrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fbooking_ordersrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<input type="hidden" name="t" value="booking_order">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div id="gmp_booking_order" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_booking_orderlist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
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
        <th data-name="booking_id" class="<?= $Page->booking_id->headerCellClass() ?>"><div id="elh_booking_order_booking_id" class="booking_order_booking_id"><?= $Page->renderFieldHeader($Page->booking_id) ?></div></th>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
        <th data-name="user_id" class="<?= $Page->user_id->headerCellClass() ?>"><div id="elh_booking_order_user_id" class="booking_order_user_id"><?= $Page->renderFieldHeader($Page->user_id) ?></div></th>
<?php } ?>
<?php if ($Page->room_id->Visible) { // room_id ?>
        <th data-name="room_id" class="<?= $Page->room_id->headerCellClass() ?>"><div id="elh_booking_order_room_id" class="booking_order_room_id"><?= $Page->renderFieldHeader($Page->room_id) ?></div></th>
<?php } ?>
<?php if ($Page->check_in->Visible) { // check_in ?>
        <th data-name="check_in" class="<?= $Page->check_in->headerCellClass() ?>"><div id="elh_booking_order_check_in" class="booking_order_check_in"><?= $Page->renderFieldHeader($Page->check_in) ?></div></th>
<?php } ?>
<?php if ($Page->check_out->Visible) { // check_out ?>
        <th data-name="check_out" class="<?= $Page->check_out->headerCellClass() ?>"><div id="elh_booking_order_check_out" class="booking_order_check_out"><?= $Page->renderFieldHeader($Page->check_out) ?></div></th>
<?php } ?>
<?php if ($Page->arrival->Visible) { // arrival ?>
        <th data-name="arrival" class="<?= $Page->arrival->headerCellClass() ?>"><div id="elh_booking_order_arrival" class="booking_order_arrival"><?= $Page->renderFieldHeader($Page->arrival) ?></div></th>
<?php } ?>
<?php if ($Page->refund->Visible) { // refund ?>
        <th data-name="refund" class="<?= $Page->refund->headerCellClass() ?>"><div id="elh_booking_order_refund" class="booking_order_refund"><?= $Page->renderFieldHeader($Page->refund) ?></div></th>
<?php } ?>
<?php if ($Page->booking_status->Visible) { // booking_status ?>
        <th data-name="booking_status" class="<?= $Page->booking_status->headerCellClass() ?>"><div id="elh_booking_order_booking_status" class="booking_order_booking_status"><?= $Page->renderFieldHeader($Page->booking_status) ?></div></th>
<?php } ?>
<?php if ($Page->order_id->Visible) { // order_id ?>
        <th data-name="order_id" class="<?= $Page->order_id->headerCellClass() ?>"><div id="elh_booking_order_order_id" class="booking_order_order_id"><?= $Page->renderFieldHeader($Page->order_id) ?></div></th>
<?php } ?>
<?php if ($Page->starter_name->Visible) { // starter_name ?>
        <th data-name="starter_name" class="<?= $Page->starter_name->headerCellClass() ?>"><div id="elh_booking_order_starter_name" class="booking_order_starter_name"><?= $Page->renderFieldHeader($Page->starter_name) ?></div></th>
<?php } ?>
<?php if ($Page->main_course_name->Visible) { // main_course_name ?>
        <th data-name="main_course_name" class="<?= $Page->main_course_name->headerCellClass() ?>"><div id="elh_booking_order_main_course_name" class="booking_order_main_course_name"><?= $Page->renderFieldHeader($Page->main_course_name) ?></div></th>
<?php } ?>
<?php if ($Page->sweet_dish_name->Visible) { // sweet_dish_name ?>
        <th data-name="sweet_dish_name" class="<?= $Page->sweet_dish_name->headerCellClass() ?>"><div id="elh_booking_order_sweet_dish_name" class="booking_order_sweet_dish_name"><?= $Page->renderFieldHeader($Page->sweet_dish_name) ?></div></th>
<?php } ?>
<?php if ($Page->trans_id->Visible) { // trans_id ?>
        <th data-name="trans_id" class="<?= $Page->trans_id->headerCellClass() ?>"><div id="elh_booking_order_trans_id" class="booking_order_trans_id"><?= $Page->renderFieldHeader($Page->trans_id) ?></div></th>
<?php } ?>
<?php if ($Page->trans_amt->Visible) { // trans_amt ?>
        <th data-name="trans_amt" class="<?= $Page->trans_amt->headerCellClass() ?>"><div id="elh_booking_order_trans_amt" class="booking_order_trans_amt"><?= $Page->renderFieldHeader($Page->trans_amt) ?></div></th>
<?php } ?>
<?php if ($Page->trans_status->Visible) { // trans_status ?>
        <th data-name="trans_status" class="<?= $Page->trans_status->headerCellClass() ?>"><div id="elh_booking_order_trans_status" class="booking_order_trans_status"><?= $Page->renderFieldHeader($Page->trans_status) ?></div></th>
<?php } ?>
<?php if ($Page->trans_resp_mesg->Visible) { // trans_resp_mesg ?>
        <th data-name="trans_resp_mesg" class="<?= $Page->trans_resp_mesg->headerCellClass() ?>"><div id="elh_booking_order_trans_resp_mesg" class="booking_order_trans_resp_mesg"><?= $Page->renderFieldHeader($Page->trans_resp_mesg) ?></div></th>
<?php } ?>
<?php if ($Page->rate_review->Visible) { // rate_review ?>
        <th data-name="rate_review" class="<?= $Page->rate_review->headerCellClass() ?>"><div id="elh_booking_order_rate_review" class="booking_order_rate_review"><?= $Page->renderFieldHeader($Page->rate_review) ?></div></th>
<?php } ?>
<?php if ($Page->datentime->Visible) { // datentime ?>
        <th data-name="datentime" class="<?= $Page->datentime->headerCellClass() ?>"><div id="elh_booking_order_datentime" class="booking_order_datentime"><?= $Page->renderFieldHeader($Page->datentime) ?></div></th>
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
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_order_booking_id" class="el_booking_order_booking_id">
<span<?= $Page->booking_id->viewAttributes() ?>>
<?= $Page->booking_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->user_id->Visible) { // user_id ?>
        <td data-name="user_id"<?= $Page->user_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_order_user_id" class="el_booking_order_user_id">
<span<?= $Page->user_id->viewAttributes() ?>>
<?= $Page->user_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->room_id->Visible) { // room_id ?>
        <td data-name="room_id"<?= $Page->room_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_order_room_id" class="el_booking_order_room_id">
<span<?= $Page->room_id->viewAttributes() ?>>
<?= $Page->room_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->check_in->Visible) { // check_in ?>
        <td data-name="check_in"<?= $Page->check_in->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_order_check_in" class="el_booking_order_check_in">
<span<?= $Page->check_in->viewAttributes() ?>>
<?= $Page->check_in->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->check_out->Visible) { // check_out ?>
        <td data-name="check_out"<?= $Page->check_out->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_order_check_out" class="el_booking_order_check_out">
<span<?= $Page->check_out->viewAttributes() ?>>
<?= $Page->check_out->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->arrival->Visible) { // arrival ?>
        <td data-name="arrival"<?= $Page->arrival->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_order_arrival" class="el_booking_order_arrival">
<span<?= $Page->arrival->viewAttributes() ?>>
<?= $Page->arrival->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->refund->Visible) { // refund ?>
        <td data-name="refund"<?= $Page->refund->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_order_refund" class="el_booking_order_refund">
<span<?= $Page->refund->viewAttributes() ?>>
<?= $Page->refund->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->booking_status->Visible) { // booking_status ?>
        <td data-name="booking_status"<?= $Page->booking_status->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_order_booking_status" class="el_booking_order_booking_status">
<span<?= $Page->booking_status->viewAttributes() ?>>
<?= $Page->booking_status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->order_id->Visible) { // order_id ?>
        <td data-name="order_id"<?= $Page->order_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_order_order_id" class="el_booking_order_order_id">
<span<?= $Page->order_id->viewAttributes() ?>>
<?= $Page->order_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->starter_name->Visible) { // starter_name ?>
        <td data-name="starter_name"<?= $Page->starter_name->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_order_starter_name" class="el_booking_order_starter_name">
<span<?= $Page->starter_name->viewAttributes() ?>>
<?= $Page->starter_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->main_course_name->Visible) { // main_course_name ?>
        <td data-name="main_course_name"<?= $Page->main_course_name->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_order_main_course_name" class="el_booking_order_main_course_name">
<span<?= $Page->main_course_name->viewAttributes() ?>>
<?= $Page->main_course_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sweet_dish_name->Visible) { // sweet_dish_name ?>
        <td data-name="sweet_dish_name"<?= $Page->sweet_dish_name->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_order_sweet_dish_name" class="el_booking_order_sweet_dish_name">
<span<?= $Page->sweet_dish_name->viewAttributes() ?>>
<?= $Page->sweet_dish_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->trans_id->Visible) { // trans_id ?>
        <td data-name="trans_id"<?= $Page->trans_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_order_trans_id" class="el_booking_order_trans_id">
<span<?= $Page->trans_id->viewAttributes() ?>>
<?= $Page->trans_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->trans_amt->Visible) { // trans_amt ?>
        <td data-name="trans_amt"<?= $Page->trans_amt->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_order_trans_amt" class="el_booking_order_trans_amt">
<span<?= $Page->trans_amt->viewAttributes() ?>>
<?= $Page->trans_amt->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->trans_status->Visible) { // trans_status ?>
        <td data-name="trans_status"<?= $Page->trans_status->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_order_trans_status" class="el_booking_order_trans_status">
<span<?= $Page->trans_status->viewAttributes() ?>>
<?= $Page->trans_status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->trans_resp_mesg->Visible) { // trans_resp_mesg ?>
        <td data-name="trans_resp_mesg"<?= $Page->trans_resp_mesg->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_order_trans_resp_mesg" class="el_booking_order_trans_resp_mesg">
<span<?= $Page->trans_resp_mesg->viewAttributes() ?>>
<?= $Page->trans_resp_mesg->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rate_review->Visible) { // rate_review ?>
        <td data-name="rate_review"<?= $Page->rate_review->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_order_rate_review" class="el_booking_order_rate_review">
<span<?= $Page->rate_review->viewAttributes() ?>>
<?= $Page->rate_review->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->datentime->Visible) { // datentime ?>
        <td data-name="datentime"<?= $Page->datentime->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_booking_order_datentime" class="el_booking_order_datentime">
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
    ew.addEventHandlers("booking_order");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
