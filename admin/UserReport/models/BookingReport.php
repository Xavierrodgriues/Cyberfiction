<?php

namespace PHPMaker2024\project3;

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
 * Table class for booking report
 */
class BookingReport extends DbTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $DbErrorMessage = "";
    public $UseSessionForListSql = true;

    // Column CSS classes
    public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
    public $RightColumnClass = "col-sm-10";
    public $OffsetColumnClass = "col-sm-10 offset-sm-2";
    public $TableLeftColumnClass = "w-col-2";

    // Ajax / Modal
    public $UseAjaxActions = false;
    public $ModalSearch = false;
    public $ModalView = false;
    public $ModalAdd = false;
    public $ModalEdit = false;
    public $ModalUpdate = false;
    public $InlineDelete = false;
    public $ModalGridAdd = false;
    public $ModalGridEdit = false;
    public $ModalMultiEdit = false;

    // Fields
    public $booking_id;
    public $check_in;
    public $check_out;
    public $arrival;
    public $datentime;
    public $rate_review;
    public $trans_resp_mesg;
    public $trans_status;
    public $trans_amt;
    public $sweet_dish_name;
    public $refund;
    public $booking_status;
    public $main_course_name;
    public $starter_name;
    public $order_id;
    public $name;
    public $area;
    public $price;
    public $quantity;
    public $removed;
    public $status;
    public $name1;
    public $_email;
    public $phonenum;
    public $is_verified;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $CurrentLanguage, $CurrentLocale;

        // Language object
        $Language = Container("app.language");
        $this->TableVar = "booking_report";
        $this->TableName = 'booking report';
        $this->TableType = "VIEW";
        $this->ImportUseTransaction = $this->supportsTransaction() && Config("IMPORT_USE_TRANSACTION");
        $this->UseTransaction = $this->supportsTransaction() && Config("USE_TRANSACTION");

        // Update Table
        $this->UpdateTable = "`booking report`";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)

        // PDF
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)

        // PhpSpreadsheet
        $this->ExportExcelPageOrientation = null; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = null; // Page size (PhpSpreadsheet only)

        // PHPWord
        $this->ExportWordPageOrientation = ""; // Page orientation (PHPWord only)
        $this->ExportWordPageSize = ""; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = false; // Allow detail add
        $this->DetailEdit = false; // Allow detail edit
        $this->DetailView = false; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UseAjaxActions = $this->UseAjaxActions || Config("USE_AJAX_ACTIONS");
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this);

        // booking_id
        $this->booking_id = new DbField(
            $this, // Table
            'x_booking_id', // Variable name
            'booking_id', // Name
            '`booking_id`', // Expression
            '`booking_id`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`booking_id`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->booking_id->InputTextType = "text";
        $this->booking_id->Raw = true;
        $this->booking_id->Nullable = false; // NOT NULL field
        $this->booking_id->Required = true; // Required field
        $this->booking_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->booking_id->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['booking_id'] = &$this->booking_id;

        // check_in
        $this->check_in = new DbField(
            $this, // Table
            'x_check_in', // Variable name
            'check_in', // Name
            '`check_in`', // Expression
            CastDateFieldForLike("`check_in`", 0, "DB"), // Basic search expression
            133, // Type
            10, // Size
            0, // Date/Time format
            false, // Is upload field
            '`check_in`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->check_in->InputTextType = "text";
        $this->check_in->Raw = true;
        $this->check_in->Nullable = false; // NOT NULL field
        $this->check_in->Required = true; // Required field
        $this->check_in->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->check_in->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['check_in'] = &$this->check_in;

        // check_out
        $this->check_out = new DbField(
            $this, // Table
            'x_check_out', // Variable name
            'check_out', // Name
            '`check_out`', // Expression
            CastDateFieldForLike("`check_out`", 0, "DB"), // Basic search expression
            133, // Type
            10, // Size
            0, // Date/Time format
            false, // Is upload field
            '`check_out`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->check_out->InputTextType = "text";
        $this->check_out->Raw = true;
        $this->check_out->Nullable = false; // NOT NULL field
        $this->check_out->Required = true; // Required field
        $this->check_out->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->check_out->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['check_out'] = &$this->check_out;

        // arrival
        $this->arrival = new DbField(
            $this, // Table
            'x_arrival', // Variable name
            'arrival', // Name
            '`arrival`', // Expression
            '`arrival`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`arrival`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->arrival->addMethod("getDefault", fn() => 0);
        $this->arrival->InputTextType = "text";
        $this->arrival->Raw = true;
        $this->arrival->Nullable = false; // NOT NULL field
        $this->arrival->Required = true; // Required field
        $this->arrival->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->arrival->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['arrival'] = &$this->arrival;

        // datentime
        $this->datentime = new DbField(
            $this, // Table
            'x_datentime', // Variable name
            'datentime', // Name
            '`datentime`', // Expression
            CastDateFieldForLike("`datentime`", 0, "DB"), // Basic search expression
            135, // Type
            19, // Size
            0, // Date/Time format
            false, // Is upload field
            '`datentime`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->datentime->InputTextType = "text";
        $this->datentime->Raw = true;
        $this->datentime->Nullable = false; // NOT NULL field
        $this->datentime->Required = true; // Required field
        $this->datentime->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->datentime->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['datentime'] = &$this->datentime;

        // rate_review
        $this->rate_review = new DbField(
            $this, // Table
            'x_rate_review', // Variable name
            'rate_review', // Name
            '`rate_review`', // Expression
            '`rate_review`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`rate_review`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->rate_review->InputTextType = "text";
        $this->rate_review->Raw = true;
        $this->rate_review->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->rate_review->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['rate_review'] = &$this->rate_review;

        // trans_resp_mesg
        $this->trans_resp_mesg = new DbField(
            $this, // Table
            'x_trans_resp_mesg', // Variable name
            'trans_resp_mesg', // Name
            '`trans_resp_mesg`', // Expression
            '`trans_resp_mesg`', // Basic search expression
            200, // Type
            100, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`trans_resp_mesg`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->trans_resp_mesg->InputTextType = "text";
        $this->trans_resp_mesg->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['trans_resp_mesg'] = &$this->trans_resp_mesg;

        // trans_status
        $this->trans_status = new DbField(
            $this, // Table
            'x_trans_status', // Variable name
            'trans_status', // Name
            '`trans_status`', // Expression
            '`trans_status`', // Basic search expression
            200, // Type
            100, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`trans_status`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->trans_status->addMethod("getDefault", fn() => "pending");
        $this->trans_status->InputTextType = "text";
        $this->trans_status->Nullable = false; // NOT NULL field
        $this->trans_status->Required = true; // Required field
        $this->trans_status->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['trans_status'] = &$this->trans_status;

        // trans_amt
        $this->trans_amt = new DbField(
            $this, // Table
            'x_trans_amt', // Variable name
            'trans_amt', // Name
            '`trans_amt`', // Expression
            '`trans_amt`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`trans_amt`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->trans_amt->InputTextType = "text";
        $this->trans_amt->Raw = true;
        $this->trans_amt->Nullable = false; // NOT NULL field
        $this->trans_amt->Required = true; // Required field
        $this->trans_amt->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->trans_amt->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['trans_amt'] = &$this->trans_amt;

        // sweet_dish_name
        $this->sweet_dish_name = new DbField(
            $this, // Table
            'x_sweet_dish_name', // Variable name
            'sweet_dish_name', // Name
            '`sweet_dish_name`', // Expression
            '`sweet_dish_name`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`sweet_dish_name`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->sweet_dish_name->addMethod("getDefault", fn() => "None");
        $this->sweet_dish_name->InputTextType = "text";
        $this->sweet_dish_name->Nullable = false; // NOT NULL field
        $this->sweet_dish_name->Required = true; // Required field
        $this->sweet_dish_name->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['sweet_dish_name'] = &$this->sweet_dish_name;

        // refund
        $this->refund = new DbField(
            $this, // Table
            'x_refund', // Variable name
            'refund', // Name
            '`refund`', // Expression
            '`refund`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`refund`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->refund->InputTextType = "text";
        $this->refund->Raw = true;
        $this->refund->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->refund->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['refund'] = &$this->refund;

        // booking_status
        $this->booking_status = new DbField(
            $this, // Table
            'x_booking_status', // Variable name
            'booking_status', // Name
            '`booking_status`', // Expression
            '`booking_status`', // Basic search expression
            200, // Type
            100, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`booking_status`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->booking_status->addMethod("getDefault", fn() => "pending");
        $this->booking_status->InputTextType = "text";
        $this->booking_status->Nullable = false; // NOT NULL field
        $this->booking_status->Required = true; // Required field
        $this->booking_status->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['booking_status'] = &$this->booking_status;

        // main_course_name
        $this->main_course_name = new DbField(
            $this, // Table
            'x_main_course_name', // Variable name
            'main_course_name', // Name
            '`main_course_name`', // Expression
            '`main_course_name`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`main_course_name`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->main_course_name->addMethod("getDefault", fn() => "None");
        $this->main_course_name->InputTextType = "text";
        $this->main_course_name->Nullable = false; // NOT NULL field
        $this->main_course_name->Required = true; // Required field
        $this->main_course_name->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['main_course_name'] = &$this->main_course_name;

        // starter_name
        $this->starter_name = new DbField(
            $this, // Table
            'x_starter_name', // Variable name
            'starter_name', // Name
            '`starter_name`', // Expression
            '`starter_name`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`starter_name`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->starter_name->addMethod("getDefault", fn() => "None");
        $this->starter_name->InputTextType = "text";
        $this->starter_name->Nullable = false; // NOT NULL field
        $this->starter_name->Required = true; // Required field
        $this->starter_name->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['starter_name'] = &$this->starter_name;

        // order_id
        $this->order_id = new DbField(
            $this, // Table
            'x_order_id', // Variable name
            'order_id', // Name
            '`order_id`', // Expression
            '`order_id`', // Basic search expression
            200, // Type
            150, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`order_id`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->order_id->InputTextType = "text";
        $this->order_id->Nullable = false; // NOT NULL field
        $this->order_id->Required = true; // Required field
        $this->order_id->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['order_id'] = &$this->order_id;

        // name
        $this->name = new DbField(
            $this, // Table
            'x_name', // Variable name
            'name', // Name
            '`name`', // Expression
            '`name`', // Basic search expression
            200, // Type
            150, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`name`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->name->InputTextType = "text";
        $this->name->Nullable = false; // NOT NULL field
        $this->name->Required = true; // Required field
        $this->name->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['name'] = &$this->name;

        // area
        $this->area = new DbField(
            $this, // Table
            'x_area', // Variable name
            'area', // Name
            '`area`', // Expression
            '`area`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`area`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->area->InputTextType = "text";
        $this->area->Raw = true;
        $this->area->Nullable = false; // NOT NULL field
        $this->area->Required = true; // Required field
        $this->area->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->area->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['area'] = &$this->area;

        // price
        $this->price = new DbField(
            $this, // Table
            'x_price', // Variable name
            'price', // Name
            '`price`', // Expression
            '`price`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`price`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->price->InputTextType = "text";
        $this->price->Raw = true;
        $this->price->Nullable = false; // NOT NULL field
        $this->price->Required = true; // Required field
        $this->price->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->price->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['price'] = &$this->price;

        // quantity
        $this->quantity = new DbField(
            $this, // Table
            'x_quantity', // Variable name
            'quantity', // Name
            '`quantity`', // Expression
            '`quantity`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`quantity`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->quantity->InputTextType = "text";
        $this->quantity->Raw = true;
        $this->quantity->Nullable = false; // NOT NULL field
        $this->quantity->Required = true; // Required field
        $this->quantity->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->quantity->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['quantity'] = &$this->quantity;

        // removed
        $this->removed = new DbField(
            $this, // Table
            'x_removed', // Variable name
            'removed', // Name
            '`removed`', // Expression
            '`removed`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`removed`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->removed->addMethod("getDefault", fn() => 0);
        $this->removed->InputTextType = "text";
        $this->removed->Raw = true;
        $this->removed->Nullable = false; // NOT NULL field
        $this->removed->Required = true; // Required field
        $this->removed->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->removed->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['removed'] = &$this->removed;

        // status
        $this->status = new DbField(
            $this, // Table
            'x_status', // Variable name
            'status', // Name
            '`status`', // Expression
            '`status`', // Basic search expression
            16, // Type
            4, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`status`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->status->addMethod("getDefault", fn() => 1);
        $this->status->InputTextType = "text";
        $this->status->Raw = true;
        $this->status->Nullable = false; // NOT NULL field
        $this->status->Required = true; // Required field
        $this->status->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->status->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['status'] = &$this->status;

        // name1
        $this->name1 = new DbField(
            $this, // Table
            'x_name1', // Variable name
            'name1', // Name
            '`name1`', // Expression
            '`name1`', // Basic search expression
            200, // Type
            100, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`name1`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->name1->InputTextType = "text";
        $this->name1->Nullable = false; // NOT NULL field
        $this->name1->Required = true; // Required field
        $this->name1->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['name1'] = &$this->name1;

        // email
        $this->_email = new DbField(
            $this, // Table
            'x__email', // Variable name
            'email', // Name
            '`email`', // Expression
            '`email`', // Basic search expression
            200, // Type
            150, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`email`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->_email->InputTextType = "text";
        $this->_email->Nullable = false; // NOT NULL field
        $this->_email->Required = true; // Required field
        $this->_email->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['email'] = &$this->_email;

        // phonenum
        $this->phonenum = new DbField(
            $this, // Table
            'x_phonenum', // Variable name
            'phonenum', // Name
            '`phonenum`', // Expression
            '`phonenum`', // Basic search expression
            200, // Type
            100, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`phonenum`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->phonenum->InputTextType = "text";
        $this->phonenum->Nullable = false; // NOT NULL field
        $this->phonenum->Required = true; // Required field
        $this->phonenum->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['phonenum'] = &$this->phonenum;

        // is_verified
        $this->is_verified = new DbField(
            $this, // Table
            'x_is_verified', // Variable name
            'is_verified', // Name
            '`is_verified`', // Expression
            '`is_verified`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`is_verified`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->is_verified->addMethod("getDefault", fn() => 0);
        $this->is_verified->InputTextType = "text";
        $this->is_verified->Raw = true;
        $this->is_verified->Nullable = false; // NOT NULL field
        $this->is_verified->Required = true; // Required field
        $this->is_verified->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->is_verified->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['is_verified'] = &$this->is_verified;

        // Add Doctrine Cache
        $this->Cache = new \Symfony\Component\Cache\Adapter\ArrayAdapter();
        $this->CacheProfile = new \Doctrine\DBAL\Cache\QueryCacheProfile(0, $this->TableVar);

        // Call Table Load event
        $this->tableLoad();
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
    public function setLeftColumnClass($class)
    {
        if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
            $this->LeftColumnClass = $class . " col-form-label ew-label";
            $this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
            $this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
            $this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
        }
    }

    // Single column sort
    public function updateSort(&$fld)
    {
        if ($this->CurrentOrder == $fld->Name) {
            $sortField = $fld->Expression;
            $lastSort = $fld->getSort();
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
        }
    }

    // Update field sort
    public function updateFieldSort()
    {
        $orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
        $flds = GetSortFields($orderBy);
        foreach ($this->Fields as $field) {
            $fldSort = "";
            foreach ($flds as $fld) {
                if ($fld[0] == $field->Expression || $fld[0] == $field->VirtualExpression) {
                    $fldSort = $fld[1];
                }
            }
            $field->setSort($fldSort);
        }
    }

    // Render X Axis for chart
    public function renderChartXAxis($chartVar, $chartRow)
    {
        return $chartRow;
    }

    // Get FROM clause
    public function getSqlFrom()
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`booking report`";
    }

    // Get FROM clause (for backward compatibility)
    public function sqlFrom()
    {
        return $this->getSqlFrom();
    }

    // Set FROM clause
    public function setSqlFrom($v)
    {
        $this->SqlFrom = $v;
    }

    // Get SELECT clause
    public function getSqlSelect() // Select
    {
        return $this->SqlSelect ?? $this->getQueryBuilder()->select($this->sqlSelectFields());
    }

    // Get list of fields
    private function sqlSelectFields()
    {
        $useFieldNames = false;
        $fieldNames = [];
        $platform = $this->getConnection()->getDatabasePlatform();
        foreach ($this->Fields as $field) {
            $expr = $field->Expression;
            $customExpr = $field->CustomDataType?->convertToPHPValueSQL($expr, $platform) ?? $expr;
            if ($customExpr != $expr) {
                $fieldNames[] = $customExpr . " AS " . QuotedName($field->Name, $this->Dbid);
                $useFieldNames = true;
            } else {
                $fieldNames[] = $expr;
            }
        }
        return $useFieldNames ? implode(", ", $fieldNames) : "*";
    }

    // Get SELECT clause (for backward compatibility)
    public function sqlSelect()
    {
        return $this->getSqlSelect();
    }

    // Set SELECT clause
    public function setSqlSelect($v)
    {
        $this->SqlSelect = $v;
    }

    // Get WHERE clause
    public function getSqlWhere()
    {
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
        $this->DefaultFilter = "";
        AddFilter($where, $this->DefaultFilter);
        return $where;
    }

    // Get WHERE clause (for backward compatibility)
    public function sqlWhere()
    {
        return $this->getSqlWhere();
    }

    // Set WHERE clause
    public function setSqlWhere($v)
    {
        $this->SqlWhere = $v;
    }

    // Get GROUP BY clause
    public function getSqlGroupBy()
    {
        return $this->SqlGroupBy != "" ? $this->SqlGroupBy : "";
    }

    // Get GROUP BY clause (for backward compatibility)
    public function sqlGroupBy()
    {
        return $this->getSqlGroupBy();
    }

    // set GROUP BY clause
    public function setSqlGroupBy($v)
    {
        $this->SqlGroupBy = $v;
    }

    // Get HAVING clause
    public function getSqlHaving() // Having
    {
        return ($this->SqlHaving != "") ? $this->SqlHaving : "";
    }

    // Get HAVING clause (for backward compatibility)
    public function sqlHaving()
    {
        return $this->getSqlHaving();
    }

    // Set HAVING clause
    public function setSqlHaving($v)
    {
        $this->SqlHaving = $v;
    }

    // Get ORDER BY clause
    public function getSqlOrderBy()
    {
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
    }

    // Get ORDER BY clause (for backward compatibility)
    public function sqlOrderBy()
    {
        return $this->getSqlOrderBy();
    }

    // set ORDER BY clause
    public function setSqlOrderBy($v)
    {
        $this->SqlOrderBy = $v;
    }

    // Apply User ID filters
    public function applyUserIDFilters($filter, $id = "")
    {
        return $filter;
    }

    // Check if User ID security allows view all
    public function userIDAllow($id = "")
    {
        $allow = $this->UserIDAllowSecurity;
        switch ($id) {
            case "add":
            case "copy":
            case "gridadd":
            case "register":
            case "addopt":
                return ($allow & Allow::ADD->value) == Allow::ADD->value;
            case "edit":
            case "gridedit":
            case "update":
            case "changepassword":
            case "resetpassword":
                return ($allow & Allow::EDIT->value) == Allow::EDIT->value;
            case "delete":
                return ($allow & Allow::DELETE->value) == Allow::DELETE->value;
            case "view":
                return ($allow & Allow::VIEW->value) == Allow::VIEW->value;
            case "search":
                return ($allow & Allow::SEARCH->value) == Allow::SEARCH->value;
            case "lookup":
                return ($allow & Allow::LOOKUP->value) == Allow::LOOKUP->value;
            default:
                return ($allow & Allow::LIST->value) == Allow::LIST->value;
        }
    }

    /**
     * Get record count
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder
     * @param mixed $c Connection
     * @return int
     */
    public function getRecordCount($sql, $c = null)
    {
        $cnt = -1;
        $sqlwrk = $sql instanceof QueryBuilder // Query builder
            ? (clone $sql)->resetQueryPart("orderBy")->getSQL()
            : $sql;
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            in_array($this->TableType, ["TABLE", "VIEW", "LINKTABLE"]) &&
            preg_match($pattern, $sqlwrk) &&
            !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sqlwrk) &&
            !preg_match('/^\s*SELECT\s+DISTINCT\s+/i', $sqlwrk) &&
            !preg_match('/\s+ORDER\s+BY\s+/i', $sqlwrk)
        ) {
            $sqlcnt = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sqlwrk);
        } else {
            $sqlcnt = "SELECT COUNT(*) FROM (" . $sqlwrk . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $cnt = $conn->fetchOne($sqlcnt);
        if ($cnt !== false) {
            return (int)$cnt;
        }
        // Unable to get count by SELECT COUNT(*), execute the SQL to get record count directly
        $result = $conn->executeQuery($sqlwrk);
        $cnt = $result->rowCount();
        if ($cnt == 0) { // Unable to get record count, count directly
            while ($result->fetch()) {
                $cnt++;
            }
        }
        return $cnt;
    }

    // Get SQL
    public function getSql($where, $orderBy = "")
    {
        return $this->getSqlAsQueryBuilder($where, $orderBy)->getSQL();
    }

    // Get QueryBuilder
    public function getSqlAsQueryBuilder($where, $orderBy = "")
    {
        return $this->buildSelectSql(
            $this->getSqlSelect(),
            $this->getSqlFrom(),
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $where,
            $orderBy
        );
    }

    // Table SQL
    public function getCurrentSql()
    {
        $filter = $this->CurrentFilter;
        $filter = $this->applyUserIDFilters($filter);
        $sort = $this->getSessionOrderBy();
        return $this->getSql($filter, $sort);
    }

    /**
     * Table SQL with List page filter
     *
     * @return QueryBuilder
     */
    public function getListSql()
    {
        $filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->getSqlSelect();
        $from = $this->getSqlFrom();
        $sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
        $this->Sort = $sort;
        return $this->buildSelectSql(
            $select,
            $from,
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $filter,
            $sort
        );
    }

    // Get ORDER BY clause
    public function getOrderBy()
    {
        $orderBy = $this->getSqlOrderBy();
        $sort = $this->getSessionOrderBy();
        if ($orderBy != "" && $sort != "") {
            $orderBy .= ", " . $sort;
        } elseif ($sort != "") {
            $orderBy = $sort;
        }
        return $orderBy;
    }

    // Get record count based on filter (for detail record count in master table pages)
    public function loadRecordCount($filter)
    {
        $origFilter = $this->CurrentFilter;
        $this->CurrentFilter = $filter;
        $this->recordsetSelecting($this->CurrentFilter);
        $isCustomView = $this->TableType == "CUSTOMVIEW";
        $select = $isCustomView ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $isCustomView ? $this->getSqlGroupBy() : "";
        $having = $isCustomView ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
        $cnt = $this->getRecordCount($sql);
        $this->CurrentFilter = $origFilter;
        return $cnt;
    }

    // Get record count (for current List page)
    public function listRecordCount()
    {
        $filter = $this->getSessionWhere();
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $isCustomView = $this->TableType == "CUSTOMVIEW";
        $select = $isCustomView ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $isCustomView ? $this->getSqlGroupBy() : "";
        $having = $isCustomView ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        $cnt = $this->getRecordCount($sql);
        return $cnt;
    }

    /**
     * INSERT statement
     *
     * @param mixed $rs
     * @return QueryBuilder
     */
    public function insertSql(&$rs)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->insert($this->UpdateTable);
        $platform = $this->getConnection()->getDatabasePlatform();
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom) {
                continue;
            }
            $field = $this->Fields[$name];
            $parm = $queryBuilder->createPositionalParameter($value, $field->getParameterType());
            $parm = $field->CustomDataType?->convertToDatabaseValueSQL($parm, $platform) ?? $parm; // Convert database SQL
            $queryBuilder->setValue($field->Expression, $parm);
        }
        return $queryBuilder;
    }

    // Insert
    public function insert(&$rs)
    {
        $conn = $this->getConnection();
        try {
            $queryBuilder = $this->insertSql($rs);
            $result = $queryBuilder->executeStatement();
            $this->DbErrorMessage = "";
        } catch (\Exception $e) {
            $result = false;
            $this->DbErrorMessage = $e->getMessage();
        }
        if ($result) {
        }
        return $result;
    }

    /**
     * UPDATE statement
     *
     * @param array $rs Data to be updated
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function updateSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->update($this->UpdateTable);
        $platform = $this->getConnection()->getDatabasePlatform();
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom || $this->Fields[$name]->IsAutoIncrement) {
                continue;
            }
            $field = $this->Fields[$name];
            $parm = $queryBuilder->createPositionalParameter($value, $field->getParameterType());
            $parm = $field->CustomDataType?->convertToDatabaseValueSQL($parm, $platform) ?? $parm; // Convert database SQL
            $queryBuilder->set($field->Expression, $parm);
        }
        $filter = $curfilter ? $this->CurrentFilter : "";
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        AddFilter($filter, $where);
        if ($filter != "") {
            $queryBuilder->where($filter);
        }
        return $queryBuilder;
    }

    // Update
    public function update(&$rs, $where = "", $rsold = null, $curfilter = true)
    {
        // If no field is updated, execute may return 0. Treat as success
        try {
            $success = $this->updateSql($rs, $where, $curfilter)->executeStatement();
            $success = $success > 0 ? $success : true;
            $this->DbErrorMessage = "";
        } catch (\Exception $e) {
            $success = false;
            $this->DbErrorMessage = $e->getMessage();
        }
        return $success;
    }

    /**
     * DELETE statement
     *
     * @param array $rs Key values
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function deleteSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($this->UpdateTable);
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        if ($rs) {
        }
        $filter = $curfilter ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;
        if ($success) {
            try {
                $success = $this->deleteSql($rs, $where, $curfilter)->executeStatement();
                $this->DbErrorMessage = "";
            } catch (\Exception $e) {
                $success = false;
                $this->DbErrorMessage = $e->getMessage();
            }
        }
        return $success;
    }

    // Load DbValue from result set or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->booking_id->DbValue = $row['booking_id'];
        $this->check_in->DbValue = $row['check_in'];
        $this->check_out->DbValue = $row['check_out'];
        $this->arrival->DbValue = $row['arrival'];
        $this->datentime->DbValue = $row['datentime'];
        $this->rate_review->DbValue = $row['rate_review'];
        $this->trans_resp_mesg->DbValue = $row['trans_resp_mesg'];
        $this->trans_status->DbValue = $row['trans_status'];
        $this->trans_amt->DbValue = $row['trans_amt'];
        $this->sweet_dish_name->DbValue = $row['sweet_dish_name'];
        $this->refund->DbValue = $row['refund'];
        $this->booking_status->DbValue = $row['booking_status'];
        $this->main_course_name->DbValue = $row['main_course_name'];
        $this->starter_name->DbValue = $row['starter_name'];
        $this->order_id->DbValue = $row['order_id'];
        $this->name->DbValue = $row['name'];
        $this->area->DbValue = $row['area'];
        $this->price->DbValue = $row['price'];
        $this->quantity->DbValue = $row['quantity'];
        $this->removed->DbValue = $row['removed'];
        $this->status->DbValue = $row['status'];
        $this->name1->DbValue = $row['name1'];
        $this->_email->DbValue = $row['email'];
        $this->phonenum->DbValue = $row['phonenum'];
        $this->is_verified->DbValue = $row['is_verified'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "";
    }

    // Get Key
    public function getKey($current = false, $keySeparator = null)
    {
        $keys = [];
        $keySeparator ??= Config("COMPOSITE_KEY_SEPARATOR");
        return implode($keySeparator, $keys);
    }

    // Set Key
    public function setKey($key, $current = false, $keySeparator = null)
    {
        $keySeparator ??= Config("COMPOSITE_KEY_SEPARATOR");
        $this->OldKey = strval($key);
        $keys = explode($keySeparator, $this->OldKey);
        if (count($keys) == 0) {
        }
    }

    // Get record filter
    public function getRecordFilter($row = null, $current = false)
    {
        $keyFilter = $this->sqlKeyFilter();
        return $keyFilter;
    }

    // Return page URL
    public function getReturnUrl()
    {
        $referUrl = ReferUrl();
        $referPageName = ReferPageName();
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if ($referUrl != "" && $referPageName != CurrentPageName() && $referPageName != "login") { // Referer not same page or login page
            $_SESSION[$name] = $referUrl; // Save to Session
        }
        return $_SESSION[$name] ?? GetUrl("BookingReportList");
    }

    // Set return page URL
    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        return match ($pageName) {
            "BookingReportView" => $Language->phrase("View"),
            "BookingReportEdit" => $Language->phrase("Edit"),
            "BookingReportAdd" => $Language->phrase("Add"),
            default => ""
        };
    }

    // Default route URL
    public function getDefaultRouteUrl()
    {
        return "BookingReportList";
    }

    // API page name
    public function getApiPageName($action)
    {
        return match (strtolower($action)) {
            Config("API_VIEW_ACTION") => "BookingReportView",
            Config("API_ADD_ACTION") => "BookingReportAdd",
            Config("API_EDIT_ACTION") => "BookingReportEdit",
            Config("API_DELETE_ACTION") => "BookingReportDelete",
            Config("API_LIST_ACTION") => "BookingReportList",
            default => ""
        };
    }

    // Current URL
    public function getCurrentUrl($parm = "")
    {
        $url = CurrentPageUrl(false);
        if ($parm != "") {
            $url = $this->keyUrl($url, $parm);
        } else {
            $url = $this->keyUrl($url, Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // List URL
    public function getListUrl()
    {
        return "BookingReportList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("BookingReportView", $parm);
        } else {
            $url = $this->keyUrl("BookingReportView", Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "BookingReportAdd?" . $parm;
        } else {
            $url = "BookingReportAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("BookingReportEdit", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl("BookingReportList", "action=edit");
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("BookingReportAdd", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl("BookingReportList", "action=copy");
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl($parm = "")
    {
        if ($this->UseAjaxActions && ConvertToBool(Param("infinitescroll")) && CurrentPageID() == "list") {
            return $this->keyUrl(GetApiUrl(Config("API_DELETE_ACTION") . "/" . $this->TableVar));
        } else {
            return $this->keyUrl("BookingReportDelete", $parm);
        }
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderFieldHeader($fld)
    {
        global $Security, $Language;
        $sortUrl = "";
        $attrs = "";
        if ($this->PageID != "grid" && $fld->Sortable) {
            $sortUrl = $this->sortUrl($fld);
            $attrs = ' role="button" data-ew-action="sort" data-ajax="' . ($this->UseAjaxActions ? "true" : "false") . '" data-sort-url="' . $sortUrl . '" data-sort-type="1"';
            if ($this->ContextClass) { // Add context
                $attrs .= ' data-context="' . HtmlEncode($this->ContextClass) . '"';
            }
        }
        $html = '<div class="ew-table-header-caption"' . $attrs . '>' . $fld->caption() . '</div>';
        if ($sortUrl) {
            $html .= '<div class="ew-table-header-sort">' . $fld->getSortIcon() . '</div>';
        }
        if ($this->PageID != "grid" && !$this->isExport() && $fld->UseFilter) {
            $html .= '<div class="ew-filter-dropdown-btn" data-ew-action="filter" data-table="' . $fld->TableVar . '" data-field="' . $fld->FieldVar .
                '"><div class="ew-table-header-filter" role="button" aria-haspopup="true">' . $Language->phrase("Filter") .
                (is_array($fld->EditValue) ? str_replace("%c", count($fld->EditValue), $Language->phrase("FilterCount")) : '') .
                '</div></div>';
        }
        $html = '<div class="ew-table-header-btn">' . $html . '</div>';
        if ($this->UseCustomTemplate) {
            $scriptId = str_replace("{id}", $fld->TableVar . "_" . $fld->Param, "tpc_{id}");
            $html = '<template id="' . $scriptId . '">' . $html . '</template>';
        }
        return $html;
    }

    // Sort URL
    public function sortUrl($fld)
    {
        global $DashboardReport;
        if (
            $this->CurrentAction || $this->isExport() ||
            in_array($fld->Type, [128, 204, 205])
        ) { // Unsortable data type
                return "";
        } elseif ($fld->Sortable) {
            $urlParm = "order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort();
            if ($DashboardReport) {
                $urlParm .= "&amp;" . Config("PAGE_DASHBOARD") . "=" . $DashboardReport;
            }
            return $this->addMasterUrl($this->CurrentPageName . "?" . $urlParm);
        } else {
            return "";
        }
    }

    // Get record keys from Post/Get/Session
    public function getRecordKeys()
    {
        $arKeys = [];
        $arKey = [];
        if (Param("key_m") !== null) {
            $arKeys = Param("key_m");
            $cnt = count($arKeys);
        } else {
            $isApi = IsApi();
            $keyValues = $isApi
                ? (Route(0) == "export"
                    ? array_map(fn ($i) => Route($i + 3), range(0, -1))  // Export API
                    : array_map(fn ($i) => Route($i + 2), range(0, -1))) // Other API
                : []; // Non-API
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                $ar[] = $key;
            }
        }
        return $ar;
    }

    // Get filter from records
    public function getFilterFromRecords($rows)
    {
        $keyFilter = "";
        foreach ($rows as $row) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            $keyFilter .= "(" . $this->getRecordFilter($row) . ")";
        }
        return $keyFilter;
    }

    // Get filter from record keys
    public function getFilterFromRecordKeys($setCurrent = true)
    {
        $arKeys = $this->getRecordKeys();
        $keyFilter = "";
        foreach ($arKeys as $key) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            $keyFilter .= "(" . $this->getRecordFilter() . ")";
        }
        return $keyFilter;
    }

    // Load result set based on filter/sort
    public function loadRs($filter, $sort = "")
    {
        $sql = $this->getSql($filter, $sort); // Set up filter (WHERE Clause) / sort (ORDER BY Clause)
        $conn = $this->getConnection();
        return $conn->executeQuery($sql);
    }

    // Load row values from record
    public function loadListRowValues(&$rs)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            return;
        }
        $this->booking_id->setDbValue($row['booking_id']);
        $this->check_in->setDbValue($row['check_in']);
        $this->check_out->setDbValue($row['check_out']);
        $this->arrival->setDbValue($row['arrival']);
        $this->datentime->setDbValue($row['datentime']);
        $this->rate_review->setDbValue($row['rate_review']);
        $this->trans_resp_mesg->setDbValue($row['trans_resp_mesg']);
        $this->trans_status->setDbValue($row['trans_status']);
        $this->trans_amt->setDbValue($row['trans_amt']);
        $this->sweet_dish_name->setDbValue($row['sweet_dish_name']);
        $this->refund->setDbValue($row['refund']);
        $this->booking_status->setDbValue($row['booking_status']);
        $this->main_course_name->setDbValue($row['main_course_name']);
        $this->starter_name->setDbValue($row['starter_name']);
        $this->order_id->setDbValue($row['order_id']);
        $this->name->setDbValue($row['name']);
        $this->area->setDbValue($row['area']);
        $this->price->setDbValue($row['price']);
        $this->quantity->setDbValue($row['quantity']);
        $this->removed->setDbValue($row['removed']);
        $this->status->setDbValue($row['status']);
        $this->name1->setDbValue($row['name1']);
        $this->_email->setDbValue($row['email']);
        $this->phonenum->setDbValue($row['phonenum']);
        $this->is_verified->setDbValue($row['is_verified']);
    }

    // Render list content
    public function renderListContent($filter)
    {
        global $Response;
        $listPage = "BookingReportList";
        $listClass = PROJECT_NAMESPACE . $listPage;
        $page = new $listClass();
        $page->loadRecordsetFromFilter($filter);
        $view = Container("app.view");
        $template = $listPage . ".php"; // View
        $GLOBALS["Title"] ??= $page->Title; // Title
        try {
            $Response = $view->render($Response, $template, $GLOBALS);
        } finally {
            $page->terminate(); // Terminate page and clean up
        }
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // booking_id

        // check_in

        // check_out

        // arrival

        // datentime

        // rate_review

        // trans_resp_mesg

        // trans_status

        // trans_amt

        // sweet_dish_name

        // refund

        // booking_status

        // main_course_name

        // starter_name

        // order_id

        // name

        // area

        // price

        // quantity

        // removed

        // status

        // name1

        // email

        // phonenum

        // is_verified

        // booking_id
        $this->booking_id->ViewValue = $this->booking_id->CurrentValue;
        $this->booking_id->ViewValue = FormatNumber($this->booking_id->ViewValue, $this->booking_id->formatPattern());

        // check_in
        $this->check_in->ViewValue = $this->check_in->CurrentValue;
        $this->check_in->ViewValue = FormatDateTime($this->check_in->ViewValue, $this->check_in->formatPattern());

        // check_out
        $this->check_out->ViewValue = $this->check_out->CurrentValue;
        $this->check_out->ViewValue = FormatDateTime($this->check_out->ViewValue, $this->check_out->formatPattern());

        // arrival
        $this->arrival->ViewValue = $this->arrival->CurrentValue;
        $this->arrival->ViewValue = FormatNumber($this->arrival->ViewValue, $this->arrival->formatPattern());

        // datentime
        $this->datentime->ViewValue = $this->datentime->CurrentValue;
        $this->datentime->ViewValue = FormatDateTime($this->datentime->ViewValue, $this->datentime->formatPattern());

        // rate_review
        $this->rate_review->ViewValue = $this->rate_review->CurrentValue;
        $this->rate_review->ViewValue = FormatNumber($this->rate_review->ViewValue, $this->rate_review->formatPattern());

        // trans_resp_mesg
        $this->trans_resp_mesg->ViewValue = $this->trans_resp_mesg->CurrentValue;

        // trans_status
        $this->trans_status->ViewValue = $this->trans_status->CurrentValue;

        // trans_amt
        $this->trans_amt->ViewValue = $this->trans_amt->CurrentValue;
        $this->trans_amt->ViewValue = FormatNumber($this->trans_amt->ViewValue, $this->trans_amt->formatPattern());

        // sweet_dish_name
        $this->sweet_dish_name->ViewValue = $this->sweet_dish_name->CurrentValue;

        // refund
        $this->refund->ViewValue = $this->refund->CurrentValue;
        $this->refund->ViewValue = FormatNumber($this->refund->ViewValue, $this->refund->formatPattern());

        // booking_status
        $this->booking_status->ViewValue = $this->booking_status->CurrentValue;

        // main_course_name
        $this->main_course_name->ViewValue = $this->main_course_name->CurrentValue;

        // starter_name
        $this->starter_name->ViewValue = $this->starter_name->CurrentValue;

        // order_id
        $this->order_id->ViewValue = $this->order_id->CurrentValue;

        // name
        $this->name->ViewValue = $this->name->CurrentValue;

        // area
        $this->area->ViewValue = $this->area->CurrentValue;
        $this->area->ViewValue = FormatNumber($this->area->ViewValue, $this->area->formatPattern());

        // price
        $this->price->ViewValue = $this->price->CurrentValue;
        $this->price->ViewValue = FormatNumber($this->price->ViewValue, $this->price->formatPattern());

        // quantity
        $this->quantity->ViewValue = $this->quantity->CurrentValue;
        $this->quantity->ViewValue = FormatNumber($this->quantity->ViewValue, $this->quantity->formatPattern());

        // removed
        $this->removed->ViewValue = $this->removed->CurrentValue;
        $this->removed->ViewValue = FormatNumber($this->removed->ViewValue, $this->removed->formatPattern());

        // status
        $this->status->ViewValue = $this->status->CurrentValue;
        $this->status->ViewValue = FormatNumber($this->status->ViewValue, $this->status->formatPattern());

        // name1
        $this->name1->ViewValue = $this->name1->CurrentValue;

        // email
        $this->_email->ViewValue = $this->_email->CurrentValue;

        // phonenum
        $this->phonenum->ViewValue = $this->phonenum->CurrentValue;

        // is_verified
        $this->is_verified->ViewValue = $this->is_verified->CurrentValue;
        $this->is_verified->ViewValue = FormatNumber($this->is_verified->ViewValue, $this->is_verified->formatPattern());

        // booking_id
        $this->booking_id->HrefValue = "";
        $this->booking_id->TooltipValue = "";

        // check_in
        $this->check_in->HrefValue = "";
        $this->check_in->TooltipValue = "";

        // check_out
        $this->check_out->HrefValue = "";
        $this->check_out->TooltipValue = "";

        // arrival
        $this->arrival->HrefValue = "";
        $this->arrival->TooltipValue = "";

        // datentime
        $this->datentime->HrefValue = "";
        $this->datentime->TooltipValue = "";

        // rate_review
        $this->rate_review->HrefValue = "";
        $this->rate_review->TooltipValue = "";

        // trans_resp_mesg
        $this->trans_resp_mesg->HrefValue = "";
        $this->trans_resp_mesg->TooltipValue = "";

        // trans_status
        $this->trans_status->HrefValue = "";
        $this->trans_status->TooltipValue = "";

        // trans_amt
        $this->trans_amt->HrefValue = "";
        $this->trans_amt->TooltipValue = "";

        // sweet_dish_name
        $this->sweet_dish_name->HrefValue = "";
        $this->sweet_dish_name->TooltipValue = "";

        // refund
        $this->refund->HrefValue = "";
        $this->refund->TooltipValue = "";

        // booking_status
        $this->booking_status->HrefValue = "";
        $this->booking_status->TooltipValue = "";

        // main_course_name
        $this->main_course_name->HrefValue = "";
        $this->main_course_name->TooltipValue = "";

        // starter_name
        $this->starter_name->HrefValue = "";
        $this->starter_name->TooltipValue = "";

        // order_id
        $this->order_id->HrefValue = "";
        $this->order_id->TooltipValue = "";

        // name
        $this->name->HrefValue = "";
        $this->name->TooltipValue = "";

        // area
        $this->area->HrefValue = "";
        $this->area->TooltipValue = "";

        // price
        $this->price->HrefValue = "";
        $this->price->TooltipValue = "";

        // quantity
        $this->quantity->HrefValue = "";
        $this->quantity->TooltipValue = "";

        // removed
        $this->removed->HrefValue = "";
        $this->removed->TooltipValue = "";

        // status
        $this->status->HrefValue = "";
        $this->status->TooltipValue = "";

        // name1
        $this->name1->HrefValue = "";
        $this->name1->TooltipValue = "";

        // email
        $this->_email->HrefValue = "";
        $this->_email->TooltipValue = "";

        // phonenum
        $this->phonenum->HrefValue = "";
        $this->phonenum->TooltipValue = "";

        // is_verified
        $this->is_verified->HrefValue = "";
        $this->is_verified->TooltipValue = "";

        // Call Row Rendered event
        $this->rowRendered();

        // Save data for Custom Template
        $this->Rows[] = $this->customTemplateFieldValues();
    }

    // Render edit row values
    public function renderEditRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // booking_id
        $this->booking_id->setupEditAttributes();
        $this->booking_id->EditValue = $this->booking_id->CurrentValue;
        $this->booking_id->PlaceHolder = RemoveHtml($this->booking_id->caption());
        if (strval($this->booking_id->EditValue) != "" && is_numeric($this->booking_id->EditValue)) {
            $this->booking_id->EditValue = FormatNumber($this->booking_id->EditValue, null);
        }

        // check_in
        $this->check_in->setupEditAttributes();
        $this->check_in->EditValue = FormatDateTime($this->check_in->CurrentValue, $this->check_in->formatPattern());
        $this->check_in->PlaceHolder = RemoveHtml($this->check_in->caption());

        // check_out
        $this->check_out->setupEditAttributes();
        $this->check_out->EditValue = FormatDateTime($this->check_out->CurrentValue, $this->check_out->formatPattern());
        $this->check_out->PlaceHolder = RemoveHtml($this->check_out->caption());

        // arrival
        $this->arrival->setupEditAttributes();
        $this->arrival->EditValue = $this->arrival->CurrentValue;
        $this->arrival->PlaceHolder = RemoveHtml($this->arrival->caption());
        if (strval($this->arrival->EditValue) != "" && is_numeric($this->arrival->EditValue)) {
            $this->arrival->EditValue = FormatNumber($this->arrival->EditValue, null);
        }

        // datentime
        $this->datentime->setupEditAttributes();
        $this->datentime->EditValue = FormatDateTime($this->datentime->CurrentValue, $this->datentime->formatPattern());
        $this->datentime->PlaceHolder = RemoveHtml($this->datentime->caption());

        // rate_review
        $this->rate_review->setupEditAttributes();
        $this->rate_review->EditValue = $this->rate_review->CurrentValue;
        $this->rate_review->PlaceHolder = RemoveHtml($this->rate_review->caption());
        if (strval($this->rate_review->EditValue) != "" && is_numeric($this->rate_review->EditValue)) {
            $this->rate_review->EditValue = FormatNumber($this->rate_review->EditValue, null);
        }

        // trans_resp_mesg
        $this->trans_resp_mesg->setupEditAttributes();
        if (!$this->trans_resp_mesg->Raw) {
            $this->trans_resp_mesg->CurrentValue = HtmlDecode($this->trans_resp_mesg->CurrentValue);
        }
        $this->trans_resp_mesg->EditValue = $this->trans_resp_mesg->CurrentValue;
        $this->trans_resp_mesg->PlaceHolder = RemoveHtml($this->trans_resp_mesg->caption());

        // trans_status
        $this->trans_status->setupEditAttributes();
        if (!$this->trans_status->Raw) {
            $this->trans_status->CurrentValue = HtmlDecode($this->trans_status->CurrentValue);
        }
        $this->trans_status->EditValue = $this->trans_status->CurrentValue;
        $this->trans_status->PlaceHolder = RemoveHtml($this->trans_status->caption());

        // trans_amt
        $this->trans_amt->setupEditAttributes();
        $this->trans_amt->EditValue = $this->trans_amt->CurrentValue;
        $this->trans_amt->PlaceHolder = RemoveHtml($this->trans_amt->caption());
        if (strval($this->trans_amt->EditValue) != "" && is_numeric($this->trans_amt->EditValue)) {
            $this->trans_amt->EditValue = FormatNumber($this->trans_amt->EditValue, null);
        }

        // sweet_dish_name
        $this->sweet_dish_name->setupEditAttributes();
        if (!$this->sweet_dish_name->Raw) {
            $this->sweet_dish_name->CurrentValue = HtmlDecode($this->sweet_dish_name->CurrentValue);
        }
        $this->sweet_dish_name->EditValue = $this->sweet_dish_name->CurrentValue;
        $this->sweet_dish_name->PlaceHolder = RemoveHtml($this->sweet_dish_name->caption());

        // refund
        $this->refund->setupEditAttributes();
        $this->refund->EditValue = $this->refund->CurrentValue;
        $this->refund->PlaceHolder = RemoveHtml($this->refund->caption());
        if (strval($this->refund->EditValue) != "" && is_numeric($this->refund->EditValue)) {
            $this->refund->EditValue = FormatNumber($this->refund->EditValue, null);
        }

        // booking_status
        $this->booking_status->setupEditAttributes();
        if (!$this->booking_status->Raw) {
            $this->booking_status->CurrentValue = HtmlDecode($this->booking_status->CurrentValue);
        }
        $this->booking_status->EditValue = $this->booking_status->CurrentValue;
        $this->booking_status->PlaceHolder = RemoveHtml($this->booking_status->caption());

        // main_course_name
        $this->main_course_name->setupEditAttributes();
        if (!$this->main_course_name->Raw) {
            $this->main_course_name->CurrentValue = HtmlDecode($this->main_course_name->CurrentValue);
        }
        $this->main_course_name->EditValue = $this->main_course_name->CurrentValue;
        $this->main_course_name->PlaceHolder = RemoveHtml($this->main_course_name->caption());

        // starter_name
        $this->starter_name->setupEditAttributes();
        if (!$this->starter_name->Raw) {
            $this->starter_name->CurrentValue = HtmlDecode($this->starter_name->CurrentValue);
        }
        $this->starter_name->EditValue = $this->starter_name->CurrentValue;
        $this->starter_name->PlaceHolder = RemoveHtml($this->starter_name->caption());

        // order_id
        $this->order_id->setupEditAttributes();
        if (!$this->order_id->Raw) {
            $this->order_id->CurrentValue = HtmlDecode($this->order_id->CurrentValue);
        }
        $this->order_id->EditValue = $this->order_id->CurrentValue;
        $this->order_id->PlaceHolder = RemoveHtml($this->order_id->caption());

        // name
        $this->name->setupEditAttributes();
        if (!$this->name->Raw) {
            $this->name->CurrentValue = HtmlDecode($this->name->CurrentValue);
        }
        $this->name->EditValue = $this->name->CurrentValue;
        $this->name->PlaceHolder = RemoveHtml($this->name->caption());

        // area
        $this->area->setupEditAttributes();
        $this->area->EditValue = $this->area->CurrentValue;
        $this->area->PlaceHolder = RemoveHtml($this->area->caption());
        if (strval($this->area->EditValue) != "" && is_numeric($this->area->EditValue)) {
            $this->area->EditValue = FormatNumber($this->area->EditValue, null);
        }

        // price
        $this->price->setupEditAttributes();
        $this->price->EditValue = $this->price->CurrentValue;
        $this->price->PlaceHolder = RemoveHtml($this->price->caption());
        if (strval($this->price->EditValue) != "" && is_numeric($this->price->EditValue)) {
            $this->price->EditValue = FormatNumber($this->price->EditValue, null);
        }

        // quantity
        $this->quantity->setupEditAttributes();
        $this->quantity->EditValue = $this->quantity->CurrentValue;
        $this->quantity->PlaceHolder = RemoveHtml($this->quantity->caption());
        if (strval($this->quantity->EditValue) != "" && is_numeric($this->quantity->EditValue)) {
            $this->quantity->EditValue = FormatNumber($this->quantity->EditValue, null);
        }

        // removed
        $this->removed->setupEditAttributes();
        $this->removed->EditValue = $this->removed->CurrentValue;
        $this->removed->PlaceHolder = RemoveHtml($this->removed->caption());
        if (strval($this->removed->EditValue) != "" && is_numeric($this->removed->EditValue)) {
            $this->removed->EditValue = FormatNumber($this->removed->EditValue, null);
        }

        // status
        $this->status->setupEditAttributes();
        $this->status->EditValue = $this->status->CurrentValue;
        $this->status->PlaceHolder = RemoveHtml($this->status->caption());
        if (strval($this->status->EditValue) != "" && is_numeric($this->status->EditValue)) {
            $this->status->EditValue = FormatNumber($this->status->EditValue, null);
        }

        // name1
        $this->name1->setupEditAttributes();
        if (!$this->name1->Raw) {
            $this->name1->CurrentValue = HtmlDecode($this->name1->CurrentValue);
        }
        $this->name1->EditValue = $this->name1->CurrentValue;
        $this->name1->PlaceHolder = RemoveHtml($this->name1->caption());

        // email
        $this->_email->setupEditAttributes();
        if (!$this->_email->Raw) {
            $this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
        }
        $this->_email->EditValue = $this->_email->CurrentValue;
        $this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

        // phonenum
        $this->phonenum->setupEditAttributes();
        if (!$this->phonenum->Raw) {
            $this->phonenum->CurrentValue = HtmlDecode($this->phonenum->CurrentValue);
        }
        $this->phonenum->EditValue = $this->phonenum->CurrentValue;
        $this->phonenum->PlaceHolder = RemoveHtml($this->phonenum->caption());

        // is_verified
        $this->is_verified->setupEditAttributes();
        $this->is_verified->EditValue = $this->is_verified->CurrentValue;
        $this->is_verified->PlaceHolder = RemoveHtml($this->is_verified->caption());
        if (strval($this->is_verified->EditValue) != "" && is_numeric($this->is_verified->EditValue)) {
            $this->is_verified->EditValue = FormatNumber($this->is_verified->EditValue, null);
        }

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
        // Call Row Rendered event
        $this->rowRendered();
    }

    // Export data in HTML/CSV/Word/Excel/Email/PDF format
    public function exportDocument($doc, $result, $startRec = 1, $stopRec = 1, $exportPageType = "")
    {
        if (!$result || !$doc) {
            return;
        }
        if (!$doc->ExportCustom) {
            // Write header
            $doc->exportTableHeader();
            if ($doc->Horizontal) { // Horizontal format, write header
                $doc->beginExportRow();
                if ($exportPageType == "view") {
                    $doc->exportCaption($this->booking_id);
                    $doc->exportCaption($this->check_in);
                    $doc->exportCaption($this->check_out);
                    $doc->exportCaption($this->arrival);
                    $doc->exportCaption($this->datentime);
                    $doc->exportCaption($this->rate_review);
                    $doc->exportCaption($this->trans_resp_mesg);
                    $doc->exportCaption($this->trans_status);
                    $doc->exportCaption($this->trans_amt);
                    $doc->exportCaption($this->sweet_dish_name);
                    $doc->exportCaption($this->refund);
                    $doc->exportCaption($this->booking_status);
                    $doc->exportCaption($this->main_course_name);
                    $doc->exportCaption($this->starter_name);
                    $doc->exportCaption($this->order_id);
                    $doc->exportCaption($this->name);
                    $doc->exportCaption($this->area);
                    $doc->exportCaption($this->price);
                    $doc->exportCaption($this->quantity);
                    $doc->exportCaption($this->removed);
                    $doc->exportCaption($this->status);
                    $doc->exportCaption($this->name1);
                    $doc->exportCaption($this->_email);
                    $doc->exportCaption($this->phonenum);
                    $doc->exportCaption($this->is_verified);
                } else {
                    $doc->exportCaption($this->booking_id);
                    $doc->exportCaption($this->check_in);
                    $doc->exportCaption($this->check_out);
                    $doc->exportCaption($this->arrival);
                    $doc->exportCaption($this->datentime);
                    $doc->exportCaption($this->rate_review);
                    $doc->exportCaption($this->trans_resp_mesg);
                    $doc->exportCaption($this->trans_status);
                    $doc->exportCaption($this->trans_amt);
                    $doc->exportCaption($this->sweet_dish_name);
                    $doc->exportCaption($this->refund);
                    $doc->exportCaption($this->booking_status);
                    $doc->exportCaption($this->main_course_name);
                    $doc->exportCaption($this->starter_name);
                    $doc->exportCaption($this->order_id);
                    $doc->exportCaption($this->name);
                    $doc->exportCaption($this->area);
                    $doc->exportCaption($this->price);
                    $doc->exportCaption($this->quantity);
                    $doc->exportCaption($this->removed);
                    $doc->exportCaption($this->status);
                    $doc->exportCaption($this->name1);
                    $doc->exportCaption($this->_email);
                    $doc->exportCaption($this->phonenum);
                    $doc->exportCaption($this->is_verified);
                }
                $doc->endExportRow();
            }
        }
        $recCnt = $startRec - 1;
        $stopRec = $stopRec > 0 ? $stopRec : PHP_INT_MAX;
        while (($row = $result->fetch()) && $recCnt < $stopRec) {
            $recCnt++;
            if ($recCnt >= $startRec) {
                $rowCnt = $recCnt - $startRec + 1;

                // Page break
                if ($this->ExportPageBreakCount > 0) {
                    if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0) {
                        $doc->exportPageBreak();
                    }
                }
                $this->loadListRowValues($row);

                // Render row
                $this->RowType = RowType::VIEW; // Render view
                $this->resetAttributes();
                $this->renderListRow();
                if (!$doc->ExportCustom) {
                    $doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
                    if ($exportPageType == "view") {
                        $doc->exportField($this->booking_id);
                        $doc->exportField($this->check_in);
                        $doc->exportField($this->check_out);
                        $doc->exportField($this->arrival);
                        $doc->exportField($this->datentime);
                        $doc->exportField($this->rate_review);
                        $doc->exportField($this->trans_resp_mesg);
                        $doc->exportField($this->trans_status);
                        $doc->exportField($this->trans_amt);
                        $doc->exportField($this->sweet_dish_name);
                        $doc->exportField($this->refund);
                        $doc->exportField($this->booking_status);
                        $doc->exportField($this->main_course_name);
                        $doc->exportField($this->starter_name);
                        $doc->exportField($this->order_id);
                        $doc->exportField($this->name);
                        $doc->exportField($this->area);
                        $doc->exportField($this->price);
                        $doc->exportField($this->quantity);
                        $doc->exportField($this->removed);
                        $doc->exportField($this->status);
                        $doc->exportField($this->name1);
                        $doc->exportField($this->_email);
                        $doc->exportField($this->phonenum);
                        $doc->exportField($this->is_verified);
                    } else {
                        $doc->exportField($this->booking_id);
                        $doc->exportField($this->check_in);
                        $doc->exportField($this->check_out);
                        $doc->exportField($this->arrival);
                        $doc->exportField($this->datentime);
                        $doc->exportField($this->rate_review);
                        $doc->exportField($this->trans_resp_mesg);
                        $doc->exportField($this->trans_status);
                        $doc->exportField($this->trans_amt);
                        $doc->exportField($this->sweet_dish_name);
                        $doc->exportField($this->refund);
                        $doc->exportField($this->booking_status);
                        $doc->exportField($this->main_course_name);
                        $doc->exportField($this->starter_name);
                        $doc->exportField($this->order_id);
                        $doc->exportField($this->name);
                        $doc->exportField($this->area);
                        $doc->exportField($this->price);
                        $doc->exportField($this->quantity);
                        $doc->exportField($this->removed);
                        $doc->exportField($this->status);
                        $doc->exportField($this->name1);
                        $doc->exportField($this->_email);
                        $doc->exportField($this->phonenum);
                        $doc->exportField($this->is_verified);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->rowExport($doc, $row);
            }
        }
        if (!$doc->ExportCustom) {
            $doc->exportTableFooter();
        }
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        global $DownloadFileName;

        // No binary fields
        return false;
    }

    // Table level events

    // Table Load event
    public function tableLoad()
    {
        // Enter your code here
    }

    // Recordset Selecting event
    public function recordsetSelecting(&$filter)
    {
        // Enter your code here
    }

    // Recordset Selected event
    public function recordsetSelected($rs)
    {
        //Log("Recordset Selected");
    }

    // Recordset Search Validated event
    public function recordsetSearchValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Recordset Searching event
    public function recordsetSearching(&$filter)
    {
        // Enter your code here
    }

    // Row_Selecting event
    public function rowSelecting(&$filter)
    {
        // Enter your code here
    }

    // Row Selected event
    public function rowSelected(&$rs)
    {
        //Log("Row Selected");
    }

    // Row Inserting event
    public function rowInserting($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, $rsnew)
    {
        //Log("Row Inserted");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, $rsnew)
    {
        //Log("Row Updated");
    }

    // Row Update Conflict event
    public function rowUpdateConflict($rsold, &$rsnew)
    {
        // Enter your code here
        // To ignore conflict, set return value to false
        return true;
    }

    // Grid Inserting event
    public function gridInserting()
    {
        // Enter your code here
        // To reject grid insert, set return value to false
        return true;
    }

    // Grid Inserted event
    public function gridInserted($rsnew)
    {
        //Log("Grid Inserted");
    }

    // Grid Updating event
    public function gridUpdating($rsold)
    {
        // Enter your code here
        // To reject grid update, set return value to false
        return true;
    }

    // Grid Updated event
    public function gridUpdated($rsold, $rsnew)
    {
        //Log("Grid Updated");
    }

    // Row Deleting event
    public function rowDeleting(&$rs)
    {
        // Enter your code here
        // To cancel, set return value to False
        return true;
    }

    // Row Deleted event
    public function rowDeleted($rs)
    {
        //Log("Row Deleted");
    }

    // Email Sending event
    public function emailSending($email, $args)
    {
        //var_dump($email, $args); exit();
        return true;
    }

    // Lookup Selecting event
    public function lookupSelecting($fld, &$filter)
    {
        //var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
        // Enter your code here
    }

    // Row Rendering event
    public function rowRendering()
    {
        // Enter your code here
    }

    // Row Rendered event
    public function rowRendered()
    {
        // To view properties of field class, use:
        //var_dump($this-><FieldName>);
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
