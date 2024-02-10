<?php

@include '../include/function.php';

if (isset($_GET['enquiry_id'])) {
// echo "SELECT * FROM sales_enquiry join sales_company_category on sales_company_category.company_category_id = sales_enquiry.sales_company_category  join customer_type on cu_ty_id = sales_enquiry.enquiry_customer_type where enquiry_id = " . $_GET['enquiry_id'];
    $customerquery = mysqli_query($conn, "SELECT * FROM sales_enquiry join sales_company_category on sales_company_category.company_category_id = sales_enquiry.sales_company_category  join customer_type on cu_ty_id = sales_enquiry.enquiry_customer_type where enquiry_id = " . $_GET['enquiry_id']);
    $customerdata = mysqli_fetch_array($customerquery);
}
$product_groupOptionsHTML = '';
$query = mysqli_query($conn, "SELECT * FROM product_group");
while ($row = mysqli_fetch_array($query)) {
    if (isset($_GET['customer_id'])) {
    }
    $product_groupOptionsHTML .= '<option value="' . $row['product_group_id'] . '">' . $row['product_group_name'] . '</option>';
}

echo '<script>';
echo 'var product_groupOptionsHTML = `' . $product_groupOptionsHTML . '`;';
echo '</script>';

$product_categoryOptionsHTML = '';
$query = mysqli_query($conn, "SELECT * FROM product_category");
while ($row = mysqli_fetch_array($query)) {
    if (isset($_GET['customer_id'])) {
    }
    $product_categoryOptionsHTML .= '<option value="' . $row['product_category_id'] . '">' . $row['product_category_name'] . '</option>';
}

echo '<script>';
echo 'var product_categoryOptionsHTML = `' . $product_categoryOptionsHTML . '`;';
echo '</script>';

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
                        return $("<button class='w-full p-2 text-center text-white' onclick=\"openModal('company_categoryPopup','#sales_stage')\"  style='background-color: #007bff;'>Add Company Category</button>");
                    }
                }
            });
            // $("#enquiry_source").select2({
            //     width: '100%',
            //     placeholder: 'Add Source / Referred by',
            //     language: {
            //         noResults: function() {
            //             return $("<button class='w-full p-2 text-center text-white' onclick=\"openModal('enquiry_sourcePopup','#enquiry_source')\" style='background-color: #007bff;'>Add Source / Referred by</button>");
            //         }
            //     }
            // });
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
        #sales_stagePopup,
        #company_categoryPopup,
        #product_groupPopup {
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
                            <input type="text" id="enquiry_code" name="enquiry_code" placeholder="Enquiry Code" value="<?php echo isset($_GET['enquiry_id']) ? $customerdata['enquiry_code'] : '' ?>" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                        </div>
                        <div class="md:col-span-3 sm:col-span-1">
                            <label for="enquiry_customer_name" class="text-gray-700 font-semibold">Customer Name</label>
                            <select name="enquiry_customer_name" onchange="" id="customer_name" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important"=>
                                <option value="Customer Name">Customer Name</option>
                                <?php
                                getoptionwithcodestatus('customer', 'customer_id', 'customer_company_name', 'customer_code', 'customer_status');

                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="grid lg:grid-cols-4 md:grid-cols-1 sm:grid-cols-1 p-4 pt-0 gap-4">
                        <div class="md:col-span-2 sm:col-span-1">
                            <label for="enquiry_name" class="text-gray-700 font-semibold">Enquiry Name</label>
                            <input type="text" name="enquiry_name" id="enquiry_name" placeholder="Enquiry Name" value="<?php echo isset($_GET['enquiry_id']) ? $customerdata['enquiry_name'] : '' ?>" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2" >
                        </div>
                        <div>
                            <label for="enquiry_sales_stage" class="text-gray-700 font-semibold">Sales Stage</label>
                            <select name="enquiry_sales_stage" id="sales_stage" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important">
                                <option value="Sales Stage">Sales Stage</option>
                                <?php
                                getoptionwithstatus('enquiry_stage', 'stage_id', 'stage_name', 'stage_status');
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="sales_company_category" class="text-gray-700 font-semibold">About Company Category</label>
                            <select name="sales_company_category" id="sales_company_category" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important">
                                <option value="About Company Category">About Company Category</option>
                                <?php
                                getoptionwithstatus('sales_company_category', 'company_category_id', 'company_category_name', 'company_category_status');

                                ?>
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
                                getoptionwithcode('currency', 'currency', 'country', 'currency');

                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="sales_customer_type" class="text-gray-700 font-semibold">Customer Type</label>
                            <input type="text" id="enquiry_customer_type" placeholder="Customer Type" value="<?php echo isset($_GET['enquiry_id']) ? $customerdata['cu_ty_name'] : '' ?>" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2" name="enquiry_customer_type">
                        </div>
                        <div>
                            <label for="sales_sr_by" class="text-gray-700 font-semibold">Source / Referred By</label>
                            <input type="text" id="sales_sr_by" placeholder="Source / Referred By" value="<?php echo isset($_GET['enquiry_id']) ? $customerdata['enquiry_source'] : '' ?>" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2" name="enquiry_source">

                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-4 p-4 pt-0 gap-4">
                        <div class="col-span-3">
                            <label for="sales_description" class="text-gray-700 font-semibold">Description</label>
                            <input type="text" id="sales_description" placeholder="Description" value="<?php echo isset($_GET['enquiry_id']) ? $customerdata['enquiry_description'] : '' ?>" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2" name="enquiry_description">
                        </div>
                        <div class="col-span-1">
                            <label for="sales_version" class="text-gray-700 font-semibold">Version</label>
                            <input type="text" id="sales_version" placeholder="Version" value="<?php echo isset($_GET['enquiry_id']) ? $customerdata['enquiry_version'] + 1 : '1' ?>" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2" name="sales_version">
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
                            <label for="assign_user_to" class="text-gray-700 font-semibold">Customer Contacts</label>
                            <select name="assign_user_to" id="assign_user_to" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important">
                                <option value="Assign To">Assign To</option>
                                <?php
                                getuseroption('user', 'user_id', 'user_username');

                                ?>
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
                                    <div>
                                        <label for="product_category<?php echo  $count; ?>" class="text-gray-700 font-semibold">Product Category</label>
                                        <select name="product_category<?php echo  $count; ?>" id="product_category<?php echo  $count; ?>" class="select2-init border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important">
                                            <option value="Product Category">Product Category</option>
                                            <?php echo $product_categoryOptionsHTML; ?>
                                        </select>
                                    </div>
                                    <div class="lg:col-span-3">
                                        <label for="product_description<?php echo  $count; ?>" class="text-gray-700 font-semibold">Product Description</label>
                                        <input type="text" value="<?php echo $productdata['enquiry_p_product_description'] ?>" id="product_description<?php echo  $count; ?>" name="product_description<?php echo  $count; ?>" placeholder="Product Description" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                                    </div>
                                </div>
                                <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 p-4 pt-0 gap-4">
                                    <div class="col-span-2">
                                        <label for="product_group<?php echo  $count; ?>" class="text-gray-700 font-semibold">Product Group</label>
                                        <select name="product_group<?php echo  $count; ?>" id="product_group<?php echo  $count; ?>" class="select2-init border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important">
                                            <option value="Product Category">Product Group</option>
                                            <?php echo $product_groupOptionsHTML; ?>

                                        </select>
                                    </div>
                                    <div>
                                        <label for="part_number<?php echo  $count; ?>" class="text-gray-700 font-semibold">Part Number</label>
                                        <input type="text" value="<?php echo $productdata['enquiry_p_product_description'] ?>" id="part_number<?php echo  $count; ?>" name="part_number<?php echo  $count; ?>" placeholder="Part Number" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                                    </div>
                                    <div>
                                        <label for="product_hsn_code<?php echo  $count; ?>" class="text-gray-700 font-semibold">HSN Code</label>
                                        <input type="text" value="<?php echo $productdata['enquiry_p_product_hsn_code'] ?>" id="product_hsn_code<?php echo  $count; ?>" name="product_hsn_code<?php echo  $count; ?>" placeholder="HSN Code" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                                    </div>
                                </div>
                                <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 p-4 pt-0 gap-4">
                                    <div>
                                        <label for="product_quantity<?php echo  $count; ?>" class="text-gray-700 font-semibold">Quantity</label>
                                        <input type="text" value="<?php echo $productdata['enquiry_p_product_quantity'] ?>" id="product_quantity<?php echo  $count; ?>" onchange="calculateAmount(<?php echo  $count; ?>)" name="product_quantity<?php echo  $count; ?>" placeholder="Quantity" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                                    </div>
                                    <div>
                                        <label for="product_rate<?php echo  $count; ?>" class="text-gray-700 font-semibold">Rate</label>
                                        <input type="text" value="<?php echo $productdata['enquiry_p_product_rate'] ?>" id="product_rate<?php echo  $count; ?>" onchange="calculateAmount(<?php echo  $count; ?>)" name="product_rate<?php echo  $count; ?>" placeholder="Rate" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                                    </div>
                                    <div class="col-span-2">
                                        <label for="product_amount<?php echo  $count; ?>" class="text-gray-700 font-semibold">Amount</label>
                                        <input type="text" value="<?php echo $productdata['enquiry_p_product_amount'] ?>" id="product_amount<?php echo  $count; ?>" name="product_amount<?php echo  $count; ?>" placeholder="Amount" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                        getselecterdata($productdata['enquiry_p_product_category'], '#product_category' . $count);
                        getselecterdata($productdata['enquiry_p_Group'], '#product_group' . $count);
                    }
                }
                echo '<script>';

                echo    $count > 0 ?  'var ProductNumber = ' . ($count) . ';' :  'var ProductNumber = ' . '0' . ';';
                echo 'console.log(ProductNumber)';
                echo '</script>';
                ?>
            </div>
            <div id="totalsections">
                <div class="bg-white rounded-sm shadow-md mb-4">
                    <div class="w-full border-b">
                        <h2 class="text-gray-800 font-semibold p-4 text-lg">Total</h3>
                    </div>
                    <div class="grid lg:grid-cols-4 md:grid-cols-1 sm:grid-cols-1 p-4 gap-4">
                        <div class="md:col-span-2 sm:col-span-1">
                            <label for="total_in_word" class="text-gray-700 font-semibold">In word</label>
                            <input type="text" id="total_in_word" placeholder="" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2" name="total_in_word">
                        </div>
                        <div>
                            <label for="total_quantity_nos" class="text-gray-700 font-semibold">Total Quantity NOs.</label>
                            <input type="text" id="total_quantity_nos" placeholder="" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2" name="total_quantity_nos">
                        </div>
                        <div>
                            <label for="total" class="text-gray-700 font-semibold">Total</label>
                            <input type="text" id="total" placeholder="" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2" name="total">
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
            <div>
                <div class="bg-white rounded-sm shadow-md mb-4">
                    <div class="w-full border-b">
                        <h2 class="text-gray-800 font-semibold p-4 text-lg"> Customer Contacts</h3>
                    </div>
                    <div class="">

                        <table id="contactTable" class="min-w-full table-auto">
                            <thead style="background-color: #F9FAFF; color:#031A61;">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm leading-4 font-medium  tracking-wider">
                                        Select
                                    </th>
                                    <th class="px-6 py-3 text-left text-sm leading-4 font-medium  tracking-wider">
                                        Contact Name
                                    </th>
                                    <th class="px-6 py-3 text-left text-sm leading-4 font-medium  tracking-wider">
                                        Job Title
                                    </th>
                                    <th class="px-6 py-3 text-left text-sm leading-4 font-medium  tracking-wider">
                                        Email
                                    </th>
                                    <th class="px-6 py-3 text-left text-sm leading-4 font-medium  tracking-wider">
                                        Phone
                                    </th>
                                    <th class="px-6 py-3 text-left text-sm leading-4 font-medium  tracking-wider">
                                        Mobile
                                    </th>
                                    <th class="px-6 py-3 text-left text-sm leading-4 font-medium  tracking-wider">
                                        Billing Address
                                    </th>
                                    <th class="px-6 py-3 text-left text-sm leading-4 font-medium  tracking-wider">
                                        Shipping Address
                                    </th>
                                </tr>
                            </thead>

                            <?php
                            if (isset($customerdata['enquiry_customer_name'])) {
                                $cotactquery = mysqli_query($conn, "SELECT * FROM contact_quotation join job_title on contact_quotation.job_title = job_title.job_title_id   where company_name = " . $customerdata['enquiry_customer_name']);
                                // $contactdata = mysqli_fetch_assoc($cotactquery);
                                while ($contactdata = mysqli_fetch_assoc($cotactquery)) {
                            ?> <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap"><input type="radio" name="contact_id" <?php echo $customerdata['contact_id'] == $contactdata['contact_quotation_id'] ? "checked" : " " ?> value="11"></td>
                                        <td class="px-6 py-4 whitespace-no-wrap"><?php echo $contactdata['first_name'] . " " . $contactdata['last_name']; ?></td>
                                        <td class="px-6 py-4 whitespace-no-wrap"><?php echo $contactdata['job_title_name']; ?></td>
                                        <td class="px-6 py-4 whitespace-no-wrap"><?php echo $contactdata['email1']; ?></td>
                                        <td class="px-6 py-4 whitespace-no-wrap"><?php echo $contactdata['mobile_no1']; ?></td>
                                        <td class="px-6 py-4 whitespace-no-wrap"><?php echo $contactdata['mobile_no2']; ?></td>
                                        <td class="px-6 py-4 whitespace-no-wrap"><?php echo $contactdata['billing_address']; ?></td>
                                        <td class="px-6 py-4 whitespace-no-wrap"><?php echo $contactdata['shipping_address']; ?></td>


                                    </tr>
                            <?php }
                            } ?>
                        </table>

                    </div>
                </div>
            </div>
            <div class="flex flex-wrap gap-5">
                <button class="text-white text-sm px-4 py-2 w-28" type="submit" style="background-color: #007bff;" value="<?php echo isset($_GET['enquiry_id']) ? $_GET['enquiry_id'] : "0" ?>" name="<?php echo isset($_GET['enquiry_id']) ? "edit_sales_enquiry" : "add_sales_enquiry" ?>">Save</button>
                <button class="text-white text-sm px-4 py-2" style="background-color: #007bff;">Save & Create Quotation</button>
                <a href="sales_enquiry.php"  class="btn border text-sm px-4 py-2" style="color: #007bff; border: 1px solid #007bff;">Cancel</a >
            </div>

        </div>
    </form>
    <div class="addpopup" id="addpopup">

    </div>
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
    <div class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 p-4 transition-all duration-300" style="  z-index: 99;" id="product_groupPopup" style="display: BLOCK;">
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-sm shadow-lg" style="width: 600px;">
            <div class="flex justify-between border-b">
                <h2 class="text-gray-800 font-semibold p-4 text-xl">Create product group</h2>
                <svg id="closeCCategory" onclick="closeModal('product_groupPopup')" class="cursor-pointer mt-3 mr-2 close-button" width="35" height="35" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M37.5 12.5L12.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M12.5 12.5L37.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </div>
            <form class="p-4" name="product_groupform" action="../include/function.php" id="product_groupform">
                <div>
                    <label for="customer_type" class="text-gray-700 font-semibold">Product group</label>
                    <input type="text" name="product_group" id="product_group" placeholder="Product group" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                </div>
                <div class="flex items-center justify-start gap-4 mt-32">
                    <button class="text-white text-sm px-4 py-2 w-28" onclick="savedata('product_groupform','#product_group','product_group')" type="button" id="openButton" style="background-color: #007bff;">Save</button>
                    <button type="button" class="border bg-white text-sm px-4 py-2 w-28" onclick="closeModal('product_groupPopup')" style="color: #007bff; border: 1px solid #007bff;">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <div class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 p-4 transition-all duration-300" style="  z-index: 99;" id="company_categoryPopup" style="display: BLOCK;">
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-sm shadow-lg" style="width: 600px;">
            <div class="flex justify-between border-b">
                <h2 class="text-gray-800 font-semibold p-4 text-xl">Create Company Category</h2>
                <svg id="closeCCategory" onclick="closeModal('company_categoryPopup')" class="cursor-pointer mt-3 mr-2 close-button" width="35" height="35" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M37.5 12.5L12.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M12.5 12.5L37.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </div>
            <form class="p-4" name="company_categoryform" action="../include/function.php" id="company_categoryform">
                <div>
                    <label for="customer_type" class="text-gray-700 font-semibold">Company Category</label>
                    <input type="text" name="company_category" id="company_category" placeholder="Company Category" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                </div>
                <div class="flex items-center justify-start gap-4 mt-32">
                    <button class="text-white text-sm px-4 py-2 w-28" onclick="savedata('company_categoryform','#sales_company_category','company_category')" type="button" id="openButton" style="background-color: #007bff;">Save</button>
                    <button type="button" class="border bg-white text-sm px-4 py-2 w-28" onclick="closeModal('company_categoryPopup')" style="color: #007bff; border: 1px solid #007bff;">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://unpkg.com/number-to-words"></script>


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
        $('#customer_name').on('select2:select', function(e) {
            var data = e.params.data;

            $.ajax({
                url: '../include/function.php',
                method: 'GET',
                data: {
                    customerdata: data.id
                },
                success: function(response) {
                    // console.log(response);
                    var customerData = JSON.parse(response);

                    var customerId = customerData.customer_id;


                    $('#enquiry_customer_type').val(customerData.cu_ty_name).prop('readonly', true);
                    $('#sales_sr_by').val(customerData.source_name).prop('readonly', true);
                    $('#enquiry_customer_type').css('background-color', '#eeeeee');
                    $('#sales_sr_by').css('background-color', '#eeeeee');

                },
                error: function(error) {
                    console.error('AJAX request failed: ' + error);
                }
            });

            $.ajax({
                url: '../include/function.php',
                method: 'GET',
                data: {
                    getcontacts: data.id
                },
                success: function(response) {
                    var contactData = JSON.parse(response);
                    // console.log(contactData);
                    let table = document.getElementById('contactTable');
                    table.innerHTML = "";

                    let headerRow = table.insertRow();
                    let headers = ["Select", "Contact Name", "Job Title", "Email", "Phone", "Mobile", "Billing Address", "Shipping Address"];
                    headers.forEach(header => {
                        let th = document.createElement('th');
                        th.classList.add("px-6", "py-3", "text-left", "text-sm", "leading-4", "font-medium", "tracking-wider");
                        th.textContent = header;
                        headerRow.appendChild(th);
                    });


                    contactData.forEach(item => {
                        let row = table.insertRow();

                        let cell1 = row.insertCell();
                        cell1.classList.add("px-6", "py-4", "whitespace-no-wrap");
                        let checkbox = document.createElement('input');
                        checkbox.type = 'radio';
                        checkbox.name = "contact_id";
                        checkbox.value = item.contact_quotation_id;
                        cell1.appendChild(checkbox);

                        let cell2 = row.insertCell();
                        cell2.classList.add("px-6", "py-4", "whitespace-no-wrap");
                        cell2.textContent = item.first_name + ' ' + item.last_name;

                        let cell3 = row.insertCell();
                        cell3.classList.add("px-6", "py-4", "whitespace-no-wrap");
                        cell3.textContent = item.job_title_name;

                        let cell4 = row.insertCell();
                        cell4.classList.add("px-6", "py-4", "whitespace-no-wrap");
                        cell4.textContent = item.email1;

                        let cell5 = row.insertCell();
                        cell5.classList.add("px-6", "py-4", "whitespace-no-wrap");
                        cell5.textContent = item.mobile_no1;

                        let cell6 = row.insertCell();
                        cell6.classList.add("px-6", "py-4", "whitespace-no-wrap");
                        cell6.textContent = item.mobile_no2;

                        let cell7 = row.insertCell();
                        cell7.classList.add("px-6", "py-4", "whitespace-no-wrap");
                        cell7.textContent = item.billing_address;

                        let cell8 = row.insertCell();
                        cell8.classList.add("px-6", "py-4", "whitespace-no-wrap");
                        cell8.textContent = item.shipping_address;
                    });

                },
                error: function(error) {
                    console.error('AJAX request failed: ' + error);
                }
            });
        });
    </script>
    <?php


    if (isset($_GET['enquiry_id'])) {


        getselecterdata($customerdata['enquiry_customer_name'], '#customer_name');

        getselecterdata($customerdata['sales_branch_warehouse'], '#sales_branch_warehouse');
        getselecterdata($customerdata['sales_stage'], '#sales_stage');
        getselecterdata($customerdata['enquiry_currency'], '#currency');
        getselecterdata($customerdata['assign_user_to'], '#assign_user_to');
        getselecterdata($customerdata['sales_company_category'], '#sales_company_category');
        echo '<script>document.getElementById("totalsections").style.display = "block";</script>';
        echo "<script>calculateAmount(ProductNumber); 
    
        </script>";
    ?>

    <?php

    } else {

        echo '<script>document.getElementById("totalsections").style.display = "none";</script>';
    }


    ?>
</body>

</html>