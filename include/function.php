<?php
include 'config.php';
session_start();

if (isset($_POST['login'])) {

  $email = $_POST['email'];
  $password = $_POST['password'];
  $loginsql = "SELECT * FROM `user` WHERE user_email = '" . $email . "' and user_password= '" . $password . "'";
  $resultlogin = $conn->query($loginsql);

  if ($resultlogin->num_rows >= 1) {
    session_start();
    $rowlogin = $resultlogin->fetch_array();
    $_SESSION['user_id'] = $rowlogin['user_id'];
    header("Location: ../index.php");
  }
}
function getoptionwithcode($table, $field, $value, $value2)
{
  include 'config.php';
  $data = mysqli_query($conn, "SELECT * FROM " . $table . " ORDER BY " . $value2);
  while ($datarow = mysqli_fetch_array($data)) {
    echo '<option value="' . $datarow[$field] . '">' . $datarow[$value] . '(' . $datarow[$value2] . ')</option>';
  }
}
function getoptionwithcodestatus($table, $field, $value, $value2, $status)
{
  include 'config.php';
  $data = mysqli_query($conn, "SELECT * FROM " . $table . " where " . $status . " =1" . " ORDER BY " . $value);
  while ($datarow = mysqli_fetch_array($data)) {
    echo '<option value="' . $datarow[$field] . '">' . $datarow[$value] . '(' . $datarow[$value2] . ')</option>';
  }
}
function getoption($table, $field, $value)
{
  include 'config.php';
  $data = mysqli_query($conn, "SELECT * FROM " . $table . " ORDER BY " . $value);
  print_r($data);
  while ($datarow = mysqli_fetch_array($data)) {
    echo '<option value="' . $datarow[$field] . '">' . $datarow[$value] . '</option>';
  }
}
function getuseroption($table, $field, $value)
{
  include 'config.php';
    $_SESSION['user_id'] = 1;
  $data = mysqli_query($conn, "SELECT * FROM " . $table ." where admin_user = ".   $_SESSION['user_id']." ORDER BY " . $value);
  print_r($data);
  while ($datarow = mysqli_fetch_array($data)) {
    echo '<option value="' . $datarow[$field] . '">' . $datarow[$value] . '</option>';
  }
}
function getoptionwithstatus($table, $field, $value, $status)
{
  include 'config.php';
  $data = mysqli_query($conn, "SELECT * FROM " . $table . " where " . $status . " = 1" . " ORDER BY " . $value);
  while ($datarow = mysqli_fetch_array($data)) {
    echo '<option value="' . $datarow[$field] . '">' . $datarow[$value] . '</option>';
  }
}


if (isset($_GET['country'])) {

  $data = mysqli_query($conn, "SELECT * FROM states where country_id =" . $_GET['country']);
  echo '<option value="State">Select State</option>';
  while ($datarow = mysqli_fetch_array($data)) {
    echo '<option value="' . $datarow['id'] . '">' . $datarow['name'] . '</option>';
  }
}
if (isset($_GET['state'])) {

  $data = mysqli_query($conn, "SELECT * FROM cities where state_id =" . $_GET['state']);
  echo '<option value="">Select city</option>';
  while ($datarow = mysqli_fetch_array($data)) {
    echo '<option value="' . $datarow['id'] . '">' . $datarow['name'] . '</option>';
  }
}

if (isset($_POST['addctomerform'])) {
  $count = 1;

  $_SESSION['user_id'] = 1;
  $customer_code = mysqli_real_escape_string($conn, $_POST['customer_code']);
  $customer_category = mysqli_real_escape_string($conn, $_POST['customer_category']);
  // $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
  $customer_company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
  $customer_Industry = mysqli_real_escape_string($conn, $_POST['customer_Industry']);
  $customer_type = mysqli_real_escape_string($conn, $_POST['customer_types']);
  $customer_source = mysqli_real_escape_string($conn, $_POST['customer_sources']);
  $customer_branch = mysqli_real_escape_string($conn, $_POST['customer_branch_warehouses']);
  $customer_phone = mysqli_real_escape_string($conn, $_POST['customer_phone']);
  $customer_email = mysqli_real_escape_string($conn, $_POST['customer_email']);
  $custom_field1 = mysqli_real_escape_string($conn, $_POST['custom_field1']);

  $stmt = $conn->prepare("INSERT INTO `customer`( `customer_code`, `customer_category`, 
  `customer_company_name`, `customer_Industry`, `customer_type`, `customer_source`, `customer_branch`, `customer_custom_1`,
`customer_created_by`, `customer_phone`, `customer_email`) 
   VALUES (?,?,?,?,?,?,?,?,?,?,?)");

$stmt->bind_param(
    "sssssssssss",
    $customer_code,
    $customer_category,
    $customer_company_name,
    $customer_Industry,
    $customer_type,
    $customer_source,
    $customer_branch,
    $custom_field1,
    $_SESSION['user_id'],
    $customer_phone,
    $customer_email,
);

  if ($stmt->execute()) {
    // die();
    $last_id = $conn->insert_id;
    if (isset($_POST['address1'])) {
      while (isset($_POST['address' . $count])) {

        // $address = mysqli_real_escape_string($conn, $_POST['address' . $count]);
        // $contact_name = mysqli_real_escape_string($conn, $_POST['contact_name' . $count]);
        $address = mysqli_real_escape_string($conn, $_POST['address' . $count]);
        $address_country = mysqli_real_escape_string($conn, $_POST['country' . $count]);
        $address_state = mysqli_real_escape_string($conn, $_POST['state' . $count]);
        $address_city = mysqli_real_escape_string($conn, $_POST['city' . $count]);

        $postal_code = mysqli_real_escape_string($conn, $_POST['postal_code' . $count]);

        $country_tax = mysqli_real_escape_string($conn, $_POST['country_tax' . $count]);
        $tax_no = mysqli_real_escape_string($conn, $_POST['tax_no' . $count]);

        // $customer_emailid = mysqli_real_escape_string($conn, $_POST['customer_emailid' . $count]);
        // $customer_fax = mysqli_real_escape_string($conn, $_POST['customer_fax' . $count]);
        // $custom_field = mysqli_real_escape_string($conn, $_POST['custom_field' . $count]);
        $stmt = $conn->prepare("INSERT INTO `customer_address`(`address_address`, `address_country`,
        `address_state`, `address_city`, `address_zip_code`, `country_tax`, `tax_no`, `customer_id`) 
        VALUES(?,?,?,?,?,?,?,?)");
        $stmt->bind_param(
          "ssssssss",
          $address,
          $address_country,
          $address_state,
          $address_city,
          $postal_code,
          $country_tax,
          $tax_no,
          $last_id
        );
        $stmt->execute();
        $count++;
      }
    } else {
    }
    echo '<script>window.location.href = "../sales/customer.php"; </script>';
  } else {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();

  //  header("Location : ../sales/customer.php");
}
if (isset($_POST['editctomerform'])) {
  $count = 1;
  $_SESSION['user_id'] = 1;
  $customer_code = mysqli_real_escape_string($conn, $_POST['customer_code']);
  $customer_category = mysqli_real_escape_string($conn, $_POST['customer_category']);
  $customer_company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
  $customer_Industry = mysqli_real_escape_string($conn, $_POST['customer_Industry']);
  $customer_type = mysqli_real_escape_string($conn, $_POST['customer_types']);
  $customer_source = mysqli_real_escape_string($conn, $_POST['customer_sources']);
  $customer_branch = mysqli_real_escape_string($conn, $_POST['customer_branch_warehouses']);
  $customer_phone = mysqli_real_escape_string($conn, $_POST['customer_phone']);
  $customer_email = mysqli_real_escape_string($conn, $_POST['customer_email']);
  $customer_custom_1 = mysqli_real_escape_string($conn, $_POST['custom_field1']);


  $stmt = $conn->prepare("UPDATE `customer` SET `customer_code`=?,`customer_category`=?,
  `customer_company_name`=?,`customer_Industry`=?,`customer_type`=?,`customer_source`=?,`customer_branch`=?,
  `customer_custom_1`=?,`customer_created_by`=?,`customer_phone`=?,`customer_email`=?  WHERE `customer_id` = ?");

  $stmt->bind_param(
    "sssssssssssi",
    $customer_code,
    $customer_category,
    $customer_company_name,
    $customer_Industry,
    $customer_type,
    $customer_source,
    $customer_branch,
    $customer_custom_1,
    $_SESSION['user_id'],
    $customer_phone,
    $customer_email,
    $_POST['editctomerform']
  );

  if ($stmt->execute()) {
    $last_id = $_POST['editctomerform'];
    $address_data1 = mysqli_query($conn, "SELECT * FROM `customer_address` WHERE `customer_id` =" . $_POST['editctomerform']);
    $numberofaddress = mysqli_num_rows($address_data1);
    $count = 1;
    while ($addressdata = mysqli_fetch_array($address_data1)) {
      if (!isset($_POST['address' . $count])) {
        // echo "DELETE FROM `customer_address` WHERE `address_id`=  " . $addressdata['address_id'];
        $stmt = $conn->prepare("DELETE FROM `customer_address` WHERE `address_id`=  ? ");
        $stmt->bind_param("s", $addressdata['address_id']);
        $stmt->execute();
      }

      $count++;
    }
    $count = 1;
    $address_datanew = mysqli_query($conn, "SELECT * FROM `customer_address` WHERE `customer_id` =" . $_POST['editctomerform']);

    $numofaddress = $_POST['numaddress'];
    while ($numofaddress > 0) {


   

      if (isset($_POST['addressid' . $count])) {
        $address = mysqli_real_escape_string($conn, $_POST['address' . $count]);
        $address_country = mysqli_real_escape_string($conn, $_POST['country' . $count]);
        $address_state = mysqli_real_escape_string($conn, $_POST['state' . $count]);
        $address_city = mysqli_real_escape_string($conn, $_POST['city' . $count]);
        $postal_code = mysqli_real_escape_string($conn, $_POST['postal_code' . $count]);
        $country_tax = mysqli_real_escape_string($conn, $_POST['country_tax' . $count]);
        $tax_no = mysqli_real_escape_string($conn, $_POST['tax_no' . $count]);
  
        $addressdata = mysqli_fetch_array($address_datanew);

     
        $address_id = $addressdata['address_id'];

        $stmt = $conn->prepare("UPDATE `customer_address` SET`address_address`=?,`address_country`=?,`address_state`=?,`address_city`=?
          ,`address_zip_code`=?,`country_tax`=?,`tax_no`=? WHERE `address_id` = ?");
        $stmt->bind_param("sssssssi", $address, $address_country, $address_state, $address_city, $postal_code, $country_tax, $tax_no, $address_id);
        $stmt->execute();
      } elseif(isset($_POST['address' . $count])) {

        $address = mysqli_real_escape_string($conn, $_POST['address' . $count]);
        $address_country = mysqli_real_escape_string($conn, $_POST['country' . $count]);
        $address_state = mysqli_real_escape_string($conn, $_POST['state' . $count]);
        $address_city = mysqli_real_escape_string($conn, $_POST['city' . $count]);
        $postal_code = mysqli_real_escape_string($conn, $_POST['postal_code' . $count]);
        $country_tax = mysqli_real_escape_string($conn, $_POST['country_tax' . $count]);
        $tax_no = mysqli_real_escape_string($conn, $_POST['tax_no' . $count]);
  
        $stmt = $conn->prepare("INSERT INTO `customer_address`(`address_address`, `address_country`,
          `address_state`, `address_city`, `address_zip_code`, `country_tax`, `tax_no`, `customer_id`) 
          VALUES(?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssss", $address, $address_country, $address_state, $address_city,  $postal_code, $country_tax, $tax_no, $last_id);
        $stmt->execute();
      }
      $count++;
      $numofaddress--;
    }
 header("Location:  ../sales/customer.php");

  }
}


//     $address_data1 = mysqli_query($conn, "SELECT * FROM `customer_address` WHERE `customer_id` =" . $_POST['editctomerform']);

//     while (isset($_POST['address' . $count])) {


//       if (isset($_POST['address' . $count])) {

//         $address = mysqli_real_escape_string($conn, $_POST['address' . $count]);
//         $address_country = mysqli_real_escape_string($conn, $_POST['country' . $count]);
//         $address_state = mysqli_real_escape_string($conn, $_POST['state' . $count]);
//         $address_city = mysqli_real_escape_string($conn, $_POST['city' . $count]);
//         $postal_code = mysqli_real_escape_string($conn, $_POST['postal_code' . $count]);
//         $country_tax = mysqli_real_escape_string($conn, $_POST['country_tax' . $count]);
//         $tax_no = mysqli_real_escape_string($conn, $_POST['tax_no' . $count]);


//         if (isset($_POST['address' . $count])) {
//           $addressdata = mysqli_fetch_array($address_data1);
//           $address_id = $addressdata['address_id'];

//           $stmt = $conn->prepare("UPDATE `customer_address` SET`address_address`=?,`address_country`=?,`address_state`=?,`address_city`=?
//           ,`address_zip_code`=?,`country_tax`=?,`tax_no`=? WHERE `address_id` = ?");
//           $stmt->bind_param("sssssssi", $address, $address_country, $address_state, $address_city, $postal_code, $country_tax, $tax_no, $address_id);
//           $stmt->execute();
//           $numberofaddress--;
//         } else {


//           $stmt = $conn->prepare("INSERT INTO `customer_address`(`address_address`, `address_country`,
//           `address_state`, `address_city`, `address_zip_code`, `country_tax`, `tax_no`, `customer_id`) 
//           VALUES(?,?,?,?,?,?,?,?)");
//           $stmt->bind_param("ssssssss", $address, $address_country, $address_state, $address_city,  $postal_code, $country_tax, $tax_no, $last_id);
//           $stmt->execute();
//           $numberofaddress--;
//         }
//         $count++;
//       }
//     }


//     $stmt->close();
//     // die();
//     // header("Location:  ../sales/customer.php");
//   }
// }
if (isset($_POST['saveandnewcustomer'])) {
  // echo " rushi";
  // die();



  $count = 1;
  $_SESSION['user_id'] = 1;

  $customer_code = mysqli_real_escape_string($conn, $_POST['customer_code']);
  $customer_category = mysqli_real_escape_string($conn, $_POST['customer_category']);
  $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
  $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
  $customer_Industry = mysqli_real_escape_string($conn, $_POST['customer_Industry']);
  $customer_type = mysqli_real_escape_string($conn, $_POST['customer_types']);
  $customer_source = mysqli_real_escape_string($conn, $_POST['customer_sources']);
  $customer_gstin = mysqli_real_escape_string($conn, $_POST['customer_gstin']);
  $branchWarehouse = mysqli_real_escape_string($conn, $_POST['customer_branch_warehouses']);
  $customField1 = mysqli_real_escape_string($conn, $_POST['custom_field1']);
  $customField2 = mysqli_real_escape_string($conn, $_POST['custom_field2']);
  $customField3 = mysqli_real_escape_string($conn, $_POST['custom_field3']);
  $stmt = $conn->prepare("UPDATE `customer` SET `customer_code` = ?, `customer_category` = ?, `customer_name` = ?, `customer_company_name` = ?, `customer_Industry` = ?, `customer_type` = ?,
  `customer_source` = ?,`customer_gstin` = ?,`customer_branch` = ?,`customer_custom_1` = ?, `customer_custom_2` = ?, `customer_custom_3` = ? WHERE `customer_id` = ?");

  $stmt->bind_param(
    "ssssssssssssi",
    $customer_code,
    $customer_category,
    $customer_name,
    $company_name,
    $customer_Industry,
    $customer_type,
    $customer_source,
    $customer_gstin,
    $branchWarehouse,
    $customField1,
    $customField2,
    $customField3,
    $_POST['saveandnewcustomer']
  );

  if ($stmt->execute()) {
    $last_id = $_POST['saveandnewcustomer'];
    $address_data = mysqli_query($conn, "SELECT * FROM `customer_address` WHERE `customer_id` =" . $_POST['saveandnewcustomer']);
    $count = 0;
    while ($addressdata = mysqli_fetch_array($address_data)) {
      $count++;
      $address_id = $addressdata['address_id'];
      $company_name = mysqli_real_escape_string($conn, $_POST['company_name' . $count]);
      $contact_name = mysqli_real_escape_string($conn, $_POST['contact_name' . $count]);
      $address = mysqli_real_escape_string($conn, $_POST['address' . $count]);
      $country = mysqli_real_escape_string($conn, $_POST['country' . $count]);
      $state = mysqli_real_escape_string($conn, $_POST['state' . $count]);
      $city = mysqli_real_escape_string($conn, $_POST['city' . $count]);
      $postal_code = mysqli_real_escape_string($conn, $_POST['postal_code' . $count]);
      $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number' . $count]);
      $customer_emailid = mysqli_real_escape_string($conn, $_POST['customer_emailid' . $count]);
      $customer_fax = mysqli_real_escape_string($conn, $_POST['customer_fax' . $count]);
      $custom_field = mysqli_real_escape_string($conn, $_POST['custom_field' . $count]);


      $stmt = $conn->prepare("UPDATE `customer_address` SET `address_company_name` = ?, `address_contact_name` = ?, `address_address` = ?, `address_country` = ?,
        `address_state` = ?, `address_city` = ?, `address_zip_code` = ?, `address_phone_number` = ?, `address_email` = ?, `address_Fax` = ?, `address_custom` = ?, `customer_id` = ? WHERE `address_id` = ?");
      $stmt->bind_param("ssssssssssssi", $company_name, $contact_name, $address, $country, $state, $city,  $postal_code, $phone_number, $customer_emailid, $customer_fax, $custom_field, $last_id, $address_id);
      $stmt->execute();
      $count++;
    }
  } else {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
  header("Location:  ../sales/add_customer.php?customer_id=" . $_POST['saveandnewcustomer'] . "&new=1");
}
function getcustomer()
{
  include 'config.php';
  $data = mysqli_query($conn, "SELECT * FROM customer join customer_type on customer.customer_type  = cu_ty_id join user on customer.customer_created_by = user.user_id join warehouse on  customer.customer_branch = warehouse.warehouse_id ");
  $count = 0;
  while ($datarow = mysqli_fetch_array($data)) {
    $count++;
    $activebtn = $datarow['customer_status'] == 1 ? ' <button style="cursor: pointer;" onclick= "changestatus(' . $datarow['customer_id'] . ')" class="text-green-900 border border-green-600 bg-green-300 w-16 p-2">
    Active
  </button>'  : '   <button   style="cursor: pointer;" onclick= "changestatus(' . $datarow['customer_id'] . ')" class="text-red-900 border border-red-600 bg-red-300 w-16 p-2">
  Inactive
</button>';
    echo ' <tr><td class="px-6 py-4 whitespace-no-wrap">' . $count . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">' . $datarow['customer_company_name'] . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">' . $datarow['customer_code'] . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">' . $datarow['cu_ty_name'] . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">' . $datarow['user_username'] . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">' . $datarow['customer_date'] . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">
 
      ' . $activebtn . '
    </td>
    <td class="px-6 py-4 whitespace-no-wrap flex justify-between">
    <a href="add_customer.php?customer_id=' . $datarow['customer_id'] . '">
      <svg class="mt-2" width="18" height="18" viewBox="0 0 24 24" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path d="M12 20H21" stroke="#8A8A8A" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path
          d="M16.5 3.50023C16.8978 3.1024 17.4374 2.87891 18 2.87891C18.2786 2.87891 18.5544 2.93378 18.8118 3.04038C19.0692 3.14699 19.303 3.30324 19.5 3.50023C19.697 3.69721 19.8532 3.93106 19.9598 4.18843C20.0665 4.4458 20.1213 4.72165 20.1213 5.00023C20.1213 5.2788 20.0665 5.55465 19.9598 5.81202C19.8532 6.06939 19.697 6.30324 19.5 6.50023L7 19.0002L3 20.0002L4 16.0002L16.5 3.50023Z"
          stroke="#8A8A8A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
      </a>
      <a href="../include/function.php?deletecustomer=' . $datarow['customer_id'] . '">
      <svg class="mt-2" width="18" height="18" viewBox="0 0 24 24" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path d="M3 6H5H21" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path
          d="M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6"
          stroke="#FF3B2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M10 11V17" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path d="M14 11V17" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
      </svg>
      </a>
    </td> </tr>';
  }
}
function getcontact()
{
  include 'config.php';
  $data = mysqli_query($conn, "SELECT * FROM contact_quotation join job_title on contact_quotation.job_title = job_title.job_title_id  
  join department  on  contact_quotation.department = department.department_id  join communication_preference  on  contact_quotation.communication_preference = communication_preference.communication_preference_id 
  join user on  contact_quotation.created_by = user.user_id join customer on  contact_quotation.company_name = customer.customer_id");
  $count = 0;
  while ($datarow = mysqli_fetch_array($data)) {
    $count++;
    $activebtn = $datarow['Contact_status'] == 1 ? ' <button style="cursor: pointer;" class="text-green-900 border border-green-600 bg-green-300 w-16 p-2" onclick= "changestatus(' . $datarow['contact_quotation_id'] . ')" >
    Active
  </button>'  : '   <button   style="cursor: pointer;" onclick= "changestatus(' . $datarow['contact_quotation_id'] . ')" class="text-red-900 border border-red-600 bg-red-300 w-16 p-2">
  Inactive
</button>';
    echo ' <tr><td class="px-6 py-4 whitespace-no-wrap">' . $count . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">'. $datarow['prefix'].' '. $datarow['first_name'].' '.$datarow['last_name'] . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">' . $datarow['customer_company_name'] . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">' . $datarow['user_username'] . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">' . $datarow['created_date'] . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">' . $datarow['created_date'] . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">
 
      ' . $activebtn . '
    </td>
    <td class="px-6 py-4 whitespace-no-wrap flex justify-between">
    <a href="add_contact.php?contact_quotation_id=' . $datarow['contact_quotation_id'] . '">
      <svg class="mt-2" width="18" height="18" viewBox="0 0 24 24" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path d="M12 20H21" stroke="#8A8A8A" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path
          d="M16.5 3.50023C16.8978 3.1024 17.4374 2.87891 18 2.87891C18.2786 2.87891 18.5544 2.93378 18.8118 3.04038C19.0692 3.14699 19.303 3.30324 19.5 3.50023C19.697 3.69721 19.8532 3.93106 19.9598 4.18843C20.0665 4.4458 20.1213 4.72165 20.1213 5.00023C20.1213 5.2788 20.0665 5.55465 19.9598 5.81202C19.8532 6.06939 19.697 6.30324 19.5 6.50023L7 19.0002L3 20.0002L4 16.0002L16.5 3.50023Z"
          stroke="#8A8A8A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
      </a>
      <a href="../include/function.php?delete_quotation_id=' . $datarow['contact_quotation_id'] . '">
      <svg class="mt-2" width="18" height="18" viewBox="0 0 24 24" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path d="M3 6H5H21" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path
          d="M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6"
          stroke="#FF3B2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M10 11V17" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path d="M14 11V17" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
      </svg>
      </a>
    </td> </tr>';
  }
}

function getcustomercategory()
{
  include 'config.php';
  $data = mysqli_query($conn, "SELECT * FROM `customer_category`");
  $count = 0;
  while ($datarow = mysqli_fetch_array($data)) {
    $count++;
    $activebtn = $datarow['cu_cat_status'] == 1 ? ' <a  style="cursor: pointer;" href=" ../include/function.php?cu_cat_id_status=' . $datarow['cu_cat_id'] . '">
    Active
  </a>' : '<a  style="cursor: pointer;" href=" ../include/function.php?cu_cat_id_status=' . $datarow['cu_cat_id'] . '"  class="text-red-900 border border-red-600 bg-red-300 w-16 p-2">
  Inactive
</a>';
    echo ' <tr><td class="px-6 py-4 whitespace-no-wrap">' . $count . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">' . $datarow['cu_cat_name'] . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">' . $activebtn . '
    </td>
    <td class="px-6 py-4 whitespace-no-wrap flex justify-between">
    <a href="customer_category.php?cu_cat_id=' . $datarow['cu_cat_id'] . '">
      <svg class="mt-2" width="18" height="18" viewBox="0 0 24 24" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path d="M12 20H21" stroke="#8A8A8A" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path
          d="M16.5 3.50023C16.8978 3.1024 17.4374 2.87891 18 2.87891C18.2786 2.87891 18.5544 2.93378 18.8118 3.04038C19.0692 3.14699 19.303 3.30324 19.5 3.50023C19.697 3.69721 19.8532 3.93106 19.9598 4.18843C20.0665 4.4458 20.1213 4.72165 20.1213 5.00023C20.1213 5.2788 20.0665 5.55465 19.9598 5.81202C19.8532 6.06939 19.697 6.30324 19.5 6.50023L7 19.0002L3 20.0002L4 16.0002L16.5 3.50023Z"
          stroke="#8A8A8A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
      </a>
      <a href="../include/function.php?customer_category_delete=' . $datarow['cu_cat_id'] . '">
      <svg class="mt-2" width="18" height="18" viewBox="0 0 24 24" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path d="M3 6H5H21" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path
          d="M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6"
          stroke="#FF3B2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M10 11V17" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path d="M14 11V17" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
      </svg>
      </a>
    </td> </tr>';
  }
}
function getsales_stage()
{
  include 'config.php';
  $data = mysqli_query($conn, "SELECT * FROM `enquiry_stage` where stage_status = 1");
  $count = 0;
  while ($datarow = mysqli_fetch_array($data)) {
    $count++;
    $activebtn = $datarow['stage_status'] == 1 ? ' <a style="cursor: pointer;" href=" ../include/function.php?stage_id_status=' . $datarow['stage_id'] . '" class="text-green-900 border border-green-600 bg-green-300 w-16 p-2">
    Active
  </a>' : '<a  style="cursor: pointer;" href=" ../include/function.php?stage_id_status=' . $datarow['stage_id'] . '"  class="text-red-900 border border-red-600 bg-red-300 w-16 p-2">
  Inactive
</a>';  
    echo ' <tr><td class="px-6 py-4 whitespace-no-wrap">' . $count . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">' . $datarow['stage_name'] . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">
   ' . $activebtn . '
    </td>
    <td class="px-6 py-4 whitespace-no-wrap flex justify-between">
    <a href="industry.php?stage_id=' . $datarow['stage_id'] . '">
      <svg class="mt-2" width="18" height="18" viewBox="0 0 24 24" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path d="M12 20H21" stroke="#8A8A8A" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path
          d="M16.5 3.50023C16.8978 3.1024 17.4374 2.87891 18 2.87891C18.2786 2.87891 18.5544 2.93378 18.8118 3.04038C19.0692 3.14699 19.303 3.30324 19.5 3.50023C19.697 3.69721 19.8532 3.93106 19.9598 4.18843C20.0665 4.4458 20.1213 4.72165 20.1213 5.00023C20.1213 5.2788 20.0665 5.55465 19.9598 5.81202C19.8532 6.06939 19.697 6.30324 19.5 6.50023L7 19.0002L3 20.0002L4 16.0002L16.5 3.50023Z"
          stroke="#8A8A8A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
      </a>
      <a href="../include/function.php?deleteIndustry=' . $datarow['stage_id'] . '">
      <svg class="mt-2" width="18" height="18" viewBox="0 0 24 24" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path d="M3 6H5H21" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path
          d="M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6"
          stroke="#FF3B2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M10 11V17" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path d="M14 11V17" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
      </svg>
      </a>
    </td> </tr>';
  }
}
function getcustomerindustry()
{
  include 'config.php';
  $data = mysqli_query($conn, "SELECT * FROM `industry`");
  $count = 0;
  while ($datarow = mysqli_fetch_array($data)) {
    $count++;
    $activebtn = $datarow['Industry_status'] == 1 ? ' <a style="cursor: pointer;" href=" ../include/function.php?Industry_id_status=' . $datarow['Industry_id'] . '" class="text-green-900 border border-green-600 bg-green-300 w-16 p-2">
    Active
  </a>' : '<a  style="cursor: pointer;" href=" ../include/function.php?Industry_id_status=' . $datarow['Industry_id'] . '"  class="text-red-900 border border-red-600 bg-red-300 w-16 p-2">
  Inactive
</a>';
    echo ' <tr><td class="px-6 py-4 whitespace-no-wrap">' . $count . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">' . $datarow['Industry_name'] . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">
   ' . $activebtn . '
    </td>
    <td class="px-6 py-4 whitespace-no-wrap flex justify-between">
    <a href="industry.php?Industry_id=' . $datarow['Industry_id'] . '">
      <svg class="mt-2" width="18" height="18" viewBox="0 0 24 24" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path d="M12 20H21" stroke="#8A8A8A" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path
          d="M16.5 3.50023C16.8978 3.1024 17.4374 2.87891 18 2.87891C18.2786 2.87891 18.5544 2.93378 18.8118 3.04038C19.0692 3.14699 19.303 3.30324 19.5 3.50023C19.697 3.69721 19.8532 3.93106 19.9598 4.18843C20.0665 4.4458 20.1213 4.72165 20.1213 5.00023C20.1213 5.2788 20.0665 5.55465 19.9598 5.81202C19.8532 6.06939 19.697 6.30324 19.5 6.50023L7 19.0002L3 20.0002L4 16.0002L16.5 3.50023Z"
          stroke="#8A8A8A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
      </a>
      <a href="../include/function.php?deleteIndustry=' . $datarow['Industry_id'] . '">
      <svg class="mt-2" width="18" height="18" viewBox="0 0 24 24" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path d="M3 6H5H21" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path
          d="M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6"
          stroke="#FF3B2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M10 11V17" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path d="M14 11V17" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
      </svg>
      </a>
    </td> </tr>';
  }
}
function getcustomerbranch_warehouse()
{
  include 'config.php';
  $data = mysqli_query($conn, "SELECT * FROM `warehouse`");
  $count = 0;
  while ($datarow = mysqli_fetch_array($data)) {
    $count++;
    $activebtn = $datarow['warehouse_status'] == 1 ? ' <a style="cursor: pointer;" href=" ../include/function.php?warehouse_id_status=' . $datarow['warehouse_id'] . '" class="text-green-900 border border-green-600 bg-green-300 w-16 p-2">
    Active
  </a>' : '<a  style="cursor: pointer;" href=" ../include/function.php?warehouse_id_status=' . $datarow['warehouse_id'] . '"  class="text-red-900 border border-red-600 bg-red-300 w-16 p-2">
  Inactive
</a>';
    echo ' <tr><td class="px-6 py-4 whitespace-no-wrap">' . $count . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">' . $datarow['warehouse_name'] . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">
    ' . $activebtn . '
    </td>
    <td class="px-6 py-4 whitespace-no-wrap flex justify-between">
    <a href="branch_warehouse.php?warehouse_id=' . $datarow['warehouse_id'] . '">
      <svg class="mt-2" width="18" height="18" viewBox="0 0 24 24" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path d="M12 20H21" stroke="#8A8A8A" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path
          d="M16.5 3.50023C16.8978 3.1024 17.4374 2.87891 18 2.87891C18.2786 2.87891 18.5544 2.93378 18.8118 3.04038C19.0692 3.14699 19.303 3.30324 19.5 3.50023C19.697 3.69721 19.8532 3.93106 19.9598 4.18843C20.0665 4.4458 20.1213 4.72165 20.1213 5.00023C20.1213 5.2788 20.0665 5.55465 19.9598 5.81202C19.8532 6.06939 19.697 6.30324 19.5 6.50023L7 19.0002L3 20.0002L4 16.0002L16.5 3.50023Z"
          stroke="#8A8A8A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
      </a>
      <a href="../include/function.php?deletewarehouse_id=' . $datarow['warehouse_id'] . '">
      <svg class="mt-2" width="18" height="18" viewBox="0 0 24 24" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path d="M3 6H5H21" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path
          d="M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6"
          stroke="#FF3B2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M10 11V17" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path d="M14 11V17" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
      </svg>
      </a>
    </td> </tr>';
  }
}
function getcustomertype()
{
  include 'config.php';
  $data = mysqli_query($conn, "SELECT * FROM `customer_type`");
  $count = 0;
  while ($datarow = mysqli_fetch_array($data)) {
    $activebtn = $datarow['cu_ty_status'] == 1 ? ' <a style="cursor: pointer;" href=" ../include/function.php?cu_ty_id_status=' . $datarow['cu_ty_id'] . '" class="text-green-900 border border-green-600 bg-green-300 w-16 p-2">
    Active
  </a>' : '<a  style="cursor: pointer;" href=" ../include/function.php?cu_ty_id_status=' . $datarow['cu_ty_id'] . '"  class="text-red-900 border border-red-600 bg-red-300 w-16 p-2">
  Inactive
</a>';
    $count++;

    echo ' <tr><td class="px-6 py-4 whitespace-no-wrap">' . $count . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">' . $datarow['cu_ty_name'] . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">
   ' . $activebtn . '
    </td>
    <td class="px-6 py-4 whitespace-no-wrap flex justify-between">
    <a href="customer_type.php?cu_ty_id=' . $datarow['cu_ty_id'] . '">
      <svg class="mt-2" width="18" height="18" viewBox="0 0 24 24" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path d="M12 20H21" stroke="#8A8A8A" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path
          d="M16.5 3.50023C16.8978 3.1024 17.4374 2.87891 18 2.87891C18.2786 2.87891 18.5544 2.93378 18.8118 3.04038C19.0692 3.14699 19.303 3.30324 19.5 3.50023C19.697 3.69721 19.8532 3.93106 19.9598 4.18843C20.0665 4.4458 20.1213 4.72165 20.1213 5.00023C20.1213 5.2788 20.0665 5.55465 19.9598 5.81202C19.8532 6.06939 19.697 6.30324 19.5 6.50023L7 19.0002L3 20.0002L4 16.0002L16.5 3.50023Z"
          stroke="#8A8A8A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
      </a>
      <a href="../include/function.php?cu_ty_id_delete=' . $datarow['cu_ty_id'] . '">
      <svg class="mt-2" width="18" height="18" viewBox="0 0 24 24" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path d="M3 6H5H21" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path
          d="M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6"
          stroke="#FF3B2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M10 11V17" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path d="M14 11V17" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
      </svg>
      </a>
    </td> </tr>';
  }
}
function getsource_referred()
{
  include 'config.php';
  $data = mysqli_query($conn, "SELECT * FROM `source`");
  $count = 0;
  while ($datarow = mysqli_fetch_array($data)) {
    $activebtn = $datarow['source_status'] == 1 ? ' <a style="cursor: pointer;" href=" ../include/function.php?source_id_status=' . $datarow['source_id'] . '" class="text-green-900 border border-green-600 bg-green-300 w-16 p-2">
    Active
  </a>' : '<a  style="cursor: pointer;" href=" ../include/function.php?source_id_status=' . $datarow['source_id'] . '"  class="text-red-900 border border-red-600 bg-red-300 w-16 p-2">
  Inactive
</a>';
    $count++;

    echo ' <tr><td class="px-6 py-4 whitespace-no-wrap">' . $count . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">' . $datarow['source_name'] . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">
   ' . $activebtn . '
    </td>
    <td class="px-6 py-4 whitespace-no-wrap flex justify-between">
    <a href="source_referred_by.php?source_id=' . $datarow['source_id'] . '">
      <svg class="mt-2" width="18" height="18" viewBox="0 0 24 24" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path d="M12 20H21" stroke="#8A8A8A" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path
          d="M16.5 3.50023C16.8978 3.1024 17.4374 2.87891 18 2.87891C18.2786 2.87891 18.5544 2.93378 18.8118 3.04038C19.0692 3.14699 19.303 3.30324 19.5 3.50023C19.697 3.69721 19.8532 3.93106 19.9598 4.18843C20.0665 4.4458 20.1213 4.72165 20.1213 5.00023C20.1213 5.2788 20.0665 5.55465 19.9598 5.81202C19.8532 6.06939 19.697 6.30324 19.5 6.50023L7 19.0002L3 20.0002L4 16.0002L16.5 3.50023Z"
          stroke="#8A8A8A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
      </a>
      <a href="../include/function.php?source_id_delete=' . $datarow['source_id'] . '">
      <svg class="mt-2" width="18" height="18" viewBox="0 0 24 24" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path d="M3 6H5H21" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path
          d="M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6"
          stroke="#FF3B2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M10 11V17" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path d="M14 11V17" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
      </svg>
      </a>
    </td> </tr>';
  }
}
function getsales_enquiry()
{
  include 'config.php';
  $data = mysqli_query($conn, "SELECT * FROM sales_enquiry join customer on customer.customer_id   = sales_enquiry.enquiry_customer_name join user on sales_enquiry.enquiry_user_id = user.user_id join warehouse on  sales_enquiry.sales_branch_warehouse = warehouse.warehouse_id ");
  $count = 0;
  while ($datarow = mysqli_fetch_array($data)) {
    $activebtn = $datarow['enquiry_id_status'] == 1 ? ' <a style="cursor: pointer;" href=" ../include/function.php?enquiry_id_status=' . $datarow['enquiry_id'] . '" class="text-green-900 border border-green-600 bg-green-300 w-16 p-2">
    Active
  </a>' : '<a  style="cursor: pointer;" href=" ../include/function.php?enquiry_id_status=' . $datarow['enquiry_id'] . '"  class="text-red-900 border border-red-600 bg-red-300 w-16 p-2">
  Inactive
</a>';
    $count++;
    echo ' <tr>
    <td class="px-6 py-4 whitespace-no-wrap">' . $count . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">' . $datarow['enquiry_company_name'] . '<br>' . $datarow['customer_code'] . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">' . $datarow['customer_name'] . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">' . $datarow['warehouse_name'] . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">' . $datarow['user_username'] . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">' . $datarow['enquiry_close_date'] . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">' . $datarow['enquiry_version'] . '</td>

    <td class="px-6 py-4 whitespace-no-wrap">
     ' . $activebtn . '
    </td>
    <td class="px-6 py-4 whitespace-no-wrap">
   <a href=""> <svg class="cursor-pointer" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="#007BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M14 2V8H20" stroke="#007BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M16 13H8" stroke="#007BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M16 17H8" stroke="#007BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M10 9H9H8" stroke="#007BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
 </a>
    </td>
    <td class="px-6 py-4 whitespace-no-wrap flex justify-between">
    <a href="add_sales_enquiry.php?enquiry_id=' . $datarow['enquiry_id'] . '">
      <svg class="mt-2" width="18" height="18" viewBox="0 0 24 24" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path d="M12 20H21" stroke="#8A8A8A" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path
          d="M16.5 3.50023C16.8978 3.1024 17.4374 2.87891 18 2.87891C18.2786 2.87891 18.5544 2.93378 18.8118 3.04038C19.0692 3.14699 19.303 3.30324 19.5 3.50023C19.697 3.69721 19.8532 3.93106 19.9598 4.18843C20.0665 4.4458 20.1213 4.72165 20.1213 5.00023C20.1213 5.2788 20.0665 5.55465 19.9598 5.81202C19.8532 6.06939 19.697 6.30324 19.5 6.50023L7 19.0002L3 20.0002L4 16.0002L16.5 3.50023Z"
          stroke="#8A8A8A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
      </a>
      <a href="../include/function.php?deleteenquiry_id=' . $datarow['enquiry_id'] . '">
      <svg class="mt-2" width="18" height="18" viewBox="0 0 24 24" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path d="M3 6H5H21" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path
          d="M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6"
          stroke="#FF3B2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M10 11V17" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path d="M14 11V17" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
      </svg>
      </a>
    </td> </tr>';
  }
}
function getjob_title()
{
  include 'config.php';
  $data = mysqli_query($conn, "SELECT * FROM `job_title`");
  $count = 0;
  while ($datarow = mysqli_fetch_array($data)) {
    $count++;
    $activebtn = $datarow['job_title_status'] == 1 ? ' <a style="cursor: pointer;" href=" ../include/function.php?job_title_status_id_status=' . $datarow['job_title_id'] . '" class="text-green-900 border border-green-600 bg-green-300 w-16 p-2">
    Active
  </a>' : '<a  style="cursor: pointer;" href=" ../include/function.php?job_title_id_status=' . $datarow['job_title_id'] . '"  class="text-red-900 border border-red-600 bg-red-300 w-16 p-2">
  Inactive
</a>';
    echo ' <tr><td class="px-6 py-4 whitespace-no-wrap">' . $count . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">' . $datarow['job_title_name'] . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">
    ' . $activebtn . '
    </td>
    <td class="px-6 py-4 whitespace-no-wrap flex justify-between">
    <a href="job_title.php?job_title_id=' . $datarow['job_title_id'] . '">
      <svg class="mt-2" width="18" height="18" viewBox="0 0 24 24" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path d="M12 20H21" stroke="#8A8A8A" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path
          d="M16.5 3.50023C16.8978 3.1024 17.4374 2.87891 18 2.87891C18.2786 2.87891 18.5544 2.93378 18.8118 3.04038C19.0692 3.14699 19.303 3.30324 19.5 3.50023C19.697 3.69721 19.8532 3.93106 19.9598 4.18843C20.0665 4.4458 20.1213 4.72165 20.1213 5.00023C20.1213 5.2788 20.0665 5.55465 19.9598 5.81202C19.8532 6.06939 19.697 6.30324 19.5 6.50023L7 19.0002L3 20.0002L4 16.0002L16.5 3.50023Z"
          stroke="#8A8A8A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
      </a>
      <a href="../include/function.php?deletejob_title_id=' . $datarow['job_title_id'] . '">
      <svg class="mt-2" width="18" height="18" viewBox="0 0 24 24" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path d="M3 6H5H21" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path
          d="M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6"
          stroke="#FF3B2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M10 11V17" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path d="M14 11V17" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
      </svg>
      </a>
    </td> </tr>';
  }
}
function getdepartment()
{
  include 'config.php';
  $data = mysqli_query($conn, "SELECT * FROM `department`");
  $count = 0;
  while ($datarow = mysqli_fetch_array($data)) {
    $count++;
    $activebtn = $datarow['department_status'] == 1 ? ' <a style="cursor: pointer;" href=" ../include/function.php?department_id_status=' . $datarow['department_id'] . '" class="text-green-900 border border-green-600 bg-green-300 w-16 p-2">
    Active
  </a>' : '<a  style="cursor: pointer;" href=" ../include/function.php?department_id_status=' . $datarow['department_id'] . '"  class="text-red-900 border border-red-600 bg-red-300 w-16 p-2">
  Inactive
</a>';
    echo ' <tr><td class="px-6 py-4 whitespace-no-wrap">' . $count . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">' . $datarow['department_name'] . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">
    ' . $activebtn . '
    </td>
    <td class="px-6 py-4 whitespace-no-wrap flex justify-between">
    <a href="department.php?department_id=' . $datarow['department_id'] . '">
      <svg class="mt-2" width="18" height="18" viewBox="0 0 24 24" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path d="M12 20H21" stroke="#8A8A8A" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path
          d="M16.5 3.50023C16.8978 3.1024 17.4374 2.87891 18 2.87891C18.2786 2.87891 18.5544 2.93378 18.8118 3.04038C19.0692 3.14699 19.303 3.30324 19.5 3.50023C19.697 3.69721 19.8532 3.93106 19.9598 4.18843C20.0665 4.4458 20.1213 4.72165 20.1213 5.00023C20.1213 5.2788 20.0665 5.55465 19.9598 5.81202C19.8532 6.06939 19.697 6.30324 19.5 6.50023L7 19.0002L3 20.0002L4 16.0002L16.5 3.50023Z"
          stroke="#8A8A8A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
      </a>
      <a href="../include/function.php?deletedepartment_id=' . $datarow['department_id'] . '">
      <svg class="mt-2" width="18" height="18" viewBox="0 0 24 24" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path d="M3 6H5H21" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path
          d="M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6"
          stroke="#FF3B2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M10 11V17" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path d="M14 11V17" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
      </svg>
      </a>
    </td> </tr>';
  }
}
function getgetcommunicationPreference()
{
  include 'config.php';
  $data = mysqli_query($conn, "SELECT * FROM `communication_preference`");
  $count = 0;
  while ($datarow = mysqli_fetch_array($data)) {
    $count++;
    $activebtn = $datarow['communication_preference_status'] == 1 ? ' <a style="cursor: pointer;" href=" ../include/function.php?communication_preference_id_status=' . $datarow['communication_preference_id'] . '" class="text-green-900 border border-green-600 bg-green-300 w-16 p-2">
    Active
  </a>' : '<a  style="cursor: pointer;" href=" ../include/function.php?communication_preference_id_status=' . $datarow['communication_preference_id'] . '"  class="text-red-900 border border-red-600 bg-red-300 w-16 p-2">
  Inactive
</a>';
    echo ' <tr><td class="px-6 py-4 whitespace-no-wrap">' . $count . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">' . $datarow['communication_preference_name'] . '</td>
    <td class="px-6 py-4 whitespace-no-wrap">
    ' . $activebtn . '
    </td>
    <td class="px-6 py-4 whitespace-no-wrap flex justify-between">
    <a href="communication_preference.php?communication_preference_id=' . $datarow['communication_preference_id'] . '">
      <svg class="mt-2" width="18" height="18" viewBox="0 0 24 24" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path d="M12 20H21" stroke="#8A8A8A" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path
          d="M16.5 3.50023C16.8978 3.1024 17.4374 2.87891 18 2.87891C18.2786 2.87891 18.5544 2.93378 18.8118 3.04038C19.0692 3.14699 19.303 3.30324 19.5 3.50023C19.697 3.69721 19.8532 3.93106 19.9598 4.18843C20.0665 4.4458 20.1213 4.72165 20.1213 5.00023C20.1213 5.2788 20.0665 5.55465 19.9598 5.81202C19.8532 6.06939 19.697 6.30324 19.5 6.50023L7 19.0002L3 20.0002L4 16.0002L16.5 3.50023Z"
          stroke="#8A8A8A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
      </a>
      <a href="../include/function.php?deletecommunication_preference_id=' . $datarow['communication_preference_id'] . '">
      <svg class="mt-2" width="18" height="18" viewBox="0 0 24 24" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path d="M3 6H5H21" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path
          d="M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6"
          stroke="#FF3B2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M10 11V17" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path d="M14 11V17" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
      </svg>
      </a>
    </td> </tr>';
  }
}
if (isset($_GET['deletecustomer'])) {

  $data = mysqli_query($conn, "DELETE FROM `customer` WHERE customer_id =" . $_GET['deletecustomer']);

  echo '<script>window.location.href = "../sales/customer.php"; </script>';
}
if (isset($_POST['customerCategory'])) {
  $sql = "INSERT INTO `customer_category`(`cu_cat_name`) VALUES (?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $_POST['customerCategory']);
  if ($stmt->execute()) {

    echo $conn->insert_id;
  }
  $stmt->close();
  $conn->close();
}

if (isset($_POST['customer_category_name_update'])) {
  $sql = "UPDATE `customer_category` SET `cu_cat_name`=? WHERE `cu_cat_id`= ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $_POST['customer_category_name_update'], $_POST['customer_category_name_update_id']);
  if ($stmt->execute()) {

    echo $conn->insert_id;
  }
  $stmt->close();
  $conn->close();
}
if (isset($_POST['customer_type_update'])) {
  $sql = "UPDATE `customer_type` SET `cu_ty_name`=? WHERE `cu_ty_id`= ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $_POST['customer_type_update'], $_POST['customer_type_update_id']);
  if ($stmt->execute()) {

    echo $conn->insert_id;
  }
  $stmt->close();
  $conn->close();
}
if (isset($_POST['customer_category_name_update'])) {
  $sql = "UPDATE `customer_category` SET `cu_cat_name`=? WHERE `cu_cat_id`= ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $_POST['customer_category_name_update'], $_POST['customer_category_name_update_id']);
  if ($stmt->execute()) {

    echo $conn->insert_id;
  }
  $stmt->close();
  $conn->close();
}
if (isset($_POST['communication_preference_name_update'])) {
  $sql = "UPDATE `communication_preference` SET `communication_preference_name`=? WHERE `communication_preference_id`= ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $_POST['communication_preference_name_update'], $_POST['communication_preference_id_update']);
  if ($stmt->execute()) {

    echo $conn->insert_id;
  }
  $stmt->close();
  $conn->close();
}
if (isset($_POST['customer_branch_warehouse_update'])) {
  $sql = "UPDATE `warehouse` SET `warehouse_name`=? WHERE `warehouse_id`= ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $_POST['customer_branch_warehouse_update'], $_POST['customer_branch_warehouse_update_id']);
  if ($stmt->execute()) {
    echo $conn->insert_id;
  }
  $stmt->close();
  $conn->close();
}
if (isset($_POST['Industry_name_update'])) {
  $sql = "UPDATE `industry` SET `Industry_name`=? WHERE `Industry_id`= ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $_POST['Industry_name_update'], $_POST['Industry_name_update_id']);
  if ($stmt->execute()) {

    echo $conn->insert_id;
  }
  $stmt->close();
  $conn->close();
}
if (isset($_POST['department_id_name_update'])) {
  $sql = "UPDATE `department` SET `department_name`=? WHERE `department_id`= ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $_POST['department_id_name_update'], $_POST['department_id_update']);
  if ($stmt->execute()) {

    echo $conn->insert_id;
  }
  $stmt->close();
  $conn->close();
}
if (isset($_POST['communication_preference_id_name_update'])) {
  $sql = "UPDATE `communication_preference` SET `communication_preference_name`=? WHERE `communication_preference_id`= ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $_POST['communication_preference_id_name_update'], $_POST['communication_preference_id_update']);
  if ($stmt->execute()) {

    echo $conn->insert_id;
  }
  $stmt->close();
  $conn->close();
}
if (isset($_POST['job_title_name_update'])) {
  $sql = "UPDATE `job_title` SET `job_title_name`=? WHERE `job_title_id`= ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $_POST['job_title_name_update'], $_POST['job_title_id_update']);
  if ($stmt->execute()) {

    echo $conn->insert_id;
  }
  $stmt->close();
  $conn->close();
}
if (isset($_POST['customerIndustry'])) {
  $sql = "INSERT INTO `industry`(`Industry_name`) VALUES (?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $_POST['customerIndustry']);
  if ($stmt->execute()) {

    echo $conn->insert_id;
  }
  $stmt->close();
  $conn->close();
}

if (isset($_POST['customer_type'])) {
  $sql = "INSERT INTO `customer_type`(`cu_ty_name`) VALUES (?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $_POST['customer_type']);
  if ($stmt->execute()) {

    echo $conn->insert_id;
  }
  $stmt->close();
  $conn->close();
}
if (isset($_POST['customer_source'])) {
  $sql = "INSERT INTO `source`(`source_name`) VALUES (?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $_POST['customer_source']);
  if ($stmt->execute()) {

    echo $conn->insert_id;
  }
  $stmt->close();
  $conn->close();
}
if (isset($_POST['customer_source_update'])) {
  $sql = "UPDATE `source` SET `source_name`=? WHERE `source_id`= ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $_POST['customer_source_update'], $_POST['customer_source_update_id']);
  if ($stmt->execute()) {

    echo $conn->insert_id;
  }
  $stmt->close();
  $conn->close();
}
if (isset($_POST['customer_branch_warehouse'])) {
  $sql = "INSERT INTO `warehouse`(`warehouse_name`) VALUES (?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $_POST['customer_branch_warehouse']);
  if ($stmt->execute()) {

    echo $conn->insert_id;
  }
  $stmt->close();
  $conn->close();
}
if (isset($_POST['sales_stage'])) {
  $sql = "INSERT INTO `enquiry_stage`(`stage_name`) VALUES (?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $_POST['sales_stage']);
  if ($stmt->execute()) {

    echo $conn->insert_id;
  }
  $stmt->close();
  $conn->close();
}
if (isset($_POST['company_category'])) {
  $sql = "INSERT INTO `sales_company_category`(`company_category_name`) VALUES (?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $_POST['company_category']);
  if ($stmt->execute()) {

    echo $conn->insert_id;
  }
  $stmt->close();
  $conn->close();
}
if (isset($_POST['product_group'])) {
  $sql = "INSERT INTO `product_group`(`product_group_name`) VALUES (?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $_POST['product_group']);
  if ($stmt->execute()) {

    echo $conn->insert_id;
  }
  $stmt->close();
  $conn->close();
}
if (isset($_GET['customercode'])) {
  $data = mysqli_query($conn, "SELECT * FROM `customer` WHERE  customer_code  = " . $_GET['customercode']);
  echo mysqli_num_rows($data);
}
if (isset($_POST['add_sales_enquiry'])) {
  $count = 1;
  $_SESSION['user_id'] = 1;

  $enquiry_code = mysqli_real_escape_string($conn, $_POST['enquiry_code']);
  $enquiry_customer_name = mysqli_real_escape_string($conn, $_POST['enquiry_customer_name']);
  $sales_branch_warehouse = mysqli_real_escape_string($conn, $_POST['sales_branch_warehouse']);
  $enquiry_name = mysqli_real_escape_string($conn, $_POST['enquiry_name']);
  $sales_stage = mysqli_real_escape_string($conn, $_POST['enquiry_sales_stage']);
  $sales_company_category = mysqli_real_escape_string($conn, $_POST['sales_company_category']);
  $enquiry_close_date = mysqli_real_escape_string($conn, $_POST['enquiry_close_date']);
  $enquiry_currency = mysqli_real_escape_string($conn, $_POST['enquiry_currency']);
  $enquiry_customer_type = mysqli_real_escape_string($conn, $_POST['enquiry_customer_type']);
  $enquiry_source = mysqli_real_escape_string($conn, $_POST['enquiry_source']);
  $enquiry_description = mysqli_real_escape_string($conn, $_POST['enquiry_description']);
  $enquiry_version = mysqli_real_escape_string($conn, $_POST['enquiry_version']);
  $assign_user_to = mysqli_real_escape_string($conn, $_POST['assign_user_to']);


  $stmt = $conn->prepare("INSERT INTO `sales_enquiry`
  ( `enquiry_code`, `enquiry_customer_name`, `sales_branch_warehouse`,
   `enquiry_name`, `sales_stage`,`sales_company_category`,`enquiry_version`,`enquiry_close_date`, 
   `enquiry_currency`, `enquiry_customer_type`,`enquiry_source`, `enquiry_description`
   ,`assign_user_to`,`enquiry_user_id`)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
  $stmt->bind_param(
    "ssssssssssssss",
    $enquiry_code,
    $enquiry_customer_name,
    $sales_branch_warehouse,
    $enquiry_name,
    $sales_stage,
    $sales_company_category,
    $enquiry_version,
    $enquiry_close_date,
    $enquiry_currency,
    $enquiry_customer_type,
    $enquiry_source,
    $enquiry_description,
    $assign_user_to,
    $_SESSION['user_id']
  );

  if ($stmt->execute()) {

    $last_id = $conn->insert_id;

    if (isset($_POST['product_description1'])) {

      while (isset($_POST['product_description' . $count])) {

        $product_description = mysqli_real_escape_string($conn, $_POST['product_description' . $count]);
        $part_number = mysqli_real_escape_string($conn, $_POST['part_number' . $count]);
        $product_hsn_code = mysqli_real_escape_string($conn, $_POST['product_hsn_code' . $count]);
        $product_quantity = mysqli_real_escape_string($conn, $_POST['product_quantity' . $count]);
        $product_rate = mysqli_real_escape_string($conn, $_POST['product_rate' . $count]);
        $product_amount = mysqli_real_escape_string($conn, $_POST['product_amount' . $count]);


        $stmt = $conn->prepare("INSERT INTO  `enquiry_product`(`enquiry_p_product_description`, `enquiry_p_part_number`, `enquiry_p_product_hsn_code`, `enquiry_p_product_quantity`, `enquiry_p_product_rate`, `enquiry_p_product_amount`,`enquiry_id`) 
                VALUES (?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssss", $product_description, $part_number, $product_hsn_code, $product_quantity, $product_rate, $product_amount, $last_id);
        $stmt->execute();
        $count++;
      }
    } else {
      // die();

    }
    echo '<script> window.location = "../sales/sales_enquiry.php"; </script>"';
  } else {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
}
if (isset($_POST['edit_sales_enquiry'])) {
  $count = 1;
  $_SESSION['user_id'] = 1;
  // echo $_POST['edit_sales_enquiry'];
  $enquiry_code = mysqli_real_escape_string($conn, $_POST['enquiry_code']);
  $enquiry_customer_name = mysqli_real_escape_string($conn, $_POST['enquiry_customer_name']);
  $enquiry_company_name = mysqli_real_escape_string($conn, $_POST['enquiry_company_name']);
  $sales_branch_warehouse = mysqli_real_escape_string($conn, $_POST['sales_branch_warehouse']);
  $enquiry_name = mysqli_real_escape_string($conn, $_POST['enquiry_name']);
  $sales_stage = mysqli_real_escape_string($conn, $_POST['enquiry_sales_stage']);
  $enquiry_version = mysqli_real_escape_string($conn, $_POST['enquiry_version']);
  $enquiry_close_date = mysqli_real_escape_string($conn, $_POST['enquiry_close_date']);
  $enquiry_currency = mysqli_real_escape_string($conn, $_POST['enquiry_currency']);
  $enquiry_customer_type = mysqli_real_escape_string($conn, $_POST['enquiry_customer_type']);
  $enquiry_source = mysqli_real_escape_string($conn, $_POST['enquiry_source']);
  $enquiry_description = mysqli_real_escape_string($conn, $_POST['enquiry_description']);
  $stmt = $conn->prepare("UPDATE `sales_enquiry` SET `enquiry_code`=?,`enquiry_customer_name`=?,`enquiry_company_name`=?,`sales_branch_warehouse`=?,`enquiry_name`=?,`sales_stage`=?,`enquiry_version`=?,`enquiry_close_date`=?,`enquiry_currency`=?,`enquiry_customer_type`=?,`enquiry_source`=?,`enquiry_description`=?,`enquiry_user_id`=? WHERE `enquiry_id`=?");
  $stmt->bind_param(
    "ssssssssssssss",
    $enquiry_code,
    $enquiry_customer_name,
    $enquiry_company_name,
    $sales_branch_warehouse,
    $enquiry_name,
    $sales_stage,
    $enquiry_version,
    $enquiry_close_date,
    $enquiry_currency,
    $enquiry_customer_type,
    $enquiry_source,
    $enquiry_description,
    $_SESSION['user_id'],
    $_POST['edit_sales_enquiry']
  );

  if ($stmt->execute()) {
    $last_id = $_POST['edit_sales_enquiry'];
    $address_data = mysqli_query($conn, "SELECT * FROM `enquiry_product` WHERE `enquiry_id` =" . $_POST['edit_sales_enquiry']);
    $count = 0;
    while ($addressdata = mysqli_fetch_array($address_data)) {
      $count++;
      $enquiry_p_id = $addressdata['enquiry_p_id'];
      $product_description = mysqli_real_escape_string($conn, $_POST['product_description' . $count]);
      $part_number = mysqli_real_escape_string($conn, $_POST['part_number' . $count]);
      $product_hsn_code = mysqli_real_escape_string($conn, $_POST['product_hsn_code' . $count]);
      $product_quantity = mysqli_real_escape_string($conn, $_POST['product_quantity' . $count]);
      $product_rate = mysqli_real_escape_string($conn, $_POST['product_rate' . $count]);
      $product_amount = mysqli_real_escape_string($conn, $_POST['product_amount' . $count]);

      $stmt = $conn->prepare("UPDATE `enquiry_product` SET `enquiry_p_product_description`=?,`enquiry_p_part_number`=?,`enquiry_p_product_hsn_code`=?,`enquiry_p_product_quantity`=?,`enquiry_p_product_rate`=?,`enquiry_p_product_amount`=?,`enquiry_id`=? WHERE `enquiry_p_id`= ?");

      $stmt->bind_param("ssssssss", $product_description, $part_number, $product_hsn_code, $product_quantity, $product_rate, $product_amount, $last_id,  $enquiry_p_id);
      $stmt->execute();
      $count++;
    }
  } else {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
  header("Location:  ../sales/sales_enquiry.php");
}

if (isset($_POST['add_sales_quotation'])) {
  $count = 1;
  $_SESSION['user_id'] = 1;

  $qsales_quotation_number = mysqli_real_escape_string($conn, $_POST['qsales_quotation_number']);
  $sales_quotation_cc_name = mysqli_real_escape_string($conn, $_POST['sales_quotation_cc_name']);
  $qsales_quotation_subject = mysqli_real_escape_string($conn, $_POST['qsales_quotation_subject']);
  $sales_quotation_enquiry = mysqli_real_escape_string($conn, $_POST['sales_quotation_enquiry']);
  $sales_quotation_branch_warehouse = mysqli_real_escape_string($conn, $_POST['sales_quotation_branch_warehouse']);
  $sales_quotation_contact = mysqli_real_escape_string($conn, $_POST['sales_quotation_contact']);
  $sales_quotation_version = mysqli_real_escape_string($conn, $_POST['sales_quotation_version']);
  $sales_quotation_valid_till = mysqli_real_escape_string($conn, $_POST['sales_quotation_valid_till']);
  $sales_quotation_currency = mysqli_real_escape_string($conn, $_POST['sales_quotation_currency']);
  $sales_quotation_type = mysqli_real_escape_string($conn, $_POST['sales_quotation_type']);
  $sales_quotation_sr_by = mysqli_real_escape_string($conn, $_POST['sales_quotation_sr_by']);
  $sales_quotation_description = mysqli_real_escape_string($conn, $_POST['sales_quotation_description']);



  $stmt = $conn->prepare("INSERT INTO `quotation`( `qsales_quotation_number`, `sales_quotation_cc_name`, `qsales_quotation_subject`, `sales_quotation_enquiry`, `sales_branch_warehouse`, `sales_quotation_contact`, `qsales_quotation_version`, `sales_quotation_valid_till`, `sales_quotation_currency`, `sales_quotation_type`, `sales_quotation_sr_by`, `sales_quotation_description`,`sales_quotation_cerated_bye`) VALUES
   (?,?,?,?,?,?,?,?,?,?,?,?,?)");
  $stmt->bind_param(
    "sssssssssssss",
    $qsales_quotation_number,
    $sales_quotation_cc_name,
    $qsales_quotation_subject,
    $sales_quotation_enquiry,
    $sales_quotation_branch_warehouse,
    $sales_quotation_contact,
    $sales_quotation_version,
    $sales_quotation_valid_till,
    $sales_quotation_currency,
    $sales_quotation_type,
    $sales_quotation_sr_by,
    $sales_quotation_description,
    $_SESSION['user_id']
  );

  if ($stmt->execute()) {
    $stmt->close();
    header("Location:  ../sales/sales_quotation.php");
  }
}
function getsales_quotation()
{
  include 'config.php';
  $data = mysqli_query($conn, "SELECT * FROM quotation join customer on customer.customer_id   = quotation.sales_quotation_cc_name join user on quotation.sales_quotation_cerated_bye = user.user_id join warehouse on  quotation.sales_branch_warehouse = warehouse.warehouse_id ");
  $count = 0;
  while ($datarow = mysqli_fetch_array($data)) {
    $count++;
    echo ' <tr>
      <td class="px-6 py-4 whitespace-no-wrap">' . $count . '</td>
      <td class="px-6 py-4 whitespace-no-wrap">' . $datarow['customer_company_name'] . '<br>' . $datarow['qsales_quotation_number'] . '</td>
      <td class="px-6 py-4 whitespace-no-wrap">' . $datarow['user_username'] . '</td>
      <td class="px-6 py-4 whitespace-no-wrap">' . $datarow['sales_quotation_date'] . '</td>
      <td class="px-6 py-4 whitespace-no-wrap">' . $datarow['sales_quotation_valid_till'] . '</td>
      <td class="px-6 py-4 whitespace-no-wrap">' . $datarow['qsales_quotation_version'] . '</td>
  
      <td class="px-6 py-4 whitespace-no-wrap">
        <button class="text-green-900 border border-green-600 bg-green-300 w-16 p-2">
          Active
        </button>
      </td> 
      <td class="px-6 py-4 whitespace-no-wrap">
     <a href=""> <svg class="cursor-pointer" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="#007BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M14 2V8H20" stroke="#007BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M16 13H8" stroke="#007BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M16 17H8" stroke="#007BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M10 9H9H8" stroke="#007BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
   </a>
      </td>
      <td class="px-6 py-4 whitespace-no-wrap flex justify-between">
      <a href="add_sales_enquiry.php?quotation_id=' . $datarow['quotation_id'] . '">
        <svg class="mt-2" width="18" height="18" viewBox="0 0 24 24" fill="none"
          xmlns="http://www.w3.org/2000/svg">
          <path d="M12 20H21" stroke="#8A8A8A" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" />
          <path
            d="M16.5 3.50023C16.8978 3.1024 17.4374 2.87891 18 2.87891C18.2786 2.87891 18.5544 2.93378 18.8118 3.04038C19.0692 3.14699 19.303 3.30324 19.5 3.50023C19.697 3.69721 19.8532 3.93106 19.9598 4.18843C20.0665 4.4458 20.1213 4.72165 20.1213 5.00023C20.1213 5.2788 20.0665 5.55465 19.9598 5.81202C19.8532 6.06939 19.697 6.30324 19.5 6.50023L7 19.0002L3 20.0002L4 16.0002L16.5 3.50023Z"
            stroke="#8A8A8A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        </a>
        <a href="../include/function.php?deletequotation_id=' . $datarow['quotation_id'] . '">
        <svg class="mt-2" width="18" height="18" viewBox="0 0 24 24" fill="none"
          xmlns="http://www.w3.org/2000/svg">
          <path d="M3 6H5H21" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" />
          <path
            d="M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6"
            stroke="#FF3B2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M10 11V17" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" />
          <path d="M14 11V17" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" />
        </svg>
        </a>
      </td> </tr>';
  }
}
function getselecterdata($data, $selecter)
{
  echo "<script>
$('" . $selecter . "').val('" . $data . "'); 
$('" . $selecter . "').trigger('change'); </script> ";
}
if (isset($_GET['customerdata'])) {
  $customerquery = mysqli_query($conn, "SELECT * FROM customer join customer_type on customer.customer_type  = cu_ty_id join user on customer.customer_created_by = user.user_id join source on source.source_id  = customer.customer_source  join warehouse on  customer.customer_branch = warehouse.warehouse_id where customer_id = " . $_GET['customerdata']);
  $customerdata = mysqli_fetch_assoc($customerquery);
  echo json_encode($customerdata);
}
if (isset($_GET['changestatus'])) {
  $stmt = $conn->prepare("UPDATE `customer` SET `customer_status` = 1- `customer_status`  WHERE `customer_id`=  ? ");

  $stmt->bind_param("s", $_GET['changestatus']);
  $stmt->execute();
  echo json_encode(['success' => true]);
}
if (isset($_GET['cu_cat_id_status'])) {
  $stmt = $conn->prepare("UPDATE `customer_category` SET `cu_cat_status` = 1- `cu_cat_status`  WHERE `cu_cat_id`=  ? ");
  $stmt->bind_param("s", $_GET['cu_cat_id_status']);
  $stmt->execute();
  echo '<script> window.location.href = "../other_pages/customer_category.php" </script> ';
}
if (isset($_GET['Industry_id_status'])) {
  $stmt = $conn->prepare("UPDATE `industry` SET `Industry_status` = 1- `Industry_status`  WHERE `Industry_id`=  ? ");
  $stmt->bind_param("s", $_GET['Industry_id_status']);
  $stmt->execute();
  echo '<script> window.location.href = "../other_pages/industry.php" </script> ';
}
if (isset($_GET['cu_ty_id_status'])) {
  $stmt = $conn->prepare("UPDATE `customer_type` SET `cu_ty_status` = 1- `cu_ty_status`  WHERE `cu_ty_id`=  ? ");
  $stmt->bind_param("s", $_GET['cu_ty_id_status']);
  $stmt->execute();
  echo '<script> window.location.href = "../other_pages/customer_type.php" </script> ';
}
if (isset($_GET['source_id_status'])) {
  $stmt = $conn->prepare("UPDATE `source` SET `source_status` = 1- `source_status`  WHERE `source_id`=  ? ");
  $stmt->bind_param("s", $_GET['source_id_status']);
  $stmt->execute();
  echo '<script> window.location.href = "../other_pages/source_referred_by.php" </script> ';
}
if (isset($_GET['warehouse_id_status'])) {
  $stmt = $conn->prepare("UPDATE `warehouse` SET `warehouse_status` = 1- `warehouse_status`  WHERE `warehouse_id`=  ? ");
  $stmt->bind_param("s", $_GET['warehouse_id_status']);
  $stmt->execute();
  echo '<script> window.location.href = "../other_pages/branch_warehouse.php" </script> ';
}
if (isset($_GET['customer_id_status'])) {
  $stmt = $conn->prepare("UPDATE `sales_enquiry` SET `warehouse_status` = 1- `warehouse_status`  WHERE `warehouse_id`=  ? ");
  $stmt->bind_param("s", $_GET['customer_id_status']);
  $stmt->execute();
  echo '<script> window.location.href = "../other_pages/branch_warehouse.php" </script> ';
}
if (isset($_GET['enquiry_id_status'])) {
  $stmt = $conn->prepare("UPDATE `sales_enquiry` SET `enquiry_id_status` = 1- `enquiry_id_status`  WHERE `enquiry_id`=  ? ");
  $stmt->bind_param("s", $_GET['enquiry_id_status']);
  $stmt->execute();
  echo '<script> window.location.href = "../sales/sales_enquiry.php" </script> ';
}
if (isset($_GET['job_title_status_id_status'])) {
 
  $stmt = $conn->prepare("UPDATE `job_title` SET `job_title_status` = 1- `job_title_status`  WHERE `job_title_id`=  ? ");
  $stmt->bind_param("s", $_GET['job_title_status_id_status']);
  $stmt->execute();
   echo '<script> window.location.href = "../other_pages/job_title.php" </script> ';
}

if (isset($_GET['department_id_status'])) {
 
  $stmt = $conn->prepare("UPDATE `department` SET `department_status` = 1- `department_status`  WHERE `department_id`=  ? ");
  $stmt->bind_param("s", $_GET['department_id_status']);
  $stmt->execute();
   echo '<script> window.location.href = "../other_pages/department.php" </script> ';
}
if (isset($_GET['communication_preference_id_status'])) {
 
  $stmt = $conn->prepare("UPDATE `communication_preference` SET `communication_preference_status` = 1- `communication_preference_status`  WHERE `communication_preference_id`=  ? ");
  $stmt->bind_param("s", $_GET['communication_preference_id_status']);
  $stmt->execute();
   echo '<script> window.location.href = "../other_pages/communication_preference.php" </script> ';
}

if (isset($_GET['deletejob_title_id'])) {
  $stmt = $conn->prepare("DELETE FROM `job_title` WHERE `job_title_id`=  ? ");
  $stmt->bind_param("s", $_GET['deletejob_title_id']);
  $stmt->execute();
  echo '<script> window.location.href = "../other_pages/job_title.php" </script> ';
}
if (isset($_GET['delete_quotation_id'])) {
  $stmt = $conn->prepare("DELETE FROM `contact_quotation` WHERE `contact_quotation_id`=  ? ");
  $stmt->bind_param("s", $_GET['delete_quotation_id']);
  $stmt->execute();
  echo '<script> window.location.href = "../sales/contact.php" </script> ';
}

if (isset($_GET['deletedepartment_id'])) {
  $stmt = $conn->prepare("DELETE FROM `department` WHERE `department_id`=  ? ");
  $stmt->bind_param("s", $_GET['deletedepartment_id']);
  $stmt->execute();
  echo '<script> window.location.href = "../other_pages/department.php" </script> ';
}

if (isset($_GET['deletecommunication_preference_id'])) {
  $stmt = $conn->prepare("DELETE FROM `communication_preference` WHERE `communication_preference_id`=  ? ");
  $stmt->bind_param("s", $_GET['deletecommunication_preference_id']);
  $stmt->execute();
  echo '<script> window.location.href = "../other_pages/communication_preference.php" </script> ';
}


if (isset($_GET['customer_category_delete'])) {
  $stmt = $conn->prepare("DELETE FROM `customer_category` WHERE `cu_cat_id`=  ? ");
  $stmt->bind_param("s", $_GET['customer_category_delete']);
  $stmt->execute();
  echo '<script> window.location.href = "../other_pages/customer_category.php" </script> ';
}
if (isset($_GET['deleteIndustry'])) {
  $stmt = $conn->prepare("DELETE FROM `industry` WHERE `Industry_id`=  ? ");
  $stmt->bind_param("s", $_GET['deleteIndustry']);
  $stmt->execute();
  echo '<script> window.location.href = "../other_pages/industry.php" </script> ';
}
if (isset($_GET['cu_ty_id_delete'])) {
  $stmt = $conn->prepare("DELETE FROM `customer_type` WHERE `cu_ty_id`=  ? ");
  $stmt->bind_param("s", $_GET['cu_ty_id_delete']);
  $stmt->execute();
  echo '<script> window.location.href = "../other_pages/customer_type.php" </script> ';
}

if (isset($_GET['source_id_delete'])) {
  $stmt = $conn->prepare("DELETE FROM `source` WHERE `source_id`=  ? ");
  $stmt->bind_param("s", $_GET['source_id_delete']);
  $stmt->execute();
  echo '<script> window.location.href = "../other_pages/source_referred_by.php" </script> ';
}
if (isset($_GET['deletewarehouse_id'])) {
  $stmt = $conn->prepare("DELETE FROM `warehouse` WHERE `warehouse_id`=  ? ");
  $stmt->bind_param("s", $_GET['deletewarehouse_id']);
  $stmt->execute();
  echo '<script> window.location.href = "../other_pages/branch_warehouse.php" </script> ';
}



if (isset($_POST['add_sales_quotation_contact'])) {


  $_SESSION['user_id'] = 1;
  $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
  $prefix = mysqli_real_escape_string($conn, $_POST['prefix']);
  $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
  $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
  $email1 = mysqli_real_escape_string($conn, $_POST['email1']);
  $email2 = mysqli_real_escape_string($conn, $_POST['email2']);
  $mobile_no1 = mysqli_real_escape_string($conn, $_POST['mobile_no1']);
  $mobile_no2 = mysqli_real_escape_string($conn, $_POST['mobile_no2']);
  $job_title = mysqli_real_escape_string($conn, $_POST['job_title']);
  $department = mysqli_real_escape_string($conn, $_POST['department']);
  $skype_id = mysqli_real_escape_string($conn, $_POST['skype_id']);
  $communication_preference = mysqli_real_escape_string($conn, $_POST['communication_preference']);
  $website_link = mysqli_real_escape_string($conn, $_POST['website_link']);
  $linkedln_profile = mysqli_real_escape_string($conn, $_POST['linkedln_profile']);
  $shipping_address = mysqli_real_escape_string($conn, $_POST['shipping_address']);
  $shipping_country = mysqli_real_escape_string($conn, $_POST['shipping_country']);
  $shipping_state = mysqli_real_escape_string($conn, $_POST['shipping_state']);
  $shipping_city = mysqli_real_escape_string($conn, $_POST['shipping_city']);
  $shipping_postal_code = mysqli_real_escape_string($conn, $_POST['shipping_postal_code']);
  $billing_address = mysqli_real_escape_string($conn, $_POST['billing_address']);
  $billing_country = mysqli_real_escape_string($conn, $_POST['billing_country']);
  $billing_state = mysqli_real_escape_string($conn, $_POST['billing_state']);
  $billing_city = mysqli_real_escape_string($conn, $_POST['billing_city']);
  $billing_postal_code = mysqli_real_escape_string($conn, $_POST['billing_postal_code']);
  $date_of_birth = mysqli_real_escape_string($conn, $_POST['date_of_birth']);

  $fax = mysqli_real_escape_string($conn, $_POST['fax']);
  $home_phone = mysqli_real_escape_string($conn, $_POST['home_phone']);
  $other_phone = mysqli_real_escape_string($conn, $_POST['other_phone']);

  $stmt = $conn->prepare("INSERT INTO `contact_quotation`(`company_name`, `prefix`, `first_name`, `last_name`, `email1`, `email2`, `mobile_no1`,
   `mobile_no2`, `job_title`, `department`, `skype_id`,`communication_preference`, `website_link`, `linkedln_profile`, `shipping_address`, 
   `shipping_country`, `shipping_state`, `shipping_city`, `shipping_postal_code`, `billing_address`, `billing_country`, `billing_state`, 
   `billing_city`, `billing_postal_code`, `date_of_birth`, `fax`, `home_phone`, `other_phone`,`created_by`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
  $stmt->bind_param(
    "ssssssssssssssssssssssssssssi",
    $company_name,
    $prefix,
    $first_name,
    $last_name,
    $email1,
    $email2,
    $mobile_no1,
    $mobile_no2,
    $job_title,
    $department,
    $skype_id,
    $communication_preference,
    $website_link,
    $linkedln_profile,
    $shipping_address,
    $shipping_country,
    $shipping_state,
    $shipping_city,
    $shipping_postal_code,
    $billing_address,
    $billing_country,
    $billing_state,
    $billing_city,
    $billing_postal_code,
    $date_of_birth,
    $fax,
    $home_phone,
    $other_phone,
    $_SESSION['user_id'],
  );
  if ($stmt->execute()) {
    echo '<script>window.location.href = "../sales/contact.php"; </script>';
  }
}


if (isset($_POST['update_sales_quotation_contact'])) {


  $_SESSION['user_id'] = 1;
  $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
  $prefix = mysqli_real_escape_string($conn, $_POST['prefix']);
  $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
  $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
  $email1 = mysqli_real_escape_string($conn, $_POST['email1']);
  $email2 = mysqli_real_escape_string($conn, $_POST['email2']);
  $mobile_no1 = mysqli_real_escape_string($conn, $_POST['mobile_no1']);
  $mobile_no2 = mysqli_real_escape_string($conn, $_POST['mobile_no2']);
  $job_title = mysqli_real_escape_string($conn, $_POST['job_title']);
  $department = mysqli_real_escape_string($conn, $_POST['department']);
  $skype_id = mysqli_real_escape_string($conn, $_POST['skype_id']);
  $communication_preference = mysqli_real_escape_string($conn, $_POST['communication_preference']);
  $website_link = mysqli_real_escape_string($conn, $_POST['website_link']);
  $linkedln_profile = mysqli_real_escape_string($conn, $_POST['linkedln_profile']);
  $shipping_address = mysqli_real_escape_string($conn, $_POST['shipping_address']);
  $shipping_country = mysqli_real_escape_string($conn, $_POST['shipping_country']);
  $shipping_state = mysqli_real_escape_string($conn, $_POST['shipping_state']);
  $shipping_city = mysqli_real_escape_string($conn, $_POST['shipping_city']);
  $shipping_postal_code = mysqli_real_escape_string($conn, $_POST['shipping_postal_code']);
  $billing_address = mysqli_real_escape_string($conn, $_POST['billing_address']);
  $billing_country = mysqli_real_escape_string($conn, $_POST['billing_country']);
  $billing_state = mysqli_real_escape_string($conn, $_POST['billing_state']);
  $billing_city = mysqli_real_escape_string($conn, $_POST['billing_city']);
  $billing_postal_code = mysqli_real_escape_string($conn, $_POST['billing_postal_code']);
  $date_of_birth = mysqli_real_escape_string($conn, $_POST['date_of_birth']);

  $fax = mysqli_real_escape_string($conn, $_POST['fax']);
  $home_phone = mysqli_real_escape_string($conn, $_POST['home_phone']);
  $other_phone = mysqli_real_escape_string($conn, $_POST['other_phone']);

  $modified_date= date("Y/m/d"); 
  $stmt = $conn->prepare("UPDATE `contact_quotation` SET `company_name`=?,`prefix`=?,`first_name`=?,`last_name`=?,`email1`=?,`email2`=?,
  `mobile_no1`=?,`mobile_no2`=?,`job_title`=?,`department`=?,`skype_id`=?,`communication_preference`=?,`website_link`=?,`linkedln_profile`=?,
  `shipping_address`=?,`shipping_country`=?,`shipping_state`=?,`shipping_city`=?,`shipping_postal_code`=?,`billing_address`=?,`billing_country`=?,
  `billing_state`=?,`billing_city`=?,`billing_postal_code`=?,`date_of_birth`=?,`fax`=?,`home_phone`=?,`other_phone`=?, `created_by`=? ,`modified_date` = ? WHERE `contact_quotation_id`=?");
  $stmt->bind_param(
    "ssssssssssssssssssssssssssssiss",
    $company_name,
    $prefix,
    $first_name,
    $last_name,
    $email1,
    $email2,
    $mobile_no1,
    $mobile_no2,
    $job_title,
    $department,
    $skype_id,
    $communication_preference,
    $website_link,
    $linkedln_profile,
    $shipping_address,
    $shipping_country,
    $shipping_state,
    $shipping_city,
    $shipping_postal_code,
    $billing_address,
    $billing_country,
    $billing_state,
    $billing_city,
    $billing_postal_code,
    $date_of_birth,
    $fax,
    $home_phone,
    $other_phone,
   
    $_SESSION['user_id'],
    $modified_date,
    $_POST['update_sales_quotation_contact']
 
  );
  if ($stmt->execute()) {
     echo '<script>window.location.href = "../sales/contact.php"; </script>';
  }
}
if (isset($_POST['prefixdata'])) {
  $sql = "INSERT INTO `prefix`(`prefix_name`) VALUES (?) ";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $_POST['prefixdata']);
  if ($stmt->execute()) {

    echo $conn->insert_id;
  }
  $stmt->close();
  $conn->close();
}
if (isset($_POST['job_titledata'])) {
  $sql = "INSERT INTO `job_title`(`job_title_name`) VALUES (?) ";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $_POST['job_titledata']);
  if ($stmt->execute()) {

    echo $conn->insert_id;
  }
  $stmt->close();
  $conn->close();
}
if (isset($_POST['departmentdata'])) {
  $sql = "INSERT INTO `department`(`department_name`) VALUES (?) ";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $_POST['departmentdata']);
  if ($stmt->execute()) {

    echo $conn->insert_id;
  }
  $stmt->close();
  $conn->close();
}
if (isset($_POST['communication_preferencedata'])) {
  $sql = "INSERT INTO `communication_preference`(`communication_preference_name`) VALUES (?) ";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $_POST['communication_preferencedata']);
  if ($stmt->execute()) {

    echo $conn->insert_id;
  }
  $stmt->close();
  $conn->close();
}