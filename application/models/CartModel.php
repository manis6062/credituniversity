<?php

class CartModel extends AdminModel
{
    function addItem($userId)
    {
        $data = array(
            'user_id' => $userId
        );
        $cartId = $this->db->query("select c.id from cart c where c.user_id = '$userId' and c.status = 0")->row()->id;
        if (!$cartId) {
            $this->db->insert('cart', $this->security->xss_clean($data));
            $cartId = $this->db->insert_id();
        }
        $data = array(
            'id' => $cartId,
            'line_id' => $this->input->post('id'),
            'quantity' => $this->input->post('qty'));
        $this->db->insert('cart_item', $this->security->xss_clean($data));
        return $this->getCart($userId);
    }

    function getCart($userId)
    {
        return $this->db->query("select ci.id, ci.line_id, ci.quantity,l.price, l.broker_price, (l.broker_price + (bu.client_commission * l.broker_price)/100)*ci.quantity client_broker_price,
                                      concat_ws(' - ', lt.bank, lt.type, lt.name, concat('$',l.lmt), l.statement, l.open) line
                                    from cart_item ci
                                    JOIN cart c on c.id = ci.id
                                    JOIN line l on l.id = ci.line_id
                                    LEFT JOIN line_type lt ON lt.id = l.type_id
                                    RIGHT JOIN broker b on b.client_id = l.user_id
                                    RIGHT JOIN business bu on bu.user_id = b.broker_id
                                    where c.user_id = '$userId'")->result();

    }

    function deleteItem()
    {
        $data = $this->input->post();
        $cart_id = $this->input->post('id');
        $this->db->delete('cart_item', $data);
        $cartItems = $this->db->query("select count(*) count from cart_item ci where ci.id = '$cart_id'")->row()->count;
        if ($cartItems == 0) {
            $this->db->where('id', $cart_id);
            $this->db->delete('cart');
        }
    }

    function getTotalCartItemCount($userId)
    {
        return $this->db->query("SELECT COUNT(line_id) cartTotal FROM cart c LEFT JOIN cart_item ci ON c.id = ci.id WHERE c.user_id = $userId ")->row()->cartTotal;
    }

    function getCartTotal()
    {
        $this->load->library('cart');
        return count($this->cart->contents());
    }

    function updateCart($row_id ,$qty){
        $this->load->library('cart');
        $data = array(
            'rowid' => $row_id,
            'qty'   => $qty,
        );

        $this->cart->update($data);
    }

    function getLastId(){
        $query = $this->db->query("SELECT max(transaction_id) as last_id FROM transaction where status = 'completed'");
        return $query->row();
    }

}

?>