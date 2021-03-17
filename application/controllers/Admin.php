<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    //  DEFAULT FUNCTION
    public function index()
    {
        $this->load->view('backend/index');
    }

    //  ADMIN DASHBOARD
    function dashboard()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        $page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = 'Dashboard';
        $this->load->view('backend/index', $page_data);
    }


    //  MANAGE CUSTOMER
    function getClients($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        if ($param1 == 'create') {
            $data['customer_code'] = $this->input->post('customer_code');
            $data['name'] = $this->input->post('name');
            // $data['email'] = $this->input->post('email');
            // $data['password'] = sha1($this->input->post('password'));
            $data['phone'] = $this->input->post('phone');
            $data['address'] = $this->input->post('address');
            $data['client_pop'] = $this->input->post('client_pop');
            $data['pop_location'] = $this->input->post('pop_location');
            $this->db->insert('customer', $data);
            // UPLOAD IMAGE FILE
            $customer_id = $this->db->insert_id();
            // move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/customer_image/' . $customer_id . '.jpg');

            // Send mail to newly created customer
            $password_unhashed = $this->input->post('password');
            // $email_to = $data['email'];
            $this->session->set_flashdata('flash_message', 'A New Customer has Been Created');
            // $this->email_model->account_opening_email('customer', $email_to, $password_unhashed);
            redirect(base_url() . 'index.php?admin/getClients', 'refresh');
        }
        if ($param1 == 'edit') {
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');
            $data['address'] = $this->input->post('address');
            $data['gender'] = $this->input->post('gender');
            $data['discount_percentage'] = $this->input->post('discount_percentage');
            $this->db->where('customer_id', $param2);
            $this->db->update('customer', $data);


            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/customer_image/' . $param2 . '.jpg');
            $this->session->set_flashdata('flash_message', 'Customer Information Has Been Updated');
            redirect(base_url() . 'index.php?admin/getCustomers', 'refresh');
        }
        if ($param1 == 'delete') {

            // For Soft Delete We actually don't need to delete the avatar image
//            if (file_exists("uploads/customer_image/" . $param2 . ".jpg")) {
//                unlink("uploads/customer_image/" . $param2 . ".jpg");
//            }
            $this->db->where('customer_id', $param2);
            $this->db->update('customer', array('softDelete' => 1));
            $this->session->set_flashdata('flash_message', 'Customer Information has Been Deleted');
            redirect(base_url() . 'index.php?admin/getCustomers', 'refresh');
        }
        $page_data['page_name'] = 'customer';
        $page_data['page_title'] = 'Clients';
        $page_data['customers'] = $this->db->get_where('customer', array('softDelete' => 0))->result_array();
        $this->load->view('backend/index', $page_data);
    }

    function getVendors($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        if ($param1 == 'create') {
            // $data['id'] = $this->input->post('id');
            $data['name'] = $this->input->post('name');
            // $data['email'] = $this->input->post('email');
            // $data['password'] = sha1($this->input->post('password'));
            $data['cnic/ntn'] = $this->input->post('cnic');
            $data['sales'] = $this->input->post('sales');
            $data['whtax'] = $this->input->post('whtax');
            $data['sales_tax'] = $this->input->post('sales_tax');
            $this->db->insert('vendors', $data);
            // UPLOAD IMAGE FILE
            // $customer_id = $this->db->insert_id();
            // move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/customer_image/' . $customer_id . '.jpg');

            // Send mail to newly created customer
            // $password_unhashed = $this->input->post('password');
            // $email_to = $data['email'];
            $this->session->set_flashdata('flash_message', 'A New Vendor has Been Created');
            // $this->email_model->account_opening_email('customer', $email_to, $password_unhashed);
            redirect(base_url() . 'index.php?admin/getVendors', 'refresh');
        }
        if ($param1 == 'edit') {
            $data['name'] = $this->input->post('name');
            // $data['email'] = $this->input->post('email');
            // $data['password'] = sha1($this->input->post('password'));
            $data['cnic'] = $this->input->post('cnic');
            $data['sales'] = $this->input->post('sales');
            $data['whtax'] = $this->input->post('whtax');
            $data['sales_tax'] = $this->input->post('sales_tax');

            
            $this->db->where('id', $param2);
            $this->db->update('vendors', $data);


            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/customer_image/' . $param2 . '.jpg');
            $this->session->set_flashdata('flash_message', 'Customer Information Has Been Updated');
            redirect(base_url() . 'index.php?admin/getCustomers', 'refresh');
        }
        if ($param1 == 'delete') {

            // For Soft Delete We actually don't need to delete the avatar image
//            if (file_exists("uploads/customer_image/" . $param2 . ".jpg")) {
//                unlink("uploads/customer_image/" . $param2 . ".jpg");
//            }
            $this->db->where('customer_id', $param2);
            $this->db->update('customer', array('softDelete' => 1));
            $this->session->set_flashdata('flash_message', 'Customer Information has Been Deleted');
            redirect(base_url() . 'index.php?admin/getCustomers', 'refresh');
        }
        $page_data['page_name'] = 'vendors';
        $page_data['page_title'] = 'Vendors';
        $page_data['vendors'] = $this->db->get('vendors')->result_array();

        // print_r($page_data);
        // exit();

        $this->load->view('backend/index', $page_data);
    }



    /**
     * Deleted Customers operations
     *
     * @param string $param1
     * @param string $param2
     * @param string $param3
     */

    function dcustomer($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        if ($param1 == 'delete') {
            if (file_exists("uploads/customer_image/" . $param2 . ".jpg")) {
                unlink("uploads/customer_image/" . $param2 . ".jpg");
            }
            $this->db->where('customer_id', $param2);
            $this->db->delete('customer');
            $this->session->set_flashdata('flash_message', ('Customer Information Permanently Deleted'));
            redirect(base_url() . 'index.php?admin/dcustomer', 'refresh');
        }
        if ($param1 == 'restore') {
            if (file_exists("uploads/customer_image/" . $param2 . ".jpg")) {
                unlink("uploads/customer_image/" . $param2 . ".jpg");
            }
            $this->db->where('customer_id', $param2);
            $this->db->update('customer', array('softDelete' => 0));
            $this->session->set_flashdata('flash_message', ('Customer Information Has Been Restored'));
            redirect(base_url() . 'index.php?admin/dcustomer', 'refresh');
        }

        $page_data['page_name'] = 'deleted_customers';
        $page_data['page_title'] = 'Deleted Customers';
        $page_data['deleted_customers'] = $this->db->get_where('customer', array('softDelete' => 1))->result_array();
        $this->load->view('backend/index', $page_data);
    }

    //  MANAGE SUPPLIER
    function getSuppliers($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        if ($param1 == 'create') {
            $data['name'] = $this->input->post('name');
            $data['company'] = $this->input->post('company');
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');
            $this->db->insert('supplier', $data);
            // UPLOAD IMAGE FILE
            $supplier_id = $this->db->insert_id();
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/supplier_image/' . $supplier_id . '.jpg');
            $this->session->set_flashdata('flash_message', 'New Supplier Has Been Created');
            redirect(base_url() . 'index.php?admin/getSuppliers', 'refresh');
        }
        if ($param1 == 'edit') {
            $data['name'] = $this->input->post('name');
            $data['company'] = $this->input->post('company');
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');
            $this->db->where('supplier_id', $param2);
            $this->db->update('supplier', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/supplier_image/' . $param2 . '.jpg');
            $this->session->set_flashdata('flash_message', 'Supplier Information Has Been Updated');
            redirect(base_url() . 'index.php?admin/getSuppliers', 'refresh');
        }
        if ($param1 == 'delete') {
//            if (file_exists("uploads/supplier_image/" . $param2 . ".jpg")) {
//                unlink("uploads/supplier_image/ " . $param2 . ".jpg");
//            }
            $this->db->where('supplier_id', $param2);
            $this->db->update('supplier', array('softDelete' => 1));
            $this->session->set_flashdata('flash_message', 'Supplier Information Has Been Deleted');
            redirect(base_url() . 'index.php?admin/getSuppliers', 'refresh');
        }
        $page_data['page_name'] = 'supplier';
        $page_data['page_title'] = 'Suppliers';
        $page_data['suppliers'] = $this->db->get_where('supplier', array('softDelete' => 0))->result_array();
        $this->load->view('backend/index', $page_data);
    }


    function dsupplier($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        if ($param1 == 'delete') {
            if (file_exists("uploads/supplier_image/" . $param2 . ".jpg")) {
                unlink("uploads/supplier_image/" . $param2 . ".jpg");
            }
            $this->db->where('supplier_id', $param2);
            $this->db->delete('supplier');
            $this->session->set_flashdata('flash_message', ('Supplier Information Has Been Permanently Deleted'));
            redirect(base_url() . 'index.php?admin/dsupplier', 'refresh');
        }
        if ($param1 == 'restore') {
            if (file_exists("uploads/supplier_image/" . $param2 . ".jpg")) {
                unlink("uploads/supplier_image/" . $param2 . ".jpg");
            }
            $this->db->where('supplier_id', $param2);
            $this->db->update('supplier', array('softDelete' => 0));
            $this->session->set_flashdata('flash_message', ('Supplier Information Has Been Restored'));
            redirect(base_url() . 'index.php?admin/dsupplier', 'refresh');
        }

        $page_data['page_name'] = 'deleted_suppliers';
        $page_data['page_title'] = 'Deleted Suppliers';
        $page_data['deleted_suppliers'] = $this->db->get_where('supplier', array('softDelete' => 1))->result_array();
        $this->load->view('backend/index', $page_data);
    }


    //  MANAGE PRODUCT CATEGORY
    function add_product_category($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        if ($param1 == 'create') {
            $data['name'] = $this->input->post('name');
            $data['description'] = $this->input->post('description');
            $this->db->insert('category', $data);
            $this->session->set_flashdata('flash_message', 'A New Product Category Has Been Created');
            redirect(base_url() . 'index.php?admin/add_product_category', 'refresh');
        }
        if ($param1 == 'edit') {
            $data['name'] = $this->input->post('name');
            $data['description'] = $this->input->post('description');
            $this->db->where('category_id', $param2);
            $this->db->update('category', $data);
            $this->session->set_flashdata('flash_message', 'Product Category Has Been Updated');
            redirect(base_url() . 'index.php?admin/add_product_category', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('category_id', $param2);
            $this->db->delete('category');
            $this->session->set_flashdata('flash_message', 'Product Category Has Been Deleted');
            redirect(base_url() . 'index.php?admin/add_product_category', 'refresh');
        }
        $page_data['page_name'] = 'product_category';
        $page_data['page_title'] = 'Product Categories';
        $page_data['categories'] = $this->db->get('category')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    //  MANAGE PRODUCT SUB CATEGORY
    function add_product_sub_category($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        if ($param1 == 'create') {
            $data['name'] = $this->input->post('name');
            $data['description'] = $this->input->post('description');
            $data['category_id'] = $this->input->post('category_id');
            $this->db->insert('sub_category', $data);
            $this->session->set_flashdata('flash_message', 'Product Sub Category Has Been Created');
            redirect(base_url() . 'index.php?admin/add_product_sub_category', 'refresh');
        }
        if ($param1 == 'edit') {
            $data['name'] = $this->input->post('name');
            $data['description'] = $this->input->post('description');
            $data['category_id'] = $this->input->post('category_id');
            $this->db->where('sub_category_id', $param2);
            $this->db->update('sub_category', $data);
            $this->session->set_flashdata('flash_message', 'Product Sub Category Information Has Been Updated');
            redirect(base_url() . 'index.php?admin/add_product_sub_category', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('sub_category_id', $param2);
            $this->db->delete('sub_category');
            $this->session->set_flashdata('flash_message', 'Product Sub Category Information Has Been Deleted');
            redirect(base_url() . 'index.php?admin/add_product_sub_category', 'refresh');
        }
        $page_data['page_name'] = 'product_sub_category';
        $page_data['page_title'] = 'Product Sub Categories';
        $page_data['sub_categories'] = $this->db->get('sub_category')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    //  MANAGE PRODUCTS
    function getAllProducts($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        if ($param1 == 'create') {
            $data['serial_number'] = $this->input->post('serial_number');
            $data['name'] = $this->input->post('name');
            $data['amount'] = $this->input->post('amount');
            $data['type'] = $this->input->post('type');
            // $data['purchase_price'] = $this->input->post('purchase_price');
            // $data['selling_price'] = $this->input->post('selling_price');
            // $data['note'] = $this->input->post('note');
            $this->db->insert('product', $data);
            // UPLOAD IMAGE FILE
            $product_id = $this->db->insert_id();
            // move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/product_image/' . $product_id . '.jpg');
            $this->session->set_flashdata('flash_message', 'New Product Has Been Added To Inventory');
            redirect(base_url() . 'index.php?admin/getAllProducts', 'refresh');
        }
        if ($param1 == 'edit') {
            $data['serial_number'] = $this->input->post('serial_number');
            $data['category_id'] = $this->input->post('category_id');
            $data['sub_category_id'] = $this->input->post('sub_category_id');
            $data['name'] = $this->input->post('name');
            $data['purchase_price'] = $this->input->post('purchase_price');
            $data['selling_price'] = $this->input->post('selling_price');
            $data['note'] = $this->input->post('note');
            $this->db->where('product_id', $param2);
            $this->db->update('product', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/product_image/' . $param2 . '.jpg');
            $this->session->set_flashdata('flash_message', 'Product Information Has Been Updated');
            redirect(base_url() . 'index.php?admin/getAllProducts', 'refresh');
        }
        if ($param1 == 'delete') {
//            if (file_exists("uploads/product_image/" . $param2 . ".jpg")) {
//                unlink("uploads/product_image/" . $param2 . ".jpg");
//            }
            $this->db->where('product_id', $param2);
            $this->db->update('product', array('softDelete' => 1));
            $this->session->set_flashdata('flash_message', 'Product Information Has Been Deleted');
            redirect(base_url() . 'index.php?admin/getAllProducts', 'refresh');
        }
        $page_data['page_name'] = 'product';
        $page_data['page_title'] = 'Products';
        $page_data['products'] = $this->db->query('select * from product where stock_quantity > 3 and softDelete = 0;')->result_array();
        $this->load->view('backend/index', $page_data);
    }


    function currentStock()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');

        $page_data['page_name'] = 'product_stock';
        $page_data['page_title'] = 'Product Stock';
        $page_data['products'] = $this->db->query("select product_id, serial_number,name,
                                 amount,stock_quantity,(stock_quantity*amount)
                                 as 'stock_amount' from `product` where `stock_quantity` > 0 and `softDelete`= 0;")->result_array();
        $this->load->view('backend/index', $page_data);
    }


    /**
     * Deleted Product Functions
     * @param string $param1
     * @param string $param2
     * @param string $param3
     */
    public function dproduct($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        if ($param1 == 'delete') {
            if (file_exists("uploads/product_image/" . $param2 . ".jpg")) {
                unlink("uploads/product_image/" . $param2 . ".jpg");
            }
            $this->db->where('product_id', $param2);
            $this->db->delete('product');
            $this->session->set_flashdata('flash_message', ('Product Information Has Been Permanently Deleted'));
            redirect(base_url() . 'index.php?admin/dproduct', 'refresh');
        }
        if ($param1 == 'restore') {
            if (file_exists("uploads/product_image/" . $param2 . ".jpg")) {
                unlink("uploads/product_image/" . $param2 . ".jpg");
            }
            $this->db->where('product_id', $param2);
            $this->db->update('product', array('softDelete' => 0));
            $this->session->set_flashdata('flash_message', ('Product Information Has Been Restored'));
            redirect(base_url() . 'index.php?admin/dproduct', 'refresh');
        }

        $page_data['page_name'] = 'deleted_products';
        $page_data['page_title'] = 'Deleted Products';
        $page_data['deleted_products'] = $this->db->get_where('product', array('softDelete' => 1))->result_array();
        $this->load->view('backend/index', $page_data);
    }

    /**
     * Out Of Stock Product
     * @param string $param1
     * @param string $param2
     * @param string $param3
     */
    public function product_oos($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');

        $page_data['page_name'] = 'product_out_stock';
        $page_data['page_title'] = 'Product out Of Stock';
        $page_data['product_oos'] = $this->db->query('select * from product where stock_quantity <= 0 and softDelete = 0;')->result_array();
        //die(var_dump(count($page_data['products'])));
        $this->load->view('backend/index', $page_data);
    }

    public function product_ls($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        $page_data['page_name'] = 'product_low_stock';
        $page_data['page_title'] = 'Products Low In Stock';
        $page_data['product_ls'] = $this->db->query('select * from product where stock_quantity <= 3 AND stock_quantity > 0;')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    //  MANAGE DAMAGED PRODUCTS
    function all_damaged_product($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        if ($param1 == 'create') {
            $data['product_id'] = $this->input->post('product_id');
            $data['quantity'] = $this->input->post('quantity');
            $data['note'] = $this->input->post('note');
            $data['timestamp'] = strtotime(date("Y-m-d H:i:s"));
            $check = $this->input->post('check');
            if ($check == 1) {
                $this->db->where('product_id', $this->input->post('product_id'));
                $this->db->set('stock_quantity', 'stock_quantity - ' . $data['quantity'], FALSE);
                $this->db->update('product');
            }
            $this->db->insert('damaged_product', $data);
            $this->session->set_flashdata('flash_message', 'Damaged Product Has Been Added To Inventory');
            redirect(base_url() . 'index.php?admin/all_damaged_product', 'refresh');
        }
        if ($param1 == 'edit') {
            $data['product_id'] = $this->input->post('product_id');
            $data['quantity'] = $this->input->post('quantity');
            $data['note'] = $this->input->post('note');
            $check = $this->input->post('check');
            if ($check == 1) {
                $this->db->where('product_id', $this->input->post('product_id'));
                $this->db->set('stock_quantity', 'stock_quantity - ' . $data['quantity'], FALSE);
                $this->db->update('product');
            }
            $this->db->where('damaged_product_id', $param2);
            $this->db->update('damaged_product', $data);
            $this->session->set_flashdata('flash_message', 'Damaged Product Information Has Been Updated');
            redirect(base_url() . 'index.php?admin/all_damaged_product', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('damaged_product_id', $param2);
            $this->db->delete('damaged_product');
            $this->session->set_flashdata('flash_message', 'Damaged Product Has Been Deleted');
            redirect(base_url() . 'index.php?admin/all_damaged_product', 'refresh');
        }
        $page_data['page_name'] = 'damaged_product';
        $page_data['page_title'] = 'Damaged Products';
        $page_data['damaged_products'] = $this->db->get('damaged_product')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    //  MANAGE ORDERS
    function make_order($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');

        if ($param1 == 'create') {
            $order_id = $this->crud_model->new_order();
            $order_status = $this->db->get_where('order', array(
                'order_id' => $order_id
            ))->row()->order_status;
            $order_number = $this->db->get_where('order', array(
                'order_id' => $order_id
            ))->row()->order_number;
            $customer = $this->db->get_where('order', array(
                'order_id' => $order_id
            ))->row()->customer_id;
            $email_to = $this->db->get_where('customer', array(
                'customer_id' => $customer
            ))->row()->email;
            if ($order_status == 0) {
                $this->session->set_flashdata('flash_message', ('Order placed. You paid partially'));
                $this->email_model->order_creating_email_by_admin('Partially paid', $order_number, $email_to);
            } else if ($order_status == 1) {
                $this->session->set_flashdata('flash_message', ('Your order is approved.'));
                $this->email_model->order_creating_email_by_admin('Approved', $order_number, $email_to);
            } else if ($order_status == 2) {
                $this->session->set_flashdata('flash_message', ('Your order has been rejected.'));
                $this->email_model->order_creating_email_by_admin('Rejected', $order_number, $email_to);
            } else if ($order_status == 3) {
                $this->session->set_flashdata('flash_message', ('Your order has been placed but you have full payment due.'));
                $this->email_model->order_creating_email_by_admin('Full Due', $order_number, $email_to);
            } else {
                $this->session->set_flashdata('flash_message', ('Something wrong happened with your order.'));
                $this->email_model->order_creating_email_by_admin('Unknown Status', $order_number, $email_to);
            }
            redirect(base_url() . 'index.php?admin/order_invoice_view/' . $order_id, 'refresh');
        }

        if ($param1 == 'edit') {
            $data['order_number'] = $this->input->post('order_number');
            $data['customer_id'] = $this->input->post('customer_id');
            $data['modifying_timestamp'] = strtotime($this->input->post('modifying_timestamp'));
            $data['order_status'] = $this->input->post('order_status');
            $data['payment_status'] = $this->input->post('payment_status');
            $data['shipping_address'] = $this->input->post('shipping_address');
            $data['note'] = $this->input->post('note');
            // DECREASE PRODUCT QUANTITY ON APPROVING THE ORDER
            $current_order_status = $this->db->get_where('order', array(
                'order_number' => $data['order_number']
            ))->row()->order_status;
            if ($data['order_status'] == 1 && $current_order_status != 1) {
                $get_ordered_products = $this->db->get_where('order', array(
                    'order_number' => $data['order_number']
                ))->row()->order_entries;
                $ordered_products = json_decode($get_ordered_products);
                foreach ($ordered_products as $ordered_product) {
                    $this->db->where('product_id', $ordered_product->product_id);
                    $this->db->set('stock_quantity', 'stock_quantity -' . $ordered_product->quantity, FALSE);
                    $this->db->update('product');
                }
            } else if ($data['order_status'] == 2 && $current_order_status != 1) {
                $get_ordered_products = $this->db->get_where('order', array(
                    'order_number' => $data['order_number']
                ))->row()->order_entries;
                $ordered_products = json_decode($get_ordered_products);
                foreach ($ordered_products as $ordered_product) {
                    $this->db->where('product_id', $ordered_product->product_id);
                    $this->db->set('stock_quantity', 'stock_quantity +' . $ordered_product->quantity, FALSE);
                    $this->db->update('product');
                }
            } else {
                $get_ordered_products = $this->db->get_where('order', array(
                    'order_number' => $data['order_number']
                ))->row()->order_entries;
                $ordered_products = json_decode($get_ordered_products);
                foreach ($ordered_products as $ordered_product) {
                    $this->db->where('product_id', $ordered_product->product_id);
                    $this->db->set('stock_quantity', 'stock_quantity -' . $ordered_product->quantity, FALSE);
                    $this->db->update('product');
                }
            }
            $this->db->where('order_id', $param2);
            $this->db->update('order', $data);
            // MAIL SENDING TO CUSTOMER
            $order_number = $data['order_number'];
            $order_status = $data['order_status'];
            $email_to = $this->db->get_where('customer', array(
                'customer_id' => $data['customer_id']
            ))->row()->email;
            $updated_order_id = $this->db->get_where('order', array(
                'order_number' => $order_number
            ))->row()->order_id;
            if ($order_status == 0) {
                $this->session->set_flashdata('flash_message', ('Order information updated'));
                $this->email_model->order_status_change_email('Partially paid', $order_number, $email_to);
            } elseif ($order_status == 1) {
                $this->session->set_flashdata('flash_message', ('Order information updated'));
                $this->email_model->order_status_change_email('Approved', $order_number, $email_to);
            } else if ($order_status == 2) {
                $this->session->set_flashdata('flash_message', ('order information updated'));
                $this->email_model->order_status_change_email('Rejected', $order_number, $email_to);
            } else if ($order_status == 3) {
                $this->session->set_flashdata('flash_message', ('order information updated'));
                $this->email_model->order_status_change_email('Full Due', $order_number, $email_to);
            } else {
                $this->session->set_flashdata('flash_message', ('Order information updated'));
                $this->email_model->order_status_change_email('Rejected', $order_number, $email_to);
            }
            redirect(base_url() . 'index.php?admin/view_all_orders/', 'refresh');
        }
    }

    //  ALLS ORDERS
    function view_all_orders()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        $page_data['page_name'] = 'orders';
        $page_data['page_title'] = 'All Orders';
        $this->load->view('backend/index', $page_data);
    }

    //  NEW ORDER
    function add_a_new_order($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        $page_data['page_name'] = 'order_add';
        $page_data['page_title'] = 'Create New Orders';
        $this->load->view('backend/index', $page_data);
    }

    //  GET THE PRODUCT INFORMATIONS FOR ORDER ON AJAX CALL
    function get_product_for_order($input_id, $total_number)
    {
        $info = $this->db->get_where('product', array(
            'product_id' => $input_id
        ))->row();

        echo '<tr id="entry_row_' . $total_number . '">
				<td id="serial_' . $total_number . '">' . $total_number . '</td>
				<td>' . $info->serial_number . '</td>
				<td>' . $info->name . ' 
					<input type="hidden" name="product_id[]" value="' . $info->product_id . '"
						id="single_entry_product_id_' . $total_number . '">
				</td>
				<td>
					<input type="number" name="quantity[]" value="1" min="1"
						id="single_entry_quantity_' . $total_number . '"
							onkeyup="calculate_single_entry_sum(' . $total_number . ')"
								onclick="calculate_single_entry_sum(' . $total_number . ')">
				</td>
				<td>
					<input type="number" name="selling_price[]" value="' . $info->amount . '" min="1"
						id="single_entry_selling_price_' . $total_number . '"
							onkeyup="calculate_single_entry_sum(' . $total_number . ')"
								onclick="calculate_single_entry_sum(' . $total_number . ')">
				</td>
				<td id="single_entry_total_' . $total_number . '">' . $info->amount . '</td>
				<td>
					<i class="fa fa-trash" onclick="delete_row(' . $total_number . ')"
						id="delete_button_' . $total_number . '" style="cursor: pointer;"></i>
				</td>
			</tr>';
    }

    //  EDIT ORDERS
    function order_edit($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        $page_data['page_name'] = 'order_edit';
        $page_data['order_id'] = $param1;
        $page_data['page_title'] = 'Edit Order';
        $this->load->view('backend/index', $page_data);
    }

    // TAKE ORDER PAYMENT ON DUE
    function take_order_payment($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        $page_data['order_id'] = $param1;
        $page_data['page_name'] = 'take_order_payment';
        $page_data['page_title'] = 'Receive Payment';
        $this->load->view('backend/index', $page_data);
    }

    function order_payment($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        if ($param1 == 'take_payment') {
            $data['due'] = $this->input->post('amount');
            $data['modifying_timestamp'] = strtotime($this->input->post('modifying_timestamp'));
            $this->db->where('order_id', $param2);
            $this->db->set('due', 'due - ' . $data['due'], FALSE);
            $this->db->set('modifying_timestamp', $data['modifying_timestamp']);
            $this->db->update('order');

            $data2['amount'] = $this->input->post('amount');
            $data2['timestamp'] = strtotime($this->input->post('modifying_timestamp'));
            $data2['method'] = $this->input->post('method');
            $data2['customer_id'] = $this->input->post('customer_id');
            $data2['order_id'] = $this->input->post('order_id');
            $data2['type'] = 'income';
            $this->db->insert('payment', $data2);
            $this->session->set_flashdata('flash_message', 'Payment Received');
            redirect(base_url() . 'index.php?admin/order_invoice_view/' . $data2['order_id']);
        }
    }


    function give_purchase_payment($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        if ($param1 == 'make_payment') {
            $data['due'] = $this->input->post('amount');
            $data['modifying_timestamp'] = strtotime($this->input->post('modifying_timestamp'));
            $this->db->where('purchase_id', $param2);
            $this->db->set('due', 'due - ' . $data['due'], FALSE);
            $this->db->set('modifying_timestamp', $data['modifying_timestamp']);
            $this->db->update('purchase');

            $data2['amount'] = $this->input->post('amount');
            $data2['timestamp'] = strtotime($this->input->post('modifying_timestamp'));
            $data2['method'] = $this->input->post('method');
            $data2['supplier_id'] = $this->input->post('supplier_id');
            $data2['purchase_id'] = $param2;
            $data2['type'] = 'expense';
            $this->db->insert('payment', $data2);
            $this->session->set_flashdata('flash_message', 'Payment Send');
            redirect(base_url() . 'index.php?admin/purchase_invoice_view/' . $data2['purchase_id']);
        }
    }


    //  VIEW ORDER INVOICE
    function order_invoice_view($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        $page_data['page_name'] = 'order_invoice_view';
        $page_data['order_id'] = $param1;
        $page_data['page_title'] = 'Order Invoice';
        $this->load->view('backend/index', $page_data);
    }

    //  NEW PURCHASE
    function add_new_purchase($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        if ($param1 == 'create') {
            $purchase_id = $this->crud_model->new_purchase();
            $this->session->set_flashdata('flash_message', 'New Product Has Been Purchased');
            redirect(base_url() . 'index.php?admin/purchase_invoice_view/' . $purchase_id, 'refresh');
        }
        $page_data['page_name'] = 'purchase_add';
        $page_data['page_title'] = 'New Purchase';
        $this->load->view('backend/index', $page_data);
    }

    //  GET THE PRODUCT INFORMATIONS FOR PURCHASE ON AJAX CALL
    function get_product_for_purchase($input_product_id, $total_number)
    {
        $product_info = $this->db->get_where('product', array(
            'product_id' => $input_product_id
        ))->row();

        echo '<tr id="entry_row_' . $total_number . '">
				<td id="serial_' . $total_number . '">' . $total_number . '</td>
				<td>' . $product_info->serial_number . '</td>
				<td>' . $product_info->name . ' 
					<input type="hidden" name="product_id[]" value="' . $product_info->product_id . '"
						id="single_entry_product_id_' . $total_number . '">
				</td>
				<td>
					<input type="number" name="quantity[]" value="1" min="1"
						id="single_entry_quantity_' . $total_number . '"
							onkeyup="calculate_single_entry_sum(' . $total_number . ')"
								onclick="calculate_single_entry_sum(' . $total_number . ')">
				</td>
				<td>
					<input type="number" name="purchase_price[]" value="' . $product_info->amount . '" min="1"
						id="single_entry_purchase_price_' . $total_number . '"
							onkeyup="calculate_single_entry_sum(' . $total_number . ')"
								onclick="calculate_single_entry_sum(' . $total_number . ')">
				</td>
				<td id="single_entry_total_' . $total_number . '">' . $product_info->amount . '</td>

				<td>
					<i class="fa fa-trash" onclick="delete_row(' . $total_number . ')"
						id="delete_button_' . $total_number . '" style="cursor: pointer;"></i>
				</td>
			</tr>';
    }

    // PURCHASE INVOICE VIEW
    function purchase_invoice_view($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        $page_data['purchase_id'] = $param1;
        $page_data['page_name'] = 'purchase_invoice_view';
        $page_data['page_title'] = 'Purchase Invoice';
        $this->load->view('backend/index', $page_data);
    }

    //  PURCHASE HISTORY
    function view_all_purchase_history()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        $this->db->order_by('purchase_id', 'desc');
        $page_data['purchases'] = $this->db->get('purchase')->result_array();
        $page_data['page_name'] = 'purchase_history';
        $page_data['page_title'] = 'Purchase History';
        $this->load->view('backend/index', $page_data);
    }

    //  SALE PRODUCTS
    function add_a_new_sale($param1 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        if ($param1 == 'do_add') {
            $invoice_id = $this->crud_model->add_new_sale();
            $this->session->set_flashdata('flash_message', 'Sales Added');
            redirect(base_url() . 'index.php?admin/sale_invoice_view/' . $invoice_id);
        }
        $page_data['page_name'] = 'sale_add';
        $page_data['page_title'] = 'Create New Sale';
        $this->load->view('backend/index', $page_data);
    }

    //  VIEW SALE INVOICE
    function sale_invoice_view($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        $page_data['invoice_id'] = $param1;
        $page_data['page_name'] = 'sale_invoice_view';
        $page_data['page_title'] = 'Sales Invoices';
        $this->load->view('backend/index', $page_data);
    }

    //  SALE INVOICES
    function view_all_sale_invoices($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        $page_data['page_name'] = 'sale_invoice';
        $page_data['page_title'] = 'Sale Invoices';
        $this->db->order_by('invoice_id', 'desc');
        $page_data['invoices'] = $this->db->get('invoice')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    // TAKE SALE PAYMENT ON DUE
    function take_sale_payment($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        $page_data['invoice_id'] = $param1;
        $page_data['page_name'] = 'take_sale_payment';
        $page_data['page_title'] = 'Receive Sales Payment';
        $this->load->view('backend/index', $page_data);
    }


    //  MAKE PURCHASE PAYMENT ON DUE
    function make_purchase_payment($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        $page_data['purchase_id'] = $param1;
        $page_data['page_name'] = 'make_payment_on_purchase';
        $page_data['page_title'] = 'Make Payment';
        $this->load->view('backend/index', $page_data);

    }


    function sale_payment($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        if ($param1 == 'take_payment') {
            $data['due'] = $this->input->post('amount');
            $this->db->where('invoice_id', $param2);
            $this->db->set('due', 'due - ' . $data['due'], FALSE);
            $this->db->update('invoice');

            $data2['amount'] = $this->input->post('amount');
            $data2['timestamp'] = strtotime($this->input->post('timestamp'));
            $data2['method'] = $this->input->post('method');
            $data2['customer_id'] = $this->input->post('customer_id');
            $data2['invoice_id'] = $this->input->post('invoice_id');
            $data2['type'] = 'income';
            $this->db->insert('payment', $data2);
            $this->session->set_flashdata('flash_message', 'Payment Has Been Received');
            redirect(base_url() . 'index.php?admin/sale_invoice_view/' . $data2['invoice_id']);
        }
    }

    //  GET THE PRODUCT LIST
    function get_sale_product_list($type, $category_id)
    {
        if ($type == 'category')
            $products = $this->db->get_where('product', array(
                'category_id' => $category_id, 'stock_quantity >' => 0
            ))->result_array();
        if ($type == 'sub_category')
            $products = $this->db->get_where('product', array(
                'sub_category_id' => $category_id, 'stock_quantity >' => 0
            ))->result_array();
        foreach ($products as $row) {
            echo '<p onclick="add_product(' . $row['product_id'] . ')" style="cursor: pointer;">'
                . $row['name'] . '' . ' ' . '(' . $row['stock_quantity'] . ')
				</p>';
        }
    }

    //  GET THE SUB CATEGORY LIST OF PRODUCTS
    function get_sub_category_list($category_id)
    {
        echo '<div class="form-group">
				<div class="col-md-12 col-sm-12">
				<select onchange="get_product(\'sub_category\' , this.value)" class="form-control selectpicker"
					name="sub_category_id" data-size="10" data-live-search="true" data-style="btn-default">
					<option value="">' . 'Select Sub Category' . '</option>';

        $sub_categories = $this->db->get_where('sub_category', array(
            'category_id' => $category_id
        ))->result_array();
        foreach ($sub_categories as $row):
            echo '<option value="' . $row['sub_category_id'] . '">' . $row['name'] . '</option>';
        endforeach;
        echo '</select></div></div>';
    }

    //  GET SELECTED PRODUCTS TO BE SOLD
    function get_selected_product($input_type, $input_id, $total_number)
    {
        if ($input_type == 'mouse') {
            $product_info = $this->db->get_where('product', array(
                'product_id' => $input_id
            ))->row();
        } else if ($input_type == 'barcode') {
            $product_info = $this->db->get_where('product', array(
                'serial_number' => $input_id
            ))->row();
        }
        echo '<tr id="entry_row_' . $total_number . '">
				<td id="serial_' . $total_number . '">' . $total_number . '</td>
				<td>' . $product_info->serial_number . '</td>
				<td>' . $product_info->name . ' 
					<input type="hidden" name="product_id[]" value="' . $product_info->product_id . '"
						id="single_entry_product_id_' . $total_number . '">
				</td>
				<td>
					<input type="number" name="total_number[]" value="1" min="1"
						id="single_entry_quantity_' . $total_number . '"
							onkeyup="calculate_single_entry_total(' . $total_number . ')"
								onclick="calculate_single_entry_total(' . $total_number . ')">
				</td>
				<td>
					<input type="number" name="selling_price[]" value="' . $product_info->selling_price . '" min="1"
						id="single_entry_selling_price_' . $total_number . '"
							onkeyup="calculate_single_entry_total(' . $total_number . ')"
								onclick="calculate_single_entry_total(' . $total_number . ')">
				</td>
				<td id="single_entry_total_' . $total_number . '">' . $product_info->selling_price . '</td>
				<td>
					<i class="fa fa-trash" onclick="remove_row(' . $total_number . ')"
						id="delete_button_' . $total_number . '" style="cursor: pointer;"></i>
				</td>
			</tr>';
    }

    //  GET SELECTED CUSTOMER DISCOUNT PERCENTAGE
    function get_customer_discount_percentage($customer_id)
    {


        $customer_details = $this->db->get_where('customer', array(
            'customer_id' => $customer_id,
        ))->result_array();

        header('Content-Type: application/json');
        echo json_encode($customer_details);
    }


    //  MANAGE EMPLOYEES
    function employee($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        if ($param1 == 'create') {
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['department'] = $this->input->post('department');
            $data['pno'] = $this->input->post('pno');
            $data['designation'] = $this->input->post('designation');
            // $data['address'] = $this->input->post('address');
            // if ($data['type'] == 2) {
            //     $this->db->insert('admin', $data);
            // }

            $this->db->insert('employee', $data);
            // UPLOAD IMAGE FILE
            // $employee_id = $this->db->insert_id();
            // move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/employee_image/' . $employee_id . '.jpg');


            // Send mail to employee upon employee creation
            // $email_to = $data['email'];
            // $password_unhashed = $this->input->post('password');
            // $this->email_model->account_opening_email('employee', $email_to, $password_unhashed);
            $this->session->set_flashdata('flash_message', 'New Employee Has Been Added');
            redirect(base_url() . 'index.php?admin/employee', 'refresh');
        }
        if ($param1 == 'edit') {
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['type'] = $this->input->post('type');
            $data['phone'] = $this->input->post('phone');
            $data['address'] = $this->input->post('address');
            $this->db->where('employee_id', $param2);
            $this->db->update('employee', $data);
            // UPLOAD IMAGE FILE
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/employee_image/' . $param2 . '.jpg');
            $this->session->set_flashdata('flash_message', 'Stuff Information Has Been Updated');
            redirect(base_url() . 'index.php?admin/employee', 'refresh');
        }
        if ($param1 == 'delete') {
            if (file_exists("uploads/employee_image/" . $param2 . ".jpg")) {
                unlink("uploads/employee_image/" . $param2 . ".jpg");
            }
            $this->db->where('employee_id', $param2);
            $this->db->delete('employee');
            $this->session->set_flashdata('flash_message', 'User Information Has Been Deleted');
            redirect(base_url() . 'index.php?admin/employee', 'refresh');
        }
        $page_data['page_name'] = 'employee';
        $page_data['page_title'] = 'Employees';
        $page_data['employees'] = $this->db->get('employee')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    //  MANAGE REPORTS
    function report($report_type = 'payment')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        if ($this->input->post('start') != "") {
            $page_data['timestamp_start'] = strtotime($this->input->post('start'));
            $page_data['timestamp_end'] = strtotime($this->input->post('end'));
            $page_data['type'] = $this->input->post('type');
        } else {
            $page_data['timestamp_start'] = strtotime('-29 days', time());
            $page_data['timestamp_end'] = strtotime(date("m/d/Y"));
        }
        $page_data['report_type'] = $report_type;
        $page_data['page_name'] = 'report_' . $report_type;
        $page_data['page_title'] = 'Report of ' . ' ' . $report_type;
        $this->load->view('backend/index', $page_data);
    }

    //  PRIVATE MESSAGING
    function message($messgae_thread_code = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        $page_data['page_name'] = 'message';
        $page_data['page_title'] = 'Private Messages';
        $page_data['message_thread_code'] = $messgae_thread_code;
        $this->load->view('backend/index', $page_data);
    }

    //  SEND NEW MESSAGE
    function write_a_new_message($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        if ($param1 == 'send_new_message') {
            $new_message_thread_code = $this->crud_model->send_new_message();
            $this->session->set_flashdata('flash_message', 'Message Sent');
            redirect(base_url() . 'index.php?admin/message_read/' . $new_message_thread_code, 'refresh');
        }
        $page_data['page_name'] = 'message_new';
        $page_data['page_title'] = 'Messaging';
        $page_data['customers'] = $this->db->get('customer')->result_array();
        $page_data['sales_staff'] = $this->db->get('employee')->result_array();

        $page_data['message_thread_code'] = $param2;
        $this->load->view('backend/index', $page_data);
    }

    //  READ MESSAGES
    function message_read($message_thread_code)
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        $page_data['page_name'] = 'message_read';
        $page_data['page_title'] = 'Read Messages';
        $page_data['message_thread_code'] = $message_thread_code;
        $this->load->view('backend/index', $page_data);
    }

    // REPLY A MESSAGE
    function message_reply($message_thread_code)
    {
        $this->crud_model->send_reply_message($message_thread_code);
        $this->session->set_flashdata('flash_message', 'Message Has Been Sent');
        $get_receiver = $this->db->get_where('message_thread', array(
            'message_thread_code' => $message_thread_code
        ))->row()->receiver;
        redirect(base_url() . 'index.php?admin/message_read/' . $message_thread_code, 'refresh');
    }

    //  ADMIN PROFILE SETTINGS
    function profile_settings($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        if ($param1 == 'update') {
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');
            $data['address'] = $this->input->post('address');
            $this->db->where('admin_id', $this->session->userdata('user_id'));
            $this->db->update('admin', $data);
            // UPLOAD IMAGE FILE
            //var_dump($_FILES['userfile']);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $this->session->userdata('user_id') . '.jpg');
            $this->session->set_flashdata('flash_message', 'User Information Has Been Updated');
            redirect(base_url() . 'index.php?admin/profile_settings', 'refresh');
        }
        // PASSWORD UPDATE
        if ($param1 == 'change_password') {
            $data['previous_password'] = sha1($this->input->post('previous_password'));
            $data['new_password'] = sha1($this->input->post('new_password'));
            $data['confirm_password'] = sha1($this->input->post('confirm_password'));
            $existing_password = $this->db->get_where('admin', array(
                'admin_id' => $this->session->userdata('user_id')
            ))->row()->password;
            if ($existing_password == $data['previous_password'] && $data['new_password'] == $data['confirm_password']) {
                $this->db->where('admin_id', $this->session->userdata('user_id'));
                $this->db->update('admin', array(
                    'password' => $data['new_password']
                ));
                $this->session->set_flashdata('flash_message', 'Information Updated');
            } else {
                $this->session->set_flashdata('flash_message', 'Password Mismatch');
            }
            redirect(base_url() . 'index.php?admin/profile_settings', 'refresh');
        }
        $page_data['page_name'] = 'profile_settings';
        $page_data['page_title'] = 'Profile';
        $this->load->view('backend/index', $page_data);
    }

    //  SYSTEM SETTINGS
    function settings($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        if ($param1 == 'update') {
            $data['description'] = $this->input->post('smtp_host');
            $this->db->where('type', 'smtp_host');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('smtp_user');
            $this->db->where('type', 'smtp_user');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('smtp_pass');
            $this->db->where('type', 'smtp_pass');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('smtp_port');
            $this->db->where('type', 'smtp_port');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('company_name');
            $this->db->where('type', 'company_name');
            $this->db->update('settings', $data);
            $data['description'] = $this->input->post('address');
            $this->db->where('type', 'address');
            $this->db->update('settings', $data);
            $data['description'] = $this->input->post('phone');
            $this->db->where('type', 'phone');
            $this->db->update('settings', $data);
            $data['description'] = $this->input->post('company_email');
            $this->db->where('type', 'company_email');
            $this->db->update('settings', $data);
            $data['description'] = $this->input->post('currency');
            $this->db->where('type', 'currency');
            $this->db->update('settings', $data);
            $data['description'] = $this->input->post('vat_percentage');
            $this->db->where('type', 'vat_percentage');
            $this->db->update('settings', $data);
            $data['description'] = $this->input->post('discount_percentage');
            $this->db->where('type', 'discount_percentage');
            $this->db->update('settings', $data);
            $data['description'] = $this->input->post('theme');
            $this->db->where('type', 'theme');
            $this->db->update('settings', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo/logo.png');
            $this->session->set_flashdata('flash_message', 'Application Settings Has Been Updated');
            redirect(base_url() . 'index.php?admin/settings', 'refresh');

        }


        $page_data['page_name'] = 'settings';
        $page_data['page_title'] = 'System Settings';
        $this->load->view('backend/index', $page_data);
    }


    /**
     * Global Search Function
     */
    function searchAnything()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');

        $page_data['search_key'] = $this->input->post('search_key');
        $page_data['page_name'] = 'search';
        $page_data['page_title'] = "Search Result";
        $this->load->view("backend/index", $page_data);
    }


    /**
     * shopSummary function will return daily result for how much sale, purchase, order and customers added
     */

    public function shopSummary()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');

        $page_data['page_name'] = 'shop_summary';
        $page_data['page_title'] = 'Shop Summary';
        $this->load->view("backend/index", $page_data);

    }

    /**
     * @param $purchase_id
     * @internal param $purchas_id Generate Purchase invoice PDF and mail it to customer.* Generate Purchase invoice PDF and mail it to customer.
     */

    public function generate_purchase_invoice($purchase_id)
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        $this->load->helper(array('utility', 'file'));
        $this->load->helper('download');
        $data['purchase_id'] = $purchase_id;
        $purchase_code = $this->db->query("select purchase_code from purchase where purchase_id = $purchase_id")->row()->purchase_code;
        $file_name = $purchase_code;
        $purchase_invoice_details = $this->db->get_where('purchase', array(
            'purchase_id' => $purchase_id
        ))->result_array();
        $data['purchase_invoice_details'] = $purchase_invoice_details;
        $data['system_name'] = $this->db->get_where('settings', array('type' => 'company_name'))->row()->description;
        $data['system_address'] = $this->db->get_where('settings', array('type' => 'address'))->row()->description;
        $data['system_phone'] = $this->db->get_where('settings', array('type' => 'phone'))->row()->description;
        $data['system_email'] = $this->db->get_where('settings', array('type' => 'company_email'))->row()->description;
        $data['currency'] = $this->db->get_where('settings', array('type' => 'currency'))->row()->description;
        $html = $this->load->view("backend/admin/purchase_invoice_template", $data, true);
        force_download($file_name . '.txt', pdf_create($html));
        //$this->session->set_flashdata('flash_message', 'Purchase PDF has been generated');
        //redirect(base_url() . 'index.php?admin/view_all_purchase_history');
    }

    /**
     * @param $invoice_id
     * Generate Sales Invoice and mail direct to customer
     */
    public function generate_sales_invoice($invoice_id)
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        $this->load->helper(array('utility', 'file'));
        $invoice_code = $this->db->query("select invoice_code, customer_id from invoice where invoice_id = $invoice_id")->row()->invoice_code;
        $customer_id = $this->db->query("select customer_id from invoice where invoice_id = $invoice_id")->row()->customer_id;
        $customer_name = $this->db->query("select name from customer where customer_id = $customer_id")->row()->name;
        $file_name = $invoice_code . '-' . $customer_name;
        $data['invoice_id'] = $invoice_id;
        $data['sale_invoice_details'] = $this->db->get_where('invoice', array(
            'invoice_id' => $invoice_id
        ))->result_array();
        $data['system_name'] = $this->db->get_where('settings', array('type' => 'company_name'))->row()->description;
        $data['system_address'] = $this->db->get_where('settings', array('type' => 'address'))->row()->description;
        $data['system_phone'] = $this->db->get_where('settings', array('type' => 'phone'))->row()->description;
        $data['system_email'] = $this->db->get_where('settings', array('type' => 'company_email'))->row()->description;
        $data['currency'] = $this->db->get_where('settings', array('type' => 'currency'))->row()->description;
        $html = $this->load->view("backend/admin/sale_invoice_template", $data, true);
        pdf_create($html, $file_name);
        //$this->session->set_flashdata('flash_message', 'Sales PDF has been generated');
        //redirect(base_url() . 'index.php?admin/view_all_sale_invoices');
    }


    public function generate_order_invoice($order_id)
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login');
        $this->load->helper(array('utility', 'file'));
        $order_code = $this->db->query("select order_number from `order` where order_id = $order_id")->row()->order_number;
        $customer_id = $this->db->query("select customer_id from `order` where order_id = $order_id")->row()->customer_id;
        $customer_name = $this->db->query("select name from customer where customer_id = $customer_id")->row()->name;
        $file_name = $order_code . '-' . $customer_name;
        $data['order_invoice_details'] = $this->db->get_where('order', array(
            'order_id' => $order_id
        ))->result_array();
        $data['system_name'] = $this->db->get_where('settings', array('type' => 'company_name'))->row()->description;
        $data['system_address'] = $this->db->get_where('settings', array('type' => 'address'))->row()->description;
        $data['system_phone'] = $this->db->get_where('settings', array('type' => 'phone'))->row()->description;
        $data['system_email'] = $this->db->get_where('settings', array('type' => 'company_email'))->row()->description;
        $data['currency'] = $this->db->get_where('settings', array('type' => 'currency'))->row()->description;
        $html = $this->load->view("backend/admin/order_invoice_template", $data, true);
        pdf_create($html, $file_name);
        //$this->session->set_flashdata('flash_message', 'Order PDF has been generated');
        //redirect(base_url() . 'index.php?admin/view_all_orders');
    }

}

/* End of file admin.php */
/* Location: ./application/controllers/Admin.php */
