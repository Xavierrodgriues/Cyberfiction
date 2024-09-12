<?php

namespace PHPMaker2024\project4;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface;
use Slim\Routing\RouteCollectorProxy;
use Slim\App;
use Closure;

/**
 * Page class
 */
class View3List extends View3
{
    use MessagesTrait;

    // Page ID
    public $PageID = "list";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "View3List";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fview3list";
    public $FormActionName = "";
    public $FormBlankRowName = "";
    public $FormKeyCountName = "";

    // CSS class/style
    public $CurrentPageName = "View3List";

    // Page URLs
    public $AddUrl;
    public $EditUrl;
    public $DeleteUrl;
    public $ViewUrl;
    public $CopyUrl;
    public $ListUrl;

    // Update URLs
    public $InlineAddUrl;
    public $InlineCopyUrl;
    public $InlineEditUrl;
    public $GridAddUrl;
    public $GridEditUrl;
    public $MultiEditUrl;
    public $MultiDeleteUrl;
    public $MultiUpdateUrl;

    // Page headings
    public $Heading = "";
    public $Subheading = "";
    public $PageHeader;
    public $PageFooter;

    // Page layout
    public $UseLayout = true;

    // Page terminated
    private $terminated = false;

    // Page heading
    public function pageHeading()
    {
        global $Language;
        if ($this->Heading != "") {
            return $this->Heading;
        }
        if (method_exists($this, "tableCaption")) {
            return $this->tableCaption();
        }
        return "";
    }

    // Page subheading
    public function pageSubheading()
    {
        global $Language;
        if ($this->Subheading != "") {
            return $this->Subheading;
        }
        if ($this->TableName) {
            return $Language->phrase($this->PageID);
        }
        return "";
    }

    // Page name
    public function pageName()
    {
        return CurrentPageName();
    }

    // Page URL
    public function pageUrl($withArgs = true)
    {
        $route = GetRoute();
        $args = RemoveXss($route->getArguments());
        if (!$withArgs) {
            foreach ($args as $key => &$val) {
                $val = "";
            }
            unset($val);
        }
        return rtrim(UrlFor($route->getName(), $args), "/") . "?";
    }

    // Show Page Header
    public function showPageHeader()
    {
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        if ($header != "") { // Header exists, display
            echo '<div id="ew-page-header">' . $header . '</div>';
        }
    }

    // Show Page Footer
    public function showPageFooter()
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<div id="ew-page-footer">' . $footer . '</div>';
        }
    }

    // Set field visibility
    public function setVisibility()
    {
        $this->booking_id->setVisibility();
        $this->user_name->setVisibility();
        $this->room_name->setVisibility();
        $this->price->setVisibility();
        $this->total_pay->setVisibility();
        $this->check_in->setVisibility();
        $this->check_out->setVisibility();
        $this->refund->setVisibility();
        $this->booking_status->setVisibility();
        $this->starter_name->setVisibility();
        $this->main_course_name->setVisibility();
        $this->sweet_dish_name->setVisibility();
        $this->trans_id->setVisibility();
        $this->trans_amt->setVisibility();
        $this->trans_status->setVisibility();
        $this->datentime->setVisibility();
        $this->rate_review->setVisibility();
        $this->phonenum->setVisibility();
    }

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $DashboardReport, $DebugTimer;
        $this->FormActionName = Config("FORM_ROW_ACTION_NAME");
        $this->FormBlankRowName = Config("FORM_BLANK_ROW_NAME");
        $this->FormKeyCountName = Config("FORM_KEY_COUNT_NAME");
        $this->TableVar = 'view3';
        $this->TableName = 'view3';

        // Table CSS class
        $this->TableClass = "table table-bordered table-hover table-sm ew-table";

        // CSS class name as context
        $this->ContextClass = CheckClassName($this->TableVar);
        AppendClass($this->TableGridClass, $this->ContextClass);

        // Fixed header table
        if (!$this->UseCustomTemplate) {
            $this->setFixedHeaderTable(Config("USE_FIXED_HEADER_TABLE"), Config("FIXED_HEADER_TABLE_HEIGHT"));
        }

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("app.language");

        // Table object (view3)
        if (!isset($GLOBALS["view3"]) || $GLOBALS["view3"]::class == PROJECT_NAMESPACE . "view3") {
            $GLOBALS["view3"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl(false);

        // Initialize URLs
        $this->AddUrl = "View3Add";
        $this->InlineAddUrl = $pageUrl . "action=add";
        $this->GridAddUrl = $pageUrl . "action=gridadd";
        $this->GridEditUrl = $pageUrl . "action=gridedit";
        $this->MultiEditUrl = $pageUrl . "action=multiedit";
        $this->MultiDeleteUrl = "View3Delete";
        $this->MultiUpdateUrl = "View3Update";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'view3');
        }

        // Start timer
        $DebugTimer = Container("debug.timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] ??= $this->getConnection();

        // List options
        $this->ListOptions = new ListOptions(Tag: "td", TableVar: $this->TableVar);

        // Export options
        $this->ExportOptions = new ListOptions(TagClassName: "ew-export-option");

        // Import options
        $this->ImportOptions = new ListOptions(TagClassName: "ew-import-option");

        // Other options
        $this->OtherOptions = new ListOptionsArray();

        // Grid-Add/Edit
        $this->OtherOptions["addedit"] = new ListOptions(
            TagClassName: "ew-add-edit-option",
            UseDropDownButton: false,
            DropDownButtonPhrase: $Language->phrase("ButtonAddEdit"),
            UseButtonGroup: true
        );

        // Detail tables
        $this->OtherOptions["detail"] = new ListOptions(TagClassName: "ew-detail-option");
        // Actions
        $this->OtherOptions["action"] = new ListOptions(TagClassName: "ew-action-option");

        // Column visibility
        $this->OtherOptions["column"] = new ListOptions(
            TableVar: $this->TableVar,
            TagClassName: "ew-column-option",
            ButtonGroupClass: "ew-column-dropdown",
            UseDropDownButton: true,
            DropDownButtonPhrase: $Language->phrase("Columns"),
            DropDownAutoClose: "outside",
            UseButtonGroup: false
        );

        // Filter options
        $this->FilterOptions = new ListOptions(TagClassName: "ew-filter-option");

        // List actions
        $this->ListActions = new ListActions();
    }

    // Get content from stream
    public function getContents(): string
    {
        global $Response;
        return $Response?->getBody() ?? ob_get_clean();
    }

    // Is lookup
    public function isLookup()
    {
        return SameText(Route(0), Config("API_LOOKUP_ACTION"));
    }

    // Is AutoFill
    public function isAutoFill()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autofill");
    }

    // Is AutoSuggest
    public function isAutoSuggest()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autosuggest");
    }

    // Is modal lookup
    public function isModalLookup()
    {
        return $this->isLookup() && SameText(Post("ajax"), "modal");
    }

    // Is terminated
    public function isTerminated()
    {
        return $this->terminated;
    }

    /**
     * Terminate page
     *
     * @param string $url URL for direction
     * @return void
     */
    public function terminate($url = "")
    {
        if ($this->terminated) {
            return;
        }
        global $TempImages, $DashboardReport, $Response;

        // Page is terminated
        $this->terminated = true;

        // Page Unload event
        if (method_exists($this, "pageUnload")) {
            $this->pageUnload();
        }
        DispatchEvent(new PageUnloadedEvent($this), PageUnloadedEvent::NAME);
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Close connection
        CloseConnections();

        // Return for API
        if (IsApi()) {
            $res = $url === true;
            if (!$res) { // Show response for API
                $ar = array_merge($this->getMessages(), $url ? ["url" => GetUrl($url)] : []);
                WriteJson($ar);
            }
            $this->clearMessages(); // Clear messages for API request
            return;
        } else { // Check if response is JSON
            if (WithJsonResponse()) { // With JSON response
                $this->clearMessages();
                return;
            }
        }

        // Go to URL if specified
        if ($url != "") {
            if (!Config("DEBUG") && ob_get_length()) {
                ob_end_clean();
            }

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $pageName = GetPageName($url);
                $result = ["url" => GetUrl($url), "modal" => "1"];  // Assume return to modal for simplicity
                if (!SameString($pageName, GetPageName($this->getListUrl()))) { // Not List page
                    $result["caption"] = $this->getModalCaption($pageName);
                    $result["view"] = SameString($pageName, "View3View"); // If View page, no primary button
                } else { // List page
                    $result["error"] = $this->getFailureMessage(); // List page should not be shown as modal => error
                    $this->clearFailureMessage();
                }
                WriteJson($result);
            } else {
                SaveDebugMessage();
                Redirect(GetUrl($url));
            }
        }
        return; // Return to controller
    }

    // Get records from result set
    protected function getRecordsFromRecordset($rs, $current = false)
    {
        $rows = [];
        if (is_object($rs)) { // Result set
            while ($row = $rs->fetch()) {
                $this->loadRowValues($row); // Set up DbValue/CurrentValue
                $row = $this->getRecordFromArray($row);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        } elseif (is_array($rs)) {
            foreach ($rs as $ar) {
                $row = $this->getRecordFromArray($ar);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        }
        return $rows;
    }

    // Get record from array
    protected function getRecordFromArray($ar)
    {
        $row = [];
        if (is_array($ar)) {
            foreach ($ar as $fldname => $val) {
                if (array_key_exists($fldname, $this->Fields) && ($this->Fields[$fldname]->Visible || $this->Fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
                    $fld = &$this->Fields[$fldname];
                    if ($fld->HtmlTag == "FILE") { // Upload field
                        if (EmptyValue($val)) {
                            $row[$fldname] = null;
                        } else {
                            if ($fld->DataType == DataType::BLOB) {
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))));
                                $row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
                            } elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $val)));
                                $row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
                            } else { // Multiple files
                                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                                $ar = [];
                                foreach ($files as $file) {
                                    $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                        "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                                    if (!EmptyValue($file)) {
                                        $ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
                                    }
                                }
                                $row[$fldname] = $ar;
                            }
                        }
                    } else {
                        if ($fld->DataType == DataType::MEMO && $fld->MemoMaxLength > 0) {
                            $val = TruncateMemo($val, $fld->MemoMaxLength, $fld->TruncateMemoRemoveHtml);
                        }
                        $row[$fldname] = $val;
                    }
                }
            }
        }
        return $row;
    }

    // Get record key value from array
    protected function getRecordKeyValue($ar)
    {
        $key = "";
        if (is_array($ar)) {
        }
        return $key;
    }

    /**
     * Hide fields for add/edit
     *
     * @return void
     */
    protected function hideFieldsForAddEdit()
    {
    }

    // Lookup data
    public function lookup(array $req = [], bool $response = true)
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = $req["field"] ?? null;
        if (!$fieldName) {
            return [];
        }
        $fld = $this->Fields[$fieldName];
        $lookup = $fld->Lookup;
        $name = $req["name"] ?? "";
        if (ContainsString($name, "query_builder_rule")) {
            $lookup->FilterFields = []; // Skip parent fields if any
        }

        // Get lookup parameters
        $lookupType = $req["ajax"] ?? "unknown";
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal") || SameText($lookupType, "filter")) {
            $searchValue = $req["q"] ?? $req["sv"] ?? "";
            $pageSize = $req["n"] ?? $req["recperpage"] ?? 10;
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = $req["q"] ?? "";
            $pageSize = $req["n"] ?? -1;
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
        }
        $start = $req["start"] ?? -1;
        $start = is_numeric($start) ? (int)$start : -1;
        $page = $req["page"] ?? -1;
        $page = is_numeric($page) ? (int)$page : -1;
        $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        $userSelect = Decrypt($req["s"] ?? "");
        $userFilter = Decrypt($req["f"] ?? "");
        $userOrderBy = Decrypt($req["o"] ?? "");
        $keys = $req["keys"] ?? null;
        $lookup->LookupType = $lookupType; // Lookup type
        $lookup->FilterValues = []; // Clear filter values first
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = $req["v0"] ?? $req["lookupValue"] ?? "";
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = $req["v" . $i] ?? "";
        }
        $lookup->SearchValue = $searchValue;
        $lookup->PageSize = $pageSize;
        $lookup->Offset = $offset;
        if ($userSelect != "") {
            $lookup->UserSelect = $userSelect;
        }
        if ($userFilter != "") {
            $lookup->UserFilter = $userFilter;
        }
        if ($userOrderBy != "") {
            $lookup->UserOrderBy = $userOrderBy;
        }
        return $lookup->toJson($this, $response); // Use settings from current page
    }

    // Class variables
    public $ListOptions; // List options
    public $ExportOptions; // Export options
    public $SearchOptions; // Search options
    public $OtherOptions; // Other options
    public $HeaderOptions; // Header options
    public $FooterOptions; // Footer options
    public $FilterOptions; // Filter options
    public $ImportOptions; // Import options
    public $ListActions; // List actions
    public $SelectedCount = 0;
    public $SelectedIndex = 0;
    public $DisplayRecords = 20;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $PageSizes = "10,20,50,-1"; // Page sizes (comma separated)
    public $DefaultSearchWhere = ""; // Default search WHERE clause
    public $SearchWhere = ""; // Search WHERE clause
    public $SearchPanelClass = "ew-search-panel collapse show"; // Search Panel class
    public $SearchColumnCount = 0; // For extended search
    public $SearchFieldsPerRow = 1; // For extended search
    public $RecordCount = 0; // Record count
    public $InlineRowCount = 0;
    public $StartRowCount = 1;
    public $Attrs = []; // Row attributes and cell attributes
    public $RowIndex = 0; // Row index
    public $KeyCount = 0; // Key count
    public $MultiColumnGridClass = "row-cols-md";
    public $MultiColumnEditClass = "col-12 w-100";
    public $MultiColumnCardClass = "card h-100 ew-card";
    public $MultiColumnListOptionsPosition = "bottom-start";
    public $DbMasterFilter = ""; // Master filter
    public $DbDetailFilter = ""; // Detail filter
    public $MasterRecordExists;
    public $MultiSelectKey;
    public $Command;
    public $UserAction; // User action
    public $RestoreSearch = false;
    public $HashValue; // Hash value
    public $DetailPages;
    public $TopContentClass = "ew-top";
    public $MiddleContentClass = "ew-middle";
    public $BottomContentClass = "ew-bottom";
    public $PageAction;
    public $RecKeys = [];
    public $IsModal = false;
    protected $FilterForModalActions = "";
    private $UseInfiniteScroll = false;

    /**
     * Load result set from filter
     *
     * @return void
     */
    public function loadRecordsetFromFilter($filter)
    {
        // Set up list options
        $this->setupListOptions();

        // Search options
        $this->setupSearchOptions();

        // Other options
        $this->setupOtherOptions();

        // Set visibility
        $this->setVisibility();

        // Load result set
        $this->TotalRecords = $this->loadRecordCount($filter);
        $this->StartRecord = 1;
        $this->StopRecord = $this->DisplayRecords;
        $this->CurrentFilter = $filter;
        $this->Recordset = $this->loadRecordset();

        // Set up pager
        $this->Pager = new PrevNextPager($this, $this->StartRecord, $this->DisplayRecords, $this->TotalRecords, $this->PageSizes, $this->RecordRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);
    }

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $Language, $Security, $CurrentForm, $DashboardReport;

        // Multi column button position
        $this->MultiColumnListOptionsPosition = Config("MULTI_COLUMN_LIST_OPTIONS_POSITION");
        $DashboardReport ??= Param(Config("PAGE_DASHBOARD"));

        // Is modal
        $this->IsModal = ConvertToBool(Param("modal"));

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param(Config("PAGE_LAYOUT"), true));

        // View
        $this->View = Get(Config("VIEW"));

        // Load user profile
        if (IsLoggedIn()) {
            Profile()->setUserName(CurrentUserName())->loadFromStorage();
        }

        // Get export parameters
        $custom = "";
        if (Param("export") !== null) {
            $this->Export = Param("export");
            $custom = Param("custom", "");
        } else {
            $this->setExportReturnUrl(CurrentUrl());
        }
        $ExportType = $this->Export; // Get export parameter, used in header
        if ($ExportType != "") {
            global $SkipHeaderFooter;
            $SkipHeaderFooter = true;
        }
        $this->CurrentAction = Param("action"); // Set up current action

        // Get grid add count
        $gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
        if (is_numeric($gridaddcnt) && $gridaddcnt > 0) {
            $this->GridAddRowCount = $gridaddcnt;
        }

        // Set up list options
        $this->setupListOptions();

        // Setup export options
        $this->setupExportOptions();
        $this->setVisibility();

        // Set lookup cache
        if (!in_array($this->PageID, Config("LOOKUP_CACHE_PAGE_IDS"))) {
            $this->setUseLookupCache(false);
        }

        // Global Page Loading event (in userfn*.php)
        DispatchEvent(new PageLoadingEvent($this), PageLoadingEvent::NAME);

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Hide fields for add/edit
        if (!$this->UseAjaxActions) {
            $this->hideFieldsForAddEdit();
        }
        // Use inline delete
        if ($this->UseAjaxActions) {
            $this->InlineDelete = true;
        }

        // Setup other options
        $this->setupOtherOptions();

        // Update form name to avoid conflict
        if ($this->IsModal) {
            $this->FormName = "fview3grid";
        }

        // Set up page action
        $this->PageAction = CurrentPageUrl(false);

        // Set up infinite scroll
        $this->UseInfiniteScroll = ConvertToBool(Param("infinitescroll"));

        // Search filters
        $srchAdvanced = ""; // Advanced search filter
        $srchBasic = ""; // Basic search filter
        $query = ""; // Query builder

        // Set up Dashboard Filter
        if ($DashboardReport) {
            AddFilter($this->Filter, $this->getDashboardFilter($DashboardReport, $this->TableVar));
        }

        // Get command
        $this->Command = strtolower(Get("cmd", ""));

        // Process list action first
        if ($this->processListAction()) { // Ajax request
            $this->terminate();
            return;
        }

        // Set up records per page
        $this->setupDisplayRecords();

        // Handle reset command
        $this->resetCmd();

        // Set up Breadcrumb
        if (!$this->isExport()) {
            $this->setupBreadcrumb();
        }

        // Hide list options
        if ($this->isExport()) {
            $this->ListOptions->hideAllOptions(["sequence"]);
            $this->ListOptions->UseDropDownButton = false; // Disable drop down button
            $this->ListOptions->UseButtonGroup = false; // Disable button group
        } elseif ($this->isGridAdd() || $this->isGridEdit() || $this->isMultiEdit() || $this->isConfirm()) {
            $this->ListOptions->hideAllOptions();
            $this->ListOptions->UseDropDownButton = false; // Disable drop down button
            $this->ListOptions->UseButtonGroup = false; // Disable button group
        }

        // Hide options
        if ($this->isExport() || !(EmptyValue($this->CurrentAction) || $this->isSearch())) {
            $this->ExportOptions->hideAllOptions();
            $this->FilterOptions->hideAllOptions();
            $this->ImportOptions->hideAllOptions();
        }

        // Hide other options
        if ($this->isExport()) {
            $this->OtherOptions->hideAllOptions();
        }

        // Get default search criteria
        AddFilter($this->DefaultSearchWhere, $this->basicSearchWhere(true));
        AddFilter($this->DefaultSearchWhere, $this->advancedSearchWhere(true));

        // Get basic search values
        $this->loadBasicSearchValues();

        // Get and validate search values for advanced search
        if (EmptyValue($this->UserAction)) { // Skip if user action
            $this->loadSearchValues();
        }

        // Process filter list
        if ($this->processFilterList()) {
            $this->terminate();
            return;
        }
        if (!$this->validateSearch()) {
            // Nothing to do
        }

        // Restore search parms from Session if not searching / reset / export
        if (($this->isExport() || $this->Command != "search" && $this->Command != "reset" && $this->Command != "resetall") && $this->Command != "json" && $this->checkSearchParms()) {
            $this->restoreSearchParms();
        }

        // Call Recordset SearchValidated event
        $this->recordsetSearchValidated();

        // Set up sorting order
        $this->setupSortOrder();

        // Get basic search criteria
        if (!$this->hasInvalidFields()) {
            $srchBasic = $this->basicSearchWhere();
        }

        // Get advanced search criteria
        if (!$this->hasInvalidFields()) {
            $srchAdvanced = $this->advancedSearchWhere();
        }

        // Get query builder criteria
        $query = $DashboardReport ? "" : $this->queryBuilderWhere();

        // Restore display records
        if ($this->Command != "json" && $this->getRecordsPerPage() != "") {
            $this->DisplayRecords = $this->getRecordsPerPage(); // Restore from Session
        } else {
            $this->DisplayRecords = 20; // Load default
            $this->setRecordsPerPage($this->DisplayRecords); // Save default to Session
        }

        // Load search default if no existing search criteria
        if (!$this->checkSearchParms() && !$query) {
            // Load basic search from default
            $this->BasicSearch->loadDefault();
            if ($this->BasicSearch->Keyword != "") {
                $srchBasic = $this->basicSearchWhere(); // Save to session
            }

            // Load advanced search from default
            if ($this->loadAdvancedSearchDefault()) {
                $srchAdvanced = $this->advancedSearchWhere(); // Save to session
            }
        }

        // Restore search settings from Session
        if (!$this->hasInvalidFields()) {
            $this->loadAdvancedSearch();
        }

        // Build search criteria
        if ($query) {
            AddFilter($this->SearchWhere, $query);
        } else {
            AddFilter($this->SearchWhere, $srchAdvanced);
            AddFilter($this->SearchWhere, $srchBasic);
        }

        // Call Recordset_Searching event
        $this->recordsetSearching($this->SearchWhere);

        // Save search criteria
        if ($this->Command == "search" && !$this->RestoreSearch) {
            $this->setSearchWhere($this->SearchWhere); // Save to Session
            $this->StartRecord = 1; // Reset start record counter
            $this->setStartRecordNumber($this->StartRecord);
        } elseif ($this->Command != "json" && !$query) {
            $this->SearchWhere = $this->getSearchWhere();
        }

        // Build filter
        AddFilter($this->Filter, $this->DbDetailFilter);
        AddFilter($this->Filter, $this->SearchWhere);

        // Set up filter
        if ($this->Command == "json") {
            $this->UseSessionForListSql = false; // Do not use session for ListSQL
            $this->CurrentFilter = $this->Filter;
        } else {
            $this->setSessionWhere($this->Filter);
            $this->CurrentFilter = "";
        }
        $this->Filter = $this->applyUserIDFilters($this->Filter);
        if ($this->isGridAdd()) {
            $this->CurrentFilter = "0=1";
            $this->StartRecord = 1;
            $this->DisplayRecords = $this->GridAddRowCount;
            $this->TotalRecords = $this->DisplayRecords;
            $this->StopRecord = $this->DisplayRecords;
        } elseif (($this->isEdit() || $this->isCopy() || $this->isInlineInserted() || $this->isInlineUpdated()) && $this->UseInfiniteScroll) { // Get current record only
            $this->CurrentFilter = $this->isInlineUpdated() ? $this->getRecordFilter() : $this->getFilterFromRecordKeys();
            $this->TotalRecords = $this->listRecordCount();
            $this->StartRecord = 1;
            $this->StopRecord = $this->DisplayRecords;
            $this->Recordset = $this->loadRecordset();
        } elseif (
            $this->UseInfiniteScroll && $this->isGridInserted() ||
            $this->UseInfiniteScroll && ($this->isGridEdit() || $this->isGridUpdated()) ||
            $this->isMultiEdit() ||
            $this->UseInfiniteScroll && $this->isMultiUpdated()
        ) { // Get current records only
            $this->CurrentFilter = $this->FilterForModalActions; // Restore filter
            $this->TotalRecords = $this->listRecordCount();
            $this->StartRecord = 1;
            $this->StopRecord = $this->DisplayRecords;
            $this->Recordset = $this->loadRecordset();
        } else {
            $this->TotalRecords = $this->listRecordCount();
            $this->StartRecord = 1;
            if ($this->DisplayRecords <= 0 || ($this->isExport() && $this->ExportAll)) { // Display all records
                $this->DisplayRecords = $this->TotalRecords;
            }
            if (!($this->isExport() && $this->ExportAll)) { // Set up start record position
                $this->setupStartRecord();
            }
            $this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);

            // Set no record found message
            if ((EmptyValue($this->CurrentAction) || $this->isSearch()) && $this->TotalRecords == 0) {
                if ($this->SearchWhere == "0=101") {
                    $this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
                } else {
                    $this->setWarningMessage($Language->phrase("NoRecord"));
                }
            }
        }

        // Set up list action columns
        foreach ($this->ListActions as $listAction) {
            if ($listAction->Allowed) {
                if ($listAction->Select == ACTION_MULTIPLE) { // Show checkbox column if multiple action
                    $this->ListOptions["checkbox"]->Visible = true;
                } elseif ($listAction->Select == ACTION_SINGLE) { // Show list action column
                        $this->ListOptions["listactions"]->Visible = true; // Set visible if any list action is allowed
                }
            }
        }

        // Search options
        $this->setupSearchOptions();

        // Set up search panel class
        if ($this->SearchWhere != "") {
            if ($query) { // Hide search panel if using QueryBuilder
                RemoveClass($this->SearchPanelClass, "show");
            } else {
                AppendClass($this->SearchPanelClass, "show");
            }
        }

        // API list action
        if (IsApi()) {
            if (Route(0) == Config("API_LIST_ACTION")) {
                if (!$this->isExport()) {
                    $rows = $this->getRecordsFromRecordset($this->Recordset);
                    $this->Recordset?->free();
                    WriteJson([
                        "success" => true,
                        "action" => Config("API_LIST_ACTION"),
                        $this->TableVar => $rows,
                        "totalRecordCount" => $this->TotalRecords
                    ]);
                    $this->terminate(true);
                }
                return;
            } elseif ($this->getFailureMessage() != "") {
                WriteJson(["error" => $this->getFailureMessage()]);
                $this->clearFailureMessage();
                $this->terminate(true);
                return;
            }
        }

        // Render other options
        $this->renderOtherOptions();

        // Set up pager
        $this->Pager = new PrevNextPager($this, $this->StartRecord, $this->DisplayRecords, $this->TotalRecords, $this->PageSizes, $this->RecordRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);

        // Set ReturnUrl in header if necessary
        if ($returnUrl = Container("app.flash")->getFirstMessage("Return-Url")) {
            AddHeader("Return-Url", GetUrl($returnUrl));
        }

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            DispatchEvent(new PageRenderingEvent($this), PageRenderingEvent::NAME);

            // Page Render event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }

            // Render search option
            if (method_exists($this, "renderSearchOptions")) {
                $this->renderSearchOptions();
            }
        }
    }

    // Get page number
    public function getPageNumber()
    {
        return ($this->DisplayRecords > 0 && $this->StartRecord > 0) ? ceil($this->StartRecord / $this->DisplayRecords) : 1;
    }

    // Set up number of records displayed per page
    protected function setupDisplayRecords()
    {
        $wrk = Get(Config("TABLE_REC_PER_PAGE"), "");
        if ($wrk != "") {
            if (is_numeric($wrk)) {
                $this->DisplayRecords = (int)$wrk;
            } else {
                if (SameText($wrk, "all")) { // Display all records
                    $this->DisplayRecords = -1;
                } else {
                    $this->DisplayRecords = 20; // Non-numeric, load default
                }
            }
            $this->setRecordsPerPage($this->DisplayRecords); // Save to Session
            // Reset start position
            $this->StartRecord = 1;
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Build filter for all keys
    protected function buildKeyFilter()
    {
        global $CurrentForm;
        $wrkFilter = "";

        // Update row index and get row key
        $rowindex = 1;
        $CurrentForm->Index = $rowindex;
        $thisKey = strval($CurrentForm->getValue($this->OldKeyName));
        while ($thisKey != "") {
            $this->setKey($thisKey);
            if ($this->OldKey != "") {
                $filter = $this->getRecordFilter();
                if ($wrkFilter != "") {
                    $wrkFilter .= " OR ";
                }
                $wrkFilter .= $filter;
            } else {
                $wrkFilter = "0=1";
                break;
            }

            // Update row index and get row key
            $rowindex++; // Next row
            $CurrentForm->Index = $rowindex;
            $thisKey = strval($CurrentForm->getValue($this->OldKeyName));
        }
        return $wrkFilter;
    }

    // Get list of filters
    public function getFilterList()
    {
        // Initialize
        $filterList = "";
        $savedFilterList = "";
        $filterList = Concat($filterList, $this->booking_id->AdvancedSearch->toJson(), ","); // Field booking_id
        $filterList = Concat($filterList, $this->user_name->AdvancedSearch->toJson(), ","); // Field user_name
        $filterList = Concat($filterList, $this->room_name->AdvancedSearch->toJson(), ","); // Field room_name
        $filterList = Concat($filterList, $this->price->AdvancedSearch->toJson(), ","); // Field price
        $filterList = Concat($filterList, $this->total_pay->AdvancedSearch->toJson(), ","); // Field total_pay
        $filterList = Concat($filterList, $this->check_in->AdvancedSearch->toJson(), ","); // Field check_in
        $filterList = Concat($filterList, $this->check_out->AdvancedSearch->toJson(), ","); // Field check_out
        $filterList = Concat($filterList, $this->refund->AdvancedSearch->toJson(), ","); // Field refund
        $filterList = Concat($filterList, $this->booking_status->AdvancedSearch->toJson(), ","); // Field booking_status
        $filterList = Concat($filterList, $this->starter_name->AdvancedSearch->toJson(), ","); // Field starter_name
        $filterList = Concat($filterList, $this->main_course_name->AdvancedSearch->toJson(), ","); // Field main_course_name
        $filterList = Concat($filterList, $this->sweet_dish_name->AdvancedSearch->toJson(), ","); // Field sweet_dish_name
        $filterList = Concat($filterList, $this->trans_id->AdvancedSearch->toJson(), ","); // Field trans_id
        $filterList = Concat($filterList, $this->trans_amt->AdvancedSearch->toJson(), ","); // Field trans_amt
        $filterList = Concat($filterList, $this->trans_status->AdvancedSearch->toJson(), ","); // Field trans_status
        $filterList = Concat($filterList, $this->datentime->AdvancedSearch->toJson(), ","); // Field datentime
        $filterList = Concat($filterList, $this->rate_review->AdvancedSearch->toJson(), ","); // Field rate_review
        $filterList = Concat($filterList, $this->phonenum->AdvancedSearch->toJson(), ","); // Field phonenum
        if ($this->BasicSearch->Keyword != "") {
            $wrk = "\"" . Config("TABLE_BASIC_SEARCH") . "\":\"" . JsEncode($this->BasicSearch->Keyword) . "\",\"" . Config("TABLE_BASIC_SEARCH_TYPE") . "\":\"" . JsEncode($this->BasicSearch->Type) . "\"";
            $filterList = Concat($filterList, $wrk, ",");
        }

        // Return filter list in JSON
        if ($filterList != "") {
            $filterList = "\"data\":{" . $filterList . "}";
        }
        if ($savedFilterList != "") {
            $filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
        }
        return ($filterList != "") ? "{" . $filterList . "}" : "null";
    }

    // Process filter list
    protected function processFilterList()
    {
        if (Post("ajax") == "savefilters") { // Save filter request (Ajax)
            $filters = Post("filters");
            Profile()->setSearchFilters("fview3srch", $filters);
            WriteJson([["success" => true]]); // Success
            return true;
        } elseif (Post("cmd") == "resetfilter") {
            $this->restoreFilterList();
        }
        return false;
    }

    // Restore list of filters
    protected function restoreFilterList()
    {
        // Return if not reset filter
        if (Post("cmd") !== "resetfilter") {
            return false;
        }
        $filter = json_decode(Post("filter"), true);
        $this->Command = "search";

        // Field booking_id
        $this->booking_id->AdvancedSearch->SearchValue = @$filter["x_booking_id"];
        $this->booking_id->AdvancedSearch->SearchOperator = @$filter["z_booking_id"];
        $this->booking_id->AdvancedSearch->SearchCondition = @$filter["v_booking_id"];
        $this->booking_id->AdvancedSearch->SearchValue2 = @$filter["y_booking_id"];
        $this->booking_id->AdvancedSearch->SearchOperator2 = @$filter["w_booking_id"];
        $this->booking_id->AdvancedSearch->save();

        // Field user_name
        $this->user_name->AdvancedSearch->SearchValue = @$filter["x_user_name"];
        $this->user_name->AdvancedSearch->SearchOperator = @$filter["z_user_name"];
        $this->user_name->AdvancedSearch->SearchCondition = @$filter["v_user_name"];
        $this->user_name->AdvancedSearch->SearchValue2 = @$filter["y_user_name"];
        $this->user_name->AdvancedSearch->SearchOperator2 = @$filter["w_user_name"];
        $this->user_name->AdvancedSearch->save();

        // Field room_name
        $this->room_name->AdvancedSearch->SearchValue = @$filter["x_room_name"];
        $this->room_name->AdvancedSearch->SearchOperator = @$filter["z_room_name"];
        $this->room_name->AdvancedSearch->SearchCondition = @$filter["v_room_name"];
        $this->room_name->AdvancedSearch->SearchValue2 = @$filter["y_room_name"];
        $this->room_name->AdvancedSearch->SearchOperator2 = @$filter["w_room_name"];
        $this->room_name->AdvancedSearch->save();

        // Field price
        $this->price->AdvancedSearch->SearchValue = @$filter["x_price"];
        $this->price->AdvancedSearch->SearchOperator = @$filter["z_price"];
        $this->price->AdvancedSearch->SearchCondition = @$filter["v_price"];
        $this->price->AdvancedSearch->SearchValue2 = @$filter["y_price"];
        $this->price->AdvancedSearch->SearchOperator2 = @$filter["w_price"];
        $this->price->AdvancedSearch->save();

        // Field total_pay
        $this->total_pay->AdvancedSearch->SearchValue = @$filter["x_total_pay"];
        $this->total_pay->AdvancedSearch->SearchOperator = @$filter["z_total_pay"];
        $this->total_pay->AdvancedSearch->SearchCondition = @$filter["v_total_pay"];
        $this->total_pay->AdvancedSearch->SearchValue2 = @$filter["y_total_pay"];
        $this->total_pay->AdvancedSearch->SearchOperator2 = @$filter["w_total_pay"];
        $this->total_pay->AdvancedSearch->save();

        // Field check_in
        $this->check_in->AdvancedSearch->SearchValue = @$filter["x_check_in"];
        $this->check_in->AdvancedSearch->SearchOperator = @$filter["z_check_in"];
        $this->check_in->AdvancedSearch->SearchCondition = @$filter["v_check_in"];
        $this->check_in->AdvancedSearch->SearchValue2 = @$filter["y_check_in"];
        $this->check_in->AdvancedSearch->SearchOperator2 = @$filter["w_check_in"];
        $this->check_in->AdvancedSearch->save();

        // Field check_out
        $this->check_out->AdvancedSearch->SearchValue = @$filter["x_check_out"];
        $this->check_out->AdvancedSearch->SearchOperator = @$filter["z_check_out"];
        $this->check_out->AdvancedSearch->SearchCondition = @$filter["v_check_out"];
        $this->check_out->AdvancedSearch->SearchValue2 = @$filter["y_check_out"];
        $this->check_out->AdvancedSearch->SearchOperator2 = @$filter["w_check_out"];
        $this->check_out->AdvancedSearch->save();

        // Field refund
        $this->refund->AdvancedSearch->SearchValue = @$filter["x_refund"];
        $this->refund->AdvancedSearch->SearchOperator = @$filter["z_refund"];
        $this->refund->AdvancedSearch->SearchCondition = @$filter["v_refund"];
        $this->refund->AdvancedSearch->SearchValue2 = @$filter["y_refund"];
        $this->refund->AdvancedSearch->SearchOperator2 = @$filter["w_refund"];
        $this->refund->AdvancedSearch->save();

        // Field booking_status
        $this->booking_status->AdvancedSearch->SearchValue = @$filter["x_booking_status"];
        $this->booking_status->AdvancedSearch->SearchOperator = @$filter["z_booking_status"];
        $this->booking_status->AdvancedSearch->SearchCondition = @$filter["v_booking_status"];
        $this->booking_status->AdvancedSearch->SearchValue2 = @$filter["y_booking_status"];
        $this->booking_status->AdvancedSearch->SearchOperator2 = @$filter["w_booking_status"];
        $this->booking_status->AdvancedSearch->save();

        // Field starter_name
        $this->starter_name->AdvancedSearch->SearchValue = @$filter["x_starter_name"];
        $this->starter_name->AdvancedSearch->SearchOperator = @$filter["z_starter_name"];
        $this->starter_name->AdvancedSearch->SearchCondition = @$filter["v_starter_name"];
        $this->starter_name->AdvancedSearch->SearchValue2 = @$filter["y_starter_name"];
        $this->starter_name->AdvancedSearch->SearchOperator2 = @$filter["w_starter_name"];
        $this->starter_name->AdvancedSearch->save();

        // Field main_course_name
        $this->main_course_name->AdvancedSearch->SearchValue = @$filter["x_main_course_name"];
        $this->main_course_name->AdvancedSearch->SearchOperator = @$filter["z_main_course_name"];
        $this->main_course_name->AdvancedSearch->SearchCondition = @$filter["v_main_course_name"];
        $this->main_course_name->AdvancedSearch->SearchValue2 = @$filter["y_main_course_name"];
        $this->main_course_name->AdvancedSearch->SearchOperator2 = @$filter["w_main_course_name"];
        $this->main_course_name->AdvancedSearch->save();

        // Field sweet_dish_name
        $this->sweet_dish_name->AdvancedSearch->SearchValue = @$filter["x_sweet_dish_name"];
        $this->sweet_dish_name->AdvancedSearch->SearchOperator = @$filter["z_sweet_dish_name"];
        $this->sweet_dish_name->AdvancedSearch->SearchCondition = @$filter["v_sweet_dish_name"];
        $this->sweet_dish_name->AdvancedSearch->SearchValue2 = @$filter["y_sweet_dish_name"];
        $this->sweet_dish_name->AdvancedSearch->SearchOperator2 = @$filter["w_sweet_dish_name"];
        $this->sweet_dish_name->AdvancedSearch->save();

        // Field trans_id
        $this->trans_id->AdvancedSearch->SearchValue = @$filter["x_trans_id"];
        $this->trans_id->AdvancedSearch->SearchOperator = @$filter["z_trans_id"];
        $this->trans_id->AdvancedSearch->SearchCondition = @$filter["v_trans_id"];
        $this->trans_id->AdvancedSearch->SearchValue2 = @$filter["y_trans_id"];
        $this->trans_id->AdvancedSearch->SearchOperator2 = @$filter["w_trans_id"];
        $this->trans_id->AdvancedSearch->save();

        // Field trans_amt
        $this->trans_amt->AdvancedSearch->SearchValue = @$filter["x_trans_amt"];
        $this->trans_amt->AdvancedSearch->SearchOperator = @$filter["z_trans_amt"];
        $this->trans_amt->AdvancedSearch->SearchCondition = @$filter["v_trans_amt"];
        $this->trans_amt->AdvancedSearch->SearchValue2 = @$filter["y_trans_amt"];
        $this->trans_amt->AdvancedSearch->SearchOperator2 = @$filter["w_trans_amt"];
        $this->trans_amt->AdvancedSearch->save();

        // Field trans_status
        $this->trans_status->AdvancedSearch->SearchValue = @$filter["x_trans_status"];
        $this->trans_status->AdvancedSearch->SearchOperator = @$filter["z_trans_status"];
        $this->trans_status->AdvancedSearch->SearchCondition = @$filter["v_trans_status"];
        $this->trans_status->AdvancedSearch->SearchValue2 = @$filter["y_trans_status"];
        $this->trans_status->AdvancedSearch->SearchOperator2 = @$filter["w_trans_status"];
        $this->trans_status->AdvancedSearch->save();

        // Field datentime
        $this->datentime->AdvancedSearch->SearchValue = @$filter["x_datentime"];
        $this->datentime->AdvancedSearch->SearchOperator = @$filter["z_datentime"];
        $this->datentime->AdvancedSearch->SearchCondition = @$filter["v_datentime"];
        $this->datentime->AdvancedSearch->SearchValue2 = @$filter["y_datentime"];
        $this->datentime->AdvancedSearch->SearchOperator2 = @$filter["w_datentime"];
        $this->datentime->AdvancedSearch->save();

        // Field rate_review
        $this->rate_review->AdvancedSearch->SearchValue = @$filter["x_rate_review"];
        $this->rate_review->AdvancedSearch->SearchOperator = @$filter["z_rate_review"];
        $this->rate_review->AdvancedSearch->SearchCondition = @$filter["v_rate_review"];
        $this->rate_review->AdvancedSearch->SearchValue2 = @$filter["y_rate_review"];
        $this->rate_review->AdvancedSearch->SearchOperator2 = @$filter["w_rate_review"];
        $this->rate_review->AdvancedSearch->save();

        // Field phonenum
        $this->phonenum->AdvancedSearch->SearchValue = @$filter["x_phonenum"];
        $this->phonenum->AdvancedSearch->SearchOperator = @$filter["z_phonenum"];
        $this->phonenum->AdvancedSearch->SearchCondition = @$filter["v_phonenum"];
        $this->phonenum->AdvancedSearch->SearchValue2 = @$filter["y_phonenum"];
        $this->phonenum->AdvancedSearch->SearchOperator2 = @$filter["w_phonenum"];
        $this->phonenum->AdvancedSearch->save();
        $this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
        $this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
    }

    // Advanced search WHERE clause based on QueryString
    public function advancedSearchWhere($default = false)
    {
        global $Security;
        $where = "";
        $this->buildSearchSql($where, $this->booking_id, $default, false); // booking_id
        $this->buildSearchSql($where, $this->user_name, $default, true); // user_name
        $this->buildSearchSql($where, $this->room_name, $default, true); // room_name
        $this->buildSearchSql($where, $this->price, $default, true); // price
        $this->buildSearchSql($where, $this->total_pay, $default, true); // total_pay
        $this->buildSearchSql($where, $this->check_in, $default, true); // check_in
        $this->buildSearchSql($where, $this->check_out, $default, true); // check_out
        $this->buildSearchSql($where, $this->refund, $default, true); // refund
        $this->buildSearchSql($where, $this->booking_status, $default, true); // booking_status
        $this->buildSearchSql($where, $this->starter_name, $default, true); // starter_name
        $this->buildSearchSql($where, $this->main_course_name, $default, true); // main_course_name
        $this->buildSearchSql($where, $this->sweet_dish_name, $default, true); // sweet_dish_name
        $this->buildSearchSql($where, $this->trans_id, $default, false); // trans_id
        $this->buildSearchSql($where, $this->trans_amt, $default, true); // trans_amt
        $this->buildSearchSql($where, $this->trans_status, $default, true); // trans_status
        $this->buildSearchSql($where, $this->datentime, $default, true); // datentime
        $this->buildSearchSql($where, $this->rate_review, $default, false); // rate_review
        $this->buildSearchSql($where, $this->phonenum, $default, false); // phonenum

        // Set up search command
        if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
            $this->Command = "search";
        }
        if (!$default && $this->Command == "search") {
            $this->booking_id->AdvancedSearch->save(); // booking_id
            $this->user_name->AdvancedSearch->save(); // user_name
            $this->room_name->AdvancedSearch->save(); // room_name
            $this->price->AdvancedSearch->save(); // price
            $this->total_pay->AdvancedSearch->save(); // total_pay
            $this->check_in->AdvancedSearch->save(); // check_in
            $this->check_out->AdvancedSearch->save(); // check_out
            $this->refund->AdvancedSearch->save(); // refund
            $this->booking_status->AdvancedSearch->save(); // booking_status
            $this->starter_name->AdvancedSearch->save(); // starter_name
            $this->main_course_name->AdvancedSearch->save(); // main_course_name
            $this->sweet_dish_name->AdvancedSearch->save(); // sweet_dish_name
            $this->trans_id->AdvancedSearch->save(); // trans_id
            $this->trans_amt->AdvancedSearch->save(); // trans_amt
            $this->trans_status->AdvancedSearch->save(); // trans_status
            $this->datentime->AdvancedSearch->save(); // datentime
            $this->rate_review->AdvancedSearch->save(); // rate_review
            $this->phonenum->AdvancedSearch->save(); // phonenum

            // Clear rules for QueryBuilder
            $this->setSessionRules("");
        }
        return $where;
    }

    // Query builder rules
    public function queryBuilderRules()
    {
        return Post("rules") ?? $this->getSessionRules();
    }

    // Quey builder WHERE clause
    public function queryBuilderWhere($fieldName = "")
    {
        global $Security;

        // Get rules by query builder
        $rules = $this->queryBuilderRules();

        // Decode and parse rules
        $where = $rules ? $this->parseRules(json_decode($rules, true), $fieldName) : "";

        // Clear other search and save rules to session
        if ($where && $fieldName == "") { // Skip if get query for specific field
            $this->resetSearchParms();
            $this->setSessionRules($rules);
        }

        // Return query
        return $where;
    }

    // Build search SQL
    protected function buildSearchSql(&$where, $fld, $default, $multiValue)
    {
        $fldParm = $fld->Param;
        $fldVal = $default ? $fld->AdvancedSearch->SearchValueDefault : $fld->AdvancedSearch->SearchValue;
        $fldOpr = $default ? $fld->AdvancedSearch->SearchOperatorDefault : $fld->AdvancedSearch->SearchOperator;
        $fldCond = $default ? $fld->AdvancedSearch->SearchConditionDefault : $fld->AdvancedSearch->SearchCondition;
        $fldVal2 = $default ? $fld->AdvancedSearch->SearchValue2Default : $fld->AdvancedSearch->SearchValue2;
        $fldOpr2 = $default ? $fld->AdvancedSearch->SearchOperator2Default : $fld->AdvancedSearch->SearchOperator2;
        $fldVal = ConvertSearchValue($fldVal, $fldOpr, $fld);
        $fldVal2 = ConvertSearchValue($fldVal2, $fldOpr2, $fld);
        $fldOpr = ConvertSearchOperator($fldOpr, $fld, $fldVal);
        $fldOpr2 = ConvertSearchOperator($fldOpr2, $fld, $fldVal2);
        $wrk = "";
        $sep = $fld->UseFilter ? Config("FILTER_OPTION_SEPARATOR") : Config("MULTIPLE_OPTION_SEPARATOR");
        if (is_array($fldVal)) {
            $fldVal = implode($sep, $fldVal);
        }
        if (is_array($fldVal2)) {
            $fldVal2 = implode($sep, $fldVal2);
        }
        if (Config("SEARCH_MULTI_VALUE_OPTION") == 1 && !$fld->UseFilter || !IsMultiSearchOperator($fldOpr)) {
            $multiValue = false;
        }
        if ($multiValue) {
            $wrk = $fldVal != "" ? GetMultiSearchSql($fld, $fldOpr, $fldVal, $this->Dbid) : ""; // Field value 1
            $wrk2 = $fldVal2 != "" ? GetMultiSearchSql($fld, $fldOpr2, $fldVal2, $this->Dbid) : ""; // Field value 2
            AddFilter($wrk, $wrk2, $fldCond);
        } else {
            $wrk = GetSearchSql($fld, $fldVal, $fldOpr, $fldCond, $fldVal2, $fldOpr2, $this->Dbid);
        }
        if ($this->SearchOption == "AUTO" && in_array($this->BasicSearch->getType(), ["AND", "OR"])) {
            $cond = $this->BasicSearch->getType();
        } else {
            $cond = SameText($this->SearchOption, "OR") ? "OR" : "AND";
        }
        AddFilter($where, $wrk, $cond);
    }

    // Show list of filters
    public function showFilterList()
    {
        global $Language;

        // Initialize
        $filterList = "";
        $captionClass = $this->isExport("email") ? "ew-filter-caption-email" : "ew-filter-caption";
        $captionSuffix = $this->isExport("email") ? ": " : "";

        // Field booking_id
        $filter = $this->queryBuilderWhere("booking_id");
        if (!$filter) {
            $this->buildSearchSql($filter, $this->booking_id, false, false);
        }
        if ($filter != "") {
            $filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->booking_id->caption() . "</span>" . $captionSuffix . $filter . "</div>";
        }

        // Field user_name
        $filter = $this->queryBuilderWhere("user_name");
        if (!$filter) {
            $this->buildSearchSql($filter, $this->user_name, false, true);
        }
        if ($filter != "") {
            $filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->user_name->caption() . "</span>" . $captionSuffix . $filter . "</div>";
        }

        // Field room_name
        $filter = $this->queryBuilderWhere("room_name");
        if (!$filter) {
            $this->buildSearchSql($filter, $this->room_name, false, true);
        }
        if ($filter != "") {
            $filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->room_name->caption() . "</span>" . $captionSuffix . $filter . "</div>";
        }

        // Field price
        $filter = $this->queryBuilderWhere("price");
        if (!$filter) {
            $this->buildSearchSql($filter, $this->price, false, true);
        }
        if ($filter != "") {
            $filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->price->caption() . "</span>" . $captionSuffix . $filter . "</div>";
        }

        // Field total_pay
        $filter = $this->queryBuilderWhere("total_pay");
        if (!$filter) {
            $this->buildSearchSql($filter, $this->total_pay, false, true);
        }
        if ($filter != "") {
            $filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->total_pay->caption() . "</span>" . $captionSuffix . $filter . "</div>";
        }

        // Field check_in
        $filter = $this->queryBuilderWhere("check_in");
        if (!$filter) {
            $this->buildSearchSql($filter, $this->check_in, false, true);
        }
        if ($filter != "") {
            $filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->check_in->caption() . "</span>" . $captionSuffix . $filter . "</div>";
        }

        // Field check_out
        $filter = $this->queryBuilderWhere("check_out");
        if (!$filter) {
            $this->buildSearchSql($filter, $this->check_out, false, true);
        }
        if ($filter != "") {
            $filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->check_out->caption() . "</span>" . $captionSuffix . $filter . "</div>";
        }

        // Field refund
        $filter = $this->queryBuilderWhere("refund");
        if (!$filter) {
            $this->buildSearchSql($filter, $this->refund, false, true);
        }
        if ($filter != "") {
            $filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->refund->caption() . "</span>" . $captionSuffix . $filter . "</div>";
        }

        // Field booking_status
        $filter = $this->queryBuilderWhere("booking_status");
        if (!$filter) {
            $this->buildSearchSql($filter, $this->booking_status, false, true);
        }
        if ($filter != "") {
            $filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->booking_status->caption() . "</span>" . $captionSuffix . $filter . "</div>";
        }

        // Field starter_name
        $filter = $this->queryBuilderWhere("starter_name");
        if (!$filter) {
            $this->buildSearchSql($filter, $this->starter_name, false, true);
        }
        if ($filter != "") {
            $filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->starter_name->caption() . "</span>" . $captionSuffix . $filter . "</div>";
        }

        // Field main_course_name
        $filter = $this->queryBuilderWhere("main_course_name");
        if (!$filter) {
            $this->buildSearchSql($filter, $this->main_course_name, false, true);
        }
        if ($filter != "") {
            $filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->main_course_name->caption() . "</span>" . $captionSuffix . $filter . "</div>";
        }

        // Field sweet_dish_name
        $filter = $this->queryBuilderWhere("sweet_dish_name");
        if (!$filter) {
            $this->buildSearchSql($filter, $this->sweet_dish_name, false, true);
        }
        if ($filter != "") {
            $filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->sweet_dish_name->caption() . "</span>" . $captionSuffix . $filter . "</div>";
        }

        // Field trans_id
        $filter = $this->queryBuilderWhere("trans_id");
        if (!$filter) {
            $this->buildSearchSql($filter, $this->trans_id, false, false);
        }
        if ($filter != "") {
            $filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->trans_id->caption() . "</span>" . $captionSuffix . $filter . "</div>";
        }

        // Field trans_amt
        $filter = $this->queryBuilderWhere("trans_amt");
        if (!$filter) {
            $this->buildSearchSql($filter, $this->trans_amt, false, true);
        }
        if ($filter != "") {
            $filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->trans_amt->caption() . "</span>" . $captionSuffix . $filter . "</div>";
        }

        // Field trans_status
        $filter = $this->queryBuilderWhere("trans_status");
        if (!$filter) {
            $this->buildSearchSql($filter, $this->trans_status, false, true);
        }
        if ($filter != "") {
            $filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->trans_status->caption() . "</span>" . $captionSuffix . $filter . "</div>";
        }

        // Field datentime
        $filter = $this->queryBuilderWhere("datentime");
        if (!$filter) {
            $this->buildSearchSql($filter, $this->datentime, false, true);
        }
        if ($filter != "") {
            $filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->datentime->caption() . "</span>" . $captionSuffix . $filter . "</div>";
        }

        // Field rate_review
        $filter = $this->queryBuilderWhere("rate_review");
        if (!$filter) {
            $this->buildSearchSql($filter, $this->rate_review, false, false);
        }
        if ($filter != "") {
            $filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->rate_review->caption() . "</span>" . $captionSuffix . $filter . "</div>";
        }

        // Field phonenum
        $filter = $this->queryBuilderWhere("phonenum");
        if (!$filter) {
            $this->buildSearchSql($filter, $this->phonenum, false, false);
        }
        if ($filter != "") {
            $filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->phonenum->caption() . "</span>" . $captionSuffix . $filter . "</div>";
        }
        if ($this->BasicSearch->Keyword != "") {
            $filterList .= "<div><span class=\"" . $captionClass . "\">" . $Language->phrase("BasicSearchKeyword") . "</span>" . $captionSuffix . $this->BasicSearch->Keyword . "</div>";
        }

        // Show Filters
        if ($filterList != "") {
            $message = "<div id=\"ew-filter-list\" class=\"callout callout-info d-table\"><div id=\"ew-current-filters\">" .
                $Language->phrase("CurrentFilters") . "</div>" . $filterList . "</div>";
            $this->messageShowing($message, "");
            Write($message);
        } else { // Output empty tag
            Write("<div id=\"ew-filter-list\"></div>");
        }
    }

    // Return basic search WHERE clause based on search keyword and type
    public function basicSearchWhere($default = false)
    {
        global $Security;
        $searchStr = "";

        // Fields to search
        $searchFlds = [];
        $searchFlds[] = &$this->user_name;
        $searchFlds[] = &$this->room_name;
        $searchFlds[] = &$this->booking_status;
        $searchFlds[] = &$this->starter_name;
        $searchFlds[] = &$this->main_course_name;
        $searchFlds[] = &$this->sweet_dish_name;
        $searchFlds[] = &$this->trans_id;
        $searchFlds[] = &$this->trans_status;
        $searchFlds[] = &$this->phonenum;
        $searchKeyword = $default ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
        $searchType = $default ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

        // Get search SQL
        if ($searchKeyword != "") {
            $ar = $this->BasicSearch->keywordList($default);
            $searchStr = GetQuickSearchFilter($searchFlds, $ar, $searchType, Config("BASIC_SEARCH_ANY_FIELDS"), $this->Dbid);
            if (!$default && in_array($this->Command, ["", "reset", "resetall"])) {
                $this->Command = "search";
            }
        }
        if (!$default && $this->Command == "search") {
            $this->BasicSearch->setKeyword($searchKeyword);
            $this->BasicSearch->setType($searchType);

            // Clear rules for QueryBuilder
            $this->setSessionRules("");
        }
        return $searchStr;
    }

    // Check if search parm exists
    protected function checkSearchParms()
    {
        // Check basic search
        if ($this->BasicSearch->issetSession()) {
            return true;
        }
        if ($this->booking_id->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->user_name->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->room_name->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->price->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->total_pay->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->check_in->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->check_out->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->refund->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->booking_status->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->starter_name->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->main_course_name->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->sweet_dish_name->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->trans_id->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->trans_amt->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->trans_status->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->datentime->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->rate_review->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->phonenum->AdvancedSearch->issetSession()) {
            return true;
        }
        return false;
    }

    // Clear all search parameters
    protected function resetSearchParms()
    {
        // Clear search WHERE clause
        $this->SearchWhere = "";
        $this->setSearchWhere($this->SearchWhere);

        // Clear basic search parameters
        $this->resetBasicSearchParms();

        // Clear advanced search parameters
        $this->resetAdvancedSearchParms();

        // Clear queryBuilder
        $this->setSessionRules("");
    }

    // Load advanced search default values
    protected function loadAdvancedSearchDefault()
    {
        return false;
    }

    // Clear all basic search parameters
    protected function resetBasicSearchParms()
    {
        $this->BasicSearch->unsetSession();
    }

    // Clear all advanced search parameters
    protected function resetAdvancedSearchParms()
    {
        $this->booking_id->AdvancedSearch->unsetSession();
        $this->user_name->AdvancedSearch->unsetSession();
        $this->room_name->AdvancedSearch->unsetSession();
        $this->price->AdvancedSearch->unsetSession();
        $this->total_pay->AdvancedSearch->unsetSession();
        $this->check_in->AdvancedSearch->unsetSession();
        $this->check_out->AdvancedSearch->unsetSession();
        $this->refund->AdvancedSearch->unsetSession();
        $this->booking_status->AdvancedSearch->unsetSession();
        $this->starter_name->AdvancedSearch->unsetSession();
        $this->main_course_name->AdvancedSearch->unsetSession();
        $this->sweet_dish_name->AdvancedSearch->unsetSession();
        $this->trans_id->AdvancedSearch->unsetSession();
        $this->trans_amt->AdvancedSearch->unsetSession();
        $this->trans_status->AdvancedSearch->unsetSession();
        $this->datentime->AdvancedSearch->unsetSession();
        $this->rate_review->AdvancedSearch->unsetSession();
        $this->phonenum->AdvancedSearch->unsetSession();
    }

    // Restore all search parameters
    protected function restoreSearchParms()
    {
        $this->RestoreSearch = true;

        // Restore basic search values
        $this->BasicSearch->load();

        // Restore advanced search values
        $this->booking_id->AdvancedSearch->load();
        $this->user_name->AdvancedSearch->load();
        $this->room_name->AdvancedSearch->load();
        $this->price->AdvancedSearch->load();
        $this->total_pay->AdvancedSearch->load();
        $this->check_in->AdvancedSearch->load();
        $this->check_out->AdvancedSearch->load();
        $this->refund->AdvancedSearch->load();
        $this->booking_status->AdvancedSearch->load();
        $this->starter_name->AdvancedSearch->load();
        $this->main_course_name->AdvancedSearch->load();
        $this->sweet_dish_name->AdvancedSearch->load();
        $this->trans_id->AdvancedSearch->load();
        $this->trans_amt->AdvancedSearch->load();
        $this->trans_status->AdvancedSearch->load();
        $this->datentime->AdvancedSearch->load();
        $this->rate_review->AdvancedSearch->load();
        $this->phonenum->AdvancedSearch->load();
    }

    // Set up sort parameters
    protected function setupSortOrder()
    {
        // Load default Sorting Order
        if ($this->Command != "json") {
            $defaultSort = ""; // Set up default sort
            if ($this->getSessionOrderBy() == "" && $defaultSort != "") {
                $this->setSessionOrderBy($defaultSort);
            }
        }

        // Check for "order" parameter
        if (Get("order") !== null) {
            $this->CurrentOrder = Get("order");
            $this->CurrentOrderType = Get("ordertype", "");
            $this->updateSort($this->booking_id); // booking_id
            $this->updateSort($this->user_name); // user_name
            $this->updateSort($this->room_name); // room_name
            $this->updateSort($this->price); // price
            $this->updateSort($this->total_pay); // total_pay
            $this->updateSort($this->check_in); // check_in
            $this->updateSort($this->check_out); // check_out
            $this->updateSort($this->refund); // refund
            $this->updateSort($this->booking_status); // booking_status
            $this->updateSort($this->starter_name); // starter_name
            $this->updateSort($this->main_course_name); // main_course_name
            $this->updateSort($this->sweet_dish_name); // sweet_dish_name
            $this->updateSort($this->trans_id); // trans_id
            $this->updateSort($this->trans_amt); // trans_amt
            $this->updateSort($this->trans_status); // trans_status
            $this->updateSort($this->datentime); // datentime
            $this->updateSort($this->rate_review); // rate_review
            $this->updateSort($this->phonenum); // phonenum
            $this->setStartRecordNumber(1); // Reset start position
        }

        // Update field sort
        $this->updateFieldSort();
    }

    // Reset command
    // - cmd=reset (Reset search parameters)
    // - cmd=resetall (Reset search and master/detail parameters)
    // - cmd=resetsort (Reset sort parameters)
    protected function resetCmd()
    {
        // Check if reset command
        if (StartsString("reset", $this->Command)) {
            // Reset search criteria
            if ($this->Command == "reset" || $this->Command == "resetall") {
                $this->resetSearchParms();
            }

            // Reset (clear) sorting order
            if ($this->Command == "resetsort") {
                $orderBy = "";
                $this->setSessionOrderBy($orderBy);
                $this->booking_id->setSort("");
                $this->user_name->setSort("");
                $this->room_name->setSort("");
                $this->price->setSort("");
                $this->total_pay->setSort("");
                $this->check_in->setSort("");
                $this->check_out->setSort("");
                $this->refund->setSort("");
                $this->booking_status->setSort("");
                $this->starter_name->setSort("");
                $this->main_course_name->setSort("");
                $this->sweet_dish_name->setSort("");
                $this->trans_id->setSort("");
                $this->trans_amt->setSort("");
                $this->trans_status->setSort("");
                $this->datentime->setSort("");
                $this->rate_review->setSort("");
                $this->phonenum->setSort("");
            }

            // Reset start position
            $this->StartRecord = 1;
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Set up list options
    protected function setupListOptions()
    {
        global $Security, $Language;

        // Add group option item ("button")
        $item = &$this->ListOptions->addGroupOption();
        $item->Body = "";
        $item->OnLeft = false;
        $item->Visible = false;

        // List actions
        $item = &$this->ListOptions->add("listactions");
        $item->CssClass = "text-nowrap";
        $item->OnLeft = false;
        $item->Visible = false;
        $item->ShowInButtonGroup = false;
        $item->ShowInDropDown = false;

        // "checkbox"
        $item = &$this->ListOptions->add("checkbox");
        $item->Visible = false;
        $item->OnLeft = false;
        $item->Header = "<div class=\"form-check\"><input type=\"checkbox\" name=\"key\" id=\"key\" class=\"form-check-input\" data-ew-action=\"select-all-keys\"></div>";
        if ($item->OnLeft) {
            $item->moveTo(0);
        }
        $item->ShowInDropDown = false;
        $item->ShowInButtonGroup = false;

        // Drop down button for ListOptions
        $this->ListOptions->UseDropDownButton = false;
        $this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
        $this->ListOptions->UseButtonGroup = false;
        if ($this->ListOptions->UseButtonGroup && IsMobile()) {
            $this->ListOptions->UseDropDownButton = true;
        }

        //$this->ListOptions->ButtonClass = ""; // Class for button group

        // Call ListOptions_Load event
        $this->listOptionsLoad();
        $this->setupListOptionsExt();
        $item = $this->ListOptions[$this->ListOptions->GroupOptionName];
        $item->Visible = $this->ListOptions->groupOptionVisible();
    }

    // Set up list options (extensions)
    protected function setupListOptionsExt()
    {
            // Set up list options (to be implemented by extensions)
    }

    // Add "hash" parameter to URL
    public function urlAddHash($url, $hash)
    {
        return $this->UseAjaxActions ? $url : UrlAddQuery($url, "hash=" . $hash);
    }

    // Render list options
    public function renderListOptions()
    {
        global $Security, $Language, $CurrentForm;
        $this->ListOptions->loadDefault();

        // Call ListOptions_Rendering event
        $this->listOptionsRendering();
        $pageUrl = $this->pageUrl(false);
        if ($this->CurrentMode == "view") { // Check view mode
        } // End View mode

        // Set up list action buttons
        $opt = $this->ListOptions["listactions"];
        if ($opt && !$this->isExport() && !$this->CurrentAction) {
            $body = "";
            $links = [];
            foreach ($this->ListActions as $listAction) {
                $action = $listAction->Action;
                $allowed = $listAction->Allowed;
                $disabled = false;
                if ($listAction->Select == ACTION_SINGLE && $allowed) {
                    $caption = $listAction->Caption;
                    $title = HtmlTitle($caption);
                    if ($action != "") {
                        $icon = ($listAction->Icon != "") ? "<i class=\"" . HtmlEncode(str_replace(" ew-icon", "", $listAction->Icon)) . "\" data-caption=\"" . $title . "\"></i> " : "";
                        $link = $disabled
                            ? "<li><div class=\"alert alert-light\">" . $icon . " " . $caption . "</div></li>"
                            : "<li><button type=\"button\" class=\"dropdown-item ew-action ew-list-action\" data-caption=\"" . $title . "\" data-ew-action=\"submit\" form=\"fview3list\" data-key=\"" . $this->keyToJson(true) . "\"" . $listAction->toDataAttributes() . ">" . $icon . " " . $caption . "</button></li>";
                        $links[] = $link;
                        if ($body == "") { // Setup first button
                            $body = $disabled
                            ? "<div class=\"alert alert-light\">" . $icon . " " . $caption . "</div>"
                            : "<button type=\"button\" class=\"btn btn-default ew-action ew-list-action\" title=\"" . $title . "\" data-caption=\"" . $title . "\" data-ew-action=\"submit\" form=\"fview3list\" data-key=\"" . $this->keyToJson(true) . "\"" . $listAction->toDataAttributes() . ">" . $icon . " " . $caption . "</button>";
                        }
                    }
                }
            }
            if (count($links) > 1) { // More than one buttons, use dropdown
                $body = "<button type=\"button\" class=\"dropdown-toggle btn btn-default ew-actions\" title=\"" . HtmlTitle($Language->phrase("ListActionButton")) . "\" data-bs-toggle=\"dropdown\">" . $Language->phrase("ListActionButton") . "</button>";
                $content = "";
                foreach ($links as $link) {
                    $content .= "<li>" . $link . "</li>";
                }
                $body .= "<ul class=\"dropdown-menu" . ($opt->OnLeft ? "" : " dropdown-menu-right") . "\">" . $content . "</ul>";
                $body = "<div class=\"btn-group btn-group-sm\">" . $body . "</div>";
            }
            if (count($links) > 0) {
                $opt->Body = $body;
            }
        }

        // "checkbox"
        $opt = $this->ListOptions["checkbox"];
        $this->renderListOptionsExt();

        // Call ListOptions_Rendered event
        $this->listOptionsRendered();
    }

    // Render list options (extensions)
    protected function renderListOptionsExt()
    {
        // Render list options (to be implemented by extensions)
        global $Security, $Language;
    }

    // Set up other options
    protected function setupOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
        $option = $options["action"];

        // Show column list for column visibility
        if ($this->UseColumnVisibility) {
            $option = $this->OtherOptions["column"];
            $item = &$option->addGroupOption();
            $item->Body = "";
            $item->Visible = $this->UseColumnVisibility;
            $this->createColumnOption($option, "booking_id");
            $this->createColumnOption($option, "user_name");
            $this->createColumnOption($option, "room_name");
            $this->createColumnOption($option, "price");
            $this->createColumnOption($option, "total_pay");
            $this->createColumnOption($option, "check_in");
            $this->createColumnOption($option, "check_out");
            $this->createColumnOption($option, "refund");
            $this->createColumnOption($option, "booking_status");
            $this->createColumnOption($option, "starter_name");
            $this->createColumnOption($option, "main_course_name");
            $this->createColumnOption($option, "sweet_dish_name");
            $this->createColumnOption($option, "trans_id");
            $this->createColumnOption($option, "trans_amt");
            $this->createColumnOption($option, "trans_status");
            $this->createColumnOption($option, "datentime");
            $this->createColumnOption($option, "rate_review");
            $this->createColumnOption($option, "phonenum");
        }

        // Set up custom actions
        foreach ($this->CustomActions as $name => $action) {
            $this->ListActions[$name] = $action;
        }

        // Set up options default
        foreach ($options as $name => $option) {
            if ($name != "column") { // Always use dropdown for column
                $option->UseDropDownButton = false;
                $option->UseButtonGroup = true;
            }
            //$option->ButtonClass = ""; // Class for button group
            $item = &$option->addGroupOption();
            $item->Body = "";
            $item->Visible = false;
        }
        $options["addedit"]->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
        $options["detail"]->DropDownButtonPhrase = $Language->phrase("ButtonDetails");
        $options["action"]->DropDownButtonPhrase = $Language->phrase("ButtonActions");

        // Filter button
        $item = &$this->FilterOptions->add("savecurrentfilter");
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"fview3srch\" data-ew-action=\"none\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = true;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"fview3srch\" data-ew-action=\"none\">" . $Language->phrase("DeleteFilter") . "</a>";
        $item->Visible = true;
        $this->FilterOptions->UseDropDownButton = true;
        $this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
        $this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

        // Add group option item
        $item = &$this->FilterOptions->addGroupOption();
        $item->Body = "";
        $item->Visible = false;

        // Page header/footer options
        $this->HeaderOptions = new ListOptions(TagClassName: "ew-header-option", UseDropDownButton: false, UseButtonGroup: false);
        $item = &$this->HeaderOptions->addGroupOption();
        $item->Body = "";
        $item->Visible = false;
        $this->FooterOptions = new ListOptions(TagClassName: "ew-footer-option", UseDropDownButton: false, UseButtonGroup: false);
        $item = &$this->FooterOptions->addGroupOption();
        $item->Body = "";
        $item->Visible = false;

        // Show active user count from SQL
    }

    // Active user filter
    // - Get active users by SQL (SELECT COUNT(*) FROM UserTable WHERE ProfileField LIKE '%"SessionID":%')
    protected function activeUserFilter()
    {
        if (UserProfile::$FORCE_LOGOUT_USER) {
            $userProfileField = $this->Fields[Config("USER_PROFILE_FIELD_NAME")];
            return $userProfileField->Expression . " LIKE '%\"" . UserProfile::$SESSION_ID . "\":%'";
        }
        return "0=1"; // No active users
    }

    // Create new column option
    protected function createColumnOption($option, $name)
    {
        $field = $this->Fields[$name] ?? null;
        if ($field?->Visible) {
            $item = $option->add($field->Name);
            $item->Body = '<button class="dropdown-item">' .
                '<div class="form-check ew-dropdown-checkbox">' .
                '<div class="form-check-input ew-dropdown-check-input" data-field="' . $field->Param . '"></div>' .
                '<label class="form-check-label ew-dropdown-check-label">' . $field->caption() . '</label></div></button>';
        }
    }

    // Render other options
    public function renderOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
        $option = $options["action"];
        // Set up list action buttons
        foreach ($this->ListActions as $listAction) {
            if ($listAction->Select == ACTION_MULTIPLE) {
                $item = &$option->add("custom_" . $listAction->Action);
                $caption = $listAction->Caption;
                $icon = ($listAction->Icon != "") ? '<i class="' . HtmlEncode($listAction->Icon) . '" data-caption="' . HtmlEncode($caption) . '"></i>' . $caption : $caption;
                $item->Body = '<button type="button" class="btn btn-default ew-action ew-list-action" title="' . HtmlEncode($caption) . '" data-caption="' . HtmlEncode($caption) . '" data-ew-action="submit" form="fview3list"' . $listAction->toDataAttributes() . '>' . $icon . '</button>';
                $item->Visible = $listAction->Allowed;
            }
        }

        // Hide multi edit, grid edit and other options
        if ($this->TotalRecords <= 0) {
            $option = $options["addedit"];
            $item = $option["gridedit"];
            if ($item) {
                $item->Visible = false;
            }
            $option = $options["action"];
            $option->hideAllOptions();
        }
    }

    // Process list action
    protected function processListAction()
    {
        global $Language, $Security, $Response;
        $users = [];
        $user = "";
        $filter = $this->getFilterFromRecordKeys();
        $userAction = Post("action", "");
        if ($filter != "" && $userAction != "") {
            $conn = $this->getConnection();
            // Clear current action
            $this->CurrentAction = "";
            // Check permission first
            $actionCaption = $userAction;
            $listAction = $this->ListActions[$userAction] ?? null;
            if ($listAction) {
                $this->UserAction = $userAction;
                $actionCaption = $listAction->Caption ?: $listAction->Action;
                if (!$listAction->Allowed) {
                    $errmsg = str_replace('%s', $actionCaption, $Language->phrase("CustomActionNotAllowed"));
                    if (Post("ajax") == $userAction) { // Ajax
                        echo "<p class=\"text-danger\">" . $errmsg . "</p>";
                        return true;
                    } else {
                        $this->setFailureMessage($errmsg);
                        return false;
                    }
                }
            } else {
                $errmsg = str_replace('%s', $userAction, $Language->phrase("CustomActionNotFound"));
                if (Post("ajax") == $userAction) { // Ajax
                    echo "<p class=\"text-danger\">" . $errmsg . "</p>";
                    return true;
                } else {
                    $this->setFailureMessage($errmsg);
                    return false;
                }
            }
            $rows = $this->loadRs($filter)->fetchAllAssociative();
            $this->SelectedCount = count($rows);
            $this->ActionValue = Post("actionvalue");

            // Call row action event
            if ($this->SelectedCount > 0) {
                if ($this->UseTransaction) {
                    $conn->beginTransaction();
                }
                $this->SelectedIndex = 0;
                foreach ($rows as $row) {
                    $this->SelectedIndex++;
                    $processed = $listAction->handle($row, $this);
                    if (!$processed) {
                        break;
                    }
                    $processed = $this->rowCustomAction($userAction, $row);
                    if (!$processed) {
                        break;
                    }
                }
                if ($processed) {
                    if ($this->UseTransaction) { // Commit transaction
                        if ($conn->isTransactionActive()) {
                            $conn->commit();
                        }
                    }
                    if ($this->getSuccessMessage() == "") {
                        $this->setSuccessMessage($listAction->SuccessMessage);
                    }
                    if ($this->getSuccessMessage() == "") {
                        $this->setSuccessMessage(str_replace("%s", $actionCaption, $Language->phrase("CustomActionCompleted"))); // Set up success message
                    }
                } else {
                    if ($this->UseTransaction) { // Rollback transaction
                        if ($conn->isTransactionActive()) {
                            $conn->rollback();
                        }
                    }
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($listAction->FailureMessage);
                    }

                    // Set up error message
                    if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                        // Use the message, do nothing
                    } elseif ($this->CancelMessage != "") {
                        $this->setFailureMessage($this->CancelMessage);
                        $this->CancelMessage = "";
                    } else {
                        $this->setFailureMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionFailed")));
                    }
                }
            }
            if (Post("ajax") == $userAction) { // Ajax
                if (WithJsonResponse()) { // List action returns JSON
                    $this->clearSuccessMessage(); // Clear success message
                    $this->clearFailureMessage(); // Clear failure message
                } else {
                    if ($this->getSuccessMessage() != "") {
                        echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
                        $this->clearSuccessMessage(); // Clear success message
                    }
                    if ($this->getFailureMessage() != "") {
                        echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
                        $this->clearFailureMessage(); // Clear failure message
                    }
                }
                return true;
            }
        }
        return false; // Not ajax request
    }

    // Set up Grid
    public function setupGrid()
    {
        global $CurrentForm;
        if ($this->ExportAll && $this->isExport()) {
            $this->StopRecord = $this->TotalRecords;
        } else {
            // Set the last record to display
            if ($this->TotalRecords > $this->StartRecord + $this->DisplayRecords - 1) {
                $this->StopRecord = $this->StartRecord + $this->DisplayRecords - 1;
            } else {
                $this->StopRecord = $this->TotalRecords;
            }
        }
        $this->RecordCount = $this->StartRecord - 1;
        if ($this->CurrentRow !== false) {
            // Nothing to do
        } elseif ($this->isGridAdd() && !$this->AllowAddDeleteRow && $this->StopRecord == 0) { // Grid-Add with no records
            $this->StopRecord = $this->GridAddRowCount;
        } elseif ($this->isAdd() && $this->TotalRecords == 0) { // Inline-Add with no records
            $this->StopRecord = 1;
        }

        // Initialize aggregate
        $this->RowType = RowType::AGGREGATEINIT;
        $this->resetAttributes();
        $this->renderRow();
        if (($this->isGridAdd() || $this->isGridEdit())) { // Render template row first
            $this->RowIndex = '$rowindex$';
        }
    }

    // Set up Row
    public function setupRow()
    {
        global $CurrentForm;
        if ($this->isGridAdd() || $this->isGridEdit()) {
            if ($this->RowIndex === '$rowindex$') { // Render template row first
                $this->loadRowValues();

                // Set row properties
                $this->resetAttributes();
                $this->RowAttrs->merge(["data-rowindex" => $this->RowIndex, "id" => "r0_view3", "data-rowtype" => RowType::ADD]);
                $this->RowAttrs->appendClass("ew-template");
                // Render row
                $this->RowType = RowType::ADD;
                $this->renderRow();

                // Render list options
                $this->renderListOptions();

                // Reset record count for template row
                $this->RecordCount--;
                return;
            }
        }

        // Set up key count
        $this->KeyCount = $this->RowIndex;

        // Init row class and style
        $this->resetAttributes();
        $this->CssClass = "";
        if ($this->isCopy() && $this->InlineRowCount == 0 && !$this->loadRow()) { // Inline copy
            $this->CurrentAction = "add";
        }
        if ($this->isAdd() && $this->InlineRowCount == 0 || $this->isGridAdd()) {
            $this->loadRowValues(); // Load default values
            $this->OldKey = "";
            $this->setKey($this->OldKey);
        } elseif ($this->isInlineInserted() && $this->UseInfiniteScroll) {
            // Nothing to do, just use current values
        } elseif (!($this->isCopy() && $this->InlineRowCount == 0)) {
            $this->loadRowValues($this->CurrentRow); // Load row values
            if ($this->isGridEdit() || $this->isMultiEdit()) {
                $this->OldKey = $this->getKey(true); // Get from CurrentValue
                $this->setKey($this->OldKey);
            }
        }
        $this->RowType = RowType::VIEW; // Render view
        if (($this->isAdd() || $this->isCopy()) && $this->InlineRowCount == 0 || $this->isGridAdd()) { // Add
            $this->RowType = RowType::ADD; // Render add
        }

        // Inline Add/Copy row (row 0)
        if ($this->RowType == RowType::ADD && ($this->isAdd() || $this->isCopy())) {
            $this->InlineRowCount++;
            $this->RecordCount--; // Reset record count for inline add/copy row
            if ($this->TotalRecords == 0) { // Reset stop record if no records
                $this->StopRecord = 0;
            }
        } else {
            // Inline Edit row
            if ($this->RowType == RowType::EDIT && $this->isEdit()) {
                $this->InlineRowCount++;
            }
            $this->RowCount++; // Increment row count
        }

        // Set up row attributes
        $this->RowAttrs->merge([
            "data-rowindex" => $this->RowCount,
            "data-key" => $this->getKey(true),
            "id" => "r" . $this->RowCount . "_view3",
            "data-rowtype" => $this->RowType,
            "data-inline" => ($this->isAdd() || $this->isCopy() || $this->isEdit()) ? "true" : "false", // Inline-Add/Copy/Edit
            "class" => ($this->RowCount % 2 != 1) ? "ew-table-alt-row" : "",
        ]);
        if ($this->isAdd() && $this->RowType == RowType::ADD || $this->isEdit() && $this->RowType == RowType::EDIT) { // Inline-Add/Edit row
            $this->RowAttrs->appendClass("table-active");
        }

        // Render row
        $this->renderRow();

        // Render list options
        $this->renderListOptions();
    }

    // Load basic search values
    protected function loadBasicSearchValues()
    {
        $this->BasicSearch->setKeyword(Get(Config("TABLE_BASIC_SEARCH"), ""), false);
        if ($this->BasicSearch->Keyword != "" && $this->Command == "") {
            $this->Command = "search";
        }
        $this->BasicSearch->setType(Get(Config("TABLE_BASIC_SEARCH_TYPE"), ""), false);
    }

    // Load search values for validation
    protected function loadSearchValues()
    {
        // Load search values
        $hasValue = false;

        // Load query builder rules
        $rules = Post("rules");
        if ($rules && $this->Command == "") {
            $this->QueryRules = $rules;
            $this->Command = "search";
        }

        // booking_id
        if ($this->booking_id->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->booking_id->AdvancedSearch->SearchValue != "" || $this->booking_id->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // user_name
        if ($this->user_name->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->user_name->AdvancedSearch->SearchValue != "" || $this->user_name->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // room_name
        if ($this->room_name->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->room_name->AdvancedSearch->SearchValue != "" || $this->room_name->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // price
        if ($this->price->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->price->AdvancedSearch->SearchValue != "" || $this->price->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // total_pay
        if ($this->total_pay->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->total_pay->AdvancedSearch->SearchValue != "" || $this->total_pay->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // check_in
        if ($this->check_in->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->check_in->AdvancedSearch->SearchValue != "" || $this->check_in->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // check_out
        if ($this->check_out->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->check_out->AdvancedSearch->SearchValue != "" || $this->check_out->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // refund
        if ($this->refund->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->refund->AdvancedSearch->SearchValue != "" || $this->refund->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // booking_status
        if ($this->booking_status->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->booking_status->AdvancedSearch->SearchValue != "" || $this->booking_status->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // starter_name
        if ($this->starter_name->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->starter_name->AdvancedSearch->SearchValue != "" || $this->starter_name->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // main_course_name
        if ($this->main_course_name->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->main_course_name->AdvancedSearch->SearchValue != "" || $this->main_course_name->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // sweet_dish_name
        if ($this->sweet_dish_name->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->sweet_dish_name->AdvancedSearch->SearchValue != "" || $this->sweet_dish_name->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // trans_id
        if ($this->trans_id->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->trans_id->AdvancedSearch->SearchValue != "" || $this->trans_id->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // trans_amt
        if ($this->trans_amt->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->trans_amt->AdvancedSearch->SearchValue != "" || $this->trans_amt->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // trans_status
        if ($this->trans_status->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->trans_status->AdvancedSearch->SearchValue != "" || $this->trans_status->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // datentime
        if ($this->datentime->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->datentime->AdvancedSearch->SearchValue != "" || $this->datentime->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // rate_review
        if ($this->rate_review->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->rate_review->AdvancedSearch->SearchValue != "" || $this->rate_review->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // phonenum
        if ($this->phonenum->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->phonenum->AdvancedSearch->SearchValue != "" || $this->phonenum->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }
        return $hasValue;
    }

    /**
     * Load result set
     *
     * @param int $offset Offset
     * @param int $rowcnt Maximum number of rows
     * @return Doctrine\DBAL\Result Result
     */
    public function loadRecordset($offset = -1, $rowcnt = -1)
    {
        // Load List page SQL (QueryBuilder)
        $sql = $this->getListSql();

        // Load result set
        if ($offset > -1) {
            $sql->setFirstResult($offset);
        }
        if ($rowcnt > 0) {
            $sql->setMaxResults($rowcnt);
        }
        $result = $sql->executeQuery();
        if (property_exists($this, "TotalRecords") && $rowcnt < 0) {
            $this->TotalRecords = $result->rowCount();
            if ($this->TotalRecords <= 0) { // Handle database drivers that does not return rowCount()
                $this->TotalRecords = $this->getRecordCount($this->getListSql());
            }
        }

        // Call Recordset Selected event
        $this->recordsetSelected($result);
        return $result;
    }

    /**
     * Load records as associative array
     *
     * @param int $offset Offset
     * @param int $rowcnt Maximum number of rows
     * @return void
     */
    public function loadRows($offset = -1, $rowcnt = -1)
    {
        // Load List page SQL (QueryBuilder)
        $sql = $this->getListSql();

        // Load result set
        if ($offset > -1) {
            $sql->setFirstResult($offset);
        }
        if ($rowcnt > 0) {
            $sql->setMaxResults($rowcnt);
        }
        $result = $sql->executeQuery();
        return $result->fetchAllAssociative();
    }

    /**
     * Load row based on key values
     *
     * @return void
     */
    public function loadRow()
    {
        global $Security, $Language;
        $filter = $this->getRecordFilter();

        // Call Row Selecting event
        $this->rowSelecting($filter);

        // Load SQL based on filter
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $res = false;
        $row = $conn->fetchAssociative($sql);
        if ($row) {
            $res = true;
            $this->loadRowValues($row); // Load row values
        }
        return $res;
    }

    /**
     * Load row values from result set or record
     *
     * @param array $row Record
     * @return void
     */
    public function loadRowValues($row = null)
    {
        $row = is_array($row) ? $row : $this->newRow();

        // Call Row Selected event
        $this->rowSelected($row);
        $this->booking_id->setDbValue($row['booking_id']);
        $this->user_name->setDbValue($row['user_name']);
        $this->room_name->setDbValue($row['room_name']);
        $this->price->setDbValue($row['price']);
        $this->total_pay->setDbValue($row['total_pay']);
        $this->check_in->setDbValue($row['check_in']);
        $this->check_out->setDbValue($row['check_out']);
        $this->refund->setDbValue($row['refund']);
        $this->booking_status->setDbValue($row['booking_status']);
        $this->starter_name->setDbValue($row['starter_name']);
        $this->main_course_name->setDbValue($row['main_course_name']);
        $this->sweet_dish_name->setDbValue($row['sweet_dish_name']);
        $this->trans_id->setDbValue($row['trans_id']);
        $this->trans_amt->setDbValue($row['trans_amt']);
        $this->trans_status->setDbValue($row['trans_status']);
        $this->datentime->setDbValue($row['datentime']);
        $this->rate_review->setDbValue($row['rate_review']);
        $this->phonenum->setDbValue($row['phonenum']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['booking_id'] = $this->booking_id->DefaultValue;
        $row['user_name'] = $this->user_name->DefaultValue;
        $row['room_name'] = $this->room_name->DefaultValue;
        $row['price'] = $this->price->DefaultValue;
        $row['total_pay'] = $this->total_pay->DefaultValue;
        $row['check_in'] = $this->check_in->DefaultValue;
        $row['check_out'] = $this->check_out->DefaultValue;
        $row['refund'] = $this->refund->DefaultValue;
        $row['booking_status'] = $this->booking_status->DefaultValue;
        $row['starter_name'] = $this->starter_name->DefaultValue;
        $row['main_course_name'] = $this->main_course_name->DefaultValue;
        $row['sweet_dish_name'] = $this->sweet_dish_name->DefaultValue;
        $row['trans_id'] = $this->trans_id->DefaultValue;
        $row['trans_amt'] = $this->trans_amt->DefaultValue;
        $row['trans_status'] = $this->trans_status->DefaultValue;
        $row['datentime'] = $this->datentime->DefaultValue;
        $row['rate_review'] = $this->rate_review->DefaultValue;
        $row['phonenum'] = $this->phonenum->DefaultValue;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        $this->loadRowValues(); // Load default row values
        return null;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs
        $this->ViewUrl = $this->getViewUrl();
        $this->EditUrl = $this->getEditUrl();
        $this->InlineEditUrl = $this->getInlineEditUrl();
        $this->CopyUrl = $this->getCopyUrl();
        $this->InlineCopyUrl = $this->getInlineCopyUrl();
        $this->DeleteUrl = $this->getDeleteUrl();

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // booking_id

        // user_name

        // room_name

        // price

        // total_pay

        // check_in

        // check_out

        // refund

        // booking_status

        // starter_name

        // main_course_name

        // sweet_dish_name

        // trans_id

        // trans_amt

        // trans_status

        // datentime

        // rate_review

        // phonenum

        // View row
        if ($this->RowType == RowType::VIEW) {
            // booking_id
            $this->booking_id->ViewValue = $this->booking_id->CurrentValue;
            $this->booking_id->ViewValue = FormatNumber($this->booking_id->ViewValue, $this->booking_id->formatPattern());

            // user_name
            $this->user_name->ViewValue = $this->user_name->CurrentValue;

            // room_name
            $this->room_name->ViewValue = $this->room_name->CurrentValue;

            // price
            $this->price->ViewValue = $this->price->CurrentValue;
            $this->price->ViewValue = FormatNumber($this->price->ViewValue, $this->price->formatPattern());

            // total_pay
            $this->total_pay->ViewValue = $this->total_pay->CurrentValue;
            $this->total_pay->ViewValue = FormatNumber($this->total_pay->ViewValue, $this->total_pay->formatPattern());

            // check_in
            $this->check_in->ViewValue = $this->check_in->CurrentValue;
            $this->check_in->ViewValue = FormatDateTime($this->check_in->ViewValue, $this->check_in->formatPattern());

            // check_out
            $this->check_out->ViewValue = $this->check_out->CurrentValue;
            $this->check_out->ViewValue = FormatDateTime($this->check_out->ViewValue, $this->check_out->formatPattern());

            // refund
            $this->refund->ViewValue = $this->refund->CurrentValue;
            $this->refund->ViewValue = FormatNumber($this->refund->ViewValue, $this->refund->formatPattern());

            // booking_status
            $this->booking_status->ViewValue = $this->booking_status->CurrentValue;

            // starter_name
            $this->starter_name->ViewValue = $this->starter_name->CurrentValue;

            // main_course_name
            $this->main_course_name->ViewValue = $this->main_course_name->CurrentValue;

            // sweet_dish_name
            $this->sweet_dish_name->ViewValue = $this->sweet_dish_name->CurrentValue;

            // trans_id
            $this->trans_id->ViewValue = $this->trans_id->CurrentValue;

            // trans_amt
            $this->trans_amt->ViewValue = $this->trans_amt->CurrentValue;
            $this->trans_amt->ViewValue = FormatNumber($this->trans_amt->ViewValue, $this->trans_amt->formatPattern());

            // trans_status
            $this->trans_status->ViewValue = $this->trans_status->CurrentValue;

            // datentime
            $this->datentime->ViewValue = $this->datentime->CurrentValue;
            $this->datentime->ViewValue = FormatDateTime($this->datentime->ViewValue, $this->datentime->formatPattern());

            // rate_review
            $this->rate_review->ViewValue = $this->rate_review->CurrentValue;
            $this->rate_review->ViewValue = FormatNumber($this->rate_review->ViewValue, $this->rate_review->formatPattern());

            // phonenum
            $this->phonenum->ViewValue = $this->phonenum->CurrentValue;

            // booking_id
            $this->booking_id->HrefValue = "";
            $this->booking_id->TooltipValue = "";

            // user_name
            $this->user_name->HrefValue = "";
            $this->user_name->TooltipValue = "";

            // room_name
            $this->room_name->HrefValue = "";
            $this->room_name->TooltipValue = "";

            // price
            $this->price->HrefValue = "";
            $this->price->TooltipValue = "";

            // total_pay
            $this->total_pay->HrefValue = "";
            $this->total_pay->TooltipValue = "";

            // check_in
            $this->check_in->HrefValue = "";
            $this->check_in->TooltipValue = "";

            // check_out
            $this->check_out->HrefValue = "";
            $this->check_out->TooltipValue = "";

            // refund
            $this->refund->HrefValue = "";
            $this->refund->TooltipValue = "";

            // booking_status
            $this->booking_status->HrefValue = "";
            $this->booking_status->TooltipValue = "";

            // starter_name
            $this->starter_name->HrefValue = "";
            $this->starter_name->TooltipValue = "";

            // main_course_name
            $this->main_course_name->HrefValue = "";
            $this->main_course_name->TooltipValue = "";

            // sweet_dish_name
            $this->sweet_dish_name->HrefValue = "";
            $this->sweet_dish_name->TooltipValue = "";

            // trans_id
            $this->trans_id->HrefValue = "";
            $this->trans_id->TooltipValue = "";

            // trans_amt
            $this->trans_amt->HrefValue = "";
            $this->trans_amt->TooltipValue = "";

            // trans_status
            $this->trans_status->HrefValue = "";
            $this->trans_status->TooltipValue = "";

            // datentime
            $this->datentime->HrefValue = "";
            $this->datentime->TooltipValue = "";

            // rate_review
            $this->rate_review->HrefValue = "";
            $this->rate_review->TooltipValue = "";

            // phonenum
            $this->phonenum->HrefValue = "";
            $this->phonenum->TooltipValue = "";
        } elseif ($this->RowType == RowType::SEARCH) {
            // booking_id
            $this->booking_id->setupEditAttributes();
            $this->booking_id->EditValue = $this->booking_id->AdvancedSearch->SearchValue;
            $this->booking_id->PlaceHolder = RemoveHtml($this->booking_id->caption());

            // user_name
            if ($this->user_name->UseFilter && !EmptyValue($this->user_name->AdvancedSearch->SearchValue)) {
                if (is_array($this->user_name->AdvancedSearch->SearchValue)) {
                    $this->user_name->AdvancedSearch->SearchValue = implode(Config("FILTER_OPTION_SEPARATOR"), $this->user_name->AdvancedSearch->SearchValue);
                }
                $this->user_name->EditValue = explode(Config("FILTER_OPTION_SEPARATOR"), $this->user_name->AdvancedSearch->SearchValue);
            }

            // room_name
            if ($this->room_name->UseFilter && !EmptyValue($this->room_name->AdvancedSearch->SearchValue)) {
                if (is_array($this->room_name->AdvancedSearch->SearchValue)) {
                    $this->room_name->AdvancedSearch->SearchValue = implode(Config("FILTER_OPTION_SEPARATOR"), $this->room_name->AdvancedSearch->SearchValue);
                }
                $this->room_name->EditValue = explode(Config("FILTER_OPTION_SEPARATOR"), $this->room_name->AdvancedSearch->SearchValue);
            }

            // price
            if ($this->price->UseFilter && !EmptyValue($this->price->AdvancedSearch->SearchValue)) {
                if (is_array($this->price->AdvancedSearch->SearchValue)) {
                    $this->price->AdvancedSearch->SearchValue = implode(Config("FILTER_OPTION_SEPARATOR"), $this->price->AdvancedSearch->SearchValue);
                }
                $this->price->EditValue = explode(Config("FILTER_OPTION_SEPARATOR"), $this->price->AdvancedSearch->SearchValue);
            }

            // total_pay
            if ($this->total_pay->UseFilter && !EmptyValue($this->total_pay->AdvancedSearch->SearchValue)) {
                if (is_array($this->total_pay->AdvancedSearch->SearchValue)) {
                    $this->total_pay->AdvancedSearch->SearchValue = implode(Config("FILTER_OPTION_SEPARATOR"), $this->total_pay->AdvancedSearch->SearchValue);
                }
                $this->total_pay->EditValue = explode(Config("FILTER_OPTION_SEPARATOR"), $this->total_pay->AdvancedSearch->SearchValue);
            }

            // check_in
            if ($this->check_in->UseFilter && !EmptyValue($this->check_in->AdvancedSearch->SearchValue)) {
                if (is_array($this->check_in->AdvancedSearch->SearchValue)) {
                    $this->check_in->AdvancedSearch->SearchValue = implode(Config("FILTER_OPTION_SEPARATOR"), $this->check_in->AdvancedSearch->SearchValue);
                }
                $this->check_in->EditValue = explode(Config("FILTER_OPTION_SEPARATOR"), $this->check_in->AdvancedSearch->SearchValue);
            }

            // check_out
            if ($this->check_out->UseFilter && !EmptyValue($this->check_out->AdvancedSearch->SearchValue)) {
                if (is_array($this->check_out->AdvancedSearch->SearchValue)) {
                    $this->check_out->AdvancedSearch->SearchValue = implode(Config("FILTER_OPTION_SEPARATOR"), $this->check_out->AdvancedSearch->SearchValue);
                }
                $this->check_out->EditValue = explode(Config("FILTER_OPTION_SEPARATOR"), $this->check_out->AdvancedSearch->SearchValue);
            }

            // refund
            if ($this->refund->UseFilter && !EmptyValue($this->refund->AdvancedSearch->SearchValue)) {
                if (is_array($this->refund->AdvancedSearch->SearchValue)) {
                    $this->refund->AdvancedSearch->SearchValue = implode(Config("FILTER_OPTION_SEPARATOR"), $this->refund->AdvancedSearch->SearchValue);
                }
                $this->refund->EditValue = explode(Config("FILTER_OPTION_SEPARATOR"), $this->refund->AdvancedSearch->SearchValue);
            }

            // booking_status
            if ($this->booking_status->UseFilter && !EmptyValue($this->booking_status->AdvancedSearch->SearchValue)) {
                if (is_array($this->booking_status->AdvancedSearch->SearchValue)) {
                    $this->booking_status->AdvancedSearch->SearchValue = implode(Config("FILTER_OPTION_SEPARATOR"), $this->booking_status->AdvancedSearch->SearchValue);
                }
                $this->booking_status->EditValue = explode(Config("FILTER_OPTION_SEPARATOR"), $this->booking_status->AdvancedSearch->SearchValue);
            }

            // starter_name
            if ($this->starter_name->UseFilter && !EmptyValue($this->starter_name->AdvancedSearch->SearchValue)) {
                if (is_array($this->starter_name->AdvancedSearch->SearchValue)) {
                    $this->starter_name->AdvancedSearch->SearchValue = implode(Config("FILTER_OPTION_SEPARATOR"), $this->starter_name->AdvancedSearch->SearchValue);
                }
                $this->starter_name->EditValue = explode(Config("FILTER_OPTION_SEPARATOR"), $this->starter_name->AdvancedSearch->SearchValue);
            }

            // main_course_name
            if ($this->main_course_name->UseFilter && !EmptyValue($this->main_course_name->AdvancedSearch->SearchValue)) {
                if (is_array($this->main_course_name->AdvancedSearch->SearchValue)) {
                    $this->main_course_name->AdvancedSearch->SearchValue = implode(Config("FILTER_OPTION_SEPARATOR"), $this->main_course_name->AdvancedSearch->SearchValue);
                }
                $this->main_course_name->EditValue = explode(Config("FILTER_OPTION_SEPARATOR"), $this->main_course_name->AdvancedSearch->SearchValue);
            }

            // sweet_dish_name
            if ($this->sweet_dish_name->UseFilter && !EmptyValue($this->sweet_dish_name->AdvancedSearch->SearchValue)) {
                if (is_array($this->sweet_dish_name->AdvancedSearch->SearchValue)) {
                    $this->sweet_dish_name->AdvancedSearch->SearchValue = implode(Config("FILTER_OPTION_SEPARATOR"), $this->sweet_dish_name->AdvancedSearch->SearchValue);
                }
                $this->sweet_dish_name->EditValue = explode(Config("FILTER_OPTION_SEPARATOR"), $this->sweet_dish_name->AdvancedSearch->SearchValue);
            }

            // trans_id
            $this->trans_id->setupEditAttributes();
            if (!$this->trans_id->Raw) {
                $this->trans_id->AdvancedSearch->SearchValue = HtmlDecode($this->trans_id->AdvancedSearch->SearchValue);
            }
            $this->trans_id->EditValue = HtmlEncode($this->trans_id->AdvancedSearch->SearchValue);
            $this->trans_id->PlaceHolder = RemoveHtml($this->trans_id->caption());

            // trans_amt
            if ($this->trans_amt->UseFilter && !EmptyValue($this->trans_amt->AdvancedSearch->SearchValue)) {
                if (is_array($this->trans_amt->AdvancedSearch->SearchValue)) {
                    $this->trans_amt->AdvancedSearch->SearchValue = implode(Config("FILTER_OPTION_SEPARATOR"), $this->trans_amt->AdvancedSearch->SearchValue);
                }
                $this->trans_amt->EditValue = explode(Config("FILTER_OPTION_SEPARATOR"), $this->trans_amt->AdvancedSearch->SearchValue);
            }

            // trans_status
            if ($this->trans_status->UseFilter && !EmptyValue($this->trans_status->AdvancedSearch->SearchValue)) {
                if (is_array($this->trans_status->AdvancedSearch->SearchValue)) {
                    $this->trans_status->AdvancedSearch->SearchValue = implode(Config("FILTER_OPTION_SEPARATOR"), $this->trans_status->AdvancedSearch->SearchValue);
                }
                $this->trans_status->EditValue = explode(Config("FILTER_OPTION_SEPARATOR"), $this->trans_status->AdvancedSearch->SearchValue);
            }

            // datentime
            if ($this->datentime->UseFilter && !EmptyValue($this->datentime->AdvancedSearch->SearchValue)) {
                if (is_array($this->datentime->AdvancedSearch->SearchValue)) {
                    $this->datentime->AdvancedSearch->SearchValue = implode(Config("FILTER_OPTION_SEPARATOR"), $this->datentime->AdvancedSearch->SearchValue);
                }
                $this->datentime->EditValue = explode(Config("FILTER_OPTION_SEPARATOR"), $this->datentime->AdvancedSearch->SearchValue);
            }

            // rate_review
            $this->rate_review->setupEditAttributes();
            $this->rate_review->EditValue = $this->rate_review->AdvancedSearch->SearchValue;
            $this->rate_review->PlaceHolder = RemoveHtml($this->rate_review->caption());

            // phonenum
            $this->phonenum->setupEditAttributes();
            if (!$this->phonenum->Raw) {
                $this->phonenum->AdvancedSearch->SearchValue = HtmlDecode($this->phonenum->AdvancedSearch->SearchValue);
            }
            $this->phonenum->EditValue = HtmlEncode($this->phonenum->AdvancedSearch->SearchValue);
            $this->phonenum->PlaceHolder = RemoveHtml($this->phonenum->caption());
        }

        // Call Row Rendered event
        if ($this->RowType != RowType::AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate search
    protected function validateSearch()
    {
        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }

        // Return validate result
        $validateSearch = !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateSearch = $validateSearch && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateSearch;
    }

    // Load advanced search
    public function loadAdvancedSearch()
    {
        $this->booking_id->AdvancedSearch->load();
        $this->user_name->AdvancedSearch->load();
        $this->room_name->AdvancedSearch->load();
        $this->price->AdvancedSearch->load();
        $this->total_pay->AdvancedSearch->load();
        $this->check_in->AdvancedSearch->load();
        $this->check_out->AdvancedSearch->load();
        $this->refund->AdvancedSearch->load();
        $this->booking_status->AdvancedSearch->load();
        $this->starter_name->AdvancedSearch->load();
        $this->main_course_name->AdvancedSearch->load();
        $this->sweet_dish_name->AdvancedSearch->load();
        $this->trans_id->AdvancedSearch->load();
        $this->trans_amt->AdvancedSearch->load();
        $this->trans_status->AdvancedSearch->load();
        $this->datentime->AdvancedSearch->load();
        $this->rate_review->AdvancedSearch->load();
        $this->phonenum->AdvancedSearch->load();
    }

    // Get export HTML tag
    protected function getExportTag($type, $custom = false)
    {
        global $Language;
        if ($type == "print" || $custom) { // Printer friendly / custom export
            $pageUrl = $this->pageUrl(false);
            $exportUrl = GetUrl($pageUrl . "export=" . $type . ($custom ? "&amp;custom=1" : ""));
        } else { // Export API URL
            $exportUrl = GetApiUrl(Config("API_EXPORT_ACTION") . "/" . $type . "/" . $this->TableVar);
        }
        if (SameText($type, "excel")) {
            if ($custom) {
                return "<button type=\"button\" class=\"btn btn-default ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcel", true)) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcel", true)) . "\" form=\"fview3list\" data-url=\"$exportUrl\" data-ew-action=\"export\" data-export=\"excel\" data-custom=\"true\" data-export-selected=\"false\">" . $Language->phrase("ExportToExcel") . "</button>";
            } else {
                return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcel", true)) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcel", true)) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
            }
        } elseif (SameText($type, "word")) {
            if ($custom) {
                return "<button type=\"button\" class=\"btn btn-default ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWord", true)) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWord", true)) . "\" form=\"fview3list\" data-url=\"$exportUrl\" data-ew-action=\"export\" data-export=\"word\" data-custom=\"true\" data-export-selected=\"false\">" . $Language->phrase("ExportToWord") . "</button>";
            } else {
                return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWord", true)) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWord", true)) . "\">" . $Language->phrase("ExportToWord") . "</a>";
            }
        } elseif (SameText($type, "pdf")) {
            if ($custom) {
                return "<button type=\"button\" class=\"btn btn-default ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPdf", true)) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPdf", true)) . "\" form=\"fview3list\" data-url=\"$exportUrl\" data-ew-action=\"export\" data-export=\"pdf\" data-custom=\"true\" data-export-selected=\"false\">" . $Language->phrase("ExportToPdf") . "</button>";
            } else {
                return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPdf", true)) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPdf", true)) . "\">" . $Language->phrase("ExportToPdf") . "</a>";
            }
        } elseif (SameText($type, "html")) {
            return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-html\" title=\"" . HtmlEncode($Language->phrase("ExportToHtml", true)) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToHtml", true)) . "\">" . $Language->phrase("ExportToHtml") . "</a>";
        } elseif (SameText($type, "xml")) {
            return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-xml\" title=\"" . HtmlEncode($Language->phrase("ExportToXml", true)) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToXml", true)) . "\">" . $Language->phrase("ExportToXml") . "</a>";
        } elseif (SameText($type, "csv")) {
            return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-csv\" title=\"" . HtmlEncode($Language->phrase("ExportToCsv", true)) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToCsv", true)) . "\">" . $Language->phrase("ExportToCsv") . "</a>";
        } elseif (SameText($type, "email")) {
            $url = $custom ? ' data-url="' . $exportUrl . '"' : '';
            return '<button type="button" class="btn btn-default ew-export-link ew-email" title="' . $Language->phrase("ExportToEmail", true) . '" data-caption="' . $Language->phrase("ExportToEmail", true) . '" form="fview3list" data-ew-action="email" data-custom="false" data-hdr="' . $Language->phrase("ExportToEmail", true) . '" data-exported-selected="false"' . $url . '>' . $Language->phrase("ExportToEmail") . '</button>';
        } elseif (SameText($type, "print")) {
            return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-print\" title=\"" . HtmlEncode($Language->phrase("PrinterFriendly", true)) . "\" data-caption=\"" . HtmlEncode($Language->phrase("PrinterFriendly", true)) . "\">" . $Language->phrase("PrinterFriendly") . "</a>";
        }
    }

    // Set up export options
    protected function setupExportOptions()
    {
        global $Language, $Security;

        // Printer friendly
        $item = &$this->ExportOptions->add("print");
        $item->Body = $this->getExportTag("print");
        $item->Visible = true;

        // Export to Excel
        $item = &$this->ExportOptions->add("excel");
        $item->Body = $this->getExportTag("excel");
        $item->Visible = true;

        // Export to Word
        $item = &$this->ExportOptions->add("word");
        $item->Body = $this->getExportTag("word");
        $item->Visible = true;

        // Export to HTML
        $item = &$this->ExportOptions->add("html");
        $item->Body = $this->getExportTag("html");
        $item->Visible = false;

        // Export to XML
        $item = &$this->ExportOptions->add("xml");
        $item->Body = $this->getExportTag("xml");
        $item->Visible = false;

        // Export to CSV
        $item = &$this->ExportOptions->add("csv");
        $item->Body = $this->getExportTag("csv");
        $item->Visible = false;

        // Export to PDF
        $item = &$this->ExportOptions->add("pdf");
        $item->Body = $this->getExportTag("pdf");
        $item->Visible = false;

        // Export to Email
        $item = &$this->ExportOptions->add("email");
        $item->Body = $this->getExportTag("email");
        $item->Visible = false;

        // Drop down button for export
        $this->ExportOptions->UseButtonGroup = true;
        $this->ExportOptions->UseDropDownButton = true;
        if ($this->ExportOptions->UseButtonGroup && IsMobile()) {
            $this->ExportOptions->UseDropDownButton = true;
        }
        $this->ExportOptions->DropDownButtonPhrase = $Language->phrase("ButtonExport");

        // Add group option item
        $item = &$this->ExportOptions->addGroupOption();
        $item->Body = "";
        $item->Visible = false;
    }

    // Set up search options
    protected function setupSearchOptions()
    {
        global $Language, $Security;
        $pageUrl = $this->pageUrl(false);
        $this->SearchOptions = new ListOptions(TagClassName: "ew-search-option");

        // Search button
        $item = &$this->SearchOptions->add("searchtoggle");
        $searchToggleClass = ($this->SearchWhere != "") ? " active" : " active";
        $item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-ew-action=\"search-toggle\" data-form=\"fview3srch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
        $item->Visible = true;

        // Show all button
        $item = &$this->SearchOptions->add("showall");
        if ($this->UseCustomTemplate || !$this->UseAjaxActions) {
            $item->Body = "<a class=\"btn btn-default ew-show-all\" role=\"button\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $pageUrl . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
        } else {
            $item->Body = "<a class=\"btn btn-default ew-show-all\" role=\"button\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" data-ew-action=\"refresh\" data-url=\"" . $pageUrl . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
        }
        $item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

        // Button group for search
        $this->SearchOptions->UseDropDownButton = false;
        $this->SearchOptions->UseButtonGroup = true;
        $this->SearchOptions->DropDownButtonPhrase = $Language->phrase("ButtonSearch");

        // Add group option item
        $item = &$this->SearchOptions->addGroupOption();
        $item->Body = "";
        $item->Visible = false;

        // Hide search options
        if ($this->isExport() || $this->CurrentAction && $this->CurrentAction != "search") {
            $this->SearchOptions->hideAllOptions();
        }
    }

    // Check if any search fields
    public function hasSearchFields()
    {
        return true;
    }

    // Render search options
    protected function renderSearchOptions()
    {
        if (!$this->hasSearchFields() && $this->SearchOptions["searchtoggle"]) {
            $this->SearchOptions["searchtoggle"]->Visible = false;
        }
    }

    /**
    * Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
    *
    * @param bool $return Return the data rather than output it
    * @return mixed
    */
    public function exportData($doc)
    {
        global $Language;
        $rs = null;
        $this->TotalRecords = $this->listRecordCount();

        // Export all
        if ($this->ExportAll) {
            if (Config("EXPORT_ALL_TIME_LIMIT") >= 0) {
                @set_time_limit(Config("EXPORT_ALL_TIME_LIMIT"));
            }
            $this->DisplayRecords = $this->TotalRecords;
            $this->StopRecord = $this->TotalRecords;
        } else { // Export one page only
            $this->setupStartRecord(); // Set up start record position
            // Set the last record to display
            if ($this->DisplayRecords <= 0) {
                $this->StopRecord = $this->TotalRecords;
            } else {
                $this->StopRecord = $this->StartRecord + $this->DisplayRecords - 1;
            }
        }
        $rs = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords <= 0 ? $this->TotalRecords : $this->DisplayRecords);
        if (!$rs || !$doc) {
            RemoveHeader("Content-Type"); // Remove header
            RemoveHeader("Content-Disposition");
            $this->showMessage();
            return;
        }
        $this->StartRecord = 1;
        $this->StopRecord = $this->DisplayRecords <= 0 ? $this->TotalRecords : $this->DisplayRecords;

        // Call Page Exporting server event
        $doc->ExportCustom = !$this->pageExporting($doc);

        // Page header
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        $doc->Text .= $header;
        $this->exportDocument($doc, $rs, $this->StartRecord, $this->StopRecord, "");
        $rs->free();

        // Page footer
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        $doc->Text .= $footer;

        // Export header and footer
        $doc->exportHeaderAndFooter();

        // Call Page Exported server event
        $this->pageExported($doc);
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset(all)
        $Breadcrumb->add("list", $this->TableVar, $url, "", $this->TableVar, true);
    }

    // Setup lookup options
    public function setupLookupOptions($fld)
    {
        if ($fld->Lookup && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $sql = $fld->Lookup->getSql(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if (!$fld->hasLookupOptions() && $fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0 && count($fld->Lookup->FilterFields) == 0) {
                $totalCnt = $this->getRecordCount($sql, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }
                $rows = $conn->executeQuery($sql)->fetchAll();
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row, Container($fld->Lookup->LinkTable));
                    $key = $row["lf"];
                    if (IsFloatType($fld->Type)) { // Handle float field
                        $key = (float)$key;
                    }
                    $ar[strval($key)] = $row;
                }
                $fld->Lookup->Options = $ar;
            }
        }
    }

    // Set up starting record parameters
    public function setupStartRecord()
    {
        if ($this->DisplayRecords == 0) {
            return;
        }
        $pageNo = Get(Config("TABLE_PAGE_NUMBER"));
        $startRec = Get(Config("TABLE_START_REC"));
        $infiniteScroll = ConvertToBool(Param("infinitescroll"));
        if ($pageNo !== null) { // Check for "pageno" parameter first
            $pageNo = ParseInteger($pageNo);
            if (is_numeric($pageNo)) {
                $this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
                if ($this->StartRecord <= 0) {
                    $this->StartRecord = 1;
                } elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1) {
                    $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1;
                }
            }
        } elseif ($startRec !== null && is_numeric($startRec)) { // Check for "start" parameter
            $this->StartRecord = $startRec;
        } elseif (!$infiniteScroll) {
            $this->StartRecord = $this->getStartRecordNumber();
        }

        // Check if correct start record counter
        if (!is_numeric($this->StartRecord) || intval($this->StartRecord) <= 0) { // Avoid invalid start record counter
            $this->StartRecord = 1; // Reset start record counter
        } elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
            $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
        } elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
            $this->StartRecord = (int)(($this->StartRecord - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
        }
        if (!$infiniteScroll) {
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Get page count
    public function pageCount() {
        return ceil($this->TotalRecords / $this->DisplayRecords);
    }

    // Parse query builder rule
    protected function parseRules($group, $fieldName = "", $itemName = "") {
        $group["condition"] ??= "AND";
        if (!in_array($group["condition"], ["AND", "OR"])) {
            throw new \Exception("Unable to build SQL query with condition '" . $group["condition"] . "'");
        }
        if (!is_array($group["rules"] ?? null)) {
            return "";
        }
        $parts = [];
        foreach ($group["rules"] as $rule) {
            if (is_array($rule["rules"] ?? null) && count($rule["rules"]) > 0) {
                $part = $this->parseRules($rule, $fieldName, $itemName);
                if ($part) {
                    $parts[] = "(" . " " . $part . " " . ")" . " ";
                }
            } else {
                $field = $rule["field"];
                $fld = $this->fieldByParam($field);
                $dbid = $this->Dbid;
                if ($fld instanceof ReportField && is_array($fld->DashboardSearchSourceFields)) {
                    $item = $fld->DashboardSearchSourceFields[$itemName] ?? null;
                    if ($item) {
                        $tbl = Container($item["table"]);
                        $dbid = $tbl->Dbid;
                        $fld = $tbl->Fields[$item["field"]];
                    } else {
                        $fld = null;
                    }
                }
                if ($fld && ($fieldName == "" || $fld->Name == $fieldName)) { // Field name not specified or matched field name
                    $fldOpr = array_search($rule["operator"], Config("CLIENT_SEARCH_OPERATORS"));
                    $ope = Config("QUERY_BUILDER_OPERATORS")[$rule["operator"]] ?? null;
                    if (!$ope || !$fldOpr) {
                        throw new \Exception("Unknown SQL operation for operator '" . $rule["operator"] . "'");
                    }
                    if ($ope["nb_inputs"] > 0 && ($rule["value"] ?? false) || IsNullOrEmptyOperator($fldOpr)) {
                        $fldVal = $rule["value"];
                        if (is_array($fldVal)) {
                            $fldVal = $fld->isMultiSelect() ? implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal) : $fldVal[0];
                        }
                        $useFilter = $fld->UseFilter; // Query builder does not use filter
                        try {
                            if ($fld instanceof ReportField) { // Search report fields
                                if ($fld->SearchType == "dropdown") {
                                    if (is_array($fldVal)) {
                                        $sql = "";
                                        foreach ($fldVal as $val) {
                                            AddFilter($sql, DropDownFilter($fld, $val, $fldOpr, $dbid), "OR");
                                        }
                                        $parts[] = $sql;
                                    } else {
                                        $parts[] = DropDownFilter($fld, $fldVal, $fldOpr, $dbid);
                                    }
                                } else {
                                    $fld->AdvancedSearch->SearchOperator = $fldOpr;
                                    $fld->AdvancedSearch->SearchValue = $fldVal;
                                    $parts[] = GetReportFilter($fld, false, $dbid);
                                }
                            } else { // Search normal fields
                                if ($fld->isMultiSelect()) {
                                    $parts[] = $fldVal != "" ? GetMultiSearchSql($fld, $fldOpr, ConvertSearchValue($fldVal, $fldOpr, $fld), $this->Dbid) : "";
                                } else {
                                    $fldVal2 = ContainsString($fldOpr, "BETWEEN") ? $rule["value"][1] : ""; // BETWEEN
                                    if (is_array($fldVal2)) {
                                        $fldVal2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal2);
                                    }
                                    $parts[] = GetSearchSql(
                                        $fld,
                                        ConvertSearchValue($fldVal, $fldOpr, $fld), // $fldVal
                                        $fldOpr,
                                        "", // $fldCond not used
                                        ConvertSearchValue($fldVal2, $fldOpr, $fld), // $fldVal2
                                        "", // $fldOpr2 not used
                                        $this->Dbid
                                    );
                                }
                            }
                        } finally {
                            $fld->UseFilter = $useFilter;
                        }
                    }
                }
            }
        }
        $where = "";
        foreach ($parts as $part) {
            AddFilter($where, $part, $group["condition"]);
        }
        if ($where && ($group["not"] ?? false)) {
            $where = "NOT (" . $where . ")";
        }
        return $where;
    }

    // Page Load event
    public function pageLoad()
    {
        //Log("Page Load");
    }

    // Page Unload event
    public function pageUnload()
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(&$url)
    {
        // Example:
        //$url = "your URL";
    }

    // Message Showing event
    // $type = ''|'success'|'failure'|'warning'
    public function messageShowing(&$msg, $type)
    {
        if ($type == "success") {
            //$msg = "your success message";
        } elseif ($type == "failure") {
            //$msg = "your failure message";
        } elseif ($type == "warning") {
            //$msg = "your warning message";
        } else {
            //$msg = "your message";
        }
    }

    // Page Render event
    public function pageRender()
    {
        //Log("Page Render");
    }

    // Page Data Rendering event
    public function pageDataRendering(&$header)
    {
        // Example:
        //$header = "your header";
    }

    // Page Data Rendered event
    public function pageDataRendered(&$footer)
    {
        // Example:
        //$footer = "your footer";
    }

    // Page Breaking event
    public function pageBreaking(&$break, &$content)
    {
        // Example:
        //$break = false; // Skip page break, or
        //$content = "<div style=\"break-after:page;\"></div>"; // Modify page break content
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in $customError
        return true;
    }

    // ListOptions Load event
    public function listOptionsLoad()
    {
        // Example:
        //$opt = &$this->ListOptions->add("new");
        //$opt->Header = "xxx";
        //$opt->OnLeft = true; // Link on left
        //$opt->moveTo(0); // Move to first column
    }

    // ListOptions Rendering event
    public function listOptionsRendering()
    {
        //Container("DetailTableGrid")->DetailAdd = (...condition...); // Set to true or false conditionally
        //Container("DetailTableGrid")->DetailEdit = (...condition...); // Set to true or false conditionally
        //Container("DetailTableGrid")->DetailView = (...condition...); // Set to true or false conditionally
    }

    // ListOptions Rendered event
    public function listOptionsRendered()
    {
        // Example:
        //$this->ListOptions["new"]->Body = "xxx";
    }

    // Row Custom Action event
    public function rowCustomAction($action, $row)
    {
        // Return false to abort
        return true;
    }

    // Page Exporting event
    // $doc = export object
    public function pageExporting(&$doc)
    {
        //$doc->Text = "my header"; // Export header
        //return false; // Return false to skip default export and use Row_Export event
        return true; // Return true to use default export and skip Row_Export event
    }

    // Row Export event
    // $doc = export document object
    public function rowExport($doc, $rs)
    {
        //$doc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
    }

    // Page Exported event
    // $doc = export document object
    public function pageExported($doc)
    {
        //$doc->Text .= "my footer"; // Export footer
        //Log($doc->Text);
    }

    // Page Importing event
    public function pageImporting(&$builder, &$options)
    {
        //var_dump($options); // Show all options for importing
        //$builder = fn($workflow) => $workflow->addStep($myStep);
        //return false; // Return false to skip import
        return true;
    }

    // Row Import event
    public function rowImport(&$row, $cnt)
    {
        //Log($cnt); // Import record count
        //var_dump($row); // Import row
        //return false; // Return false to skip import
        return true;
    }

    // Page Imported event
    public function pageImported($obj, $results)
    {
        //var_dump($obj); // Workflow result object
        //var_dump($results); // Import results
    }
}
