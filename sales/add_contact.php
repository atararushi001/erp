<?php
@include '../include/config.php';
@include '../include/function.php';

if (isset($_GET['contact_quotation_id'])) {

    $contact_quotationquery = mysqli_query($conn, "SELECT * FROM `contact_quotation` where contact_quotation_id = " . $_GET['contact_quotation_id']);
    $contact_quotationdata = mysqli_fetch_array($contact_quotationquery);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <?php include '../include/script.php' ?>

    <style>
        #prefixdataPopup,
        #job_titledataPopup,
        #departmentdataPopup,
        #communication_preferencedataPopup {
            display: none;
            z-index: 99;
        }

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
            $("#company_name").select2({
                width: '100%',
                placeholder: 'Add Company Name / Customer Name',
                language: {
                    noResults: function() {
                        return $("<button class='w-full p-2 text-center text-white' onclick=\"location.href='add_customer.php'\" style='background-color: #007bff;'>Add Company Name / Customer Name</button>");

                    }
                }
            });
            $("#prefix").select2({
                width: '100%',
                placeholder: 'Add prefix',
                // language: {
                //     noResults: function() {
                //         return $("<button class='w-full p-2 text-center text-white' onclick=\"openModal('prefixdataPopup','#prefix')\"  style='background-color: #007bff;'>Add Enquiry</button>");
                //     }
                // }
            });
            $("#job_title").select2({
                width: '100%',
                placeholder: 'Add Branch / Warehouse',
                language: {
                    noResults: function() {
                        return $("<button class='w-full p-2 text-center text-white' onclick=\"openModal('job_titledataPopup','#job_title')\"  style='background-color: #007bff;'>Add Branch / Warehouse</button>");
                    }
                }
            });
            $("#department").select2({
                width: '100%',
                placeholder: 'Add Contact',
                language: {
                    noResults: function() {
                        return $("<button class='w-full p-2 text-center text-white' onclick=\"openModal('departmentdataPopup','#department')\" style='background-color: #007bff;'>Add Contact</button>");
                    }
                }
            });
            $("#communication_preference").select2({
                width: '100%',
                placeholder: 'Add Contact',
                language: {
                    noResults: function() {
                        return $("<button class='w-full p-2 text-center text-white' onclick=\"openModal('communication_preferencedataPopup','#communication_preference')\" style='background-color: #007bff;'>Add Contact</button>");
                    }
                }
            });

            $("#shipping_country").select2({});
            $("#shipping_state").select2({});
            $("#shipping_city").select2({});

            $("#billing_country").select2({});
            $("#billing_state").select2({});
            $("#billing_city").select2({});
        })
    </script>
</head>

<body>
    <?php include '../include/sidebar.php' ?>
    <?php include '../include/header.php' ?>

    <form action="../include/function.php" method="post" enctype="multipart/form-data">
        <div id="mydiv" class="max-w-full mx-auto mt-20 ml-16 p-4 text-sm transition-all duration-300">
            <div class="mb-3">
                <h1 class="text-xl font-semibold text-custom-blue">Add Contact</h1>
            </div>
            <div>
                <div class="bg-white rounded-sm shadow-md mb-4">
                    <div class="w-full border-b">
                        <h2 class="text-gray-800 font-semibold p-4 text-lg">General Information</h3>
                    </div>
                    <div class="grid lg:grid-cols-4 md:grid-cols-1 sm:grid-cols-1 p-4 gap-4">
                        <div>
                            <label for="company_name" class="text-gray-700 font-semibold">Company Name</label>
                            <select name="company_name" id="company_name" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important">
                                <option value="">Company name</option>
                                <?php getoptionwithstatus('customer', 'customer_id', 'customer_company_name', 'customer_status'); ?>
                            </select>
                        </div>
                        <div>
                            <label for="prefix" class="text-gray-700 font-semibold">Prefix</label>
                            <select name="prefix" id="prefix" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important">

                                <option value="Select Prefix">Select Prefix</option>
                                <option value="Dr." <?php echo isset($_GET['contact_quotation_id']) ?  $contact_quotationdata['prefix'] == "Dr" ? "selected" :  " " : "" ?>>Dr.</option>
                                <option value="Mr." <?php echo isset($_GET['contact_quotation_id']) ?  $contact_quotationdata['prefix'] == "Mr." ? "selected" :  " " : "" ?>>Mr.</option>
                                <option value="Mrs." <?php echo isset($_GET['contact_quotation_id']) ?  $contact_quotationdata['prefix'] == "Mrs." ? "selected" :  " " : ""  ?>>Mrs.</option>
                                <option value="Ms." <?php echo isset($_GET['contact_quotation_id']) ?  $contact_quotationdata['prefix'] == "Ms." ? "selected" :  " " : ""  ?>>Ms.</option>
                                <option value="Pro." <?php echo isset($_GET['contact_quotation_id']) ?  $contact_quotationdata['prefix'] == "Pro." ? "selected" :  " " : "" ?>>Pro.</option>
                                <?php    //   getoptionwithstatus('prefix', 'prefix_id', 'prefix_name', 'prefix_status'); 
                                ?>

                            </select>
                        </div>
                        <div>
                            <label for="first_name" class="text-gray-700 font-semibold">First Name</label>
                            <input type="text" id="first_name" placeholder="First Name" name="first_name" value="<?php echo isset($_GET['contact_quotation_id']) ? $contact_quotationdata['first_name'] : "" ?>" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                        </div>
                        <div>
                            <label for="last_name" class="text-gray-700 font-semibold">Last Name</label>
                            <input type="text" id="last_name" placeholder="Last Name" name="last_name" value="<?php echo isset($_GET['contact_quotation_id']) ?  $contact_quotationdata['last_name'] : "" ?>" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                        </div>
                        <div>
                            <label for="email1" class="text-gray-700 font-semibold">Email 1</label>
                            <input type="text" id="email1" placeholder="Email 1" name="email1" value="<?php echo isset($_GET['contact_quotation_id']) ?  $contact_quotationdata['email1'] : "" ?>" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                        </div>
                        <div>
                            <label for="email2" class="text-gray-700 font-semibold">Email 2</label>
                            <input type="text" id="email2" placeholder="Email 2" name="email2" value="<?php echo isset($_GET['contact_quotation_id']) ?  $contact_quotationdata['email2'] : "" ?>" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                        </div>
                        <div>
                            <label for="mobile_no1" class="text-gray-700 font-semibold">Mobile 1</label>
                            <input type="text" id="mobile_no1" placeholder="Mobile 1" name="mobile_no1" value="<?php echo isset($_GET['contact_quotation_id']) ?  $contact_quotationdata['mobile_no1'] : "" ?>" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                        </div>
                        <div>
                            <label for="mobile_no2" class="text-gray-700 font-semibold">Mobile 2</label>
                            <input type="text" id="mobile_no2" placeholder="Mobile 2" name="mobile_no2" value="<?php echo isset($_GET['contact_quotation_id']) ?  $contact_quotationdata['mobile_no2'] : "" ?>" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                        </div>
                        <div>
                            <label for="job_title" class="text-gray-700 font-semibold">Job Title</label>
                            <select name="job_title" id="job_title" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important">
                                <option value="Job Title">Job Title</option>
                                <?php getoptionwithstatus('job_title', 'job_title_id', 'job_title_name', 'job_title_status'); ?>

                            </select>
                        </div>
                        <div>
                            <label for="department" class="text-gray-700 font-semibold">Department</label>
                            <select name="department" id="department" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important">
                                <option value="Branch/Warehouse">Department</option>
                                <?php getoptionwithstatus('department', 'department_id', 'department_name', 'department_status'); ?>

                            </select>
                        </div>
                        <div>
                            <label for="skype_id" class="text-gray-700 font-semibold">Skypre ID</label>
                            <input type="text" id="skype_id" placeholder="Skype ID" name="skype_id" value="<?php echo isset($_GET['contact_quotation_id']) ? $contact_quotationdata['skype_id'] : "" ?>" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                        </div>
                        <div>
                            <label for="communication_preference" class="text-gray-700 font-semibold">Communication Preference</label>
                            <select name="communication_preference" id="communication_preference" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important">
                                <option value="Branch/Warehouse">Communication Preference</option>
                                <?php getoptionwithstatus('communication_preference', 'communication_preference_id', 'communication_preference_name', 'communication_preference_status'); ?>

                            </select>
                        </div>
                    </div>
                    <div class="grid lg:grid-cols-2 md:grid-cols-1 sm:grid-cols-1 p-4 pt-0 gap-4">
                        <div>
                            <label for="website_link" class="text-gray-700 font-semibold">Website Link</label>
                            <input type="text" id="website_link" placeholder="Website Link" name="website_link" value="<?php echo isset($_GET['contact_quotation_id']) ?  $contact_quotationdata['website_link'] : "" ?>" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                        </div>
                        <div>
                            <label for="linkedln_profile" class="text-gray-700 font-semibold">Linkedln Profile (URL/Details)</label>
                            <input type="text" id="linkedln_profile" placeholder="Linkedln Profile (URL/Details)" value="<?php echo isset($_GET['contact_quotation_id']) ? $contact_quotationdata['linkedln_profile'] : "" ?>" name="linkedln_profile" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-full mb-4">
                <div class="bg-white rounded-sm shadow-md">
                    <div class="w-full border-b flex">
                        <h2 class="justify-start text-gray-800 font-semibold p-4 text-lg">Shipping Address Information</h3>
                    </div>
                    <div class="grid lg:grid-cols-4 md:grid-cols-1 sm:grid-cols-1 p-4 gap-4">
                        <div class="col-span-full">
                            <label for="shipping_address" class="text-gray-700 font-semibold">Address</label>
                            <input type="text" name="shipping_address" id="shipping_address" placeholder="Address" value="<?php echo isset($_GET['contact_quotation_id']) ?  $contact_quotationdata['shipping_address'] : "" ?>" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                        </div>
                    </div>
                    <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 p-4 pt-0 gap-4">
                        <div>
                            <label for="shipping_country" class="text-gray-700 font-semibold">Country</label>
                            <select name="shipping_country" id="shipping_country" class="select2-init border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important" onchange="fetchStates(this,<?php echo isset($_GET['contact_quotation_id']) ?   $contact_quotationdata['shipping_state'] : '' ?>)">
                                <option value="Country">Country</option>
                                <?php getoption('country', 'id', 'name'); ?>

                            </select>
                        </div>
                        <div>
                            <label for="shipping_state" class="text-gray-700 font-semibold">State</label>
                            <select name="shipping_state" id="shipping_state" onchange="fetchcity(this,<?php echo isset($_GET['contact_quotation_id']) ?  $contact_quotationdata['shipping_city'] : '' ?>)" class="select2-init border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important">
                                <option value="State">State</option>

                            </select>
                        </div>
                        <div>
                            <label for="shipping_city" class="text-gray-700 font-semibold">City</label>
                            <select name="shipping_city" id="shipping_city" class="select2-init border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important">
                                <option value="City">City</option>
                                <option value="Category 2">Category 2</option>
                                <option value="Category 3">Category 3</option>
                            </select>
                        </div>
                        <div>
                            <label for="shipping_postal_code" class="text-gray-700 font-semibold">Zip/Postal Code</label>
                            <input type="text" name="shipping_postal_code" id="shipping_postal_code" value="<?php echo isset($_GET['contact_quotation_id']) ? $contact_quotationdata['shipping_postal_code'] : "" ?>" placeholder="Zip/Postal Code" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-full mb-4">

                <input type="checkbox" class="ml-1" name="copycheckbox" id="copycheckbox" onclick="copyaddress(this)">
                <label class="justify-start text-gray-800 font-semibold  text-lg" for="copycheckbox">Copy billing address </label>
            </div>
            <div class="max-w-full mb-4">
                <div class="bg-white rounded-sm shadow-md">
                    <div class="w-full border-b flex">
                        <h2 class="justify-start text-gray-800 font-semibold p-4 text-lg">Billing Address Information</h3>
                    </div>
                    <div class="grid lg:grid-cols-4 md:grid-cols-1 sm:grid-cols-1 p-4 gap-4">
                        <div class="col-span-full">
                            <label for="billing_address" class="text-gray-700 font-semibold">Address</label>
                            <input type="text" name="billing_address" id="billing_address" value="<?php echo isset($_GET['contact_quotation_id']) ? $contact_quotationdata['billing_address'] : "" ?>" placeholder="Address" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                        </div>
                    </div>
                    <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 p-4 pt-0 gap-4">
                        <div>
                            <label for="billing_country" class="text-gray-700 font-semibold">Country</label>
                            <select name="billing_country" id="billing_country" class="select2-init border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important" onchange="fetchStates(this,<?php echo isset($_GET['contact_quotation_id']) ?   $contact_quotationdata['billing_state'] : '' ?>)">
                                <option value="Country">Country</option>
                                <?php getoption('country', 'id', 'name'); ?>

                            </select>
                        </div>
                        <div>
                            <label for="billing_state" class="text-gray-700 font-semibold">State</label>
                            <select name="billing_state" id="billing_state" class="select2-init border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important" onchange="fetchcity(this,<?php echo isset($_GET['contact_quotation_id']) ?  $contact_quotationdata['billing_city'] : '' ?>)">
                                <option value="State">State</option>

                            </select>
                        </div>
                        <div>
                            <label for="billing_city" class="text-gray-700 font-semibold">City</label>
                            <select name="billing_city" id="billing_city" class="select2-init border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important">
                                <option value="City">City</option>
                            </select>
                        </div>
                        <div>
                            <label for="billing_postal_code" class="text-gray-700 font-semibold">Zip/Postal Code</label>
                            <input type="text" name="billing_postal_code" id="billing_postal_code" value="<?php echo isset($_GET['contact_quotation_id']) ? $contact_quotationdata['billing_postal_code'] : "" ?>" placeholder="Zip/Postal Code" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-full mb-4">
                <div class="bg-white rounded-sm shadow-md">
                    <div class="w-full border-b flex">
                        <h2 class="justify-start text-gray-800 font-semibold p-4 text-lg">Additional Informations</h3>
                    </div>
                    <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 p-4 gap-4">
                        <div>
                            <label for="date_of_birth" class="text-gray-700 font-semibold">Date of Birth</label>
                            <input type="date" name="date_of_birth" id="date_of_birth" placeholder="Date of Birth" value="<?php echo isset($_GET['contact_quotation_id']) ? $contact_quotationdata['date_of_birth'] : "" ?>" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                        </div>
                        <div>
                            <label for="fax" class="text-gray-700 font-semibold">Fax</label>
                            <input type="text" name="fax" id="fax" placeholder="Fax" value="<?php echo isset($_GET['contact_quotation_id']) ? $contact_quotationdata['fax'] : "" ?>" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                        </div>
                        <div>
                            <label for="home_phone" class="text-gray-700 font-semibold">Home Phone</label>
                            <input type="text" name="home_phone" id="home_phone" value="<?php echo isset($_GET['contact_quotation_id']) ? $contact_quotationdata['home_phone'] : "" ?>" placeholder="Home Phone" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                        </div>
                        <div>
                            <label for="other_phone" class="text-gray-700 font-semibold">Other Phone</label>
                            <input type="text" name="other_phone" id="other_phone" placeholder="Other Phone" value="<?php echo isset($_GET['contact_quotation_id']) ? $contact_quotationdata['other_phone'] : "" ?>" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                        </div>
                    </div>

                </div>
            </div>
            <div class="flex flex-wrap gap-5">
                <button class="text-white text-sm px-4 py-2 w-28" style="background-color: #007bff;" value="<?php echo isset($_GET['contact_quotation_id']) ? $contact_quotationdata['contact_quotation_id'] : '' ?>"
                 name="<?php echo isset($_GET['contact_quotation_id']) ? 'update_sales_quotation_contact': 'add_sales_quotation_contact' ?>">Save</button>
              
                 <a name="cancel" href="contact.php" class="border bg-white text-sm px-8 py-2 w-28" style="color: #007bff; border: 1px solid #007bff;">Cancel</a>
                 <!-- <button class="bordertext-sm px-4 py-2 w-28" href="" style="color: #007bff; border: 1px solid #007bff;">Cancel</button> -->
            </div>
        </div>
    </form>

    <div class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 p-4 transition-all duration-300" style="    z-index: 99;" id="prefixdataPopup" style="display: BLOCK;">
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-sm shadow-lg" style="width: 600px;">
            <div class="flex justify-between border-b">
                <h2 class="text-gray-800 font-semibold p-4 text-xl">Create Prefix</h2>
                <svg id="closeCCategory" onclick="closeModal('prefixdataPopup')" class="cursor-pointer mt-3 mr-2 close-button" width="35" height="35" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M37.5 12.5L12.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M12.5 12.5L37.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </div>
            <form class="p-4" name="Prefixfrom" action="../include/function.php" id="Prefixfrom">
                <div>
                    <label for="prefixdata" class="text-gray-700 font-semibold">Prefix </label>
                    <input type="text" name="prefixdata" id="prefixdata" placeholder="Prefix" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                </div>
                <div class="flex items-center justify-start gap-4 mt-32">
                    <button class="text-white text-sm px-4 py-2 w-28" onclick="savedata('Prefixfrom','#prefix','prefixdata')" type="button" id="openButton" style="background-color: #007bff;">Save</button>
                    <button type="button" class="border bg-white text-sm px-4 py-2 w-28" onclick="closeModal('prefixdataPopup')" style="color: #007bff; border: 1px solid #007bff;">Cancel</button>
                </div>
            </form>
        </div>
    </div>


    <div class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 p-4 transition-all duration-300" style="    z-index: 99;" id="job_titledataPopup" style="display: BLOCK;">
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-sm shadow-lg" style="width: 600px;">
            <div class="flex justify-between border-b">
                <h2 class="text-gray-800 font-semibold p-4 text-xl">Create job_title</h2>
                <svg id="closeCCategory" onclick="closeModal('job_titledataPopup')" class="cursor-pointer mt-3 mr-2 close-button" width="35" height="35" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M37.5 12.5L12.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M12.5 12.5L37.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </div>
            <form class="p-4" name="job_titlefrom" action="../include/function.php" id="job_titlefrom">
                <div>
                    <label for="job_titledata" class="text-gray-700 font-semibold">job_title </label>
                    <input type="text" name="job_titledata" id="job_titledata" placeholder="job_title" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                </div>
                <div class="flex items-center justify-start gap-4 mt-32">
                    <button class="text-white text-sm px-4 py-2 w-28" onclick="savedata('job_titlefrom','#job_title','job_titledata')" type="button" id="openButton" style="background-color: #007bff;">Save</button>
                    <button type="button" class="border bg-white text-sm px-4 py-2 w-28" onclick="closeModal('job_titledataPopup')" style="color: #007bff; border: 1px solid #007bff;">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <div class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 p-4 transition-all duration-300" style="    z-index: 99;" id="departmentdataPopup" style="display: BLOCK;">
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-sm shadow-lg" style="width: 600px;">
            <div class="flex justify-between border-b">
                <h2 class="text-gray-800 font-semibold p-4 text-xl">Create department</h2>
                <svg id="closeCCategory" onclick="closeModal('departmentdataPopup')" class="cursor-pointer mt-3 mr-2 close-button" width="35" height="35" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M37.5 12.5L12.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M12.5 12.5L37.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </div>
            <form class="p-4" name="departmentdatafrom" action="../include/function.php" id="departmentdatafrom">
                <div>
                    <label for="departmentdata" class="text-gray-700 font-semibold">department </label>
                    <input type="text" name="departmentdata" id="departmentdata" placeholder="department" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                </div>
                <div class="flex items-center justify-start gap-4 mt-32">
                    <button class="text-white text-sm px-4 py-2 w-28" onclick="savedata('departmentdatafrom','#department','departmentdata')" type="button" id="openButton" style="background-color: #007bff;">Save</button>
                    <button type="button" class="border bg-white text-sm px-4 py-2 w-28" onclick="closeModal('departmentdataPopup')" style="color: #007bff; border: 1px solid #007bff;">Cancel</button>
                </div> 
            </form>
        </div>
    </div>

    <div class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 p-4 transition-all duration-300" style="    z-index: 99;" id="communication_preferencedataPopup" style="display: BLOCK;">
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-sm shadow-lg" style="width: 600px;">
            <div class="flex justify-between border-b">
                <h2 class="text-gray-800 font-semibold p-4 text-xl">Create department</h2>
                <svg id="closeCCategory" onclick="closeModal('communication_preferencedataPopup')" class="cursor-pointer mt-3 mr-2 close-button" width="35" height="35" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M37.5 12.5L12.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M12.5 12.5L37.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </div>
            <form class="p-4" name="communication_preferencedatafrom" action="../include/function.php" id="communication_preferencedatafrom">
                <div>
                    <label for="communication_preferencedata" class="text-gray-700 font-semibold">communication_preference </label>
                    <input type="text" name="communication_preferencedata" id="communication_preferencedata" placeholder="communication_preference" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                </div>
                <div class="flex items-center justify-start gap-4 mt-32">
                    <button class="text-white text-sm px-4 py-2 w-28" onclick="savedata('communication_preferencedatafrom','#communication_preference','communication_preferencedata')" type="button" id="openButton" style="background-color: #007bff;">Save</button>
                    <button type="button" class="border bg-white text-sm px-4 py-2 w-28" onclick="closeModal('communication_preferencedataPopup')" style="color: #007bff; border: 1px solid #007bff;">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <script src="../assets/js/script.js"></script>
    <script>
        $(document).ready(function() {
            if (window.location.href.includes("sales")) {
                const sales = document.querySelector(".sales");
                sales.classList.add("active");

                const customerLink = document.querySelector('a[href="/erp/sales/contact.php"]');
                if (customerLink) {
                    customerLink.classList.add('font-bold', 'text-black');
                }
            }
        });

        function fetchStates(countrySelect) {
            const selectedCountry = countrySelect.value;
            const stateSelect = countrySelect.parentElement.nextElementSibling;

            const stateSelectElement = stateSelect.querySelector('select');
            console.log(stateSelectElement.id);
            $.ajax({
                url: '../include/function.php',
                method: 'GET',
                data: {
                    country: selectedCountry
                },
                success: function(response) {


                    stateSelectElement.innerHTML = response;
                },
                error: function(error) {
                    console.error('AJAX request failed: ' + error);
                }
            });
        }

        function fetchStates(countrySelect, data) {
            const selectedCountry = countrySelect.value;
            const stateSelect = countrySelect.parentElement.nextElementSibling;

            const stateSelectElement = stateSelect.querySelector('select');

            $.ajax({
                url: '../include/function.php',
                method: 'GET',
                data: {
                    country: selectedCountry
                },
                success: function(response) {


                    stateSelectElement.innerHTML = response;
                    $('#' + stateSelectElement.id).val(data);
                    $('#' + stateSelectElement.id).trigger('change');
                },
                error: function(error) {
                    console.error('AJAX request failed: ' + error);
                }
            });
        }
     

        function fetchcity(stateSelect) {



            const selectedstate = stateSelect.value;
            const citySelect = stateSelect.parentElement.nextElementSibling;
            const citySelectElement = citySelect.querySelector('select');

            $.ajax({
                url: '../include/function.php',
                method: 'GET',
                data: {
                    state: selectedstate
                },

                success: function(response) {
                    citySelectElement.innerHTML = response;
                },
                error: function(error) {
                    console.error('AJAX request failed: ' + error);
                }

            });
        }
        function fetchcity(stateSelect, data) {
            const selectedstate = stateSelect.value;
            const citySelect = stateSelect.parentElement.nextElementSibling;
            const citySelectElement = citySelect.querySelector('select');

            $.ajax({
                url: '../include/function.php',
                method: 'GET',
                data: {
                    state: selectedstate
                },

                success: function(response) {
                    citySelectElement.innerHTML = response;
                    console.log(citySelectElement)
                    $('#' + citySelectElement.id).val(data);
                    $('#' + citySelectElement.id).trigger('change');
                },
                error: function(error) {
                    console.error('AJAX request failed: ' + error);
                }

            });
        }
        function copyaddress(checkbox) {
            var shipping_address = $("#shipping_address").val();
            var billing_address = $("#billing_address");

            var shipping_postal_code = $("#shipping_postal_code").val();
            var billing_postal_code = $("#billing_postal_code");


            var shipping_country = $("#shipping_country").val();
            var billing_country = $("#billing_country");


            var shipping_state = $("#shipping_state").val();
            var billing_state = $("#billing_state");


            var shipping_city = $("#shipping_city").val();
            var billing_city = $("#billing_city");
            if (checkbox.checked) {
                billing_address.val(shipping_address);
                billing_postal_code.val(shipping_postal_code);

                $('#billing_country').val(shipping_country);
                $('#billing_country').trigger('change');
                setTimeout(function() {
                    $('#billing_state').val(shipping_state);
                    $('#billing_state').trigger('change');

                }, 100);
                setTimeout(function() {
       
                    $('#billing_city').val(shipping_city);
                    $('#billing_city').trigger('change');
                    console.log(shipping_city);
                }, 100);
              


            } else {
                billing_address.val("");
                billing_postal_code.val("");
                $('#billing_country').val("Country");
                $('#billing_country').trigger('change');

                $('#billing_state').val("State");
                $('#billing_state').trigger('change');
            }
        }
    </script>
    <?php


    if (isset($_GET['contact_quotation_id'])) {

        getselecterdata($contact_quotationdata['company_name'], '#company_name');
        getselecterdata($contact_quotationdata['job_title'], '#job_title');
        getselecterdata($contact_quotationdata['department'], '#department');
        getselecterdata($contact_quotationdata['communication_preference'], '#communication_preference');
        getselecterdata($contact_quotationdata['shipping_country'], '#shipping_country');
      
        getselecterdata($contact_quotationdata['billing_country'], '#billing_country');
    }


    ?>
</body>

</html>