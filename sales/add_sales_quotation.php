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
                        <thead style="background-color: #F9FAFF; color:#031A61;">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm leading-4 font-medium  tracking-wider">
                                    <input type="checkbox" name="" id="" checked disabled>
                                </th>
                                <th class="px-6 py-3 text-left text-sm leading-4 font-medium  tracking-wider">
                                    #
                                </th>
                                <th class="px-6 py-3 text-left text-sm leading-4 font-medium  tracking-wider">
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
            <div class="flex flex-wrap gap-5">
                <button class="text-white text-sm px-4 py-2 w-28" style="background-color: #007bff;" name="add_sales_quotation">Save</button>
                <button class="text-white text-sm px-4 py-2" style="background-color: #007bff;">Save & Preview</button>
                <button class="text-white text-sm px-4 py-2" style="background-color: #007bff;">Save & Create Sales Order</button>
                <button class="bordertext-sm px-4 py-2 w-28" style="color: #007bff; border: 1px solid #007bff;">Cancel</button>
            </div>
        </div>
    </form>

    <script src="../assets/js/script.js"></script>
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
                    console.log(response);

                    let data = JSON.parse(response);
                    let select = document.getElementById('sales_quotation_enquiry');
                    data.forEach(item => {
                        let option = document.createElement('option');
                        option.value = item.enquiry_id;
                        option.text = item.enquiry_name;
                        select.appendChild(option);
                    });


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

                    data.forEach((item, index) => {
                        let row = table.insertRow(-1);
                        row.innerHTML = `
        <td class="px-6 py-4 whitespace-no-wrap"><input type="radio" ></td>
        <td class="px-6 py-4 whitespace-no-wrap">${index + 1}</td>
        <td class="px-6 py-4 whitespace-no-wrap">${item.enquiry_p_product_description}</td>
        <td   class="px-6 py-4 whitespace-no-wrap" >${item.enquiry_p_part_number}</td>
        <td   class="px-6 py-4 whitespace-no-wrap" >${item.enquiry_p_product_hsn_code}</td>
        <td   class="px-6 py-4 whitespace-no-wrap" >${item.enquiry_p_product_quantity}</td>
        <td   class="px-6 py-4 whitespace-no-wrap" >${item.enquiry_p_product_rate}</td>
        <td   class="px-6 py-4 whitespace-no-wrap" >${item.enquiry_p_product_amount}</td>
        <td   class="px-6 py-4 whitespace-no-wrap" >Tax</td>
        <td   class="px-6 py-4 whitespace-no-wrap" >Tax Amount</td>
        <td   class="px-6 py-4 whitespace-no-wrap" >Action</td>
    `;
                    });
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
                    $('#sales_quotation_currency').val(data[0].enquiry_currency); // Select by value
                    $('#sales_quotation_currency').trigger('change');
                    let sales_quotation_sr_by = document.getElementById('sales_quotation_sr_by');
                    sales_quotation_sr_by   .value = data[0].enquiry_source;
                },
                error: function(error) {
                    console.error('AJAX request failed: ' + error);
                }
            });


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