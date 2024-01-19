<?php
@include '../include/config.php';
@include '../include/function.php';
if (isset($_GET['enquiry_id'])) {

    $customerquery = mysqli_query($conn, "SELECT * FROM sales_enquiry where enquiry_id = " . $_GET['enquiry_id']);
    $customerdata = mysqli_fetch_array($customerquery);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Sales Enquiry</title>

    <?php include '../include/script.php' ?>
    <style>
        .select2-container {
            box-sizing: border-box;
            display: inline-block;
            margin-top: 0.5rem;
            position: relative;
            vertical-align: middle;
        }
    </style>

    <script>
        $(document).ready(function() {
            $("#customer_name").select2({
                width: '100%',
                placeholder: 'Add Customer Name',
                language: {
                    noResults: function() {
                        return $("<button class='w-full p-2 text-center text-white' onclick=\"openModal('aadcustomerPopup','#customer_name')\"  style='background-color: #007bff;'>Add Customer Name</button>");
                    }
                }
            });
            $("#sales_branch_warehouse").select2({
                width: '100%',
                placeholder: 'Add Branch / Warehouse',
                language: {
                    noResults: function() {
                        return $("<button class='w-full p-2 text-center text-white' onclick=\"openModal('customer_branch_warehousePopup','#sales_branch_warehouse')\"   style='background-color: #007bff;'>Add Branch / Warehouse</button>");
                    }
                }
            });
            $("#sales_stage").select2({
                width: '100%',
                placeholder: 'Add Sales Stage',
                language: {
                    noResults: function() {
                        return $("<button class='w-full p-2 text-center text-white' onclick=\"openModal('sales_stagePopup','#sales_stage')\"  style='background-color: #007bff;'>Add Sales Stage</button>");
                    }
                }
            });
            $("#sales_company_category").select2({
                width: '100%',
                placeholder: 'Add Company Category',
                language: {
                    noResults: function() {
                        return $("<button class='w-full p-2 text-center text-white' onclick=\"openModal('sales_stagePopup','#sales_stage')\"  style='background-color: #007bff;'>Add Company Category</button>");
                    }
                }
            });
            $("#currency").select2({});
            $("#assign_user_to").select2({
                width: '100%',
                placeholder: 'Add User',
                language: {
                    noResults: function() {
                        return $("<button class='w-full p-2 text-center text-white' onclick=\"openModal('sales_stagePopup','#sales_stage')\"  style='background-color: #007bff;'>Add User</button>");
                    }
                }
            });
            $('.select2-init').each(function() {
                $(this).select2({});
            });
        })
    </script>
    <style>
        #customer_branch_warehousePopup,
        #aadcustomerPopup,
        #sales_stagePopup {
            display: none;
            z-index: 99;
        }
    </style>
</head>

<body class="bg-gray-100">
    <?php include '../include/sidebar.php' ?>

    <?php include '../include/header.php' ?>
    <form action="../include/function.php" method="post" enctype="multipart/form-data">
        <div id="mydiv" class="max-w-full mx-auto mt-20 ml-16 p-4 text-sm transition-all duration-300">
            <div class="mb-3">
                <h1 class="text-xl font-semibold text-custom-blue">Add Sales Enquiry</h1>
            </div>
            <div>
                <div class="bg-white rounded-sm shadow-md mb-4">
                    <div class="w-full border-b">
                        <h2 class="text-gray-800 font-semibold p-4 text-lg">General Information</h3>
                    </div>
                    <div class="grid lg:grid-cols-4 md:grid-cols-1 sm:grid-cols-1 p-4 gap-4">
                        <div>
                            <label for="customer_code" class="text-gray-700 font-semibold">Enquiry Code</label>
                            <input type="text" id="customer_code" name="enquiry_code" placeholder="Enquiry Code" value="<?php echo isset($_GET['enquiry_id']) ? $customerdata['enquiry_code'] : '' ?>" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                        </div>
                        <div class="md:col-span-2 sm:col-span-1">
                            <label for="enquiry_customer_name" class="text-gray-700 font-semibold">Customer Name</label>
                            <select name="enquiry_customer_name" id="customer_name" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important">
                                <option value="Customer Name">Customer Name</option>
                                <?php
                                getoptionwithcodestatus('customer', 'customer_id', 'customer_name', 'customer_code','customer_status');

                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="sales_branch_warehouse" class="text-gray-700 font-semibold">Branch/Warehouse</label>
                            <select name="sales_branch_warehouse" id="sales_branch_warehouse" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important">
                                <option value="Branch/Warehouse">Branch/Warehouse</option>
                                <?php
                                getoptionwithstatus('warehouse', 'warehouse_id', 'warehouse_name','warehouse_status');

                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="grid lg:grid-cols-4 md:grid-cols-1 sm:grid-cols-1 p-4 pt-0 gap-4">
                        <div class="md:col-span-2 sm:col-span-1">
                            <label for="enquiry_name" class="text-gray-700 font-semibold">Enquiry Name</label>
                            <input type="text" id="enquiry_name" placeholder="Enquiry Name" value="<?php echo isset($_GET['enquiry_id']) ? $customerdata['enquiry_name'] : '' ?>" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2" name="enquiry_name">
                        </div>
                        <div>
                            <label for="enquiry_sales_stage" class="text-gray-700 font-semibold">Sales Stage</label>
                            <select name="enquiry_sales_stage" id="sales_stage" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important">
                                <option value="Sales Stage">Sales Stage</option>
                                <?php
                                getoptionwithstatus('enquiry_stage', 'stage_id', 'stage_name','stage_status');
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="sales_company_category" class="text-gray-700 font-semibold">About Company Category</label>
                            <select name="sales_company_category" id="sales_company_category" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important">
                                <option value="About Company Category">About Company Category</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 p-4 pt-0 gap-4">
                        <div>
                            <label for="close_date" class="text-gray-700 font-semibold">Close Date</label>
                            <input type="date" id="close_date" placeholder="Close Date" value="<?php echo isset($_GET['enquiry_id']) ? $customerdata['enquiry_close_date'] : '' ?>" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2" name="enquiry_close_date">
                        </div>
                        <div>
                            <label for="currency" class="text-gray-700 font-semibold">Currency</label>
                            <select name="enquiry_currency" id="currency" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important">
                                <option value="Currency">Currency</option>
                                <?php
                                getoptionwithcode('currency', 'currency_id', 'name', 'symbol');

                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="sales_customer_type" class="text-gray-700 font-semibold">Customer Type</label>
                            <input type="text" id="enquiry_customer_type" placeholder="Customer Type" value="<?php echo isset($_GET['enquiry_id']) ? $customerdata['enquiry_code'] : '' ?>" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2" name="enquiry_customer_type">
                        </div>
                        <div>
                            <label for="sales_sr_by" class="text-gray-700 font-semibold">Source / Referred By</label>
                            <input type="text" id="sales_sr_by" placeholder="Source / Referred By" value="<?php echo isset($_GET['enquiry_id']) ? $customerdata['enquiry_code'] : '' ?>" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2" name="enquiry_source">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-4 p-4 pt-0 gap-4">
                        <div class="col-span-3">
                            <label for="sales_description" class="text-gray-700 font-semibold">Description</label>
                            <input type="text" id="sales_description" placeholder="Description" value="<?php echo isset($_GET['enquiry_id']) ? $customerdata['enquiry_code'] : '' ?>" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2" name="enquiry_description">
                        </div>
                        <div class="col-span-1">
                            <label for="sales_version" class="text-gray-700 font-semibold">Version</label>
                            <input type="text" id="sales_version" placeholder="Version" value="<?php echo isset($_GET['enquiry_id']) ? $customerdata['enquiry_code'] : '' ?>" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2" name="enquiry_description">
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="bg-white rounded-sm shadow-md mb-4">
                    <div class="w-full border-b">
                        <h2 class="text-gray-800 font-semibold p-4 text-lg">Assign User Information</h3>
                    </div>
                    <div class="grid lg:grid-cols-4 md:grid-cols-1 sm:grid-cols-1 p-4 gap-4">
                        <div>
                            <label for="assign_user_to" class="text-gray-700 font-semibold">Assign To</label>
                            <select name="assign_user_to" id="assign_user_to" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important">
                                <option value="Assign To">Assign To</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div id="add-product">

            <?php
                $count = 0;
                if (isset($_GET['enquiry_id'])) {

                    $addressrquery = mysqli_query($conn, "SELECT * FROM enquiry_product  where enquiry_id = " . $_GET['enquiry_id']);
                    while ($productdata = mysqli_fetch_array($addressrquery)) {
                        $count++;
                ?>
                <div class="max-w-full mb-4">
                    <div class="bg-white rounded-sm shadow-md mb-4">
                        <div class="w-full border-b flex">
                            <h2 class="text-gray-700 font-semibold p-4 text-lg">Product <?php echo  $count; ?></h2>
                            <button class="ml-auto mr-4 flex mt-auto mb-auto" onclick="removeProduct(this)">
                                <svg class="mr-2 mt-1" width="23" height="23" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M15 9L9 15" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M9 9L15 15" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <p class="text-red-500 text-lg">Remove Product</p>
                            </button>
                        </div>
                        <div class="grid lg:grid-cols-4 md:grid-cols-1 sm:grid-cols-1 p-4 gap-4">
                            <div class="lg:col-span-3">
                                <label for="product_description<?php echo  $count; ?>" class="text-gray-700 font-semibold">Product Description</label>
address_email                                <input type="text" id="product_description<?php echo  $count; ?>" name="product_description<?php echo  $count; ?>"  value="<?php echo $productdata['enquiry_p_product_description']; ?>" placeholder="Product Description" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                            </div>
                            <div>
                                <label for="part_number<?php echo  $count; ?>" class="text-gray-700 font-semibold">Part Number</label>
                                <input type="text" id="part_number<?php echo  $count; ?>" name="part_number<?php echo  $count; ?>" value="<?php echo $productdata['enquiry_p_part_number']; ?>" placeholder="Part Number" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                            </div>

                        </div>
                        <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 p-4 pt-0 gap-4">
                            <div>
                                <label for="product_hsn_code<?php echo  $count; ?>" class="text-gray-700 font-semibold">HSN Code</label>
                                <input type="text" id="product_hsn_code<?php echo  $count; ?>" name="product_hsn_code<?php echo  $count; ?>" value="<?php echo $productdata['enquiry_p_product_hsn_code']; ?>" placeholder="HSN Code" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                            </div>
                            <div>
                                <label for="product_quantity<?php echo  $count; ?>" class="text-gray-700 font-semibold">Quantity</label>
                                <input type="text" id="product_quantity<?php echo  $count; ?>" name="product_quantity<?php echo  $count; ?>"  value="<?php echo $productdata['enquiry_p_product_quantity']; ?>" placeholder="Quantity" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                            </div>
                            <div>
                                <label for="product_rate<?php echo  $count; ?>" class="text-gray-700 font-semibold">Rate</label>
                                <input type="text" id="product_rate<?php echo  $count; ?>" name="product_rate<?php echo  $count; ?>" value="<?php echo $productdata['enquiry_p_product_rate']; ?>"  placeholder="Rate" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                            </div>
                            <div>
                                <label for="product_amount<?php echo  $count; ?>" class="text-gray-700 font-semibold">Amount</label>
                                <input type="text" id="product_amount<?php echo  $count; ?>" name="product_amount<?php echo  $count; ?>" value="<?php echo $productdata['enquiry_p_product_amount']; ?>"  placeholder="Amount" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }
                }
                echo '<script>';
                echo    $count > 0 ?  'var ProductNumber = ' . ($count + 1) . ';' :  'var addresscount = ' . '1' . ';';
                echo '</script>';
                ?>
            </div>
            <div>
                <div class="bg-white rounded-sm shadow-md mb-4">
                    <div class="w-full border-b">
                        <h2 class="text-gray-800 font-semibold p-4 text-lg">Total</h3>
                    </div>
                    <div class="grid lg:grid-cols-4 md:grid-cols-1 sm:grid-cols-1 p-4 gap-4">
                        <div class="md:col-span-2 sm:col-span-1">
                            <label for="total_in_word" class="text-gray-700 font-semibold">In word</label>
                            <input type="text" id="total_in_word" placeholder="" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2" name="enquiry_name">
                        </div>
                        <div>
                            <label for="total_quantity_nos" class="text-gray-700 font-semibold">Total Quantity NOs.</label>
                            <input type="text" id="total_quantity_nos" placeholder="" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2" name="enquiry_name">
                        </div>
                        <div>
                            <label for="total" class="text-gray-700 font-semibold">Total</label>
                            <input type="text" id="total" placeholder="" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2" name="enquiry_name">
                        </div>
                    </div>
                </div>
            </div>
            <button class="flex p-4" onclick="addProduct()" type="button">
                <svg class="ml-3 mr-3 mb-1" width="23" height="23" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#007BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M12 8V16" stroke="#007BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M8 12H16" stroke="#007BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <p class="" style="color: #007bff;">Add New Product</p>
            </button>

            <div class="flex flex-wrap gap-5">
                <button class="text-white text-sm px-4 py-2 w-28" type="submit" style="background-color: #007bff;"value="<?php echo isset($_GET['enquiry_id']) ? $_GET['enquiry_id'] : "0" ?>"  name="<?php echo isset($_GET['enquiry_id']) ? "edit_sales_enquiry" : "add_sales_enquiry" ?>" >Save</button>
                <button class="text-white text-sm px-4 py-2" style="background-color: #007bff;">Save & Create Quotation</button>
                <button class="border text-sm px-4 py-2 w-28" style="color: #007bff; border: 1px solid #007bff;">Cancel</button>
            </div>
        </div>
    </form>
    <div class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 p-4 transition-all duration-300" style="  z-index: 99;" id="customer_branch_warehousePopup" style="display: BLOCK;">
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-sm shadow-lg" style="width: 600px;">
            <div class="flex justify-between border-b">
                <h2 class="text-gray-800 font-semibold p-4 text-xl">Create Customer Branch</h2>
                <svg id="closeCCategory" onclick="closeModal('customer_branch_warehousePopup')" class="cursor-pointer mt-3 mr-2 close-button" width="35" height="35" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M37.5 12.5L12.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M12.5 12.5L37.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </div>
            <form class="p-4" name="customer_branch_warehouseform" action="../include/function.php" id="customer_branch_warehouseform">
                <div>
                    <label for="customer_type" class="text-gray-700 font-semibold">Customer Branch</label>
                    <input type="text" name="customer_branch_warehouse" id="customer_branch_warehouse" placeholder="Customer Type" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                </div>
                <div class="flex items-center justify-start gap-4 mt-32">
                    <button class="text-white text-sm px-4 py-2 w-28" onclick="savedata('customer_branch_warehouseform','#sales_branch_warehouse','customer_branch_warehouse')" type="button" id="openButton" style="background-color: #007bff;">Save</button>
                    <button type="button" class="border bg-white text-sm px-4 py-2 w-28" onclick="closeModal('customer_branch_warehousePopup')" style="color: #007bff; border: 1px solid #007bff;">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <div class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 p-4 transition-all duration-300" style="  z-index: 99;" id="sales_stagePopup" style="display: BLOCK;">
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-sm shadow-lg" style="width: 600px;">
            <div class="flex justify-between border-b">
                <h2 class="text-gray-800 font-semibold p-4 text-xl">Create Sales Stage</h2>
                <svg id="closeCCategory" onclick="closeModal('sales_stagePopup')" class="cursor-pointer mt-3 mr-2 close-button" width="35" height="35" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M37.5 12.5L12.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M12.5 12.5L37.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </div>
            <form class="p-4" name="sales_stageform" action="../include/function.php" id="sales_stageform">
                <div>
                    <label for="customer_type" class="text-gray-700 font-semibold">Sales_Stage</label>
                    <input type="text" name="sales_stage" id="sales_stage" placeholder="Customer Type" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                </div>
                <div class="flex items-center justify-start gap-4 mt-32">
                    <button class="text-white text-sm px-4 py-2 w-28" onclick="savedata('sales_stageform','#sales_stage','sales_stage')" type="button" id="openButton" style="background-color: #007bff;">Save</button>
                    <button type="button" class="border bg-white text-sm px-4 py-2 w-28" onclick="closeModal('sales_stagePopup')" style="color: #007bff; border: 1px solid #007bff;">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <?php


    if (isset($_GET['enquiry_id'])) {


        getselecterdata($customerdata['enquiry_customer_name'], '#customer_name');
        getselecterdata($customerdata['sales_branch_warehouse'], '#sales_branch_warehouse');
        getselecterdata($customerdata['sales_stage'], '#sales_stage');
        getselecterdata($customerdata['enquiry_currency'], '#currency');
    }
 
    
    ?>
    <script src="../assets/js/script.js"></script>
<script>
    $(document).ready(function() {
        if (window.location.href.includes("sales")) {
            const sales = document.querySelector(".sales");
            const salesMenu = document.getElementById("salesSubmenu");

            sales.classList.add("active");

            const customerLink = document.querySelector('a[href="/erp/sales/sales_enquiry.php"]');
            if (customerLink) {
                customerLink.classList.add('font-bold', 'text-black');
            }
        }
    });
$('#customer_name').on('select2:select', function (e) {
    var data = e.params.data;

    $.ajax({
        url: '../include/function.php',
        method: 'GET',
        data: {
            customerdata: data.id
        },
        success: function(response) {
//    console.log(response);
            var customerData = JSON.parse(response);

            var customerId = customerData.customer_id;
       
$(' #sales_branch_warehouse').val(customerData.warehouse_id ); 
$(' #sales_branch_warehouse').trigger('change'); 
$('#company_name').val(customerData.customer_company_name); 
$('#enquiry_customer_type').val(customerData.customer_type);

        },  
        error: function(error) {
            console.error('AJAX request failed: ' + error);
        }
    });
});

</script>
</body>

</html>