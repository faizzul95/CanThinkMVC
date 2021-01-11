<?php

class Role_model extends Model
{
    private $db;
    protected $table      = 'master_role';
    protected $primaryKey = 'role_id';
    protected $foreignKey = '';

    public function __construct()
    {
        $this->db = new Database;
        $this->timestamp = date('Y-m-d H:i:s');
    }

    public function getAllRole($params = NULL)
    {
        $data = $this->db->get($this->table);
        return $data;
    }

    public function getUserRole($params = NULL)
    {
        $data = $this->db->where("role_id", $params)->fetchRow($this->table);
        return $data;
    }

    public function insert($data)
    {

        $data = [
                    'role_name' => $this->db->escape($data['role_name']),
                    'redirect_url' => $this->db->escape($data['redirect_url']),
                    'created_at' => $this->timestamp,
                ];

        $result = $this->db->insert($this->table, $data);
        return $result;
    }

    public function update($data)
    {   
        $user_id = $this->db->escape($data['user_id']);
        $data = [
                    'role_name' => $this->db->escape($data['role_name']),
                    'redirect_url' => $this->db->escape($data['redirect_url']),
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

}