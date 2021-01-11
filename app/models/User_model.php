<?php

// Example : https://github.com/ThingEngineer/PHP-MySQLi-Database-Class

class User_model extends Model
{
    private $db;
    protected $table      = 'user';
    protected $primaryKey = 'user_id';
    protected $foreignKey = '';

    public function __construct()
    {
        $this->db = new Database;
        $this->timestamp = date('Y-m-d H:i:s');
    }

    public function getAllUser()
    {
      
        $this->db->join("master_status s", "f.status_id=s.status_id", "LEFT");
        $this->db->join("master_role t", "f.role_id=t.role_id", "LEFT");
        $this->db->join("school_info q", "f.school_id=q.school_id", "LEFT");
        $data = $this->db->get("".$this->table." f", null, "*");

        return $data;
    }

    public function getUserByID($params = NULL)
    {
        $data = $this->db->where($this->primaryKey, $params)->fetchRow($this->table);
        return $data;
    }

    public function getUserByEmail($params = NULL)
    {
        $data = $this->db->where("user_email", $params)->fetchRow($this->table);
        return $data;
    }

    public function getUserLogin($params = NULL)
    {
        $this->db->where('user_email', $params);
        $this->db->orWhere('user_username', $params);
        $data = $this->db->fetchRow($this->table);
        return $data;
    }

    public function getUserStatus($params = NULL)
    {
        $data = $this->db->where("status_id", $params)->fetchRow('master_status');
        return $data;
    }

    public function getUserByUsername($params = NULL)
    {
        $data = $this->db->where("user_username", $params)->fetchRow($this->table);
        return $data;
    }

    public function insert($data)
    {

        $data = [
                    'user_fullname' => $this->db->escape($data['user_fullname']),
                    'user_email' => $this->db->escape($data['user_email']),
                    'user_username' => $this->db->escape($data['user_username']),
                    'user_password' => $this->encryptPassword($data['user_password']),
                    'role_id' => $this->db->escape($data['role_id']),
                    'user_avatar' => 'default/image.png',
                    'status_id' => '1',
                    'school_id' => '1',
                    'created_at' => $this->timestamp,
                ];

        $result = $this->db->insert($this->table, $data);
        return $result;
    }

    public function update($data)
    {   
        $user_id = $this->db->escape($data['user_id']);
        $data = [
                    'user_fullname' => $this->db->escape($data['user_fullname']),
                    'user_email' => $this->db->escape($data['user_email']),
                    'user_username' => $this->db->escape($data['user_username']),
                    'user_password' => $this->encryptPassword($data['user_password']),
                    'role_id' => $this->db->escape($data['role_id']),
                    'user_avatar' => 'default/image.png',
                    'status_id' => '1',
                    'school_id' => '1',
                    'updated_at' => $this->timestamp,
                ];

        if ($this->db->where($this->primaryKey, $user_id)->update($this->table, $data))
           $result = $this->db->count;
        else
           $result = $this->db->getLastError();

        return $result;
    }

    public function delete($id)
    {
        $result = $this->db->where($this->primaryKey, $id)->delete($this->table);
        return $result;
    }

    private function encryptPassword($pass)
    {
        return password_hash($pass, PASSWORD_DEFAULT); // hash password new password
    }

}