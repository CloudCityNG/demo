<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller
{

    function __construct()
    {
        parent:: __construct();
        $this->load->model('User');
        $this->load->model('Admin_Insert');
        $this->load->model('Bannermgmt');
        $this->load->model('cmsadmin');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('upload');
        $this->load->library('cart');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('form');
    }
    /**
     * add product to cart using cart function of codeigniter
     * @prod_id=product_id
     * @product= image_name,name,price
     * #model =  user
     * @return = add data into codeigniter card
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function add_to_cart()                             //add data into cart function
    {
        $i="";
        //$prod_id = $this->uri->segment(3);                    //fetch product_id
        //$prod_id=$this->input->post('code');
        $prod_id=$this->input->post('code');

        $product = $this->User->fetch_data($prod_id);        //fetch all details of particular product_id
        //explore product array
        foreach($product as $value)
        {
            $value = (array)$value;
            $iname = $value['image_name'];
            $name = $value['name'];
            $price = $value['price'];
            $data = array(
                'id' => $prod_id,
                'qty' => 1,
                'price' => $price,
                'name' => $name,
                'image_name' => $iname
            );
            $this->cart->insert($data);
        }
        echo "Product Add In Cart";
    }

    /**
     * call user cart
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function index()
    {
        $this->load->view('user/headeruser');
        $this->load->view('user/cart_user');
        $this->load->view('user/footer_user');
    }

    public function qunty_check()
    {
        $size=$this->input->post('qty');
        $id=$this->input->post('p_id');

        $data=$this->User->check_qty($id,$size);

        if($data <= 0)
        {
            foreach ($this->cart->contents() as $item)
            {
                if($id == $item['id'])
                {
                    echo $item['qty'];
                    break;
                }
            }
        }
        else
        {
            echo $size;
        }
    }

    /**
     * update quantity of cart data from front end
     * @return = update quantity in cart product
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function update_cart()
    {
        $i = 1;
        //explore cart for updation

        foreach ($this->cart->contents() as $item)
        {

            $this->cart->update(array('rowid'=>$item['rowid'],'qty'=>$_POST[ 'qty'.$i ])); //update quantity of cart
            $i++;
        }
        $this->load->view('user/headeruser');
        $this->load->view('user/cart_user');
        $this->load->view('user/footer_user');
    }

    /**
     * delete product from cart
     * fetch product_id using url
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function delete_cart()
    {
        //fetch product_id from url
        $rowid=$this->uri->segment(3);
        //if quantity is zero product deleted from cart
        $this->cart->update(array('rowid' => $rowid,'qty' => 0));
        redirect('home/user_cart');
    }

}