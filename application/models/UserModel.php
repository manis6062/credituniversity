<?php

class UserModel extends AdminModel
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
        $this->load->library('email');
        $this->load->library('encrypt');
        $this->load->helper('security');
        $this->load->model('RoleModel');
        $this->load->model('ContentModel');
        $this->load->model('EmailModel');
        $this->load->model('UserModel');
        $this->load->model('MembershipModel');
        $this->load->database();

    }


    function  getClients($brokerId, $widget)
    {
//        $brokers = $this->getBrokerHierarchy($brokerId, true, true);
        if ($brokerId) {
            $append = " and  b.broker_id = '$brokerId'";
        }
        $result = $this->db->query("SELECT concat_ws(' ', p.first_name, p.last_name) client, u.id
                                        FROM user u
                                        LEFT JOIN broker b on b.client_id = u.id
                                        LEFT JOIN  role r ON r.id = b.role_id
                                        LEFT JOIN  profile p ON p.user_id = u.id
                                        WHERE r.name = 'client' $append")->result();
        return $this->widget($widget, $result, 'id', 'client', '');
    }


    function getBrokersEditable()
    {
        $query = $this->db->query("SELECT DISTINCT concat(p.first_name, ' ', p.last_name) broker_name, u.id broker_id FROM user u LEFT JOIN profile p ON p.user_id = u.id LEFT JOIN user_role ur ON ur.user_id = u.id LEFT JOIN role r ON r.id = ur.role_id WHERE lower(r.name) = 'broker'");
        if ($query->num_rows() > 0) {
            return $this->editable($query->result(), 'broker_id', 'broker_name');
        } else
            return false;
    }


    function getLineOwner($ownerId)
    {
        $result = $this->db->query("select b.client_id, concat(p.first_name,' ', p.last_name) name from broker b
                                        JOIN user_role ur on ur.user_id = b.client_id JOIN role r on r.id = ur.role_id
                                        LEFT JOIN profile p on p.user_id = b.client_id where b.client_id = $ownerId and r.name = 'owner'")->result();
        $owner = array();
        foreach ($result as $user) {
            $owner[$user->owner_id] = $user->name;
        };
        return $owner;
    }

    function getLineOwners($brokerId)
    {
        $result = $this->db->query("select DISTINCT o.client_id, concat(p.first_name,' ', p.last_name) name
                                    FROM  profile p
                                    LEFT JOIN user_role ur ON p.user_id = ur.user_id
                                    LEFT JOIN role r ON r.id = ur.role_id
                                    LEFT JOIN broker o on o.client_id = p.user_id
                                    where r.name = 'owner' and o.broker_id  = '$brokerId'")->result();
        $owner = array();
        foreach ($result as $user) {
            $owner[$user->client_id] = $user->name;
        };
        return $owner;
    }

    function getAllLineOwners()
    {
        $result = $this->db->query("SELECT b.client_id, concat(p.first_name,' ', p.last_name) name FROM broker b
                                        JOIN user_role ur ON ur.user_id = b.client_id JOIN role r ON r.id = ur.role_id
                                        LEFT JOIN profile p ON p.user_id = b.client_id WHERE r.name = 'owner'")->result();
        $owner = array();
        foreach ($result as $user) {
            $owner[$user->client_id] = $user->name;
        };
        return $owner;
    }

    function getBrokerHierarchy($brokerId, $includeChild = false, $includeSelf = false)
    {
        $result = '';
        if ($includeSelf == 'true' and $brokerId != null) {
            $result .= $brokerId . ",";
        }

        if ($includeChild == 'true ' and $this->getSubBrokers($brokerId)->client_id != null) {
            $result .= $this->getSubBrokers($brokerId)->client_id . ",";
        }
        return trim($result, ",");
    }

    function getSubBrokers($brokerId)
    {
        return $this->db->query("select group_concat(b.client_id) client_id from broker b LEFT JOIN user_role ur on ur.user_id = b.client_id
                                    LEFT JOIN role r on r.id = ur.role_id where b.broker_id = '$brokerId' AND r.name = 'broker'")->row();
    }

    function getUser($userId)
    {
        $address_id = $this->db->query("select * from profile p where p.user_id = '$userId'")->row()->address_id;

        if (!$address_id) {
            $address_id = $this->insertAddress();
            $this->updateProfileAddress($userId, $address_id);
        }

        $query = $this->db->query("SELECT u.id,u.last_login_date, p.first_name, p.middle_initial, p.last_name, p.phone as personal_phone , p.profile_image,p.question_id_1,p.answer_1,p.question_id_2,p.answer_2,q.question,qa.question question2,
			                            p.fax as personal_fax, u.email, p.gender, AES_DECRYPT(p.dob,'$this->dob_phrase') dob, AES_DECRYPT(p.cpn,'$this->cpn_phrase') cpn,AES_DECRYPT(p.ssn,'$this->ssn_phrase') ssn, u.status, p.comment, bu.site, bu.name, bu.dba,
										bu.b_phone as business_phone, a.state, a.postal_code,p.address_id,  bu.b_fax as business_fax, bu.email AS b_email, a.street, a.city, u.password, b.broker_id broker_id,
										(SELECT concat(p.first_name, ' ', p.last_name) FROM profile p WHERE p.user_id = b.broker_id) broker, bu.client_commission, bu.owner_commission
									   FROM user u
									   LEFT JOIN profile p ON p.user_id = u.id
									   LEFT JOIN business bu ON bu.user_id = u.id
									   LEFT JOIN  address a ON a.id = p.address_id
									   LEFT JOIN broker b ON b.client_id = u.id
									   LEFT JOIN question  q ON q.id = p.question_id_1
									   LEFT JOIN question  qa ON qa.id = p.question_id_2
									   WHERE u.id = ?", array($userId));
        return $query->row();
    }

    function getUserNotes($userId)
    {
        return $this->db->query("select * from notes n where n.user_id = '$userId'")->result();
    }

    function getBrokerUsers($brokerId, $userType)
    {
        if ($this->session->userdata(BROKER_ID) && $userType == 1) {
            $condition = "AND m.sys_admin_id=" . $this->session->userdata(USER_ID);

        } elseif ($this->session->userdata(BROKER_ID)) {
            $condition = "AND b.sys_admin_id=" . $this->session->userdata(USER_ID);
        } else {
            $condition = '';
        }
        if ($userType == '1') { //todo: what does this mean? usertype 1
            return $query = $this->db->query("SELECT  DISTINCT  u.id id, p.first_name first_name,p.middle_initial middle_initial, p.last_name last_name,p.phone phone , u.email email,
                                    (SELECT concat(first_name, ' ', last_name) FROM profile p WHERE p.user_id = m.parent) broker_name,
                                    m.parent broker_id, u.status, u.last_login_date, u.created_date
                                    FROM user u
                                    LEFT JOIN profile p ON p.user_id = u.id
                                    LEFT JOIN membership m ON m.user_id= u.id
                                    where m.parent = '$brokerId' $condition ")->result();
        } else {
            $query = $this->db->query("SELECT u.id id, p.first_name first_name,p.middle_initial middle_initial, p.last_name last_name,p.phone phone , u.email email,
                                    (SELECT concat(first_name, ' ', last_name) FROM profile p WHERE p.user_id = b.broker_id) broker_name,
                                    b.broker_id broker_id, u.status, u.last_login_date, u.created_date
                                    FROM user u
                                    LEFT JOIN profile p ON p.user_id = u.id
                                    LEFT JOIN broker b ON b.client_id = u.id
                                    where b.broker_id = '$brokerId' $condition");
            if ($query->num_rows() > 0) {
                return $query->result();
            }
        }
    }


    function getUsers()
    {
        $query = $this->db->query("SELECT u.id id,m.type, m.status,r.label,
                                      ml.value m_type,
                                      m.type membershipTypeId , p.first_name first_name,p.middle_initial middle_initial, p.last_name last_name,p.phone phone , u.email email,
                                    (SELECT concat(first_name, ' ', last_name) FROM profile p WHERE p.user_id = b.broker_id) broker_name,
                                    b.broker_id broker_id, u.status, u.last_login_date, u.created_date,GROUP_CONCAT(ml.value, r.label SEPARATOR ' ') as membership_title
                                    FROM user u
                                    LEFT JOIN profile p ON p.user_id = u.id
                                    LEFT JOIN broker b ON b.client_id = u.id
                                    LEFT JOIN membership m ON u.id = m.user_id
                                    LEFT JOIN membership_type mt ON mt.id = m.type
                                     LEFT JOIN membership_level ml ON ml.id = mt.level
                                JOIN role r ON r.id = mt.role GROUP BY u.id");
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function getEmails($rolesArray, $individualsArray, $prospectRoleName = null)
    {
        $prospect = false;
        $subscriber = false;
        $roles = '';
        $individuals = '';
        if (is_array($rolesArray)) {
            $roles = "'" . implode("', '", $rolesArray) . "'";
        } else {
            if ($rolesArray != 'subscriber' and $rolesArray != 'prospect' and !$individualsArray) {
                $roles = '\'' . $rolesArray . '\'';
            } else if ($rolesArray == 'subscriber') {
                $subscriber = true;
            } else if ($rolesArray == 'prospect') {
                $prospect = true;
            }
        }
        if (is_array($individualsArray)) {
            $individuals = "'" . implode("', '", $individualsArray) . "'";
        } else {
            if ($individualsArray) {
                $individuals = '\'' . $individualsArray . '\'';
            }
        }
        $query = '';

        if ($roles or $individuals) {
            $append = " and ";
            if ($roles and !$individuals) {
                $append .= " (r.name IN ($roles))";
            }
            if (!$roles and $individuals) {
                $append .= " (u.id IN ($individuals))";
            }
            if ($roles and $individuals) {
                $append .= " (u.id IN ($roles) and r.name IN ($individuals)) ";
            }
            $query .= "SELECT DISTINCT  u.email, concat_ws(' ', p.first_name, p.last_name) name FROM
                                      user u JOIN user_role ur ON u.id = ur.user_id
                                      JOIN  role r ON r.id = ur.role_id
                                      LEFT JOIN profile p on p.user_id = u.id
                                      where u.email IS  NOT  NULL and trim(u.email) <> '' $append";
        }
        if (in_array('subscriber', $rolesArray) or $subscriber) {
            $append = '';
            if ($query) $append = 'union all';
            $query .= "$append SELECT DISTINCT subscriber email, '' name FROM subscribe s";
        }
        if (in_array('prospect', $rolesArray) or $prospect) {
            $append = '';
            if ($query) $append = 'union all';
            $query .= "$append SELECT DISTINCT p.email, concat_ws(' ', p.first_name, p.last_name) name FROM prospect p join role r on r.id = p.role_id WHERE p.email IS NOT  NULL  AND p.email <> '' and r.name = '$prospectRoleName' AND p.status ='1' ";
        }
        return $this->widget(null, $this->db->query($query . ' order by name asc')->result(), 'email', 'name', '');
    }


    function getBrokerNameEmail($clientId)
    {
        return $this->db->query("select u.email, concat_ws(' ', p.first_name, p.last_name) name from broker b JOIN profile p on p.user_id = b.broker_id JOIN user u on u.id = b.broker_id where b.client_id = '$clientId'")->result();
    }


    function getUsersWithEmail()
    {
        $query = $this->db->query("
                                    SELECT u.id id, p.first_name first_name,p.middle_initial middle_initial, p.last_name last_name,p.phone phone , u.email email,
                                    (SELECT concat(first_name, ' ', last_name) FROM profile p WHERE p.user_id = b.broker_id) broker_name,
                                    b.broker_id broker_id, u.status, u.last_login_date, u.created_date,
                                    (SELECT (CASE WHEN count(r.name) = 1 THEN r.name WHEN count(r.name) > 1 THEN '' END)  FROM role r JOIN user_role ur ON ur.role_id = r.id WHERE ur.user_id = u.id) role_name
                                    FROM user u
                                    LEFT JOIN profile p ON p.user_id = u.id
                                    LEFT JOIN broker b ON b.client_id = u.id WHERE u.email != '' ORDER BY p.first_name,p.last_name ASC ");
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function getUserByEmail($email)
    {
        return $this->db->query("SELECT u.id, p.first_name, p.middle_initial, p.last_name, p.phone FROM user u
                                         LEFT JOIN profile p ON p.user_id = u.id where u.email = '$email'")->row();
    }

    function getBrokerBroker()
    {
        return $this->db->query("SELECT b.broker_id, b.client_id FROM broker b JOIN user_role ur ON ur.user_id = b.client_id")->result();
    }

    function getBrokers($widget = null)
    {
        $result = $this->db->query("SELECT u.id, concat(p.first_name, ' ', p.last_name, ' - ' , u.email, ' (', u.id, ')') name
                                      FROM user u
                                      LEFT JOIN membership m ON m.user_id = u.id
                                      RIGHT JOIN membership_type mt ON mt.id = m.type
                                      LEFT JOIN profile p ON p.user_id = u.id
                                      RIGHT  JOIN role r ON r.id = mt.role WHERE r.name = 'broker' AND u.status='1' AND m.status = 1")->result();
        return $this->widget($widget, $result, 'id', 'name', '');
    }

    function insertUser($status = '')
    {
        $campaignId = $this->input->post('campaign');
        $email = $this->input->post('email');

        $isMember = $this->db->query("select u.id, m.status, m.type from membership m JOIN user u on u.id = m.user_id where u.email = '$email'")->row();

        if ($isMember) {
            throw new Exception("You are already a member. No need to register");
        } else if ($email) {
            $userId = $this->db->query("select * from user u where u.email = '$email'")->row()->id;
            if (!$userId) {
                $userId = $this->db->query("select u.id from user u where u.email = '$email'")->row()->id;
            }
            if ($userId) {
                if ($campaignId) {
                    $campaignDetails = $this->CampaignModel->getCampaignDetails($campaignId);
                    if ($campaignDetails->percentage == 100) {
                        return $this->updateUnregisteredUser($userId, $email, 1, $campaignDetails->start, $campaignDetails->end, $campaignDetails->role);
                    } else {
                        return $this->updateUnregisteredUser($userId, $email, 0);
                    }
                } else {
                    return $this->updateUnregisteredUser($userId, $email, 0);
                }
            }
        }

        if ($status == 0)
            $statusUser = 0;
        else
            $statusUser = 1;

        $this->db->trans_start();
        $userId = $this->insertUserTable($statusUser);

        $address_id = $this->insertAddress();

        $roleId = $this->input->post('roleId');
        $this->insertProfile($userId, $address_id);

        $brokerId = $this->input->post('brokerId');
        $roleName = $this->RoleModel->getRoleNameByRoleId($roleId);
        $this->RoleModel->insertUserRoles($userId, array($roleId));
        if ($roleName == BROKER) {
            $this->insertBusiness($userId);
        }
        if ($brokerId) {
            $this->insertBroker($brokerId, $userId, $roleId);
        }
        $this->db->trans_complete();
        return $userId;
    }

    function updateUnregisteredUser($userId, $email, $status = 0, $end = null, $role = null)
    {
        $this->db->trans_start();
        $data = array(
            'status' => $status,
            'password' => md5($this->input->post('password'))
        );
        $this->db->where('email', $email);
        $this->db->update('user', $data);
        unset($data);
        $data = array(
            'first_name' => trim($this->input->post('firstName')),
            'middle_initial' => trim($this->input->post('mi')),
            'last_name' => trim($this->input->post('lastName')),
            'phone' => $this->input->post('phone'),
            'question_id_1' => $this->input->post('question1'),
            'answer_1' => $this->input->post('answer1'),
            'question_id_2' => $this->input->post('question2'),
            'answer_2' => $this->input->post('answer2')
        );
        $this->db->where('user_id', $userId);
        $this->db->update('profile', $this->data($data));
        $this->db->trans_complete();

        if ($status and $end and $role) {
            $membershipTypeId = $this->MembershipModel->getMembershipTypeByRoleCost($role, 0)->id;
            $this->MembershipModel->insertMembershipUser($userId, $membershipTypeId, $end);
        }

        return $userId;
    }

    /**
     * @param $statusUser
     * @return mixed
     */
    public function insertUserTable($statusUser)
    {
        $data = array(
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('password')),
            'status' => $statusUser,
        );
        $this->db->insert('user', $this->data($data));
        $userId = $this->db->insert_id();
        return $userId;
    }

    function insertAddress()
    {
        $data1 = array(
            'street' => $this->input->post('street'),
            'state' => $this->input->post('state'),
            'city' => $this->input->post('city'),
            'postal_code' => 0,
        );
        $this->db->insert('address', $this->security->xss_clean($data1));
        return $this->db->insert_id();
    }

    function insertProfile($user_id, $address_id)
    {
        $data = array(
            'user_id' => $user_id,
            'ssn' => $this->input->post('ssn'),
            'first_name' => trim($this->input->post('firstName')),
            'middle_initial' => trim($this->input->post('mi')),
            'last_name' => trim($this->input->post('lastName')),
            'gender' => trim($this->input->post('gender')),
            'dob' => $this->formatDate($this->input->post('dob')),
            'phone' => $this->input->post('phone'),
            'address_id' => $address_id,
            'fax' => $this->input->post('fax'),
            'cpn' => $this->input->post('cpn'),
            'comment' => $this->input->post('comment'),
            'question_id_1' => $this->input->post('question1'),
            'answer_1' => $this->input->post('answer1'),
            'question_id_2' => $this->input->post('question2'),
            'answer_2' => $this->input->post('answer2'),


        );
        $this->db->insert('profile', $this->data($data));
    }

    function insertBusiness($user_id)
    {

        $count = $this->db->query("select count(*) count from business b where b.user_id = '$user_id'")->row()->count;
        if ($count == 1) {
            return;
        }

        $address_id = $this->insertAddress();
        $data1 = array(
            'user_id' => $user_id,
            'address_id' => $address_id,
            'site' => trim($this->input->post('site')),
            'b_fax' => trim($this->input->post('fax')),
        );
        $this->db->insert('business', $this->security->xss_clean($data1));
    }

    function insertBroker($parentId, $brokerId, $roleId)
    {

        $data = array(
            "broker_id" => $parentId,
            "client_id" => $brokerId,
            "role_id" => $roleId,
            "status" => 1,
            "sys_admin_id" => $this->session->userdata(BROKER_ID) ? $this->session->userdata(USER_ID) : ''
        );
        $this->db->insert('broker', $data);
    }

    function insertSystemUser()
    {
        $brokerId = $this->input->post('brokerId');
        $userId = $this->insertUserTable(1);

        $address_id = $this->insertAddress();
        $this->insertProfile($userId, $address_id);
        $membershipInfo = $this->MembershipModel->membershipExist($brokerId);
        foreach ($membershipInfo as $memberships) {
            $this->MembershipModel->insertMembershipSystemUser($userId, $memberships->type, $memberships->campaign, $memberships->status, $memberships->start_date, $memberships->end_date, $this->session->userdata(BROKER_ID) ? $this->session->userdata(BROKER_ID) : $this->session->userdata(USER_ID));
        }
        $rolePrivilege = $this->RoleModel->getNonPublicRolesByUserId($brokerId);
        foreach ($rolePrivilege as $roles) {
            $this->RoleModel->insertUserRole($userId, $roles->id);
        }

    }

    function insertreferrer($referrerId, $referreeId)
    {
        $data = array(
            "referrer_id" => $referrerId,
            "referree" => $referreeId,
            "status" => 1
        );
        $this->db->insert('referrer', $data);
    }

    function updateProfile($image, $user_id, $code = '')
    {
        $oldProfilePictureName = $this->db->query("select p.profile_image from profile p where p.user_id = $user_id")->row()->profile_image;
        $data = array(
            "profile_image" => $image,
            "reset_code" => $code
        );
        $this->db->where("user_id", $user_id);
        $this->db->update('profile', $this->security->xss_clean($data));

        if ($user_id == $this->session->userdata(USER_ID) || $user_id == $this->session->userdata(BROKER_ID)) {
            $this->session->set_userdata(PROFILE_PIC, $image);
        }
        return $oldProfilePictureName;
    }

    function updateProfileAddress($userId, $addressId)
    {
        $data = array(
            "address_id" => $addressId
        );
        $this->db->where("user_id", $userId);
        $this->db->update('profile', $this->security->xss_clean($data));
    }

    function updateBusinessAddress($userId, $addressId)
    {
        $data = array(
            "address_id" => $addressId
        );
        $this->db->where("user_id", $userId);
        $this->db->update('business', $this->security->xss_clean($data));
    }

    function getUserIdFromEmailAddress($email)
    {
        foreach ($email as $values) {
            $query = $this->db->query("
                  Select id,email from user where email = '$values' ");
            $receiver_id[] = $query->row()->id;
        }
        return $receiver_id;
    }

    function deleteUser($userId)
    {
        $addressId = $this->db->query("SELECT address_id FROM profile where user_id = '$userId'")->row()->address_id;
        $clientId = $this->db->query("SELECT client_id FROM broker where client_id = '$userId'")->row()->client_id;
        $this->db->trans_start();

        $this->db->where('user_id', $userId);
        $this->db->delete('user_role');

        $this->db->where('user_id', $userId);
        $this->db->delete('profile');

        $this->db->where('id', $addressId);
        $this->db->delete('address');

        $this->db->where('user_id', $userId);
        $this->db->delete('business');

        $cartId = $this->db->query("select c.id from cart c where c.user_id = '$userId'")->row()->id;
        $this->db->where('id', $cartId);
        $this->db->delete('cart_item');

        $this->db->where('user_id', $userId);
        $this->db->delete('cart');

        $this->db->where('client_id', $clientId);
        $this->db->delete('broker');

        $this->db->where('user_id', $userId);
        $this->db->delete('notes');

        $this->db->where('user_id', $userId);
        $this->db->delete('task');

        $transactionId = $this->db->query("select transaction_id from transaction  where user_id = '$userId'")->row()->transaction_id;
        $this->db->where('transaction_id', $transactionId);
        $this->db->delete('transaction_details');

        $this->db->where('user_id', $userId);
        $this->db->delete('transaction');

        $this->db->where('user_id', $userId);
        $this->db->delete('membership');

        $this->db->where('id', $userId);
        $this->db->delete('user');

        $this->db->trans_complete();
    }

    function checkEmailRegistered($email)
    {
        $this->db->select('id');
        $query = $this->db->get_where("user", array('email' => $email));
        if ($query->num_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }

    function deleteSystemUser($userId)
    {
        $addressId = $this->db->query("SELECT address_id FROM profile where user_id = '$userId'")->row()->address_id;
        $this->db->trans_start();
        $this->db->where('user_id', $userId);
        $this->db->delete('user_role');
        $this->db->where('user_id', $userId);
        $this->db->delete('profile');
        $this->db->where('id', $addressId);
        $this->db->delete('address');
        $this->db->where('user_id', $userId);
        $this->db->delete('membership');
        $this->db->where('id', $userId);
        $this->db->delete('user');
        $this->db->trans_complete();
    }

    function getStatesEditable()
    {
        $state = $this->getStates();
        if (!empty($state)) {
            $states = array();
            foreach ($state as $key => $value) {
                $states[] = '{' . 'value: ' . '\'' . $value->state . '\'' . ',' . ' text: ' . '\'' . $value->state . '\'' . '}';
            }
            return str_replace("\"", "", json_encode($states));

        }
    }

    function getStates()
    {
        $query = $this->db->query("SELECT * FROM states ORDER BY id ASC");
        if ($query->num_rows() > 1)
            return $query->result();
        return 0;
    }

    function getNameFromEmailAddress($email)
    {
        foreach ($email as $values) {
            $query = $this->db->query("
                  SELECT u.* , p.* from user u INNER JOIN profile p on u.id = p.user_id where u.email = '$values' ");
            $name[] = $query->row()->first_name . ' ' . $query->row()->middle_initial . ' ' . $query->row()->last_name;
        }

        return $name;
    }

    function get_brokersEmail($q)
    {
        $this->db->select('*');
        $this->db->like('email', $q);
        $query = $this->db->get('user');
        foreach ($query->result_array() as $val) {
            $new[] = $val['email'];
        }
        echo json_encode($new);

    }

    function checkEmailId($email_id)
    {
        $query = $this->db->query("SELECT  * FROM user WHERE email='$email_id'");
        if ($query->num_rows() == 1) {
            return $query->row()->id;
        } else {
            return false;
        }
    }

    function checkResetCode($code)
    {
        $query = $this->db->query("SELECT  * FROM profile WHERE reset_code='$code'");
        if ($query->num_rows() == 1) {
            return $query->row()->user_id;
        } else {
            return false;
        }
    }

    function updatePassword($user_id)
    {
        $data = array('password' => md5($this->input->post('password')));
        $this->db->where("id", $user_id);
        $this->db->update('user', $this->security->xss_clean($data));
    }

    function getQuestions()
    {
        return $this->db->query("SELECT * FROM question")->result();

    }

    function getQuestionsEditable()
    {
        $query = $this->db->query("SELECT * FROM question");
        if ($query->num_rows() > 0) {
            return $this->editable($query->result(), 'id', 'question');
        } else
            return false;
    }

    function checkQuestionsAnswers($email_to, $answer_1, $answer_2)
    {
        return $this->db->query("select * from profile p JOIN user u on u.id=p.user_id where p.answer_1='$answer_1' AND  p.answer_2='$answer_2' AND u.email='$email_to'")->result();
    }

    function getEmployement($userId)
    {
        $query = $this->db->query("SELECT * FROM employment WHERE user_id = $userId");
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function getSingleEmployement($userId)
    {
        $query = $this->db->query("SELECT * FROM employment WHERE user_id = '$userId'  ORDER BY id DESC LIMIT 1 ");
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function insertEmployment()
    {
        $data = array(
            'user_id' => $this->input->post('user_id'),
            'company' => $this->input->post('company1'),
            'position' => $this->input->post('position1'),
            'salary' => $this->input->post('sal'),
            'phone_employment' => $this->input->post('phone1'),
            'months' => $this->input->post('months'),
            'years' => $this->input->post('years'),
            'city_employment' => $this->input->post('city1'),
            'street_employment' => $this->input->post('street1'),
            'zip_employment' => $this->input->post('zip1'),
            'web_address' => $this->input->post('web_address2'),
            'comment_employment' => $this->input->post('comment1')


        );
        $this->db->insert('employment', $this->security->xss_clean($data));

    }

    function getBrokerFromClientid($client_id)
    {
        return $this->db->query("SELECT broker_id FROM broker WHERE client_id = '$client_id'")->row()->broker_id;
    }

    function getOwnerFromLineid($line_id)
    {
        return $this->db->query("SELECT user_id FROM line WHERE id = $line_id")->row()->user_id;
    }

    function getCreditApplication($userId)
    {
        $query = $this->db->query("SELECT * FROM application WHERE user_id = $userId");
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function insertCreditApplication()
    {
        $data = array(
            'user_id' => $this->input->post('user_id'),
            'creditor' => $this->input->post('creditor1'),
            'applied' => $this->formatDate($this->input->post('applied1')),
            'amount' => $this->input->post('amount1'),
            'application_type' => $this->input->post('type1'),
            'status' => $this->input->post('status1'),
            'due' => $this->input->post('due1'),
            'comment_application' => $this->input->post('comment4')
        );
        $this->db->insert('application', $this->security->xss_clean($data));

    }

    function  deleteCreditApplication()
    {
        $this->db->where($this->input->post());
        $this->db->delete('application');
        if ($this->db->affected_rows() == 0) {
            throw new Exception("Could not delete row");
        }
    }

    function deleteEmployment()
    {
        $this->db->where($this->input->post());
        $this->db->delete('employment');
        if ($this->db->affected_rows() == 0) {
            throw new Exception("Could not delete row");
        }

    }

    function getBusiness($userId)
    {
        $address_id = $this->db->query("select * from business p where p.user_id = '$userId'")->row()->address_id;

        if (!$address_id) {
            $address_id = $this->insertAddress();
            $this->updateBusinessAddress($userId, $address_id);
        }
        return $this->db->query("SELECT * FROM business LEFT JOIN address ON business.address_id = address.id WHERE business.user_id = $userId")->row();

    }

    function getEmailAddress($userId)
    {
        return $this->db->query("SELECT email FROM user WHERE id = '$userId'")->row()->email;

    }

    function getIdFromEmailAddress($email)
    {
        return $this->db->query("SELECT id FROM user WHERE email = '$email'")->row()->id;

    }

    function deleteNote($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('notes');
        if ($this->db->affected_rows() == 0) {
            throw new Exception("Could not delete row");
        }

    }

    function addUserNotes($brokerId, $userId, $note)
    {
        $data = array(
            'broker_id' => $brokerId,
            'user_id' => $userId,
            'note' => $note
        );
        $this->db->insert('notes', $this->data($data));
    }

    function addProspectNotes($brokerId, $prospectId, $note)
    {
        $data = array(
            'broker_id' => $brokerId,
            'prospect_id' => $prospectId,
            'note' => $note
        );
        $this->db->insert('notes', $this->data($data));
    }

    function getAdminDetails($user_id)
    {
        $query = $this->db->get_where('user', array('user_id' => $user_id));
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return $query->row();
        }
    }

    function uniqueUserName($userid, $name)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user_name', $name);
        $this->db->where_not_in('user_id', $userid);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function getAllUsersTemp()
    {
        $this->db->order_by("user_id", "DESC");
        $query = $this->db->get("user");
        if ($query->num_rows() > 0)
            return $query->result();
        return 0;
    }

    function getSingleUsers()
    {
        $this->db->where("user_id", $this->session->userdata(USER_ID));
        $this->db->order_by("user_id", "DESC");
        $query = $this->db->get("user");
        if ($query->num_rows() > 0)
            return $query->result();
        return 0;
    }

    function update($user_id)
    {
        $today = date("Y - m - d H:i:s");
        $data = array('user_name' => trim($this->input->post('user_name')),
            'phone' => ucwords($this->input->post('phone')),
            'cell' => ucwords($this->input->post('cell')),
            'address' => ucwords(trim($this->input->post('address'))),
            'email' => $this->input->post('email'),
            'auth_id' => implode(',', $this->input->post('auth_id')),
            'status' => $this->input->post('status'),
            'updt_dt' => $today,
            'updt_cnt' => $this->input->post('updt_cnt') + 1,
            'updt_by' => $this->session->userdata(USER_ID),
            'user_type' => $this->input->post('user_type')
        );
        $this->db->where("user_id", $user_id);
        $this->db->update('user', $this->security->xss_clean($data));
    }

    function updateself($user_id)
    {
        $today = date("Y - m - d H:i:s");
        $data = array(
            'user_name' => trim($this->input->post('user_name')),
            'phone' => ucwords($this->input->post('phone')),
            'cell' => ucwords($this->input->post('cell')),
            'address' => ucwords(trim($this->input->post('address'))),
            'email' => trim($this->input->post('email')),
            'updt_dt' => $today,
            'updt_cnt' => $this->input->post('updt_cnt') + 1,
            'updt_by' => $this->session->userdata(USER_ID),
            'paypal_account' => $this->input->post('pa'),
            'referrer_reg_charge' => $this->input->post('rrc')
        );
        $this->db->where("user_id", $user_id);
        $this->db->update('user', $this->security->xss_clean($data));
    }

    function updateStatus($id, $value)
    {
        $data = array('status' => $value);
        $this->db->where("user_id", $id);
        $this->db->update('user', $this->security->xss_clean($data));
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }

    function insert()
    {
        $today = date("Y - m - d H:i:s");
        $data = array('user_name' => trim($this->input->post('user_name')),
            'login_name' => $this->input->post('login_name'),
            'login_pwd' => $this->input->post('login_pwd'),
            'phone' => ucwords($this->input->post('phone')),
            'cell' => ucwords($this->input->post('cell')),
            'address' => ucwords(trim($this->input->post('address'))),
            'user_type' => $this->input->post('user_type'),
            'email' => trim($this->input->post('email')),
            'crtd_by' => $this->session->userdata(USER_ID),
            'status' => $this->input->post('status'),
            'auth_id' => implode(',', $this->input->post('auth_id')),
            'crtd_dt' => $today);
        $this->db->insert('user', $this->security->xss_clean($data));
        $userid = $this->db->insert_id();
        return $userid;
    }

    function getDomainUser($domain)
    {
        $query = $this->db->query("Select user_id , domain_id from nc_domain where domain_name = '$domain'");
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return 0;
    }

    function getSuperAdmin()
    {
        $query = $this->db->query("SELECT user_id FROM user WHERE user_type = 'super-admin'");
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return 0;
    }

    function getSuperDuperAdmin()
    {
        $query = $this->db->query("SELECT user_id FROM user WHERE user_type = ''");
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return 0;
    }



    function getAdminPaypalInfo()
    {
        $query = $this->db->query("SELECT paypal_account, referrer_reg_charge FROM user WHERE user_type = 'super-admin' ORDER BY user_id ASC LIMIT 1");
        if ($query->num_rows() == 1) {
            return $query->row();
        }
        return 0;
    }

    function getPrivilegeRole($userid)
    {
        $query = $this->db->query("SELECT u.id ,ur.role_id ,ra.auth_id FROM user u JOIN user_role ur ON ur.user_id = u.id LEFT JOIN role_auth ra ON ra.role_id = ur.role_id WHERE u.id = " . $userid);
        if ($query->num_rows() > 0) {
            $roles = $query->row()->role_privilege;
            $privilege_roles = explode(',', $roles);
            foreach ($privilege_roles as $key => $value) {
                $role = $this->RoleModel->getRolesByRoleId($value);
                $role_name[$key] = $role->role_type;
                $role_id[$key] = $role->role_id;
                $roller[] = array($role_id[$key] => $role_name[$key]);
            }
            return $roller;
        }
        return 0;
    }

    function getUserRoleDetailByRoleID($roleid)
    {
        $query = $this->db->get_where('user_role', array('role_id' => $roleid));
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return 0;
    }

    function getAllRoles()
    {
        $this->db->select('*');
        $this->db->from('user_role');
        $this->db->where("role_id > 2");
        $this->db->order_by('role_id', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return 0;
    }

    function getUserByUserId($userId)
    {
        return $this->db->query("SELECT u.*, p.*, concat_ws(' ', p.first_name, p.middle_initial, p.last_name) userName FROM user u
                                         LEFT JOIN profile p ON p.user_id = u.id
                                         where u.id = '$userId'")->row();
    }

    function addSuperBrokerRole($userid)
    {
        $this->getUserInfoByUserId($userid);

    }

    function getUserInfoByUserId($userid)
    {
        $query = $this->db->get_where('user', array('id' => $userid));
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return 0;

    }

    function addBrokerRole($userid)
    {
        $role_exist = $this->brokerAlreadyExistCheck($userid);
        if (empty($role_exist)) {
            $userinfo = $this->getUserInfoByUserId($userid);
            list($fname, $lname) = explode(' ', $userinfo->user_name);
            $today = date('Y-m-d H:i:s');
            $data = array(
                'user_id' => $userid,
                'affiliate_fname' => ucfirst($fname),
                'affiliate_lname' => ucfirst($lname),
                'affiliate_email' => $userinfo->email,
                'affiliate_primary_contact' => $userinfo->phone,
                'affiliate_registered_date' => $today,
                'affiliate_status' => 'Y',
                'is_delete' => 'NO',
            );
            $this->db->insert('nc_affiliate', $this->security->xss_clean($data));
            $brokerid = $this->db->insert_id();
            $this->db->insert('nc_affiliate_detail', array('affiliate_id' => $brokerid));
        }
    }

    function brokerAlreadyExistCheck($userid)
    {
        $query = $this->db->get_where('nc_affiliate', array('user_id' => $userid));
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return 0;
    }

    function addreferrerRole($userid)
    {
        $role_exist = $this->referrerAlreadyExistCheck($userid);
        if (empty($role_exist)) {
            $userinfo = $this->getUserInfoByUserId($userid);
            list($fname, $lname) = explode(' ', $userinfo->user_name);
            $today = date('Y-m-d H:i:s');
            $data = array(
                'user_id' => $userid,
                'ref_fname' => ucfirst($fname),
                'ref_lname' => ucfirst($lname),
                'ref_email' => $userinfo->email,
                'ref_primary_contact' => $userinfo->phone,
                'ref_registered_date' => $today,
                'ref_status' => 'Y',
                'ref_is_delete' => 'NO'
            );
            $this->db->insert('referrer', $this->security->xss_clean($data));
            return $referrerid = $this->db->insert_id();

        }
    }

    function referrerAlreadyExistCheck($userid)
    {
        $query = $this->db->get_where('referrer', array('user_id' => $userid));
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return 0;
    }

    function addLineRole($userid)
    {
        $role_exist = $this->lineAlreadyExistCheck($userid);
        if (empty($role_exist)) {
            $userinfo = $this->getUserInfoByUserId($userid);
            list($fname, $lname) = explode(' ', $userinfo->user_name);
            $today = date('Y-m-d H:i:s');
            $data = array(
                'user_id' => $userid,
                'to_fname' => ucfirst($fname),
                'to_lname' => ucfirst($lname),
                'to_email' => $userinfo->email,
                'to_pcon' => $userinfo->phone,
                'to_reg_date' => $today,
            );
            $this->db->insert('nc_line_owner', $this->security->xss_clean($data));
            return $toid = $this->db->insert_id();

        }
    }

    function lineAlreadyExistCheck($userid)
    {
        $query = $this->db->get_where('nc_line_owner', array('user_id' => $userid));
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return 0;
    }

    function updateRolesIntoUserTable($roles, $userid)
    {
        $this->db->where('user_id', $userid);
        $this->db->update('user', array('role_privilege' => $roles));
        if ($this->db->affected_rows() == 1)
            return TRUE;
        else
            return FALSE;
    }

    public function insertToUserTable($email)
    {
        $data = array(
            'email' => $email,
        );
        $this->db->insert('user', $this->data($data));
        $userId = $this->db->insert_id();
        return $userId;
    }

    public function brokerExist($broker_id)
    {
        $this->db->where('broker_id', $broker_id);
        $query = $this->db->get('broker');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function getBrokerUsersWithRoles($brokerId, $role_name = '')
    {
        return $query = $this->db->query("SELECT u.id, u_r. user_id , u_r.role_id ,r.id roles_id , p.first_name first_name,p.middle_initial middle_initial, p.last_name last_name,p.phone phone , u.email email,
                                    (SELECT concat(first_name, ' ', last_name) FROM profile p WHERE p.user_id = b.broker_id) broker_name,
                                    b.broker_id broker_id, u.status, u.last_login_date, u.created_date
                                    FROM user u
                                    LEFT JOIN profile p ON p.user_id = u.id
                                    LEFT JOIN broker b ON b.client_id = u.id
                                    LEFT JOIN user_role u_r ON u_r.user_id = u.id
                                    LEFT JOIN role r ON r.id = u_r.role_id
                                    where b.broker_id = $brokerId and r.name = '$role_name'")->result();

    }

    function login($email, $password)
    {
        $query = $this->db->query("SELECT u.id, u.email, m.parent, p.profile_image ,p.phone , u.created_date,concat(p.first_name, ' ', p.last_name) AS name, ad.street, ad.state, ad.city, ad.postal_code
                                          FROM user u
                                          LEFT JOIN user_role ur ON ur.user_id = u .id
                                          LEFT JOIN profile p ON u.id = p.user_id
                                          LEFT JOIN address ad ON p.address_id = ad.id
                                          JOIN membership m on m.user_id = u.id
                                          WHERE u.email = ? AND AES_DECRYPT(u.password, '$this->password_phrase') = ? AND u.status = 1 AND m.status =1", array($email, $password));
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            $user = $query->row();
            $roleMembershipPrivilege = $this->MembershipModel->getMembershipRolesByUserId($user->id);
            $nonPublicRoles = $this->RoleModel->getNonPublicRolesByUserId($user->id);
            if (!empty($roleMembershipPrivilege) && !empty($nonPublicRoles)) {
                $roleResult = array_merge((array)$roleMembershipPrivilege, (array)$nonPublicRoles);
            } else {
                $roleResult = $roleMembershipPrivilege;
            }
            $roles = array();
            $roleKeys = '';
            foreach ($roleResult as $role) {
                $roles[$role->name] = $role->label;
                $roleKeys .= $role->id . ',';
            }
            $roleKeys = trim($roleKeys, ",");
            $authResult = '';
            if ($roleKeys) {
                $authResult = $this->db->query("SELECT a.name FROM role_auth ra LEFT JOIN  auth a on a.id = ra.auth_id WHERE ra.role_id IN ($roleKeys)")->result();
            }
            $firstRole = array();
            if (count($roleResult) != 0) {
                $firstRole = $roleResult[0];
            }
            if ($firstRole) {
                $roleId = $firstRole->id;
                $roleName = $firstRole->name;
                $roleLabel = $firstRole->label;
            } else {
                $roleId = '';
                $roleName = '';
                $roleLabel = '';
            }
            $monthlyTips = array();
            if (in_array(CLIENT, array_keys($roles))) {
                $monthlyTips = $this->ContentModel->getMonthlyTips($user->id);
            }

            $pdfBooks = array();
            if (in_array(CLIENT, array_keys($roles))) {
                $pdfBooks = $this->ContentModel->getPdf();
            }
            $data['receivedEmails'] = $this->EmailModel->received_emails($user->id);
            $inbox = $data['receivedEmails'];
            $data['count_receivedEmails'] = $this->EmailModel->countAllReceivedItems($user->id);
            $countInbox = $data['count_receivedEmails'];
            $membershipQuery = $this->MembershipModel->getMemberships($user->id);
            $memberships = array();
            foreach ($membershipQuery as $query) {
                $memberships[] = $query->membership;
            }

            $userdata = array(
                USER_ID => $user->id,
                BROKER_ID => $user->parent,
                ROLES => $roles,
                AUTHS => $authResult,
                NAME => $user->name,
                PROFILE_PIC => $user->profile_image,
                ROLE_ID => $roleId,
                ROLE_NAME => $roleName,
                ROLE_LABEL => $roleLabel,
                CREATED_DATE => $user->created_date,
                INBOX => $inbox,
                COUNT_INBOX => $countInbox,
                COUNT_INBOX => $countInbox,
                EMAIL => $user->email,
                MEMBERSHIPS => $memberships,
                MONTHLY_TIPS => $monthlyTips,
                PDF_BOOKS => $pdfBooks,
                PHONE => $user->phone,
                CITY => $user->city,
                STREET => $user->street,
                ZIP => $user->postal_code,
                STATE => $user->state
            );
            $this->session->set_userdata($userdata);
            return $user->id;
        }
    }

    function getMembershipChargeAfterDiscount($userId, $typeId = null, $roleId = null, $couponDiscount = null)
    {
        $reduceablePrice = $this->calculateReduceableAmount($userId);
        if ($reduceablePrice) {
            if ($typeId != null && $roleId != null) {
                return $this->db->query("SELECT mt.id tid, Round(mt.price - $reduceablePrice) price, ml.value
                                        FROM membership_type mt
                                        JOIN membership_level ml ON ml.id = mt.level
                                        JOIN status s ON s.id = mt.status
                                        WHERE  mt.id = $typeId AND mt.role = $roleId")->row();
            } else {
                return $this->db->query("SELECT mt.id, concat_ws(' ' , concat('$', Round(mt.price - $reduceablePrice)), r.label,ml.value) description
                                        FROM membership_type mt
                                        JOIN role r ON r.id = mt.role
                                        JOIN membership_level ml ON ml.id = mt.level
                                        JOIN status s ON s.id = mt.status
                                        WHERE r.name = 'client'
                                        ORDER BY r.label , ml.value  ASC")->result();
            }
        } elseif ($couponDiscount) {
            return $this->db->query("SELECT mt.id tid, ROUND(mt.price -  (mt.price * ('$couponDiscount') / 100),2) price, ml.value
                                        FROM membership_type mt
                                        JOIN membership_level ml ON ml.id = mt.level
                                        JOIN status s ON s.id = mt.status
                                        WHERE  mt.id = $typeId AND mt.role = $roleId")->row();
        } else {
            return $this->db->query("SELECT mt.id tid, mt.price, ml.value
                                        FROM membership_type mt
                                        JOIN membership_level ml ON ml.id = mt.level
                                        JOIN status s ON s.id = mt.status
                                        WHERE  mt.id = $typeId AND mt.role = $roleId")->row();
        }
    }

    function calculateReduceableAmount($userId)
    {
        $query = $this->db->query("SELECT m.start_date, m.end_date, ROUND((mt.price - (CASE WHEN !c.percentage THEN c.amount ELSE (mt.price * (c.percentage) / 100) END)),2) price
                                  FROM membership m
                                  LEFT JOIN membership_type mt ON mt.id = m.type
                                  LEFT JOIN membership_level ml ON ml.id = mt.level
                                  LEFT JOIN campaign c ON c.id = m.campaign where m.user_id = '$userId'")->row();

        if (strtotime($query->end_date) > strtotime(date('Y-m-d'))) {
            $start = new DateTime($query->start_date);
            $end = new DateTime($query->end_date);
            $days = $end->diff($start)->format("%a");
            $today = new DateTime(date('Y-m-d'));
            $remainingDays = $end->diff($today)->format("%a");
            return $reduceablePrice = round(($query->price * $remainingDays) / $days);
        } else
            return false;
    }

    function getClientsUnderBroker($broker_id)
    {
        $query = $this->db->query("SELECT concat_ws(' ', p.first_name, p.last_name) client, u.id
                                        FROM user u
                                        LEFT JOIN user_role ur ON ur.user_id = u.id
                                        LEFT JOIN broker b on b.client_id = u.id
                                        LEFT JOIN  role r ON r.id = b.role_id
                                        LEFT JOIN  profile p ON p.user_id = u.id
                                        WHERE r.name = 'client' and  b.broker_id = $broker_id");
        if ($query->num_rows() > 0) {
            return $this->editable($query->result(), 'id', 'client');
        } else
            return false;
    }

    function  getBrokersSystemUsers($user_id, $widget)
    {

        $result = $this->db->query("SELECT concat_ws(' ', p.first_name, p.last_name) client, u.id
                                        FROM user u
                                        LEFT JOIN membership m ON m.user_id = u.id
                                        LEFT JOIN  profile p ON p.user_id = u.id where m.parent = '$user_id'")->result();
        return $this->widget($widget, $result, 'id', 'client', '');
    }

    function  getSystemUsersUnderBroker($client_id, $widget)
    {
        $parent_id = $this->getParentOfSystemUsers($client_id);
        $parent_id = $parent_id->parent;
        $result = $this->db->query("SELECT concat_ws(' ', p.first_name, p.last_name) system_users, u.id
                                        FROM user u
                                        LEFT JOIN membership m ON m.user_id = u.id
                                        LEFT JOIN  profile p ON p.user_id = u.id where m.parent = '$parent_id'")->result();
        return $this->widget($widget, $result, 'id', 'system_users', '');
    }

    function getParentOfSystemUsers($broker_id)
    {
        $result = $this->db->query("SELECT parent from membership where user_id = '$broker_id'")->row();
        return $result;
    }

    function getParentName($broker_id)
    {
        $result = $this->db->query("SELECT u.* ,p.*, concat_ws(' ', p.first_name, p.last_name) parent_name from profile p
                                       left join user u on u.id = p.user_id
                                       where u.id = '$broker_id'")->row();
        return $result;
    }

    public function userExist($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {
            $id = $this->getIdByEmail($email);
            $id = $id->id;
            echo $id;
        } else {
            echo '0';
        }
    }


    function getIdByEmail($email)
    {
        return $this->db->query("SELECT id from user where email = '$email'")->row();
    }

    function getQuestionById($id)
    {
        return $this->db->query("SELECT q.question as question1 ,q1.question as question2 from profile p
        LEFT JOIN question q ON  q.id=p.question_id_1
        LEFT JOIN question q1 ON  q1.id=p.question_id_2
        where p.user_id = '$id'")->row();
    }

    function getAdminUsers()
    {
        return $this->db->query("SELECT u.id, u.email FROM user u LEFT JOIN user_role ur ON u.id = ur.user_id JOIN role r ON r.id = ur.role_id WHERE r.name = 'admin' ")->result();
    }

    /*
     * ============================================================
     * To Do sharing
     * ===========================================================
     */

    /*Get System Users*/
    function toDoSystemUsers($parent_id, $sys_admin_id = 0)
    {

        $condition = '';
        if ($sys_admin_id)
            $condition = " AND m.sys_admin_id=" . $sys_admin_id;

        $result = $this->db->query("SELECT  DISTINCT  u.id id, concat_ws(' ', p.first_name, p.last_name) user ,
                                    m.parent broker_id, u.status, u.last_login_date, u.created_date
                                    FROM user u
                                    LEFT JOIN profile p ON p.user_id = u.id
                                    LEFT JOIN membership m ON m.user_id= u.id
                                    where m.parent = '$parent_id' $condition ")->result();

        return $this->widget(SELECT, $result, 'id', 'user', '');
    }


    function getUserCreatedDate($user_id)
    {
        $query = $this->db->query("select start_date from membership where user_id = '$user_id'");
        return $query->row();

    }
}

