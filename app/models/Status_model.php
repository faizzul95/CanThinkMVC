<?php

class Status_model extends Model
{
    private $db;
    protected $table      = 'master_status';
    protected $primaryKey = 'status_id';
    protected $foreignKey = '';

    public function __construct()
    {
        $this->db = new Database;
        $this->timestamp = date('Y-m-d H:i:s');
    }

    public function getAllStatus($params = NULL)
    {
        $data = $this->db->get($this->table);
        return $data;
    }

    public function insert($data)
    {

        $data = [
                    'status_name' => $this->db->escape($data['status_name']),
                    'status_type' => $this->db->escape($data['status_type']),
                    'created_at' => $this->timestamp,
                ];

        $result = $this->db->insert($this->table, $data);
        return $result;
    }

    public function update($data)
    {   
        $user_id = $this->db->escape($data['user_id']);
        $data = [
                    'status_name' => $this->db->escape($data['status_name']),
                    'status_type' => $this->db->escape($data['status_type']),
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