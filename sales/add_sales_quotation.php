    <?php

    @include '../include/function.php';

    if (isset($_GET['quotation_id'])) {

        $quotationquery = mysqli_query($conn, "SELECT * FROM quotation where quotation_id = " . $_GET['quotation_id']);
        $quotationdata = mysqli_fetch_array($quotationquery);
        // print_r($quotationdata);
        // die();

        // print_r( $qsales_quotation_product_id);
        // die();
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
                                <input type="text" id="qsales_quotation_number" placeholder="Quotation number" name="qsales_quotation_number" value="<?php echo isset($_GET['quotation_id']) ? $quotationdata['qsales_quotation_number'] : '' ?>" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                                <input type="hidden" name="quotation_id" value="<?php echo isset($_GET['quotation_id']) ? $quotationdata['quotation_id'] : '' ?>" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">

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
                                <input type="text" id="qsales_quotation_subject" placeholder="Quotation Subject" value="<?php echo isset($_GET['quotation_id']) ? $quotationdata['qsales_quotation_subject'] : '' ?>" name="qsales_quotation_subject" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                            </div>
                            <div>
                                <label for="sales_quotation_contact" class="text-gray-700 font-semibold">Contact</label>
                                <input name="sales_quotation_contact" id="sales_quotation_contact" class="border rounded-sm outline-none mt-2 p-2 w-full focus:ring focus:ring-blue-400" value="<?php echo isset($_GET['quotation_id']) ? $quotationdata['sales_quotation_contact'] : '' ?>" placeholder="Contact" />
                            </div>
                            <div>
                                <label for="sales_quotation_version" class="text-gray-700 font-semibold">Version</label>
                                <input type="text" id="sales_quotation_version" placeholder="Version" name="sales_quotation_version" value="<?php echo isset($_GET['quotation_id']) ? $quotationdata['sales_quotation_version'] : '' ?>" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                            </div>
                        </div>
                        <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 p-4 pt-0 gap-4">
                            <div>
                                <label for="sales_quotation_valid_till" class="text-gray-700 font-semibold">Valid Till</label>
                                <input type="date" id="sales_quotation_valid_till" name="sales_quotation_valid_till" value="<?php echo isset($_GET['quotation_id']) ? $quotationdata['sales_quotation_valid_till'] : '' ?>" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2" style="color: #999999;">
                            </div>
                            <div>
                                <label for="sales_quotation_currency" class="text-gray-700 font-semibold">Currency</label>

                                <input type="text" id="sales_quotation_currency" placeholder="Currency" value="<?php echo isset($_GET['quotation_id']) ? $quotationdata['sales_quotation_currency'] : '' ?>" name="sales_quotation_currency" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">

                            </div>
                            <div>
                                <label for="quotation_type" class="text-gray-700 font-semibold">Quotation Type</label>
                                <div class="flex items-center mt-4">
                                    <div class="flex items-center mr-3">
                                        <input type="radio" id="domestic" name="sales_quotation_type" class="border rounded-sm outline-none p-3 mr-2 w-5 h-5" value="Domestic">
                                        <label for="domestic" class="text-gray-400 font-normal">Domestic</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" id="export" name="sales_quotation_type" class="border rounded-sm outline-none p-2 mr-2 w-5 h-5" value="Export">
                                        <label for="export" class="text-gray-400 font-normal mr-auto">Export</label>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="sales_quotation_sr_by" class="text-gray-700 font-semibold">Source / Referred By</label>
                                <input type="text" id="sales_quotation_sr_by" value="<?php echo isset($_GET['quotation_id']) ? $quotationdata['sales_quotation_sr_by'] : '' ?>" placeholder="Source / Referred By" name="sales_quotation_sr_by" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                            </div>
                        </div>
                        <div class="grid p-4 pt-0 gap-4">
                            <div class="col-span-full">
                                <label for="sales_quotation_description" class="text-gray-700 font-semibold">Description</label>
                                <input type="text" id="sales_quotation_description" placeholder="Description" value="<?php echo isset($_GET['quotation_id']) ? $quotationdata['sales_quotation_description'] : '' ?>" name="sales_quotation_description" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
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
                                    <td class="px-6 py-4 whitespace-no-wrap"><input type="checkbox" name="terms_condition[]" value="<?php echo $terms_conditiondata['Terms_Condition_id']; ?>" <?php echo  isset($quotationdata['qsales_quotation_product_turm']) ? $quotationdata['qsales_quotation_product_turm'] == $terms_conditiondata['Terms_Condition_id'] ? "checked" : "" : ""  ?>></td>
                                    <td class="px-6 py-4 whitespace-no-wrap"><?php echo $count; ?></td>
                                    <td class="px-6 py-4 whitespace-no-wrap"><?php echo $terms_conditiondata['Terms_Condition_description']; ?></td>
                                    <td class="px-6 py-4 whitespace-no-wrap"><?php echo $terms_conditiondata['Terms_Condition_Condition']; ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>

                <div class="flex flex-wrap gap-5">
                    <button class="text-white text-sm px-4 py-2 w-28" style="background-color: #007bff;" name="<?php echo isset($_GET['quotation_id']) ? "edit_sales_quotation" : "add_sales_quotation" ?>"><?php echo isset($_GET['quotation_id']) ? "Update" : "Save" ?></button>
                    <button class="text-white text-sm px-4 py-2" style="background-color: #007bff;">Save & Preview</button>
                    <button class="text-white text-sm px-4 py-2" style="background-color: #007bff;">Save & Create Sales Order</button>
                    <a href="sales_quotation.php" class="bordertext-sm px-4 py-2 w-20" style="color: #007bff; border: 1px solid #007bff;">Cancel</a>
                </div>
            </div>
        </form>
        <div class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 p-4 transition-all duration-300" style="z-index: 99;" id="productPopup" style="display: BLOCK;">
            <div id="bw_popup" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-sm shadow-lg" style="width:1100px;">

                <!-- <h2 class="text-gray-800 font-semibold p-4 text-xl">Terms Condition</h2> -->
                <div class="flex justify-end">
                    <svg id="closeCCategory" onclick="closeModal('productPopup')" class="cursor-pointer mt-3 mr-2 close-button" width="35" height="35" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M37.5 12.5L12.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M12.5 12.5L37.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>

                </div>
                <form class="p-4" name="editproductform" action="../include/function.php" id="terms_conditionform">

                    <div class="grid lg:grid-cols-2 md:grid-cols-1 sm:grid-cols-1 p-4 gap-4">
                        <div>
                            <label for="Product_Description" class="text-gray-700 font-semibold">Product Description</label>
                            <input type="text" name="Product_Description" id="Product_Description" placeholder="Product Description" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                        </div>
                        <div>
                            <label for="part_number" class="text-gray-700 font-semibold">Part Number</label>
                            <input type="text" name="part_number" id="part_number" placeholder="part number" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                        </div>

                        <input type="hidden" name="quotation_Product_id" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                    </div>
                    <div class="grid lg:grid-cols-4 md:grid-cols-1 sm:grid-cols-1 p-4 gap-4">
                        <div>
                            <label for="hsn_code" class="text-gray-700 font-semibold">HSN Code</label>
                            <input type="text" name="hsn_code" id="hsn_code" placeholder="HSN Code" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                        </div>
                        <div>
                            <label for="quantity" class="text-gray-700 font-semibold">Quantity</label>
                            <input type="text" name="quantity" id="quantity" placeholder="Quantity" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2" onchange="calculatamount()">
                        </div>
                        <div>
                            <label for="rate" class="text-gray-700 font-semibold">Rate</label>
                            <input type="text" name="rate" id="rate" placeholder="Rate" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2" onchange="calculatamount()">
                        </div>
                        <div>
                            <label for="amount" class="text-gray-700 font-semibold">Amount</label>
                            <input type="text" name="amount" id="amount" placeholder="amount" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                        </div>

                        <input type="hidden" name="Product_id" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                    </div>


                    <div class="grid lg:grid-cols-4 md:grid-cols-1 sm:grid-cols-1 p-4 gap-4" class="gsts" id="gsts">
                        <div>
                            <label for="customer_type" class="text-gray-700 font-semibold">CGST</label>
                            <select name="cgst" id="cgst" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important" onchange="calculattax()">
                                <option value="">CGST</option>
                                <option value="5">5%</option>
                                <option value="12">12%</option>
                                <option value="18">18%</option>
                                <option value="28">28%</option>


                            </select>
                        </div>
                        <div>
                            <label for="customer_type" class="text-gray-700 font-semibold">SGST</label>
                            <select name="SGST" id="SGST" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important" onchange="calculattax()">
                                <option value="">SGST</option>
                                <option value="5">5%</option>
                                <option value="12">12%</option>
                                <option value="18">18%</option>
                                <option value="28">28%</option>



                            </select>
                        </div>
                        <div>
                            <label for="customer_type" class="text-gray-700 font-semibold">IGST</label>
                            <select name="IGST" id="IGST" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important" onchange="calculattax()">
                                <option value="">IGST</option>
                                <option value="5">5%</option>
                                <option value="12">12%</option>
                                <option value="18">18%</option>
                                <option value="28">28%</option>

                            </select>
                        </div>
                        <div>
                            <label for="customer_type" class="text-gray-700 font-semibold">Tax Amount</label>
                            <input type="text" name="tax_amount" id="tax_amount" placeholder="Tax Amount" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                        </div>

                        <input type="hidden" name="Product_id" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                    </div>
                    <div class="flex items-center justify-start gap-4 mt-10 ">
                        <button class="text-white text-sm px-4 py-2 w-28" onclick="saveditproduct()" type="button" id="openButton" style="background-color: #007bff;">Save</button>
                        <button type="button" class="border bg-white text-sm px-4 py-2 w-28" onclick="closeModal('productPopup')" style="color: #007bff; border: 1px solid #007bff;">Cancel</button>

                </form>
            </div>
        </div>
        <script src="../assets/js/script.js"></script>
        <script>
            function numberToWords(n) {
                const units = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
                const tens = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

                if (n < 20) return units[n];
                const digit = n % 10;
                if (n < 100) return tens[Math.floor(n / 10)] + (digit ? ' ' + units[digit] : '');
                if (n < 1000) return units[Math.floor(n / 100)] + ' hundred' + (n % 100 === 0 ? '' : ' ' + numberToWords(n % 100));
                return numberToWords(Math.floor(n / 1000)) + ' thousand' + (n % 1000 !== 0 ? ' ' + numberToWords(n % 1000) : '');
            }

            $('input[name="sales_quotation_type"]').change(function() {
                if ($(this).val() === 'Domestic') {
                    $('#gsts').show();
                } else {
                    table = document.getElementById('Producttable');
                    for (let i = 1; i < table.rows.length; i++) {
                        table.rows[i].cells[8].innerHTML = '0';
                        table.rows[i].cells[9].innerHTML = '0';
                    }

                    $('#gsts').hide();
                }
            });

            $(document).ready(function() {

                let tax_amount = document.getElementById('tax_amount');
                tax_amount.readOnly = true;
                tax_amount.style.backgroundColor = '#eeeeee';
                let amount = document.getElementById('amount');
                amount.readOnly = true;
                amount.style.backgroundColor = '#eeeeee';

                console.log($('input[name="sales_quotation_type"]').val());

                document.querySelector('input[value="Domestic"]').checked = true;




                $('#headerCheckbox').click(function() {
                    $('input[name="terms_condition[]"]').prop('checked', this.checked);
                });

                $('#termheaderCheckbox').click(function() {
                    $('input[name="Productheadercheckbox[]"]').prop('checked', this.checked);
                });
            });

            var currency;

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

                        currency = data[0].enquiry_currency;
                        $('#sales_quotation_currency').val(null); // Deselect all options
                        $('#sales_quotation_currency').prop('disabled', false); // Disable the selector
                        $('#sales_quotation_currency').trigger('change');
                        // let sales_quotation_sr_by = document.getElementById('sales_quotation_sr_by');
                        // sales_quotation_sr_by.value = "";
                        // sales_quotation_sr_by.readOnly = true;
                    },
                    error: function(error) {
                        console.error('AJAX request failed: ' + error);
                    }
                });

            }

            function getcontactdata(e) {
                console.log(e);
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
                        // Clear all rows in the table
                        for (let i = table.rows.length - 1; i > 0; i--) {
                            table.deleteRow(i);
                        }


                        data.forEach((item, index) => {
                            let row = table.insertRow(-1);

                            let quantity = Number(item.enquiry_p_product_quantity);
                            let rate = Number(item.enquiry_p_product_rate);
                            let amount = quantity * rate;
                            let cgst = parseInt(item.enquiry_p_cgst);
                            let sgst = parseInt(item.enquiry_p_sgst);
                            let igst = parseInt(item.enquiry_p_igst);
                            let totalTaxPercentage = cgst + sgst + igst;
                            let taxAmount = (totalTaxPercentage / 100) * amount;

                            row.innerHTML = `
    <td class="px-6 py-4 whitespace-no-wrap" ><input type="checkbox" name="Productheadercheckbox[]" value="${item.enquiry_p_id}"></td>
    <td class="px-6 py-4 whitespace-no-wrap">${index + 1}</td>
    <td class="px-6 py-4 whitespace-no-wrap" colspan="2">${item.enquiry_p_product_description}</td>
    <td   class="px-6 py-4 whitespace-no-wrap" >${item.enquiry_p_part_number}</td>
    <td   class="px-6 py-4 whitespace-no-wrap" >${item.enquiry_p_product_hsn_code}</td>
    <td   class="px-6 py-4 whitespace-no-wrap" >${item.enquiry_p_product_quantity}</td>
    <td   class="px-6 py-4 whitespace-no-wrap" >${item.enquiry_p_product_rate}</td>
    <td   class="px-6 py-4 whitespace-no-wrap" >${item.enquiry_p_product_amount}</td>
    <td class="px-6 py-4 whitespace-no-wrap">${totalTaxPercentage}</td>
    <td   class="px-6 py-4 whitespace-no-wrap" >${taxAmount}</td>
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

    <td colspan="4" class="px-6 py-4 whitespace-no-wrap">
    Amount In Words: <b> ${numberToWords(netAmount.toFixed(2))} ${currency}  Only</b>
    </td>
    <td colspan="2" class="px-6 py-4 whitespace-no-wrap">
     Total Quantity NOs. <b>${totalQuantity}</b>
    </td>
    <td colspan="2" class="px-6 py-4 whitespace-no-wrap">
    Total <b>${totalAmount.toFixed(2)}</b>
    </td>
    <td colspan="2" class="px-6 py-4 whitespace-no-wrap">
    Tax Amount <b>${totalTaxAmount.toFixed(2)}</b>
    </td>
    <td colspan="2" class="px-6 py-4 whitespace-no-wrap">
        Net Amount (${currency}) <b> ${netAmount.toFixed(2)}</b>
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
                        // console.log(data[0]);
                        let sales_quotation_contact = document.getElementById('sales_quotation_contact');
                        sales_quotation_contact.value = data[0].first_name + ' ' + data[0].last_name;
                        sales_quotation_contact.readOnly = true;
                        sales_quotation_contact.style.backgroundColor = '#eeeeee';

                        let sales_quotation_currency = document.getElementById('sales_quotation_currency');
                        sales_quotation_currency.value = data[0].enquiry_currency;
                        sales_quotation_currency.readOnly = true;
                        sales_quotation_currency.style.backgroundColor = '#eeeeee';

                        let sales_quotation_sr_by = document.getElementById('sales_quotation_sr_by');
                        sales_quotation_sr_by.value = data[0].enquiry_source;
                        sales_quotation_sr_by.readOnly = true;
                        sales_quotation_sr_by.style.backgroundColor = '#eeeeee';
                    },
                    error: function(error) {
                        console.error('AJAX request failed: ' + error);
                    }
                });


            }

            function editproduct(id) {
                // console.log(id);
                var id = id;
                document.getElementById('productPopup').style.display = 'block';

                document.querySelector('input[name="quotation_Product_id"]').value = id;

                // Fetch data using AJAX
                $.ajax({
                    url: '../include/function.php',
                    method: 'GET',
                    data: {
                        ProductId: id
                    },
                    success: function(response) {
                        let data = JSON.parse(response);
                        // console.log(data)
                        // Add data to input fields in the productPopup div
                        document.querySelector('input[name="Product_Description"]').value = data[0].enquiry_p_product_description;
                        document.querySelector('input[name="part_number"]').value = data[0].enquiry_p_part_number;
                        document.querySelector('input[name="hsn_code"]').value = data[0].enquiry_p_product_hsn_code;
                        document.querySelector('input[name="quantity"]').value = data[0].enquiry_p_product_quantity;
                        document.querySelector('input[name="rate"]').value = data[0].enquiry_p_product_rate;

                        let cgstSelect = document.getElementById('cgst');
                        let cgstValue = parseFloat(data[0].enquiry_p_cgst);

                        if (cgstValue !== 0) {
                            cgstSelect.value = cgstValue;
                        }

                        let sgstSelect = document.getElementById('SGST');
                        let sgstValue = parseFloat(data[0].enquiry_p_sgst);

                        if (sgstValue !== 0) {
                            sgstSelect.value = sgstValue;
                        }

                        let igstSelect = document.getElementById('IGST');
                        let igstValue = parseFloat(data[0].enquiry_p_igst);

                        if (igstValue !== 0) {
                            igstSelect.value = igstValue;
                        }

                        calculatamount();
                        calculattax();
                    },
                    error: function(error) {
                        console.error('AJAX request failed: ' + error);
                    }
                });
            }

            function calculatamount() {
                var quantity = document.getElementById('quantity').value;
                var rate = document.getElementById('rate').value;
                var amount = quantity * rate;
                document.getElementById('amount').value = amount;
            }

            function calculattax() {

                var amount = parseFloat(document.getElementById('amount').value);
                var cgst = parseFloat(document.getElementById('cgst').value);
                var sgst = parseFloat(document.getElementById('SGST').value);
                var igst = parseFloat(document.getElementById('IGST').value);

                // Check if the values are null or NaN and assign default values
                amount = isNaN(amount) ? 1 : amount;
                cgst = isNaN(cgst) ? 0 : cgst;
                sgst = isNaN(sgst) ? 0 : sgst;
                igst = isNaN(igst) ? 0 : igst;

                var tax_amount = (amount * (cgst / 100)) + (amount * (sgst / 100)) + (amount * (igst / 100));
                console.log(tax_amount);
                document.getElementById('tax_amount').value = tax_amount;
            }

            function saveditproduct() {
                const formData = new FormData(document.querySelector('form[name="editproductform"]'));
                formData.append('editproduct', 'true');

                $.ajax({
                    url: '../include/function.php',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // console.log(response);
                    },
                    error: function(error) {
                        console.error('AJAX request failed: ', error);
                    }
                });
                closeModal('productPopup');
                let sales_quotation_enquiry = document.getElementById('sales_quotation_enquiry').value;

                getcontactdata(sales_quotation_enquiry);

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
        <?php

        if (isset($_GET['quotation_id'])) {
            $qsales_quotation_product_id = explode(',', $quotationdata['qsales_quotation_product_id']);
            // getselecterdata($quotationdata['sales_quotation_cc_name'], '#sales_quotation_cc_name');
            echo "<script>


            $('#sales_quotation_cc_name').val('" . $quotationdata['sales_quotation_cc_name'] . "'); 
            $('#sales_quotation_cc_name').trigger('change');

            setTimeout(function() {
                $('#sales_quotation_enquiry').val('" . $quotationdata['sales_quotation_enquiry'] . "'); 
                $('#sales_quotation_enquiry').trigger('change');
            }, 200);
               



                document.querySelector('input[value=\"" . $quotationdata['sales_quotation_type'] . "\"]').checked = true;
                document.querySelector('input[value=\"" . $quotationdata['sales_quotation_type'] . "\"]').checked = true;
                setTimeout(function() {
                ";

            // Select checkb    oxes based on $qsales_quotation_product_id array
            foreach ($qsales_quotation_product_id as $productId) {
                echo "
                    document.querySelector('input[name=\"Productheadercheckbox[]\"][value=\"" . $productId . "\"]').checked = true;
                    ";
            }

            echo "
        }, 100); 
            </script>";
        }
        ?>
    </body>

    </html>