<?php

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
    <title>Dashboard Layout</title>
    <?php include '../include/script.php' ?>

    <style>
        .select2-container {
            box-sizing: border-box;
            display: inline-block;
            margin-top: 0.5rem;
            position: relative;
            vertical-align: middle;
        }

        #productPopup {


            display: none;
        }
    </style>

    <script>
        $(document).ready(function() {
            $("#sales_quotation_cc_name").select2({
                width: '100%',
                placeholder: 'Add Company Name / Customer Name',
                language: {
                    noResults: function() {
                        return $("<button class='w-full p-2 text-center text-white' style='background-color: #007bff;'>Add Company Name / Customer Name</button>");
                    }
                }
            });
            $("#sales_quotation_enquiry").select2({
                width: '100%',
                placeholder: 'Add Enquiry',
                language: {
                    noResults: function() {
                        return $("<button class='w-full p-2 text-center text-white' style='background-color: #007bff;'>Add Enquiry</button>");
                    }
                }
            });
            $("#sales_quotation_branch_warehouse").select2({
                width: '100%',
                placeholder: 'Add Branch / Warehouse',
                language: {
                    noResults: function() {
                        return $("<button class='w-full p-2 text-center text-white' style='background-color: #007bff;'>Add Branch / Warehouse</button>");
                    }
                }
            });
            $("#sales_quotation_currency").select2({});
        })
    </script>

</head>

<body class="bg-gray-100">
    <?php include '../include/sidebar.php' ?>

    <?php include '../include/header.php' ?>
    <form action="../include/function.php" method="post" enctype="multipart/form-data">

        <div id="mydiv" class="max-w-full mx-auto mt-20 ml-16 p-4 text-sm transition-all duration-300">
            <div class="mb-3">
                <h1 class="text-xl font-semibold text-custom-blue">Add Sales Quotation</h1>
            </div>
            <div>
                <div class="bg-white rounded-sm shadow-md mb-4">
                    <div class="w-full border-b">
                        <h2 class="text-gray-800 font-semibold p-4 text-lg">General Information</h3>
                    </div>
                    <div class="grid lg:grid-cols-4 md:grid-cols-1 sm:grid-cols-1 p-4 gap-4">
                        <div>
                            <label for="qsales_quotation_number" class="text-gray-700 font-semibold">Quotation number</label>
                            <input type="text" id="qsales_quotation_number" placeholder="Quotation number" name="qsales_quotation_number" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                        </div>
                        <div>
                            <label for="sales_quotation_cc_name" class="text-gray-700 font-semibold">Company name / Customer Name</label>
                            <select name="sales_quotation_cc_name" id="sales_quotation_cc_name" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important" onchange="getenquirydata(this.value)">
                                <option value="">Formura</option>
                                <?php
                                getoptionwithcode('customer', 'customer_id', 'customer_name', 'customer_company_name');
                                ?>
                            </select>
                        </div>
                        <div class="md:col-span-2 sm:col-span-1">
                            <label for="sales_quotation_enquiry" class="text-gray-700 font-semibold">Enquiry</label>
                            <select name="sales_quotation_enquiry" id="sales_quotation_enquiry" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important" onchange="getcontactdata(this.value)">
                                <option value="Enquiry">Enquiry</option>
                                <?php
                                // getoptionwithcode('sales_enquiry', 'enquiry_id', 'enquiry_name', 'enquiry_id');

                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="grid lg:grid-cols-4 md:grid-cols-1 sm:grid-cols-1 p-4 pt-0 gap-4">
                        <div class="md:col-span-2 sm:col-span-1">
                            <label for="qsales_quotation_subject" class="text-gray-700 font-semibold">Quotation Subject</label>
                            <input type="text" id="qsales_quotation_subject" placeholder="Quotation Subject" name="qsales_quotation_subject" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                        </div>
                        <div>
                            <label for="sales_quotation_contact" class="text-gray-700 font-semibold">Contact</label>
                            <input name="sales_quotation_contact" id="sales_quotation_contact" class="border rounded-sm outline-none mt-2 p-2 w-full focus:ring focus:ring-blue-400" placeholder="Add Contact" />
                        </div>
                        <div>
                            <label for="sales_quotation_type" class="text-gray-700 font-semibold">Version</label>
                            <input type="text" id="sales_quotation_version" placeholder="Version" name="sales_quotation_type" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                        </div>
                    </div>
                    <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 p-4 pt-0 gap-4">
                        <div>
                            <label for="sales_quotation_valid_till" class="text-gray-700 font-semibold">Valid Till</label>
                            <input type="date" id="sales_quotation_valid_till" name="sales_quotation_valid_till" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2" style="color: #999999;">
                        </div>
                        <div>
                            <label for="sales_quotation_currency" class="text-gray-700 font-semibold">Currency</label>
                            <select name="sales_quotation_currency" id="sales_quotation_currency" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important">
                                <option value="Currency">Currency</option>
                                <?php
                                getoptionwithcode('currency', 'currency', 'country', 'currency');

                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="quotation_type" class="text-gray-700 font-semibold">Quotation Type</label>
                            <div class="flex items-center mt-4">
                                <div class="flex items-center mr-3">
                                    <input type="radio" id="domestic" name="sales_quotation_type" name="qsales_quotation_type" class="border rounded-sm outline-none p-3 mr-2 w-5 h-5" value="Domestic">
                                    <label for="domestic" class="text-gray-400 font-normal">Domestic</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" id="export" name="sales_quotation_type" name="qsales_quotation_type" class="border rounded-sm outline-none p-2 mr-2 w-5 h-5" value="Export">
                                    <label for="export" class="text-gray-400 font-normal mr-auto">Export</label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="sales_quotation_sr_by" class="text-gray-700 font-semibold">Source / Referred By</label>
                            <input type="text" id="sales_quotation_sr_by" placeholder="Source / Referred By" name="sales_quotation_sr_by" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                        </div>
                    </div>
                    <div class="grid p-4 pt-0 gap-4">
                        <div class="col-span-full">
                            <label for="sales_quotation_description" class="text-gray-700 font-semibold">Description</label>
                            <input type="text" id="sales_quotation_description" placeholder="Description" name="sales_quotation_description" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-sm shadow-md mb-4">
                <div class="w-full border-b">
                    <h2 class="text-gray-800 font-semibold p-4 text-lg">Product List</h3>
                </div>
                <div class="">

                    <table id="Producttable" class="min-w-full table-auto">
                        <thead style="background-color: #F9FAFF; ">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm leading-4 font-medium  tracking-wider">
                                    <input type="checkbox" name="termheaderCheckbox" id="termheaderCheckbox">
                                </th>
                                <th class="px-6 py-3 text-left text-sm leading-4 font-medium  tracking-wider">
                                    #
                                </th>
                                <th class="px-6 py-3 text-left text-sm leading-4 font-medium  tracking-wider" colspan="2">
                                    Product Description
                                </th>
                                <th class="px-6 py-3 text-left text-sm leading-4 font-medium  tracking-wider">
                                    Part Number

                                </th>
                                <th class="px-6 py-3 text-left text-sm leading-4 font-medium  tracking-wider">
                                    HSN Code
                                </th>
                                <th class="px-6 py-3 text-left text-sm leading-4 font-medium  tracking-wider">
                                    Quantity
                                </th>
                                <th class="px-6 py-3 text-left text-sm leading-4 font-medium  tracking-wider">
                                    Rate
                                </th>
                                <th class="px-6 py-3 text-left text-sm leading-4 font-medium  tracking-wider">
                                    Amount
                                </th>
                                <th class="px-6 py-3 text-left text-sm leading-4 font-medium  tracking-wider">
                                    Tax
                                </th>
                                <th class="px-6 py-3 text-left text-sm leading-4 font-medium  tracking-wider">
                                    Tax Amount
                                </th>
                                <th class="px-6 py-3 text-left text-sm leading-4 font-medium  tracking-wider">
                                    Action
                                </th>
                            </tr>
                        </thead>

                    </table>

                </div>
            </div>
            <div class="bg-white rounded-sm shadow-md mb-4">
                <div class="w-full border-b">
                    <h2 class="text-gray-800 font-semibold p-4 text-lg">Terms and Condition</h3>
                </div>
                <div class="">

                    <table id="termtable" class="min-w-full table-auto">
                        <thead style="background-color: #F9FAFF; ">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm leading-4 font-medium  tracking-wider">
                                    <input type="checkbox" name="headerCheckbox" id="headerCheckbox">
                                </th>
                                <th class="px-6 py-3 text-left text-sm leading-4 font-medium  tracking-wider">
                                    #
                                </th>
                                <th class="px-6 py-3 text-left text-sm leading-4 font-medium  tracking-wider">
                                    Title
                                </th>
                                <th class="px-6 py-3 text-left text-sm leading-4 font-medium  tracking-wider">
                                    Term And Condition
                                </th>
                            </tr>
                        </thead>
                        <?php
                        $count = 0;
                        $terms_conditionquery = mysqli_query($conn, "SELECT * FROM `terms_condition` ");
                        while ($terms_conditiondata = mysqli_fetch_array($terms_conditionquery)) {
                            $count++;
                        ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap"><input type="checkbox" name="terms_condition[]" value="<?php echo $terms_conditiondata['Terms_Condition_id']; ?>"></td>
                                <td class="px-6 py-4 whitespace-no-wrap"><?php echo $count; ?></td>
                                <td class="px-6 py-4 whitespace-no-wrap"><?php echo $terms_conditiondata['Terms_Condition_description']; ?></td>
                                <td class="px-6 py-4 whitespace-no-wrap"><?php echo $terms_conditiondata['Terms_Condition_Condition']; ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>

            <div class="flex flex-wrap gap-5">
                <button class="text-white text-sm px-4 py-2 w-28" style="background-color: #007bff;" name="add_sales_quotation">Save</button>
                <button class="text-white text-sm px-4 py-2" style="background-color: #007bff;">Save & Preview</button>
                <button class="text-white text-sm px-4 py-2" style="background-color: #007bff;">Save & Create Sales Order</button>
                <button class="bordertext-sm px-4 py-2 w-28" style="color: #007bff; border: 1px solid #007bff;">Cancel</button>
            </div>
        </div>
    </form>
    <div class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 p-4 transition-all duration-300" style="z-index: 99;" id="productPopup" style="display: BLOCK;">
        <div id="bw_popup" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-sm shadow-lg" style="width:1100px;">
            <div class="flex justify-between border-b">
                <h2 class="text-gray-800 font-semibold p-4 text-xl">Terms Condition</h2>
                <svg id="closeCCategory" onclick="closeModal('terms_conditionPopup')" class="cursor-pointer mt-3 mr-2 close-button" width="35" height="35" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M37.5 12.5L12.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M12.5 12.5L37.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </div>
            <form class="p-4" name="terms_conditionform" action="../include/function.php" id="terms_conditionform">

                <div class="grid lg:grid-cols-2 md:grid-cols-1 sm:grid-cols-1 p-4 gap-4">
                    <div>
                        <label for="customer_type" class="text-gray-700 font-semibold">Product Description</label>
                        <input type="text" name="Product_Description" id="Product_Description" placeholder="Product Description" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                    </div>
                    <div>
                        <label for="customer_type" class="text-gray-700 font-semibold">Part Number</label>
                        <input type="text" name="part_number" id="part_number" placeholder="part number" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                    </div>

                    <input type="hidden" name="quotation_Product_id" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                </div>
                <div class="grid lg:grid-cols-4 md:grid-cols-1 sm:grid-cols-1 p-4 gap-4">
                    <div>
                        <label for="customer_type" class="text-gray-700 font-semibold">HSN Code</label>
                        <input type="text" name="hsn_code" id="hsn_code" placeholder="HSN Code" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                    </div>
                    <div>
                        <label for="customer_type" class="text-gray-700 font-semibold">Part Number</label>
                        <input type="text" name="part_number" id="part_number" placeholder="Terms Condition Condition" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                    </div>
                    <div>
                        <label for="customer_type" class="text-gray-700 font-semibold">Part Number</label>
                        <input type="text" name="" id="Terms_Condition_Condition" placeholder="Terms Condition Condition" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                    </div>
                    <div>
                        <label for="customer_type" class="text-gray-700 font-semibold">Part Number</label>
                        <input type="text" name="" id="Terms_Condition_Condition" placeholder="Terms Condition Condition" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                    </div>

                    <input type="hidden" name="Product_id" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                </div>
                <div class="grid lg:grid-cols-4 md:grid-cols-1 sm:grid-cols-1 p-4 gap-4">
                    <div>
                        <label for="customer_type" class="text-gray-700 font-semibold">CGST</label>
                        <input type="text" name="" id="Terms_Condition_description" placeholder="Terms_Condition_description" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                    </div>
                    <div>
                        <label for="customer_type" class="text-gray-700 font-semibold">SGST</label>
                        <input type="text" name="" id="Terms_Condition_Condition" placeholder="Terms Condition Condition" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                    </div>
                    <div>
                        <label for="customer_type" class="text-gray-700 font-semibold">IGST</label>
                        <input type="text" name="" id="Terms_Condition_Condition" placeholder="Terms Condition Condition" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                    </div>
                    <div>
                        <label for="customer_type" class="text-gray-700 font-semibold">Tax Amount</label>
                        <input type="text" name="" id="Terms_Condition_Condition" placeholder="Terms Condition Condition" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                    </div>

                    <input type="hidden" name="Product_id" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                </div>
                <div class="flex items-center justify-start gap-4 mt-10 ">
                    <button class="text-white text-sm px-4 py-2 w-28" onclick="savedatanow('terms_conditionform','<?php echo  isset($_GET['Terms_Condition_id']) ?  'terms_condition_update' : 'Terms_Condition_Condition' ?>')" type="button" id="openButton" style="background-color: #007bff;">Save</button>
                    <button type="button" class="border bg-white text-sm px-4 py-2 w-28" onclick="closeModal('terms_conditionPopup')" style="color: #007bff; border: 1px solid #007bff;">Cancel</button>

            </form>
        </div>
    </div>
    <script src="../assets/js/script.js"></script>
    <script>
        $(document).ready(function() {


            $('#headerCheckbox').click(function() {
                $('input[name="terms_condition[]"]').prop('checked', this.checked);
            });

            $('#termheaderCheckbox').click(function() {
                $('input[name="Productheadercheckbox[]"]').prop('checked', this.checked);
            });
        });
    </script>
    <script>
        function getenquirydata(e) {
            // var data = e.params.data;

            $.ajax({
                url: '../include/function.php',
                method: 'GET',
                data: {
                    Enquirydata: e
                },
                success: function(response) {
                    // console.log(response);

                    let data = JSON.parse(response);
                    let select = document.getElementById('sales_quotation_enquiry');

                    // Empty the select element
                    select.innerHTML = '';
                    let option = document.createElement('option');
                    option.value = "";
                    option.text = "Select Enquiry";
                    select.appendChild(option);
                    data.forEach(item => {
                        let option = document.createElement('option');
                        option.value = item.enquiry_id;
                        option.text = item.enquiry_name;
                        select.appendChild(option);
                    });
                    let sales_quotation_contact = document.getElementById('sales_quotation_contact');
                    sales_quotation_contact.value = "";
                    $('#sales_quotation_currency').val(null); // Deselect all options
                    $('#sales_quotation_currency').prop('disabled', false); // Disable the selector
                    $('#sales_quotation_currency').trigger('change');
                    let sales_quotation_sr_by = document.getElementById('sales_quotation_sr_by');
                    sales_quotation_sr_by.value = "";
                    sales_quotation_sr_by.disabled = true;
                },
                error: function(error) {
                    console.error('AJAX request failed: ' + error);
                }
            });

        }

        function getcontactdata(e) {

            $.ajax({
                url: '../include/function.php',
                method: 'GET',
                data: {
                    Productdata: e
                },
                success: function(response) {
                    console.log(response);

                    let data = JSON.parse(response);
                    let table = document.getElementById('Producttable');
                    let totalQuantity = 0;
                    let totalAmount = 0;
                    let totalTaxAmount = 0;
                    let taxRate = 0;
                    data.forEach((item, index) => {
                        let row = table.insertRow(-1);

                        let quantity = Number(item.enquiry_p_product_quantity);
                        let rate = Number(item.enquiry_p_product_rate);
                        let amount = quantity * rate;
                        let taxAmount = amount * taxRate;

                        row.innerHTML = `
<td class="px-6 py-4 whitespace-no-wrap" ><input type="checkbox" name="Productheadercheckbox[]"></td>
<td class="px-6 py-4 whitespace-no-wrap">${index + 1}</td>
<td class="px-6 py-4 whitespace-no-wrap" colspan="2">${item.enquiry_p_product_description}</td>
<td   class="px-6 py-4 whitespace-no-wrap" >${item.enquiry_p_part_number}</td>
<td   class="px-6 py-4 whitespace-no-wrap" >${item.enquiry_p_product_hsn_code}</td>
<td   class="px-6 py-4 whitespace-no-wrap" >${item.enquiry_p_product_quantity}</td>
<td   class="px-6 py-4 whitespace-no-wrap" >${item.enquiry_p_product_rate}</td>
<td   class="px-6 py-4 whitespace-no-wrap" >${item.enquiry_p_product_amount}</td>
<td   class="px-6 py-4 whitespace-no-wrap" >00</td>
<td   class="px-6 py-4 whitespace-no-wrap" >00</td>
<td   class="px-6 py-4 whitespace-no-wrap" >
<button type="button" onclick="editproduct(${item.enquiry_p_id })">
<svg class="mt-2" width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M12 20H21" stroke="#8A8A8A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
        <path d="M16.5 3.50023C16.8978 3.1024 17.4374 2.87891 18 2.87891C18.2786 2.87891 18.5544 2.93378 18.8118 3.04038C19.0692 3.14699 19.303 3.30324 19.5 3.50023C19.697 3.69721 19.8532 3.93106 19.9598 4.18843C20.0665 4.4458 20.1213 4.72165 20.1213 5.00023C20.1213 5.2788 20.0665 5.55465 19.9598 5.81202C19.8532 6.06939 19.697 6.30324 19.5 6.50023L7 19.0002L3 20.0002L4 16.0002L16.5 3.50023Z" stroke="#8A8A8A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
      </svg>
</button>
</td>
`;

                        totalQuantity += quantity;
                        totalAmount += amount;
                        totalTaxAmount += taxAmount;
                    });


                    let netAmount = totalAmount + totalTaxAmount;

                    let footerRow = table.insertRow(-1);
                    footerRow.innerHTML = `

<td colspan="2" class="px-6 py-4 whitespace-no-wrap">
Amount In Words:
</td>
<td colspan="9" class="px-6 py-4 whitespace-no-wrap">
Amount In Words: INR ${netAmount.toFixed(2)} only Total Quantity NOs. ${totalQuantity} Total ${totalAmount.toFixed(2)} Tax Amount ${totalTaxAmount.toFixed(2)} Net Amount (INR) ${netAmount.toFixed(2)}
</td>
`;
                },
                error: function(error) {
                    console.error('AJAX request failed: ' + error);
                }
            });

            $.ajax({
                url: '../include/function.php',
                method: 'GET',
                data: {
                    Enquirydetaildata: e
                },
                success: function(response) {


                    let data = JSON.parse(response);
                    console.log(data[0]);
                    let sales_quotation_contact = document.getElementById('sales_quotation_contact');
                    sales_quotation_contact.value = data[0].first_name + ' ' + data[0].last_name;
                    sales_quotation_contact.disabled = true; // Disable the input field
                    $('#sales_quotation_currency').val(data[0].enquiry_currency); // Select by value
                    $('#sales_quotation_currency').prop('disabled', true); // Disable the selector
                    $('#sales_quotation_currency').trigger('change');
                    let sales_quotation_sr_by = document.getElementById('sales_quotation_sr_by');
                    sales_quotation_sr_by.value = data[0].enquiry_source;
                    sales_quotation_sr_by.disabled = true;
                },
                error: function(error) {
                    console.error('AJAX request failed: ' + error);
                }
            });


        }

        function editproduct(id) {
            console.log(id);

            document.getElementById('productPopup').style.display = 'block';

            document.querySelector('input[name="quotation_Product_id"]').value = id;
        }
        $(document).ready(function() {


            if (window.location.href.includes("sales")) {
                const sales = document.querySelector(".sales");
                sales.classList.add("active");

                const customerLink = document.querySelector('a[href="/erp/sales/sales_quotation.php"]');
                if (customerLink) {
                    customerLink.classList.add('font-bold', 'text-black');
                }
            }
        });
    </script>
</body>

</html>